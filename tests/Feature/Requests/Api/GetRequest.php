<?php

namespace Tests\Feature\Requests\Api;

abstract class GetRequest extends Request
{
    /**
     * Retrieve the method of the request.
     *
     * @return string
     */
    public function method(): string
    {
        return 'get';
    }
}
