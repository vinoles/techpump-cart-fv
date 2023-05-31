<?php

namespace Core\Product\Domain\Interfaces;

use App\Models\Product;

interface ProductRepository
{
    /**
     *  Gel all products
     *
     * @return array
     */
    public function all(): array;

    /**
     * find Product
     *
     * @param  int  $id
     * @return array
     */
    public function find(int $id): Product;
}
