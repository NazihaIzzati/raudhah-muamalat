<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Services\CardzoneService; // Your custom service
use App\Models\Transaction; // Import your Transaction model
use App\Models\CardzoneKey; // Import your CardzoneKey model
use App\Models\Donation; // Import your Donation model

class PaymentController extends Controller
{
    protected $cardzoneService;

    public function __construct(CardzoneService $cardzoneService)
    {
        $this->cardzoneService = $cardzoneService;
    }

    /**
     * Test endpoint to check Cardzone API connectivity
     */
    public function testCardzoneConnection()
    {
        try {
            // Generate a proper test key pair
            $config = [
                "digest_alg" => "sha256",
                "private_key_bits" => 2048,
                "private_key_type" => OPENSSL_KEYTYPE_RSA,
            ];
            
            $res = openssl_pkey_new($config);
            openssl_pkey_export($res, $privateKey);
            $publicKeyDetails = openssl_pkey_get_details($res);
            $publicKey = $publicKeyDetails["key"];
            
            // Convert to Base64Url format as expected by Cardzone
            $key = str_replace(['-----BEGIN PUBLIC KEY-----', '-----END PUBLIC KEY-----', "\n"], '', $publicKey);
            $pubKeyBase64Url = rtrim(strtr(base64_encode($key), '+/', '-_'), '=');
            
            // Test with a proper POST request
            $testPayload = [
                'merchantId' => env('CARDZONE_MERCHANT_ID'),
                'purchaseId' => 'TEST' . now()->format('YmdHis'),
                'pubKey' => $pubKeyBase64Url,
                'version' => '2.9'
            ];
            
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->post(env('CARDZONE_UAT_KEY_EXCHANGE_URL'), $testPayload);
            
            return response()->json([
                'success' => true,
                'status' => $response->status(),
                'body' => $response->body(),
                'url' => env('CARDZONE_UAT_KEY_EXCHANGE_URL'),
                'method' => 'POST',
                'payload' => $testPayload,
                'pubKeyLength' => strlen($pubKeyBase64Url)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'url' => env('CARDZONE_UAT_KEY_EXCHANGE_URL')
            ], 500);
        }
    }

    /**
     * Displays the payment wizard page and handles Cardzone redirect.
     */
    public function showPaymentPage(Request $request)
    {
        // Check if this is a donation payment from session
        $donationData = null;
        if (session()->has('donation_id')) {
            $donationData = [
                'donation_id' => session('donation_id'),
                'amount' => session('amount'),
                'campaign_id' => session('campaign_id'),
                'donor_name' => session('donor_name'),
                'donor_email' => session('donor_email'),
                'donor_phone' => session('donor_phone'),
                'message' => session('message'),
                'is_anonymous' => session('is_anonymous'),
                'payment_method' => session('payment_method'),
                'card_number' => session('card_number'),
                'card_expiry' => session('card_expiry'),
                'card_cvv' => session('card_cvv'),
                'card_holder_name' => session('card_holder_name'),
                'obw_bank' => session('obw_bank'),
            ];
            
            // If we have donation data, initiate payment and redirect to Cardzone
            if ($donationData['donation_id']) {
                return $this->initiateDonationPayment($donationData);
            }
        }
        
        // If no donation data, show regular payment page
        $banks = $this->cardzoneService->getBankList();
        
        // If bank list API fails, use empty array instead of redirecting
        if ($banks === false) {
            Log::warning('Bank list API failed during payment page load, using empty bank list');
            $banks = [];
        }
        
        return view('payment', [
            'banks' => $banks,
            'donationData' => $donationData
        ]);
    }
    
