<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PaynetLogController extends Controller
{
    protected $logFiles = [
        'main' => 'storage/logs/paynet.log',
        'transactions' => 'storage/logs/paynet_transactions.log',
        'debug' => 'storage/logs/paynet_debug.log'
    ];

    /**
     * Show Paynet logs dashboard
     */
    public function index()
    {
        $stats = $this->getLogStats();
        $mainLog = $this->getLogEntries('main', 10);
        $transactionLog = $this->getLogEntries('transactions', 10);
        $debugLog = $this->getLogEntries('debug', 10);

        return view('admin.paynet.logs', compact('stats', 'mainLog', 'transactionLog', 'debugLog'));
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

        $title = ucfirst($type) . ' Logs';
        
        return view('admin.paynet.logs', compact('logs', 'title', 'type', 'filter'));
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
        $lines = array_filter(explode("\n", $content));
        
        // Reverse to get latest entries first
        $lines = array_reverse($lines);
        
        return array_slice($lines, 0, $limit);
    }

    /**
     * Clear logs
     */
    public function clearLogs(Request $request)
    {
        $type = $request->get('type', 'all');
        
        if ($type === 'all') {
            foreach ($this->logFiles as $logType => $file) {
                if (File::exists($file)) {
                    File::put($file, '');
                }
            }
        } else {
            $logFile = $this->logFiles[$type] ?? null;
            if ($logFile && File::exists($logFile)) {
                File::put($logFile, '');
            }
        }

        return redirect()->back()->with('success', 'Logs cleared successfully');
    }

    /**
     * Download logs
     */
    public function downloadLogs(Request $request)
    {
        $type = $request->get('type', 'all');
        $filename = 'paynet_logs_' . date('Y-m-d_H-i-s') . '.txt';
        
        if ($type === 'all') {
            $content = '';
            foreach ($this->logFiles as $logType => $file) {
                if (File::exists($file)) {
                    $content .= "=== {$logType} LOG ===\n";
                    $content .= File::get($file) . "\n\n";
                }
            }
        } else {
            $logFile = $this->logFiles[$type] ?? null;
            if (!$logFile || !File::exists($logFile)) {
                return redirect()->back()->with('error', 'Log file not found');
            }
            $content = File::get($logFile);
            $filename = "paynet_{$type}_logs_" . date('Y-m-d_H-i-s') . '.txt';
        }

        return response($content)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    /**
     * Get real-time log updates
     */
    public function getLiveLogs(Request $request)
    {
        $type = $request->get('type', 'main');
        $lastLine = $request->get('last_line', 0);
        
        $logFile = $this->logFiles[$type] ?? $this->logFiles['main'];
        
        if (!File::exists($logFile)) {
            return response()->json(['logs' => [], 'last_line' => 0]);
        }

        $content = File::get($logFile);
        $lines = array_filter(explode("\n", $content));
        
        $newLines = array_slice($lines, $lastLine);
        
        return response()->json([
            'logs' => $newLines,
            'last_line' => count($lines)
        ]);
    }
} 