@extends('layouts.app', ['pageSlug' => 'requests'])
@section('content')

<div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header list-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="text-white">{{ __('What do you want to provide?') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('store.provide.request') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="request_type" value="2">
                            <h4 class="heading-small text-muted mb-4">{{ __('Provide Request') }}</h4>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group{{ $errors->has('category') ? ' has-danger' : '' }}">
                                            <strong><label class="form-control-label" for="input-category">{{ __('Category') }}</label></strong>
                                            <select name="category_id" id="productCategory" class="form-control" value="{{ old('category') }}" required>
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
                                    {{--<div class="row">
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
                                                <select name="state_id" id="state_id" class="form-control" placeholder="{{ __('State') }}" value="{{ old('state') }}" required >
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
                                    </div>--}}

                                        <div class="row">
                                        <div class="col-md-3">
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
                                        <div class="col-md-3">
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
                                    <!-- </div>

                                    <div class="row"> -->
                                        <div class="col-md-3">
                                            <div class="form-group{{ $errors->has('api_delivery_town') ? ' has-danger' : '' }}">
                                                <strong><label class="form-control-label" for="api_delivery_town">{{ __('Delivery Town (Optional)') }}</label></strong>
                                                <select name="api_delivery_town" id="api_delivery_town" class="form-control form-control-alternative{{ $errors->has('api_delivery_town') ? ' is-invalid' : '' }}" placeholder="{{ __('api_delivery_town') }}" value="{{ old('street') }}">
                                                    <option value="">Select Town</option>
                                                </select>
                                                @if ($errors->has('api_delivery_town'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('api_delivery_town') }}</strong>
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
                                            <div class="form-group{{ $errors->has('delivery_cost_payer') ? ' has-danger' : '' }}">
                                                <strong><label class="form-control-label" for="delivery_cost_payer">{{ __('Delivery fee Payment Type') }}</label></strong>
                                                <select name="delivery_cost_payer" id="delivery_cost_payer" class="form-control form-control-alternative{{ $errors->has('delivery_cost_payer') ? ' is-invalid' : '' }}" value="{{ old('delivery_cost_payer') }}" required>
                                                    <option value="">Select delivey fee payment type</option>
                                                    @foreach(payment_types() as $paymentype)
                                                        <option  value="{{ $paymentype['PaymentType'] }}">{{ $paymentype['PaymentType'] }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('delivery_cost_payer'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('delivery_cost_payer') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group{{ $errors->has('show_phone') ? ' has-danger' : '' }}">
                                                <strong><label class="form-control-label" for="show_phone">{{ __('Show Phone Number') }}<!-- <small>(If No, you would be contacted via mail)</small> --></label></strong>
                                                <select name="show_phone" id="show_phone" class="form-control form-control-alternative{{ $errors->has('show_phone') ? ' is-invalid' : '' }}" required>
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
                                    <h3>Item Size IN Weight</h3>
                             <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('show_address') ? ' has-danger' : '' }}">
                                                <input class="form-check-input" type="radio" name="weight" id="weight1" value="3.5">
                                            <label class="form-check-label" for="weight1"><b>SMALL:</b> Items that can fit into a box on a motorcycle (e.g. small-sized electronics) <b>Assumed Weight:</b> 3.5 kg</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                             <input class="form-check-input" type="radio" name="weight" id="weight2" value="7.5">
                                                <label class="form-check-label" for="weight2"><b>MEDIUM:</b> Items that are heavy and may be transported with vans. <b>Assumed Weight:</b> 7.5.0 kg</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('delivery_cost_payer') ? ' has-danger' : '' }}">
                                               <input class="form-check-input" type="radio" name="weight" id="weight3" value="10.0">
                                            <label class="form-check-label" for="weight3"><b>LARGE:</b> Items that are large like pieces of furniture and large electronics. <b>Assumed Weight:</b> 10.0 kg</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
     
                                <div class="col-md-12">
                                    <label class="form-control-label" for="input-property_type">{{ __('Photos') }} (Optional)</label>
                                    <input type="file" name="photos[112211][image_url]"  class="form-control">
                                </div>
                            
                                  <div style="clear:both"></div>
                                <div id="photoContainer" class="col-md-12">
                                </div>   
         
                                    </div>
                                  <div style="clear:both"></div>

                                     <div class="form-group">
                                    <button type="button" id="addMorePhoto" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i>  Add more photo</button>
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