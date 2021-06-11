@extends('layouts.app-blue', ['pageSlug' => 'all-requests'])
@section('content')
	<div class="page-wrap">
		<section class="all-requests-wrap">
			<div class="container-fluid">
				<div class="row">
					<?php
					use App\LockdownRequest;
					 $allRequests = LockdownRequest::orderBy('created_at', 'DESC')->get();
					 ?>

					<div class="col-md-12">
						<div class="page-header">
							<h2>All Requests</h2>
						</div>
						<div class="row grid-box all-requests">
							
							
						@if($allRequests)
						
						   @php
								$i = 1;
							@endphp
							@foreach( $allRequests as $req )
							
																		
							<div id="item id_{{ $i }}" class="col-md-3 item">
								<div class="card-container">
									@if($req->request_type == 1) 
									<span class="pro">{{ __('Request') }}</span>
									@else
									<span class="pro">{{ __('Supply') }}</span>
									@endif

									<img class="round" src="{{ asset('blue') }}/images/user.jpg" alt="user" />
									
									<h3>{{ $req->user->username }}</h3>

									@if ( $req->api_city !== "" )
									<h6>{{ $req->api_city }}, {{ $req->api_state }}</h6>
									@endif
									<p>{{ Str::limit($req->description, 30) }}</p>


									@if($req->request_type == 1) 
									<div class="buttons">
										<a class="primary" href="{{ route('view.make.request', [$req->id]) }}">View Request</a>									
									</div>
									@else
									<div class="buttons">
										<a class="primary" href="{{ route('view.request', [$req->id]) }}">View Supply</a>											
									</div>
									@endif

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
							</div>
							
							@php
							$i++;
							@endphp
							@endforeach	
						@else
						<small>No request found</small>
						@endif
							
						</div>
						<div class="text-center pt-40 pb-40 bs-padded">
							<a href="#" id="loadMore" class="btn btn-primary">Load More</a>
						</div>
						<script>
								$(function () {
								    $(".card-container").slice(0, 8).show();
								    $("#loadMore").on('click', function (e) {
								        e.preventDefault();
								        $(".card-container:hidden").slice(0, 8).slideDown();
								        if ($(".card-container:hidden").length == 0) {
								            $("#load").fadeOut('slow');
								        }
								        $('html,body').animate({
								            scrollTop: $(this).offset().top
								        }, 1500);
								    });
								});

								$('a[href=#top]').click(function () {
								    $('body,html').animate({
								        scrollTop: 0
								    }, 600);
								    return false;
								});

								
							</script>
					</div>
				</div>
			</div>
		</section>
		</div>
		
@endsection
