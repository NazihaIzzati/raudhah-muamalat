<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class CardzoneDebugService
{
    protected $debugLogPath;
    protected $transactionLogPath;
    protected $enabled;

    public function __construct()
    {
        $this->debugLogPath = storage_path('logs/cardzone_debug.log');
        $this->transactionLogPath = storage_path('logs/cardzone_transactions.log');
        $this->enabled = env('CARDZONE_DEBUG', true);
    }

    /**
     * Log debug information with timestamp and context
     */
    public function log($message, $data = [], $level = 'INFO')
    {
        if (!$this->enabled) {
            return;
        }

        $timestamp = Carbon::now()->format('Y-m-d H:i:s.u');
        $logEntry = [
            'timestamp' => $timestamp,
            'level' => $level,
            'message' => $message,
            'data' => $data,
        ];

        $logLine = "[{$timestamp}] [{$level}] {$message}";
        if (!empty($data)) {
            $logLine .= " | Data: " . json_encode($data, JSON_PRETTY_PRINT);
        }

        // Write to debug log
        File::append($this->debugLogPath, $logLine . "\n");

        // Also write to Laravel log
        Log::channel('cardzone')->info($message, $data);
    }

    /**
     * Log transaction-specific information
     */
    public function logTransaction($transactionId, $action, $data = [], $status = 'INFO')
    {
        if (!$this->enabled) {
            return;
        }

        $timestamp = Carbon::now()->format('Y-m-d H:i:s.u');
        $logEntry = [
            'timestamp' => $timestamp,
            'transaction_id' => $transactionId,
            'action' => $action,
            'status' => $status,
            'data' => $data,
        ];

        $logLine = "[{$timestamp}] [{$status}] TXN:{$transactionId} | {$action}";
        if (!empty($data)) {
            $logLine .= " | " . json_encode($data, JSON_PRETTY_PRINT);
        }

        // Write to transaction log
        File::append($this->transactionLogPath, $logLine . "\n");

        // Also write to debug log
        $this->log("Transaction {$action}", $logEntry, $status);
    }

    /**
     * Log payment initiation
     */
    public function logPaymentInitiation($transactionId, $cardDetails, $amount, $currency)
    {
        $data = [
            'transaction_id' => $transactionId,
            'amount' => $amount,
            'currency' => $currency,
            'card_number' => substr($cardDetails['card_number'], 0, 4) . '****' . substr($cardDetails['card_number'], -4),
            'card_expiry' => $cardDetails['card_expiry'],
            'card_holder' => $cardDetails['card_holder_name'],
        ];

        $this->logTransaction($transactionId, 'PAYMENT_INITIATED', $data, 'SUCCESS');
    }

    /**
     * Log key exchange attempt with detailed request and response
     */
    public function logKeyExchange($transactionId, $url, $payload, $response, $success)
    {
        // Enhanced request logging
        $requestData = [
            'url' => $url,
            'method' => 'POST',
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],
            'payload' => [
                'merchantId' => $payload['merchantId'] ?? 'N/A',
                'purchaseId' => $payload['purchaseId'] ?? 'N/A',
                'pubKey_length' => isset($payload['pubKey']) ? strlen($payload['pubKey']) : 'N/A',
                'pubKey_preview' => isset($payload['pubKey']) ? substr($payload['pubKey'], 0, 50) . '...' : 'N/A'
            ],
            'timeout' => 30
        ];

        // Enhanced response logging
        $responseData = [
            'status_code' => $response['status'] ?? 'N/A',
            'content_type' => $response['content_type'] ?? 'N/A',
            'response_headers' => $response['headers'] ?? [],
            'response_body' => $response['body'] ?? 'N/A',
            'response_length' => strlen($response['body'] ?? ''),
            'response_time' => $response['response_time'] ?? 'N/A',
            'success' => $success
        ];

        // Log request details
        $this->logTransaction($transactionId, 'KEY_EXCHANGE_REQUEST', $requestData, 'INFO');
        
        // Log response details
        $this->logTransaction($transactionId, 'KEY_EXCHANGE_RESPONSE', $responseData, $success ? 'SUCCESS' : 'ERROR');

        // Log summary
        $summaryData = [
            'url' => $url,
            'request_payload_summary' => [
                'merchantId' => $payload['merchantId'] ?? 'N/A',
                'purchaseId' => $payload['purchaseId'] ?? 'N/A',
                'pubKey_length' => isset($payload['pubKey']) ? strlen($payload['pubKey']) : 'N/A'
            ],
            'response_summary' => [
                'status_code' => $response['status'] ?? 'N/A',
                'response_length' => strlen($response['body'] ?? ''),
                'content_type' => $response['content_type'] ?? 'N/A',
                'response_time' => $response['response_time'] ?? 'N/A'
            ],
            'success' => $success,
            'error' => $response['error'] ?? null,
        ];

        $status = $success ? 'SUCCESS' : 'ERROR';
        $this->logTransaction($transactionId, 'KEY_EXCHANGE_SUMMARY', $summaryData, $status);
    }

    /**
     * Log payment form submission
     */
    public function logPaymentSubmission($transactionId, $url, $payload, $response)
    {
        $data = [
            'url' => $url,
            'payload' => $this->sanitizePayload($payload),
            'response_status' => $response['status'] ?? 'N/A',
            'response_length' => strlen($response['body'] ?? ''),
            'content_type' => $response['content_type'] ?? 'N/A',
            'has_form' => strpos($response['body'] ?? '', '<form') !== false,
            'has_3ds' => strpos($response['body'] ?? '', '3D Secure') !== false,
        ];

        $status = ($response['status'] ?? 0) === 200 ? 'SUCCESS' : 'ERROR';
        $this->logTransaction($transactionId, 'PAYMENT_SUBMISSION', $data, $status);
    }

    /**
     * Log callback received
     */
    public function logCallbackReceived($transactionId, $callbackData, $macValid = null)
    {
        $data = [
            'callback_data' => $this->sanitizeCallbackData($callbackData),
            'mac_valid' => $macValid,
            'verification_status' => $callbackData['MPI_VER_STATUS'] ?? 'N/A',
            'mpi_status' => $callbackData['MPI_MPI_STATUS'] ?? 'N/A',
        ];

        $status = $macValid !== false ? 'SUCCESS' : 'ERROR';
        $this->logTransaction($transactionId, 'CALLBACK_RECEIVED', $data, $status);
    }

    /**
     * Log payment status update
     */
    public function logPaymentStatus($transactionId, $oldStatus, $newStatus, $reason = '')
    {
        $data = [
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
            'reason' => $reason,
        ];

        $this->logTransaction($transactionId, 'STATUS_UPDATE', $data, 'INFO');
    }

    /**
     * Log error with full context
     */
    public function logError($transactionId, $error, $context = [])
    {
        $data = [
            'error' => $error,
            'context' => $context,
            'stack_trace' => debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 3),
        ];

        $this->logTransaction($transactionId, 'ERROR', $data, 'ERROR');
    }

    /**
     * Log success milestone
     */
    public function logSuccess($transactionId, $milestone, $data = [])
    {
        $this->logTransaction($transactionId, $milestone, $data, 'SUCCESS');
    }

    /**
     * Sanitize sensitive data in payload
     */
    protected function sanitizePayload($payload)
    {
        $sanitized = $payload;
        
        // Mask card number
        if (isset($sanitized['MPI_PAN'])) {
            $cardNumber = $sanitized['MPI_PAN'];
            $sanitized['MPI_PAN'] = substr($cardNumber, 0, 4) . '****' . substr($cardNumber, -4);
        }

        // Mask CVV
        if (isset($sanitized['MPI_CVV2'])) {
            $sanitized['MPI_CVV2'] = '***';
        }

        // Mask MAC (show only first and last few characters)
        if (isset($sanitized['MPI_MAC'])) {
            $mac = $sanitized['MPI_MAC'];
            $sanitized['MPI_MAC'] = substr($mac, 0, 10) . '...' . substr($mac, -10);
        }

        return $sanitized;
    }

    /**
     * Sanitize callback data
     */
    protected function sanitizeCallbackData($callbackData)
    {
        $sanitized = $callbackData;
        
        // Mask CAVV values
        if (isset($sanitized['MPI_CAVV'])) {
            $cavv = $sanitized['MPI_CAVV'];
            $sanitized['MPI_CAVV'] = substr($cavv, 0, 10) . '...' . substr($cavv, -10);
        }

        if (isset($sanitized['MPI_MPI_CAVV'])) {
            $cavv = $sanitized['MPI_MPI_CAVV'];
            $sanitized['MPI_MPI_CAVV'] = substr($cavv, 0, 10) . '...' . substr($cavv, -10);
        }

        // Mask MAC
        if (isset($sanitized['MPI_MAC'])) {
            $mac = $sanitized['MPI_MAC'];
            $sanitized['MPI_MAC'] = substr($mac, 0, 10) . '...' . substr($mac, -10);
        }

        return $sanitized;
    }

    /**
     * Get debug log content
     */
    public function getDebugLog($lines = 100)
    {
        if (!File::exists($this->debugLogPath)) {
            return "Debug log file not found.";
        }

        $content = File::get($this->debugLogPath);
        $logLines = explode("\n", $content);
        $logLines = array_filter($logLines); // Remove empty lines
        
        return array_slice($logLines, -$lines);
    }

    /**
     * Get transaction log content
     */
    public function getTransactionLog($lines = 100)
    {
        if (!File::exists($this->transactionLogPath)) {
            return "Transaction log file not found.";
        }

        $content = File::get($this->transactionLogPath);
        $logLines = explode("\n", $content);
        $logLines = array_filter($logLines); // Remove empty lines
        
        return array_slice($logLines, -$lines);
    }

    /**
     * Clear debug logs
     */
    public function clearLogs()
    {
        if (File::exists($this->debugLogPath)) {
            File::put($this->debugLogPath, '');
        }
        if (File::exists($this->transactionLogPath)) {
            File::put($this->transactionLogPath, '');
        }
    }

    /**
     * Get log file sizes
     */
    public function getLogStats()
    {
        $debugSize = File::exists($this->debugLogPath) ? File::size($this->debugLogPath) : 0;
        $transactionSize = File::exists($this->transactionLogPath) ? File::size($this->transactionLogPath) : 0;

        return [
            'debug_log_size' => $debugSize,
            'transaction_log_size' => $transactionSize,
            'debug_log_path' => $this->debugLogPath,
            'transaction_log_path' => $this->transactionLogPath,
        ];
    }
} 