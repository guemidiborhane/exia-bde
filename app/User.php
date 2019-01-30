<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'email', 'password', 'role', 'center'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function participations()
    {
        return $this->belongsToMany(\App\Event::class);
    }

    public function events()
    {
        return $this->hasMany(\App\Event::class);
    }

    public function photos()
    {
        return $this->hasMany(\App\Photo::class);
    }

    public function getCampusAttribute()
    {
        return ($this->center === 1) ? 'Alger' : 'Oran';
    }

    public function hasRole($role)
    {
        return strtolower($this->role) === strtolower($role);
    }
}
