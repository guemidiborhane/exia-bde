<?php

Route::redirect('/home', '/', 301);
Route::get('/', 'HomeController@index')->name('home');

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
Route::post('/users/toggleLike/{event}', 'UsersController@toggleLike')->name('toggleLike');
Route::get('/users/events', 'UsersController@events')->name('users.events');
Route::get('/users/reports', 'UsersController@reports')->name('users.reports');
Route::get('/users', 'UsersController@index')->name('users.index');
Route::put('/users/{user}', 'UsersController@update')->name('users.update');

Auth::routes();


Route::resource('products', 'ProductsController', [
    'except' => ['index', 'show']
]);
Route::get('/products/{product}', 'ProductsController@show')->where('product', '[0-9]+')->name('products.show');
Route::get('/products/{category?}', 'ProductsController@index')->name('products.index');

Route::get('/cart', 'CartController@index')->name('cart');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::patch('/cart', 'CartController@update')->name('cart.update');
Route::delete('/cart', 'CartController@destroy')->name('cart.destroy');
Route::get('/cart/purchase', 'CartController@purchase')->name('cart.submit');
