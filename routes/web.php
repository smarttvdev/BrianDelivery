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

//Route::get('/home', 'HomeController@index')->name('home');

Route::Group(['middleware'=>'auth'],function(){

    Route::get('/job','JobController@showJob');
    Route::get('/getJobs','JobController@getJobs');
    Route::post('/insertJob','JobController@insertJob');
    Route::post('/updateJob','JobController@updateJob');
    Route::post('/deleteJob','JobController@deleteJob');


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

    Route::get('/getEmployeeJob/{employee_id}/{employee_statement}','EmployeeController@getEmployeeJob');
    Route::post('/insertEmployeeJob','EmployeeController@insertEmployeeJob');
    Route::post('/editEmployeeJob','EmployeeController@editEmployeeJob');
    Route::post('/deleteEmployeeJob','EmployeeController@deleteEmployeeJob');


    Route::get('/event/create','EventController@create');


    Route::get('/home', function (){
        $menu_level1='';
        $menu_level2='';
        return view('layouts.template',compact('menu_level2','menu_level1'));
    });

});

