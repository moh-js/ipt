<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Logbook;
use Auth;
use App\User;
use App\Http\Controllers\Controller;

class LogbookController extends Controller
{

	public function __construct()
	{
		$this->middleware(['auth', 'role:student']);
	}

    public function index()
    {	
    	$student_logbook = Logbook::all()->where('user_id', Auth::id())->first();
    	return view('student/submission/logbook&report', ['log' => $student_logbook]);
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'logbook' => 'mimes:pdf|required|max:3060',
    		'report'  => 'mimes:pdf|required|max:3060',
    	]);

    	// Query data to check
    	$logbook = Logbook::all()->where('user_id', Auth::id())->first();


    	if(isset($logbook)){

    		if ($logbook->confirm) {
    			// you cannot upload
    			toastr()->error('You cannot upload because you have already confimed');
				return back();
    		}else{
    				// Get previous logbook and report
	    			$logbook_file 	= $logbook->logbook;
	    			$report_file 	= $logbook->report;

	    		if ($request->hasFile('logbook')) {
		    		$name 	 = $request->file('logbook')->getClientOriginalName();
		    		$file 	 = $name;
		    	
		    		$request->logbook->storeAs('public/logbooks', $file);
		    		
		    		// deleting old logbook
					Storage::delete('public/logbooks/'.$logbook_file);
		    		$status1 = 1;
		    	}

		    	if ($request->hasFile('report')) {
		    		$name 	 = $request->file('report')->getClientOriginalName();
		    		$file1 	 = $name;
		    		
		    		$request->report->storeAs('public/reports', $file1);
		    		// deleting old report
					Storage::delete('public/reports/'.$report_file);

		    		$status2 = 1;
		    	}

		    	if($status1 && $status2) {

		    		$logbook->logbook 		= $file;
		    		$logbook->report 		= $file1;
		    		$logbook->confirm 		= 0;

		    		$logbook->save();

		    		toastr()->success('Your Logbook and Report has been successfully updated');
		    		return back();
	    			
	    		}
    		}
    	}

    	else{
		    	if ($request->hasFile('logbook')) {
		    		$name 	 = $request->file('logbook')->getClientOriginalName();
		    		$file 	 = $name;
		    	
		    		$request->logbook->storeAs('public/logbooks', $file);
		    		$status1 = 1;
		    	}

		    	if ($request->hasFile('report')) {
		    		$name 	 = $request->file('report')->getClientOriginalName();
		    		$file1 	 = $name;
		    		
		    		$request->report->storeAs('public/reports', $file1);
		    		$status2 = 1;
		    	}

		    	if($status1 && $status2) {
		    		$log_rep = new Logbook;

		    		$log_rep->user_id 		= Auth::id();
		    		$log_rep->logbook 		= $file;
		    		$log_rep->report 		= $file1;
		    		$log_rep->marked 		= 0;
		    		$log_rep->department 	= Auth::user()->department;
		    		$log_rep->confirm 		= 0;

		    		$log_rep->save();

		    		toastr()->success('Your Logbook and Report has been successfully uploaded');
		    		return back();
		    	}
    		}
    }

    public function confirm($id)
    {
    	$logs = Logbook::find($id);

    	if (!$logs->confirm) {
    		
	    	$logs->confirm = 1;
	    	$logs->save();

	    	toastr()->success('Good work...');
			return back();
    	
    	}else{
    		toastr()->error('You have already confirmed your upload');
			return back();
    	}

    }

    public function removeLogbook()
    {
    	$logbook = Logbook::where('user_id', Auth::id())->first();

    	if(isset($logbook))
    	{

			Storage::delete('public/logbooks/'.$logbook->logbook);
			Storage::delete('public/reports/'.$logbook->report);

    		$logbook->delete();

    		toastr()->success('You have delete successfully');
    		return back();
    	}

    }

    function submissionReport()
    {
    	$user = User::find(Auth::id());

    	return view('student.submission.report', [ 'user' => $user ]);
    }
}
