<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    public function astrologers()
    {
        return $this->belongsToMany(Astrologer::class)
            ->withPivot('price');
    }
}
