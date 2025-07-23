<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\CardzoneKey; // Import your CardzoneKey model

class CardzoneService
{
    protected $merchantId;
    protected $keyExchangeUrl;
    protected $mpireqUrl;
    protected $obwUrl;
    protected $qrUrl;
    protected $responseUrl;
    protected $privateKeyPath;
    protected $publicKeyPath;
    protected $debugService;

    public function __construct()
    {
        $this->merchantId = env('CARDZONE_MERCHANT_ID');
        $this->keyExchangeUrl = env('CARDZONE_UAT_KEY_EXCHANGE_URL');
        $this->mpireqUrl = env('CARDZONE_UAT_MPIREQ_URL');
        $this->obwUrl = env('CARDZONE_UAT_OBW_URL');
        $this->qrUrl = env('CARDZONE_UAT_QR_URL');
        $this->responseUrl = env('CARDZONE_RESPONSE_URL');
        $this->privateKeyPath = base_path('ssh-keygen/jariahfund-dev');
        $this->publicKeyPath = base_path('ssh-keygen/jariahfund-dev_public.pem');
        $this->debugService = new CardzoneDebugService();
    }

    /**
     * Loads the merchant's private key from the ssh-keygen folder.
     */
    public function getMerchantPrivateKey()
    {
        return file_get_contents($this->privateKeyPath);
    }

    /**
     * Loads the merchant's public key from the ssh-keygen folder.
     */
    public function getMerchantPublicKey()
    {
        return file_get_contents($this->publicKeyPath);
    }

    /**
     * Converts a raw/base64 public key to PEM format.
     */
    public function convertBase64ToPem($base64Key) {
        $pem = "-----BEGIN PUBLIC KEY-----\n";
        $pem .= chunk_split($base64Key, 64, "\n");
        $pem .= "-----END PUBLIC KEY-----\n";
        return $pem;
    }

    /**
     * Retrieves Cardzone's public key from the database (always PEM format).
     */
    public function getCardzonePublicKey()
    {
        $cardzoneKey = CardzoneKey::where('merchant_id', $this->merchantId)->first();
        if (!$cardzoneKey) return null;
        $key = $cardzoneKey->cardzone_public_key;
        // If already PEM, return as is; else convert
        if (strpos($key, '-----BEGIN PUBLIC KEY-----') !== false) {
            return $key;
        }
        return $this->convertBase64ToPem($key);
    }

    /**
     * Updates Cardzone's public key in the database and saves as PEM file for encryption use.
     */
    public function updateCardzonePublicKey($publicKey)
    {
        // If not PEM, convert
        if (strpos($publicKey, '-----BEGIN PUBLIC KEY-----') === false) {
            $publicKey = $this->convertBase64ToPem($publicKey);
        }
        CardzoneKey::updateOrCreate(
            ['merchant_id' => $this->merchantId],
            ['cardzone_public_key' => $publicKey]
        );
        // Also save to PEM file for encryption
        $pemPath = base_path('ssh-keygen/cardzone_public.pem');
        file_put_contents($pemPath, $publicKey);
    }

