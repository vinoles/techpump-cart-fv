<?php

namespace Core\Cart\Application\UseCases;

use Core\Cart\Infrastructure\Repositories\Cart as CartRepository;

final class ShowCart
{
    /**
     * Create a new instance.
     * @param  \Core\Cart\Infrastructure\Repositories\Cart  $cartRepository
     */
    public function __construct(protected CartRepository $cartRepository)
    {
    }

    /**
     * Execute the use case.
     *
     * @return array
     */
    public function execute(): array
    {
        return [
            'items' => $this->cartRepository->items()->toArray(),
            'subtotal' => $this->cartRepository->getSubTotal(),
            'total' => $this->cartRepository->getTotal(),
            'total_quantity' => $this->cartRepository->getTotalQuantity(),
            'total_items' => $this->cartRepository->getTotalItems(),
        ];
    }
}
