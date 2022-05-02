
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
       <div class="page-title-box">
              <div class="row align-items-center">
                  <div class="col-sm-6">
                      <h4 class="page-title">Dashboard</h4>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-right">
                          <li class="breadcrumb-item"><a href="#">SIA Master</a></li>
                          
                          <li class="breadcrumb-item active"><a class=" List-POI"href="#">List Poi</a></li>
                          <li class="breadcrumb-item text-success">Page Form POI</li>
                      </ol>
                  </div>
              </div>
              <!-- end row -->
          </div>
          <div class="alert alert-success d-none" id="msg_div">
            <span id="res_message"></span>
   </div>
   
   <div class="alert" id="message" style="display: none"></div>
   <form method="post" id="upload_form" enctype="multipart/form-data">
       @csrf
       <input type="hidden" id="inputRoute" value="">
        <div class="row">
       <div class="col-md-12">
         
       </div>
     </div>


     {{--star raw header edit--}}
     <div class="row">
   
                                   
       <div class="col-sm-6 col-xl-6 bg-primary">
            <div class="row pl-2">
                    <div class="row">
                        <div class="form-group mb-1">
                            <label for="">Title</label>
                            <input id="tetle" type="text" class="form-control text @error('tetle') is-invalid @enderror" name="tetle" value="{{ old('tetle') }} " required autocomplete="name" autofocus>
                            <span class="text-danger error-text tetle_error"></span>
                           
                        </div>
                    </div>
    
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mb-1">
                                <label for="">Latitude</label>
                                <input id="Latitude" type="text" class="form-control text @error('lat') is-invalid @enderror" name="lat" value="{{ old('lat') }} " required autocomplete="lat">
                                <span class="text-danger error-text lat_error"></span>
                            </div>
                            
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-1">
                                <label for="">Longitude</label> 
                                <input id="Longitude" type="text" class="form-control text @error('lng') is-invalid @enderror" name="lng" value="{{ old('lng') }}" required autocomplete="lng">
                                <span class="text-danger error-text lng_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            
                            <div class="form-group mb-1">
                               <label class="" >Wilaya</label>
                                <select id="wilaya_id" class="form-control text" name="wilaya_id"onchange="getValue(this);">
                                     {{--<option selected value=""></option>--}}
                                </select>
                            </div>
                
                        </div>
                        <div class="col-6">
                            
                    
                           <div class="form-group mb-1">
                                    <label class="" for="inputGroupSelect01">Commines</label>
                     
                                <select class="form-control text" name="commine_id" id="commine_id">
                                   
                                     {{--<option selected value=""></option>--}}
                               </select>
               
                            </div>
                        </div>
                    </div>
                    
                    <li id="evolation" class="dropdown notification-list list-inline-item">
                        <div class="dropdown notification-list nav-pro-img">
                            <a class="dropdown-toggle nav-link arrow-none nav-user " data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img  src="public/profile/{{ Auth::user()->image }}" alt="user" class="rounded-circle">
                                Rating Users<span class="mdi mdi-chevron-down"></span>
                            </a>
                            <div id="les-ratings" class="dropdown-menu dropdown-menu-right  profile-dropdown ">
                                <!-- item-->
                                {{--end item--}}
                            </div>
                        </div>
                    </li>
                    
                </div>
       </div>
       {{--stare dev card image--}}
        <div class=" col-sm-4 col-xl-4 bg-primary">
            
            <label for="">Map  </label><span class="text-success pose"></span>
           <div  class="row h-100 bg-dark" style="max-height: 200px">
                  <div id="maps">
                  </div>          
           </div>
        </div>
        {{--end dev card image--}}  
        <div class="col-sm-2 col-xl-2 bg-primary">
            <div class="form-group row">
                <label class="" for="type">Type</label>
                     
                <select  class="form-control text" name="type_id" id="type_id">
                          
                                     {{--<option selected value=""></option>--}}
                </select>
            </div> 
            <div class="form-group row">  
                <img id="myImage_marker" src="..." class="" 
                 alt=".." style="max-height: 150px; width: 100%">
            </div>
                <div class="form-group row">
                    <label for="phone">Photo</label>
                    <div class="input-group mb-1">
                        <div class="custom-file">
                           <input type="file" name="file" class=" form-control custom-file-input text @error('image') is-invalid @enderror" id="file">{{--onchange ="previewFile()"--}}
                           <label class="custom-file-label" for="inputGroupFile01">..</label>
                           
                        </div>
                        <span class="text-danger error-text file_error"></span>
                    </div>
                    <input type="hidden" name="last_img"id="last_image" value="">
                           
                </div>
              
        </div>
</div>
   
   <input type="hidden" id="marker_id" name="marker_id"value="">
   <input type="hidden" id="user_id" name="user_id"value="{{Auth::user()->id}}">
    <div class="form-group">
     {{--star row center google map et rating --}}
     <div class="row">
       <div class="col-12 bg-primary text-center" stayl="heigth:200px">
          <div class="card-footer">
             <a class="btn btn-link" href="https://www.latlong.net/" target="_blank" rel="noopener noreferrer">select les poit lat and lng </a>
             <button type="reset"class="btn btn-secondary" >reset</button>
             <button type="submit" name="upload" id="upload" class="btn btn-success" >save</button>
         </div>
         <div class="spinner-border text-success" role="status"style="display: none">
              <span class="sr-only">Loading...</span>
            </div>
      </div>
   </div>
    </div>
   </form>
   <br />
   <span id="uploaded_image"></span>
  </div>

<script>
$(document).ready(function(){
    $('.List-POI').click(function(){
               // $(".content").html("");
                        $(".content").load("listPoi");//code html table POI 
                        $(".script").load("Ajax_Datatables_Markers"); //code Ajax table POI     
    });

 $('#upload_form').on('submit', function(event){
  event.preventDefault();
  var error="folse";
  $.ajax({
   url:$("#inputRoute").val(),
   method:"POST",
   data:new FormData(this),
   dataType:'JSON',
   contentType: false,
   cache: false,
   processData: false,
   beforeSend:function(){
       $(document).find('span.error-text').text('');
       
       
       $('.spinner-border ').css('display', 'block');
   },
   success:function(data)
   {

       if(data.status == 0){
              $.each(data.error, function(prefix, val){
               $('span.'+prefix+'_error').text(val[0]);
               error="true";
               });
              }else{ error="true";
                 $('#upload_form').reset();
                  //alert(data.msg);
              }
              $("#upload_form :input").each(function(){
              $(".text").val('');
               });
      //$('#message').css('display', 'block');
    //  $('#message').html(data.message);
    //  $('#message').addClass(data.class_name);
      
   },
   complete:function(){
        if(error=="folse"){
            
         $(".content").show(1000).load("listPoi");//code html table POI 
         $(".script").load("Ajax_Datatables_Markers"); //code Ajax table POI 
        }
   }
  })
 });

});
</script>
