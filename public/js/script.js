var ctx2 = document.getElementById("chart2").getContext("2d");
var colors=new Array()
for(var i=0;i<48;i++){

var randomColor = Math.floor(Math.random()*16777215).toString(16);
colors[i]="#"+randomColor
//document.body.style.backgroundColor = "#" + randomColor;
// color.innerHTML = "#" + randomColor;

}
function getMax(arr, prop) {
  var max;
  var lableval;
  var index;
  for (var i=0 ; i<arr.length ; i++) {
      if (max == null || parseInt(arr[i][prop]) > parseInt(max[prop]))
          max = arr[i];
          lableval=arr[i]['label'];
          index=i;
  }
  return lableval;
}


//dachbord

/*
 Template Name: Jassa - Responsive Bootstrap 4 Admin Dashboard
 Author: Therichpost
 File: Dashboard Init
 */

 setTimeout(function(){
  !function ($) {
    "use strict";
  
    var Dashboard = function () {
    };
        //creates Donut chart
        Dashboard.prototype.createDonutChart = function (element, data, colors) {
            Morris.Donut({
                element: element,
                data: data,
                resize: true,
                labelColor: '#a5a6ad',
              backgroundColor: '#222437',
                colors: colors
            });
        },
  
  
        Dashboard.prototype.init = function () {
          // surcl system rocomndation number de click  Totale 
          
          fetch("/get-locationCityjson").then(response=>response.json()).then(data=>{
            
            let maxObj = data.nb_com.reduce((max, obj) => (max.value > obj.value) ? max : obj);
            let W_data=new Array()
            let W_name=new Array()
            data.nb_com.forEach((val,index)=>{
              //alert(val)
              W_name[index]=val.label;
              
              W_data[index]=val.value;
            });
           // alert(val)
           let  WlilayaMaxComin=maxObj.label;
           let colorss=colors[0];
            var myChart = new Chart(ctx2, {
              type: "bar",
              data: {
              labels: W_name,
              datasets: [
              {
             // label:W_name,
              data:W_data,
              backgroundColor: colors,
              borderColor:colors,
              borderWidth: 1,
              fillText: 'test'
              },
              ],
              },
              options: {
              scales: {
              y: {
              beginAtZero: true,
              },
              },
              },
              });
              
              var ctx = document.getElementById("myChart").getContext("2d");
              var myChart = new Chart(ctx, {
                type: "line",
                data: {
                  labels: [
                    "Monday",
                    "Tuesday",
                    "Wednesday",
                    "Thursday",
                    "Friday",
                    "Saturday",
                    "Sunday",
                  ],
                  datasets: [
                    {
                      label: "work load",
                      data: [2, 9, 3, 17, 6, 3, 7],
                      backgroundColor: "rgba(153,205,1,0.6)",
                    },
                    {
                      label: "free hours",
                      data: [2, 2, 5, 5, 2, 1, 10],
                      backgroundColor: "rgba(155,153,10,0.6)",
                    },
                  ],
                },
              });
              


            this.createDonutChart('morris-area-example', data.nb_com, colors);//, '#fcbe2d'
        
          })
          var $donutData = [
            {label: "Number de user Rating SR Pearsonn", value: 40},
            {label: "Number de user Rating SR Slop ONE", value: 50},
            //{label: "Mail-Order Sales", value: 40}
        ];
       // this.createDonutChart('morris-area-example', $donutData, ['#02c58d', '#30419b']);//, '#fcbe2d'
        },
        //init
        $.Dashboard = new Dashboard, $.Dashboard.Constructor = Dashboard
  }(window.jQuery),
  
  //initializing 
    function ($) {
        "use strict";
        $.Dashboard.init();
    }(window.jQuery);
  }, 1000);




  function getCommin(code,lat,lng){
    map.remove()
    map = L.map('map').setView([lat,lng], 8);
    //var wilys=new Array()
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
       attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);
        
   fetch("/get-locationCityThisjson"+code).then(response=>response.json()).then(data=>{
    data.city.forEach((val,index)=>{
            var marker = new L.marker([val.longitude,val.latitude]).bindPopup(val.name+'<br><a href="#" onclick="GetPOI('+val.id+','+val.longitude+','+val.latitude+','+val.wilaya_id+')">shw POI</a><br> <a href="#" onclick="getWilaya()"> Return </a><br>').addTo(map);
            // wilys.push(marker);
            // map.addLayer(wilys[index]);
        
             
       })

       $(".profil-image").html('');
   })
  

}

