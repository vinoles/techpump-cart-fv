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
        $items = $this->cartRepository->items();

        return [
            'items' => $items->toArray(),
            'subtotal' => $this->cartRepository->getSubTotal(),
            'total' => $this->cartRepository->getTotal(),
            'quantity' => $items->sum('quantity'),
            'total_items' => $items->count(),
        ];
    }
}
