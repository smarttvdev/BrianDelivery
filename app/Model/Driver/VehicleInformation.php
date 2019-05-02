<?php

namespace App\Model\Driver;

use Illuminate\Database\Eloquent\Model;

class VehicleInformation extends Model
{
    public function driver(){
        return $this->belongsTo('App\Model\Driver\Driver');
    }

}
