<?php

Route::get('auth/login', 'AuthController@login')->name('auth.login');

Route::get('/', 'PagesController@home')->name('home');

