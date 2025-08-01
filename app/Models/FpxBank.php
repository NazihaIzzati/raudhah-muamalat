<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FpxBank extends Model
{
    use HasFactory;

    protected $table = 'fpx_banks';

    protected $fillable = [
        'bank_id',
        'bank_name',
        'display_name',
        'bank_status',
        'bank_type',
        'last_updated',
        'is_active'
    ];

    protected $casts = [
        'bank_status' => 'boolean',
        'is_active' => 'boolean',
        'last_updated' => 'datetime'
    ];

    /**
     * Get the display name for the bank
     */
    public function getDisplayNameAttribute()
    {
        $baseName = $this->attributes['display_name'];
        
        if ($this->bank_status) {
            return $baseName;
        } else {
            // Check if already has (Offline) suffix
            if (str_ends_with($baseName, ' (Offline)')) {
                return $baseName;
            }
            return $baseName . ' (Offline)';
        }
    }

    /**
     * Scope for active banks only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->where('bank_status', true);
    }

    /**
     * Scope for online banks only
     */
    public function scopeOnline($query)
    {
        return $query->where('bank_status', true);
    }

    /**
     * Scope for offline banks only
     */
    public function scopeOffline($query)
    {
        return $query->where('bank_status', false);
    }

    /**
     * Update bank status
     */
    public function updateStatus($status)
    {
        $this->update([
            'bank_status' => $status === 'A', // 'A' = Available, 'B' = Busy/Offline
            'last_updated' => now()
        ]);
    }

    /**
     * Get bank by ID
     */
    public static function findByBankId($bankId)
    {
        return static::where('bank_id', $bankId)->first();
    }

    /**
     * Get all active banks for selection
     */
    public static function getActiveBanks()
    {
        return static::active()->orderBy('display_name')->get();
    }

    /**
     * Get bank list for FPX integration
     */
    public static function getBankListForFpx()
    {
        return static::active()
            ->select('bank_id', 'display_name', 'bank_name')
            ->orderBy('display_name')
            ->get()
            ->map(function ($bank) {
                return [
                    'code' => $bank->bank_id,
                    'name' => $bank->display_name,
                    'full_name' => $bank->bank_name
                ];
            });
    }
} 