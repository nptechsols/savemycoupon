<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public function website()
	{
    	return $this->belongsTo('App\Website');
	}
}
