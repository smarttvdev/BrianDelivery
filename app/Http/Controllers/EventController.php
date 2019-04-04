<?php

namespace App\Http\Controllers;

use App\Postion;
use Illuminate\Http\Request;
Use \DB;
use App\Event;
use App\Job;
use App\Employee;
use App\EmployeeJob;
use App\EmployeeEvent;
use Monolog\Handler\IFTTTHandler;
use phpDocumentor\Reflection\Types\Null_;

class EventController extends Controller
{
    public function create(){
        $menu_level1='event_create';
        $menu_level2='';
        $result=Array();
        $positions=Postion::all();
        $result['position'][0]['Id']=0;
        $result['position'][0]['Name']=null;
        $i=1;
        foreach ($positions as $position){
            $result['position'][$i]['Id']=$i;
            $result['position'][$i]['Name']=$position->name;
            $i++;
        }

        $jobs=Job::all();
        $i=0;
        foreach ($jobs as $job){
            $result["job"][$i]["type"]=$job->type;
            $result["job"][$i]["variation"]=$job->variation;
            $result["job"][$i]["id"]=$job->id;

            $result['employee'][$i][0][0]['Id']=0;
            $result['employee'][$i][0][0]['Name']='';
            $result['employee'][$i][0][0]['bonus']=0;
            $result['employee'][$i][0][0]['hourly_pay']=0;
            $result['employee'][$i][0][0]['hourly_percent']=0;
            $result['employee'][$i][0][0]['flat_percent']=0;
            $result['employee'][$i][0][0]['packing_percent']=0;
            $result['employee'][$i][0][0]['service_percent']=0;
            $result['employee'][$i][0][0]['extra_percent']=0;

            $j=1;
            foreach ($positions as $position){
                $result['employee'][$i][$j][0]['Id']=0;
                $result['employee'][$i][$j][0]['Name']='';
                $result['employee'][$i][$j][0]['bonus']=0;
                $result['employee'][$i][$j][0]['hourly_pay']=0;
                $result['employee'][$i][$j][0]['hourly_percent']=0;
                $result['employee'][$i][$j][0]['flat_percent']=0;
                $result['employee'][$i][$j][0]['packing_percent']=0;
                $result['employee'][$i][$j][0]['service_percent']=0;
                $result['employee'][$i][$j][0]['extra_percent']=0;
                $employee_jobs=EmployeeJob::where([['job_id','=',$job->id],['position_id','=',$position->id]])->get();
                $k=1;
                foreach ($employee_jobs as $employee_job){
                    $employee=Employee::find($employee_job->employee_id);
                    $employeement_state='beginner';
                    if (!is_null($employee->promotion_date)) {
                        $promotion_date = $employee->promotion_date;
                        $today = (new \DateTime())->format('promotion_date');
                        if ($today >= $promotion_date)
                            $employeement_state = 'promote';
                    }

                    if (!is_null($employee)){
                        if ($employee_job->employeement_state==$employeement_state){
                            $result['employee'][$i][$j][$k]['Id']=$k;
                            $result['employee'][$i][$j][$k]['Name']="$employee->first_name $employee->last_name";
                            $result['employee'][$i][$j][$k]['bonus']=$employee->bonus;
                            $result['employee'][$i][$j][$k]['hourly_pay']=$employee_job->hourly_pay;
                            $result['employee'][$i][$j][$k]['hourly_percent']=$employee_job->hourly_percent;
                            $result['employee'][$i][$j][$k]['flat_percent']=$employee_job->flat_percent;
                            $result['employee'][$i][$j][$k]['packing_percent']=$employee_job->packing_percent;
                            $result['employee'][$i][$j][$k]['service_percent']=$employee_job->service_percent;
                            $result['employee'][$i][$j][$k]['extra_percent']=$employee_job->extra_percent;
                            $k++;
                        }
                    }
                }
                $j++;
            }
            $i++;
        }
        return view('event.create',compact('menu_level1','menu_level2','result'));
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

        $event->job_id=$request->input('job_id');
        $event->pick_address=$request->input('pick_address');
        $event->drop_address=$request->input('drop_address');

        $stop_count=$request->input('stop-count');
        $stop_addresses=Array();
        $j=0;
        if ($stop_count!=0){
            for ($i=1;$i<=$stop_count;$i++){
                if (!is_null($request->input('stop_address-'.$i))){
                    $stop_addresses[$j]=$request->input('stop_address-'.$i);
                    $j++;
                }
            }
        }
        $event->stop_address=$stop_addresses;
        $event->non_profit=$request->input('non_profit');
        if (!is_null($request->input('hourly_rate')))
            $event->hourly_rate=$request->input('hourly_rate');
        else
            $event->flat=$request->input('flat');

        $event->packing=$request->input('packing');
        $event->service=$request->input('service');
        $event->extra=$request->input('extra');
        $event->job_total=$request->input('job_total');
        $event->discount=$request->input('discount');
        $event->tips=$request->input('tips');
        $event->truck_license=$request->input('truck_license');
        if ($request->hasFile('attach_docs')){
            $file=$request->file('attach_docs');
            $file->move(public_path().'/docs',$file->getClientOriginalName());
            $event->attach_file=$file->getClientOriginalName();
        }
        $event->comment=$request->input('event_comment');
        if (!is_null($request->input('start_time')))
            $event->start_time=(new \DateTime($request->input('start_time')))->format('Y-m-d H:i:s');
        if (!is_null($request->input('finish_time')))
            $event->finish_time=(new \DateTime($request->input('finish_time')))->format('Y-m-d H:i:s');
        $event->labor_hours=$request->input('labor_hours');
        $event->travel_time=$request->input('travel_time');
        $event->total_hours=$request->input('total_hours');
        $event->save();
        return $event->id;
    }

