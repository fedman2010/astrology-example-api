<?php


namespace App\Services\Google;


use App\Order;
use Revolution\Google\Sheets\Facades\Sheets as GoogleSheets;

class Sheets
{
    protected $sheet;

    public function __construct()
    {
        $this->sheet = GoogleSheets::spreadsheet(getenv('POST_SPREADSHEET_ID'))
                ->sheet("'" . getenv('POST_SPREADSHEET_NAME') . "'");
    }

    public function write(Order $order)
    {
        $this->sheet->append([[
            $order->email,
            $order->name,
            $order->astrologer()->withTrashed()->first()->fullName(),
            $order->service()->withTrashed()->first()->name,
            $order->formattedPrice()
        ]]);
    }

    public function read()
    {
        $data = $this->sheet->get();

        return $data;
    }
}
