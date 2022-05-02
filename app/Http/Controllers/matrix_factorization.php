<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class matrix_factorization extends Controller
{
    
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
    
$R = [
    [5,3,0,1],
    [4,0,0,1],
    [1,1,0,5],
    [1,0,0,4],
    [0,1,5,4],
   ];

$N = count($R);
$M = count($R[0]);
//Number of latent factors
$K = 2;

$P = $this->generateRandomArray($N, $K);
$Q = $this->generateRandomArray($M, $K);

$calculatedRatingsMatrix = $this->matrix_factorization($R, $P, $Q, $K);
echo "This is the final matrix - where all user-item pairs with 0 has been approximated";
dd($this->matrixmult($calculatedRatingsMatrix[0], $this->transpose($calculatedRatingsMatrix[1])));

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
