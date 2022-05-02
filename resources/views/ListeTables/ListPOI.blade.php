
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<div class="card-header">
       <div class="page-title-box">
              <div class="row align-items-center">
                  <div class="col-sm-6">
                      <h4 class="page-title"><span><i class="bi bi-table me-2"></i></span> System Rocmndation</h4>
                      
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-right">
                          <li class="breadcrumb-item"><a href="#">SIA Master</a></li>
                          <li class="breadcrumb-item active"><a class="text-success "href="#">Openstreet</a></li>
                      </ol>
                  </div>
              </div>
              <!-- end row -->
          </div>
</div>
            
<div class="card-body">
              <div class="table-responsive">
              <table class="table table-bordered yajra-datatable-user table-striped "style="width: 100%"id="ajax-crud-datatable">
              <thead>
              <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>image</th>
                            <th>Number Vi</th>
                            <th>Action</th>
              </tr>
              </thead>
              </table>
              </div>
              </div>
              <!-- Modal -->
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