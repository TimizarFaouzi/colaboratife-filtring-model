<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Marker;
use App\Models\Historique;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Validator;
use File;
class C_Marker extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return view('markers.Marker');

       $markers = Marker::paginate(5);
       
       $markersss = Marker::all();
       if ($request->ajax()) {
           return view('pagination.pagiresult',compact('markers'));
       }
        
           //dd($lastMarker);
           
         return view('markers.marker',['markers'=>$markers,'lastMarker'=>$markersss]);
        //return view('markers.marker',compact(['markers']));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {$validator = Validator::make($request->all(),[
            
        'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'tetle' => ['required', 'string', 'max:255'],
       'lat' =>  'required|numeric',
       'lng' =>  'required|numeric',
   ]);

  
   if(!$validator->passes()){
    return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
}else{ 
           $imageName = time().'.'.$request->file->extension();
          // "user_id","type_id","wilaya_id","commine_id","tetle","lat","lng","image","moy","commenter","action","nb_visited"

            $request->file->storeAs('marker', $imageName);
            $marker=new Marker;
            $marker->user_id=$request->user_id ; 
            if (isset($request->type_id)) {
            
                $marker->type_id=$request->type_id;
            }
            if (isset($request->wilaya_id)) {
            
                $marker->wilaya_id=$request->wilaya_id ;
            }
            if (isset($request->commine_id)) {
            
                $marker->commine_id=$request->commine_id ;
            }

            $marker->tetle=$request->tetle ;
            $marker->lat=$request->lat ;
            $marker->lng=$request->lng ;
            $marker->image=$imageName; 
            //$marker->image=$request->file->hashName(); 
            $marker->moy=0; 
            $marker->commenter=null;
            $marker->action="active"; //active ou désactive
            
            $marker->nb_visited=0; //active ou désactive
            
            $marker->save();
           
            return response()->json([
                'message'   => 'Image Upload Successfully',
                'uploaded_image' => '<img src="/public/marker/'.$new_name.'" class="img-thumbnail" width="300" />',
                'class_name'  => 'alert-success'
          ]);
       } 
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $poi =Marker::find($id);
        $lastMarker[]=array("tetle"=>$poi->tetle,"lat"=>$poi->lat,"lng"=>$poi->lng,"image"=>$poi->image);
    
       // $poi=Marker::all()->last();
       // dd($poi);
        $markers = Marker::paginate(5);
       if ($request->ajax()) {
           return view('pagination.pagiresult',compact('markers'));
       }
        
           //dd($lastMarker);
           
         return view('markers.marker',['markers'=>$markers,'lastMarker'=>$lastMarker]);
        //return view('markers.marker',compact(['markers']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $marker =Marker::find($id);
        if($marker)
        {
            return response()->json([
                'status'=>200,
                'markers'=> $marker,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No Student Found.'
            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validated=$request->validate([
            'tetle' => ['required', 'string', 'max:255'],
            'lat' =>  'required|numeric',
            'lng' =>  'required|numeric',
        ]);
            $id=$request->marker_id;
            
            $markers = Marker::find($id);
            if($markers)
            {
                $markers->user_id = $request->user_id;
                $markers->wilaya_id = $request->wilaya_id;
                $markers->commine_id = $request->commine_id;
                $markers->type_id = $request->type_id;
                $markers->tetle = $request->tetle;
                $markers->lat = $request->lat;
                $markers->lng = $request->lng;
                if ($request->file<>Null) {
                    
                    $imageName = time().'.'.$request->file->extension();
        
                    $request->file->storeAs('marker', $imageName);
                     $markers->image = $imageName;
                     $image_path = "public/marker/".$request->last_img;
                     if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }else {
                   
                      $markers->image = $request->last_img;
                }
                $markers->update();
               //return redirect('marker');
               
            return response()->json([
                'message'=>'Student Updated Successfully.'
            ]);
            }
            
            return response()->json([
                'message'=>'Student Updated chowi.'
            ]);
        
           // return redirect('marker');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function shwPageOpenstreet()
    {
        return view('openstreet.home');
    }

    public function getOpenstreet()
    {
        $markers = Marker::all();
        return response()->json([
            'markers'=>$markers,
        ]);
    }
    public function Delete(Request $request)
    {   
        $id=$request->idm;
        $markers = Marker::find($id);
        if($markers)
        {   $image_path = "public/marker/".$markers->image;
            if(File::exists($image_path)) {
               File::delete($image_path);
            }
            
            $evo = DB::table('evolations')->where("marker_id","=",$id)->delete();
            $deleted = DB::table('historiques')->where("marker_id","=",$id)->get();
            foreach ($deleted as $deleted) {
                $hist = Historique::find($deleted->id);
                 $hist->delete();

            }
            $markers->delete();
            
        
        } return response()->json([
            'markers'=>$markers,
        ]);
        
    }
     public function lastPoi($id){
        $markers = DB::table('markers')->where("user_id","=",$id)->orderBy('id', 'DESC')->first();
        //dd($last_row);
        if ($markers<>null) {
           
           // dd($marker);
        }else{
            $markers==null;
        }
        return Response()->json([
            'markers'=>$markers,
        ]);
     }

     public function convert(){
        $s = '06/10/2011 19:00:02';
        $date = strtotime($s);// H:i:s
        echo date('Y-m-d', $date);
       // The above one is the one of the example of converting a string to date.
        //echo $s ->format('Y-m-d');
        //The above one is another method 
        echo "Today is " . date("Y/m/d") . "<br>";
echo "Today is " . date("Y.m.d") . "<br>";
echo "Today is " . date("Y-m-d") . "<br>";
echo "Today is " . date("l");
        
     }
}
