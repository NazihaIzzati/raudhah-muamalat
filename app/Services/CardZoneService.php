<?php

namespace App\Services;

use App\Services\CardzoneDebugService;
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
        $this->privateKeyPath = base_path('storage/keys/cardzone/merchant_private.key');
        $this->publicKeyPath = base_path('storage/keys/cardzone/merchant_public.pem');
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
        $pemPath = base_path('storage/keys/cardzone/cardzone_public.pem');
        file_put_contents($pemPath, $publicKey);
    }

    /**
     * Converts a Base64Url or Base64 public key to PEM format and saves it for Cardzone encryption.
     * Call this after a successful key exchange.
     *
     * @param string $base64urlKey The pubKey from Cardzone key exchange response.
     * @param string|null $pemPath The path to save the PEM file (default: ssh-keygen/cardzone_public.pem).
     * @return string The PEM-formatted public key.
     */
    public function saveCardzonePublicKeyPem($base64urlKey, $pemPath = null)
    {
        // Convert Base64Url to Base64 if needed
        $base64 = strtr($base64urlKey, '-_', '+/');
        $pad = strlen($base64) % 4;
        if ($pad > 0) {
            $base64 .= str_repeat('=', 4 - $pad);
        }
        // Convert to PEM format
        $pem = "-----BEGIN PUBLIC KEY-----\n";
        $pem .= chunk_split($base64, 64, "\n");
        $pem .= "-----END PUBLIC KEY-----\n";
        // Save to file
        if (!$pemPath) {
            $pemPath = base_path('storage/keys/cardzone/cardzone_public.pem');
        }
        file_put_contents($pemPath, $pem);
        return $pem;
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
        // Generate 20-digit transaction ID as per Cardzone documentation
        $timestampPart = substr(strval(time()), -10); // last 10 digits of timestamp
        $randomPart = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT); // 6 random digits
        $donationPart = str_pad($donationId ?? mt_rand(100, 999), 4, '0', STR_PAD_LEFT); // 4 digits for donation ID
        $transactionId = $timestampPart . $randomPart . $donationPart;
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
     * Format the entire payload according to Cardzone specifications
     * This ensures the payload sent to Cardzone matches the MAC generation
     * 
     * @param array $payload The payload to format
     * @return array Formatted payload
     */
    public function formatPayloadForCardzone(array $payload)
    {
        // Cardzone field specifications with proper formatting
        $fieldSpecs = [
            'MPI_TRANS_TYPE' => 'AN(10)',
            'MPI_MERC_ID' => 'N(15)',
            'MPI_PAN' => 'N(19)',
            'MPI_CARD_HOLDER_NAME' => 'A(45)',
            'MPI_PAN_EXP' => 'N(4)',
            'MPI_CVV2' => 'N(3)',
            'MPI_TRXN_ID' => 'N(20)',
            'MPI_ORI_TRXN_ID' => 'N(20)',
            'MPI_PURCH_DATE' => 'N(14)',
            'MPI_PURCH_CURR' => 'N(3)',
            'MPI_PURCH_AMT' => 'N(12)',
            'MPI_ADDR_MATCH' => 'A(1)',
            'MPI_BILL_ADDR_CITY' => 'AN(50)',
            'MPI_BILL_ADDR_STATE' => 'AN(3)',
            'MPI_BILL_ADDR_CNTRY' => 'AN(3)',
            'MPI_BILL_ADDR_POSTCODE' => 'AN(16)',
            'MPI_BILL_ADDR_LINE1' => 'AN(50)',
            'MPI_BILL_ADDR_LINE2' => 'AN(50)',
            'MPI_BILL_ADDR_LINE3' => 'AN(50)',
            'MPI_SHIP_ADDR_CITY' => 'AN(50)',
            'MPI_SHIP_ADDR_STATE' => 'AN(3)',
            'MPI_SHIP_ADDR_CNTRY' => 'AN(3)',
            'MPI_SHIP_ADDR_POSTCODE' => 'AN(16)',
            'MPI_SHIP_ADDR_LINE1' => 'AN(50)',
            'MPI_SHIP_ADDR_LINE2' => 'AN(50)',
            'MPI_SHIP_ADDR_LINE3' => 'AN(50)',
            'MPI_EMAIL' => 'AN(254)',
            'MPI_HOME_PHONE' => 'AN(15)',
            'MPI_HOME_PHONE_CC' => 'N(3)',
            'MPI_WORK_PHONE' => 'AN(15)',
            'MPI_WORK_PHONE_CC' => 'N(3)',
            'MPI_MOBILE_PHONE' => 'AN(15)',
            'MPI_MOBILE_PHONE_CC' => 'N(3)',
            'MPI_LINE_ITEM' => 'AN',
            'MPI_RESPONSE_TYPE' => 'AN',
        ];

        $formattedPayload = [];
        
        // Format each field according to its specification
        foreach ($fieldSpecs as $field => $type) {
            $value = $payload[$field] ?? '';
            $formattedPayload[$field] = $this->formatFieldValue($value, $type, $field);
        }
        
        // Note: panRef, cardNo, cardExpiryDate are NOT included in payload to avoid MAC verification issues
        
        return $formattedPayload;
    }

    /**
     * Formats the payload for Cardzone with proper field padding (same as MAC generation).
     * This ensures the payload sent to Cardzone matches the MAC generation string.
     */
    public function formatPayloadForCardzoneWithProperPadding(array $payload)
    {
        // Cardzone field specifications with proper formatting - Official order
        // Based on documentation: MPIReq – Request Form Fields
        $fieldSpecs = [
            'MPI_TRANS_TYPE' => 'AN(10)',
            'MPI_MERC_ID' => 'N(15)',
            'MPI_PAN' => 'N(19)',
            'MPI_CARD_HOLDER_NAME' => 'A(45)',
            'MPI_PAN_EXP' => 'N(4)',
            'MPI_CVV2' => 'N(3)',
            'MPI_TRXN_ID' => 'N(20)',
            'MPI_ORI_TRXN_ID' => 'N(20)',
            'MPI_PURCH_DATE' => 'N(14)',
            'MPI_PURCH_CURR' => 'N(3)',
            'MPI_PURCH_AMT' => 'N(12)',
            'MPI_ADDR_MATCH' => 'A(1)',
            'MPI_BILL_ADDR_CITY' => 'AN(50)',
            'MPI_BILL_ADDR_STATE' => 'AN(3)',
            'MPI_BILL_ADDR_CNTRY' => 'N(3)',
            'MPI_BILL_ADDR_POSTCODE' => 'N(16)',
            'MPI_BILL_ADDR_LINE1' => 'AN(50)',
            'MPI_BILL_ADDR_LINE2' => 'AN(50)',
            'MPI_BILL_ADDR_LINE3' => 'AN(50)',
            'MPI_SHIP_ADDR_CITY' => 'AN(50)',
            'MPI_SHIP_ADDR_STATE' => 'AN(3)',
            'MPI_SHIP_ADDR_CNTRY' => 'AN(3)',
            'MPI_SHIP_ADDR_POSTCODE' => 'AN(16)',
            'MPI_SHIP_ADDR_LINE1' => 'AN(50)',
            'MPI_SHIP_ADDR_LINE2' => 'AN(50)',
            'MPI_SHIP_ADDR_LINE3' => 'AN(50)',
            'MPI_EMAIL' => 'AN(254)',
            'MPI_HOME_PHONE' => 'AN(15)',
            'MPI_HOME_PHONE_CC' => 'N(3)',
            'MPI_WORK_PHONE' => 'AN(15)',
            'MPI_WORK_PHONE_CC' => 'N(3)',
            'MPI_MOBILE_PHONE' => 'AN(15)',
            'MPI_MOBILE_PHONE_CC' => 'N(3)',
            'MPI_LINE_ITEM' => 'AN',
            'MPI_RESPONSE_TYPE' => 'AN',
        ];
        
        $formattedPayload = [];
        
        // Format each field according to Cardzone specifications
        foreach ($fieldSpecs as $field => $type) {
            // Only process fields that exist in the input payload
            if (!array_key_exists($field, $payload)) {
                continue;
            }
            
            $value = $payload[$field];
            
            // Extract type and length from format like 'N(12)' or 'A(45)' or 'AN(10)'
            if (preg_match('/^([AN]+)(?:\((\d+)\))?$/', $type, $matches)) {
                $dataType = $matches[1];
                $length = isset($matches[2]) ? (int)$matches[2] : 0;
            } else {
                $formattedPayload[$field] = $value;
                continue;
            }
            
            // Handle empty values - return empty string for all empty fields
            if (empty($value)) {
                $formattedValue = ''; // Return empty string for all empty fields
            } else {
                // Special handling for email field - no padding
                if ($field === 'MPI_EMAIL') {
                    $formattedValue = $value; // Use plain value without padding for email
                } else {
                    // Format based on data type with proper padding as per requirement document
                    switch ($dataType) {
                        case 'N': // Numeric - pad with leading zeros to full length
                            $cleanValue = ltrim($value, '0');
                            if (empty($cleanValue)) {
                                $cleanValue = '0'; // Keep at least one zero if original was all zeros
                            }
                            // Pad with leading zeros to full length
                            $formattedValue = str_pad($cleanValue, $length, '0', STR_PAD_LEFT);
                            break;
                        case 'A': // Alphabetic - pad with spaces to full length
                            $formattedValue = str_pad($value, $length, ' ', STR_PAD_RIGHT);
                            break;
                        case 'AN': // Alphanumeric - pad with spaces to full length
                            $formattedValue = str_pad($value, $length, ' ', STR_PAD_RIGHT);
                            break;
                        default:
                            $formattedValue = $value;
                    }
                }
            }
            
            $formattedPayload[$field] = $formattedValue;
        }
        
        // Add any additional fields that are not in the specs (like plain text fields)
        foreach ($payload as $field => $value) {
            if (!isset($fieldSpecs[$field])) {
                $formattedPayload[$field] = $value;
            }
        }
        
        // Ensure all fields from fieldSpecs are present in the formatted payload
        // This is crucial for MAC generation consistency
        foreach ($fieldSpecs as $field => $type) {
            if (!isset($formattedPayload[$field])) {
                $formattedPayload[$field] = '';
            }
        }
        
        return $formattedPayload;
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
                $this->saveCardzonePublicKeyPem($result['pubKey']); // Save the key after successful exchange
                $this->debugService->logSuccess($purchaseId, 'KEY_EXCHANGE_SUCCESS', [
                    'cardzone_public_key_length' => strlen($result['pubKey'])
                ]);
                Log::info('Cardzone Key Exchange successful.', ['purchaseId' => $purchaseId]);
                return [
                    'success' => true, 
                    'cardzonePublicKey' => $result['pubKey'], 
                    'merchantPrivateKey' => $privateKey,
                    'purchaseId' => $result['purchaseId'] ?? $purchaseId // Return the purchase ID from Cardzone response
                ];
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

        // Base64 encode the signature (Cardzone requires standard Base64)
        return base64_encode($signature);
    }

    /**
     * Format field value according to Cardzone specifications
     * 
     * @param string $value The field value
     * @param string $type The field type (A, N, AN) with length
     * @return string Formatted field value
     */
    private function formatFieldValue($value, $type, $fieldName = '')
    {
        // Extract type and length from format like 'N(12)' or 'A(45)' or 'AN(10)'
        if (preg_match('/^([AN]+)(?:\((\d+)\))?$/', $type, $matches)) {
            $dataType = $matches[1];
            $length = isset($matches[2]) ? (int)$matches[2] : 0;
        } else {
            // Default to string if type is not recognized
            return $value;
        }
        
        // Special handling for amount field - return original value without padding
        if ($fieldName === 'MPI_PURCH_AMT') {
            return $value; // Return amount as-is without padding
        }
        
        // Handle empty values - return empty string for all empty fields
        if (empty($value)) {
            return ''; // Return empty string for all empty fields
        }
        
        // Format based on data type with minimal padding
        switch ($dataType) {
            case 'N': // Numeric - right justified with minimal leading zeros
                return str_pad($value, $length, '0', STR_PAD_LEFT);
            case 'A': // Alphabetic - left justified with minimal trailing spaces
            case 'AN': // Alphanumeric - left justified with minimal trailing spaces
                return str_pad($value, $length, ' ', STR_PAD_RIGHT);
            default:
                return $value;
        }
    }

    /**
     * Generates the MPI_MAC for the MPIReq payload.
     * This uses YOUR merchant's PRIVATE KEY.
     * The field order for MAC generation is CRITICAL and must match Cardzone's spec.
     */
    public function generateMacForMPIReq(array $data, $privateKey)
    {
        // IMPORTANT: The order of concatenation for MAC generation MUST precisely match
        // the specification provided by Cardzone for MPIReq.
        // Based on documentation: 5.6.2 MPI_MAC (MPIReq) - 35 fields in exact order
        $macString = '';
        
        // Build MAC string in exact order as per documentation
        $macString .= $data['MPI_TRANS_TYPE'] ?? '';
        $macString .= $data['MPI_MERC_ID'] ?? '';
        $macString .= $data['MPI_PAN'] ?? '';
        $macString .= $data['MPI_CARD_HOLDER_NAME'] ?? '';
        $macString .= $data['MPI_PAN_EXP'] ?? '';
        $macString .= $data['MPI_CVV2'] ?? '';
        $macString .= $data['MPI_TRXN_ID'] ?? '';
        $macString .= $data['MPI_ORI_TRXN_ID'] ?? '';
        $macString .= $data['MPI_PURCH_DATE'] ?? '';
        $macString .= $data['MPI_PURCH_CURR'] ?? '';
        $macString .= $data['MPI_PURCH_AMT'] ?? '';
        $macString .= $data['MPI_ADDR_MATCH'] ?? '';
        $macString .= $data['MPI_BILL_ADDR_CITY'] ?? '';
        $macString .= $data['MPI_BILL_ADDR_STATE'] ?? '';
        $macString .= $data['MPI_BILL_ADDR_CNTRY'] ?? '';
        $macString .= $data['MPI_BILL_ADDR_POSTCODE'] ?? '';
        $macString .= $data['MPI_BILL_ADDR_LINE1'] ?? '';
        $macString .= $data['MPI_BILL_ADDR_LINE2'] ?? '';
        $macString .= $data['MPI_BILL_ADDR_LINE3'] ?? '';
        $macString .= $data['MPI_SHIP_ADDR_CITY'] ?? '';
        $macString .= $data['MPI_SHIP_ADDR_STATE'] ?? '';
        $macString .= $data['MPI_SHIP_ADDR_CNTRY'] ?? '';
        $macString .= $data['MPI_SHIP_ADDR_POSTCODE'] ?? '';
        $macString .= $data['MPI_SHIP_ADDR_LINE1'] ?? '';
        $macString .= $data['MPI_SHIP_ADDR_LINE2'] ?? '';
        $macString .= $data['MPI_SHIP_ADDR_LINE3'] ?? '';
        $macString .= $data['MPI_EMAIL'] ?? '';
        $macString .= $data['MPI_HOME_PHONE'] ?? '';
        $macString .= $data['MPI_HOME_PHONE_CC'] ?? '';
        $macString .= $data['MPI_WORK_PHONE'] ?? '';
        $macString .= $data['MPI_WORK_PHONE_CC'] ?? '';
        $macString .= $data['MPI_MOBILE_PHONE'] ?? '';
        $macString .= $data['MPI_MOBILE_PHONE_CC'] ?? '';
        $macString .= $data['MPI_LINE_ITEM'] ?? '';
        $macString .= $data['MPI_RESPONSE_TYPE'] ?? '';
        
        // Generate MAC using RSA-SHA256
        $signature = '';
        if (!openssl_sign($macString, $signature, $privateKey, OPENSSL_ALGO_SHA256)) {
            Log::error('Failed to generate MAC signature.', ['error' => openssl_error_string()]);
            throw new \Exception('MAC generation failed.');
        }
        
        // Convert to Base64 format (Cardzone requires standard Base64, not Base64URL)
        return base64_encode($signature);
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
        return base64_encode($signature);
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
        return base64_encode($signature);
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
        // Convert to Base64URL format as expected by Cardzone
        return rtrim(strtr(base64_encode($encrypted), '+/', '-_'), '=');
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

    /**
     * Generates the MPI_MAC for the MPIReq payload with proper field padding.
     * This uses YOUR merchant's PRIVATE KEY.
     * The field order for MAC generation is CRITICAL and must match Cardzone's spec.
     */
    public function generateMacForMPIReqWithProperPadding(array $data, $privateKey)
    {
        // Cardzone field specifications with proper formatting - Official order
        // Transaction data first, then card data, then address data
        $fieldSpecs = [
            'MPI_TRANS_TYPE' => 'AN(10)',
            'MPI_MERC_ID' => 'N(15)',
            'MPI_PURCH_AMT' => 'N(12)',
            'MPI_PURCH_CURR' => 'N(3)',
            'MPI_TRXN_ID' => 'N(20)',
            'MPI_PURCH_DATE' => 'N(14)',
            'MPI_PAN' => 'N(19)',
            'MPI_CARD_HOLDER_NAME' => 'A(45)',
            'MPI_PAN_EXP' => 'N(4)',
            'MPI_CVV2' => 'N(3)',
            'MPI_ORI_TRXN_ID' => 'N(20)',
            'MPI_ADDR_MATCH' => 'A(1)',
            'MPI_BILL_ADDR_CITY' => 'AN(50)',
            'MPI_BILL_ADDR_STATE' => 'AN(3)',
            'MPI_BILL_ADDR_CNTRY' => 'N(3)',
            'MPI_BILL_ADDR_POSTCODE' => 'N(16)',
            'MPI_BILL_ADDR_LINE1' => 'AN(50)',
            'MPI_BILL_ADDR_LINE2' => 'AN(50)',
            'MPI_BILL_ADDR_LINE3' => 'AN(50)',
            'MPI_SHIP_ADDR_CITY' => 'AN(50)',
            'MPI_SHIP_ADDR_STATE' => 'AN(3)',
            'MPI_SHIP_ADDR_CNTRY' => 'AN(3)',
            'MPI_SHIP_ADDR_POSTCODE' => 'AN(16)',
            'MPI_SHIP_ADDR_LINE1' => 'AN(50)',
            'MPI_SHIP_ADDR_LINE2' => 'AN(50)',
            'MPI_SHIP_ADDR_LINE3' => 'AN(50)',
            'MPI_EMAIL' => 'AN(254)',
            'MPI_HOME_PHONE' => 'AN(15)',
            'MPI_HOME_PHONE_CC' => 'N(3)',
            'MPI_WORK_PHONE' => 'AN(15)',
            'MPI_WORK_PHONE_CC' => 'N(3)',
            'MPI_MOBILE_PHONE' => 'AN(15)',
            'MPI_MOBILE_PHONE_CC' => 'N(3)',
            'MPI_LINE_ITEM' => 'AN',
            'MPI_RESPONSE_TYPE' => 'AN',
        ];
        
        $macString = '';
        
        // Build MAC string with already formatted fields (no double formatting)
        foreach ($fieldSpecs as $field => $type) {
            $value = $data[$field] ?? '';
            // Use the value as-is since it's already formatted
            $macString .= $value;
        }
        
        // Log the MAC string for debugging (without sensitive data)
        Log::info('MAC generation string', [
            'macStringLength' => strlen($macString),
            'macStringPreview' => substr($macString, 0, 100) . '...'
        ]);
        
        // Generate MAC using RSA-SHA256
        $signature = '';
        if (!openssl_sign($macString, $signature, $privateKey, OPENSSL_ALGO_SHA256)) {
            Log::error('Failed to generate MAC signature.', ['error' => openssl_error_string()]);
            throw new \Exception('MAC generation failed.');
        }
        
        // Convert to Base64 format (Cardzone requires standard Base64)
        $mac = base64_encode($signature);
        
        Log::info('MAC generated successfully', [
            'macLength' => strlen($mac),
            'macPreview' => substr($mac, 0, 50) . '...'
        ]);
        
        return $mac;
    }
} 