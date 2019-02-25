<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Info;

class NewsController extends Controller
{
	public function __construct()
	{
		$this->middleware(['auth', 'role:student']);
	}
	
    public function index()
    {
    	$news = Info::orderBy('id', 'desc')->get();
    	return view('student.news.index', [
    		'news' => $news,
    	]);
    }

    public function read($id)
    {
    	$news = Info::find($id);

    	// Get ID of a news whose autoincremented ID is less than the current news, but because some entries might have been deleted we need to get the max available ID of all entries whose ID is less than current news
		$prevNewsId = Info::all()->where('id', '<', $news->id)->max('id');
		 
		// Same for the next news id as previous news but in the other direction
		$nextNewsId = Info::all()->where('id', '>', $news->id)->min('id');

    	return view('student.news.read', [
    		'news' => $news,
    		'next' => $nextNewsId,
    		'prev' => $prevNewsId,
    	]);
    }
}
