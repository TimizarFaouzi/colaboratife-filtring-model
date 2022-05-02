
<div class="container-fluid">
    
    <!-- Fonts 
        
    <link href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" rel="stylesheet"/> -->
    {{-- style css fonts zise--}}
    <link rel="stylesheet" href="{{asset('css/openstreet.css')}}">
    <!--Style les graph -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="page-title-box">
                           <div class="row align-items-center">
                               <div class="col-sm-6">
                                   <h4 class="page-title"><span><i class="bi bi-table me-2"></i></span> Data Table POI</h4>
                               </div>
                               <div class="col-sm-6">
                                   <ol class="breadcrumb float-right">
                                       <li class="breadcrumb-item"><a href="#">SIA Master</a></li>
                                       <li class="breadcrumb-item active"><a class="text-success ADD_POI"href="#">ADD Un POI</a></li>
                                   </ol>
                               </div>
                           </div>
                           <!-- end row -->
                       </div>
             </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!--
                    <input type="checkbox" class="btn-check" id="btn-check" autocomplete="off" />
                    <label class="btn btn-link " for="btn-check"><i class="bi bi-star noti mr-2"></i></label>
                    <input type="checkbox" class="btn-check" id="btn-check3" autocomplete="off" />
                    <label class="btn btn-link " for="btn-check3"><i class="bi bi-star noti mr-2"></i></label>
-->
@auth
<table id="myTable" >
             
    <?php
                  foreach($poi as $key=>$row){
                    echo '<tr  id="">';
                    echo '<td>' . $row['title']. '</td>';
                    echo '<td>' . $row['lat']. '</td>';
                    echo '<td>' . $row['lng'] . '</td>';
                    echo '<td>' . $row['id']. '</td>';
                    echo '<td>' .$row['image']. '</td>';
                    echo '<td>'.$row['rating'];
                    //echo '<td><img src="file/image/'.$marker->image .'"width="300" height="150" alt="" class="navbar-brand"></td>';
                    
                    echo '</tr>';
                    
                  }
                 ?>
                </table>
                <table id="myTableRS"style="display: none;" >
             
                    <?php
                                  foreach($RS as $key=>$row){
                                    echo '<tr  id="">';
                                    echo '<td>' . $row['title']. '</td>';
                                    echo '<td>' . $row['lat']. '</td>';
                                    echo '<td>' . $row['lng'] . '</td>';
                                    echo '<td>' . $row['id']. '</td>';
                                    echo '<td>' . $row['image'] . '</td>';
                                    echo '<td>' . $row['pepred']. '</td>';
                                    echo '<td>' . $row['slopred'] . '</td>';
                                    //echo '<td><img src="file/image/'.$marker->image .'"width="300" height="150" alt="" class="navbar-brand"></td>';
                                    
                                    echo '</tr>';
                                    
                                  }
                                 ?>
                                </table>
               
                <div class="row">
                  <div id="map" class="col-md-12 col-lg-6 col-xl-6"> </div>
                  <div class="row col-md-12 col-lg-6 col-xl-6 mt-5  }}" style="">
                    {{--<section class="bg-light py-4 my-5">
                      <div class="container">
                          <div class="row">
                              <div class="col-12">
                                  <h2 class="mb-3 text-danger">Bootstrap 5 Cards</h2>
                              </div>
                  
                              <div class="col-md-6 col-lg-4">
                                  <div class="card my-3">
                                      <div class="card-thumbnail">
                                          <img src="https://www.markuptag.com/images/image-one.jpg" class="img-fluid" alt="thumbnail">
                                      </div>
                                      <div class="card-body">
                                          <h5 class="card-title"></h5>
                                          <p class="card-text table-responsive" style="max-height: 40px">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text</p>
                                          <a href="#" class="btn btn-danger">Read More</a>
                                      </div>
                                  </div>
                              </div>
                              
                          </div>
                      </div>
                    </section>--}}
                      
                        <?phP
                        foreach($RS as $key=>$row){
                           // echo '<div class="card col-md-12 col-lg-3 col-xl-3 mt-5 mb-2 mr-3 " style="padding: 0px; ">';
                           $im= $row['image'];
                                echo '<figure class="figure col-xl-4 col-lg-12 col-md-12 col-sm-12 ">
                                    <img src="public/marker/'.$row['image'].'" class="figure-img img-fluid rounded"  alt="...">
                                    <div class="table-responsive" style="max-height: 25px"><figcaption class="figure-caption" >'.$row['title'].'</figcaption></div>';
                                    if ($row['slopred']<>"NAN") {
                                        echo  '<figcaption class="figure-caption"><small class="text-muted">rating  slope one :'.$row['slopred'].'</small></figcaption>';
                                     
                                      }
                                      if ($row['pepred']<>"NAN") {
                                        echo ' <figcaption class="figure-caption"><small class="text-muted">rating : pearson :'.$row['pepred'].'</small></figcaption>';
                                  }
                                echo '</figure>'; 
                        }
                       ?>
                       
                    </div>
                 </div>

