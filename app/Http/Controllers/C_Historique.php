<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Historique;
use App\Models\Marker;
use App\Models\User;
use App\Models\Evolation;
use Illuminate\Support\Facades\DB;

class C_Historique extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addRS(Request $request)
    {  $SSR=DB::table('rs')->get();
        $SR=array();
        foreach ($SSR as $value) {
            $SR[]=($value->note);
        }
        $rsa=$SR[0];
        $rsb=$SR[1];
        $sra=0;
        $srbb=0;
        $sraa=0;
        if ($request->SRA<>"NAN" AND $request->SRB<>"NAN") {
             $SRA= sqrt(($request->SRA - $request->rating)**2);
             $SRB= sqrt(($request->SRA - $request->rating)**2);
             if ($SRA>=$SRB) {
                 if ($SRA==$SRB) {
                    $sraa=1;
                    $srbb=1;
                    $min="tout";
                 }else{
                     $srbb=1;
                     $min="srb";
                 }
                 
             }else{
                $sraa=1;
                $min="sra";
               }
        }elseif ($request->SRA<>"NAN" AND $request->SRB=="NAN"){
            $sraa=1;
            $min="sra";
        }elseif ($request->SRA=="NAN" AND $request->SRB<>"NAN"){
            $srbb=1;
            $min="srb";
        }
           $totsra=$sraa+$rsa;
           $totsrb=$srbb+$rsb;
           
        $URSA=DB::table('rs')->where("name","=","SRA")->update(['note' =>$totsra]);//Add 1 une poit la 
         
        $URSB=DB::table('rs')->where("name","=","SRB")->update(['note' =>$totsrb]);//Add 1 une poit la 
        $this->storEvolation($request,$min,$totsra,$totsrb);
   // dd( $SSR,$request->SRA,$request->SRB,   $totsra,   $totsrb);
       return 0;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    # function de system rocomondation 
    
    /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |    function de system rocomondation               |             | 
     *              |                                                   |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
    public function show($id)
    {
        $TSRA=DB::table('rs')->where('name',"=","SRA")->get();
        $TSRB=DB::table('rs')->where('name',"=","SRB")->get();
        
        foreach ($TSRA as $value) {
            $SRA=$value->note; 
        }
        foreach ($TSRB as $value) {
            $SRB=$value->note; 
        }
         if ($SRA>$SRB) {
            return redirect('/RA'.$id);
         //return $SRA;
         }else {
            return redirect('/RB'.$id);
          //return $SRB;
         }
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
     /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |    function virificatioUser test si visiter ou no | 
     *              |                                                   |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
    public function virificatioUser($user,$item){
        $visite="false";
        $historiques=DB::table('historiques')->where("user_id","=",$user)->where("marker_id","=",$item)->get();
        foreach ($historiques as $value) {
            $visite="true";
            break;
        }
        return $visite;
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
    /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |     function storEvolation insertion un evolation | 
     *              |                                                   |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
    public function storEvolation(Request $request,$add,$totalRSA,$totalRSB)
    {
        
        $Evolation=new Evolation;
        $Evolation->user_id=$request->id_user;
        $Evolation->marker_id=$request->id_marker;
        $rsa = $request->id_user_sra; // Retrieve the currently authenticated user's ID...
        $rsb = $request->id_user_srb; // Retrieve the currently authenticated user's ID...
       // tset  que add un poit  system rocomondation  A ou B OU tout les do
       if ($add=="sra") {
          $rsa++;//add un poit pour rsa
       }elseif ($add=="srb") {
        $rsb++;//add un poit pour rsb
       }elseif ($add=="tout") {
        $rsa++;//add un poit pour rsa
        $rsb++;//add un poit pour rsb
       }
        $Evolation->rsa=$rsa;
        $Evolation->rsb=$rsb ;
        $Evolation->total_rsa=$totalRSA;
        $Evolation->total_rsb=$totalRSB ; 
        $Evolation->rating=$request->rating ;
        $Evolation->save();
        $URS=DB::table('users')->where("id","=",$request->id_user)->update(['rsa' =>$rsa,'rsb' =>$rsb]);//Add 1 une poit pour toute les system rocomondation 
            
        
    }
    /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |     function  set la moyenn de rating User        |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
     public function SetMoiyennUser($user)
     {
         $n=0;//nuber de POI  pour rating user
         $somRatingUser=0;//La somme de Rating user to POI 
      
         $Ratings=DB::table('historiques')->where("user_id","=",$user)->get();
         foreach ($Ratings as $Rating) {
             $n++;
             $somRatingUser +=$Rating->votes;
         }
          $Moiyenn=$somRatingUser/$n;
          $Moiyenn=round($Moiyenn,2);
          return $Moiyenn;
    }
    
    /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |     function  set la moyenn de rating Item        |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
    public function SetMoiyennItem($item){
        $n=0;//nuber de POI  pour rating user
        $somRatingItem=0;//La somme de Rating user to POI 
        $Ratings=DB::table('historiques')->where("marker_id","=",$item)->get();
        foreach ($Ratings as $Rating) {
            $n++;
            $somRatingItem +=$Rating->votes;
        }
         $Moiyenn=$somRatingItem/$n;
         $Moiyenn=round($Moiyenn,2);//قيمة المقربة بزيادة الى الميئاة
         return $Moiyenn;
       }

       

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |    function edit ce function de calcule moiyenne  | 
     *              |             de evolation de User et Item                                      |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
    public function edit($id_user,$id_marker,$rating,$visite)
    {   #select moyen de vote user  et update
        $users = User::find($id_user);
        if ($users) {
            if ($visite<>0) {
                
            $moyenn_user= (($users->moyanne)*($users->nb_visited));// select la somme de rating
            $users->moyanne=(($moyenn_user + $rating - $visite)/($users->nb_visited ));// edit moyenn de rating 
            }else{
                $moyenn_user= (($users->moyanne)*($users->nb_visited));// select la somme de rating
                $users->moyanne=(($moyenn_user + $rating)/($users->nb_visited + 1));// edit moyenn de rating 
                $users->nb_visited = $users->nb_visited + 1;// incrimpnt number de visite
                }
            $users->update();
        }
        #select moyen de vote item i  et update
        $markers = Marker::find($id_marker);
        if ($markers) {
            if ($visite<>0) {
                
                $moyenn_user= (($markers->moy)*($markers->nb_visited));// select la somme de rating
                $markers->moy=(($moyenn_user + $rating - $visite)/($markers->nb_visited ));// edit moyenn de rating 
                }else{
                    $moyenn_user= (($markers->moy)*($markers->nb_visited));// select la somme de rating
                    $markers->moy=(($moyenn_user + $rating)/($markers->nb_visited + 1));// edit moyenn de rating 
                    $markers->nb_visited = $markers->nb_visited + 1;// incrimpnt number de visite
                    }
            $markers->update();
        }
       return 0;
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |    function de insertion un historique            |             | 
     *              |                                                   |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
    public function store(Request $req)
    {   
        if (isset($req->rating ) OR isset($req->comm) ) {
            
            $ens_rating=0;
            $last_rating=$req->rating;
         $historiques = DB::table('historiques')->where("marker_id","=",$req->id_marker)->where("user_id","=",$req->id_user)->get();
         $test="false" ;           
         foreach ($historiques as $hist) {
                
            $editHist=Historique::find($hist->id);
          
             if (isset($req->rating)) {
                 if ($hist->votes<>null) {
                  $ens_rating=$hist->votes;
                  $note=(($hist->votes)+($req->rating))/2;
                  $note= round($note,2);
                  $editHist->votes=$note;
                  $last_rating= $note;
                 }else{
                     
                     $last_rating=$req->rating;
                     $editHist->votes=$req->rating;
                     $ens_rating=0;
                 }
                 
              }
               $nb_visite=$hist->nb_visite+1;
             
              $editHist->nb_visite= $nb_visite;
         if (isset($req->comm)) {
             $editHist->comm=$req->comm;
          }
         $editHist->update();
         $test="true" ;
        }
             
            if ($test=="false") {
              //insert une historique id_user
              $historique=new Historique;
              $historique->user_id=$req->id_user;
              $historique->	user_id_marker=$req->user_marker;
              $historique->name=$req->name ;
              $historique->	image=$req->image;
              $historique->	title=$req->title;
              $historique->nb_visite=1;
              $historique->marker_id=$req->id_marker ;
              if (isset($req->comm)) {
                 $historique->comm=$req->comm;
              }if (isset($req->rating)) {
                $historique->votes=$req->rating;
             }
              $historique->save();
              if ($req->RS=="true") {
                  # Add une point de min dicetonce pour rating SRA  et SRB
                  $ADD=$this->addRS($req);
              }
        }
           // return $this->show($req->id_user);
           if (isset($req->rating)) {       
            # calcule  et updat la moiyenne de vote user et evolation de item
           $updat=$this->edit($req->id_user,$req->id_marker,$last_rating,$ens_rating); 

       }
   return response()->json(['sessen'=>$req->rating]);
        }else {
            
        }
    }
   
    //function get last historique
    
    public function lastPoi($id){
        $markers = DB::table('historique')->where("user_id","=",$id)->orderBy('id', 'DESC')->first();
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



     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |    function de shwo notification                  |             | 
     *              |                                                   |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
    public function Shownotification($id){
        $notification=DB::table('historiques')->where([["user_id_marker","=",$id],["user_id","<>",$id]])->get();
        $tablenotification=array();
        $sr=array();
        $nb_notification=0;
        $firstSone=0;
        $yers=2013;
        foreach ($notification as $key => $value) {
            $tablenotification[]=array(
                'id'=>$value->id, 
                'name'=>$value->name, 
                'image'=>$value->image,
                'rating'=>$value->votes, 
                'comm'=>$value->comm, 
                'title'=>$value->title, 
                'vi_this'=>$value->vi_this,
                'vi_form'=>$value->vi_form,
                'created_at'=>$value->created_at,
            );
            $yers++;
            $sr[]=array(
                'name'=>$value->created_at, 
                'a'=>$key, 
                'b'=>$value->votes, 
                'c'=>$value->id,
              );
            if($value->vi_form==null)
                {
                    $nb_notification++;
                    if ( $firstSone==0) {
                        $firstSone=$value->id;
                    }
                }
            
        }
        
        if ($tablenotification<>null ) {
            foreach ($tablenotification as $key => $row) {
                $idn[$key]  = $row['id'];
             }
        
             // ترتيب البيانات حسب الحجم تنازليًا، وحسب الإصدار تصاعديًا
             // إضافة data$ كآخر وسيط للترتيب حسب المفتاح المشترك
             array_multisort($idn, SORT_DESC, $tablenotification);
           
        }
        return Response()->json([
            'tablenotification'=>$tablenotification,
            'number'=>$nb_notification,
            'sr'=>$sr,
            
        ]);

        
   
        //dd($tablenotification,$nb_notification);
    }

    public function VI_form_Notification($id){
        
        $notification=DB::table('historiques')->where([["user_id_marker","=",$id],["vi_form",null]])->get();

        if ($notification<>null) {
            foreach ($notification as $key => $value) {
           
                $update=Historique::find($value->id);
                $update->vi_form=1;
                $update->update();
            
            }
            return Response()->json([
                        'succes'=>"vi valide"
            ]);
        }else {
            return Response()->json([
                'succes'=>"pas vi et pat notification"
                ]);
        }

    }

    public function VI_this_Notification($id){
        
        
        $update=Historique::find($id);
        if($update) {
            
        $update->vi_this=1;
        $update->update();
        
        
        }
             
    return view('auth.profil');
    }


    /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |     function get System Rocomndation              |             | 
     *              |               Base ser Algoritm                   |             |
     *              |                   Pearson                         |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */


    
    public function viThisHistorique($user)
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
