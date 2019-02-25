<?php

namespace App\Http\Controllers\Marker;

use Illuminate\Http\Request;
use App\Logbook;
use DB;
use Auth;
use Spatie\QueryBuilder\QueryBuilder;
use App\Result;
use Response;
use App\Http\Controllers\Controller;

class LogbookController extends Controller
{

	public function __construct()
	{
		$this->middleware(['auth', 'role:marker']);
	}

	// View all student Logbooks
    public function logbook()
    {
    	$dep = Auth::user()->department;
    	$logbook = Logbook::all()->where('department', $dep)->where('marked', 0);

    	return view('marker.logbook', ['logbook' => $logbook]);
    }

    // Mark specific student
    public function markStudent($id)
    {	
    	$logbook = Logbook::all()->where('user_id', $id)->first();

    	return view('marker.mark_student', ['logbook' => $logbook]);
    }

    // Open student report file
    public function openReport($id)
    {
    	$name = Logbook::all()->where('user_id', $id)->first();

    	$filename = $name->report;
		$path = storage_path('app/public/reports/'.$filename);

		if(file_exists($path))
		{

			return Response::make(file_get_contents($path), 200, [
			    'Content-Type' => 'application/pdf',
			    'Content-Disposition' => 'inline; filename="'.$filename.'"'
			]);

		}else{

			toastr()->error('File not found');
			return back();
		}
    }

   // Open student Logbook file
    public function openLogbook($id)
    {
    	$name = Logbook::all()->where('user_id', $id)->first();

    	$filename = $name->logbook;
		$path = storage_path('app/public/logbooks/'.$filename);
		
		if(file_exists($path))
		{

			return Response::make(file_get_contents($path), 200, [
			    'Content-Type' => 'application/pdf',
			    'Content-Disposition' => 'inline; filename="'.$filename.'"'
			]);

		}else{

			abort(404, 'We could not find the file you where looking for');

		}


    }

    // Store logbook and report marks in the database
    public function store(Request $request, $id)
    {
    	$this->validate($request, ['marks' => 'integer|lte:60']);

    	$result 					= new Result;
    	$result->logbook_marks 		= $request->marks;
    	$result->uni_super_marks	= 0;
    	$result->indu_super_marks 	= 0;
    	$result->supervisor 		= 'George Kitula';
    	$result->total     			= 0;
    	$result->marker 			= Auth::user()->name;
    	$result->user_id 			= $id;

    	$result->save();

    	$name = Logbook::all()->where('user_id', $id)->first();
    	$name->marked = 1;
    	$name->update();

    	return redirect()->route('industrial.mark', $id);
    	
    }
}
