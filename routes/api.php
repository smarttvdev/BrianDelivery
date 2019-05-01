<?php

use Illuminate\Http\Request;


Route::post('driver/login', 'ApiLoginController@driverLogin');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::Group(['middleware'=>'auth:api'],function (){
    Route::post('upload/vehicle_information','Driver\InformationController@uploadInformation');


});

