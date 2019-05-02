<?php

use Illuminate\Http\Request;


Route::post('driver/login', 'ApiLoginController@driverLogin');
Route::post('customer/login', 'ApiLoginController@customerLogin');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::Group(['middleware'=>'auth:api'],function (){

    //******************   Driver Part   *************************//
    Route::Group(['prefix'=>'driver','namespace'=>'Driver'],function (){
        Route::post('upload/vehicle_information','InformationController@uploadInformation');

    });


    //******************   Driver Part   *************************//
    Route::Group(['prefix'=>'customer','namespace'=>'Customer'],function (){
        Route::post('post/order','CustomerController@postOrder');

    });




});


