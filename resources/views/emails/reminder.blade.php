Hello {{ $user->name }},<br/><br/>

The following coupons are expiring tomorrow. Please use them.<br/><br/><br/>

@foreach ($user_coupons as $user_coupon)
  	<b>Coupon :</b> {{ $user_coupon->coupon_code }}<br/>
  	<b>Website :</b> {{ $user_coupon->website->website }}<br/><br/><br/>
@endforeach