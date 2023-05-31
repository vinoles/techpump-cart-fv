<?php

namespace Tests\Feature\Requests\Api;

use App\Models\Product;

class DeleteItemInCartRequest extends DeleteRequest
{
    /**
     * Create a new instance of the request.
     *
     * @param  \App\Models\Product  $product
     */
    public function __construct(protected Product $product)
    {
        //
    }

    /**
     * Retrieve the endpoint of the request.
     *
     * @return string
     */
    public function endpoint(): string
    {
        return route('api.cart.delete.item', $this->product);
    }
}
