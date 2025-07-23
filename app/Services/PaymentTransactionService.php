<?php

namespace App\Services;

use App\Models\Transaction;
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

            $transaction = Transaction::create([
                'transaction_id' => $data['transaction_id'],
                'merchant_id' => $data['merchant_id'],
                'amount' => $data['amount'],
                'currency' => $data['currency'],
                'payment_method' => $data['payment_method'],
                'status' => 'pending',
                'card_number_masked' => $this->maskCardNumber($data['card_number'] ?? null),
                'card_expiry' => $data['card_expiry'] ?? null,
                'card_holder_name' => $data['card_holder_name'] ?? null,
                'obw_bank_code' => $data['obw_bank_code'] ?? null,
                'qr_code_data' => $data['qr_code_data'] ?? null,
                'donation_id' => $data['donation_id'] ?? null,
            ]);

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
            $transaction = Transaction::where('transaction_id', $transactionId)->first();

            if (!$transaction) {
                throw new Exception("Transaction not found: {$transactionId}");
            }

            $oldStatus = $transaction->status;
            $transaction->status = $status;

            // Update additional fields if provided
            if (isset($additionalData['auth_value'])) {
                $transaction->auth_value = $additionalData['auth_value'];
            }

            if (isset($additionalData['eci'])) {
                $transaction->eci = $additionalData['eci'];
            }

            if (isset($additionalData['cardzone_response_data'])) {
                $transaction->cardzone_response_data = $additionalData['cardzone_response_data'];
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
            $transaction = Transaction::where('transaction_id', $transactionId)->first();

            if (!$transaction) {
                throw new Exception("Transaction not found: {$transactionId}");
            }

            // Update transaction with response data
            $transaction->cardzone_response_data = $responseData;
            $transaction->save();

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
            $transaction = Transaction::where('transaction_id', $transactionId)->first();

            if (!$transaction) {
                throw new Exception("Transaction not found: {$transactionId}");
            }

            // Determine status from callback data
            $status = $this->determineStatusFromCallback($callbackData);

            // Update transaction
            $transaction->status = $status;
            $transaction->auth_value = $callbackData['MPI_CAVV'] ?? $callbackData['MPI_AAV'] ?? null;
            $transaction->eci = $callbackData['MPI_ECI'] ?? null;
            $transaction->cardzone_response_data = $callbackData;
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
            $transaction = Transaction::where('transaction_id', $transactionId)->first();

            if (!$transaction) {
                throw new Exception("Transaction not found: {$transactionId}");
            }

            $transaction->status = $status;
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
            $transaction = Transaction::where('transaction_id', $transactionId)->first();

            if ($transaction) {
                $transaction->status = 'failed';
                $transaction->cardzone_response_data = array_merge(
                    $transaction->cardzone_response_data ?? [],
                    ['error' => $error, 'error_context' => $context]
                );
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
        return Transaction::where('transaction_id', $transactionId)->first();
    }

    /**
     * Get transaction statistics
     */
    public function getTransactionStats()
    {
        return [
            'total_transactions' => Transaction::count(),
            'pending_transactions' => Transaction::where('status', 'pending')->count(),
            'successful_transactions' => Transaction::whereIn('status', ['authorized', 'authenticated'])->count(),
            'failed_transactions' => Transaction::where('status', 'failed')->count(),
            'total_amount' => Transaction::whereIn('status', ['authorized', 'authenticated'])->sum('amount'),
            'recent_transactions' => Transaction::latest()->take(10)->get()
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