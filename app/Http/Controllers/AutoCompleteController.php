<?php
 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Marker;
use App\Models\Historique;
use Illuminate\Support\Facades\DB;
 
class AutoCompleteController extends Controller
{
 
    public function index()
    {
        return view('search');
    }
 
    public function search(Request $request)
    {
          $search = '$request->dd';
      
         // $result = Marker::where('tetle', 'LIKE', '%'. $search. '%')->get();
 
          return response()->json($search);
            
    } 
}