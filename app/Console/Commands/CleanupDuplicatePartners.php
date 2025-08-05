<?php

namespace App\Console\Commands;

use App\Models\Partner;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanupDuplicatePartners extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'partners:cleanup-duplicates {--dry-run : Show what would be deleted without actually deleting}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up duplicate partners by keeping the first occurrence and removing duplicates';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $isDryRun = $this->option('dry-run');
        
        $this->info('Starting duplicate partner cleanup...');
        if ($isDryRun) {
            $this->warn('DRY RUN MODE - No changes will be made');
        }
        
        // Get all active partners
        $partners = Partner::where('status', 'active')->orderBy('id')->get();
        
        // Group by name to find duplicates
        $groupedPartners = $partners->groupBy('name');
        
        $duplicatesFound = 0;
        $partnersToDelete = collect();
        
        foreach ($groupedPartners as $name => $partnersWithSameName) {
            if ($partnersWithSameName->count() > 1) {
                $duplicatesFound++;
                $this->line("Found duplicates for '{$name}':");
                
                // Keep the first one (lowest ID), mark others for deletion
                $firstPartner = $partnersWithSameName->first();
                $duplicates = $partnersWithSameName->skip(1);
                
                $this->line("  Keeping: ID {$firstPartner->id} - {$firstPartner->name}");
                
                foreach ($duplicates as $duplicate) {
                    $this->line("  Will delete: ID {$duplicate->id} - {$duplicate->name}");
                    $partnersToDelete->push($duplicate);
                }
                $this->line('');
            }
        }
        
        if ($duplicatesFound === 0) {
            $this->info('No duplicate partners found!');
            return 0;
        }
        
        $this->info("Found {$duplicatesFound} partner names with duplicates.");
        $this->info("Total partners to delete: {$partnersToDelete->count()}");
        
        if ($isDryRun) {
            $this->warn('DRY RUN: Would delete ' . $partnersToDelete->count() . ' duplicate partners');
            return 0;
        }
        
        if (!$this->confirm('Do you want to proceed with deleting the duplicate partners?')) {
            $this->info('Operation cancelled.');
            return 0;
        }
        
        // Delete duplicates
        $deletedCount = 0;
        foreach ($partnersToDelete as $partner) {
            try {
                $partner->delete();
                $deletedCount++;
                $this->line("Deleted partner ID {$partner->id} - {$partner->name}");
            } catch (\Exception $e) {
                $this->error("Failed to delete partner ID {$partner->id}: " . $e->getMessage());
            }
        }
        
        $this->info("Successfully deleted {$deletedCount} duplicate partners.");
        
        // Show final count
        $finalCount = Partner::where('status', 'active')->count();
        $this->info("Final active partner count: {$finalCount}");
        
        return 0;
    }
}
