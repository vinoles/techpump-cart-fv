<?php

namespace Tests\Feature\Api;

use App\Models\Product;
use Illuminate\Support\Str;
use Tests\Feature\Requests\Api\DeleteItemInCartRequest;

class DeleteItemInCartTest extends TestCase
{
    /**
     * A guest user can delete a product in the cart.
     *
     * @test
     * @return void
     */
    public function can_delete_a_product_in_the_cart(): void
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

        $product = $products->first();

        $request = DeleteItemInCartRequest::make($product);

        $response = $this
            ->sendRequest($request);

        $response->assertSuccessful();

        $data = $response->json();

        $this->assertArrayNotHasKey($product->id, $data);

        $this->assertEquals(
            $products->count() - 1,
            count($response->json('items'))
        );
    }
}
