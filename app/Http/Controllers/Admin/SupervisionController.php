<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Arrival;
use App\SuperHasStudent;
use DB;

class SupervisionController extends Controller
{
    public function __construct()
    {
    	$this->middleware(['auth', 'role:admin']);
    }

    public function studentList()
    {
    	$arrivals = Arrival::doesntHave('assigned')->get();
    	$arrivals = $arrivals->sortByDesc('created_at'); 
    	return view('admin.supervision.students',[
    		'arrivals' => $arrivals,
    	]);
    }

    public function superList()
    {
        $supers = User::role('supervisor')->doesntHave('super_has_student')->get();
        return view('admin.supervision.supers', [
            'supers' => $supers,
        ]);
    }

    public function assignPage()
    {
        return view('admin.supervision.assign');
    }

    public function assign(Request $request)
    {

        $this->validate($request, [
            'num' => 'integer|required|min:10',
        ]);

        $arrival = Arrival::doesntHave('assigned')->orderBy('region', 'asc')->select('industry_name', 'id', 'region', 'department')->get();

        // group by region
        $arrival = $arrival->groupBy('region');
    
        $addedCount = 0;
        
        foreach ($arrival as $key => $value) {

            // get a collection of data for each region
            $get = array_get($arrival, $key);
 
            // sort data by department of the same region
            $store = $get->sortBy('industry_name')->reverse();

            
            /* Continue to assign student while there is still student who have not being assigned */
            while (count($store)) {

                $poped = NULL;                
            
                for ($i=0; $i < $request->num ; $i++) { 
                    
                    if ($store->isNotEmpty()) {
                        
                        $poped[] = $store->pop();
                                            
                    }
                    else {

                        break;
                    }
                }

                // $students = collect($students);
                $department = array();

                // store department
                foreach ($poped as $dep) {

                    $department = array_merge($department, (array)$dep->department);

                }         
                
                // count the value of department
                $count = array_count_values($department);

                // get the deparment which have highest integer value
                $da = max($count);
                $da = array_search($da, $count);
                
                // Get supervisors 
                $super = User::role('supervisor')->doesntHave('super_has_student')->select('id')->where('department', $da)->get();

                if (!$super->isNotEmpty()) {
                    $super = User::role('supervisor')->doesntHave('super_has_student')->select('id')->get();
                }

                if ($super->isNotEmpty()) {
                    
                    $super = $super->random();

                    // Assign one supervisor to many students
                    foreach ($poped as $no => $pop) {
                        
                        $assign = new SuperHasStudent;
                        $assign->student_id = $pop->id;
                        $assign->super_id   = $super->id;

                        $assign->save();
                        $addedCount++;

                    }

                }
                else {
                    toastr()->success("$addedCount students has been assigned a supervisor successfully");
                    toastr()->error("Insufficient supervisor there are still sudents who have not been assigned a supervisor");
                    return back();
                }

                
            }

        }       

    }



    
}
