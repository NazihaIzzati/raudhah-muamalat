<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Support\Str;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first admin user to assign as creator
        $adminUser = User::where('role', 'admin')->first();
        
        if (!$adminUser) {
            // If no admin user exists, create one
            $adminUser = User::create([
                'name' => 'Admin User',
                'email' => 'admin@raudhahmuamalat.org',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]);
        }

        $partners = [
            [
                'name' => 'UNICEF Malaysia',
                'slug' => 'unicef-malaysia-' . Str::random(5),
                'description' => 'UNICEF works in over 190 countries and territories to save children\'s lives, to defend their rights, and to help them fulfil their potential, from early childhood through adolescence.',
                'url' => 'https://www.unicef.org/malaysia',
                'status' => 'active',
                'featured' => true,
                'display_order' => 1,
                'created_by' => $adminUser->id,
            ],
            [
                'name' => 'World Food Programme',
                'slug' => 'world-food-programme-' . Str::random(5),
                'description' => 'The World Food Programme is the leading humanitarian organization saving lives and changing lives, delivering food assistance in emergencies and working with communities to improve nutrition and build resilience.',
                'url' => 'https://www.wfp.org',
                'status' => 'active',
                'featured' => true,
                'display_order' => 2,
                'created_by' => $adminUser->id,
            ],
            [
                'name' => 'Malaysian Red Crescent Society',
                'slug' => 'malaysian-red-crescent-' . Str::random(5),
                'description' => 'The Malaysian Red Crescent Society is a voluntary relief organization that provides humanitarian services to the community, particularly to the most vulnerable people.',
                'url' => 'https://www.redcrescent.org.my',
                'status' => 'active',
                'featured' => true,
                'display_order' => 3,
                'created_by' => $adminUser->id,
            ],
            [
                'name' => 'Mercy Malaysia',
                'slug' => 'mercy-malaysia-' . Str::random(5),
                'description' => 'MERCY Malaysia is a non-profit organization that provides medical relief, sustainable health-related development and risk reduction activities for vulnerable communities.',
                'url' => 'https://www.mercy.org.my',
                'status' => 'active',
                'featured' => false,
                'display_order' => 4,
                'created_by' => $adminUser->id,
            ],
            [
                'name' => 'Islamic Relief Malaysia',
                'slug' => 'islamic-relief-malaysia-' . Str::random(5),
                'description' => 'Islamic Relief Malaysia works to empower communities to mitigate the effect of disasters, prepare for their occurrence and respond by providing emergency relief, healthcare and education.',
                'url' => 'https://www.islamic-relief.org.my',
                'status' => 'active',
                'featured' => false,
                'display_order' => 5,
                'created_by' => $adminUser->id,
            ],
            [
                'name' => 'Genting Foundation',
                'slug' => 'genting-foundation-' . Str::random(5),
                'description' => 'The Genting Foundation is committed to making a positive impact in the communities where Genting operates, focusing on education, healthcare, and community development.',
                'url' => 'https://www.genting.com/foundation',
                'status' => 'active',
                'featured' => false,
                'display_order' => 6,
                'created_by' => $adminUser->id,
            ],
            [
                'name' => 'Maybank Foundation',
                'slug' => 'maybank-foundation-' . Str::random(5),
                'description' => 'Maybank Foundation focuses on education and community empowerment programmes that create positive and sustainable impact to the bottom 40% of the community.',
                'url' => 'https://www.maybank.com/foundation',
                'status' => 'active',
                'featured' => true,
                'display_order' => 7,
                'created_by' => $adminUser->id,
            ],
            [
                'name' => 'Yayasan Sime Darby',
                'slug' => 'yayasan-sime-darby-' . Str::random(5),
                'description' => 'Yayasan Sime Darby focuses on four key areas: education, healthcare, youth development, and environment to create sustainable communities.',
                'url' => 'https://www.yayasansimedarby.com',
                'status' => 'active',
                'featured' => false,
                'display_order' => 8,
                'created_by' => $adminUser->id,
            ],
            [
                'name' => 'Ministry of Women, Family and Community Development',
                'slug' => 'ministry-women-family-' . Str::random(5),
                'description' => 'The Ministry is responsible for formulating policies and implementing programmes related to women, family, children, and community development in Malaysia.',
                'url' => 'https://www.kpwkm.gov.my',
                'status' => 'active',
                'featured' => false,
                'display_order' => 9,
                'created_by' => $adminUser->id,
            ],
            [
                'name' => 'Department of Social Welfare Malaysia',
                'slug' => 'department-social-welfare-' . Str::random(5),
                'description' => 'The Department of Social Welfare Malaysia provides social protection and welfare services to ensure the wellbeing of individuals, families and communities.',
                'url' => 'https://www.jkm.gov.my',
                'status' => 'active',
                'featured' => false,
                'display_order' => 10,
                'created_by' => $adminUser->id,
            ],
            [
                'name' => 'Teach for Malaysia',
                'slug' => 'teach-for-malaysia-' . Str::random(5),
                'description' => 'Teach for Malaysia develops leaders who expand educational opportunities for children from low-income communities and creates systemic change.',
                'url' => 'https://www.teachformalaysia.org',
                'status' => 'active',
                'featured' => false,
                'display_order' => 11,
                'created_by' => $adminUser->id,
            ],
            [
                'name' => 'Tzu Chi Foundation Malaysia',
                'slug' => 'tzu-chi-foundation-' . Str::random(5),
                'description' => 'Tzu Chi Foundation Malaysia is committed to charity, medicine, education, and humanistic culture, serving communities regardless of race, religion, or nationality.',
                'url' => 'https://www.tzuchi.org.my',
                'status' => 'active',
                'featured' => false,
                'display_order' => 12,
                'created_by' => $adminUser->id,
            ],
            [
                'name' => 'Global Peace Foundation Malaysia',
                'slug' => 'global-peace-foundation-' . Str::random(5),
                'description' => 'Global Peace Foundation Malaysia promotes an innovative, values-based approach to peacebuilding, guided by the vision of One Family under God.',
                'url' => 'https://www.globalpeace.org/malaysia',
                'status' => 'inactive',
                'featured' => false,
                'display_order' => 13,
                'created_by' => $adminUser->id,
            ],
            [
                'name' => 'Habitat for Humanity Malaysia',
                'slug' => 'habitat-humanity-malaysia-' . Str::random(5),
                'description' => 'Habitat for Humanity Malaysia builds strength, stability and self-reliance through shelter, focusing on providing decent and affordable housing.',
                'url' => 'https://www.habitat.org.my',
                'status' => 'active',
                'featured' => false,
                'display_order' => 14,
                'created_by' => $adminUser->id,
            ],
            [
                'name' => 'WWF Malaysia',
                'slug' => 'wwf-malaysia-' . Str::random(5),
                'description' => 'WWF-Malaysia is the leading conservation organization working to conserve nature and reduce the most pressing threats to the diversity of life on Earth.',
                'url' => 'https://www.wwf.org.my',
                'status' => 'active',
                'featured' => true,
                'display_order' => 15,
                'created_by' => $adminUser->id,
            ],
        ];

        foreach ($partners as $partnerData) {
            Partner::create($partnerData);
        }

        $this->command->info('Partner seeder completed successfully. Created ' . count($partners) . ' partners.');
    }
}
