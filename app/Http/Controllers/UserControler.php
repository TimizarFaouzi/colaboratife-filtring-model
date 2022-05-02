<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Historique;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use File;
class UserControler extends Controller
{
    public function editeUser(Request $req)
    {    $id=$req->id;
         $users=User::find($id);
         $d= $req->image;
         $image=$req->last_img;
        
       
         //dd($req->image);
        // echo'<img src="'.$req->image.'" alt="" srcset="">';
        // dd($req->image);
       if ($users<>null) {
        if (isset($req->image)) {
            $req->validate([
                //'image' => 'required|image',
                'image' => 'mimes:jpeg,bmp,png,jpg,jfif' // Only allow .jpg, .bmp and .png file types.
            ]);
          
                
                $imageName = time().'.'.$req->image->extension();
        
                $req->image->storeAs('profile', $imageName);
                  $users->image = $imageName;
                  $notification=DB::table('historiques')->where("user_id","=",$id)->get();

                  if ($notification<>null) {
                      foreach ($notification as $key => $value) {
                     
                          $update=Historique::find($value->id);
                          $update->image=$imageName;
                          $update->update();
                      
                      }
                  }
            
        }
        if (isset($req->name)) {
            
            $validated=$req->validate([ 'name' => ['required', 'string', 'max:20']]);
             $users->name=$req->name;
         }
         if (isset($req->email)) {
              
            $validated=$req->validate([ 'email' => ['required', 'email', 'max:225']]);
             $users->email=$req->email;
         }
        if (isset($req->password)) {
         $req->validate([ 'password' => ['required', 'string', 'min:8','confirmed']]);
                    $users->password= Hash::make($req->password);
        }
        if (isset($req->wilay)) {
          
            $users->wilay=$req->wilay;
        }
        if (isset($req->commine)) {
          
            $users->commine=$req->commine;
        }
           $users->update();
       }
       return response()->json([
        'message'   => 'Profil Upload Successfully',
        'class_name'  => 'alert-success'
  ]);
    }


 public function index(){
      
    return view('auth.profil');
 }

    public function Profile_Personal($user)
    { 
        $markers=DB::table('markers')->where('user_id','=',$user)->get();
        $historique=DB::table('historiques')->where('user_id_marker','=',$user)->get();
        //$count=DB::table('historiques')->where('user_id_marker','=',$user)->count();
       // dd($count);
          $poi=[];
          $rating_user=[]; 
        foreach ($markers as $keymar =>$marker){
            $vi=false;
            $r=0;
            $c=0;
            foreach ($historique as $key => $value) {
                if ($marker->id==$value->marker_id) {
                    $rating_user[$keymar][]=array(
                    'user_id'=>$marker->user_id,
                    'name'=>$value->name,
                    'image_user'=>$value->image,
                    'rating'=>$value->votes,
                    'comm'=>$value->comm);
                    $historique->pull($key);
                    $vi=true;
                    if($value->votes<>null){
                        $r++;
                    }if($value->comm<>null){
                        $c++;
                    }
                }
            }
            if ($vi==false) {
                $rating_user[$keymar]=null;
            }
            $poi[]=array(
                'id'=>$marker->id,
                'title'=>$marker->tetle,
                'image'=>$marker->image,
                'lat'=>$marker->lat,
                'lng'=>$marker->lng,
                'nb_visited'=>$marker->nb_visited,
                'nb_rating'=>$r,
                'nb_comm'=>$c,
                'moyenn'=>$marker->moy,
                'icons'=>$marker->icons,
                'created_at'=>$marker->created_at,
                'user'=>$rating_user[$keymar]);
            }
    if ($poi<>null) {
       /** fin system rocomndation */
       foreach ($poi as $key => $row) {
            $rating[$key]  = $row['id'];
         }

         // ترتيب البيانات حسب الحجم تنازليًا، وحسب الإصدار تصاعديًا
         // إضافة data$ كآخر وسيط للترتيب حسب المفتاح المشترك
         array_multisort($rating, SORT_DESC, $poi);
    }
       
   // dd($poi,$RS);
  return response()->json(['poi'=>$poi]);
       
       // return view('home',['poi'=>$poi,'RS'=>$RS,"SR"=>"A"]);
    }

}
