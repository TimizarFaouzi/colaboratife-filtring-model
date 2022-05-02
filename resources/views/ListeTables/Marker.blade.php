
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
                 <meta charset="UTF-8" />
              <meta http-equiv="X-UA-Compatible" content="IE=edge" />
              <meta name="viewport" content="width=device-width, initial-scale=1.0" />
              <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}" />
              <link
                rel="stylesheet"
                href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
              />
              <link rel="stylesheet" href="{{asset('admin/css/dataTables.bootstrap5.min.css')}}" />
              <script src="{{asset('assets/js/jquery.min.js')}}"></script>
              <link rel="stylesheet" href="{{asset('admin/css/style.css')}}" />     
<div class="container mt-2">

              @if ($message = Session::get('success'))
              <div class="alert alert-success">
              <p>{{ $message }}</p>
              </div>
              @endif
              <div class="card">
               
              </div>
              <button type="button" class="btn ml-5 btn-success add_poi" data-toggle="modal" data-target="#AddMarker">new Marker</button>
              
              </div>
              <!-- boostrap company model -->
              {{-- Edit Modal --}}
              <div class="modal fade" id="editMarker" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit & Update POI Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                    </div>
                                <form id="contact-form"action="/update-markers/"method="post" enctype="multipart/form-data">
                                        @csrf
                                    <div class="modal-body">
                                     
                                        <ul id="update_msgList"></ul>
                        
                                         
                                        <input type="hidden" id="input_id"Name="input_id">
                                        <input type="hidden" id="fin_image"Name="fin_image">
                                        <div class="form-group mb-3">
                                            <label for="">Title</label>
                                            <input type="text" id="title" name="title" required class="form-control">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Latitude</label>
                                            <input type="text" id="Latitude"name="Latitude" required class="form-control">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Longitude</label> 
                                            <input type="text" id="Longitude"name="Longitude" required class="form-control">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">image</label>
                                            <input id="last_image" type="file" class="form-control" name="last_image" onchange ="previewFile()">
                                            <div class="col-md-6">
                                                <img id="myImage"alt="photo "style="width: 100%;height: 100px;">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <a class="btn btn-link" href="https://www.latlong.net/" target="_blank" rel="noopener noreferrer">select les poit lat and lng </a>
                                        <button type="reset"class="btn btn-secondary" >reset</button>
                                        <button type="button" class="btn btn-secondary close" >Close</button>
                                        <button type="submit" class="btn btn-primary update_studentd">Update</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        {{-- Edn- Edit Modal --}}
                       {{--end error--}} 
                      
              <div class="modal fade" id="AddMarker" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Add  une POI</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                    </div>
                               
                                 <form id="form_addmarkers" class="poiForm" method="POST" action="#"enctype="multipart/form-data">
                                        @csrf
                                    <div class="modal-body">
                                     
                                        <ul id="update_msgList"></ul>
                        
                                        <div class="form-group mb-3">
                                            <label for="">Title</label>
                                            <input id="tetle" type="text" class="form-control @error('tetle') is-invalid @enderror" name="tetle" value="{{ old('tetle') }}" required autocomplete="name" autofocus>
                        
                                            @error('tetle')
                                                <span class="invalid-feedback" role="alert"id="erre-tetle">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Latitude</label>
                                            <input id="lat" type="text" class="form-control @error('lat') is-invalid @enderror" name="lat" value="{{ old('lat') }}" required autocomplete="lat">
                        
                                            @error('lat')
                                                <span class="invalid-feedback" role="alert" id="erre-lat">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Longitude</label> 
                                            <input id="lng" type="text" class="form-control @error('lng') is-invalid @enderror" name="lng" value="{{ old('lng') }}" required autocomplete="lng">
                        
                                            @error('lng')
                                                <span class="invalid-feedback" role="alert"id="erre-lng">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">image</label>
                                            <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file" required onchange ="previewFile()">
                        
                                            @error('file')
                                                <span class="invalid-feedback" role="alert"id="erre-file">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                  
                                            <div class="col-md-6">
                                                <img id="imgpho" class="uploude"alt="photo ">
                                            </div>
                                            <div id="edmap"class="col-md-6" style="width: 100px;height: 100px;"></div>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <a class="btn btn-link" href="https://www.latlong.net/" target="_blank" rel="noopener noreferrer">select les poit lat and lng </a>
                                        <button type="reset"class="btn btn-secondary" >reset</button>
                                        <button type="button" class="btn btn-secondary close" >Close</button>
                                        <button type="submit"value="btnadd" class="btn btn-primary add_markers">Enregistrer</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        {{-- Edn- add Modal --}}  <script class="script"></script> 

                        
                <script src="{{asset('admin/js/jquery.dataTables.min.js')}}"></script>
                <script src="{{asset('admin/js/dataTables.bootstrap5.min.js')}}"></script>
                <script src="{{asset('page/loadePagedachboard.js')}}"></script>

                    
                        
                      
