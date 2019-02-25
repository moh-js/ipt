<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Location;
use App\Arrival;

class StudentLocController extends Controller
{
	public function __construct()
	{
		$this->middleware(['auth', 'role:student']);
	}
	
    public function index()
    {
    	$dep = Auth::user()->department;
    	$loc = Location::all()->where('dep', $dep);
    	return view('student.location.index', ['loc' => $loc]);
    }

    public function request($id)
    {
    	$location = Location::find($id);

    	if($location->remain)
    	{
    		$is_request = Arrival::all()->where('user_id', Auth::id());

    		if(!count($is_request)){

	    		$arrival = new Arrival;

		    	$arrival->industry_name = $location->name;
		    	$arrival->user_id 		= Auth::id();
		    	$arrival->region 		= $location->region;
		    	$arrival->district 		= $location->district;
		        $arrival->phone         = Auth::user()->phone;
		    	$arrival->phone_super 	= '043021023';
                $arrival->location      = $location->location;
		    	$arrival->department 	= Auth::user()->department;
		    	$arrival->placement 	= 1;
		    	$arrival->placement_id 	= $location->id;


		    	$arrival->save();

		    	$location->remain--;
		    	$location->update();

		    	toastr()->success('Request has been sent successfully,');
	    		return back();
	    		
    		}else{

    			toastr()->success('You can not send request while you have already submitted arrival note or another request');
	    		return back();

    		}

    	}
    }

    public function change()
    {
    	$arrival 	= Arrival::all()->where('user_id', Auth::id())->first();

    	$placement 	    = $arrival->placement;
    	$industry  	    = $arrival->industry_name;
    	$region 	    = $arrival->region;
    	$placement_id 	= $arrival->placement_id;

    	if($placement){	

    		$location = Location::all()->where('id', $placement_id)->first();

    		$location->remain++;
    		$location->update();

    	}

    	$arrival->delete();
    	toastr()->success('Your Arrival information has been successfully removed');
	    return back();
    }
}
