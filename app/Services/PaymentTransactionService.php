<?php

namespace App\Services;

use App\Models\CardzoneTransaction;
use App\Models\PaynetTransaction;
use App\Models\Donation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;

class PaymentTransactionService
{
    protected $debugService;

    public function __construct()
    {
        $this->debugService = new CardzoneDebugService();
    }

    /**
     * Create a new payment transaction record
     */
    public function createTransaction(array $data)
    {
        try {
            DB::beginTransaction();

            // Determine which transaction model to use based on payment method
            $paymentMethod = $data['payment_method'] ?? '';
            
            if (in_array($paymentMethod, ['card', 'obw', 'qr'])) {
                // Use CardzoneTransaction for Cardzone payments
                $transaction = CardzoneTransaction::create([
                    'cz_transaction_id' => $data['transaction_id'],
                    'cz_merchant_id' => $data['merchant_id'],
                    'cz_amount' => $data['amount'],
                    'cz_currency' => $data['currency'],
                    'cz_payment_method' => $data['payment_method'],
                    'cz_status' => 'pending',
                    'cz_card_number_masked' => $this->maskCardNumber($data['card_number'] ?? null),
                    'cz_card_expiry' => $data['card_expiry'] ?? null,
                    'cz_card_holder_name' => $data['card_holder_name'] ?? null,
                    'cz_obw_bank_code' => $data['obw_bank_code'] ?? null,
                    'cz_qr_code_data' => $data['qr_code_data'] ?? null,
                    'donation_id' => $data['donation_id'] ?? null,
                ]);
            } else {
                // Use PaynetTransaction for Paynet payments
                $transaction = PaynetTransaction::create([
                    'pn_transaction_id' => $data['transaction_id'],
                    'pn_merchant_id' => $data['merchant_id'],
                    'pn_amount' => $data['amount'],
                    'pn_currency' => $data['currency'],
                    'pn_payment_method' => $data['payment_method'],
                    'pn_status' => 'pending',
                    'donation_id' => $data['donation_id'] ?? null,
                ]);
            }

            // Log the transaction creation
            $this->debugService->logTransaction(
                $data['transaction_id'],
                'TRANSACTION_CREATED',
                [
                    'transaction_id' => $transaction->id,
                    'amount' => $data['amount'],
                    'currency' => $data['currency'],
                    'payment_method' => $data['payment_method']
                ],
                'INFO'
            );

            DB::commit();

            return $transaction;

        } catch (Exception $e) {
            DB::rollBack();
            
            $this->debugService->logError(
                $data['transaction_id'] ?? 'UNKNOWN',
                'Failed to create transaction: ' . $e->getMessage(),
                ['data' => $data]
            );

            throw $e;
        }
    }

    /**
     * Update transaction status
     */
    public function updateTransactionStatus($transactionId, $status, array $additionalData = [])
    {
        try {
            // Try to find transaction in both tables
            $cardzoneTransaction = CardzoneTransaction::where('cz_transaction_id', $transactionId)->first();
            $paynetTransaction = PaynetTransaction::where('pn_transaction_id', $transactionId)->first();
            
            if (!$cardzoneTransaction && !$paynetTransaction) {
                throw new Exception("Transaction not found: {$transactionId}");
            }

            if ($cardzoneTransaction) {
                $transaction = $cardzoneTransaction;
                $oldStatus = $transaction->cz_status;
                $transaction->cz_status = $status;

                // Update additional fields if provided
                if (isset($additionalData['auth_value'])) {
                    $transaction->cz_auth_value = $additionalData['auth_value'];
                }

                if (isset($additionalData['eci'])) {
                    $transaction->cz_eci = $additionalData['eci'];
                }

                if (isset($additionalData['cardzone_response_data'])) {
                    $transaction->cz_response_data = $additionalData['cardzone_response_data'];
                }
            } else {
                $transaction = $paynetTransaction;
                $oldStatus = $transaction->pn_status;
                $transaction->pn_status = $status;

                // Update additional fields if provided
                if (isset($additionalData['paynet_response_data'])) {
                    $transaction->pn_response_data = $additionalData['paynet_response_data'];
                }
            }

            $transaction->save();

            // Log the status update
            $this->debugService->logTransaction(
                $transactionId,
                'TRANSACTION_STATUS_UPDATED',
                [
                    'old_status' => $oldStatus,
                    'new_status' => $status,
                    'additional_data' => $additionalData
                ],
                'INFO'
            );

            return $transaction;

        } catch (Exception $e) {
            $this->debugService->logError(
                $transactionId,
                'Failed to update transaction status: ' . $e->getMessage(),
                ['status' => $status, 'additional_data' => $additionalData]
            );

            throw $e;
        }
    }

