<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Partner;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Support\Str;

class PartnerSeeder extends Seeder
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

        $partners = [
            [
                'name' => 'UNICEF Malaysia',
                'description' => 'UNICEF works in over 190 countries and territories to save children\'s lives, to defend their rights, and to help them fulfil their potential, from early childhood through adolescence.',
                'website' => 'https://www.unicef.org/malaysia',
                'status' => 'active',
                'sort_order' => 1,
            ],
            [
                'name' => 'World Food Programme',
                'description' => 'The World Food Programme is the leading humanitarian organization saving lives and changing lives, delivering food assistance in emergencies and working with communities to improve nutrition and build resilience.',
                'website' => 'https://www.wfp.org',
                'status' => 'active',
                'sort_order' => 2,
            ],
            [
                'name' => 'Malaysian Red Crescent Society',
                'description' => 'The Malaysian Red Crescent Society is a voluntary relief organization that provides humanitarian services to the community, particularly to the most vulnerable people.',
                'website' => 'https://www.redcrescent.org.my',
                'status' => 'active',
                'sort_order' => 3,
            ],
            [
                'name' => 'Mercy Malaysia',
                'description' => 'MERCY Malaysia is a non-profit organization that provides medical relief, sustainable health-related development and risk reduction activities for vulnerable communities.',
                'website' => 'https://www.mercy.org.my',
                'status' => 'active',
                'sort_order' => 4,
            ],
            [
                'name' => 'Islamic Relief Malaysia',
                'description' => 'Islamic Relief Malaysia works to empower communities to mitigate the effect of disasters, prepare for their occurrence and respond by providing emergency relief, healthcare and education.',
                'website' => 'https://www.islamic-relief.org.my',
                'status' => 'active',
                'sort_order' => 5,
            ],
            [
                'name' => 'Genting Foundation',
                'description' => 'The Genting Foundation is committed to making a positive impact in the communities where Genting operates, focusing on education, healthcare, and community development.',
                'website' => 'https://www.genting.com/foundation',
                'status' => 'active',
                'sort_order' => 6,
            ],
            [
                'name' => 'Maybank Foundation',
                'description' => 'Maybank Foundation focuses on education and community empowerment programmes that create positive and sustainable impact to the bottom 40% of the community.',
                'website' => 'https://www.maybank.com/foundation',
                'status' => 'active',
                'sort_order' => 7,
            ],
            [
                'name' => 'Yayasan Sime Darby',
                'description' => 'Yayasan Sime Darby focuses on four key areas: education, healthcare, youth development, and environment to create sustainable communities.',
                'website' => 'https://www.yayasansimedarby.com',
                'status' => 'active',
                'sort_order' => 8,
            ],
            [
                'name' => 'Ministry of Women, Family and Community Development',
                'description' => 'The Ministry is responsible for formulating policies and implementing programmes related to women, family, children, and community development in Malaysia.',
                'website' => 'https://www.kpwkm.gov.my',
                'status' => 'active',
                'sort_order' => 9,
            ],
            [
                'name' => 'Department of Social Welfare Malaysia',
                'description' => 'The Department of Social Welfare Malaysia provides social protection and welfare services to ensure the wellbeing of individuals, families and communities.',
                'website' => 'https://www.jkm.gov.my',
                'status' => 'active',
                'sort_order' => 10,
            ],
            [
                'name' => 'Teach for Malaysia',
                'description' => 'Teach for Malaysia develops leaders who expand educational opportunities for children from low-income communities and creates systemic change.',
                'website' => 'https://www.teachformalaysia.org',
                'status' => 'active',
                'sort_order' => 11,
            ],
            [
                'name' => 'Tzu Chi Foundation Malaysia',
                'description' => 'Tzu Chi Foundation Malaysia is committed to charity, medicine, education, and humanistic culture, serving communities regardless of race, religion, or nationality.',
                'website' => 'https://www.tzuchi.org.my',
                'status' => 'active',
                'sort_order' => 12,
            ],
            [
                'name' => 'Global Peace Foundation Malaysia',
                'description' => 'Global Peace Foundation Malaysia promotes an innovative, values-based approach to peacebuilding, guided by the vision of One Family under God.',
                'website' => 'https://www.globalpeace.org/malaysia',
                'status' => 'inactive',
                'sort_order' => 13,
            ],
            [
                'name' => 'Habitat for Humanity Malaysia',
                'description' => 'Habitat for Humanity Malaysia builds strength, stability and self-reliance through shelter, focusing on providing decent and affordable housing.',
                'website' => 'https://www.habitat.org.my',
                'status' => 'active',
                'sort_order' => 14,
            ],
            [
                'name' => 'WWF Malaysia',
                'description' => 'WWF-Malaysia is the leading conservation organization working to conserve nature and reduce the most pressing threats to the diversity of life on Earth.',
                'website' => 'https://www.wwf.org.my',
                'status' => 'active',
                'sort_order' => 15,
            ],
        ];

        foreach ($partners as $partnerData) {
            Partner::create([
                'name' => $partnerData['name'],
                'description' => $partnerData['description'],
                'website' => $partnerData['website'],
                'status' => $partnerData['status'],
                'sort_order' => $partnerData['sort_order'],
            ]);
        }
        
        $this->command->info('✅ Partner seeding completed!');
        $this->command->info('🤝 Partners created: ' . Partner::count());
    }
}
