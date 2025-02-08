<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            [
                'name' => ['ar' => 'مصر', 'en' => 'Egypt'],
                'flag_icon' => '🇪🇬',
                'numeric_code' => '818',

            ],
            [
                'name' => ['ar' => 'المملكة العربية السعودية', 'en' => 'Saudi Arabia'],
                'flag_icon' => '🇸🇦',
                'numeric_code' => '682'
            ],
            [
                'name' => ['ar' => 'الإمارات العربية المتحدة', 'en' => 'United Arab Emirates'],
                'flag_icon' => '🇦🇪',
                'numeric_code' => '784'
            ],
            [
                'name' => ['ar' => 'قطر', 'en' => 'Qatar'],
                'flag_icon' => '🇶🇦',
                'numeric_code' => '634'
            ],
            [
                'name' => ['ar' => 'المغرب', 'en' => 'Morocco'],
                'flag_icon' => '🇲🇦',
                'numeric_code' => '504'
            ],
            [
                'name' => ['ar' => 'الجزائر', 'en' => 'Algeria'],
                'flag_icon' => '🇩🇿',
                'numeric_code' => '012'
            ],
            [
                'name' => ['ar' => 'تونس', 'en' => 'Tunisia'],
                'flag_icon' => '🇹🇳',
                'numeric_code' => '788'
            ],
            [
                'name' => ['ar' => 'لبنان', 'en' => 'Lebanon'],
                'flag_icon' => '🇱🇧',
                'numeric_code' => '422'
            ],
            [
                'name' => ['ar' => 'الأردن', 'en' => 'Jordan'],
                'flag_icon' => '🇯🇴',
                'numeric_code' => '400'
            ],
            [
                'name' => ['ar' => 'العراق', 'en' => 'Iraq'],
                'flag_icon' => '🇮🇶',
                'numeric_code' => '368'
            ],
            [
                'name' => ['ar' => 'سوريا', 'en' => 'Syria'],
                'flag_icon' => '🇸🇾',
                'numeric_code' => '760'
            ],
            [
                'name' => ['ar' => 'فلسطين', 'en' => 'Palestine'],
                'flag_icon' => '🇵🇸',
                'numeric_code' => '275'
            ],
            [
                'name' => ['ar' => 'السودان', 'en' => 'Sudan'],
                'flag_icon' => '🇸🇩',
                'numeric_code' => '729'
            ],
            [
                'name' => ['ar' => 'ليبيا', 'en' => 'Libya'],
                'flag_icon' => '🇱🇾',
                'numeric_code' => '434'
            ],
            [
                'name' => ['ar' => 'اليمن', 'en' => 'Yemen'],
                'flag_icon' => '🇾🇪',
                'numeric_code' => '887'
            ],
            ['name' => ['ar' => 'الكويت', 'en' => 'Kuwait'], 'flag_icon' => '🇰🇼', 'numeric_code' => '414'],
            ['name' => ['ar' => 'عمان', 'en' => 'Oman'], 'flag_icon' => '🇴🇲', 'numeric_code' => '512'],
            ['name' => ['ar' => 'البحرين', 'en' => 'Bahrain'], 'flag_icon' => '🇧🇭', 'numeric_code' => '048'],
            ['name' => ['ar' => 'موريتانيا', 'en' => 'Mauritania'], 'flag_icon' => '🇲🇷', 'numeric_code' => '478'],
            ['name' => ['ar' => 'جيبوتي', 'en' => 'Djibouti'], 'flag_icon' => '🇩🇯', 'numeric_code' => '262'],
            ['name' => ['ar' => 'جزر القمر', 'en' => 'Comoros'], 'flag_icon' => '🇰🇲', 'numeric_code' => '174'],
            ['name' => ['ar' => 'الصومال', 'en' => 'Somalia'], 'flag_icon' => '🇸🇴', 'numeric_code' => '706'],
            ['name' => ['ar' => 'تركيا', 'en' => 'Turkey'], 'flag_icon' => '🇹🇷', 'numeric_code' => '792'],
            ['name' => ['ar' => 'إيران', 'en' => 'Iran'], 'flag_icon' => '🇮🇷', 'numeric_code' => '364'],
            ['name' => ['ar' => 'باكستان', 'en' => 'Pakistan'], 'flag_icon' => '🇵🇰', 'numeric_code' => '586']
        ];

        foreach ($countries as $country) {
            DB::table('countaries')->insert([
                'name' => json_encode($country['name']), // تخزين الاسم كـ JSON
                'flag_icon' => $country['flag_icon'],
                'numeric_code' => $country['numeric_code'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
