<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FpxBank;

class FpxBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banks = [
            // Commercial Banks
            ['bank_id' => 'MB2U0227', 'bank_name' => 'Maybank Berhad', 'display_name' => 'Maybank', 'bank_type' => 'commercial'],
            ['bank_id' => 'CIMB0229', 'bank_name' => 'CIMB Bank Berhad', 'display_name' => 'CIMB Bank', 'bank_type' => 'commercial'],
            ['bank_id' => 'RHB0218', 'bank_name' => 'RHB Bank Berhad', 'display_name' => 'RHB Bank', 'bank_type' => 'commercial'],
            ['bank_id' => 'PBB0233', 'bank_name' => 'Public Bank Berhad', 'display_name' => 'Public Bank', 'bank_type' => 'commercial'],
            ['bank_id' => 'HLB0224', 'bank_name' => 'Hong Leong Bank Berhad', 'display_name' => 'Hong Leong Bank', 'bank_type' => 'commercial'],
            ['bank_id' => 'UOB0226', 'bank_name' => 'United Overseas Bank (Malaysia) Berhad', 'display_name' => 'UOB Bank', 'bank_type' => 'commercial'],
            ['bank_id' => 'OCBC0229', 'bank_name' => 'OCBC Bank (Malaysia) Berhad', 'display_name' => 'OCBC Bank', 'bank_type' => 'commercial'],
            ['bank_id' => 'HSBC0223', 'bank_name' => 'HSBC Bank Malaysia Berhad', 'display_name' => 'HSBC Bank', 'bank_type' => 'commercial'],
            ['bank_id' => 'SCB0216', 'bank_name' => 'Standard Chartered Bank Malaysia Berhad', 'display_name' => 'Standard Chartered', 'bank_type' => 'commercial'],
            ['bank_id' => 'CIT0219', 'bank_name' => 'Citibank Berhad', 'display_name' => 'Citibank', 'bank_type' => 'commercial'],
            ['bank_id' => 'ABMB0212', 'bank_name' => 'Alliance Bank Malaysia Berhad', 'display_name' => 'Alliance Bank', 'bank_type' => 'commercial'],
            ['bank_id' => 'AFB0231', 'bank_name' => 'AmBank (M) Berhad', 'display_name' => 'AmBank', 'bank_type' => 'commercial'],
            ['bank_id' => 'MBSB0220', 'bank_name' => 'Malaysia Building Society Berhad', 'display_name' => 'MBSB Bank', 'bank_type' => 'commercial'],
            ['bank_id' => 'BIMB0340', 'bank_name' => 'Bank Islam Malaysia Berhad', 'display_name' => 'Bank Islam', 'bank_type' => 'islamic'],
            ['bank_id' => 'BKRM0602', 'bank_name' => 'Bank Kerjasama Rakyat Malaysia Berhad', 'display_name' => 'Bank Rakyat', 'bank_type' => 'islamic'],
            ['bank_id' => 'BSN0601', 'bank_name' => 'Bank Simpanan Nasional', 'display_name' => 'BSN', 'bank_type' => 'government'],
            ['bank_id' => 'AGRO01', 'bank_name' => 'Agro Bank', 'display_name' => 'Agro Bank', 'bank_type' => 'government'],
            
            // Islamic Banks
            ['bank_id' => 'BIMB0340', 'bank_name' => 'Bank Islam Malaysia Berhad', 'display_name' => 'Bank Islam', 'bank_type' => 'islamic'],
            ['bank_id' => 'AMMB0209', 'bank_name' => 'AmBank Islamic Berhad', 'display_name' => 'AmBank Islamic', 'bank_type' => 'islamic'],
            ['bank_id' => 'CIMB0229', 'bank_name' => 'CIMB Islamic Bank Berhad', 'display_name' => 'CIMB Islamic', 'bank_type' => 'islamic'],
            ['bank_id' => 'HLB0224', 'bank_name' => 'Hong Leong Islamic Bank Berhad', 'display_name' => 'Hong Leong Islamic', 'bank_type' => 'islamic'],
            ['bank_id' => 'MB2U0227', 'bank_name' => 'Maybank Islamic Berhad', 'display_name' => 'Maybank Islamic', 'bank_type' => 'islamic'],
            ['bank_id' => 'PBB0233', 'bank_name' => 'Public Islamic Bank Berhad', 'display_name' => 'Public Islamic Bank', 'bank_type' => 'islamic'],
            ['bank_id' => 'RHB0218', 'bank_name' => 'RHB Islamic Bank Berhad', 'display_name' => 'RHB Islamic Bank', 'bank_type' => 'islamic'],
            
            // Digital Banks
            ['bank_id' => 'BOOST0588', 'bank_name' => 'Boost Bank', 'display_name' => 'Boost Bank', 'bank_type' => 'digital'],
            ['bank_id' => 'TOUCHNGO0588', 'bank_name' => 'Touch n Go eWallet', 'display_name' => 'Touch n Go', 'bank_type' => 'digital'],
            ['bank_id' => 'GRABPAY0588', 'bank_name' => 'GrabPay', 'display_name' => 'GrabPay', 'bank_type' => 'digital'],
            
            // Test Banks (for development)
            ['bank_id' => 'TEST0022', 'bank_name' => 'Test Bank 1', 'display_name' => 'Test Bank 1', 'bank_type' => 'test'],
            ['bank_id' => 'TEST0023', 'bank_name' => 'Test Bank 2', 'display_name' => 'Test Bank 2', 'bank_type' => 'test'],
            ['bank_id' => 'TEST0024', 'bank_name' => 'Test Bank 3', 'display_name' => 'Test Bank 3', 'bank_type' => 'test'],
        ];

        foreach ($banks as $bank) {
            FpxBank::create([
                'bank_id' => $bank['bank_id'],
                'bank_name' => $bank['bank_name'],
                'display_name' => $bank['display_name'],
                'bank_type' => $bank['bank_type'],
                'bank_status' => true,
                'is_active' => $bank['bank_type'] !== 'test' || app()->environment('local', 'testing')
            ]);
        }

        $this->command->info('FPX Banks seeded successfully!');
    }
}
