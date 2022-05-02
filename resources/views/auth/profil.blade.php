

     <!-- icons-->
     <link href="{{asset('font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('bootstrap-icons/bootstrap-icons.css')}}">
<link rel="stylesheet" href="{{asset('leaflet/leaflet.css')}}"  />

<link rel="stylesheet" href="{{asset('css/openstreet.css')}}">
<script src="{{asset('leaflet/leaflet.js')}}"></script>
<style>
 
}@media (min-width: 720px) {
  .leaflet-top .leaflet-control  {
  margin-top: 37px;
  }
}
</style>
    <div class="container-fluid">
          <div class="row" >
            <div class="body_map pl-md-2 pr-md-2"style=" heigth:4cm; ">
              <div id="map" class="map"style=" heigth:3cm; "></div>
  
            </div>
          </div>
        <div class="row ">
          <div class="row profil-image"></div>
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
    url:"VI_this_Notification"+user_id,
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
            /*  $('.profil-image').append( '<figure class="figure col-xl-4 col-lg-12 col-md-12 col-sm-12 ">'+
                                     '<img src="public/marker/'+val.image+'" class="figure-img img-fluid rounded"  alt="..."style="max-height:100px;min-width:100%">'+
                                     '<div class="table-responsive" style="max-height: 25px"><figcaption class="figure-caption" >'+val.title+'</figcaption></div>'+
                                     slops  +pepreds+
                                       
                                 '</figure>')

*/var nb_evo=""
var nb_comm=""
var comm=""
var rating=""
var user=""

var CommonterThisusr=""
if(data.poi[index].user!=null){

    data.poi[index].user.forEach((value,index2)=>{
      
      var starthisuser=""
      if ((!value.comm==null)) {
        CommonterThisusr+='<a class="ml-2" href="#" rel="'+value.user_id+'">'+
              '<div class="media w-100">'+
                  '<img src="public/profile/'+value.image_user+'" class="align-self-center rounded-circle mr-3 ml-2 mb-2"style="width :1cm;heigth:1cm" alt="...">'+
                   '<div class="media-body">'+
                      '<h6 class="mt-2">'+value.name+ '</h6>'+
                      '<p><span class=" ml-2">'+value.comm+'</span></p>'+
                    '</div>'+
                  ' </div>'+
            '</a>'
      }
        
      if ((!value.rating==null) ||(!value.rating==0)) {
        var yes=false
        
         for ( var j = 5; j > 0; j-- ) {
          if((value.rating>=j) &&( value.rating<j+1)){
            yes=true
            if (value.rating==j) {
              starthisuser+='<i class="bi bi-star-fill"></i>'
            }else if(value.rating<j+1){
              starthisuser +='<i class="bi bi-star-half"></i>'
            }

          }else{
            if (yes==false ) {
              starthisuser +='<i class="bi bi-star-fill"></i>'
            }else {
              starthisuser +='<i class="bi bi-star"></i>'
            }
          }
        }
      }
          user +='<a class="ml-2" href="#" rel="'+value.user_id+'">'+
              '<div class="media w-100">'+
                  '<img src="public/profile/'+value.image_user+'" class="align-self-center rounded-circle mr-3 ml-2 mb-2"style="width :1cm;heigth:1cm" alt="...">'+
                   '<div class="media-body">'+
                      '<h6 class="mt-2">'+value.name+ '<span class=" ml-2">'+starthisuser+'</span>'+'</h6>'+
                    '</div>'+
                  ' </div>'+
            '</a>'
                   
    });
   
  }    

