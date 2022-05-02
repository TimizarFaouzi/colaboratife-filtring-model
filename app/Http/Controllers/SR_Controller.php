<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Historique;
use App\Models\Marker;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class SR_Controller extends Controller
{   protected $tableMarkers;//table de markers  do noter oumois 2  users
    protected $tableUsers;// table de users si omois noter 2 item;
    public function __construct() {
         $this->tableUsers=DB::table('users')->where([["nb_visited",">=",2],["moyanne",">",0]])->get();
         $this->tableMarkers=DB::table('markers')->where([["nb_visited",">=",2],["moy",">",0]])->get();
    }
    /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |     function getSimilarity Item Item              |             | 
     *              |           Algoritm  Pearsonn                      |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
    public function getPearsonSimilartyItemItem()
    {
        $markers=$this->tableMarkers;
        
        $tableSim=array();//table de similartyer
        $u=0;//$U egale nomber de Item
        foreach ($markers as $markerWen) {
            $j=0;
            foreach ($markers as $markerTow) {
                
             if ($markerWen->id==$markerTow->id) { 
                 
                    $tableSim[$u][$j]=array($markerTow->id,$markerTow->tetle,1);
             }elseif($u>$j) {
                    $tableSim[$u][$j]=$tableSim[$j][$u];
                   
                }else{
                 $tableSim[$u][$j]=array($markerTow->id,$markerTow->tetle,$this->setPearsonSimilartyItemItem($markerWen->id,$markerTow->id));
                
             }
                
                $j++;
            }
            $u++;
        }
        //dd($tableSim);
        return view('Similarty.TableSimilarty',['pearsonitem'=>$tableSim]);
    }
     /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |     function setSimilarity Item Item              |             | 
     *              |           Algoritm  Pearsonn                      |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
    public function setPearsonSimilartyItemItem($item1,$item2)
    {
        $ra=0;// moyanne   vote  item A
        $rb=0;
        $his1= DB::table('markers')->where("id","=",$item1)->get();//get vote les etem A
        $his2= DB::table('markers')->where("id","=",$item2)->get();//get vote les etem A
        
        foreach($his1 as $hi){
         $ra=$hi->moy; //get moiyan  de note item a
        
        }
        if ($ra==0) {
            $sim="NAN";
            return $sim;
        }else{
         
            foreach($his2 as $hi){
             $rb=$hi->moy;//get moiyan  de note item b
            }
            if ($rb==0 ) {
                $sim="NAN";
                return $sim;
              }else{
              
               $ab=0;//$ab= some evaltion de users  (rap)*(rbp)
               $powrap=0;//$powrap= (rap-ra)^2
               $powrbp=0;//$powrbp= (rbp-rb)^2
               $users=$this->tableUsers;//get tout users que note marker
               foreach ($users as $user){
                  $rap=0;
                  $rbp=0;
                  //select  tout  les markers de historique 
                  $ha=DB::table('historiques')->where("user_id","=",$user->id)->where("marker_id","=",$item1)->get();
                  foreach ($ha as $historique){
                        $rap=(($historique->votes)-$ra);//set le marker de historique  par  array et eleminer  si double parkers par historique
                                                
                        $powrap+=(($rap)**2);
                        break;
                   }
                            $hb=DB::table('historiques')->where("user_id","=",$user->id)->where("marker_id","=",$item2)->get();
                            foreach ($hb as $historique){
                               $rbp=($historique->votes)-$rb;//set le marker de historique  par  array et eleminer  si double parkers par historique
                                $powrbp+=(($rbp)**2);
                                break;
                         }

                         $ab+=$rap*$rbp;
                         
                         //echo "ab : ".$ab."  powrap :".$powrap."  powrap :".$powrbp.'<br/>';
               }if ($powrap==0 OR $powrbp==0) {
                    return "NAN";
                }else {
                 
                        //CALCUL similarti (user1,user2)
                        $sim=$ab/(sqrt($powrap)*sqrt($powrbp));
                        /**
                         * round(1.5,0,PHP_ROUND_HALF_UP)=2
                         * round(1.5,0,PHP_ROUND_HALF_DOWN)=1
                         * round(1.5,0,PHP_ROUND_HALF_EVEN)=2
                         * round(1.5,0,PHP_ROUND_HALF_ODD)=1
                         */
                        $sim=round($sim,2);//9IMA mo9arab bzyad ila miaat 0.001 
                        return $sim;
             
                   }
            }
       }
    }
    
    /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |     function getSimilarity User User              |             | 
     *              |           Algoritm  Pearsonn                      |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
    public function getPearsonSimilartyUserUser()
    {    $users=$this->tableUsers;//table users que visiter miniment 2 Item
         $tableSim=[];//table de similarty user user
         $u=0;//u égale number de  users
         foreach ($users as $tab1) {
             $j=0;
             foreach ($users as $tab2) {
                 if ($tab1->id==$tab2->id) { 
                     $tableSim[$u][$j]=array($tab2->id,$tab2->name,1);
                 }elseif($u>$j) {
                     $tableSim[$u][$j]=$tableSim[$j][$u];
                    
                 }else{
                     
                     $tableSim[$u][$j]=array($tab2->id,$tab2->name,$this->setPearsonSimilartyUserUser($tab1->id,$tab2->id));
                    
                 }
                 
                 $j++;
             }
             $u++;
         }
         return view('Similarty.TableSimilarty',['pearson'=>$tableSim]);
     }

     
    /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |     function setSimilarity User User              |             | 
     *              |           Algoritm  Pearsonn                      |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
    public function setPearsonSimilartyUserUser($user1,$user2)
    {
        $ra=0;
        $his1= DB::table('users')->where("id","=",$user1)->get();
        $his2= DB::table('users')->where("id","=",$user2)->get();
        
        foreach($his1 as $hi){
         $ra=$hi->moyanne;//get moiyan  de vote user a
        }
        if ($ra==0) {
            $sim="NAN";
            return $sim;
        }else{
       foreach($his2 as   $hi){
        $rb=$hi->moyanne;//get moiyan  de vote user b
       }
       if ($rb==0) {
        $sim="NAN";
        return $sim;//resilta 0
         }else{
          $ab=0;//$ab= mjmo3 i=0 et i->n (rap)*(rbp)
          $powrap=0;//$powrap= (rap-ra)^2
          $powrbp=0;//$powrbp= (rbp-rb)^2
          $markers=DB::table('markers')->get();
          
          $markers=$this->tableMarkers;//get tout markers que note users
          foreach ($markers as $marker){
             $rap=0;
             $rbp=0;
             //select  tout  les markers de historique 
             $ha=DB::table('historiques')->where("user_id","=",$user1)->where("marker_id","=",$marker->id)->get();
             foreach ($ha as $historique){
                           $rap=(($historique->votes)-$ra);//set le marker de historique  par  array et eleminer  si double parkers par historique
                          
                           $powrap+=($rap)**2;
                            break;
             }
                  $hb=DB::table('historiques')->where("user_id","=",$user2)->where("marker_id","=",$marker->id)->get();
                  foreach ($hb as $historique){
                            $rbp=($historique->votes)-$rb;//set le marker de historique  par  array et eleminer  si double parkers par historique
                            $powrbp+=(($rbp)**2);;
                            break;
               }
               $ab+=$rap*$rbp;
          }if ($powrap==0 OR $powrbp==0) {
              return "NAN";
          }else {
              
                //CALCUL similarti (user1,user2)
                $sim=$ab/(sqrt($powrap)*sqrt($powrbp));
                /**
                 * round(1.5,0,PHP_ROUND_HALF_UP)=2
                 * round(1.5,0,PHP_ROUND_HALF_DOWN)=1
                 * round(1.5,0,PHP_ROUND_HALF_EVEN)=2
                 * round(1.5,0,PHP_ROUND_HALF_ODD)=1
                 */
                $sim=round($sim,2);//ubdat $sim  ila  9IMA mo9arab bzyad ila miaat 0.001 
                //echo ($sim).'<br/>';
                //$union= DB::table('historiques')->where("user_id","=",$user2)->union($his1)->get();
                // return "mjmo3 i=0 et i->n(rap-ra)*(rbp-rb) = ".$ab."  la mjmo3 i=0 et i->n (rap-ra)^2 =".$powrap."  la mjmo3 i=0 et i->n (rbp-rb)^2 =".$powrbp;
                return $sim;
          }
        }
      }

    }
     
    /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |     function getSimilarity Item Item              |             | 
     *              |           Algoritm  Slop One                      |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
    public function getSlopOneSimilartyItemItem()
    {
        $markers=$this->tableMarkers;
        
        $tableSim=array();//table de similartyer
        $u=0;//$U egale nomber de Item
       $arrayfin=[];
       foreach ($markers as $tab1) {
           $j=0;
           foreach ($markers as $tab2) {
               
            if ($tab1->id==$tab2->id) { 
                
                $tableSim[$u][$j]=array($tab2->id,$tab2->tetle,0,1);
            }elseif($u>$j) {
                    $dev=$tableSim[$j][$u][2];
                    if ($dev<>"NAN") {
                       $dev=floatval($dev);
                       $dev=(-1)*$dev;
                       //$float_value_of_var = floatval($var);
                    }
                   $tableSim[$u][$j]=array($tableSim[$j][$u][0],$tableSim[$j][$u][1],$dev,0);
                  
               }else{
                   
                $tableSim[$u][$j]=array($tab2->id,$tab2->tetle,$this->setSlopOneSimilartyItemItem($tab1->id,$tab2->id),0);
               
            }
               
               $j++;
           }
           $u++;
       }
       return view('Similarty.TableSimilarty',['pearsonitem'=>$tableSim,'slopOne'=>"SlopOne"]);

    }
    /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |     function setSimilarity Item Item              |             | 
     *              |           Algoritm  Slop One                      |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
    public function setSlopOneSimilartyItemItem($a,$b)
    {
      $item1=DB::table('historiques')->where("marker_id","=",$a)->get();
        $som=0;
         $card=0;
        //$item2=DB::table('historiques')->where("marker_id","=",$b);
        foreach ($item1 as $item) {
        $item2=DB::table('historiques')->where([["marker_id","=",$b],["user_id","=",$item->user_id]])->get();
         foreach ($item2 as $value) {
             $som+=($item->votes )-($value->votes );
             $card++;
         }
      
      }
        if ($card==0) {
            return "NAN";
        }else {
            $dev=$som/$card;
            $dev=round($dev,2);
            return $dev;
        }
    }
    /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |     function getSimilarity Thise auth             |             | 
     *              |           Algoritm  Pearsone                      |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
    public function getPearsonSimilartyThiseaAuth($idI)
    {
        $i=0;
        $data=array();
        $arrayuser=array();
        $users=$this->tableUsers;//table users que visiter miniment 2 Item 
        foreach ($users as $user) {
                if ($user->id<>$idI) {
                    $simi=$this->setPearsonSimilartyUserUser($idI,$user->id);
                    if ($simi<>"NAN") {
                        $data[]=array('id'=>$user->id,'name'=>$user->name,'image'=>$user->image,'sim'=>$simi);
                    }
                }
        }
        if ($data<>null) {
            
        foreach($data as $key=>$row){
            $name[$key]=$row['name'];
            $image[$key]=$row['image'];
            $sim[$key]=$row['sim'];
        }
        array_multisort($sim, SORT_DESC, $data);
        }
        return view('Similarty.TableSimilarty',['Mypearson'=>$data]);
    }
    /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |     function getPrediction  Item Base             |             | 
     *              |           Algoritm  Pearsone                      |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
    public function getPearsonPredictionItemBase()
    {
        
        $markers=$this->tableMarkers;
        $users=$this->tableUsers;
       $u=0;
       $tabePrediction=[];
       $rest="folse";
       //dd($arraymarker);
       foreach ($users as $user) {
           $j=0;
           foreach ($markers as $marker) {
            $rest="false";
              $histouser=DB::table('historiques')->where('user_id','=',$user->id)->where('marker_id','=',$marker->id)->get();
              foreach ($histouser as $hi){
                  $tabePrediction[$u][$j]=array($user->id,$user->name,$user->image,$hi->marker_id,$marker->tetle,$hi->votes,0);
                  $rest="treu";
              }
             if ($rest=="false") { 
                $tabePrediction[$u][$j]=array($user->id,$user->name,$user->image,$marker->id,$marker->tetle,$this->setPearsonPredictionItemBase($user->id,$marker->id),1);
               }
               
               $j++;
           }
           $u++;
       }
       //dd($arraymarker);
        return view('Similarty.TableSimilarty',['pred'=>$tabePrediction,'markers'=>$markers]);
    }
    
    /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |     function setPrediction  Item Base             |             | 
     *              |           Algoritm  Pearsone                      |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
    public function setPearsonPredictionItemBase($user,$item){

        $somsim=0;//la somme de evolation user (rui-ripar)*sim(i,j)
        $prot=0;//somme de similarty item i,j
            
        $historiques=DB::table('historiques')->where('user_id','=',$user)->get();
        foreach ($historiques as $hist) {
            
            $markers=$this->tableMarkers->where("id","=",$hist->marker_id);
            foreach ($markers as $marker) {
                $sim=$this->setPearsonSimilartyItemItem($item,$hist->marker_id);
                if ($sim<>"NAN") {
                    $prot +=(($hist->votes)-$marker->moy)*$sim;
                    $sim=sqrt(($sim**2));
                    $somsim +=$sim;
                }
                break;
            }
        
        }
      if ($somsim==0) {
        /**
         * $markers=DB::table('markers')->where('id','=',$item)->get();
        *foreach ($markers as $marker) {
            
        * $pred=$marker->moy;
        *}
         */
       return "NAN";
    }else { 
        $markers=DB::table('markers')->where('id','=',$item)->get();
        foreach ($markers as $marker) {  
         $pred=( $prot/$somsim)+$marker->moy;
         //$pred=( $prot/$somsim);
        }
         $pred=round($pred,2);
       //  echo $pred.'<br/>';
         return  $pred;
    }
    }
     
    /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |     function getPrediction  Item Base             |             | 
     *              |           Algoritm  Slope One                     |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
    public function getSlopOnePredictionItemBase()
    {
        
        $markers=$this->tableMarkers;
        $users=$this->tableUsers;
       $u=0;
       $tabePrediction=[];
       $rest="folse";
       //dd($arraymarker);
       foreach ($users as $user) {
           $j=0;
           foreach ($markers as $marker) {
            $rest="false";
              $histouser=DB::table('historiques')->where('user_id','=',$user->id)->where('marker_id','=',$marker->id)->get();
              foreach ($histouser as $hi){
                  $tabePrediction[$u][$j]=array($user->id,$user->name,$user->image,$hi->marker_id,$marker->tetle,$hi->votes,0);
                  $rest="treu";
              }
             if ($rest=="false") { 
                $tabePrediction[$u][$j]=array($user->id,$user->name,$user->image,$marker->id,$marker->tetle,$this->setSlopOnePredictionItemBase($user->id,$marker->id),1);
               }
               
               $j++;
           }
           $u++;
       }
       //dd($arraymarker);
        return view('Similarty.TableSimilarty',['pred'=>$tabePrediction,'predSlopOne'=>"slop one",'markers'=>$markers]);
    }
    /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |     function setPrediction  Item Base             |             | 
     *              |           Algoritm  Slope One                     |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
    public function setSlopOnePredictionItemBase($user,$item)
    {
        $somcard=0;
        $prot=0;
            
        $historiques=DB::table('historiques')->where('user_id','=',$user)->get();
        foreach ($historiques as $hist) {
            //  $true=DB::table('markers')->where("id","=",$hist->marker_id)->get();
              
                $markers=$this->tableMarkers->where("id","=",$hist->marker_id);
              foreach ($markers as $value) {
                $dev=$this->setSlopOneSimilartyItemItem($item,$hist->marker_id);
                if ($dev<>"NAN") {
                    $card=$this->card($item,$hist->marker_id);
                    $somcard +=$card;
                     $prot +=(($hist->votes)+$dev)*$card;
                }
                break;
              }
        }
        if($somcard==0) { 
            return "NAN";
        }else {
            $pred=$prot/$somcard;
            $pred=round($pred,2);
            return $pred;
        }

    }
    /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |         function card  Item  Algoritm             |             | 
     *              |                     Slope One                     |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */

    public function card($a,$b){
        
        $item1=DB::table('historiques')->where("marker_id","=",$a)->get();
         $card=0;
        //$item2=DB::table('historiques')->where("marker_id","=",$b);
        foreach ($item1 as $item) {
        $item2=DB::table('historiques')->where([["marker_id","=",$b],["user_id","=",$item->user_id]])->get();
         foreach ($item2 as $value) {
        // $som+=($item->votes )-($value->votes );
             $card++;
         }
      
      }return $card;
    }

    
     
    /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |     function get Table Historique                 |             | 
     *              |        Aficher table Historique                   |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
    public function getTableHistorique()
    {
        
        $markers=$this->tableMarkers;
        $users=$this->tableUsers;
       $u=0;
       $tabePrediction=[];
       $rest="folse";
       //dd($arraymarker);
       foreach ($users as $user) {
           $j=0;
           foreach ($markers as $marker) {
            $rest="false";
              $histouser=DB::table('historiques')->where('user_id','=',$user->id)->where('marker_id','=',$marker->id)->get();
              foreach ($histouser as $hi){
                  $tabePrediction[$u][$j]=array($user->id,$user->name,$user->image,$marker->id,$marker->tetle,$hi->votes,0);
                  $rest="treu";
              }
             if ($rest=="false") { 
                $tabePrediction[$u][$j]=array($user->id,$user->name,$user->image,$marker->id,$marker->tetle,"?",1);
               }
               
               $j++;
           }
           $u++;
       }
       //dd($arraymarker);
       return view('Similarty.TableSimilarty',['pred'=>$tabePrediction,'TableHistorique'=>"slop one",'markers'=>$markers]);
    }

    
    /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |     function get Table Historique                 |             | 
     *              |        Aficher table Historique                   |             |
     *              |                   Totale                                |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
    public function getTableHistoriqueTotal()
    {
        
        $users=DB::table('users')->where("nb_visited",">=",1)->get();
        $markers=DB::table('markers')->where("nb_visited",">=",1)->get();

       $u=0;
       $tabePrediction=[];
       $rest="folse";
       //dd($arraymarker);
       foreach ($users as $user) {
           $j=0;
           foreach ($markers as $marker) {
            $rest="false";
              $histouser=DB::table('historiques')->where('user_id','=',$user->id)->where('marker_id','=',$marker->id)->get();
              foreach ($histouser as $hi){
                  $tabePrediction[$u][$j]=array($user->id,$user->name,$user->image,$marker->id,$marker->tetle,$hi->votes,0);
                  $rest="treu";
              }
             if ($rest=="false") { 
                $tabePrediction[$u][$j]=array($user->id,$user->name,$user->image,$marker->id,$marker->tetle,"?",1);
               }
               
               $j++;
           }
           $u++;
       }
       //dd($arraymarker);
       return view('Similarty.TableSimilarty',['pred'=>$tabePrediction,'TableHistoriqueTotale'=>"Historique",'markers'=>$markers]);
    }

    /*********************************************************************************|     
     *                                                                            |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |     function getPrediction  User Base             |             | 
     *              |           Algoritm  Pearsone                      |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
    public function getPearsonPredictionUserBase()
    {
        
        $markers=$this->tableMarkers;
        $users=$this->tableUsers;
       $u=0;
       $tabePrediction=[];
       $rest="folse";
       //dd($arraymarker);
       foreach ($users as $user) {
           $j=0;
           foreach ($markers as $marker) {
            $rest="false";
              $histouser=DB::table('historiques')->where('user_id','=',$user->id)->where('marker_id','=',$marker->id)->get();
              foreach ($histouser as $hi){
                  $tabePrediction[$u][$j]=array($user->id,$user->name,$user->image,$hi->marker_id,$marker->tetle,$hi->votes,0);
                  $rest="treu";
              }
             if ($rest=="false") { 
                $tabePrediction[$u][$j]=array($user->id,$user->name,$user->image,$hi->marker_id,$marker->tetle,$this->setPearsonPredictionUserBase($user->id,$marker->id),1);
               }
               
               $j++;
           }
           $u++;
       }
       //dd($arraymarker);
        return view('Similarty.TableSimilarty',['pred'=>$tabePrediction,'UserBase'=>"userBase",'markers'=>$markers]);
    }
    
    
    /**-----------------------------------------------------------------------------------
     *                         ---------------------------------
     *                          function set proting  Algorithme Hybridation Mixte
     *                        : La formule de calcul de la prédiction user-base
     *                 
     *      pred(user,item)= (mjmo3 i=1 et i=>n sim(Ua,Ub)*Rbi)/(mjmo3 i=1 et i=>n sim(Ua,Ub))
     *                        ----------------------------------
     * ------------------------------------------------------------------------------------
     */
    
    /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |     function setPrediction  User Base             |             | 
     *              |           Algoritm  Pearsone                      |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
    function setPearsonPredictionUserBase($user,$item){
        $somsim=0;
        $prot=0;
        $historiques=DB::table('historiques')->where('marker_id','=',$item)->get();
        foreach ($historiques as $hist)
         {
            $sim=$this->setPearsonSimilartyUserUser($user,$hist->user_id);
            if ($sim<>"NAN") 
            {
                $users=DB::table('users')->where('id','=',$hist->user_id)->get();
                foreach ($users as $value)
                 {
                    $prot +=(($hist->votes)-$value->moyanne)*$sim;
                    $somsim +=$sim;
                 }
            }
            //echo $sim."   ".$hist->votes;
        }
        if ($somsim==0)
        {
            $pred="NAN";
           return $pred;
        }else 
        {
            
            $users=DB::table('users')->where('id','=',$user)->get();
            foreach ($users as $value) {
                $pred= ($prot/$somsim)+$value->moyanne;
                $pred=round($pred,2);
            }
             return  $pred;
        }
        
    }

    
    /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |     function Calcule La moyenn Base               |             | 
     *              |                    Historique                     |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
    /** function calculer  la moyene de vote pour user */
    public function CalculeMoyennRatingUserEtItem(){
        $users=DB::table('users')->get();
       
        foreach ($users as $user) {
            $v=0;$nb=0;
           // echo $user->moyanne.'<br/>';
           $historiques=DB::table('historiques')->where("user_id","=",$user->id)->get();
           foreach ($historiques as $hi) {
               $v+=$hi->votes;
               $nb++;
           }
            if ($nb==0) {
                echo "user ".$user->name." pas note".'<br/>';
            }else {
                $m=$v/$nb;
                $m=round($m,2);
                
            $mesajourmo=DB::table('users')->where("id","=", $user->id)->update(['moyanne' =>$m,'nb_visited'=> $nb]);
            //afichage la moyenn ratinge user;
            echo "moyen vote user ".$user->name.$m.'<br/>';
            }
        }
        echo "function de calcule moyene de marker ";
            /**
             * --------------------------------calculer moyen de vote markers----------------------
             */
            $markers=DB::table('markers')->get();
       
        foreach ($markers as $marker) {
            $v=0;$nb=0;
           // echo $user->moyanne.'<br/>';
           $historiques=DB::table('historiques')->where("marker_id","=",$marker->id)->get();
           foreach ($historiques as $hi) {
               $v+=$hi->votes;
               $nb++;
           }
            if ($nb==0) {
                echo "marker ".$marker->tetle." pas note".'<br/>';
            }else {
                $m=$v/$nb;
                $m=round($m,2);
                
            $mesajourmo=DB::table('markers')->where("id","=", $marker->id)->update(['moy' =>$m,'nb_visited'=> $nb]);
            //afichege la moyenn ratinge marker;
            echo "moyen vote user ".$marker->tetle.$m.'<br/>';
            }
        }
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


    
    public function RSA($user)
    { 
        $minRating=3;
        $nb_visite=0;
        $markers=DB::table('markers')->get();
        $users=DB::table('users')->where([["id","=",$user],["nb_visited",">=",1]])->get();
        $users=DB::table('users')->where("id","=",$user)->get();

        $historique=DB::table('historiques')->where('user_id','=',$user)->get();
        // dd($historique,$historique);
         // min ratinge egal 3 =>prid(user,Poi)>=3
          $RS=array();//system rocomondation 
          $poi=[];  
        foreach ($users as $tabuser) {
            $nb_visite=$tabuser->nb_visited;
            $rsa=$tabuser->rsa;
            $rsb=$tabuser->rsb;
            $moyenn=$tabuser->moyanne;
        }
        foreach ($markers as $marker){
            $vi=false;
            foreach ($historique as $key => $value) {
                // $thisHistorique=-1;
                if ($marker->id==$value->marker_id) {
                    $poi[]=array(
                    'id'=>$marker->id,
                    'user_id'=>$marker->user_id,
                    'sra'=>$rsa,
                    'srb'=>$rsb,
                    'URM'=>$moyenn,
                    'NBRU'=>$nb_visite,
                    'title'=>$marker->tetle,
                    'image'=>$marker->image,
                    'lat'=>$marker->lat,
                    'lng'=>$marker->lng,
                    'rating'=>$value->votes,
                    'pepred'=>0,
                    'slopred'=>0,
                    'vi'=>true,
                    'thisHistorique'=>$value->id,
                    'nb_visited'=>$marker->nb_visited,
                    'moyenn'=>$marker->moy);
                    $historique->pull($key);
                    $vi=true;
                }
            }
            if ($vi==false) {
                //system rocomondation SLope One
                if ( $nb_visite>1 AND $marker->nb_visited>1 ) {
                    
                   $slop=$this->setSlopOnePredictionItemBase($user,$marker->id);
                   $pearson=$this->setPearsonPredictionItemBase($user,$marker->id);
                }else {
                    
                $slop="NAN";
                $pearson="NAN";
                }
                
                 if ($slop<>"NAN" AND $pearson<>"NAN") {
                    if($slop >= $minRating AND $pearson< $minRating){
                        $pearson="NAN";
                     }else {
                        $slop="NAN";
                     }
                     $RS[]=array(
                         'user_id'=>$marker->user_id,
                         'sra'=>$rsa,
                         'srb'=>$rsb,
                         'URM'=>$moyenn,
                         'NBRU'=>$nb_visite,
                         'id'=>$marker->id,
                         'title'=>$marker->tetle,
                         'image'=>$marker->image,
                         'lat'=>$marker->lat,
                         'lng'=>$marker->lng,
                         'rating'=>0,
                         
                         'thisHistorique'=>-1,
                         'pepred'=>$pearson,
                        'slopred'=>$slop,
                        'nb_visited'=>$marker->nb_visited,
                        'moyenn'=>$marker->moy);

                 }else {
                    $poi[]=array(
                    'id'=>$marker->id,
                    'sra'=>$rsa,
                    'srb'=>$rsb,
                    'URM'=>$moyenn,
                    'NBRU'=>$nb_visite,
                    'user_id'=>$marker->user_id,
                    'title'=>$marker->tetle,
                    'image'=>$marker->image,
                    'lat'=>$marker->lat,
                    'lng'=>$marker->lng,
                    'rating'=>0,
                    'pepred'=>0,
                    'slopred'=>0,
                    'vi'=>false,
                    'thisHistorique'=>-1,
                    'nb_visited'=>$marker->nb_visited,
                    'moyenn'=>$marker->moy);
                 }
               
            }
        }

       
    if ($RS<>null) {
       if ($rsa>=$rsb) {
           $order="pepred";
       }else{
        $order="slopred";
       }
       /** fin system rocomndation */
       foreach ($RS as $key => $row) {
            $rating[$key]  = $row[$order];
         }

         // ترتيب البيانات حسب الحجم تنازليًا، وحسب الإصدار تصاعديًا
         // إضافة data$ كآخر وسيط للترتيب حسب المفتاح المشترك
         array_multisort($rating, SORT_DESC, $RS);
    }
       
   // dd($poi,$RS);
   return response()->json(['poi'=>$poi,'RS'=>$RS,"SR"=>"B"]);

       // return view('home',['poi'=>$poi,'RS'=>$RS,"SR"=>"A"]);
    }
}
