<?php

namespace Tests\Feature\Api;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Tests\Feature\Requests\Api\UpdateItemToCartRequest;

class UpdateItemToCartTest extends TestCase
{
    /**
     * A guest user can update a product in the cart.
     *
     * @test
     * @return void
     */
    public function can_update_a_product_in_the_cart(): void
    {
        session()->forget('token-cart');

        $products = Product::factory()->count(random_int(1, 5))->create();

        $cookieForCart = Str::uuid();

        session(['token-cart' => $cookieForCart]);

        Cookie::make('token-cart', $cookieForCart, 10, '/', 'test-fv-techpump.test');

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

        $quantity = $quantity + 1;

        $request = UpdateItemToCartRequest::make()
            ->withPayload($product->id, $quantity);

        $response = $this
            ->sendRequest($request);

        $response->assertSuccessful();

        $data = $response->json('items');

        $data = $data[$product->id];

        $this->assertEquals(
            $products->count(),
            count($response->json('items'))
        );

        // $this->assertEquals(
        //     $quantity,
        //     $response->json('quantity')
        // );

        // $this->assertEquals(
        //     $products->count(),
        //     count($response->json())
        // );

        $this->assertEquals(
            $quantity,
            $data['quantity']
        );
    }

    /**
     * A guest user cannot update a product in the cart if quantity is zero.
     *
     * @test
     * @return void
     */
    public function cannot_update_a_product_in_the_cart_if_quantity_is_zero(): void
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

        $request = UpdateItemToCartRequest::make()
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
     * A guest user cannot update a product in the cart if the product not exists.
     *
     * @test
     * @return void
     */
    public function cannot_update_a_product_in_the_cart_if_the_product_not_exists(): void
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

        $request = UpdateItemToCartRequest::make()
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
