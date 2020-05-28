<?php

namespace App\Jobs;

use App\Order;
use App\Services\Google\Sheets;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GoogleSheets implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Order
     */
    private $order;
    /**
     * @var Sheets
     */
    private $sheets;

    /**
     * Create a new job instance.
     *
     * @param Order $order
     * @param Sheets $sheets
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->sheets = new Sheets();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->sheets->write($this->order);
    }
}
