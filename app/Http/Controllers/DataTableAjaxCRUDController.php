<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use App\Models\Marker;
 
use App\Models\User;
use Datatables;
 
class DataTableAjaxCRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Marker::select('*'))
            ->addColumn('action', 'home.company-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('home.companies');
    }
    public function datatablesPOI(){
        if(request()->ajax()) {
            return datatables()->of(Marker::select('*'))
            ->addColumn('action', function($row){
                $actionBtn = '<button type="button" class="editbtn-poi  btn btn-success btn-sm mr-2"value="'.$row->id.'"><i class="bi bi-pencil-square"></i></button><button type="button" class="delete-Marker  btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalCenter" value="'.$row->id.'"><i class="bi bi-trash" ></i></button>';
                return $actionBtn;})->addColumn('imagePOI', function($row){
                    $imageimg = '
                    <img src="public/marker/'.$row->image.'" alt="" srcset=""style="width:100px;heigth:25px;border-radius:50%">';
                    return $imageimg;})
            ->rawColumns(['action','imagePOI'])
            ->addIndexColumn()
            ->make(true);
        }
       // return view('ListeTables.Marker');
        return view('dachboarde.index');
    }
    public function datatablesUsers(){
        if(request()->ajax()) {
            return datatables()->of(User::select('*'))
            ->addColumn('action', function($row){
                $actionBtn = '<button type="button" class="editbtn-user   btn btn-success btn-sm mr-2"data-toggle="modal" data-target="#exampleModalCenter"value="'.$row->id.'"><i class="bi bi-pencil-square"></i></button><button type="button" class="delete  btn btn-danger btn-sm"value="'.$row->id.'"><i class="bi bi-trash" ></i></button>';
                return $actionBtn;})
                ->addColumn('image', function($row){
                    $actionBtn = '
                    <img src="public/profile/'.$row->image.'" alt="" srcset=""style="width:50px;heigth:50px;border-radius:50%">';
                    return $actionBtn;})
            ->rawColumns(['action','image'])
            ->addIndexColumn()
            ->make(true);
        }
       // return view('ListeTables.Marker');
        return view('dachboarde.index');
        
        
    } 
      
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
 
        $companyId = $request->id;
 
        $company   =   Marker::updateOrCreate(
                    [
                     'id' => $companyId
                    ],
                    [
                    'tetle' => $request->name, 
                    'lat' => $request->email,
                    'lng' => $request->address
                    ]);    
                         
        return Response()->json($company);
 
    }
      
      
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {   
       // $where = array('id' => $request->id);
        //$company  = Marker::where($where)->first();
        return view('POI.Form_Markers');

       // return Response()->json($company);
    }
      
      
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $company = Marker::where('id',$request->id)->delete();
      
        return Response()->json($company);
    }
}