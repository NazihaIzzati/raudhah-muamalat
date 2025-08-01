<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        // General Settings
        'site_name',
        'site_email', 
        'site_phone',
        'site_description',
        
        // Payment Settings
        'currency',
        'min_donation',
        'duitnow_qr_enabled',
        'fpx_banking_enabled',
        'card_payment_enabled',
        
        // Security Settings
        'registration_type',
        'session_timeout',
        'max_login_attempts',
        
        // Notification Settings
        'email_new_donations',
        'email_new_registrations',
        'email_campaign_updates',
        'admin_email',
    ];

    protected $casts = [
        'min_donation' => 'decimal:2',
        'duitnow_qr_enabled' => 'boolean',
        'fpx_banking_enabled' => 'boolean',
        'card_payment_enabled' => 'boolean',
        'email_new_donations' => 'boolean',
        'email_new_registrations' => 'boolean',
        'email_campaign_updates' => 'boolean',
        'session_timeout' => 'integer',
        'max_login_attempts' => 'integer',
    ];

    /**
     * Get the first (and only) settings record
     */
    public static function getSettings()
    {
        return static::first() ?? static::create();
    }

    /**
     * Update settings with validation
     */
    public static function updateSettings(array $data)
    {
        $settings = static::getSettings();
        $settings->update($data);
        return $settings;
    }

    /**
     * Get a specific setting value
     */
    public static function get($key, $default = null)
    {
        $settings = static::getSettings();
        return $settings->$key ?? $default;
    }

    /**
     * Set a specific setting value
     */
    public static function set($key, $value)
    {
        $settings = static::getSettings();
        $settings->update([$key => $value]);
        return $settings;
    }
}
