	<header class="main-header">
		<div class="container-fluid">
			<div class="grid-parent layout_centerVertical">
				<div class="grid-12 grid-parent layout_centerVertical layout_rel">
					<div class="grid-8 grid-md-4 grid-xl-3 grid-parent layout_centerVertical">
						<a href="{{ url('/') }}" class="logo logo-link">
							<img src="{{ asset('blue') }}/images/logo.png" alt="MyHelperApp homepage">
						</a>
					</div>
					
					<div class="grid-4 grid-md-8 grid-xl-9 text_fontSizeSmall ">
						<nav class="grid-12 grid-parent layout_centerVertical layout_alignRight">
						   <div class="grid-12 menu-wrap">
								<a href="{{ route('make.request') }}" class="hidden-xl-m col_ggPrimary5Text link_subtle box_leftPadded2 text_4n">{{ _('Get Help') }}</a>
								<a href="{{ route('provide.request') }}" class="hidden-xl-m col_ggPrimary5Text link_subtle box_leftPadded2 text_4n">{{ _('Provide Help') }}</a>
								<a href="{{ route('how_it_works') }}" class="hidden-xl-m col_ggPrimary5Text link_subtle box_leftPadded2 text_4n">{{ _('How It Works') }}</a>
								<a href="{{ url('reg_type') }}" class="hidden-xl-m col_ggPrimary5Text link_subtle box_leftPadded2 text_4n">{{ _('Register') }}</a>
								
								<span class="layout_centerVertical" id="js-headerCta1">
									<a href="{{ route('login') }}" class="btn btn_simple btn_transparent btn_ggPrimary2" id="js-headerCtaBtn2">Sign In</a>
								</span>
								<div class="hidden-xl-m layout_centerVertical search-wrap">
									<form name="search" method="GET">
										<input name="s" type="text" id="search" placeholder="Search requests" />
									</form>
								</div>						  
						   </div>
						</nav>
					</div>		
				</div>
				<nav class="grid-12 grid-xl-0 layout_centerVertical border_default border_left0 border_right0 border_bottom0 box_verticalPadded2  text_fontSizeSmall layout_center mobile-nav">
					<a href="{{ route('make.request') }}" class="grid-sm-inline col_ggPrimary5Text link_subtle text_4n box_rightPadded3">{{ _('Get Help') }}</a>
					<a href="{{ route('provide.request') }}" class="grid-sm-inline col_ggPrimary5Text link_subtle text_4n box_rightPadded3">{{ _('Provide Help') }}</a>		
					<a href="{{ route('how_it_works') }}" class="grid-sm-inline col_ggPrimary5Text link_subtle text_4n box_rightPadded3">{{ _('How It Works') }}</a>
					<a href="{{ url('reg_type') }}" class="grid-sm-inline col_ggPrimary5Text link_subtle text_4n box_rightPadded3">{{ _('Register') }}</a>
				</nav>      
			</div>
		</div>
	</header>


