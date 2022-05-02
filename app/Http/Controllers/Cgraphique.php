<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Historique;
use App\Models\Marker;
use App\Models\Rs;
use App\Models\User;
use App\Models\Evolation;
use Illuminate\Support\Facades\DB;
class Cgraphique extends Controller
{ 
     

    public function index(){

        $Evolation = Evolation::all();
        $dataPoints = [];
        $SRA=[];
        $SRB=[];
        $Click=[];
        $i=1;
        foreach ($Evolation as $Evolation) {
            $SRA[]=intval($Evolation['total_rsa']);
            $SRB[]=intval($Evolation['total_rsb']);
            $Click[]="Click ".$i;
            $i++;
            
        }
        $dataPoints[0] = array(
            "name" =>"System Rocomondation Pearson",
            "data" =>$SRA,
        );
        $dataPoints[1] = array(
            "name" =>"System Rocomondation Slope One",
            "data" =>$SRB,
        );

        $Cyrcl=[];
        $system = RS::all();
        return view("graph.line-graph", [
            "data" => json_encode($dataPoints),
            "terms" => json_encode($Click),"system"=>$system 
        ]);

    }
    public function GraphSR($id)
    {  
        $totSr = Rs::all();
        foreach ($totSr as $key => $val) {
            if ($val->name=="SRA") {
                $countPer=$val->note;
            }else{
                
                $countSlp=$val->note;
            }
        }
        $UserAddMarker=Marker::where("user_id","=",$id)->count();
        
        $Marker=Marker::all()->count();
        $Percentage=($UserAddMarker*100)/$Marker;

        $activMarker=Marker::where("action","=","active")->count();
        $PAM=($activMarker*100)/$Marker;
        $users=User::where("id","=",$id)->get();
      foreach ($users as $key => $value) {
         
        $nb_vi=$value->nb_visited;
      }
      if ($Marker-$UserAddMarker<>0) {
          $prosontageViusr=($nb_vi*100)/($Marker-$UserAddMarker);
      }else {
          
        $prosontageViusr=100;
      }
      // dd( $UserAddMarker,  $Marker,$Percentage,$nb_vi);
        $evolation = Evolation::all();
        $dataPoints = [];
        
        $dataPointsUser = [];
        $person=0; 
        $slopon=0;
        $i=0;

        $j=0;
        foreach ($evolation as $key=>$evo) {
            if ($evo->user_id==$id) {
                $dataPointsUser[] = array(
                    'date' =>$evo->created_at, 
                    'SRA' =>intval($evo['rsa']),
                    'SRB'=> intval($evo['rsb']),
        
                );
            }



           $dataPoints[] = array(
                'date' =>$evo->created_at, 
                'SRA' =>intval($evo['total_rsa']),
                'SRB'=> intval($evo['total_rsb']),
    
            );
            
        }
        return Response()->json([
            'dataPoints'=>$dataPoints,
            'countper'=>$countPer, 
            'countslp'=>$countSlp, 
            'dataPointsUser'=>$dataPointsUser,
            'PercentageAddMarkers'=>$Percentage,
            'users_nb_vi'=>$nb_vi,
            'prosontageViusr'=>$prosontageViusr,
            'totoMarker'=>$Marker,
            'activMarker'=>$activMarker,
            'PAM'=>$PAM,

        ]);

    }
    public function show()
    {
        $system = DB::table('rs')->get();
        return view("graph.cyrcl", [ 'data' => $system]);
    }

    public function GetJsonTest() {
        return view("graph.json");
    }
    public function fetchstudent()
    {
        $totSr = Rs::all();
        return response()->json([
            'students'=>$students,
        ]);
    }

    public function showChart(Request $request)
    {   $user = $request->user(); // returns an instance of the authenticated user...
        $id = $request->user()->id; // Retrieve the currently authenticated user's ID...
        $population = DB::table('evolations')->where("user_id","=",$id)->get();
        $students = Rs::all();
        $res[] = ['Year', 'RSA', 'RSB'];
        foreach ($population as $key => $val) {
            $res[] = [$key, $val->rsa, $val->rsb];
        }
            return response()->json([
                'students'=>$students,
                'rse'=>$res,
            ]);
    }
    //function get graphique
    public function getGraphique()
    {
        $students = Evolation::all();

        $dataPoints = [];
        $SRA=[];
        $SRB=[];
        $Click=[];
        $i=1;
        foreach ($students as $student) {
            $SRA[]=intval($student['total_rsa']);
            $SRB[]=intval($student['total_rsb']);
            $Click[]="Click ".$i;
            $i++;
            
        }
        $dataPoints[0] = array(
            "name" =>"System Rocomondation Pearson",
            "data" =>$SRA,
        );
        $dataPoints[1] = array(
            "name" =>"System Rocomondation Slope One",
            "data" =>$SRB,
        );
        $Cyrcl= RS::all();
        return response()->json([
            "data" => $dataPoints,
            "terms" => $Click,
        ]);

    }

}
