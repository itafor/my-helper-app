@extends('layouts.app-blue', ['pageSlug' => 'requests'])
@section('content')

<div class="page-wrap">
        <div class="container">
            <div class="row">
              <div class="col-md-10 request-panel  pt-40 pb-40">
                <div class="card">
                    <div class="card-header text-center bs-padded">
                        <h2>{{ __('Get Help') }}</h2>
                    </div>
                    <div class="card-body">
                        <div class="form-wrap">
                        <form method="post" action="{{ route('store.make.request') }}" autocomplete="off">
                            @csrf
                            <input type="hidden" name="request_type" value="1">
                            
                            <h4 class="heading-small text-muted mb-4">{{ __('Make Request') }}</h4>
                            <div class="group-wrap">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('category') ? ' has-danger' : '' }}">
                                            <strong><label class="form-control-label" for="input-category">{{ __('Category') }}</label></strong>
                                            <select name="category_id" id="category_id" class="form-control  productCategory" value="{{ old('category') }}" required>
                                                <option value="">Select a Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                @error('category_id')
                            <div class="error">{{ $message }}</div>
                            @enderror
                                        </div>
                                    </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label id="itemlabel"></label><br>
                                        <div id="multipleItem"></div>
                                @error('items')
                            <div class="error">{{ $message }}</div>
                            @enderror
                                    </div>
                                </div>
                            <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('company_name') ? ' has-danger' : '' }}">
                                            <strong><label class="form-control-label" for="input-company">{{ __('Description') }}</label></strong>
                                            <textarea name="description" id="input-description" class="form-control" placeholder="{{ __('Description') }}" value="{{ old('description') }}" required></textarea>

                            @error('description')
                            <div class="error">{{ $message }}</div>
                            @enderror
                                        </div>
                                    </div>                                                         
                                </div>
                            </div>

                            <div class="group-wrap">
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
                            @error('api_state')
                            <div class="error">{{ $message }}</div>
                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('api_city_id') ? ' has-danger' : '' }}">
                                                <strong><label class="form-control-label" for="api_city_id">{{ __('City') }}</label></strong>
                                                <select name="api_city" id="api_city_id" class="form-control form-control-alternative{{ $errors->has('api_city_id') ? ' is-invalid' : '' }}" placeholder="{{ __('api_city_id') }}" value="{{ old('api_city_id') }}" required >
                                                    <option value="">Select City</option>
                                                   
                                                </select>
                                @error('api_city')
                            <div class="error">{{ $message }}</div>
                            @enderror
                                            </div>
                                        </div>
                                       
                                    </div>
                                      <div class="row">
                                     
                                   
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('api_onforwarding_town_id') ? ' has-danger' : '' }}">
                                                <strong><label class="form-control-label" for="api_onforwarding_town_id">{{ __('Delivery Town')}}</label></strong>
                                                <select name="api_onforwarding_town_id" id="api_onforwarding_town_id" class="form-control form-control-alternative{{ $errors->has('api_onforwarding_town_id') ? ' is-invalid' : '' }}" placeholder="{{ __('api_onforwarding_town_id') }}" value="{{ old('street') }}" required>
                                                    <option value="">Select Town</option>
                                                </select>
                            @error('api_onforwarding_town_id')
                            <div class="error">{{ $message }}</div>
                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('street') ? ' has-danger' : '' }}">
                                                <strong><label class="form-control-label" for="input-street">{{ __('Street') }}</label></strong>
                                                <input type="text" name="street" id="input-street" class="form-control form-control-alternative{{ $errors->has('street') ? ' is-invalid' : '' }}" placeholder="{{ __('Street') }}" value="{{ old('street') }}" required >

                            @error('street')
                            <div class="error">{{ $message }}</div>
                            @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="api_delivery_town_id" id="api_delivery_town_id">
                            </div>
                                
                            
                                <div style="clear:both"></div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-custom mt-4">{{ __('Save') }}</button>
                                </div>
                            
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{--@include('layouts.footers.auth') --}}
    </div>
</div>
@endsection