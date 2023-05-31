<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class Products extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Product 1',
                'price' => 250,
                'description' => 'lorem ipsum',
                'image' => fake()->imageUrl(),
            ],
            [
                'name' => 'Product 12',
                'price' => 6,
                'description' => 'lorem ipsum',
                'image' => fake()->imageUrl(),
            ],
            [
                'name' => 'Product 3',
                'price' => 50,
                'description' => 'lorem ipsum',
                'image' => fake()->imageUrl(),
            ],
            [
                'name' => 'Product 4',
                'price' => 12,
                'description' => 'lorem ipsum',
                'image' => fake()->imageUrl(),
            ],
        ];

        Product::insert($products);
    }
}
