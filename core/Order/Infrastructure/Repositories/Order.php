<?php

namespace Core\Order\Infrastructure\Repositories;

use App\Models\Order as OrderModel;
use Core\Order\Domain\Interfaces\OrderRepository;
use Darryldecode\Cart\CartCollection;
use Illuminate\Database\Eloquent\Collection;

final class Order implements OrderRepository
{
    /**
     * The finder Order.
     *
     * @var OrderModel
     */
    private $model;

    /**
     * Create a new instance.
     *
     */
    public function __construct()
    {
        $this->model = new OrderModel();
    }

    /**
     * Get all orders for user
     *
     * @param  int  $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allForUser(int $userId): Collection
    {
        return $this->model->where('user_id', $userId)->get();
    }

    /**
     * Get order
     *
     * @param  int  $id
     * @return  \App\Models\Order
     */
    public function find(int $id): OrderModel
    {
        return $this->model->find($id);
    }

    /**
     * Create order
     *
     * @param  array  $attributes
     * @param  \Darryldecode\Cart\CartCollection  $items
     * @return  \App\Models\Order
     */
    public function create(array $attributes, CartCollection $items): OrderModel
    {
        $order = $this->model->create($attributes);

        $items->each(static function ($item) use ($order) {
            $order->items()->create([
                'price' => $item->price,
                'quantity' => $item->quantity,
                'product_id' => $item->id,
            ]);
        });

        return $order;
    }
}
