<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use Igaster\LaravelCities\Geo;
use App\Http\Controllers\Controller;
use Auth;
use App\Arrival;
use App\User;

class SubmissionController extends Controller
{
	public function __construct()
	{
		$this->middleware(['auth', 'role:student']);
	}
	
    public function arrival()
    {	

        // Get the arrival data of the logged in user
        $user      = User::find(Auth::id())->arrival;

    	return view('student.submission.arrival_info', [
    		
    		'user' => $user

    	]);
    }

    public function Regions()
    {
        // get all the region of TZ
        $geo = Geo::getCountry('TZ'); 
        $children    = $geo->getChildren();
        return $children;
    }

    public function District($id)
    {
        $district =  Geo::level(Geo::LEVEL_2)->where('parent_id',$id)->get();
        return $district;
    }

    public function arrival_store(Request $request)		
    {
    	$this->validate($request, [

    		'industry' 	  => ['required'],
    		'phone' 	  => ['required','numeric','min:9'],
            'region'      => ['required'],
            'district'    => ['required'],
    		'phone_super' => ['required','numeric','min:9'],

    	]);

    	$arrival  = new Arrival;
        $geo      = Geo::find($request->region);

    	$arrival->industry_name = $request->industry;
    	$arrival->user_id 		= Auth::id();
    	$arrival->region 		= $geo->name;
    	$arrival->district 		= $request->district;
        $arrival->phone         = $request->phone;
    	$arrival->phone_super 	= $request->phone_super;
        $arrival->location      = $request->location;
        $arrival->department    = Auth::user()->department;
        $arrival->placement_id  = 0;
    	$arrival->placement 	= 0;


    	$arrival->save();
    	toastr()->success('Information has been sent successfully');
    	return back();
    	
    }
}
