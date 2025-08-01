<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

/**
 * PaynetTransaction Model
 * 
 * Handles all Paynet FPX payment transactions including:
 * - FPX payments (AR, AC, BE, AE messages)
 * - Bank status enquiries
 * - Transaction status queries
 * 
 * Transaction ID Format: PNT + timestamp + random + donation_id
 * Example: PNT2025011512345678901234567890001
 */
class PaynetTransaction extends Model
{
    use HasFactory;

    protected $table = 'paynet_transactions';

    protected $fillable = [
        // Core Transaction Fields
        'pn_transaction_id',
        'pn_merchant_id',
        'pn_amount',
        'pn_currency',
        'pn_payment_method',
        'pn_status',
        
        // Paynet Response Data
        'pn_response_data',
        'pn_response_code',
        'pn_response_message',
        'pn_response_received_at',
        
        // FPX Message Tracking - AR (Authorization Request)
        'pn_fpx_ar_message_data',
        'pn_fpx_ar_sent_at',
        'pn_fpx_ar_status',
        'pn_fpx_ar_response_code',
        
        // FPX Message Tracking - AC (Acknowledgement)
        'pn_fpx_ac_message_data',
        'pn_fpx_ac_received_at',
        'pn_fpx_ac_status',
        'pn_fpx_ac_response_code',
        'pn_fpx_ac_debit_auth_code',
        'pn_fpx_ac_fpx_txn_id',
        
        // FPX Message Tracking - BE (Bank Enquiry)
        'pn_fpx_be_message_data',
        'pn_fpx_be_sent_at',
        'pn_fpx_be_status',
        'pn_fpx_be_response_code',
        'pn_fpx_be_bank_list',
        
        // FPX Message Tracking - AE (Acknowledgement Enquiry)
        'pn_fpx_ae_message_data',
        'pn_fpx_ae_sent_at',
        'pn_fpx_ae_status',
        'pn_fpx_ae_response_code',
        'pn_fpx_ae_txn_status',
        
        // FPX Message Sequence Tracking
        'pn_fpx_message_sequence',
        'pn_fpx_last_message_type',
        'pn_fpx_last_message_at',
        'pn_fpx_error_log',
        
        // FPX Transaction Details
        'pn_fpx_seller_ex_id',
        'pn_fpx_seller_ex_order_no',
        'pn_fpx_seller_order_no',
        'pn_fpx_seller_id',
        'pn_fpx_seller_bank_code',
        'pn_fpx_buyer_bank_id',
        'pn_fpx_buyer_bank_branch',
        'pn_fpx_buyer_acc_no',
        'pn_fpx_buyer_id',
        'pn_fpx_buyer_name',
        'pn_fpx_buyer_email',
        'pn_fpx_buyer_iban',
        'pn_fpx_maker_name',
        'pn_fpx_product_desc',
        'pn_fpx_version',
        
        // Transaction Tracking
        'pn_session_id',
        'pn_order_id',
        'pn_created_at',
        'pn_updated_at',
        
        // Relationship Fields
        'donation_id',
    ];

    protected $casts = [
        'pn_response_data' => 'array',
        'pn_fpx_ar_message_data' => 'array',
        'pn_fpx_ac_message_data' => 'array',
        'pn_fpx_be_message_data' => 'array',
        'pn_fpx_ae_message_data' => 'array',
        'pn_fpx_ar_sent_at' => 'datetime',
        'pn_fpx_ac_received_at' => 'datetime',
        'pn_fpx_be_sent_at' => 'datetime',
        'pn_fpx_ae_sent_at' => 'datetime',
        'pn_fpx_last_message_at' => 'datetime',
        'pn_response_received_at' => 'datetime',
        'pn_created_at' => 'datetime',
        'pn_updated_at' => 'datetime',
        'pn_amount' => 'decimal:2',
    ];

