<?php
use Carbon\Carbon;

Route::redirect('/home', '/', 301);
Route::get('/', function () {
    $week_ends_at = Carbon::now()->endOfWeek()->toDateString();
    $coming_events = App\Event::whereRaw('planned_on >= ? AND planned_on <= ?', [today(), $week_ends_at])->get();
    $past_events = App\Event::whereRaw('planned_on < ?', today())->limit(5)->get();
    return view('welcome', compact('coming_events', 'past_events'));
})->name('home');

Route::resource('events', 'EventsController', [
    'except' => ['index', 'show']
]);
Route::get('/events/{event}', 'EventsController@show')->where('event', '[0-9]+')->name('events.show');
Route::get('/events/{type}', 'EventsController@index')->name('events');

Route::get('/uploads/{event}/create', 'UploadsController@create')->name('uploads.create');
Route::post('/uploads/{event}', 'UploadsController@store')->name('uploads.store');
Route::delete('/uploads', 'UploadsController@destroy')->name('uploads.delete');

Route::post('/users/participate/{event}', 'UsersController@participate')->name('participate');
Route::get('/users/events', 'UsersController@events')->name('user_events');

Auth::routes();
