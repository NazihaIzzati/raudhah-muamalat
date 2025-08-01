<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

/**
 * CardzoneTransaction Model
 * 
 * Handles all Cardzone payment transactions including:
 * - Card payments (3DS)
 * - Online Banking (OBW)
 * - QR payments
 * 
 * Transaction ID Format: Random 10 digits (matching Cardzone request)
 * Example: 6487047256
 */
class CardzoneTransaction extends Model
{
    use HasFactory;

    protected $table = 'cardzone_transactions';

    protected $fillable = [
        // Core Transaction Fields
        'cz_transaction_id',
        'cz_merchant_id',
        'cz_amount',
        'cz_currency',
        'cz_payment_method',
        'cz_status',
        
        // Card Payment Fields (3DS)
        'cz_card_number_masked',
        'cz_card_expiry',
        'cz_card_holder_name',
        'cz_auth_value',
        'cz_eci',
        
        // Online Banking Fields (OBW)
        'cz_obw_bank_code',
        
        // QR Payment Fields
        'cz_qr_code_data',
        
        // Cardzone Response Data
        'cz_response_data',
        'cz_response_code',
        'cz_response_message',
        'cz_response_received_at',
        
        // Transaction Tracking
        'cz_session_id',
        'cz_order_id',
        'cz_created_at',
        'cz_updated_at',
        
        // Relationship Fields
        'donation_id',
    ];

    protected $casts = [
        'cz_response_data' => 'array',
        'cz_amount' => 'decimal:2',
        'cz_response_received_at' => 'datetime',
        'cz_created_at' => 'datetime',
        'cz_updated_at' => 'datetime',
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
        Log::channel('cardzone_transactions')->info('Transaction status changed', [
            'transaction_id' => $this->cz_transaction_id,
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
        Log::channel('cardzone_transactions')->info('Transaction created', [
            'transaction_id' => $this->cz_transaction_id,
            'merchant_id' => $this->cz_merchant_id,
            'amount' => $this->cz_amount,
            'payment_method' => $this->cz_payment_method,
            'donation_id' => $this->donation_id,
            'details' => $details,
            'timestamp' => now()->toISOString()
        ]);
    }

    /**
     * Log response data update
     */
    public function logResponseUpdate($responseData, $source = 'cardzone')
    {
        Log::channel('cardzone_transactions')->info('Transaction response updated', [
            'transaction_id' => $this->cz_transaction_id,
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
        
        Log::channel('cardzone_transactions')->info($logMessage, [
            'transaction_id' => $this->cz_transaction_id,
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
        return $query->where('cz_status', 'pending');
    }

    /**
     * Scope for completed transactions
     */
    public function scopeCompleted($query)
    {
        return $query->where('cz_status', 'completed');
    }

    /**
     * Scope for failed transactions
     */
    public function scopeFailed($query)
    {
        return $query->where('cz_status', 'failed');
    }

    /**
     * Scope for card payments
     */
    public function scopeCardPayments($query)
    {
        return $query->where('cz_payment_method', 'card');
    }

    /**
     * Scope for OBW payments
     */
    public function scopeObwPayments($query)
    {
        return $query->where('cz_payment_method', 'obw');
    }

    /**
     * Scope for QR payments
     */
    public function scopeQrPayments($query)
    {
        return $query->where('cz_payment_method', 'qr');
    }

    /**
     * Scope for authenticated transactions
     */
    public function scopeAuthenticated($query)
    {
        return $query->where('cz_status', 'authenticated');
    }

    /**
     * Scope for authorized transactions
     */
    public function scopeAuthorized($query)
    {
        return $query->where('cz_status', 'authorized');
    }

    /**
     * Scope for cancelled transactions
     */
    public function scopeCancelled($query)
    {
        return $query->where('cz_status', 'cancelled');
    }

    /**
     * Get transaction ID (alias for cz_transaction_id)
     */
    public function getTransactionIdAttribute()
    {
        return $this->cz_transaction_id;
    }

    /**
     * Get merchant ID (alias for cz_merchant_id)
     */
    public function getMerchantIdAttribute()
    {
        return $this->cz_merchant_id;
    }

    /**
     * Get amount (alias for cz_amount)
     */
    public function getAmountAttribute()
    {
        return $this->cz_amount;
    }

    /**
     * Get status (alias for cz_status)
     */
    public function getStatusAttribute()
    {
        return $this->cz_status;
    }

    /**
     * Get payment method (alias for cz_payment_method)
     */
    public function getPaymentMethodAttribute()
    {
        return $this->cz_payment_method;
    }
} 