    /**
     * Get the donation associated with this transaction.
     */
    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }

    /**
     * Log transaction status change
     */
    public function logStatusChange($oldStatus, $newStatus, $details = [])
    {
        Log::channel('paynet_transactions')->info('Transaction status changed', [
            'transaction_id' => $this->pn_transaction_id,
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
            'details' => $details,
            'timestamp' => now()->toISOString()
        ]);
    }

    /**
     * Log transaction creation
     */
    public function logCreation($details = [])
    {
        Log::channel('paynet_transactions')->info('Transaction created', [
            'transaction_id' => $this->pn_transaction_id,
            'merchant_id' => $this->pn_merchant_id,
            'amount' => $this->pn_amount,
            'payment_method' => $this->pn_payment_method,
            'donation_id' => $this->donation_id,
            'details' => $details,
            'timestamp' => now()->toISOString()
        ]);
    }

    /**
     * Log FPX message sent/received
     */
    public function logFpxMessage($messageType, $status, $messageData = [], $details = [])
    {
        Log::channel('paynet_transactions')->info("FPX {$messageType} message {$status}", [
            'transaction_id' => $this->pn_transaction_id,
            'message_type' => $messageType,
            'status' => $status,
            'message_data_keys' => array_keys($messageData),
            'details' => $details,
            'timestamp' => now()->toISOString()
        ]);
    }

    /**
     * Log response data update
     */
    public function logResponseUpdate($responseData, $source = 'paynet')
    {
        Log::channel('paynet_transactions')->info('Transaction response updated', [
            'transaction_id' => $this->pn_transaction_id,
            'source' => $source,
            'response_keys' => array_keys($responseData),
            'status' => $responseData['status'] ?? 'unknown',
            'timestamp' => now()->toISOString()
        ]);
    }

    /**
     * Update transaction with logging
     */
    public function updateWithLogging($data, $logMessage = 'Transaction updated')
    {
        $oldData = $this->toArray();
        
        $this->update($data);
        
        Log::channel('paynet_transactions')->info($logMessage, [
            'transaction_id' => $this->pn_transaction_id,
            'updated_fields' => array_keys($data),
            'old_data' => $oldData,
            'new_data' => $this->fresh()->toArray(),
            'timestamp' => now()->toISOString()
        ]);
    }

    /**
     * Scope for pending transactions
     */
    public function scopePending($query)
    {
        return $query->where('pn_status', 'pending');
    }

    /**
     * Scope for completed transactions
     */
    public function scopeCompleted($query)
    {
        return $query->where('pn_status', 'completed');
    }

    /**
     * Scope for failed transactions
     */
    public function scopeFailed($query)
    {
        return $query->where('pn_status', 'failed');
    }

    /**
     * Scope for FPX payments
     */
    public function scopeFpxPayments($query)
    {
        return $query->where('pn_payment_method', 'fpx');
    }

    /**
     * Scope for system transactions (BE messages)
     */
    public function scopeSystemTransactions($query)
    {
        return $query->where('pn_payment_method', 'fpx_system');
    }

    /**
     * Scope for AR messages
     */
    public function scopeArMessages($query)
    {
        return $query->where('pn_fpx_last_message_type', 'AR');
    }

    /**
     * Scope for AC messages
     */
    public function scopeAcMessages($query)
    {
        return $query->where('pn_fpx_last_message_type', 'AC');
    }

    /**
     * Scope for BE messages
     */
    public function scopeBeMessages($query)
    {
        return $query->where('pn_fpx_last_message_type', 'BE');
    }

    /**
     * Scope for AE messages
     */
    public function scopeAeMessages($query)
    {
        return $query->where('pn_fpx_last_message_type', 'AE');
    }

    /**
     * Scope for successful AC responses
     */
    public function scopeSuccessfulAc($query)
    {
        return $query->where('pn_fpx_ac_response_code', '00');
    }

    /**
     * Scope for failed AC responses
     */
    public function scopeFailedAc($query)
    {
        return $query->where('pn_fpx_ac_response_code', '!=', '00');
    }

    /**
     * Get transaction ID (alias for pn_transaction_id)
     */
    public function getTransactionIdAttribute()
    {
        return $this->pn_transaction_id;
    }

    /**
     * Get merchant ID (alias for pn_merchant_id)
     */
    public function getMerchantIdAttribute()
    {
        return $this->pn_merchant_id;
    }

    /**
     * Get amount (alias for pn_amount)
     */
    public function getAmountAttribute()
    {
        return $this->pn_amount;
    }

    /**
     * Get status (alias for pn_status)
     */
    public function getStatusAttribute()
    {
        return $this->pn_status;
    }

    /**
     * Get payment method (alias for pn_payment_method)
     */
    public function getPaymentMethodAttribute()
    {
        return $this->pn_payment_method;
    }
} 