    public function addEmployeeToEvent(Request $request){
        $event_id=$request->input('event_id');
        $job_id=$request->input('job_id');
        $employee_data=$request->input('employee_data');
        $employee_id=$this->getEmployeeIdFromName($employee_data[0]);
        $position_id=$this->getPositionIdFromName($employee_data[1]);
        $temps=EmployeeEvent::where([['event_id','=',$event_id],['position_id','=',$position_id],['employee_id','=',$employee_id]])->get();
        if ($temps->first())
            $employee_event=$temps->first();
        else
            $employee_event=new EmployeeEvent;

        $employee_event->event_id=$event_id;
        $employee_event->position_id=$position_id;
        $employee_event->employee_id=$employee_id;
        $employee_event->bonus=$employee_data[2];
        $employee_event->hourly_pay=$employee_data[3];
        $job=Job::find($job_id);
        if ($job->type=="Hourly")
            $employee_event->hourly_percent=$employee_data[4];
        else
            $employee_event->flat_percent=$employee_data[4];
        $employee_event->extra_percent=$employee_data[5];
        $employee_event->packing_percent=$employee_data[6];
        $employee_event->service_percent=$employee_data[7];
        $employee_event->payment_description=$employee_data[9];
        $employee_event->save();
        return $request->all();
    }


    public function getEmployeeIdFromName($employee_name){
        $employee_lists=Employee::where(DB::raw("CONCAT(`first_name`,' ', `last_name`)"), '=',$employee_name)->get()->first();
        return $employee_lists->id;
    }

