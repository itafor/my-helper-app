	<header class="main-header">
		<div class="container-fluid">
			<div class="grid-parent layout_centerVertical">
				<div class="grid-12 grid-parent layout_centerVertical layout_rel mob-border-bottom pb-10">
					<div class="grid-4 grid-md-4 grid-xl-3 grid-parent layout_centerVertical">
						<a href="{{ url('/') }}" class="logo logo-link">
							<img src="{{ asset('blue') }}/images/logo.png" alt="MyHelperApp homepage">
						</a>
					</div>
					
					<div class="grid-8 grid-md-8 grid-xl-9 text_fontSizeSmall ">
						<nav class="grid-12 grid-parent layout_centerVertical layout_alignRight">
						   <div class="grid-12 menu-wrap">
								<a href="{{ route('new.make.request') }}" class="hidden-xl-m col_ggPrimary5Text link_subtle box_leftPadded2 text_4n">{{ _('Get Help') }}</a>
								<a href="{{ route('new.provide.request') }}" class="hidden-xl-m col_ggPrimary5Text link_subtle box_leftPadded2 text_4n">{{ _('Provide Help') }}</a>
								<a href="{{ route('how_it_works') }}" class="hidden-xl-m col_ggPrimary5Text link_subtle box_leftPadded2 text_4n">{{ _('How It Works') }}</a>
								<!--<span class="hidden-xl-m layout_centerVertical" id="js-headerCta1">
									<a href="#" class="btn btn_simple btn_transparent btn_ggPrimary3" id="js-headerCtaBtn1">Register</a>
								</span>-->
								<div class="dropdown nav-item">
									<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
										<div class="photo">
											<img src="{{ asset('blue') }}/images/user.jpg" alt="{{ __('Profile Photo') }}">
										</div>
										@php
										$logged_in = Auth::user();
										@endphp
										<p>{{ $logged_in->name }}</p>
									</a>
									<ul class="dropdown-menu dropdown-navbar">
										<li class="nav-link">
											<a href="{{ route('profile.edit') }}" class="nav-item dropdown-item">{{ __('My Profile') }}</a>
										</li>
										
										<li class="dropdown-divider"></li>
										<li class="nav-link">
											<a href="{{ route('logout') }}" class="nav-item dropdown-item" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">{{ __('Sign Out') }}</a>
										</li>
									</ul>
								</div>
								<div class="hidden-xl-m layout_centerVertical search-wrap">
									<form name="search" method="GET">
										<input name="s" type="text" id="search" placeholder="Search requests" />
									</form>
								</div>						  
						   </div>
						</nav>
					</div>		
				</div>
				<nav class="grid-10 grid-xl-0 layout_centerVertical box_verticalPadded2  text_fontSizeSmall mobile-nav">
					<a href="{{ route('new.make.request') }}" class="grid-sm-inline col_ggPrimary5Text link_subtle text_4n box_rightPadded3">{{ _('Get Help') }}</a>
					<a href="{{ route('new.provide.request') }}" class="grid-sm-inline col_ggPrimary5Text link_subtle text_4n box_rightPadded3">{{ _('Provide Help') }}</a>		
					<a href="{{ route('how_it_works') }}" class="grid-sm-inline col_ggPrimary5Text link_subtle text_4n box_rightPadded3">{{ _('How It Works') }}</a>
					<a href="{{ route('logout') }}" class="grid-sm-inline col_ggPrimary5Text link_subtle text_4n box_rightPadded3 hidden-mobile"  onclick="event.preventDefault();  document.getElementById('logout-form').submit();">Sign Out</a>
				</nav>
				<div class="menu-trigger-wrap">
					<a href="javascript:void(0);" class="icon" onclick="menuTrigger()">
					   <span></span>
					   <span></span>
					   <span></span>
					   <span></span>
					</a> 
				</div>     
			</div>
		</div>
	</header>


