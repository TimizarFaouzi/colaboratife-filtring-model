<?php

namespace App\Http\Controllers;

use App\Models\Icons;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Marker;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class IconsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Icons=Icons::all();
        return view('formIcons',['list'=>$Icons]);
    }
    public function seach(Request $request)
    {  // $search = $request->term;
      
      //  $result = Marker::where('tetle', 'LIKE', '%'. $search. '%')->get();
        $search = $request->get('term');
      
        $result = User::select('name')->where('name', 'LIKE', '%'. $search. '%')->get();

         return response()->json($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIconsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIconsRequest $request)
    {
        //
        dd("wdj");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Icons  $icons
     * @return \Illuminate\Http\Response
     */
    public function show(Icons $icons)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Icons  $icons
     * @return \Illuminate\Http\Response
     */
    public function edit(Icons $icons)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIconsRequest  $request
     * @param  \App\Models\Icons  $icons
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIconsRequest $request, Icons $icons)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Icons  $icons
     * @return \Illuminate\Http\Response
     */
    public function destroy(Icons $icons)
    {
        //
    }
    
    public function saveicons(Request $request)
    {
      // dd($request->file);
        //$imageName = time().'.'.$request->file->extension();
        $imageName =$request->file;
       // $request->file->storeAs('icons', $imageName);
        $save = new Icons;
        $save->name = "icons/".$imageName;
        $save->icon ="icons/".$imageName;
 
        $save->save();
  return view('formIcons');
 
    }
}
