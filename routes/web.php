<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::Group(['middleware'=>'auth'],function(){

    Route::get('/event','EventController@showEvent');
    Route::get('/getEvents','EventController@getEvents');
    Route::post('/insertEvent','EventController@insertEvent');
    Route::post('/updateEvent','EventController@updateEvent');
    Route::post('/deleteEvent','EventController@deleteEvent');


    Route::get('/position','PositionController@showPosition');
    Route::get('/getPositions','PositionController@getPositions');
    Route::post('/insertPosition','PositionController@insertPosition');
    Route::post('/updatePosition','PositionController@updatePosition');
    Route::post('/deletePosition','PositionController@deletePosition');


    Route::get('employee/create','EmployeeController@showCreate');
    Route::post('employee/save','EmployeeController@Save');

    Route::get('employee/list','EmployeeController@showEmployeeList');
    Route::post('/getEmployeeList','EmployeeController@getEmployeeList');

    Route::post('/deleteEmployee','EmployeeController@deleteEmployee');
    Route::get('/employee/edit/{employee_id}','EmployeeController@showEdit');

    Route::post('/employee/search','EmployeeController@searchEmployee');



    Route::get('/getEmployeeEvent/{employee_id}/{employee_statement}','EmployeeController@getEmployeeEvent');
    Route::post('/insertEmployeeEvent','EmployeeController@insertEmployeeEvent');
    Route::post('/editEmployeeEvent','EmployeeController@editEmployeeEvent');
    Route::post('/deleteEmployeeEvent','EmployeeController@deleteEmployeeEvent');


    Route::get('/job/create','JobController@create');


    Route::get('/template', function (){
        return view('layouts.template');
    });

});

