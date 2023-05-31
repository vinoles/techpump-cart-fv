<?php

namespace Tests\Feature\Api;

use App\Mail\SendPasswordToUser;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Tests\Feature\Requests\Api\ProcessOrderRequest;

class ProcessOrderTest extends TestCase
{
    /**
     * A user not logged in can buy and receives an email with his password.
     *
     * @test
     * @return void
     */
    public function user_not_logged_can_buy_and_receives_an_email_with_his_password(): void
    {
        Mail::fake();

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

        $response = $this
            ->sendRequest($request);

        $response->assertJsonPath(
            'message',
            'Payment made successfully, enter our platform to manage your purchases'
        );

        $response->assertSuccessful();

        Mail::assertSent(SendPasswordToUser::class);
    }

    /**
     * A user not logged in can buy.
     *
     * @test
     * @return void
     */
    public function user_logged_can_buy(): void
    {
        Mail::fake();

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

        $response = $this->signIn()
            ->sendRequest($request);

        $response->assertJsonPath(
            'message',
            'Payment made successfully'
        );

        $response->assertSuccessful();

        Mail::assertNotSent(SendPasswordToUser::class);
    }

    /**
     * A user cannot buy if the information is not completed.
     *
     * @test
     * @return void
     */
    public function cannot_buy_if_the_information_is_not_completed(): void
    {
        Mail::fake();

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

        $request = ProcessOrderRequest::make();

        $response = $this->signIn()
            ->sendRequest($request);

        $response->assertStatus(422);

        $response->assertJsonPath(
            'errors.first_name.0',
            trans('validation.required', ['attribute' => 'first name'])
        );

        $response->assertJsonPath(
            'errors.last_name.0',
            trans('validation.required', ['attribute' => 'last name'])
        );

        $response->assertJsonPath(
            'errors.email.0',
            trans('validation.required', ['attribute' => 'email'])
        );

        $response->assertJsonPath(
            'errors.phone.0',
            trans('validation.required', ['attribute' => 'phone'])
        );

        $response->assertJsonPath(
            'errors.address.0',
            trans('validation.required', ['attribute' => 'address'])
        );

        $response->assertJsonPath(
            'errors.city.0',
            trans('validation.required', ['attribute' => 'city'])
        );

        $response->assertJsonPath(
            'errors.state.0',
            trans('validation.required', ['attribute' => 'state'])
        );

        $response->assertJsonPath(
            'errors.postal_code.0',
            trans('validation.required', ['attribute' => 'postal code'])
        );

        $response->assertJsonPath(
            'errors.country.0',
            trans('validation.required', ['attribute' => 'country'])
        );

        $response->assertJsonPath(
            'errors.shipping_address.0',
            trans('validation.required', ['attribute' => 'shipping address'])
        );

        $response->assertJsonPath(
            'errors.shipping_email.0',
            trans('validation.required', ['attribute' => 'shipping email'])
        );
    }
}
