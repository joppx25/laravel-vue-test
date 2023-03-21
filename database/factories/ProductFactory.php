<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'menu_id' => Menu::factory(),
            'sku'   => $this->faker->ean13(),
            'title' => $this->faker->title,
            'price' => $this->faker->randomFloat(2, 1, 10000),
        ];
    }
}
