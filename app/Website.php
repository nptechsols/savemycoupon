<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{

	protected  $fillable = ['website','logo'];

	
     public function coupons()
    {
        return $this->hasMany('App\Coupon');
    }
}
