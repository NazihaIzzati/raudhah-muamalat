<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('🌱 Starting database seeding...');
        
        // Seed in order of dependencies
        $this->call([
            // Users first (required for other modules)
            UserSeeder::class,
            
            // Campaigns (required for donations and some posters)
            CampaignSeeder::class,
            
            // Donations (depends on users and campaigns)
            DonationSeeder::class,
            
            // Posters (can reference campaigns)
            PosterSeeder::class,
            
            // Events (independent)
            EventSeeder::class,
            
            // Partners (independent)
            PartnerSeeder::class,
            
            // FAQs (depends on users)
            FaqSeeder::class,
            
            // Contacts (independent)
            ContactSeeder::class,
            
            // News (independent)
            NewsSeeder::class,
        ]);
        
        $this->command->info('✅ Database seeding completed successfully!');
        $this->command->info('');
        $this->command->info('📊 Summary:');
        $this->command->info('👥 Users: ' . \App\Models\User::count());
        $this->command->info('🎯 Campaigns: ' . \App\Models\Campaign::count());
        $this->command->info('💰 Donations: ' . \App\Models\Donation::count());
        $this->command->info('📋 Posters: ' . \App\Models\Poster::count());
        $this->command->info('📅 Events: ' . \App\Models\Event::count());
        $this->command->info('🤝 Partners: ' . \App\Models\Partner::count());
        $this->command->info('❓ FAQs: ' . \App\Models\Faq::count());
        $this->command->info('📧 Contacts: ' . \App\Models\Contact::count());
        $this->command->info('📰 News: ' . \App\Models\News::count());
        $this->command->info('');
        $this->command->info('🔑 Admin Login:');
        $this->command->info('Email: admin@raudhahmuamalat.com');
        $this->command->info('Password: password123');
    }
}
