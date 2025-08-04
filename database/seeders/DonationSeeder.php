<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Donation;
use App\Models\Campaign;
use App\Models\User;
use App\Models\Donor;
use Carbon\Carbon;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get campaigns
        $campaigns = Campaign::all();
        
        if ($campaigns->isEmpty()) {
            $this->command->info('No campaigns found. Please run the campaign seeder first.');
            return;
        }
        
        // Get donor users (for registered donations)
        $donors = Donor::with('user')->get();
        
        // Payment methods (Malaysian context)
        $paymentMethods = [
            'duitnow_qr', 'fpx_online_banking', 'credit_card', 'debit_card', 
            'maybank2u', 'cimb_clicks', 'public_bank', 'rhb_now', 
            'bank_transfer', 'cash', 'boost', 'grabpay', 'tng_ewallet'
        ];
        
        // Payment statuses with realistic distribution
        $statusDistribution = [
            'completed' => 70, // 70% completed
            'pending' => 15,   // 15% pending
            'failed' => 10,    // 10% failed
            'refunded' => 5    // 5% refunded
        ];
        
        // Create weighted status array
        $statuses = [];
        foreach ($statusDistribution as $status => $weight) {
            $statuses = array_merge($statuses, array_fill(0, $weight, $status));
        }
        
        // Donation amounts with realistic distribution
        $amountRanges = [
            ['min' => 10, 'max' => 50, 'weight' => 40],    // Small donations (40%)
            ['min' => 51, 'max' => 200, 'weight' => 35],   // Medium donations (35%)
            ['min' => 201, 'max' => 500, 'weight' => 15],  // Large donations (15%)
            ['min' => 501, 'max' => 2000, 'weight' => 8],  // Very large donations (8%)
            ['min' => 2001, 'max' => 10000, 'weight' => 2] // Major donations (2%)
        ];
        
        // Create weighted amount ranges
        $weightedAmounts = [];
        foreach ($amountRanges as $range) {
            $weightedAmounts = array_merge($weightedAmounts, array_fill(0, $range['weight'], $range));
        }
        
        // Inspirational donation messages
        $donationMessages = [
            'May Allah bless this cause and help those in need.',
            'Barakallahu feeki for organizing this campaign.',
            'In sha Allah this will reach those who need it most.',
            'May this small contribution make a big difference.',
            'Praying for the success of this noble cause.',
            'Alhamdulillah for the opportunity to give.',
            'May Allah multiply the reward for everyone involved.',
            'Supporting our brothers and sisters in need.',
            'Fi sabilillah - in the path of Allah.',
            'May Allah accept this donation and bless the recipients.',
            'Sadaqah jariyah for my family.',
            'In memory of my beloved parents.',
            'May this bring barakah to my family.',
            'Lillahi ta\'ala - for the sake of Allah.',
            'Supporting the ummah with love and prayers.',
        ];
        
        // Malaysian names for guest donations
        $malaysianNames = [
            'Ahmad bin Abdullah', 'Siti Nurhaliza binti Hassan', 'Muhammad Hafiz bin Omar',
            'Fatimah binti Ibrahim', 'Ali bin Yusof', 'Khadijah binti Rahman',
            'Omar bin Ahmad', 'Aisha binti Salleh', 'Yusuf bin Hassan',
            'Maryam binti Abdullah', 'Ibrahim bin Ali', 'Zainab binti Omar',
            'Hassan bin Muhammad', 'Ruqayyah binti Yusuf', 'Umar bin Ibrahim'
        ];
        
        // Create 100 donations with realistic distribution
        for ($i = 0; $i < 100; $i++) {
            $campaign = $campaigns->random();
            $isAnonymous = rand(0, 100) < 25; // 25% anonymous
            
            // Select amount from weighted distribution
            $amountRange = $weightedAmounts[array_rand($weightedAmounts)];
            $amount = rand($amountRange['min'], $amountRange['max']);
            
            // Select status from weighted distribution
            $status = $statuses[array_rand($statuses)];
            
            // Determine if this is a registered or guest donation
            $isRegistered = !$isAnonymous && $donors->isNotEmpty() && rand(0, 100) < 60; // 60% registered
            
            if ($isRegistered) {
                $donor = $donors->random();
                $donationData = [
                    'campaign_id' => $campaign->id,
                    'donor_id' => $donor->id,
                    'donor_name' => $donor->user->name,
                    'donor_email' => $donor->user->email,
                    'amount' => $amount,
                    'currency' => $campaign->currency,
                    'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                    'payment_status' => $status,
                    'message' => $donationMessages[array_rand($donationMessages)],
                    'created_at' => Carbon::now()->subDays(rand(1, 90)),
                    'updated_at' => Carbon::now()->subDays(rand(1, 90)),
                ];
            } else {
                // Guest donation
                $donationData = [
                    'campaign_id' => $campaign->id,
                    'donor_id' => null, // No registered donor
                    'donor_name' => $isAnonymous ? 'Anonymous Donor' : $malaysianNames[array_rand($malaysianNames)],
                    'donor_email' => $isAnonymous ? 'anonymous@example.com' : 'guest' . rand(1, 999) . '@example.com',
                    'donor_phone' => $isAnonymous ? null : '+60 1' . rand(10000000, 99999999),
                    'amount' => $amount,
                    'currency' => $campaign->currency,
                    'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                    'payment_status' => $status,
                    'message' => $isAnonymous ? null : $donationMessages[array_rand($donationMessages)],
                    'created_at' => Carbon::now()->subDays(rand(1, 90)),
                    'updated_at' => Carbon::now()->subDays(rand(1, 90)),
                ];
            }
            
            Donation::create($donationData);
        }
        
        $this->command->info('✅ Donation seeding completed!');
        $this->command->info('💰 Donations created: ' . Donation::count());
        $this->command->info('👥 Registered donations: ' . Donation::whereNotNull('donor_id')->count());
        $this->command->info('👤 Guest donations: ' . Donation::whereNull('donor_id')->count());
    }
}
