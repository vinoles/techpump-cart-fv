<?php

namespace Core\Cart\Application\UseCases;

use Core\Cart\Infrastructure\Repositories\Cart as CartRepository;

final class ClearCart
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
     * @return void
     */
    public function execute(): void
    {
        $this->cartRepository->clearCart();
    }
}
