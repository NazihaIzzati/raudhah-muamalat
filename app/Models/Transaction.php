<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Transaction Model
 * 
 * Transaction ID Format: Random 10 digits (matching sample request)
 * Example: 6487047256
 * - Random 10 digits for uniqueness
 * 
 * Sample Request Format:
 * - purchaseId: "6487047256" (10 digits)
 * - merchantId: "600000000000001" (15 digits)
 * - pubKey: 523 characters (Base64Url encoded PEM)
 */
class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id', // Format: YYMMDDHHMMSS<UNIX ID><RANDOM 8 DIGITS>
        'merchant_id',
        'amount',
        'currency',
        'payment_method',
        'status',
        'card_number_masked',
        'card_expiry',
        'card_holder_name',
        'obw_bank_code',
        'qr_code_data',
        'auth_value',
        'eci',
        'cardzone_response_data',
        'donation_id',
    ];

    protected $casts = [
        'cardzone_response_data' => 'array', // Cast JSON string to array
    ];

    /**
     * Get the donation associated with this transaction.
     */
    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
}
