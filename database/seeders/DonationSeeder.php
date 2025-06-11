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
        $users = User::all();
        
        // Payment methods
        $paymentMethods = ['credit_card', 'paypal', 'bank_transfer', 'cash', 'crypto'];
        
        // Payment statuses
        $statuses = ['completed', 'pending', 'failed', 'refunded'];
        
        // Create 50 random donations
        for ($i = 0; $i < 50; $i++) {
            $campaign = $campaigns->random();
            $isAnonymous = rand(0, 1) === 1;
            $amount = rand(10, 1000);
            $status = $statuses[array_rand($statuses)];
            $paidAt = $status === 'completed' ? Carbon::now()->subDays(rand(1, 30)) : null;
            
            // Randomly assign to a user or make it a guest donation
            $user = rand(0, 1) === 1 && !$users->isEmpty() ? $users->random() : null;
            
            Donation::create([
                'user_id' => $user ? $user->id : null,
                'campaign_id' => $campaign->id,
                'donor_name' => $user ? $user->name : fake()->name(),
                'donor_email' => $user ? $user->email : fake()->safeEmail(),
                'donor_phone' => rand(0, 1) === 1 ? fake()->phoneNumber() : null,
                'amount' => $amount,
                'currency' => 'USD',
                'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                'payment_status' => $status,
                'transaction_id' => $status !== 'pending' ? strtoupper(substr(md5(microtime()), 0, 10)) : null,
                'message' => rand(0, 1) === 1 ? fake()->paragraph(2) : null,
                'is_anonymous' => $isAnonymous,
                'paid_at' => $paidAt,
                'created_at' => $paidAt ?? Carbon::now()->subDays(rand(1, 45)),
            ]);
        }
        
        // Update campaign raised amounts based on completed donations
        foreach ($campaigns as $campaign) {
            $completedDonations = Donation::where('campaign_id', $campaign->id)
                ->where('payment_status', 'completed')
                ->sum('amount');
            
            $campaign->raised_amount = $completedDonations;
            $campaign->save();
        }
    }
}
