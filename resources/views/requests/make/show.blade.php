@extends('layouts.app', ['pageSlug' => 'Requests'])

@section('content')
    <div class="container-fluid mt--7 header-body ">
        <div class="row">
            <div class="col-xl-12 order-xl-1 welcome-cards track-cards">
                <div class="card">
                    <div class="card-header list-header">
                        <div class="row align-items-center">
                            <div class="col-8">    

                                <h4 class="card-title">Request for  {{ $getRequest->category ? $getRequest->category->title : '' }}</h4>  
                            </div>
                            <div class="col-4 text-right">
                                @if(auth()->check())
                                    <a href="{{ route('requests') }}" class="btn btn-sm btn-primary btn-header">{{ __('Back to list') }}</a>
                                @else
                                    <a href="{{ route('home.landingpage') }}" class="btn btn-sm btn-primary btn-header">{{ __('Back to list') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body request-card column-card" style="background-image:url({{ asset('white') }}/img/give.jpg);">
                      <div>
                        <div class="col-md-9 float-left">
                                <div class="user-request-card">

                                <h3>Welcome to my page - <strong>{{ $getRequest->user->username }}</strong></h3>
                                 <label>
                                I need {{ $getRequest->category ? $getRequest->category->title : '' }} ({{ $getRequest->description }}) around {{ ucfirst(Str::lower($getRequest->api_city))}} {{ ucfirst(Str::lower($getRequest->api_state))}} ({{ $getRequest->street }})
                                       </label>   
                        @if(auth()->check())
                         @if(authUser()->id == $getRequest->user->id)
                        <h4 style="margin-top: 20px;">Users interested to provide the above request</h4>
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
                           <span style="color: green; font-size: 14px;">{{$bid->status}}</span>  
                            @elseif($bid->status =='Pending')
                           <span style="color: brown; font-size: 14px;">{{$bid->status}}</span>
                           @elseif($bid->status == 'Delivered')
                           <span style="color: blue; font-size: 14px;">{{$bid->status}}</span>  
                            @elseif($bid->status == 'Rejected')
                           <span style="color: red; font-size: 14px;">{{$bid->status}}</span>  
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
                                   <!-- Check if the person is logged in -->
                        @if(auth()->check())
                @if(user_already_contacted_help_seeker(authUser()->id,$getRequest->id,$getRequest->user_id,'Get Help'))
                                <p style="color:red"></p>
                                <span style="font-size: 20px;">Request Status: <strong>{{user_already_contacted_help_seeker(authUser()->id,$getRequest->id,$getRequest->user_id,'Get Help')['status']}} </strong>
                              @if(user_already_contacted_help_seeker(authUser()->id,$getRequest->id,$getRequest->user_id,'Get Help')['status'] == 'Approved')
                              and pickup request sent.
                               <a href="{{URL::route('pickupRequest.details', [$getRequest->id, authUser()->id, $getRequest->user->id] )}}">
                       View and track shipment status</a>
                              @endif
                                </span>
                            @else
                                @if($getRequest->user_id != auth()->user()->id)
                                        @if($getRequest->request_type == 1)
                                     <div class="text-left card-btn">
                                       
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
                              <h4>Item Size In Weight <small>(and Pickup/delivery price)</small></h4>
                                  <div class="col-md-4">
                                      <div class="form-group{{ $errors->has('show_address') ? ' has-danger' : '' }}">
                                          <input class="form-check-input" type="radio" name="weight" id="weight1" value="3.5" style="margin-left: 5px;" required>
                                          <label class="form-check-label" for="weight1" style="margin-left: 20px;">
                                            <span class="desc">SMALL (3.5 kg)</span>
                                            <span class="desc-price">N800</span>                                     
                                        </label>
                                      </div>
                                  </div>

                                  <div class="col-md-4">
                                      <div class="form-group{{ $errors->has('show_address') ? ' has-danger' : '' }}">
                                          <input class="form-check-input" type="radio" name="weight" id="weight2" value="7.5" style="margin-left: 5px;" required>
                                          <label class="form-check-label" for="weight2" style="margin-left: 20px;">
                                            <span class="desc">MEDIUM (7.5 kg)</span>
                                            <span class="desc-price">N1,500</span>                                     
                                        </label>
                                      </div>
                                  </div>

                                  <div class="col-md-4">
                                      <div class="form-group{{ $errors->has('show_address') ? ' has-danger' : '' }}">
                                          <input class="form-check-input" type="radio" name="weight" id="weight3" value="10.0" style="margin-left: 5px;" required>
                                          <label class="form-check-label" for="weight3" style="margin-left: 20px;">
                                            <span class="desc">LARGE (10.0 kg)</span>
                                            <span class="desc-price">N2,00</span>                                     
                                        </label>
                                      </div>
                                  </div>
                                </div>
                                    <div class="row" style="margin-top: 0px;">
                                        <div class="col-md-12">
                                       <label><small> Please note that pickup or delivery in outskirt locations will attract extral charges</small></label>
                                    </div>
                                    </div>
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
                                <div id="photoContainer" class="col-md-12">
                                </div>   
         
                                    </div>
                                  <div style="clear:both"></div>

                                     <div class="form-group">
                                    <button type="button" id="addMorePhoto" class="btn btn-success btn-custom"><i class="fa fa-plus-circle"></i>  Add more photo</button>
                                </div>
                            
                            <div style="clear:both"></div>

                       
                    <div class="form-group">
                            <label for="exampleInputEmail1">Comment (Optional)</label>
                            <textarea type="text" name="comment" class="form-control" id="delievery_cost" value="3500" placeholder="type a comment" ></textarea>
                          </div>
                         
                          <button type="submit" class="btn btn-primary btn-custom">Contact {{ $getRequest->user->username }}</button>
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

                    </div> 

                          <!-- Render suggestion if authenticated -->
                        @if(auth()->check())
                            <div class="col-md-3 float-right">
                                <div class="suggestion">
                                    <h4>Suggestions</h4>
                                    @foreach($suggestions as $suggestion)
                                        <div class="suggestion-area" style="width: 100%;">
                                        
                                            <a href="{{ route('auth_view.provide.request', [$id=$suggestion->id]) }}">
                                        <label>
                                                <h4 class="name">{{ $suggestion->user->username }}<br> <span class="float-left">{{ $suggestion->category ? $suggestion->category->title : ''}} </span></h4>
                                                <br>                                            
                                                <div class="memo desc">{{Str::limit( $suggestion->description,16) }} </div>
                                                <div class="desc">State: <span>{{ $suggestion->api_state }} </span></div>
                                              </label>
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
    
@endsection
