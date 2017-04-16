<?php
# ------------------ static ------------------------
Route::get('/', 'PagesController@home')->name('home');

# ------------------ Authentication ------------------------
Route::get('auth/login', 'AuthController@login')->name('auth.login');
Route::get('/auth/oauth', 'Auth\AuthController@oauth')->name('auth.oauth');


