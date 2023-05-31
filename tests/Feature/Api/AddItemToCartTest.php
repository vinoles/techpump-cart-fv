<?php

namespace Tests\Feature\Api;

use App\Models\Product;
use Tests\Feature\Requests\Api\AddItemToCartRequest;

class AddItemToCartTest extends TestCase
{
    /**
     * A guest user can add a product in the cart.
     *
     * @test
     * @return void
     */
    public function can_add_a_product_in_the_cart(): void
    {
        session()->forget('token-cart');

        $product = Product::factory()->create();

        $quantity = random_int(1, 5);

        $request = AddItemToCartRequest::make()
            ->withPayload($product->id, $quantity);

        $response = $this
            ->sendRequest($request);

        $response->assertSuccessful();

        $response->json();

        $this->assertEquals(
            1,
            count($response->json('items'))
        );

        $this->assertEquals(
            $quantity,
            $response->json('quantity')
        );
    }

    /**
     * A guest user cannot add a product in the cart if quantity is zero.
     *
     * @test
     * @return void
     */
    public function cannot_add_a_product_in_the_cart_if_quantity_is_zero(): void
    {
        session()->forget('token-cart');

        $product = Product::factory()->create();

        $request = AddItemToCartRequest::make()
            ->withPayload($product->id, 0);

        $response = $this
            ->sendRequest($request);

        $response->assertStatus(422);

        $response->assertJsonPath(
            'message',
            'The quantity field must be at least 1.'
        );
    }

    /**
     * A guest user cannot add a product in the cart if the product not exists.
     *
     * @test
     * @return void
     */
    public function cannot_add_a_product_in_the_cart_if_the_product_not_exists(): void
    {
        session()->forget('token-cart');

        $request = AddItemToCartRequest::make()
            ->withPayload(0, 10);

        $response = $this
            ->sendRequest($request);

        $response->assertStatus(422);

        $response->assertJsonPath(
            'message',
            'The selected product id is invalid.'
        );
    }
}
