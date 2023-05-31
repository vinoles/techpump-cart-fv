<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'price' => $this->faker->numberBetween(0, 50),
            'quantity' => $this->faker->numberBetween(1, 5),
        ];
    }

    /**
     * Indicates the product.
     *
     * @param  \App\Models\Product  $product
     * @return self
     */
    public function forProduct(Product $product): self
    {
        return $this->state([
            'product_id' => $product->id,
        ]);
    }

    /**
     * Indicates the order of the item.
     *
     * @param  \App\Models\Order  $order
     * @return self
     */
    public function forOrder(Order $order): self
    {
        return $this->state([
            'order_id' => $order->id,
        ]);
    }
}
