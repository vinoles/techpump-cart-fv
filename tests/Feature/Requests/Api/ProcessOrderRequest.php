<?php

namespace Tests\Feature\Requests\Api;

class ProcessOrderRequest extends PostRequest
{
    /**
     * Retrieve the endpoint of the request.
     *
     * @return string
     */
    public function endpoint(): string
    {
        return route('api.orders.create');
    }

    /**
     * Set the  dat for request.
     *
     * @return self
     */
    public function withPayload(): self
    {
        $this->set('email', fake()->email())
            ->set('first_name', fake()->firstName())
            ->set('last_name', fake()->lastName())
            ->set('phone', fake()->phoneNumber())
            ->set('address', fake()->address())
            ->set('city', fake()->city())
            ->set('state', fake()->word())
            ->set('postal_code', fake()->postcode())
            ->set('country', fake()->country())
            ->set('shipping_address', fake()->address())
            ->set('shipping_email', fake()->email())
            ->set('shipping_note', fake()->paragraph(2));

        return $this;
    }
}
