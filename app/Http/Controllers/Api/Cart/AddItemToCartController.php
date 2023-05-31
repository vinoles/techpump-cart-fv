<?php

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use Core\Cart\Application\UseCases\AddItem;
use Core\Cart\Application\UseCases\ShowCart;
use Core\Cart\Infrastructure\Repositories\Cart as CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AddItemToCartController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, CartRepository $cartRepository)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|required|min:1',
        ]);

        if (! session()->has('token-cart')) {
            $cookieForCart = Str::uuid();

            session(['token-cart' => $cookieForCart]);
        }

        $addItem = new AddItem($cartRepository);

        $productId = $request->input('product_id');

        $quantity = $request->input('quantity');

        $addItem->execute($productId, $quantity);

        $cart = new ShowCart($cartRepository);

        return response()->json($cart->execute());
    }
}
