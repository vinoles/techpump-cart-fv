<?php

namespace Core\Order\Application\UseCases;

use Core\Cart\Infrastructure\Repositories\Cart as CartRepository;
use Core\Order\Infrastructure\Repositories\Order as OrderRepository;

final class CreateOrder
{
    /**
     * Create a new instance.
     *
     * @param  \Core\Order\Infrastructure\Repositories\Order  $orderRepository
     * @param  \Core\Cart\Infrastructure\Repositories\Cart  $cartRepository
     */
    public function __construct(protected OrderRepository $orderRepository, protected CartRepository $cartRepository)
    {
    }

    /**
     * Execute the use case.
     *
     * @param  array  $attributes
     * @return void
     */
    public function execute(array $attributes): void
    {
        $attributes = array_merge(
            $attributes,
            [
                'subtotal' => $this->cartRepository->getSubTotal(),
                'total' => $this->cartRepository->getTotal(),
            ]
        );

        $this->orderRepository->create(
            $attributes,
            $this->cartRepository->items()
        );
    }
}
