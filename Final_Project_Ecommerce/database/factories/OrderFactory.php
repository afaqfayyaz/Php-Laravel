<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'quantity'=>fake()->randomDigit,
            'user_id'=>function()
            {
                return User::all()->random();
            },
            'product_id'=>function()
            {
                return Product::all()->random();
            },

        ];
    }
}
