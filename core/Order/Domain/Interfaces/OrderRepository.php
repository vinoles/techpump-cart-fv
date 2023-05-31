<?php

namespace Core\Order\Domain\Interfaces;

use App\Models\Order;
use Darryldecode\Cart\CartCollection;
use Illuminate\Database\Eloquent\Collection;

interface OrderRepository
{
    /**
     * Get all orders for user
     * @param  int  $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allForUser(int $userId): Collection;

    /**
     * find order
     *
     * @param  int  $id
     * @return \App\Models\Order
     */
    public function find(int $id): Order;

    /**
     * Ceeate order
     *
     * @param  array  $attributes
     * @param  \Darryldecode\Cart\CartCollection  $items
     * @return \App\Models\Order
     */
    public function create(array $attributes, CartCollection $items): Order;
}
