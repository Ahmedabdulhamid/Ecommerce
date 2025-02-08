<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            // محافظات مصر - المدن (تحديث مع 10 مدن لكل محافظة)
            ['name' => ['ar' => 'مدينة نصر', 'en' => 'Nasr City'], 'governorate_id' => 1],
            ['name' => ['ar' => 'المعادي', 'en' => 'Maadi'], 'governorate_id' => 1],
            ['name' => ['ar' => '6 أكتوبر', 'en' => '6th of October'], 'governorate_id' => 2],
            ['name' => ['ar' => 'الإسكندرية الجديدة', 'en' => 'New Alexandria'], 'governorate_id' => 2],
            ['name' => ['ar' => 'الزقازيق', 'en' => 'Zagazig'], 'governorate_id' => 3],
            ['name' => ['ar' => 'المنصورة', 'en' => 'Mansoura'], 'governorate_id' => 3],
            ['name' => ['ar' => 'قنا الجديدة', 'en' => 'New Qena'], 'governorate_id' => 4],
            ['name' => ['ar' => 'أسوان الجديدة', 'en' => 'New Aswan'], 'governorate_id' => 4],
            ['name' => ['ar' => 'أسيوط الجديدة', 'en' => 'New Assiut'], 'governorate_id' => 5],
            ['name' => ['ar' => 'المنيا الجديدة', 'en' => 'New Minya'], 'governorate_id' => 5],

            // السعودية - المدن
            ['name' => ['ar' => 'الرياض الجديدة', 'en' => 'New Riyadh'], 'governorate_id' => 6],
            ['name' => ['ar' => 'جدة الجديدة', 'en' => 'New Jeddah'], 'governorate_id' => 7],
            ['name' => ['ar' => 'الدمام الجديدة', 'en' => 'New Dammam'], 'governorate_id' => 8],
            ['name' => ['ar' => 'مكة الجديدة', 'en' => 'New Mecca'], 'governorate_id' => 9],
            ['name' => ['ar' => 'المدينة المنورة الجديدة', 'en' => 'New Medina'], 'governorate_id' => 10],

            // الإمارات - المدن
            ['name' => ['ar' => 'دبي الجديدة', 'en' => 'New Dubai'], 'governorate_id' => 11],
            ['name' => ['ar' => 'أبوظبي الجديدة', 'en' => 'New Abu Dhabi'], 'governorate_id' => 12],
            ['name' => ['ar' => 'الشارقة الجديدة', 'en' => 'New Sharjah'], 'governorate_id' => 13],
            ['name' => ['ar' => 'رأس الخيمة الجديدة', 'en' => 'New Ras Al Khaimah'], 'governorate_id' => 14],
            ['name' => ['ar' => 'الفجيرة الجديدة', 'en' => 'New Fujairah'], 'governorate_id' => 15],

            // لبنان - المدن
            ['name' => ['ar' => 'بيروت الجديدة', 'en' => 'New Beirut'], 'governorate_id' => 16],
            ['name' => ['ar' => 'طرابلس الجديدة', 'en' => 'New Tripoli'], 'governorate_id' => 17],
            ['name' => ['ar' => 'صور الجديدة', 'en' => 'New Tyre'], 'governorate_id' => 18],
            ['name' => ['ar' => 'صيدا الجديدة', 'en' => 'New Sidon'], 'governorate_id' => 19],
            ['name' => ['ar' => 'بعلبك الجديدة', 'en' => 'New Baalbek'], 'governorate_id' => 20],

            // العراق - المدن
            ['name' => ['ar' => 'بغداد الجديدة', 'en' => 'New Baghdad'], 'governorate_id' => 21],
            ['name' => ['ar' => 'النجف الجديدة', 'en' => 'New Najaf'], 'governorate_id' => 22],
            ['name' => ['ar' => 'بابل الجديدة', 'en' => 'New Babil'], 'governorate_id' => 23],
            ['name' => ['ar' => 'كربلاء الجديدة', 'en' => 'New Karbala'], 'governorate_id' => 24],
            ['name' => ['ar' => 'البصرة الجديدة', 'en' => 'New Basra'], 'governorate_id' => 25],
        ];

        foreach ($cities as $city) {
            DB::table('cities')->insert([
                'name' => json_encode($city['name']), // حفظ البيانات بشكل JSON
                'governorate_id' => $city['governorate_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
