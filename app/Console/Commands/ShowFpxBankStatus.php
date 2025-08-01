<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FpxBank;
use App\Services\PaynetService;
use Carbon\Carbon;

class ShowFpxBankStatus extends Command
{
    protected $signature = 'fpx:show-bank-status {--refresh : Refresh status from Paynet} {--detailed : Show detailed information} {--offline-only : Show only offline banks}';
    protected $description = 'Show current FPX bank status and handle maintenance windows';

    public function handle()
    {
        $this->info('🏦 FPX Bank Status Report');
        $this->line('');

        $refresh = $this->option('refresh');
        $detailed = $this->option('detailed');
        $offlineOnly = $this->option('offline-only');

        // Check maintenance window
        $this->checkMaintenanceWindow();

        // Refresh status if requested
        if ($refresh) {
            $this->refreshBankStatus();
        }

        // Show bank status
        $this->showBankStatus($detailed, $offlineOnly);

        $this->info('✅ Bank Status Report Completed!');
    }

    private function checkMaintenanceWindow()
    {
        $now = Carbon::now();
        $maintenanceStart = Carbon::today()->setTime(0, 0); // 12:00 AM
        $maintenanceEnd = Carbon::today()->setTime(1, 0);   // 1:00 AM

        if ($now->between($maintenanceStart, $maintenanceEnd)) {
            $this->warn('⚠️  MAINTENANCE WINDOW ACTIVE');
            $this->line('   Time: 12:00 AM - 1:00 AM');
            $this->line('   Status: FPX system maintenance in progress');
            $this->line('   Impact: Some banks may be temporarily unavailable');
            $this->line('');
        }
    }

    private function refreshBankStatus()
    {
        $this->info('🔄 Refreshing bank status from Paynet...');
        
        try {
            $paynetService = new PaynetService();
            $updatedCount = $paynetService->updateBankStatusFromFpx();
            
            if ($updatedCount !== false) {
                $this->line("  ✅ Successfully updated {$updatedCount} banks");
            } else {
                $this->error('  ❌ Failed to update bank status');
                $this->line('  Using cached status from database...');
            }
        } catch (\Exception $e) {
            $this->error("  ❌ Error refreshing status: {$e->getMessage()}");
            $this->line('  Using cached status from database...');
        }

        $this->line('');
    }

    private function showBankStatus($detailed, $offlineOnly)
    {
        // Get summary
        $paynetService = new PaynetService();
        $summary = $paynetService->getBankStatusSummary();

        if ($summary) {
            $this->info('📊 Bank Status Summary');
            $this->line("  Total Banks: {$summary['total_banks']}");
            $this->line("  Online Banks: {$summary['online_banks']}");
            $this->line("  Offline Banks: {$summary['offline_banks']}");
            $this->line("  Active Banks: {$summary['active_banks']}");
            
            if ($summary['last_updated']) {
                $lastUpdated = Carbon::parse($summary['last_updated']);
                $this->line("  Last Updated: {$lastUpdated->format('Y-m-d H:i:s')} ({$lastUpdated->diffForHumans()})");
            }

            // Show status indicators
            $this->line('');
            $this->line('  Status Indicators:');
            $this->line('    🟢 Online - Bank is available for transactions');
            $this->line('    🔴 Offline - Bank is temporarily unavailable');
            $this->line('    ⚠️  Maintenance - System maintenance in progress');
        }

        // Get banks based on filter
        if ($offlineOnly) {
            $banks = FpxBank::offline()->where('is_active', true)->orderBy('display_name')->get();
            $this->line('');
            $this->warn('⚠️  Currently Offline Banks:');
        } else {
            $banks = FpxBank::where('is_active', true)->orderBy('display_name')->get();
            $this->line('');
            $this->info('📋 Bank List:');
        }

        if ($banks->count() === 0) {
            $this->line('  No banks found matching criteria.');
            return;
        }

        $table = [];
        $onlineCount = 0;
        $offlineCount = 0;

        foreach ($banks as $bank) {
            $status = $bank->bank_status ? '🟢 Online' : '🔴 Offline';
            $lastUpdated = $bank->last_updated ? $bank->last_updated->format('H:i:s') : 'Never';
            
            if ($bank->bank_status) $onlineCount++;
            else $offlineCount++;

            $row = [
                $bank->bank_id,
                $bank->display_name,
                $status,
                $lastUpdated
            ];

            if ($detailed) {
                $row[] = $bank->bank_type;
                $row[] = $bank->bank_name;
            }

            $table[] = $row;
        }

        $headers = ['Bank ID', 'Display Name', 'Status', 'Last Updated'];
        if ($detailed) {
            $headers[] = 'Type';
            $headers[] = 'Full Name';
        }

        $this->table($headers, $table);

        // Show summary
        if (!$offlineOnly) {
            $this->line('');
            $this->line("  Summary: {$onlineCount} online, {$offlineCount} offline");
        }

        // Show maintenance info
        $this->showMaintenanceInfo();
    }

    private function showMaintenanceInfo()
    {
        $this->line('');
        $this->info('ℹ️  Maintenance Information:');
        $this->line('  • FPX system maintenance: Daily 12:00 AM - 1:00 AM');
        $this->line('  • During maintenance, some banks may be offline');
        $this->line('  • Status is automatically updated after maintenance');
        $this->line('  • Use --refresh to get latest status from Paynet');
        $this->line('');
        $this->line('  Commands:');
        $this->line('    php artisan fpx:show-bank-status --refresh');
        $this->line('    php artisan fpx:show-bank-status --detailed');
        $this->line('    php artisan fpx:show-bank-status --offline-only');
        $this->line('    php artisan fpx:update-bank-status --force');
    }
} 