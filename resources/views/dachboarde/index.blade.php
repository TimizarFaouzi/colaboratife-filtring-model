
<!DOCTYPE html>
<html lang="en"lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Document</title>
  
            
    <!-- Fonts 
        
    <link href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" rel="stylesheet"/> -->
    {{-- style css fonts zise--}}
    <link rel="stylesheet" href="{{asset('css/openstreet.css')}}">
    <!--Style les graph -->
    <link href="{{asset('css/styleGraph.css')}}" rel="stylesheet">
  <!--Morris Chart CSS -->
  <link rel="stylesheet" href="{{asset('assets/css/morris.css')}}">
  
  <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}" />
  <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('assets/css/metismenu.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
  
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
  />
  <link rel="stylesheet" href="{{asset('admin/css/dataTables.bootstrap5.min.css')}}" />
  <!-- jQuery  -->
  <script src="{{asset('assets/js/jquery.min.js')}}"></script>
  <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/js/metismenu.min.js')}}"></script>
  <script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
  <script src="{{asset('assets/js/waves.min.js')}}"></script>
  <!--Morris Chart-->
  <script src="{{asset('assets/js/morris.min.js')}}"></script>
  <script src="{{asset('assets/js/raphael.min.js')}}"></script>
  {{--<script src="{{asset('assets/js/dashboard.init.js')}}"></script>--}}
  <!-- App js -->
  <script src="{{asset('assets/js/app.js')}}"></script>
                           
</head>
<body>
<!-- Begin page -->
<div id="wrapper">
    
            @auth
            
            <input type="hidden" id="user_id" name="user_id"value="{{Auth::user()->id}}">
              <!-- Top Bar Start -->
              <div class="topbar">
      
                  <!-- LOGO -->
                  <div class="topbar-left">
                      <a href="#" class="logo">
                          <span class="logo-light">
                                  <i class="mdi mdi-camera-control"></i> SIA Master
                              </span>
                          <span class="logo-sm">
                                  <i class="mdi mdi-camera-control"></i>
                              </span>
                      </a>
                  </div>
      
                  <nav class="navbar-custom">
                      <ul class="navbar-right list-inline float-right mb-0">
      
                          <!-- language-->
                          <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                              <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                  <img src="assets/images/us_flag.jpg" class="mr-2" height="12" alt="" /> English <span class="mdi mdi-chevron-down"></span>
                              </a>
                              
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated language-switch">
                              {{-- div list de Langue
                               
                                  <a class="dropdown-item" href="#"><img src="assets/images/french_flag.jpg" alt="" height="16" /><span> French </span></a>
                                  <a class="dropdown-item" href="#"><img src="assets/images/spain_flag.jpg" alt="" height="16" /><span> Spanish </span></a>
                                  <a class="dropdown-item" href="#"><img src="assets/images/russia_flag.jpg" alt="" height="16" /><span> Russian </span></a>
                                  <a class="dropdown-item" href="#"><img src="assets/images/germany_flag.jpg" alt="" height="16" /><span> German </span></a>
                                  <a class="dropdown-item" href="#"><img src="assets/images/italy_flag.jpg" alt="" height="16" /><span> Italian </span></a>
                              
                              end div Langue
                            --}}
                        </div>
                          </li>
      
                          <!-- full screen -->
                          <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                              <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                                  <i class="mdi mdi-arrow-expand-all noti-icon"></i>
                              </a>
                          </li>
      
                          <!-- notification -->
                          <li class="dropdown notification-list list-inline-item">
                              <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                  <i class="mdi mdi-bell-outline noti-icon"></i>
                                  <span class="badge badge-pill badge-danger noti-icon-badge">3</span>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg px-1">
                                  <!-- item-->
                                  <h6 class="dropdown-item-text">
                                          Notifications
                                      </h6>
                                  {{--and star list de notification--}}
                                  {{--<div class="slimscroll notification-item-list">
                                      <!-- item-->
                                      <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                          <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                          <p class="notify-details"><b>Your order is placed</b><span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
                                      </a>
      
                                      <!-- item-->
                                      <a href="javascript:void(0);" class="dropdown-item notify-item">
                                          <div class="notify-icon bg-danger"><i class="mdi mdi-message-text-outline"></i></div>
                                          <p class="notify-details"><b>New Message received</b><span class="text-muted">You have 87 unread messages</span></p>
                                      </a>
      
                                      <!-- item-->
                                      <a href="javascript:void(0);" class="dropdown-item notify-item">
                                          <div class="notify-icon bg-info"><i class="mdi mdi-filter-outline"></i></div>
                                          <p class="notify-details"><b>Your item is shipped</b><span class="text-muted">It is a long established fact that a reader will</span></p>
                                      </a>
      
                                      <!-- item-->
                                      <a href="javascript:void(0);" class="dropdown-item notify-item">
                                          <div class="notify-icon bg-success"><i class="mdi mdi-message-text-outline"></i></div>
                                          <p class="notify-details"><b>New Message received</b><span class="text-muted">You have 87 unread messages</span></p>
                                      </a>
      
                                      <!-- item-->
                                      <a href="javascript:void(0);" class="dropdown-item notify-item">
                                          <div class="notify-icon bg-warning"><i class="mdi mdi-cart-outline"></i></div>
                                          <p class="notify-details"><b>Your order is placed</b><span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
                                      </a>
      
                                  </div>--}}
                                  {{-- end list notification--}}
                                  <!-- All-->
                                  <a href="javascript:void(0);" class="dropdown-item text-center notify-all text-primary">
                                          View all <i class="fi-arrow-right"></i>
                                      </a>
                              </div>
                          </li>
      
                          <li class="dropdown notification-list list-inline-item">
                              <div class="dropdown notification-list nav-pro-img">
                                  <a class="dropdown-toggle nav-link arrow-none nav-user " data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                      <img src="public/profile/{{ Auth::user()->image }}" alt="user" class="rounded-circle">
                                  </a>
                                  <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                      <!-- item-->
                                      <a class="dropdown-item profile" href="#"><i class="mdi mdi-account-circle"></i> Profile</a>
                                      {{--<a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="mdi mdi-settings"></i> Settings</a>--}}
                                      <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline"></i> Lock screen</a>
                                      <div class="dropdown-divider"></div>
                                      <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="mdi mdi-power text-danger"></i>{{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                  </div>
                              </div>
                          </li>
      
                      </ul>
      
                      <ul class="list-inline menu-left mb-0">
                          <li class="float-left">
                              <button class="button-menu-mobile open-left waves-effect">
                                  <i class="mdi mdi-menu"></i>
                              </button>
                          </li>
                          <li class="d-none d-md-inline-block">
                              <form role="search" class="app-search">
                                  <div class="form-group mb-0">
                                      <input type="text" class="form-control" placeholder="Search..">
                                      <button type="submit"><i class="fa fa-search"></i></button>
                                  </div>
                              </form>
                          </li>
                      </ul>
      
                  </nav>
      
              </div>
              <!-- Top Bar End -->
      
              <!-- ========== Left Sidebar Start ========== -->
              <div class="left side-menu">
                  <div class="slimscroll-menu" id="remove-scroll">
      
                      <!--- Sidemenu -->
                      <div id="sidebar-menu">
                          <!-- Left Menu Start -->
                          <ul class="metismenu" id="side-menu">
                              <li class="menu-title">Menu</li>
                              <li>
                                  <a href="#" class="waves-effect Dashboard">
                                      <i class="icon-accelerator"></i><span class="badge badge-success badge-pill float-right">9+</span> <span> Dashboard </span>
                                  </a>
                              </li>
                               
                              <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="icon-map"></i><span> Maps <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a class="SystemRocomndation" href="#"> Google Map</a></li>
                                    <li><a href="#"> Locations City</a></li>
                                    <li><a href="#"> Locations Route</a></li>
                                    <li><a href="#">  locations Marker</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="bi bi-table me-2"></i><span> Tables <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="#"class="Table-Users">Tables Users</a></li>
                                    <li><a href="#" class="Table-markers">Table POI</a></li>
                                    <li><a class="table-Historique" href="#">Table Historical</a></li>
                                    
                                </ul>
                            </li><li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="bi bi-calendar-week-fill"></i> Tables similarity <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="#"class="Table-similarity-Users">Tables similarity  User </a></li>
                                    <li><a href="#" class="Table-similarity-this-User">similarity This User</a></li>
                                    <li><a class="table-similarity-person_item" href="#">Tables similarity  Item Algo Pearson</a></li><li><a class="table-similarity-SlopOne-item" href="#">Tables similarity  Item Algo Slop One</a></li>
                                    
                                </ul>
                            </li>
                              <li>
                                  <a href="javascript:void(0);" class="waves-effect"><i class="icon-mail-open"></i><span> Email </a>
                              </li>
      
                              <li>
                                  <a href="#" class="waves-effect"><i class="icon-calendar"></i><span> Calendar </span></a>
                              </li>
      
                              <li>
                                  <a href="javascript:void(0);" class="waves-effect"><i class="icon-paper-sheet"></i><span> Pages <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                  <ul class="submenu">
                                      
                                      <li><a href="#">Home</a></li>
                                      <li><a href="#">Profile personal</a></li>
                                      <li><a href="#">Edit profile</a></li>
                                  </ul>
                              </li>
      
                              <li class="menu-title">Components</li>
                              <li>
                                  <a href="javascript:void(0);" class="waves-effect"><i class="icon-diamond"></i> <span> Advanced UI <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                                  <ul class="submenu">
                                      {{--<li><a href="#"><i class="bi bi-list-stars"></i></a></li>--}}
                                     <li> <a class="table-Historique-Totale" href="#"><i class="bi bi-hourglass-split"></i> Table Historique </a></li>
                                     <li> <a class=" predaction-User-base" href="#"><i class="bi bi-star-half"></i> Predaction avence User-base</a></li>
                                     <li><a class="predaction-item-base" href="#"> <i class="bi bi-star-half"></i> Predaction avence Item-base</a></li>
                                     <li>
                                        <a class="predaction-item-base-SlopOne" href="#"><i class="bi bi-star-half"></i>  Predaction base slope one</a></li>
                                     
                                  </ul>
                              </li>
                              <li>
                                  <a href="javascript:void(0);" class="waves-effect"><i class="icon-graph"></i><span> Charts <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                  <ul class="submenu">
                                      <li><a href="#">Chart Rocomndation System</a></li>
                                      <li><a href="#">Chart POI</a></li>
                                  </ul>
                              </li>
                                <li>
                                  <a href="javascript:void(0);" class="waves-effect"><i class="icon-coffee"></i> <span> Icons  <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span> </a>
                                  <ul class="submenu">
                                      <li><a href="#">Icone POI</a></li>
                                      
                                  </ul>
                              </li>
      
                          </ul>
      
                      </div>
                      <!-- Sidebar -->
      
                  </div>
                  <!-- Sidebar -left -->
      
              </div>
              <!-- Left Sidebar End -->   
              @endauth
              <!-- ============================================================== -->
              <!-- Start right Content here -->
              <!-- ============================================================== -->
              <div class="content-page">
                  <!-- Start content -->
                  <div class="content">
                
                      @yield('content')
                      {{--and container-fluid --}}
                      <!-- container-fluid -->
      
                  </div>
                  <!-- content -->
      
                  <footer class="footer">
                      ©2021 SIA Master <span class="d-none d-sm-inline-block"> - Love <i class="mdi mdi-heart text-danger"></i> by SIA Master.in.com</span>
                  </footer>
      
              </div>
              <!-- ============================================================== -->
              <!-- End Right content here -->
              <!-- ============================================================== -->
      
          </div>
          <!-- END wrapper -->
          {{--add wilaya--}}   
                {{--<script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>--
              
                <script src="{{asset('admin/dist/chart.min.js')}}"></script>
                --}}
                
                <script src="{{asset('admin/js/jquery.dataTables.min.js')}}"></script>
                <script src="{{asset('admin/js/dataTables.bootstrap5.min.js')}}"></script>
                <script src="{{asset('page/loadePagedachboard.js')}}"></script>
                
                <script src="{{asset('wilay/localistion.js')}}"></script>
                
                {{-- script insertion location to table wilaya et commens
                    
                <script src="{{asset('js/wilay/wilay.js')}}"></script>
                 <script src="{{asset('wilay/localistion.js')}}"></script>
                <script src="{{asset('wilay/commin.js')}}"></script>
                --}}
</body>
<script class="script"></script>

<script>
   
        
    </script>
</html>