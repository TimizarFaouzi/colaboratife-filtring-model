
@auth
@if (Auth::user()->role<>"empyter")
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            @php
                                if(isset($pearson)){
                                    echo "table de Similarités(user, user)".'<span class="text-success mr-5"> Pearson correlation </span> ';
                                }elseif (isset($pred)) {
                                    if (isset($predSlopOne)) {
                                        echo "table de prsdiction Item Base".'<span class="text-success mr-5"> Rating Base  Algorithem Slop One </span> ';
                                
                                    }elseif (isset($TableHistorique)) {
                                        echo "Table de Historique".'<span class="text-success mr-5"> Historique User mois Les Item visted <1 </span> ';
                                
                                    }elseif (isset($TableHistoriqueTotale)) {
                                        echo "Table de Historique ".'<span class="text-success mr-5"> Totale </span> ';
                                
                                    }elseif(isset($UserBase)){
                                        echo "table de prsdiction User Base ".'<span class="text-success mr-5"> Rating Base  Algorithem Pearsonn </span> ';
                                    }
                                      else {
                                        echo "table de prsdiction Item Base ".'<span class="text-success mr-5"> Rating Base  Algorithem Pearsonn </span> ';
                                
                                    }
                                    
                                    
                                }elseif (isset($Mypearson)) {
                                    echo '<span class="text-success mr-5"> Number of People similar to me </span> ';
                                
                                }elseif (isset($pearsonitem)) {
                                    if (isset($slopOne)) {
                                        echo "table de Similarités(item, item) base ser Algorithem".'<span class="text-success mr-5"> SLope One </span> ';
                                
                                    }else {
                                        echo "table de Similarités(item, item) base ser Algorithem".'<span class="text-success mr-5"> Pearson correlation </span> ';
                                
                                    }
                                    
                                }
                            @endphp
                        </li>
                       {{-- <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Pearson similarity</a>
                          <div class="dropdown-menu">
                            <a class="dropdown-item Calcul-Moyenn-Rating" href="{{route('Calcul.Moyenn.Rating')}}"> Test La moyenn </a>
                            <a class="dropdown-item Similarty-User" href="#"> Symilarty user-user</a>
                            <a class="dropdown-item SimilarityUser-id"  href="#"> Symilarty my-user</a>
                            <a class="dropdown-item Similarty-Item" href="{{route('Similarty.Item')}}"> Symilarty item-item</a>
                            <a class="dropdown-item Similarty-SlopOne" href="{{route('Similarty.SlopOne')}}"> SLOPE ONE</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item table-Historique-Totale'" href="{{route('table.Historique.Totale')}}"> Table Historique </a>
                            <a class="dropdown-item table-Historique" href="{{route('table.Historique')}}">Table Historique -</a>
                            <a class="dropdown-item  predaction-User-base" href="{{route('predaction.User.base')}}"> Predaction avence User-base</a>
                            <a class="dropdown-item predaction-item-base" href="{{route('predaction.item.base')}}"> Predaction avence Item-base</a>
                            <a class="dropdown-item predaction-item-base-SlopOne" href="{{route('predaction.item.base.SlopOne')}}"> Predaction base slope one</a>
                            
                        </div>
                        </li>--}}
                    </ul>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  @auth
                  @php
     /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |     Table getSimilarity User User                 |             | 
     *              |           Algoritm  Pearsonn                      |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
                        
                  @endphp
                  <?php if(isset($pearson)){ ?>
                    <div class="table-responsive-sm table-responsive">
                  <table class="table table-bordered">
                       <thead>
                         <tr class="bg-secondary">
                            <th scope="col">#</th>
                            @php
                               $i=0;
                                foreach ($pearson as $key=>$value){
                                    echo '<th class="text-center bg-secondary" scope="row">
                                            <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="'.$pearson[$i][$i][1].'">
                                               user '.$pearson[$i][$i][0].'
                                             </button>
                                        </th> ';
                                    $i++;
                                }
                                
                                
                            @endphp
                         </tr>
                       </thead>
                       <tbody> 
                           @php 
                                 $u=0;
                                 foreach ($pearson as $key=>$arrayus) {
                                     $j=0;
                                     echo '<tr>';
                                        echo '<th class="text-center bg-secondary" scope="row">
                                            <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="'.$pearson[$u][$u][1].'">
                                               user '.$pearson[$u][$u][0].'
                                             </button>
                                        </th> ';
                                     foreach ($pearson as $key=>$row) {
                                        if ($u==$j) {
                                            echo '<td class="text-center  simcenter">';
                                                 echo '<span class=" text_center">'.$pearson[$u][$j][2].'</span></td> ';
                                            }else {
                                                echo '<td class="text-center  predaction ">';
                                                    if($pearson[$u][$j][2]>=0.75) {
                                                        echo '<span class="text-success">'.$pearson[$u][$j][2].'</span></td> ';
                                        
                                                    }elseif($pearson[$u][$j][2]>=0.50) {
                                                        echo '<span class="text-warning">'.$pearson[$u][$j][2].'</span></td> ';
                                                    }elseif ($pearson[$u][$j][2]>0) {
                                                        # code...
                                                        echo '<span class="text-danger ngatifebliss">'.$pearson[$u][$j][2].'</span></td> ';
                                                    } 
                                                    elseif ($pearson[$u][$j][2]<0) {
                                                        # code...
                                                        echo '<span class="ngatife">'.$pearson[$u][$j][2].'</span></td> ';
                                                    }
                                                    elseif ($pearson[$u][$j][2]==0) {
                                                        # code...
                                                        echo '<span class="ngatife">'.$pearson[$u][$j][2].'</span></td> ';
                                                    }        
                                                }
                                        $j++;
                                     }
                                     $u++;
                                     echo '</tr>';
                                 }
                           @endphp
                       </tbody>
                    </table>
                </div>
                   <?php }?>
                   <?php
    /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |                     Table Rating                  |             | 
     *              |                                                   |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
                        if (isset($pred)) {
                         ?>   
                    <div class="table-responsive-sm table-responsive">        
                    <table id="prediction" class="table table-bordered">
                       <thead>
                         <tr class="bg-success">
                            <th class="bg-danger" scope="col">#</th>
                             <?php
                               $i=0;
                               foreach ($markers as $marker) {
                                echo '<th class="text-center bg-success" scope="row">
                                            <button type="button" class="btn-lick btn-success" data-toggle="tooltip" data-placement="top" title="'.$marker->tetle.'">
                                               item '.$marker->id.'
                                             </button>
                                        </th> ';
                                    $i++;
                                    
                                }
                                
                                
                            ?>
                         </tr>
                       </thead>
                       <tbody> 
                             @php
                                 $u=0;
                                 foreach ($pred as $key=>$arrayus) {
                                     $j=0;
                                     echo '<tr>';
                                        echo '<th class="text-center bg-danger" scope="row">
                                            <button type="button" class="btn-linck btn-danger" data-toggle="tooltip" data-placement="top" title="'.$pred[$u][$u][1].'">
                                               user '.$pred[$u][$u][0].'
                                             </button>
                                        </th> ';

                                        $j=0;
                               foreach ($markers as $marker) {
                                if ($pred[$u][$j][6]==1) {
                                   
                                    echo '<td class="text-center  predaction bg-secondary ">';
                                }else {
                                echo '<td class="text-center ">';
                                }
                                                    if($pred[$u][$j][5]>=4) {
                                                        echo '<span class="text-success">'.$pred[$u][$j][5].'</span></td> ';
                                        
                                                    }elseif ($pred[$u][$j][5]>=3) {
                                                        # code...
                                                        echo '<span class="text-warning">'.$pred[$u][$j][5].'</span></td> ';
                                                    
                                                    }elseif ($pred[$u][$j][5]>=0) {
                                                        # code...
                                                        echo '<span class="text-danger ngatifebliss">'.$pred[$u][$j][5].'</span></td> ';
                                                    
                                                    }else {
                                                        echo '<span class="text-danger ngatifebliss"> NAN</span></td> ';
                                                    
                                                    }
                                    $j++;
                                    
                                }
                                    echo '<tr>';
                                        $u++;

                                    } 
                             @endphp
                       </tbody>
                    </table>
                    </div>
                        <?php }?>

                        <?php
    /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |     Table getSimilarity Item Item                 |             | 
     *              |           Algoritm  Pearsonn                      |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
    if (isset($pearsonitem)) {
                          # code...
                          ?>
                           <div class="table-responsive-sm table-responsive">
                            <table class="table table-bordered">
                                 <thead>
                                   <tr class="bg-secondary">
                                      <th scope="col">#</th>
                                      @php
                                         $i=0;
                                          foreach ($pearsonitem as $key=>$arrayus){
                                              echo '<th class="text-center bg-secondary" scope="row">
                                                      <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="'.$pearsonitem[$i][$i][1].'">
                                                         Item '.$pearsonitem[$i][$i][0].'
                                                       </button>
                                                  </th> ';
                                              $i++;
                                          }
                                          
                                          
                                      @endphp
                                   </tr>
                                 </thead>
                                 <tbody> 
                                     @php 
                                           $u=0;
                                           foreach ($pearsonitem as $key=>$arrayus) {
                                               $j=0;
                                               echo '<tr>';
                                                  echo '<th class="text-center bg-secondary" scope="row">
                                                      <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="'.$pearsonitem[$u][$u][1].'">
                                                         Item '.$pearsonitem[$u][$u][0].'
                                                       </button>
                                                  </th> ';
                                               foreach ($pearsonitem as $key=>$arrayus) {
                                                 if ($u==$j) {
                                                          
                                                      echo '<td class="text-center simcenter">';
                                                          # code...simcenter
                                                      
                                                    echo '<span class=" text_center">'.$pearsonitem[$u][$j][2].'</span></td> ';
                                                      }else {
                                                          echo '<td class="text-center  predaction ">';
                                                              if($pearsonitem[$u][$j][2]>=0.75) {
                                                                  echo '<span class="text-success">'.$pearsonitem[$u][$j][2].'</span></td> ';
                                                  
                                                              }elseif($pearsonitem[$u][$j][2]>=0.50) {
                                                                  echo '<span class="text-warning">'.$pearsonitem[$u][$j][2].'</span></td> ';
                                                              }elseif ($pearsonitem[$u][$j][2]>0) {
                                                                  # code...
                                                                  echo '<span class="text-danger ngatifebliss">'.$pearsonitem[$u][$j][2].'</span></td> ';
                                                              } 
                                                              elseif ($pearsonitem[$u][$j][2]<0) {
                                                                  # code...
                                                                  echo '<span class="ngatife">'.$pearsonitem[$u][$j][2].'</span></td> ';
                                                              }
                                                              elseif ($pearsonitem[$u][$j][2]==0) {
                                                                  # code...
                                                                  echo '<span class="ngatife">'.$pearsonitem[$u][$j][2].'</span></td> ';
                                                              }        
                                                          }
                                                  $j++;
                                               }
                                               $u++;
                                               echo '</tr>';
                                           }
                                     @endphp
                                 </tbody>
                              </table>
                          </div>


                        <?php }?>

                     <?php 
                     /**
                      * 
                      *
                      **   
                      
                      */
     /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              | parti de  implimontatin de number de people to me |             | 
     *              |           Algoritm  Pearsonn                      |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                                |                                      
     * *******************************************************************************|                                                                 
     */
                        if (isset($Mypearson)) {
                          # code...
                        ?>

                          <!--similarty  this user -->
                            <div class="text-center container  bg-danger ">
                               <div class="card-group  mt-2 " style="position: relative;float: center">
                                  <div class="card   mb-2 bg-secondary mt-2 position-relative">
                                      <img style="width: 100px; height: 100px;" src="public/profile/{{ Auth::user()->image }}" class="rounded mx-auto d-block mt-2 position-relative" alt="this user">
                                      <div class="card-body">
                                        <h5 class="card-title">{{ Auth::user()->name }}</h5>
                                      </div>
                                   </div>
                               </div>
                            </div>
                            
                        <div class="alert-dark card card-group mt-2">
                            <?php $j=0;
                                foreach ($Mypearson as $key => $value) {
                                     echo '<div class="col-md-2">
                            <div class="card alert-secondary text-center mb-2 mt-2">
                                <img src="public/profile/'.$Mypearson[$j]['image'].'" style="width: 100px; height: 100px;"class="rounded mx-auto d-block mt-2 position-relative" alt="user">
                                <div class="card-body">
                                  <h5 class="card-title">'.$Mypearson[$j]['name'].'</h5>
                                  <p class="card-text">
                                      <small class="text-muted"> Similarity :'.$Mypearson[$j]['sim'].
                                      '</small>
                                    </p>
                                </div>
                              </div>
                         </div>';

                                  $j++;
                              } 
                      }
                      
                      ?>

                      {{--
     /*********************************************************************************|     
     *                                                                                |
     *               ----------------------------------------------------             |
     *              |                                                   |             |
     *              |      Table    Matrix   itme user                  |             | 
     *              |           Matrix  Factorisation                   |             |
     *              |                                                   |             |
     *               ----------------------------------------------------             |
     *                                                                            |                                      
     ********************************************************************************|                                          
     */
    --}}
    @if (isset($M_Factorisation))
        
    <div class="table-responsive-sm table-responsive">
        <table class="table table-bordered">
             <thead>
               <tr class="bg-secondary">
                  <th scope="col">#</th>
                  @php
                     $i=0;
                      foreach ($M_Factorisation[0]['rating'] as $key=>$arrayus){
                          echo '<th class="text-center bg-secondary" scope="row">
                                  <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="'.$M_Factorisation[0]['rating'][$key][1].'">
                                     User '.$M_Factorisation[0]['rating'][$key][0].'
                                   </button>
                              </th> ';
                          $i++;
                      }
                      
                      
                  @endphp
               </tr>
               @foreach ($M_Factorisation as $key=>$item)
                   <tr>
                    <th class="text-center bg-secondary" scope="row">
                        <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="{{$M_Factorisation[$key]['title']}}">
                           Item {{$M_Factorisation[$key]['id']}}
                         </button>
                    </th>
                       @foreach ($M_Factorisation[$key]['rating'] as $key1=>$rating)
                       @if ($M_Factorisation[$key]['rating'][$key1][4]==1)
                       <td class="bg-secondary">
                       @else
                       <td>
                       @endif
                           
                            {{$M_Factorisation[$key]['rating'][$key1][3]}}
                           </td>
                       @endforeach
                   
                   </tr>
               @endforeach
             </thead>
             <tbody> 
             </tbody>
        </table>
    </div>
    @endif

                 @endauth

                </div>
            </div>
        </div>
    </div>
</div>

@endif
@endauth
























