<?php

namespace Core\Cart\Application\UseCases;

use Core\Cart\Infrastructure\Repositories\Cart as CartRepository;

final class DeleteItem
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
     * @return void
     */
    public function execute(int $idProduct): void
    {
        $this->cartRepository->deleteItem($idProduct);
    }
}
