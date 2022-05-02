$(document).ready(function(){
              $('.Dashboard').click(function(){
                $(".content").html("");
                  $(".content").load("/dachboarde");
              });

              //Lien de afficher datatable Markers
              $('.Table-markers').click(function(){
                $(".content").html("");
                        $(".content").load("listPoi");//code html table POI 
                        $(".script").load("Ajax_Datatables_Markers"); //code Ajax table POI     
               });
               $('.Table-markerstow').click(function(){
                $(".content").load("listPoi");//code html table POI 
                $(".script").load("Ajax_Datatables_Markers"); //code Ajax table POI     
               });
               // lien de afficher datatable user 
               $('.Table-Users').click(function(){
                $(".content").html("");
                    $(".content").load("listUsers"); //code html table User

                   $(".script").load("Ajax_Datatables_Users");  //    //code Ajax table Users
               });

               // lien de afficher datatable user 
               $('.profile').click(function(){
                         
                $(".content").load("/profile"); //code html table User

               //$(".script").load("Ajax_Datatables_Users");  //    //code Ajax table Users
           });

           //paget Pridiction
           $('.Table-similarity-Users').click(function(){
            $(".content").load("/SimilartyUser"); //code html table Historique

           });
           $('.Table-similarity-this-User').click(function(){
            $(".content").load("SimilarityUser."+$('#user_id').val()); //code html table Historique

           });
           $('.table-similarity-person_item').click(function(){
            $(".content").load("/SimilartyItem"); //code html table Historique

           });
           $('.table-similarity-SlopOne-item').click(function(){
            $(".content").load("/SimilartySlopEOne"); //code html table Historique

           });
           //fin les page pridiction
           
           $('.table-Historique-Totale').click(function(){
            $(".content").load("/TableHistoriqueTotale"); //code html table Historique
           // alert();
           });
           
           $('.predaction-User-base').click(function(){
             //$(".content").load("/predactionPearsonUserBase"); //code html table Historique
            });
            $('.predaction-item-base').click(function(){
             $(".content").load("/predactionPearsonItemBase"); //code html table Historique
            
            });
            $('.predaction-item-base-SlopOne').click(function(){
             $(".content").load("/predactionSlopOneItemBase"); //code html table Historique
            
            });

            //page home
            $('.SystemRocomndation').click(function(){
                $(".content").load("/SystemRocomndation"); //code html table Historique
               
               });
               
               
               //page home
               $('.MatrixFactorisation').click(function(){
                $(".content").load("/factorisation"); //code html table Historique 
          
            });

            //get location 
             $('.get-locationCity').click(function(){
                
                $(".content").load("/get-locationCity");
             })
            //profile parsonale
            $('.prfile_parsonal').click(function(){
               // alert()
            $(".content").load("/Profile-Personal"+$('#user_id').val()); //code html table Historique
            })
           $(document).on('click', '.editbtn-user', function (e) {
            e.preventDefault();
            //alert($(this).val());
            // afficher lest table markers
           // ListeMarkers()
        });
       
});


$(document).on('click', '.editbtn-poi', function (e) {
    e.preventDefault();
  
    $(".content").load("/show_Page_marker"); //code html table User
    // afficher lest table markers
   readMarker($(this).val())
});

$(document).on('click', '.ADD_POI', function (e) {
    e.preventDefault();
    $(".content").load("/show_Page_marker"); //code html table User
    // afficher lest table markers
    
    lastaddPOI()
});
function lastaddPOI(){
 var id_user = $("#user_id").val();
 
         $.ajax({
             
             type: "GET",
             url: "/getLastMarkers/"+id_user,
             dataType: "json",
             beforeSand:function(){
                      
               
         },
             success: function (response) {
    $(".pose").html( "Last POI create");      
    $("#inputRoute").val("/ajax_add/marker");
              $('.btn_update_marker').hide();
              
               var  map = L.map('maps').setView([response.markers.lat,response.markers.lng], 12);
               L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
               attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
              }).addTo(map);
              let info='<form id="rating-form'+response.markers.id+'">'+
              ' <p><h6 style="max-width:100px">'+response.markers.tetle+'</h5></p>'+
              '<img src="public/marker/'+response.markers.image+ '"width="100" height="50" alt="" class="navbar-brand">'+
              '<div class="mb-3">'+
                 '<label for="exampleFormControlTextarea1" class="form-label">Commonter</label>'+
                  '<div class="">'+
                      
                  '</div>'
              '</div>'+
          '</form>';
          var marker = new L.marker([response.markers.lat,response.markers.lng])
          .bindPopup(info).addTo(map);
             },complete:function(){
                     
            }
         })
}


 function readMarker(id){
    //alert(id);
    $.ajax({
        type: "GET",
        url: "/editmarkers"+id,
        dataType: "json",
        success: function (response) {
            if (response.status == 404) {
               // $('#success_message').addClass('alert alert-success');
               // $('#success_message').text(response.message);
               // $('#editMarker').modal('hide');
            } else {
              $(".pose").html( "This POI Update");      
                
              $("#inputRoute").val("/ajax_upload/marker");
               // console.log(response.marker.name);
               $('#marker_id').val(response.markers.id)
               $('#wilaya_id').append('<option  value="'+response.markers.wilaya_id+'">'+response.markers.wilaya_id+'</option>');
               $('#commine_id').append('<option  value="'+response.markers.commine_id+'">'+response.markers.commine_id+'</option>');
               $('#type_id').append('<option  value="'+response.markers.type_id+'">'+response.markers.type_id+'</option>');
                $('#tetle').val(response.markers.tetle);
                $('#Latitude').val(response.markers.lat);
                $('#Longitude').val(response.markers.lng);
                
                $('#last_image').val(response.markers.image);
                $('.btn_add_marker').hide(); 
                document.getElementById("myImage_marker").src = 'public/marker/'+response.markers.image;
               var  map = L.map('maps').setView([response.markers.lat,response.markers.lng], 13);
                           L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                           attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                          }).addTo(map);
                          
                  var marker = new L.marker([response.markers.lat,response.markers.lng])
                  .bindPopup("info").addTo(map);
            }
        }
    });

   
 }  
