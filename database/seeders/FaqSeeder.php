<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faqs = [
            [
                'title' => 'How do I reset my password?',
                'content' => 'To reset your password, click "Forgot Password" on the login page and follow the instructions.',
                'status' => 'active',
            ],
            [
                'title' => 'How can I contact support?',
                'content' => 'You can contact support via email at support@example.com or by phone.',
                'status' => 'active',
            ],
            [
                'title' => 'What is the refund policy?',
                'content' => 'Refunds are processed within 5-7 business days as per our refund policy.',
                'status' => 'inactive',
            ],
            [
                'title' => 'How do I change my email address?',
                'content' => 'Navigate to your account settings to update your email address.',
                'status' => 'active',
            ],
            [
                'title' => 'Is my personal data secure?',
                'content' => 'We use industry-standard encryption to keep your data safe.',
                'status' => 'active',
            ],
            [
                'title' => 'Can I access the platform on mobile?',
                'content' => 'Yes, our platform is mobile-friendly and supports all major devices.',
                'status' => 'active',
            ],
            [
                'title' => 'How do I delete my account?',
                'content' => 'To delete your account, contact support with a deletion request.',
                'status' => 'inactive',
            ],
            [
                'title' => 'Do you offer discounts for students?',
                'content' => 'Yes, we offer a 10% discount for verified students.',
                'status' => 'active',
            ],
            [
                'title' => 'How often is content updated?',
                'content' => 'Content is updated weekly to ensure accuracy and relevance.',
                'status' => 'active',
            ],
            [
                'title' => 'What payment methods are accepted?',
                'content' => 'We accept credit/debit cards, UPI, and net banking.',
                'status' => 'active',
            ],
        ];

        foreach ($faqs as &$faq) {
            $faq['created_at'] = now();
            $faq['updated_at'] = now();
        }

        DB::table('faqs')->insert($faqs);
    }
}
