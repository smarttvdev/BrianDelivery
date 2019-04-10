<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Employee;
use App\EmployeeEvent;
use App\Event;
use App\Job;
use App\Postion;
use Illuminate\Http\Request;


class ReportController extends Controller
{
    public function View(){
        $menu_level1='report';
        $menu_level2='';
        $result=Array();
        $temps=Employee::all();
        $i=1;
        $result['employee'][0]['id']=0;
        $result['employee'][0]['name']='';
        foreach ($temps as $temp){
            $result['employee'][$i]['id']=$temp->id;
            $result['employee'][$i]['name']=$temp->first_name." ".$temp->last_name;
            $i++;
        }
        return view('report',compact('menu_level1','menu_level2','result'));
    }

    public function getEmployeeReport(Request $request){
        if (!is_null($request->input('start_date')))
            $start_date=(new \DateTime($request->input('start_date')))->format('Y-m-d');
        else
            $start_date=null;

        if (!is_null($request->input('end_date')))
            $end_date=(new \DateTime($request->input('end_date')))->format('Y-m-d');
        else
            $end_date=null;
        $employee_id=$request->input('employee_id');
        $employee=Employee::find($employee_id);
        $employee_name=$employee->first_name." ".$employee->last_name;
        $result=Array();
        $i=0;
        $event_ids=EmployeeEvent::where('employee_id',$employee_id)->pluck('event_id')->toArray();
        if (!is_null($start_date) && !is_null($end_date)){
            $events=Event::whereIn('id',$event_ids)->where([['start_time','>=',$start_date],['start_time','<=',$end_date]])->get();
        }
        if (!is_null($start_date) && is_null($end_date)){
            $events=Event::whereIn('id',$event_ids)->where('start_time','<=',$start_date)->get();
        }

        if (is_null($start_date) && !is_null($end_date)){
            $events=Event::whereIn('id',$event_ids)->where('start_time','<=',$end_date)->get();
        }

        if (is_null($start_date) && is_null($end_date)){
            $events=Event::whereIn('id',$event_ids)->get();
        }
        foreach ($events as $event){
            $result['event'][$i]['id']=$event->id;
            $result['event'][$i]['employee_name']=$employee_name;
            $customer_id=$event->customer_id;
            $customer=Customer::find($customer_id);
            $result['event'][$i]['customer_name']=$customer->name;
            $job=Job::find($event->job_id);
            if (!is_null($job->variation))
                $result['event'][$i]['job_type']=$job->type." ".$job->variation;
            else
                $result['event'][$i]['job_type']=$job->type;
            $employee_events=EmployeeEvent::where([['event_id','=',$event->id],['employee_id','=',$employee_id]])->get();
            $j=0;
            foreach ($employee_events as $employee_event){
                $position=Postion::find($employee_event->position_id);
                $result['event'][$i]['position_name'][$j]=$position->name;
                $result['event'][$i]['position_id'][$j]=$position->id;
                $result['event'][$i]['total_hours'][$j]=$employee_event->total_hours;
                $result['event'][$i]['bonus'][$j]=$employee_event->bonus;
                $result['event'][$i]['extra'][$j]=$employee_event->extra_percent;
                $result['event'][$i]['packing'][$j]=$employee_event->packing_percent;
                $result['event'][$i]['service'][$j]=$employee_event->service_percent;
                $result['event'][$i]['hourly_pay'][$j]=$employee_event->hourly_pay;
                $result['event'][$i]['hourly'][$j]=$employee_event->hourly_percent;
                $result['event'][$i]['flat'][$j]=$employee_event->flat_percent;
                $result['event'][$i]['tips'][$j]=$employee_event->tips_percent;
                $result['event'][$i]['discount'][$j]=$employee_event->discount_percent;
                $j++;
            }
            $i++;
        }
        return json_encode($result);
    }

}
