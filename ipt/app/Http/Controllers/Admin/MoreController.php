<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Igaster\LaravelCities\Geo;
use App\Arrival;
use DB;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class MoreController extends Controller
{
    public function __construct()
    {
    	$this->middleware(['auth', 'role:admin']);
    }

    public function arrival()
    {
    	return view('admin.more.arrival');
    }

    public function arrivalData($id)
    {	
        $id = str_replace('_', '/', $id);

        $arrival = Arrival::doesntHave('assigned')->orderBy('region', 'asc')->get();
        
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

        // Get department of Specific Region
        $department = $arrival->map(function ($value) {
            $value = collect($value);
            return $value->get('department');
        })->toArray();

        $department = array_count_values($department);


        $collection[] = $arrival;
        $collection[] = $id;
        $collection[] = $department;

        return $collection;
    }
}
