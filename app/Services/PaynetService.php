<?php

namespace App\Services;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\FpxBank;
use App\Models\PaynetTransaction;
use App\Services\CardzoneDebugService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaynetService
{
    // =============================================================================
    // PROPERTIES
    // =============================================================================
    
    protected $merchantId;
    protected $merchantKey;
    protected $apiUrl;
    protected $callbackUrl;
    protected $debugService;
    protected $environment;
    protected $timeout;
    protected $retryAttempts;

    // =============================================================================
    // CONSTRUCTOR & INITIALIZATION
    // =============================================================================
    
    public function __construct()
    {
        $this->initializeEnvironment();
        $this->loadConfiguration();
        $this->initializeServices();
        $this->logInitialization();
    }

    /**
     * Initialize environment settings
     */
    private function initializeEnvironment()
    {
        $this->environment = env('PAYNET_ENVIRONMENT', 'uat');
    }

    /**
     * Load configuration from environment variables
     */
    private function loadConfiguration()
    {
        // Core settings with direct env() access
        $this->merchantId = env('PAYNET_' . strtoupper($this->environment) . '_MERCHANT_ID');
        $this->merchantKey = env('PAYNET_MERCHANT_KEY');
        $this->apiUrl = env('PAYNET_' . strtoupper($this->environment) . '_API_URL');
        $this->callbackUrl = env('PAYNET_' . strtoupper($this->environment) . '_CALLBACK_URL', url('/payment/paynet/callback'));
        $this->timeout = env('PAYNET_' . strtoupper($this->environment) . '_TIMEOUT', 30);
        $this->retryAttempts = env('PAYNET_' . strtoupper($this->environment) . '_RETRY_ATTEMPTS', 3);
    }

    /**
     * Initialize additional services
     */
    private function initializeServices()
    {
        $this->debugService = new CardzoneDebugService();
    }

    /**
     * Log service initialization details
     */
    private function logInitialization()
    {
        Log::info('PaynetService initialized', [
            'environment' => $this->environment,
            'api_url' => $this->apiUrl,
            'merchant_id' => $this->merchantId,
            'timeout' => $this->timeout,
            'retry_attempts' => $this->retryAttempts,
            'env_variables_loaded' => $this->getLoadedEnvVariables()
        ]);
    }



    // =============================================================================
    // UTILITY METHODS
    // =============================================================================
    
    /**
     * Get list of loaded environment variables for debugging
     */
    private function getLoadedEnvVariables()
    {
        $envVars = [];
        $envPrefix = 'PAYNET_' . strtoupper($this->environment) . '_';
        
        $keys = [
            'API_URL', 'MERCHANT_ID', 'CALLBACK_URL', 'TIMEOUT', 'RETRY_ATTEMPTS',
            'PRIVATE_KEY_PATH', 'PUBLIC_CERT_PATH', 'MERCHANT_CERT_PATH',
            'GATEWAY_URL', 'BANK_LIST_URL', 'REDIRECT_URL', 'TERMS_URL',
            'LOGGING_LEVEL', 'MERCHANT_NAME'
        ];

        foreach ($keys as $key) {
            $value = env($envPrefix . $key);
            if ($value !== null) {
                $envVars[$key] = $value;
            }
        }

        return $envVars;
    }

    /**
     * Generate a unique transaction ID for Paynet
     */
    public function generateTransactionId($donationId = null)
    {
        $prefix = 'PNT';
        $timestamp = now()->format('YmdHis');
        $random = Str::random(6);
        $donationSuffix = $donationId ? sprintf('%06d', $donationId) : '000000';
        
        return $prefix . $timestamp . $random . $donationSuffix;
    }

    // =============================================================================
    // BANK LIST MANAGEMENT
    // =============================================================================
    
    /**
     * Get list of FPX banks from Paynet
     * Using the correct environment-specific endpoint
     */
    public function getFpxBankList()
    {
        try {
            $bankListUrl = env('PAYNET_' . strtoupper($this->environment) . '_BANK_LIST_URL', $this->apiUrl . '/fpx/banks/v1');
            
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout($this->timeout)->get($bankListUrl);

            if ($response->successful()) {
                $data = $response->json();
                return $data['banks'] ?? [];
            }

            Log::error('Paynet FPX bank list failed', [
                'environment' => $this->environment,
                'url' => $bankListUrl,
                'status' => $response->status(),
                'response' => $response->body(),
                'available_env_vars' => $this->getLoadedEnvVariables()
            ]);

            return false;
        } catch (\Exception $e) {
            Log::error('Paynet FPX bank list error', [
                'environment' => $this->environment,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Get static list of FPX banks based on official Paynet documentation
     * Source: https://docs.developer.paynet.my/docs/fpx/mapping-table
     */
    public function getStaticFpxBankList()
    {
        return [
            ['id' => 'ABB0232', 'name' => 'Affin Bank Berhad'],
            ['id' => 'ABB0233', 'name' => 'Affin Bank Berhad B2C'],
            ['id' => 'ABMB0212', 'name' => 'Alliance Bank Malaysian Berhad B2C'],
            ['id' => 'ABMB0213', 'name' => 'Alliance Bank Malaysian Berhad B2B'],
            ['id' => 'AMBB0208', 'name' => 'AmBank Malaysia Berhad B2B'],
            ['id' => 'AMBB0209', 'name' => 'AmBank Malaysia Berhad B2C'],
            ['id' => 'BCBB0235', 'name' => 'CIMB Bank Berhad'],
            ['id' => 'BIMB0340', 'name' => 'Bank Islam Malaysia Berhad'],
            ['id' => 'BMMB0341', 'name' => 'Bank Muamalat Malaysia Berhad'],
            ['id' => 'BMMB0342', 'name' => 'Bank Muamalat Malaysia Berhad B2B'],
            ['id' => 'BKRM0602', 'name' => 'Bank Kerjasama Rakyat Malaysia B2C'],
            ['id' => 'BSN0601', 'name' => 'Bank Simpanan Nasional'],
            ['id' => 'DBB0199', 'name' => 'Deutsche Bank (Malaysia) Berhad'],
            ['id' => 'HLB0224', 'name' => 'Hong Leong Bank Berhad'],
            ['id' => 'HLB0225', 'name' => 'Hong Leong Bank Berhad B2B2'],
            ['id' => 'HSBC0223', 'name' => 'HSBC Bank Berhad FPX'],
            ['id' => 'KFH0346', 'name' => 'Kuwait Finance House'],
            ['id' => 'MB2U0227', 'name' => 'Malayan Banking Berhad (M2U)'],
            ['id' => 'MBB0227', 'name' => 'Malayan Banking Berhad (M2E)'],
            ['id' => 'MBB0228', 'name' => 'Malayan Banking Berhad B2B'],
            ['id' => 'OCBC0229', 'name' => 'OCBC Bank Malaysia Berhad'],
            ['id' => 'PBB0233', 'name' => 'Public Bank Berhad'],
            ['id' => 'RHB0218', 'name' => 'RHB Bank Berhad'],
            ['id' => 'SCB0215', 'name' => 'Standard Chartered Bank Malaysia Berhad B2B'],
            ['id' => 'SCB0216', 'name' => 'Standard Chartered Bank Malaysia Berhad B2C'],
            ['id' => 'TPAGHL', 'name' => 'GHL CardPay Sdn Bhd'],
            ['id' => 'TPAIPAY88', 'name' => 'Mobile88.com Sdn Bhd'],
            ['id' => 'TPAMOLPAY', 'name' => 'MOL Pay Sdn Bhd'],
            ['id' => 'TPAREVENUE', 'name' => 'Revenue Harvest Sdn Bhd'],
            ['id' => 'UOB0226', 'name' => 'United Overseas Bank B2C'],
            ['id' => 'UOB0227', 'name' => 'United Overseas Bank B2B1'],
            ['id' => 'UOB0228', 'name' => 'United Overseas Bank B2B1 Regional'],
            // Additional banks that are only in test list
            ['id' => 'CIT0219', 'name' => 'Citibank Malaysia'],
            ['id' => 'AGRO01', 'name' => 'AGRONet (Retail)'],
            ['id' => 'BOCM01', 'name' => 'Bank of China Malaysia'],
        ];
    }

    /**
     * Get test banks for UAT environment
     * Source: https://docs.developer.paynet.my/docs/fpx/mapping-table
     */
    public function getTestFpxBankList()
    {
        return [
            // Test banks with different naming conventions for UAT environment
            ['id' => 'MB2U0227', 'name' => 'MAYBANK2U'],
            ['id' => 'MBB0228', 'name' => 'MAYBANK2E'],
            ['id' => 'BCBB0235', 'name' => 'CIMB BANK'],
            ['id' => 'PBB0233', 'name' => 'PUBLIC BANK'],
            ['id' => 'RHB0218', 'name' => 'RHB BANK'],
            ['id' => 'HLB0224', 'name' => 'HLBB'],
            ['id' => 'OCBC0229', 'name' => 'OCBC BANK'],
            ['id' => 'UOB0226', 'name' => 'UOB BANK'],
            ['id' => 'HSBC0223', 'name' => 'HSBC BANK'],
            ['id' => 'SCB0216', 'name' => 'STANDARD CHARTERED'],
            ['id' => 'CIT0219', 'name' => 'CITIBANK'],
            ['id' => 'ABMB0212', 'name' => 'ALLIANCE BANK (PERSONAL)'],
            ['id' => 'AMBB0209', 'name' => 'AMBANK'],
            ['id' => 'ABB0233', 'name' => 'AFFIN BANK'],
            ['id' => 'BIMB0340', 'name' => 'BANK ISLAM'],
            ['id' => 'KFH0346', 'name' => 'KFH'],
            ['id' => 'BSN0601', 'name' => 'BSN'],
            ['id' => 'AGRO01', 'name' => 'AGRONet (Retail)'],
            ['id' => 'BKRM0602', 'name' => 'BANK RAKYAT'],
            ['id' => 'BOCM01', 'name' => 'BANK OF CHINA'],
            ['id' => 'BMMB0341', 'name' => 'BANK MUAMALAT'],
        ];
    }

    // =============================================================================
    // PAYMENT PROCESSING
    // =============================================================================
    
    /**
     * Sanitize buyer name for FPX compatibility
     * Based on official Paynet documentation: https://docs.developer.paynet.my/docs/fpx/mapping-table
     */
    private function sanitizeBuyerName($name)
    {
        // Remove or replace unsupported special characters
        $unsupportedChars = ['`', '~', '*', '"', ';', ':'];
        $name = str_replace($unsupportedChars, '', $name);
        
        // Supported special characters: @, /, \, (, ), blank space, ., -, _, ,, &, '
        // These are allowed and don't need to be removed
        
        // Trim whitespace and limit length
        $name = trim($name);
        
        // Limit to reasonable length (adjust as needed)
        if (strlen($name) > 100) {
            $name = substr($name, 0, 100);
        }
        
        return $name;
    }

    /**
     * Create FPX payment request (AR Message)
     * Step 3: Merchant Send AR Message to FPX
     */
    public function createFpxPayment($transactionData)
    {
        try {
            $transactionId = $transactionData['transaction_id'];
            $amount = $transactionData['amount'];
            $fpxBank = $transactionData['fpx_bank'];
            $donationId = $transactionData['donation_id'];
            
            // Get donation and campaign details
            $donation = Donation::find($donationId);
            $campaign = Campaign::find($donation->campaign_id);
            
            // Create FPX payment payload (AR message) - matches Python sample field names
            $fpxPayload = [
                'fpx_msgToken' => '01',
                'fpx_msgType' => 'AR', // Authorization Request
                'fpx_sellerExId' => $this->merchantId,
                'fpx_sellerExOrderNo' => 'JF' . $donation->id,
                'fpx_sellerTxnTime' => now()->format('YmdHis'),
                'fpx_sellerOrderNo' => $transactionId,
                'fpx_sellerId' => $this->merchantId,
                'fpx_sellerBankCode' => '01',
                'fpx_txnCurrency' => 'MYR',
                'fpx_txnAmount' => number_format($amount, 2, '.', ''),
                'fpx_buyerEmail' => $donation->email ?? '',
                'fpx_buyerBankId' => $fpxBank,
                'fpx_productDesc' => $campaign ? $campaign->title : 'Donation',
                'fpx_version' => '7.0',
                'fpx_buyerName' => $this->sanitizeBuyerName($donation->name ?? ''),
                'fpx_buyerId' => $donation->email ?? '',
                'fpx_buyerBankBranch' => '',
                'fpx_buyerIban' => '',
                'fpx_makerName' => $donation->name ?? '',
                'fpx_buyerAccNo' => '',
            ];
            
            // Generate signature
            $fpxPayload['fpx_checkSum'] = $this->generateSignature($fpxPayload);
            
            // Save AR message data to database
            $transaction = PaynetTransaction::where('pn_transaction_id', $transactionId)->first();
            if ($transaction) {
                $transaction->update([
                    'fpx_ar_message_data' => $fpxPayload,
                    'fpx_ar_sent_at' => now(),
                    'fpx_ar_status' => 'sent',
                    'fpx_last_message_type' => 'AR',
                    'fpx_last_message_at' => now(),
                    'fpx_message_sequence' => 'AR',
                ]);
                
                Log::channel('paynet_transactions')->info('AR message data saved to database', [
                    'transaction_id' => $transactionId,
                    'message_data' => $fpxPayload
                ]);
            }
            
            Log::channel('paynet')->info('Creating FPX payment', [
                'transaction_id' => $transactionId,
                'amount' => $amount,
                'bank' => $fpxBank,
                'merchant_id' => $this->merchantId,
                'environment' => $this->environment,
                'payload_keys' => array_keys($fpxPayload),
                'complete_payload' => $fpxPayload
            ]);
            
            // Send to Paynet API
            return $this->sendToPaynetAPI($fpxPayload, $transactionId);
            
        } catch (\Exception $e) {
            Log::channel('paynet')->error('Error creating FPX payment', [
                'transaction_id' => $transactionData['transaction_id'] ?? 'unknown',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Update transaction with error
            $transaction = PaynetTransaction::where('pn_transaction_id', $transactionData['transaction_id'] ?? '')->first();
            if ($transaction) {
                $transaction->update([
                    'fpx_ar_status' => 'failed',
                    'fpx_error_log' => $e->getMessage(),
                    'fpx_last_message_type' => 'AR',
                    'fpx_last_message_at' => now(),
                ]);
            }
            
            return [
                'success' => false,
                'error' => 'Failed to create FPX payment: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Send payment request to Paynet API (Production)
     */
    private function sendToPaynetAPI($fpxPayload, $transactionId)
    {
        try {
            // For development/testing environment, return mock response
            // But respect PAYNET_ENVIRONMENT setting - if it's 'prod', use real API
            if (app()->environment('local', 'development', 'testing') && env('PAYNET_ENVIRONMENT') !== 'prod') {
                Log::info('Development environment detected, returning mock response for production API');
                return $this->getMockFpxResponse($transactionId, $fpxPayload['txnAmount'], $fpxPayload['buyerBank']);
            }

            // For FPX payments, redirect to the gateway URL with the signed payload
            $gatewayUrl = env('PAYNET_' . strtoupper($this->environment) . '_GATEWAY_URL');
            
            // Log gateway redirect
            Log::channel('paynet_transactions')->info('FPX Gateway Redirect', [
                'transaction_id' => $transactionId,
                'gateway_url' => $gatewayUrl,
                'payload_keys' => array_keys($fpxPayload),
                'complete_payload' => $fpxPayload,
                'gateway_url_with_params' => $gatewayUrl . '?' . http_build_query($fpxPayload)
            ]);

            // Log debug information
            Log::channel('paynet_debug')->info('FPX Debug Information', [
                'transaction_id' => $transactionId,
                'environment' => $this->environment,
                'merchant_id' => $this->merchantId,
                'api_url' => $this->apiUrl,
                'gateway_url' => $gatewayUrl,
                'callback_url' => $this->callbackUrl,
                'timeout' => $this->timeout,
                'retry_attempts' => $this->retryAttempts
            ]);

            return [
                'success' => true,
                'gateway_url' => $gatewayUrl,
                'payment_data' => $fpxPayload,
                'redirect_url' => $gatewayUrl,
                'message' => 'FPX payment created successfully'
            ];

        } catch (\Exception $e) {
            Log::error('Paynet FPX Production API Exception', [
                'transaction_id' => $transactionId,
                'error' => $e->getMessage()
            ]);

            // For development/testing, return mock response instead of failing
            // But respect PAYNET_ENVIRONMENT setting - if it's 'prod', use real API
            if (app()->environment('local', 'development', 'testing') && env('PAYNET_ENVIRONMENT') !== 'prod') {
                Log::info('Development environment detected, returning mock response due to API error');
                return $this->getMockFpxResponse($transactionId, $fpxPayload['txnAmount'], $fpxPayload['buyerBank']);
            }

            return [
                'success' => false,
                'error' => 'FPX payment processing failed. Please try again.',
                'details' => $e->getMessage()
            ];
        }
    }

    /**
     * Get exchange list for FPX payload
     * Based on UAT simulator format
     */
    private function getExchangeList()
    {
        // This should be the list of exchanges from the simulator
        // For now, using a sample list based on the simulator payload
        $exchanges = [
            'SE00004292', 'SE00004293', 'SE00002014', 'SE00002604', 'SE00004132',
            'SE00004133', 'SE00004294', 'SE00004335', 'SE00004353', 'SE00004354',
            'SE00004546', 'SE00004547', 'SE00004548', 'SE00004549', 'SE00004554',
            'SE00004555', 'SE00004556', 'SE00004557', 'SE00004574', 'SE00004575',
            'SE00004680', 'SE00004681', 'SE00004734', 'SE00004735', 'SE00004738',
            'SE00004739', 'SE00004794', 'SE00004796', 'SE00004797', 'SE00004816',
            'SE00004817', 'SE00004834', 'SE00004835', 'SE00004836', 'SE00004837',
            'SE00004855', 'SE00004857', 'SE00004860', 'SE00004861', 'SE00004875',
            'SE00004934', 'SE00004936', 'SE00004937', 'SE00004941', 'SE00004942',
            'SE00005000', 'SE00005001', 'SE00005002', 'SE00005003', 'SE00005034',
            'SE00005214', 'SE00005215', 'SE00005356', 'SE00005357', 'SE00005396',
            'SE00005397', 'SE00005459', 'SE00005496', 'SE00005538', 'SE00005556',
            'SE00005736', 'SE00005737', 'SE00005738', 'SE00006076', 'SE00006156',
            'SE00006496', 'SE00006679', 'SE00006680', 'SE00006681', 'SE00006716',
            'SE00006736', 'SE00006976', 'SE00007136', 'SE00007296', 'SE00008059',
            'SE00008060', 'SE00008216', 'SE00008217', 'SE00008839', 'SE00009356',
            'SE00009357', 'SE00009898', 'SE00009899', 'SE00009978', 'SE00010403',
            'SE00010404', 'SE00010418', 'SE00010419', 'SE00010741', 'SE00010742',
            'SE00011058', 'SE00011059', 'SE00011060', 'SE00011061', 'SE00011178',
            'SE00011179', 'SE00011439', 'SE00011440', 'SE00011445', 'SE00011752',
            'SE00011786', 'SE00011907', 'SE00012896', 'SE00012897', 'SE00013158',
            'SE00015255', 'SE00004714', 'SE00004295', 'SE00028766'
        ];
        
        return implode(',', $exchanges);
    }

    // =============================================================================
    // CALLBACK & VERIFICATION
    // =============================================================================
    
    /**
     * Handle Direct AC (Direct Acknowledgment) from FPX
     * Step 8: FPX Respond Direct AC Message to Merchant
     */
    public function verifyFpxCallback($callbackData)
    {
        try {
            $receivedSignature = $callbackData['fpx_checkSum'] ?? '';
            $transactionId = $callbackData['fpx_sellerExOrderNo'] ?? '';
            $status = $callbackData['fpx_txnStatus'] ?? '';
            $amount = $callbackData['fpx_txnAmount'] ?? '';
            $fpxBank = $callbackData['fpx_buyerBankId'] ?? '';
            $responseCode = $callbackData['fpx_txnResponseCode'] ?? '';

            // Remove signature from data for verification
            $dataForVerification = $callbackData;
            unset($dataForVerification['fpx_checkSum']);

            // Verify Direct AC signature using Paynet public certificate
            $isValid = $this->verifySignature($dataForVerification, $receivedSignature);
            
            if (!$isValid) {
                Log::error('Paynet FPX Direct AC signature verification failed', [
                    'transaction_id' => $transactionId,
                    'received_signature' => $receivedSignature
                ]);
                return false;
            }

            // Get response code description
            $responseDescription = $this->getResponseCodeDescription($responseCode);

            Log::info('Paynet FPX Direct AC verified', [
                'transaction_id' => $transactionId,
                'status' => $status,
                'response_code' => $responseCode,
                'response_description' => $responseDescription,
                'amount' => $amount,
                'fpx_bank' => $fpxBank
            ]);

            return [
                'success' => $responseCode === '00',
                'response_code' => $responseCode,
                'response_description' => $responseDescription,
                'transaction_id' => $transactionId,
                'status' => $status,
                'amount' => $amount,
                'fpx_bank' => $fpxBank
            ];

        } catch (\Exception $e) {
            Log::error('Paynet FPX Direct AC verification error', [
                'error' => $e->getMessage(),
                'callback_data' => $callbackData
            ]);
            return false;
        }
    }

    /**
     * Get response code description based on official Paynet documentation
     * Source: https://docs.developer.paynet.my/docs/fpx/response-code
     */
    private function getResponseCodeDescription($responseCode)
    {
        $responseCodes = [
            // FPX Services Response Codes
            '00' => 'Approved',
            '03' => 'Approved',
            '05' => 'Invalid Seller Or Acquiring Bank Code',
            '09' => 'Transaction Pending',
            '12' => 'Invalid Transaction',
            '13' => 'Invalid Amount',
            '14' => 'Invalid Amount',
            '20' => 'Invalid Response',
            '30' => 'Format Error',
            '31' => 'Invalid Bank',
            '39' => 'Invalid Bank',
            '45' => 'Duplicate Seller Order Number',
            '46' => 'Invalid Seller Exchange Or Seller',
            '47' => 'Invalid Seller Exchange Or Seller',
            '48' => 'Maximum Transaction Limit Exceeded',
            '49' => 'Maximum Transaction Limit Exceeded',
            '50' => 'Invalid Seller for Merchant Specific Limit',
            '51' => 'Insufficient Funds',
            '53' => 'No Buyer Account Number',
            '57' => 'Transaction Not Permitted',
            '58' => 'Transaction To Merchant Not Permitted',
            '70' => 'Invalid Serial Number',
            '76' => 'Transaction Not Found',
            '77' => 'Invalid Buyer Name Or Buyer ID',
            '78' => 'Decryption Failed',
            '79' => 'Host Decline When Down',
            '80' => 'Buyer Cancel Transaction',
            '83' => 'Invalid Transaction Model',
            '84' => 'Invalid Transaction Type',
            '85' => 'Internal Error At Bank System',
            '87' => 'Internal Error At Bank System',
            '88' => 'Credit Failed Exception Handling',
            '89' => 'Transaction Not Received Exception Handling',
            '90' => 'Bank Internet Banking Unavailable',
            '92' => 'Invalid Buyer Bank',
            '96' => 'System Malfunction',
            '98' => 'MAC Error',
            '99' => 'Pending Authorization (Applicable for B2B model)',
            'BB' => 'Pending Authorization (Applicable for B2B model)',
            'BC' => 'Transaction Cancelled By Customer',
            'DA' => 'Invalid Application Type',
            'DB' => 'Invalid Email Format',
            'DC' => 'Invalid Maximum Frequency',
            'DD' => 'Invalid Frequency Mode',
            'DE' => 'Invalid Expiry Date',
            'DF' => 'Invalid e-Mandate Buyer Bank ID',
            'FE' => 'Internal Error',
            'OE' => 'Transaction Rejected As Not In FPX Operating Hours',
            'OF' => 'Transaction Rejected As Not In FPX Operating Hours',
            'SB' => 'Invalid Acquiring Bank Code',
            'XA' => 'Invalid Source IP Address (Applicable for B2B2 model)',
            'XB' => 'Invalid Source IP Address (Applicable for B2B2 model)',
            'XE' => 'Invalid Message',
            'XF' => 'Invalid Number Of Orders',
            'XI' => 'Invalid Number Of Orders',
            'XM' => 'Invalid FPX Transaction Model',
            'XN' => 'Transaction Rejected Due To Duplicate Seller Exchange Order Number',
            'XO' => 'Duplicate Exchange Order Number',
            'XS' => 'Seller Does Not Belong To Exchange',
            'XT' => 'Invalid Transaction Type',
            'XW' => 'Seller Exchange Date Difference Exceeded',
            '1A' => 'Seller Exchange Date Difference Exceeded',
            '1B' => 'Buyer Failed To Provide The Necessary Info To Login To Internet Banking Login Page',
            '1C' => 'Buyer Choose Cancel At Login Page',
            '1D' => 'Buyer Session Timeout At Account Selection Page',
            '1E' => 'Buyer Failed To Provide The Necessary Info At Account Selection Page',
            '1F' => 'Buyer Choose Cancel At Account Selection Page',
            '1G' => 'Buyer Session Timeout At TAC Request Page',
            '1H' => 'Buyer Failed To Provide The Necessary Info At TAC Request Page',
            '1I' => 'Buyer Choose Cancel At TAC Request Page',
            '1J' => 'Buyer Session Timeout At Confirmation Page',
            '1K' => 'Buyer Failed To Provide The Necessary Info At Confirmation Page',
            '1L' => 'Buyer Choose Cancel At Confirmation Page',
            '1M' => 'Internet Banking Session Timeout',
            '2A' => 'Transaction Amount Is Lower Than Minimum Limit',
            '2X' => 'Transaction Is Canceled By Merchant',
        ];

        return $responseCodes[$responseCode] ?? 'Unknown Response Code';
    }

    /**
     * Get user-friendly error message based on response code
     * Source: https://docs.developer.paynet.my/docs/fpx/response-code
     */
    public function getUserFriendlyErrorMessage($responseCode)
    {
        $userMessages = [
            // Success codes
            '00' => 'Payment completed successfully',
            '03' => 'Payment completed successfully',
            
            // Common user-facing errors
            '51' => 'Insufficient funds in your account. Please check your balance and try again.',
            '80' => 'Payment was cancelled by you. Please try again if you wish to complete the payment.',
            'BC' => 'Payment was cancelled. Please try again if you wish to complete the payment.',
            '1C' => 'Payment was cancelled at the login page. Please try again.',
            '1F' => 'Payment was cancelled at the account selection page. Please try again.',
            '1I' => 'Payment was cancelled at the TAC request page. Please try again.',
            '1L' => 'Payment was cancelled at the confirmation page. Please try again.',
            '1M' => 'Your internet banking session has timed out. Please try again.',
            '1D' => 'Your session timed out at the account selection page. Please try again.',
            '1G' => 'Your session timed out at the TAC request page. Please try again.',
            '1J' => 'Your session timed out at the confirmation page. Please try again.',
            '90' => 'Internet banking is currently unavailable. Please try again later.',
            '96' => 'The bank system is experiencing technical difficulties. Please try again later.',
            '98' => 'There was a security error. Please try again.',
            '2A' => 'The payment amount is below the minimum limit. Please increase the amount.',
            '48' => 'The payment amount exceeds the maximum limit. Please reduce the amount.',
            '49' => 'The payment amount exceeds the maximum limit. Please reduce the amount.',
            '77' => 'There was an issue with your account information. Please check your details and try again.',
            '53' => 'No account number found. Please check your bank account details.',
            '92' => 'The selected bank is not available for this payment. Please choose a different bank.',
            '31' => 'The selected bank is not available. Please choose a different bank.',
            '39' => 'The selected bank is not available. Please choose a different bank.',
            'OE' => 'FPX is currently closed. Please try again during operating hours.',
            'OF' => 'FPX is currently closed. Please try again during operating hours.',
            
            // Technical errors (generic message)
            '05' => 'There was an issue with the payment configuration. Please contact support.',
            '09' => 'Your payment is being processed. Please wait for confirmation.',
            '12' => 'There was an issue with the transaction. Please try again.',
            '13' => 'There was an issue with the payment amount. Please try again.',
            '14' => 'There was an issue with the payment amount. Please try again.',
            '20' => 'There was an issue with the payment response. Please try again.',
            '30' => 'There was a format error. Please try again.',
            '45' => 'This order number has already been used. Please try again.',
            '46' => 'There was an issue with the merchant configuration. Please contact support.',
            '47' => 'There was an issue with the merchant configuration. Please contact support.',
            '50' => 'There was an issue with the merchant configuration. Please contact support.',
            '57' => 'This type of transaction is not permitted. Please contact support.',
            '58' => 'This transaction is not permitted for this merchant. Please contact support.',
            '70' => 'There was an issue with the transaction serial number. Please try again.',
            '76' => 'The transaction was not found. Please try again.',
            '78' => 'There was a security error. Please try again.',
            '79' => 'The bank system is currently down. Please try again later.',
            '83' => 'There was an issue with the transaction model. Please contact support.',
            '84' => 'There was an issue with the transaction type. Please contact support.',
            '85' => 'The bank system is experiencing technical difficulties. Please try again later.',
            '87' => 'The bank system is experiencing technical difficulties. Please try again later.',
            '88' => 'There was an issue with the credit processing. Please try again.',
            '89' => 'The transaction was not received. Please try again.',
            '99' => 'Your payment is pending authorization. Please wait for confirmation.',
            'BB' => 'Your payment is pending authorization. Please wait for confirmation.',
            'DA' => 'There was an issue with the application type. Please contact support.',
            'DB' => 'There was an issue with the email format. Please check your email address.',
            'DC' => 'There was an issue with the frequency settings. Please contact support.',
            'DD' => 'There was an issue with the frequency mode. Please contact support.',
            'DE' => 'There was an issue with the expiry date. Please contact support.',
            'DF' => 'There was an issue with the mandate configuration. Please contact support.',
            'FE' => 'There was an internal error. Please try again.',
            'SB' => 'There was an issue with the acquiring bank. Please contact support.',
            'XA' => 'There was an issue with the source IP address. Please contact support.',
            'XB' => 'There was an issue with the source IP address. Please contact support.',
            'XE' => 'There was an issue with the message format. Please try again.',
            'XF' => 'There was an issue with the order format. Please try again.',
            'XI' => 'There was an issue with the order format. Please try again.',
            'XM' => 'There was an issue with the FPX transaction model. Please contact support.',
            'XN' => 'This order number has already been used. Please try again.',
            'XO' => 'This exchange order number has already been used. Please try again.',
            'XS' => 'There was an issue with the seller exchange. Please contact support.',
            'XT' => 'There was an issue with the transaction type. Please contact support.',
            'XW' => 'There was an issue with the exchange date. Please contact support.',
            '1A' => 'There was an issue with the exchange date. Please contact support.',
            '1B' => 'Please provide the necessary information to login to your internet banking.',
            '1E' => 'Please provide the necessary information at the account selection page.',
            '1H' => 'Please provide the necessary information at the TAC request page.',
            '1K' => 'Please provide the necessary information at the confirmation page.',
            '2X' => 'The transaction was cancelled by the merchant. Please contact support.',
        ];

        return $userMessages[$responseCode] ?? 'An unexpected error occurred. Please try again or contact support.';
    }

    /**
     * Send acknowledgment to FPX (Step 9)
     * Merchant Send Acknowledgment of Direct AC Message to FPX
     */
    public function sendAcknowledgmentToPaynet($transactionId, $status = 'OK')
    {
        try {
            $ackPayload = [
                'fpx_msgToken' => '02', // Acknowledgment message token
                'fpx_msgType' => 'AC', // Acknowledgment message type
                'fpx_sellerExId' => $this->merchantId, // Seller exchange ID
                'fpx_version' => '7.0', // FPX version
                'fpx_sellerExOrderNo' => $transactionId, // Seller exchange order number
                'fpx_sellerTxnTime' => now()->format('YmdHis'), // Seller transaction time
                'fpx_sellerOrderNo' => $transactionId, // Seller order number
                'fpx_sellerId' => $this->merchantId, // Seller ID
                'fpx_txnStatus' => $status, // Transaction status
                'fpx_txnResponseCode' => $status === 'OK' ? '00' : '99', // Transaction response code
                'fpx_txnResponseDesc' => $status === 'OK' ? 'Success' : 'Failed', // Transaction response description
            ];

            $ackPayload['fpx_checkSum'] = $this->generateSignature($ackPayload);

            $response = Http::withHeaders([
                'Content-Type' => 'application/x-www-form-urlencoded',
                'X-Signature' => $ackPayload['fpx_checkSum'],
            ])->post($this->apiUrl . '/fpx/ack', $ackPayload);

            if ($response->successful()) {
                Log::info('Paynet FPX Acknowledgment sent successfully', [
                    'transaction_id' => $transactionId,
                    'status' => $status
                ]);
                return true;
            }

            Log::error('Paynet FPX Acknowledgment failed', [
                'transaction_id' => $transactionId,
                'response' => $response->body()
            ]);
            return false;

        } catch (\Exception $e) {
            Log::error('Paynet FPX Acknowledgment error', [
                'transaction_id' => $transactionId,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    // =============================================================================
    // SIGNATURE & SECURITY
    // =============================================================================
    
    /**
     * Generate signature for Paynet API requests
     * Based on official Paynet documentation: https://docs.developer.paynet.my/docs/fpx/authentication
     */
    private function generateSignature($data)
    {
        // If data is a string, use it directly
        if (is_string($data)) {
            $checksumString = $data;
        } else {
            // Step 1: Construct the source string according to Paynet specification
            // Remove signature field if it exists (both old and new field names)
            unset($data['fpx_checkSum']);
            unset($data['checkSum']);
            
                    // Step 2: Build checksum string in specific order as per Paynet specification
        // Order matches Python sample: buyerAccNo|buyerBankBranch|buyerBankId|buyerEmail|buyerIban|buyerId|buyerName|makerName|msgToken|msgType|productDesc|sellerBankCode|sellerExId|sellerExOrderNo|sellerId|sellerOrderNo|sellerTxnTime|txnAmount|txnCurrency|version
        
        $checksumString = ($data['fpx_buyerAccNo'] ?? '') . '|' .
                         ($data['fpx_buyerBankBranch'] ?? '') . '|' .
                         ($data['fpx_buyerBankId'] ?? '') . '|' .
                         ($data['fpx_buyerEmail'] ?? '') . '|' .
                         ($data['fpx_buyerIban'] ?? '') . '|' .
                         ($data['fpx_buyerId'] ?? '') . '|' .
                         ($data['fpx_buyerName'] ?? '') . '|' .
                         ($data['fpx_makerName'] ?? '') . '|' .
                         ($data['fpx_msgToken'] ?? '') . '|' .
                         ($data['fpx_msgType'] ?? '') . '|' .
                         ($data['fpx_productDesc'] ?? '') . '|' .
                         ($data['fpx_sellerBankCode'] ?? '') . '|' .
                         ($data['fpx_sellerExId'] ?? '') . '|' .
                         ($data['fpx_sellerExOrderNo'] ?? '') . '|' .
                         ($data['fpx_sellerId'] ?? '') . '|' .
                         ($data['fpx_sellerOrderNo'] ?? '') . '|' .
                         ($data['fpx_sellerTxnTime'] ?? '') . '|' .
                         ($data['fpx_txnAmount'] ?? '') . '|' .
                         ($data['fpx_txnCurrency'] ?? '') . '|' .
                         ($data['fpx_version'] ?? '');
        
        // Log the checksum string for debugging
        Log::channel('paynet_debug')->info('Checksum string generated', [
            'checksum_string' => $checksumString,
            'data_keys' => array_keys($data)
        ]);
        }
        
        // Step 3: Generate signature using RSA-SHA1
        $privateKey = $this->getMerchantPrivateKey();
        if (!$privateKey) {
            Log::channel('paynet')->error('Failed to get merchant private key for signature generation');
            return false;
        }
        
        // Create signature
        $signature = '';
        if (openssl_sign($checksumString, $signature, $privateKey, OPENSSL_ALGO_SHA1)) {
            // Convert to uppercase hex (Paynet requirement)
            return strtoupper(bin2hex($signature));
        }
        
        Log::error('Failed to generate signature');
        return false;
    }

    /**
     * Get merchant private key for environment-specific path
     */
    private function getMerchantPrivateKey()
    {
        $privateKeyPath = env('PAYNET_' . strtoupper($this->environment) . '_PRIVATE_KEY_PATH');
        
        // Convert relative path to absolute path
        if ($privateKeyPath && !file_exists($privateKeyPath)) {
            $privateKeyPath = base_path($privateKeyPath);
        }
        
        Log::channel('paynet_debug')->info('Getting merchant private key', [
            'environment' => $this->environment,
            'path' => $privateKeyPath,
            'file_exists' => file_exists($privateKeyPath),
            'is_readable' => is_readable($privateKeyPath)
        ]);
        
        if (!$privateKeyPath || !file_exists($privateKeyPath)) {
            Log::channel('paynet')->error('Paynet merchant private key not found', [
                'environment' => $this->environment,
                'path' => $privateKeyPath,
                'available_env_vars' => $this->getLoadedEnvVariables()
            ]);
            return false;
        }
        
        $privateKey = file_get_contents($privateKeyPath);
        if (!$privateKey) {
            Log::error('Failed to read merchant private key', [
                'environment' => $this->environment,
                'path' => $privateKeyPath
            ]);
            return false;
        }
        
        Log::channel('paynet_debug')->info('Successfully loaded merchant private key', [
            'environment' => $this->environment,
            'key_length' => strlen($privateKey)
        ]);
        
        return $privateKey;
    }
    
    /**
     * Verify signature using environment-specific public certificate
     */
    private function verifySignature($data, $signature)
    {
        $publicCertPath = env('PAYNET_' . strtoupper($this->environment) . '_PUBLIC_CERT_PATH');
        
        if (!$publicCertPath || !file_exists($publicCertPath)) {
            Log::error('Paynet public certificate not found', [
                'environment' => $this->environment,
                'path' => $publicCertPath,
                'available_env_vars' => $this->getLoadedEnvVariables()
            ]);
            return false;
        }
        
        $publicKey = openssl_pkey_get_public(file_get_contents($publicCertPath));
        if (!$publicKey) {
            Log::error('Failed to load public certificate', [
                'environment' => $this->environment,
                'path' => $publicCertPath
            ]);
            return false;
        }
        
        // Prepare data for verification
        if (is_array($data)) {
            // Remove signature field if it exists
            unset($data['fpx_checkSum']);
            unset($data['checkSum']);
            
            // Sort by keys and concatenate values
            ksort($data);
            $dataString = implode('|', $data);
        }
        
        $signatureBinary = hex2bin(strtolower($signature));
        $result = openssl_verify($dataString, $signatureBinary, $publicKey, OPENSSL_ALGO_SHA1);
        
        openssl_free_key($publicKey);
        
        return $result === 1;
    }

    /**
     * Get payment status from Paynet
     */
    public function getPaymentStatus($transactionId)
    {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->merchantKey,
            ])->get($this->apiUrl . '/payment/status/' . $transactionId);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('Paynet payment status check failed', [
                'transaction_id' => $transactionId,
                'status' => $response->status(),
                'response' => $response->body()
            ]);

            return false;

        } catch (\Exception $e) {
            Log::error('Paynet payment status check error', [
                'transaction_id' => $transactionId,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    // =============================================================================
    // TESTING & DEBUGGING
    // =============================================================================
    


    // =============================================================================
    // FPX MESSAGE HANDLING
    // =============================================================================
    
    /**
     * Send BE (Bank Enquiry) message to FPX to get updated bank list
     * Based on FPX documentation for bank status updates
     */
    public function sendBankEnquiryMessage()
    {
        try {
            // BE message parameters
            $fpx_msgType = 'BE';
            $fpx_msgToken = '01';
            $fpx_sellerExId = $this->merchantId;
            $fpx_version = '7.0'; // FPX version is constant
            
            // Generate checksum string for BE message
            $checksumString = $fpx_msgToken . '|' . $fpx_msgType . '|' . $fpx_sellerExId . '|' . $fpx_version;
            
            // Generate signature
            $fpx_checkSum = $this->generateSignature($checksumString);
            
            // Prepare BE message payload
            $bePayload = [
                'fpx_msgType' => $fpx_msgType,
                'fpx_msgToken' => $fpx_msgToken,
                'fpx_sellerExId' => $fpx_sellerExId,
                'fpx_version' => $fpx_version,
                'fpx_checkSum' => $fpx_checkSum,
            ];
            
            // Get environment-specific bank list URL
            $bankListUrl = env('PAYNET_' . strtoupper($this->environment) . '_BANK_LIST_URL', 'https://www.mepsfpx.com.my/FPXMain/RetrieveBankList');
            
            // Send BE message to FPX
            $response = Http::withHeaders([
                'Content-Type' => 'application/x-www-form-urlencoded',
                'X-Signature' => $fpx_checkSum,
            ])->timeout($this->timeout)->post($bankListUrl, $bePayload);
            
            if ($response->successful()) {
                $bankListResponse = $response->body();
                Log::info('BE message sent successfully', [
                    'environment' => $this->environment,
                    'url' => $bankListUrl,
                    'response_length' => strlen($bankListResponse)
                ]);
                
                // Save BE message data to database (create a system transaction record)
                $systemTransaction = PaynetTransaction::create([
                    'transaction_id' => 'BE_' . now()->format('YmdHis') . '_' . rand(1000, 9999),
                    'merchant_id' => $this->merchantId,
                    'amount' => 0.00, // BE message has no amount
                    'currency' => 'MYR',
                    'payment_method' => 'fpx_system',
                    'status' => 'completed',
                    'fpx_be_message_data' => $bePayload,
                    'fpx_be_sent_at' => now(),
                    'fpx_be_status' => 'success',
                    'fpx_last_message_type' => 'BE',
                    'fpx_last_message_at' => now(),
                    'fpx_message_sequence' => 'BE',
                ]);
                
                Log::channel('paynet_transactions')->info('BE message data saved to database', [
                    'transaction_id' => $systemTransaction->transaction_id,
                    'message_data' => $bePayload
                ]);
                
                return $this->parseBankListResponse($bankListResponse);
            }
            
            Log::error('FPX BE message failed', [
                'environment' => $this->environment,
                'url' => $bankListUrl,
                'status' => $response->status(),
                'response' => $response->body()
            ]);
            
            return false;
            
        } catch (\Exception $e) {
            Log::error('FPX BE message error', [
                'environment' => $this->environment,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }
    
    /**
     * Parse bank list response from FPX
     * Format: bank_id%7Estatus%2Cbank_id%7Estatus
     * Status: A = Available, B = Busy/Offline
     */
    private function parseBankListResponse($response)
    {
        try {
            Log::info('Parsing bank list response', ['raw_response' => $response]);
            
            // Parse response format: fpx_bankList=bank_id%7Estatus%2Cbank_id%7Estatus
            $data = [];
            parse_str($response, $data);
            
            Log::info('Parsed data', ['data' => $data]);
            
            if (!isset($data['fpx_bankList'])) {
                Log::error('Invalid bank list response format', ['response' => $response, 'parsed_data' => $data]);
                return false;
            }
            
            $bankListStr = $data['fpx_bankList'];
            $bankStatus = [];
            
            // Parse bank list: bank_id~status,bank_id~status (after URL decoding)
            $banks = explode(',', $bankListStr);
            
            foreach ($banks as $bank) {
                $parts = explode('~', $bank);
                if (count($parts) === 2) {
                    $bankId = $parts[0];
                    $status = $parts[1];
                    $bankStatus[$bankId] = $status; // 'A' = Available, 'B' = Busy
                }
            }
            
            Log::info('Parsed bank list response', [
                'total_banks' => count($bankStatus),
                'bank_status' => $bankStatus
            ]);
            
            return $bankStatus;
            
        } catch (\Exception $e) {
            Log::error('Error parsing bank list response', [
                'error' => $e->getMessage(),
                'response' => $response
            ]);
            return false;
        }
    }
    
    /**
     * Update bank status in database based on FPX response
     */
    public function updateBankStatusFromFpx()
    {
        try {
            $bankStatus = $this->sendBankEnquiryMessage();
            
            if (!$bankStatus) {
                Log::warning('Failed to get bank status from FPX');
                return false;
            }
            
            $updatedCount = 0;
            $fpxBankModel = new FpxBank();
            
            foreach ($bankStatus as $bankId => $status) {
                $bank = $fpxBankModel::findByBankId($bankId);
                
                if ($bank) {
                    $bank->updateStatus($status);
                    $updatedCount++;
                } else {
                    Log::info('Bank not found in database', ['bank_id' => $bankId]);
                }
            }
            
            Log::info('Bank status updated from FPX', [
                'total_banks' => count($bankStatus),
                'updated_count' => $updatedCount
            ]);
            
            return $updatedCount;
            
        } catch (\Exception $e) {
            Log::error('Error updating bank status from FPX', ['error' => $e->getMessage()]);
            return false;
        }
    }
    
    /**
     * Get bank status summary
     */
    public function getBankStatusSummary()
    {
        try {
            $fpxBankModel = new FpxBank();
            
            $summary = [
                'total_banks' => $fpxBankModel::count(),
                'online_banks' => $fpxBankModel::online()->count(),
                'offline_banks' => $fpxBankModel::offline()->count(),
                'active_banks' => $fpxBankModel::active()->count(),
                'last_updated' => $fpxBankModel::max('last_updated'),
            ];
            
            return $summary;
            
        } catch (\Exception $e) {
            Log::error('Error getting bank status summary', ['error' => $e->getMessage()]);
            return false;
        }
    }

    /**
     * Send AE (Acknowledgement Enquiry) message to FPX to query transaction status
     * Based on FPX documentation for manual transaction status enquiry
     */
    public function sendAcknowledgementEnquiryMessage($transactionId, $donationId = null)
    {
        try {
            // Get transaction details from database
            $transaction = PaynetTransaction::where('pn_transaction_id', $transactionId)->first();
            
            if (!$transaction) {
                Log::error('Transaction not found for AE enquiry', [
                    'transaction_id' => $transactionId
                ]);
                return false;
            }
            
            // Get donation details
            $donation = Donation::find($transaction->donation_id);
            if (!$donation) {
                Log::error('Donation not found for AE enquiry', [
                    'donation_id' => $transaction->donation_id
                ]);
                return false;
            }
            
            // Get campaign details
            $campaign = Campaign::find($donation->campaign_id);
            
            // AE message parameters (25 parameters as per FPX specification)
            $aePayload = [
                'fpx_msgType' => 'AE', // Acknowledgement Enquiry
                'fpx_msgToken' => '01',
                'fpx_sellerExId' => $this->merchantId,
                'fpx_sellerExOrderNo' => 'JF' . $donation->id,
                'fpx_sellerTxnTime' => $transaction->created_at->format('YmdHis'),
                'fpx_sellerOrderNo' => $transaction->transaction_id,
                'fpx_sellerId' => $this->merchantId,
                'fpx_sellerBankCode' => '01', // Default bank code
                'fpx_txnCurrency' => 'MYR',
                'fpx_txnAmount' => number_format($transaction->amount, 2, '.', ''),
                'fpx_buyerEmail' => $donation->email ?? '',
                'fpx_buyerBankId' => $transaction->paynet_response_data['fpx_buyerBankId'] ?? '',
                'fpx_productDesc' => $campaign ? $campaign->title : 'Donation',
                'fpx_version' => '7.0',
                'fpx_buyerName' => $this->sanitizeBuyerName($donation->name ?? ''),
                'fpx_buyerID' => $donation->email ?? '',
                'fpx_buyerBankBranch' => '',
                'fpx_buyerIBAN' => '',
                'fpx_makerName' => $donation->name ?? '',
                'fpx_buyerAccNo' => '',
                'fpx_sellerOrdNo' => $transaction->transaction_id,
                'fpx_sellerFPXBank' => '01',
                'fpx_sellerID' => $this->merchantId,
                'fpx_OrdNo' => $transaction->transaction_id,
                'fpx_sellerTxnTime' => $transaction->created_at->format('YmdHis'),
            ];
            
            // Generate checksum string for AE message (same order as AR message)
            $checksumString = ($aePayload['fpx_buyerAccNo'] ?? '') . '|' .
                             ($aePayload['fpx_buyerBankBranch'] ?? '') . '|' .
                             ($aePayload['fpx_buyerBankId'] ?? '') . '|' .
                             ($aePayload['fpx_buyerEmail'] ?? '') . '|' .
                             ($aePayload['fpx_buyerIBAN'] ?? '') . '|' .
                             ($aePayload['fpx_buyerID'] ?? '') . '|' .
                             ($aePayload['fpx_buyerName'] ?? '') . '|' .
                             ($aePayload['fpx_makerName'] ?? '') . '|' .
                             ($aePayload['fpx_msgToken'] ?? '') . '|' .
                             ($aePayload['fpx_msgType'] ?? '') . '|' .
                             ($aePayload['fpx_productDesc'] ?? '') . '|' .
                             ($aePayload['fpx_sellerFPXBank'] ?? '') . '|' .
                             ($aePayload['fpx_sellerID'] ?? '') . '|' .
                             ($aePayload['fpx_OrdNo'] ?? '') . '|' .
                             ($aePayload['fpx_sellerID'] ?? '') . '|' .
                             ($aePayload['fpx_sellerOrdNo'] ?? '') . '|' .
                             ($aePayload['fpx_sellerTxnTime'] ?? '') . '|' .
                             ($aePayload['fpx_txnAmount'] ?? '') . '|' .
                             ($aePayload['fpx_txnCurrency'] ?? '') . '|' .
                             ($aePayload['fpx_version'] ?? '');
            
            // Generate signature
            $aePayload['fpx_checkSum'] = $this->generateSignature($checksumString);
            
            Log::info('AE message payload prepared', [
                'transaction_id' => $transactionId,
                'donation_id' => $donation->id,
                'payload_keys' => array_keys($aePayload),
                'checksum_string' => $checksumString
            ]);
            
            // Get environment-specific status enquiry URL
            $statusEnquiryUrl = env('PAYNET_' . strtoupper($this->environment) . '_STATUS_ENQUIRY_URL', 'https://www.mepsfpx.com.my/FPXMain/sellerNVPTxnStatus.jsp');
            
            // Send AE message to FPX
            $response = Http::withHeaders([
                'Content-Type' => 'application/x-www-form-urlencoded',
                'X-Signature' => $aePayload['fpx_checkSum'],
            ])->timeout($this->timeout)->post($statusEnquiryUrl, $aePayload);
            
            if ($response->successful()) {
                $aeResponse = $response->body();
                Log::info('AE message sent successfully', [
                    'transaction_id' => $transactionId,
                    'environment' => $this->environment,
                    'url' => $statusEnquiryUrl,
                    'response_length' => strlen($aeResponse)
                ]);
                
                // Parse AE response
                $aeResult = $this->parseAcknowledgementEnquiryResponse($aeResponse, $transactionId);
                
                // Update transaction with AE message data
                if ($transaction) {
                    $transaction->update([
                        'fpx_ae_message_data' => $aePayload,
                        'fpx_ae_sent_at' => now(),
                        'fpx_ae_status' => $aeResult ? 'success' : 'failed',
                        'fpx_ae_response_code' => $aeResult['response_code'] ?? '',
                        'fpx_last_message_type' => 'AE',
                        'fpx_last_message_at' => now(),
                        'fpx_message_sequence' => $transaction->fpx_message_sequence ? $transaction->fpx_message_sequence . '->AE' : 'AR->AC->AE',
                    ]);
                    
                    Log::channel('paynet_transactions')->info('AE message data saved to database', [
                        'transaction_id' => $transactionId,
                        'message_data' => $aePayload,
                        'result' => $aeResult
                    ]);
                }
                
                return $aeResult;
            }
            
            Log::error('FPX AE message failed', [
                'transaction_id' => $transactionId,
                'environment' => $this->environment,
                'url' => $statusEnquiryUrl,
                'status' => $response->status(),
                'response' => $response->body()
            ]);
            
            return false;
            
        } catch (\Exception $e) {
            Log::error('FPX AE message error', [
                'transaction_id' => $transactionId,
                'environment' => $this->environment,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }
    
    /**
     * Parse AE (Acknowledgement Enquiry) response from FPX
     * Format: fpx_msgType=AC&fpx_debitAuthCode=00&fpx_fpxTxnId=...
     */
    private function parseAcknowledgementEnquiryResponse($response, $transactionId)
    {
        try {
            Log::info('Parsing AE response', [
                'transaction_id' => $transactionId,
                'raw_response' => $response
            ]);
            
            // Parse response format: key=value&key=value
            $data = [];
            parse_str($response, $data);
            
            Log::info('Parsed AE response data', [
                'transaction_id' => $transactionId,
                'data' => $data
            ]);
            
            // Extract key information
            $result = [
                'success' => false,
                'transaction_id' => $transactionId,
                'response_code' => $data['fpx_debitAuthCode'] ?? '',
                'fpx_transaction_id' => $data['fpx_fpxTxnId'] ?? '',
                'response_description' => $this->getResponseCodeDescription($data['fpx_debitAuthCode'] ?? ''),
                'raw_response' => $data
            ];
            
            // Determine success based on response code
            if (isset($data['fpx_debitAuthCode']) && $data['fpx_debitAuthCode'] === '00') {
                $result['success'] = true;
            }
            
            Log::info('AE response parsed successfully', [
                'transaction_id' => $transactionId,
                'result' => $result
            ]);
            
            return $result;
            
        } catch (\Exception $e) {
            Log::error('Error parsing AE response', [
                'transaction_id' => $transactionId,
                'error' => $e->getMessage(),
                'response' => $response
            ]);
            return false;
        }
    }


    
    /**
     * Get current environment information
     */
    public function getEnvironmentInfo()
    {
        return [
            'environment' => $this->environment,
            'name' => 'Production', // Hardcoded since we removed envConfig
            'api_url' => $this->apiUrl,
            'merchant_id' => $this->merchantId,
            'merchant_name' => env('PAYNET_' . strtoupper($this->environment) . '_MERCHANT_NAME', 'Unknown'),
            'timeout' => $this->timeout,
            'retry_attempts' => $this->retryAttempts,
            'logging_level' => env('PAYNET_' . strtoupper($this->environment) . '_LOGGING_LEVEL', 'info'),
            'private_key_path' => env('PAYNET_' . strtoupper($this->environment) . '_PRIVATE_KEY_PATH'),
            'public_cert_path' => env('PAYNET_' . strtoupper($this->environment) . '_PUBLIC_CERT_PATH'),
            'merchant_cert_path' => env('PAYNET_' . strtoupper($this->environment) . '_MERCHANT_CERT_PATH'),
            'callback_url' => $this->callbackUrl,
            'gateway_url' => env('PAYNET_' . strtoupper($this->environment) . '_GATEWAY_URL'),
            'bank_list_url' => env('PAYNET_' . strtoupper($this->environment) . '_BANK_LIST_URL'),
            'redirect_url' => env('PAYNET_' . strtoupper($this->environment) . '_REDIRECT_URL'),
            'terms_url' => env('PAYNET_' . strtoupper($this->environment) . '_TERMS_URL'),
            'loaded_env_variables' => $this->getLoadedEnvVariables()
        ];
    }

    /**
     * Mock response for testing in UAT environment
     */
    private function getMockFpxResponse($transactionId, $amount, $fpxBank)
    {
        Log::info('Paynet FPX Mock Response for UAT environment', [
            'transaction_id' => $transactionId,
            'amount' => $amount,
            'bank' => $fpxBank
        ]);

        // Get the actual transaction data from the database
                    $transaction = PaynetTransaction::where('pn_transaction_id', $transactionId)->first();
        $donation = null;
        $donorName = 'Test Donor';
        $donorEmail = 'test@example.com';
        
        if ($transaction && $transaction->donation_id) {
            $donation = Donation::find($transaction->donation_id);
            if ($donation) {
                // Use the actual form data from the donation
                $donorName = $donation->donor_name ?? 'Test Donor';
                $donorEmail = $donation->donor_email ?? 'test@example.com';
            }
        }

        // Create mock payload with correct field names and actual data
        $mockPayload = [
            'debugMode' => 'false',
            'msgType' => 'AR',
            'IntgType' => '2D',
            'msgToken' => '01',
            'buyerBank' => $fpxBank, // Use the passed fpxBank parameter
            'sellerFPXBank' => '01',
            'exchange' => $this->getExchangeList(),
            'sellerID' => $this->merchantId,
            'OrdNo' => $transactionId,
            'sellerOrdNo' => $transactionId,
            'productDesc' => 'Donation - ' . ($donation->campaign->name ?? 'Test Campaign'),
            'buyerEmail' => $donorEmail,
            'txnAmount' => number_format($amount, 2, '.', ''),
            'fpx_eaccountNum' => '',
            'fpx_ebuyerID' => '',
            'buyerBankBranch' => '',
            'buyerAccNo' => '',
            'buyerName' => $donorName,
            'buyerID' => '',
            'makerName' => $donorName,
            'buyerIBAN' => '',
            'fpx_orderList' => '',
            'fpx_buyerID' => '',
            'fpx_maxFreq' => '',
            'fpx_freqMode' => '',
            'fpx_effectiveDate' => '',
            'fpx_appType' => '',
            'hiddentxnAmount' => '0',
            'hiddenpriorradio' => '0',
            'orderCount' => '1',
            'sellerTxnTime' => now()->format('YmdHis'),
            'sNo' => '1',
            'chargeType' => 'AA',
            'txnCurrency' => 'MYR',
            'version' => '7.0',
            'Submit' => 'Pay with FPX!'
        ];

        // Generate real signature for mock response
        $mockPayload['checkSum'] = $this->generateSignature($mockPayload);

        return [
            'success' => true,
            'redirect_url' => route('payment.fpx.redirect', ['transaction_id' => $transactionId]),
            'payment_data' => $mockPayload
        ];
    }
} 