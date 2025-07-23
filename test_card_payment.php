<?php

// Bootstrap Laravel
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Services\CardzoneService;

// Helper to load PEM public key
function getCardzonePemKey() {
    $pemPath = __DIR__ . '/ssh-keygen/cardzone_public.pem';
    if (!file_exists($pemPath)) {
        echo "Cardzone public key PEM file not found: $pemPath\n";
        exit(1);
    }
    return file_get_contents($pemPath);
}

// Hardcoded test values
$cardNumber = '5195 9821 6886 1592';
$expiry = '03/28';
$cvv = '133';
$amount = '1.00';
$currency = '458';
$cardHolder = 'Test User';

$service = app(CardzoneService::class);

// 1. Key Exchange (for completeness, not used for encryption)
echo "\nPerforming key exchange...\n";
$purchaseId = $service->generateTransactionId();
$keyExchange = $service->performKeyExchange($purchaseId);
if (!$keyExchange['success']) {
    echo "Key exchange failed: " . ($keyExchange['error'] ?? 'Unknown error') . "\n";
    exit(1);
}

// 2. Load Cardzone PEM public key for encryption
$cardzonePublicKey = getCardzonePemKey();
$merchantPrivateKey = $service->getMerchantPrivateKey();

// 3. Prepare MPIReq payload with all 35 fields (empty string if not used)
$now = date('YmdHis');
$encryptedPan = $service->encryptData(str_replace(' ', '', $cardNumber), $cardzonePublicKey);
$encryptedCvv = $service->encryptData($cvv, $cardzonePublicKey);
$exp = preg_replace('/\D/', '', $expiry); // MMYY or MMYYYY
if (strlen($exp) === 4) {
    $exp = substr($exp, 2, 2) . substr($exp, 0, 2); // YYMM
} elseif (strlen($exp) === 6) {
    $exp = substr($exp, 4, 2) . substr($exp, 2, 2); // YYMM
}
$encryptedExp = $service->encryptData($exp, $cardzonePublicKey);

// Example line item
$lineItems = [
    [
        'MPI_ITEM_ID' => 'ITEM001',
        'MPI_ITEM_REMARK' => 'Test Item',
        'MPI_ITEM_QUANTITY' => '1',
        'MPI_ITEM_AMOUNT' => $amount,
        'MPI_ITEM_CURRENC' => $currency,
    ]
];

$mpiReq = [
    'MPI_TRANS_TYPE' => 'SALE',
    'MPI_MERC_ID' => env('CARDZONE_MERCHANT_ID'),
    'MPI_PAN' => $encryptedPan,
    'MPI_CARD_HOLDER_NAME' => $cardHolder,
    'MPI_PAN_EXP' => $encryptedExp,
    'MPI_CVV2' => $encryptedCvv,
    'MPI_TRXN_ID' => $purchaseId,
    'MPI_ORI_TRXN_ID' => '',
    'MPI_PURCH_DATE' => $now,
    'MPI_PURCH_CURR' => $currency,
    'MPI_PURCH_AMT' => number_format((float)$amount, 2, '.', ''),
    'MPI_ADDR_MATCH' => '',
    'MPI_BILL_ADDR_CITY' => '',
    'MPI_BILL_ADDR_STATE' => '',
    'MPI_BILL_ADDR_CNTRY' => '',
    'MPI_BILL_ADDR_POSTCODE' => '',
    'MPI_BILL_ADDR_LINE1' => '',
    'MPI_BILL_ADDR_LINE2' => '',
    'MPI_BILL_ADDR_LINE3' => '',
    'MPI_SHIP_ADDR_CITY' => '',
    'MPI_SHIP_ADDR_STATE' => '',
    'MPI_SHIP_ADDR_CNTRY' => '',
    'MPI_SHIP_ADDR_POSTCODE' => '',
    'MPI_SHIP_ADDR_LINE1' => '',
    'MPI_SHIP_ADDR_LINE2' => '',
    'MPI_SHIP_ADDR_LINE3' => '',
    'MPI_EMAIL' => '',
    'MPI_HOME_PHONE' => '',
    'MPI_HOME_PHONE_CC' => '',
    'MPI_WORK_PHONE' => '',
    'MPI_WORK_PHONE_CC' => '',
    'MPI_MOBILE_PHONE' => '',
    'MPI_MOBILE_PHONE_CC' => '',
    'MPI_LINE_ITEM' => $lineItems,
    'MPI_RESPONSE_TYPE' => '',
];

// 4. Generate MAC (strict Cardzone order)
$mpiReq['MPI_MAC'] = $service->generateMacForMPIReq($mpiReq, $merchantPrivateKey);

// 5. Submit payment
$mpireqUrl = env('CARDZONE_UAT_MPIREQ_URL');
echo "\nSubmitting card payment to: $mpireqUrl\n";
$response = Illuminate\Support\Facades\Http::withHeaders([
    'Content-Type' => 'application/json',
    'Accept' => 'application/json',
])->timeout(30)->post($mpireqUrl, $mpiReq);

// 6. Print/log request and response
echo "\n=== REQUEST PAYLOAD ===\n";
print_r($mpiReq);
echo "\n=== RESPONSE ===\n";
print_r($response->json());
echo "\nStatus Code: " . $response->status() . "\n"; 