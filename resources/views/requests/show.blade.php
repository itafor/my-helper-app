@extends('layouts.app', ['pageSlug' => ''])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header list-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="text-white">Supply of {{ $getRequest->category ? $getRequest->category->title : ''}}</h3>
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
                    <div class="card-body request-card column-card" style="background-image:url({{ asset('white') }}/img/give.jpg);">
                        <div class="column-one">
                            @if($getRequest->type == "paid" || $getRequest->type == "Paid")
                                <h3>Welcome to my page - <strong>{{ $getRequest->user->username }}</strong></h3>
                                    <div class="user-request-card">
                                        <p>
                                        @if($getRequest->show_phone == 1)
                                            Please call me on 
                                            <strong>
                                                    {{ $getRequest->user->phone }}</strong>
                                                @else
                                                    Kindly contact me through this platform
                                                @endif
                                             for <b>sale </b>of <strong>{{ $getRequest->category ? $getRequest->category->title : '' }} - {{ $getRequest->description }}</strong> at affordable prices around <strong>{{ $getRequest->city->name }}, {{ $getRequest->state->name }}</strong>.
                                        </p>
                                        <p>Thank you for your patronage</p>
                                        <p><strong>{{ $getRequest->user->username }}</strong></p> 
                                        @if($getRequest->show_address == 1)
                                            <p>Address: {{ $getRequest->street }}</p>
                                        @endif
                                     @else

                                    <h3>Welcome to my page - <strong>{{ $getRequest->user->username }}</strong></h3>
                                    @if($getRequest->show_phone == 1)
                                    <div class="user-request-card">
                                        <p>Please call me on 
                                        <strong>
                                                {{ $getRequest->user->phone }}
                                            @else
                                                <p>Kindly contact me through this platform
                                            @endif
                                        </strong>for <b>free</b> <strong>{{ $getRequest->category ? $getRequest->category->title : '' }} - ({{ $getRequest->description }})</strong> around <strong>{{ $getRequest->city->name }}, {{ $getRequest->state->name }}</strong>.
                                    
                                    </p>
                                    <p>Thank you</p>
                                    <p><strong>{{ $getRequest->user->username }}</strong></p> 
                                    @if($getRequest->show_address == 1)
                                        <p>Address: {{ $getRequest->street }}</p>
                                    @endif
                                @endif
                            </div>
                        </div>
                        @if(auth()->check())
                            <div class="column-two">
                                <div class="suggestion">
                                    <h4>Suggestions</h4>
                                    @foreach($suggestions as $suggestion)
                                        <div class="suggestion-area">
                                        <!-- Render different URLs if they are guests or not -->
                                        <!-- Link to the get help page -->
                                            <a href="{{ route('auth_view.make.request', [$id=$suggestion->id]) }}">
                                                <h4 class="name">{{ $suggestion->user->username }} <span class="cat memo memo2">{{ $suggestion->category ? $suggestion->category->title : '' }} </span></h4>                                            
                                                <div class="memo desc">{{ $suggestion->description }} </div>
                                                <div class="desc">State: <span>{{ $suggestion->state->name }} </span></div>
                                            </a>
                                        </div>
                                        <br>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <!-- </div> -->
                        @if(auth()->check())
                            @if(in_array(auth()->user()->id, $checkIfContacted))
                                <p style="color:red">You have previously contacted this user</p>
                            @else
                                @if($getRequest->user_id != auth()->user()->id)
                                    <div class="text-left card-btn">
                                    <a onclick="disableButton()" id="email" href="{{ route('send.provideDetails', $id=[$getRequest->id]) }}" class="btn btn-sm btn-primary btn-header">Contact {{ $getRequest->user->username }}</a>
                                    </div>
                                @endif
                            @endif
                        @else
                            <div class="text-left card-btn">
                                <a onclick="alert('please login to contact this person')" href="{{ route('send.provideDetails', $id=[$getRequest->id]) }}" class="btn btn-sm btn-primary btn-header">Contact {{ $getRequest->user->username }}</a>
                            </div>
                        @endif  
                    <!-- </div>                     -->
                        <!-- <div class="col-4 text-right">
                            <a href="{{ route('show.request', $id=[$getRequest->id]) }}" class="btn btn-sm btn-primary btn-header">{{ __('Contact By Email') }}</a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
