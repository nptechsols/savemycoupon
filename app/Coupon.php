<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{

	// protected $dates = ['expiry_date'];
	public $timestamps = false;

	protected $fillable = ['website_id'];
	
    public function website()
	{
    	return $this->belongsTo('App\Website');
	}

	public function user(){
		return $this->belongsTo('App\User');
	}
}
