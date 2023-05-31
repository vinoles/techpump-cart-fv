<?php

namespace Tests\Feature\Requests\Api;

use App\Models\Order;

class RetrieveOrderRequest extends GetRequest
{
    /**
     * Create a new instance of the request.
     *
     * @param  \App\Models\Order  $product
     */
    public function __construct(protected Order $order)
    {
    }

    /**
     * Retrieve the endpoint of the request.
     *
     * @return string
     */
    public function endpoint(): string
    {
        return route('api.orders.show', $this->order);
    }
}
