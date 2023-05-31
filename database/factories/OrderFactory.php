<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => fake()->email(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'state' => fake()->word(),
            'postal_code' => fake()->postcode(),
            'country' => fake()->country(),
            'shipping_address' => fake()->address(),
            'shipping_email' => fake()->email(),
            'shipping_note' => fake()->paragraph(2),
            'subtotal' => random_int(50, 300),
            'total' => random_int(50, 300),

        ];
    }

    /**
     * Indicates that the order is for the given user.
     *
     * @param  \App\Models\User  $user
     * @return self
     */
    public function forUser(User $user): self
    {
        return $this->state([
            'user_id' => $user->id,
        ]);
    }
}
