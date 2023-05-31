<?php

namespace Core\Product\Domain;

use App\Models\Product as ProductModel;

final class Product
{
    /**
     * Create a new instance.
     *
     * @param \App\Models\Product  $product
     */
    public function __construct(protected ProductModel $product)
    {
    }

    /**
     * Careta the instance from array.
     *

     * @return \App\Models\Product
     */
    public function getProduct(): ProductModel
    {
        return $this->product;
    }
}
