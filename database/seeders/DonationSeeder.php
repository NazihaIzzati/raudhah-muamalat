<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Donation;
use App\Models\Campaign;
use App\Models\User;
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
        
        // Get users (for registered donations)
        $users = User::where('role', 'user')->get();
        
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
            
            // Set payment date based on status
            $paidAt = null;
            $createdDaysAgo = rand(1, 90);
            
            if ($status === 'completed') {
                $paidAt = Carbon::now()->subDays($createdDaysAgo);
            } elseif ($status === 'refunded') {
                $paidAt = Carbon::now()->subDays($createdDaysAgo + rand(1, 7));
            }
            
            // Randomly assign to a user or make it a guest donation
            $user = null;
            $donorName = '';
            $donorEmail = '';
            
            if (rand(0, 100) < 60 && !$users->isEmpty()) { // 60% registered users
                $user = $users->random();
                $donorName = $user->name;
                $donorEmail = $user->email;
            } else { // 40% guest donations
                $donorName = $malaysianNames[array_rand($malaysianNames)];
                $donorEmail = strtolower(str_replace(' ', '.', $donorName)) . '@example.com';
            }
            
            // Generate Malaysian phone number
            $donorPhone = null;
            if (rand(0, 100) < 70) { // 70% provide phone
                $donorPhone = '+60 1' . rand(0, 9) . '-' . rand(100, 999) . ' ' . rand(1000, 9999);
            }
            
            // Add donation message
            $message = null;
            if (rand(0, 100) < 40) { // 40% include message
                $message = $donationMessages[array_rand($donationMessages)];
            }
            
            // Generate transaction ID for non-pending donations
            $transactionId = null;
            if ($status !== 'pending') {
                $transactionId = strtoupper(substr(md5(microtime() . $i), 0, 12));
            }
            
            Donation::create([
                'user_id' => $user?->id,
                'campaign_id' => $campaign->id,
                'donor_name' => $isAnonymous ? 'Anonymous' : $donorName,
                'donor_email' => $donorEmail,
                'donor_phone' => $donorPhone,
                'amount' => $amount,
                'currency' => 'MYR', // Malaysian Ringgit
                'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                'payment_status' => $status,
                'transaction_id' => $transactionId,
                'message' => $message,
                'is_anonymous' => $isAnonymous,
                'paid_at' => $paidAt,
                'created_at' => Carbon::now()->subDays($createdDaysAgo),
                'updated_at' => $paidAt ?? Carbon::now()->subDays($createdDaysAgo),
            ]);
        }
        
        // Create some recurring donations (monthly donors)
        $recurringDonors = $users->take(10); // Top 10 users as recurring donors
        
        foreach ($recurringDonors as $donor) {
            $campaign = $campaigns->random();
            $monthlyAmount = rand(50, 300);
            
            // Create 6 months of recurring donations
            for ($month = 0; $month < 6; $month++) {
                $donationDate = Carbon::now()->subMonths($month)->subDays(rand(1, 28));
                
                Donation::create([
                    'user_id' => $donor->id,
                    'campaign_id' => $campaign->id,
                    'donor_name' => $donor->name,
                    'donor_email' => $donor->email,
                    'donor_phone' => $donor->phone,
                    'amount' => $monthlyAmount + rand(-10, 10), // Slight variation
                    'currency' => 'MYR',
                    'payment_method' => 'fpx_online_banking',
                    'payment_status' => 'completed',
                    'transaction_id' => strtoupper(substr(md5(microtime() . $donor->id . $month), 0, 12)),
                    'message' => 'Monthly recurring donation - Barakallahu feeki',
                    'is_anonymous' => false,
                    'paid_at' => $donationDate,
                    'created_at' => $donationDate,
                    'updated_at' => $donationDate,
                ]);
            }
        }
        
        // Update campaign raised amounts based on completed donations
        foreach ($campaigns as $campaign) {
            $completedDonations = Donation::where('campaign_id', $campaign->id)
                ->where('payment_status', 'completed')
                ->sum('amount');
            
            $campaign->raised_amount = $completedDonations;
            $campaign->save();
        }
        
        $this->command->info('Created ' . Donation::count() . ' donations across ' . $campaigns->count() . ' campaigns.');
    }
}
