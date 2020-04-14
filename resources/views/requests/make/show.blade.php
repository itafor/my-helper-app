@extends('layouts.app', ['pageSlug' => 'Requests'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('View Request') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('/') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><h5>{{ __('Name') }}</h5></label>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><strong>{{ $getRequest->user->name }}</strong></label>
                            </div>
                            
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><h5>{{ __('Phone') }}</h5></label>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><strong>{{ $getRequest->user->phone }}</strong></label>
                            </div>

                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><h5>{{ __('Email') }}</h5></label>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><strong>{{ $getRequest->user->email }}</strong></label>
                            </div>

                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><h5>{{ __('Street') }}</h5></label>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><strong>{{ $getRequest->user->street }}</strong></label>
                            </div>
                            @if($getRequest->user->user_type == 2) 
                                <div class="col-xl-6">
                                    <label class="form-control-label" for="input-name"><h5>Company Name</h5></label>
                                </div>
                                <div class="col-xl-6">
                                    <label class="form-control-label" for="input-name">{{ $getRequest->user->company_name }}<strong></strong></label>
                                </div>
                                <div class="col-xl-6">
                                    <label class="form-control-label" for="input-name"><h5>{{ __("Company's Website") }}</h5></label>
                                </div>
                                <div class="col-xl-6">
                                    <label class="form-control-label" for="input-name"><strong>{{ $getRequest->user->website }}</strong></label>
                                </div>
                            @endif 
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><h5>{{ __('User Type') }}</h5></label>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><strong>{{ $getRequest->user->user_type == 1 ? 'Individual':'Corporate' }}</strong></label>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><h5>{{ __('Description') }}</h5></label>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><strong>{{ $getRequest->description }}</strong></label>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><h5>{{ __('Category') }}</h5></label>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><strong>{{ $getRequest->category->title }}</strong></label>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><h5>{{ __('Type') }}</h5></label>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-control-label" for="input-name"><strong>{{ $getRequest->type }}</strong></label>
                            </div>
                                                     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
