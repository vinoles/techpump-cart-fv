<?php

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use Core\Cart\Application\UseCases\ClearCart;
use Core\Cart\Infrastructure\Repositories\Cart as CartRepository;
use Illuminate\Http\Request;

class ClearCartController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, CartRepository $cartRepository)
    {
        abort_if(! session()->has('token-cart'), 403);

        $clearCart = new ClearCart($cartRepository);

        $clearCart->execute();

        return response()->json([
            'message' => 'The is deleted',
        ]);
    }
}