    /**
     * Initiates donation payment and redirects to Cardzone
     */
    private function initiateDonationPayment($donationData)
    {
        // Prepare payment data
        $paymentData = [
            'payment_method' => $donationData['payment_method'],
            'merchant_id' => env('CARDZONE_MERCHANT_ID'),
            'purchase_amount' => $donationData['amount'] * 100, // Convert to minor units
            'purchase_currency' => '458', // MYR
            'donation_id' => $donationData['donation_id'],
            'campaign_id' => $donationData['campaign_id'],
            'amount' => $donationData['amount'],
            'donor_name' => $donationData['donor_name'],
            'donor_email' => $donationData['donor_email'],
            'donor_phone' => $donationData['donor_phone'],
            'message' => $donationData['message'],
            'is_anonymous' => $donationData['is_anonymous'],
        ];
        
        // Add payment method specific data
        if ($donationData['payment_method'] === 'card') {
            $paymentData['card_number'] = $donationData['card_number'];
            $paymentData['card_expiry'] = $donationData['card_expiry'];
            $paymentData['card_cvv'] = $donationData['card_cvv'];
            $paymentData['card_holder_name'] = $donationData['card_holder_name'];
        } elseif ($donationData['payment_method'] === 'obw') {
            $paymentData['obw_bank'] = $donationData['obw_bank'];
        }
        
        // Call initiatePayment to get the form data
        $paymentResponse = $this->initiatePayment(new \Illuminate\Http\Request($paymentData));
        $result = json_decode($paymentResponse->getContent(), true);
        
        if (isset($result['success']) && $result['success'] && isset($result['form'])) {
            // Clear session data
            session()->forget([
                'donation_id', 'amount', 'campaign_id', 'donor_name', 'donor_email', 
                'donor_phone', 'message', 'is_anonymous', 'payment_method',
                'card_number', 'card_expiry', 'card_cvv', 'card_holder_name', 'obw_bank'
            ]);
            
            // Return the payment form view that will redirect to Cardzone
            return view('payment_redirect', [
                'form' => $result['form'],
                'donationData' => $donationData
            ]);
        } else {
            // Payment initiation failed
            $errorMsg = $result['message'] ?? 'Payment initiation failed.';
            return redirect()->route('payment.failure', [
                'donation_id' => $donationData['donation_id'], 
                'message' => $errorMsg
            ]);
        }
    }

