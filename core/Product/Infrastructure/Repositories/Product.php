<?php

namespace Core\Product\Infrastructure\Repositories;

use App\Models\Product as ProductModel;
use Core\Product\Domain\Interfaces\ProductRepository;

final class Product implements ProductRepository
{
    /**
     * The finder Product.
     *
     * @var ProductModel
     */
    private $model;

    /**
     * Create a new instance.
     *
     */
    public function __construct()
    {
        $this->model = new ProductModel();
    }

    /**
     * All products
     *
     * @return array
     */
    public function all(): array
    {
        return $this->model->paginate(10)->toArray();
    }

    /**
     * Get Product
     *
     * @param  int  $id
     * @return  ProductModel
     */
    public function find(int $id): ProductModel
    {
        return $this->model->find($id);
    }
}
