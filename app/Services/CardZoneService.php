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
     * Retrieves Cardzone's public key from the database.
     */
    public function getCardzonePublicKey()
    {
        $cardzoneKey = CardzoneKey::where('merchant_id', $this->merchantId)->first();
        return $cardzoneKey ? $cardzoneKey->cardzone_public_key : null;
    }

    /**
     * Updates Cardzone's public key in the database.
     */
    public function updateCardzonePublicKey($publicKey)
    {
        CardzoneKey::updateOrCreate(
            ['merchant_id' => $this->merchantId],
            ['cardzone_public_key' => $publicKey]
        );
    }

    /**
     * Generates a 10-digit numeric transaction ID for Cardzone.
     *
     * @param int|null $donationId Optional donation ID to use as base
     * @return string 10-digit numeric transaction ID
     */
    public function generateTransactionId($donationId = null)
    {
        $base = $donationId ?: time();
        $numericId = abs(crc32($base . microtime(true)));
        $transactionId = str_pad(substr($numericId, -9), 10, '0', STR_PAD_LEFT);
        if (strlen($transactionId) > 10) {
            $transactionId = substr($transactionId, -10);
        }
        return $transactionId;
    }

    /**
     * Converts a PEM public key to Base64Url format for Cardzone.
     */
    public function convertPublicKeyToBase64Url($pemPublicKey)
    {
        $key = str_replace(['-----BEGIN PUBLIC KEY-----', '-----END PUBLIC KEY-----', "\n"], '', $pemPublicKey);
        return rtrim(strtr(base64_encode($key), '+/', '-_'), '=');
    }

    /**
     * Performs the Key Exchange (MPIKeyReq) with Cardzone using the persistent key pair.
     */
    public function performKeyExchange($purchaseId)
    {
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
            'version' => '2.9',
        ];

        try {
            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30)->post($this->keyExchangeUrl, $payload);

            $result = $response->json();
            Log::info('Cardzone Key Exchange response', ['response' => $result, 'status' => $response->status()]);

            if ($response->status() === 405) {
                Log::error('Cardzone Key Exchange failed - Method not allowed', ['status' => $response->status()]);
                return ['success' => false, 'error' => 'API endpoint does not accept this request method', 'errorCode' => '405'];
            }
            if ($response->status() >= 400) {
                Log::error('Cardzone Key Exchange failed - HTTP error', ['status' => $response->status(), 'body' => $response->body()]);
                return ['success' => false, 'error' => 'API endpoint returned HTTP error: ' . $response->status(), 'errorCode' => (string)$response->status()];
            }
            if (!$result) {
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
                Log::warning('Cardzone Key Exchange returned error code', [
                    'errorCode' => $result['errorCode'],
                    'errorDescription' => $result['errorDescription'] ?? 'No description',
                    'purchaseId' => $purchaseId
                ]);
            }
            if ($isSuccess && isset($result['pubKey'])) {
                $this->updateCardzonePublicKey($result['pubKey']);
                Log::info('Cardzone Key Exchange successful.', ['purchaseId' => $purchaseId]);
                return ['success' => true, 'cardzonePublicKey' => $result['pubKey'], 'merchantPrivateKey' => $privateKey];
            } else {
                $errorMessage = $result['errorDesc'] ?? $result['errorMessage'] ?? $result['message'] ?? 'Unknown error';
                $errorCode = $result['errorCode'] ?? $result['responseCode'] ?? 'N/A';
                Log::error('Cardzone Key Exchange failed.', ['response' => $result, 'errorCode' => $errorCode]);
                return ['success' => false, 'error' => $errorMessage, 'errorCode' => $errorCode];
            }
        } catch (\Exception $e) {
            Log::error('Cardzone Key Exchange network error.', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return ['success' => false, 'error' => 'Network error during key exchange: ' . $e->getMessage()];
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
        // This is a simplified example; refer to your BMMB-Cardzone 3DS Merchant Interface_v2.9.pdf for exact order.
        $macString = '';
        $macString .= $data['MPI_TRANS_TYPE'] ?? '';
        $macString .= $data['MPI_MERC_ID'] ?? '';
        $macString .= $data['MPI_PAN'] ?? ''; // Use encrypted PAN in production
        $macString .= $data['MPI_PAN_EXP'] ?? '';
        $macString .= $data['MPI_CVV2'] ?? ''; // Use encrypted CVV in production
        $macString .= $data['MPI_CARD_HOLDER_NAME'] ?? '';
        $macString .= $data['MPI_PURCH_AMT'] ?? '';
        $macString .= $data['MPI_PURCH_CURR'] ?? '';
        $macString .= $data['MPI_TRXN_ID'] ?? '';
        $macString .= $data['MPI_PURCH_DATE'] ?? '';
        // Add other fields relevant to MPIReq in their specified order:
        $macString .= $data['MPI_ADDR_MATCH'] ?? '';
        $macString .= $data['MPI_BILL_ADDR_CITY'] ?? '';
        $macString .= $data['MPI_BILL_ADDR_POSTCODE'] ?? '';
        $macString .= $data['MPI_BILL_ADDR_LINE1'] ?? '';
        $macString .= $data['MPI_BILL_ADDR_LINE2'] ?? '';
        $macString .= $data['MPI_BILL_ADDR_LINE3'] ?? '';
        $macString .= $data['MPI_SHIP_ADDR_CITY'] ?? '';
        $macString .= $data['MPI_SHIP_ADDR_STATE'] ?? '';
        $macString .= $data['MPI_SHIP_ADDR_CNTRY'] ?? '';
        $macString .= $data['MPI_EMAIL'] ?? '';
        $macString .= $data['MPI_MOBILE_PHONE_CC'] ?? '';
        $macString .= $data['MPI_MOBILE_PHONE'] ?? '';

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