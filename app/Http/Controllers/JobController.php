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
        $Jobs=Job::all();
        $i=0;
        foreach ($Jobs as $Job){
            $result[$i]['variation']=$Job->variation;
            if ($Job->type=='Hourly')
                $result[$i]['type']=1;
            else
                $result[$i]['type']=2;
            $result[$i]['ID']=$Job->id;
            $result[$i]['pay_amount']=$Job->pay_amount;
            $result[$i]['bonus']=$Job->bonus;
            $result[$i]['extra']=$Job->extra;
            $result[$i]['packing']=$Job->packing;
            $result[$i]['service']=$Job->service;
            $i++;
        }
        return response($result)->withHeaders([
            'Content-Type' => 'application/json',
        ]);
    }

    public function insertJob(Request $request){

        $item=$request->all();
        $variation=$item['variation'];
        $type_temp=$item['type'];
        if ($type_temp==1){
            $type="Hourly";
        }else{
            $type="Flat";
        }

        $temps=Job::where([['variation','=',$variation],['type','=',$type]])->get();
        if (!$temps->first()){
            $Job=new Job;
            $Job->type=$type;
            $Job->variation=$variation;
            $Job->pay_amount=$item['pay_amount'];
            $Job->bonus=$item['bonus'];
            $Job->extra=$item['extra'];
            $Job->packing=$item['packing'];
            $Job->service=$item['service'];
            $Job->save();
            $item['ID']=$Job->id;
            $item['type']=(int)$type_temp;
            return response($item)->withHeaders([
                'Content-Type' => 'application/json',
            ]);
        }
        return "non";
    }

    public function updateJob(Request $request){

        $item=$request->all();
        $id=$item['ID'];


        $variation=$item['variation'];
        $type_temp=$item['type'];
        if ($type_temp==1){
            $type="Hourly";
        }else{
            $type="Flat";
        }

        $Job=Job::find($id);
        $Job->type=$type;
        $Job->variation=$variation;
        $Job->pay_amount=$item['pay_amount'];
        $Job->bonus=$item['bonus'];
        $Job->extra=$item['extra'];
        $Job->packing=$item['packing'];
        $Job->service=$item['service'];
        $Job->save();
        $item['ID']=$Job->id;
        $item['type']=(int)$type_temp;

        return response($item)->withHeaders([
            'Content-Type' => 'application/json',
        ]);
    }

    public function deleteJob(Request $request){
        $id=$request->input('ID');
        $Job=Job::find($id);
        if ($Job)
            $Job->delete();

    }





}