    /**
     * Record payment initiation
     */
    public function recordPaymentInitiation(array $data)
    {
        try {
            $transaction = $this->createTransaction($data);

            // Log payment initiation
            $this->debugService->logTransaction(
                $data['transaction_id'],
                'PAYMENT_INITIATED',
                [
                    'amount' => $data['amount'],
                    'currency' => $data['currency'],
                    'payment_method' => $data['payment_method'],
                    'transaction_id' => $transaction->id
                ],
                'INFO'
            );

            return $transaction;

        } catch (Exception $e) {
            $this->debugService->logError(
                $data['transaction_id'] ?? 'UNKNOWN',
                'Failed to record payment initiation: ' . $e->getMessage(),
                ['data' => $data]
            );

            throw $e;
        }
    }

    /**
     * Record payment submission to Cardzone
     */
    public function recordPaymentSubmission($transactionId, array $requestData, array $responseData)
    {
        try {
            // Try to find transaction in both tables
            $cardzoneTransaction = CardzoneTransaction::where('cz_transaction_id', $transactionId)->first();
            $paynetTransaction = PaynetTransaction::where('pn_transaction_id', $transactionId)->first();
            
            if (!$cardzoneTransaction && !$paynetTransaction) {
                throw new Exception("Transaction not found: {$transactionId}");
            }

            if ($cardzoneTransaction) {
                $transaction = $cardzoneTransaction;
                // Update transaction with response data
                $transaction->cz_response_data = $responseData;
                $transaction->cz_response_received_at = now();
                $transaction->save();
            } else {
                $transaction = $paynetTransaction;
                // Update transaction with response data
                $transaction->pn_response_data = $responseData;
                $transaction->pn_response_received_at = now();
                $transaction->save();
            }

            // Log payment submission
            $this->debugService->logTransaction(
                $transactionId,
                'PAYMENT_SUBMITTED_TO_CARDZONE',
                [
                    'request_data' => $this->sanitizeRequestData($requestData),
                    'response_status' => $responseData['status'] ?? null,
                    'response_length' => strlen($responseData['body'] ?? ''),
                    'has_form' => strpos($responseData['body'] ?? '', '<form') !== false,
                    'has_3ds' => strpos($responseData['body'] ?? '', '3D Secure') !== false
                ],
                'INFO'
            );

            return $transaction;

        } catch (Exception $e) {
            $this->debugService->logError(
                $transactionId,
                'Failed to record payment submission: ' . $e->getMessage(),
                ['request_data' => $requestData, 'response_data' => $responseData]
            );

            throw $e;
        }
    }

