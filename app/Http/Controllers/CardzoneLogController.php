<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CardzoneLogController extends Controller
{
    protected $logFiles = [
        'main' => 'storage/logs/cardzone.log',
        'transactions' => 'storage/logs/cardzone_transactions.log',
        'debug' => 'storage/logs/cardzone_debug.log'
    ];

    /**
     * Show Cardzone logs dashboard
     */
    public function index()
    {
        $stats = $this->getLogStats();
        $mainLog = $this->getLogEntries('main', 10);
        $transactionLog = $this->getLogEntries('transactions', 10);
        $debugLog = $this->getLogEntries('debug', 10);

        return view('admin.cardzone.logs', compact('stats', 'mainLog', 'transactionLog', 'debugLog'));
    }

    /**
     * Show detailed logs
     */
    public function logs(Request $request)
    {
        $type = $request->get('type', 'main');
        $perPage = 20;
        $page = (int) $request->get('page', 1);
        $page = $page > 0 ? $page : 1;

        $allLogs = $this->getLogEntries($type, 1000);
        
        $filter = $request->get('filter');
        if ($filter) {
            $filterLower = strtolower($filter);
            $allLogs = array_filter($allLogs, function($log) use ($filterLower) {
                return str_contains(strtolower($log), $filterLower);
            });
        }

        // Paginate the logs
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

        $title = ucfirst($type) . ' Logs';
        
        return view('admin.cardzone.logs', compact('logs', 'title', 'type', 'filter'));
    }

    /**
     * Get log statistics
     */
    private function getLogStats()
    {
        $stats = [];
        
        foreach ($this->logFiles as $type => $file) {
            if (File::exists($file)) {
                $content = File::get($file);
                $lines = explode("\n", $content);
                $stats[$type] = [
                    'total_lines' => count($lines),
                    'file_size' => File::size($file),
                    'last_modified' => Carbon::createFromTimestamp(File::lastModified($file)),
                    'error_count' => count(array_filter($lines, fn($line) => str_contains(strtolower($line), 'error'))),
                    'success_count' => count(array_filter($lines, fn($line) => str_contains(strtolower($line), 'success'))),
                ];
            } else {
                $stats[$type] = [
                    'total_lines' => 0,
                    'file_size' => 0,
                    'last_modified' => null,
                    'error_count' => 0,
                    'success_count' => 0,
                ];
            }
        }

        return $stats;
    }

    /**
     * Get log entries from a specific log file
     */
    private function getLogEntries($type, $limit = 50)
    {
        $logFile = $this->logFiles[$type] ?? $this->logFiles['main'];
        
        if (!File::exists($logFile)) {
            return [];
        }

        $content = File::get($logFile);
        $lines = explode("\n", $content);
        
        // Remove empty lines and reverse to get latest first
        $lines = array_filter($lines, fn($line) => !empty(trim($line)));
        $lines = array_reverse($lines);
        
        return array_slice($lines, 0, $limit);
    }

    /**
     * Clear logs
     */
    public function clearLogs(Request $request)
    {
        $type = $request->get('type', 'main');
        $logFile = $this->logFiles[$type] ?? $this->logFiles['main'];
        
        if (File::exists($logFile)) {
            File::put($logFile, '');
            Log::info("Cardzone {$type} logs cleared by admin");
        }

        return redirect()->back()->with('success', ucfirst($type) . ' logs cleared successfully');
    }

    /**
     * Download logs
     */
    public function downloadLogs(Request $request)
    {
        $type = $request->get('type', 'main');
        $logFile = $this->logFiles[$type] ?? $this->logFiles['main'];
        
        if (!File::exists($logFile)) {
            return response('Log file not found', 404);
        }

        $content = File::get($logFile);
        $filename = "cardzone_{$type}_" . date('Y-m-d_H-i-s') . '.log';

        return response($content)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    /**
     * Get live logs for AJAX requests
     */
    public function getLiveLogs(Request $request)
    {
        $type = $request->get('type', 'main');
        $limit = (int) $request->get('limit', 10);
        
        $logs = $this->getLogEntries($type, $limit);
        
        return response()->json([
            'logs' => $logs,
            'timestamp' => now()->toISOString()
        ]);
    }
} 