{{--@extends('layouts.app')

@section('content')--}}
     <link href="{{asset('font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet">
     <link rel="stylesheet" href="{{asset('bootstrap-icons/bootstrap-icons.css')}}">

<div class="container-fluid">
    
    <!-- Fonts 
        
    <link href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" rel="stylesheet"/> -->
    {{-- style css fonts zise--}}
    <!--Style les graph -->
    <link rel="stylesheet" href="{{asset('leaflet/leaflet.css')}}"  />
    
    <link rel="stylesheet" href="{{asset('css/openstreet.css')}}">
    <script src="{{asset('leaflet/leaflet.js')}}" i></script>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="page-title-box">
                           <div class="row align-items-center">
                               <div class="col-sm-6">
                                   <h4 class="page-title"><span><i class="icon-map"></i></span> OpenstreetMap</h4>
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
@auth
               
                <div class="row">
                  <div id="map" class="col-md-12 col-lg-6 col-xl-6 mb-3"> </div>
                  <div class="row col-md-12 col-lg-6 col-xl-6  div_img_rs "style="">
                    </div>
                 </div>

<script>
   var map
   var user_id=$('#user_id').val()
   map = L.map('map').setView([36.533340, 1.574312], 11);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);
    rest()
function rest(){
    
   var markerroc = new Array();
   var marker = new Array();
    $.ajax({
   url:"/RA"+user_id,
   method:"GET",
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
     
   {   
      
       // iconOptions
       // stare poi pas rocomnder
        data.poi.forEach((val,index)=>{
            let vi="false"
            let stare="";
             var bg_vi=""
             let customIcon="";
             let myIcon="";
              let iconOptions="";
            for ( var j = 5; j > 0; j-- ) {
                     if((val.rating>=j) &&( val.rating<j+1)){ bg_vi="bg-vi"
                        stare +='<input type="radio" name="rating" checked value="'+j+'"><span class=" star"></span>';
                        vi="true";
                        //and icon poi diga visited
                        customIcon = {
                            iconUrl:"icons/visiter.png",
                            iconSize:[30,45],
                           // iconAnchor: [10, 29],
                          //  popupAnchor:[0,-29]
                            
                              shadowSize:   [50, 64], // size of the shadow
                              iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
                              shadowAnchor: [4, 62],  // the same for the shadow
                              popupAnchor:  [0, -40] // point from which the popup should open relative to the iconAncho
    
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
                                '<span class="d-inline-block text-truncate" style="max-width:150px; color:red"><h6>'+ val.title+
                                    '</h6></span>'+
                                '</div>'+
                               '<img src="public/marker/'+val.image+'" class="figure-img img-fluid rounded"  alt="..." style="min-hiegth:150px">'+
                               '<figcaption class="figure-caption text-center">'+
                               
                               '<i class="bi bi-telephone-fill text-Danger"> : 0658140866</i>'+
                               '</figcaption >'+
                               '<figcaption class="figure-caption text-center">'+
                               '<i class="bi bi-geo-fill text-Danger">:localisation</i>'+
                                '</figcaption >'+
                             '<form id="rating-form'+val.id+'" class="historique_forms" action="/addhistorique" method="get">'+                    
                                            '<input id="ids" type="text" name="id_user" value="{{ Auth::user()->id }}">'+
                                            
                                             '<input type="hidden" name="visite" value="'+val.thisHistorique+'">'+
                                            '<input id="ids" type="text" name="name" value="{{ Auth::user()->name }}">'+
                                            '<input type="hidden" name="image" value="{{ Auth::user()->image }}">'+
                                              '<input id="ids" type="text" name="title" value="'+ val.title+'">'+
                                             '<input id="ids" type="text" name="nb_visite_user" value="'+val.NBRU+'">'+
                                            '<input id="ids" type="text" name="moyenn_user" value="'+val.URM+'">'+
                                            '<input id="lat'+val.id+'" type="hidden" name="lat" value="'+val.lat+'">'+
                                           '<input id="lng'+val.id+'" type="hidden" name="lng" value="'+val.lng+'">'+

                                '<input id="ids" type="text" name="nb_visite_marker" value="'+val.nb_visited+'">'+
                                ' <input id="ids" type="text" name="moyenn_marker" value="'+val.moyenn+'">'+

                                '<input id="ids" type="text" name="user_marker" value="'+val.user_id+'">'+
                                ' <input id="ids" type="text" name="id_marker" value="'+val.id+'">'+
                               '<figcaption class="figure-caption text-center">'+
                                   '<small class="text-muted">'+
                                       '<span class="rating-star">'+
                                        stare+
                                          '</span>'+
                                    '</small>'+
                                 '</figcaption>'+
                                 '<figcaption class="figure-caption text-center">'+
                                  '<button type="button" class="button button-sev addHistorique" value="'+val.id+'">save</button> '+
                                 '</figcaption>'+
                              '</form>'+
                            '</figure>'+
                        '</div>'

            var LamMarker = new L.marker([val.lat, val.lng],iconOptions).bindPopup(info);
            marker.push(LamMarker);
            map.addLayer(marker[index]);
        })
        // end poi pa rocomnder
       // star poi 
     $('.div_img_rs').html("")
        data.RS.forEach((val,index)=>{
           // get image ser div
          
           var slops=""
           var pepreds=""
           if (val.slopred !="NAN") {
                                        slop='<figcaption class="figure-caption"><small class="text-muted">rating  slope one :'+val.slopred+'</small></figcaption>';
                                     
                                      }
                                      if (val.pepred!="NAN") {
                                        pepred=' <figcaption class="figure-caption"><small class="text-muted">rating : pearson :'+val.pepred+'</small></figcaption>';
                                  }
            $('.div_img_rs').append( '<figure class="figure col-xl-4 col-lg-12 col-md-12 col-sm-12 ">'+
                                    '<img src="public/marker/'+val.image+'" class="figure-img img-fluid rounded"  alt="..."style="max-height:100px;min-width:100%">'+
                                    '<div class="table-responsive" style="max-height: 25px"><figcaption class="figure-caption" >'+val.title+'</figcaption></div>'+
                                    slops  +pepreds+
                                      
                                '</figure>')
            //end get image
            let color="";
             
             let customIcon="";
             let myIcon="";
              let iconOptions="";
            if ((val.pepred!="NAN")&&(val.slopred!="NAN")) {
                color="bg-success";
                //and icon poi diga visited
                        customIcon = {
                            iconUrl:"icons/intersection_prev_ui.png",

                            iconSize:[30,45],
                           // iconAnchor: [10, 29],
                          //  popupAnchor:[0,-29]
                            
                              shadowSize:   [50, 64], // size of the shadow
                              iconAnchor:   [11, 45], // point of the icon which will correspond to marker's location
                              shadowAnchor: [4, 62],  // the same for the shadow
                              popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAncho
    
                        }
                        //end icon poi visited
             }else if((val.pepred!="NAN")&&(val.slopred=="NAN")){
                color="bg-danger";
                 //and icon poi diga visited
                 customIcon = {
                            iconUrl:"icons/images_prev_ui.png",
                            
                              iconSize:[30,45],
                              shadowSize:   [50, 64], // size of the shadow
                              iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
                              shadowAnchor: [4, 62],  // the same for the shadow
                              popupAnchor:  [0, -40] // point from which the popup should open relative to the iconAncho
                        }
                        
                        //end icon poi visited
             }else if((val.pepred=="NAN")&&(val.slopred!="NAN")){
                color="RSSloPea ";
                 //and icon poi diga visited
                 customIcon = {
                            iconUrl:"icons/ACO_prev_ui.png",
                             
                              iconSize:[30,45],
                              shadowSize:   [50, 64], // size of the shadow
                              iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
                              shadowAnchor: [4, 62],  // the same for the shadow
                              popupAnchor:  [0, -40] // point from which the popup should open relative to the iconAncho
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
                                '<span class="d-inline-block text-truncate" style="max-width:   150px;"><h6>'+ val.title+
                                    '</h6></span>'+
                                '</div>'+
                               '<img src="public/marker/'+val.image+'" class="figure-img img-fluid rounded"  alt="...">'+
                               '<figcaption class="figure-caption text-center">'+
                               
                               '<i class="bi bi-telephone-fill text-Danger"> : 0658140866</i>'+
                               
                               '</figcaption >'+
                               '<figcaption class="figure-caption text-center">'+
                               '<i class="bi bi-geo-fill text-Danger">:localisation</i>'+
                                '</figcaption >'+
                             '<form id="rating-form'+val.id+'" class="historique_forms" action="/addhistorique" method="get">'+ 
                                '<input id="ids" type="text" name="id_user" value="{{ Auth::user()->id }}">'+
                                    '<input id="ids" type="text" name="name" value="{{ Auth::user()->name }}">'+
                                    '<input type="hidden" name="image" value="{{ Auth::user()->image }}">'+
                                              '<input id="ids" type="text" name="title" value="'+ val.title+'">'+
                                '<input id="ids" type="text" name="id_user_sra" value="'+val.sra+'">'+
                                '<input id="ids" type="text" name="id_user_srb" value="'+val.srb+'">'+
                                '<input type="hidden" name="visite" value="'+val.thisHistorique+'">'+
                                '<input id="ids" type="text" name="user_marker" value="'+val.user_id+'">'+
                                ' <input id="ids" type="text" name="id_marker" value="'+val.id+'">'+

                                 '<input id="ids" type="text" name="nb_visite_user" value="'+val.NBRU+'">'+
                                '<input id="ids" type="text" name="moyenn_user" value="'+val.URM+'">'+

                                
                                
                                '<input id="lat'+val.id+'" type="hidden" name="lat" value="'+val.lat+'">'+
                                '<input id="lng'+val.id+'" type="hidden" name="lng" value="'+val.lng+'">'+


                                '<input id="ids" type="text" name="nb_visite_marker" value="'+val.nb_visited+'">'+
                                ' <input id="ids" type="text" name="moyenn_marker" value="'+val.moyenn+'">'+

                                ' <input id="ids" type="text" name="RS" value="true">'+
                                '<input id="ids" type="text" name="SRA" value="'+val.pepred+'">'+
                                '<input id="ids" type="text" name="SRB" value="'+val.slopred+'">'+
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
                                 '<figcaption class="figure-caption text-center">'+
                                  '<button type="button" class="button button-sev addHistorique" value="'+val.id+'">save</button> '+
                                 '</figcaption>'+
                              '</form>'+
                            '</figure>'+
                          '  <div class="text-center" >'+
                               ' <div class="spinner-grow"  style="margin:-40%;width: 3rem; height: 3rem;background-color: rgba(51, 136, 255, 0.626);"role="status">'+
                                    ' <span class="sr-only">Loading...</span>'+
                               ' </div>'+
                            '</div>'+
                        '</div>';
                        var LamMarker = new L.marker([val.lat, val.lng],iconOptions).bindPopup(info);
                        markerroc.push(LamMarker);
                       map.addLayer(markerroc[index]);
          var circle = new L.circle([val.lat,val.lng], {
            color: 'background-color: rgba(51, 136, 255, 0.626);',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 100
           }).addTo(map);
        })
           //end poi rocomnder
   }/**,
   complete:function(){
    foreacheData()
        }*/
  })
}
//animation
getLocation()
function getLocation(){
	map.locate({setView: true, enableHighAccuracy: true})
	.on('location found', function(e){
		var marker = new L.marker(e.latlng);
		marker.addTo(map);
	});
}


</script>


<script>


     /********************************************************************************|
     *                                                                               |
     *                                                                               |
     *                       fonction add istorique                                  |
     *                                                                               |
     *                                                                               |
     *                                                                               |
     * ******************************************************************************|
     */
     $(document).on('click', '.addHistorique', function (e) {
        e.preventDefault();
        var lat= $("#lat"+$(this).val()).val();
        var lng= $("#lng"+$(this).val()).val();
                 
        var all_data = $("#rating-form"+$(this).val()+" :input").serializeArray();
      
        $.ajax({
            type: "GET",
            url: "/addhistorique",
            data:all_data,
            dataType: "json",
            success: function (response) {
                  
                 lastaddPOI(lat,lng)
            }
        });
       
    
    });

/************************************************************************************|
*                                                                                    |
*                                                                                    |
*                           Function  last historique                                |
*                                                                                    |
*                                                                                    |
 ************************************************************************************* 
 */
    
function lastaddPOI(lat,log){
        
    map.remove();
             map = L.map('map').setView([Number(lat),Number(log)], 14);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
              attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
             }).addTo(map);

             rest()
              
            
}

</script>
@endauth

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('Leaflet.MovingMarker-master/MovingMarker.js')}}"></script>

{{--@endsection--}}