<?php


namespace App\Services\Payment;


use App\Order;
use Illuminate\Http\Request;

class Payment implements PaymentInterface
{

    public function create(Order $order)
    {
        // TODO: Implement createOrder() method.
    }

    public function markOrderPaid(Request $request)
    {
        // TODO: Implement isSuccess() method.
    }
}
