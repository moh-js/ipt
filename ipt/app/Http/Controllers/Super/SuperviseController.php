<?php

namespace App\Http\Controllers\Super;

use Illuminate\Http\Request;
use App\Result;
use Auth;
use App\SuperHasStudent;
use App\Http\Controllers\Controller;

class SuperviseController extends Controller
{
    public function studentList()
    {
       $students = SuperHasStudent::all()->where('super_id', Auth::id());
       return view('super.students', [
            'students' => $students,
       ]);
    }

    public function induSuper($id)
    {
    	$result                     = Result::all()->where('user_id', $id)->first();
    	$result->indu_super_marks 	= rand(10,20);

    	$result->update();

    	return redirect()->route('university.mark', $id);
    	
    }

    public function uniSuper($id)
    {
    	$result                  = Result::all()->where('user_id', $id)->first();
    	$result->uni_super_marks = rand(10,20);
    	$result->total           = $result->uni_super_marks + $result->indu_super_marks + $result->logbook_marks;
    	$result->update();

    	return redirect()->route('logbook.mark', $id);
    }
}
