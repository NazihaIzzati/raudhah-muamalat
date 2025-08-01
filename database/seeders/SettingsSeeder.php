<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default settings if none exist
        if (Setting::count() === 0) {
            Setting::create([
                // General Settings
                'site_name' => 'Raudhah Muamalat',
                'site_email' => 'info@raudhahmuamalat.com',
                'site_phone' => '+60 3-1234 5678',
                'site_description' => 'A trusted Islamic crowdfunding platform dedicated to helping the underprivileged and supporting community development through Sharia-compliant financial solutions.',
                
                // Payment Settings
                'currency' => 'MYR',
                'min_donation' => 10.00,
                'duitnow_qr_enabled' => true,
                'fpx_banking_enabled' => true,
                'card_payment_enabled' => true,
                
                // Security Settings
                'registration_type' => 'open',
                'session_timeout' => 120, // 2 hours in minutes
                'max_login_attempts' => 5,
                
                // Notification Settings
                'email_new_donations' => true,
                'email_new_registrations' => true,
                'email_campaign_updates' => false,
                'admin_email' => 'admin@raudhahmuamalat.com',
            ]);
        }
    }
}
