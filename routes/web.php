<?php
# ------------------ static ------------------------
Route::get('/', 'PagesController@home')->name('home');

# ------------------ Authentication ------------------------
Route::get('auth/login', 'Auth\AuthController@login')->name('auth.login');
Route::get('/auth/oauth', 'Auth\AuthController@oauth')->name('auth.oauth');
Route::get('/auth/callback', 'Auth\AuthController@callback')->name('auth.callback');
Route::get('/signup', 'Auth\AuthController@create')->name('signup');
Route::post('/signup', 'Auth\AuthController@store');

# ------------------ test ------------------------
Route::get('/test', 'TestController@test')->name('test');

# ------------------ user ------------------------
Route::get('/users/{id}/edit', 'UsersController@edit')->name('users.edit');
