<?php

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use Core\Cart\Application\UseCases\ShowCart;
use Core\Cart\Infrastructure\Repositories\Cart as CartRepository;
use Illuminate\Http\Request;

class RetrieveCartController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        abort_if(! session()->has('token-cart'), 403);

        $cart = new ShowCart(new CartRepository());

        return response()->json($cart->execute());
    }
}
