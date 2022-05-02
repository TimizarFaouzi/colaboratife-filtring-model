<?php

namespace App\Http\Controllers;

use App\Models\Marker;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use File;
class AjaxUploadController extends Controller
{
    function index()
    {
     return view('ajax_upload');
    }

    function action(Request $request)
    { $validator = Validator::make($request->all(),[
            
        'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'tetle' => ['required', 'string', 'max:255'],
       'lat' =>  'required|numeric',
       'lng' =>  'required|numeric',
   ]);

  
   if(!$validator->passes()){
    return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
}else{  
        //return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
      $image = $request->file('file');
      $new_name = rand() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('public/marker'), $new_name);
             $id=$request->marker_id;
            
            $markers = Marker::find($id);
            if ($markers) {
                
                $markers->user_id = $request->user_id;
                $markers->wilaya_id = $request->wilaya_id;
                $markers->commine_id = $request->commine_id;
                $markers->type_id = $request->type_id;
                $markers->tetle = $request->tetle;
                $markers->lat = $request->lat;
                $markers->lng = $request->lng;
                if ($request->file('file')) {
                     $markers->image = $new_name;
                     $image_path = "public/marker/".$request->last_img;
                     if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }
                
                $markers->update();
                  
      return response()->json([
        'message'   => 'Image Upload Successfully',
        'uploaded_image' => '<img src="/public/marker/'.$new_name.'" class="img-thumbnail" width="300" />',
        'class_name'  => 'alert-success'
       ]);
            }
     }
    }
    function store(Request $request){
        $validator = Validator::make($request->all(),[
                
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tetle' => ['required', 'string', 'max:255'],
           'lat' =>  'required|numeric',
           'lng' =>  'required|numeric',
       ]);
    
      
       if(!$validator->passes()){
        return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
    }else{$image = $request->file('file');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('public/marker'), $new_name);
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
        $markers->image = $new_name;
        $marker->action="active"; //active ou désactive
            
        $marker->nb_visited=0; //active ou désactive
        
        $marker->save();
       // return view('POI.addPoi');
        return response()->json(['success'=>'Successfully']);

    }
            
  }
  function Updat(Request $request){
    $validator = Validator::make($request->all(),[
            
        //'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'tetle' => ['required', 'string', 'max:255'],
       'lat' =>  'required|numeric',
       'lng' =>  'required|numeric',
   ]);

  
   if(!$validator->passes()){
    return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
}else{
             $id=$request->marker_id;
            
            $markers = Marker::find($id);
            if ($markers) {
                
                $markers->user_id = $request->user_id;
                $markers->wilaya_id = $request->wilaya_id;
                $markers->commine_id = $request->commine_id;
                $markers->type_id = $request->type_id;
                $markers->tetle = $request->tetle;
                $markers->lat = $request->lat;
                $markers->lng = $request->lng;
                if ($request->file('file')) {
                    $validatorimg = Validator::make($request->all(),[
                        'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                     ]);
                   if(!$validatorimg->passes()){
                    return response()->json(['status'=>0, 'error'=>$validatorimg->errors()->toArray()]);
                }else{
                    

                   //return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
                   $image = $request->file('file');
                   $new_name = rand() . '.' . $image->getClientOriginalExtension();
                   $image->move(public_path('public/marker'), $new_name);
                     $markers->image = $new_name;
                     $image_path = "public/marker/".$request->last_img;
                     if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }
                }
                $markers->update();
                  
                return response()->json([
                     'message'   => 'Image Upload Successfully',
                     'uploaded_image' => '<img src="/public/marker/'.$new_name.'" class="img-thumbnail" width="300" />',
                     'class_name'  => 'alert-success'
               ]);
            }
        }
    }
}
?>
