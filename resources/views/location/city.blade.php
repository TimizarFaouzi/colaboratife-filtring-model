


<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
{{--<script src="{{asset('js/jquery-3.5.1.js')}}"></script>--}}
<script src="{{asset('js/Chart.min.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
     <!-- icons-->
     <link href="{{asset('font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('bootstrap-icons/bootstrap-icons.css')}}">
<link rel="stylesheet" href="{{asset('leaflet/leaflet.css')}}"  />

<link rel="stylesheet" href="{{asset('css/openstreet.css')}}">
<script src="{{asset('leaflet/leaflet.js')}}"></script>
  
<script src="{{asset('plugins/jquery-2.2.4.min.js')}}"></script>
<script src="{{asset('plugins/jquery.appear.min.js')}}"></script>
<script src="{{asset('plugins/jquery.easypiechart.min.js')}}"></script> 
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
          <div class="row POI-image"></div>
        </div>
        <div class="row profil-image">
            <div class="col-md-9 mb-9">
              <div class="card h-100">
                <div class="card-header">
                  <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                  Bar Chart Wilaya Algrian
                </div>
                <div class="card-body">
                  <canvas id="chart2" class="chart" width="780" height="390" style="display: block; box-sizing: border-box; height: 195px; width: 390px;"></canvas>
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

<script>
              
   var user_id=$('#user_id').val()
  
var map
getWilaya()
  function getWilaya(){
  if (map) {
    map.remove()
  }
   map = L.map('map').setView([36.2838408,2.7728462], 7);
    
    var cityAlg
   var wilys=new Array()
 L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
 attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
 }).addTo(map);
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
               var marker = new L.marker([val.longitude,val.latitude]).bindPopup('<div class=text-center text-success pg-primary>'+val.name+'<br>'+val.ar_name+'<br><a href="#" onclick="getCommin('+val.code+','+val.longitude+','+val.latitude+')" >shw city</a><br><a href="#" onclick="GetPOIThisWilaya('+val.id+','+val.longitude+','+val.latitude+','+val.wilaya_id+')">shw POI</a><br></div>');
     //marker.addTo(map);
 
               
           wilys.push(marker);
            map.addLayer(wilys[index]);
        })
    }
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
          var code=$(".code"+$(this).val()).val()   
         // alert(code)   
        var all_data = $("#rating-form"+$(this).val()+" :input").serializeArray();
      
        $.ajax({
            type: "GET",
            url: "/addhistorique",
            data:all_data,
            dataType: "json",
            success: function (response) {
             // alert(response.sessen+$(this).val())
          //  $(".rating"+response.sessen+$(this).val()).attr("checked","checked");
                // lastaddPOI(code,lat,lng)
               GetPOIThisWilaya(code,lat,lng,code)
            }
        });
       
    
    });
/********************************************************************************|
     *                                                                               |
     *                                                                               |
     *                       fonction add istorique body                             |
     *                                                                               |
     *                                                                               |
     *                                                                               |
     * ******************************************************************************|
     */
     $(document).on('click', '.addHistorique_pody', function (e) {
        e.preventDefault();
       // var lat= $("#lat"+$(this).val()).val();
       // var lng= $("#lng"+$(this).val()).val();
       //alert($(this).attr('rel'))     
        var all_data = $("#rating-form-body"+$(this).attr('rel')+" :input").serializeArray();
        alert(all_data)
        $.ajax({
            type: "GET",
            url: "/addhistorique",
            data:all_data,
            dataType: "json",
            success: function (response) {
            }
        });
       
    
    });


    /********************************************************************************|
     *                                                                               |
     *                                                                               |
     *                       fonction add istorique body                             |
     *                                                                               |
     *                                                                               |
     *                                                                               |
     * ******************************************************************************|
     */
     $(document).on('click', '.addcommenter_pody', function (e) {
        e.preventDefault();
        var all_data = $("#commenter-form-body"+$(this).attr('rel')+" :input").serializeArray();
        $.ajax({
            type: "GET",
            url: "/addhistorique",
            data:all_data,
            dataType: "json",
            success: function (response) {
             // $(".visite"+$(this).attr('rel')).each(function(){
               // $(".visite"+$(this).attr('rel')).val()
              // });
              
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

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('Leaflet.MovingMarker-master/MovingMarker.js')}}"></script>