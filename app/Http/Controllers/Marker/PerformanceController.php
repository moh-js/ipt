<?php

namespace App\Http\Controllers\Marker;

use App\Exports\ResultsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Result;

class PerformanceController extends Controller
{
    public function __construct()
	{
		$this->middleware(['auth', 'role:marker']);
	}

	public function listStudent()
	{
		$getData = Result::all();

		foreach ($getData as $key => $data) {
			if ($data->user->department == Auth::user()->department) {
				$result[] = $data;
			}
		}
		return view('marker.performance', ['result' => $result]);
	}

	public function excel() 
	{
	    return Excel::download(new ResultsExport, Auth::user()->department.'_result.xlsx');
	}

	public function pdf() 
	{
	    return Excel::download(new ResultsExport, Auth::user()->department.'_result.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
	}
}
