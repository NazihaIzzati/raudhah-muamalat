<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\About;
use App\Models\Staff;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first staff member as creator
        $staff = Staff::first();
        
        if (!$staff) {
            $this->command->warn('No staff members found. Creating about content without creator.');
        }

        About::create([
            'title' => 'Jariah Fund About Page Content',
            'mission' => 'To empower communities through Islamic crowdfunding by providing a trusted platform that connects donors with meaningful causes, ensuring transparency, accountability, and positive social impact.',
            'vision' => 'To become Malaysia\'s leading Islamic crowdfunding platform that fosters sustainable community development and social welfare through innovative financial solutions.',
            'values' => 'Our values are rooted in Islamic principles of Sadaqah (charitable giving) and Amanah (trustworthiness). We believe in transparency, accountability, and making a positive difference in people\'s lives.',
            'bank_muamalat_title' => 'Bank Muamalat Malaysia Berhad',
            'bank_muamalat_description' => 'Jariah Fund is proud to partner with Bank Muamalat Malaysia Berhad, Malaysia\'s premier Islamic bank. This strategic partnership ensures that all our financial transactions are conducted in accordance with Shariah principles, providing our donors and beneficiaries with confidence in our Islamic banking practices.

Our partnership with Bank Muamalat enables us to offer secure, transparent, and Shariah-compliant payment solutions. This collaboration reinforces our commitment to Islamic finance principles while providing convenient and reliable banking services to our community.

Together with Bank Muamalat, we are building a stronger, more inclusive financial ecosystem that serves the needs of the Muslim community while promoting social welfare and economic development.',
            'payment_section_title' => 'Simple & Secure Donation',
            'payment_section_description' => 'Choose from Malaysia\'s most trusted payment methods for your donations. All transactions are secure, transparent, and processed in real-time.',
            'fpx_description' => 'FPX (Financial Process Exchange) is Malaysia\'s premier online banking payment system. It allows you to make secure donations directly from your bank account to any Malaysian bank. Quick, secure, and hassle-free - your donation reaches the cause immediately with no extra fees.',
            'duitnow_description' => 'DuitNow is Malaysia\'s real-time payment system that enables instant transfers between bank accounts using just a phone number or IC number. Available 24/7, it\'s perfect for urgent donations and provides immediate confirmation.',
            'hero_badge_text' => 'About Us',
            'hero_title' => 'Building a Better World',
            'hero_subtitle' => 'Through Islamic Crowdfunding',
            'hero_description' => 'Jariah Fund is Malaysia\'s premier Shariah-compliant platform',
            'hero_highlights' => [
                ['text' => 'Social Welfare Programs', 'delay' => '0.6s'],
                ['text' => 'Educational Initiatives', 'delay' => '0.8s'],
                ['text' => 'Humanitarian Relief', 'delay' => '1.0s']
            ],
            'hero_pills' => [
                ['text' => 'Shariah Compliant', 'delay' => '0.7s'],
                ['text' => 'No Admin Fees', 'delay' => '0.8s'],
                ['text' => 'Full Transparency', 'delay' => '0.9s']
            ],
            'hero_cta_buttons' => [
                ['text' => 'Support Our Causes', 'url' => '/campaigns', 'type' => 'primary'],
                ['text' => 'Learn How It Works', 'url' => '/how-it-works', 'type' => 'secondary']
            ],
            'status' => 'active',
            'is_active' => true,
            'display_order' => 1,
            'created_by' => $staff ? $staff->id : null,
        ]);

        $this->command->info('About content seeded successfully!');
    }
}
