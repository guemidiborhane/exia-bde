<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Event;
use App\Comment;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $week_ends_at = Carbon::now()->endOfWeek()->toDateString();
        $coming_events = Event::whereRaw('planned_on >= ? AND planned_on <= ? AND status IS NULL', [today(), $week_ends_at])->get();
        $past_events = Event::whereRaw('planned_on < ?', Carbon::now()->format('Y-m-d'))->limit(5)->get();
        $comments = Comment::where('commentable_type', Event::class)->whereIn('commentable_id', Event::pluck('id'))->orderBy('created_at')->limit(15)->get();
        
        return view('welcome', compact('coming_events', 'past_events', 'comments'));
    }
}
