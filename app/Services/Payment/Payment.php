<?php


namespace App\Services\Payment;


use App\Order;
use Illuminate\Http\Request;

class Payment implements PaymentInterface
{
    public function create(Order $order)
    {
        /*
         * 1. create payment in payment service
         * 2. if something goes wrong throw PaymentException
         */
    }

    public function markOrderPaid(array $data) : Order
    {
        /*
         * 1. parse $data
         * 2. check if payment is paid in payment service
         * 3. get order_id from $data and find order in DB
         * 4. mark order as paid
         */

        return Order::first();
    }
}
