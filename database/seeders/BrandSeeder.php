<?php

namespace Database\Seeders;

use App\Models\Brand;
use Spatie\Sluggable\HasSlug;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
       $brands = [
            [
                'name' => ['ar' => 'سامسونج', 'en' => 'Samsung'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/2/24/Samsung_Logo.svg',
            ],
            [
                'name' => ['ar' => 'آبل', 'en' => 'Apple'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg',
            ],
            [
                'name' => ['ar' => 'سوني', 'en' => 'Sony'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/2/2e/Sony_logo.svg',
            ],
            [
                'name' => ['ar' => 'إل جي', 'en' => 'LG'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/7/7c/LG_logo_%282015%29.svg',
            ],
            [
                'name' => ['ar' => 'هواوي', 'en' => 'Huawei'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/5/5e/Huawei.svg',
            ],
            [
                'name' => ['ar' => 'شاومي', 'en' => 'Xiaomi'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/2/29/Xiaomi_logo.svg',
            ],
            [
                'name' => ['ar' => 'أوبو', 'en' => 'Oppo'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/5/5a/OPPO_Logo_2019.svg',
            ],
            [
                'name' => ['ar' => 'نوكيا', 'en' => 'Nokia'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/0/07/Nokia_wordmark.svg',
            ],
            [
                'name' => ['ar' => 'ديل', 'en' => 'Dell'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/4/48/Dell_Logo.svg',
            ],
            [
                'name' => ['ar' => 'إتش بي', 'en' => 'HP'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/3/3a/HP_logo_2012.svg',
            ],
            [
                'name' => ['ar' => 'لينوفو', 'en' => 'Lenovo'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/4/4c/Lenovo_Global_Corporate_Logo.png',
            ],
            [
                'name' => ['ar' => 'مايكروسوفت', 'en' => 'Microsoft'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg',
            ],
            [
                'name' => ['ar' => 'ريزر', 'en' => 'Razer'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/4/45/Razer_logo_green.svg',
            ],
            [
                'name' => ['ar' => 'أسوس', 'en' => 'Asus'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/8/82/Asus_logo.svg',
            ],
            [
                'name' => ['ar' => 'إيسر', 'en' => 'Acer'],
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/5/5a/Acer_2011.svg',
            ],
        ];
        foreach ($brands as $brand) {
           Brand::create([
            'name'=>$brand['name'],
            'logo'=>$brand['logo'],
           ]);
        }
    }
}
