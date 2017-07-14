<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Website;
use Illuminate\Http\Request;


use Storage;
use File;
use DateTime;
class WebsiteController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$websites = Website::orderBy('id', 'desc')->paginate(10);

		return view('websites.index', compact('websites'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('websites.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$website = new Website();

		$website->website = $request->input("website");

		// Profile Pic storage
		$file = $request->file('logo');
		$extension = $file->getClientOriginalExtension();
		Storage::disk('public')->put($website->code.'.'.$extension,  File::get($file));

		$website->logo = $website->code.'.'.$extension;

		$website->save();

		return redirect()->route('websites.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$website = Website::findOrFail($id);

		$storagePath  = Storage::url($website->logo);

		return view('websites.show', compact('website'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$website = Website::findOrFail($id);

		return view('websites.edit', compact('website'));
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
		$website = Website::findOrFail($id);

		$website->website = $request->input("website");

		// Logo Pic storage
		if ($request->file('logo')) {
			$file = $request->file('logo');
			$extension = $file->getClientOriginalExtension();
			Storage::disk('public')->put($website->code.'.'.$extension,  File::get($file));

			$website->logo = $website->code.'.'.$extension;
		}

		$website->save();

		return redirect()->route('websites.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$website = Website::findOrFail($id);
		$website->delete();

		return redirect()->route('websites.index')->with('message', 'Item deleted successfully.');
	}

}
