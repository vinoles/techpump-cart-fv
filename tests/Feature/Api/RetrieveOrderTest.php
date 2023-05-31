<?php

namespace Tests\Feature\Api;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Tests\Feature\Requests\Api\RetrieveOrderRequest;

class RetrieveOrderTest extends TestCase
{
    /**
     * Guests cannot retrieve a order.
     *
     * @test
     * @return void
     */
    public function guests_cannot_retrieve_the_order(): void
    {
        $user = User::factory()->create();

        $order = Order::factory()->forUser($user)->create();

        $request = RetrieveOrderRequest::make($order);

        $this->sendRequest($request)->assertUnauthorized();
    }

    /**
     * A user logged can see the details the a order.
     *
     * @test
     * @return void
     */
    public function user_logged_can_see_the_details_the_a_order(): void
    {
        $user = User::factory()->create();

        $order = Order::factory()->forUser($user)->create();

        $products = Product::factory()->count(random_int(1, 10))->create();

        foreach ($products as $product) {
            OrderItem::factory()
                ->forOrder($order)
                ->forProduct($product)
                ->create();
        }

        $request = RetrieveOrderRequest::make($order);

        $response = $this->signIn($user)->sendRequest($request);

        $data = $response->json('data');

        $this->assertEquals(
            $order->first_name,
            $data['first_name']
        );

        $this->assertEquals(
            $order->last_name,
            $data['last_name']
        );

        $this->assertEquals(
            $order->phone,
            $data['phone']
        );

        $this->assertEquals(
            $order->address,
            $data['address']
        );

        $this->assertEquals(
            $order->email,
            $data['email']
        );

        $this->assertEquals(
            $order->total,
            $data['total']
        );

        $this->assertEquals(
            $order->subtotal,
            $data['subtotal']
        );

        $items = $data['items'];

        $this->assertEquals(
            $products->count(),
            count($items)
        );

        foreach ($products  as $key => $product) {
            $this->assertEquals(
                $product->name,
                $items[$key]['name']
            );
        }

        $response->assertSuccessful();
    }
}
