<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$coupons = Coupon::orderBy('expiry_date', 'asc')->paginate(10);

		return view('coupons.index', compact('coupons'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('coupons.create');
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
	        'description' => 'required',
	        'expiry_date' => 'required',
    	]);

		$coupon = new Coupon();

		$coupon->coupon_code = $request->input("coupon_code");
        $coupon->website = $request->input("website");
        $coupon->description = $request->input("description");
        $coupon->expiry_date = date("Y-m-d", strtotime($request->input("expiry_date")));
        // $employee->date_of_brith = date("Y-m-d", strtotime($request->input("date_of_brith")));

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

		return view('coupons.edit', compact('coupon'));
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
        $coupon->website = $request->input("website");
        $coupon->description = $request->input("description");
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
