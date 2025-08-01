<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donation extends Model
{
    use HasFactory, SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'donor_id',
        'campaign_id',
        'donor_name',
        'donor_email',
        'donor_phone',
        'amount',
        'currency',
        'payment_method',
        'payment_status',
        'transaction_id',
        'message',
        'is_anonymous',
        'paid_at',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'is_anonymous' => 'boolean',
        'paid_at' => 'datetime',
    ];
    
    /**
     * Get the donor that made this donation.
     */
    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }
    
    /**
     * Get the campaign this donation was made to.
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    /**
     * Get the cardzone transaction associated with this donation.
     */
    public function cardzoneTransaction()
    {
        return $this->hasOne(CardzoneTransaction::class, 'donation_id');
    }

    /**
     * Get the paynet transaction associated with this donation.
     */
    public function paynetTransaction()
    {
        return $this->hasOne(PaynetTransaction::class, 'donation_id');
    }
}
