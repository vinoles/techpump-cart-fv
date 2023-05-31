<?php

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Core\Cart\Application\UseCases\DeleteItem;
use Core\Cart\Application\UseCases\ShowCart;
use Core\Cart\Infrastructure\Repositories\Cart as CartRepository;
use Illuminate\Http\Request;

class DeleteItemInCartController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, CartRepository $cartRepository, Product $product)
    {
        abort_if(! session()->has('token-cart'), 403);

        $deleteItem = new DeleteItem($cartRepository);

        $deleteItem->execute($product->id);

        $cart = new ShowCart($cartRepository);

        return response()->json($cart->execute());
    }
}
