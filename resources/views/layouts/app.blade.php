<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>MyHelperApp</title>

        <link rel="mask-icon" sizes="any" href="{{ asset('blue') }}/images/icons/favicon-48x48.svg" color="#F08B1D">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('blue') }}/images/icons/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('blue') }}/images/icons/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('blue') }}/images/icons/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('blue') }}/images/icons/apple-touch-icon-180x180.png">
        
        
        <meta name="apple-mobile-web-app-title" content="MyHelperApp">
        <link rel="icon" type="image/png" href="{{ asset('blue') }}/images/icons/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="{{ asset('blue') }}/images/icons/favicon-16x16.png" sizes="16x16">
        <link rel="icon" type="image/png" href="{{ asset('blue') }}/images/icons/favicon-32x32.png" sizes="32x32">
        <meta name="msapplication-TileColor" content="#59BFCE">
        <meta name="msapplication-TileImage" content="{{ asset('blue') }}/images/icons/mstile-144x144.png">

        <meta name="application-name" content="MyHelperApp">

        <!-- Favicon --
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('white') }}/img/favicon.png">
        <link rel="icon" type="image/png" href="{{ asset('white') }}/img/favicon.png"> 
        -->
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Aleo:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300&display=swap" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css2?family=Mukta+Vaani:wght@200;300;400;600;700&display=swap" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

        <!-- Icons -->
        <link href="{{ asset('white') }}/css/nucleo-icons.css" rel="stylesheet" />


        <!-- CSS -->
        <link href="{{ asset('white') }}/css/white-dashboard.css?v=1.0.0" rel="stylesheet" />
        <link href="{{ asset('white') }}/css/theme.css" rel="stylesheet" />
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

        <!-- select2 css -->
        <!-- <link rel="stylesheet" type="text/css" href="/css/app.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"> -->

        <!-- for get/provide help page -->
        <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
        <link href="{{ asset('assets/css/gsdk-bootstrap-wizard.css')}}" rel="stylesheet" />
        <link href="{{ asset('assets/css/demo.css') }}" rel="stylesheet" />
      
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <link rel="stylesheet" href="sweetalert2/dist/sweetalert2.min.css">

        <!-- new design - /blue --> 

        <link rel="stylesheet" type="text/css" href="{{ asset('blue') }}/css/minimal.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('blue') }}/slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('blue') }}/slick/slick-theme.css"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('blue') }}/css/custom.css">
        <meta name="description" content="Welcome to MyHelperApp where you can receive or provide goods and services.">
       
       <script src="https://code.jquery.com/jquery-3.5.1.js"  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        
         
        <!-- CSS Files -->
        <script>
            var baseUrl = '{{url("/")}}';
        </script>
    </head>
    <body class="white-content {{ $class ?? '' }}">
        <div id='app'></div>
        @auth()
            <div class="wrapper">
                    @include('layouts.navbars.sidebar')
                <div class="main-panel">
                    @include('layouts.navbars.navbar')

                    <div class="content">
                        @include('admin.flash_messages')
                        @yield('content')
                    </div>

                    @include('layouts.footer')
                </div>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            @include('layouts.navbars.navbar')
            <div class="wrapper wrapper-full-page">
                <div class="full-page {{ $contentClass ?? '' }}">
                    <div class="content">
                        <div class="container">
                            @yield('content')
                        </div>
                    </div>
                    @include('layouts.footer')
                </div>
            </div>
        @endauth
       
       @if ( (\Request::is('make/req/*') ) || (\Request::is('provide/req/*') ) ){ 
        <!--   Core JS Files   -->
        <script src="{{ asset('white') }}/js/core/jquery.min.js"></script>
        <script src="{{ asset('white') }}/js/core/popper.min.js"></script>
        <script src="{{ asset('white') }}/js/core/bootstrap.min.js"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
        <script src="{{ asset('assets/js/jquery-2.2.4.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/jquery.bootstrap.wizard.js')}}" type="text/javascript"></script>

        <!--  Plugin for the Wizard -->
        <script src="{{ asset('assets/js/gsdk-bootstrap-wizard.js')}}"></script>

        <!--  More information about jquery.validate here: http://jqueryvalidation.org/  -->
        <script src="{{ asset('assets/js/jquery.validate.min.js')}}"></script>
    
      
       @else 
         

                                <!-- Jquery -->
          <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

          <script src="{{ asset('white') }}/js/core/jquery.min.js"></script>

       
            <script src="{{ asset('white') }}/js/core/popper.min.js"></script>
            <!-- <script src="{{ asset('white') }}/js/core/bootstrap.min.js"></script> -->
        <script src="{{ asset('assets/js/jquery.bootstrap.wizard.js')}}" type="text/javascript"></script>

        <!--  Plugin for the Wizard -->
        <!-- <script src="{{ asset('assets/js/gsdk-bootstrap-wizard.js')}}"></script> -->

        <!--  More information about jquery.validate here: http://jqueryvalidation.org/  -->
          
            <!-- <script src="{{ asset('white') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script> -->
            <!-- <script src="{{ asset('assets/js/jquery.validate.min.js')}}"></script> -->
        <!--  Google Maps Plugin    -->
        <!-- Place this tag in your head or just before your close body tag. -->
        <script src="{{ asset('js/custom.js') }}"></script>
       
        
        <!--  Notifications Plugin    -->
        <!-- <script src="{{ asset('white') }}/js/plugins/bootstrap-notify.js"></script> -->

        <!-- <script src="{{ asset('white') }}/js/white-dashboard.min.js?v=1.0.0"></script> -->
        <!-- <script src="{{ asset('white') }}/js/theme.js"></script> -->

        @stack('js')

        <script>
            $(document).ready(function() {
                $().ready(function() {
                    $sidebar = $('.sidebar');
                    $navbar = $('.navbar');
                    $main_panel = $('.main-panel');

                    $full_page = $('.full-page');

                    $sidebar_responsive = $('body > .navbar-collapse');
                    sidebar_mini_active = true;
                    white_color = false;

                    window_width = $(window).width();

                    fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

                    $('.fixed-plugin a').click(function(event) {
                        if ($(this).hasClass('switch-trigger')) {
                            if (event.stopPropagation) {
                                event.stopPropagation();
                            } else if (window.event) {
                                window.event.cancelBubble = true;
                            }
                        }
                    });

                    $('.fixed-plugin .background-color span').click(function() {
                        $(this).siblings().removeClass('active');
                        $(this).addClass('active');

                        var new_color = $(this).data('color');

                        if ($sidebar.length != 0) {
                            $sidebar.attr('data', new_color);
                        }

                        if ($main_panel.length != 0) {
                            $main_panel.attr('data', new_color);
                        }

                        if ($full_page.length != 0) {
                            $full_page.attr('filter-color', new_color);
                        }

                        if ($sidebar_responsive.length != 0) {
                            $sidebar_responsive.attr('data', new_color);
                        }
                    });

                    $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
                        var $btn = $(this);

                        if (sidebar_mini_active == true) {
                            $('body').removeClass('sidebar-mini');
                            sidebar_mini_active = false;
                            whiteDashboard.showSidebarMessage('Sidebar mini deactivated...');
                        } else {
                            $('body').addClass('sidebar-mini');
                            sidebar_mini_active = true;
                            whiteDashboard.showSidebarMessage('Sidebar mini activated...');
                        }

                        // we simulate the window Resize so the charts will get updated in realtime.
                        var simulateWindowResize = setInterval(function() {
                            window.dispatchEvent(new Event('resize'));
                        }, 180);

                        // we stop the simulation of Window Resize after the animations are completed
                        setTimeout(function() {
                            clearInterval(simulateWindowResize);
                        }, 1000);
                    });

                    $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
                            var $btn = $(this);

                            if (white_color == true) {
                                $('body').addClass('change-background');
                                setTimeout(function() {
                                    $('body').removeClass('change-background');
                                    $('body').removeClass('white-content');
                                }, 900);
                                white_color = false;
                            } else {
                                $('body').addClass('change-background');
                                setTimeout(function() {
                                    $('body').removeClass('change-background');
                                    $('body').addClass('white-content');
                                }, 900);

                                white_color = true;
                            }
                    });

                    $('.light-badge').click(function() {
                        $('body').addClass('white-content');
                    });

                    $('.dark-badge').click(function() {
                        $('body').removeClass('white-content');
                    });
                });
            });
        </script>
        <script>
           function searchCards() {
              // Declare variables
              var input, filter, div, carddiv, name, req, cat, city, price, time, i, result, results;
              input = document.getElementById("cardSearch");
              filter = input.value.toUpperCase();

              div = document.getElementById("card");
              carddiv = div.getElementsByClassName("card-inner"); //** Select by class

              // Loop through all list items, and hide those who don't match the search query
              for (i = 0; i < carddiv.length; i++) {
                //** Select specific parent element. innerText will return text in child h1.
                name = carddiv[i].querySelector("[id='name']").innerText;
                req = carddiv[i].querySelector("[id='req_type']").innerText;
                cat = carddiv[i].querySelector("[id='category']").innerText;
                price = carddiv[i].querySelector("[id='price']").innerText;
                city = carddiv[i].querySelector("[id='city']").innerText;
                time = carddiv[i].querySelector("[id='time']").innerText;

                
            if (name.toUpperCase().indexOf(filter) > -1) {
                carddiv[i].style.display = "block";                                
                } else {
                    if (time.toUpperCase().indexOf(filter) > -1) {
                        carddiv[i].style.display = "block";
                        carddiv[i].id = "result"; 
                    } else {
                        if (req.toUpperCase().indexOf(filter) > -1 ) {
                            carddiv[i].style.display = "block"; 
                            carddiv[i].id = "result";   
                        } else {
                            if (cat.toUpperCase().indexOf(filter) > -1) {
                                carddiv[i].style.display = "block";
                                carddiv[i].id = "result"; 
                            } else {
                                if (price.toUpperCase().indexOf(filter) > -1) {
                                    carddiv[i].style.display = "block";
                                    carddiv[i].id = "result"; 
                                } else {
                                    if (city.toUpperCase().indexOf(filter) > -1) {
                                        carddiv[i].style.display = "block";
                                        carddiv[i].id = "result"; 
                                    } else {
                                        carddiv[i].style.display = "none";                                
                                    } 
                                }
                            }
                        }
                    }

                }
                
            }
                
        };
        </script>
         
        @stack('js')
       <!--  <script type="text/javascript" src="/js/app.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                    $(document).ready(function () {
         $('#productCategory').select2();

     })
            })
        
        </script> -->
            <script src="{{ asset('white') }}/js/core/bootstrap.min.js"></script>
        
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

 $('#approveRequest').on('submit', function() 
    {
     return confirm('Do you really want to approve this request? Approving this request will also submit Pickup Request to the Logistic Delivery partner for shippment!! ');
     });

 $('#rejectRequest').on('submit', function() 
    {
     return confirm('Do you really want to reject this request? You cannot undo this action!! ');
     });

    </script>
    </body>

    @endif

</html>