function GetPOI(code,lat,lng,id){  
   fetch("/get-locationPOIThisjson/poi."+code+'.user'+$("#user_id").val()).then(response=>response.json()).then(data=>{
 
    if (data.message=="plan") {
      map.remove()
      map = L.map('map').setView([data.city[0].lat,data.city[0].lng], 11);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
         attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map)
        $('.POI-image').html('')
    data.city.forEach((val,index)=>{
     var stare=""
    
      let info='<div class="shadow-lg marker rounded ">'+
      '<figure class="figure ">'+
         '<div class="badge  text-wrap" style="width: 10rem;">'+
            '<span class="d-inline-block text-success" style="max-width:150px; "><h6>'+ val.tetle+
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
                        '<input type="hidden" name="RS" value="false">'+                  
                        '<input id="ids" type="text" name="id_user" value="'+data.user.id+'">'+
                        '<input type="hidden"class="visite'+val.id+'"  name="visite" value="'+val.thisHistorique+'">'+
                        '<input id="ids" type="text" name="name" value="'+data.user.name+'">'+
                        '<input type="hidden" name="image" value="'+data.user.image+'">'+
                        '<input id="ids" type="text" name="title" value="'+ val.tetle+'">'+
                        '<input id="ids" type="text" name="nb_visite_user" value="'+data.user.nb_visited+'">'+
                        '<input id="ids" type="text" name="moyenn_user" value="'+data.user.moyanne+'">'+
                        '<input id="lat'+val.id+'" type="hidden" name="lat" value="'+val.lat+'">'+
                        '<input id="lng'+val.id+'" type="hidden" name="lng" value="'+val.lng+'">'+
                        '<input id="ids" type="text" name="nb_visite_marker" value="'+val.nb_visited+'">'+
                        ' <input id="ids" type="text" name="moyenn_marker" value="'+val.moy+'">'+
                        '<input id="ids" type="text" name="user_marker" value="'+val.user_id+'">'+
                        '<input id="ids" type="text" name="id_marker" value="'+val.id+'">'+
           '<figcaption class="figure-caption text-center">'+
               '<small class="text-muted">'+
                   '<span class="rating-star">'+
                    val.stars+
                      '</span>'+
                '</small>'+
             '</figcaption>'+
             '<figcaption class="figure-caption text-center">'+
              '<button type="button" class="button btn btn-success button-sev addHistorique" value="'+val.id+'"><i class="bi bi-arrow-down-circle-fill"></i> Sve</button> '+
              '<a class="btn btn-info " href="#" onclick="getWilaya()" ><i class="bi bi-arrow-up-right-circle-fill"></i></a>'+
             '</figcaption>'+
          '</form>'+
        '</figure>'+
    '</div>'


  
          var marker = new L.marker([val.lat,val.lng]).bindPopup(info).addTo(map);
          //POI.push(marker);+val.rating
        // map.addLayer(POI[index]);

        // return  les image poi
        
$('.POI-image').append('<div class="col-md-6  col-xl-4 col-lg-4 col-sm-12 ">'+
'<div class="card mb-4 shadow-sm ">'+
'<a class=""" href="#" >'+
  '<div class="media">'+
     '<img src="public/profile/'+val.userImage.image+'" class="align-self-center rounded-circle mr-3"style="width :1cm;heigth:1cm" alt="...">'+
     '<div class="media-body">'+
          '<h5 class="mt-2">'+val.created_at+'</h5>'+
     '</div>'+
 ' </div>'+
'</a>'+
'<dl class="row ml-5">'+
 ' <dt class="col-sm-12 ">'+val.tetle+'</dt>'+
  '<dd class="col-sm-12">...</dd>'+
'</dl>'+

   '<img class="bd-placeholder-img card-img-top" width="100%" height="180" src="public/marker/'+val.image+'" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">'+
  '<div class="card-body"> <hr>'+
    '<ul class="list-group list-group-horizontal" style="list-style-type:none">'+
         '<li class="col-sm-4 col-md-4 iem"><i class="bi   bi-eye-fill"></i> vi '+val.nb_visited+ '</li>'+
         // nomber de commenter
          '<li class="col-sm-4 col-md-4">'+val.nb_comm+'</li>'+
          //moyenn de rating this POI
          '<li class="col-sm-4 col-md-4">'+3+'</li>'+
      '</ul>'+
      '<div class="d-flex  bg-secondary p-0">'+
           '<div class="btn-group dropup col-7  ">'+
            //button view route ou open poi adrass
            '<button type="button"class="btn-secondary  w-50" onclick="viewpoi('+val.id+')" value="'+val.id+'">'+
           '    view<i class="fa fa-street-view" aria-hidden="true"></i>'+
           '  </button>'+
           //end button view poi
           '  <button type="button" class="btn-secondary w-50" id="dropdownMenuReference'+val.id+'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">'+val.nb_comm+'<i class="bi bi-chat-square-dots"></i>'+
           '  </button>'+
           '  <div class="dropdown-menu " style="width:7cm;"aria-labelledby="dropdownMenuReference'+val.id+'">'+
            // liste comnter
           // +CommonterThisusr+

           '<div class="dropdown-divider"></div>'+
           // star form commnter
           //' <form action="#form-commenter'+val.id+'" method="post">'+
             //id user    
           '<form id="commenter-form-body'+val.id+'" class="historique_forms" action="/addhistorique" method="get">'+  
           '<input type="hidden" name="RS" value="false">'+                  
           '<input id="ids" type="text" name="id_user" value="'+data.user.id+'">'+
           '<input type="hidden" class="visite'+val.id+'" name="visite" value="'+val.thisHistorique+'">'+
           '<input id="ids" type="text" name="name" value="'+data.user.name+'">'+
           '<input type="hidden" name="image" value="'+data.user.image+'">'+
           '<input id="ids" type="text" name="title" value="'+ val.tetle+'">'+
           '<input id="ids" type="text" name="nb_visite_user" value="'+data.user.nb_visited+'">'+
           '<input id="ids" type="text" name="moyenn_user" value="'+data.user.moyanne+'">'+
           '<input id="lat'+val.id+'" type="hidden" name="lat" value="'+val.lat+'">'+
           '<input id="lng'+val.id+'" type="hidden" name="lng" value="'+val.lng+'">'+
           '<input id="ids" type="text" name="nb_visite_marker" value="'+val.nb_visited+'">'+
           ' <input id="ids" type="text" name="moyenn_marker" value="'+val.moy+'">'+
           '<input id="ids" type="text" name="user_marker" value="'+val.user_id+'">'+
           '<input id="ids" type="text" name="id_marker" value="'+val.id+'">'+

                '<a href="#" class="text-secondary float-end  mr-2  addcommenter_pody" rel="'+val.id+'" style="margin-bottom: -2cm;" >'+
                        '<i class="fa fa-send fa-2x "></i>'+//fa_customfloat-end 
                        '</a>'+
                 //textArea       
                '<textarea class="form-control pr-3" id="validationTextarea" name="comm" placeholder="Required example textarea" > </textarea>'+
             
              '</form>'+
              //end form commonter
           ' </div>'+
           '</div>'+
           '<div class="btn-group dropup col-5 "  >'+
           '  <button type="button" class="btn-secondary w-100" id="dropdownMenuRe'+val.id+'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">'+val.nb_rating+' <i class="bi bi-hand-thumbs-up"></i>'+
           '  </button>'+
           '  <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg dropdown-menu-noti px-1" style="width:7cm;"aria-labelledby="dropdownMenuRe'+val.id+'">'+
            '<h6 class="dropdown-item-text"> Rating</h6>'+
            '<div class="" style="max-height:4cm">'+
                         
                  val.rating+          
           '</div>'+
           '    <div class="dropdown-divider"></div>'+
           // stare  form add ratinge
           '<form id="rating-form-body'+val.id+'" class="historique_forms" action="/addhistorique" method="get">'+  
           '<input type="hidden" name="RS" value="false">'+                  
           '<input id="ids" type="text" name="id_user" value="'+data.user.id+'">'+
           '<input type="hidden" class="visite'+val.id+'"  name="visite" value="'+val.thisHistorique+'">'+
           '<input id="ids" type="text" name="name" value="'+data.user.name+'">'+
           '<input type="hidden" name="image" value="'+data.user.image+'">'+
           '<input id="ids" type="text" name="title" value="'+ val.tetle+'">'+
           '<input id="ids" type="text" name="nb_visite_user" value="'+data.user.nb_visited+'">'+
           '<input id="ids" type="text" name="moyenn_user" value="'+data.user.moyanne+'">'+
           '<input id="lat'+val.id+'" type="hidden" name="lat" value="'+val.lat+'">'+
           '<input id="lng'+val.id+'" type="hidden" name="lng" value="'+val.lng+'">'+
           '<input id="ids" type="text" name="nb_visite_marker" value="'+val.nb_visited+'">'+
           ' <input id="ids" type="text" name="moyenn_marker" value="'+val.moy+'">'+
           '<input id="ids" type="text" name="user_marker" value="'+val.user_id+'">'+
           '<input id="ids" type="text" name="id_marker" value="'+val.id+'">'+
           '<small class="text-muted">'+
              '<span class="rating-star">'+
                 val.stars+
              '</span>'+
              '<a href="#" class="text-secondary ml-3 mb-0 mt-2 addHistorique_pody" rel="'+val.id+'">'+
              '<i class="fa fa-send fa-2x "></i>'+//fa_customfloat-end 
              '</a>'+
             '</small>'+
            // function add evalation
           
            '</form>'+
   // end form rating
           '  </div>'+
           '</div>'+
        '</div>'+
  '</div>'+
'</div>'+
'</div>')
           
   })
    
  }
  else {
    var user=$('#user_id').val()
  //  $(".lab"+code).html("Error pas POi")
    alert(" Excuse me .there is no area of tourist areas in this municipality")
    //getCommin(id,lat,lng)
  }
  

     //$(".profil-image").html('');
 })
}


