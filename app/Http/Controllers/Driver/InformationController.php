<?php

namespace App\Http\Controllers\Driver;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Model\Driver\VehicleInformation;

class InformationController extends Controller
{
    public function uploadInformation(Request $request){
        $user=Auth::user();
        $user_id= $user->id;
        $temps=VehicleInformation::where('driver_id',$user_id)->get();
        if ($temps->first())
            $vehicle_information=$temps->first();
        else
            $vehicle_information=new VehicleInformation;
        $vehicle_information->driver_id=$user_id;

        if ($request->hasFile('driver_license')){
            $file=$request->file('driver_license');
            $file_name=md5(uniqid()).".".$file->extension();
            $file->move(public_path().'/images/Driver',$file_name);
            $vehicle_information->driver_license=$file_name;
        }

        if ($request->hasFile('vehicle_registration')){
            $file=$request->file('vehicle_registration');
            $file_name=md5(uniqid()).".".$file->extension();
            $file->move(public_path().'/images/Driver',$file_name);
            $vehicle_information->vehicle_registration=$file_name;
        }

        if ($request->hasFile('proof_insurance')){
            $file=$request->file('proof_insurance');
            $file_name=md5(uniqid()).".".$file->extension();
            $file->move(public_path().'/images/Driver',$file_name);
            $vehicle_information->proof_insurance=$file_name;
        }

        if ($request->hasFile('vehicle_picture_in')){
            $file=$request->file('vehicle_picture_in');
            $file_name=md5(uniqid()).".".$file->extension();
            $file->move(public_path().'/images/Driver',$file_name);
            $vehicle_information->vehicle_picture_in=$file_name;
        }

        if ($request->hasFile('vehicle_picture_out')){
            $file=$request->file('vehicle_picture_out');
            $file_name=md5(uniqid()).".".$file->extension();
            $file->move(public_path().'/images/Driver',$file_name);
            $vehicle_information->vehicle_picture_out=$file_name;
        }
        $vehicle_information->max_seats=$request->input('max_seats');
        $vehicle_information->max_stuff_weight=$request->input('max_stuff_weight');
        $vehicle_information->max_stuff_width=$request->input('max_stuff_width');
        $vehicle_information->max_stuff_height=$request->input('max_stuff_height');
        $vehicle_information->save();
        return "success";

    }
}
