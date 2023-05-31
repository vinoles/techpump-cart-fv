<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use Core\Product\Application\UseCases\ListProducts;
use Core\Product\Infrastructure\Repositories\Product as ProductRepository;

class RetrieveProductsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $products = new ListProducts(new ProductRepository());

        return response()->json($products->execute());
    }
}
