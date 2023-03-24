<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>fake()->name(),
            'description'=>fake()->sentence(),
            'quantity'=>fake()->randomDigit(),
            'status'=>fake()->randomElement(['In-Stock','Out-Of-Stock','Coming Soon']),
            'price'=>fake()->randomDigit(100,1000),
            'image'=>fake()->imageUrl(),
            'category_id'=>function()
            {
                return Category::all()->random();
            },
        ];
    }
}
