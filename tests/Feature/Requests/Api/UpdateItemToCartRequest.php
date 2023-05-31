<?php

namespace Tests\Feature\Requests\Api;

class UpdateItemToCartRequest extends PatchRequest
{
    /**
     * Retrieve the endpoint of the request.
     *
     * @return string
     */
    public function endpoint(): string
    {
        return route('api.cart.update.item');
    }

    /**
     * Set the  dat for request.
     *
     * @param  int  $productId
     * @param  int  $quantity
     * @return self
     */
    public function withPayload(int $productId, int $quantity): self
    {
        $this->set('product_id', $productId)
            ->set('quantity', $quantity);

        return $this;
    }
}