    /**
     * Handles the initial payment request from the frontend.
     * This endpoint will perform the Key Exchange and prepare data for the frontend.
     */
    public function initiatePayment(Request $request)
    {
        $paymentMethod = $request->input('payment_method');
        $merchantId = env('CARDZONE_MERCHANT_ID');
        $purchaseAmount = $request->input('purchase_amount');
        $purchaseCurrency = $request->input('purchase_currency');
        $donationId = $request->input('donation_id');

        $donation = null;
        if ($donationId) {
            $donation = \App\Models\Donation::find($donationId);
        }

        $transactionId = $this->cardzoneService->generateTransactionId($donationId);
        Log::info('Payment transaction initiated', [
            'transactionId' => $transactionId,
            'paymentMethod' => $paymentMethod,
            'amount' => $purchaseAmount / 100,
            'currency' => $purchaseCurrency,
            'donationId' => $donationId
        ]);

        $transaction = Transaction::create([
            'transaction_id' => $transactionId,
            'merchant_id' => $merchantId,
            'amount' => $purchaseAmount / 100,
            'currency' => $purchaseCurrency,
            'payment_method' => $paymentMethod,
            'status' => 'pending',
            'card_number_masked' => $paymentMethod === 'card' ? \Illuminate\Support\Str::mask($request->input('card_number'), '*', 6, 4) : null,
            'card_expiry' => $paymentMethod === 'card' ? $request->input('card_expiry') : null,
            'card_holder_name' => $paymentMethod === 'card' ? $request->input('card_holder_name') : null,
            'obw_bank_code' => $paymentMethod === 'obw' ? $request->input('obw_bank') : null,
            'donation_id' => $donationId,
        ]);

        // --- Perform Key Exchange (MPIKeyReq) ---
        Log::info('Starting Key Exchange with Cardzone', [
            'transactionId' => $transactionId,
            'merchantId' => $merchantId,
            'keyExchangeUrl' => env('CARDZONE_UAT_KEY_EXCHANGE_URL')
        ]);
        $keyExchangeResult = $this->cardzoneService->performKeyExchange($transactionId);
        Log::info('Key Exchange Result', [
            'transactionId' => $transactionId,
            'success' => $keyExchangeResult['success'] ?? false,
            'error' => $keyExchangeResult['error'] ?? null,
            'errorCode' => $keyExchangeResult['errorCode'] ?? null
        ]);

        $cardzonePublicKey = null;
        $merchantPrivateKey = null;
        if ($keyExchangeResult['success'] && isset($keyExchangeResult['cardzonePublicKey'])) {
            $this->cardzoneService->saveCardzonePublicKeyPem($keyExchangeResult['cardzonePublicKey']);
            $cardzonePublicKey = file_get_contents(base_path('ssh-keygen/cardzone_public.pem'));
            $merchantPrivateKey = $this->cardzoneService->getMerchantPrivateKey();
        } else {
            Log::error('Key exchange failed, cannot proceed with card payment.', [
                'transactionId' => $transactionId,
                'error' => $keyExchangeResult['error'] ?? 'Unknown error',
                'errorCode' => $keyExchangeResult['errorCode'] ?? null
            ]);
            $transaction->update(['status' => 'failed_key_exchange']);
            return response()->json(['success' => false, 'message' => 'Key exchange failed.'], 500);
        }

        // Prepare MPIReq data strictly following Cardzone spec
        $cardNumber = $request->input('card_number');
        $cardExpiry = $request->input('card_expiry');
        $cardCVV = $request->input('card_cvv');
        $cardHolderName = $request->input('card_holder_name');
        $now = now()->format('YmdHis');
        // Use purchaseAmount directly as it is already in minor units
        $amountMinor = $purchaseAmount;
        $exp = preg_replace('/\D/', '', $cardExpiry);
        if (strlen($exp) === 4) {
            $exp = substr($exp, 2, 2) . substr($exp, 0, 2); // YYMM
        } elseif (strlen($exp) === 6) {
            $exp = substr($exp, 4, 2) . substr($exp, 2, 2); // YYMM
        }
        $encryptedPan = $this->cardzoneService->encryptData($cardNumber, $cardzonePublicKey);
        $encryptedCvv = $this->cardzoneService->encryptData($cardCVV, $cardzonePublicKey);
        $encryptedExp = $this->cardzoneService->encryptData($exp, $cardzonePublicKey);

        // --- Dynamic MPI_TRANS_TYPE support ---
        $allowedTransTypes = ['INQ', 'SALES', 'VSALES', 'REFUND'];
        $mpiTransType = strtoupper($request->input('mpi_trans_type', 'SALES'));
        if (!in_array($mpiTransType, $allowedTransTypes)) {
            $mpiTransType = 'SALES';
        }

        $mpiReq = [
            'MPI_TRANS_TYPE' => $mpiTransType,
            'MPI_MERC_ID' => $merchantId,
            'MPI_PAN' => $encryptedPan,
            'MPI_PAN_EXP' => $encryptedExp,
            'MPI_CVV2' => $encryptedCvv,
            'MPI_CARD_HOLDER_NAME' => $cardHolderName,
            'MPI_PURCH_AMT' => $amountMinor,
            'MPI_PURCH_CURR' => $purchaseCurrency,
            'MPI_TRXN_ID' => $transactionId,
            'MPI_PURCH_DATE' => $now,
        ];
        // Only add optional/conditional fields if present
        if ($request->filled('MPI_ADDR_MATCH')) $mpiReq['MPI_ADDR_MATCH'] = $request->input('MPI_ADDR_MATCH');
        if ($request->filled('MPI_BILL_ADDR_CITY')) $mpiReq['MPI_BILL_ADDR_CITY'] = $request->input('MPI_BILL_ADDR_CITY');
        if ($request->filled('MPI_BILL_ADDR_STATE')) $mpiReq['MPI_BILL_ADDR_STATE'] = $request->input('MPI_BILL_ADDR_STATE');
        if ($request->filled('MPI_BILL_ADDR_CNTRY')) $mpiReq['MPI_BILL_ADDR_CNTRY'] = $request->input('MPI_BILL_ADDR_CNTRY');
        if ($request->filled('MPI_BILL_ADDR_POSTCODE')) $mpiReq['MPI_BILL_ADDR_POSTCODE'] = $request->input('MPI_BILL_ADDR_POSTCODE');
        if ($request->filled('MPI_BILL_ADDR_LINE1')) $mpiReq['MPI_BILL_ADDR_LINE1'] = $request->input('MPI_BILL_ADDR_LINE1');
        if ($request->filled('MPI_BILL_ADDR_LINE2')) $mpiReq['MPI_BILL_ADDR_LINE2'] = $request->input('MPI_BILL_ADDR_LINE2');
        if ($request->filled('MPI_BILL_ADDR_LINE3')) $mpiReq['MPI_BILL_ADDR_LINE3'] = $request->input('MPI_BILL_ADDR_LINE3');
        if ($request->filled('MPI_SHIP_ADDR_CITY')) $mpiReq['MPI_SHIP_ADDR_CITY'] = $request->input('MPI_SHIP_ADDR_CITY');
        if ($request->filled('MPI_SHIP_ADDR_STATE')) $mpiReq['MPI_SHIP_ADDR_STATE'] = $request->input('MPI_SHIP_ADDR_STATE');
        if ($request->filled('MPI_SHIP_ADDR_CNTRY')) $mpiReq['MPI_SHIP_ADDR_CNTRY'] = $request->input('MPI_SHIP_ADDR_CNTRY');
        if ($request->filled('MPI_SHIP_ADDR_POSTCODE')) $mpiReq['MPI_SHIP_ADDR_POSTCODE'] = $request->input('MPI_SHIP_ADDR_POSTCODE');
        if ($request->filled('MPI_SHIP_ADDR_LINE1')) $mpiReq['MPI_SHIP_ADDR_LINE1'] = $request->input('MPI_SHIP_ADDR_LINE1');
        if ($request->filled('MPI_SHIP_ADDR_LINE2')) $mpiReq['MPI_SHIP_ADDR_LINE2'] = $request->input('MPI_SHIP_ADDR_LINE2');
        if ($request->filled('MPI_SHIP_ADDR_LINE3')) $mpiReq['MPI_SHIP_ADDR_LINE3'] = $request->input('MPI_SHIP_ADDR_LINE3');
        if ($request->filled('MPI_EMAIL')) $mpiReq['MPI_EMAIL'] = $request->input('MPI_EMAIL');
        if ($request->filled('MPI_HOME_PHONE')) $mpiReq['MPI_HOME_PHONE'] = $request->input('MPI_HOME_PHONE');
        if ($request->filled('MPI_HOME_PHONE_CC')) $mpiReq['MPI_HOME_PHONE_CC'] = $request->input('MPI_HOME_PHONE_CC');
        if ($request->filled('MPI_WORK_PHONE')) $mpiReq['MPI_WORK_PHONE'] = $request->input('MPI_WORK_PHONE');
        if ($request->filled('MPI_WORK_PHONE_CC')) $mpiReq['MPI_WORK_PHONE_CC'] = $request->input('MPI_WORK_PHONE_CC');
        if ($request->filled('MPI_MOBILE_PHONE')) $mpiReq['MPI_MOBILE_PHONE'] = $request->input('MPI_MOBILE_PHONE');
        if ($request->filled('MPI_MOBILE_PHONE_CC')) $mpiReq['MPI_MOBILE_PHONE_CC'] = $request->input('MPI_MOBILE_PHONE_CC');
        if ($request->filled('MPI_LINE_ITEM')) $mpiReq['MPI_LINE_ITEM'] = $request->input('MPI_LINE_ITEM');
        if ($request->filled('MPI_RESPONSE_TYPE')) $mpiReq['MPI_RESPONSE_TYPE'] = $request->input('MPI_RESPONSE_TYPE');

        // MAC must be generated using only the fields present in the POST, in the correct order
        $mpiReq['MPI_MAC'] = $this->cardzoneService->generateMacForMPIReq($mpiReq, $merchantPrivateKey);

        // Log the request (both Laravel and debug log)
        $mpireqUrl = env('CARDZONE_UAT_MPIREQ_URL');
        $requestLog = [
            'url' => $mpireqUrl,
            'payload' => $mpiReq,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ];
        Log::info('Cardzone Card Payment Request', $requestLog);
        file_put_contents(storage_path('logs/cardzone_debug.log'), "[" . date('Y-m-d H:i:s') . "] Cardzone Card Payment Request: " . print_r($requestLog, true) . "\n", FILE_APPEND);

        // Submit payment
        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->timeout(30)->post($mpireqUrl, $mpiReq);

        // Log the response (both Laravel and debug log)
        $responseLog = [
            'status' => $response->status(),
            'headers' => $response->headers(),
            'body' => $response->body()
        ];
        Log::info('Cardzone Card Payment Response', $responseLog);
        file_put_contents(storage_path('logs/cardzone_debug.log'), "[" . date('Y-m-d H:i:s') . "] Cardzone Card Payment Response: " . print_r($responseLog, true) . "\n", FILE_APPEND);

        // Update transaction status based on response
        $responseData = $response->json();
        if ($response->status() === 200 && isset($responseData['errorCode']) && $responseData['errorCode'] === '000') {
            $transaction->update(['status' => 'completed', 'cardzone_response_data' => $responseData]);
        } else {
            $transaction->update(['status' => 'failed', 'cardzone_response_data' => $responseData]);
        }

        // Return the API response directly
        return response()->json([
            'success' => true,
            'form' => [
                'fields' => $mpiReq,
                'target' => 'cardzone_iframe'
            ],
            'cardzone_response' => $responseData,
            'status_code' => $response->status()
        ]);
    }

