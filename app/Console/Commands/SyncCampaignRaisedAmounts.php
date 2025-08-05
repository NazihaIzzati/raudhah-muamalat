<?php

namespace App\Console\Commands;

use App\Models\Campaign;
use Illuminate\Console\Command;

class SyncCampaignRaisedAmounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'campaigns:sync-raised-amounts {--campaign-id= : Sync specific campaign by ID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize campaign raised amounts with actual completed donations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $campaignId = $this->option('campaign-id');
        
        if ($campaignId) {
            $campaign = Campaign::find($campaignId);
            if (!$campaign) {
                $this->error("Campaign with ID {$campaignId} not found.");
                return 1;
            }
            
            $this->info("Syncing campaign: {$campaign->title}");
            $this->syncCampaign($campaign);
        } else {
            $this->info('🔄 Syncing all campaign raised amounts...');
            
            $campaigns = Campaign::all();
            $totalCampaigns = $campaigns->count();
            $syncedCount = 0;
            
            $progressBar = $this->output->createProgressBar($totalCampaigns);
            $progressBar->start();
            
            foreach ($campaigns as $campaign) {
                if ($this->syncCampaign($campaign, false)) {
                    $syncedCount++;
                }
                $progressBar->advance();
            }
            
            $progressBar->finish();
            $this->newLine();
            
            $this->info("✅ Sync completed! {$syncedCount} campaigns updated out of {$totalCampaigns} total campaigns.");
        }
        
        return 0;
    }
    
    /**
     * Sync a single campaign's raised amount.
     */
    private function syncCampaign(Campaign $campaign, bool $showOutput = true)
    {
        $actualRaised = $campaign->actual_raised_amount;
        $currentRaised = $campaign->raised_amount;
        
        if (abs($currentRaised - $actualRaised) > 0.01) {
            if ($showOutput) {
                $this->warn("  ⚠️  Discrepancy found:");
                $this->line("     Current: RM " . number_format($currentRaised, 2));
                $this->line("     Actual:  RM " . number_format($actualRaised, 2));
                $this->line("     Difference: RM " . number_format($currentRaised - $actualRaised, 2));
            }
            
            $campaign->syncRaisedAmount();
            
            if ($showOutput) {
                $this->info("  ✅ Synced successfully!");
            }
            
            return true;
        } else {
            if ($showOutput) {
                $this->info("  ✅ Already in sync (RM " . number_format($currentRaised, 2) . ")");
            }
            
            return false;
        }
    }
} 