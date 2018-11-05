<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	public function user(){
		return $this->belongsTo('App\User');
	}
	public function category(){
		return $this->belongsTo('App\Category');
	}
	public function unit(){
		return $this->belongsTo('App\Unit');
	}
	public function cart(){
		return $this->hasOne('App\Cart');
	}
}
