<?php

namespace Tests\Feature\Api;

use App\Models\Product;
use Illuminate\Support\Str;

class RetrieveCartTest extends TestCase
{
    /**
     * A guest user can retrieve the cart.
     *
     * @test
     * @return void
     */
    public function can_retrieve_cart(): void
    {
        $products = Product::factory()->count(random_int(1, 5))->create();

        $cookieForCart = Str::uuid();

        session(['token-cart' => $cookieForCart]);

        $totalItems = 0;

        foreach ($products as $product) {
            $quantity = random_int(1, 5);

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

            $totalItems = $totalItems + $quantity;
        }

        $response = $this->sendRequest();

        $response->assertSuccessful();

        $this->assertEquals(
            $products->count(),
            $response->json('total_items')
        );

        $cart = \Cart::session($cookieForCart);

        $this->assertEquals(
            $cart->getTotal(),
            $response->json('total')
        );

        $this->assertEquals(
            $cart->getSubtotal(),
            $response->json('subtotal')
        );

        $this->assertEquals(
            $cart->getContent()->sum('quantity'),
            $totalItems
        );
    }
}
