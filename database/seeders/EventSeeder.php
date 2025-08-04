<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
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

        // Create sample events
        $events = [
            [
                'title' => 'Islamic Finance Workshop 2024',
                'description' => 'Learn about Sharia-compliant financial solutions, Islamic banking principles, and ethical investment strategies.',
                'content' => 'This comprehensive workshop will cover the fundamentals of Islamic finance, including Murabaha, Musharaka, Mudharabah, and other Islamic financial instruments. Participants will learn how to apply these principles in modern banking and investment scenarios. The workshop includes practical case studies, interactive sessions, and Q&A with industry experts.',
                'location' => 'Kuala Lumpur Convention Centre',
                'start_date' => now()->addDays(15),
                'end_date' => now()->addDays(15),
                'status' => 'active',
                'created_by' => $adminStaff->id,
            ],
            [
                'title' => 'Community Iftar Gathering',
                'description' => 'Join us for a community iftar during Ramadan with traditional Malaysian cuisine and fellowship.',
                'content' => 'Our annual community iftar brings together Muslims from all backgrounds to break their fast together. The event features traditional Malaysian dishes, dates, and refreshments. There will be a brief talk about the significance of Ramadan, followed by Maghrib prayer and dinner. Families are welcome, and childcare will be provided.',
                'location' => 'Masjid Al-Hidayah',
                'start_date' => now()->addDays(25),
                'end_date' => now()->addDays(25),
                'status' => 'active',
                'created_by' => $adminStaff->id,
            ],
            [
                'title' => 'Charity Fundraising Gala',
                'description' => 'An elegant evening of dining, entertainment, and fundraising for our humanitarian projects.',
                'content' => 'Join us for an unforgettable evening dedicated to raising funds for our ongoing humanitarian projects. The gala features a three-course halal dinner, live entertainment, silent auction, and inspiring presentations about our work. Dress code is formal/semi-formal. All proceeds will go directly to our emergency relief fund.',
                'location' => 'Grand Ballroom, Hotel Istana',
                'start_date' => now()->addDays(45),
                'end_date' => now()->addDays(45),
                'status' => 'active',
                'created_by' => $adminStaff->id,
            ],
            [
                'title' => 'Youth Leadership Summit',
                'description' => 'Empowering young Muslims to become leaders in their communities through workshops and networking.',
                'content' => 'This summit brings together young Muslim professionals, students, and community leaders for a day of learning, networking, and inspiration. Topics include leadership development, community service, Islamic values in modern society, and career guidance. The event includes interactive workshops, panel discussions, and networking sessions.',
                'location' => 'Universiti Malaya',
                'start_date' => now()->addDays(60),
                'end_date' => now()->addDays(60),
                'status' => 'active',
                'created_by' => $adminStaff->id,
            ],
            [
                'title' => 'Women Empowerment Conference',
                'description' => 'Supporting Muslim women in leadership, entrepreneurship, and community development.',
                'content' => 'This conference celebrates and supports Muslim women in various fields. The event features keynote speakers, panel discussions, workshops on entrepreneurship, leadership skills, and community development. There will be networking opportunities and a marketplace showcasing women-owned businesses.',
                'location' => 'Petaling Jaya Convention Centre',
                'start_date' => now()->addDays(75),
                'end_date' => now()->addDays(75),
                'status' => 'active',
                'created_by' => $adminStaff->id,
            ],
            [
                'title' => 'Eid Celebration 2024',
                'description' => 'Join us for a community Eid celebration with food, activities, and fellowship.',
                'content' => 'Celebrate Eid with our community! The event includes traditional Malaysian cuisine, children\'s activities, cultural performances, and prayer services. Families are welcome, and there will be special activities for children including face painting, games, and storytelling.',
                'location' => 'Community Hall',
                'start_date' => now()->addDays(90),
                'end_date' => now()->addDays(90),
                'status' => 'active',
                'created_by' => $adminStaff->id,
            ],
            [
                'title' => 'Volunteer Training Workshop',
                'description' => 'Learn essential skills for community service and humanitarian work.',
                'content' => 'This workshop provides essential training for volunteers who want to serve their community. Topics include first aid, communication skills, project management, and Islamic ethics in service. The workshop includes hands-on activities and certification.',
                'location' => 'Training Centre',
                'start_date' => now()->addDays(30),
                'end_date' => now()->addDays(30),
                'status' => 'active',
                'created_by' => $adminStaff->id,
            ],
            [
                'title' => 'Digital Islamic Finance Seminar',
                'description' => 'Exploring the intersection of Islamic finance and modern technology.',
                'content' => 'This seminar explores how Islamic finance principles can be applied in the digital age. Topics include fintech solutions, blockchain technology, digital banking, and maintaining Sharia compliance in modern financial services.',
                'location' => 'Digital Innovation Hub',
                'start_date' => now()->addDays(45),
                'end_date' => now()->addDays(45),
                'status' => 'active',
                'created_by' => $adminStaff->id,
            ],
        ];

        foreach ($events as $eventData) {
            Event::create([
                'title' => $eventData['title'],
                'slug' => Str::slug($eventData['title']),
                'description' => $eventData['description'],
                'content' => $eventData['content'],
                'location' => $eventData['location'],
                'start_date' => $eventData['start_date'],
                'end_date' => $eventData['end_date'],
                'status' => $eventData['status'],
                'created_by' => $eventData['created_by'],
            ]);
        }
    }
} 