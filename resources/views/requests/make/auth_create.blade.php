@extends('layouts.app', ['pageSlug' => 'requests'])
@section('content')

<div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header bg-white border-0 list-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="text-white">{{ __('What do you need?') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('store.make.request') }}" autocomplete="off">
                            @csrf
                            <input type="hidden" name="request_type" value="1">
                            <h6 class="heading-small text-muted mb-4">{{ __('Make Request') }}</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group{{ $errors->has('category') ? ' has-danger' : '' }}">
                                            <strong><label class="form-control-label" for="input-category">{{ __('Category') }}</label></strong>
                                            <select name="category_id" id="input-category" class="form-control form-control-alternative{{ $errors->has('category') ? ' is-invalid' : '' }} productCategory" value="{{ old('category') }}" required>
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
                                <h3>Delivery Location:</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">
                                                <strong><label class="form-control-label" for="api_state_id">{{ __('State') }}</label></strong>
                                                <select name="api_state" id="api_state_id" class="form-control form-control-alternative{{ $errors->has('country') ? ' is-invalid' : '' }}" placeholder="{{ __('Country') }}" value="{{ old('country') }}" required >
                                                    <option value="">Select a state</option>
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
                                        <div class="col-md-6">
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
                                       
                                    </div>
                                      <div class="row">
                                     
                                   
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('api_onforwarding_town_id') ? ' has-danger' : '' }}">
                                                <strong><label class="form-control-label" for="api_onforwarding_town_id">{{ __('Delivery Town (Optional)') }}</label></strong>
                                                <select name="api_onforwarding_town_id" id="api_onforwarding_town_id" class="form-control form-control-alternative{{ $errors->has('api_onforwarding_town_id') ? ' is-invalid' : '' }}" placeholder="{{ __('api_onforwarding_town_id') }}" value="{{ old('street') }}">
                                                    <option value="">Select Town</option>
                                                </select>
                                                @if ($errors->has('api_onforwarding_town_id'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('api_onforwarding_town_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
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
                                    <input type="hidden" name="api_delivery_town_id" id="api_delivery_town_id">

                                <!-- </div> -->
                                 <!--    <div class="row">
                                        <div class="col-md-4">
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
                                        <div class="col-md-4">
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
                                   
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('show_phone') ? ' has-danger' : '' }}">
                                                <strong><label class="form-control-label" for="show_phone">{{ __('Show Phone Number') }}<small>(If No, you would be contacted via mail)</small></label></strong>
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
                                    </div> -->
                            
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