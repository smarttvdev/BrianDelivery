<?php

Route::get('/', function () {
    if (Auth::check())
        return redirect('/home');
    return view('login');
});

Route::get('/login','Admin\Auth\LoginController@showLoginForm');
Route::post('/login','Admin\Auth\LoginController@login')->name('login');
Route::post('/logout','Admin\Auth\LoginController@logout')->name('logout');

Route::get('/register', function () {
    return view('register');
});

Route::Group(['middleware'=>'auth:admin','namespace'=>'Admin'],function (){
    Route::get('/home',function (){
        return view('layouts.template');
    });

    Route::get('driver/all',function (){
        return view('driver.all');
    });

    Route::get('api/driver/all','DriverController@getAllDriver');
});



