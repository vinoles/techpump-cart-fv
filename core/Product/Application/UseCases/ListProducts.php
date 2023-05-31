<?php

namespace Core\Product\Application\UseCases;

use Core\Product\Infrastructure\Repositories\Product as ProductRepository;

final class ListProducts
{
    /**
     * Create a new instance.
     *
     * @param  \Core\Product\Infrastructure\Repositories\Product  $productRepository
     */
    public function __construct(protected ProductRepository $productRepository)
    {
    }

    /**
     * Execute the use case.
     *
     * @return array
     */
    public function execute(): array
    {
        return $this->productRepository->all();
    }
}
