<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faq;
use App\Models\User;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure we have an admin user
        $adminUser = User::where('role', 'admin')->first();
        if (!$adminUser) {
            $adminUser = User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@raudhahmuamalat.com',
                'role' => 'admin',
            ]);
        }

        $faqs = [
            // General Category (Basics)
            [
                'question' => 'What is Jariah?',
                'answer' => 'Jariah linguistically means continuous or flowing. In the context of giving donations, Jariah shows an appreciation that has a continuous effect on the giver and helps the recipient over a long period of time.',
                'category' => 'general',
                'status' => 'active',
                'featured' => true,
                'display_order' => 1,
                'created_by' => $adminUser->id,
            ],
            [
                'question' => 'What is Jariah Fund?',
                'answer' => 'Jariah Fund is a public funding platform based on Islamic values that aims to facilitate donors to contribute to aid recipients/beneficiaries.',
                'category' => 'general',
                'status' => 'active',
                'featured' => true,
                'display_order' => 2,
                'created_by' => $adminUser->id,
            ],
            [
                'question' => 'What is Crowdfunding?',
                'answer' => 'Crowdfunding is an online platform to support those who need help. Everyone can contribute a small or large amount to the targeted amount.',
                'category' => 'general',
                'status' => 'active',
                'featured' => false,
                'display_order' => 3,
                'created_by' => $adminUser->id,
            ],
            [
                'question' => 'What types of Jariah Fund campaigns are conducted?',
                'answer' => 'Jariah Fund focuses on social campaigns covering the Education, Health and Economic Empowerment sectors.',
                'category' => 'general',
                'status' => 'active',
                'featured' => false,
                'display_order' => 4,
                'created_by' => $adminUser->id,
            ],

            // Donations Category
            [
                'question' => 'How do I donate to a campaign?',
                'answer' => "Payment via FPX:\n1. Log In / Register\n2. Select campaign\n3. Click 'Donate' button\n4. Enter amount and make payment\n5. You will be taken to the payment page\n6. Choose your preferred payment method and complete your donation\n\nPayment via QR Code:\n1. Select campaign\n2. Click 'DuitNow'\n3. Select banking app\n4. Scan QR code\n5. Enter donation amount and make payment",
                'category' => 'donations',
                'status' => 'active',
                'featured' => true,
                'display_order' => 5,
                'created_by' => $adminUser->id,
            ],
            [
                'question' => 'Do I need to register to donate?',
                'answer' => 'Registration and login only apply to donations via FPX. For donations via QR Code, donors do not need to register and log in.',
                'category' => 'donations',
                'status' => 'active',
                'featured' => false,
                'display_order' => 6,
                'created_by' => $adminUser->id,
            ],
            [
                'question' => 'What are the minimum and maximum amounts for donations?',
                'answer' => 'The minimum amount for a single transaction is RM10 and the maximum is RM1,000. However, donations via QR code can be made starting from RM0.01.',
                'category' => 'donations',
                'status' => 'active',
                'featured' => false,
                'display_order' => 7,
                'created_by' => $adminUser->id,
            ],
            [
                'question' => 'Are there any charges for donors?',
                'answer' => 'Subject to fee exemptions by the main sponsor (if any), normal FPX service fees will be charged accordingly.',
                'category' => 'donations',
                'status' => 'active',
                'featured' => false,
                'display_order' => 8,
                'created_by' => $adminUser->id,
            ],
            [
                'question' => 'Does Jariah Fund charge any fees for crowdfunding donations?',
                'answer' => 'No. We offer crowdfunding donation services with the aim of fulfilling Value Based Intermediation values in the banking industry.',
                'category' => 'donations',
                'status' => 'active',
                'featured' => false,
                'display_order' => 9,
                'created_by' => $adminUser->id,
            ],
            [
                'question' => 'Are my donations tax deductible?',
                'answer' => 'All donations are tax exempt. Our charity partners are registered under the Inland Revenue Board (LHDN) and are eligible for tax exemption through receipts issued by them.',
                'category' => 'donations',
                'status' => 'active',
                'featured' => true,
                'display_order' => 10,
                'created_by' => $adminUser->id,
            ],
            [
                'question' => 'Are my donations secure?',
                'answer' => 'Yes. We use FPX and DuitNow QR payment networks, a secure online payment solution that allows real-time debiting of customers\' internet banking accounts from various banks.',
                'category' => 'donations',
                'status' => 'active',
                'featured' => true,
                'display_order' => 11,
                'created_by' => $adminUser->id,
            ],
            [
                'question' => 'How do I apply for a tax exemption receipt?',
                'answer' => 'For donations via FPX, receipts will be sent to your address as soon as the charity partner receives the list of completed transactions. For donations via DuitNow QR code, you can email us at jariahfund@muamalat.com.my with your transaction details and proof.',
                'category' => 'donations',
                'status' => 'active',
                'featured' => false,
                'display_order' => 12,
                'created_by' => $adminUser->id,
            ],
            [
                'question' => 'When will I receive the tax exemption receipt after donating?',
                'answer' => 'Tax exemption receipts will be sent by our charity partners within 30 days after the campaign ends.',
                'category' => 'donations',
                'status' => 'active',
                'featured' => false,
                'display_order' => 13,
                'created_by' => $adminUser->id,
            ],

            // Campaigns Category
            [
                'question' => 'What happens if a campaign doesn\'t reach its target amount on time?',
                'answer' => "We will:\n• Extend the campaign period; or\n• End the campaign as an incomplete campaign and transfer the donated amount to the beneficiary; or\n• End the campaign as an incomplete campaign and the remaining balance will be added by us\n\n*Any decisions made are subject to our discretion.",
                'category' => 'campaigns',
                'status' => 'active',
                'featured' => true,
                'display_order' => 14,
                'created_by' => $adminUser->id,
            ],
            [
                'question' => 'How do I get updates from campaigns I\'ve donated to?',
                'answer' => 'We will inform all registered donors about the latest developments regarding campaigns through updates on the campaign page or registered email. Donors will be notified after the campaign has been fully funded, the campaign period has ended, and the recipients/beneficiaries have received the donations.',
                'category' => 'campaigns',
                'status' => 'active',
                'featured' => false,
                'display_order' => 15,
                'created_by' => $adminUser->id,
            ],
            [
                'question' => 'How do I contact charity partners?',
                'answer' => 'You can always visit the charity partner\'s website as listed on the Partners page and contact them. You can also email us at jariahfund@muamalat.com.my.',
                'category' => 'campaigns',
                'status' => 'active',
                'featured' => false,
                'display_order' => 16,
                'created_by' => $adminUser->id,
            ],

            // Operations Category
            [
                'question' => 'How does Jariah Fund cover its operational costs?',
                'answer' => 'We are fully sponsored by Bank Muamalat Malaysia Berhad. All operational costs are currently supported by our main sponsor. We do not charge any fees to donors.',
                'category' => 'operations',
                'status' => 'active',
                'featured' => false,
                'display_order' => 17,
                'created_by' => $adminUser->id,
            ],
            [
                'question' => 'What is the due diligence process in selecting charity partners?',
                'answer' => 'We only select trusted and verified charity partners and campaigns. Charity partners running campaigns are thoroughly vetted by a trusted panel to provide full transparency. After charity partners are appointed, we will verify all their modus operandi before, during and after to ensure all aid donations are received by aid recipients. This includes all monitoring, reporting and auditing processes.',
                'category' => 'operations',
                'status' => 'active',
                'featured' => true,
                'display_order' => 18,
                'created_by' => $adminUser->id,
            ],
            [
                'question' => 'What is the breakdown of management costs taken by charity partners?',
                'answer' => 'Management costs taken (if any) are to cover monitoring costs, administrative costs, transportation costs, operational costs and all other types of costs related to charity partner management.',
                'category' => 'operations',
                'status' => 'active',
                'featured' => false,
                'display_order' => 19,
                'created_by' => $adminUser->id,
            ],

            // Partnerships Category (mapped from "Other Matters" section)
            [
                'question' => 'Does Jariah Fund share my personal information?',
                'answer' => "We may use your information obtained as stated in the Terms & Conditions for the purpose of:\n• Updating the latest campaign developments\n• Notifying you of new campaigns that may interest you\n• Delivering our products and services to you\n• Improving our products and services to you\n• Marketing and advertising our products and services and also from other platforms in the network to you\n• To notify you about changes to our services\n• To give you information about fees and charges",
                'category' => 'partnerships',
                'status' => 'active',
                'featured' => false,
                'display_order' => 20,
                'created_by' => $adminUser->id,
            ],
            [
                'question' => 'Is there a registration fee for charity partners to launch campaigns on the platform?',
                'answer' => 'There is no registration fee for charity partners to register on the platform.',
                'category' => 'partnerships',
                'status' => 'active',
                'featured' => false,
                'display_order' => 21,
                'created_by' => $adminUser->id,
            ],
            [
                'question' => 'Will we receive a receipt after donating?',
                'answer' => 'Yes, an electronic receipt (E-Receipt) will be emailed to the registered email address. However, if you use Yahoo and Hotmail email, please print your E-Receipt after donating as there are technical issues for those email users.',
                'category' => 'partnerships',
                'status' => 'active',
                'featured' => false,
                'display_order' => 22,
                'created_by' => $adminUser->id,
            ],
            [
                'question' => 'Is there a fee for transferring funds from Jariah Fund to charity partners?',
                'answer' => 'We do not charge any fees for fund transfers to charity partners in Malaysia. Instead, we bear all transfer fees if any.',
                'category' => 'partnerships',
                'status' => 'active',
                'featured' => false,
                'display_order' => 23,
                'created_by' => $adminUser->id,
            ],
            [
                'question' => 'If we are an Organization/Foundation/NGO/NPO and interested in uploading campaigns on the Jariah Fund portal, what are the steps?',
                'answer' => 'You need to go through our selection process to ensure all criteria are met. After you are accepted, we will review and determine which campaigns are suitable to be featured on our platform.',
                'category' => 'partnerships',
                'status' => 'active',
                'featured' => true,
                'display_order' => 24,
                'created_by' => $adminUser->id,
            ],
            [
                'question' => 'When can charity partners collect funds for their campaigns?',
                'answer' => 'The funds will be transferred to the recipient/beneficiary within 30 days from the day the campaign is fully funded. Depending on the charity partner\'s request, funds can be released earlier subject to our committee\'s approval.',
                'category' => 'partnerships',
                'status' => 'active',
                'featured' => false,
                'display_order' => 25,
                'created_by' => $adminUser->id,
            ],
            [
                'question' => 'How are funds transferred to charity partners?',
                'answer' => 'After the campaign is funded or fully completed, funds will be transferred to the registered account number provided by the charity partner.',
                'category' => 'partnerships',
                'status' => 'active',
                'featured' => false,
                'display_order' => 26,
                'created_by' => $adminUser->id,
            ],
        ];

        // Clear existing FAQs
        Faq::truncate();

        // Create FAQs
        foreach ($faqs as $faqData) {
            Faq::create($faqData);
        }

        echo "✅ FAQ Seeder completed successfully!\n";
        echo "📊 Created " . count($faqs) . " FAQs across 5 categories\n";
        echo "🌟 Featured FAQs: " . collect($faqs)->where('featured', true)->count() . "\n";
        echo "📚 Categories:\n";
        echo "   • General: " . collect($faqs)->where('category', 'general')->count() . " FAQs\n";
        echo "   • Donations: " . collect($faqs)->where('category', 'donations')->count() . " FAQs\n";
        echo "   • Campaigns: " . collect($faqs)->where('category', 'campaigns')->count() . " FAQs\n";
        echo "   • Operations: " . collect($faqs)->where('category', 'operations')->count() . " FAQs\n";
        echo "   • Partnerships: " . collect($faqs)->where('category', 'partnerships')->count() . " FAQs\n";
    }
}
