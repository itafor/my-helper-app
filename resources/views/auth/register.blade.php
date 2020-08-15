@extends('layouts.app', ['class' => 'register-page', 'contentClass' => 'register-page'])

@section('content')
    <div class="row">
        
        <div class="col-md-8 offset-md-2">
            <div class="card card-register card-white">
                <div class="card-header">
                    <!-- <img class="card-img" src="{{ asset('white') }}/img/card-primary.png" alt="Card image"> -->
                    <h2 class="text-center">{{ __('Individual Registration') }}</h2>
                </div>
                <form class="form" method="post" action="{{ route('register') }}">
                    @csrf
                    <input type="hidden" name="user_type" value="1">
                    <div class="card-body form-wrap">
                        <!-- row -->
                        <div class="row form-group">
                            <div class="col-md-6">
                                <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-single-02"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ _('First Name') }}" value="{{ old('name') }}">
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group{{ $errors->has('lastname') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-single-02"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="last_name" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" placeholder="{{ _('Last Name') }}" value="{{ old('lastname') }}">
                                    @include('alerts.feedback', ['field' => 'lastname'])
                                </div>
                            </div>
                        </div>

                        <!-- row -->
                        <div class="row form-group">
                            <div class="col-md-6">
                                <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-email-85"></i>
                                        </div>
                                    </div>
                                    <input onblur="duplicateEmail(this)" type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ _('Email') }}" value="{{ old('email') }}">
                                    @include('alerts.feedback', ['field' => 'email'])
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-mobile"></i>
                                        </div>
                                    </div>
                                    <input type="tel" name="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="{{ _('Phone No') }}" value="{{ old('phone') }}">
                                    @include('alerts.feedback', ['field' => 'phone'])
                                </div>
                            </div>
                        </div>

                        <!-- row -->
                        <div class="row form-group">
                            <div class="col-md-12">
                                <div class="input-group{{ $errors->has('username') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-email-85"></i>
                                        </div>
                                    </div>
                                    <input onblur="duplicateUserName(this)" type="text" name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="{{ _('Username') }}" value="{{ old('username') }}">
                                    @include('alerts.feedback', ['field' => 'username'])
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">
                                                <strong><label class="form-control-label" for="api_state_id">{{ __('State') }}</label></strong>
                                                <select name="api_state" id="api_state_id" class="form-control form-control-alternative{{ $errors->has('country') ? ' is-invalid' : '' }}" placeholder="{{ __('Country') }}" value="{{ old('country') }}" required >
                                                    <option value="">Select a country</option>
                                                    @foreach(clickship_states() as $state)
                                                        <option  value="{{ $state['StateName'] }}">{{ $state['StateName'] }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('api_state'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('api_state_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('api_city_id') ? ' has-danger' : '' }}">
                                                <strong><label class="form-control-label" for="api_city_id">{{ __('City') }}</label></strong>
                                                <select name="api_city" id="api_city_id" class="form-control form-control-alternative{{ $errors->has('api_city_id') ? ' is-invalid' : '' }}" placeholder="{{ __('api_city_id') }}" value="{{ old('api_city_id') }}" required >
                                                    <option value="">Select City</option>
                                                   
                                                </select>
                                                @if ($errors->has('api_city'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('api_city_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                   
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('street') ? ' has-danger' : '' }}">
                                                <strong><label class="form-control-label" for="input-street">{{ __('Street') }}</label></strong>
                                                <input type="text" name="street" id="input-street" class="form-control form-control-alternative{{ $errors->has('street') ? ' is-invalid' : '' }}" placeholder="{{ __('Street') }}" value="{{ old('street') }}" required >

                                                @if ($errors->has('street'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('street') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                     


 
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-lock-circle"></i>
                                        </div>
                                    </div>
                                    <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ _('Password') }}">
                                    @include('alerts.feedback', ['field' => 'password'])
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-lock-circle"></i>
                                        </div>
                                    </div>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="{{ _('Confirm Password') }}">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-footer text-center mb-20">
                        <button type="submit" class="btn btn-round btn-lg btn-lg-pd btn-custom">{{ _('Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6 mr-auto">
            
        </div>
    </div>
@endsection
