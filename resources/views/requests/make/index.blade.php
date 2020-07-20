@extends('layouts.app', ['pageSlug' => 'Requests'])

@section('content')
    <div class="header py-7 py-lg-8">
        <div class="container-fluid">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-md-12 content-wrapper">
                        <div class="content-header">
                        <h3 class="text-blue text-center h2-heading">{{ __('Welcome to MyHelperApp where you can receive or provide goods and services for free or at a fee.') }} <span> {{__('We’re here to help you get through the day stress free. ')}}</span></h3>

                            <div class="btn-group req-btn">
                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Get or Provide Help Here
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('new.make.request') }}">Get Help</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('new.provide.request') }}">Provide Help</a>
                                </div>
                            </div>
                        <!-- <p class="text-lead text-light">
                            {{ __('What do u need right now for your lockdown?') }}
                        </p> -->
                        </div>
                        <div class="col-md-12 welcome-cards">
                            <div id="card" class="card ">
                                <div class="card-header">
                                    <h4 class="card-title">Requests</h4>
                                </div>
                                <div class="card-body">
                                @include('alerts.success')
                                    <div class="requests hidden-pc" id="all-requests">
                                         <!--Search CODE -->
                                         <div class="search-filter">
                                            <span class="bmd-form-group">
                                                <div class="input-group">
                                                    <input id="cardSearch" class="form-control" placeholder="Search name, category, request type, time, price or location etc." maxlength="100"  onkeyup="searchCards()" type="text">    
                                                </div>
                                            </span>
                                            <p id="summary"></p>
                                        </div>
                                        <!--Search CODE -->
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach( $allRequests as $req )

                                        <div class='card-inner'>                                            
                                            <div class="card-detail" id="request_{{ $req->id }}">
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        @php
                                                            $bgcolors = array('#dbdbea', '#FFBFBF', '#dfbfbf', '#99ff99', '#bfbfff', '#bfffbf', '#ffbfff', '#ffdfbf', '#ffdc73', '#efbfff', '#bfcfff', '#cfbfff', '#bfcfdf', '#ffcfbf', '#dfdfdf', '#efefef', '#bfcfcf', '#cfcfcf', '#fcfcfc', '#efcfef', '#efefcf', '#fdfcff', '#bfcfbf', '#dfffbf', '#cfffbf', '#deeebe', '#ceeebe', '#beeebe', '#cfbfff',);
                                                            $randBg = array_rand($bgcolors);
                                                        @endphp
                                                        <div class="avatar" id="avatar" style="background:{{ $bgcolors[$randBg] }};">
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-md-11 text-left">
                                                        <div class="request-content">
                                                            <div class="request-meta">

                                                                <p id="req_type" class="type"><i class="tim-icons icon-basket-simple" aria-hidden="true"></i>{{ $req->request_type == 1 ? 'Request' : 'Supply' }}</p>

                                                                <p id="category" class="type"><i class="tim-icons icon-tag" aria-hidden="true"></i>{{  $req->category ? $req->category->title : '' }}</p>

                                                                @if( ( $req->type == 'Paid' ) || ( $req->type == 'paid' ) )
                                                                <p id="price" class="type type_c_paid"><i class="tim-icons icon-money-coins" aria-hidden="true"></i>{{ $req->type }}</p>
                                                                @else
                                                                <p id="price" class="type type_c_free"><i class="tim-icons icon-notes" aria-hidden="true"></i>{{ $req->type }}</p>
                                                                @endif

                                                            </div>
                                                            <div class="request-comment">
                                                                @if( $req->request_type == 1 )
                                                                <p id="name" class="text">{{ $req->user->name }}'s Comments:  <span class="request">{{ Str::limit($req->description, 90) }}</span></p>

                                                                @else
                                                                <p id="name" class="text">{{ $req->user->name }}'s Comments:  <span class="supply">{{ Str::limit($req->description, 90) }}</span></p>

                                                                @endif
                                                            </div>
                                                            <div class="request-meta bottom-meta">
                                                                <div class="pull-left">
                                                                    <p id="city"><i class="tim-icons icon-map-big" aria-hidden="true"></i>
                                                                        {{ $req->city->name }} {{ $req->state->name }}, {{ $req->country->country_name }}
                                                                    </p>
                                                                </div>
                                                                <div class="time pull-right">
                                                                   
                                                                    @php
                                                                        $today = \Carbon\Carbon::today();
                                                                        $time = \Carbon\Carbon::now();
                                                                        $ageInSeconds = \Carbon\Carbon::parse($req->created_at)->diffInSeconds($time);
                                                                        $ageInMins = \Carbon\Carbon::parse($req->created_at)->diffInMinutes($time);
                                                                        $ageInHrs = \Carbon\Carbon::parse($req->created_at)->diffInHours($time);
                                                                        $age = \Carbon\Carbon::parse($req->created_at)->diffInDays($time);
                                                                    @endphp
                                                       
                                                                    @if($ageInMins < 60)
                                                                        <div id="time" class="text-left time_c"><i class="tim-icons icon-time-alarm" aria-hidden="true"></i>{{ $ageInMins }}{{ $ageInMins < 2 ? ' minute ' : ' minutes '}} ago</div>

                                                                    @elseif(($ageInHrs >= 1 ) && ( $ageInHrs <= 24 ))
                                                                        <div id="time" class="text-left time_c"><i class="tim-icons icon-time-alarm" aria-hidden="true"></i>{{ $ageInHrs }}{{ $ageInHrs < 2 ? ' hour ' : ' hours '}} ago</div>

                                                                    @else
                                                                        <div id="time" class="text-left time_c"><i class="tim-icons icon-time-alarm" aria-hidden="true"></i>{{ $age }}{{ $age < 2 ? ' day ' : ' days '}} ago</div>
                                                                    @endif

                                                                    
                                                                </div>
                                                            </div>
                                                                <button class="clickable-row btn btn-custom btn-request" 
                                                                    @if($req->request_type == 1)
                                                                        data-href="{{ route('view.make.request', [$req->id]) }}">View Request</button>
                                                                    @else
                                                                        data-href="{{ route('view.request', [$req->id]) }}">View Supply</button>
                                                                    @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                         @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                    </div>


                                    <div class="table-responsive hidden-mobile">
                                        <table class="table tablesorter " id="requests">
                                            <thead class=" text-primary">
                                                <tr>
                                                    <th class="text-left id hidden_all">SN</th>
                                                    <th class="text-left time">Time</th>
                                                    <th class="text-left req_type">Request Type</th>
                                                    <th class="text-left category">Category</th>
                                                    <th class="text-left name">Display Name</th>
                                                    <th class="text-left details">Details</th>
                                                    <th class="text-left type">Type</th>
                                                    <th class="text-left city">City</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach( $allRequests as $req )
                                                
                                                    <tr class='clickable-row' 
                                                        @if($req->request_type == 1)
                                                            data-href="{{ route('auth_view.make.request', [$req->id]) }}">
                                                        @else
                                                            data-href="{{ route('auth_view.provide.request', [$req->id]) }}">
                                                        @endif
                                                    <td class='text-left id_c hidden_all'>{{ $i }}</td>
                                                        @php
                                                            $today = \Carbon\Carbon::today();
                                                            $time = \Carbon\Carbon::now();
                                                            $ageInSeconds = \Carbon\Carbon::parse($req->created_at)->diffInSeconds($time);
                                                            $ageInMins = \Carbon\Carbon::parse($req->created_at)->diffInMinutes($time);
                                                            $ageInHrs = \Carbon\Carbon::parse($req->created_at)->diffInHours($time);
                                                            $age = \Carbon\Carbon::parse($req->created_at)->diffInDays($time);
                                                            @endphp
                                                       
                                                        @if($ageInMins < 60)
                                                            <td class="text-left time_c">{{ $ageInMins }}{{ $ageInMins < 2 ? ' minute ' : ' minutes '}} ago</td>

                                                        @elseif(($ageInHrs >= 1 ) && ( $ageInHrs <= 24 ))
                                                            <td class="text-left time_c">{{ $ageInHrs }}{{ $ageInHrs < 2 ? ' hour ' : ' hours '}} ago</td>

                                                        @else
                                                            <td class="text-left time_c">{{ $age }}{{ $age < 2 ? ' day ' : ' days '}} ago</td>
                                                        @endif

                                                        <td class="text-left req_type_c">{{ $req->request_type == 1 ? 'Request' : 'Supply' }}</td>
                                                        <td class="text-left category_c">{{ $req->category ? $req->category->title : '' }}</td>
                                                        <td class="text-left name_c">{{ $req->user->username }}</td>
                                                        <td class="text-left details_c">{{ Str::limit($req->description, 30) }}</td>

                                                        @if( ( $req->type == 'Paid' ) || ( $req->type == 'paid' ) )
                                                        <td class="text-left type_c_paid">{{ $req->type }}</td>
                                                        @else
                                                        <td class="text-left type_c_free">{{ $req->type }}</td>
                                                        @endif

                                                        <td class="text-left city_c">{{ $req->city->name }}</td>
                                                    </tr>
                                                @php
                                                $i++;
                                                @endphp
                                            @endforeach
                                                
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="disclaimer">
                                          <p><span>Disclaimer:</span> 
                                    This platform does not take responsibility for fulfillment of orders or guarantee of payment for goods and services listed.  Kindly engage with caution.</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
