<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Donor extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'donor_id',
        'identification_number',
        'phone',
        'address',
        'profile_picture',
        'donor_type', // 'individual', 'corporate', 'anonymous'
        'status', // 'active', 'inactive', 'suspended'
        'registration_date',
        'total_donated',
        'donation_count',
        'last_donation_date',
        'newsletter_subscribed',
        'preferences',
        'notes'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'registration_date' => 'date',
        'last_donation_date' => 'date',
        'total_donated' => 'decimal:2',
        'donation_count' => 'integer',
        'newsletter_subscribed' => 'boolean',
        'preferences' => 'array',
    ];

    /**
     * Get the user associated with this donor.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the donations made by this donor.
     */
    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * Check if donor is active.
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Check if donor is individual.
     */
    public function isIndividual(): bool
    {
        return $this->donor_type === 'individual';
    }

    /**
     * Check if donor is corporate.
     */
    public function isCorporate(): bool
    {
        return $this->donor_type === 'corporate';
    }

    /**
     * Check if donor is anonymous.
     */
    public function isAnonymous(): bool
    {
        return $this->donor_type === 'anonymous';
    }

    /**
     * Check if donor is subscribed to newsletter.
     */
    public function isNewsletterSubscribed(): bool
    {
        return $this->newsletter_subscribed;
    }

    /**
     * Get the profile picture URL.
     */
    public function getProfilePictureUrlAttribute(): string
    {
        if ($this->profile_picture) {
            return asset('storage/' . $this->profile_picture);
        }
        
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->user->name ?? 'Donor') . '&color=fff&background=10B981&size=150';
    }

    /**
     * Get the donor type display name.
     */
    public function getDonorTypeDisplayNameAttribute(): string
    {
        return match($this->donor_type) {
            'individual' => 'Individual',
            'corporate' => 'Corporate',
            'anonymous' => 'Anonymous',
            default => 'Unknown'
        };
    }

    /**
     * Get the status display name.
     */
    public function getStatusDisplayNameAttribute(): string
    {
        return match($this->status) {
            'active' => 'Active',
            'inactive' => 'Inactive',
            'suspended' => 'Suspended',
            default => 'Unknown'
        };
    }

    /**
     * Get the average donation amount.
     */
    public function getAverageDonationAttribute(): float
    {
        if ($this->donation_count == 0) {
            return 0.00;
        }
        
        return round($this->total_donated / $this->donation_count, 2);
    }

    /**
     * Get the formatted total donated amount.
     */
    public function getFormattedTotalDonatedAttribute(): string
    {
        return 'RM ' . number_format($this->total_donated, 2);
    }

    /**
     * Get the formatted average donation amount.
     */
    public function getFormattedAverageDonationAttribute(): string
    {
        return 'RM ' . number_format($this->average_donation, 2);
    }

    /**
     * Update donor statistics after a donation.
     */
    public function updateDonationStats(float $amount): void
    {
        $this->increment('donation_count');
        $this->increment('total_donated', $amount);
        $this->update(['last_donation_date' => now()]);
    }

    /**
     * Get donor preferences as array.
     */
    public function getPreferencesAttribute($value): array
    {
        return json_decode($value, true) ?? [];
    }

    /**
     * Set donor preferences as JSON.
     */
    public function setPreferencesAttribute($value): void
    {
        $this->attributes['preferences'] = is_array($value) ? json_encode($value) : $value;
    }
} 