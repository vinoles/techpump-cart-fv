<?php

namespace Tests\Feature\Api;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;
use Tests\Feature\Requests\Api\ProcessOrderRequest;
use Tests\Feature\Requests\Api\RetrieveOrdersRequest;

class RetrieveOrdersTest extends TestCase
{
    /**
     * Guests cannot retrieve their orders.
     *
     * @test
     * @return void
     */
    public function guests_cannot_retrieve_their_orders(): void
    {
        $this->sendRequest()->assertUnauthorized();
    }

    /**
     * A user logged can see the list the his orders.
     *
     * @test
     * @return void
     */
    public function user_logged_can_see_the_list_the_his_orders(): void
    {
        $user = User::factory()->create();

        for ($i = 0; $i < 5; $i++) {
            $products = Product::factory()->count(random_int(1, 10))->create();

            $cookieForCart = Str::uuid();

            session(['token-cart' => $cookieForCart]);

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
            }

            $request = ProcessOrderRequest::make()
                ->withPayload();

            $this->signIn($user)->sendRequest($request);
        }

        $request = RetrieveOrdersRequest::make();

        $response = $this->signIn($user)->sendRequest($request);

        $this->assertEquals(5, count($response->json('data')));

        $response->assertSuccessful();
    }
}
