<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/read', function (\App\Services\Google\Sheets $sheets) {
//dd(getenv('POST_SPREADSHEET_ID'), "'" . getenv('POST_SPREADSHEET_ID') . "'");
//    $s = Sheets::spreadsheet('1dbJ3RSByffQebmWDa1EcrlUdDAlJoUdySy_f4UdP7Xs');
//    $data = $s->sheet("'tab1'")->get();
//
    $data = $sheets->read();

    ddd($data);
});

Route::get('/write', function (\App\Services\Google\Sheets $sheets) {
    $fake = \Faker\Factory::create();

    $order = new \App\Order(
        [
            'astrologer_id' => 1,
            'service_id' => 1,
            'email' => $fake->email,
            'name' => $fake->name,
        ]
    );
    $order->price = $fake->randomNumber(2);


    $sheets->write($order);
});
