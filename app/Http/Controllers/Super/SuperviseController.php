<?php

namespace App\Http\Controllers\Super;

use Illuminate\Http\Request;
use App\Result;
use Auth;
use App\User;
use Illuminate\Support\Facades\Storage;
use App\SuperHasStudent;
use App\Http\Controllers\Controller;

class SuperviseController extends Controller
{
    public function studentList()
    {
       $getData = SuperHasStudent::all()->where('super_id', Auth::id());

       foreach ($getData as $data) {
           $result = Result::where('user_id', $data->students->user_id)->first();

           if (!isset($result)) {
               $students[] = $data;
           }
       }if (!isset($students)) {
           $students = array();
       }

       return view('super.students', [
            'students' => $students,
       ]);
    }

    public function viewPage($id)
    {
        $student = User::role('student')->where('userId', $id)->first();
        return view('super.supervise', ['student' => $student]);
    }

    public function mark(Request $request, $id)
    {
        $this->validate($request, [
            'indu_marks' => ['required', 'integer', 'max:100'],
            'uni_marks'  => ['required', 'integer', 'max:100'],
            'indu_file' => ['required', 'file', 'max:1000', 'mimes:pdf'],
            'uni_file'  => ['required', 'file', 'max:1000', 'mimes:pdf'],
        ]);

        $result = new Result;
        $student = User::role('student')->where('userId', $id)->first();

        if ($request->has('indu_file')) {
            $ext  = $request->indu_file->extension();
            $indu_file = date('YmdHisv').rand(1,100).'.'.$ext;
            $request->indu_file->storeAs('public/supervisor/industrial', $indu_file);
        }

        if ($request->has('uni_file')) {
            $ext  = $request->uni_file->extension();
            $uni_file = date('YmdHisv').rand(1,100).'.'.$ext;
            $request->uni_file->storeAs('public/supervisor/university', $uni_file);
        }

        $result->user_id = $student->id;
        $result->uni_super_marks = $request->uni_marks;
        $result->indu_super_marks = $request->indu_marks;
        $result->indu_file = $indu_file;
        $result->uni_file = $uni_file;
        $result->uni_file = $uni_file;
        $result->marker = '0';
        $result->logbook_marks = '0';
        $result->total = $request->uni_marks + $request->indu_marks;
        $result->supervisor = title_case(Auth::user()->name);

        $result->save();
        
        return redirect()->route('super.student_list');
    }

   
}
