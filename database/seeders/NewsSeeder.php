<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\User;
use App\Models\Campaign;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $campaigns = Campaign::all();
        
        $newsData = [
            [
                'title' => 'Raudhah Muamalat Launches New Zakat Collection Campaign',
                'excerpt' => 'Initiative aims to support underprivileged families during Ramadan with comprehensive assistance programs.',
                'content' => 'Raudhah Muamalat has announced the launch of its comprehensive Zakat collection campaign, designed to provide essential support to underprivileged families throughout the holy month of Ramadan. The campaign focuses on addressing critical needs including food security, education, and healthcare access for vulnerable communities across Malaysia.

The initiative includes partnerships with local mosques, community centers, and social welfare organizations to ensure efficient distribution of aid. "Our goal is to make a meaningful impact in the lives of those who need it most," said the organization\'s spokesperson. "This campaign represents our commitment to Islamic values of charity and community support."

The campaign features multiple donation channels including online platforms, mobile banking, and traditional collection points. All contributions will be transparently managed and reported to donors.',
                'category' => 'announcement',
                'status' => 'published',
                'featured' => true,
                'display_order' => 1,
            ],
            [
                'title' => 'Community Iftar Program Reaches Record Participation',
                'excerpt' => 'Over 500 families benefited from the community iftar program, strengthening bonds during Ramadan.',
                'content' => 'The annual community iftar program organized by Raudhah Muamalat has achieved unprecedented success this year, with over 500 families participating in the month-long initiative. The program, which provides daily iftar meals to families in need, has become a cornerstone of the organization\'s Ramadan activities.

"Seeing the community come together to break fast and share meals has been truly heartwarming," said program coordinator Ahmad Rahman. "The program not only addresses food security but also fosters community spirit and Islamic brotherhood."

The initiative included special provisions for elderly residents, single mothers, and families with children. Volunteers from various backgrounds contributed their time and resources to ensure the program\'s success. Plans are already underway to expand the program for next year\'s Ramadan.',
                'category' => 'event',
                'status' => 'published',
                'featured' => true,
                'display_order' => 2,
            ],
            [
                'title' => 'New Islamic Finance Workshop Series Announced',
                'excerpt' => 'Free workshops on Islamic banking principles and halal investment opportunities for the community.',
                'content' => 'Raudhah Muamalat is proud to announce a new series of Islamic finance workshops designed to educate the community about halal banking principles and investment opportunities. The workshops, which will be conducted by certified Islamic finance experts, aim to promote financial literacy within Islamic guidelines.

The series covers topics including:
- Understanding Islamic banking principles
- Halal investment opportunities
- Zakat calculation and distribution
- Islamic estate planning
- Ethical business practices

Each workshop includes practical sessions and Q&A opportunities. "Financial literacy is crucial for community development," said workshop facilitator Dr. Siti Aminah. "We want to ensure that our community members have access to knowledge that aligns with Islamic values."

Registration is now open for the first workshop, scheduled for next month. The series will run throughout the year with both in-person and online sessions available.',
                'category' => 'general',
                'status' => 'published',
                'featured' => false,
                'display_order' => 3,
            ],
            [
                'title' => 'Emergency Relief Fund Established for Natural Disasters',
                'excerpt' => 'New fund to provide immediate assistance to communities affected by natural disasters and emergencies.',
                'content' => 'In response to the increasing frequency of natural disasters affecting Malaysian communities, Raudhah Muamalat has established an Emergency Relief Fund to provide immediate assistance to affected families. The fund is designed to respond quickly to emergencies including floods, landslides, and other natural calamities.

The fund operates with a network of local coordinators who can assess needs and distribute aid within 24 hours of a disaster. "Our experience with previous emergency responses has taught us the importance of preparedness and rapid response," said emergency coordinator Zainab Hassan.

The fund accepts donations year-round and maintains reserves for immediate deployment. All contributions are used exclusively for emergency relief efforts, with transparent reporting to donors. The organization has also established partnerships with government agencies and other NGOs for coordinated disaster response.',
                'category' => 'campaign',
                'status' => 'published',
                'featured' => false,
                'display_order' => 4,
            ],
            [
                'title' => 'Youth Leadership Program Applications Open',
                'excerpt' => 'Six-month program designed to develop leadership skills in young Muslims aged 18-25.',
                'content' => 'Applications are now open for the Raudhah Muamalat Youth Leadership Program, a comprehensive six-month initiative designed to develop leadership skills in young Muslims aged 18-25. The program combines Islamic values with modern leadership principles to prepare participants for community service and professional success.

Program highlights include:
- Leadership development workshops
- Community service projects
- Mentorship from experienced leaders
- Islamic ethics and values training
- Networking opportunities
- Certificate upon completion

"The program aims to create a new generation of leaders who can serve their communities with Islamic values," said program director Faridah Ismail. "We believe in investing in our youth as they are the future of our community."

Selected participants will receive full scholarships covering all program costs. Applications close next month, with the program scheduled to begin in three months.',
                'category' => 'event',
                'status' => 'published',
                'featured' => false,
                'display_order' => 5,
            ],
            [
                'title' => 'Digital Transformation Initiative Launched',
                'excerpt' => 'New online platforms and mobile apps to improve service delivery and community engagement.',
                'content' => 'Raudhah Muamalat has launched a comprehensive digital transformation initiative aimed at improving service delivery and community engagement. The initiative includes new online platforms, mobile applications, and digital tools designed to make charitable giving and community participation more accessible.

Key features of the digital transformation include:
- Online donation platform with multiple payment options
- Mobile app for campaign updates and notifications
- Digital Zakat calculator
- Online event registration system
- Transparent reporting dashboard
- Community forum for discussions

"The digital transformation will help us reach more people and provide better services," said IT director Kamaluddin Ahmad. "We\'re committed to using technology to enhance our Islamic charitable work while maintaining the personal touch that our community values."

The new platforms are designed to be user-friendly and accessible to people of all ages and technical abilities. Training sessions will be provided to help community members navigate the new digital tools.',
                'category' => 'update',
                'status' => 'published',
                'featured' => false,
                'display_order' => 6,
            ],
            [
                'title' => 'Women Empowerment Seminar Series Announced',
                'excerpt' => 'Monthly seminars focusing on women\'s rights, education, and economic empowerment within Islamic framework.',
                'content' => 'Raudhah Muamalat is launching a new Women Empowerment Seminar Series designed to address the unique challenges and opportunities facing Muslim women in Malaysia. The monthly seminars will cover topics including women\'s rights in Islam, educational opportunities, economic empowerment, and community leadership.

Each seminar features expert speakers including Islamic scholars, business leaders, and community activists. "We believe that empowered women are essential for strong families and communities," said seminar coordinator Nurul Ain. "These sessions provide a safe space for women to learn, share experiences, and support each other."

The series is open to women of all ages and backgrounds. Childcare services will be provided during sessions to ensure accessibility for mothers with young children. The first seminar is scheduled for next month with registration now open.',
                'category' => 'event',
                'status' => 'published',
                'featured' => false,
                'display_order' => 7,
            ],
            [
                'title' => 'Annual Report: Record-Breaking Year for Community Impact',
                'excerpt' => 'Comprehensive report shows significant increase in community programs and beneficiary reach.',
                'content' => 'Raudhah Muamalat has released its annual report, revealing a record-breaking year of community impact and charitable activities. The comprehensive report details significant achievements across all program areas including education, healthcare, emergency relief, and community development.

Key highlights from the report include:
- 15,000+ families assisted through various programs
- RM 2.5 million distributed in charitable aid
- 50+ community events organized
- 200+ volunteers actively engaged
- 95% donor satisfaction rate
- 100% transparency in fund utilization

"The report demonstrates our commitment to accountability and transparency," said executive director Dr. Mohd Aziz. "We\'re proud of our achievements but recognize that there\'s always more work to be done. Our success is due to the generous support of our donors and the dedication of our volunteers."

The full report is available on the organization\'s website and includes detailed breakdowns of all programs and financial statements.',
                'category' => 'general',
                'status' => 'published',
                'featured' => false,
                'display_order' => 8,
            ],
            [
                'title' => 'Partnership with Islamic Universities Announced',
                'excerpt' => 'Collaboration with leading Islamic universities to enhance educational programs and research initiatives.',
                'content' => 'Raudhah Muamalat has announced strategic partnerships with leading Islamic universities in Malaysia to enhance educational programs and research initiatives. The partnerships will focus on developing innovative approaches to Islamic charitable work and community development.

The collaboration includes:
- Joint research projects on Islamic philanthropy
- Student internship programs
- Academic conferences and seminars
- Curriculum development for Islamic studies
- Community outreach programs
- Professional development for staff

"These partnerships will strengthen our academic foundation and ensure our programs are based on sound Islamic principles and modern best practices," said education director Prof. Dr. Aminah Yusof. "We\'re excited about the opportunities for learning and growth that these collaborations will provide."

The partnerships will also create opportunities for university students to gain practical experience in Islamic charitable work while contributing to community development efforts.',
                'category' => 'announcement',
                'status' => 'published',
                'featured' => false,
                'display_order' => 9,
            ],
            [
                'title' => 'New Volunteer Training Program Launched',
                'excerpt' => 'Comprehensive training program for volunteers covering Islamic values and community service skills.',
                'content' => 'A new comprehensive volunteer training program has been launched by Raudhah Muamalat to prepare community members for effective service delivery. The program covers essential skills including Islamic values, communication, project management, and community engagement.

The training program includes:
- Islamic ethics and values in community service
- Effective communication with diverse populations
- Project planning and implementation
- Crisis management and emergency response
- Cultural sensitivity and inclusivity
- Leadership and team building

"Volunteers are the backbone of our organization," said volunteer coordinator Siti Mariam. "This training program ensures that our volunteers are well-prepared to serve the community with professionalism and Islamic values."

The program is open to all community members interested in volunteering. Successful completion of the training program is required for participation in major community projects and leadership roles.',
                'category' => 'update',
                'status' => 'draft',
                'featured' => false,
                'display_order' => 10,
            ],
            [
                'title' => 'Sustainable Development Goals Integration',
                'excerpt' => 'Organization aligns programs with UN Sustainable Development Goals while maintaining Islamic principles.',
                'content' => 'Raudhah Muamalat has announced the integration of United Nations Sustainable Development Goals (SDGs) into its program framework while maintaining strong Islamic principles. The initiative aims to contribute to global development objectives while ensuring all activities align with Islamic values and local community needs.

The integration covers key areas including:
- Poverty alleviation (SDG 1)
- Quality education (SDG 4)
- Gender equality (SDG 5)
- Clean water and sanitation (SDG 6)
- Climate action (SDG 13)
- Partnerships for goals (SDG 17)

"Islamic values and sustainable development are perfectly aligned," said sustainability director Dr. Khadijah Ibrahim. "Our programs demonstrate how Islamic principles can contribute to global development objectives while serving local communities."

The organization will track and report progress on SDG contributions while maintaining its focus on Islamic charitable work and community development.',
                'category' => 'general',
                'status' => 'draft',
                'featured' => false,
                'display_order' => 11,
            ],
            [
                'title' => 'Mental Health Support Program Development',
                'excerpt' => 'New initiative to provide mental health support within Islamic framework and cultural context.',
                'content' => 'Raudhah Muamalat is developing a new mental health support program designed to provide culturally appropriate mental health services within an Islamic framework. The program will address the growing need for mental health support in the Muslim community while respecting Islamic values and cultural sensitivities.

Program components include:
- Islamic counseling approaches
- Community-based support groups
- Educational workshops on mental health
- Referral services to qualified professionals
- Crisis intervention support
- Family counseling services

"Mental health is an important aspect of overall well-being that has been overlooked in many communities," said program developer Dr. Noraini Ahmad. "Our program will provide support that is both culturally appropriate and professionally sound."

The program is currently in development with input from mental health professionals, Islamic scholars, and community members. Launch is scheduled for next quarter.',
                'category' => 'campaign',
                'status' => 'draft',
                'featured' => false,
                'display_order' => 12,
            ],
        ];

        foreach ($newsData as $index => $data) {
            $slug = Str::slug($data['title']);
            $baseSlug = $slug;
            $counter = 1;
            
            // Ensure slug is unique
            while (News::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }

            News::create([
                'title' => $data['title'],
                'slug' => $slug,
                'content' => $data['content'],
                'excerpt' => $data['excerpt'],
                'category' => $data['category'],
                'status' => $data['status'],
                'featured' => $data['featured'],
                'display_order' => $data['display_order'],
                'published_at' => $data['status'] === 'published' ? now() : null,
                'created_by' => $users->random()->id,
            ]);
        }

        $this->command->info('News seeded successfully!');
    }
}
