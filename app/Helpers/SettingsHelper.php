<?php

namespace App\Helpers;

use App\Models\Setting;

class SettingsHelper
{
    /**
     * Get a setting value
     */
    public static function get($key, $default = null)
    {
        return Setting::get($key, $default);
    }

    /**
     * Set a setting value
     */
    public static function set($key, $value)
    {
        return Setting::set($key, $value);
    }

    /**
     * Get all settings
     */
    public static function all()
    {
        return Setting::getSettings();
    }

    /**
     * Get site name
     */
    public static function siteName()
    {
        return self::get('site_name', 'Raudhah Muamalat');
    }

    /**
     * Get site email
     */
    public static function siteEmail()
    {
        return self::get('site_email', 'info@raudhahmuamalat.com');
    }

    /**
     * Get site phone
     */
    public static function sitePhone()
    {
        return self::get('site_phone', '+60 3-1234 5678');
    }

    /**
     * Get currency
     */
    public static function currency()
    {
        return self::get('currency', 'MYR');
    }

    /**
     * Get minimum donation amount
     */
    public static function minDonation()
    {
        return self::get('min_donation', 10.00);
    }

    /**
     * Check if payment method is enabled
     */
    public static function isPaymentMethodEnabled($method)
    {
        $methodMap = [
            'duitnow_qr' => 'duitnow_qr_enabled',
            'fpx_banking' => 'fpx_banking_enabled',
            'card_payment' => 'card_payment_enabled',
        ];

        $field = $methodMap[$method] ?? null;
        return $field ? self::get($field, false) : false;
    }

    /**
     * Get registration type
     */
    public static function registrationType()
    {
        return self::get('registration_type', 'open');
    }

    /**
     * Check if registration is open
     */
    public static function isRegistrationOpen()
    {
        return self::registrationType() === 'open';
    }

    /**
     * Check if registration requires approval
     */
    public static function isRegistrationApprovalRequired()
    {
        return self::registrationType() === 'approval';
    }

    /**
     * Check if registration is closed
     */
    public static function isRegistrationClosed()
    {
        return self::registrationType() === 'closed';
    }
} 