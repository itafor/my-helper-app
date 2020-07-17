<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>MyHelperApp</title>
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('white') }}/img/favicon.png">
        <link rel="icon" type="image/png" href="{{ asset('white') }}/img/favicon.png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Mukta+Vaani:wght@200;300;400;600;700&display=swap" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <!-- Icons -->
        <link href="{{ asset('white') }}/css/nucleo-icons.css" rel="stylesheet" />
        <!-- CSS -->
        <link href="{{ asset('white') }}/css/white-dashboard.css?v=1.0.0" rel="stylesheet" />
        <link href="{{ asset('white') }}/css/theme.css" rel="stylesheet" />
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">


      
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

          <!-- select2 css -->
        <link rel="stylesheet" type="text/css" href="/css/app.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
        <!-- CSS Files -->
        <script>
            var baseUrl = '{{url("/")}}';
        </script>
    </head>
    <body class="white-content {{ $class ?? '' }}">
        @auth()
            <div class="wrapper">
                    @include('layouts.navbars.sidebar')
                <div class="main-panel">
                    @include('layouts.navbars.navbar')

                    <div class="content">
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
       
         

                                <!-- Jquery -->
          <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

          <script src="{{ asset('white') }}/js/core/jquery.min.js"></script>

       
            <!-- <script src="{{ asset('white') }}/js/core/popper.min.js"></script> -->
            <!-- <script src="{{ asset('white') }}/js/core/bootstrap.min.js"></script> -->
        <!-- <script src="{{ asset('assets/js/jquery.bootstrap.wizard.js')}}" type="text/javascript"></script> -->

        <!--  Plugin for the Wizard -->
        <!-- <script src="{{ asset('assets/js/gsdk-bootstrap-wizard.js')}}"></script> -->

        <!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
          
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
        <script type="text/javascript" src="/js/app.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
         $('.productCategory').select2();
     })
        </script>
          <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>


    </body>
</html>
