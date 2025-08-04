<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'user_type', // 'staff', 'donor'
        'is_active',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'last_login_at' => 'datetime',
        ];
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        if ($this->user_type !== 'staff') {
            return false;
        }
        
        return $this->staff && $this->staff->role === 'admin';
    }

    /**
     * Check if user is staff
     */
    public function isStaff(): bool
    {
        return $this->user_type === 'staff';
    }

    /**
     * Check if user is donor
     */
    public function isDonor(): bool
    {
        return $this->user_type === 'donor';
    }
    
    /**
     * Check if user is HQ
     */
    public function isHQ(): bool
    {
        if ($this->user_type !== 'staff') {
            return false;
        }
        
        return $this->staff && $this->staff->role === 'hq';
    }
    
    /**
     * Check if user has executive access (admin or hq)
     */
    public function hasExecutiveAccess(): bool
    {
        return $this->isAdmin() || $this->isHQ();
    }
    
    /**
     * Check if user is active
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }

    /**
     * Get the staff profile associated with this user.
     */
    public function staff()
    {
        return $this->hasOne(Staff::class);
    }

    /**
     * Get the donor profile associated with this user.
     */
    public function donor()
    {
        return $this->hasOne(Donor::class);
    }
    
    /**
     * Get the profile photo URL based on user type
     */
    public function getProfilePhotoUrlAttribute(): string
    {
        if ($this->isStaff() && $this->staff && $this->staff->profile_picture) {
            return asset('storage/' . $this->staff->profile_picture);
        }
        
        if ($this->isDonor() && $this->donor && $this->donor->profile_picture) {
            return asset('storage/' . $this->donor->profile_picture);
        }
        
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=fff&background=FB923C&size=150';
    }
}
