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
     * Test payment with debug logging
     */
    public function testPayment(Request $request)
    {
        $paymentMethod = $request->get('payment_method', 'card');
        $amount = $request->get('amount', '1000');
        $currency = $request->get('currency', 'MYR');
        
        // Generate transaction ID
        $transactionId = $this->cardzoneService->generateTransactionId();
        
        // Log payment initiation
        $this->debugService->logTransaction($transactionId, 'PAYMENT_TEST_STARTED', [
            'payment_method' => $paymentMethod,
            'amount' => $amount,
            'currency' => $currency
        ], 'INFO');

        try {
            switch ($paymentMethod) {
                case 'card':
                    return $this->testCardPayment($request, $transactionId, $amount, $currency);
                case 'obw':
                    return $this->testOBWPayment($request, $transactionId, $amount, $currency);
                case 'qr':
                    return $this->testQRPayment($request, $transactionId, $amount, $currency);
                default:
                    throw new Exception('Invalid payment method: ' . $paymentMethod);
            }
        } catch (Exception $e) {
            $this->debugService->logError($transactionId, 'Payment test failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Payment test failed: ' . $e->getMessage(),
                'transaction_id' => $transactionId
            ], 500);
        }
    }

    /**
     * Test card payment
     */
    private function testCardPayment(Request $request, $transactionId, $amount, $currency)
    {
        $cardDetails = [
            'card_number' => $request->get('card_number', '5195982168861592'),
            'card_expiry' => $request->get('card_expiry', '03/28'),
            'card_cvv' => $request->get('card_cvv', '133'),
            'card_holder_name' => $request->get('card_holder_name', 'Test Cardholder'),
        ];

        try {
            // 1. Perform Key Exchange and get latest Cardzone public key
            $keyExchange = $this->cardzoneService->performKeyExchange($transactionId);
            if (!$keyExchange['success']) {
                throw new \Exception('Key exchange failed: ' . ($keyExchange['error'] ?? 'Unknown error'));
            }
            $cardzonePublicKey = file_exists(base_path('ssh-keygen/cardzone_public.pem'))
                ? file_get_contents(base_path('ssh-keygen/cardzone_public.pem'))
                : null;
            if (!$cardzonePublicKey) {
                throw new \Exception('Cardzone public key PEM not found after key exchange.');
            }

            // 2. Record payment initiation in database
            $transactionData = [
                'transaction_id' => $transactionId,
                'merchant_id' => env('CARDZONE_MERCHANT_ID'),
                'amount' => $amount / 100, // Convert from cents to decimal
                'currency' => $currency,
                'payment_method' => 'card',
                'card_number' => $cardDetails['card_number'],
                'card_expiry' => $cardDetails['card_expiry'],
                'card_holder_name' => $cardDetails['card_holder_name'],
            ];
            $transaction = $this->paymentTransactionService->recordPaymentInitiation($transactionData);

            // 3. Encrypt sensitive fields
            $encryptedPan = $this->cardzoneService->encryptData($cardDetails['card_number'], $cardzonePublicKey);
            $encryptedCvv = $this->cardzoneService->encryptData($cardDetails['card_cvv'], $cardzonePublicKey);
            // Format expiry as YYMM
            $exp = preg_replace('/\D/', '', $cardDetails['card_expiry']);
            if (strlen($exp) === 4) {
                $exp = substr($exp, 2, 2) . substr($exp, 0, 2); // YYMM
            } elseif (strlen($exp) === 6) {
                $exp = substr($exp, 4, 2) . substr($exp, 2, 2); // YYMM
            }
            $encryptedExp = $this->cardzoneService->encryptData($exp, $cardzonePublicKey);

            // 4. Prepare MPI Request Data
            $mpiReqData = [
                'MPI_TRANS_TYPE' => 'SALES',
                'MPI_MERC_ID' => env('CARDZONE_MERCHANT_ID'),
                'MPI_PAN' => $encryptedPan,
                'MPI_PAN_EXP' => $encryptedExp,
                'MPI_CVV2' => $encryptedCvv,
                'MPI_CARD_HOLDER_NAME' => $cardDetails['card_holder_name'],
                'MPI_PURCH_AMT' => $amount,
                'MPI_PURCH_CURR' => $currency,
                'MPI_TRXN_ID' => $transactionId,
                'MPI_PURCH_DATE' => now()->format('YmdHis'),
                'MPI_EMAIL' => 'test@example.com',
                'MPI_MOBILE_PHONE_CC' => '60',
                'MPI_MOBILE_PHONE' => '123456789',
            ];

            // 5. Generate MAC
            $privateKey = $this->cardzoneService->getMerchantPrivateKey();
            $mac = $this->cardzoneService->generateMacForMPIReq($mpiReqData, $privateKey);
            $mpiReqData['MPI_MAC'] = $mac;

            // 6. Log the request (same format as sample log)
            $mpireqUrl = env('CARDZONE_UAT_MPIREQ_URL');
            $requestLog = [
                'url' => $mpireqUrl,
                'payload' => $mpiReqData,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ]
            ];
            \Log::info('Cardzone Card Payment Request', $requestLog);
            file_put_contents(storage_path('logs/cardzone_debug.log'), "[" . date('Y-m-d H:i:s') . "] Cardzone Card Payment Request: " . print_r($requestLog, true) . "\n", FILE_APPEND);

            // 7. Submit payment
            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30)->post($mpireqUrl, $mpiReqData);

            // 8. Log the response (same format as sample log)
            $responseLog = [
                'status' => $response->status(),
                'headers' => $response->headers(),
                'body' => $response->body()
            ];
            \Log::info('Cardzone Card Payment Response', $responseLog);
            file_put_contents(storage_path('logs/cardzone_debug.log'), "[" . date('Y-m-d H:i:s') . "] Cardzone Card Payment Response: " . print_r($responseLog, true) . "\n", FILE_APPEND);

            // 9. Record payment submission in database
            $this->paymentTransactionService->recordPaymentSubmission($transactionId, $mpiReqData, $responseLog);

            $success = $response->status() === 200;
            $message = $success ? 'Payment form submitted successfully' : 'Payment submission failed';

            return response()->json([
                'success' => $success,
                'message' => $message,
                'transaction_id' => $transactionId,
                'response_status' => $response->status(),
                'response_length' => strlen($response->body()),
                'has_form' => strpos($response->body(), '<form') !== false,
                'has_3ds' => strpos($response->body(), '3D Secure') !== false,
                'db_transaction_id' => $transaction->id,
            ]);

        } catch (\Exception $e) {
            // Record error in database
            $this->paymentTransactionService->recordPaymentError($transactionId, 'Payment submission exception', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Exception: ' . $e->getMessage(),
                'transaction_id' => $transactionId,
            ]);
        }
    }

    /**
     * Test OBW payment
     */
    private function testOBWPayment(Request $request, $transactionId, $amount, $currency)
    {
        $bankCode = $request->get('bank_code', 'MBBEMYKL'); // Maybank

        try {
            // Record payment initiation in database
            $transactionData = [
                'transaction_id' => $transactionId,
                'merchant_id' => env('CARDZONE_MERCHANT_ID'),
                'amount' => $amount / 100, // Convert from cents to decimal
                'currency' => $currency,
                'payment_method' => 'obw',
                'obw_bank_code' => $bankCode,
            ];

            $transaction = $this->paymentTransactionService->recordPaymentInitiation($transactionData);

            // Prepare OBW Request Data
            $obwReqData = [
                'MPI_MERC_ID' => env('CARDZONE_MERCHANT_ID'),
                'MPI_PURCH_AMT' => $amount,
                'MPI_PURCH_CURR' => $currency,
                'MPI_TRXN_ID' => $transactionId,
                'MPI_PURCH_DATE' => now()->format('YmdHis'),
                'MPI_EMAIL' => 'test@example.com',
                'MPI_MOBILE_PHONE_CC' => '60',
                'MPI_MOBILE_PHONE' => '123456789',
                'MPI_TRANS_TYPE' => 'SALES',
                'MPI_BANK_CODE' => $bankCode,
            ];

            // Generate MAC
            $privateKey = $this->cardzoneService->getMerchantPrivateKey();
            $mac = $this->cardzoneService->generateMacForMPIReqOBW($obwReqData, $privateKey);
            $obwReqData['MPI_MAC'] = $mac;

            // Submit OBW payment
            $response = Http::asForm()->timeout(30)->post(env('CARDZONE_UAT_OBW_URL'), $obwReqData);
            
            $responseData = [
                'status' => $response->status(),
                'body' => $response->body(),
                'content_type' => $response->header('Content-Type'),
            ];

            // Record payment submission in database
            $this->paymentTransactionService->recordPaymentSubmission($transactionId, $obwReqData, $responseData);

            $success = $response->status() === 200;
            $message = $success ? 'OBW payment form submitted successfully' : 'OBW payment submission failed';

            return response()->json([
                'success' => $success,
                'message' => $message,
                'transaction_id' => $transactionId,
                'response_status' => $response->status(),
                'response_length' => strlen($response->body()),
                'has_form' => strpos($response->body(), '<form') !== false,
                'payment_method' => 'obw',
                'bank_code' => $bankCode,
                'db_transaction_id' => $transaction->id,
            ]);

        } catch (Exception $e) {
            // Record error in database
            $this->paymentTransactionService->recordPaymentError($transactionId, 'OBW payment submission exception', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Exception: ' . $e->getMessage(),
                'transaction_id' => $transactionId,
            ]);
        }
    }

    /**
     * Test QR payment
     */
    private function testQRPayment(Request $request, $transactionId, $amount, $currency)
    {
        try {
            // Record payment initiation in database
            $transactionData = [
                'transaction_id' => $transactionId,
                'merchant_id' => env('CARDZONE_MERCHANT_ID'),
                'amount' => $amount / 100, // Convert from cents to decimal
                'currency' => $currency,
                'payment_method' => 'qr',
            ];

            $transaction = $this->paymentTransactionService->recordPaymentInitiation($transactionData);

            // Prepare QR Request Data
            $qrReqData = [
                'MPI_MERC_ID' => env('CARDZONE_MERCHANT_ID'),
                'MPI_PURCH_AMT' => $amount,
                'MPI_PURCH_CURR' => $currency,
                'MPI_TRXN_ID' => $transactionId,
                'MPI_PURCH_DATE' => now()->format('YmdHis'),
                'MPI_EMAIL' => 'test@example.com',
                'MPI_MOBILE_PHONE_CC' => '60',
                'MPI_MOBILE_PHONE' => '123456789',
                'MPI_TRANS_TYPE' => 'SALES',
            ];

            // Generate MAC
            $privateKey = $this->cardzoneService->getMerchantPrivateKey();
            $mac = $this->cardzoneService->generateMacForMPIReqQr($qrReqData, $privateKey);
            $qrReqData['MPI_MAC'] = $mac;

            // Submit QR payment
            $response = Http::asForm()->timeout(30)->post(env('CARDZONE_UAT_QR_URL'), $qrReqData);
            
            $responseData = [
                'status' => $response->status(),
                'body' => $response->body(),
                'content_type' => $response->header('Content-Type'),
            ];

            // Record payment submission in database
            $this->paymentTransactionService->recordPaymentSubmission($transactionId, $qrReqData, $responseData);

            $success = $response->status() === 200;
            $message = $success ? 'QR payment form submitted successfully' : 'QR payment submission failed';

            return response()->json([
                'success' => $success,
                'message' => $message,
                'transaction_id' => $transactionId,
                'response_status' => $response->status(),
                'response_length' => strlen($response->body()),
                'has_form' => strpos($response->body(), '<form') !== false,
                'has_qr' => strpos($response->body(), 'qr') !== false || strpos($response->body(), 'QR') !== false,
                'payment_method' => 'qr',
                'db_transaction_id' => $transaction->id,
            ]);

        } catch (Exception $e) {
            // Record error in database
            $this->paymentTransactionService->recordPaymentError($transactionId, 'QR payment submission exception', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Exception: ' . $e->getMessage(),
                'transaction_id' => $transactionId,
            ]);
        }
    }

    /**
     * Test key exchange with debug logging
     */
    public function testKeyExchange()
    {
        $transactionId = $this->cardzoneService->generateTransactionId();
        
        // Get request details before performing key exchange
        $privateKey = $this->cardzoneService->getMerchantPrivateKey();
        $publicKey = $this->cardzoneService->getMerchantPublicKey();
        $merchantPublicKeyBase64Url = $this->cardzoneService->convertPublicKeyToBase64Url($publicKey);
        
        $requestPayload = [
            'merchantId' => env('CARDZONE_MERCHANT_ID'),
            'purchaseId' => $transactionId,
            'pubKey' => $merchantPublicKeyBase64Url,
        ];
        
        $requestDetails = [
            'url' => env('CARDZONE_UAT_KEY_EXCHANGE_URL'),
            'method' => 'POST',
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],
            'payload' => [
                'merchantId' => $requestPayload['merchantId'],
                'purchaseId' => $requestPayload['purchaseId'],
                'pubKey_length' => strlen($requestPayload['pubKey']),
                'pubKey_preview' => substr($requestPayload['pubKey'], 0, 50) . '...'
            ],
            'timeout' => 30
        ];
        
        // Perform key exchange
        $result = $this->cardzoneService->performKeyExchange($transactionId);
        
        // Get response details from the latest logs
        $responseDetails = null;
        $logs = $this->debugService->getTransactionLog(50);
        foreach (array_reverse($logs) as $log) {
            if (strpos($log, 'KEY_EXCHANGE_RESPONSE') !== false && strpos($log, $transactionId) !== false) {
                // Extract response details from log
                $jsonStart = strpos($log, '{');
                if ($jsonStart !== false) {
                    $jsonPart = substr($log, $jsonStart);
                    $logData = json_decode($jsonPart, true);
                    if ($logData && isset($logData['data'])) {
                        $responseDetails = [
                            'status_code' => $logData['data']['status_code'] ?? 'N/A',
                            'content_type' => $logData['data']['content_type'] ?? 'N/A',
                            'response_headers' => $logData['data']['response_headers'] ?? [],
                            'response_body' => $logData['data']['response_body'] ?? 'N/A',
                            'response_length' => $logData['data']['response_length'] ?? 'N/A',
                            'response_time' => $logData['data']['response_time'] ?? 'N/A'
                        ];
                    }
                }
                break;
            }
        }
        
        // If response details not found in logs, create from the result
        if (!$responseDetails && isset($result['errorCode'])) {
            $responseDetails = [
                'status_code' => 200, // Cardzone returns 200 even with error codes
                'content_type' => 'application/json;charset=utf-8',
                'response_headers' => [],
                'response_body' => [
                    'merchantId' => env('CARDZONE_MERCHANT_ID'),
                    'purchaseId' => $transactionId,
                    'errorCode' => $result['errorCode'],
                    'errorDescription' => $result['error'] ?? 'Unknown error'
                ],
                'response_length' => 'N/A',
                'response_time' => 'N/A'
            ];
        }
        
        return response()->json([
            'success' => $result['success'],
            'message' => $result['success'] ? 'Key exchange successful' : ($result['error'] ?? 'Key exchange failed'),
            'transaction_id' => $transactionId,
            'error' => $result['error'] ?? null,
            'error_code' => $result['errorCode'] ?? null,
            'request_details' => $requestDetails,
            'response_details' => $responseDetails,
        ]);
    }

    /**
     * Test environment configuration
     */
    public function testEnvironment()
    {
        try {
            $this->debugService->logTransaction('TEST', 'ENVIRONMENT_TEST_STARTED', [], 'INFO');
            
            $environment = [
                'merchant_id' => env('CARDZONE_MERCHANT_ID'),
                'uat_key_exchange_url' => env('CARDZONE_UAT_KEY_EXCHANGE_URL'),
                'uat_mpireq_url' => env('CARDZONE_UAT_MPIREQ_URL'),
                'uat_obw_url' => env('CARDZONE_UAT_OBW_URL'),
                'uat_qr_url' => env('CARDZONE_UAT_QR_URL'),
                'response_url' => env('CARDZONE_RESPONSE_URL'),
                'private_key_exists' => file_exists(base_path('ssh-keygen/jariahfund-dev')),
                'public_key_exists' => file_exists(base_path('ssh-keygen/jariahfund-dev_public.pem')),
                'app_env' => config('app.env'),
                'debug_enabled' => config('app.debug'),
            ];
            
            // Test connectivity to Cardzone endpoints
            $connectivity = [];
            $endpoints = [
                'Key Exchange' => env('CARDZONE_UAT_KEY_EXCHANGE_URL'),
                'Card Payment' => env('CARDZONE_UAT_MPIREQ_URL'),
                'OBW Payment' => env('CARDZONE_UAT_OBW_URL'),
                'QR Payment' => env('CARDZONE_UAT_QR_URL'),
            ];
            
            foreach ($endpoints as $name => $url) {
                try {
                    $response = Http::timeout(10)->get($url);
                    $connectivity[$name] = [
                        'status' => $response->status(),
                        'reachable' => $response->status() < 500
                    ];
                } catch (Exception $e) {
                    $connectivity[$name] = [
                        'status' => 'error',
                        'reachable' => false,
                        'error' => $e->getMessage()
                    ];
                }
            }
            
            $this->debugService->logSuccess('TEST', 'ENVIRONMENT_TEST_COMPLETED', [
                'environment' => $environment,
                'connectivity' => $connectivity
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Environment test completed successfully',
                'data' => [
                    'environment' => $environment,
                    'connectivity' => $connectivity
                ]
            ]);
        } catch (Exception $e) {
            $this->debugService->logError('TEST', 'Environment test failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Environment test failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Test MAC verification
     */
    public function testMACVerification()
    {
        try {
            $this->debugService->logTransaction('TEST', 'MAC_VERIFICATION_TEST_STARTED', [], 'INFO');
            
            // Test MAC generation
            $testData = [
                'merchantId' => env('CARDZONE_MERCHANT_ID'),
                'transactionId' => '1234567890',
                'amount' => '1000',
                'currency' => 'MYR',
                'paymentMethod' => 'card'
            ];
            
            $macSignature = $this->cardzoneService->generateMacForMPIReq($testData, $this->cardzoneService->getMerchantPrivateKey());
            
            // Test MAC verification
            $testData['MPI_MAC'] = $macSignature;
            $macValid = $this->cardzoneService->verifyMacForMPIRes($testData, $this->cardzoneService->getCardzonePublicKey(), $macSignature);
            
            $this->debugService->logSuccess('TEST', 'MAC_VERIFICATION_TEST_COMPLETED', [
                'test_data' => $testData,
                'mac_signature' => $macSignature,
                'mac_valid' => $macValid
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'MAC verification test completed successfully',
                'data' => [
                    'test_data' => $testData,
                    'mac_signature' => $macSignature,
                    'mac_valid' => $macValid
                ]
            ]);
        } catch (Exception $e) {
            $this->debugService->logError('TEST', 'MAC verification test failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'MAC verification test failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show transaction records
     */
    public function transactions(Request $request)
    {
        $query = \App\Models\Transaction::with('donation')->latest();
        
        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        
        // Filter by payment method
        if ($request->has('payment_method') && $request->payment_method !== 'all') {
            $query->where('payment_method', $request->payment_method);
        }
        
        // Search by transaction ID
        if ($request->has('search')) {
            $query->where('transaction_id', 'like', '%' . $request->search . '%');
        }
        
        $transactions = $query->paginate(20);
        $stats = $this->paymentTransactionService->getTransactionStats();
        
        return view('admin.cardzone.transactions', compact('transactions', 'stats'));
    }

    /**
     * Show individual transaction details
     */
    public function showTransaction(\App\Models\Transaction $transaction)
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