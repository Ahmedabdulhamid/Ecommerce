<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [
            // مصر (مضاف 10 محافظات باللغتين)
            ['name' => ['ar' => 'القاهرة', 'en' => 'Cairo'], 'countary_id' => 1],
            ['name' => ['ar' => 'الإسكندرية', 'en' => 'Alexandria'], 'countary_id' => 1],
            ['name' => ['ar' => 'الجيزة', 'en' => 'Giza'], 'countary_id' => 1],
            ['name' => ['ar' => 'الشرقية', 'en' => 'Sharqia'], 'countary_id' => 1],
            ['name' => ['ar' => 'الدقهلية', 'en' => 'Dakahlia'], 'countary_id' => 1],
            ['name' => ['ar' => 'قنا', 'en' => 'Qena'], 'countary_id' => 1],
            ['name' => ['ar' => 'أسوان', 'en' => 'Aswan'], 'countary_id' => 1],
            ['name' => ['ar' => 'أسيوط', 'en' => 'Assiut'], 'countary_id' => 1],
            ['name' => ['ar' => 'المنوفية', 'en' => 'Menoufia'], 'countary_id' => 1],
            ['name' => ['ar' => 'المنيا', 'en' => 'Minya'], 'countary_id' => 1],

            // السعودية (مضاف 10 محافظات باللغتين)
            ['name' => ['ar' => 'الرياض', 'en' => 'Riyadh'], 'countary_id' => 2],
            ['name' => ['ar' => 'جدة', 'en' => 'Jeddah'], 'countary_id' => 2],
            ['name' => ['ar' => 'مكة', 'en' => 'Mecca'], 'countary_id' => 2],
            ['name' => ['ar' => 'الدمام', 'en' => 'Dammam'], 'countary_id' => 2],
            ['name' => ['ar' => 'المدينة المنورة', 'en' => 'Medina'], 'countary_id' => 2],
            ['name' => ['ar' => 'الطائف', 'en' => 'Taif'], 'countary_id' => 2],
            ['name' => ['ar' => 'حائل', 'en' => 'Hail'], 'countary_id' => 2],
            ['name' => ['ar' => 'تبوك', 'en' => 'Tabuk'], 'countary_id' => 2],
            ['name' => ['ar' => 'القصيم', 'en' => 'Qassim'], 'countary_id' => 2],
            ['name' => ['ar' => 'الباحة', 'en' => 'Al-Baha'], 'countary_id' => 2],

            // الإمارات (مضاف 10 محافظات باللغتين)
            ['name' => ['ar' => 'دبي', 'en' => 'Dubai'], 'countary_id' => 3],
            ['name' => ['ar' => 'أبوظبي', 'en' => 'Abu Dhabi'], 'countary_id' => 3],
            ['name' => ['ar' => 'الشارقة', 'en' => 'Sharjah'], 'countary_id' => 3],
            ['name' => ['ar' => 'رأس الخيمة', 'en' => 'Ras Al Khaimah'], 'countary_id' => 3],
            ['name' => ['ar' => 'الفجيرة', 'en' => 'Fujairah'], 'countary_id' => 3],
            ['name' => ['ar' => 'عجمان', 'en' => 'Ajman'], 'countary_id' => 3],
            ['name' => ['ar' => 'أم القيوين', 'en' => 'Umm Al-Quwain'], 'countary_id' => 3],
            ['name' => ['ar' => 'الظفرة', 'en' => 'Al Dhafra'], 'countary_id' => 3],
            ['name' => ['ar' => 'مليحة', 'en' => 'Mleiha'], 'countary_id' => 3],
            ['name' => ['ar' => 'دبا', 'en' => 'Diba'], 'countary_id' => 3],

            // قطر (مضاف 10 محافظات باللغتين)
            ['name' => ['ar' => 'الدوحة', 'en' => 'Doha'], 'countary_id' => 4],
            ['name' => ['ar' => 'الريان', 'en' => 'Al Rayyan'], 'countary_id' => 4],
            ['name' => ['ar' => 'الوكرة', 'en' => 'Al Wakrah'], 'countary_id' => 4],
            ['name' => ['ar' => 'الخور', 'en' => 'Al Khor'], 'countary_id' => 4],
            ['name' => ['ar' => 'الشمال', 'en' => 'Al Shamal'], 'countary_id' => 4],
            ['name' => ['ar' => 'الدوحة الجديدة', 'en' => 'New Doha'], 'countary_id' => 4],
            ['name' => ['ar' => 'مسيعيد', 'en' => 'Mesaieed'], 'countary_id' => 4],
            ['name' => ['ar' => 'الشيحانية', 'en' => 'Al Sheehaniya'], 'countary_id' => 4],
            ['name' => ['ar' => 'الزبارة', 'en' => 'Al Zubara'], 'countary_id' => 4],
            ['name' => ['ar' => 'دخان', 'en' => 'Dukhan'], 'countary_id' => 4],

            // المغرب (مضاف 10 محافظات باللغتين)
            ['name' => ['ar' => 'الدار البيضاء', 'en' => 'Casablanca'], 'countary_id' => 5],
            ['name' => ['ar' => 'فاس', 'en' => 'Fes'], 'countary_id' => 5],
            ['name' => ['ar' => 'مراكش', 'en' => 'Marrakech'], 'countary_id' => 5],
            ['name' => ['ar' => 'الرباط', 'en' => 'Rabat'], 'countary_id' => 5],
            ['name' => ['ar' => 'طنجة', 'en' => 'Tangier'], 'countary_id' => 5],
            ['name' => ['ar' => 'أغادير', 'en' => 'Agadir'], 'countary_id' => 5],
            ['name' => ['ar' => 'القنيطرة', 'en' => 'Kenitra'], 'countary_id' => 5],
            ['name' => ['ar' => 'مكناس', 'en' => 'Meknes'], 'countary_id' => 5],
            ['name' => ['ar' => 'العيون', 'en' => 'Laayoune'], 'countary_id' => 5],
            ['name' => ['ar' => 'القدس', 'en' => 'Jerusalem'], 'countary_id' => 5],

            // الجزائر (مضاف 10 محافظات باللغتين)
            ['name' => ['ar' => 'الجزائر العاصمة', 'en' => 'Algiers'], 'countary_id' => 6],
            ['name' => ['ar' => 'وهران', 'en' => 'Oran'], 'countary_id' => 6],
            ['name' => ['ar' => 'عنابة', 'en' => 'Annaba'], 'countary_id' => 6],
            ['name' => ['ar' => 'باتنة', 'en' => 'Batna'], 'countary_id' => 6],
            ['name' => ['ar' => 'المدية', 'en' => 'Medea'], 'countary_id' => 6],
            ['name' => ['ar' => 'قسنطينة', 'en' => 'Constantine'], 'countary_id' => 6],
            ['name' => ['ar' => 'بسكرة', 'en' => 'Biskra'], 'countary_id' => 6],
            ['name' => ['ar' => 'سيدي بلعباس', 'en' => 'Sidi Bel Abbes'], 'countary_id' => 6],
            ['name' => ['ar' => 'تلمسان', 'en' => 'Tlemcen'], 'countary_id' => 6],
            ['name' => ['ar' => 'الطارف', 'en' => 'Tarf'], 'countary_id' => 6],

            // لبنان (مضاف 10 محافظات باللغتين)
            ['name' => ['ar' => 'بيروت', 'en' => 'Beirut'], 'countary_id' => 8],
            ['name' => ['ar' => 'طرابلس', 'en' => 'Tripoli'], 'countary_id' => 8],
            ['name' => ['ar' => 'صور', 'en' => 'Tyre'], 'countary_id' => 8],
            ['name' => ['ar' => 'صيدا', 'en' => 'Sidon'], 'countary_id' => 8],
            ['name' => ['ar' => 'بعلبك', 'en' => 'Baalbek'], 'countary_id' => 8],
            ['name' => ['ar' => 'زحلة', 'en' => 'Zahle'], 'countary_id' => 8],
            ['name' => ['ar' => 'جبيل', 'en' => 'Byblos'], 'countary_id' => 8],
            ['name' => ['ar' => 'الشوف', 'en' => 'Chouf'], 'countary_id' => 8],
            ['name' => ['ar' => 'النبطية', 'en' => 'Nabatieh'], 'countary_id' => 8],
            ['name' => ['ar' => 'الكورة', 'en' => 'Koura'], 'countary_id' => 8],

            // العراق (مضاف 10 محافظات باللغتين)
            ['name' => ['ar' => 'بغداد', 'en' => 'Baghdad'], 'countary_id' => 10],
            ['name' => ['ar' => 'النجف', 'en' => 'Najaf'], 'countary_id' => 10],
            ['name' => ['ar' => 'بابل', 'en' => 'Babil'], 'countary_id' => 10],
            ['name' => ['ar' => 'كربلاء', 'en' => 'Karbala'], 'countary_id' => 10],
            ['name' => ['ar' => 'البصرة', 'en' => 'Basra'], 'countary_id' => 10],
            ['name' => ['ar' => 'كركوك', 'en' => 'Kirkuk'], 'countary_id' => 10],
            ['name' => ['ar' => 'السماوة', 'en' => 'Samawa'], 'countary_id' => 10],
            ['name' => ['ar' => 'ديالى', 'en' => 'Diyala'], 'countary_id' => 10],
            ['name' => ['ar' => 'صلاح الدين', 'en' => 'Salah ad-Din'], 'countary_id' => 10],
            ['name' => ['ar' => 'المثنى', 'en' => 'Muthanna'], 'countary_id' => 10]
        ];

        foreach ($provinces as $province) {
            DB::table('governorates')->insert([
                'name' => json_encode($province['name']), // حفظ البيانات بشكل JSON
                'countary_id' => $province['countary_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
