<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\SubscriptionCycle;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
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
            'order_id' => Order::factory(),
            'product_id' => Product::factory(),
            'subscription_cycle_id' => SubscriptionCycle::factory(),
            'price' => $price,
            'paid_price' =>  $price,
            'status'    => 'paid',
        ];
    }
}
