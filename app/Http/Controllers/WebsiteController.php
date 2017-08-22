<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Website;
use Illuminate\Http\Request;


use Storage;
use File;
use DateTime;
class WebsiteController extends Controller {

	public function __construct()
    {
        $this->middleware('auth', ['only' => [ 'create','edit','update','destroy']]);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$websites = Website::orderBy('id', 'desc')->paginate(10);

		// var_dump(storage_path());
		return view('websites.index', compact('websites'));
	}

	public function autoComplete(Request $request) {
        $query = $request->get('term','');
        
        $websites=Website::where('website','LIKE','%'.$query.'%')->get();
        
        $data=array();
        foreach ($websites as $website) {
                $data[]=array('value'=>$website->website,'id'=>$website->id);
        }
        if(count($data))
             return $data;
        else
            return ['value'=>'No Result Found','id'=>''];
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

		$this->validate($request, [
	        'logo' => 'required | mimes:jpeg,jpg,png | max:1000',
	        // 'file_upload' => 'mimes:doc,pdf,docx', 
	        'website' => 'required|unique:websites',
    	]);
		$website = new Website();

		$website->website = $request->input("website");

		// Profile Pic storage
		$file = $request->file('logo');
		$extension = $file->getClientOriginalName();
		Storage::disk('public')->put($extension,  File::get($file->getRealPath()));

		$website->logo = $extension;


		// // File_upload storage
		// $file1 = $request->file('file_upload');
		// $extension = $file1->getClientOriginalName();
		// Storage::disk('public')->put($extension,  File::get($file1->getRealPath()));

		// $website->file_upload = $extension;

		// $website->file_upload = $extension;


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

		// $storagePath1  = Storage::url($website->file_upload);

		return view('websites.show', compact('website','storagePath'));
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


		/*
			$website = new Website();

		$website->website = $request->input("website");

		// Profile Pic storage
		$file = $request->file('logo');
		$extension = $file->getClientOriginalName();
		Storage::disk('public')->put($extension,  File::get($file->getRealPath()));

		$website->logo = $extension;

		*/

		// Logo Pic storage
		if ($request->file('logo')) {
			$file = $request->file('logo');
			$extension = $file->getClientOriginalExtension();
			$img = Storage::disk('public')->put($extension,  File::get($file));

			$website->logo = $extension;

			// $website->file_upload = $extension;
		}

		// // File_upload storage
		// if ($request->file('file_upload')) {
		// 	$file1 = $request->file('file_upload');
		// 	$extension = $file1->getClientOriginalExtension();
		// 	Storage::disk('public')->put($extension,  File::get($file1));

		// 	$website->file_upload = $extension;

			
		// }

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

		File::delete(storage_path()."/app/public/".$website->logo);

	    $website->delete();

	    return redirect()->route('websites.index')->with('message', 'Item deleted successfully.');
	}

}
