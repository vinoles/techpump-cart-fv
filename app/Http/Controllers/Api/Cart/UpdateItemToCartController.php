<?php

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Cart\UpdateItemToCartRequest;
use Core\Cart\Application\UseCases\ShowCart;
use Core\Cart\Application\UseCases\UpdateItem;
use Core\Cart\Infrastructure\Repositories\Cart as CartRepository;
use Illuminate\Http\Request;

class UpdateItemToCartController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdateItemToCartRequest $request, CartRepository $cartRepository)
    {
        abort_if(! session()->has('token-cart'), 403);

        $attributes = $request->validated();

        $updateItem = new UpdateItem($cartRepository);

        $productId = $attributes['product_id'];

        $quantity = $attributes['quantity'];

        $updateItem->execute($productId, $quantity);

        $cart = new ShowCart($cartRepository);

        return response()->json($cart->execute());
    }
}
