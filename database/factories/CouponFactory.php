<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CouponFactory extends Factory
{
    protected $model=Coupon::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $limit=$this->faker->numberBetween(10,100);
        $time_used=$this->faker->numberBetween(0,$limit);
        return [
           'code'=>$this->faker->unique()->regexify('[A-Z0-9]{10}'),
           'discount_precentage'=>$this->faker->numberBetween(10,50),
           'start_at'=>now()->addDays(random_int(1,4)),
           'end_at'=>now()->addDays(random_int(5,15)),
           'limit'=>$limit,
           'time_used'=>$time_used,
           'status'=>'active'
        ];
    }
}
