<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Partner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create partners
        $partners = Partner::all();
        
        if ($partners->isEmpty()) {
            $this->command->info('No partners found. Please run PartnerSeeder first.');
            return;
        }

        // Featured Campaigns (Active and performing well)
        $featuredCampaigns = [
            [
                'title' => 'Emergency Flood Relief Fund',
                'description' => 'Providing immediate assistance to families affected by recent floods in Kelantan and Terengganu. Your donation will help provide food, clean water, shelter, and medical supplies to those in need.',
                'short_description' => 'Emergency assistance for flood victims in Kelantan and Terengganu',
                'goal_amount' => 500000,
                'raised_amount' => 425000,
                'donor_count' => 1250,
                'featured' => true,
                'display_order' => 1,
                'category' => 'emergency',
                'start_date' => now()->subDays(30),
                'end_date' => now()->addDays(15),
                'status' => 'active',
            ],
            [
                'title' => 'Rural School Computer Lab',
                'description' => 'Building a modern computer lab for rural schools in Sabah to provide digital literacy education to underprivileged students. This will include 20 computers, internet connectivity, and trained teachers.',
                'short_description' => 'Digital education for rural students in Sabah',
                'goal_amount' => 150000,
                'raised_amount' => 142000,
                'donor_count' => 890,
                'featured' => true,
                'display_order' => 2,
                'category' => 'education',
                'start_date' => now()->subDays(45),
                'end_date' => now()->addDays(30),
                'status' => 'active',
            ],
            [
                'title' => 'Clean Water for Rural Villages',
                'description' => 'Installing water purification systems in 10 rural villages in Sarawak to provide clean, safe drinking water to over 500 families who currently rely on contaminated water sources.',
                'short_description' => 'Clean water access for 500 families in Sarawak',
                'goal_amount' => 300000,
                'raised_amount' => 285000,
                'donor_count' => 1100,
                'featured' => true,
                'display_order' => 3,
                'category' => 'water',
                'start_date' => now()->subDays(60),
                'end_date' => now()->addDays(45),
                'status' => 'active',
            ],
        ];

        // Successful Campaigns (Completed or high percentage)
        $successfulCampaigns = [
            [
                'title' => 'COVID-19 PPE Emergency Support',
                'description' => 'Successfully provided 10,000 PPE sets to Selangor Health Department during the critical phase of the COVID-19 pandemic. The campaign exceeded its target and helped protect frontline healthcare workers.',
                'short_description' => 'PPE support for healthcare workers during COVID-19',
                'goal_amount' => 200000,
                'raised_amount' => 250000,
                'donor_count' => 1500,
                'featured' => false,
                'category' => 'healthcare',
                'start_date' => now()->subDays(120),
                'end_date' => now()->subDays(30),
                'status' => 'completed',
            ],
            [
                'title' => 'Rural Islamic School Construction',
                'description' => 'Successfully built a complete Islamic school facility in rural Kelantan, providing quality education to 300 children. The facility includes 8 classrooms, library, computer lab, and prayer hall.',
                'short_description' => 'Islamic school for 300 children in rural Kelantan',
                'goal_amount' => 800000,
                'raised_amount' => 850000,
                'donor_count' => 2200,
                'featured' => false,
                'category' => 'education',
                'start_date' => now()->subDays(180),
                'end_date' => now()->subDays(60),
                'status' => 'completed',
            ],
            [
                'title' => 'Orphan Education Support Program',
                'description' => 'Provided comprehensive education support to 150 orphaned children including school supplies, uniforms, tuition fees, and mentorship programs. The program achieved 95% success rate.',
                'short_description' => 'Education support for 150 orphaned children',
                'goal_amount' => 100000,
                'raised_amount' => 98000,
                'donor_count' => 750,
                'featured' => false,
                'category' => 'orphan',
                'start_date' => now()->subDays(90),
                'end_date' => now()->subDays(15),
                'status' => 'completed',
            ],
            [
                'title' => 'Mobile Health Clinic',
                'description' => 'Launched a mobile health clinic serving remote villages in Pahang. The clinic provides basic healthcare services, vaccinations, and health education to communities with limited access to medical facilities.',
                'short_description' => 'Mobile healthcare for remote villages in Pahang',
                'goal_amount' => 250000,
                'raised_amount' => 240000,
                'donor_count' => 1200,
                'featured' => false,
                'category' => 'healthcare',
                'start_date' => now()->subDays(150),
                'end_date' => now()->subDays(45),
                'status' => 'completed',
            ],
        ];

        // Regular Active Campaigns
        $regularCampaigns = [
            [
                'title' => 'Food Bank for Urban Poor',
                'description' => 'Establishing a food bank network in Kuala Lumpur to provide nutritious meals to urban poor families. The program will serve 1000 families monthly.',
                'short_description' => 'Food assistance for 1000 urban poor families',
                'goal_amount' => 200000,
                'raised_amount' => 85000,
                'donor_count' => 420,
                'featured' => false,
                'category' => 'food',
                'start_date' => now()->subDays(20),
                'end_date' => now()->addDays(40),
                'status' => 'active',
            ],
            [
                'title' => 'Mosque Renovation Project',
                'description' => 'Renovating a historic mosque in Penang to accommodate the growing Muslim community. The project includes prayer hall expansion, modern facilities, and accessibility improvements.',
                'short_description' => 'Historic mosque renovation in Penang',
                'goal_amount' => 400000,
                'raised_amount' => 180000,
                'donor_count' => 650,
                'featured' => false,
                'category' => 'mosque',
                'start_date' => now()->subDays(15),
                'end_date' => now()->addDays(60),
                'status' => 'active',
            ],
            [
                'title' => 'Disaster Preparedness Training',
                'description' => 'Conducting disaster preparedness training for communities in high-risk areas. The program will train 500 community leaders in emergency response and disaster management.',
                'short_description' => 'Disaster preparedness for 500 community leaders',
                'goal_amount' => 75000,
                'raised_amount' => 45000,
                'donor_count' => 280,
                'featured' => false,
                'category' => 'emergency',
                'start_date' => now()->subDays(10),
                'end_date' => now()->addDays(50),
                'status' => 'active',
            ],
        ];

        $allCampaigns = array_merge($featuredCampaigns, $successfulCampaigns, $regularCampaigns);

        foreach ($allCampaigns as $campaignData) {
            $partner = $partners->random();
            
            Campaign::create([
                'title' => $campaignData['title'],
                'slug' => Str::slug($campaignData['title']),
                'organization_name' => $partner->name,
                'partner_id' => $partner->id,
                'description' => $campaignData['description'],
                'short_description' => $campaignData['short_description'],
                'goal_amount' => $campaignData['goal_amount'],
                'raised_amount' => $campaignData['raised_amount'],
                'donor_count' => $campaignData['donor_count'],
                'currency' => 'MYR',
                'start_date' => $campaignData['start_date'],
                'end_date' => $campaignData['end_date'],
                'status' => $campaignData['status'],
                'featured' => $campaignData['featured'] ?? false,
                'display_order' => $campaignData['display_order'] ?? 0,
                'category' => $campaignData['category'],
                'created_by' => 1, // Assuming admin user ID is 1
            ]);
        }

        $this->command->info('Campaigns seeded successfully!');
        $this->command->info('- Featured campaigns: ' . count($featuredCampaigns));
        $this->command->info('- Successful campaigns: ' . count($successfulCampaigns));
        $this->command->info('- Regular campaigns: ' . count($regularCampaigns));
    }
}
