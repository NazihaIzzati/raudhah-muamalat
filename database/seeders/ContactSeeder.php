<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\User;
use App\Models\Staff;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminStaff = Staff::whereHas('user', function($query) {
            $query->where('user_type', 'staff');
        })->where('role', 'admin')->first();
        
        $contacts = [
            [
                'name' => 'Ahmad Rahman',
                'email' => 'ahmad.rahman@email.com',
                'phone' => '+60123456789',
                'subject' => 'Campaign Support',
                'message' => 'Assalamualaikum, I would like to know more about how to start a fundraising campaign for my local mosque renovation project. Can you provide guidance on the requirements and process?',
                'status' => 'unread',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@email.com',
                'phone' => '+60198765432',
                'subject' => 'Donation Inquiry',
                'message' => 'Hi, I made a donation yesterday but haven\'t received any confirmation email. My transaction reference is TXN123456. Please help me verify the status of my donation.',
                'status' => 'replied',
                'admin_notes' => 'Verified donation in system. Confirmation email was sent manually.',
            ],
            [
                'name' => 'Muhammad Ali',
                'email' => 'muhammad.ali@email.com',
                'phone' => null,
                'subject' => 'Partnership Opportunity',
                'message' => 'Good day, I represent a local charity organization and we are interested in partnering with JariahFund for joint fundraising initiatives. Could we schedule a meeting to discuss potential collaboration?',
                'status' => 'read',
                'admin_notes' => 'Potential partnership opportunity. Need to follow up with partnership team.',
            ],
            [
                'name' => 'Fatimah Zahra',
                'email' => 'fatimah.zahra@email.com',
                'phone' => '+60187654321',
                'subject' => 'Technical Support',
                'message' => 'I am having trouble uploading documents for my campaign application. The file upload seems to fail every time. I have tried different browsers but the issue persists. Please help.',
                'status' => 'unread',
            ],
            [
                'name' => 'Omar Hassan',
                'email' => 'omar.hassan@email.com',
                'phone' => '+60176543210',
                'subject' => 'Media & Press',
                'message' => 'Assalamualaikum, I am a journalist from Berita Harian and would like to feature JariahFund in our upcoming article about Islamic crowdfunding platforms in Malaysia. Could we arrange an interview?',
                'status' => 'read',
                'admin_notes' => 'Media inquiry - forwarded to PR team for response.',
            ],
            [
                'name' => 'Aminah Binti Abdullah',
                'email' => 'aminah.abdullah@email.com',
                'phone' => '+60165432109',
                'subject' => 'General Inquiry',
                'message' => 'I would like to know more about the zakat distribution programs and how I can contribute. Also, do you have any programs specifically for orphan support?',
                'status' => 'replied',
                'admin_notes' => 'Provided information about zakat programs and orphan support initiatives.',
            ],
            [
                'name' => 'Yusuf bin Ibrahim',
                'email' => 'yusuf.ibrahim@email.com',
                'phone' => '+60154321098',
                'subject' => 'Volunteer Application',
                'message' => 'I am interested in volunteering for your humanitarian projects. I have experience in community service and would like to contribute my time and skills. Please let me know about available opportunities.',
                'status' => 'unread',
            ],
            [
                'name' => 'Khadijah Yusof',
                'email' => 'khadijah.yusof@email.com',
                'phone' => '+60143210987',
                'subject' => 'Event Registration',
                'message' => 'I would like to register for the upcoming Islamic Finance Workshop. However, I am having trouble with the online registration form. Can you help me with the registration process?',
                'status' => 'replied',
                'admin_notes' => 'Assisted with registration. Confirmation sent.',
            ],
            [
                'name' => 'Hassan bin Omar',
                'email' => 'hassan.omar@email.com',
                'phone' => '+60132109876',
                'subject' => 'Corporate Donation',
                'message' => 'Our company would like to make a corporate donation to support your emergency relief efforts. We would like to discuss the process and potential tax benefits for corporate donations.',
                'status' => 'read',
                'admin_notes' => 'Corporate donation inquiry. Forwarded to fundraising team.',
            ],
            [
                'name' => 'Maryam Salleh',
                'email' => 'maryam.salleh@email.com',
                'phone' => '+60121098765',
                'subject' => 'Feedback',
                'message' => 'I recently donated to the Gaza relief campaign and I am very satisfied with the transparency and updates provided. Thank you for your excellent work and may Allah bless your efforts.',
                'status' => 'replied',
                'admin_notes' => 'Positive feedback received. Thank you message sent.',
            ],
        ];

        foreach ($contacts as $contactData) {
            Contact::create([
                'name' => $contactData['name'],
                'email' => $contactData['email'],
                'phone' => $contactData['phone'],
                'subject' => $contactData['subject'],
                'message' => $contactData['message'],
                'status' => $contactData['status'],
                'admin_notes' => $contactData['admin_notes'] ?? null,
            ]);
        }
        
        $this->command->info('✅ Contact seeding completed!');
        $this->command->info('📧 Contacts created: ' . Contact::count());
    }
} 