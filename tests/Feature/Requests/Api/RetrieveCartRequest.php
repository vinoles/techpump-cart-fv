<?php

namespace Tests\Feature\Requests\Api;

class RetrieveCartRequest extends GetRequest
{
    /**
     * Retrieve the endpoint of the request.
     *
     * @return string
     */
    public function endpoint(): string
    {
        return route('api.cart');
    }
}
