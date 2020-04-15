@extends('layouts.app', ['pageSlug' => 'Requests'])

@section('content')
    <div class="header py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <h2 class="text-blue h2-heading">{{ __('What do u need right now for your lockdown?') }}</h2>
                            <div class="btn-group req-btn" >
                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Select Request Type
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('new.make.request') }}">Make Request</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('new.provide.request') }}">Provide Request</a>
                                </div>
                            </div>
                        <p class="text-lead text-light">
                            {{ __('What do u need right now for your lockdown?') }}
                        </p>
                        
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
                                                <th class="text-left">Date</th>
                                                <th class="text-left">Request Type</th>
                                                <th class="text-left">Category</th>
                                                <th class="text-left">Display Name</th>
                                                <th class="text-left">Details</th>
                                                <th class="text-left">Type</th>
                                                <th class="text-left">City</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($allRequests as $req)
                                            
                                                <tr class='clickable-row' 
                                                    @if($req->request_type == 1)
                                                        data-href="{{ route('view.make.request', [$req->id]) }}">
                                                    @else
                                                        data-href="{{ route('view.request', [$req->id]) }}">
                                                    @endif
                                                    @php
                                                        $today = \Carbon\Carbon::today();
                                                        $time = \Carbon\Carbon::now();
                                                        $ageInSeconds = \Carbon\Carbon::parse($req->created_at)->diffInSeconds($time);
                                                        $ageInMins = \Carbon\Carbon::parse($req->created_at)->diffInMinutes($time);
                                                        $ageInHrs = \Carbon\Carbon::parse($req->created_at)->diffInHours($time);
                                                        $age = \Carbon\Carbon::parse($req->created_at)->diffInDays($time);
                                                        @endphp
                                                    @if($ageInSeconds < 60)
                                                        <td class="text-left">{{ $ageInSeconds }}{{ $ageInSeconds < 2 ? 'sec' : 'secs'}} ago</td>
                                                    @elseif($ageInMins < 60)
                                                        <td class="text-left">{{ $ageInMins }}{{ $ageInMins < 2 ? 'min' : 'mins'}} ago</td>
                                                    @elseif($ageInHrs < 24)
                                                        <td class="text-left">{{ $ageInHrs }}{{ $ageInHrs < 2 ? 'hr' : 'hrs'}} ago</td>
                                                    @else 
                                                        <td class="text-left">{{ $age  }} {{ $age < 2 ? 'day': 'days' }}</td>
                                                    @endif

                                                    <td class="text-left">{{ $req->request_type == 1 ? 'I need' : 'I want to provide' }}</td>
                                                    <td class="text-left">{{ $req->category->title }}</td>
                                                    <td class="text-left">{{ $req->user->username }} {{ $req->user->last_name }}</td>
                                                    <td class="text-left">{{ Str::limit($req->description, 30) }}</td>
                                                    <td class="text-left">{{ $req->type }}</td>
                                                    <td class="text-left">{{ $req->city->name }}</td>
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