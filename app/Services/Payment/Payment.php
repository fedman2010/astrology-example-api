<?php


namespace App\Services\Payment;


use App\Astrologer;
use App\AstrologerService;
use App\Order;
use Faker\Factory;
use Illuminate\Http\Request;

/**
 * Not real class.
 * Should be implemented for specific Payment service
 *
 * @package App\Services\Payment
 */
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


        return $this->makeTestOrder();
    }

    /**
     * Make a mock order object which is marked as paid,
     * so we can test our Google Sheets API integration
     *
     * @return Order
     */
    private function makeTestOrder()
    {
        $service = AstrologerService::first();
        $fake = Factory::create();
        $order=  new Order(
            [
                'astrologer_id' => $service->astrologer_id,
                'service_id' => $service->service_id,
                'email' => $fake->email,
                'name' => $fake->name,
            ]
        );
        $order->price = $fake->randomNumber(2);
        $order->paid = true;
        $order->save();

        return $order;
    }
}
