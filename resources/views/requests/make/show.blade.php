@extends('layouts.app-blue', ['pageSlug' => 'Requests'])

@section('content')
     <div class="page-wrap">
        <div class="container">
            <div class="row">
                
              <div class="col-md-12 content-wrapper pt-40 pb-40">
                <div class="card">
                    <div class="card-header bs-padded">
                        <div class="row align-items-center">
                            <div class="col-8 col-left">    

                                <h2>Request for  {{ $getRequest->category ? $getRequest->category->title : '' }}</h2>  
                            </div>
                            <div class="col-4 text-right">
                                @if(auth()->check())
                                    <a href="{{ route('requests') }}" class="btn btn-dark">{{ __('Back to list') }}</a>
                                @else
                                    <a href="{{ route('home.landingpage') }}" class="btn btn-dark">{{ __('Back to list') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body request-card column-card" style="background-image:url({{ asset('white') }}/img/give.jpg);">
                      <div class="row">
                      <div class="col-md-8 float-left">
                            <div class="group-wrap">
                              <div class="user-request-card">
                                  <div class="request-title">
                                    <h3>Welcome to my page - 
                                      <strong>{{ $getRequest->user->username }}</strong>
                                    </h3>
                                   
                                        I need {{ $getRequest->category ? $getRequest->category->title : '' }} ({{ $getRequest->description }}) around {{ ucfirst(Str::lower($getRequest->api_city))}} {{ ucfirst(Str::lower($getRequest->api_state))}} ({{ $getRequest->street }})

                                    @auth
                                        @if($requestBid)
                                           <div class="request-detail size-wrap">
                                      Item Size: {{itemSize($requestBid->weight)}}
                                    </div>

                                    <div class="request-detail delivery-fee-wrap">
                                      Delivery Fee Payer: <strong class="text-danger">{{$requestBid->payment_type =='prepaid' ? 'Help Provider will pay for Shipping fee':'Help Receiver will pay for Shipping fee'}}</strong>
                                    </div>

                                    @endauth
                                  @endif
                                  </div>   
                                  
                                  @if(auth()->check())
                                    @if(authUser()->id == $getRequest->user->id)

                                    <div class="group-wraps wrap-2">
                                        <h4 class="mt-20">Users interested to provide the above request</h4>
                                        <div class="table-responsive">
                                            <table class="table tablesorter" id="requests">
                                              <thead class=" text-primary">
                                                 <tr>
                                                <th> Full name </th>
                                                <th> City </th>
                                                <th> Delivery Cost </th>
                                                <th> Status </th>
                                                <th> Actions </th>
                                                  </tr>
                                               
                                              </thead>
                                              <tbody>
                       
                                                  @foreach($help_request_bidders as $bid)

                                                  <tr>

                                                    <td>{{$bid->requester ? $bid->requester->name : 'N/A'}} 
                                                        {{$bid->requester ? $bid->requester->last_name : 'N/A'}}
                                                    </td>
                                                    <td>{{$bid->requester ? providerDetail($getRequest->id,$bid->requester->id)['api_city'] : 'N/A'}} </td>
                                                    <td>

                                                      @if($bid->requester) 
                                                        @foreach(deliveryFee($getRequest->api_city,providerDetail($getRequest->id,$bid->requester->id)['api_city'],$getRequest->weight,providerDetail($getRequest->id,$bid->requester->id)['api_delivery_town_id']) as $fee)
                                                         &#8358;{{$fee['TotalAmount']}}
                                                        @endforeach
                                                      @endif
                                                    </td>
                                                    <td>
                                                        @if($bid->status == 'Approved')
                                                       <span class="approved">{{$bid->status}}</span>  
                                                        @elseif($bid->status =='Pending')
                                                       <span class="pending">{{$bid->status}}</span>
                                                       @elseif($bid->status == 'Delivered')
                                                       <span class="delivered">{{$bid->status}}</span>  
                                                        @elseif($bid->status == 'Rejected')
                                                       <span class="error">{{$bid->status}}</span>  
                                                       @endif

                                                    </td>
                       
                                                    <td>
                                                        <a href="{{route('request.approve_or_reject',[$bid->id])}}">
                                                          <button class="btn btn-sm btn-success"><i class="fa fa-eye" title="View"></i></button>
                                                        </a>
                                                    </td>
                         
                                                  </tr>
                       
                                                  @endforeach
                                                </tbody>
                                              </table>
                                            </div>
                                       @endif
                                      @endif
                                    </div>
                                     <!-- Check if the person is logged in -->
                                      @if(auth()->check())

                                        @if(user_already_contacted_help_seeker(authUser()->id,$getRequest->id,$getRequest->user_id,'Get Help'))

                                        <p class="error"></p>
                                        <span style="font-size: 20px;">Request Status: <strong>{{user_already_contacted_help_seeker(authUser()->id,$getRequest->id,$getRequest->user_id,'Get Help')['status']}} </strong>
                                        </span>
                                
                                          @if(user_already_contacted_help_seeker(authUser()->id,$getRequest->id,$getRequest->user_id,'Get Help')['status'] == 'Approved') and pickup request sent.
                                          <br>
                                          <br>
                            
                 @php
                    $get_pickup_request = helpProviderPickupRequestDetails($requestBid->requester_id, $getRequest->id, $requestBid->bidder_id);
                 @endphp   

                      Payment Status:  {{$get_pickup_request->PaymentRef ? paymentStatus($get_pickup_request->PaymentRef) : 'N/A'}}

                 @if($requestBid->payment_type =='prepaid')
                  <form action="{{route('initiate_shipping_fee_payment')}}" method="post">
                                  @csrf
                    <input type="hidden" name="waybillNo" value="{{helpProviderPickupRequestDetails($requestBid->requester_id, $getRequest->id, $requestBid->bidder_id)['WaybillNumber']}}">

                    <input type="hidden" name="pickupRequest_id" value="{{helpProviderPickupRequestDetails($requestBid->requester_id, $getRequest->id, $requestBid->bidder_id)['id']}}">

                        <button type="submit" class="btn btn-success">Pay shipping fee</button>
                    </form>
                 @endif
                              <br>
                              <br>

                              <h2>Pickup Request Details</h2>
                             @include('inc.pickupRequestDetails')  
                @endif
                        @else
                                          @if($getRequest->user_id != auth()->user()->id)
                                            @if($getRequest->request_type == 1)

                                       <div class="group-wrap">
       <h2>Fill the following form to contact {{ $getRequest->user->name }} {{ $getRequest->user->last_name }}</h2>
    <br>
                                          <form class="form" method="post" action="{{ route('request.provide') }}" enctype="multipart/form-data">
                                          @csrf
                                              <div class="form-group">
                                                <input type="hidden" name="request_id" class="form-control" id="request_id" value="{{$getRequest->id}}" >
                                              </div>

                                               <div class="form-group">
                                                <input type="hidden" name="requester_id" class="form-control" id="request_id" value="{{authUser()->id}}" >
                                              </div>

                                                <div class="form-group">
                                                <input type="hidden" name="bidder_id" class="form-control" id="request_id" value="{{$getRequest->user_id}}" >
                                              </div>

                                              <div class="form-group">
                                                <input type="hidden" name="request_type" class="form-control" id="request_type" value="Get Help" >
                                              </div>

                                              <div class="row req-description">
                                                <h4 class="full-width bs-padded">Shipping Fee Per Item Size </small></h4>
                                                  <div class="col-md-4">
                                                      <div class="form-group radio-group {{ $errors->has('show_address') ? ' has-danger' : '' }}">                                              
                                                          <input class="form-check-input" type="radio" name="weight" id="weight1" value="1" style="margin-left: 5px;" required/> 
                                                          <label class="form-check-label" for="weight1">
                                                              <span class="desc">SMALL</span>
                                                              <span class="desc-price">N800</span>
                                                          </label>                                      
                                                      </div>
                                                  </div>

                                                  <div class="col-md-4">
                                                      <div class="form-group radio-group {{ $errors->has('show_address') ? ' has-danger' : '' }}">
                                                          <input class="form-check-input" type="radio" name="weight" id="weight2" value="2" style="margin-left: 5px;" required>
                                                          <label class="form-check-label" for="weight2">
                                                              <span class="desc">MEDIUM</span>
                                                              <span class="desc-price">N1,200</span>
                                                          </label>
                                                      </div>
                                                  </div>

                                                  <div class="col-md-4">
                                                      <div class="form-group radio-group {{ $errors->has('show_address') ? ' has-danger' : '' }}">
                                                          <input class="form-check-input" type="radio" name="weight" id="weight3" value="4" style="margin-left: 5px;" required>
                                                          <label class="form-check-label" for="weight3">
                                                              <span class="desc">LARGE</span>
                                                              <span class="desc-price">N2,000</span>
                                                          </label>
                                                      </div>
                                                  </div>
                                              </div>

                                              <div class="col-md-12">
                                     
                                                  <label class="form-info"> <small>Please note that pickup or delivery in outskirt locations will attract extra charges</small> </label>
                                              </div>                                
                                          </div>

                                          <hr />

                                          <h4>Pickup Location</h4>

                                          <div class="row">
                                              <div class="col-md-6">
                                                  <div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">
                                                      <strong><label class="form-check-label" for="api_state_id">{{ __('State') }}</label></strong>
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
                                          <!-- </div>

                                          <div class="row"> -->
                                              <div class="col-md-6">
                                                  <div class="form-group{{ $errors->has('api_onforwarding_town_id') ? ' has-danger' : '' }}">
                                                      <strong><label class="form-control-label" for="api_onforwarding_town_id">{{ __('Delivery Town') }}</label></strong>
                                                      <select name="api_onforwarding_town_id" id="api_onforwarding_town_id" class="form-control" required>
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
                                          <input type="hidden" name="receiver_state" id="receiver_state" value="{{$getRequest->api_state}}">
                                          <div class="row">
                                               <div class="col-md-12">
                                                  <div class="form-group{{ $errors->has('delivery_cost_payer') ? ' has-danger' : '' }}">
                                                      <strong><label class="form-control-label" for="delivery_cost_payer">{{ __('Who will pay delivery cost') }}</label></strong>
                                                      <select name="delivery_cost_payer" id="delivery_cost_payer" class="form-control" required>
                                                          <option value="">Select delivey fee payer</option>
                                                          @foreach(payment_types() as $paymentype)
                                                              <option  value="{{ $paymentype['PaymentType'] }}">{{ $paymentype['PaymentType'] =='pay on delivery' ? 'Receiver will pay for shipping cost':'Sender will pay for shipping cost' }}</option>
                                                          @endforeach
                                                      </select>
                                                     
                                                  </div>
                                              </div>
                                          </div>

                                          <div class="row">
                 
                                            <div class="col-md-12">
                                                <label class="form-control-label" for="input-property_type">{{ __('Photos') }} (Optional)</label>
                                                <input type="file" name="photos[112211][image_url]"  class="form-control">
                                            </div>
                                        
                                            <div style="clear:both"></div>
                                            <div id="photoContainer" class="col-md-12"></div>   
                     
                                          </div>

                                          <div style="clear:both"></div>

                                          <div class="form-group">
                                              <button type="button" id="addMorePhoto" class="btn btn-primary"><i class="fa fa-plus-circle"></i>  Add more photo</button>
                                          </div>
                              
                                          <div style="clear:both"></div>

                         
                                          <div class="form-group">
                                              <label for="exampleInputEmail1">Comment (Optional)</label>
                                              <textarea type="text" name="comment" class="form-control" id="delievery_cost" value="3500" placeholder="type a comment" ></textarea>
                                          </div>
                           
                                          <button type="submit" class="btn btn-primary">Contact {{ $getRequest->user->username }}</button>
                                        </form>
                                      </div>
                                     @endif
                                  @endif
                              @endif
                                @else
                                <div class="text-left card-btn">
                                    <a onclick="alert('please login to contact this person')" href="{{route('login')}}" class="btn btn-sm btn-primary btn-custom">Contact  {{ $getRequest->user->username ? $getRequest->user->username : $getRequest->user->company_name }}</a>
                                </div>
                                @endif 
                              </div>
                            
                            <!--</div>-->
                        

                          <!-- Render suggestion if authenticated -->
                        @if(auth()->check())
                        <div class="col-md-4 float-right">
                            <div class="suggestion">
                                <h4>Suggestions</h4>
                                @foreach($suggestions as $suggestion)
                                    <div class="suggestion-area">                                    
                                        <a href="{{ route('auth_view.provide.request', [$id=$suggestion->id]) }}">                   
                                            <h4 class="name">{{ strtolower($suggestion->user->username) }}
                                              <span>{{ $suggestion->category ? $suggestion->category->title : ''}}</span>
                                            </h4>
                                            <br>                                            
                                            <div class="memo desc">{{Str::words( $suggestion->description,7) }} </div>
                                            <div class="desc">State: <span>{{ $suggestion->api_state ? $suggestion->api_state : 'Undefined' }} </span></div>
                                        </a>
                                    </div>
                                    <br>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        </div>   
                    </div>                   
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
    
@endsection
