<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Conner\Likeable\Likeable;

class Event extends Model
{
    use Likeable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'planned_on', 'status', 'image'
    ];


    protected $dates = ['planned_on', 'deleted_at'];

    public function participants()
    {
        return $this->belongsToMany(\App\User::class);
    }

    public function photos()
    {
        return $this->hasMany(\App\Photo::class, 'event_id', 'id');
    }

    public function getParticipatesAttribute()
    {
        return \Auth::user()->participations()->where('events.id', $this->id)->exists() ? 'true' : 'false';
    }

    public function getPassedAttribute()
    {
        return $this->planned_on >= today();
    }

    public function author()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
