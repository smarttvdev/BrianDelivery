<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Validator;
use App\Model\Driver\Driver;
use App\Model\Customer\Customer;




class ApiLoginController extends Controller
{
    public function driverLogin(Request $request){
        $about_me=$request->input('about_me');
        if(Auth::guard('user')->attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::guard('user')->user();
            $user->about_me=$about_me;
            $user->save();
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
            return response()->json(['status'=>'fail'], 401);
        }
    }


    public function customerLogin(Request $request){
        $email=$request->input('email');
        $password=$request->input('password');
        $about_me=$request->input('about_me');
        if(Auth::guard('user')->attempt(['email' => $email, 'password' => $password])){
            $user = Auth::guard('user')->user();
            $user->about_me=$about_me;
            $user->save();

            $token =  $user->createToken('MyApp')-> accessToken;

            //Create Driver
            $customer=$user->customer;
            if (!$customer){
                $customer=new Customer;
                $customer->user_id=$user->id;
                $customer->save();
            }

            return response()->json(['token' => "Bearer ".$token,'status'=>'success']);
        }
        else{
            return response()->json(['status'=>'fail'], 401);
        }
    }




}
