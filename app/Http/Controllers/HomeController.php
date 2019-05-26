<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use DB;
use App\Rules\ValidatePassword;
use App\Info;
use App\Location;
use App\Arrival;
use App\Logbook;
use App\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // get department of authentiacated user
        $dep   = Auth::user()->department;

         // retreive all users who have student role
        $users = User::role('student')->where('department', $dep)->count();
        
        // retreve data
        $infos          = Info::all();
        $adminIndustry  = Location::all();
        $arrival        = Arrival::all();
        $logbook        = Logbook::all()->count();
        $dep_logbook    = Logbook::all()->where('department', $dep)->count();
        $logbook_marked = Logbook::all()->where('department', $dep)->where('marked', 1)->count();
        $locations       = Location::all();

        // cheking if the user is student
        $check = Auth::user()->hasRole('student');
       
        // If is the student retreive the remaining vacancy 
        $placements = array();
        if($check){
            foreach ($locations as $location ) {
                $departments = explode(",", $location->dep);

                foreach ($departments as $department) {
                    if ($department == $dep) {
                        $placements[] = $location;
                    }
                }
            }
            
            if(isset($placements)){

                $remT  = 0;
                $total = 0;

                foreach ($placements as $i) {

                  $remT  = $i->remain + $remT;
                  $total = $i->vac + $total;
                
                }

                $vac = $remT;
                if ($total) {
                $percentage = ($vac / $total) * 100;
                }
                else{ $percentage = 0;}

            }else{
                $vac = 0;
                $percentage = 0;
            }
            
        }else{
            $vac = 0;
            $percentage = 0;
        }
        
        // Checking if the user has login for the first time.
        $user = Auth::user()->flag;
        
        // If true redirect to change password page.
        if (is_null($user)) {

            return view('auth.passwords.changePass');
        }

        //If not redirect to the Home page 
        return view('home', [
            'infos'         => $infos,
            'placements'    => $placements,
            'vac'           => $vac,
            'percentage'    => $percentage,
            'adminIndustry' => $adminIndustry,
            'arrival'       => $arrival,
            'logbook'       => $logbook,
            'users'         => $users,
            'logbook_mark'  => $logbook_marked,
            'dep_logbook'   => $dep_logbook,
        ]);
    }

    
    public function changePassword(Request $request){

        $validator = $request->validate([
            'current_password' => ['required', new ValidatePassword(auth()->user())],
            'password'         => 'required|confirmed|min:6',
        ]);

        
        $user = Auth::user();

        $user->password = bcrypt($request->password);
        $user->flag     = 1;
        $user->update();

        return redirect()->route('home'); 

    }
}
