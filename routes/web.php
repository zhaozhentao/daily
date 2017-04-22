<?php
# ------------------ static ------------------------
Route::get('/', 'PagesController@home')->name('home');
Route::get('/aboutme', 'PagesController@about')->name('aboutme');

# ------------------ Authentication ------------------------
Route::get('auth/login', 'Auth\AuthController@login')->name('auth.login');
Route::get('/auth/oauth', 'Auth\AuthController@oauth')->name('auth.oauth');
Route::get('/auth/callback', 'Auth\AuthController@callback')->name('auth.callback');
Route::get('/signup', 'Auth\AuthController@create')->name('signup');
Route::post('/signup', 'Auth\AuthController@store');
Route::get('/logout', 'Auth\AuthController@logout')->name('logout');

# ------------------ test ------------------------
Route::get('/test', 'TestController@test')->name('test');

# ------------------ user ------------------------
Route::get('/users/{id}/edit', 'UsersController@edit')->name('users.edit');
Route::get('/users/{id}', 'UsersController@show')->name('users.show');

# ------------------ topic ------------------------
Route::get('/topics/create', 'TopicsController@create')->name('topics.create');
Route::post('/upload_image', 'TopicsController@uploadImage')->name('upload_image');
Route::post('/topics', 'TopicsController@store')->name('topics.store');
Route::get('/topics/{id}', 'TopicsController@show')->name('topics.show');
Route::get('/topics/{id}/edit', 'TopicsController@edit')->name('topics.edit');
Route::patch('/topics/{id}', 'TopicsController@update')->name('topics.update');

Route::post('topics/{id}/recommend', 'TopicsController@recommend')->name('topics.recommend');
Route::post('topics/pin/{id}', 'TopicsController@pin')->name('topics.pin');
Route::post('topics/sink/{id}', 'TopicsController@sink')->name('topics.sink');
Route::delete('topics/{id}', 'TopicsController@destroy')->name('topics.destroy');
