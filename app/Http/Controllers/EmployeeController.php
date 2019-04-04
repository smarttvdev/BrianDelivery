<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Job;
use App\Postion;
use App\EmployeeJob;

Use \DB;

class EmployeeController extends Controller
{

    public $positionIndicies=Array(),$positionIds, $jobIndicies=Array(),$jobIds;

    public function __construct(){

        $jobs=Job::orderBy('type')->get();
        $i=0;
        foreach ($jobs as $job){
            $this->jobIndicies[$job->id]=$i+1;
            $this->jobIds[$i]=$job->id;
            $i++;
        }
        $positions=Postion::all();
        $i=0;
        foreach ($positions as $position){
            $this->positionIndicies[$position->id]=$i+1;
            $this->positionIds[$i]=$position->id;
            $i++;
        }
    }

    public function showCreate(){
        $menu_level1='employee';
        $menu_level2='employee_create';
        $temps=Postion::all();
        $i=0;
        $position[0]['Name']=null;
        $position[0]['bonus']=0;
        $position[0]['Id']=$i;
        foreach ($temps as $temp){
            $position[$i+1]['Name']=$temp->name;
            $position[$i+1]['bonus']=$temp->bonus;
            $position[$i+1]['Id']=$i+1;
            $i++;
        }
        $position=json_encode($position);

        $temps=Job::orderBy('type')->get();
        $i=0;
        $job_item[0]['Name']=null;
        $job_item[0]['Id']=0;
        $job_item[0]['hourly_pay']=0;
        $job_item[0]['hourly_percent']=0;
        $job_item[0]['flat_percent']=0;
        $job_item[0]['extra_percent']=0;
        $job_item[0]['packing_percent']=0;
        $job_item[0]['service_percent']=0;
        foreach ($temps as $temp){
            if (!is_null($temp->variation))
                $job_item[$i+1]['Name']=$temp->type.' - '. $temp->variation;
            else
                $job_item[$i+1]['Name']=$temp->type;

            $job_item[$i+1]['Id']=$i+1;
            $job_item[$i+1]['hourly_pay']=$temp->hourly_pay;
            $job_item[$i+1]['hourly_percent']=$temp->hourly_percent;
            $job_item[$i+1]['flat_percent']=$temp->flat_percent;
            $job_item[$i+1]['extra_percent']=$temp->extra_percent;
            $job_item[$i+1]['packing_percent']=$temp->packing_percent;
            $job_item[$i+1]['service_percent']=$temp->service_percent;
            $i++;
        }
        $job_item=json_encode($job_item);
        return view('employee.create_employee',compact('menu_level1','menu_level2','position','job_item'));
    }


    public function Save(Request $request){
        $employeement_state=$request->input('employeement_state');
        $employee_id=$request->input('employee_id');
        if ($employeement_state!='promote'){
            $first_name=$request->input('first_name');
            $last_name=$request->input('last_name');
            $gender=$request->input('gender');
            $paid_method=$request->input('PaidMethod');
            if ($employee_id!=0)
                $employee=Employee::find($employee_id);
            else
                $employee=new Employee;

            $employeement_time=(new \DateTime(''))->format('Y-m-d H:i:s');

            $employee->first_name=$first_name;
            $employee->last_name=$last_name;
            $employee->gender=$gender;
            $employee->paid_method=$paid_method;
            $employee->employeement_time=$employeement_time;
            if ($request->hasFile('profile_picture')){
                $file=$request->file('profile_picture');
                $file->move(public_path().'/pictureIDs',$file->getClientOriginalName());
                $employee->pictureID=$file->getClientOriginalName();
            }
            $employee->save();
            $employee_id=$employee->id;
            $this->saveEmployeeJob($request,$employee_id);
        }
        else{
            $this->saveEmployeeJob($request,$employee_id,$employeement_state);
        }
        return $employee_id;
    }



