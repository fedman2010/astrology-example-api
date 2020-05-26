<?php

namespace App\Providers;

use App\Services\Payment\Payment;
use App\Services\Payment\PaymentInterface;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PaymentInterface::class, Payment::class);
    }
}
