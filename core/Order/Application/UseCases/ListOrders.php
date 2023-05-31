<?php

namespace Core\Order\Application\UseCases;

use Core\Order\Infrastructure\Repositories\Order as OrderRepository;
use Illuminate\Database\Eloquent\Collection;

final class ListOrders
{
    /**
     * Create a new instance.
     *
     * @param  \Core\Order\Infrastructure\Repositories\Order  $orderRepository
     */
    public function __construct(protected OrderRepository $orderRepository)
    {
    }

    /**
     * Execute the use case.
     *
     * @param  int  $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function execute(int $userId): Collection
    {
        return $this->orderRepository->allForUser($userId);
    }
}
