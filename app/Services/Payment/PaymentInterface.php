<?php


namespace App\Services\Payment;


use App\Order;
use Illuminate\Http\Request;

interface PaymentInterface
{
    public function create(Order $order);

    public function markOrderPaid(Request $request);
}