function GetPOIThisWilaya(code,lat,lng,id){  
  fetch("/get-locationPOIThisWilayajson/poi."+code+'.user'+$("#user_id").val()).then(response=>response.json()).then(data=>{

     if (data.message=="plan") {
       map.remove()
       map = L.map('map').setView([data.city[0].lat,data.city[0].lng], 11);
         L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
         }).addTo(map)
         $('.POI-image').html('')
     data.city.forEach((val,index)=>{
      //var stare=""
       
       let info='<div class="shadow-lg marker rounded ">'+
       '<input id="ids" class="code'+val.id+'" type="text" name="code" value="'+code+'">'+
       '<figure class="figure ">'+
          '<div class="badge  text-wrap" style="width: 10rem;">'+
             '<span class="d-inline-block text-success" style="max-width:150px; "><h6>'+ val.tetle+
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
                         '<input type="hidden" name="RS" value="false">'+                  
                         '<input id="ids" type="text" name="id_user" value="'+data.user.id+'">'+
                         '<input type="hidden"class="visite'+val.id+'"  name="visite" value="'+val.thisHistorique+'">'+
                         '<input id="ids" type="text" name="name" value="'+data.user.name+'">'+
                         '<input type="hidden" name="image" value="'+data.user.image+'">'+
                         '<input id="ids" type="text" name="title" value="'+ val.tetle+'">'+
                         '<input id="ids" type="text" name="nb_visite_user" value="'+data.user.nb_visited+'">'+
                         '<input id="ids" type="text" name="moyenn_user" value="'+data.user.moyanne+'">'+
                         '<input id="lat'+val.id+'" type="hidden" name="lat" value="'+val.lat+'">'+
                         '<input id="lng'+val.id+'" type="hidden" name="lng" value="'+val.lng+'">'+
                         '<input id="ids" type="text" name="nb_visite_marker" value="'+val.nb_visited+'">'+
                         ' <input id="ids" type="text" name="moyenn_marker" value="'+val.moy+'">'+
                         '<input id="ids" type="text" name="user_marker" value="'+val.user_id+'">'+
                         '<input id="ids" type="text" name="id_marker" value="'+val.id+'">'+
            '<figcaption class="figure-caption text-center">'+
                '<small class="text-muted">'+
                    '<span class="rating-star">'+
                     val.stars+
                       '</span>'+
                 '</small>'+
              '</figcaption>'+
              '<figcaption class="figure-caption text-center">'+
               '<button type="button" class="button btn btn-success button-sev addHistorique" value="'+val.id+'"><i class="bi bi-arrow-down-circle-fill"></i> Sve</button> '+
               '<a class="btn btn-info " href="#" onclick="getWilaya()" ><i class="bi bi-arrow-up-right-circle-fill"></i></a>'+
              '</figcaption>'+
           '</form>'+
         '</figure>'+
     '</div>'


   
           var marker = new L.marker([val.lat,val.lng]).bindPopup(info).addTo(map);
           //POI.push(marker);+val.rating
         // map.addLayer(POI[index]);

         // return  les image poi
         
$('.POI-image').append('<div class="col-md-6  col-xl-4 col-lg-4 col-sm-12 ">'+
'<div class="card mb-4 shadow-sm ">'+
 '<a class=""" href="#" >'+
   '<div class="media">'+
      '<img src="public/profile/'+val.userImage.image+'" class="align-self-center rounded-circle mr-3"style="width :1cm;heigth:1cm" alt="...">'+
      '<div class="media-body">'+
           '<h5 class="mt-2">'+val.created_at+'</h5>'+
      '</div>'+
  ' </div>'+
 '</a>'+
'<dl class="row ml-5">'+
  ' <dt class="col-sm-12 ">'+val.tetle+'</dt>'+
   '<dd class="col-sm-12">...</dd>'+
'</dl>'+

    '<img class="bd-placeholder-img card-img-top" width="100%" height="180" src="public/marker/'+val.image+'" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">'+
   '<div class="card-body"> <hr>'+
     '<ul class="list-group list-group-horizontal" style="list-style-type:none">'+
          '<li class="col-sm-4 col-md-4 iem"><i class="bi   bi-eye-fill"></i> vi '+val.nb_visited+ '</li>'+
          // nomber de commenter
           '<li class="col-sm-4 col-md-4">'+val.nb_comm+'</li>'+
           //moyenn de rating this POI
           '<li class="col-sm-4 col-md-4">'+3+'</li>'+
       '</ul>'+
       '<div class="d-flex  bg-secondary p-0">'+
            '<div class="btn-group dropup col-7  ">'+
             //button view route ou open poi adrass
             '<button type="button"class="btn-secondary  w-50" onclick="viewpoi('+val.id+')" value="'+val.id+'">'+
            '    view<i class="fa fa-street-view" aria-hidden="true"></i>'+
            '  </button>'+
            //end button view poi
            '  <button type="button" class="btn-secondary w-50" id="dropdownMenuReference'+val.id+'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">'+val.nb_comm+'<i class="bi bi-chat-square-dots"></i>'+
            '  </button>'+
            '  <div class="dropdown-menu " style="width:7cm;"aria-labelledby="dropdownMenuReference'+val.id+'">'+
             // liste comnter
            // +CommonterThisusr+
 
            '<div class="dropdown-divider"></div>'+
            // star form commnter
            //' <form action="#form-commenter'+val.id+'" method="post">'+
              //id user    
            '<form id="commenter-form-body'+val.id+'" class="historique_forms" action="/addhistorique" method="get">'+  
            '<input type="hidden" name="RS" value="false">'+                  
            '<input id="ids" type="text" name="id_user" value="'+data.user.id+'">'+
            '<input type="hidden" class="visite'+val.id+'" name="visite" value="'+val.thisHistorique+'">'+
            '<input id="ids" type="text" name="name" value="'+data.user.name+'">'+
            '<input type="hidden" name="image" value="'+data.user.image+'">'+
            '<input id="ids" type="text" name="title" value="'+ val.tetle+'">'+
            '<input id="ids" type="text" name="nb_visite_user" value="'+data.user.nb_visited+'">'+
            '<input id="ids" type="text" name="moyenn_user" value="'+data.user.moyanne+'">'+
            '<input id="lat'+val.id+'" type="hidden" name="lat" value="'+val.lat+'">'+
            '<input id="lng'+val.id+'" type="hidden" name="lng" value="'+val.lng+'">'+
            '<input id="ids" type="text" name="nb_visite_marker" value="'+val.nb_visited+'">'+
            ' <input id="ids" type="text" name="moyenn_marker" value="'+val.moy+'">'+
            '<input id="ids" type="text" name="user_marker" value="'+val.user_id+'">'+
            '<input id="ids" type="text" name="id_marker" value="'+val.id+'">'+

                 '<a href="#" class="text-secondary float-end  mr-2  addcommenter_pody" rel="'+val.id+'" style="margin-bottom: -2cm;" >'+
                         '<i class="fa fa-send fa-2x "></i>'+//fa_customfloat-end 
                         '</a>'+
                  //textArea       
                 '<textarea class="form-control pr-3" id="validationTextarea" name="comm" placeholder="Required example textarea" > </textarea>'+
              
               '</form>'+
               //end form commonter
            ' </div>'+
            '</div>'+
            '<div class="btn-group dropup col-5 "  >'+
            '  <button type="button" class="btn-secondary w-100" id="dropdownMenuRe'+val.id+'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">'+val.nb_rating+' <i class="bi bi-hand-thumbs-up"></i>'+
            '  </button>'+
            '  <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg dropdown-menu-noti px-1" style="width:7cm;"aria-labelledby="dropdownMenuRe'+val.id+'">'+
             '<h6 class="dropdown-item-text"> Rating</h6>'+
             '<div class="" style="max-height:4cm">'+
                          
                   val.rating+          
            '</div>'+
            '    <div class="dropdown-divider"></div>'+
            // stare  form add ratinge
            '<form id="rating-form-body'+val.id+'" class="historique_forms" action="/addhistorique" method="get">'+  
            '<input type="hidden" name="RS" value="false">'+                  
            '<input id="ids" type="text" name="id_user" value="'+data.user.id+'">'+
            '<input type="hidden" class="visite'+val.id+'"  name="visite" value="'+val.thisHistorique+'">'+
            '<input id="ids" type="text" name="name" value="'+data.user.name+'">'+
            '<input type="hidden" name="image" value="'+data.user.image+'">'+
            '<input id="ids" type="text" name="title" value="'+ val.tetle+'">'+
            '<input id="ids" type="text" name="nb_visite_user" value="'+data.user.nb_visited+'">'+
            '<input id="ids" type="text" name="moyenn_user" value="'+data.user.moyanne+'">'+
            '<input id="lat'+val.id+'" type="hidden" name="lat" value="'+val.lat+'">'+
            '<input id="lng'+val.id+'" type="hidden" name="lng" value="'+val.lng+'">'+
            '<input id="ids" type="text" name="nb_visite_marker" value="'+val.nb_visited+'">'+
            ' <input id="ids" type="text" name="moyenn_marker" value="'+val.moy+'">'+
            '<input id="ids" type="text" name="user_marker" value="'+val.user_id+'">'+
            '<input id="ids" type="text" name="id_marker" value="'+val.id+'">'+
            '<small class="text-muted">'+
               '<span class="rating-star">'+
                  val.stars+
               '</span>'+
               '<a href="#" class="text-secondary ml-3 mb-0 mt-2 addHistorique_pody" rel="'+val.id+'">'+
               '<i class="fa fa-send fa-2x "></i>'+//fa_customfloat-end 
               '</a>'+
              '</small>'+
             // function add evalation
            
             '</form>'+
    // end form rating
            '  </div>'+
            '</div>'+
         '</div>'+
   '</div>'+
'</div>'+
'</div>')
            
    })
     
   }
   else {
     var user=$('#user_id').val()
   //  $(".lab"+code).html("Error pas POi")
     alert(" Excuse me .there is no area of tourist areas in this municipality")
     //getCommin(id,lat,lng)
   }
   

      //$(".profil-image").html('');
  })
}


