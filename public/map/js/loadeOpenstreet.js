$(document).ready(function () {
       var map;
       //fetchstudent();
      // LastItem()
       
       function LastItem() {
       // map.remove();  
       var id_user = $("#user_id").val();
       //alert(id_user)
           $.ajax({
               
               type: "GET",
               url: "/getLastMarkers/"+id_user,
               dataType: "json",
               success: function (response) {
                //alert(response.markers.lat);
                   if (response.markers!="NAN") {
                       $.each(response.markers, function (key, item) {
                          
                           map = L.map('maps').setView([item.lat,item.lng], 13);
                           L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                           attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                          }).addTo(map);
                      let info='<form id="rating-form'+item.id+'">'+
                      '<input id="ids" type="text" name="id_user" value="'+user_id+'">'+
                      ' <input id="ids" type="text" name="id_marker" value="'+item.id+'">'+
                      '<input id="lat'+item.id+'"type="text" value="'+item.lat+'">'+
                      '<input id="lng'+item.id+'"type="text" value="'+item.lng+'">'+
                      ' <p><h5>'+item.tetle+'</h5></p>'+
                      '<img src="public/marker/'+item.image+ '"width="100" height="50" alt="" class="navbar-brand">'+
                      '<div class="mb-3">'+
                         '<label for="exampleFormControlTextarea1" class="form-label">Commonter</label>'+
                         '<textarea name="commu" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>'+
                          '<div class="">'+
                              '<span class="rating-star">'+
                                  '<input type="radio" name="rating" value="5"><span class=" star"></span>'+
                                  '<input type="radio" name="rating" value="4"><span class=" star"></span>'+
                                  '<input type="radio" name="rating" value="3"><span class=" star"></span>'+
                                  '<input type="radio" name="rating" value="2"><span class=" star"></span>'+
                                  '<input type="radio" name="rating" value="1"><span class=" star"></span>'+
                                  
                                  '<button id="ajaxStart" class="btn btn-primary mt-3 mt-2 addHistorique"  type="button" value="'+item.id+'">save</button>'+
                              '</span>'+
                              
                          '</div>'
                      '</div>'+
                  '</form>';
                  var marker = new L.marker([item.lat,item.lng])
                 .bindPopup(info).addTo(map);


                 alert()
                           })
                    }if(response.marker=="NAN"){
                        
                        map = L.map('maps').setView([36.224646,1.240034], 13);
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                         attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(map);
                    }
                  }
               });
           }
       function showmap(){
              map = L.map('maps').setView([36.224646,1.240034], 13);
              L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
              attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
             }).addTo(map);
       }
       function fetchstudent() {
           $.ajax({
               type: "GET",
               url: "/getMarkers",
               dataType: "json",
               success: function (response) {
                  map = L.map('maps').setView([36.224646,1.240034], 13);
                   L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                   attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                  }).addTo(map);
               
                  let late,lngt;
                  var user=$('#id').val();
                   $.each(response.markers, function (key, item) {
                       late=item.lat;
                       lngt=item.lng;
                       typeof late;
                       typeof lngt;
                       let info='<form id="rating-form'+item.id+'">'+
                       '<input id="ids" type="text" name="id_user" value="'+user+'">'+
                       ' <input id="ids" type="text" name="id_marker" value="'+item.id+'">'+
                       '<input id="lat'+item.id+'"type="text" value="'+item.lat+'">'+
                       '<input id="lng'+item.id+'"type="text" value="'+item.lng+'">'+
                       ' <p><h5>'+item.tetle+'</h5></p>'+
                       '<img src="public/marker/'+item.image+ '"width="300" height="150" alt="" class="navbar-brand">'+
                       '<div class="mb-3">'+
                          '<label for="exampleFormControlTextarea1" class="form-label">Commonter</label>'+
                          '<textarea name="commu" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>'+
                           '<div class="">'+
                               '<span class="rating-star">'+
                                   '<input type="radio" name="rating" value="5"><span class=" star"></span>'+
                                   '<input type="radio" name="rating" value="4"><span class=" star"></span>'+
                                   '<input type="radio" name="rating" value="3"><span class=" star"></span>'+
                                   '<input type="radio" name="rating" value="2"><span class=" star"></span>'+
                                   '<input type="radio" name="rating" value="1"><span class=" star"></span>'+
                                   
                                   '<button id="ajaxStart" class="btn btn-primary mt-3 mt-2 addHistorique"  type="button" value="'+item.id+'">save</button>'+
                               '</span>'+
                               
                           '</div>'
                       '</div>'+
                   '</form>';
                   var marker = new L.marker([Number(late),Number(lngt)])
                  .bindPopup(info).addTo(map);
   
   
                   });
               }
           });
       }
})