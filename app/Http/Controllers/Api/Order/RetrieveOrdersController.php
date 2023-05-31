<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\RetrieveOrdersRequest;
use App\Http\Resources\Order\OrderList;
use Core\Order\Application\UseCases\ListOrders;
use Core\Order\Infrastructure\Repositories\Order as OrderRepository;

class RetrieveOrdersController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RetrieveOrdersRequest $request)
    {
        $user = $request->user();

        $orders = new ListOrders(new OrderRepository());

        return OrderList::collection($orders->execute($user->id));
    }
}
