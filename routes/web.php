<?php
use Carbon\Carbon;

Route::redirect('/home', '/', 301);
Route::get('/', function () {
    $week_ends_at = Carbon::now()->endOfWeek()->toDateString();
    $coming_events = App\Event::whereRaw('planned_on >= ? AND planned_on <= ? AND status IS NULL', [today(), $week_ends_at])->get();
    $past_events = App\Event::whereRaw('planned_on < ?', today())->limit(5)->get();
    return view('welcome', compact('coming_events', 'past_events'));
})->name('home');

Route::get('mib', function () {
    return response()->view('mib')->header("Refresh", "1;url=".route('users.reports'));
});

Route::resource('events', 'EventsController', [
    'except' => ['index', 'show']
]);
Route::get('/events/{event}', 'EventsController@show')->where('event', '[0-9]+')->name('events.show');
Route::get('/events/{type}', 'EventsController@index')->name('events');
Route::get('/events/{event}/participants', 'EventsController@participants')->name('events.participants');
Route::put('/events/{event}/restore', 'EventsController@restore')->name('events.restore');

Route::get('/uploads/{event}/create', 'UploadsController@create')->name('uploads.create');
Route::post('/uploads/{event}', 'UploadsController@store')->name('uploads.store');
Route::delete('/uploads', 'UploadsController@destroy')->name('uploads.delete');

Route::post('/comments/{id}', 'CommentsController@store')->name('comments.store');
Route::delete('/comments/{comment?}', 'CommentsController@destroy')->name('comments.destroy');
Route::put('/comments/{comment}/restore', 'CommentsController@restore')->name('comments.restore');

Route::post('/users/participate/{event}', 'UsersController@participate')->name('participate');
Route::get('/users/events', 'UsersController@events')->name('users.events');
Route::get('/users/reports', 'UsersController@reports')->name('users.reports');

Auth::routes();
