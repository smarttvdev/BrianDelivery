<?php

namespace App\Http\Controllers\Customer;

use App\Model\Driver\Driver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Order\Order;
use App\Model\User\User;
use App\Model\Driver\VehicleInformation;

use App\Notifications\OrderCreatedNotification;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{
    public function postOrder(Request $request){
        $user=Auth::user();
        $customer=$user->customer;
        $user_id=$user->id;
        $customer_id=$customer->id;
        $start_lat=$request->input('start_lat');
        $start_lng=$request->input('start_lng');
        $end_lat=$request->input('end_lat');
        $end_lng=$request->input('end_lng');
        $stuff_weight=$request->input('stuff_weight');
        $stuff_width=$request->input('stuff_width');
        $stuff_height=$request->input('stuff_height');
        $round_trip=$request->input('round_trip');
        $waiting_time=$request->input('waiting_time');
        $min_price=$request->input('min_price');
        $max_price=$request->input('max_price');
        $ordered_time=$request->input('ordered_time');
        $ordered_title=$request->input('ordered_title');
        $ordered_content=$request->input('ordered_content');

        $order=new Order;
        $order->customer_id=$customer_id;
        $order->start_lat=$start_lat;
        $order->start_lng=$start_lng;
        $order->end_lat=$end_lat;
        $order->end_lng=$end_lng;
        $order->stuff_weight=$stuff_weight;
        $order->stuff_width=$stuff_width;
        $order->stuff_height=$stuff_height;
        $order->round_trip=$round_trip;
        $order->waiting_time=$waiting_time;
        $order->min_price=$min_price;
        $order->max_price=$max_price;
        $order->ordered_time=$ordered_time;
        $order->order_title=$ordered_title;
        $order->order_content=$ordered_content;
        $order->save();



//        Test
        $user_id=18;
        $user=User::find($user_id);
        $customer=$user->customer;
        $customer_id=$customer->id;
        $start_lat=0.2;
        $start_lng=0.3;
        $end_lat=0.2;
        $end_lng=0.3;
        $stuff_weight=4;
        $stuff_width=2;
        $stuff_height=1;
        $round_trip=1;
        $waiting_time=4;
        $min_price=21;
        $max_price=100;
        $ordered_time="2019-05-01";
        $ordered_title="Hello Drivers, I need urgent help";
        $ordered_content="hello all";

        $free_driver_ids=Order::whereNotNull('accepted_driver_id')->whereNull('order_finished_state')->get()->pluck('id')->toArray();  // this is the drivers that are doing tasks
        $stuff_available_driver_ids=VehicleInformation::where([['max_stuff_weight','>=',$stuff_weight],['max_stuff_height','>=',$stuff_height],['max_stuff_width','>=',$stuff_width]])->get()->pluck('driver_id')->toArray();

        $drivers=Driver::whereNotIn('id',$free_driver_ids)->whereIn('id',$stuff_available_driver_ids)->where('state','active')->get();

        $order_alert=new OrderCreatedNotification($customer_id,$ordered_title,$ordered_content,$ordered_content,$start_lat,$start_lng,$end_lat,$end_lng,$min_price,$max_price,$round_trip,$stuff_weight,$stuff_width,$stuff_height,$waiting_time);
        foreach ($drivers as $driver){
            $user=$driver->user;
            $user->notify($order_alert);
        }



    }

}
