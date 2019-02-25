<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Igaster\LaravelCities\Geo;
use App\Arrival;
use DB;
use App\Http\Controllers\Controller;

class MoreController extends Controller
{
    public function __construct()
    {
    	$this->middleware(['auth', 'role:admin']);
    }

    public function arrival()
    {
    	$geo 	 = Geo::getCountry('TZ'); 
        $regions = $geo->getChildren();          
            
    	
    	return view('admin.more.arrival', [
    		'regions' => $regions,
    	]);
    }

    public function arrivalData($id)
    {	
    	$geo 	 = Geo::getCountry('TZ'); 
        $regions = $geo->getChildren();

        $arrival = DB::table('arrivals')->orderBy('region', 'asc')->get();
        
        // group by region
        $arrival = $arrival->groupBy('region');
       
       $data = array();
        foreach ($arrival as $key => $value) {
            
            // get a collection of data for each region
            $gt = array_get($arrival, $key);
 
            // sort data by department of the same region
            $gt = $gt->sortBy('industry_name')->toArray();

            // Merge all group of array into one array
            $data = array_merge($data, $gt);            
            
        }

       		$data = collect($data);
        	
        	$arrival = $data->where('region', $id);

        	/* Take all student department and store in one array*/
            $re = array();

            // store department
            foreach ($arrival as $value) {

                $re = array_merge($re, (array)$value->department);

            }

            $re = array_count_values($re);

    	
    	return view('admin.more.arrival', [
    		'regions' => $regions,
    		'arrival' => $arrival,
    		'id' 	  => $id,
    		're' 	  => $re,
    	]);
    }
}
