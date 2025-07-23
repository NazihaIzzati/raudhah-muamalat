<?php

require_once 'vendor/autoload.php';

use App\Services\CardzoneService;
use App\Services\CardzoneDebugService;
use Illuminate\Support\Facades\Log;

// Initialize Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "🔍 CARDZONE PAYMENT FLOW TEST - COMPLETE PROCESS\n";
echo "================================================\n\n";

// Initialize services
$cardzoneService = new CardzoneService();
$debugService = new CardzoneDebugService();

// Test card details
$cardDetails = [
    'card_number' => '5195982168861592',
    'card_expiry' => '03/28',
    'card_cvv' => '133',
    'card_holder_name' => 'Test User'
];

$amount = 1000; // 10.00 RM in cents
$currency = 'MYR';
$transactionId = 'TEST' . time();

echo "📋 TEST PARAMETERS:\n";
echo "-------------------\n";
echo "Transaction ID: {$transactionId}\n";
echo "Card Number: {$cardDetails['card_number']}\n";
echo "Expiry: {$cardDetails['card_expiry']}\n";
echo "CVV: {$cardDetails['card_cvv']}\n";
echo "Amount: RM " . ($amount / 100) . "\n";
echo "Currency: {$currency}\n\n";

// Step 1: Log payment initiation
echo "🚀 STEP 1: PAYMENT INITIATION\n";
echo "------------------------------\n";
$debugService->logPaymentInitiation($transactionId, $cardDetails, $amount, $currency);
echo "✅ Payment initiation logged\n\n";

// Step 2: Key Exchange
echo "🔑 STEP 2: KEY EXCHANGE (MPIKeyReq)\n";
echo "-----------------------------------\n";
echo "URL: " . env('CARDZONE_UAT_KEY_EXCHANGE_URL') . "\n";
echo "Merchant ID: " . env('CARDZONE_MERCHANT_ID') . "\n";

$keyExchangeResult = $cardzoneService->performKeyExchange($transactionId);

echo "Key Exchange Result:\n";
echo "- Success: " . ($keyExchangeResult['success'] ? 'Yes' : 'No') . "\n";
echo "- Error: " . ($keyExchangeResult['error'] ?? 'None') . "\n";
echo "- Error Code: " . ($keyExchangeResult['errorCode'] ?? 'None') . "\n";

if ($keyExchangeResult['success']) {
    echo "✅ Key exchange successful\n";
    echo "- Cardzone Public Key Length: " . strlen($keyExchangeResult['cardzonePublicKey']) . " characters\n";
} else {
    echo "⚠️  Key exchange failed - proceeding with demo mode\n";
}
echo "\n";

// Step 3: Prepare payment data
echo "📝 STEP 3: PREPARE PAYMENT DATA\n";
echo "--------------------------------\n";

// Generate transaction ID
$cardzoneTransactionId = $cardzoneService->generateTransactionId();
echo "Generated Transaction ID: {$cardzoneTransactionId}\n";

// Get merchant private key
$merchantPrivateKey = $cardzoneService->getMerchantPrivateKey();
echo "Merchant Private Key: " . (strlen($merchantPrivateKey) > 0 ? 'Loaded' : 'Not found') . "\n";

// Get Cardzone public key
$cardzonePublicKey = $cardzoneService->getCardzonePublicKey();
echo "Cardzone Public Key: " . ($cardzonePublicKey ? 'Available' : 'Not available') . "\n";

// Prepare payment payload
$paymentData = [
    'merchantId' => env('CARDZONE_MERCHANT_ID'),
    'purchaseId' => $cardzoneTransactionId,
    'purchaseAmount' => $amount,
    'purchaseCurrency' => '458', // MYR currency code
    'purchaseDescription' => 'Test Payment',
    'customerEmail' => 'test@example.com',
    'customerPhone' => '123456789',
    'customerName' => 'Test Customer',
    'responseUrl' => env('CARDZONE_RESPONSE_URL'),
    'cardNumber' => $cardDetails['card_number'],
    'cardExpiry' => $cardDetails['card_expiry'],
    'cardCVV' => $cardDetails['card_cvv'],
    'cardHolderName' => $cardDetails['card_holder_name']
];

echo "Payment Data Prepared:\n";
foreach ($paymentData as $key => $value) {
    if (in_array($key, ['cardNumber', 'cardCVV'])) {
        $maskedValue = strlen($value) > 4 ? str_repeat('*', strlen($value) - 4) . substr($value, -4) : $value;
        echo "- {$key}: {$maskedValue}\n";
    } else {
        echo "- {$key}: {$value}\n";
    }
}
echo "\n";

