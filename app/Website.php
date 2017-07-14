<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
     public function coupons()
    {
        return $this->hasMany('App\Coupon');
    }
}
