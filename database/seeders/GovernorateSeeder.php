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
            //محافظات تونس
            ['name' => ['ar' => 'أريانةة', 'en' => 'Ariana'], 'countary_id' => 7],
            ['name' => ['ar' => 'بن عروس', 'en' => 'Ben Arous'], 'countary_id' => 7],
            ['name' => ['ar' => 'بنزرت', 'en' => 'Bizerte'], 'countary_id' => 7],
            ['name' => ['ar' => 'قابس', 'en' => 'Gabès'], 'countary_id' => 7],
            ['name' => ['ar' => 'قفصة', 'en' => 'Gafsa'], 'countary_id' => 7],
            ['name' => ['ar' => 'جندوبة', 'en' => 'Jendouba'], 'countary_id' => 7],
            ['name' => ['ar' => 'القيروان', 'en' => 'Kairouan'], 'countary_id' => 7],
            ['name' => ['ar' => 'القصرين', 'en' => 'Kasserine'], 'countary_id' => 7],
            ['name' => ['ar' => 'قبلي', 'en' => 'Kebili'], 'countary_id' => 7],
            ['name' => ['ar' => 'الكاف', 'en' => 'Kef'], 'countary_id' => 7],
            ['name' => ['ar' => 'نابل', 'en' => 'Nabeul'], 'countary_id' => 7],
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
            // محافظات الاردن

                ['name' => ['ar' => 'عمان', 'en' => 'Amman'], 'countary_id' => 9],
                ['name' => ['ar' => 'إربد', 'en' => 'Irbid'], 'countary_id' => 9],
                ['name' => ['ar' => 'الزرقاء', 'en' => 'Zarqa'], 'countary_id' => 9],
                ['name' => ['ar' => 'البلقاء', 'en' => 'Balqa'], 'countary_id' => 9],
                ['name' => ['ar' => 'المفرق', 'en' => 'Mafraq'], 'countary_id' => 9],
                ['name' => ['ar' => 'الكرك', 'en' => 'Karak'], 'countary_id' => 9],
                ['name' => ['ar' => 'الطفيلة', 'en' => 'Tafilah'], 'countary_id' => 9],
                ['name' => ['ar' => 'معان', 'en' => 'Ma’an'], 'countary_id' => 9],
                ['name' => ['ar' => 'العقبة', 'en' => 'Aqaba'], 'countary_id' => 9],
                ['name' => ['ar' => 'جرش', 'en' => 'Jerash'], 'countary_id' => 9],
                ['name' => ['ar' => 'عجلون', 'en' => 'Ajloun'], 'countary_id' => 9],
                ['name' => ['ar' => 'مأدبا', 'en' => 'Madaba'], 'countary_id' => 9],



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
                ['name' => ['ar' => 'المثنى', 'en' => 'Muthanna'], 'countary_id' => 10],

            // محافظات سوريا

                ['name' => ['ar' => 'دمشق', 'en' => 'Damascus'], 'countary_id' => 11],
                ['name' => ['ar' => 'ريف دمشق', 'en' => 'Rif Dimashq'], 'countary_id' => 11],
                ['name' => ['ar' => 'حلب', 'en' => 'Aleppo'], 'countary_id' => 11],
                ['name' => ['ar' => 'حمص', 'en' => 'Homs'], 'countary_id' => 11],
                ['name' => ['ar' => 'حماة', 'en' => 'Hama'], 'countary_id' => 11],
                ['name' => ['ar' => 'اللاذقية', 'en' => 'Latakia'], 'countary_id' => 11],
                ['name' => ['ar' => 'طرطوس', 'en' => 'Tartus'], 'countary_id' => 11],
                ['name' => ['ar' => 'إدلب', 'en' => 'Idlib'], 'countary_id' => 11],
                ['name' => ['ar' => 'دير الزور', 'en' => 'Deir ez-Zor'], 'countary_id' => 11],
                ['name' => ['ar' => 'الرقة', 'en' => 'Raqqa'], 'countary_id' => 11],
                ['name' => ['ar' => 'الحسكة', 'en' => 'Al-Hasakah'], 'countary_id' => 11],
                ['name' => ['ar' => 'درعا', 'en' => 'Daraa'], 'countary_id' => 11],
                ['name' => ['ar' => 'السويداء', 'en' => 'As-Suwayda'], 'countary_id' => 11],
                ['name' => ['ar' => 'القنيطرة', 'en' => 'Quneitra'], 'countary_id' => 11],

            // محافظات فلسطين

                ['name' => ['ar' => 'القدس', 'en' => 'Jerusalem'], 'countary_id' => 12],
                ['name' => ['ar' => 'رام الله والبيرة', 'en' => 'Ramallah and Al-Bireh'], 'countary_id' => 12],
                ['name' => ['ar' => 'الخليل', 'en' => 'Hebron'], 'countary_id' => 12],
                ['name' => ['ar' => 'نابلس', 'en' => 'Nablus'], 'countary_id' => 12],
                ['name' => ['ar' => 'جنين', 'en' => 'Jenin'], 'countary_id' => 12],
                ['name' => ['ar' => 'طولكرم', 'en' => 'Tulkarm'], 'countary_id' => 12],
                ['name' => ['ar' => 'قلقيلية', 'en' => 'Qalqilya'], 'countary_id' => 12],
                ['name' => ['ar' => 'سلفيت', 'en' => 'Salfit'], 'countary_id' => 12],
                ['name' => ['ar' => 'طوباس', 'en' => 'Tubas'], 'countary_id' => 12],
                ['name' => ['ar' => 'أريحا والأغوار', 'en' => 'Jericho and Jordan Valley'], 'countary_id' => 12],
                ['name' => ['ar' => 'غزة', 'en' => 'Gaza'], 'countary_id' => 12],
                ['name' => ['ar' => 'شمال غزة', 'en' => 'North Gaza'], 'countary_id' => 12],
                ['name' => ['ar' => 'الوسطى', 'en' => 'Deir al-Balah (Central)'], 'countary_id' => 12],
                ['name' => ['ar' => 'خانيونس', 'en' => 'Khan Yunis'], 'countary_id' => 12],
                ['name' => ['ar' => 'رفح', 'en' => 'Rafah'], 'countary_id' => 12],

            //محافظات السودان

                ['name' => ['ar' => 'الخرطوم', 'en' => 'Khartoum'], 'countary_id' => 13],
                ['name' => ['ar' => 'كسلا', 'en' => 'Kassala'], 'countary_id' => 13],
                ['name' => ['ar' => 'البحر الأحمر', 'en' => 'Red Sea'], 'countary_id' => 13],
                ['name' => ['ar' => 'نهر النيل', 'en' => 'River Nile'], 'countary_id' => 13],
                ['name' => ['ar' => 'الشمالية', 'en' => 'Northern'], 'countary_id' => 13],
                ['name' => ['ar' => 'شمال كردفان', 'en' => 'North Kordofan'], 'countary_id' => 13],
                ['name' => ['ar' => 'جنوب كردفان', 'en' => 'South Kordofan'], 'countary_id' => 13],
                ['name' => ['ar' => 'غرب كردفان', 'en' => 'West Kordofan'], 'countary_id' => 13],
                ['name' => ['ar' => 'شمال دارفور', 'en' => 'North Darfur'], 'countary_id' => 13],
                ['name' => ['ar' => 'جنوب دارفور', 'en' => 'South Darfur'], 'countary_id' => 13],
                ['name' => ['ar' => 'غرب دارفور', 'en' => 'West Darfur'], 'countary_id' => 13],
                ['name' => ['ar' => 'وسط دارفور', 'en' => 'Central Darfur'], 'countary_id' => 13],
                ['name' => ['ar' => 'شرق دارفور', 'en' => 'East Darfur'], 'countary_id' => 13],
                ['name' => ['ar' => 'الجزيرة', 'en' => 'Al Jazirah'], 'countary_id' => 13],
                ['name' => ['ar' => 'سنار', 'en' => 'Sennar'], 'countary_id' => 13],
                ['name' => ['ar' => 'النيل الأزرق', 'en' => 'Blue Nile'], 'countary_id' => 13],
                ['name' => ['ar' => 'القضارف', 'en' => 'Gedaref'], 'countary_id' => 13],
                ['name' => ['ar' => 'النيل الأبيض', 'en' => 'White Nile'], 'countary_id' => 13],



                ['name' => ['ar' => 'طرابلس', 'en' => 'Tripoli'], 'countary_id' => 14],
                ['name' => ['ar' => 'بنغازي', 'en' => 'Benghazi'], 'countary_id' => 14],
                ['name' => ['ar' => 'مصراتة', 'en' => 'Misrata'], 'countary_id' => 14],
                ['name' => ['ar' => 'الزاوية', 'en' => 'Zawiya'], 'countary_id' => 14],
                ['name' => ['ar' => 'سبها', 'en' => 'Sebha'], 'countary_id' => 14],
                ['name' => ['ar' => 'درنة', 'en' => 'Derna'], 'countary_id' => 14],
                ['name' => ['ar' => 'طبرق', 'en' => 'Tobruk'], 'countary_id' => 14],
                ['name' => ['ar' => 'زليتن', 'en' => 'Zliten'], 'countary_id' => 14],
                ['name' => ['ar' => 'سرت', 'en' => 'Sirte'], 'countary_id' => 14],


                ['name' => ['ar' => 'صنعاء', 'en' => 'Sanaa'], 'countary_id' => 15],
                ['name' => ['ar' => 'عدن', 'en' => 'Aden'], 'countary_id' => 15],
                ['name' => ['ar' => 'تعز', 'en' => 'Taiz'], 'countary_id' => 15],
                ['name' => ['ar' => 'الحديدة', 'en' => 'Al Hudaydah'], 'countary_id' => 15],
                ['name' => ['ar' => 'إب', 'en' => 'Ibb'], 'countary_id' => 15],
                ['name' => ['ar' => 'حضرموت', 'en' => 'Hadramaut'], 'countary_id' => 15],
                ['name' => ['ar' => 'المهرة', 'en' => 'Al Mahrah'], 'countary_id' => 15],
                ['name' => ['ar' => 'حجة', 'en' => 'Hajjah'], 'countary_id' => 15],

                ['name' => ['ar' => 'العاصمة', 'en' => 'Capital'], 'countary_id' => 16],
                ['name' => ['ar' => 'حولي', 'en' => 'Hawalli'], 'countary_id' => 16],
                ['name' => ['ar' => 'الفروانية', 'en' => 'Farwaniya'], 'countary_id' => 16],
                ['name' => ['ar' => 'الأحمدي', 'en' => 'Ahmadi'], 'countary_id' => 16],
                ['name' => ['ar' => 'مبارك الكبير', 'en' => 'Mubarak Al-Kabeer'], 'countary_id' => 16],
                ['name' => ['ar' => 'الجهراء', 'en' => 'Jahra'], 'countary_id' => 16],

                ['name' => ['ar' => 'مسقط', 'en' => 'Muscat'], 'countary_id' => 17],
                ['name' => ['ar' => 'ظفار', 'en' => 'Dhofar'], 'countary_id' => 17],
                ['name' => ['ar' => 'مسندم', 'en' => 'Musandam'], 'countary_id' => 17],
                ['name' => ['ar' => 'البريمي', 'en' => 'Al Buraimi'], 'countary_id' => 17],
                ['name' => ['ar' => 'الداخلية', 'en' => 'Ad Dakhiliyah'], 'countary_id' => 17],
                ['name' => ['ar' => 'شمال الباطنة', 'en' => 'North Al Batinah'], 'countary_id' => 17],
                ['name' => ['ar' => 'جنوب الباطنة', 'en' => 'South Al Batinah'], 'countary_id' => 17],
                ['name' => ['ar' => 'الوسطى', 'en' => 'Al Wusta'], 'countary_id' => 17],
                 ['name' => ['ar' => 'العاصمة', 'en' => 'Capital'], 'countary_id' => 18],
                ['name' => ['ar' => 'المحرق', 'en' => 'Muharraq'], 'countary_id' => 18],
                ['name' => ['ar' => 'المنامة', 'en' => 'Manama'], 'countary_id' => 18],
                ['name' => ['ar' => 'الرفاع', 'en' => 'Riffa'], 'countary_id' => 18],
                ['name' => ['ar' => 'المحافظة الشمالية', 'en' => 'Northern'], 'countary_id' => 18],
                ['name' => ['ar' => 'المحافظة الجنوبية', 'en' => 'Southern'], 'countary_id' => 18],

                    ['name' => ['ar' => 'نواكشوط', 'en' => 'Nouakchott'], 'countary_id' => 19],
                    ['name' => ['ar' => 'نواذيبو', 'en' => 'Nouadhibou'], 'countary_id' => 19],
                    ['name' => ['ar' => 'الحوض الشرقي', 'en' => 'Hodh Ech Chargui'], 'countary_id' => 19],
                    ['name' => ['ar' => 'الحوض الغربي', 'en' => 'Hodh El Gharbi'], 'countary_id' => 19],
                    ['name' => ['ar' => 'تكانت', 'en' => 'Tagant'], 'countary_id' => 19],
                    ['name' => ['ar' => 'لبراكنة', 'en' => 'Brakna'], 'countary_id' => 19],

                ['name' => ['ar' => 'مدينة جيبوتي', 'en' => 'Djibouti City'], 'countary_id' => 20],
                ['name' => ['ar' => 'علي صبيح', 'en' => 'Ali Sabieh'], 'countary_id' => 20],
                ['name' => ['ar' => 'تاجورا', 'en' => 'Tadjourah'], 'countary_id' => 20],
                ['name' => ['ar' => 'عرتا', 'en' => 'Arta'], 'countary_id' => 20],
                ['name' => ['ar' => 'دخل', 'en' => 'Dikhil'], 'countary_id' => 20],
                ['name' => ['ar' => 'أوبوك', 'en' => 'Obock'], 'countary_id' => 20],

                ['name' => ['ar' => 'القمر الكبرى', 'en' => 'Grande Comore'], 'countary_id' => 21],
                ['name' => ['ar' => 'أنجوان', 'en' => 'Anjouan'], 'countary_id' => 21],
                ['name' => ['ar' => 'موهيلي', 'en' => 'Mohéli'], 'countary_id' => 21],

                ['name' => ['ar' => 'بنادر', 'en' => 'Banadir'], 'countary_id' => 22],
                ['name' => ['ar' => 'أودال', 'en' => 'Awdal'], 'countary_id' => 22],
                ['name' => ['ar' => 'باي', 'en' => 'Bay'], 'countary_id' => 22],
                ['name' => ['ar' => 'بكول', 'en' => 'Bakool'], 'countary_id' => 22],
                ['name' => ['ar' => 'جدو', 'en' => 'Gedo'], 'countary_id' => 22],
                ['name' => ['ar' => 'مدق', 'en' => 'Mudug'], 'countary_id' => 22],
                ['name' => ['ar' => 'شبيلي السفلى', 'en' => 'Lower Shabelle'], 'countary_id' => 22],
                ['name' => ['ar' => 'شبيلي الوسطى', 'en' => 'Middle Shabelle'], 'countary_id' => 22],
                ['name' => ['ar' => 'سول', 'en' => 'Sool'], 'countary_id' => 22],

                ['name' => ['ar' => 'إسطنبول', 'en' => 'Istanbul'], 'countary_id' => 23],
                ['name' => ['ar' => 'أنقرة', 'en' => 'Ankara'], 'countary_id' => 23],
                ['name' => ['ar' => 'إزمير', 'en' => 'Izmir'], 'countary_id' => 23],
                ['name' => ['ar' => 'أنطاليا', 'en' => 'Antalya'], 'countary_id' => 23],
                ['name' => ['ar' => 'بورصة', 'en' => 'Bursa'], 'countary_id' => 23],
                ['name' => ['ar' => 'أضنة', 'en' => 'Adana'], 'countary_id' => 23],
                ['name' => ['ar' => 'غازي عنتاب', 'en' => 'Gaziantep'], 'countary_id' => 23],
                ['name' => ['ar' => 'قونية', 'en' => 'Konya'], 'countary_id' => 23],
                ['name' => ['ar' => 'طرابزون', 'en' => 'Trabzon'], 'countary_id' => 23],

                ['name' => ['ar' => 'طهران', 'en' => 'Tehran'], 'countary_id' => 24],
                ['name' => ['ar' => 'أصفهان', 'en' => 'Isfahan'], 'countary_id' => 24],
                ['name' => ['ar' => 'مشهد', 'en' => 'Mashhad'], 'countary_id' => 24],
                ['name' => ['ar' => 'شيراز', 'en' => 'Shiraz'], 'countary_id' => 24],
                ['name' => ['ar' => 'قم', 'en' => 'Qom'], 'countary_id' => 24],
                ['name' => ['ar' => 'تبريز', 'en' => 'Tabriz'], 'countary_id' => 24],
                ['name' => ['ar' => 'كرمان', 'en' => 'Kerman'], 'countary_id' => 24],
                ['name' => ['ar' => 'همدان', 'en' => 'Hamedan'], 'countary_id' => 24],
                ['name' => ['ar' => 'كرج', 'en' => 'Karaj'], 'countary_id' => 24],

                ['name' => ['ar' => 'البنجاب', 'en' => 'Punjab'], 'countary_id' => 25],
                ['name' => ['ar' => 'السند', 'en' => 'Sindh'], 'countary_id' => 25],
                ['name' => ['ar' => 'خيبر بختونخوا', 'en' => 'Khyber Pakhtunkhwa'], 'countary_id' => 25],
                ['name' => ['ar' => 'بلوشستان', 'en' => 'Balochistan'], 'countary_id' => 25],
                ['name' => ['ar' => 'جلجت-بلتستان', 'en' => 'Gilgit-Baltistan'], 'countary_id' => 25],
                ['name' => ['ar' => 'إسلام أباد', 'en' => 'Islamabad'], 'countary_id' => 25],
                ['name' => ['ar' => 'آزاد كشمير', 'en' => 'Azad Kashmir'], 'countary_id' => 25]














        ];

        foreach ($provinces as $province) {
            DB::table('governorates')->insert([
                'name' => json_encode($province['name']), // حفظ البيانات بشكل JSON
                'countary_id' => $province['countary_id'],
                'created_at' => now(),
                'updated_at' => now(),
                'price'=>mt_rand(50,1000)
            ]);
        }
    }
}
