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

    Route::get('driver/approvals/{state}','DriverController@getApprovals');
    Route::get('driver/profile/all','DriverController@viewAllProfile');
    Route::get('driver/profile/detail/{driver_id}','DriverController@viewDetailedProfile');
    Route::get('driver/map','DriverController@viewMap');



    //********************** Api Part *************************///
    Route::Group(['prefix'=>'api'],function (){
        Route::get('driver/approvals/{$state}','DriverController@getApprovals');
        Route::post('driver/changestate','DriverController@ChangeState');
        Route::post('driver/changeAgreeState','DriverController@ChangeInformationAgreeState');
        Route::post('driver/getLocationInfo','DriverController@getLocationInfo');



    });




});



