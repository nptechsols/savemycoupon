<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{

	// protected $dates = ['expiry_date'];
	public $timestamps = false;
	
    public function website()
	{
    	return $this->belongsTo('App\Website');
	}
}
