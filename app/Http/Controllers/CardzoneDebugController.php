<?php

namespace App\Http\Controllers;

use App\Services\CardzoneDebugService;
use App\Services\CardzoneService;
use App\Services\PaymentTransactionService;
use App\Models\CardzoneKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Exception;

class CardzoneDebugController extends Controller
{
    protected $debugService;
    protected $cardzoneService;
    protected $paymentTransactionService;

    public function __construct()
    {
        $this->debugService = new CardzoneDebugService();
        $this->cardzoneService = new CardzoneService();
        $this->paymentTransactionService = new PaymentTransactionService();
    }

    /**
     * Show debug dashboard
     */
    public function index()
    {
        $stats = $this->debugService->getLogStats();
        $debugLog = $this->debugService->getDebugLog(50);
        $transactionLog = $this->debugService->getTransactionLog(50);

        return view('admin.cardzone.debug', compact('stats', 'debugLog', 'transactionLog'));
    }

    /**
     * Show debug logs
     */
    public function logs(Request $request)
    {
        $type = $request->get('type', 'debug');
        $perPage = 20; // Match transactions pagination
        $page = (int) $request->get('page', 1);
        $page = $page > 0 ? $page : 1;

        if ($type === 'transaction') {
            $allLogs = $this->debugService->getTransactionLog(1000); // get enough for pagination
            $title = 'Transaction Logs';
        } else {
            $allLogs = $this->debugService->getDebugLog(1000);
            $title = 'Debug Logs';
        }
        
        $filter = $request->get('filter');
        if ($filter) {
            $filterLower = strtolower($filter);
            $allLogs = array_filter($allLogs, function($log) use ($filterLower) {
                $datetime = '';
                $level = '';
                $transactionId = '';
                $action = '';
                $message = '';
                $data = '';
                $jsonTransactionId = '';
                if (preg_match('/\[(.*?)\]\s*\[(.*?)\]\s*TXN:([^\s]+)\s*\|\s*([^|]+)\s*\|?(.*)$/s', $log, $m)) {
                    $datetime = $m[1];
                    $level = $m[2];
                    $transactionId = $m[3];
                    $action = trim($m[4]);
                    $data = trim($m[5]);
                } elseif (preg_match('/\[(.*?)\]\s*\[(.*?)\]\s*([^|]+)\|?\s*Data:?\s*(.*)$/s', $log, $m)) {
                    $datetime = $m[1];
                    $level = $m[2];
                    $message = trim($m[3]);
                    $data = trim($m[4]);
                } else {
                    $message = strip_tags($log);
                }
                if (preg_match('/\{[\s\S]*\}/', $data, $jsonMatch)) {
                    $json = json_decode($jsonMatch[0], true);
                    if (is_array($json) && isset($json['transaction_id'])) {
                        $jsonTransactionId = $json['transaction_id'];
                    }
                }
                // Format datetime as displayed in the table (dd/mm/yyyy)
                $formattedDatetime = $datetime;
                $formattedDatetimeShort = $datetime;
                if ($datetime) {
                    try {
                        $formattedDatetime = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s.u', $datetime)->format('d/m/y h:i A');
                        $formattedDatetimeShort = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s.u', $datetime)->format('d/m/Y');
                    } catch (\Exception $e) {
                        $formattedDatetime = $datetime;
                        $formattedDatetimeShort = $datetime;
                    }
                }
                // Check filter in any column, including raw, previous, and new formatted datetime
                return (
                    stripos($datetime, $filterLower) !== false ||
                    stripos(strtolower($formattedDatetime), $filterLower) !== false ||
                    stripos(strtolower($formattedDatetimeShort), $filterLower) !== false ||
                    stripos($level, $filterLower) !== false ||
                    stripos($transactionId, $filterLower) !== false ||
                    stripos($jsonTransactionId, $filterLower) !== false ||
                    stripos($action, $filterLower) !== false ||
                    stripos($message, $filterLower) !== false
                );
            });
            $allLogs = array_values($allLogs); // reindex
        }
        
        // Show latest first
        $allLogs = array_reverse($allLogs);
        
        $total = count($allLogs);
        $offset = ($page - 1) * $perPage;
        $logs = array_slice($allLogs, $offset, $perPage);
        
        // Create Laravel paginator
        $logs = new \Illuminate\Pagination\LengthAwarePaginator(
            $logs,
            $total,
            $perPage,
            $page,
            [
                'path' => $request->url(),
                'pageName' => 'page',
            ]
        );
        
        // Append query parameters
        $logs->appends($request->query());

        return view('admin.cardzone.logs', compact('logs', 'title', 'type', 'filter'));
    }

    /**
     * Clear logs
     */
    public function clearLogs()
    {
        $this->debugService->clearLogs();
        return redirect()->back()->with('success', 'Logs cleared successfully');
    }















    /**
     * Show transaction records
     */
    public function transactions(Request $request)
    {
        $query = \App\Models\CardzoneTransaction::with('donation')->latest();
        
        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('cz_status', $request->status);
        }
        
        // Filter by payment method
        if ($request->has('payment_method') && $request->payment_method !== 'all') {
            $query->where('cz_payment_method', $request->payment_method);
        }
        
        // Search by transaction ID
        if ($request->has('search')) {
            $query->where('cz_transaction_id', 'like', '%' . $request->search . '%');
        }
        
        $transactions = $query->paginate(20);
        $stats = $this->paymentTransactionService->getTransactionStats();
        
        return view('admin.cardzone.transactions', compact('transactions', 'stats'));
    }

    /**
     * Show individual transaction details
     */
    public function showTransaction(\App\Models\CardzoneTransaction $transaction)
    {
        return response()->json($transaction);
    }

    /**
     * Get log stats
     */
    public function getStats()
    {
        $debugStats = $this->debugService->getLogStats();
        $transactionStats = $this->paymentTransactionService->getTransactionStats();
        
        return response()->json(array_merge($debugStats, $transactionStats));
    }

    /**
     * Download logs
     */
    public function downloadLogs(Request $request)
    {
        $type = $request->get('type', 'debug');
        
        if ($type === 'transaction') {
            $content = file_get_contents(storage_path('logs/cardzone_transactions.log'));
            $filename = 'cardzone_transactions_' . date('Y-m-d_H-i-s') . '.log';
        } else {
            $content = file_get_contents(storage_path('logs/cardzone_debug.log'));
            $filename = 'cardzone_debug_' . date('Y-m-d_H-i-s') . '.log';
        }

        return response($content)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
} 