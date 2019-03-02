<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $casts=[
        'stop_address'=>'array'
    ];
}
