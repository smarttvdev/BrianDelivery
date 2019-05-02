<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User\User;
use App\Model\Driver\Driver;
use App\Model\Driver\VehicleInformation;

class DriverController extends Controller
{

    // *****************************   Approval Part  *******************************//
    public function getApprovals($state)
    {
        $menu_level1 = 'approvals';
        $menu_level2 = $state;
        $drivers = $this->getAllDriver($state);
        return view('driver.approvals', compact('drivers', 'menu_level1', 'menu_level2'));
    }

    public function ChangeState(Request $request)
    {
        $id = $request->input('id');
        $state = $request->input('state');
        $driver = Driver::find($id);
        if ($state == 'Pending')
            $driver->state = 'active';
        else
            $driver->state = 'pending';
        $driver->save();
    }

    public function ChangeInformationAgreeState(Request $request)
    {
        $state = $request->input('state');
        $driver_id = $request->input('driver_id');
        $picture_information = $request->input('picture_information');
        $information = Driver::find($driver_id)->vehicleInformation;
        if ($state == 0)
            $state = 1;
        else
            $state = 0;
        $information[$picture_information . "_agreed_state"] = $state;
        $information->save();
        $agreed_state = $this->checkAgreedState($driver_id);
        $driver = $information->driver;
        if ($agreed_state == 1)
            $driver->state = 'active';
        else
            $driver->state = 'pending';
        $driver->save();


        return $agreed_state;
    }

    public function checkAgreedState($driver_id)
    {
        $agreed_state = 1;
        $information = Driver::find($driver_id)->vehicleInformation;
        if ($information) {
            if ($information->driver_license_agreed_state == 0) {
                $agreed_state = 0;
                return $agreed_state;
            }
            if ($information->vehicle_registration_agreed_state == 0) {
                $agreed_state = 0;
                return $agreed_state;
            }
            if ($information->proof_insurance_agreed_state == 0) {
                $agreed_state = 0;
                return $agreed_state;
            }
            if ($information->vehicle_picture_in_agreed_state == 0) {
                $agreed_state = 0;
                return $agreed_state;
            }
            if ($information->vehicle_picture_out_agreed_state == 0) {
                $agreed_state = 0;
                return $agreed_state;
            }
            if ($information->max_seats <= 0) {
                $agreed_state = 0;
                return $agreed_state;
            }
            if ($information->max_stuff_weight <= 0) {
                $agreed_state = 0;
                return $agreed_state;
            }
            if ($information->max_stuff_width <= 0) {
                $agreed_state = 0;
                return $agreed_state;
            }
            if ($information->max_stuff_height == 0) {
                $agreed_state = 0;
                return $agreed_state;
            }
        } else {
            $agreed_state = 0;
            return $agreed_state;
        }
        return $agreed_state;
    }

    public function getAllDriver($state)
    {
        $drivers = Driver::where('state', $state)->get();
        $data = Array();
        $i = 0;
        foreach ($drivers as $driver) {
            $user = $driver->user;
            $data[$i]['user_id'] = $user->id;
            $data[$i]['driver_id'] = $driver->id;
            $data[$i]['firstname'] = $user->firstname;
            $data[$i]['lastname'] = $user->lastname;
            $vehicle_information = $driver->vehicleInformation;


            $data[$i]['driver_license'] = url("/public/images/Driver/$vehicle_information->driver_license");
            $data[$i]['vehicle_registration'] = url("/public/images/Driver/$vehicle_information->vehicle_registration");
            $data[$i]['proof_insurance'] = url("/public/images/Driver/$vehicle_information->proof_insurance");
            $data[$i]['vehicle_picture_in'] = url("/public/images/Driver/$vehicle_information->vehicle_picture_in");
            $data[$i]['vehicle_picture_out'] = url("/public/images/Driver/$vehicle_information->vehicle_picture_out");
            $data[$i]['max_seats'] = $vehicle_information->max_seats;
            $data[$i]['max_stuff_weight'] = $vehicle_information->max_stuff_weight;
            $data[$i]['max_stuff_width'] = $vehicle_information->max_stuff_width;
            $data[$i]['max_stuff_height'] = $vehicle_information->max_stuff_height;

            $data[$i]['driver_license_agreed_state'] = $vehicle_information->driver_license_agreed_state;
            $data[$i]['vehicle_registration_agreed_state'] = $vehicle_information->vehicle_registration_agreed_state;
            $data[$i]['proof_insurance_agreed_state'] = $vehicle_information->proof_insurance_agreed_state;
            $data[$i]['vehicle_picture_in_agreed_state'] = $vehicle_information->vehicle_picture_in_agreed_state;
            $data[$i]['vehicle_picture_out_agreed_state'] = $vehicle_information->vehicle_picture_out_agreed_state;

            $data[$i]['earned'] = $driver->earned;
            $data[$i]['rate'] = $driver->rate;
            $data[$i]['state'] = $driver->state;

            $i++;
        }
        return $data;
    }
    //*****************************   End  Approval part ***********************************//


    // ****************************  Profile Part  *****************************************//
    public function viewAllProfile()
    {
        $drivers = $this->getAllProfile();
        $menu_level1 = 'profile';

        return view('driver.profile', compact('drivers', 'menu_level1'));
    }

    public function getAllProfile()
    {
        $drivers = Driver::where('state', 'active')->get();
        $data = Array();
        $i = 0;
        foreach ($drivers as $driver) {
            $user = $driver->user;
            $data[$i]['user_id'] = $user->id;
            $data[$i]['firstname'] = $user->firstname;
            $data[$i]['lastname'] = $user->lastname;
            $data[$i]['driver_id'] = $driver->id;
            $data[$i]['email'] = $user->email;
            if (!is_null($user->avatar))
                $data[$i]['profile_pic'] = url("/public/images/Profile/$user->avatar");
            else
                $data[$i]['profile_pic'] = null;
            $data[$i]['phone_number'] = $user->phonenum;
            $data[$i]['country'] = $user->country;
            $data[$i]['birthday'] = $user->birthday;
            $data[$i]['gender'] = $user->gender;
            $data[$i]['rate'] = $driver->rate;
            $data[$i]['earned'] = $driver->earned;
            $i++;
        }
        return $data;

    }

    public function viewDetailedProfile($driver_id)
    {
        $menu_level1 = 'profile';
        $profile_data = $this->getDetailProfile($driver_id);
        return view('driver.profile_detail', compact('menu_level1','profile_data'));

    }

    public function getDetailProfile($driver_id)
    {
        $data=Array();
        $driver=Driver::find($driver_id);
        $user=$driver->user;
        $data['profile_pic']= url("/public/images/Profile/$user->avatar");
        $data['user_name']=ucfirst($user->firstname)." ".ucfirst($user->lastname);
        $data['about_me']=ucfirst($user->about_me);
        $data['earned']=$driver->earned;
        $data['rate']=$driver->rate;
        $data['task_numbers']=5;

        return $data;

    }


}
