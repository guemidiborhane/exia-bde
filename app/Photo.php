<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'filename'
    ];

    public function event()
    {
        return $this->belongsTo(\App\Event::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
