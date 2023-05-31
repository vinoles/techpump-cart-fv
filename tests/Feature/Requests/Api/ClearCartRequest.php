<?php

namespace Tests\Feature\Requests\Api;

class ClearCartRequest extends DeleteRequest
{
    /**
     * Retrieve the endpoint of the request.
     *
     * @return string
     */
    public function endpoint(): string
    {
        return route('api.cart.clear');
    }
}
