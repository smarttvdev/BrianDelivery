<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Validator;
use App\Model\Driver\Driver;
use App\Model\Customer\Customer;




class ApiLoginController extends Controller
{
    public function driverLogin(){
        if(Auth::guard('user')->attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::guard('user')->user();
            $token =  $user->createToken('MyApp')-> accessToken;

            //Create Driver
            $driver=$user->driver;
            if (!$driver){
                $driver=new Driver;
                $driver->user_id=$user->id;
                $driver->save();
            }

            return response()->json(['token' => "Bearer ".$token,'status'=>'success']);
        }
        else{
            return response()->json(['status'=>'faile'], 401);
        }
    }

}
