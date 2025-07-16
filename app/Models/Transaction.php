<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
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