    /**
     * Handles the Cardzone MPIRes callback (webhook).
     * This endpoint receives the POST request from Cardzone after 3DS authentication.
     */
    public function handleCardzoneCallback(Request $request)
    {
        Log::info('Cardzone Callback Received', $request->all());

        $receivedData = $request->all();
        $receivedMac = $receivedData['MPI_MAC'] ?? null;
        $transactionId = $receivedData['MPI_TRXN_ID'] ?? null;

        $transaction = Transaction::where('transaction_id', $transactionId)->first();

        if (!$transaction) {
            Log::error('Transaction not found for callback.', ['transactionId' => $transactionId, 'callbackData' => $receivedData]);
            return response('Error: Transaction not found.', 404);
        }

        // Retrieve Cardzone's public key for this merchant from your persistent storage
        $cardzoneKey = CardzoneKey::where('merchant_id', $transaction->merchant_id)->first();
        $cardzonePublicKey = $cardzoneKey ? $cardzoneKey->cardzone_public_key : null;

        if (!$cardzonePublicKey) {
            Log::error('Cardzone Public Key not found for merchant during callback verification.', ['merchantId' => $transaction->merchant_id]);
            $transaction->update(['status' => 'failed', 'cardzone_response_data' => $receivedData]);
            return response('Error: Public key missing for verification.', 400);
        }

        // --- Verify MAC ---
        $isMacValid = $this->cardzoneService->verifyMacForMPIRes($receivedData, $cardzonePublicKey, $receivedMac);

        if (!$isMacValid) {
            Log::error('Cardzone Callback MAC verification failed.', ['transactionId' => $transactionId, 'receivedMac' => $receivedMac]);
            $transaction->update(['status' => 'failed', 'cardzone_response_data' => $receivedData]);
            return response('Error: MAC verification failed.', 401);
        }

        // --- Process Transaction Status ---
        $transStatus = $receivedData['MPI_TRANS_STATUS'] ?? 'F'; // 'Y' for success, 'N' for failed, 'C' for challenge, 'F' for fraud/error

        $updateData = [
            'cardzone_response_data' => $receivedData,
            'auth_value' => $receivedData['authenticationValue'] ?? null,
            'eci' => $receivedData['eci'] ?? null,
        ];

        if ($transStatus === 'Y' || $transStatus === 'C') {
            // 3DS authentication successful
            Log::info('3DS authentication successful. Proceed to final payment gateway authorization.', ['transactionId' => $transactionId, 'authValue' => $updateData['auth_value'], 'eci' => $updateData['eci']]);

            // --- Send to Primary Payment Gateway for Final Authorization ---
            // This is where you'd integrate with your main payment gateway (e.g., Stripe, PayPal, local acquirer)
            // You MUST include $updateData['auth_value'] (CAVV/AAV) and $updateData['eci'] in this final authorization request.
            // Example (pseudo-code):
            /*
            try {
                $paymentGatewayResponse = $this->paymentGateway->authorize([
                    'amount' => $transaction->amount,
                    'currency' => $transaction->currency,
                    'card_number' => '...', // Retrieve actual card number if needed and securely stored/tokenized
                    'authentication_value' => $updateData['auth_value'],
                    'eci' => $updateData['eci'],
                    'transaction_id' => $transaction->transaction_id,
                    // ... other necessary data
                ]);

                if ($paymentGatewayResponse->isSuccessful()) {
                    $transaction->update(array_merge($updateData, ['status' => 'authorized']));
                    Log::info('Transaction successfully authorized by Payment Gateway.', ['transactionId' => $transactionId]);
                    return redirect()->route('payment.success', ['transaction_id' => $transactionId]);
                } else {
                    $transaction->update(array_merge($updateData, ['status' => 'failed_authorization']));
                    Log::warning('Payment Gateway authorization failed.', ['transactionId' => $transactionId, 'gatewayResponse' => $paymentGatewayResponse->message()]);
                    return redirect()->route('payment.failure', ['transaction_id' => $transactionId, 'message' => $paymentGatewayResponse->message()]);
                }
            } catch (\Exception $e) {
                $transaction->update(array_merge($updateData, ['status' => 'failed_authorization_error']));
                Log::error('Error during final payment gateway authorization.', ['transactionId' => $transactionId, 'error' => $e->getMessage()]);
                return redirect()->route('payment.failure', ['transaction_id' => $transactionId, 'message' => 'Authorization error.']);
            }
            */
            
            // For demo, directly update status and redirect
            $transaction->update(array_merge($updateData, ['status' => 'authenticated']));
            
            // Update donation status if this is a donation payment
            if ($transaction->donation_id) {
                $this->updateDonationStatus($transaction->donation_id, 'completed', $transaction->transaction_id);
            }
            
            return redirect()->route('payment.success', ['transaction_id' => $transactionId]);

        } else {
            // 3DS authentication failed or declined
            Log::warning('3DS authentication failed or declined.', ['transactionId' => $transactionId, 'status' => $transStatus, 'errorDesc' => $receivedData['errorDesc'] ?? '']);
            $transaction->update(array_merge($updateData, ['status' => 'failed']));
            
            // Update donation status if this is a donation payment
            if ($transaction->donation_id) {
                $this->updateDonationStatus($transaction->donation_id, 'failed');
            }
            
            return redirect()->route('payment.failure', ['transaction_id' => $transactionId, 'message' => $receivedData['errorDesc'] ?? 'Payment failed.']);
        }
    }

