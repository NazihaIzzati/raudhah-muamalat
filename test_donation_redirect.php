<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Http\Request;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\PaymentController;

echo "Testing Donation Redirect Flow...\n\n";

// Test 1: Create donation and redirect to payment page
echo "1. Testing donation creation and redirect...\n";

$donationRequest = new Request([
    'campaign_id' => 1,
    'amount' => 50.00,
    'donor_name' => 'Test Donor',
    'donor_email' => 'test@example.com',
    'donor_phone' => '123456789',
    'message' => 'Test donation message',
    'is_anonymous' => false,
    'payment_method' => 'card',
    'card_number' => '4111111111111111',
    'card_expiry' => '12/25',
    'card_cvv' => '123',
    'card_holder_name' => 'Test Card Holder',
]);

$donationController = app(DonationController::class);

try {
    // Start session for testing
    session()->start();
    
    $response = $donationController->processDonation($donationRequest);
    
    echo "✓ Donation created successfully\n";
    echo "  - Response status: " . $response->getStatusCode() . "\n";
    echo "  - Redirect URL: " . $response->getTargetUrl() . "\n";
    
    // Check if session data was set
    if (session()->has('donation_id')) {
        echo "  - Session data set: donation_id = " . session('donation_id') . "\n";
    } else {
        echo "  - Warning: Session data not set\n";
    }
    
} catch (Exception $e) {
    echo "✗ Error creating donation: " . $e->getMessage() . "\n";
}

echo "\n2. Testing payment page with donation data...\n";

try {
    $paymentController = app(PaymentController::class);
    $paymentRequest = new Request();
    
    $response = $paymentController->showPaymentPage($paymentRequest);
    
    if ($response instanceof \Illuminate\Http\RedirectResponse) {
        echo "✓ Payment page redirecting to Cardzone\n";
        echo "  - Redirect URL: " . $response->getTargetUrl() . "\n";
    } elseif ($response instanceof \Illuminate\View\View) {
        echo "✓ Payment page view rendered successfully\n";
        echo "  - View name: " . $response->getName() . "\n";
    } else {
        echo "✓ Payment page response received\n";
        echo "  - Response type: " . get_class($response) . "\n";
    }
    
} catch (Exception $e) {
    echo "✗ Error loading payment page: " . $e->getMessage() . "\n";
}

echo "\nDonation redirect flow test completed!\n"; 