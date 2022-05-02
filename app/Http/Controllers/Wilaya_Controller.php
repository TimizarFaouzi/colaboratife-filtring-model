<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wilay;
use App\Models\Commine;
use App\Models\Marker;
use App\Models\type;
use App\Models\Historique;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Wilaya_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('location.city');
    }

    public function getLOcationCity(){
         $wilaya=Wilay::all();
         $nb_com=array();
         $lable=array();
         $valueW=array();
         foreach ($wilaya as $key => $value) {
             $count=DB::table('commines')->where("wilaya_id","=",$value->code)->count();
             $nb_com[]=array(
                 "id"=>$key,
                 "label"=>$value->name,
                 "value"=>$count,
             );
            //$lable[]=$value->name;
            // $valueW[]=$count;
         }

         foreach ($nb_com as $key => $row) {
            $values[$key]  = $row['value'];
         }

         // ترتيب البيانات حسب الحجم تنازليًا، وحسب الإصدار تصاعديًا
         // إضافة data$ كآخر وسيط للترتيب حسب المفتاح المشترك
         array_multisort($values, SORT_DESC, $nb_com);
        // dd($wilaya, $nb_com);
         return response()->json([
            'wilaya'=>$wilaya,
            'nb_com'=>$nb_com,
         ]);
    }
    public function getLOcationCityThisCode($id){
       // dd($wilaya,$commines);
     $commine=  DB::table('commines')->where("wilaya_id","=",$id)->get();//list commens por this wilaya

     $chartCommen=array();//list  de chart cominse par nomber de POI Toutal

     $prosntageNBCOM=((DB::table('commines')->where("wilaya_id","=",$id)->count())*100)/DB::table('commines')->count();// prosntage  nomber de wilawa par this wilaya $id

     $totoMarkersThisWilaya=DB::table('markers')->where("wilaya_id","=",$id)->count();
     //nomber de wilaya par this wilaya $id

     //star foreach ($commine as $key => $value) foreach de tout Comminse to Wilaya $id
     foreach ($commine as $key => $value) {

         $count=DB::table('markers')->where("commine_id","=",$value->id)->count();// nomber de POI To Wilaya this $id
         //star  if ($count==0 AND $totoMarkersThisWilaya)
         if ($count==0 AND $totoMarkersThisWilaya) {

            $chartCommen[]=array(
                "id"=>$key,// key de  comoinse  rotorni color de prosntage parsoque color c est random 
                "label"=>$value->name,//name de comminse

                "value"=>$count,// number de poi  to this comminse $value ->id

                "prosntage"=>($count*100/$totoMarkersThisWilaya),//prosntage de  de POI to this  commins  par total POI on Wilaya this $id
            );
         }
         //end  if ($count==0 AND $totoMarkersThisWilaya)
        
     } 
        return response()->json([
           'city'=>$commine,//list Cominse  On this Wilaya $id

           'chartCommen'=>$chartCommen,// list  Prosntage to POI ON comminse  to wilaya

           'prosntageNBOM'=>round($prosntageNBCOM,2),// list  Prosntage total de wilaya
        ]);
   }

   public function locationPOIThisjson($id,$user){
       
      
    $message="vide";
      $poi=Marker::where("commine_id","=",$id)->get();
      $pois=array();
      //$thishistoruq=array();
      foreach ($poi as $key => $value) { 
       $thisrating ="";
       $thiscommenter ="";
       $historique=Historique::where("marker_id","=", $value->id)->get();
       $userMarker=User::find($value->user_id);
       $stare =null;
       //dd($user->image);
       $thisHistorique=-1;
       $nb_rating=0;
       foreach ($historique as $keyh => $valueh) {
         if ($valueh->votes<>null OR $valueh->votes<>0 OR $valueh->comm<>null) {
          if ($valueh->votes<>null OR $valueh->votes<>0) {
            $nb_rating++;
            $yes=false;
            $starthisuser="";
            for ( $j = 5; $j > 0; $j-- ) {
             if(($valueh->votes>=$j) &&( $valueh->votes<$j+1)){
               $yes=true;
               if($valueh->votes==$j) {
                 $starthisuser=$starthisuser.'<i class="bi bi-star-fill"></i>';
               }else if($valueh->votes<$j+1){
                 $starthisuser =$starthisuser.'<i class="bi bi-star-half"></i>';
               }
   
             }else{
               if ($yes==false ) {
                 $starthisuser =$starthisuser.'<i class="bi bi-star-fill"></i>';
               }else {
                 $starthisuser =$starthisuser.'<i class="bi bi-star"></i>';
               }
             }
           }
         }
         
         if ($valueh->comm<>null) {
          //$thiscommenter +="";
      }
           
                
            $thisrating =$thisrating.'<a class="ml-2" href="#" rel="'.$valueh->user_id.'">'.'<div class="media w-100">'.'<img src="public/profile/'.$valueh->image.'" class="align-self-center rounded-circle mr-3 ml-2 mb-2"style="width :1cm;heigth:1cm" alt="...">'.
                 '<div class="media-body">'.
                    '<h6 class="mt-2">'.$valueh->name. '<span class=" ml-2">'.$starthisuser.'</span>'.'</h6>'.
                  '</div>'.
                ' </div>'.
          '</a>';
          if ($valueh->user_id==$user) {
            $thisHistorique=$valueh->id;
            
            for ( $j = 5; $j > 0; $j-- ) {
              if(($valueh->votes>=$j) &&( $valueh->votes<$j+1)){
                // bg_vi="bg-vi"
                $stare=$stare.'<input type="radio" name="rating" checked value="'.$j.'"><span class=" star"></span>';
               }else{
                $stare=$stare.'<input type="radio" name="rating" value="'.$j.'"><span class=" star"></span>';
               }

             }
           }
          }
       }
       if ($stare==null) {
        for ( $j = 5; $j > 0; $j-- ) {
         
            $stare=$stare.'<input type="radio" name="rating" value="'.$j.'"><span class=" star"></span>';
          
         }
        }
       //dd($thisrating);
        $pois[]=array(
           "id"=>$value->id,
           "stars"=>$stare,
            "user_id"=>$value->user_id ,
            "userImage"=>$userMarker,
            "type_id"=>$value->type_id ,
            "tetle"=>$value->tetle ,
            "lat"=>$value-> lat,
            "lng"=>$value-> lng,
            "image"=>$value->image ,
            "moy"=>$value->moy ,
            "commenter"=>$value->commenter ,
            "action"=>$value->action ,
            "nb_visited"=>$value-> nb_visited,
            "created_at"=>$value->created_at,
            "historique"=>$historique,
            "rating"=> $thisrating,
            "nb_rating"=>$nb_rating,
            "nb_comm"=>0,
            "thisHistorique"=> $thisHistorique
        );
        $message="plan";
         //break;
      }
       return response()->json([
        'message'=>$message,
        'user'=>$user=User::find($user),
        'city'=>$pois,
     ]);
       //dd($user->name);
   
   }




   
   public function locationPOIThisWilayajson($id,$user){
       
      
    $message="vide";
      $poi=Marker::where("wilaya_id","=",$id)->get();
      $pois=array();
      //$thishistoruq=array();
      foreach ($poi as $key => $value) { 
       $thisrating ="";
       $thiscommenter ="";
       $historique=Historique::where("marker_id","=", $value->id)->get();
       $userMarker=User::find($value->user_id);
       $stare =null;
       //dd($user->image);
       $thisHistorique=-1;
       $nb_rating=0;
       foreach ($historique as $keyh => $valueh) {
         if ($valueh->votes<>null OR $valueh->votes<>0 OR $valueh->comm<>null) {
          if ($valueh->votes<>null OR $valueh->votes<>0) {
            $nb_rating++;
            $yes=false;
            $starthisuser="";
            for ( $j = 5; $j > 0; $j-- ) {
             if(($valueh->votes>=$j) &&( $valueh->votes<$j+1)){
               $yes=true;
               if($valueh->votes==$j) {
                 $starthisuser=$starthisuser.'<i class="bi bi-star-fill"></i>';
               }else if($valueh->votes<$j+1){
                 $starthisuser =$starthisuser.'<i class="bi bi-star-half"></i>';
               }
   
             }else{
               if ($yes==false ) {
                 $starthisuser =$starthisuser.'<i class="bi bi-star-fill"></i>';
               }else {
                 $starthisuser =$starthisuser.'<i class="bi bi-star"></i>';
               }
             }
           }
         }
         
         if ($valueh->comm<>null) {
          //$thiscommenter +="";
      }
           
                
            $thisrating =$thisrating.'<a class="ml-2" href="#" rel="'.$valueh->user_id.'">'.'<div class="media w-100">'.'<img src="public/profile/'.$valueh->image.'" class="align-self-center rounded-circle mr-3 ml-2 mb-2"style="width :1cm;heigth:1cm" alt="...">'.
                 '<div class="media-body">'.
                    '<h6 class="mt-2">'.$valueh->name. '<span class=" ml-2">'.$starthisuser.'</span>'.'</h6>'.
                  '</div>'.
                ' </div>'.
          '</a>';
          if ($valueh->user_id==$user) {
            $thisHistorique=$valueh->id;
            
            for ( $j = 5; $j > 0; $j-- ) {
              if(($valueh->votes>=$j) &&( $valueh->votes<$j+1)){
                // bg_vi="bg-vi"
                $stare=$stare.'<input type="radio" name="rating" checked value="'.$j.'"><span class=" star"></span>';
               }else{
                $stare=$stare.'<input type="radio" name="rating" value="'.$j.'"><span class=" star"></span>';
               }

             }
           }
          }
       }
       if ($stare==null) {
        $stare="";
        for ( $j = 5; $j > 0; $j-- ) {
         
            $stare=$stare.'<input type="radio" name="rating" value="'.$j.'"><span class=" star"></span>';
          
         }
        }
       //dd($thisrating);
        $pois[]=array(
           "id"=>$value->id,
           "stars"=>$stare,
            "user_id"=>$value->user_id ,
            "userImage"=>$userMarker,
            "type_id"=>$value->type_id ,
            "tetle"=>$value->tetle ,
            "lat"=>$value-> lat,
            "lng"=>$value-> lng,
            "image"=>$value->image ,
            "moy"=>$value->moy ,
            "commenter"=>$value->commenter ,
            "action"=>$value->action ,
            "nb_visited"=>$value-> nb_visited,
            "created_at"=>$value->created_at,
            "historique"=>$historique,
            "rating"=> $thisrating,
            "nb_rating"=>$nb_rating,
            "nb_comm"=>0,
            "thisHistorique"=> $thisHistorique
        );
        $message="plan";
         //break;
      }
       return response()->json([
        'message'=>$message,
        'user'=>$user=User::find($user),
        'city'=>$pois,
     ]);
       //dd($user->name);
   
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
    {
        $wilaya=new Wilay;
        $wilaya->code=$request->code;
        $wilaya->name=$request->name;
        $wilaya->ar_name=$request->ar_name;
        $wilaya->longitude=$request->longitude;
        $wilaya->latitude=$request->latitude;
        $wilaya->save();
        return response()->json([
            'status'=>404,
            'message'=>'No Student Found.'
        ]);
    }
    public function storeCommines(Request $request)
    {
        $commines=new Commine;
        $commines->id=$request->id;
        $commines->post_code=$request->post_code;
        $commines->name=$request->name;
        $commines->wilaya_id=$request->wilaya_id;
        $commines->ar_name=$request->ar_name;
        $commines->longitude=$request->longitude;
        $commines->latitude=$request->latitude;
        $commines->save();
        return response()->json([
            'status'=>404,
            'message'=>'No Student Found.'
        ]);
    }/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   //$types=DB::table('types')->get();
       // $commines=DB::table('commines')->where("wilaya_id","=",$id)->get();
        return response()->json([
            'commines'=>DB::table('commines')->where("wilaya_id","=",$id)->get(),
            'types'=>DB::table('types')->get(),
        ]);
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
        //
    }

    public function getthispoi($id,$user){
      
      
    $message="vide";
    $poi=Marker::where("id","=",$id)->get();
      $pois=array();
      //$thishistoruq=array();
      foreach ($poi as $key => $value) { 
       $thisrating ="";
       $thiscommenter ="";
       $historique=Historique::where("marker_id","=", $value->id)->get();
       $userMarker=User::find($value->user_id);
       $stare =null;
       //dd($user->image);
       $thisHistorique=-1;
       $nb_rating=0;
       foreach ($historique as $keyh => $valueh) {
         if ($valueh->votes<>null OR $valueh->votes<>0 OR $valueh->comm<>null) {
           
          $starthisuser="";
          if ($valueh->votes<>null OR $valueh->votes<>0) {
            $nb_rating++;
            $yes=false;
            for ( $j = 5; $j > 0; $j-- ) {
             if(($valueh->votes>=$j) &&( $valueh->votes<$j+1)){
               $yes=true;
               if($valueh->votes==$j) {
                 $starthisuser=$starthisuser.'<i class="bi bi-star-fill"></i>';
               }else if($valueh->votes<$j+1){
                 $starthisuser =$starthisuser.'<i class="bi bi-star-half"></i>';
               }
   
             }else{
               if ($yes==false ) {
                 $starthisuser =$starthisuser.'<i class="bi bi-star-fill"></i>';
               }else {
                 $starthisuser =$starthisuser.'<i class="bi bi-star"></i>';
               }
             }
           }
         }
         
         if ($valueh->comm<>null) {
          //$thiscommenter +="";
      }
           
                
            $thisrating =$thisrating.'<a class="ml-2" href="#" rel="'.$valueh->user_id.'">'.'<div class="media w-100">'.'<img src="public/profile/'.$valueh->image.'" class="align-self-center rounded-circle mr-3 ml-2 mb-2"style="width :1cm;heigth:1cm" alt="...">'.
                 '<div class="media-body">'.
                    '<h6 class="mt-2">'.$valueh->name. '<span class=" ml-2">'.$starthisuser.'</span>'.'</h6>'.
                  '</div>'.
                ' </div>'.
          '</a>';
          if ($valueh->user_id==$user) {
            $thisHistorique=$valueh->id;
            
            for ( $j = 5; $j > 0; $j-- ) {
              if(($valueh->votes>=$j) &&( $valueh->votes<$j+1)){
                // bg_vi="bg-vi"
                $stare=$stare.'<input type="radio" name="rating" checked value="'.$j.'"><span class=" star"></span>';
               }else{
                $stare=$stare.'<input type="radio" name="rating" value="'.$j.'"><span class=" star"></span>';
               }

             }
           }
          }
       }
       if ($stare==null) {
        $stare="";
        for ( $j = 5; $j > 0; $j-- ) {
         
            $stare=$stare.'<input type="radio" name="rating" value="'.$j.'"><span class=" star"></span>';
          
         }
        }
       //dd($thisrating);
        $pois[]=array(
           "id"=>$value->id,
           "stars"=>$stare,
            "user_id"=>$value->user_id ,
            "userImage"=>$userMarker,
            "type_id"=>$value->type_id ,
            "tetle"=>$value->tetle ,
            "lat"=>$value-> lat,
            "lng"=>$value-> lng,
            "image"=>$value->image ,
            "moy"=>$value->moy ,
            "commenter"=>$value->commenter ,
            "action"=>$value->action ,
            "nb_visited"=>$value-> nb_visited,
            "created_at"=>$value->created_at,
            "historique"=>$historique,
            "rating"=> $thisrating,
            "nb_rating"=>$nb_rating,
            "nb_comm"=>0,
            "thisHistorique"=> $thisHistorique
        );
        $message="plan";
         //break;
      }
       return response()->json([
        'message'=>$message,
        'user'=>$user=User::find($user),
        'city'=>$pois,
     ]);
       //dd($user->name);
   
   
    }
}
