@extends('layouts.app-blue', ['pageSlug' => ''])
@section('content')

		<div class="grid-parent js-tileParent heroslide">
			<div class="grid-12 grid-lg-6 grid-spacer js-tileMain">
				<div class="tile tile-lg col_ggSecondary1Darker layout_rel" style="height: 450px;">
      
					<a href="{{ url('/') }}"><img src="{{ asset('blue') }}/images/welcome_001.jpg" class="img-cover" id="js-mainPhoto" alt="Welcome to My Helper App"></a>
					<div class="tile-content col_whiteText">
						<a href="{{ url('/') }}"><span class="link_linkify text_fontSizeZero">{{ __('Welcome to My Helper App') }}</span></a>
         
						<div class="col_ggSecondary1LighterText">
							<h2 class="text_fontSizeLarger text_title text_4n box_topMarginHalf">
								<a href="{{ url('/') }}" class="link_subtle col_whiteText zindex_linkify layout_rel">{{ __('Welcome to My Helper App') }}</a>
							</h2>
							<p>{{ __('Where you can receive or provide goods and services. ') }}</p>
						</div>
						<div class="tile-hidden">
						   <a href="{{ url('/') }}" class="grid-6 btn btn_short box_topMargin1 zindex_linkify">Learn more</a>
						</div>
         
					</div>
				</div>
			</div>
			
			<div class="grid-12 grid-lg-6 grid-parent layout_hideOverflow js-tileSecondary">
			
				<div class="grid-6 grid-spacer">
					<div class="tile col_ggSecondary1Darker layout_rel" style="height: 224px;">      
						<a href="{{ route('make.request') }}"><img src="{{ asset('blue') }}/images/welcome_002.jpg" class="img-cover" alt="Get help"></a>
						<div class="tile-content col_whiteText">
							<a href="{{ route('make.request') }}"><span class="link_linkify text_fontSizeZero">Get Help</span></a>
							<div class="col_ggSecondary1LighterText text_lineHeightNatural">
								<h4 class="text_fontSizeBase text_lineHeightMedium box_topMargin1">
									<a href="{{ route('make.request') }}" class="link_subtle col_whiteText zindex_linkify layout_rel">Get Help</a>
								</h4>
								<p>{{ __('Create your request.') }}</p>
							</div>
							<div class="tile-hidden">
								
								<a href="{{ route('make.request') }}" class="grid-6 btn btn_short box_topMargin2 zindex_linkify">Create</a>
							</div>
							 
						</div>
					</div>
				</div>
				
				<div class="grid-6 grid-spacer">
					<div class="tile col_ggSecondary1Darker layout_rel" style="height: 224px;">      
						<a href="{{ route('provide.request') }}"><img src="{{ asset('blue') }}/images/welcome_003.jpg" class="img-cover" alt="Provide help"></a>
						<div class="tile-content col_whiteText">
							<a href="{{ route('provide.request') }}"><span class="link_linkify text_fontSizeZero">Provide Help</span></a>
							<div class="col_ggSecondary1LighterText text_lineHeightNatural">
								<h4 class="text_fontSizeBase text_lineHeightMedium box_topMargin1">
									<a href="{{ route('provide.request') }}" class="link_subtle col_whiteText zindex_linkify layout_rel">Provide Help</a>
								</h4>
								<p>{{ __('Select any request to provide help.') }}</p>
							</div>
							<div class="tile-hidden">
								
								<a href="{{ route('provide.request') }}" class="grid-6 btn btn_short box_topMargin2 zindex_linkify">Select</a>
							</div>
							 
						</div>
					</div>
				</div>
				
				<div class="grid-6 grid-spacer">
					<div class="tile col_ggSecondary1Darker layout_rel" style="height: 224px;">      
						<a href="{{ route('how_it_works') }}"><img src="{{ asset('blue') }}/images/welcome_004.jpg" class="img-cover" alt="How it works"></a>
						<div class="tile-content col_whiteText">
							<a href="{{ route('how_it_works') }}"><span class="link_linkify text_fontSizeZero">How It Works</span></a>
							<div class="col_ggSecondary1LighterText text_lineHeightNatural">
								<h4 class="text_fontSizeBase text_lineHeightMedium box_topMargin1">
									<a href="{{ route('how_it_works') }}" class="link_subtle col_whiteText zindex_linkify layout_rel">{{ __('How It Works') }}</a>
								</h4>
								<p>{{ __('Learn how you can be helped or how you can help others.') }}</p>
							</div>
							<div class="tile-hidden">
								
								<a href="{{ route('how_it_works') }}" class="grid-6 btn btn_short box_topMargin2 zindex_linkify">Learn more</a>
							</div>
							 
						</div>
					</div>
				</div>
				
				<div class="grid-6 grid-spacer">
					<div class="tile col_ggSecondary1Darker layout_rel" style="height: 224px;">      
						<a href="#"><img src="{{ asset('blue') }}/images/welcome_005.jpg" class="img-cover" alt="Contact us"></a>
						<div class="tile-content col_whiteText">
							<a href="#"><span class="link_linkify text_fontSizeZero">Contact us</span></a>
							<div class="col_ggSecondary1LighterText text_lineHeightNatural">
								<h4 class="text_fontSizeBase text_lineHeightMedium box_topMargin1">
									<a href="#" class="link_subtle col_whiteText zindex_linkify layout_rel">Contact us</a>
								</h4>
								<p>Get in touch with us.</p>
							</div>
							<div class="tile-hidden">
								
								<a href="#" class="grid-6 btn btn_short box_topMargin2 zindex_linkify">Contact</a>
							</div>
							 
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
		   function setTileHeights(){for(var e=window.innerWidth||document.documentElement.clientWidth||document.getElementsByTagName("body")[0].clientWidth,t=e<1024?1:2,i=document.getElementsByClassName("tile"),n=1;n<5;n++)i[n].style.height=Math.round(e/t/3-4)+"px";document.getElementsByClassName("tile-lg")[0].style.height=2*Math.round(e/t/3)-6+"px"}setTileHeights(),window.addEventListener?window.addEventListener("resize",setTileHeights,!1):window.attachEvent?window.attachEvent("onresize",setTileHeights):window.onresize=setTileHeights;
		</script>
		
		<div class="grid-parent col_ggPrimary5VeryLight box_horizontalPadded2 layout_center layout_centerVertical col_ggPrimary5Text page-cta">
			<span class="grid-12 grid-lg-6 text_fontSizeSmall_2 box_verticalPadded2 text_allCaps layout_alignLeft">Requests</span>
			<a href="{{route('all_requests')}}" class="grid-12 grid-lg-6 text_fontSizeSmall col_ggPrimary5Text box_verticalPadded2 text_allCaps layout_alignRight">Explore ›</a>
		</div>
		
		<section class="requests-slides">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-3">
						<div class="grid-box">
							<div class="slide-group">
								<div class="title-box">
									<img src="{{ asset('blue') }}/images/help_requests.jpg" alt="Help Requests" />
									<div class="details">
										<h4>{{ __('Help Requests') }}</h4>
										<p>{{ __('Create help requests to get help on the platform') }}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-1">
					
					</div>
					<div class="col-md-8">
						<div class="grid-box">
							<div class="requests-cards-slide">
							
								<div class="request-slide">
									@php
										$i = 1;
									@endphp
									@foreach( $allRequests->take(12) as $req )
									@if($req->request_type == 1) 
																				
									<div id="id_{{ $i }}" class="item card-container">
										<span class="pro">{{ __('Request') }}</span>
										<img class="round" src="{{ asset('blue') }}/images/user.jpg" alt="user" />
										<h3>{{ $req->user->username }}</h3>
										@if ( $req->api_city !== "" )
										<h6>{{ $req->api_city }}, {{ $req->api_state }}</h6>
										@endif
										<p>{{ Str::limit($req->description, 30) }}</p>
										<div class="buttons">
											<a class="primary" href="{{ route('view.make.request', [$req->id]) }}">View Request</a>											
										</div>
										<div class="skills">
											<ul>
												<li>{{ $req->category ? $req->category->title : '' }}</li>
												@php
													$today = \Carbon\Carbon::today();
													$time = \Carbon\Carbon::now();
													$ageInSeconds = \Carbon\Carbon::parse($req->created_at)->diffInSeconds($time);
													$ageInMins = \Carbon\Carbon::parse($req->created_at)->diffInMinutes($time);
													$ageInHrs = \Carbon\Carbon::parse($req->created_at)->diffInHours($time);
													$age = \Carbon\Carbon::parse($req->created_at)->diffInDays($time);
												@endphp
	                                            @if($ageInMins < 60)
												<li>{{ $ageInMins }}{{ $ageInMins < 2 ? ' minute ' : ' minutes '}} ago</li>
												@elseif(($ageInHrs >= 1 ) && ( $ageInHrs <= 24 ))
												<li>{{ $ageInHrs }}{{ $ageInHrs < 2 ? ' hour ' : ' hours '}} ago</li>
												@else
												<li>{{ $age }}{{ $age < 2 ? ' day ' : ' days '}} ago</li>
												@endif
	                                                											
											</ul>
										</div>
									</div>
									@endif
									
									@php
									$i++;
									@endphp
									@endforeach		
								</div>													
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<section class="provide-slides grey-bg">
			<div class="container-fluid">
				<div class="row">

					<div class="col-md-3">
						<div class="grid-box">
							<div class="slide-group">
								<div class="title-box">
									<img src="{{ asset('blue') }}/images/help_requests.jpg" alt="Help Requests" />
									<div class="details">
										<h4>{{ __('Provide Requests') }}</h4>
										<p>{{ __('Create provide requests to help people on the platform') }}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-1">
					
					</div>
					<div class="col-md-8">
						<div class="grid-box">
							<div class="requests-cards-slide">
							
								<div class="request-slide">
									@php
										$i = 1;
									@endphp
									@foreach( $allRequests->take(12) as $req )
									@if($req->request_type == 2) 
																				
									<div id="id_{{ $i }}" class="item card-container">
										<span class="pro">{{ __('Supply') }}</span>
										<img class="round" src="{{ asset('blue') }}/images/user.jpg" alt="user" />
										<h3>{{ $req->user->username }}</h3>
										@if ( $req->api_city !== "" )
										<h6>{{ $req->api_city }}, {{ $req->api_state }}</h6>
										@endif
										<p>{{ Str::limit($req->description, 30) }}</p>
										<div class="buttons">
											<a class="primary" href="{{ route('view.request', [$req->id]) }}">View Request</a>											
										</div>
										<div class="skills">
											<ul>
												<li>{{ $req->category ? $req->category->title : '' }}</li>
												@php
													$today = \Carbon\Carbon::today();
													$time = \Carbon\Carbon::now();
													$ageInSeconds = \Carbon\Carbon::parse($req->created_at)->diffInSeconds($time);
													$ageInMins = \Carbon\Carbon::parse($req->created_at)->diffInMinutes($time);
													$ageInHrs = \Carbon\Carbon::parse($req->created_at)->diffInHours($time);
													$age = \Carbon\Carbon::parse($req->created_at)->diffInDays($time);
												@endphp
	                                            @if($ageInMins < 60)
													<li>{{ $ageInMins }}{{ $ageInMins < 2 ? ' minute ' : ' minutes '}} ago</li>
												@elseif(($ageInHrs >= 1 ) && ( $ageInHrs <= 24 ))
													<li>{{ $ageInHrs }}{{ $ageInHrs < 2 ? ' hour ' : ' hours '}} ago</li>
												@else
													<li>{{ $age }}{{ $age < 2 ? ' day ' : ' days '}} ago</li>
												@endif
	                                                											
											</ul>
										</div>
									</div>
									@endif
									
									@php
									$i++;
									@endphp
									@endforeach		
								</div>							
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<section class="layout_center col_ggPrimary1 col_whiteText triangle-parent ">
			<div class=" box_verticalPadded4 layout_center">
				<div class="layout_centerVertical">
					<div class="grid-parent grid-padder">
					   
						<div class="grid-12 box_verticalPadded1">
							<!--<span class="text_fontSizeLarger text_md_fontSizeJumbo text_title text_7n text_lineHeightLoose">3564</span><br>-->
							<div class="text_fontSizeLarge"><span>{{ __('This platform will help create an avenue for minimal wealth distribution among the rich and the poor.') }}</span><br /> 
								- <br />{{ __('Abubakar Suleiman') }}
								<br /> {{ __('MD Sterling Bank') }}
							</div>
						</div>
	  
					</div>
				<div class="triangle triangle_bottom grid-0 grid-lg-12"></div>
				</div>
			</div>
		</section>
		
		<div class="grid-0 grid-md-12 grid-parent col_ggPrimary2Dark layout_rel layout_center">
			<div class="grid-12 box_topPadded3 layout_abs zindex_overlayTop col_whiteText">
				<h3 class="col_whiteText ruleBottom ruleBottom_ggPrimary1">{{ __('How It Works') }}</h3>
			</div>
			<div class="grid-12 grid-md-12 grid-lg-4 img-overlay layout_rel text_fontSizeSmaller text_md_fontSizeBase hiw">
				<div class="grid-9 layout_centerBoth box_topPadded6 zindex_overlayTop">
				   
				   <div class="col_whiteText">
						<span class="col_ggPrimary1Text text_allCaps"><a href="#" class="col_inherit">{{ __('Getting Help') }}</a></span>
					  <br><br>
						{{ __('Go to Get Help') }}<br />
						{{ __('Fill the Request form') }}<br />
						{{ __('Your request for help will be made public after filling') }}<br />
						{{ __('You will be contacted via mail by the platform with the responses from the public. Please do ensure to check your spam.') }}
					  <br><br>
				   </div>
				   
				</div>
				<img src="{{ asset('blue') }}/images/hiw_get_help.jpg" class="img-cover" alt="getting help.">
			</div>
			<div class="grid-12 grid-md-12 grid-lg-4 img-overlay layout_rel text_fontSizeSmaller text_md_fontSizeBase hiw">
				<div class="grid-9 layout_centerBoth box_topPadded6 zindex_overlayTop">
				   
				   <div class="col_whiteText">
						<span class="col_ggPrimary1Text text_allCaps"><a href="#" class="col_inherit">{{ __('Providing Help') }}</a></span>
					  <br><br>
						{{ __('Go to Provide Help') }}<br />
						{{ __('Fill the Request form') }}<br />
						{{ __('Your request for help will be made public after filling') }}<br />
						{{ __('You will be contacted via mail by the platform with the responses from the public. Please do ensure to check your spam.') }}
					  <br><br>
				   </div>
				  
				</div>
				<img data-src="/images/hiw_provide_help.jpg" class="img-cover lazyloaded" alt="providing help" src="{{ asset('blue') }}/images/hiw_provide_help.jpg">
			</div>
			<div class="grid-12 grid-md-12 grid-lg-4 img-overlay layout_rel text_fontSizeSmaller text_md_fontSizeBase hiw">
				<div class="grid-9 layout_centerBoth box_topPadded6 zindex_overlayTop">
				   
				   <div class="col_whiteText">
						<span class="col_ggPrimary1Text text_allCaps"><a href="#" class="col_inherit">{{ __('Contact Us') }}</a></span>
					  <br><br>
						{{ __('For more enquiries contact:') }}<br />
						{{ __('+234 703 410 4040 (Whatsapp Chat and SMS Only) ') }}<br />
						{{ __('help@myhelperapp.com') }}
					  <br><br>
				   </div>
				   
				</div>
				<img data-src="/img/hiw_contact_us.jpg" class="img-cover ls-is-cached lazyloaded" alt="Contact us" src="{{ asset('blue') }}/images/hiw_contact_us.jpg">
			</div>
			 
		</div>
		
		<section class="layout_center  ">
			<div class="grid-lg-padder box_horizontalPadded3 box_verticalPadded5 layout_center">
				<div class="layout_centerVertical">
					<h3 class="ruleBottom ruleBottom_ggPrimary1 box_bottomMargin2">{{ __('Our Corporate Partners') }}</h3>
					<div class="img-bg box_verticalPadded2">
					   {{ __('This service is provided by Sterling Bank, Giving and 100StartApps') }}
					</div>
					<div class="grid-parent layout_centerVertical partners">
						<div class="grid-4 grid-md-4 box_padded2">
						   <img class="grid-12 lazyloaded" data-src="/images/sterling_logo.png" alt="Sterling Bank" src="{{ asset('blue') }}/images/sterling_logo.png">
						</div>
						<div class="grid-4 grid-md-4 box_padded2">
						   <img class="grid-12 lazyloaded" data-src="/images/giving_logo.png" alt="Giving" src="{{ asset('blue') }}/images/giving_logo.png">
						</div>
						<div class="grid-4 grid-md-4 box_padded2">
						   <img class="grid-12 lazyloaded" data-src="/images/100startapps_logo.png" alt="100StartApps" src="{{ asset('blue') }}/images/100startapps_logo.png">
						</div>

					</div>

				</div>
			</div>
		</section>  
		
@endsection