    public function getPositionIdFromName($position_name){
        $position=Postion::where('name',$position_name)->get()->first();
        return $position->id;
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
        $employee_data=$request->input('employee_data');
        $employee_id=$this->getEmployeeIdFromName($employee_data[0]);
        $position_id=$this->getPositionIdFromName($employee_data[1]);
        EmployeeEvent::where([['event_id','=',$event_id],['position_id','=',$position_id],['employee_id','=',$employee_id]])->delete();

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
            $result[$i]['stop_address']=implode(',',$temp->stop_address);
            $result[$i]['truck_license']=$temp->truck_license;
            $result[$i]['state']=$temp->state;
            $result[$i]['flat']=$temp->flat;
            $result[$i]['hourly_rate']=$temp->hourly_rate;
            $result[$i]['job_total']=$temp->job_total;
            $result[$i]['discount']=$temp->discount;
            $result[$i]['tips']=$temp->tips;
            $result[$i]['extra']=$temp->extra;
            $result[$i]['service']=$temp->service;
            $result[$i]['packing']=$temp->packing;
            $result[$i]['non_profit']=$temp->non_profit;
            $result[$i]['employee_numbers']=0;

            $job=Job::where('id',$temp->job_id)->first();
            if (!is_null($job->variation))
                $result[$i]['job_type']="$job->type - $job->variation";
            else
                $result[$i]['job_type']="$job->type";

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

        $menu_level1='event_create';
        $menu_level2='';
        $result=Array();

        $positions=Postion::all();
        $result['position'][0]['Id']=0;
        $result['position'][0]['Name']=null;
        $i=1;
        foreach ($positions as $position){
            $result['position'][$i]['Id']=$i;
            $result['position'][$i]['Name']=$position->name;
            $i++;
        }

        $jobs=Job::all();
        $i=0;
        foreach ($jobs as $job){
            $result["job"][$i]["type"]=$job->type;
            $result["job"][$i]["variation"]=$job->variation;
            $result["job"][$i]["id"]=$job->id;

            $result['employee'][$i][0][0]['Id']=0;
            $result['employee'][$i][0][0]['Name']='';
            $result['employee'][$i][0][0]['bonus']=0;
            $result['employee'][$i][0][0]['hourly_pay']=0;
            $result['employee'][$i][0][0]['hourly_percent']=0;
            $result['employee'][$i][0][0]['flat_percent']=0;
            $result['employee'][$i][0][0]['packing_percent']=0;
            $result['employee'][$i][0][0]['service_percent']=0;
            $result['employee'][$i][0][0]['extra_percent']=0;

            $j=1;
            foreach ($positions as $position){
                $result['employee'][$i][$j][0]['Id']=0;
                $result['employee'][$i][$j][0]['Name']='';
                $result['employee'][$i][$j][0]['bonus']=0;
                $result['employee'][$i][$j][0]['hourly_pay']=0;
                $result['employee'][$i][$j][0]['hourly_percent']=0;
                $result['employee'][$i][$j][0]['flat_percent']=0;
                $result['employee'][$i][$j][0]['packing_percent']=0;
                $result['employee'][$i][$j][0]['service_percent']=0;
                $result['employee'][$i][$j][0]['extra_percent']=0;
                $employee_jobs=EmployeeJob::where([['job_id','=',$job->id],['position_id','=',$position->id]])->get();
                $k=1;
                foreach ($employee_jobs as $employee_job){
                    $employee=Employee::find($employee_job->employee_id);
                    $employeement_state='beginner';
                    if (!is_null($employee->promotion_date)) {
                        $promotion_date = $employee->promotion_date;
                        $today = (new \DateTime())->format('promotion_date');
                        if ($today >= $promotion_date)
                            $employeement_state = 'promote';
                    }

                    if (!is_null($employee)){
                        if ($employee_job->employeement_state==$employeement_state){
                            $result['employee'][$i][$j][$k]['Id']=$k;
                            $result['employee'][$i][$j][$k]['Name']="$employee->first_name $employee->last_name";
                            $result['employee'][$i][$j][$k]['bonus']=$employee->bonus;
                            $result['employee'][$i][$j][$k]['hourly_pay']=$employee_job->hourly_pay;
                            $result['employee'][$i][$j][$k]['hourly_percent']=$employee_job->hourly_percent;
                            $result['employee'][$i][$j][$k]['flat_percent']=$employee_job->flat_percent;
                            $result['employee'][$i][$j][$k]['packing_percent']=$employee_job->packing_percent;
                            $result['employee'][$i][$j][$k]['service_percent']=$employee_job->service_percent;
                            $result['employee'][$i][$j][$k]['extra_percent']=$employee_job->extra_percent;
                            $k++;
                        }
                    }
                }
                $j++;
            }
            $i++;
        }

        $event=Event::find($id);
        $result['event']['pick_address']=$event->pick_address;
        $result['event']['drop_address']=$event->drop_address;
        $result['event']['stop_address']=$event->stop_address;
        $result['event']['non_profit']=$event->non_profit;
        $result['event']['hourly_rate']=$event->hourly_rate;
        $result['event']['flat']=$event->flat;
        $result['event']['packing']=$event->packing;
        $result['event']['service']=$event->service;
        $result['event']['extra']=$event->extra;
        $result['event']['job_total']=$event->job_total;
        $result['event']['tips']=$event->tips;
        $result['event']['discount']=$event->discount;
        $result['event']['start_time']=$event->start_time;
        $result['event']['finish_time']=$event->finish_time;
        $result['event']['truck_license']=$event->truck_license;
        $result['event']['comment']=$event->comment;
        $result['event']['labor_hours']=$event->labor_hours;
        $result['event']['travel_time']=$event->travel_time;
        $result['event']['total_hours']=$event->total_hours;
        $result['event']['id']=$event->id;
        $result['event']['job_id']=$event->job_id;

        $result['event_employees']=Array();
        $temps=EmployeeEvent::where('event_id',$event->id)->get();
        $i=0;
        foreach ($temps as $temp){
            $result['event_employees'][$i]['id']=$temp->employee_id;
            $employee=Employee::find($temp->employee_id);
            $result['event_employees'][$i]['name']="$employee->first_name $employee->last_name";
            $position=Postion::find($temp->position_id);
            $result['event_employees'][$i]['position']=$position->name;
            $result['event_employees'][$i]['bonus']=$temp->bonus;

            $result['event_employees'][$i]['hourly_pay']=$temp->hourly_pay;
            $result['event_employees'][$i]['flat']=$temp->flat;
            $result['event_employees'][$i]['hourly_percent']=$temp->hourly_percent;
            $result['event_employees'][$i]['flat_percent']=$temp->flat_percent;
            $result['event_employees'][$i]['extra_percent']=$temp->extra_percent;
            $result['event_employees'][$i]['packing_percent']=$temp->packing_percent;
            $result['event_employees'][$i]['service_percent']=$temp->service_percent;
            $result['event_employees'][$i]['payment_description']=$temp->payment_description;
            $i++;
        }
        return view('event.edit',compact('menu_level1','menu_level2','result'));
    }

}
