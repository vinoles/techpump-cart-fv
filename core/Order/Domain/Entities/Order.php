<?php

namespace Core\Order\Domain;

use App\Models\Order as OrderModel;

final class Order
{
    /**
     * Create a new instance.
     *
     * @param \App\Models\Order  $order
     */
    public function __construct(protected OrderModel $order)
    {
    }

    /**
     * Careta the instance from array.
     *

     * @return \App\Models\Order
     */
    public function getOrder(): OrderModel
    {
        return $this->order;
    }
}
