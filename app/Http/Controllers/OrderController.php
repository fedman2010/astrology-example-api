<?php

namespace App\Http\Controllers;

use App\AstrologerService;
use App\Http\Resources\Astrologer;
use App\Order;
use App\Services\Payment\Payment;
use App\Services\Payment\PaymentException;
use App\Services\Payment\PaymentInterface;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    private $payments;

    public function __construct(PaymentInterface $payments)
    {
        $this->payments = $payments;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Order::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|Responsable
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'astrologer_id' => 'required|exists:astrologers,id',
                'service_id' => [
                    'required',
                    'exists:services,id',
                    Rule::exists('astrologer_service')->where(
                        function ($query) use ($request) {
                            $query->where('astrologer_id', $request->get('astrologer_id'))
                                ->where('service_id', $request->get('service_id'));
                        }
                    ),
                ],
                'email' => 'required|email|max:255',
                'name' => 'required|max:255',
            ]
        );

        $order = new Order($validatedData);
        $service = AstrologerService::where('astrologer_id', $request->get('astrologer_id'))
            ->where('service_id', $request->get('service_id'))
            ->first();

        if (!is_a($service, AstrologerService::class)) {
            throw new \DomainException('Price is not set');
        }

        $order->price = $service->price;

        $order->save();

        try {
            $this->payments->create($order);
        } catch (PaymentException $e) {
            throw new \HttpException('Payment service is unavailable', 500);
        }

        return $order;
    }

    public function webhook(Request $request)
    {
        $data = $request->all();

        $order = $this->payments->markOrderPaid($data);

        if ($order->paid) {

        }

        return response('Request handled', 200);
    }
}
