@extends('layouts.app', ['pageSlug' => 'Requests'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header list-header">
                        <div class="row align-items-center">
                            <div class="col-8">    
                                <h3 class="text-white">Request for {{ $getRequest->category->title }}</h3>  
                            </div>
                            <div class="col-4 text-right">
                                @if(auth()->check())
                                    <a href="{{ route('requests') }}" class="btn btn-sm btn-primary btn-header">{{ __('Back to list') }}</a>
                                @else
                                    <a href="{{ route('home.landingpage') }}" class="btn btn-sm btn-primary btn-header">{{ __('Back to list') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($getRequest->type == "paid" || $getRequest->type == "Paid")
                            <!-- <h1>Requesting for paid service</h1> -->
                            <h3>Welcome to my page - <strong>{{ $getRequest->user->username }}</strong></h3>
                            <p>I require <strong>{{ $getRequest->category->title }}</strong> around <strong>{{ $getRequest->city->name }}, {{ $getRequest->state->name }}</strong>. I am willing to pay for it.</p>
                            @if($getRequest->show_phone == 1)
                                <p>Kindly call me on <i>
                                    <strong>{{ $getRequest->user->phone }}</strong>
                            @else
                                <p>Kindly contact me through this platform
                            @endif
                                 for <b>sale of</b> <b>{{ $getRequest->category->title }}({{ $getRequest->description }})</b> at affordable prices around <i>{{ $getRequest->city->name }}, {{ $getRequest->state->name }}</i>.
                            </p>
                            <p> <strong>{{ $getRequest->user->username }}</strong></p> 
                            @if($getRequest->show_address == 1)
                                <p>Address: {{ $getRequest->street }}</p>
                            @endif
                        @else
                            <!-- <h1>Requesting for free service</h1> -->
                            <h3>Welcome to my page - <strong>{{ $getRequest->user->username }}</strong></h3>
                            <p>I require <strong>{{ $getRequest->category->title }}({{$getRequest->description}})</strong> around <strong>{{ $getRequest->city->name }}, {{ $getRequest->state->name }}</strong> for free.</p>
                            @if($getRequest->show_phone == 1)
                                <p>Kindly call me on
                                    <strong>{{ $getRequest->user->phone }}</strong>  
                            @else
                                <p>Kindly contact me through this platform
                            @endif
                            </p>
                            <p><strong>{{ $getRequest->user->username }}</strong></p> 
                            @if($getRequest->show_address == 1)
                                <p>Address: {{ $getRequest->street }}</p>
                            @endif
                        @endif
                        </div>
                        @if(auth()->check())
                            @if(in_array(auth()->user()->id, $checkIfContacted))
                                <p style="color:red">You have previously contacted this user</p>
                            @else
                                @if($getRequest->user_id != auth()->user()->id)
                                    <div class="col-4 text-left">
                                        <a href="{{ route('send.requestDetails', $id=[$getRequest->id]) }}" onclick="disableButton()" id="email" class="btn btn-sm btn-primary btn-header">Contact {{ $getRequest->user->username }}</a>
                                    </div>
                                @endif
                            @endif
                        @else
                            <div class="col-4 text-left">
                                <a onclick="alert('please login to contact this person')" href="{{ route('send.requestDetails', $id=[$getRequest->id]) }}" class="btn btn-sm btn-primary btn-header">Contact {{ $getRequest->user->username }}</a>
                            </div>
                        @endif  
                    </div>
            </div>
        </div>
    </div>
    
@endsection
