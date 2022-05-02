<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Wilaya_Controller;

use App\Http\Controllers\DataTableAjaxCRUDController;

use App\Http\Controllers\factorisation;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//route Login
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/factorisation', [factorisation::class, 'index'])->name('factorisation');

    //route get notification
    Route::get('/myProfile{id?}', [App\Http\Controllers\C_Historique::class, 'VI_this_Notification'])->name('app.VI_this_Notification');

//route aficher profel
Route::get('/profile', function () {
    return view('auth.uplade');
});//route aficher profel
Route::get('/sone', function () {
    return view('layouts.header');
});
//route aficher profel
Route::get('/log', function () {
    return view('login');
});
  //edit profile 
Route::post('/UserControler',[App\Http\Controllers\UserControler::class ,'editeUser'])->name('UserControler');


  // Profile_Personal
  Route::get('/Profile-Personal{id?}',[App\Http\Controllers\UserControler::class ,'index'])->name('Profile_Personal');

// page Admin
Route::get('/', function () {
return view('layouts.app');

});

//route de page dachboard
Route::get('/dachboarde', function () {
    return view('dachboarde.dachboard');
});

//route afficher leste poi code Ajax
Route::get('/Ajax_Datatables_Markers', function () {
    return view('ListeTables.Ajax_Datatables_Markers');
});
Route::get('/show_Page_marker',function(){

    return view('ajax_upload');
});

// page home SystemRocomndation
Route::get("/SystemRocomndation",function(){
    return view('home');
});
//route Affichet table de  POI 
Route::get('/listPoi', function () {
    return view('ListeTables.ListPOI');
});

//route afficher list Users code Ajax
Route::get('/Ajax_Datatables_Users', function () {
    return view('ListeTables.Ajax_Datatables_Users');
});

Route::get('location/dachborardPOI.blade.php',function(){
    return view('location.dachborardPOI');
});

//route Affichet table de  Users 
Route::get('/listUsers', function () {
    return view('ListeTables.ListeUsers');
});
//route add Wilaya
Route::get('/Add-Wilaya', [App\Http\Controllers\Wilaya_Controller::class, 'store']);


//route add Wilaya
Route::get('/get-locationCity', [Wilaya_Controller::class, 'index']);

//route add Wilaya
Route::get('/get-locationCityjson', [Wilaya_Controller::class, 'getLOcationCity']);


///get cominn this wilaya  

Route::get('/get-locationCityThisjson{id?}', [Wilaya_Controller::class, 'getLOcationCityThisCode']);
//route add comminse  
Route::get('/Add-Commines', [App\Http\Controllers\Wilaya_Controller::class, 'storeCommines']);

 //route afficher list de POI
Route::get('ajax-crud-datatable-markers', [DataTableAjaxCRUDController::class, 'datatablesPOI']);

//show page  add poi
Route::get('edit-POI', [DataTableAjaxCRUDController::class, 'edit']);

//route edite une markers
Route::get('/editmarkers{id}',[App\Http\Controllers\C_Marker::class ,'edit']);
//route add POi

//update-markers ser la base donee
Route::Post('/update-markers', [App\Http\Controllers\C_Marker::class, 'update']);


Route::Post('/submit-form/Marker',[App\Http\Controllers\C_Marker::class ,'store'])->name('submit-add.marker');

//route Afficher list Users
Route::get('ajax-crud-datatable-users', [DataTableAjaxCRUDController::class, 'datatablesUsers']);

Route::post('store-company', [DataTableAjaxCRUDController::class, 'store']);
Route::post('delete-company', [DataTableAjaxCRUDController::class, 'destroy']);

//route afficher les pois
// route get les markers
Route::get('/getMarkers', [App\Http\Controllers\C_Marker::class, 'getOpenstreet']);

//route slecte commines;
Route::get('/show-Commines{id?}', [App\Http\Controllers\Wilaya_Controller::class, 'show']);


//route aficher les poi this comin  locationPOIThisWilayajson

Route::get('/get-locationPOIThisWilayajson/poi.{code?}.user{user?}', [App\Http\Controllers\Wilaya_Controller::class, 'locationPOIThisWilayajson']);


Route::get('/get-locationPOIThisjson/poi.{code?}.user{user?}', [App\Http\Controllers\Wilaya_Controller::class, 'locationPOIThisjson']);




Route::get('/getthispoi/poi.{code?}.user{user?}', [App\Http\Controllers\Wilaya_Controller::class, 'getthispoi']);

use App\Http\Controllers\AjaxContactController;
 
Route::get('ajax-form', [AjaxContactController::class, 'index']);
Route::post('store-data', [AjaxContactController::class, 'store']);

//route get last poi create

Route::get('/getLastMarkers/{user}', [App\Http\Controllers\C_Marker::class, 'lastPoi']);


Route::get('/ajax_upload', [App\Http\Controllers\AjaxUploadController::class, 'index']);

