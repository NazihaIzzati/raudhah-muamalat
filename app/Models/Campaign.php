<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'featured_image',
        'qr_code_image',
        'goal_amount',
        'raised_amount',
        'currency',
        'start_date',
        'end_date',
        'status',
        'created_by',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'goal_amount' => 'decimal:2',
        'raised_amount' => 'decimal:2',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
    
    /**
     * Get the staff member who created this campaign.
     */
    public function creator()
    {
        return $this->belongsTo(Staff::class, 'created_by');
    }
    
    /**
     * Get the donations for this campaign.
     */
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
    
    /**
     * Get the QR code image URL.
     */
    public function getQrCodeImageUrlAttribute(): ?string
    {
        if ($this->qr_code_image) {
            return asset('storage/' . $this->qr_code_image);
        }
        
        return null;
    }

    /**
     * Get the featured image URL.
     */
    public function getFeaturedImageUrlAttribute(): ?string
    {
        if ($this->featured_image) {
            return asset('storage/' . $this->featured_image);
        }
        
        return null;
    }
    
    /**
     * Check if campaign is active.
     */
    public function isActive()
    {
        return $this->status === 'active';
    }
    
    /**
     * Calculate percentage of fundraising goal reached.
     */
    public function percentageReached()
    {
        if ($this->goal_amount == 0) {
            return 0;
        }
        
        return min(100, round(($this->raised_amount / $this->goal_amount) * 100));
    }
}
