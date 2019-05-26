<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Igaster\LaravelCities\Geo;
use App\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth', 'role:admin'])->except('api');
    }
    
    public function index()
    {
        $loc = Location::orderBy('id', 'desc')->get();
        return view('admin.location.index', ['loc' => $loc]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.location.add');
    }

    public function getRegions()
    {
        // get all the region of TZ
        $geo = Geo::getCountry('TZ'); 
        $children    = $geo->getChildren();
        
        // get district of all regions in TZ
        // $district =  Geo::level(Geo::LEVEL_2)->get();

        return $children;
    }

    public function getDistrict($id)
    {
        $district =  Geo::level(Geo::LEVEL_2)->where('parent_id',$id)->get();
        return $district;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'name'      => 'required',
            'vac'       => 'required | integer | max:20',
            'dep'       => 'required',
            'district'  => 'required',
            'region'    => 'required',

        ]);

       
        $location = new Location();

        $geo      = Geo::find($request->region);

        $location->region      = $geo->name;
        $location->name        = $request->name;
        $department            = implode(",", $request->dep);
        $location->dep         = $department;
        $location->district    = $request->district;
        $location->vac         = $request->vac;
        $location->remain      = $request->vac;

        $location->save();

        return redirect()->route('location.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = Location::find($id);
        $location->delete();

        toastr()->success('Industrial placement deleted successfully');
        return back();
    }
}
