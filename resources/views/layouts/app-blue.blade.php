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

       
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Aleo:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300&display=swap" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">        
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

        <!--<link rel="stylesheet" href="sweetalert2/dist/sweetalert2.min.css">-->

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
    <body class="text_sansLoaded text_titleLoaded home {{ $class ?? '' }}"> 
        <div id='app'></div>
        @auth()
            <div class="main">
                    @include('layouts.navbars.sidebar')
                <div class="main-panel">
                    @include('layouts.navbars.navbar-blue')

                    <div class="content">
                        @include('admin.flash_messages')
                        @yield('content')
                    </div>

                    @include('layouts.footer-blue')
                </div>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            @include('layouts.navbars.navbar-blue')
            <div class="main wrapper-full-page">
                @yield('content')
                        
                @include('layouts.footer-blue')
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
        
		<script src="{{ asset('white') }}/js/core/popper.min.js"></script>
		<script src="{{ asset('white') }}/js/core/bootstrap.min.js"></script>
        
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

		<!-- sweetalert script -->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
		<!--<script src="sweetalert2/dist/sweetalert2.all.min.js"></script>-->
		<script src="{{ asset('blue') }}/js/s.js"></script>
        <script type="text/javascript" src="{{ asset('blue') }}/slick/slick.min.js"></script>
		
        @stack('js')

        <script type="text/javascript">
            $('.request-slide').slick({
			  dots: true,
			  infinite: true,
			  speed: 300,
			  autoPlay: true,
			  autoplaySpeed: 5000,
			  arrows: true,
			  slidesToShow: 3,
			  slidesToScroll: 1,
			  responsive: [
				{
				  breakpoint: 1024,
				  settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					infinite: true,
					dots: true
				  }
				},
				{
				  breakpoint: 600,
				  settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				  }
				}
				
			  ]
			});
			$('.provide-slide').slick({
			  dots: true,
			  infinite: true,
			  speed: 300,
			  autoPlay: true,
			  autoplaySpeed: 5000,
			  arrows: true,
			  slidesToShow: 3,
			  slidesToScroll: 1,
			  responsive: [
				{
				  breakpoint: 1024,
				  settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					infinite: true,
					dots: true
				  }
				},
				{
				  breakpoint: 600,
				  settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				  }
				}
				
			  ]
			});
        </script>
         
        @stack('js')
		
		<div style="position: static !important;"></div>
		
		</div>
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
