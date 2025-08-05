<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasAuditTrail;

class Campaign extends Model
{
    use HasFactory, SoftDeletes, HasAuditTrail;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'organization_name',
        'partner_id',
        'description',
        'short_description',
        'content',
        'featured_image',
        'qr_code_image',
        'goal_amount',
        'raised_amount',
        'donor_count',
        'currency',
        'start_date',
        'end_date',
        'status',
        'featured',
        'display_order',
        'category',
        'created_by',
        'updated_by',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'goal_amount' => 'decimal:2',
        'raised_amount' => 'decimal:2',
        'donor_count' => 'integer',
        'featured' => 'boolean',
        'display_order' => 'integer',
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
     * Get the partner associated with this campaign.
     */
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
    
    /**
     * Get the donations for this campaign.
     */
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * Get the audit trail for this campaign.
     */
    public function auditTrails()
    {
        return $this->hasMany(CampaignAuditTrail::class)->orderBy('created_at', 'desc');
    }

    /**
     * Sync the raised amount with actual completed donations.
     */
    public function syncRaisedAmount()
    {
        $actualRaised = $this->donations()
            ->where('payment_status', 'completed')
            ->sum('amount');
        
        if (abs((float)$this->raised_amount - (float)$actualRaised) > 0.01) {
            $oldAmount = $this->raised_amount;
            $this->raised_amount = $actualRaised;
            $this->save();
            
            // Log the correction
            $this->logCustomAction(
                'goal_updated',
                "Campaign raised amount synchronized from RM " . number_format($oldAmount, 2) . " to RM " . number_format($actualRaised, 2) . " based on actual donations"
            );
            
            return true;
        }
        
        return false;
    }

    /**
     * Check if the raised amount is in sync with actual donations.
     */
    public function isRaisedAmountInSync()
    {
        return abs((float)$this->raised_amount - (float)$this->actual_raised_amount) < 0.01;
    }

    /**
     * Get the actual raised amount from completed donations.
     */
    public function getActualRaisedAmountAttribute()
    {
        return $this->donations()
            ->where('payment_status', 'completed')
            ->sum('amount');
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
     * Get the staff member who updated this campaign.
     */
    public function updater()
    {
        return $this->belongsTo(Staff::class, 'updated_by');
    }

    /**
     * Get the organization logo URL from partner.
     */
    public function getOrganizationLogoUrlAttribute(): ?string
    {
        if ($this->partner && $this->partner->logo) {
            return asset('storage/' . $this->partner->logo);
        }
        
        return null;
    }

    /**
     * Check if campaign is featured.
     */
    public function isFeatured()
    {
        return $this->featured;
    }

    /**
     * Check if campaign is soft deleted.
     */
    public function isDeleted()
    {
        return $this->deleted_at !== null;
    }

    /**
     * Get the formatted deleted date.
     */
    public function getDeletedAtFormattedAttribute()
    {
        return $this->deleted_at ? $this->deleted_at->format('M j, Y') : null;
    }

    /**
     * Scope for active campaigns.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for featured campaigns.
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Scope for trashed campaigns.
     */
    public function scopeTrashed($query)
    {
        return $query->onlyTrashed();
    }

    /**
     * Get available categories.
     */
    public static function getCategories()
    {
        return [
            'general' => 'General',
            'emergency' => 'Emergency Relief',
            'education' => 'Education',
            'healthcare' => 'Healthcare',
            'infrastructure' => 'Infrastructure',
            'food' => 'Food & Nutrition',
            'orphan' => 'Orphan Support',
            'mosque' => 'Mosque Building',
            'water' => 'Water & Sanitation',
        ];
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

    /**
     * Check if campaign is successful (completed or reached high percentage).
     */
    public function isSuccessful()
    {
        // Campaign is successful if:
        // 1. Status is completed, OR
        // 2. Has reached 80% or more of goal, OR
        // 3. Has ended and reached 70% or more of goal
        if ($this->status === 'completed') {
            return true;
        }
        
        $percentage = $this->percentageReached();
        
        if ($percentage >= 80) {
            return true;
        }
        
        // If campaign has ended and reached 70% or more
        if ($this->end_date && $this->end_date->isPast() && $percentage >= 70) {
            return true;
        }
        
        return false;
    }

    /**
     * Check if campaign has ended.
     */
    public function hasEnded()
    {
        return $this->end_date && $this->end_date->isPast();
    }

    /**
     * Check if campaign is ongoing.
     */
    public function isOngoing()
    {
        return $this->status === 'active' && 
               (!$this->end_date || $this->end_date->isFuture());
    }

    /**
     * Get campaign status for display.
     */
    public function getDisplayStatusAttribute()
    {
        if ($this->status === 'completed') {
            return 'completed';
        }
        
        if ($this->hasEnded()) {
            return $this->isSuccessful() ? 'successful' : 'ended';
        }
        
        return $this->status;
    }

    /**
     * Scope for successful campaigns.
     */
    public function scopeSuccessful($query)
    {
        return $query->where(function($q) {
            $q->where('status', 'completed')
              ->orWhereRaw('(raised_amount / goal_amount) >= 0.8')
              ->orWhere(function($subQ) {
                  $subQ->whereNotNull('end_date')
                       ->where('end_date', '<=', now())
                       ->whereRaw('(raised_amount / goal_amount) >= 0.7');
              });
        });
    }

    /**
     * Scope for ended campaigns.
     */
    public function scopeEnded($query)
    {
        return $query->whereNotNull('end_date')
                     ->where('end_date', '<=', now());
    }

    /**
     * Scope for ongoing campaigns.
     */
    public function scopeOngoing($query)
    {
        return $query->where('status', 'active')
                     ->where(function($q) {
                         $q->whereNull('end_date')
                           ->orWhere('end_date', '>', now());
                     });
    }

    /**
     * Get campaign duration in days.
     */
    public function getDurationDaysAttribute()
    {
        if (!$this->start_date || !$this->end_date) {
            return null;
        }
        
        return $this->start_date->diffInDays($this->end_date);
    }

    /**
     * Get days remaining for ongoing campaigns.
     */
    public function getDaysRemainingAttribute()
    {
        if (!$this->end_date || $this->hasEnded()) {
            return 0;
        }
        
        return max(0, now()->diffInDays($this->end_date, false));
    }
}
