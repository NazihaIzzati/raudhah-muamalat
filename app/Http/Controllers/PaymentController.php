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
        $purchaseAmount = $request->input('purchase_amount'); // Already in minor units (e.g., 15000)
        $purchaseCurrency = $request->input('purchase_currency'); // e.g., 458
        $donationId = $request->input('donation_id'); // Get donation ID if this is a donation

        // Get donation data if available
        $donation = null;
        if ($donationId) {
            $donation = \App\Models\Donation::find($donationId);
        }

        // Generate a unique transaction ID for Cardzone using donation ID if available
        $transactionId = $this->cardzoneService->generateTransactionId($donationId);
        
        Log::info('Payment transaction initiated', [
            'transactionId' => $transactionId,
            'paymentMethod' => $paymentMethod,
            'amount' => $purchaseAmount / 100,
            'currency' => $purchaseCurrency,
            'donationId' => $donationId
        ]);

        // --- Store initial transaction details in database ---
        $transaction = Transaction::create([
            'transaction_id' => $transactionId,
            'merchant_id' => $merchantId,
            'amount' => $purchaseAmount / 100, // Store as major units
            'currency' => $purchaseCurrency,
            'payment_method' => $paymentMethod,
            'status' => 'pending',
            // Store sensitive data masked or encrypted if needed
            'card_number_masked' => $paymentMethod === 'card' ? Str::mask($request->input('card_number'), '*', 6, 4) : null,
            'card_expiry' => $paymentMethod === 'card' ? $request->input('card_expiry') : null,
            'card_holder_name' => $paymentMethod === 'card' ? $request->input('card_holder_name') : null,
            'obw_bank_code' => $paymentMethod === 'obw' ? $request->input('obw_bank') : null,
            // Store donation reference if this is a donation
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

        // Initialize variables
        $cardzonePublicKey = 'DEMO_PUBLIC_KEY';
        $merchantPrivateKey = 'DEMO_PRIVATE_KEY';

        if (!$keyExchangeResult['success']) {
            $errorMessage = $keyExchangeResult['error'] ?? 'Unknown key exchange error';
            $errorCode = $keyExchangeResult['errorCode'] ?? 'N/A';
            
            Log::warning('Payment initiation - Key exchange failed, using demo mode', [
                'transactionId' => $transactionId,
                'error' => $errorMessage,
                'errorCode' => $errorCode,
                'paymentMethod' => $paymentMethod
            ]);
            
            // Update transaction status to indicate demo mode
            $transaction->update([
                'status' => 'demo_mode',
                'cardzone_response_data' => [
                    'error' => $errorMessage,
                    'errorCode' => $errorCode,
                    'demo_mode' => true
                ]
            ]);
        } else {
            $cardzonePublicKey = $keyExchangeResult['cardzonePublicKey'];
            $merchantPrivateKey = $keyExchangeResult['merchantPrivateKey'];
        }

        // Update CardzoneKey model with Cardzone's public key (already done in service, but ensure it's there)
        $this->cardzoneService->updateCardzonePublicKey($cardzonePublicKey);

        // Use donation data if available, otherwise use default values
        $customerEmail = $donation ? $donation->donor_email : 'customer@example.com';
        $customerPhone = $donation ? $donation->donor_phone : '123456789';
        $customerName = $donation ? $donation->donor_name : 'Test Customer';
        $paymentDescription = $donation ? "Donation to " . $donation->campaign->title : 'Payment';

        $mpiReqData = [
            'MPI_MERC_ID' => $merchantId,
            'MPI_PURCH_AMT' => $purchaseAmount,
            'MPI_PURCH_CURR' => $purchaseCurrency,
            'MPI_TRXN_ID' => $transactionId,
            'MPI_PURCH_DATE' => now()->format('YmdHis'),
            'MPI_EMAIL' => $customerEmail,
            'MPI_MOBILE_PHONE_CC' => '60', // Malaysia country code
            'MPI_MOBILE_PHONE' => $customerPhone,
            // ... common fields for all payment types
        ];

        $formFields = [];
        switch ($paymentMethod) {
            case 'card':
                $cardNumber = $request->input('card_number');
                $cardExpiry = $request->input('card_expiry');
                $cardCVV = $request->input('card_cvv');
                $cardHolderName = $request->input('card_holder_name');

                // Encrypt sensitive fields using Cardzone's public key
                $encryptedPan = null;
                $encryptedCvv = null;
                
                if ($transaction->status !== 'demo_mode' && $cardzonePublicKey !== 'DEMO_PUBLIC_KEY') {
                    try {
                        $encryptedPan = $this->cardzoneService->encryptData($cardNumber, $cardzonePublicKey);
                        $encryptedCvv = $this->cardzoneService->encryptData($cardCVV, $cardzonePublicKey);
                    } catch (\Exception $e) {
                        Log::error('Failed to encrypt card data', ['error' => $e->getMessage()]);
                        // Fall back to demo mode if encryption fails
                        $transaction->update(['status' => 'demo_mode']);
                    }
                }

                $mpiReqData['MPI_TRANS_TYPE'] = 'SALES';
                $mpiReqData['MPI_PAN'] = $encryptedPan ?: $cardNumber; // Use encrypted PAN if available
                $mpiReqData['MPI_PAN_EXP'] = $cardExpiry;
                $mpiReqData['MPI_CVV2'] = $encryptedCvv ?: $cardCVV; // Use encrypted CVV if available
                $mpiReqData['MPI_CARD_HOLDER_NAME'] = $cardHolderName;
                $mpiReqData['MPI_ADDR_MATCH'] = 'Y';
                $mpiReqData['MPI_BILL_ADDR_CITY'] = 'KUL';
                $mpiReqData['MPI_BILL_ADDR_POSTCODE'] = '59200';
                $mpiReqData['MPI_BILL_ADDR_LINE1'] = 'ADR LINE 1';
                $mpiReqData['MPI_BILL_ADDR_LINE2'] = 'ADR LINE 2';
                $mpiReqData['MPI_BILL_ADDR_LINE3'] = 'ADR LINE 3';
                $mpiReqData['MPI_SHIP_ADDR_CITY'] = 'KUL';
                $mpiReqData['MPI_SHIP_ADDR_STATE'] = '14';
                $mpiReqData['MPI_SHIP_ADDR_CNTRY'] = '458';
                $formFields['action'] = env('CARDZONE_UAT_MPIREQ_URL');

                if ($transaction->status === 'demo_mode') {
                    $mpiReqData['MPI_MAC'] = 'DEMO_MAC_SIGNATURE';
                } else {
                    $mpiReqData['MPI_MAC'] = $this->cardzoneService->generateMacForMPIReq($mpiReqData, $merchantPrivateKey);
                }
                break;
            case 'obw':
                $selectedBank = $request->input('obw_bank');
                $mpiReqData['MPI_TRANS_TYPE'] = 'OBWTXN';
                $mpiReqData['MPI_CHANNEL_CODE'] = 'BW';
                $mpiReqData['MPI_SELECTED_BANK'] = $selectedBank;
                $mpiReqData['MPI_CUST_BANK_TYPE'] = 'RET';
                $mpiReqData['MPI_CUST_NAME'] = $customerName;
                $mpiReqData['MPI_MER_IP'] = '127.0.0.1';
                $mpiReqData['MPI_MER_NAME'] = 'Test Merchant';
                $mpiReqData['MPI_PYMT_DESC'] = $paymentDescription;
                $mpiReqData['MPI_RCP_REF'] = 'OBWRef' . substr($transactionId, -6); // Use last 6 chars for reference
                $formFields['action'] = env('CARDZONE_UAT_OBW_URL');

                if ($transaction->status === 'demo_mode') {
                    $mpiReqData['MPI_MAC'] = 'DEMO_MAC_SIGNATURE';
                } else {
                    $mpiReqData['MPI_MAC'] = $this->cardzoneService->generateMacForMPIReqOBW($mpiReqData, $merchantPrivateKey);
                }
                break;
            case 'qr':
                $mpiReqData['MPI_TRANS_TYPE'] = 'QRTXN';
                $mpiReqData['MPI_CHANNEL_CODE'] = 'BW';
                $mpiReqData['MPI_MER_IP'] = '127.0.0.1';
                $mpiReqData['MPI_MER_NAME'] = 'Test Merchant';
                $mpiReqData['MPI_PYMT_DESC'] = $paymentDescription;
                $mpiReqData['MPI_QR_TYPE'] = 'STRING'; // Request QR as string
                // If you need a hosted QR page from Cardzone, the URL would be different
                $formFields['action'] = env('CARDZONE_UAT_QR_URL');

                if ($transaction->status === 'demo_mode') {
                    $mpiReqData['MPI_MAC'] = 'DEMO_MAC_SIGNATURE';
                } else {
                    $mpiReqData['MPI_MAC'] = $this->cardzoneService->generateMacForMPIReqQr($mpiReqData, $merchantPrivateKey);
                }
                break;
            default:
                $transaction->update(['status' => 'failed']);
                return response()->json(['success' => false, 'message' => 'Invalid payment method.'], 400);
        }

        $formFields['fields'] = $mpiReqData;
        $formFields['target'] = 'cardzone_iframe'; // Target the iframe

        // Update transaction status to indicate redirection
        $transaction->update(['status' => 'redirected_to_3ds']);

        return response()->json(['success' => true, 'form' => $formFields]);
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