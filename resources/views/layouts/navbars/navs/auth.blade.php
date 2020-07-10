<header id="topHeader" class="header auth-header">
     <div class="logo-wrapper">
        <div class="logo-col-1">
            <a href="{{ url('/') }}" class="simple-text logo-normal">
                <img src="{{ asset('white') }}/img/lc_logo.png" alt="MyHelperApp Logo">
            </a>
        </div>
        <!--<div class="logo-col-2">
            <div class="logo-group">
                <a href="https://sterling.ng" target="_blank">
                    <img src="{{ asset('white') }}/img/sterling_logo.png" alt="Sterling Bank">
                </a>
                <a href="https://giving.ng" target="_blank">
                    <img src="{{ asset('white') }}/img/giving_logo.png" alt="Giving">
                </a>
                <a href="https://digitalwebglobal.com" target="_blank">
                    <img src="{{ asset('white') }}/img/dw_logo.png" alt="Digitalweb">
                </a>
            </div>
            <div class="sponsor-info">
                Free service provided by Sterling Bank, Giving and Digitalweb
            </div>
        </div>-->
    </div>
    <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
        <div class="container-fluid">
            <div class="navbar-wrapper">
                <div class="navbar-toggle d-inline">
                    <button type="button" class="navbar-toggler">
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                    </button>
                </div>
                <a class="navbar-brand" href="{{ route('requests') }}">{{ $page ?? __('MyHelperApp') }}</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-bar navbar-kebab"></span>
                <span class="navbar-toggler-bar navbar-kebab"></span>
                <span class="navbar-toggler-bar navbar-kebab"></span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item ">
                        <a href="{{ route('how_it_works') }}" class="nav-link">
                            <i class="fas fa-cog"></i> {{ _('How it works') }}
                        </a>
                    </li>
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <div class="photo">
                                <img src="{{ asset('white') }}/img/anime3.png" alt="{{ __('Profile Photo') }}">
                            </div>
                            <b class="caret d-none d-lg-block d-xl-block"></b>
                            <p class="d-lg-none">{{ __('Log out') }}</p>
                        </a>
                        <ul class="dropdown-menu dropdown-navbar">
                            <li class="nav-link">
                                <a href="{{ route('profile.edit') }}" class="nav-item dropdown-item">{{ __('Profile') }}</a>
                            </li>
                            <!-- <li class="nav-link">
                                <a href="#" class="nav-item dropdown-item">{{ __('Settings') }}</a>
                            </li> -->
                            <li class="dropdown-divider"></li>
                            <li class="nav-link">
                                <a href="{{ route('logout') }}" class="nav-item dropdown-item" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">{{ __('Log out') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="separator d-lg-none"></li>
                </ul>
            </div>
        </div>
    </nav>
    
</header>