    /**
     * Generates a transaction ID matching the sample request format.
     * 
     * Sample Request Format:
     * - purchaseId: "6487047256" (10 digits)
     * - Format: Random 10 digits
     *
     * @param int|null $donationId Optional donation ID to use as base
     * @return string Transaction ID matching sample request format
     */
    public function generateTransactionId($donationId = null)
    {
        // Generate random 10 digits to match sample request format
        $transactionId = str_pad(mt_rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
        
        return $transactionId;
    }

    /**
     * Converts a PEM public key to the format required by Cardzone specification.
     */
    public function convertPublicKeyToBase64Url($pemPublicKey)
    {
        // Extract the raw key data from PEM format (392 chars as per spec)
        $key = str_replace(['-----BEGIN PUBLIC KEY-----', '-----END PUBLIC KEY-----', "\n", "\r"], '', $pemPublicKey);
        
        // Return the raw key data (not Base64 encoded) to meet the 392 character limit
        return $key;
    }

    /**
     * Performs the Key Exchange (MPIKeyReq) with Cardzone using the persistent key pair.
     */
    public function performKeyExchange($purchaseId)
    {
        // Debug logging
        $this->debugService->logTransaction($purchaseId, 'KEY_EXCHANGE_STARTED', [
            'merchant_id' => $this->merchantId,
            'url' => $this->keyExchangeUrl
        ], 'INFO');

        Log::info('Cardzone Key Exchange initiated', [
            'purchaseId' => $purchaseId,
            'merchantId' => $this->merchantId,
            'keyExchangeUrl' => $this->keyExchangeUrl
        ]);

        $privateKey = $this->getMerchantPrivateKey();
        $publicKey = $this->getMerchantPublicKey();
        $merchantPublicKeyBase64Url = $this->convertPublicKeyToBase64Url($publicKey);

        $payload = [
            'merchantId' => $this->merchantId,
            'purchaseId' => $purchaseId,
            'pubKey' => $merchantPublicKeyBase64Url,
        ];

        // MAC field is conditional - only include if merchant enrolls key exchange mac verification
        // For now, we'll try without MAC to see if it resolves the 201 error
        // $mac = $this->generateMacForKeyExchange($payload, $privateKey);
        // $payload['mac'] = $mac;


        // Log the complete request details
        Log::info('Cardzone Key Exchange Request Details', [
            'url' => $this->keyExchangeUrl,
            'method' => 'POST',
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],
            'payload' => [
                'merchantId' => $payload['merchantId'],
                'purchaseId' => $payload['purchaseId'],
                'pubKey_length' => strlen($payload['pubKey']),
                'pubKey_preview' => substr($payload['pubKey'], 0, 50) . '...'
            ],
            'timeout' => 30
        ]);

        // Debug service log for request
        $this->debugService->logTransaction($purchaseId, 'KEY_EXCHANGE_REQUEST', [
            'url' => $this->keyExchangeUrl,
            'method' => 'POST',
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],
            'payload' => [
                'merchantId' => $payload['merchantId'],
                'purchaseId' => $payload['purchaseId'],
                'pubKey_length' => strlen($payload['pubKey']),
                'pubKey_preview' => substr($payload['pubKey'], 0, 50) . '...'
            ],
            'timeout' => 30
        ], 'INFO');

        try {
            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30)->post($this->keyExchangeUrl, $payload);

            $result = $response->json();
            
            // Enhanced response logging
            $responseData = [
                'status' => $response->status(),
                'body' => $response->body(),
                'content_type' => $response->header('Content-Type'),
                'headers' => $response->headers(),
                'response_time' => $response->handlerStats()['total_time'] ?? 'N/A'
            ];
            
            // Log the complete response details
            Log::info('Cardzone Key Exchange Response Details', [
                'status_code' => $response->status(),
                'content_type' => $response->header('Content-Type'),
                'response_headers' => $response->headers(),
                'response_body' => $result,
                'response_length' => strlen($response->body()),
                'response_time' => $responseData['response_time']
            ]);

            // Debug service log for response
            $this->debugService->logTransaction($purchaseId, 'KEY_EXCHANGE_RESPONSE', [
                'status_code' => $response->status(),
                'content_type' => $response->header('Content-Type'),
                'response_headers' => $response->headers(),
                'response_body' => $result,
                'response_length' => strlen($response->body()),
                'response_time' => $responseData['response_time']
            ], 'INFO');
            
            $this->debugService->logKeyExchange($purchaseId, $this->keyExchangeUrl, $payload, $responseData, $response->status() === 200);

            Log::info('Cardzone Key Exchange response', ['response' => $result, 'status' => $response->status()]);

