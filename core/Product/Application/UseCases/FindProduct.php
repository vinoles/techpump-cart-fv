<?php

namespace Core\Product\Application\UseCases;

use App\Models\Product;
use Core\Product\Infrastructure\Repositories\Product as ProductRepository;

final class FindProduct
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
     * @param  int  $productId
     * @return \App\Models\Product
     */
    public function execute(int $productId): Product
    {
        return $this->productRepository->find($productId);
    }
}