    public function saveEmployeeJob(Request $request,$employee_id,$employeement_state='beginner')
    {
        $item_count = $request->input('item_count');
        if ($item_count > 0) {
            for ($i = 0; $i < $item_count; $i++) {
                $job_index = $request->input('job-' . $i);
                $id = $request->input('id-' . $i);
                $temps = Job::orderBy('type')->get();
                $job_id = $temps[$job_index - 1]->id;

                $position_index = $request->input('position-' . $i);
                $temps = Postion::all();
                $position_id = $temps[$position_index - 1]->id;

                $temps = EmployeeJob::find($id);  // Will check if already saved

                if ($temps)
                    $employee_job = $temps;
                else
                    $employee_job = new EmployeeJob;
                $employee_job->employee_id = $employee_id;
                $employee_job->job_id = $job_id;
                $employee_job->position_id = $position_id;
                $employee_job->hourly_pay = $request->input('hourly_pay-' . $i);
                $employee_job->hourly_percent = $request->input('hourly_percent-' . $i);
                $employee_job->flat_percent = $request->input('flat_percent-' . $i);
                $employee_job->extra_percent = $request->input('extra_percent-' . $i);
                $employee_job->packing_percent = $request->input('packing_percent-' . $i);
                $employee_job->service_percent = $request->input('service_percent-' . $i);
                $employee_job->employeement_state = $employeement_state;
                $employee_job->save();

                if ($employeement_state == 'beginner') {
                    $temps = EmployeeJob::find($id + 1);  // Will check if already saved
                    if (!$temps) {
                        $employee_job_promote = new EmployeeJob;
                        $employee_job_promote->employee_id = $employee_job->employee_id;
                        $employee_job_promote->job_id = $employee_job->job_id;
                        $employee_job_promote->position_id = $employee_job->position_id;
                        $employee_job_promote->employeement_state = $employee_job->employeement_state;
                        $employee_job_promote->hourly_pay = $employee_job->hourly_pay;
                        $employee_job_promote->hourly_percent = $employee_job->hourly_percent;
                        $employee_job_promote->flat_percent = $employee_job->flat_percent;
                        $employee_job_promote->extra_percent = $employee_job->extra_percent;
                        $employee_job_promote->packing_percent = $employee_job->packing_percent;
                        $employee_job_promote->service_percent = $employee_job->service_percent;
                        $employee_job_promote->employeement_state = 'promote';
                        $employee_job_promote->save();
                    }
                }
            }
            if ($employeement_state == 'promote') {  // Will save Promote Date
                if (!is_null($request->input('promote_date'))) {
                    $employee = Employee::find($employee_id);
                    $employee->promotion_date = (new \DateTime($request->input('promote_date')))->format('Y-m-d');
                    $employee->save();
                }
            }

        }
    }

    public function insertEmployeeJob(Request $request){
        $employee_id=$request->input('employee_id');
        $employeement_state=$request->input('employeement_state');
        $i=0;
        $job_index = $request->input('job-0');
        $temps = Job::orderBy('type')->get();
        $job_id = $temps[$job_index - 1]->id;
        $position_index = $request->input('position-' . $i);
        $temps = Postion::all();
        $position_id = $temps[$position_index - 1]->id;
        $employee_job = new EmployeeJob;
        $employee_job->employee_id = $employee_id;
        $employee_job->job_id = $job_id;
        $employee_job->position_id = $position_id;
        $employee_job->hourly_pay = $request->input('hourly_pay-' . $i);
        $employee_job->hourly_percent = $request->input('hourly_percent-' . $i);
        $employee_job->flat_percent = $request->input('flat_percent-' . $i);
        $employee_job->extra_percent = $request->input('extra_percent-' . $i);
        $employee_job->packing_percent = $request->input('packing_percent-' . $i);
        $employee_job->service_percent = $request->input('service_percent-' . $i);
        $employee_job->employeement_state = $employeement_state;
        $employee_job->save();

        if ($employeement_state=='beginner'){
            $employee_job_promot=new EmployeeJob;
            $employee_job_promot->employee_id = $employee_id;
            $employee_job_promot->job_id = $job_id;
            $employee_job_promot->position_id = $position_id;
            $employee_job_promot->hourly_pay = $request->input('hourly_pay-' . $i);
            $employee_job_promot->hourly_percent = $request->input('hourly_percent-' . $i);
            $employee_job_promot->flat_percent = $request->input('flat_percent-' . $i);

            $employee_job_promot->extra_percent = $request->input('extra_percent-' . $i);
            $employee_job_promot->packing_percent = $request->input('packing_percent-' . $i);
            $employee_job_promot->service_percent = $request->input('service_percent-' . $i);
            $employee_job_promot->employeement_state = 'promote';
            $employee_job_promot->save();

        }

        return $request->all();
    }

