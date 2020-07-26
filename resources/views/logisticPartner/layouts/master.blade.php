<!--

=========================================================
* Now UI Dashboard - v1.5.0
=========================================================

* Product Page: https://www.creative-tim.com/product/now-ui-dashboard
* Copyright 2019 Creative Tim (http://www.creative-tim.com)

* Designed by www.invisionapp.com Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../admin_dashboard_assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../admin_dashboard_assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
   @yield('title')
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="../admin_dashboard_assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../admin_dashboard_assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../admin_dashboard_assets/demo/demo.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="sweetalert2/dist/sweetalert2.min.css">

   <script>
            var baseUrl = '{{url("/")}}';
        </script>
     
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="pink">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->

      <div class="logo">
        <a href="/admin/dashboard" class="simple-text logo-normal">
         <img src="{{ asset('white') }}/img/lc_logo.png" alt="MyHelperApp Logo" style="width: 100px; height: 40px;">
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li @if (isset($pageSlug) && $pageSlug == 'logisticPartner_dashboard') class="active"  @endif>
            <a href="{{route('logistic_partner.dashboard')}}" >
              <i class="now-ui-icons design_app" @if (isset($pageSlug) && $pageSlug == 'logisticPartner_dashboard') style="color: #000000;" @endif></i>
              <p  @if (isset($pageSlug) && $pageSlug == 'logisticPartner_dashboard') style="color: #000000;" @endif>Dashboard</p>
            </a>
          </li>
         
          <li @if (isset($pageSlug) && $pageSlug == 'logisticPartner_request') class="active"  @endif>
            <a href="{{route('logistic_partner.requests')}}" >
              <i class="now-ui-icons design_app" @if (isset($pageSlug) && $pageSlug == 'logisticPartner_request') style="color: #000000;" @endif></i>
              <p  @if (isset($pageSlug) && $pageSlug == 'logisticPartner_request') style="color: #000000;" @endif>Requests/Provisions</p>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="now-ui-icons users_single-02"></i>
              <p>User Profile</p>
            </a>
          </li>
        
       
         
        </ul>
      </div>
    </div>



    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Welcome to Logistic Partner Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                        <a class="nav-link href="{{ route('logout') }}" aria-haspopup="true" aria-expanded="false" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                  <i class="fa fa-lock" aria-hidden="true" title="Log Out"></i>
                   <p>
                    <span class="d-lg-none d-md-block">Logout</span>
                  </p>
                   
            </a>    
            <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
            </form>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons location_world"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="{{route('admin.profile')}}">
                  <i class="now-ui-icons users_single-02" title="View Profile"></i>
                View Profile</a>

                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                     <i class="fa fa-lock" aria-hidden="true" title="Log Out"></i>
                   Logout
            </a>    
            <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
            </form>

                </div>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="{{route('admin.profile')}}">
                  <i class="now-ui-icons users_single-02" title="View Profile"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
              </li>

                
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>

      <div class="content">
        @include('admin.flash_messages')
        @yield('content')

       
      </div>

      <footer class="footer">
        <div class=" container-fluid ">
          <nav>
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  Creative Tim
                </a>
              </li>
              <li>
                <a href="http://presentation.creative-tim.com">
                  About Us
                </a>
              </li>
              <li>
                <a href="http://blog.creative-tim.com">
                  Blog
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright" id="copyright">
            &copy; <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>, Designed by <a href="https://www.invisionapp.com" target="_blank">Invision</a>. Coded by <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
          </div>
        </div>
      </footer>
    </div>

    

  </div>
  <!--   Core JS Files   -->
  <script src="../admin_dashboard_assets/js/core/jquery.min.js"></script>
  <script src="../admin_dashboard_assets/js/core/popper.min.js"></script>
  <script src="../admin_dashboard_assets/js/core/bootstrap.min.js"></script>
  <script src="../admin_dashboard_assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../admin_dashboard_assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../admin_dashboard_assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../admin_dashboard_assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="../admin_dashboard_assets/demo/demo.js"></script>
  <script src="../admin_dashboard_assets/admin_custom.js"></script>
           
   <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

    <!-- sweetalert script -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="sweetalert2/dist/sweetalert2.all.min.js"></script>
  <script>
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
    </script>
  @yield('scripts')
</body>

</html>