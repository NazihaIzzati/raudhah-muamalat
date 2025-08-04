<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\User;
use App\Models\Staff;
use App\Models\Campaign;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
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

        $newsData = [
            [
                'title' => 'JariahFund Launches New Zakat Collection Campaign',
                'content' => 'JariahFund has announced the launch of its comprehensive Zakat collection campaign, designed to provide essential support to underprivileged families throughout the holy month of Ramadan. The campaign focuses on addressing critical needs including food security, education, and healthcare access for vulnerable communities across Malaysia.

The initiative includes partnerships with local mosques, community centers, and social welfare organizations to ensure efficient distribution of aid. "Our goal is to make a meaningful impact in the lives of those who need it most," said the organization\'s spokesperson. "This campaign represents our commitment to Islamic values of charity and community support."

The campaign features multiple donation channels including online platforms, mobile banking, and traditional collection points. All contributions will be transparently managed and reported to donors.',
                'status' => 'published',
                'created_by' => $adminStaff->id,
            ],
            [
                'title' => 'Community Iftar Program Reaches Record Participation',
                'content' => 'The annual community iftar program organized by JariahFund has achieved unprecedented success this year, with over 500 families participating in the month-long initiative. The program, which provides daily iftar meals to families in need, has become a cornerstone of the organization\'s Ramadan activities.

"Seeing the community come together to break fast and share meals has been truly heartwarming," said program coordinator Ahmad Rahman. "The program not only addresses food security but also fosters community spirit and Islamic brotherhood."

The initiative included special provisions for elderly residents, single mothers, and families with children. Volunteers from various backgrounds contributed their time and resources to ensure the program\'s success. Plans are already underway to expand the program for next year\'s Ramadan.',
                'status' => 'published',
                'created_by' => $adminStaff->id,
            ],
            [
                'title' => 'New Islamic Finance Workshop Series Announced',
                'content' => 'JariahFund is proud to announce a new series of Islamic finance workshops designed to educate the community about halal banking principles and investment opportunities. The workshops, which will be conducted by certified Islamic finance experts, aim to promote financial literacy within Islamic guidelines.

The series covers topics including:
- Understanding Islamic banking principles
- Halal investment opportunities
- Zakat calculation and distribution
- Islamic estate planning
- Ethical business practices

Each workshop includes practical sessions and Q&A opportunities. "Financial literacy is crucial for community development," said workshop facilitator Dr. Siti Aminah. "We want to ensure that our community members have access to knowledge that aligns with Islamic values."

Registration is now open for the first workshop, scheduled for next month. The series will run throughout the year with both in-person and online sessions available.',
                'status' => 'published',
                'created_by' => $adminStaff->id,
            ],
            [
                'title' => 'Emergency Relief Fund Established for Natural Disasters',
                'content' => 'In response to the increasing frequency of natural disasters affecting Malaysian communities, JariahFund has established an Emergency Relief Fund to provide immediate assistance to affected families. The fund is designed to respond quickly to emergencies including floods, landslides, and other natural calamities.

The fund operates with a network of local coordinators who can assess needs and distribute aid within 24 hours of a disaster. "Our experience with previous emergency responses has taught us the importance of preparedness and rapid response," said emergency coordinator Zainab Hassan.

The fund accepts donations year-round and maintains reserves for immediate deployment. All contributions are used exclusively for emergency relief efforts, with transparent reporting to donors. The organization has also established partnerships with government agencies and other NGOs for coordinated disaster response.',
                'status' => 'published',
                'created_by' => $adminStaff->id,
            ],
            [
                'title' => 'Youth Leadership Program Applications Open',
                'content' => 'Applications are now open for the JariahFund Youth Leadership Program, a comprehensive six-month initiative designed to develop leadership skills in young Muslims aged 18-25. The program combines Islamic values with modern leadership principles to prepare participants for community service and professional success.

Program highlights include:
- Leadership development workshops
- Community service projects
- Mentorship from experienced leaders
- Islamic ethics and values training
- Networking opportunities
- Certificate upon completion

"The program aims to create a new generation of leaders who can serve their communities with Islamic values," said program director Faridah Ismail. "We believe in investing in our youth as they are the future of our community."

Selected participants will receive full scholarships covering all program costs. Applications close next month, with the program scheduled to begin in three months.',
                'status' => 'published',
                'created_by' => $adminStaff->id,
            ],
        ];

        foreach ($newsData as $data) {
            $slug = Str::slug($data['title']);
            News::create([
                'title' => $data['title'],
                'slug' => $slug,
                'content' => $data['content'],
                'featured_image' => $data['featured_image'] ?? null,
                'author' => $data['author'] ?? null,
                'published_at' => $data['published_at'] ?? now(),
                'status' => $data['status'],
                'created_by' => $data['created_by'],
            ]);
        }
        
        $this->command->info('✅ News seeding completed!');
        $this->command->info('📰 News articles created: ' . News::count());
    }
}
