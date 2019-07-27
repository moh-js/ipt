<?php

namespace App\Http\Controllers\Marker;

use App\Exports\ResultsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Result;

class PerformanceController extends Controller
{
    public function __construct()
	{
		$this->middleware(['auth', 'role:marker']);
	}

	public function listStudent()
	{
		$result = Result::all();
		return view('marker.performance', ['result' => $result]);
	}

	public function excel() 
	{
	    return Excel::download(new ResultsExport, 'result.xlsx');
	}

	public function pdf() 
	{
	    // return Excel::download(new ResultsExport, 'invoices.xlsx', \Maatwebsite\Excel\Excel::DOMPDF);
	}
}
