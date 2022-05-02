
  
    <script src="{{asset('js/wilay/wilay.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/user/user.css')}}">
    <div class="container">
        <input type="hidden" name="user"value="{{ Auth::user()->id }}">
        <div class="row gutters">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 position-relative">
        <div class="card ">{{--h-100--}}
            <div class="card-body">
                <div class="account-settings">
                    <div class="user-profile ">
                        <div class="user-avatar ">
                            <img src="public/profile/{{ Auth::user()->image }}" alt="Maxwell Admin" class="ml-5"id="myImage" style="align-content: center">
                        </div>
                        <h5 class="user-name">{{ Auth::user()->name }}</h5>
                        <h6 class="user-email">{{ Auth::user()->email }}</h6>
                    </div>
                    <div class="about">
                        <h5>Environ</h5>
                        <p>Je suis {{ Auth::user()->name }}. Mon travail sur ce site est : {{ Auth::user()->role }}</p>
                        <p> Évaluation moyenne : {{ Auth::user()->moyanne }}</p>
                        <p>Nombre de visites : {{ Auth::user()->nb_visited }} POI</p>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="card h-100">
            <div class="card-body">
                {{--action="{{route('UserControler')}}"--}}
                <form id="contact-form" class="form-edit-profil" method="post" enctype="multipart/form-data">
                    
                    @csrf
                    <input type="hidden" id="user_id" name="id"value="{{ Auth::user()->id }}">
                    
                    <input type="hidden" id="inputRoute" name="" value="{{route('UserControler')}}">
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h6 class="mb-2 text-primary">Personal Details</h6>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input type="text" name="name" class="form-control" id="fullName" placeholder="Enter full name"value="{{ Auth::user()->name }}">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="eMail">Email</label>
                            <input type="email" name="email"class="form-control @error('email') is-invalid @enderror" id="eMail" placeholder="Enter email ID" value="{{ Auth::user()->email }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="website">Password</label>
                                <input type="password"name="password" class="form-control @error('password') is-invalid @enderror" id="website" placeholder="Website url">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                
                            <label for="password-confirm" >{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="phone">Photo</label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                   <input type="file" name="image" class=" form-control custom-file-input @error('image') is-invalid @enderror" id="last_image"onchange ="previewFile()">
                                   <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>
                                   
                                </div>
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input type="hidden" name="last_img" value="{{ Auth::user()->image }}">
                                   
                        </div>
                    </div>

                </div>
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h6 class="mt-3 mb-2 text-primary">Address</h6>
                    </div>
                </div>
                
               <div class="row">
                  <div class="input-group mb-3 col-6">
                       <div class="input-group-prepend">
                         <label class="input-group-text" for="inputGroupSelect01">Wilaya</label>
                      </div>
                      <select class="custom-select" id="wilaya_id"name="wilay"onchange="getValue(this);">
                        <option selected value="{{ Auth::user()->wilay }}">{{ Auth::user()->wilay }}</option>
                     </select>
                  </div>
                  <div class="input-group mb-3 col-6">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect01">Commines</label>
                    </div>
                    <select class="custom-select" name="commine" id="commine_id">
                        
                        <option selected value="{{ Auth::user()->commine }}">{{ Auth::user()->commine }}</option>
                    </select>
                </div>
               </div>
                <div class="row gutters ">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="text-center mx-auto">
                            <button type="reste"  name="rest" class="btn btn-secondary ">Cancel</button>
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
        <script src="{{asset('updat/image/image.js')}}"></script>{{--
            <script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>--}}
        <script>
            $(document).ready(function () {
                
                $('.form-edit-profil').on('submit', function(event){
                  event.preventDefault();
                    $.ajax({
                        
                        url:$("#inputRoute").val(),
                        method:"POST",
                        data:new FormData(this),
                        dataType:'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend:function(){
                             
                            $('.spinner-border ').css('display', 'block');
                        },
                        success:function(data){
                           $('.spinner-border ').hide(1000)
                          // $(".content").load("/SystemRocomndation"); //code html table Historique
                        }
                        
                        
                    })
                })
            
            });
        </script>