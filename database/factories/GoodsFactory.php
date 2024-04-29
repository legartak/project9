<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Goods>
 */
class GoodsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'goods_name' => fake()->word(),
            'goods_price' => fake()->randomFloat(min: 0.25,max: 1000),
            'goods_description' => fake()->paragraph(),
            // in this way I want to get random fk for cat_id
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