    /**
     * Record Cardzone callback response
     */
    public function recordCallbackResponse($transactionId, array $callbackData, $macValid = null)
    {
        try {
            // Try to find transaction in both tables
            $transaction = CardzoneTransaction::where('cz_transaction_id', $transactionId)->first();
            if (!$transaction) {
                $transaction = PaynetTransaction::where('pn_transaction_id', $transactionId)->first();
            }

            if (!$transaction) {
                throw new Exception("Transaction not found: {$transactionId}");
            }

            // Determine status from callback data
            $status = $this->determineStatusFromCallback($callbackData);

            // Update transaction based on type
            if ($transaction instanceof CardzoneTransaction) {
                $transaction->cz_status = $status;
                $transaction->cz_auth_value = $callbackData['MPI_CAVV'] ?? $callbackData['MPI_AAV'] ?? null;
                $transaction->cz_eci = $callbackData['MPI_ECI'] ?? null;
                $transaction->cz_response_data = $callbackData;
            } else {
                $transaction->pn_status = $status;
                $transaction->pn_response_data = $callbackData;
            }
            $transaction->save();

            // Update related donation if exists
            if ($transaction->donation_id) {
                $this->updateDonationStatus($transaction->donation_id, $status);
            }

            // Log callback response
            $this->debugService->logTransaction(
                $transactionId,
                'CALLBACK_RECEIVED',
                [
                    'status' => $status,
                    'mac_valid' => $macValid,
                    'auth_value' => $transaction->auth_value,
                    'eci' => $transaction->eci,
                    'donation_updated' => $transaction->donation_id ? true : false
                ],
                'INFO'
            );

            return $transaction;

        } catch (Exception $e) {
            $this->debugService->logError(
                $transactionId,
                'Failed to record callback response: ' . $e->getMessage(),
                ['callback_data' => $callbackData, 'mac_valid' => $macValid]
            );

            throw $e;
        }
    }

    /**
     * Record payment completion
     */
    public function recordPaymentCompletion($transactionId, $status, array $completionData = [])
    {
        try {
            // Try to find transaction in both tables
            $transaction = CardzoneTransaction::where('cz_transaction_id', $transactionId)->first();
            if (!$transaction) {
                $transaction = PaynetTransaction::where('pn_transaction_id', $transactionId)->first();
            }

            if (!$transaction) {
                throw new Exception("Transaction not found: {$transactionId}");
            }

            // Update transaction based on type
            if ($transaction instanceof CardzoneTransaction) {
                $transaction->cz_status = $status;
            } else {
                $transaction->pn_status = $status;
            }
            $transaction->save();

            // Log payment completion
            $this->debugService->logTransaction(
                $transactionId,
                'PAYMENT_COMPLETED',
                [
                    'final_status' => $status,
                    'completion_data' => $completionData
                ],
                'INFO'
            );

            return $transaction;

        } catch (Exception $e) {
            $this->debugService->logError(
                $transactionId,
                'Failed to record payment completion: ' . $e->getMessage(),
                ['status' => $status, 'completion_data' => $completionData]
            );

            throw $e;
        }
    }

    /**
     * Record payment error
     */
    public function recordPaymentError($transactionId, $error, array $context = [])
    {
        try {
            // Try to find transaction in both tables
            $transaction = CardzoneTransaction::where('cz_transaction_id', $transactionId)->first();
            if (!$transaction) {
                $transaction = PaynetTransaction::where('pn_transaction_id', $transactionId)->first();
            }

            if ($transaction) {
                if ($transaction instanceof CardzoneTransaction) {
                    $transaction->cz_status = 'failed';
                    $transaction->cz_response_data = array_merge(
                        $transaction->cz_response_data ?? [],
                        ['error' => $error, 'error_context' => $context]
                    );
                } else {
                    $transaction->pn_status = 'failed';
                    $transaction->pn_response_data = array_merge(
                        $transaction->pn_response_data ?? [],
                        ['error' => $error, 'error_context' => $context]
                    );
                }
                $transaction->save();
            }

            // Log the error
            $this->debugService->logError(
                $transactionId,
                $error,
                $context
            );

            return $transaction;

        } catch (Exception $e) {
            Log::error('Failed to record payment error', [
                'transaction_id' => $transactionId,
                'error' => $error,
                'context' => $context,
                'exception' => $e->getMessage()
            ]);

            throw $e;
        }
    }

    /**
     * Get transaction by ID
     */
    public function getTransaction($transactionId)
    {
        // Try to find transaction in both tables
        $cardzoneTransaction = CardzoneTransaction::where('cz_transaction_id', $transactionId)->first();
        $paynetTransaction = PaynetTransaction::where('pn_transaction_id', $transactionId)->first();
        
        return $cardzoneTransaction ?: $paynetTransaction;
    }

