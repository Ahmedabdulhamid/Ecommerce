<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'questions' => [
                    'en' => 'What payment methods do you accept?',
                    'ar' => 'ما هي طرق الدفع التي تقبلونها؟'
                ],
                'answers' => [
                    'en' => 'We accept credit cards, PayPal, and bank transfers.',
                    'ar' => 'نقبل بطاقات الائتمان، باي بال، والتحويلات البنكية.'
                ]
            ],
            [
                'questions' => [
                    'en' => 'How can I track my order?',
                    'ar' => 'كيف يمكنني تتبع طلبي؟'
                ],
                'answers' => [
                    'en' => 'You can track your order through the tracking link sent to your email.',
                    'ar' => 'يمكنك تتبع طلبك من خلال رابط التتبع المرسل إلى بريدك الإلكتروني.'
                ]
            ],
            [
                'questions' => [
                    'en' => 'Do you offer international shipping?',
                    'ar' => 'هل تقدمون الشحن الدولي؟'
                ],
                'answers' => [
                    'en' => 'Yes, we offer international shipping to most countries.',
                    'ar' => 'نعم، نقدم الشحن الدولي لمعظم الدول.'
                ]
            ],
            [
                'questions' => [
                    'en' => 'Can I return a product?',
                    'ar' => 'هل يمكنني إرجاع المنتج؟'
                ],
                'answers' => [
                    'en' => 'Yes, you can return a product within 14 days of purchase.',
                    'ar' => 'نعم، يمكنك إرجاع المنتج خلال 14 يومًا من الشراء.'
                ]
            ],
            [
                'questions' => [
                    'en' => 'How do I contact customer support?',
                    'ar' => 'كيف يمكنني التواصل مع دعم العملاء؟'
                ],
                'answers' => [
                    'en' => 'You can contact our support team via email or phone.',
                    'ar' => 'يمكنك التواصل مع فريق الدعم لدينا عبر البريد الإلكتروني أو الهاتف.'
                ]
            ],
            [
                'questions' => [
                    'en' => 'What are your business hours?',
                    'ar' => 'ما هي ساعات العمل لديكم؟'
                ],
                'answers' => [
                    'en' => 'Our business hours are from 9 AM to 6 PM, Monday to Friday.',
                    'ar' => 'ساعات العمل لدينا من 9 صباحًا حتى 6 مساءً، من الاثنين إلى الجمعة.'
                ]
            ],
            [
                'questions' => [
                    'en' => 'Do you have a refund policy?',
                    'ar' => 'هل لديكم سياسة استرداد؟'
                ],
                'answers' => [
                    'en' => 'Yes, we offer a 30-day money-back guarantee.',
                    'ar' => 'نعم، نقدم ضمان استرداد الأموال لمدة 30 يومًا.'
                ]
            ],
            [
                'questions' => [
                    'en' => 'Do you provide warranty on products?',
                    'ar' => 'هل تقدمون ضمان على المنتجات؟'
                ],
                'answers' => [
                    'en' => 'Yes, all our products come with a one-year warranty.',
                    'ar' => 'نعم، جميع منتجاتنا تأتي مع ضمان لمدة سنة واحدة.'
                ]
            ],
            [
                'questions' => [
                    'en' => 'How can I change my shipping address?',
                    'ar' => 'كيف يمكنني تغيير عنوان الشحن؟'
                ],
                'answers' => [
                    'en' => 'You can update your shipping address from your account settings.',
                    'ar' => 'يمكنك تحديث عنوان الشحن من إعدادات حسابك.'
                ]
            ],
            [
                'questions' => [
                    'en' => 'Is my personal information secure?',
                    'ar' => 'هل معلوماتي الشخصية آمنة؟'
                ],
                'answers' => [
                    'en' => 'Yes, we use encryption to protect your personal information.',
                    'ar' => 'نعم، نستخدم التشفير لحماية معلوماتك الشخصية.'
                ]
            ],
            // إضافة المزيد من الأسئلة حتى تصل إلى 30
        ];

        foreach ($faqs as $faq) {
            Faq::create([
                'questions' => $faq['questions'],
                'answers' => $faq['answers']
            ]);
        }
    }
}