Route::post('/ajax_upload/marker',[App\Http\Controllers\AjaxUploadController::class,  'Updat'])->name('ajaxupload.marker');
Route::post('/ajax_add/marker',[App\Http\Controllers\C_Marker::class,'store'])->name('ajaxadd.marker');




//route aficher similarty Item Item
Route::get('/SimilartyItem',[App\Http\Controllers\SR_Controller::class ,'getPearsonSimilartyItemItem'])->name("Similarty.Item");
//route aficher similarty Item Item
Route::get('/SimilartyUser',[App\Http\Controllers\SR_Controller::class ,'getPearsonSimilartyUserUser'])->name("Similarty.User");

//route aficher similarty Item Item base ser algorithem Slop One
Route::get('/SimilartySlopEOne',[App\Http\Controllers\SR_Controller::class ,'getSlopOneSimilartyItemItem'])->name("Similarty.SlopOne");
//route return  similarity auth ( I me) et users
Route::get('SimilarityUser.{id?}', [App\Http\Controllers\SR_Controller::class, 'getPearsonSimilartyThiseaAuth'])->name('similarités.this.user.user');
//route  de fonction  predaction base ser similarété item item et paser ser  la moyen  de item  i
Route::get('/predactionPearsonItemBase', [App\Http\Controllers\SR_Controller::class, 'getPearsonPredictionItemBase'])->name('predaction.item.base');
//route  de fonction  predaction base ser similarété item item et paser ser  la moyen  de item  i
Route::get('/predactionPearsonUserBase', [App\Http\Controllers\SR_Controller::class, 'getPearsonPredictionUserBase'])->name('predaction.User.base');
//aficher table rating  base ser algorithem  Slope One 
Route::get('/predactionSlopOneItemBase', [App\Http\Controllers\SR_Controller::class, 'getSlopOnePredictionItemBase'])->name('predaction.item.base.SlopOne');

// route afichage  table de historique si user visite >=2 et Item mame
Route::get('/TableHistorique', [App\Http\Controllers\SR_Controller::class, 'getTableHistorique'])->name('table.Historique');
//afichege tote les historique
Route::get('/TableHistoriqueTotale', [App\Http\Controllers\SR_Controller::class, 'getTableHistoriqueTotal'])->name('table.Historique.Totale');
//lien Calcule la moyenne de rating user et item lamme tamp
Route::get('/CalculeMoyennRatingUserEtItem', [App\Http\Controllers\SR_Controller::class, 'CalculeMoyennRatingUserEtItem'])->name('Calcul.Moyenn.Rating');

//route  les poi system rocomondation baser  ser algorthemm pearsone
Route::get('/RA{user?}', [App\Http\Controllers\SR_Controller::class, 'RSA']);

//route  les poi system rocomondation  baser ser la algorithemm slop one
Route::get('/RB{user?}', [App\Http\Controllers\SR_Controller::class, 'RSB']);

//route get notification
Route::get('/Show_Notification{id?}', [App\Http\Controllers\C_Historique::class, 'Shownotification'])->name('app.Show_Notification');

    //route get notification
Route::get('/VI_form_Notification{id?}', [App\Http\Controllers\C_Historique::class, 'VI_form_Notification'])->name('app.VI_form_Notification');

//route  vi this historique
Route::get('/VI_this_Notification{id?}', [App\Http\Controllers\C_Historique::class, 'viThisHistorique'])->name('app.VI_this_Notification');
//route  notification  insert new vote addhistorique 
Route::get('/addhistorique', [App\Http\Controllers\C_Historique::class, 'store'])->name('home.addhistorique');

Route::get('/matrix_factorization',[App\Http\Controllers\matrix_factorization::class ,'index'])->name('UserControlere');

//edit profile
Route::post('/UserControler',[App\Http\Controllers\UserControler::class ,'editeUser'])->name('UserControler');


// delete markers 
Route::post('/deletemarkers', [App\Http\Controllers\C_Marker::class, 'Delete']);

// graphique dachboard
 Route::get('/convert', [App\Http\Controllers\C_Marker::class, 'convert']);
//route userchart 
Route::get('line-graph{id?}', [App\Http\Controllers\Cgraphique::class, 'GraphSR'])->name('GRaph.RS');
//djfhlAIU
//get les date graphique 
Route::get('getGraphique', [App\Http\Controllers\Cgraphique::class, 'getGraphique']);
//get date  cycle 

Route::get('/Cyrcl', [App\Http\Controllers\Cgraphique::class, 'show']);
use App\Http\Controllers\IconsController;
use App\Http\Controllers\AutoCompleteController;
 
Route::get('stor-image', [IconsController::class, 'saveicons']);
Route::get('upload-image', [IconsController::class, 'index']);
Route::get('search', [IconsController::class, 'seach']);

Route::get('autocomplete', [AutoCompleteController::class, 'index']);
Route::get('article-form',function(){
    return view('article-form');
});
Route::get('serch-form',function(){
    return view('sd');
});