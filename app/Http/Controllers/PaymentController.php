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
            ];
        }
        
        // Get bank list for payment options
        $banks = $this->cardzoneService->getBankList();
        
        // If bank list API fails, use empty array instead of redirecting
        if ($banks === false) {
            Log::warning('Bank list API failed during payment page load, using empty bank list');
            $banks = [];
        }
        
        // Check if this is the debug route
        $viewName = $request->route()->getName() === 'payment.debug' ? 'payment_debug' : 'payment';
        
        return view($viewName, [
            'banks' => $banks,
            'donationData' => $donationData,
            'cardzoneMpiReqUrl' => env('CARDZONE_UAT_MPIREQ_URL', 'https://uat.cardzone.com.my/mpireq')
        ]);
    }
    
    /**
     * Handles key exchange requests for card payments
     */
    public function performKeyExchange(Request $request)
    {
        $paymentMethod = $request->input('payment_method');
        $merchantId = env('CARDZONE_MERCHANT_ID');
        $purchaseAmount = $request->input('purchase_amount');
        $purchaseCurrency = $request->input('purchase_currency');
        $donationId = $request->input('donation_id');

        // Only allow key exchange for card payments
        if ($paymentMethod !== 'card') {
            return response()->json(['success' => false, 'message' => 'Key exchange is only required for card payments.'], 400);
        }

        $donation = null;
        if ($donationId) {
            $donation = \App\Models\Donation::find($donationId);
        }

        $transactionId = $this->cardzoneService->generateTransactionId($donationId);
        Log::info('Key exchange initiated', [
            'transactionId' => $transactionId,
            'paymentMethod' => $paymentMethod,
            'amount' => $purchaseAmount / 100,
            'currency' => $purchaseCurrency,
            'donationId' => $donationId
        ]);

        // Create a temporary transaction record for key exchange
        $transaction = Transaction::create([
            'transaction_id' => $transactionId,
            'merchant_id' => $merchantId,
            'amount' => $purchaseAmount / 100,
            'currency' => $purchaseCurrency,
            'payment_method' => $paymentMethod,
            'status' => 'key_exchange_pending',
            'donation_id' => $donationId,
        ]);

        // --- Perform Key Exchange (MPIKeyReq) ---
        Log::info('Starting Key Exchange with Cardzone', [
            'transactionId' => $transactionId,
            'merchantId' => $merchantId,
            'keyExchangeUrl' => env('CARDZONE_UAT_KEY_EXCHANGE_URL')
        ]);
        
        $keyExchangeResult = $this->cardzoneService->performKeyExchange($transactionId);
        
        if ($keyExchangeResult['success']) {
            // Get the purchaseId from Cardzone response
            $cardzonePurchaseId = $keyExchangeResult['purchaseId'] ?? $transactionId;
            
            // Update transaction with Cardzone's purchaseId
            $transaction->update([
                'transaction_id' => $cardzonePurchaseId,
                'status' => 'key_exchange_completed',
                'cardzone_response_data' => $keyExchangeResult
            ]);
            
            Log::info('Key exchange completed successfully', [
                'originalTransactionId' => $transactionId,
                'cardzonePurchaseId' => $cardzonePurchaseId,
                'donationId' => $donationId
            ]);
            
            return response()->json([
                'success' => true,
                'transaction_id' => $cardzonePurchaseId,
                'message' => 'Key exchange completed successfully'
            ]);
        } else {
            // Get the purchaseId from Cardzone response if available
            $cardzonePurchaseId = $keyExchangeResult['purchaseId'] ?? $transactionId;
            
            // Update transaction status to failed
            $transaction->update([
                'transaction_id' => $cardzonePurchaseId,
                'status' => 'key_exchange_failed',
                'cardzone_response_data' => $keyExchangeResult
            ]);
            
            Log::error('Key exchange failed', [
                'originalTransactionId' => $transactionId,
                'cardzonePurchaseId' => $cardzonePurchaseId,
                'error' => $keyExchangeResult['error'] ?? 'Unknown error',
                'donationId' => $donationId
            ]);
            
            return response()->json([
                'success' => false, 
                'message' => 'Key exchange failed: ' . ($keyExchangeResult['error'] ?? 'Unknown error'),
                'error_code' => $keyExchangeResult['errorCode'] ?? null
            ], 400);
        }
    }

    /**
     * Handles the initial payment request from the frontend.
     * This endpoint will perform the Key Exchange and prepare data for the frontend.
     */
    public function initiatePayment(Request $request)
    {
        // Check if this is a key exchange request
        if ($request->input('action') === 'key_exchange') {
            return $this->performKeyExchange($request);
        }

        $paymentMethod = $request->input('payment_method');
        $merchantId = env('CARDZONE_MERCHANT_ID');
        $purchaseAmount = $request->input('purchase_amount');
        $purchaseCurrency = $request->input('purchase_currency');
        $donationId = $request->input('donation_id');

        $donation = null;
        if ($donationId) {
            $donation = \App\Models\Donation::find($donationId);
        }

        $transactionId = $request->input('transaction_id') ?? $this->cardzoneService->generateTransactionId($donationId);
        Log::info('Payment transaction initiated', [
            'transactionId' => $transactionId,
            'paymentMethod' => $paymentMethod,
            'amount' => $purchaseAmount / 100,
            'currency' => $purchaseCurrency,
            'donationId' => $donationId
        ]);

        // For card payments, we need to find the existing transaction from key exchange
        if ($paymentMethod === 'card') {
            // Look for the transaction created during key exchange
            $existingTransaction = Transaction::where('transaction_id', $transactionId)
                ->where('status', 'key_exchange_completed')
                ->first();
            
            if (!$existingTransaction) {
                Log::error('Key exchange not completed for card payment', [
                    'transactionId' => $transactionId,
                    'donationId' => $donationId
                ]);
                return response()->json(['success' => false, 'message' => 'Key exchange must be completed before payment.'], 400);
            }
            
            // Use the existing transaction from key exchange
            $transaction = $existingTransaction;
            
            // Update the transaction with payment details
            $transaction->update([
                'card_number_masked' => \Illuminate\Support\Str::mask($request->input('card_number'), '*', 6, 4),
                'card_expiry' => $request->input('card_expiry'),
                'card_holder_name' => $request->input('card_holder_name'),
                'amount' => $purchaseAmount / 100, // Add amount field
                'currency' => $purchaseCurrency, // Add currency field
                'status' => 'pending',
            ]);
            
            Log::info('Updated key exchange transaction for payment', [
                'transactionId' => $transactionId,
                'previousStatus' => $existingTransaction->status
            ]);
        } else {
            // For non-card payments, create or update transaction
            $existingTransaction = Transaction::where('transaction_id', $transactionId)->first();
            
            if ($existingTransaction) {
                // Update existing transaction with payment details
                $transaction = $existingTransaction;
                $transaction->update([
                    'merchant_id' => $merchantId,
                    'amount' => $purchaseAmount / 100,
                    'currency' => $purchaseCurrency,
                    'payment_method' => $paymentMethod,
                    'obw_bank_code' => $paymentMethod === 'obw' ? $request->input('obw_bank') : null,
                    'donation_id' => $donationId,
                    'status' => 'pending',
                ]);
                Log::info('Updated existing transaction for payment', [
                    'transactionId' => $transactionId,
                    'previousStatus' => $existingTransaction->status
                ]);
            } else {
                // Create new transaction
                $transaction = Transaction::create([
                    'transaction_id' => $transactionId,
                    'merchant_id' => $merchantId,
                    'amount' => $purchaseAmount / 100,
                    'currency' => $purchaseCurrency,
                    'payment_method' => $paymentMethod,
                    'status' => 'pending',
                    'obw_bank_code' => $paymentMethod === 'obw' ? $request->input('obw_bank') : null,
                    'donation_id' => $donationId,
                ]);
                Log::info('Created new transaction for payment', [
                    'transactionId' => $transactionId
                ]);
            }
        }

        // For card payments, we need to use the key exchange result
        if ($paymentMethod === 'card') {
            // Use the Cardzone public key from file
            $cardzonePublicKeyPath = base_path('ssh-keygen/cardzone_public.pem');
            if (!file_exists($cardzonePublicKeyPath)) {
                Log::error('Cardzone public key file not found', [
                    'transactionId' => $transactionId,
                    'path' => $cardzonePublicKeyPath
                ]);
                $transaction->update(['status' => 'failed_validation']);
                return response()->json(['success' => false, 'message' => 'Cardzone public key not found. Please perform key exchange first.'], 400);
            }
            $cardzonePublicKey = file_get_contents($cardzonePublicKeyPath);
            $merchantPrivateKey = $this->cardzoneService->getMerchantPrivateKey();
        } else {
            // For non-card payments, we don't need key exchange
            $cardzonePublicKey = null;
            $merchantPrivateKey = null;
        }
        
        // Prepare MPIReq data strictly following Cardzone spec
        $cardNumber = $request->input('card_number');
        $cardExpiry = $request->input('card_expiry');
        $cardCVV = $request->input('card_cvv');
        $cardHolderName = $request->input('card_holder_name');
        
        // Validate card holder name
        if (empty($cardHolderName) || strlen(trim($cardHolderName)) < 2) {
            Log::error('Invalid card holder name', [
                'transactionId' => $transactionId,
                'cardHolderName' => $cardHolderName
            ]);
            $transaction->update(['status' => 'failed_validation']);
            return response()->json(['success' => false, 'message' => 'Card holder name is required and must be at least 2 characters long.'], 400);
        }
        
        // Clean and format card holder name (remove extra spaces, special characters)
        $cardHolderName = trim(preg_replace('/[^a-zA-Z\s]/', '', $cardHolderName));
        if (empty($cardHolderName)) {
            Log::error('Card holder name contains no valid characters', [
                'transactionId' => $transactionId,
                'originalName' => $request->input('card_holder_name')
            ]);
            $transaction->update(['status' => 'failed_validation']);
            return response()->json(['success' => false, 'message' => 'Card holder name must contain only letters and spaces.'], 400);
        }
        
        // Ensure card holder name is not too long (Cardzone typically has limits)
        if (strlen($cardHolderName) > 50) {
            $cardHolderName = substr($cardHolderName, 0, 50);
        }
        
        // Convert to uppercase as per Cardzone requirements
        $cardHolderName = strtoupper($cardHolderName);
        
        Log::info('Card holder name processed', [
            'transactionId' => $transactionId,
            'originalName' => $request->input('card_holder_name'),
            'processedName' => $cardHolderName
        ]);
        
        $now = now()->format('YmdHis');
        // Use purchaseAmount directly as it is already in minor units
        $amountMinor = $purchaseAmount;
        
        // Fix card expiry date format according to Cardzone docs: YYMM (4 digits)
        $exp = preg_replace('/\D/', '', $cardExpiry);
        if (strlen($exp) === 4) {
            // Already in MMYY format, convert to YYMM
            $exp = substr($exp, 2, 2) . substr($exp, 0, 2); // YYMM
        } elseif (strlen($exp) === 6) {
            // MMYYYY format, extract YYMM
            $exp = substr($exp, 4, 2) . substr($exp, 2, 2); // YYMM
        } elseif (strlen($exp) === 5) {
            // M/YY format, convert to YYMM
            $exp = substr($exp, 3, 2) . substr($exp, 0, 1) . '0'; // YYMM
        }
        
        // Validate card number format and clean it
        $cardNumber = preg_replace('/\D/', '', $cardNumber); // Remove non-digits
        
        // Log card data processing for debugging
        Log::info('Card data processing', [
            'transactionId' => $transactionId,
            'originalExpiry' => $cardExpiry,
            'processedExpiry' => $exp,
            'cardNumberLength' => strlen($cardNumber),
            'cardNumberMasked' => substr($cardNumber, 0, 4) . '****' . substr($cardNumber, -4)
        ]);
        
        // --- Dynamic MPI_TRANS_TYPE support ---
        $allowedTransTypes = ['INQ', 'SALES', 'VSALES', 'REFUND'];
        $mpiTransType = strtoupper($request->input('mpi_trans_type', 'SALES'));
        if (!in_array($mpiTransType, $allowedTransTypes)) {
            $mpiTransType = 'SALES';
        }

        // Handle MPI_ORI_TRXN_ID based on transaction type
        $oriTrxnId = '';
        if (in_array($mpiTransType, ['VSALES', 'INQ', 'REFUND'])) {
            // For these transaction types, MPI_ORI_TRXN_ID is mandatory
            $oriTrxnId = $request->input('mpi_ori_trxn_id', '');
            if (empty($oriTrxnId)) {
                Log::warning('MPI_ORI_TRXN_ID is required for transaction type: ' . $mpiTransType, [
                    'transactionId' => $transactionId,
                    'transactionType' => $mpiTransType
                ]);
            }
        }
        
        // Start with mandatory fields only
        $mpiReq = [
            // Mandatory Fields (7)
            'MPI_TRANS_TYPE' => $mpiTransType,
            'MPI_MERC_ID' => $merchantId,
            'MPI_PURCH_AMT' => $amountMinor,
            'MPI_PURCH_CURR' => $purchaseCurrency,
            'MPI_TRXN_ID' => $transactionId,
            'MPI_PURCH_DATE' => $now,
            
            // Card Data Fields (Plain Text) - 4 fields
            'MPI_PAN' => $cardNumber, // Plain text card number
            'MPI_CARD_HOLDER_NAME' => $cardHolderName,
            'MPI_PAN_EXP' => $exp, // Plain text expiry date
            'MPI_CVV2' => $cardCVV, // Plain text CVV
        ];
        
        // Add optional fields only if they have values
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
        
        // Map new form fields to Cardzone payload
        // Billing Address
        if ($request->filled('billing_address_line1')) $mpiReq['MPI_BILL_ADDR_LINE1'] = $request->input('billing_address_line1');
        if ($request->filled('billing_address_line2')) $mpiReq['MPI_BILL_ADDR_LINE2'] = $request->input('billing_address_line2');
        if ($request->filled('billing_address_line3')) $mpiReq['MPI_BILL_ADDR_LINE3'] = $request->input('billing_address_line3');
        if ($request->filled('billing_city')) $mpiReq['MPI_BILL_ADDR_CITY'] = $request->input('billing_city');
        if ($request->filled('billing_state')) $mpiReq['MPI_BILL_ADDR_STATE'] = $request->input('billing_state');
        if ($request->filled('billing_country')) $mpiReq['MPI_BILL_ADDR_CNTRY'] = $request->input('billing_country');
        if ($request->filled('billing_postcode')) $mpiReq['MPI_BILL_ADDR_POSTCODE'] = $request->input('billing_postcode');
        
        // Shipping Address
        if ($request->filled('shipping_address_line1')) $mpiReq['MPI_SHIP_ADDR_LINE1'] = $request->input('shipping_address_line1');
        if ($request->filled('shipping_address_line2')) $mpiReq['MPI_SHIP_ADDR_LINE2'] = $request->input('shipping_address_line2');
        if ($request->filled('shipping_address_line3')) $mpiReq['MPI_SHIP_ADDR_LINE3'] = $request->input('shipping_address_line3');
        if ($request->filled('shipping_city')) $mpiReq['MPI_SHIP_ADDR_CITY'] = $request->input('shipping_city');
        if ($request->filled('shipping_state')) $mpiReq['MPI_SHIP_ADDR_STATE'] = $request->input('shipping_state');
        if ($request->filled('shipping_country')) $mpiReq['MPI_SHIP_ADDR_CNTRY'] = $request->input('shipping_country');
        if ($request->filled('shipping_postcode')) $mpiReq['MPI_SHIP_ADDR_POSTCODE'] = $request->input('shipping_postcode');
        
        // Address Match
        if ($request->filled('MPI_ADDR_MATCH')) {
            $mpiReq['MPI_ADDR_MATCH'] = $request->input('MPI_ADDR_MATCH');
        } elseif ($request->filled('addr_match_backup')) {
            $mpiReq['MPI_ADDR_MATCH'] = $request->input('addr_match_backup');
        } else {
            // Default to 'N' if not provided
            $mpiReq['MPI_ADDR_MATCH'] = 'N';
        }
        
        // Contact Information
        if ($request->filled('email')) {
            $email = trim(str_replace(["\n", "\r", "\t"], '', $request->input('email')));
            $mpiReq['MPI_EMAIL'] = $email;
            
            // Log email cleaning for debugging
            Log::info('Email field cleaned in initiatePayment', [
                'original' => $request->input('email'),
                'cleaned' => $email,
                'has_newlines' => strpos($request->input('email'), "\n") !== false,
                'has_carriage_returns' => strpos($request->input('email'), "\r") !== false
            ]);
        }
        if ($request->filled('home_phone')) $mpiReq['MPI_HOME_PHONE'] = $request->input('home_phone');
        if ($request->filled('work_phone')) $mpiReq['MPI_WORK_PHONE'] = $request->input('work_phone');
        if ($request->filled('mobile_phone')) $mpiReq['MPI_MOBILE_PHONE'] = $request->input('mobile_phone');
        
        // Card Details
        if ($request->filled('card_number')) {
            // Remove all spaces from card number
            $cardNumber = preg_replace('/\s+/', '', $request->input('card_number'));
            $mpiReq['MPI_PAN'] = $cardNumber;
        }
        if ($request->filled('card_expiry')) {
            // Format expiry date properly (remove any formatting and use YYMM format)
            $expiry = preg_replace('/\D/', '', $request->input('card_expiry')); // Remove non-digits
            if (strlen($expiry) === 4) {
                $expiry = substr($expiry, 2, 2) . substr($expiry, 0, 2); // Convert MMYY to YYMM
            }
            $mpiReq['MPI_PAN_EXP'] = $expiry;
        }
        if ($request->filled('card_cvv')) $mpiReq['MPI_CVV2'] = $request->input('card_cvv');
        if ($request->filled('card_holder_name')) $mpiReq['MPI_CARD_HOLDER_NAME'] = strtoupper($request->input('card_holder_name'));
        
        // Set default country code for Malaysia if not provided
        if (empty($mpiReq['MPI_HOME_PHONE_CC']) && !empty($mpiReq['MPI_HOME_PHONE'])) $mpiReq['MPI_HOME_PHONE_CC'] = '60';
        if (empty($mpiReq['MPI_WORK_PHONE_CC']) && !empty($mpiReq['MPI_WORK_PHONE'])) $mpiReq['MPI_WORK_PHONE_CC'] = '60';
        if (empty($mpiReq['MPI_MOBILE_PHONE_CC']) && !empty($mpiReq['MPI_MOBILE_PHONE'])) $mpiReq['MPI_MOBILE_PHONE_CC'] = '60';
        
        // Remove empty/null fields from payload
        $mpiReq = $this->removeEmptyFields($mpiReq);
        
        // Override plain text fields if provided (these are NOT part of MAC generation)
        // if ($request->filled('panRef')) $mpiReq['panRef'] = $request->input('panRef');
        // if ($request->filled('cardNo')) $mpiReq['cardNo'] = $request->input('cardNo');
        // if ($request->filled('cardExpiryDate')) $mpiReq['cardExpiryDate'] = $request->input('cardExpiryDate');

        // Format the payload for Cardzone with proper padding (same as MAC generation)
        $formattedMpiReq = $this->cardzoneService->formatPayloadForCardzoneWithProperPadding($mpiReq);
        
        // MAC must be generated using the same properly padded data
        // Set $testWithoutMac = true to test without MAC generation
        $testWithoutMac = false; // Set to true to test without MAC
        if (!$testWithoutMac) {
            $formattedMpiReq['MPI_MAC'] = $this->cardzoneService->generateMacForMPIReq($formattedMpiReq, $merchantPrivateKey);
        } else {
            // Test without MAC - remove MAC field if it exists
            unset($formattedMpiReq['MPI_MAC']);
            Log::info('Testing without MAC - MAC field removed from payload');
        }

        // Log the request (both Laravel and debug log)
        $mpireqUrl = env('CARDZONE_UAT_MPIREQ_URL');
        $requestLog = [
            'url' => $mpireqUrl,
            'payload' => $formattedMpiReq,
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8'
            ]
        ];
        Log::info('Cardzone Card Payment Request', $requestLog);
        file_put_contents(storage_path('logs/cardzone_debug.log'), "[" . date('Y-m-d H:i:s') . "] Cardzone Card Payment Request: " . print_r($requestLog, true) . "\n", FILE_APPEND);

        // Submit payment - Cardzone expects form data, not JSON
        $response = \Illuminate\Support\Facades\Http::asForm()->timeout(30)->post($mpireqUrl, $formattedMpiReq);

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

        // For card payments, we need to redirect to Cardzone for 3DS authentication
        if ($paymentMethod === 'card') {
            // Store transaction data in session for callback processing
            session([
                'pending_transaction_id' => $transactionId,
                'pending_donation_id' => $donationId,
                'pending_amount' => $purchaseAmount / 100,
                'pending_currency' => $purchaseCurrency
            ]);
            
            // Check if this is a direct form submission (JavaScript disabled)
            if ($request->isMethod('POST') && !$request->expectsJson()) {
                // Redirect to our redirect page for form submission
                return redirect()->route('payment.redirect', [
                    'transaction_id' => $transactionId,
                    'redirect_url' => env('CARDZONE_UAT_MPIREQ_URL'),
                    'form_data' => json_encode($mpiReq)
                ]);
            }
            
            // Return JSON response for AJAX requests
            return response()->json([
                'success' => true,
                'redirect_url' => env('CARDZONE_UAT_MPIREQ_URL'),
                'form_data' => $mpiReq,
                'transaction_id' => $transactionId
            ]);
        } else {
            // For non-card payments, return the API response directly
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
    }

    /**
     * Shows the redirect page for Cardzone payment processing
     */
    public function showRedirectPage(Request $request)
    {
        $transactionId = $request->query('transaction_id');
        $redirectUrl = $request->query('redirect_url');
        $formData = $request->query('form_data');
        
        if (!$transactionId || !$redirectUrl || !$formData) {
            return redirect()->route('payment.failure', ['message' => 'Invalid redirect parameters']);
        }
        
        // Get transaction details
        $transaction = Transaction::where('transaction_id', $transactionId)->first();
        if (!$transaction) {
            return redirect()->route('payment.failure', ['message' => 'Transaction not found']);
        }
        
        return view('payment.redirect', [
            'transaction_id' => $transactionId,
            'redirect_url' => $redirectUrl,
            'form_data' => json_decode($formData, true),
            'amount' => $transaction->amount,
            'payment_method' => $transaction->payment_method
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
                'donation_id' => 'nullable|exists:donations,id',
                'campaign_id' => 'required|exists:campaigns,id',
                'amount' => 'required|numeric|min:1',
                'donor_name' => 'required|string|max:255',
                'donor_email' => 'required|email|max:255',
                'donor_phone' => 'nullable|string|max:20',
                'message' => 'nullable|string',
                'is_anonymous' => 'boolean',
                'payment_method' => 'required|string|in:card,obw,qr',
                'transaction_id' => 'nullable|string|max:50',
                
                // Payment method specific validation
                'obw_bank' => 'required_if:payment_method,obw|string',
                
                // Secure payment page fields (optional for card payments)
                'billing_address_line1' => 'nullable|string|max:50',
                'billing_address_line2' => 'nullable|string|max:50',
                'billing_address_line3' => 'nullable|string|max:50',
                'billing_city' => 'nullable|string|max:50',
                                        'billing_state' => 'nullable|string|max:2',
                                        'billing_country' => 'nullable|string|max:3',
                'billing_postcode' => 'nullable|string|max:16',
                'shipping_address_line1' => 'nullable|string|max:50',
                'shipping_address_line2' => 'nullable|string|max:50',
                'shipping_address_line3' => 'nullable|string|max:50',
                'shipping_city' => 'nullable|string|max:50',
                                        'shipping_state' => 'nullable|string|max:2',
                                        'shipping_country' => 'nullable|string|max:3',
                'shipping_postcode' => 'nullable|string|max:16',
                'email' => 'nullable|email|max:254',
                'home_phone' => 'nullable|string|max:15',
                'work_phone' => 'nullable|string|max:15',
                'mobile_phone' => 'nullable|string|max:15',
                'MPI_ADDR_MATCH' => 'nullable|string|in:Y,N',
                
                // Card Details (required for card payments)
                'card_number' => 'required_if:payment_method,card|string|max:19',
                'card_expiry' => 'required_if:payment_method,card|string|max:5',
                'card_cvv' => 'required_if:payment_method,card|string|max:4',
                'card_holder_name' => 'required_if:payment_method,card|string|max:45',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed: Please check your input data',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Use existing donation if donation_id is provided
            $donation = null;
            if ($request->filled('donation_id')) {
                $donation = \App\Models\Donation::find($request->donation_id);
            }
            if (!$donation) {
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
                $donation->is_anonymous = $request->is_anonymous ?? false;
                $donation->save();
            }

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

            // Add transaction_id if provided (for card payments)
            if ($request->filled('transaction_id')) {
                $paymentData['transaction_id'] = $request->transaction_id;
            }

            // Add payment method specific data
            if ($request->payment_method === 'card') {
                $paymentData['card_number'] = $request->card_number;
                $paymentData['card_expiry'] = $request->card_expiry;
                $paymentData['card_cvv'] = $request->card_cvv;
                $paymentData['card_holder_name'] = $request->card_holder_name;
                
                // Add all secure payment page details for card payments
                $paymentData['billing_address_line1'] = $request->input('billing_address_line1');
                $paymentData['billing_address_line2'] = $request->input('billing_address_line2');
                $paymentData['billing_address_line3'] = $request->input('billing_address_line3');
                $paymentData['billing_city'] = $request->input('billing_city');
                $paymentData['billing_state'] = $request->input('billing_state');
                $paymentData['billing_country'] = $request->input('billing_country');
                $paymentData['billing_postcode'] = $request->input('billing_postcode');
                
                $paymentData['shipping_address_line1'] = $request->input('shipping_address_line1');
                $paymentData['shipping_address_line2'] = $request->input('shipping_address_line2');
                $paymentData['shipping_address_line3'] = $request->input('shipping_address_line3');
                $paymentData['shipping_city'] = $request->input('shipping_city');
                $paymentData['shipping_state'] = $request->input('shipping_state');
                $paymentData['shipping_country'] = $request->input('shipping_country');
                $paymentData['shipping_postcode'] = $request->input('shipping_postcode');
                
                $paymentData['email'] = $request->input('email');
                $paymentData['home_phone'] = $request->input('home_phone');
                $paymentData['work_phone'] = $request->input('work_phone');
                $paymentData['mobile_phone'] = $request->input('mobile_phone');
                $paymentData['MPI_ADDR_MATCH'] = $request->input('MPI_ADDR_MATCH');
                
                // Clean email value - remove any newlines, extra spaces, and trim
                if (!empty($paymentData['email'])) {
                    $originalEmail = $paymentData['email'];
                    $paymentData['email'] = trim(str_replace(["\n", "\r", "\t"], '', $originalEmail));
                    
                    // Log email cleaning for debugging
                    Log::info('Email field cleaned', [
                        'original' => $originalEmail,
                        'cleaned' => $paymentData['email'],
                        'has_newlines' => strpos($originalEmail, "\n") !== false,
                        'has_carriage_returns' => strpos($originalEmail, "\r") !== false
                    ]);
                }
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
    
    /**
     * Remove empty/null fields from payload
     * @param array $payload
     * @return array
     */
    private function removeEmptyFields(array $payload): array
    {
        $cleanedPayload = [];
        
        foreach ($payload as $key => $value) {
            // Skip null values
            if ($value === null) {
                continue;
            }
            
            // Skip empty strings
            if ($value === '') {
                continue;
            }
            
            // Skip arrays with only empty values
            if (is_array($value) && empty(array_filter($value, function($item) {
                return $item !== null && $item !== '';
            }))) {
                continue;
            }
            
            // Include the field if it has a value
            $cleanedPayload[$key] = $value;
        }
        
        return $cleanedPayload;
    }
} 