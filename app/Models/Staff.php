<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Staff extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'employee_id',
        'position',
        'department',
        'phone',
        'address',
        'profile_picture',
        'role', // 'hq', 'admin', 'manager', 'staff'
        'status', // 'active', 'inactive', 'suspended'
        'hire_date',
        'termination_date',
        'notes'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'hire_date' => 'date',
        'termination_date' => 'date',
    ];

    /**
     * Get the user associated with this staff member.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the campaigns created by this staff member.
     */
    public function campaigns(): HasMany
    {
        return $this->hasMany(Campaign::class, 'created_by');
    }

    /**
     * Get the news articles created by this staff member.
     */
    public function news(): HasMany
    {
        return $this->hasMany(News::class, 'created_by');
    }

    /**
     * Get the events created by this staff member.
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'created_by');
    }

    /**
     * Check if staff member is HQ level.
     */
    public function isHQ(): bool
    {
        return $this->role === 'hq';
    }

    /**
     * Check if staff member is admin level.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if staff member is manager level.
     */
    public function isManager(): bool
    {
        return $this->role === 'manager';
    }

    /**
     * Check if staff member is regular staff level.
     */
    public function isStaff(): bool
    {
        return $this->role === 'staff';
    }

    /**
     * Check if staff member is active.
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Check if staff member has executive access (HQ or Admin).
     */
    public function hasExecutiveAccess(): bool
    {
        return in_array($this->role, ['hq', 'admin']);
    }

    /**
     * Check if staff member has management access (HQ, Admin, or Manager).
     */
    public function hasManagementAccess(): bool
    {
        return in_array($this->role, ['hq', 'admin', 'manager']);
    }

    /**
     * Get the profile picture URL.
     */
    public function getProfilePictureUrlAttribute(): string
    {
        if ($this->profile_picture) {
            return asset('storage/' . $this->profile_picture);
        }
        
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->user->name ?? 'Staff') . '&color=fff&background=FB923C&size=150';
    }

    /**
     * Get the role display name.
     */
    public function getRoleDisplayNameAttribute(): string
    {
        return match($this->role) {
            'hq' => 'HQ',
            'admin' => 'Admin',
            'manager' => 'Manager',
            'staff' => 'Staff',
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
} 