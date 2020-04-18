@extends('layouts.app', ['pageSlug' => ''])

@section('content')
    <div class="header py-7 py-lg-8">
        <div class="container-fluid">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-md-12 content-wrapper">
                        <div class="content-header">
                            <h2 class="text-blue h2-heading">{{ __('What do you need right now for your lockdown?') }}</h2>
                            <div class="btn-group req-btn" >
                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Get Started
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('make.request') }}">Receiver</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('provide.request') }}">Supplier</a>
                                </div>
                            </div>
                            <!-- <p class="text-lead text-light">
                                {{ __('What do u need right now for your lockdown?') }}
                            </p> -->
                        </div>
                        
                        
                        <div class="col-md-12">
                            <div class="card ">
                                <div class="card-header">
                                    <h4 class="card-title">Requests</h4>
                                </div>
                                <div class="card-body">
                                @include('alerts.success')
                                <div class="table-responsive">
                                    <table class="table tablesorter " id="requests">
                                        <thead class=" text-primary">
                                            <tr>
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
                                        @foreach($allRequests as $req)
                                            
                                        <tr class='clickable-row' 
                                                    @if($req->request_type == 1)
                                                        onclick="alert('Please login to see this request')"
                                                        data-href="{{ route('view.make.request', [$req->id]) }}">
                                                    @else
                                                        data-href="{{ route('view.request', [$req->id]) }}">
                                                    @endif
                                                <td class='text-left id_c hidden_all'>{{ $req->id }}</td>
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

                                                    @elseif(($ageInHrs > 1 ) && ( $ageInHrs < 24 ))
                                                        <td class="text-left time_c">{{ $ageInHrs }}{{ $ageInHrs < 2 ? 'hour' : ' hours'}} ago</td>
                                                    @else
                                                        <td class="text-left time_c">{{ $age }}{{ $age < 2 ? ' day ' : ' days '}} ago</td>
                                                    @endif
                                                    
                                                    <td class="text-left req_type_c">{{ $req->request_type == 1 ? 'Request' : 'Supply' }}</td>
                                                    <td class="text-left category_c">{{ $req->category->title }}</td>
                                                    <td class="text-left name_c">{{ $req->user->username }} {{ $req->user->last_name }}</td>
                                                    <td class="text-left details_c">{{ Str::limit($req->description, 30) }}</td>

                                                    @if( ( $req->type == 'Paid' ) || ( $req->type == 'paid' ) )
                                                    <td class="text-left type_c_paid">{{ $req->type }}</td>
                                                    @else
                                                    <td class="text-left type_c_free">{{ $req->type }}</td>
                                                    @endif

                                                    <td class="text-left city_c">{{ $req->city->name }}</td>
                                                </tr>
                                            
                                        @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
