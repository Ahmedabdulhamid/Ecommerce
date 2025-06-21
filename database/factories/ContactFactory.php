<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=Contact::class;
    public function definition(): array
    {
        return [
            'user_id'=>User::inRandomOrder()->first()->id,
            'name'=>fake()->name(),
            'email'=>fake()->unique()->safeEmail(),
            'phone'=>fake()->phoneNumber(),
            'subject'=>fake()->sentence(3),
            'message'=>fake()->paragraph(3),
            'is_read'=>random_int(0,1),
            'is_replied'=>random_int(0,1)
        ];
    }
}
