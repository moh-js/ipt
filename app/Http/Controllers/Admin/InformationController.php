<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Info;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $news = Info::orderBy('id', 'desc')->get();
        return view('admin.info.index', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.info.create');
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

                'title'         => 'required|max:50',
                'attachment'    => 'size:1020',
                'description'   => 'required|max:200',

            ]);

        $info = new Info;

        $info->title        = $request->title;
        $info->description  = $request->description;
        $info->user_id       = Auth::user()->id;
        
        if($request->hasFile('attach')){

            $name    = $request->file('attach')->getClientOriginalName();
            $ext = $request->attach->extension();
            $file = $name.rand(1, 9999).'.'.$ext;
            $request->attach->storeAs('public/attach', $file);

            $info->attachment = $file;  
        }

        $info->save();

        
        return redirect()->route('info.index');
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
        $news = Info::find($id);

        return view('admin.info.edit', [
            'news' => $news,
        ]);
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
        $this->validate($request, [

                'title'         => 'required|max:50',
                'attachment'    => 'size:1020',
                'description'   => 'required|max:200',

            ]);

        $info = Info::find($id);

        $info->title        = $request->title;
        $info->description  = $request->description;
        $info->user_id      = Auth::user()->id;
        
        if($request->hasFile('attach')){

            if(isset($info->attachment))
            {
                // deleting old Attachment
                Storage::delete('public/attach/'.$info->attachment);
            }

            $name    = $request->file('attach')->getClientOriginalName();
            $ext = $request->attach->extension();
            $file = $name.rand(1, 9999).'.'.$ext;
            $request->attach->storeAs('public/attach', $file);

            $info->attachment = $file;  
        }

        $info->save();

        
        return redirect()->route('info.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = Info::find($id);

        if(isset($news->attachment))
        {
            // deleting old Attachment
            Storage::delete('public/attach/'.$news->attachment);
        }

        $news->delete();

        toastr()->success('News deleted successfully');
        return back();
    }
}
