<?php

namespace App\Console\Commands;

use App\Models\Campaign;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ManageFeaturedCampaigns extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'campaigns:manage-featured {--auto : Automatically select campaigns to feature} {--limit=3 : Maximum number of featured campaigns}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manage featured campaigns - automatically select or manually manage';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->option('auto')) {
            $this->autoSelectFeaturedCampaigns();
        } else {
            $this->showFeaturedCampaigns();
        }

        return Command::SUCCESS;
    }

    /**
     * Automatically select campaigns to feature based on criteria
     */
    private function autoSelectFeaturedCampaigns()
    {
        $this->info('Automatically selecting featured campaigns...');

        // First, unfeature all current featured campaigns
        Campaign::where('featured', true)->update(['featured' => false]);

        $limit = (int) $this->option('limit');

        // Select campaigns based on multiple criteria
        $featuredCampaigns = Campaign::where('status', 'active')
            ->where(function($query) {
                $query->whereNull('end_date')
                      ->orWhere('end_date', '>', now());
            })
            ->orderByRaw('
                (raised_amount / goal_amount) DESC,
                donor_count DESC,
                created_at DESC
            ')
            ->take($limit)
            ->get();

        $updatedCount = 0;

        foreach ($featuredCampaigns as $campaign) {
            $campaign->featured = true;
            $campaign->display_order = $updatedCount + 1;
            $campaign->save();
            $updatedCount++;

            $percentage = $campaign->percentageReached();
            $this->info("Featured: '{$campaign->title}' ({$percentage}% funded, {$campaign->donor_count} donors)");
        }

        $this->info("Auto-selection completed. {$updatedCount} campaigns featured.");
        
        Log::info("Featured campaigns auto-selected", [
            'count' => $updatedCount,
            'campaigns' => $featuredCampaigns->pluck('id')->toArray()
        ]);
    }

    /**
     * Show current featured campaigns and provide management options
     */
    private function showFeaturedCampaigns()
    {
        $featuredCampaigns = Campaign::where('featured', true)
            ->orderBy('display_order', 'asc')
            ->get();

        if ($featuredCampaigns->isEmpty()) {
            $this->info('No campaigns are currently featured.');
            return;
        }

        $this->info('Current Featured Campaigns:');
        $this->newLine();

        foreach ($featuredCampaigns as $campaign) {
            $percentage = $campaign->percentageReached();
            $status = $campaign->hasEnded() ? 'Ended' : 'Active';
            
            $this->line("• {$campaign->title}");
            $this->line("  Status: {$status} | Progress: {$percentage}% | Donors: {$campaign->donor_count}");
            $this->line("  Display Order: {$campaign->display_order}");
            $this->newLine();
        }

        $this->info('Use --auto flag to automatically select featured campaigns based on performance.');
    }
} 