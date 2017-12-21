<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Mail;
use Auth;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function user_redirect(){

        $user = Auth::user();

        // \Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {
        //     $m->from('reminder@savemycoupon.com', 'Save My Coupon');

        //     $m->to("nptechsols@gmail.com", $user->name)->subject('Following coupons are expiring this week.');
        // });

        Session::put('role_id', $user->role_id);

        if (session()->get('role_id')==2) {
            return redirect()->intended('/coupons');
        }else{
            return redirect()->intended('/websites');
        }
    }
}
