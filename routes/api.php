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
        Route::post('post/update/location','DriverController@updateLocation');
        Route::post('post/bid','DriverController@BidToOrder');
        Route::post('customer/track','DriverController@trackCustomer');



    });

    //******************   Customer Part   *************************//
    Route::Group(['prefix'=>'customer','namespace'=>'Customer'],function (){
        Route::post('post/order','CustomerController@postOrder');
        Route::post('post/update/location','CustomerController@updateLocation');
        Route::post('accept/order','CustomerController@acceptOrder');
        Route::post('get/bids','CustomerController@getBids');
        Route::post('drivers/around','CustomerController@getDriversAround');
        Route::post('driver/track','CustomerController@trackDriver');

    });




});


