<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['astrologer_id','service_id','email','name','paid'];

    public function astrologer()
    {
        return $this->belongsTo(Astrologer::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function formattedPrice()
    {
        return "{$this->price}\$";
    }
}
