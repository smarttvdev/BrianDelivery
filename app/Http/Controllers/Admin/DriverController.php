<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User\User;
use App\Model\Driver\Driver;
use App\Model\Driver\VehicleInformation;

class DriverController extends Controller
{
    public function getAllDriver(){
        $drivers=Driver::all();
        $result=Array();
        $i=0;
        foreach ($drivers as $driver){
            $user=$driver->user;
            $result[$i]['id']=$user->id;
            $result[$i]['driver_id']=$driver->id;
            $result[$i]['firstname']=$user->firstname;
            $result[$i]['lastname']=$user->lastname;
            $vehicle_information=$driver->vehicleInformation;


            $result[$i]['driver_license']=url("/public/images/Driver/$vehicle_information->driver_license");
            $result[$i]['vehicle_registration']=url("/public/images/Driver/$vehicle_information->vehicle_registration");
            $result[$i]['proof_insurance']=url("/public/images/Driver/$vehicle_information->proof_insurance");
            $result[$i]['vehicle_picture_in']=url("/public/images/Driver/$vehicle_information->vehicle_picture_in");
            $result[$i]['vehicle_picture_out']=url("/public/images/Driver/$vehicle_information->vehicle_picture_out");
            $result[$i]['max_seats']=$vehicle_information->max_seats;
            $result[$i]['max_stuff_weight']=$vehicle_information->max_stuff_weight;
            $result[$i]['max_stuff_width']=$vehicle_information->max_stuff_width;
            $result[$i]['max_stuff_height']=$vehicle_information->max_stuff_height;
            $result[$i]['earned']=$driver->earned;
            $result[$i]['rate']=$driver->rate;

            $i++;
        }
        return $result;


    }
}
