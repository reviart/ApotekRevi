<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function customers(){
        return $this->hasMany('App\Customer');
    }
    public function categories(){
        return $this->hasMany('App\Category');
    }
    public function products(){
        return $this->hasMany('App\Product');
    }
    public function orders(){
        return $this->hasMany('App\Order');
    }
}
