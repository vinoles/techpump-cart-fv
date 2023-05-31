<?php

namespace Tests\Feature\Requests\Api;

abstract class DeleteRequest extends Request
{
    /**
     * Retrieve the method of the request.
     *
     * @return string
     */
    public function method(): string
    {
        return 'delete';
    }
}
