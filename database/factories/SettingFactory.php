<?php

namespace Database\Factories;

use App\Models\Setting;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SettingFactory extends Factory
{
    protected $model=Setting::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create('ar_SA');
        return [
            'site_name' => json_encode([
                'en' => $this->faker->company,
                'ar' => 'موقع ' . $this->faker->company
            ], JSON_UNESCAPED_UNICODE),

            'site_desc' => json_encode([
                'en' => $this->faker->sentence,
                'ar' => 'وصف الموقع: ' . $this->faker->sentence
            ], JSON_UNESCAPED_UNICODE),

            'site_email' => $this->faker->unique()->safeEmail,

            'site_address' => json_encode([
                'en' => $this->faker->address,
                'ar' => 'العنوان: ' . $this->faker->address
            ], JSON_UNESCAPED_UNICODE),

            'email_support' => 'support@' . $this->faker->domainName,

            'facebook_url' => 'https://www.facebook.com/' . $this->faker->userName,
            'twitter_url' => 'https://twitter.com/' . $this->faker->userName,
            'youtube_url' => 'https://www.youtube.com/channel/' . $this->faker->regexify('[A-Za-z0-9]{10}'),

            'meta_description' => json_encode([
                'en' => $this->faker->sentence(10),
                'ar' => 'وصف ميتا: ' . $this->faker->sentence(10)
            ], JSON_UNESCAPED_UNICODE),

            'logo' => 'uploads/logos/' . $this->faker->uuid . '.png',
            'favicon' => 'uploads/favicons/' . $this->faker->uuid . '.ico',



            'promotion_video_url' => 'https://www.youtube.com/watch?v=' . $this->faker->regexify('[A-Za-z0-9]{11}')
        ];
    }
}