// Step 4: Generate MAC signature
echo "🔐 STEP 4: GENERATE MAC SIGNATURE\n";
echo "----------------------------------\n";

try {
    $mac = $cardzoneService->generateMacForMPIReq($paymentData, $merchantPrivateKey);
    echo "MAC Signature: " . substr($mac, 0, 20) . "...\n";
    echo "MAC Length: " . strlen($mac) . " characters\n";
    echo "✅ MAC signature generated successfully\n";
} catch (Exception $e) {
    echo "❌ MAC signature generation failed: " . $e->getMessage() . "\n";
    $mac = 'DEMO_MAC_SIGNATURE';
}
echo "\n";

// Step 5: Submit payment to Cardzone
echo "🌐 STEP 5: SUBMIT PAYMENT TO CARDZONE\n";
echo "-------------------------------------\n";

$mpireqUrl = env('CARDZONE_UAT_MPIREQ_URL');
echo "URL: {$mpireqUrl}\n";

// Add MAC to payload
$paymentData['mac'] = $mac;

// Log the submission
$debugService->logPaymentSubmission($transactionId, $mpireqUrl, $paymentData, []);

try {
    $response = \Illuminate\Support\Facades\Http::withHeaders([
        'Content-Type' => 'application/x-www-form-urlencoded',
        'User-Agent' => 'Raudhah-Muamalat/1.0'
    ])->timeout(30)->post($mpireqUrl, $paymentData);
    
    $responseStatus = $response->status();
    $responseBody = $response->body();
    $responseHeaders = $response->headers();
    
    echo "Response Status: {$responseStatus}\n";
    echo "Response Headers:\n";
    foreach ($responseHeaders as $header => $values) {
        echo "- {$header}: " . implode(', ', $values) . "\n";
    }
    echo "\nResponse Body (first 500 chars):\n";
    echo substr($responseBody, 0, 500) . "\n";
    
    // Check if response contains HTML form
    $hasForm = strpos($responseBody, '<form') !== false;
    $has3DS = strpos($responseBody, '3D') !== false || strpos($responseBody, 'secure') !== false;
    
    echo "\nResponse Analysis:\n";
    echo "- Contains HTML Form: " . ($hasForm ? 'Yes' : 'No') . "\n";
    echo "- Contains 3D Secure: " . ($has3DS ? 'Yes' : 'No') . "\n";
    
    if ($responseStatus === 200) {
        echo "✅ Payment submission successful\n";
        
        if ($hasForm) {
            echo "📋 HTML form received - ready for 3D Secure authentication\n";
            echo "💡 Next step: User should be redirected to complete 3D Secure\n";
        } else {
            echo "📋 Direct response received\n";
        }
    } else {
        echo "❌ Payment submission failed\n";
    }
    
} catch (Exception $e) {
    echo "❌ Network error: " . $e->getMessage() . "\n";
}

echo "\n";

// Step 6: Log completion
echo "📊 STEP 6: LOGGING COMPLETION\n";
echo "------------------------------\n";

$debugService->logSuccess($transactionId, 'PAYMENT_FLOW_COMPLETED', [
    'transaction_id' => $cardzoneTransactionId,
    'amount' => $amount,
    'currency' => $currency,
    'key_exchange_success' => $keyExchangeResult['success'],
    'payment_submitted' => isset($responseStatus) && $responseStatus === 200
]);

echo "✅ Payment flow logging completed\n\n";

// Step 7: Summary
echo "📋 PAYMENT FLOW SUMMARY\n";
echo "=======================\n";
echo "Transaction ID: {$cardzoneTransactionId}\n";
echo "Key Exchange: " . ($keyExchangeResult['success'] ? '✅ Success' : '❌ Failed') . "\n";
echo "Payment Submission: " . (isset($responseStatus) && $responseStatus === 200 ? '✅ Success' : '❌ Failed') . "\n";
echo "Response Type: " . (isset($hasForm) && $hasForm ? 'HTML Form (3D Secure)' : 'Direct Response') . "\n";
echo "Debug Logs: Available in storage/logs/cardzone_debug.log\n";
echo "Transaction Logs: Available in storage/logs/cardzone_transactions.log\n\n";

echo "🔗 NEXT STEPS:\n";
echo "--------------\n";
echo "1. Check debug logs for detailed information\n";
echo "2. If HTML form received, user should complete 3D Secure\n";
echo "3. Monitor callback URL for payment status updates\n";
echo "4. Check Cardzone dashboard for transaction status\n\n";

echo "🎯 TEST COMPLETED!\n";
echo "==================\n"; 