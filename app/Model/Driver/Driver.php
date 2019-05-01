<?php

namespace App\Model\Driver;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Model\User\User');
    }

    public function vehicleInformation(){
        return $this->hasOne('App\Model\Driver\VehicleInformation','driver_id','user_id');
    }


}
