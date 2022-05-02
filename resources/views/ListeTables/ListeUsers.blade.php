<div class="card-header"><span><i class="bi bi-table me-2"></i></span> Data Table POI</div>
            
 <div class="card-body">
    <div class="table-responsive">
       <table class="table table-bordered yajra-datatable-user table-striped "style="width: 100%"id="ajax-crud-datatable">
          <thead>
              <tr>
                   <th>ID</th>
                   <th>image</th>
                   <th>name</th>
                   <th>email</th>
                   <th>Action</th>
              </tr>
          </thead>
        </table>
    </div>
</div>
{{-- model edit --}}
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title taxt-danger" id="exampleModalCenterTitle">Edit Users</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
            
  
    <script src="{{asset('js/wilay/wilay.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/user/user.css')}}">
    <div class="container">
        <input type="hidden" name="user"value="{{ Auth::user()->id }}">
        <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card h-100">
            <div class="card-body">
                {{--action="{{route('UserControler')}}"--}}
                <form id="contact-form" class="form-edit-profil" method="post" enctype="multipart/form-data">
                    
                    @csrf
                    <input type="hidden" id="user_id" name="id"value="">
                    
                    <input type="hidden" id="inputRoute" name="" value="{{route('UserControler')}}">
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h6 class="mb-2 text-primary">Personal Details</h6>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input type="text" name="name" class="form-control itext" id="Name" placeholder="Enter full name"value="">
                            <span class="ivalid-feedback stext"></span>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="eMail">Email</label>
                            <input type="email" name="email"class="form-control intext @error('email') is-invalid @enderror" id="Email" placeholder="Enter email ID" value="">
                           
                            <span class="invalid-feedback stext" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="website">Password</label>
                                <input type="password"name="password" class="form-control itext @error('password') is-invalid @enderror" id="Password" placeholder="Website url">
                               
                                    <span class="invalid-feedback stext" role="alert">
                                        <strong></strong>
                                    </span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                
                            <label for="password-confirm" >{{ __('Confirm ') }}</label>
                                <input id="password-confirm itext" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                                    <span class="invalid-feedback stext" role="alert">
                                        <strong></strong>
                                    </span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="phone">Photo</label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                   <input type="file" name="image" class=" form-control custom-file-input itext @error('image') is-invalid @enderror" id="image"onchange ="previewFile()">
                                   <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>
                                   
                                </div>
                                    <span class="stext" role="alert">
                                        <strong></strong>
                                    </span>
                            </div>
                            <input type="hidden" name="last_img" value="">
                                   
                        </div>
                    </div>

                </div>
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h6 class="mt-3 mb-2 text-primary">Address</h6>
                    </div>
                </div>
                
               <div class="row">
                  <div class="form-group mb-3 col-6">
                         <label for="inputGroupSelect01">Wilaya</label>
                      
                      <select class="form-control" id="wilaya_id"name="wilay"onchange="getValue(this);">
                        <option selected value="{{ Auth::user()->wilay }}">{{ Auth::user()->wilay }}</option>
                     </select>
                  </div>
                  <div class="form-group mb-3 col-6">
                      <label  for="inputGroupSelect01">Commines</label>
                    
                    <select class="form-control" name="commine" id="commine_id">
                        <option selected value="{{ Auth::user()->commine }}">{{ Auth::user()->commine }}</option>
                    </select>
                </div>
               </div>
                <div class="row gutters ">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="text-center mx-auto">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary " data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Update</button>
                            
                        </div>
                    </div>
                </div>
                
            </form>
            </div>
        </div>
        </div>
        </div>
        </div>
        
        <div class="modal fade bd-example-modal-sm " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    <div class="spinner-border text-primary justify-content-center" role="status"style="display: none">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
              </div>
            </div>
          </div>
        <script src="{{asset('updat/image/image.js')}}"></script>
        </div>
        <div class="modal-footer text-center">
            <div class="spinner-border text-primary justify-content-center" role="status"style="display: none">
                <span class="sr-only">Loading...</span>
            </div>
        
        </div>
      </div>
    </div>
  </div>
{{--fin model edit--}}
{{--
 <!-- Modal delete -->
 <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title taxt-danger" id="exampleModalCenterTitle">Are You Sure</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        
        <form id="modelDelet-form" method="POST" action="deletemarkers"enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="inputRoute" name="" value="deletemarkers">
            <input type="hiddn" id="idm" name="idm" value="">
        <div class="modal-body">
            <div class="row">
                <div class="col-6 pg-success">
                    <figure class="figure">
                        <img id="image_marker"src="..." class="figure-img img-fluid rounded" alt="...">
                        <figcaption class="figure-caption Title"></figcaption>
                      </figure>
                </div>
                <div id="maps"class="col-6 pg-info">
                </div>
            </div>
        </div>
        <div class="modal-footer text-center">
            <div class="spinner-border text-primary justify-content-center" role="status"style="display: none">
                <span class="sr-only">Loading...</span>
            </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
          <button type="submit" class="btn btn-danger" > <i class="bi bi-trash" ></i>Delet</button>
        </div>
    </form>
      </div>
    </div>
  </div>
--}}
  <script>
$('#modelDelet-form').on('submit', function(event){
  event.preventDefault();
  $.ajax({
   url:"deletemarkers",
   method:"POST",
   data:new FormData(this),
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
   },
   complete:function(){
            
         $(".content").show(1000).load("listPoi");//code html table POI 
         $(".script").load("Ajax_Datatables_Markers"); //code Ajax table POI 
        }
  })
 });




       $(document).on('click', '.delete-Marker', function (e) {
            e.preventDefault();
            //alert($(this).val());
            // afficher lest table markers
           // ListeMarkers()

           $.ajax({
        type: "GET",
        url: "/editmarkers"+$(this).val(),
        dataType: "json",
        success: function (response) {
            if (response.status == 404) {
            } else {
              $(".Title").html( response.markers.tetle);      
                $("#idm").val(response.markers.id);
                document.getElementById("image_marker").src = 'public/marker/'+response.markers.image;
               var  map = L.map('maps').setView([response.markers.lat,response.markers.lng], 13);
                           L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                           attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                          }).addTo(map);
                          
                  var marker = new L.marker([response.markers.lat,response.markers.lng])
                  .bindPopup(response.markers.tetle).addTo(map);
               }
        }
    });



});


  </script>