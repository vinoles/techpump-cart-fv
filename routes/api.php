<?php

use App\Http\Controllers\Api\Cart\AddItemToCartController;
use App\Http\Controllers\Api\Cart\ClearCartController;
use App\Http\Controllers\Api\Cart\DeleteItemInCartController;
use App\Http\Controllers\Api\Cart\RetrieveCartController;
use App\Http\Controllers\Api\Cart\UpdateItemToCartController;
use App\Http\Controllers\Api\Order\ProcessOrderController;
use App\Http\Controllers\Api\Order\RetrieveOrderController;
use App\Http\Controllers\Api\Order\RetrieveOrdersController;
use App\Http\Controllers\Api\Product\RetrieveProductsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(static function () {
    Route::get('orders', RetrieveOrdersController::class)->name('orders');
    Route::get('orders/{order}', RetrieveOrderController::class)->name('orders.show');
});

Route::get('products', RetrieveProductsController::class)->name('products');

Route::get('cart', RetrieveCartController::class)->name('cart');
Route::post('cart/add/item', AddItemToCartController::class)->name('cart.add.item');
Route::patch('cart/update/item', UpdateItemToCartController::class)->name('cart.update.item');
Route::delete('cart/delete/item/{product}', DeleteItemInCartController::class)->name('cart.delete.item');
Route::delete('cart/clear', ClearCartController::class)->name('cart.clear');

Route::post('orders', ProcessOrderController::class)->name('orders.create');
