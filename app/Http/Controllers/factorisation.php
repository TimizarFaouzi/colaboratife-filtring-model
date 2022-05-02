<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Historique;
use App\Models\Marker;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class factorisation extends Controller
{
    protected $tableMarkers;//table de markers  do noter oumois 2  users
        protected $tableUsers;// table de users si omois noter 2 item;
        public function __construct() {
             $this->tableUsers=DB::table('users')->where([["nb_visited",">=",2],["moyanne",">",0]])->get();
             $this->tableMarkers=DB::table('markers')->where([["nb_visited",">=",2],["moy",">",0]])->get();
        }
    /*$Rs=array(
    array(5,3,0,1),
    array(4,0,0,1),
    array(1,1,0,5),
    array(1,0,0,4),
    array([0,1,5,4),
);
 * @DanDuus - http://dan.thoeisen.dk
 * Original Python impl: http://www.quuxlabs.com/blog/2010/09/matrix-factorization-a-simple-tutorial-and-implementation-in-python/
@INPUT:
    R     : a matrix to be factorized, dimension N x M
    P     : an initial matrix of dimension N x K
    Q     : an initial matrix of dimension M x K
    K     : the number of latent factors
    steps : the maximum number of steps to perform the optimization
    alpha : the learning rate
    beta  : the regularization parameter
@OUTPUT:
    the final matrices P and transposed(Q)
*/

public function matrix_factorization($R, $P, $Q, $K, $steps=5000, $alpha=0.0002, $beta=0.02){
    $Q = $this->transpose($Q);
	for($step = 0; $step<$steps; $step++){
		for($i = 0; $i<count($R); $i++){
			for($j = 0; $j<count($R[$i]); $j++){
				if ($R[$i][$j] > 0){
					$sigmaPQ = 0;
					for($z = 0; $z < $K; $z++){
						$sigmaPQ += $P[$i][$z] * $Q[$z][$j];
					}
                    $eij = $R[$i][$j] - $sigmaPQ;
                    for ($k = 0; $k < $K; $k++){
                        $P[$i][$k] = $P[$i][$k] + $alpha * (2 * $eij * $Q[$k][$j] - $beta * $P[$i][$k]);
						$Q[$k][$j] = $Q[$k][$j] + $alpha * (2 * $eij * $P[$i][$k] - $beta * $Q[$k][$j]);
					}
				}
			}
		}
        $e = 0;
		for ($i = 0; $i < count($R); $i++){
            for ($j = 0; $j < count($R[$i]); $j++){
                if ($R[$i][$j] > 0){
					//pow(x, y, z) = x to the power of y modulo z.

					$sigmaPQ = 0;
					for($z = 0; $z < $K; $z++){
						$sigmaPQ += $P[$i][$z] * $Q[$z][$j];
					}
                    $e = $e + pow($R[$i][$j] - $sigmaPQ, 2);
                    for ($k = 0; $k < $K; $k++){
						$e = $e + ($beta/2) * ( pow($P[$i][$k],2) + pow($Q[$k][$j],2) );
					}
				}
			}
		}
        if ($e < 0.001){
			break;
		}
	}
    return [$P,$this->transpose($Q)];
}
//$R= array();
//Example ratings matrix (This could be from a database)
public function index(){

    $markers=$this->tableMarkers;
    $users=$this->tableUsers;
   $tabePrediction=[];
   $rest="folse";
   $R = [];
   //dd($arraymarker);
   $u=0;
   foreach ($markers as $marker) {
    $j=0;
   foreach ($users as $user) {
    
        $rest="false";
          $histouser=DB::table('historiques')->where('user_id','=',$user->id)->where('marker_id','=',$marker->id)->get();
          foreach ($histouser as $hi){
              $tabePrediction[$u][$j]=array($user->id,$user->name,$user->image,$marker->id,$marker->tetle,$hi->votes,0);
              $rest="treu";
              $R[$u][$j]=$hi->votes;
          }
         if ($rest=="false") { 
            $tabePrediction[$u][$j]=array($user->id,$user->name,$user->image,$marker->id,$marker->tetle,"?",1);
            
            $R[$u][$j]=0;
           }
           
           $j++;
       }
       $u++;
   }
   //dd($arraymarker);
   //return view('Similarty.TableSimilarty',['pred'=>$tabePrediction,'TableHistorique'=>"slop one",'markers'=>$markers]);
/*
$R = [
    [5,3,0,1],
    [4,0,0,1],
    [1,1,0,5],
    [1,0,0,4],
    [0,1,5,4],
   ];
*/
$N = count($R);
$M = count($R[0]);
//Number of latent factors
$K = 2;

$P = $this->generateRandomArray($N, $K);
$Q = $this->generateRandomArray($M, $K);

$calculatedRatingsMatrix = $this->matrix_factorization($R, $P, $Q, $K);
//echo "This is the final matrix - where all user-item pairs with 0 has been approximated";
//dd($this->matrixmult($calculatedRatingsMatrix[0], $this->transpose($calculatedRatingsMatrix[1])),$tabePrediction);
$R=$this->matrixmult($calculatedRatingsMatrix[0], $this->transpose($calculatedRatingsMatrix[1]));
$u=0;
$matrixFactorisation=[];
   foreach ($markers as $marker) {
    $j=0;
$ArrayRating=array();
   foreach ($users as $user) {
    
        $rest="false";
          $histouser=DB::table('historiques')->where('user_id','=',$user->id)->where('marker_id','=',$marker->id)->get();
          foreach ($histouser as $hi){
            //  $tabePrediction[$u][$j]=array($user->id,$user->name,$user->image,$marker->id,$marker->tetle, $R[$u][$j],0);
              $rest="treu";
              $ArrayRating[]=array($user->id,$user->name,$user->image, round($R[$u][$j],2),0);
             // $R[$u][$j]=$hi->votes;
          }
         if ($rest=="false") { 
//$tabePrediction[$u][$j]=array($user->id,$user->name,$user->image,$marker->id,$marker->tetle, $R[$u][$j],1);

            $ArrayRating[]=array($user->id,$user->name,$user->image, round($R[$u][$j],2),1);
           // $R[$u][$j]=0;
           }
           
           $j++;
       }
       $u++;
       $matrixFactorisation[]=array(
           "id"=>$marker->id,
           "title"=>$marker->tetle,
           "rating"=>$ArrayRating,
       );
   }
  //dd($matrixFactorisation);
   //re
   return view('Similarty.TableSimilarty',['M_Factorisation'=>$matrixFactorisation,'TableHistorique'=>"M_Factorisation",'markers'=>$markers]);

}

/*
 * Helper functions
 * */
public function matrixmult($matrix_a,$matrix_b){
    $matrix_a_count=count($matrix_a);
    $c=count($matrix_b[0]);
    $matrix_b_count=count($matrix_b);
    if(count($matrix_a[0])!=$matrix_b_count){throw new Exception('Incompatible matrices');}
    $matrix_return=array();
    for ($i=0;$i< $matrix_a_count;$i++){
        for($j=0;$j<$c;$j++){
            $matrix_return[$i][$j]=0;
            for($k=0;$k<$matrix_b_count;$k++){
                $matrix_return[$i][$j]+=$matrix_a[$i][$k]*$matrix_b[$k][$j];
            }
        }
    }
    return($matrix_return);
}
public function generateRandomArray($dim, $num){
    $newArray = array();
    for($i = 0; $i < $dim; $i++){
        for($j = 0; $j < $num; $j++){
            $newArray[$i][$j] = mt_rand() / mt_getrandmax();
        }
    }
    return $newArray;

}
public function transpose($array) {
    array_unshift($array, null);
    return call_user_func_array('array_map', $array);
}
}
