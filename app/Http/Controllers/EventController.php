<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
    public function showEvent(){
        $menu_level1='event';
        $menu_level2='';
        return view('event',compact('menu_level1','menu_level2'));
    }

    public function getEvents(){
        $result=Array();
        $Events=Event::all();
        $i=0;
        foreach ($Events as $Event){
            $result[$i]['variation']=$Event->variation;
            if ($Event->type=='Hourly')
                $result[$i]['type']=1;
            else
                $result[$i]['type']=2;
            $result[$i]['ID']=$Event->id;
            $result[$i]['pay_amount']=$Event->pay_amount;
            $result[$i]['bonus']=$Event->bonus;
            $result[$i]['extra']=$Event->extra;
            $result[$i]['packing']=$Event->packing;
            $result[$i]['service']=$Event->service;
            $i++;
        }
        return response($result)->withHeaders([
            'Content-Type' => 'application/json',
        ]);
    }

    public function insertEvent(Request $request){

        $item=$request->all();
        $variation=$item['variation'];
        $type_temp=$item['type'];
        if ($type_temp==1){
            $type="Hourly";
        }else{
            $type="Flat";
        }

        $temps=Event::where([['variation','=',$variation],['type','=',$type]])->get();
        if (!$temps->first()){
            $Event=new Event;
            $Event->type=$type;
            $Event->variation=$variation;
            $Event->pay_amount=$item['pay_amount'];
            $Event->bonus=$item['bonus'];
            $Event->extra=$item['extra'];
            $Event->packing=$item['packing'];
            $Event->service=$item['service'];
            $Event->save();
            $item['ID']=$Event->id;
            $item['type']=(int)$type_temp;
            return response($item)->withHeaders([
                'Content-Type' => 'application/json',
            ]);
        }
        return "non";
    }

    public function updateEvent(Request $request){

        $item=$request->all();
        $id=$item['ID'];


        $variation=$item['variation'];
        $type_temp=$item['type'];
        if ($type_temp==1){
            $type="Hourly";
        }else{
            $type="Flat";
        }

        $Event=Event::find($id);
        $Event->type=$type;
        $Event->variation=$variation;
        $Event->pay_amount=$item['pay_amount'];
        $Event->bonus=$item['bonus'];
        $Event->extra=$item['extra'];
        $Event->packing=$item['packing'];
        $Event->service=$item['service'];
        $Event->save();
        $item['ID']=$Event->id;
        $item['type']=(int)$type_temp;

        return response($item)->withHeaders([
            'Content-Type' => 'application/json',
        ]);
    }

    public function deleteEvent(Request $request){
        $id=$request->input('ID');
        $Event=Event::find($id);
        if ($Event)
            $Event->delete();

    }
}
