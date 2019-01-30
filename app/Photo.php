<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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
