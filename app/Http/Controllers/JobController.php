<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class JobController extends Controller
{
    public function create(){
        $menu_level1='create_job';
        $menu_level2='';
        return view('job.create',compact('menu_level1','menu_level2'));


    }





}
