<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class UsersController extends Controller
{

     /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function participate(Request $request, $event_id)
    {
        $user_events = \Auth::user()->participations();
        $action = null;

        if ($user_events->where('events.id', $event_id)->exists()) {
            $user_events->detach($event_id);
            $action = 'detach';
        } else {
            $user_events->attach($event_id);
            $action = 'attach';
        }

        return response()->json([
            'action' => $action,
            'participantsCount' => Event::find($event_id)->participants()->count()
        ]);
    }

    public function events()
    {
        $participations = \Auth::user()->participations()
            ->whereRaw('events.user_id != ?', \Auth::user()->id)->get();
        $events = \Auth::user()->events()->get();

        return view('users.events', compact('participations', 'events'));
    }
}