    public function editEmployeeJob(Request $request){
        $id=$request->input('id-0');
        if (!is_null($id)){
            $employee_id=$request->input('employee_id');
            $employeement_state=$request->input('employeement_state');
            $i=0;
            $job_index = $request->input('job-0');
            $temps = Job::orderBy('type')->get();
            $job_id = $temps[$job_index - 1]->id;
            $position_index = $request->input('position-' . $i);
            $temps = Postion::all();
            $position_id = $temps[$position_index - 1]->id;
            $employee_job = EmployeeJob::find($id);
            $employee_job->employee_id = $employee_id;
            $employee_job->job_id = $job_id;
            $employee_job->position_id = $position_id;
            $employee_job->hourly_pay = $request->input('hourly_pay-' . $i);
            $employee_job->hourly_percent = $request->input('hourly_percent-' . $i);
            $employee_job->flat_percent = $request->input('flat_percent-' . $i);
            $employee_job->extra_percent = $request->input('extra_percent-' . $i);
            $employee_job->packing_percent = $request->input('packing_percent-' . $i);
            $employee_job->service_percent = $request->input('service_percent-' . $i);
            $employee_job->employeement_state = $employeement_state;
            $employee_job->save();
        }
        return $request->all();
    }

    public function deleteEmployeeJob(Request $request){
        $id=$request->input('ID');
        EmployeeJob::where('id',$id)->delete();
        return $request->all();
    }

    public function getEmployeeJob($employee_id,$employeement_state){
        $EmployeeJobs=EmployeeJob::where([['employee_id','=',$employee_id],['employeement_state','=',$employeement_state]])->get();

        $item=Array();
        if ($EmployeeJobs->first()){
            $i=0;
            foreach ($EmployeeJobs as $EmployeeJob){
                $item[$i]['ID']=$EmployeeJob->id;
                $item[$i]['job']=(int)$this->jobIndicies[$EmployeeJob->job_id];
                $item[$i]['position']=(int)$this->positionIndicies[$EmployeeJob->position_id];
                $item[$i]['hourly_pay']=$EmployeeJob->hourly_pay;
                $item[$i]['hourly_percent']=$EmployeeJob->hourly_percent;
                $item[$i]['flat_percent']=$EmployeeJob->flat_percent;
                $item[$i]['extra_percent']=$EmployeeJob->extra_percent;
                $item[$i]['packing_percent']=$EmployeeJob->packing_percent;
                $item[$i]['service_percent']=$EmployeeJob->service_percent;
                $temp=Postion::find($EmployeeJob->position_id);
                $item[$i]['bonus']=$temp->bonus;
                $i++;
            }
        }

        return response($item)->withHeaders([
            'Content-Type' => 'application/json',
        ]);
    }


    public function showEmployeeList(){
        $menu_level1='employee';
        $menu_level2='employee_list';
        return view('employee.list_employee',compact('menu_level1','menu_level2'));
    }


