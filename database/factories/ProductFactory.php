<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(mt_rand(3, 6), true),
            'price' => fake()->numberBetween(10, 100),
            'image' => fake()->imageUrl(),
            'description' => fake()->word(),
        ];
    }
}
