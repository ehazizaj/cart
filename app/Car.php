<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{

    protected $fillable = [
        'brand', 'model', 'registration', 'engine', 'price'
    ];
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