            if ($response->status() === 405) {
                $this->debugService->logError($purchaseId, 'Method not allowed', ['status' => $response->status()]);
                Log::error('Cardzone Key Exchange failed - Method not allowed', ['status' => $response->status()]);
                return ['success' => false, 'error' => 'API endpoint does not accept this request method', 'errorCode' => '405'];
            }
            if ($response->status() >= 400) {
                $this->debugService->logError($purchaseId, 'HTTP error', ['status' => $response->status(), 'body' => $response->body()]);
                Log::error('Cardzone Key Exchange failed - HTTP error', ['status' => $response->status(), 'body' => $response->body()]);
                return ['success' => false, 'error' => 'API endpoint returned HTTP error: ' . $response->status(), 'errorCode' => (string)$response->status()];
            }
            if (!$result) {
                $this->debugService->logError($purchaseId, 'Invalid response', ['response' => $result]);
                Log::error('Cardzone Key Exchange failed - Invalid response', ['response' => $result]);
                return ['success' => false, 'error' => 'Invalid response from Cardzone API'];
            }
            $isSuccess = false;
            if (isset($result['errorCode']) && $result['errorCode'] === '000') {
                $isSuccess = true;
            } elseif (isset($result['responseCode']) && $result['responseCode'] === '000') {
                $isSuccess = true;
            } elseif (isset($result['status']) && $result['status'] === 'success') {
                $isSuccess = true;
            }
            if (isset($result['errorCode']) && $result['errorCode'] !== '000') {
                $this->debugService->logTransaction($purchaseId, 'KEY_EXCHANGE_WARNING', [
                    'error_code' => $result['errorCode'],
                    'error_description' => $result['errorDescription'] ?? 'No description'
                ], 'WARNING');
                Log::warning('Cardzone Key Exchange returned error code', [
                    'errorCode' => $result['errorCode'],
                    'errorDescription' => $result['errorDescription'] ?? 'No description',
                    'purchaseId' => $purchaseId
                ]);
            }
            if ($isSuccess && isset($result['pubKey'])) {
                $this->updateCardzonePublicKey($result['pubKey']);
                $this->debugService->logSuccess($purchaseId, 'KEY_EXCHANGE_SUCCESS', [
                    'cardzone_public_key_length' => strlen($result['pubKey'])
                ]);
                Log::info('Cardzone Key Exchange successful.', ['purchaseId' => $purchaseId]);
                return ['success' => true, 'cardzonePublicKey' => $result['pubKey'], 'merchantPrivateKey' => $privateKey];
            } else {
                $errorMessage = $result['errorDesc'] ?? $result['errorMessage'] ?? $result['message'] ?? 'Unknown error';
                $errorCode = $result['errorCode'] ?? $result['responseCode'] ?? 'N/A';
                $this->debugService->logError($purchaseId, $errorMessage, ['error_code' => $errorCode, 'response' => $result]);
                Log::error('Cardzone Key Exchange failed.', ['response' => $result, 'errorCode' => $errorCode]);
                return ['success' => false, 'error' => $errorMessage, 'errorCode' => $errorCode];
            }
        } catch (\Exception $e) {
            $this->debugService->logError($purchaseId, 'Network error', ['error' => $e->getMessage()]);
            Log::error('Cardzone Key Exchange network error.', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return ['success' => false, 'error' => 'Network error during key exchange: ' . $e->getMessage()];
        }
    }

    /**
     * Generates the MAC for the key exchange payload.
     * This uses YOUR merchant's PRIVATE KEY.
     * The field order for MAC generation must match Cardzone's key exchange specification.
     */
    public function generateMacForKeyExchange(array $data, $privateKey)
    {
        // For key exchange, the MAC is generated from the concatenation of:
        // merchantId + purchaseId + pubKey (in this order)
        $macString = '';
        $macString .= $data['merchantId'] ?? '';
        $macString .= $data['purchaseId'] ?? '';
        $macString .= $data['pubKey'] ?? '';

        // Sign the string with your private key
        $signature = '';
        if (!openssl_sign($macString, $signature, $privateKey, OPENSSL_ALGO_SHA256)) {
            Log::error('Failed to sign key exchange MAC string.', ['macString' => $macString, 'error' => openssl_error_string()]);
            throw new \Exception('Key exchange MAC signing failed.');
        }

        // Base64Url encode the signature
        return rtrim(strtr(base64_encode($signature), '+/', '-_'), '=');
    }

    /**
     * Generates the MPI_MAC for the MPIReq payload.
     * This uses YOUR merchant's PRIVATE KEY.
     * The field order for MAC generation is CRITICAL and must match Cardzone's spec.
     */
    public function generateMacForMPIReq(array $data, $privateKey)
    {
        // Strict Cardzone field order for MPI_MAC (35 fields)
        $fields = [
            'MPI_TRANS_TYPE',
            'MPI_MERC_ID',
            'MPI_PAN',
            'MPI_CARD_HOLDER_NAME',
            'MPI_PAN_EXP',
            'MPI_CVV2',
            'MPI_TRXN_ID',
            'MPI_ORI_TRXN_ID',
            'MPI_PURCH_DATE',
            'MPI_PURCH_CURR',
            'MPI_PURCH_AMT',
            'MPI_ADDR_MATCH',
            'MPI_BILL_ADDR_CITY',
            'MPI_BILL_ADDR_STATE',
            'MPI_BILL_ADDR_CNTRY',
            'MPI_BILL_ADDR_POSTCODE',
            'MPI_BILL_ADDR_LINE1',
            'MPI_BILL_ADDR_LINE2',
            'MPI_BILL_ADDR_LINE3',
            'MPI_SHIP_ADDR_CITY',
            'MPI_SHIP_ADDR_STATE',
            'MPI_SHIP_ADDR_CNTRY',
            'MPI_SHIP_ADDR_POSTCODE',
            'MPI_SHIP_ADDR_LINE1',
            'MPI_SHIP_ADDR_LINE2',
            'MPI_SHIP_ADDR_LINE3',
            'MPI_EMAIL',
            'MPI_HOME_PHONE',
            'MPI_HOME_PHONE_CC',
            'MPI_WORK_PHONE',
            'MPI_WORK_PHONE_CC',
            'MPI_MOBILE_PHONE',
            'MPI_MOBILE_PHONE_CC',
            // MPI_LINE_ITEM (repeat subfields as necessary)
            // For simplicity, concatenate all line items in order (if present)
            'MPI_LINE_ITEM',
            'MPI_RESPONSE_TYPE',
        ];
        $macString = '';
        foreach ($fields as $field) {
            if ($field === 'MPI_LINE_ITEM' && isset($data['MPI_LINE_ITEM']) && is_array($data['MPI_LINE_ITEM'])) {
                foreach ($data['MPI_LINE_ITEM'] as $item) {
                    $macString .= $item['MPI_ITEM_ID'] ?? '';
                    $macString .= $item['MPI_ITEM_REMARK'] ?? '';
                    $macString .= $item['MPI_ITEM_QUANTITY'] ?? '';
                    $macString .= $item['MPI_ITEM_AMOUNT'] ?? '';
                    $macString .= $item['MPI_ITEM_CURRENC'] ?? '';
                }
            } else {
                $macString .= $data[$field] ?? '';
            }
        }
        // Sign the string with your private key
        $signature = '';
        if (!openssl_sign($macString, $signature, $privateKey, OPENSSL_ALGO_SHA256)) {
            Log::error('Failed to sign MAC string.', ['macString' => $macString, 'error' => openssl_error_string()]);
            throw new \Exception('MAC signing failed.');
        }
        // Base64Url encode the signature
        return rtrim(strtr(base64_encode($signature), '+/', '-_'), '=');
    }

    /**
     * Generates the MPI_MAC for the MPIReqOBW payload.
     * This uses YOUR merchant's PRIVATE KEY.
     * The field order for MAC generation is CRITICAL and must match Cardzone's spec.
     */
    public function generateMacForMPIReqOBW(array $data, $privateKey)
    {
        // IMPORTANT: The order of concatenation for MAC generation MUST precisely match
        // the specification provided by Cardzone for MPIReqOBW.
        // Refer to your BMMB-Cardzone 3DS Merchant Interface_v2.9.pdf for exact order (Section 5.8.1.7)
        $macString = '';
        $macString .= $data['MPI_CHANNEL_CODE'] ?? '';
        $macString .= $data['MPI_MERC_ID'] ?? '';
        $macString .= $data['MPI_TRXN_ID'] ?? '';
        $macString .= $data['MPI_TRANS_TYPE'] ?? '';
        $macString .= $data['MPI_PURCH_AMT'] ?? '';
        $macString .= $data['MPI_PURCH_CURR'] ?? '';
        $macString .= $data['MPI_SELECTED_BANK'] ?? '';
        $macString .= $data['MPI_CUST_BANK_TYPE'] ?? '';
        $macString .= $data['MPI_CUST_NAME'] ?? '';
        $macString .= $data['MPI_MER_IP'] ?? '';
        $macString .= $data['MPI_MER_NAME'] ?? '';
        $macString .= $data['MPI_PURCH_DATE'] ?? '';
        $macString .= $data['MPI_PYMT_DESC'] ?? '';
        $macString .= $data['MPI_RCP_REF'] ?? '';

        $signature = '';
        if (!openssl_sign($macString, $signature, $privateKey, OPENSSL_ALGO_SHA256)) {
            Log::error('Failed to sign OBW MAC string.', ['macString' => $macString, 'error' => openssl_error_string()]);
            throw new \Exception('OBW MAC signing failed.');
        }
        return rtrim(strtr(base64_encode($signature), '+/', '-_'), '=');
    }

    /**
     * Generates the MPI_MAC for the MPIReqQr payload.
     * This uses YOUR merchant's PRIVATE KEY.
     * The field order for MAC generation is CRITICAL and must match Cardzone's spec.
     */
    public function generateMacForMPIReqQr(array $data, $privateKey)
    {
        // IMPORTANT: The order of concatenation for MAC generation MUST precisely match
        // the specification provided by Cardzone for MPIReqQr.
        // Refer to your BMMB-Cardzone 3DS Merchant Interface_v2.9.pdf for exact order.
        $macString = '';
        $macString .= $data['MPI_CHANNEL_CODE'] ?? '';
        $macString .= $data['MPI_MERC_ID'] ?? '';
        $macString .= $data['MPI_TRXN_ID'] ?? '';
        $macString .= $data['MPI_TRANS_TYPE'] ?? '';
        $macString .= $data['MPI_PURCH_AMT'] ?? '';
        $macString .= $data['MPI_PURCH_CURR'] ?? '';
        // Add other fields relevant to MPIReqQr in their specified order:
        $macString .= $data['MPI_MER_IP'] ?? '';
        $macString .= $data['MPI_MER_NAME'] ?? '';
        $macString .= $data['MPI_PURCH_DATE'] ?? '';
        $macString .= $data['MPI_PYMT_DESC'] ?? '';
        $macString .= $data['MPI_QR_TYPE'] ?? ''; // If you specify QR type (e.g., 'STRING')

        $signature = '';
        if (!openssl_sign($macString, $signature, $privateKey, OPENSSL_ALGO_SHA256)) {
            Log::error('Failed to sign QR MAC string.', ['macString' => $macString, 'error' => openssl_error_string()]);
            throw new \Exception('QR MAC signing failed.');
        }
        return rtrim(strtr(base64_encode($signature), '+/', '-_'), '=');
    }

    /**
     * Verifies the MPI_MAC received in MPIRes callback.
     * This uses Cardzone's PUBLIC KEY (obtained during key exchange).
     */
    public function verifyMacForMPIRes(array $data, $cardzonePublicKey, $receivedMac)
    {
        // IMPORTANT: The order of concatenation for MAC verification MUST precisely match
        // the specification provided by Cardzone for MPIRes.
        // Refer to your BMMB-Cardzone 3DS Merchant Interface_v2.9.pdf for exact order.
        $macString = '';
        $macString .= $data['MPI_TRXN_ID'] ?? '';
        $macString .= $data['MPI_MERC_ID'] ?? '';
        $macString .= $data['MPI_TRANS_TYPE'] ?? '';
        $macString .= $data['MPI_TRANS_STATUS'] ?? '';
        $macString .= $data['authenticationValue'] ?? '';
        $macString .= $data['eci'] ?? '';
        $macString .= $data['MPI_PURCH_AMT'] ?? '';
        $macString .= $data['MPI_PURCH_CURR'] ?? '';
        $macString .= $data['MPI_PURCH_DATE'] ?? '';
        $macString .= $data['errorDesc'] ?? ''; // Include errorDesc if present in MAC calculation

        // Decode the received MAC from Base64Url
        $decodedMac = base64_decode(strtr($receivedMac, '-_', '+/'));

        // Verify the signature
        $result = openssl_verify($macString, $decodedMac, $cardzonePublicKey, OPENSSL_ALGO_SHA256);

        if ($result === -1) {
            Log::error('OpenSSL verification error.', ['error' => openssl_error_string()]);
            return false;
        }
        return (bool) $result;
    }

    /**
     * Encrypts data using Cardzone's public key (RSA-OAEP).
     * This is typically used for sensitive fields like PAN, CVV.
     */
    public function encryptData($data, $cardzonePublicKey)
    {
        $encrypted = '';
        if (!openssl_public_encrypt($data, $encrypted, $cardzonePublicKey, OPENSSL_PKCS1_OAEP_PADDING)) {
            Log::error('Failed to encrypt data.', ['error' => openssl_error_string()]);
            throw new \Exception('Data encryption failed.');
        }
        return base64_encode($encrypted); // Cardzone expects Base64 for encrypted fields
    }

    /**
     * Fetches the list of available banks for FPX Online Banking from Cardzone API.
     * This method performs a Key Exchange first, then requests the bank list.
     * 
     * @return array|false Returns bank list array on success, false on failure
     */
    public function getBankList()
    {
        try {
            // First, perform key exchange to get Cardzone's public key
            $transactionId = $this->generateTransactionId(); // Format: BANK202507151234567890ABCDEF
            $keyExchangeResult = $this->performKeyExchange($transactionId);
            
            if (!$keyExchangeResult['success']) {
                Log::error('Key exchange failed for bank list request', ['error' => $keyExchangeResult['error']]);
                return false;
            }
            
            $merchantPrivateKey = $keyExchangeResult['merchantPrivateKey'];
            
            // Prepare MPIReqOBW request for bank list
            $mpiReqData = [
                'MPI_CHANNEL_CODE' => 'BW',
                'MPI_MERC_ID' => $this->merchantId,
                'MPI_TRXN_ID' => $transactionId,
                'MPI_TRANS_TYPE' => 'OBWBANKLIST', // Special transaction type for bank list
                'MPI_PURCH_AMT' => '0', // No amount for bank list request
                'MPI_PURCH_CURR' => '458', // MYR
                'MPI_SELECTED_BANK' => '', // Empty for bank list request
                'MPI_CUST_BANK_TYPE' => 'RET', // Retail banking
                'MPI_CUST_NAME' => 'Bank List Request',
                'MPI_MER_IP' => '127.0.0.1',
                'MPI_MER_NAME' => 'Test Merchant',
                'MPI_PURCH_DATE' => now()->format('YmdHis'),
                'MPI_PYMT_DESC' => 'Bank List Request',
                'MPI_RCP_REF' => 'BANKLIST' . substr($transactionId, -6), // Use last 6 chars for reference
            ];
            
            // Generate MAC for the request
            $mpiReqData['MPI_MAC'] = $this->generateMacForMPIReqOBW($mpiReqData, $merchantPrivateKey);
            
            // Make the API call to Cardzone
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($this->obwUrl, $mpiReqData);
            
            $result = $response->json();
            
            Log::info('Bank list API response', [
                'status' => $response->status(),
                'response' => $result,
                'transactionId' => $transactionId
            ]);
            
            // Check if response contains bank list
            if ($result && isset($result['banks']) && is_array($result['banks'])) {
                Log::info('Bank list fetched successfully from Cardzone', ['count' => count($result['banks'])]);
                return $result['banks'];
            } elseif ($result && isset($result['MPI_ERROR_CODE']) && $result['MPI_ERROR_CODE'] === '000') {
                // Success response but no banks array - might be in different format
                if (isset($result['bankList']) && is_array($result['bankList'])) {
                    Log::info('Bank list fetched successfully from Cardzone (bankList format)', ['count' => count($result['bankList'])]);
                    return $result['bankList'];
                }
            }
            
            // If we get here, the response format is unexpected
            Log::warning('Bank list API returned unexpected format', ['response' => $result]);
            return false;
            
        } catch (\Exception $e) {
            Log::error('Error fetching bank list from Cardzone', ['error' => $e->getMessage()]);
            return false;
        }
    }
} 