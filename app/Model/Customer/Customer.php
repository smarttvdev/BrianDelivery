<?php

namespace App\Model\Customer;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Model\User\User');
    }
}
