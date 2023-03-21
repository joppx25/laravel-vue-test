<?php

namespace Database\Factories;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionCycleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subscription_id' => Subscription::factory(),
            'delivery_date' => date('Y-m-d'),
            'shipping' => 0,
            'price' => $this->faker->randomFloat(2, 1, 10000),    
        ];
    }
}
