<header id="topHeader" class="header guest-header">
    <div class="logo-wrapper">
       <div class="logo-col-1">
            <a href="{{ url('/') }}" class="simple-text logo-normal">
                <img src="{{ asset('white') }}/img/lc_logo.png" alt="MyHelperApp Logo">
            </a>
        </div>
        <!--
        <div class="logo-col-2">
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
        </div>
    -->
    </div>
    <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent fixed-top">
        <div class="container-fluid">
            <div class="navbar-wrapper">
                <div class="navbar-toggle d-inline">
                    <button type="button" class="navbar-toggler">
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                    </button>
                </div>
                <a class="navbar-brand" href="#">{{ $page ?? '' }}</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar navbar-kebab"></span>
                <span class="navbar-toggler-bar navbar-kebab"></span>
                <span class="navbar-toggler-bar navbar-kebab"></span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
                <ul class="navbar-nav ml-auto">
                    <!-- <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link text-primary">
                            <i class="tim-icons icon-minimal-left"></i> {{ _('Back to Dashboard') }}
                        </a>
                    </li> -->
                    <li class="nav-item ">
                        <a href="{{ route('how_it_works') }}" class="nav-link">
                            <i class="fas fa-cog"></i> {{ _('How it works') }}
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{ url('reg_type') }}" class="nav-link">
                            <i class="tim-icons icon-laptop"></i> {{ _('Register') }}
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{ route('login') }}" class="nav-link">
                            <i class="tim-icons icon-single-02"></i> {{ _('Login') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
