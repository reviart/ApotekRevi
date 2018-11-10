<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user(){
		return $this->belongsTo('App\User');
	}
	public function customer(){
		return $this->belongsTo('App\Customer');
	}
	public function order_details(){
        return $this->hasMany('App\OrderDetail');
    }
}
