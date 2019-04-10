<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    public function showCustomer(){
        $menu_level1='customer';
        $menu_level2='';
        return view('customer',compact('menu_level1','menu_level2'));
    }

    public function getCustomers(){
        $result=Array();
        $customers=Customer::all();
        $i=0;
        foreach ($customers as $customer){
            $result[$i]['name']=$customer->name;
            $result[$i]['ID']=$customer->id;
            $i++;
        }
        return response($result)->withHeaders([
            'Content-Type' => 'application/json',
        ]);
    }

    public function insertCustomer(Request $request){
        $item=$request->all();
        $customer_name=$item['name'];
        $temps=Customer::where('name',$customer_name)->get();
        if (!$temps->first()){
            $customer=new Customer;
            $customer->name=$customer_name;
            $customer->save();
            $item['ID']=$customer->id;
            return response($item)->withHeaders([
                'Content-Type' => 'application/json',
            ]);
        }
        return "non";
    }

    public function updateCustomer(Request $request){
        $item=$request->all();
        $id=$item['ID'];
        $customer_name=$item['name'];
        $customer=Customer::find($id);
        if ($customer){
            $customer->name=$customer_name;
            $customer->save();
            $item['ID']=$customer->id;
            return response($item)->withHeaders([
                'Content-Type' => 'application/json',
            ]);
        }
    }

    public function deleteCustomer(Request $request){
        $item=$request->all();
        $id=$item['ID'];

        $customer=Customer::find($id);
        if ($customer){
            $customer->delete();
        }
    }




}
