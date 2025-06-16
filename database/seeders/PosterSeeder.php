<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Poster;
use App\Models\User;
use App\Models\Campaign;
use Illuminate\Support\Str;

class PosterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin user for created_by
        $adminUser = User::where('role', 'admin')->first();
        
        if (!$adminUser) {
            $adminUser = User::create([
                'name' => 'Admin User',
                'email' => 'admin@raudhahmuamalat.com',
                'password' => bcrypt('password123'),
                'role' => 'admin',
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
                'category' => 'humanitarian',
                'featured' => true,
                'file_size' => 2048576, // 2MB
                'display_from' => now()->subDays(30),
                'display_until' => now()->addDays(60),
                'display_order' => 1,
                'campaign_id' => $campaigns->first()?->id,
            ],
            [
                'title' => 'Build Mosque Indonesia',
                'description' => 'Help us build a new mosque in Surabaya, Indonesia to serve the growing Muslim community.',
                'status' => 'active',
                'category' => 'infrastructure',
                'featured' => true,
                'file_size' => 1536000, // 1.5MB
                'display_from' => now()->subDays(90),
                'display_until' => now()->addDays(275),
                'display_order' => 2,
                'campaign_id' => $campaigns->skip(1)->first()?->id,
            ],
            [
                'title' => 'Clean Water for Africa',
                'description' => 'Provide clean water access to rural villages in Africa through deep water well construction.',
                'status' => 'active',
                'category' => 'water',
                'featured' => false,
                'file_size' => 1024000, // 1MB
                'display_from' => now()->subDays(45),
                'display_until' => now()->addDays(140),
                'display_order' => 3,
                'campaign_id' => $campaigns->skip(2)->first()?->id,
            ],
            [
                'title' => 'Ramadan Food Distribution 2024',
                'description' => 'Support families in need during Ramadan with iftar meals and food packages.',
                'status' => 'active',
                'category' => 'food',
                'featured' => true,
                'file_size' => 2560000, // 2.5MB
                'display_from' => now()->subDays(15),
                'display_until' => now()->addDays(15),
                'display_order' => 4,
                'campaign_id' => null,
            ],
            [
                'title' => 'Orphan Sponsorship Program',
                'description' => 'Sponsor an orphan and provide them with education, healthcare, and a brighter future.',
                'status' => 'active',
                'category' => 'education',
                'featured' => false,
                'file_size' => 1800000, // 1.8MB
                'display_from' => now()->subDays(60),
                'display_until' => now()->addDays(305),
                'display_order' => 5,
                'campaign_id' => null,
            ],
            [
                'title' => 'Eid Celebration 2024',
                'description' => 'Join us for a community Eid celebration with food, activities, and fellowship.',
                'status' => 'active',
                'category' => 'event',
                'featured' => false,
                'file_size' => 1200000, // 1.2MB
                'display_from' => now()->subDays(10),
                'display_until' => now()->addDays(5),
                'display_order' => 6,
                'campaign_id' => null,
            ],
            [
                'title' => 'Islamic Finance Workshop',
                'description' => 'Learn about Sharia-compliant financial solutions and Islamic banking principles.',
                'status' => 'active',
                'category' => 'education',
                'featured' => false,
                'file_size' => 900000, // 900KB
                'display_from' => now()->addDays(5),
                'display_until' => now()->addDays(30),
                'display_order' => 7,
                'campaign_id' => null,
            ],
            [
                'title' => 'Volunteer Recruitment Drive',
                'description' => 'Join our team of dedicated volunteers and make a difference in your community.',
                'status' => 'active',
                'category' => 'volunteer',
                'featured' => false,
                'file_size' => 1100000, // 1.1MB
                'display_from' => now(),
                'display_until' => now()->addDays(90),
                'display_order' => 8,
                'campaign_id' => null,
            ],
            [
                'title' => 'Zakat Collection Campaign',
                'description' => 'Fulfill your religious obligation and help those in need through Zakat contributions.',
                'status' => 'active',
                'category' => 'zakat',
                'featured' => true,
                'file_size' => 2200000, // 2.2MB
                'display_from' => now()->subDays(20),
                'display_until' => now()->addDays(100),
                'display_order' => 9,
                'campaign_id' => null,
            ],
            [
                'title' => 'Youth Leadership Program',
                'description' => 'Empower the next generation of Muslim leaders through our comprehensive youth program.',
                'status' => 'inactive',
                'category' => 'youth',
                'featured' => false,
                'file_size' => 1400000, // 1.4MB
                'display_from' => now()->addDays(15),
                'display_until' => now()->addDays(120),
                'display_order' => 10,
                'campaign_id' => null,
            ],
            [
                'title' => 'Women Empowerment Initiative',
                'description' => 'Supporting women in developing skills, education, and economic opportunities.',
                'status' => 'inactive',
                'category' => 'empowerment',
                'featured' => false,
                'file_size' => 1600000, // 1.6MB
                'display_from' => now()->addDays(20),
                'display_until' => now()->addDays(150),
                'display_order' => 11,
                'campaign_id' => null,
            ],
            [
                'title' => 'Disaster Relief Fund',
                'description' => 'Emergency fund for natural disaster relief and humanitarian aid worldwide.',
                'status' => 'inactive',
                'category' => 'emergency',
                'featured' => false,
                'file_size' => 1300000, // 1.3MB
                'display_from' => now()->subDays(180),
                'display_until' => now()->subDays(30),
                'display_order' => 12,
                'campaign_id' => null,
            ],
        ];

        foreach ($posters as $posterData) {
            Poster::create([
                'title' => $posterData['title'],
                'slug' => Str::slug($posterData['title']),
                'image_path' => 'posters/' . Str::slug($posterData['title']) . '.jpg', // Placeholder path
                'description' => $posterData['description'],
                'status' => $posterData['status'],
                'category' => $posterData['category'],
                'featured' => $posterData['featured'],
                'file_size' => $posterData['file_size'],
                'display_from' => $posterData['display_from'],
                'display_until' => $posterData['display_until'],
                'display_order' => $posterData['display_order'],
                'campaign_id' => $posterData['campaign_id'],
                'created_by' => $adminUser->id,
            ]);
        }

        $this->command->info('Created ' . Poster::count() . ' posters (' . Poster::where('status', 'active')->count() . ' active, ' . Poster::where('status', 'inactive')->count() . ' inactive)');
    }
} 