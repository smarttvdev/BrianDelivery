<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;

class JobController extends Controller
{
    public function showJob(){
        $menu_level1='job';
        $menu_level2='';
        return view('job',compact('menu_level1','menu_level2'));
    }

    public function getJobs(){
        $result=Array();
        $jobs=Job::all();
        $i=0;
        foreach ($jobs as $job){
            $result[$i]['name']=$job->name;
            if ($job->category=='Hourly')
                $result[$i]['category']=1;
            else
                $result[$i]['category']=2;
            $result[$i]['ID']=$job->id;
            $result[$i]['pay_amount']=$job->pay_amount;
            $result[$i]['bonus']=$job->bonus;
            $result[$i]['extra']=$job->extra;
            $result[$i]['packing']=$job->packing;
            $result[$i]['service']=$job->service;
            $i++;
        }
        return response($result)->withHeaders([
            'Content-Type' => 'application/json',
        ]);
    }

    public function insertJob(Request $request){

        $item=$request->all();
        $job_name=$item['name'];
        $category_temp=$item['category'];
        if ($category_temp==1){
            $category="Hourly";
        }else{
            $category="Flat";
        }

        $temps=Job::where([['name','=',$job_name],['category','=',$category]])->get();
        if (!$temps->first()){
            $job=new Job;
            $job->category=$category;
            $job->name=$job_name;
            $job->pay_amount=$item['pay_amount'];
            $job->bonus=$item['bonus'];
            $job->extra=$item['extra'];
            $job->packing=$item['packing'];
            $job->service=$item['service'];
            $job->save();
            $item['ID']=$job->id;
            $item['category']=(int)$category_temp;
            return response($item)->withHeaders([
                'Content-Type' => 'application/json',
            ]);
        }
        return "non";
    }

    public function updateJob(Request $request){

        $item=$request->all();
        $id=$item['ID'];


        $job_name=$item['name'];
        $category_temp=$item['category'];
        if ($category_temp==1){
            $category="Hourly";
        }else{
            $category="Flat";
        }

        $job=Job::find($id);
        $job->category=$category;
        $job->name=$job_name;
        $job->pay_amount=$item['pay_amount'];
        $job->bonus=$item['bonus'];
        $job->extra=$item['extra'];
        $job->packing=$item['packing'];
        $job->service=$item['service'];
        $job->save();
        $item['ID']=$job->id;
        $item['category']=(int)$category_temp;

        return response($item)->withHeaders([
            'Content-Type' => 'application/json',
        ]);
    }

    public function deleteJob(Request $request){
        $id=$request->input('ID');
        $job=Job::find($id);
        if ($job)
            $job->delete();

    }




}
