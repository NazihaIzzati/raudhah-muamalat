<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Campaign;
use App\Models\User;
use Illuminate\Support\Str;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin user for created_by
        $adminUser = User::where('role', 'admin')->first();
        
        if (!$adminUser) {
            // Create an admin user if none exists
            $adminUser = User::create([
                'name' => 'Admin User',
                'email' => 'admin@jariahfund.com',
                'password' => bcrypt('password123'),
                'role' => 'admin',
            ]);
        }
        
        // Create sample campaigns
        $campaigns = [
            [
                'title' => 'Emergency Relief for Gaza',
                'description' => 'Support families affected by the ongoing humanitarian crisis in Gaza with food, water, and medical supplies.',
                'content' => 'The situation in Gaza has reached critical levels with thousands of families lacking basic necessities. Your donation will provide emergency food packages, clean water, and essential medical supplies to those most in need.',
                'goal_amount' => 100000,
                'currency' => 'USD',
                'start_date' => now()->subDays(30),
                'end_date' => now()->addDays(60),
                'status' => 'active',
            ],
            [
                'title' => 'Build a Mosque in Indonesia',
                'description' => 'Help build a new mosque to serve the growing Muslim community in Surabaya, Indonesia.',
                'content' => 'The Muslim community in Surabaya has grown significantly over the past decade, and the existing mosque can no longer accommodate all worshippers. This project will build a new mosque with capacity for 500 people, with facilities for education, community events, and charitable activities.',
                'goal_amount' => 250000,
                'currency' => 'USD',
                'start_date' => now()->subDays(90),
                'end_date' => now()->addDays(275),
                'status' => 'active',
            ],
            [
                'title' => 'Water Wells for African Villages',
                'description' => 'Provide clean water access to rural villages in Africa by funding the construction of deep water wells.',
                'content' => 'Access to clean water remains a critical challenge for many rural communities in Africa. This campaign aims to fund the construction of 10 deep water wells, each serving approximately 500 people with clean, safe drinking water and irrigation for crops.',
                'goal_amount' => 75000,
                'currency' => 'USD',
                'start_date' => now()->subDays(45),
                'end_date' => now()->addDays(140),
                'status' => 'active',
            ],
            [
                'title' => 'Orphan Sponsorship Program',
                'description' => 'Sponsor orphaned children by providing education, healthcare, food, and shelter.',
                'content' => 'Our orphan sponsorship program supports children who have lost one or both parents. Your donation provides education, healthcare, nutritious meals, and safe housing. Each sponsored child receives individualized care and support to help them thrive despite difficult circumstances.',
                'goal_amount' => 120000,
                'currency' => 'USD',
                'start_date' => now()->subDays(60),
                'end_date' => now()->addDays(305),
                'status' => 'active',
            ],
            [
                'title' => 'Ramadan Food Distribution',
                'description' => 'Provide iftar meals and food packages to families in need during the holy month of Ramadan.',
                'content' => 'During Ramadan, many families struggle to provide adequate meals for iftar and suhoor. This campaign will distribute food packages containing rice, flour, oil, dates, and other essentials to 1,000 families, as well as hot iftar meals in community settings throughout the month.',
                'goal_amount' => 50000,
                'currency' => 'USD',
                'start_date' => now()->subDays(15),
                'end_date' => now()->addDays(15),
                'status' => 'active',
            ],
        ];
        
        foreach ($campaigns as $campaignData) {
            Campaign::create([
                'title' => $campaignData['title'],
                'slug' => Str::slug($campaignData['title']),
                'description' => $campaignData['description'],
                'content' => $campaignData['content'],
                'featured_image' => null, // No image for now
                'goal_amount' => $campaignData['goal_amount'],
                'raised_amount' => rand(0, $campaignData['goal_amount'] * 0.8), // Random amount raised
                'currency' => $campaignData['currency'],
                'start_date' => $campaignData['start_date'],
                'end_date' => $campaignData['end_date'],
                'status' => $campaignData['status'],
                'created_by' => $adminUser->id,
            ]);
        }
    }
}
