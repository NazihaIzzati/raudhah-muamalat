<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\User;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUsers = User::where('role', 'admin')->pluck('id')->toArray();
        
        $contacts = [
            [
                'first_name' => 'Ahmad',
                'last_name' => 'Rahman',
                'email' => 'ahmad.rahman@email.com',
                'phone' => '+60123456789',
                'subject' => 'Campaign Support',
                'message' => 'Assalamualaikum, I would like to know more about how to start a fundraising campaign for my local mosque renovation project. Can you provide guidance on the requirements and process?',
                'status' => 'new',
                'is_urgent' => false,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'first_name' => 'Siti',
                'last_name' => 'Nurhaliza',
                'email' => 'siti.nurhaliza@email.com',
                'phone' => '+60198765432',
                'subject' => 'Donation Inquiry',
                'message' => 'Hi, I made a donation yesterday but haven\'t received any confirmation email. My transaction reference is TXN123456. Please help me verify the status of my donation.',
                'status' => 'replied',
                'is_urgent' => true,
                'replied_by' => $adminUsers ? $adminUsers[0] : null,
                'replied_at' => now()->subHours(6),
                'admin_notes' => 'Verified donation in system. Confirmation email was sent manually.',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subHours(6),
            ],
            [
                'first_name' => 'Muhammad',
                'last_name' => 'Ali',
                'email' => 'muhammad.ali@email.com',
                'phone' => null,
                'subject' => 'Partnership Opportunity',
                'message' => 'Good day, I represent a local charity organization and we are interested in partnering with Raudhah Muamalat for joint fundraising initiatives. Could we schedule a meeting to discuss potential collaboration?',
                'status' => 'read',
                'is_urgent' => false,
                'admin_notes' => 'Potential partnership opportunity. Need to follow up with partnership team.',
                'created_at' => now()->subHours(12),
                'updated_at' => now()->subHours(8),
            ],
            [
                'first_name' => 'Fatimah',
                'last_name' => 'Zahra',
                'email' => 'fatimah.zahra@email.com',
                'phone' => '+60187654321',
                'subject' => 'Technical Support',
                'message' => 'I am having trouble uploading documents for my campaign application. The file upload seems to fail every time. I have tried different browsers but the issue persists. Please help.',
                'status' => 'new',
                'is_urgent' => true,
                'created_at' => now()->subHours(3),
                'updated_at' => now()->subHours(3),
            ],
            [
                'first_name' => 'Omar',
                'last_name' => 'Hassan',
                'email' => 'omar.hassan@email.com',
                'phone' => '+60176543210',
                'subject' => 'Media & Press',
                'message' => 'Assalamualaikum, I am a journalist from Berita Harian and would like to feature Raudhah Muamalat in our upcoming article about Islamic crowdfunding platforms in Malaysia. Could we arrange an interview?',
                'status' => 'read',
                'is_urgent' => false,
                'admin_notes' => 'Media inquiry - forwarded to PR team for response.',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(2),
            ],
            [
                'first_name' => 'Aminah',
                'last_name' => 'Binti Abdullah',
                'email' => 'aminah.abdullah@email.com',
                'phone' => '+60165432109',
                'subject' => 'General Inquiry',
                'message' => 'I would like to know more about the zakat distribution programs and how I can contribute. Also, do you have any programs specifically for orphan support?',
                'status' => 'replied',
                'is_urgent' => false,
                'replied_by' => $adminUsers ? $adminUsers[0] : null,
                'replied_at' => now()->subDays(1),
                'admin_notes' => 'Provided information about zakat programs and orphan support initiatives.',
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(1),
            ],
            [
                'first_name' => 'Ismail',
                'last_name' => 'Ibrahim',
                'email' => 'ismail.ibrahim@email.com',
                'phone' => null,
                'subject' => 'Campaign Support',
                'message' => 'My campaign has been under review for over a week. When can I expect approval? The beneficiaries are in urgent need of the funds for medical treatment.',
                'status' => 'new',
                'is_urgent' => true,
                'created_at' => now()->subHours(6),
                'updated_at' => now()->subHours(6),
            ],
            [
                'first_name' => 'Khadijah',
                'last_name' => 'Mohd',
                'email' => 'khadijah.mohd@email.com',
                'phone' => '+60154321098',
                'subject' => 'Donation Inquiry',
                'message' => 'Can I set up a monthly recurring donation? I would like to contribute RM100 every month to your emergency relief fund.',
                'status' => 'closed',
                'is_urgent' => false,
                'replied_by' => $adminUsers ? $adminUsers[0] : null,
                'replied_at' => now()->subDays(5),
                'admin_notes' => 'Set up monthly recurring donation as requested. Customer satisfied with the service.',
                'created_at' => now()->subWeek(),
                'updated_at' => now()->subDays(5),
            ],
        ];

        foreach ($contacts as $contactData) {
            Contact::create($contactData);
        }

        $this->command->info('✅ Contact messages seeded successfully!');
        $this->command->info('📧 Created ' . count($contacts) . ' contact messages with various statuses');
    }
} 