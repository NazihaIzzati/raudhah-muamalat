<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
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
     * Get the user that made this donation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the campaign this donation was made to.
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
