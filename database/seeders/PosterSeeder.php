<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Poster;
use App\Models\User;
use App\Models\Staff;
use App\Models\Campaign;
use Illuminate\Support\Str;

class PosterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin staff user for created_by
        $adminStaff = Staff::whereHas('user', function($query) {
            $query->where('user_type', 'staff');
        })->where('role', 'admin')->first();
        
        if (!$adminStaff) {
            $user = User::create([
                'name' => 'Admin User',
                'email' => 'admin@jariahfund.com',
                'password' => bcrypt('password123'),
                'user_type' => 'staff',
                'is_active' => true,
                'email_verified_at' => now(),
            ]);
            
            $adminStaff = Staff::create([
                'user_id' => $user->id,
                'employee_id' => 'EMP001',
                'position' => 'System Administrator',
                'department' => 'IT',
                'role' => 'admin',
                'status' => 'active',
                'hire_date' => now()->subYear(),
                'address' => 'Kuala Lumpur, Malaysia',
            ]);
        }

        // Get some campaigns for poster association
        $campaigns = Campaign::limit(3)->get();

        // Create sample posters
        $posters = [
            [
                'title' => 'Emergency Relief Gaza Campaign',
                'description' => 'Join our humanitarian mission to provide emergency relief to families in Gaza. Every donation counts.',
                'status' => 'active',
                'image' => 'posters/emergency-relief-gaza-campaign.jpg',
                'link' => 'https://example.com/campaigns/emergency-relief-gaza',
                'sort_order' => 1,
                'start_date' => now()->subDays(30),
                'end_date' => now()->addDays(60),
            ],
            [
                'title' => 'Build Mosque Indonesia',
                'description' => 'Help us build a new mosque in Surabaya, Indonesia to serve the growing Muslim community.',
                'status' => 'active',
                'image' => 'posters/build-mosque-indonesia.jpg',
                'link' => 'https://example.com/campaigns/build-mosque-indonesia',
                'sort_order' => 2,
                'start_date' => now()->subDays(90),
                'end_date' => now()->addDays(275),
            ],
            [
                'title' => 'Clean Water for Africa',
                'description' => 'Provide clean water access to rural villages in Africa through deep water well construction.',
                'status' => 'active',
                'image' => 'posters/clean-water-africa.jpg',
                'link' => 'https://example.com/campaigns/clean-water-africa',
                'sort_order' => 3,
                'start_date' => now()->subDays(45),
                'end_date' => now()->addDays(140),
            ],
            [
                'title' => 'Ramadan Food Distribution 2024',
                'description' => 'Support families in need during Ramadan with iftar meals and food packages.',
                'status' => 'active',
                'image' => 'posters/ramadan-food-distribution-2024.jpg',
                'link' => 'https://example.com/campaigns/ramadan-food-distribution',
                'sort_order' => 4,
                'start_date' => now()->subDays(15),
                'end_date' => now()->addDays(15),
            ],
            [
                'title' => 'Orphan Sponsorship Program',
                'description' => 'Sponsor an orphan and provide them with education, healthcare, and a brighter future.',
                'status' => 'active',
                'image' => 'posters/orphan-sponsorship-program.jpg',
                'link' => 'https://example.com/campaigns/orphan-sponsorship',
                'sort_order' => 5,
                'start_date' => now()->subDays(60),
                'end_date' => now()->addDays(305),
            ],
            [
                'title' => 'Eid Celebration 2024',
                'description' => 'Join us for a community Eid celebration with food, activities, and fellowship.',
                'status' => 'active',
                'image' => 'posters/eid-celebration-2024.jpg',
                'link' => 'https://example.com/events/eid-celebration',
                'sort_order' => 6,
                'start_date' => now()->subDays(30),
                'end_date' => now()->addDays(30),
            ],
            [
                'title' => 'Islamic Education Fund',
                'description' => 'Support Islamic education programs for children and adults in our community.',
                'status' => 'active',
                'image' => 'posters/islamic-education-fund.jpg',
                'link' => 'https://example.com/campaigns/islamic-education',
                'sort_order' => 7,
                'start_date' => now()->subDays(120),
                'end_date' => now()->addDays(180),
            ],
            [
                'title' => 'Healthcare for Refugees',
                'description' => 'Provide essential healthcare services to refugee families in need.',
                'status' => 'active',
                'image' => 'posters/healthcare-refugees.jpg',
                'link' => 'https://example.com/campaigns/healthcare-refugees',
                'sort_order' => 8,
                'start_date' => now()->subDays(75),
                'end_date' => now()->addDays(150),
            ],
            [
                'title' => 'Community Center Project',
                'description' => 'Help build a community center to serve as a hub for social and educational activities.',
                'status' => 'active',
                'image' => 'posters/community-center-project.jpg',
                'link' => 'https://example.com/campaigns/community-center',
                'sort_order' => 9,
                'start_date' => now()->subDays(45),
                'end_date' => now()->addDays(200),
            ],
            [
                'title' => 'Disaster Relief Fund',
                'description' => 'Support emergency response and recovery efforts for communities affected by natural disasters.',
                'status' => 'active',
                'image' => 'posters/disaster-relief-fund.jpg',
                'link' => 'https://example.com/campaigns/disaster-relief',
                'sort_order' => 10,
                'start_date' => now()->subDays(20),
                'end_date' => now()->addDays(100),
            ],
            [
                'title' => 'Youth Development Program',
                'description' => 'Invest in the future by supporting youth development and leadership programs.',
                'status' => 'active',
                'image' => 'posters/youth-development-program.jpg',
                'link' => 'https://example.com/campaigns/youth-development',
                'sort_order' => 11,
                'start_date' => now()->subDays(60),
                'end_date' => now()->addDays(240),
            ],
            [
                'title' => 'Women Empowerment Initiative',
                'description' => 'Support programs that empower women through education, skills training, and economic opportunities.',
                'status' => 'active',
                'image' => 'posters/women-empowerment-initiative.jpg',
                'link' => 'https://example.com/campaigns/women-empowerment',
                'sort_order' => 12,
                'start_date' => now()->subDays(90),
                'end_date' => now()->addDays(300),
            ],
        ];

        foreach ($posters as $posterData) {
            Poster::create([
                'title' => $posterData['title'],
                'description' => $posterData['description'],
                'status' => $posterData['status'],
                'image' => $posterData['image'],
                'link' => $posterData['link'],
                'sort_order' => $posterData['sort_order'],
                'start_date' => $posterData['start_date'],
                'end_date' => $posterData['end_date'],
            ]);
        }

        $this->command->info('Created ' . Poster::count() . ' posters (' . Poster::where('status', 'active')->count() . ' active, ' . Poster::where('status', 'inactive')->count() . ' inactive)');
    }
} 