    public function paymentSuccess(Request $request)
    {
        $transaction = Transaction::where('transaction_id', $request->query('transaction_id'))->first();
        return view('payment_status', ['status' => 'success', 'transaction' => $transaction]);
    }

    public function paymentFailure(Request $request)
    {
        $transaction = Transaction::where('transaction_id', $request->query('transaction_id'))->first();
        return view('payment_status', ['status' => 'failure', 'transaction' => $transaction, 'message' => $request->query('message')]);
    }

    /**
     * Update donation status after payment processing
     */
    private function updateDonationStatus($donationId, $status, $transactionId = null)
    {
        try {
            $donation = \App\Models\Donation::find($donationId);
            if ($donation) {
                $donation->payment_status = $status;
                if ($transactionId) {
                    $donation->transaction_id = $transactionId;
                }
                if ($status === 'completed') {
                    $donation->paid_at = now();
                }
                $donation->save();
                
                Log::info('Donation status updated', [
                    'donation_id' => $donationId,
                    'status' => $status,
                    'transaction_id' => $transactionId
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error updating donation status', [
                'donation_id' => $donationId,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * API endpoint to get bank list
     */
    public function getBankList()
    {
        try {
            $banks = $this->cardzoneService->getBankList();
            
            if ($banks === false) {
                Log::warning('Bank list API failed, returning empty list');
                return response()->json([
                    'success' => true,
                    'banks' => [],
                    'message' => 'Bank list temporarily unavailable, but payment can still proceed'
                ]);
            }
            
            return response()->json([
                'success' => true,
                'banks' => $banks
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching bank list', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => true,
                'banks' => [],
                'message' => 'Bank list temporarily unavailable, but payment can still proceed',
                'error' => config('app.debug') ? $e->getMessage() : null
            ]);
        }
    }

    /**
     * API endpoint to process payment (combines donation creation and payment initiation)
     */
    public function processPayment(Request $request)
    {
        try {
            // Validate the request
            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'campaign_id' => 'required|exists:campaigns,id',
                'amount' => 'required|numeric|min:1',
                'donor_name' => 'required|string|max:255',
                'donor_email' => 'required|email|max:255',
                'donor_phone' => 'nullable|string|max:20',
                'message' => 'nullable|string',
                'is_anonymous' => 'boolean',
                'payment_method' => 'required|string|in:card,obw,qr',
                
                // Payment method specific validation
                'card_number' => 'required_if:payment_method,card|string',
                'card_expiry' => 'required_if:payment_method,card|string',
                'card_cvv' => 'required_if:payment_method,card|string',
                'card_holder_name' => 'required_if:payment_method,card|string',
                'obw_bank' => 'required_if:payment_method,obw|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Create donation first
            $donation = new Donation();
            $donation->user_id = auth()->id();
            $donation->campaign_id = $request->campaign_id;
            $donation->donor_name = $request->donor_name;
            $donation->donor_email = $request->donor_email;
            $donation->donor_phone = $request->donor_phone;
            $donation->amount = $request->amount;
            $donation->currency = 'MYR';
            $donation->payment_method = $request->payment_method;
            $donation->payment_status = 'pending';
            $donation->message = $request->message;
            $donation->is_anonymous = $request->is_anonymous;
            $donation->save();

            // Prepare payment data
            $paymentData = [
                'payment_method' => $request->payment_method,
                'merchant_id' => env('CARDZONE_MERCHANT_ID'),
                'purchase_amount' => $request->amount * 100, // Convert to minor units
                'purchase_currency' => '458', // MYR
                'donation_id' => $donation->id,
                'campaign_id' => $request->campaign_id,
                'amount' => $request->amount,
                'donor_name' => $request->donor_name,
                'donor_email' => $request->donor_email,
                'donor_phone' => $request->donor_phone,
                'message' => $request->message,
                'is_anonymous' => $request->is_anonymous,
            ];

            // Add payment method specific data
            if ($request->payment_method === 'card') {
                $paymentData['card_number'] = $request->card_number;
                $paymentData['card_expiry'] = $request->card_expiry;
                $paymentData['card_cvv'] = $request->card_cvv;
                $paymentData['card_holder_name'] = $request->card_holder_name;
            } elseif ($request->payment_method === 'obw') {
                $paymentData['obw_bank'] = $request->obw_bank;
            }

            // Process payment through Cardzone and return API response directly
            $result = $this->initiatePayment(new Request($paymentData));

            // Return the API response directly - no redirect to payment page
            return $result;

        } catch (\Exception $e) {
            Log::error('Payment processing error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Payment processing failed. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
} 