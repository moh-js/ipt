<?php

namespace App\Http\Controllers\Super;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentsController extends Controller
{
    public function __construct()
    {
    	$this->middleware(['auth', 'role:supervisor']);
    }

    public function students($value='')
    {
    	# code...
    }
}
