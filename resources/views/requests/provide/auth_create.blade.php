@extends('layouts.app', ['pageSlug' => 'requests'])
@section('content')

<div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header list-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="text-white">{{ __('What do you want to provide for this lockdown?') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('store.provide.request') }}" autocomplete="off">
                            @csrf
                            <input type="hidden" name="request_type" value="2">
                            <h4 class="heading-small text-muted mb-4">{{ __('Provide Request') }}</h4>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group{{ $errors->has('category') ? ' has-danger' : '' }}">
                                            <strong><label class="form-control-label" for="input-category">{{ __('Category') }}</label></strong>
                                            <select name="category_id" id="input-category" class="form-control form-control-alternative{{ $errors->has('category') ? ' is-invalid' : '' }}" value="{{ old('category') }}" required>
                                                <option value="">Select a Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('industry'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('category') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group{{ $errors->has('company_name') ? ' has-danger' : '' }}">
                                            <strong><label class="form-control-label" for="input-company">{{ __('Description') }}</label></strong>
                                            <textarea name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('company_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}" value="{{ old('description') }}"></textarea>

                                            @if ($errors->has('company_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('company_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>                                                         
                                </div>
                                <h3>Location:</h3>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">
                                                <strong><label class="form-control-label" for="country_id">{{ __('Country') }}</label></strong>
                                                <select name="country_id" id="country_id" class="form-control form-control-alternative{{ $errors->has('country') ? ' is-invalid' : '' }}" placeholder="{{ __('Country') }}" value="{{ old('country') }}" required >
                                                    <option value="">Select a country</option>
                                                    @foreach(getCountries() as $country)
                                                        <option {{ $country->sortname == $location ? "selected" : "" }} value="{{ $country->id }}">{{ $country->country_name }}</option>
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
                                                <strong><label class="form-control-label" for="state_id">{{ __('State') }}</label></strong>
                                                <select name="state_id" id="state_id" class="form-control form-control-alternative{{ $errors->has('state') ? ' is-invalid' : '' }}" placeholder="{{ __('State') }}" value="{{ old('state') }}" required >
                                                    <option value="">Select State</option>
                                                    @foreach($states as $state)
                                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('state'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('state') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    <!-- </div>

                                    <div class="row"> -->
                                        <div class="col-md-3">
                                            <div class="form-group{{ $errors->has('city') ? ' has-danger' : '' }}">
                                                <strong><label class="form-control-label" for="city_id">{{ __('City') }}</label></strong>
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
                                <!-- </div> -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group{{ $errors->has('show_address') ? ' has-danger' : '' }}">
                                                <strong><label class="form-control-label" for="input-show_address">{{ __('Show Street Address') }}</label></strong>
                                                <select name="show_address" id="show_address" class="form-control form-control-alternative{{ $errors->has('type') ? ' is-invalid' : '' }}" >
                                                    <option value="">Select</option>
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>
                                                </select>

                                                @if ($errors->has('show_address'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('show_address') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                                <strong><label class="form-control-label" for="type">{{ __('Type') }}</label></strong>
                                                <select name="type" id="type_id" class="form-control form-control-alternative{{ $errors->has('type') ? ' is-invalid' : '' }}" value="{{ old('type') }}" >
                                                    <option value="">Select</option>
                                                    <option value="Free">Free</option>
                                                    <option value="Paid">Paid</option>
                                                </select>
                                                @if ($errors->has('type'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('type') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group{{ $errors->has('mode_of_contact') ? ' has-danger' : '' }}">
                                                <strong><label class="form-control-label" for="mode_of_contact">{{ __('How would you like to be contacted?') }}</label></strong>
                                                <select name="mode_of_contact" id="mode_of_contact" class="form-control form-control-alternative{{ $errors->has('mode_of_contact') ? ' is-invalid' : '' }}" value="{{ old('mode_of_contact') }}" >
                                                    <option value="">Select</option>
                                                    <option value="phone">Phone</option>
                                                    <option value="email">Email</option>
                                                </select>
                                                @if ($errors->has('state'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('state') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group{{ $errors->has('show_phone') ? ' has-danger' : '' }}">
                                                <strong><label class="form-control-label" for="show_phone">{{ __('Show Phone Number') }}</label></strong>
                                                <select name="show_phone" id="show_phone" class="form-control form-control-alternative{{ $errors->has('show_phone') ? ' is-invalid' : '' }}">
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                                @if ($errors->has('show_phone'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('show_phone') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                            
                                <div style="clear:both"></div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-custom mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        {{--@include('layouts.footers.auth') --}}
    </div>

@endsection