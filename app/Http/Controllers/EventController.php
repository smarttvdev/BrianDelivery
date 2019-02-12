<?php

namespace App\Http\Controllers;

use App\Postion;
use Illuminate\Http\Request;
use App\Event;
use App\Job;
use App\Employee;
use App\EmployeeJob;
use App\EmployeeEvent;
use Monolog\Handler\IFTTTHandler;

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
        return view('event.create',compact('menu_level1','menu_level2','jobs','positions','employees'));
    }

    public function getEmployees(Request $request){
        $job_id=$request->input('job_id');
        $position_id=$request->input('position_id');
        $result=Array();
        $now=(new \DateTime())->format('Y-m-d H:i:s');

        $temps=Employee::all();
        $i=0;
        foreach ($temps as $temp){
            $employeement_state='beginner';
            if (!is_null($temp->promotion_date)){
                if ($temp->promotion_date>=$now)
                    $employeement_state="promote";

            }

            if ($job_id==0 && $position_id==0)  // Will select all job, all position
                $employee_jobs=EmployeeJob::where([['employee_id','=',$temp->id],['employeement_state','=',$employeement_state]])->get();
            if ($job_id==0 && $position_id!=0)  // Will select all job, all position
                $employee_jobs=EmployeeJob::where([['employee_id','=',$temp->id],['position_id','=',$position_id],['employeement_state','=',$employeement_state]])->get();
            if ($job_id!=0 && $position_id==0)  // Will select all job, all position
                $employee_jobs=EmployeeJob::where([['employee_id','=',$temp->id],['job_id','=',$job_id],['employeement_state','=',$employeement_state]])->get();
            if ($job_id!=0 && $position_id!=0)  // Will select all job, all position
                $employee_jobs=EmployeeJob::where([['employee_id','=',$temp->id],['job_id','=',$job_id],['position_id','=',$position_id],['employeement_state','=',$employeement_state]])->get();

            foreach ($employee_jobs as $employee_job){
                $job_temp=Job::find($employee_job->job_id);
                $position=Postion::find($employee_job->position_id);
                if ($job_temp){
                    $result[$i]['employee_id']=$temp->id;
                    $result[$i]['name']=$temp->first_name.$temp->last_name;
                    $result[$i]['job']=$job_temp->type.' '.$job_temp->variation;
                    $result[$i]['job_id']=$job_temp->id;
                    $result[$i]['position']=$position->name;
                    $result[$i]['position_id']=$position->id;
                    $result[$i]['hourly_pay']=$job_temp->hourly_pay;
                    $result[$i]['hourly_percent']=$job_temp->hourly_percent;
                    $result[$i]['flat_percent']=$job_temp->flat_percent;
                    $result[$i]['extra_percent']=$job_temp->extra_percent;
                    $result[$i]['packing_percent']=$job_temp->packing_percent;
                    $result[$i]['service_percent']=$job_temp->service_percent;
                    $result[$i]['bonus']=$temp->bonus;

                    $i++;
                }
            }
        }
        return response()->json(['data'=>$result]);
    }

    public function registerEvent(Request $request){

        $event_id=$request->input('event_id');
        $event=Event::find($event_id);
        if (!$event)
            $event=new Event;
        $event->pick_address=$request->input('pick_address');
        $event->stop_address=$request->input('stop_address');
        $event->drop_address=$request->input('drop_address');
        $event->truck_license=$request->input('truck_license');
        $event->comment=$request->input('event_comment');
        $event->attach_file=$request->input('attach_file');
        $event->non_profit=$request->input('non_profit');
        $event->packing=$request->input('packing');
        $event->service=$request->input('service');
        $event->extra=$request->input('extra');
        $event->state="close";
        $event->flat=$request->input('flat');

        if ($request->hasFile('attach_docs')){
            $file=$request->file('attach_docs');
            $file->move(public_path().'/docs',$file->getClientOriginalName());
            $event->attach_file=$file->getClientOriginalName();
        }
        $event->save();
        return $event->id;
    }


    public function addEmployeeToEvent(Request $request){
        $event_id=$request->input('event_id');
        $employee_events=EmployeeEvent::where([['event_id','=',$event_id],['employee_id','=',$request->input('employee_id')],
                                                ['job_id','=',$request->input('job_id')],['position_id','=',$request->input('position_id')]])->get();
        if ($employee_events->first())
            $employee_event=$employee_events->first();
        else
            $employee_event=new EmployeeEvent;
        $employee_event->event_id=$event_id;
        $employee_event->employee_id=$request->input('employee_id');
        $employee_event->job_id=$request->input('job_id');
        $employee_event->position_id=$request->input('position_id');
        $employee_event->start_time=$request->input('start_time');
        $employee_event->finish_time=$request->input('finish_time');
        $employee_event->travel_time=$request->input('travel_time');
        $employee_event->total_hours=$request->input('total_hours');
        $employee_event->labor_hours=$request->input('labor_hours');
        $employee_event->non_profit_percent=$request->input('non_profit_percent');
        $employee_event->hourly_pay=$request->input('hourly_pay');
        $employee_event->hourly_percent=$request->input('hourly_percent');
        $employee_event->flat_percent=$request->input('flat_percent');
        $employee_event->extra_percent=$request->input('extra_percent');
        $employee_event->job_total=$request->input('job_total');
        $employee_event->packing_percent=$request->input('packing_percent');
        $employee_event->service_percent=$request->input('service_percent');
        $employee_event->tips=$request->input('tips');
        $employee_event->bonus=$request->input('bonus');
        $employee_event->hourly_rate=$request->input('hourly_rate');
        $employee_event->discount=$request->input('discount');
        $employee_event->payment_description=$request->input('comment');
        $employee_event->save();
        return $request->all();
    }


    public function getSelectedEmployee(Request $request){
        $event_id=$request->input('event_id');
        $temps=EmployeeEvent::where('event_id',$event_id)->get();
        $result=Array();
        $i=0;
        foreach ($temps as $temp){
            $employee_id=$temp->employee_id;
            $employee=Employee::find($employee_id);
            $job_id=$temp->job_id;
            $job=Job::find($job_id);
            $position_id=$temp->position_id;
            $position=Postion::find($position_id);
            $result[$i]['name']=$employee->first_name.' '.$employee->last_name;
            $result[$i]['job']=$job->type.' - '.$job->variation;
            $result[$i]['position']=$position->name;
            $result[$i]['event_id']=$event_id;
            $result[$i]['job_id']=$job_id;
            $result[$i]['employee_id']=$employee_id;
            $result[$i]['position_id']=$position_id;
            $result[$i]['start_time']=$temp->start_time;
            $result[$i]['finish_time']=$temp->finish_time;
            $result[$i]['travel_time']=$temp->travel_time;
            $result[$i]['total_hours']=$temp->total_hours;
            $result[$i]['labor_hours']=$temp->labor_hours;
            $result[$i]['non_profit_percent']=$temp->non_profit_percent;
            $result[$i]['hourly_pay']=$temp->hourly_pay;
            $result[$i]['flat_percent']=$temp->flat_percent;
            $result[$i]['tips']=$temp->tips;
            $result[$i]['comment']=$temp->payment_description;
            $result[$i]['job_total']=$temp->job_total;
            $result[$i]['hourly_percent']=$temp->hourly_percent;
            $result[$i]['hourly_rate']=$temp->hourly_rate;
            $result[$i]['packing_percent']=$temp->packing_percent;
            $result[$i]['service_percent']=$temp->service_percent;
            $result[$i]['extra_percent']=$temp->extra_percent;
            $result[$i]['non_profit_percent']=$temp->non_profit_percent;
            $result[$i]['discount']=$temp->discount;
            $result[$i]['bonus']=$temp->bonus;
            $i++;
        }
        return response()->json(['data'=>$result]);
    }

    public function deleteEmployeeEvent(Request $request){
        $event_id=$request->input('event_id');
        $job_id=$request->input('job_id');
        $position_id=$request->input('position_id');
        EmployeeEvent::where([['event_id','=',$event_id],['job_id','=',$job_id],['position_id','=',$position_id]])->delete();

    }


    public function listEmployees(){
        $menu_level1='event_list';
        $menu_level2='';

        $result=Array();
        $temps=Event::all();
        $i=0;
        foreach ($temps as $temp){
            $result[$i]['id']=$temp->id;
            $result[$i]['pick_address']=$temp->pick_address;
            $result[$i]['drop_address']=$temp->drop_address;
            $result[$i]['stop_address']=$temp->stop_address;
            $result[$i]['truck_license']=$temp->truck_license;
            $result[$i]['state']=$temp->drop_address;
            $result[$i]['flat']=$temp->flat;
            $result[$i]['extra']=$temp->extra;
            $result[$i]['service']=$temp->service;
            $result[$i]['packing']=$temp->packing;
            $result[$i]['non_profit']=$temp->non_profit;
            $result[$i]['employee_numbers']=0;
            $employee_events=EmployeeEvent::where('event_id',$temp->id)->get();

            foreach($employee_events as $employee_event){
                $result[$i]['employee_numbers']++;
            }
            $i++;
        }
        return view('event.list',compact('menu_level1','menu_level2','result'));
    }


    public function deleteEvent($id){
        Event::where('id',$id)->delete();
        EmployeeEvent::where('employee_id',$id)->delete();
        return redirect()->back();
    }



    public function edit($id){

        $menu_level1='event_edit';
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
        $event=Event::find($id);
        $eventData['id']=$event->id;
        $eventData['pick_address']=$event->pick_address;
        $eventData['drop_address']=$event->drop_address;
        $eventData['stop_address']=$event->stop_address;
        $eventData['flat']=$event->flat;
        $eventData['extra']=$event->extra;
        $eventData['packing']=$event->packing;
        $eventData['service']=$event->service;
        $eventData['non_profit']=$event->non_profit;
        $eventData['truck_license']=$event->truck_license;
        $eventData['comment']=$event->comment;
        return view('event.edit',compact('menu_level1','menu_level2','jobs','positions','employees','eventData'));
    }





}
