<?php

namespace Database\Seeders;


use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeederSetting extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'site_name' => [
                'en' => 'My Awesome Website',
                'ar' => 'موقعي الرائع'
            ],
            'site_desc' => [
                'en' => 'This is a brief description of the website.',
                'ar' => 'هذا وصف مختصر للموقع.'
            ],
            'site_email' => 'info@example.com',
            'site_address' => [
                'en' => '123 Street, New York, USA',
                'ar' => '١٢٣ شارع، نيويورك، الولايات المتحدة'
            ],
            'email_support' => 'support@example.com',
            'facebook_url' => 'https://www.facebook.com/mywebsite',
            'twitter_url' => 'https://twitter.com/mywebsite',
            'youtube_url' => 'https://www.youtube.com/c/mywebsite',
            'meta_description' => [
                'en' => 'This is a meta description for SEO purposes.',
                'ar' => 'هذا وصف ميتا لأغراض تحسين محركات البحث.'
            ],
            'logo' => 'uploads/logos/logo.png',
            'favicon' => 'uploads/favicons/favicon.ico',

            'promotion_video_url' => 'https://www.youtube.com/watch?v=abcdefghij'
        ];
        Setting::create([
            'site_name'=>$settings['site_name'],
            'site_desc'=>$settings['site_desc'],
            'site_email'=>$settings['site_email'],
            'site_address'=>$settings['site_address'],
            'email_support'=>$settings['email_support'],
            'facebook_url'=>$settings['facebook_url'],
            'twitter_url'=>$settings['twitter_url'],
            'youtube_url'=>$settings['youtube_url'],
            'meta_description'=>$settings['meta_description'],
            'logo'=>$settings['logo'],
            'promotion_video_url'=>$settings['promotion_video_url']
        ]);

    }
}
