<?php

namespace App\Http\Controllers\Customer;

use App\Model\Driver\Driver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Order\Order;
use App\Model\Order\OrderBid;

use App\Model\User\User;
use App\Model\Driver\VehicleInformation;
use App\Model\Customer\Customer;

use App\Notifications\OrderCreatedNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CustomerController extends Controller
{
    public function postOrder(Request $request){
        $user=Auth::user();
        $customer=$user->customer;
        $user_id=$user->id;
        $phone_number=$user->phonenum;
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
        $ordered_title=$request->input('order_title');
        $ordered_content=$request->input('order_content');

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

//        $free_driver_ids=Order::whereNotNull('accepted_driver_id')->whereNull('order_finished_state')->get()->pluck('id')->toArray();  // this is the drivers that are doing tasks
        $stuff_available_driver_ids=VehicleInformation::where([['max_stuff_weight','>=',$stuff_weight],['max_stuff_height','>=',$stuff_height],['max_stuff_width','>=',$stuff_width]])->get()->pluck('driver_id')->toArray();
        $drivers=Driver::whereIn('id',$stuff_available_driver_ids)->where('state','active')->get();

        $order_alert=new OrderCreatedNotification($customer_id,$phone_number,$ordered_title,$ordered_content,$ordered_content,$start_lat,$start_lng,$end_lat,$end_lng,$min_price,$max_price,$round_trip,$stuff_weight,$stuff_width,$stuff_height,$waiting_time);
        foreach ($drivers as $driver){
            $user=$driver->user;
            $user->notify($order_alert);
        }
        return "success";
    }



    public function updateLocation(Request $request){
        $user=Auth::user();
        $customer=$user->customer;
        $lat=$request->input('lat');
        $lng=$request->input('lng');
        $customer->lat=$lat;
        $customer->lng=$lng;
        $customer->save();
        return "success";
    }

    public function acceptOrder(Request $request){
        $order_id=$request->input('order_id');
        $driver_id=$request->input('driver_id');
        $price=$request->input('price');
        $accepted_time=date("Y-m-d H:i:s");

        $order=Order::find($order_id);
        $order->accepted_driver_id=$driver_id;
        $order->accepted_state=1;
        $order->accepted_price=$price;
        $order->accepted_time=$accepted_time;
        $order->order_finished_state=0; // 0 means, order is doing now.
        $order->save();
        return "success";
    }

    public function getBids(Request $request){
        $order_id=$request->input('order_id');
        $data=Array();

//        $drivers=DB::table('drivers')->join('order_bids','drivers.id','=','order_bids.driver_id')->where('order_bids.order_id',$order_id)->join('orders','drivers.id','=','orders.accepted_driver_id')->orderBy('rate','desc')->where('orders.order_finished_state',1)->whereNotNull('orders.order_review_mark_from_customer')->select('drivers.*','order_bids.bid_content','order_bids.price','orders.order_title','orders.accepted_price','orders.order_review_mark_from_customer as review_mark','orders.order_review_text_from_customer as review_text','orders.id as order_review_id','orders.customer_id as order_review_customer_id')->get();
        $drivers=DB::table('drivers')->join('order_bids','drivers.id','=','order_bids.driver_id')->where('order_bids.order_id',$order_id)->orderBy('drivers.rate','desc')->select('drivers.*','order_bids.bid_content','order_bids.price')->get();

        $i=0;
        foreach ($drivers as $driver){
            $user=User::find($driver->user_id);
            $data[$i]['driver']['id']=$driver->id;
            $data[$i]['driver']['name']=$user->full_name;
            $data[$i]['driver']['user_id']=$driver->user_id;
            $data[$i]['driver']['rate']=$driver->rate;
            $data[$i]['driver']['earned']=$driver->earned;
            $data[$i]['driver']['bid_content']=$driver->bid_content;
            $data[$i]['driver']['price']=$driver->price;
            $data[$i]['driver']['phone_number']=$user->phonenum;
            $data[$i]['driver']['review']=$this->getDriverReview($driver->id);
            $i++;
        }
        return $data;
    }

    public function getDriversAround(){
        $user=Auth::user();
        $customer=$user->customer;
        $lat=$customer->lat;
        $lng=$customer->lng;
        $data=Array();
        $drivers=Driver::where(DB::raw('SQRT(POWER(lat-'.$lat.',2)+POWER(lng-'.$lng.',2))'),'<=',0.01)->where([['user_id','!=',$user->id],['state','=','active']])->get();
        $i=0;
        foreach ($drivers as $driver){
            $user=$driver->user;
            $data[$i]['driver_id']=$driver->id;
            $data[$i]['rate']=$driver->rate;
            $data[$i]['earned']=$driver->earned;
            $data[$i]['lat']=$driver->lat;
            $data[$i]['lng']=$driver->lng;
            $data[$i]['phone_number']=$user->phonenum;
            $data[$i]['review']=$this->getDriverReview($driver->id);
            $i++;
        }
        return $data;
    }

    public function getDriverReview($driver_id){
        $data=Array();
        $last_orders=Order::where([['order_finished_state','=',1],['accepted_driver_id','=',$driver_id]])->whereNotNull('order_review_mark_from_customer')->get();
        $j=0;
        foreach ($last_orders as $last_order){
            $data[$j]['order_id']=$last_order->id;
            $data[$j]['customer_id']=$last_order->customer_id;
            $customer=Customer::find($last_order->customer_id)->user;
            $data[$j]['customer_name']=$customer->full_name;
            $data[$j]['customer_profile_pic']=url("http://remittyllc.com/public/uploads/$customer->avatar");
            $data[$j]['price']=$last_order->accepted_price;
            $data[$j]['order_title']=$last_order->order_title;
            $data[$j]['mark']=$last_order->order_review_mark_from_customer;
            $data[$j]['text']=$last_order->order_review_text_from_customer;
            $j++;
        }
        return $data;
    }

    public function trackDriver(Request $request){
        $driver_id=$request->input('driver_id');
        $driver=Driver::find($driver_id);
        $data=Array();
        $data['lat']=$driver->lat;
        $data['lng']=$driver->lng;
        $data['phone_number']=$driver->user->phonenum;
        $data['earned']=$driver->earned;
        $data['rate']=$driver->rate;
        $data['review']=$this->getDriverReview($driver->id);
        return $data;
    }


}
