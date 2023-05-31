<?php

namespace Core\Cart\Application\UseCases;

use Core\Cart\Infrastructure\Repositories\Cart as CartRepository;

final class UpdateItem
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
     * @param  int  $idProduct
     * @param  int  $quantity
     * @return void
     */
    public function execute(int $idProduct, int $quantity): void
    {
        $this->cartRepository->updateItem($idProduct, $quantity);
    }
}
