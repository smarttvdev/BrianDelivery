<?php

namespace App\Http\Controllers;

use App\Postion;
use Illuminate\Http\Request;
use App\Event;
use App\Job;
use App\Employee;
use App\EmployeeJob;

class EventController extends Controller
{
    public function create(){
        $menu_level1='event_create';
        $menu_level2='';

        $temps=Job::orderBy('type','asc')->orderBy('variation','asc')->get();
        $i=0;

        foreach ($temps as $temp){
            $jobs[$i]['name']=$temp->type.' - '.$temp->variation;
            $jobs[$i]['id']=$temp->id;
            $jobs[$i]['pay_amount']=$temp->pay_amount;
            $jobs[$i]['bonus']=$temp->bonus;
            $jobs[$i]['extra']=$temp->extra;
            $jobs[$i]['packing']=$temp->packing;
            $jobs[$i]['service']=$temp->service;
            $i++;
        }


        $position_temps=Postion::all();
        $i=0;
        foreach ($position_temps as $position_temp){
            $positions[$i]['id']=$position_temp->id;
            $positions[$i]['name']=$position_temp->name;
            $i++;
        }

        $employees=Array();
        $employee_temps=Employee::all();
        $i=0;
        foreach ($employee_temps as $employee_temp) {
            $employees[$i]['id'] = $employee_temp->id;
            $employees[$i]['name'] = $employee_temp->first_name . ' ' . $employee_temp->last_name;
            $state='beginner';
            $today=(new \DateTime())->format('Y-m-d');
            if ($today>=$employee_temp->promotion_date)
                $state='promote';

            $employee_job_temps=EmployeeJob::where([['employee_id','=',$employee_temp->id],['employeement_state','=',$state]])->get();
            if ($employee_job_temps->first()){
                $k=0;
                foreach ($employee_job_temps as $employee_job_temp){
                    $employees[$i]['job'][$k]=$employee_job_temp->job_id;
                    $employees[$i]['position'][$k]=$employee_job_temp->position_id;
                    $employees[$i]['pay_amount'][$k]=$employee_job_temp->pay_amount;
                    $employees[$i]['bonus'][$k]=$employee_job_temp->bonus;
                    $employees[$i]['extra'][$k]=$employee_job_temp->extra;
                    $employees[$i]['packing'][$k]=$employee_job_temp->packing;
                    $employees[$i]['service'][$k]=$employee_job_temp->service;
                    $k++;
                }
            }
            $i++;
        }






//        echo "<pre>";
//        print_r($employees);
//        print_r($employee_jobs);
//        print_r($employee_positions);
//        exit();


        return view('event.create',compact('menu_level1','menu_level2','jobs','positions','employees'));
    }
}
