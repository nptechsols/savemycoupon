<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Coupon;
use App\Website;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Mail;

class CouponController extends Controller {

	public function __construct()
    {
        $this->middleware('auth', ['only' => ['index', 'create','store','show','edit','update','destroy']]);
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$current_user = Auth::user();

		$coupons = $current_user->coupons()->orderBy('expiry_date', 'asc')->paginate(16);

		return view('coupons.index', compact('coupons'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$items = Website::all('id','website','logo');
		return view('coupons.create',compact('items'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
	        'coupon_code' => 'required|max:255',
	        'website' => 'required',
    	]);

		$coupon = new Coupon();

		$coupon->coupon_code = $request->input("coupon_code");
        $coupon->website_id = $request->input("website");
        $coupon->description = $request->input("description");
        $coupon->user_id = $request->input("user_id");

        if($request->input("expiry_date") != null)
        	$coupon->expiry_date =  date("Y-m-d", strtotime($request->input("expiry_date")));
      

		$coupon->save();

		return redirect()->route('coupons.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$coupon = Coupon::findOrFail($id);

		return view('coupons.show', compact('coupon'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$coupon = Coupon::findOrFail($id);

		$items = Website::all('id','website');

		return view('coupons.edit', compact('coupon','items'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$coupon = Coupon::findOrFail($id);

		$coupon->coupon_code = $request->input("coupon_code");
        $coupon->website_id = $request->input("website");
        $coupon->description = $request->input("description");

        if($request->input("expiry_date") != null)
        $coupon->expiry_date = date("Y-m-d", strtotime($request->input("expiry_date")));

		$coupon->save();

		return redirect()->route('coupons.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$coupon = Coupon::findOrFail($id);
		$coupon->delete();


		return redirect()->route('coupons.index')->with('message', 'Item deleted successfully.');
	}

}
