
          $(document).on('click', '.tablemarkers', function (e) {
            e.preventDefault();
            // afficher lest table markers
           // ListeMarkers()
        });
       // ListeMarkers()
          //function return les liste de user
          function ListeUsers(){
                        
              $.ajax({
                            type: "GET",
                            url: "/ListUsersAjax",
                            dataType: "json",
                            success: function (response) {
                                
                                if (response.status == 404) {
                                   // $('#success_message').addClass('alert alert-success');
                                   // $('#success_message').text(response.message);
                                   // $('#editMarker').modal('hide');
                                   //alert(response.status);
                                } 
                                $('tfoot').html("");
                                $('thead','tfoot').html("");
                                $('thead').append('<tr>\
                                        <th>Name</th>\
                                        <th>Email</th>\
                                        <th>Number Vi</th>\
                                        <th>Edite</th>\
                                        <th>Delete</th>\
                                    \</tr>');
                                $('tbody').html("");
                                $.each(response.users, function (key, item) {
                                    $('tbody').append('<tr>\
                                        <td>' + item.name + '</td>\
                                        <td>' + item.email + '</td>\
                                        <td>' + item.nb_visited + '</td>\
                                        <td><button type="button" value="' + item.id + '" class="btn btn-primary editbtn btn-sm">Edit</button></td>\
                                        <td><button type="button" value="' + item.id + '" class="btn btn-danger deletebtn btn-sm">Delete</button></td>\
                                    \</tr>');
            
                                   
                                $('tfoot').html("");
                                $('tfoot').append('<tr>\
                                        <th>Name</th>\
                                        <th>Email</th>\
                                        <th>Number Vi</th>\
                                        <th>Edite</th>\
                                        <th>Delete</th>\
                                    \</tr>');
                      
            
                                });
                            }
                        });
                       
          }
         // ListeMarkers()
          //function return list Markers
           function ListeMarkers(){
                        
              $.ajax({
                            type: "GET",
                            url: "/ListMarkersAjax",
                            dataType: "json",
                            success: function (response) {
                                 
                                if (response.status == 404) {
                                    // $('#success_message').addClass('alert alert-success');
                                    // $('#success_message').text(response.message);
                                    // $('#editMarker').modal('hide');
                                    //alert(response.status);
                                 }   
                                 $('thead').html("");
                                 $('thead').append('<tr>\
                                         <th>Title</th>\
                                         <th>Latitude</th>\
                                         <th>Longitude</th>\
                                         <th>Number Vi</th>\
                                         <th>image</th>\
                                         <th>Action</th>\
                                     \</tr>');
                               //  $('tbody').html("");
                               //  for (let index = 0; index < 10; index++) {
                                     
                                  $.each(response.markers, function (key, item) {
                                    $('tbody').append('<tr>\
                                        <td>' + item.tetle + '</td>\
                                        <td>' + item.lat + '</td>\
                                        <td>' + item.lng+ '</td>\
                                        <td>' + item.nb_visited + '</td>\
                                        <td>' + item.image + '</td>\
                                        <td colspan="2"><button type="button" value="' + item.id + '" class="btn btn-primary editbtn btn-sm"><i class="bi bi-pencil-square"></i></button>\
                                        <button type="button" value="' + item.id + '" class="btn btn-danger deletebtn btn-sm"><i class="bi bi-trash"></i></button></td>\
                                    \</tr>');
            
                                    //function afcher  graph 
                      
            
                                });
                                     
                                // }
                                 $('tfoot').html("");
                                 $('tfoot').append('<tr>\
                                         <th>Title</th>\
                                         <th>Latitude</th>\
                                         <th>Longitude</th>\
                                         <th>Number Vi</th>\
                                         <th>image</th>\
                                         <th>Action</th>\
                                     \</tr>');
                                if (response.status == 404) {
                                    $('#success_message').addClass('alert alert-success');
                                    $('#success_message').text(response.message);
                                } else {
                                   // console.log(response.marker.name);
                                    $('#title').val(response.markers.tetle);
                                    $('#Latitude').val(response.markers.lat);
                                    $('#Longitude').val(response.markers.lng);
                                    $('#fin_image').val(response.markers.image);
                                    $('#input_id').val(response.markers.id);
                                    $('#edmap').innerHTML="";
                                    document.getElementById("myImage").src = 'public/marker/'+response.markers.image;
                                  var map = L.map('edmap').setView([response.markers.lat,response.markers.lng], 11);
                    
                                  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                   attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                                 }).addTo(map);
                                //var markers= new L.marker([response.markers.lat,response.markers.lng]).addTo(map).bindPopup(response.markers.tetle);
                                   
                                }
                            }
                        });
                       
          }
          $(document).on('click', '.tableusers', function (e) {
            e.preventDefault();
        //$('tbody').html("");
   
            $.ajax ({ 
            
            url:"ListeUsers",
            type:"get",
            beforeSend:function(){
            },
            statusCode:{
            404:function(){
                             $("#ma").html("الصفحة غير موجودة يرجى المحاولة فيما بعد");
                          },
            401:function(){  
                             $("#ma").html("غير مصرح لك");
                          }
                          
                       },
                      
            success:function (data) {
            //$("#ma").html(data);
            
            $('.card').html(data);
            
            },
            complete:function(){
      
                   
            }
            });
            //return false;
            
            });

            $(document).on('click', '.tablemarkers', function (e) {
                e.preventDefault();
                //alert()
              //$('tbody').html("");
                $.ajax ({ 
                
                url:"ListeMarkers",
                type:"get",
                          
                success:function (data) {
                
                //$('main').html("<h1>hi </h1>");
               $('main').html(data);
                
                },
                });
                //return false;
                
                });
                $(document).ready( function () {
                    $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    });
                $(document).on('click', '.editbtn1', function (e) {

                    e.preventDefault();
                    var id = $(this).val();
                   // alert(stud_id)
                    //fetchstudent(stud_id);
                    
                    $('#company-modal').modal('show');
                    $.ajax({
                        type:"POST",
                        url: "{{ url('edit-company') }}",
                        data: { id:id },
                        dataType: 'json',
                        success: function(res){
                        $('#CompanyModal').html("Edit Company");
                        $('#company-modal').modal('show');
                        $('#id').val(res.id);
                        $('#name').val(res.tetle);
                        $('#address').val(res.lat);
                        $('#email').val(res.lng);
                        }
                        });
                
                });
                
            });
            $(document).on('click', '.editbtn', function (e) {
                e.preventDefault();
                var stud_id = $(this).val();
                //fetchstudent(stud_id);
             
                $('#editMarker').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/editmarkers"+stud_id,
                    dataType: "json",
                    success: function (response) {
                        
                        if (response.status == 404) {
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('#editMarker').modal('hide');
                        } else {
                           // console.log(response.marker.name);
                            $('#title').val(response.markers.tetle);
                            $('#Latitude').val(response.markers.lat);
                            $('#Longitude').val(response.markers.lng);
                            $('#fin_image').val(response.markers.image);
                            $('#input_id').val(response.markers.id);
                            $('#edmap').innerHTML="";
                            document.getElementById("myImage").src = 'public/marker/'+response.markers.image;
                          var map = L.map('edmap').setView([response.markers.lat,response.markers.lng], 11);
            
                          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                           attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                         }).addTo(map);
                        //var markers= new L.marker([response.markers.lat,response.markers.lng]).addTo(map).bindPopup(response.markers.tetle);
                           
                        }
                    }
                });
               
            
            });
     
$(document).on('click', '.close', function (e) {
    e.preventDefault();
    $('#editMarker').modal('hide');
    $('#DeleteModal').modal('hide');      
});

$(document).on('click', '.add_poi', function (e) {
    e.preventDefault();
    $('#AddMarker').modal('show');
    $('#DeleteModal').modal('hide');      
});       
            
$('.poiForm').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
    type:'POST',
    url: "{{ route('add-marker') }}",
    data: formData,
    cache:false,
    contentType: false,
    processData: false,
    success: (data) => {
    $("#company-modal").modal('hide');
    var oTable = $('#ajax-crud-datatable').dataTable();
    oTable.fnDraw(false);
    $("#btn-save").html('Submit');
    $("#btn-save"). attr("disabled", false);
    },
    error: function(data){
    console.log(data);
    }
    });
    });
            
            