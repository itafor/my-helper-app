@extends('layouts.app-blue', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<div class="page-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="welcome-cards track-cards">
                    <div class="card">
                        <div class="card-header text-center">
                            <h2>{{ _('Edit Profile') }}</h2>
                        </div>
                        <form class="form" method="post" action="{{ route('profile.update') }}">
                            @csrf
                            <input type="hidden" name="user_type" value="1">
                            <div class="card-body form-wrap">
                                <!-- row -->

                                 <div class="row form-group">
                                    <div class="col-md-6">
                                        <div class="input-group{{ $errors->has('company_name') ? ' has-danger' : '' }}">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tim-icons icon-single-02"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="company_name" class="form-control" value="{{ $user->company_name}}" placeholder="Company Name">
                                            @include('alerts.feedback', ['field' => 'company_name'])
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group{{ $errors->has('lastname') ? ' has-danger' : '' }}">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tim-icons icon-single-02"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="website" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" placeholder="{{ _('Company website') }}" value="{{ $user->website }}">
                                            @include('alerts.feedback', ['field' => 'website'])
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tim-icons icon-single-02"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ _('First Name') }}" value="{{ $user->name}}">
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
                                            <input type="text" name="last_name" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" placeholder="{{ _('Last Name') }}" value="{{ $user->last_name }}">
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
                                            <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ _('Email') }}" value="{{ $user->email }}" readonly>
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
                                            <input type="tel" name="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="{{ _('Phone No') }}" value="{{ $user->phone }}">
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
                                                    <i class="tim-icons icon-single-02"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="{{ _('Username') }}" value="{{ $user->username }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">
                                            <strong><label class="form-control-label" for="api_state_id">{{ __('State') }}</label></strong>
                                            <select name="api_state" id="api_state_id" class="form-control form-control-alternative{{ $errors->has('country') ? ' is-invalid' : '' }}" placeholder="{{ __('Country') }}" value="{{ old('country') }}" required >
                                                <option value="">Select a state</option>
                                                @foreach(clickship_states() as $state)
                                                    <option  value="{{ $state['StateName'] }}" {{$state['StateName'] == $user->api_state ? 'selected' :''}}>{{ $state['StateName'] }}</option>
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
                                        <select name="api_city" id="api_city_id" class="form-control" required >
                                               <option value="">Select city</option>
                                                @foreach(clickship_cities() as $city)
                                                    <option  value="{{ $city['CityCode'] }}" {{$city['CityName'] == $user->api_city ? 'selected' : ''}}>{{ $city['CityName'] }}</option>
                                                @endforeach
                                               
                                            </select>
                                            @if ($errors->has('api_city'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('api_city_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('api_delivery_town') ? ' has-danger' : '' }}">
                                            <strong><label class="form-control-label" for="api_delivery_town">{{ __('Delivery Town') }}</label></strong>
                                            <select name="api_delivery_town" id="api_delivery_town" class="form-control">
                                                <option value="" {{$user->api_delivery_town !='' ? 'selected':''}}>{{$user->api_delivery_town}}</option>
                                                
                                            </select>
                                            @if ($errors->has('api_delivery_town'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('api_delivery_town') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>                                     
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('street') ? ' has-danger' : '' }}">
                                            <strong><label class="form-control-label" for="input-street">{{ __('Street') }}</label></strong>
                                            <input type="text" name="street" id="input-street" class="form-control form-control-alternative{{ $errors->has('street') ? ' is-invalid' : '' }}" placeholder="{{ __('Street') }}" value="{{$user->street}}" required >

                                            @if ($errors->has('street'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('street') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center mb-20">
                                <button type="submit" class="btn btn_simple btn_transparent btn_ggPrimary2">{{ _('Submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>

            <div class="welcome-cards mt-70 mb-20">

                <div class="card">
                    <div class="card-header text-center">
                        <h2>{{ _('Reset Password') }}</h2>
                    </div>
                    <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                        <div class="card-body">
                            @csrf
                            @method('put')

                            @include('alerts.success', ['key' => 'password_status'])

                            <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                <label>{{ __('Current Password') }}</label>
                                <input type="password" name="old_password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>
                                @include('alerts.feedback', ['field' => 'old_password'])
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <label>{{ __('New Password') }}</label>
                                <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
                                @include('alerts.feedback', ['field' => 'password'])
                            </div>
                            <div class="form-group">
                                <label>{{ __('Confirm New Password') }}</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm New Password') }}" value="" required>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn_simple btn_transparent btn_ggPrimary2">{{ _('Change password') }}</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
