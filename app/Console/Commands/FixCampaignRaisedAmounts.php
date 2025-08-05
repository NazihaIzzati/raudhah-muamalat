<?php

namespace App\Console\Commands;

use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixCampaignRaisedAmounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'campaigns:fix-raised-amounts {--dry-run : Show what would be changed without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix campaign raised amounts by recalculating from actual completed donations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $isDryRun = $this->option('dry-run');
        
        if ($isDryRun) {
            $this->info('🔍 DRY RUN MODE - No changes will be made');
        }

        $this->info('📊 Analyzing campaign raised amounts...');
        
        $campaigns = Campaign::all();
        $totalDiscrepancies = 0;
        $totalFixed = 0;
        
        $this->table(
            ['Campaign ID', 'Campaign Title', 'Current Raised', 'Actual Donations', 'Difference', 'Action'],
            []
        );

        foreach ($campaigns as $campaign) {
            // Calculate actual raised amount from completed donations
            $actualRaised = Donation::where('campaign_id', $campaign->id)
                ->where('payment_status', 'completed')
                ->sum('amount');
            
            $currentRaised = $campaign->raised_amount;
            $difference = $currentRaised - $actualRaised;
            
            if (abs($difference) > 0.01) { // Allow for small floating point differences
                $totalDiscrepancies++;
                
                $action = $isDryRun ? 'Would fix' : 'Fixing';
                
                $this->table(
                    ['Campaign ID', 'Campaign Title', 'Current Raised', 'Actual Donations', 'Difference', 'Action'],
                    [[
                        $campaign->id,
                        $campaign->title,
                        'RM ' . number_format($currentRaised, 2),
                        'RM ' . number_format($actualRaised, 2),
                        'RM ' . number_format($difference, 2),
                        $action
                    ]]
                );
                
                if (!$isDryRun) {
                    // Update the campaign's raised amount
                    $campaign->raised_amount = $actualRaised;
                    $campaign->save();
                    
                    // Log the audit trail
                    $campaign->logCustomAction(
                        'goal_updated',
                        "Campaign raised amount corrected from RM " . number_format($currentRaised, 2) . " to RM " . number_format($actualRaised, 2) . " based on actual donations"
                    );
                    
                    $totalFixed++;
                }
            }
        }
        
        if ($totalDiscrepancies === 0) {
            $this->info('✅ All campaign raised amounts are correct!');
        } else {
            if ($isDryRun) {
                $this->warn("⚠️  Found {$totalDiscrepancies} campaigns with incorrect raised amounts");
                $this->info('Run without --dry-run to fix the discrepancies');
            } else {
                $this->info("✅ Fixed {$totalFixed} campaigns with incorrect raised amounts");
            }
        }
        
        // Show summary statistics
        $this->newLine();
        $this->info('📈 Summary Statistics:');
        
        $totalCampaigns = Campaign::count();
        $totalRaised = Campaign::sum('raised_amount');
        $totalDonations = Donation::where('payment_status', 'completed')->sum('amount');
        
        $this->table(
            ['Metric', 'Value'],
            [
                ['Total Campaigns', $totalCampaigns],
                ['Total Raised (Campaigns)', 'RM ' . number_format($totalRaised, 2)],
                ['Total Donations', 'RM ' . number_format($totalDonations, 2)],
                ['Discrepancies Found', $totalDiscrepancies],
                ['Campaigns Fixed', $totalFixed],
            ]
        );
        
        return 0;
    }
} 