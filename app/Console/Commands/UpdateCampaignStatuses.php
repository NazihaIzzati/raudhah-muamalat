<?php

namespace App\Console\Commands;

use App\Models\Campaign;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateCampaignStatuses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'campaigns:update-statuses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update campaign statuses based on end dates and success criteria';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting campaign status update...');

        // Get campaigns that have ended but are still marked as active
        $endedCampaigns = Campaign::where('status', 'active')
            ->whereNotNull('end_date')
            ->where('end_date', '<=', now())
            ->get();

        $updatedCount = 0;

        foreach ($endedCampaigns as $campaign) {
            $oldStatus = $campaign->status;
            $percentage = $campaign->percentageReached();

            // Determine new status based on success criteria
            if ($percentage >= 100) {
                $campaign->status = 'completed';
                $this->info("Campaign '{$campaign->title}' marked as completed (100%+ goal reached)");
            } elseif ($percentage >= 70) {
                $campaign->status = 'completed';
                $this->info("Campaign '{$campaign->title}' marked as completed (70%+ goal reached)");
            } else {
                $campaign->status = 'ended';
                $this->info("Campaign '{$campaign->title}' marked as ended (less than 70% goal reached)");
            }

            $campaign->save();
            $updatedCount++;

            // Log the status change
            Log::info("Campaign status updated", [
                'campaign_id' => $campaign->id,
                'campaign_title' => $campaign->title,
                'old_status' => $oldStatus,
                'new_status' => $campaign->status,
                'percentage_reached' => $percentage,
                'goal_amount' => $campaign->goal_amount,
                'raised_amount' => $campaign->raised_amount,
            ]);
        }

        // Also check for campaigns that have reached 100% but haven't been marked as completed
        $successfulCampaigns = Campaign::where('status', 'active')
            ->whereRaw('(raised_amount / goal_amount) >= 1.0')
            ->get();

        foreach ($successfulCampaigns as $campaign) {
            if ($campaign->status !== 'completed') {
                $campaign->status = 'completed';
                $campaign->save();
                $updatedCount++;

                $this->info("Campaign '{$campaign->title}' marked as completed (100% goal reached)");
                
                Log::info("Campaign marked as completed due to 100% goal reached", [
                    'campaign_id' => $campaign->id,
                    'campaign_title' => $campaign->title,
                    'goal_amount' => $campaign->goal_amount,
                    'raised_amount' => $campaign->raised_amount,
                ]);
            }
        }

        $this->info("Campaign status update completed. {$updatedCount} campaigns updated.");
        
        return Command::SUCCESS;
    }
} 