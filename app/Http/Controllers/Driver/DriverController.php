<?php

namespace App\Http\Controllers\Driver;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\Order\Order;
use App\Model\Order\OrderBid;
use App\Model\Customer\Customer;

class DriverController extends Controller
{
    public function updateLocation(Request $request){
        $user=Auth::user();
        $driver=$user->driver;
        $lat=$request->input('lat');
        $lng=$request->input('lng');
        $driver->lat=$lat;
        $driver->lng=$lng;
        $driver->save();
        return "success";
    }

    public function BidToOrder(Request $request){
        $order_id=$request->input('order_id');
        $driver_id=$request->input('driver_id');
        $price=$request->input('price');
        $bid_content=$request->input('bid_content');

        $temp=OrderBid::find($order_id);
        if (!$temp)
            $order_bid=new OrderBid;
        else
            $order_bid=$temp;
        $order_bid->order_id=$order_id;
        $order_bid->driver_id=$driver_id;
        $order_bid->price=$price;
        $order_bid->bid_content=$bid_content;
        $order_bid->save();
        return "success";
    }

    public function trackCustomer(Request $request){
        $customer_id=$request->input('customer_id');
        $customer=Customer::find($customer_id);
        $user=$customer->user;
        $data=Array();
        $data['phone_number']=$user->phonenum;
        $data['lat']=$customer->lat;
        $data['lng']=$customer->lng;
        $data['sent']=$customer->sent;
        $data['rate']=$customer->rate;
        $data['name']=$user->full_name;
        $data['profile_picture']=url("http://remittyllc.com/public/uploads/$user->avatar");
        return $data;
    }


}