    /**
     * Get transaction statistics
     */
    public function getTransactionStats()
    {
        return [
            'total_transactions' => CardzoneTransaction::count() + PaynetTransaction::count(),
            'pending_transactions' => CardzoneTransaction::where('cz_status', 'pending')->count() + PaynetTransaction::where('pn_status', 'pending')->count(),
            'successful_transactions' => CardzoneTransaction::whereIn('cz_status', ['authorized', 'authenticated'])->count() + PaynetTransaction::whereIn('pn_status', ['completed'])->count(),
            'failed_transactions' => CardzoneTransaction::where('cz_status', 'failed')->count() + PaynetTransaction::where('pn_status', 'failed')->count(),
            'total_amount' => CardzoneTransaction::whereIn('cz_status', ['authorized', 'authenticated'])->sum('cz_amount') + PaynetTransaction::whereIn('pn_status', ['completed'])->sum('pn_amount'),
            'recent_transactions' => collect([
                CardzoneTransaction::latest()->take(5)->get(),
                PaynetTransaction::latest()->take(5)->get()
            ])->flatten()->sortByDesc('created_at')->take(10)
        ];
    }

    /**
     * Mask card number for security
     */
    private function maskCardNumber($cardNumber)
    {
        if (!$cardNumber) {
            return null;
        }

        $cardNumber = preg_replace('/\s+/', '', $cardNumber);
        
        if (strlen($cardNumber) < 4) {
            return $cardNumber;
        }

        return substr($cardNumber, 0, 4) . ' **** **** ' . substr($cardNumber, -4);
    }

    /**
     * Sanitize request data for logging
     */
    private function sanitizeRequestData(array $data)
    {
        $sensitiveFields = ['MPI_PAN', 'MPI_CVV2', 'MPI_CARD_HOLDER_NAME'];
        
        foreach ($sensitiveFields as $field) {
            if (isset($data[$field])) {
                if ($field === 'MPI_PAN') {
                    $data[$field] = $this->maskCardNumber($data[$field]);
                } elseif ($field === 'MPI_CVV2') {
                    $data[$field] = '***';
                } elseif ($field === 'MPI_CARD_HOLDER_NAME') {
                    $data[$field] = '***';
                }
            }
        }

        return $data;
    }

    /**
     * Determine transaction status from callback data
     */
    private function determineStatusFromCallback(array $callbackData)
    {
        $responseCode = $callbackData['MPI_RESPONSE_CODE'] ?? $callbackData['responseCode'] ?? null;
        $authStatus = $callbackData['MPI_AUTH_STATUS'] ?? $callbackData['authStatus'] ?? null;

        if ($responseCode === '000' || $authStatus === 'Y') {
            return 'authorized';
        } elseif ($responseCode === '001' || $authStatus === 'A') {
            return 'authenticated';
        } elseif ($responseCode === '002' || $authStatus === 'N') {
            return 'failed';
        } else {
            return 'pending';
        }
    }

    /**
     * Update donation status based on transaction status
     */
    private function updateDonationStatus($donationId, $transactionStatus)
    {
        try {
            $donation = Donation::find($donationId);
            
            if (!$donation) {
                return;
            }

            $donationStatus = match($transactionStatus) {
                'authorized', 'authenticated' => 'completed',
                'failed' => 'failed',
                'cancelled' => 'cancelled',
                default => 'pending'
            };

            $donation->status = $donationStatus;
            $donation->save();

            // Log donation status update
            $this->debugService->logTransaction(
                $donation->id,
                'DONATION_STATUS_UPDATED',
                [
                    'donation_id' => $donationId,
                    'old_status' => $donation->getOriginal('status'),
                    'new_status' => $donationStatus,
                    'transaction_status' => $transactionStatus
                ],
                'INFO'
            );

        } catch (Exception $e) {
            Log::error('Failed to update donation status', [
                'donation_id' => $donationId,
                'transaction_status' => $transactionStatus,
                'error' => $e->getMessage()
            ]);
        }
    }
} 