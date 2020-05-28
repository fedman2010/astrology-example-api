<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Astrologer extends Model
{
    use SoftDeletes;

    protected $fillable = ['first_name','last_name','email','bio'];

    public function services()
    {
        return $this->belongsToMany(Service::class)
            ->withPivot('price')
            ->withTimestamps();
    }

    public function fullName()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
