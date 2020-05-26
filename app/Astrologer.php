<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Astrologer extends Model
{
    protected $fillable = ['first_name','last_name','email','bio'];

    public function services()
    {
        return $this->belongsToMany(Service::class)
            ->withPivot('price')
            ->withTimestamps();
    }
}
