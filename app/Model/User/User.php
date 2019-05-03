<?php

namespace App\Model\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    protected $guard = 'user';
    use HasApiTokens,Notifiable;
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function driver()
    {
        return $this->hasOne('App\Model\Driver\Driver');
    }

    public function customer()
    {
        return $this->hasOne('App\Model\Customer\Customer');
    }

    public function getFullNameAttribute() {
        return ucfirst($this->firstname) . ' ' . ucfirst($this->lastname);
    }

//    public function getFirstNameAttribute() {
//        return ucfirst($this->firstname);
//    }
//
//    public function getLastNameAttribute() {
//        return ucfirst($this->lastname);
//    }



}
