@extends('layouts.app', ['class' => 'register-page', 'contentClass' => 'register-page'])

@section('content')
    <div class="row">
        
        <div class="col-md-12">
            <div class="card card-register card-white">
                <div class="card-header">
                    <!-- <img class="card-img" src="{{ asset('white') }}/img/card-primary.png" alt="Card image"> -->
                    <h4 class="text-blue card-title">{{ __('Corporate') }}</h4>
                </div>
                <form class="form" method="post" action="{{ route('register') }}">
                    @csrf
                    <input type="hidden" name="user_type" value="2">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-group{{ $errors->has('company_name') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-single-02"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="company_name" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" placeholder="{{ _('Company Name') }}" value="{{ old('company_name') }}">
                                    @include('alerts.feedback', ['field' => 'company_name'])
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group{{ $errors->has('website') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-single-02"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="website" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" placeholder="{{ _('Website') }}" value="{{ old('website') }}">
                                    @include('alerts.feedback', ['field' => 'website'])
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-single-02"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Contact Person's Firstname" value="{{ old('name') }}">
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group{{ $errors->has('lastname') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-single-02"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="last_name" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" placeholder="Contact Person's Surname" value="{{ old('lastname') }}">
                                    @include('alerts.feedback', ['field' => 'lastname'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-email-85"></i>
                                        </div>
                                    </div>
                                    <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Contact Person's Email" value="{{ old('email') }}">
                                    @include('alerts.feedback', ['field' => 'email'])
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-email-85"></i>
                                        </div>
                                    </div>
                                    <input type="tel" name="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="Contact Person's Phone No" value="{{ old('phone') }}">
                                    @include('alerts.feedback', ['field' => 'phone'])
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-md-6">
                                <div class="input-group{{ $errors->has('username') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-email-85"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="{{ _('Username') }}" value="{{ old('username') }}">
                                    @include('alerts.feedback', ['field' => 'username'])
                                </div>
                            </div>
                        </div> -->

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="country_id">{{ __('Country') }}</label>
                                    <select name="country_id" id="country_id" class="form-control form-control-alternative{{ $errors->has('country') ? ' is-invalid' : '' }}" placeholder="{{ __('Country') }}" value="{{ old('country') }}" required >
                                        <option value="">Select a country</option>
                                        @foreach(getCountries() as $country)
                                            <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('country'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('country') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group{{ $errors->has('state') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="state_id">{{ __('State') }}</label>
                                    <select name="state_id" id="state_id" class="form-control form-control-alternative{{ $errors->has('state') ? ' is-invalid' : '' }}" placeholder="{{ __('State') }}" value="{{ old('state') }}" required >
                                        <option value="">Select State</option>
                                    </select>
                                    @if ($errors->has('state'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('state') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                
                            <div class="col-md-3">
                                <div class="form-group{{ $errors->has('city') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="city_id">{{ __('City') }}</label>
                                    <select name="city_id" id="city_id" class="form-control form-control-alternative{{ $errors->has('city') ? ' is-invalid' : '' }}" placeholder="{{ __('City') }}" value="{{ old('street') }}" required >
                                        <option value="">Select City</option>
                                    </select>
                                    @if ($errors->has('city'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group{{ $errors->has('street') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-street">{{ __('Street') }}</label>
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
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-round btn-lg">{{ _('Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6 mr-auto">
            
        </div>
    </div>
@endsection