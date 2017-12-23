<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
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

        Session::put('role_id', $user->role_id);

        if (session()->get('role_id')==2) {
            return redirect()->intended('/coupons');
        }else{
            return redirect()->intended('/websites');
        }
    }
}
