<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $price = $this->faker->randomFloat(2, 1, 10000);
        return [
            'user_id' => User::factory(),
            'delivery_date' => date('Y-m-d'),
            'price' => $price,
            'paid_price' => $price,
            'status'    => 'paid',
        ];
    }
}
