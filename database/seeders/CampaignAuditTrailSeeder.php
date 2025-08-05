<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\CampaignAuditTrail;
use App\Models\Staff;
use Illuminate\Database\Seeder;

class CampaignAuditTrailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $campaigns = Campaign::all();
        $staff = Staff::first();

        if ($campaigns->isEmpty()) {
            $this->command->info('No campaigns found. Please run CampaignSeeder first.');
            return;
        }

        foreach ($campaigns as $campaign) {
            // Create initial creation audit trail
            CampaignAuditTrail::create([
                'campaign_id' => $campaign->id,
                'action' => 'created',
                'description' => 'Campaign was created',
                'performed_by' => $staff ? $staff->id : null,
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Seeder',
                'created_at' => $campaign->created_at,
                'updated_at' => $campaign->created_at,
            ]);

            // Create status change audit trail if status is not draft
            if ($campaign->status !== 'draft') {
                CampaignAuditTrail::create([
                    'campaign_id' => $campaign->id,
                    'action' => 'status_changed',
                    'description' => "Campaign status changed from draft to {$campaign->status}",
                    'old_values' => ['status' => 'draft'],
                    'new_values' => ['status' => $campaign->status],
                    'performed_by' => $staff ? $staff->id : null,
                    'ip_address' => '127.0.0.1',
                    'user_agent' => 'Seeder',
                    'created_at' => $campaign->created_at->addHours(1),
                    'updated_at' => $campaign->created_at->addHours(1),
                ]);
            }

            // Create featured status audit trail if featured
            if ($campaign->featured) {
                CampaignAuditTrail::create([
                    'campaign_id' => $campaign->id,
                    'action' => 'featured_toggled',
                    'description' => 'Campaign featured status changed from Not Featured to Featured',
                    'old_values' => ['featured' => false],
                    'new_values' => ['featured' => true],
                    'performed_by' => $staff ? $staff->id : null,
                    'ip_address' => '127.0.0.1',
                    'user_agent' => 'Seeder',
                    'created_at' => $campaign->created_at->addHours(2),
                    'updated_at' => $campaign->created_at->addHours(2),
                ]);
            }

            // Create donation received audit trails for campaigns with raised amounts
            if ($campaign->raised_amount > 0) {
                $donationCount = min(5, intval($campaign->raised_amount / 1000)); // Simulate donations
                for ($i = 1; $i <= $donationCount; $i++) {
                    $amount = rand(50, 500);
                    CampaignAuditTrail::create([
                        'campaign_id' => $campaign->id,
                        'action' => 'donation_received',
                        'description' => "Donation received: " . number_format($amount, 2) . " from Anonymous Donor",
                        'performed_by' => null, // Anonymous donation
                        'ip_address' => '127.0.0.1',
                        'user_agent' => 'Seeder',
                        'created_at' => $campaign->created_at->addDays($i),
                        'updated_at' => $campaign->created_at->addDays($i),
                    ]);
                }

                // Create milestone reached audit trail if percentage is high
                $percentage = $campaign->percentageReached();
                if ($percentage >= 50) {
                    CampaignAuditTrail::create([
                        'campaign_id' => $campaign->id,
                        'action' => 'milestone_reached',
                        'description' => "Campaign reached 50% milestone ({$percentage}% funded)",
                        'performed_by' => $staff ? $staff->id : null,
                        'ip_address' => '127.0.0.1',
                        'user_agent' => 'Seeder',
                        'created_at' => $campaign->created_at->addDays(3),
                        'updated_at' => $campaign->created_at->addDays(3),
                    ]);
                }

                if ($percentage >= 100) {
                    CampaignAuditTrail::create([
                        'campaign_id' => $campaign->id,
                        'action' => 'milestone_reached',
                        'description' => "Campaign reached 100% milestone ({$percentage}% funded)",
                        'performed_by' => $staff ? $staff->id : null,
                        'ip_address' => '127.0.0.1',
                        'user_agent' => 'Seeder',
                        'created_at' => $campaign->created_at->addDays(5),
                        'updated_at' => $campaign->created_at->addDays(5),
                    ]);
                }
            }

            // Create completion audit trail for completed campaigns
            if ($campaign->status === 'completed') {
                CampaignAuditTrail::create([
                    'campaign_id' => $campaign->id,
                    'action' => 'completed',
                    'description' => 'Campaign was marked as completed',
                    'performed_by' => $staff ? $staff->id : null,
                    'ip_address' => '127.0.0.1',
                    'user_agent' => 'Seeder',
                    'created_at' => $campaign->created_at->addDays(7),
                    'updated_at' => $campaign->created_at->addDays(7),
                ]);
            }
        }

        $this->command->info('Campaign audit trail data seeded successfully!');
        $this->command->info('Total audit trail entries created: ' . CampaignAuditTrail::count());
    }
} 