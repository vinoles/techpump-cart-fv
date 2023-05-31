<?php

namespace Core\Order\Application\UseCases;

use App\Models\Order;
use Core\Order\Infrastructure\Repositories\Order as OrderRepository;

final class FindOrder
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
     * @param  int  $orderId
     * @return \App\Models\Order
     */
    public function execute(int $orderId): Order
    {
        return $this->orderRepository->find($orderId);
    }
}
