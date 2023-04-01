<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
            "product_name" => fake()->word(5),
            "stock" => rand(1, 50),
            "price" => 100000,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
