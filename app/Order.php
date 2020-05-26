<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['astrologer_id','service_id','email','name','paid'];
}
