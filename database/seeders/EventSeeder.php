<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
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

        // Create sample events
        $events = [
            [
                'title' => 'Islamic Finance Workshop 2024',
                'description' => 'Learn about Sharia-compliant financial solutions, Islamic banking principles, and ethical investment strategies.',
                'content' => 'This comprehensive workshop will cover the fundamentals of Islamic finance, including Murabaha, Musharaka, Mudharabah, and other Islamic financial instruments. Participants will learn how to apply these principles in modern banking and investment scenarios. The workshop includes practical case studies, interactive sessions, and Q&A with industry experts.',
                'location' => 'Kuala Lumpur Convention Centre',
                'address' => 'Kuala Lumpur City Centre, 50088 Kuala Lumpur, Malaysia',
                'latitude' => 3.1478,
                'longitude' => 101.7089,
                'start_date' => now()->addDays(15),
                'end_date' => now()->addDays(15),
                'start_time' => now()->addDays(15)->setTime(9, 0),
                'end_time' => now()->addDays(15)->setTime(17, 0),
                'max_participants' => 200,
                'registered_participants' => 45,
                'registration_fee' => 150.00,
                'currency' => 'MYR',
                'category' => 'education',
                'status' => 'published',
                'is_featured' => true,
                'registration_required' => true,
                'registration_deadline' => now()->addDays(10),
                'contact_info' => [
                    'email' => 'events@raudhahmuamalat.com',
                    'phone' => '+60 3-1234 5678',
                    'person' => 'Sarah Ahmad'
                ],
                'social_links' => [
                    'facebook' => 'https://facebook.com/raudhahmuamalat',
                    'instagram' => 'https://instagram.com/raudhahmuamalat'
                ],
            ],
            [
                'title' => 'Community Iftar Gathering',
                'description' => 'Join us for a community iftar during Ramadan with traditional Malaysian cuisine and fellowship.',
                'content' => 'Our annual community iftar brings together Muslims from all backgrounds to break their fast together. The event features traditional Malaysian dishes, dates, and refreshments. There will be a brief talk about the significance of Ramadan, followed by Maghrib prayer and dinner. Families are welcome, and childcare will be provided.',
                'location' => 'Masjid Al-Hidayah',
                'address' => 'Jalan Masjid, Petaling Jaya, 47400 Selangor, Malaysia',
                'latitude' => 3.1073,
                'longitude' => 101.6436,
                'start_date' => now()->addDays(25),
                'end_date' => now()->addDays(25),
                'start_time' => now()->addDays(25)->setTime(18, 30),
                'end_time' => now()->addDays(25)->setTime(21, 0),
                'max_participants' => 300,
                'registered_participants' => 120,
                'registration_fee' => 0.00,
                'currency' => 'MYR',
                'category' => 'religious',
                'status' => 'published',
                'is_featured' => true,
                'registration_required' => true,
                'registration_deadline' => now()->addDays(20),
                'contact_info' => [
                    'email' => 'iftar@raudhahmuamalat.com',
                    'phone' => '+60 3-2345 6789',
                    'person' => 'Ahmad Ibrahim'
                ],
                'social_links' => [
                    'facebook' => 'https://facebook.com/raudhahmuamalat',
                    'whatsapp' => 'https://wa.me/60123456789'
                ],
            ],
            [
                'title' => 'Charity Fundraising Gala',
                'description' => 'An elegant evening of dining, entertainment, and fundraising for our humanitarian projects.',
                'content' => 'Join us for an unforgettable evening dedicated to raising funds for our ongoing humanitarian projects. The gala features a three-course halal dinner, live entertainment, silent auction, and inspiring presentations about our work. Dress code is formal/semi-formal. All proceeds will go directly to our emergency relief fund.',
                'location' => 'Grand Ballroom, Hotel Istana',
                'address' => '73 Jalan Raja Chulan, 50200 Kuala Lumpur, Malaysia',
                'latitude' => 3.1516,
                'longitude' => 101.7089,
                'start_date' => now()->addDays(45),
                'end_date' => now()->addDays(45),
                'start_time' => now()->addDays(45)->setTime(19, 0),
                'end_time' => now()->addDays(45)->setTime(23, 0),
                'max_participants' => 150,
                'registered_participants' => 78,
                'registration_fee' => 250.00,
                'currency' => 'MYR',
                'category' => 'fundraising',
                'status' => 'published',
                'is_featured' => true,
                'registration_required' => true,
                'registration_deadline' => now()->addDays(35),
                'contact_info' => [
                    'email' => 'gala@raudhahmuamalat.com',
                    'phone' => '+60 3-3456 7890',
                    'person' => 'Fatimah Zahra'
                ],
                'social_links' => [
                    'facebook' => 'https://facebook.com/raudhahmuamalat',
                    'instagram' => 'https://instagram.com/raudhahmuamalat',
                    'linkedin' => 'https://linkedin.com/company/raudhahmuamalat'
                ],
            ],
            [
                'title' => 'Youth Leadership Bootcamp',
                'description' => 'A 3-day intensive program designed to develop leadership skills among Muslim youth.',
                'content' => 'This bootcamp is designed for young Muslims aged 18-25 who want to develop their leadership potential. The program includes workshops on public speaking, project management, Islamic leadership principles, community organizing, and social entrepreneurship. Participants will work on real projects and receive mentorship from established leaders.',
                'location' => 'Youth Development Center',
                'address' => 'Shah Alam, 40150 Selangor, Malaysia',
                'latitude' => 3.0738,
                'longitude' => 101.5183,
                'start_date' => now()->addDays(60),
                'end_date' => now()->addDays(62),
                'start_time' => now()->addDays(60)->setTime(8, 30),
                'end_time' => now()->addDays(62)->setTime(17, 30),
                'max_participants' => 50,
                'registered_participants' => 23,
                'registration_fee' => 100.00,
                'currency' => 'MYR',
                'category' => 'youth',
                'status' => 'published',
                'is_featured' => false,
                'registration_required' => true,
                'registration_deadline' => now()->addDays(50),
                'contact_info' => [
                    'email' => 'youth@raudhahmuamalat.com',
                    'phone' => '+60 3-4567 8901',
                    'person' => 'Omar Hassan'
                ],
                'social_links' => [
                    'instagram' => 'https://instagram.com/raudhahyouth',
                    'telegram' => 'https://t.me/raudhahyouth'
                ],
            ],
            [
                'title' => 'Women Empowerment Seminar',
                'description' => 'Empowering Muslim women through education, skills development, and networking opportunities.',
                'content' => 'This seminar focuses on empowering Muslim women in various aspects of life including career development, entrepreneurship, family balance, and community leadership. Sessions include practical workshops on financial literacy, digital marketing, and personal branding. The event also features successful Muslim women entrepreneurs sharing their experiences.',
                'location' => 'Women\'s Resource Center',
                'address' => 'Subang Jaya, 47500 Selangor, Malaysia',
                'latitude' => 3.0436,
                'longitude' => 101.5820,
                'start_date' => now()->addDays(30),
                'end_date' => now()->addDays(30),
                'start_time' => now()->addDays(30)->setTime(9, 0),
                'end_time' => now()->addDays(30)->setTime(16, 0),
                'max_participants' => 100,
                'registered_participants' => 67,
                'registration_fee' => 75.00,
                'currency' => 'MYR',
                'category' => 'empowerment',
                'status' => 'published',
                'is_featured' => false,
                'registration_required' => true,
                'registration_deadline' => now()->addDays(25),
                'contact_info' => [
                    'email' => 'women@raudhahmuamalat.com',
                    'phone' => '+60 3-5678 9012',
                    'person' => 'Aisha Rahman'
                ],
                'social_links' => [
                    'facebook' => 'https://facebook.com/raudhahwomen',
                    'instagram' => 'https://instagram.com/raudhahwomen'
                ],
            ],
            [
                'title' => 'Eid Celebration Festival',
                'description' => 'Community celebration of Eid with food, games, cultural performances, and family activities.',
                'content' => 'Join our community for a joyous Eid celebration featuring traditional Malaysian and Middle Eastern cuisine, cultural performances, children\'s activities, henna art, and games for all ages. The event includes Eid prayers, followed by festivities that celebrate our diverse Muslim community. Traditional clothing is encouraged.',
                'location' => 'Taman Tasik Titiwangsa',
                'address' => 'Jalan Temerloh, 53200 Kuala Lumpur, Malaysia',
                'latitude' => 3.1726,
                'longitude' => 101.7022,
                'start_date' => now()->addDays(80),
                'end_date' => now()->addDays(80),
                'start_time' => now()->addDays(80)->setTime(8, 0),
                'end_time' => now()->addDays(80)->setTime(18, 0),
                'max_participants' => 500,
                'registered_participants' => 234,
                'registration_fee' => 0.00,
                'currency' => 'MYR',
                'category' => 'religious',
                'status' => 'published',
                'is_featured' => true,
                'registration_required' => false,
                'registration_deadline' => null,
                'contact_info' => [
                    'email' => 'eid@raudhahmuamalat.com',
                    'phone' => '+60 3-6789 0123',
                    'person' => 'Khadijah Yusof'
                ],
                'social_links' => [
                    'facebook' => 'https://facebook.com/raudhahmuamalat',
                    'instagram' => 'https://instagram.com/raudhahmuamalat',
                    'whatsapp' => 'https://wa.me/60123456789'
                ],
            ],
            [
                'title' => 'Volunteer Training Program',
                'description' => 'Comprehensive training for new volunteers joining our humanitarian missions.',
                'content' => 'This training program prepares new volunteers for various humanitarian and community service activities. Topics include disaster response, community outreach, fundraising ethics, cultural sensitivity, and project management. Participants will receive certificates upon completion and will be eligible to join our active volunteer network.',
                'location' => 'Community Training Center',
                'address' => 'Bangi, 43600 Selangor, Malaysia',
                'latitude' => 2.9213,
                'longitude' => 101.7785,
                'start_date' => now()->addDays(20),
                'end_date' => now()->addDays(21),
                'start_time' => now()->addDays(20)->setTime(9, 0),
                'end_time' => now()->addDays(21)->setTime(17, 0),
                'max_participants' => 75,
                'registered_participants' => 42,
                'registration_fee' => 50.00,
                'currency' => 'MYR',
                'category' => 'volunteer',
                'status' => 'published',
                'is_featured' => false,
                'registration_required' => true,
                'registration_deadline' => now()->addDays(15),
                'contact_info' => [
                    'email' => 'volunteer@raudhahmuamalat.com',
                    'phone' => '+60 3-7890 1234',
                    'person' => 'Yusuf Abdullah'
                ],
                'social_links' => [
                    'facebook' => 'https://facebook.com/raudhahvolunteers',
                    'telegram' => 'https://t.me/raudhahvolunteers'
                ],
            ],
            [
                'title' => 'Digital Marketing for Nonprofits',
                'description' => 'Learn how to effectively use digital marketing tools to promote charitable causes and increase donations.',
                'content' => 'This workshop is designed for nonprofit organizations and charity workers who want to improve their digital marketing skills. Topics include social media marketing, email campaigns, content creation, SEO for nonprofits, and online fundraising strategies. Participants will learn practical tools and techniques to increase their organization\'s online presence.',
                'location' => 'Digital Hub Cyberjaya',
                'address' => 'Cyberjaya, 63000 Selangor, Malaysia',
                'latitude' => 2.9213,
                'longitude' => 101.6559,
                'start_date' => now()->addDays(35),
                'end_date' => now()->addDays(35),
                'start_time' => now()->addDays(35)->setTime(10, 0),
                'end_time' => now()->addDays(35)->setTime(16, 0),
                'max_participants' => 40,
                'registered_participants' => 18,
                'registration_fee' => 120.00,
                'currency' => 'MYR',
                'category' => 'education',
                'status' => 'published',
                'is_featured' => false,
                'registration_required' => true,
                'registration_deadline' => now()->addDays(30),
                'contact_info' => [
                    'email' => 'digital@raudhahmuamalat.com',
                    'phone' => '+60 3-8901 2345',
                    'person' => 'Maryam Salleh'
                ],
                'social_links' => [
                    'linkedin' => 'https://linkedin.com/company/raudhahmuamalat',
                    'facebook' => 'https://facebook.com/raudhahmuamalat'
                ],
            ],
        ];

        foreach ($events as $eventData) {
            Event::create([
                'title' => $eventData['title'],
                'slug' => Str::slug($eventData['title']),
                'description' => $eventData['description'],
                'content' => $eventData['content'],
                'featured_image' => 'events/' . Str::slug($eventData['title']) . '.jpg', // Placeholder path
                'location' => $eventData['location'],
                'address' => $eventData['address'],
                'latitude' => $eventData['latitude'],
                'longitude' => $eventData['longitude'],
                'start_date' => $eventData['start_date'],
                'end_date' => $eventData['end_date'],
                'start_time' => $eventData['start_time'],
                'end_time' => $eventData['end_time'],
                'max_participants' => $eventData['max_participants'],
                'registered_participants' => $eventData['registered_participants'],
                'registration_fee' => $eventData['registration_fee'],
                'currency' => $eventData['currency'],
                'category' => $eventData['category'],
                'status' => $eventData['status'],
                'is_featured' => $eventData['is_featured'],
                'registration_required' => $eventData['registration_required'],
                'registration_deadline' => $eventData['registration_deadline'],
                'contact_info' => $eventData['contact_info'],
                'social_links' => $eventData['social_links'],
                'created_by' => $adminUser->id,
            ]);
        }
    }
} 