//function  view poi
function viewpoi(code){
  fetch("/getthispoi/poi."+code+'.user'+$("#user_id").val()).then(response=>response.json()).then(data=>{
       
     data.city.forEach((val,index)=>{
    let info='<div class="shadow-lg marker rounded ">'+
    '<figure class="figure ">'+
       '<div class="badge  text-wrap" style="width: 10rem;">'+
          '<span class="d-inline-block text-success" style="max-width:150px; "><h6>'+ val.tetle+
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
                      '<input type="hidden" name="RS" value="false">'+                  
                      '<input id="ids" type="text" name="id_user" value="'+data.user.id+'">'+
                      '<input type="hidden" name="visite" value="'+val.thisHistorique+'">'+
                      '<input id="ids" type="text" name="name" value="'+data.user.name+'">'+
                      '<input type="hidden" name="image" value="'+data.user.image+'">'+
                      '<input id="ids" type="text" name="title" value="'+ val.tetle+'">'+
                      '<input id="ids" type="text" name="nb_visite_user" value="'+data.user.nb_visited+'">'+
                      '<input id="ids" type="text" name="moyenn_user" value="'+data.user.moyanne+'">'+
                      '<input id="lat'+val.id+'" type="hidden" name="lat" value="'+val.lat+'">'+
                      '<input id="lng'+val.id+'" type="hidden" name="lng" value="'+val.lng+'">'+
                      '<input id="ids" type="text" name="nb_visite_marker" value="'+val.nb_visited+'">'+
                      ' <input id="ids" type="text" name="moyenn_marker" value="'+val.moy+'">'+
                      '<input id="ids" type="text" name="user_marker" value="'+val.user_id+'">'+
                      '<input id="ids" type="text" name="id_marker" value="'+val.id+'">'+
         '<figcaption class="figure-caption text-center">'+
             '<small class="text-muted">'+
                 '<span class="rating-star">'+
                  val.stars+
                    '</span>'+
              '</small>'+
           '</figcaption>'+
           '<figcaption class="figure-caption text-center">'+
            '<button type="button" class="button btn btn-success button-sev addHistorique" value="'+val.id+'"><i class="bi bi-arrow-down-circle-fill"></i> Sve</button> '+
            '<a class="btn btn-info " href="#" onclick="getWilaya()" ><i class="bi bi-arrow-up-right-circle-fill"></i></a>'+
           '</figcaption>'+
        '</form>'+
      '</figure>'+
  '</div>';
  
  var marker = new L.marker([val.lat,val.lng]).addTo(map)
           .bindPopup(info).openPopup();
     })

  })
 }