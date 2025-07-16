<?php

require_once 'vendor/autoload.php';

use App\Http\Controllers\PaymentController;
use App\Services\CardzoneService;
use Illuminate\Http\Request;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Testing Payment Flow...\n";

// Test 1: Check if payment page loads
echo "\n1. Testing payment page load...\n";
try {
    $controller = new PaymentController(new CardzoneService());
    $request = new Request();
    $response = $controller->showPaymentPage($request);
    echo "✓ Payment page loads successfully\n";
} catch (Exception $e) {
    echo "✗ Payment page failed to load: " . $e->getMessage() . "\n";
}

// Test 2: Test payment initiation
echo "\n2. Testing payment initiation...\n";
try {
    $controller = new PaymentController(new CardzoneService());
    $request = new Request([
        'payment_method' => 'card',
        'merchant_id' => '400000000000005',
        'purchase_amount' => 15000,
        'purchase_currency' => '458',
        'card_number' => '4111111111111111',
        'card_expiry' => '1225',
        'card_cvv' => '123',
        'card_holder_name' => 'Test User'
    ]);
    
    $response = $controller->initiatePayment($request);
    $data = json_decode($response->getContent(), true);
    
    if (isset($data['success']) && $data['success']) {
        echo "✓ Payment initiation successful\n";
        echo "  - Transaction ID: " . ($data['form']['fields']['MPI_TRXN_ID'] ?? 'N/A') . "\n";
        echo "  - Action URL: " . ($data['form']['action'] ?? 'N/A') . "\n";
    } else {
        echo "✗ Payment initiation failed: " . ($data['message'] ?? 'Unknown error') . "\n";
    }
} catch (Exception $e) {
    echo "✗ Payment initiation failed: " . $e->getMessage() . "\n";
}

// Test 3: Test bank list API
echo "\n3. Testing bank list API...\n";
try {
    $controller = new PaymentController(new CardzoneService());
    $response = $controller->getBankList();
    $data = json_decode($response->getContent(), true);
    
    if (isset($data['success']) && $data['success']) {
        echo "✓ Bank list API successful\n";
        echo "  - Banks count: " . count($data['banks']) . "\n";
    } else {
        echo "✗ Bank list API failed: " . ($data['message'] ?? 'Unknown error') . "\n";
    }
} catch (Exception $e) {
    echo "✗ Bank list API failed: " . $e->getMessage() . "\n";
}

echo "\nPayment flow test completed!\n"; 