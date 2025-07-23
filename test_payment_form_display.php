<?php

require_once 'vendor/autoload.php';

// Initialize Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Services\CardzoneService;

echo "<!DOCTYPE html>
<html>
<head>
    <title>Cardzone Payment Test</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header { background: #fe5000; color: white; padding: 20px; margin: -20px -20px 20px -20px; border-radius: 8px 8px 0 0; }
        .step { background: #f8f9fa; padding: 15px; margin: 10px 0; border-radius: 5px; border-left: 4px solid #fe5000; }
        .success { border-left-color: #28a745; }
        .error { border-left-color: #dc3545; }
        .warning { border-left-color: #ffc107; }
        .code { background: #f8f9fa; padding: 10px; border-radius: 4px; font-family: monospace; font-size: 12px; overflow-x: auto; }
        .btn { background: #fe5000; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block; margin: 5px; }
        .btn:hover { background: #e04500; }
        .response-frame { width: 100%; height: 400px; border: 1px solid #ddd; border-radius: 4px; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1>🔍 Cardzone Payment Flow Test</h1>
            <p>Complete payment process demonstration</p>
        </div>";

// Initialize service
$cardzoneService = new CardzoneService();

// Test parameters
$cardDetails = [
    'card_number' => '5195982168861592',
    'card_expiry' => '03/28',
    'card_cvv' => '133',
    'card_holder_name' => 'Test User'
];

$amount = 1000; // 10.00 RM in cents
$transactionId = 'TEST' . time();

echo "<div class='step'>
    <h3>📋 Test Parameters</h3>
    <p><strong>Transaction ID:</strong> {$transactionId}</p>
    <p><strong>Card Number:</strong> {$cardDetails['card_number']}</p>
    <p><strong>Expiry:</strong> {$cardDetails['card_expiry']}</p>
    <p><strong>CVV:</strong> {$cardDetails['card_cvv']}</p>
    <p><strong>Amount:</strong> RM " . ($amount / 100) . "</p>
</div>";

// Step 1: Key Exchange
echo "<div class='step'>
    <h3>🔑 Step 1: Key Exchange (MPIKeyReq)</h3>
    <p><strong>URL:</strong> " . env('CARDZONE_UAT_KEY_EXCHANGE_URL') . "</p>
    <p><strong>Merchant ID:</strong> " . env('CARDZONE_MERCHANT_ID') . "</p>";

$keyExchangeResult = $cardzoneService->performKeyExchange($transactionId);

if ($keyExchangeResult['success']) {
    echo "<p class='success'>✅ Key exchange successful</p>";
    echo "<p>Cardzone Public Key Length: " . strlen($keyExchangeResult['cardzonePublicKey']) . " characters</p>";
} else {
    echo "<p class='warning'>⚠️ Key exchange failed - proceeding with demo mode</p>";
    echo "<p><strong>Error:</strong> " . ($keyExchangeResult['error'] ?? 'Unknown error') . "</p>";
    echo "<p><strong>Error Code:</strong> " . ($keyExchangeResult['errorCode'] ?? 'None') . "</p>";
}

echo "</div>";

// Step 2: Prepare payment data
echo "<div class='step'>
    <h3>📝 Step 2: Prepare Payment Data</h3>";

$cardzoneTransactionId = $cardzoneService->generateTransactionId();
$merchantPrivateKey = $cardzoneService->getMerchantPrivateKey();
$cardzonePublicKey = $cardzoneService->getCardzonePublicKey();

echo "<p><strong>Generated Transaction ID:</strong> {$cardzoneTransactionId}</p>";
echo "<p><strong>Merchant Private Key:</strong> " . (strlen($merchantPrivateKey) > 0 ? 'Loaded' : 'Not found') . "</p>";
echo "<p><strong>Cardzone Public Key:</strong> " . ($cardzonePublicKey ? 'Available' : 'Not available') . "</p>";

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

echo "<p><strong>Payment Data:</strong></p>
<div class='code'>";
foreach ($paymentData as $key => $value) {
    if (in_array($key, ['cardNumber', 'cardCVV'])) {
        $maskedValue = strlen($value) > 4 ? str_repeat('*', strlen($value) - 4) . substr($value, -4) : $value;
        echo "{$key}: {$maskedValue}\n";
    } else {
        echo "{$key}: {$value}\n";
    }
}
echo "</div></div>";

// Step 3: Generate MAC signature
echo "<div class='step'>
    <h3>🔐 Step 3: Generate MAC Signature</h3>";

try {
    $mac = $cardzoneService->generateMacForMPIReq($paymentData, $merchantPrivateKey);
    echo "<p class='success'>✅ MAC signature generated successfully</p>";
    echo "<p><strong>MAC Length:</strong> " . strlen($mac) . " characters</p>";
    echo "<p><strong>MAC Preview:</strong> " . substr($mac, 0, 20) . "...</p>";
} catch (Exception $e) {
    echo "<p class='error'>❌ MAC signature generation failed: " . $e->getMessage() . "</p>";
    $mac = 'DEMO_MAC_SIGNATURE';
}

echo "</div>";

// Step 4: Submit payment
echo "<div class='step'>
    <h3>🌐 Step 4: Submit Payment to Cardzone</h3>
    <p><strong>URL:</strong> " . env('CARDZONE_UAT_MPIREQ_URL') . "</p>";

// Add MAC to payload
$paymentData['mac'] = $mac;

try {
    $response = \Illuminate\Support\Facades\Http::withHeaders([
        'Content-Type' => 'application/x-www-form-urlencoded',
        'User-Agent' => 'Raudhah-Muamalat/1.0'
    ])->timeout(30)->post(env('CARDZONE_UAT_MPIREQ_URL'), $paymentData);
    
    $responseStatus = $response->status();
    $responseBody = $response->body();
    
    echo "<p><strong>Response Status:</strong> <span class='" . ($responseStatus === 200 ? 'success' : 'error') . "'>{$responseStatus}</span></p>";
    
    if ($responseStatus === 200) {
        echo "<p class='success'>✅ Payment submission successful</p>";
        
        // Check response content
        $hasForm = strpos($responseBody, '<form') !== false;
        $has3DS = strpos($responseBody, '3D') !== false || strpos($responseBody, 'secure') !== false;
        
        echo "<p><strong>Response Analysis:</strong></p>";
        echo "<ul>";
        echo "<li>Contains HTML Form: " . ($hasForm ? 'Yes' : 'No') . "</li>";
        echo "<li>Contains 3D Secure: " . ($has3DS ? 'Yes' : 'No') . "</li>";
        echo "</ul>";
        
        if ($hasForm) {
            echo "<p class='success'>📋 HTML form received - ready for 3D Secure authentication</p>";
            echo "<p>💡 Next step: User should be redirected to complete 3D Secure</p>";
        } else {
            echo "<p>📋 Direct response received</p>";
        }
        
        // Display response
        echo "<p><strong>Response Preview:</strong></p>";
        echo "<div class='code'>" . htmlspecialchars(substr($responseBody, 0, 500)) . "...</div>";
        
        // If it's an HTML form, show it in an iframe
        if ($hasForm) {
            echo "<p><strong>Payment Form:</strong></p>";
            echo "<iframe class='response-frame' srcdoc='" . htmlspecialchars($responseBody) . "'></iframe>";
        }
        
    } else {
        echo "<p class='error'>❌ Payment submission failed</p>";
        echo "<p><strong>Error Response:</strong></p>";
        echo "<div class='code'>" . htmlspecialchars($responseBody) . "</div>";
    }
    
} catch (Exception $e) {
    echo "<p class='error'>❌ Network error: " . $e->getMessage() . "</p>";
}

echo "</div>";

// Summary
echo "<div class='step'>
    <h3>📋 Payment Flow Summary</h3>
    <p><strong>Transaction ID:</strong> {$cardzoneTransactionId}</p>
    <p><strong>Key Exchange:</strong> " . ($keyExchangeResult['success'] ? '✅ Success' : '❌ Failed') . "</p>
    <p><strong>Payment Submission:</strong> " . (isset($responseStatus) && $responseStatus === 200 ? '✅ Success' : '❌ Failed') . "</p>
    <p><strong>Response Type:</strong> " . (isset($hasForm) && $hasForm ? 'HTML Form (3D Secure)' : 'Direct Response') . "</p>
</div>";

echo "<div class='step'>
    <h3>🔗 Next Steps</h3>
    <ul>
        <li>If HTML form received, user should complete 3D Secure authentication</li>
        <li>Monitor callback URL for payment status updates</li>
        <li>Check Cardzone dashboard for transaction status</li>
        <li>Review debug logs for detailed information</li>
    </ul>
    
    <div style='margin-top: 20px;'>
        <a href='/admin/cardzone/debug' class='btn'>View Debug Dashboard</a>
        <a href='/admin/cardzone/debug/logs' class='btn'>View Debug Logs</a>
        <a href='#' onclick='location.reload()' class='btn'>Run Another Test</a>
    </div>
</div>";

echo "</div></body></html>"; 