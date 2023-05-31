<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\RetrieveOrderRequest;
use App\Http\Resources\Order\Order as ResourceOrder;
use App\Models\Order as Order;
use Core\Order\Application\UseCases\FindOrder;
use Core\Order\Infrastructure\Repositories\Order as OrderRepository;

class RetrieveOrderController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RetrieveOrderRequest $request, Order $order)
    {
        $findOrder = new FindOrder(new OrderRepository());

        return ResourceOrder::make($findOrder->execute($order->id));
    }
}