if (!val.nb_comm==0) {
  nb_comm=val.nb_comm+' <i class="bi bi-hand-thumbs-up-fill"></i>'
  comm= val.nb_comm+' <i class="bi bi-chat-square-dots"></i>'
}
var star=""
if (!val.moyenn==0) {
var yes=false
  for ( var j = 5; j > 0; j-- ) {
          if((val.moyenn>=j) &&( val.moyenn<j+1)){
            yes=true
            if (val.moyenn==j) {
               star+='<i class="bi bi-star-fill"></i>'
            }else if(val.moyenn<j+1){
              star +='<i class="bi bi-star-half"></i>'
            }

          }else if (j>=1) {
            if (yes==false ) {
             star +='<i class="bi bi-star-fill"></i>'
            }else {
              star +='<i class="bi bi-star"></i>'
            }
          }
          
      }
}
if (!val.nb_rating==0) {
  nb_evo=val.nb_rating
 
}  
 $('.profil-image').append('<div class="col-md-6  col-xl-4 col-lg-4 col-sm-12 ">'+
   '<div class="card mb-4 shadow-sm ">'+
    '<a class=""" href="#" >'+
      '<div class="media">'+
         '<img src="public/profile/{{ Auth::user()->image }}" class="align-self-center rounded-circle mr-3"style="width :1cm;heigth:1cm" alt="...">'+
         '<div class="media-body">'+
              '<h5 class="mt-2">'+val.created_at+'</h5>'+
         '</div>'+
     ' </div>'+
    '</a>'+
  '<dl class="row ml-5">'+
     ' <dt class="col-sm-12 ">'+val.title+'</dt>'+
      '<dd class="col-sm-12">...</dd>'+
   '</dl>'+

       '<img class="bd-placeholder-img card-img-top" width="100%" height="180" src="public/marker/'+val.image+'" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">'+
      '<div class="card-body"> <hr>'+
        '<ul class="list-group list-group-horizontal" style="list-style-type:none">'+
             '<li class="col-sm-4 col-md-4 iem"><i class="bi   bi-eye-fill"></i> vi '+val.nb_visited+ '</li>'+
             // nomber de commenter
              '<li class="col-sm-4 col-md-4">'+comm+'</li>'+
              //moyenn de rating this POI
              '<li class="col-sm-4 col-md-4">'+star+'</li>'+
          '</ul>'+
          '<div class="d-flex  bg-secondary p-0">'+
               '<div class="btn-group dropup col-7  ">'+

                // inpute save title poi
                '<input type="hidden" name="marker_id" id="viewtitle'+val.id+'" value="'+val.title+'">'+

                //input save latuted poi
                '<input type="hidden" name="marker_id" id="viewlat'+val.id+'" value="'+val.lat+'">'+
                //input save latuted poi
                '<input type="hidden" name="marker_id" id="viewlng'+val.id+'" value="'+val.lng+'">'+
                 // inpute save image this poi
                '<input type="hidden" name="marker_id" id="viewimg'+val.id+'" value="'+val.image+'">'+
                //button view route ou open poi adrass
                '<button type="button"class="btn-secondary  w-50" onclick="viewpoi('+val.id+')" value="'+val.id+'">'+
               '    view<i class="fa fa-street-view" aria-hidden="true"></i>'+
               '  </button>'+
               //end button view poi
               '  <button type="button" class="btn-secondary w-50" id="dropdownMenuReference'+val.id+'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">'+nb_comm+'<i class="bi bi-chat-square-dots"></i>'+
               '  </button>'+
               '  <div class="dropdown-menu " style="width:7cm;"aria-labelledby="dropdownMenuReference'+val.id+'">'+
                // liste comnter
                +CommonterThisusr+
    
               '<div class="dropdown-divider"></div>'+
               // star form commnter
               ' <form action="#form-commenter'+val.id+'" method="post">'+
                 //id user  
                '<input  type="hidden" name="user_id" value="{{ Auth::user()->id }}">'+
                //id marker
                '<input type="hidden" name="marker_id" value="'+val.id+'">'+
                    '<a href="#" class="text-secondary float-end  mr-2 " rel="'+val.id+'"onclick="addHistorique('+val.id+')" style="margin-bottom: -2cm;" >'+
                            '<i class="fa fa-send fa-2x "></i>'+//fa_customfloat-end 
                            '</a>'+
                     //textArea       
                    '<textarea class="form-control pr-3" id="validationTextarea" name="commenter" placeholder="Required example textarea" > </textarea>'+
                 
                  '</form>'+
                  //end form commonter
               ' </div>'+
               '</div>'+
               '<div class="btn-group dropup col-5 ml-0"  >'+
               '  <button type="button" class="btn-secondary w-100" id="dropdownMenuRe'+val.id+'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">'+nb_evo+' <i class="bi bi-hand-thumbs-up"></i>'+
               '  </button>'+
               '  <div class="dropdown-menu" style="width:7cm;min-height: 4cm;min-height: 4.5cm"aria-labelledby="dropdownMenuRe'+val.id+'">'+
                
                  
                    //liste ratinge
                      user+
               '    <div class="dropdown-divider"></div>'+
               // stare  form add ratinge
               ' <form action="#form_add_rating'+val.id+'" method="post">'+
                
                '<small class="text-muted">'+
                  '<span class="rating-star">'+
                     '<input type="radio" name="rating"  value="5"><span class=" star"></span>'+
                     '<input type="radio" name="rating" value="4"><span class=" star"></span>'+
                     '<input type="radio" name="rating" value="3"><span class=" star"></span>'+
                     '<input type="radio" name="rating" value="2"><span class=" star"></span>'+
                     '<input type="radio" name="rating" value="1"><span class=" star"></span>'+
                     
                  '</span>'+

                '</small>'+
      
                // function add evalation
                '<a href="#" class="text-secondary ml-3 mb-0 mt-2" rel="'+val.id+'"onclick="addHistorique('+val.id+')" >'+
                      '<i class="fa fa-send fa-2x "></i>'+//fa_customfloat-end 
                      '</a>'+
                '</form>'+
       // end form rating
               '  </div>'+
               '</div>'+
            '</div>'+
      '</div>'+
   '</div>'+
'</div>')


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
                               iconAnchor:   [11, 45], // point of the icon which will correspond to marker's location
                               shadowAnchor: [4, 62],  // the same for the shadow
                               popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAncho
     
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
                                 '<span class="d-inline-block text-truncate" style="max-width:   150px;"><h6>'+ val.title+
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
                                             '<input type="hidden" name="visite" value="'+vi+'">'+
                                             '<input id="ids" type="text" name="name" value="{{ Auth::user()->name }}">'+
                                             '<input type="hidden" name="image" value="{{ Auth::user()->image }}">'+
                                             
                                               '<input id="ids" type="text" name="title" value="'+ val.title+'">'+
                                 '<input id="ids" type="text" name="nb_visite_user" value="{{ Auth::user()->nb_visited }}">'+
                                 ' <input id="ids" type="text" name="moyenn_user" value="{{ Auth::user()->moyanne }}">'+
 
                                 
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
                         '</div>';
 
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
             $('.profil-image').append( '<figure class="figure col-xl-4 col-lg-12 col-md-12 col-sm-12 ">'+
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
                            // iconAnchor: [10, 29],
                           //  popupAnchor:[0,-29]
                             
                               shadowSize:   [50, 64], // size of the shadow
                               iconAnchor:   [11, 45], // point of the icon which will correspond to marker's location
                               shadowAnchor: [4, 62],  // the same for the shadow
                               popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAncho
                         }
                         
                         //end icon poi visited
              }else if((val.pepred=="NAN")&&(val.slopred!="NAN")){
                 color="RSSloPea ";
                  //and icon poi diga visited
                  customIcon = {
                             iconUrl:"icons/ACO_prev_ui.png",
                             iconSize:[30,45],
                            // iconAnchor: [10, 29],
                           //  popupAnchor:[0,-29]
                             
                               shadowSize:   [50, 64], // size of the shadow
                               iconAnchor:   [11, 45], // point of the icon which will correspond to marker's location
                               shadowAnchor: [4, 62],  // the same for the shadow
                               popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAncho
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
                                 '<input id="ids" type="text" name="id_user_sra" value="{{ Auth::user()->rsa }}">'+
                                 '<input id="ids" type="text" name="id_user_srb" value="{{ Auth::user()->rsb }}">'+
                                 '<input type="hidden" name="visite" value="false">'+
                                 '<input id="ids" type="text" name="user_marker" value="'+val.user_id+'">'+
                                 ' <input id="ids" type="text" name="id_marker" value="'+val.id+'">'+
 
                                 
                                 '<input id="ids" type="text" name="nb_visite_user" value="{{ Auth::user()->nb_visited }}">'+
                                 ' <input id="ids" type="text" name="moyenn_user" value="{{ Auth::user()->moyanne }}">'+
 
                                 
                                 
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
                         '</div>';
                         var LamMarker = new L.marker([val.lat, val.lng],iconOptions).bindPopup(info);
                         markerroc.push(LamMarker);
                        map.addLayer(markerroc[index]);
           var circle = new L.circle([val.lat,val.lng], {
             color: 'red',
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
 
 function addHistorique(id){
   alert(id)
 }
 function viewpoi(id){

  let info='<div class="shadow-lg marker ">'+
                           '<figure class="figure ">'+
                              '<div class="badge  text-wrap" style="width: 10rem;">'+
                                 '<span class="d-inline-block text-success" style="max-width:   150px;"><h6>'+$('#viewtitle'+id).val()+
                                     '</h6></span>'+
                                 '</div>'+
                                '<img src="public/marker/'+$('#viewimg'+id).val()+'" class="figure-img img-fluid rounded"  alt="...">'+
                                '<figcaption class="figure-caption text-center">'+
                                
                                '<i class="bi bi-telephone-fill text-Danger"> : 0658140866</i>'+
                                
                                '</figcaption >'+
                                '<figcaption class="figure-caption text-center">'+
                                '<i class="bi bi-geo-fill text-Danger">:localisation</i>'+
                                 '</figcaption >'+
                              '<form id="rating-form'+id+'" class="historique_forms" action="/addhistorique" method="get">'+ 
                                 '<input id="ids" type="text" name="id_user" value="{{ Auth::user()->id }}">'+
                                     '<input id="ids" type="text" name="name" value="{{ Auth::user()->name }}">'+
                                     '<input type="hidden" name="image" value="{{ Auth::user()->image }}">'+
                                               '<input id="ids" type="text" name="title" value="'+ $('#viewtitle'+id).val()+'">'+
                                 '<input id="ids" type="text" name="id_user_sra" value="{{ Auth::user()->rsa }}">'+
                                 '<input id="ids" type="text" name="id_user_srb" value="{{ Auth::user()->rsb }}">'+
                                 '<input type="hidden" name="visite" value="false">'+
                                // '<input id="ids" type="text" name="user_marker" value="'+val.user_id+'">'+
                                 ' <input id="ids" type="text" name="id_marker" value="'+id+'">'+
 
                                 
                                 '<input id="ids" type="text" name="nb_visite_user" value="{{ Auth::user()->nb_visited }}">'+
                                 ' <input id="ids" type="text" name="moyenn_user" value="{{ Auth::user()->moyanne }}">'+
 
                                 
                                 
                                // '<input id="lat'+val.id+'" type="hidden" name="lat" value="'+val.lat+'">'+
                                // '<input id="lng'+val.id+'" type="hidden" name="lng" value="'+val.lng+'">'+
 
 
                                // '<input id="ids" type="text" name="nb_visite_marker" value="'+val.nb_visited+'">'+
                                //' <input id="ids" type="text" name="moyenn_marker" value="'+val.moyenn+'">'+
 
                                 ' <input id="ids" type="text" name="RS" value="false">'+
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
                                   '<button type="button" class="button button-sev addHistorique" value="'+id+'">save</button> '+
                                  '</figcaption>'+
                               '</form>'+
                             '</figure>'+
                         '</div>';

  var marker = new L.marker([Number($('#viewlat'+id).val()),Number($('#viewlng'+id).val())]).addTo(map)
           .bindPopup(info).openPopup();
  //alert($('#viewlng'+id).val())
 }
        </script>