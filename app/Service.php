<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name'];

    public function astrologers()
    {
        return $this->belongsToMany(Astrologer::class)
            ->withPivot('price');
    }
}
