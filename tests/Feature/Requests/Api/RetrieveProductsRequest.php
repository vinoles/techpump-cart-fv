<?php

namespace Tests\Feature\Requests\Api;

class RetrieveProductsRequest extends GetRequest
{
    /**
     * Retrieve the endpoint of the request.
     *
     * @return string
     */
    public function endpoint(): string
    {
        return route('api.products');
    }
}
