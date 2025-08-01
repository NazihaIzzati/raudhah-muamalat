<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PaynetService;
use App\Models\FpxBank;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class UpdateFpxBankStatus extends Command
{
    protected $signature = 'fpx:update-bank-status {--force : Force update even during maintenance} {--detailed : Show detailed output}';
    protected $description = 'Update FPX bank status from Paynet and handle maintenance windows';

    public function handle()
    {
        $this->info('🏦 Updating FPX Bank Status from Paynet');
        $this->line('');

        $paynetService = new PaynetService();
        $detailed = $this->option('detailed');
        $force = $this->option('force');

        // Check if we're in maintenance window (12am - 1am)
        if ($this->isMaintenanceWindow() && !$force) {
            $this->warn('⚠️  Currently in FPX maintenance window (12:00 AM - 1:00 AM)');
            $this->warn('   Banks may be temporarily unavailable for maintenance.');
            $this->warn('   Use --force to update anyway.');
            $this->line('');
            
            if (!$this->confirm('Do you want to continue with the update?')) {
                $this->info('Update cancelled.');
                return;
            }
        }

        // Get current bank status summary
        $this->showCurrentStatus($detailed);

        // Update bank status from Paynet
        $this->updateBankStatus($paynetService, $detailed);

        // Show updated status
        $this->showUpdatedStatus($detailed);

        $this->info('✅ FPX Bank Status Update Completed!');
    }

    private function isMaintenanceWindow()
    {
        $now = Carbon::now();
        $maintenanceStart = Carbon::today()->setTime(0, 0); // 12:00 AM
        $maintenanceEnd = Carbon::today()->setTime(1, 0);   // 1:00 AM

        return $now->between($maintenanceStart, $maintenanceEnd);
    }

    private function showCurrentStatus($detailed)
    {
        $this->info('📊 Current Bank Status Summary');
        
        $summary = (new PaynetService())->getBankStatusSummary();
        
        if ($summary) {
            $this->line("  Total Banks: {$summary['total_banks']}");
            $this->line("  Online Banks: {$summary['online_banks']}");
            $this->line("  Offline Banks: {$summary['offline_banks']}");
            $this->line("  Active Banks: {$summary['active_banks']}");
            
            if ($summary['last_updated']) {
                $lastUpdated = Carbon::parse($summary['last_updated']);
                $this->line("  Last Updated: {$lastUpdated->format('Y-m-d H:i:s')} ({$lastUpdated->diffForHumans()})");
            }
        }

        if ($detailed) {
            $this->line('');
            $this->info('📋 Detailed Bank List:');
            
            $banks = FpxBank::orderBy('display_name')->get();
            $table = [];
            
            foreach ($banks as $bank) {
                $status = $bank->bank_status ? '🟢 Online' : '🔴 Offline';
                $active = $bank->is_active ? '✅ Active' : '❌ Inactive';
                $lastUpdated = $bank->last_updated ? $bank->last_updated->format('H:i:s') : 'Never';
                
                $table[] = [
                    $bank->bank_id,
                    $bank->display_name,
                    $status,
                    $active,
                    $lastUpdated
                ];
            }
            
            $this->table(['Bank ID', 'Bank Name', 'Status', 'Active', 'Last Updated'], $table);
        }

        $this->line('');
    }

    private function updateBankStatus($paynetService, $detailed)
    {
        $this->info('🔄 Updating Bank Status from Paynet...');
        
        try {
            $updatedCount = $paynetService->updateBankStatusFromFpx();
            
            if ($updatedCount !== false) {
                $this->line("  ✅ Successfully updated {$updatedCount} banks");
                
                if ($detailed) {
                    $this->line('');
                    $this->info('📡 Paynet Response Details:');
                    
                    // Get the latest bank status from Paynet
                    $bankStatus = $paynetService->sendBankEnquiryMessage();
                    
                    if ($bankStatus) {
                        $this->line("  Total banks in response: " . count($bankStatus));
                        
                        $onlineCount = 0;
                        $offlineCount = 0;
                        
                        foreach ($bankStatus as $bankId => $status) {
                            $statusText = $status === 'A' ? '🟢 Online' : '🔴 Offline';
                            if ($status === 'A') $onlineCount++;
                            else $offlineCount++;
                            
                            $this->line("    {$bankId}: {$statusText}");
                        }
                        
                        $this->line('');
                        $this->line("  Summary: {$onlineCount} online, {$offlineCount} offline");
                    }
                }
            } else {
                $this->error('  ❌ Failed to update bank status from Paynet');
                $this->line('  This might be due to:');
                $this->line('    - Network connectivity issues');
                $this->line('    - Paynet service maintenance');
                $this->line('    - Invalid credentials or keys');
                $this->line('    - Environment configuration issues');
            }
            
        } catch (\Exception $e) {
            $this->error("  ❌ Error updating bank status: {$e->getMessage()}");
        }

        $this->line('');
    }

    private function showUpdatedStatus($detailed)
    {
        $this->info('📊 Updated Bank Status Summary');
        
        $summary = (new PaynetService())->getBankStatusSummary();
        
        if ($summary) {
            $this->line("  Total Banks: {$summary['total_banks']}");
            $this->line("  Online Banks: {$summary['online_banks']}");
            $this->line("  Offline Banks: {$summary['offline_banks']}");
            $this->line("  Active Banks: {$summary['active_banks']}");
            
            if ($summary['last_updated']) {
                $lastUpdated = Carbon::parse($summary['last_updated']);
                $this->line("  Last Updated: {$lastUpdated->format('Y-m-d H:i:s')} ({$lastUpdated->diffForHumans()})");
            }
        }

        // Show banks that are currently offline
        $offlineBanks = FpxBank::offline()->where('is_active', true)->get();
        
        if ($offlineBanks->count() > 0) {
            $this->line('');
            $this->warn('⚠️  Currently Offline Banks:');
            
            foreach ($offlineBanks as $bank) {
                $lastUpdated = $bank->last_updated ? $bank->last_updated->format('H:i:s') : 'Never';
                $this->line("  - {$bank->display_name} (Last updated: {$lastUpdated})");
            }
        }

        // Show maintenance window info
        if ($this->isMaintenanceWindow()) {
            $this->line('');
            $this->warn('⚠️  Maintenance Window Active (12:00 AM - 1:00 AM)');
            $this->line('   Some banks may be temporarily unavailable for system maintenance.');
            $this->line('   This is normal and expected during this time period.');
        }

        $this->line('');
    }
}