    public function getEmployeeList(Request $request){
        $search_by=$request->input('search_by');
        $key_word=$request->input('key_word');

        if (is_null($search_by) || is_null($key_word))  // Will get All Employee Lists
            $employee_lists=Employee::all();
        else{
            if ($search_by=='name'){  // search by employee name
                $employee_lists=Employee::where(DB::raw("CONCAT(`first_name`,' ', `last_name`)"), 'LIKE', "%".$key_word."%")->get();
            }
            elseif($search_by=='pay roll')
            {  // if search by pay roll
                $job_ids=Job::where(DB::raw("CONCAT(`category`,' ', `name`)"), 'LIKE', "%".$key_word."%")
                    ->orWhere(DB::raw("CONCAT(`category`,'-', `name`)"), 'LIKE', "%".$key_word."%")
                    ->orWhere(DB::raw("CONCAT(`category`,' - ', `name`)"), 'LIKE', "%".$key_word."%")
                    ->orWhere(DB::raw("CONCAT(`category`,'/', `name`)"), 'LIKE', "%".$key_word."%")
                    ->orWhere(DB::raw("CONCAT(`category`,' / ', `name`)"), 'LIKE', "%".$key_word."%")
                    ->get()->pluck('id')->toArray();
                $employee_ids=EmployeeJob::whereIn('job_id',$job_ids)->get()->pluck('employee_id')->toArray();
                $employee_lists=Employee::whereIn('id',$employee_ids)->get();
            }
            else{  // position
                $position_ids=Postion::where('name','LIKE','%'.$key_word.'%')->get()->pluck('id')->toArray();
                $employee_ids=EmployeeJob::whereIn('position_id',$position_ids)->get()->pluck('employee_id')->toArray();
                $employee_lists=Employee::whereIn('id',$employee_ids)->get();
            }
        }



        $item=Array();
        $i=0;
        foreach ($employee_lists as $employee_list){
            $item[$i]['ID']=$employee_list->id;
            $item[$i]['name']=$employee_list->first_name.' '.$employee_list->last_name;
            $item[$i]['employeement_date']=(new \DateTime($employee_list->employeement_tile))->format('Y-m-d');
            $item[$i]['state']=$employee_list->state;
            $item[$i]['bonus']=0;
            $item[$i]['penalty']=0;
            $item[$i]['reimbursment']=0;
            $i++;
        }
        return response($item)->withHeaders([
            'Content-Type' => 'application/json',
        ]);
    }


    public function deleteEmployee(Request $request){
        $employee_id=$request->input('ID');
        Employee::where('id',$employee_id)->delete();
        EmployeeJob::where('employee_id',$employee_id)->delete();
        return $request->all();
    }

    public function searchEmployee(Request $request){
        return $request->all();
    }

    public function showEdit($employee_id){
        $menu_level1='';
        $menu_level2='';

        $temps=Postion::all();
        $i=0;
        $position[0]['Name']=null;
        $position[0]['Id']=$i;
        foreach ($temps as $temp){
            $position[$i+1]['Name']=$temp->name;
            $position[$i+1]['bonus']=$temp->bonus;
            $position[$i+1]['Id']=$i+1;
            $i++;
        }
        $position=json_encode($position);

        $temps=Job::orderBy('type')->get();
        $i=0;
        $job_item[0]['Name']=null;
        $job_item[0]['Id']=0;
        $job_item[0]['hourly_pay']=0;
        $job_item[0]['hourly_percent']=0;
        $job_item[0]['flat_percent']=0;

        $job_item[0]['extra_percent']=0;
        $job_item[0]['packing_percent']=0;
        $job_item[0]['service_percent']=0;
        $job_item[0]['bonus']=0;
        foreach ($temps as $temp){
            $job_item[$i+1]['Name']=$temp->type.' - '. $temp->variation;
            $job_item[$i+1]['Id']=$i+1;
            $job_item[$i+1]['hourly_pay']=$temp->hourly_pay;
            $job_item[$i+1]['hourly_percent']=$temp->hourly_percent;
            $job_item[$i+1]['flat_percent']=$temp->flat_percent;

            $job_item[$i+1]['extra_percent']=$temp->extra_percent;
            $job_item[$i+1]['packing_percent']=$temp->packing_percent;
            $job_item[$i+1]['service_percent']=$temp->service_percent;
            $job_item[$i+1]['bonus']=$temp->bonus;
            $i++;
        }
        $job_item=json_encode($job_item);

        $employee=Employee::find($employee_id);

        return view('employee.edit_employee',compact('employee_id','job_item','position','menu_level1','menu_level2','employee'));
    }

}
