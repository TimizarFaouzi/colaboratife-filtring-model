<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rs;
use Illuminate\Support\Facades\DB;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $sr=DB::table('rs')->get();
        foreach ($sr as $key => $value) {
            if ($value->name=="SRA") {
               $SRA=$value->note;
            }
            elseif($value->name=="SRB"){
                $SRB=$value->note;
            }
        }
        if($SRA>$SRB){
            $SR="SRA";
        }elseif($SRA<$SRB){
            $SR="SRB";
        }else{
            $SR="touts"; 
        }
        return view('layouts.app',['SRR'=>$SR]);
        //return view('home');
    }
}
