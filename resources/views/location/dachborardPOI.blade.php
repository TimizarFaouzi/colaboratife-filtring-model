
 <!doctype html>
 <html> 
 <head>
  
 <title> About</title> 
  
 <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}" />
  <link rel="stylesheet" type="text/css" href="{{asset('plugins/style.css')}}">
  <link href="{{asset('font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('bootstrap-icons/bootstrap-icons.css')}}">
<link rel="stylesheet" href="{{asset('leaflet/leaflet.css')}}"  />

<link rel="stylesheet" href="{{asset('css/openstreet.css')}}">
<script src="{{asset('leaflet/leaflet.js')}}"></script>
   
   
  
 </head>
 <style>
        }@media (min-width: 720px) {
  .leaflet-top .leaflet-control  {
  margin-top: 37px;
  }
}
 </style>
 <body>
         
               
               <div class="container-fluid">
                     <div class="row" >
                       <div class="body_map pl-md-2 pr-md-2"style=" heigth:4cm; ">
                         <div id="map" class="map"style=" heigth:3cm; "></div>
             
                       </div>
                     </div>
                   <div class="row ">
                     <div class="row profil-image"></div>
                   </div>
                   <div class="row">
                       <div class="col-md-9 mb-9">
                         <div class="card h-100">
                           <div class="card-header">
                             <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                             Bar Chart Wilaya Algrian
                           </div>
                           <div class="card-body">
                            
                             <canvas id="chart2" class="chart" width="780" height="390" style="display: none; box-sizing: border-box; height: 195px; width: 390px;"></canvas>


                           </div>
                           
                         </div>
                       </div>
                       <div class="col-md-3 mb-3">
                         <div class="card h-100">
                           <div class="card-header">
                             <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                             Donut Chart Wilaya Algrian
                           </div>
                           <div class="card-body">
                               
                            
                            <div id="morris-area-example"></div>
                             <canvas id="myChart" class="Mychart" width="780" height="390" style="display: none; box-sizing: border-box; height: 195px; width: 390px; "></canvas>
                             
                           </div>
                         </div>
                       </div>
                     </div>
                   
               </div> 
   
   
   
  <script src="{{asset('plugins/jquery-2.2.4.min.js')}}"></script>
  <script src="{{asset('plugins/jquery.appear.min.js')}}"></script>
  <script src="{{asset('plugins/jquery.easypiechart.min.js')}}"></script> 
  

<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
{{--<script src="{{asset('js/jquery-3.5.1.js')}}"></script>--}}
<script src="{{asset('js/Chart.min.js')}}"></script>

  <script>
       var map 
       var user_id=$('#user_id').val()
                  map = L.map('map').setView([36.2838408,2.7728462], 7);
       
       var cityAlg
      var wilys=new Array()
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
        rest()
    function rest(){
        
       //var marker = new Array();
        $.ajax({
       url:"/get-locationCityjson",
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
            data.wilaya.forEach((val,index)=>{
                  var marker = new L.marker([val.longitude,val.latitude]).bindPopup('<div class=text-center text-success pg-primary>'+val.name+'<br>'+val.ar_name+'<br><a href="#" onclick="getCommin('+val.code+','+val.longitude+','+val.latitude+')" >shw city</a></div>');
                  //marker.addTo(map);
    
                  
              wilys.push(marker);
               map.addLayer(wilys[index]);
           })
       }
      })
    }
    function getCommin(code,lat,lng){
        map.remove()
        map = L.map('map').setView([lat,lng], 11);
        var wilys=new Array()
          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
           attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
          }).addTo(map);
            
       fetch("/get-locationCityThisjson"+code).then(response=>response.json()).then(data=>{
        data.city.forEach((val,index)=>{
                var marker = new L.marker([val.longitude,val.latitude]).bindPopup(val.name+'<br><a href="#" >shw city</a>');
                 wilys.push(marker);
                 map.addLayer(wilys[index]);
            
                 
           })
       })
      
    
    }
    //animation
    //getLocation()
    function getLocation(){
           map.locate({setView: true, enableHighAccuracy: true})
           .on('location found', function(e){
                  var marker = new L.marker(e.latlng).bindPopup(info);
                  marker.addTo(map);
           });
    }
    
    
    </script>
  <script>
     'use strict';
 
 var $window = $(window);
 
 function run()
 {
        var fName = arguments[0],
               aArgs = Array.prototype.slice.call(arguments, 1);
        try {
               fName.apply(window, aArgs);
        } catch(err) {
                
        }
 };
  
 /* chart
 ================================================== */
 function _chart ()
 {
        $('.b-skills').appear(function() {
               setTimeout(function() {
                      $('.chart').easyPieChart({
                             easing: 'easeOutElastic',
                             delay: 3000,
                             barColor: '#369670',
                             trackColor: '#fff',
                             scaleColor: false,
                             lineWidth: 21,
                             trackWidth: 21,
                             size: 250,
                             lineCap: 'round',
                             onStep: function(from, to, percent) {
                                    this.el.children[0].innerHTML = Math.round(percent);
                             }
                      });
               }, 150);
        });
 };
  
 
 $(document).ready(function() {
   
        run(_chart);
   
     
 });
 
 
     
     </script>
  

  {{--chart  POI Wliya--}}
  
<script>
       'use strict';
   
   var $window = $(window);
   
   function run()
   {
          var fName = arguments[0],
                 aArgs = Array.prototype.slice.call(arguments, 1);
          try {
                 fName.apply(window, aArgs);
          } catch(err) {
                  
          }
   };
    
   /* chart
   ================================================== */
   function _chart ()
   {  
          $('.b-skills').appear(function() {
                 setTimeout(function() {
                        $('.chart').easyPieChart({
                               easing: 'easeOutElastic',
                               delay: 3000,
                               barColor: '#369670',
                               trackColor: '#fff',
                               scaleColor: false,
                               lineWidth: 21,
                               trackWidth: 21,
                               size: 250,
                               lineCap: 'round',
                               onStep: function(from, to, percent) {
                                      this.el.children[0].innerHTML = Math.round(percent);
                               }
                        });
                 }, 150);
          });
   };
    
   
   $(document).ready(function() {
     
          run(_chart);
     
       
   });
   
   
       
       </script>
    
 </body>
  
 </html>
 