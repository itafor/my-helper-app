@extends('layouts.app', ['pageSlug' => ''])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header list-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="text-white">{{ $getRequest->category->title }}</h3>
                            </div>
                            <div class="col-4 text-right">
                              <a href="{{ url('/') }}" class="btn btn-sm btn-primary btn-header">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- <div class="row"> -->
                            @if($getRequest->type == "paid" || $getRequest->type == "Paid")
                                <h3>Welcome to my <strong>{{ $getRequest->user->username }}</strong> page</h3>
                                <p>
                                @if($getRequest->show_phone == 1)
                                    Please call me on <i>
                                    <strong>
                                            {{ $getRequest->user->phone }}</strong>
                                        @else
                                            Kindly contact me
                                        @endif
                                    </i> for <b>sale </b>of <i>"<strong>{{ $getRequest->description }}</strong>"</i> at affordable prices around <i>"<strong>{{ $getRequest->city->name }}, {{ $getRequest->state->name }}</strong>"</i> axis.
                                </p>
                                <p>Thank you for your patronage</p>
                                <p> Name: <strong>{{ $getRequest->user->name }} {{ $getRequest->user->last_name }}</strong></p> 
                                @if($getRequest->show_address == 0)
                                    <p>Address ***</p>
                                @else
                                    <p>Address: {{ $getRequest->street }}</p>
                                @endif
                            @else

                                <h3>Welcome to my page <strong>{{ $getRequest->user->username }}</strong></h3>
                                @if($getRequest->show_phone == 1)
                                    <p>Please call me on <i>"
                                    <strong>
                                            {{ $getRequest->user->phone }}
                                        @else
                                            <p>Please contact me through this platform
                                        @endif
                                    </strong>for <b>free</b> <strong>{{ $getRequest->category->title }} ({{ $getRequest->description }})</strong>"</i> around <i>"<strong>{{ $getRequest->city->name }}, {{ $getRequest->state->name }}</strong>"</i>.
                                
                                </p>
                                <p>Thank you</p>
                                <p> Name <strong>{{ $getRequest->user->name }} {{ $getRequest->user->last_name }}</strong></p> 
                                @if($getRequest->show_address == 0)
                                    <p>Address ***</p>
                                @else
                                    <p>Address: {{ $getRequest->street }}</p>
                                @endif
                            @endif
                            
                            
                        <!-- </div> -->
                        <!-- <div class="row item-row">
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><h5>{{ __('Name') }}</h5></label>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><strong>{{ $getRequest->user->name }}</strong></label>
                            </div>
                        </div> 
                        <div class="row item-row">
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><h5>{{ __('Phone') }}</h5></label>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><strong>{{ $getRequest->user->phone }}</strong></label>
                            </div>
                        </div>
                        <div class="row item-row">
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><h5>{{ __('Email') }}</h5></label>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><strong>{{ $getRequest->user->email }}</strong></label>
                            </div>
                        </div>
                        <div class="row item-row">
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><h5>{{ __('Country') }}</h5></label>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><strong>{{ $getRequest->country->country_name }}</strong></label>
                            </div>
                        </div> 
                        <div class="row item-row">
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><h5>{{ __('State') }}</h5></label>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><strong>{{ $getRequest->state->name }}</strong></label>
                            </div>
                        </div> 
                        <div class="row item-row">
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><h5>{{ __('City') }}</h5></label>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><strong>{{ $getRequest->city->name }}</strong></label>
                            </div>
                        </div> 
                        <div class="row item-row">
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><h5>{{ __('Street') }}</h5></label>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><strong>{{ $getRequest->street }}</strong></label>
                            </div>
                        </div>

                            @if($getRequest->user->user_type == 2) 
                        <div class="row item-row">
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><h5>Company Name</h5></label>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><strong>{{ $getRequest->user->company_name }}</strong></label>
                            </div>
                        </div>
                        <div class="row item-row">
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><h5>{{ __("Company's Website") }}</h5></label>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><strong>{{ $getRequest->user->website }}</strong></label>
                            </div>
                        </div>
                        @endif 
                        <div class="row item-row">
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><h5>{{ __('User Type') }}</h5></label>
                            </div>

                        
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><strong>{{ $getRequest->user->user_type == 1 ? 'Individual':'Corporate' }}</strong></label>
                            </div>
                        </div>
                        <div class="row item-row">
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><h5>{{ __('Description') }}</h5></label>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><strong>{{ $getRequest->description }}</strong></label>
                            </div>
                        </div>
                        <div class="row item-row">
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><h5>{{ __('Category') }}</h5></label>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><strong>{{ $getRequest->category->title }}</strong></label>
                            </div>
                        </div>
                        <div class="row item-row">
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><h5>{{ __('Type') }}</h5></label>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><strong>{{ $getRequest->type }}</strong></label>
                            </div>                           
                        </div> -->
                            @if(auth()->check())
                                @if(auth()->user()->id != $getRequest->user_id)
                                    <div class="col-4 text-right">
                                        <a onclick="disableButton()" id="email" href="{{ route('send.provideDetails', $id=[$getRequest->id]) }}" class="btn btn-sm btn-primary btn-header">{{ __('Contact By Email') }}</a>
                                    </div>
                                @endif
                            @else
                                <div class="col-4 text-right">
                                    <a onclick="alert('please login to contact this person')" href="{{ route('show.auth.request', $id=[$getRequest->id]) }}" class="btn btn-sm btn-primary btn-header">{{ __('Contact By Email') }}</a>
                                </div>
                            @endif                            
                        <!-- <div class="col-4 text-right">
                            <a href="{{ route('show.request', $id=[$getRequest->id]) }}" class="btn btn-sm btn-primary btn-header">{{ __('Contact By Email') }}</a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