<script>
    var srt=$("#srt").val()
    var sra=$("#sra").val()
    var srb=$("#srb").val()
    
    var user_id=$("#user_id").val()
    if (srt=="touts") {
        if (sra>srb) {
            
        srt="sra"
        }else if(sra<srb) {
            
            srt="srb"
            }
            else{
                srt="touts"  
            }
    }
    rest()
function rest(){
    $.ajax({
   url:"/RB"+user_id,
   method:"POST",
   data:{
       srt:srt,
       user:user_id
   },
   dataType:'JSON',
   contentType: false,
   cache: false,
   processData: false,
   
    beforeSend:function(){

        $('.spinner-border ').css('display', 'block');
    },
    statusCode:{
            404:function(){
                alert("الصفحة غير موجودة يرجى المحاولة فيما بعد");
			  },
             401:function(){  
                alert("غير مصرح لك");
			  }
			  
           },
		
    
           success:function(data)
   {  alert()
      // $("#exampleModalCenter").modal('fade');
   // foreacheData()
   }/**,
   complete:function(){
    foreacheData()
        }*/
  })
}
</script>




    <script>
        var map = L.map('map').setView([36.533340, 1.574312], 11);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
       }).addTo(map);
       
       /********************************************************88888888888888888888888888*/
       var table = document.getElementById("myTable");
             var tr = table.getElementsByTagName("tr");
             var td;  
             let lat,lng,tetle,info,id_marker,id_user;
            
    for ( var i = 0; i < tr.length; i++ ) {
             
             td = tr[i].getElementsByTagName("td");
             tetle=td[0].innerHTML.toUpperCase();
             lat=td[1].innerHTML.toUpperCase();
             lng=td[2].innerHTML.toUpperCase();
             id_marker=td[3].innerHTML.toUpperCase();
            let image=td[4].innerHTML.toUpperCase();
             //alert(image)
             var im="public/image/"+image;
             typeof lat;
             typeof lng;
             let stare="";
             var bg_vi=""
             let customIcon="";
             let myIcon="";
              let iconOptions="";

             for ( var j = 5; j > 0; j-- ) {
                     if((td[5].innerHTML.toUpperCase()>=j) &&( td[5].innerHTML.toUpperCase()<j+1)){ bg_vi="bg-vi"
                        stare +='<input type="radio" name="rating" checked value="'+j+'"><span class=" star"></span>';
                        //and icon poi diga visited
                        customIcon = {
                            iconUrl:"icons/visiter.png",
                            iconSize:[30,45]
                        }
                        myIcon = L.icon(customIcon);
               
                        iconOptions = {
                        title:"company name",
                       draggable:true,
                       icon:myIcon
                        }
                        //end icon poi visited
                     }else{
                            stare +='<input type="radio" name="rating"  value="'+j+'"><span class=" star"></span>';
                         }
                    
                 }
            let info='<div class="shadow-lg marker rounded '+bg_vi+'">'+
                          '<figure class="figure ">'+
                             '<div class="badge  text-wrap" style="width: 10rem;">'+
                                '<span class="d-inline-block text-truncate" style="max-width:   150px;"><h6>'+ tetle+
                                    '</h6></span>'+
                                '</div>'+
                               '<img src="public/marker/'+td[4].innerHTML.toUpperCase()+'"     class="figure-img img-fluid rounded"  alt="...">'+
                               '<figcaption class="figure-caption text-center">'+
                               
                               '<i class="bi bi-telephone-fill text-Danger"> : 0658140866</i>'+
                               
                               '</figcaption >'+
                               '<figcaption class="figure-caption text-center">'+
                               '<i class="bi bi-geo-fill text-Danger">:localisation</i>'+
                                '</figcaption >'+
                             '<form id="rating-form"action="/addhistorique" method="get">'+
                                '<input id="ids" type="text" name="id_user" value="{{ Auth::user()->id }}">'+
                                ' <input id="ids" type="text" name="id_marker" value="'+id_marker+'">'+
                               '<figcaption class="figure-caption text-center">'+
                                   '<small class="text-muted">'+
                                       '<span class="rating-star">'+
                                        stare+
                                          '</span>'+
                                    '</small>'+
                                 '</figcaption>'+
                                 '<figcaption class="figure-caption text-center">'+
                                  '<button type="submit" class="button button-sev">save</button> '+
                                 '</figcaption>'+
                              '</form>'+
                            '</figure>'+
                        '</div>';
            var marker = new L.marker([Number(lat),Number(lng)],iconOptions).addTo(map)
           .bindPopup(info);
          //.openPopup();
          //markers.push(marker)
          
         
          }
     
          var rs = document.getElementById("myTableRS");
           var rss = rs.getElementsByTagName("tr");
             var tdr;  
             var late,lnge;
    for ( var i = 0;i < rss.length; i++ ) {
        tdr = rss[i].getElementsByTagName("td");
        tetle=tdr[0].innerHTML.toUpperCase();
        
        id_marker=tdr[3].innerHTML.toUpperCase();
            late=tdr[1].innerHTML.toUpperCase();
            lnge=tdr[2].innerHTML.toUpperCase();
            
            let imagem="public/marker/"+td[4].innerHTML.toUpperCase();
             
             typeof late;
             typeof lnge;
             let color="";
             
             let customIcon="";
             let myIcon="";
              let iconOptions="";
             if ((tdr[5].innerHTML.toUpperCase()!="NAN")&&(tdr[6].innerHTML.toUpperCase()!="NAN")) {
                color="bg-success";
                //and icon poi diga visited
                customIcon = {
                            iconUrl:"icons/intersection_prev_ui.png",
                            iconSize:[30,45]
                        }
                        
                        //end icon poi visited
             }else if((tdr[5].innerHTML.toUpperCase()!="NAN")&&(tdr[6].innerHTML.toUpperCase()=="NAN")){
                color="bg-danger";
                 //and icon poi diga visited
                 customIcon = {
                            iconUrl:"icons/images_prev_ui.png",
                            iconSize:[30,45]
                        }
                        
                        //end icon poi visited
             }else if((tdr[5].innerHTML.toUpperCase()=="NAN")&&(tdr[6].innerHTML.toUpperCase()!="NAN")){
                color="RSSloPea ";
                 //and icon poi diga visited
                 customIcon = {
                            iconUrl:"icons/ACO_prev_ui.png",
                            iconSize:[30,45]
                        }
                        
                        //end icon poi visited
             }
             myIcon = L.icon(customIcon);
               
                        iconOptions = {
                        title:"company name",
                       draggable:true,
                       icon:myIcon
                        }
             let info='<div class="shadow-lg marker  '+color+'">'+
                          '<figure class="figure ">'+
                             '<div class="badge  text-wrap" style="width: 10rem;">'+
                                '<span class="d-inline-block text-truncate" style="max-width:   150px;"><h6>'+ tetle+
                                    '</h6></span>'+
                                '</div>'+
                               '<img src="public/marker/'+tdr[4].innerHTML.toUpperCase()+'"     class="figure-img img-fluid rounded"  alt="...">'+
                               '<figcaption class="figure-caption text-center">'+
                               
                               '<i class="bi bi-telephone-fill text-Danger"> : 0658140866</i>'+
                               
                               '</figcaption >'+
                               '<figcaption class="figure-caption text-center">'+
                               '<i class="bi bi-geo-fill text-Danger">:localisation</i>'+
                                '</figcaption >'+
                             '<form id="rating-form"action="/addhistorique" method="get">'+
                                '<input id="ids" type="text" name="id_user" value="{{ Auth::user()->id }}">'+
                                ' <input id="ids" type="text" name="id_marker" value="'+id_marker+'">'+
                                ' <input id="ids" type="text" name="RS" value="true">'+
                                '<input id="ids" type="text" name="SRA" value="'+tdr[5].innerHTML.toUpperCase()+'">'+
                                '<input id="ids" type="text" name="SRB" value="'+tdr[6].innerHTML.toUpperCase()+'">'+
                               '<figcaption class="figure-caption text-center">'+
                                   '<small class="text-muted">'+
                                       '<span class="rating-star">'+
                                            '<input type="radio" name="rating"  value="5"><span class=" star"></span>'+
                                            '<input type="radio" name="rating" value="4"><span class=" star"></span>'+
                                            '<input type="radio" name="rating" value="3"><span class=" star"></span>'+
                                            '<input type="radio" name="rating" value="2"><span class=" star"></span>'+
                                            '<input type="radio" name="rating" value="1"><span class=" star"></span>'+
                                          '</span>'+
                                    '</small>'+
                                 '</figcaption>'+
                                 '<figcaption class="figure-caption text-center"           style="margin-bottom:-10px">'+
                                    '<button type="submit" class="button button-sev"><i class="fa fa-check"></i>save</button> '+
                                 '</figcaption>'+
                              '</form>'+
                            '</figure>'+
                        '</div>';
             var marker = new L.marker([Number(late),Number(lnge)],iconOptions).addTo(map)
           .bindPopup(info).openPopup();
          var circle = new L.circle([Number(late),Number(lnge)], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 100
           }).addTo(map);

    }
    </script>
    <script src="{{asset('js/stars.js')}}"></script> 
@endauth

                </div>
            </div>
        </div>
    </div>
</div>
