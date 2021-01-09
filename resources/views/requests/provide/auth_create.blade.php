@extends('layouts.app-blue', ['pageSlug' => 'requests'])

@section('content')

    <div class="page-wrap">
        <div class="container">
            <div class="row">
                
                <div class="col-md-10 request-panel pt-40 pb-40">

                  <div class="card">

                    <div class="card-header text-center bs-padded">
                        <h2>{{ __('Provide Help') }}</h2>
                    </div>

                    <div class="card-body">
                        <form method="post" action="{{ route('store.provide.request') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="request_type" value="2">
                            <h4 class="heading-small text-muted mb-4">{{ __('Provide Request') }}</h4>
                            <div class="group-wrap">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('category') ? ' has-danger' : '' }}">
                                            <strong><label class="form-control-label" for="input-category">{{ __('Category') }}</label></strong>
                                            <select name="category_id" id="category_id" class="form-control" value="{{ old('category') }}" required>
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
                                <h3>Location:</h3>

                                <div class="row">
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
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
                                    
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('api_onforwarding_town_id') ? ' has-danger' : '' }}">
                                            <strong><label class="form-control-label" for="api_onforwarding_town_id">{{ __('Pickup Town') }}</label></strong>
                                            <select name="api_onforwarding_town_id" id="api_onforwarding_town_id" class="form-control form-control-alternative{{ $errors->has('api_onforwarding_town_id') ? ' is-invalid' : '' }}" placeholder="{{ __('api_onforwarding_town_id') }}" value="{{ old('street') }}" required>
                                                <option value="">Select Town</option>
                                            </select>
                                            @error('api_onforwarding_town_id')
                                            <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                      
                                </div>
                                    
                                <input type="hidden" name="api_delivery_town_id" id="api_delivery_town_id">


                                <div class="row">
                                     <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('street') ? ' has-danger' : '' }}">
                                            <strong><label class="form-control-label" for="input-street">{{ __('Street') }}</label></strong>
                                            <input type="text" name="street" id="input-street" class="form-control form-control-alternative{{ $errors->has('street') ? ' is-invalid' : '' }}" placeholder="{{ __('Street') }}" value="{{ old('street') }}" required >

                                            @error('street')
                                            <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                      
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('delivery_cost_payer') ? ' has-danger' : '' }}">
                                            <strong><label class="form-control-label" for="delivery_cost_payer">{{ __('Who will pay delivery cost') }}</label></strong>
                                            <select name="delivery_cost_payer" id="delivery_cost_payer" class="form-control form-control-alternative{{ $errors->has('delivery_cost_payer') ? ' is-invalid' : '' }}" value="{{ old('delivery_cost_payer') }}" required>
                                                <option value="">Select delivey fee payment type</option>
                                                @foreach(payment_types() as $paymentype)
                                                    <option  value="{{ $paymentype['PaymentType'] }}">{{ $paymentype['PaymentType'] =='pay on delivery' ? 'Receiver will pay for shipping cost':'Sender will pay for shipping cost' }}</option>
                                                @endforeach
                                            </select>
                                            @error('delivery_cost_payer')
                                            <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                      
                                </div>
                            </div>
                            
                            <div class="group-wrap"> 
                                <div class="col-md-12">
                                    <h4>Shipping Fee Per Item Size</h4>
                                </div>
                                <div class="row req-description">
                                    <div class="col-md-4">
                                        <div class="form-group radio-group">                                              
                                            <input class="form-check-input" type="radio" name="weight" id="weight1" value="1" style="margin-left: 5px;" required/> 
                                            <label class="form-check-label" for="weight1">
                                                <span class="desc">SMALL</span>
                                                <span class="desc-price">N800</span>
                                            </label>                                      
                                        </div>
                                        <div class="{{ $errors->has('show_address') ? ' has-danger' : '' }}"></div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group radio-group">
                                            <input class="form-check-input" type="radio" name="weight" id="weight2" value="2" style="margin-left: 5px;" required>
                                            <label class="form-check-label" for="weight2">
                                                <span class="desc">MEDIUM</span>
                                                <span class="desc-price">N1,500</span>
                                            </label>
                                        </div>
                                        <div class="{{ $errors->has('type') ? ' has-danger' : '' }} "></div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group radio-group">
                                            <input class="form-check-input" type="radio" name="weight" id="weight3" value="4" style="margin-left: 5px;" required>
                                            <label class="form-check-label" for="weight3">
                                                <span class="desc">LARGE</span>
                                                <span class="desc-price">N2,000</span>
                                            </label>
                                        </div>
                                        <div class="{{ $errors->has('delivery_cost_payer') ? ' has-danger' : '' }}"></div>
                                    </div>
                                </div>
                                @error('weight')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                                <div class="col-md-12">
                       
                                    <label class="form-info"> <small>Please note that pickup or delivery in outskirt locations will attract extra charges</small> </label>
                                </div>
                            </div>


                            <div class="row group-wrap">

                                <div class="col-md-12 image-upload">
                                    <label class="form-control-label" for="image_upload">{{ __('Photos') }} (Optional)</label>
                                    <input id="image_upload" type="file" name="photos[112211][image_url]"  class="form-control">
                                </div>
                    
                                <div style="clear:both"></div>

                                <div id="photoContainer"></div>   
                          
                                <div style="clear:both"></div>

                                <div class="form-group">
                                    <button type="button" id="addMorePhoto" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i>  Add more photo</button>
                                </div>

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
        
        {{--@include('layouts.footers.auth') --}}
    </div>
</div>
@endsection