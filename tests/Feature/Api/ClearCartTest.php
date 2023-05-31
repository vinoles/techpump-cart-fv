<?php

namespace Tests\Feature\Api;

use App\Models\Product;
use Illuminate\Support\Str;

class ClearCartTest extends TestCase
{
    /**
     * A guest user can clear the cart.
     *
     * @test
     * @return void
     */
    public function can_clean_the_cart(): void
    {
        session()->forget('token-cart');

        $products = Product::factory()->count(random_int(1, 5))->create();

        $cookieForCart = Str::uuid();

        session(['token-cart' => $cookieForCart]);

        $quantity = random_int(1, 5);

        foreach ($products as $product) {
            \Cart::session($cookieForCart)
                ->add([
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'attributes' => [
                        'image' => $product->image,
                    ],
                ]);
        }

        $response = $this->sendRequest();

        $response->assertSuccessful();
    }

    /**
     * A guest user cannot clear the cart.
     *
     * @test
     * @return void
     */
    public function cannot_clean_the_cart(): void
    {
        $response = $this->sendRequest();

        $response->assertStatus(403);
    }
}
