@extends('layouts.app-blue', ['pageSlug' => ''])

@section('content')
     
                <div class="card">
                    <div class="card-header bs-padded">
                        <div class="row align-items-center">
                            <div class="col-8 col-left">    
                                <h2>Supply of {{ $getRequest->category ? $getRequest->category->title : ''}}</h2>
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
                    <div class="card-body request-card" style="background-image:url({{ asset('white') }}/img/give.jpg);">
                       <div class="row">
                          <div class="col-md-8">
                            <div class="group-wrap">
                              <div class="user-request-card">
                                  <div class="request-title">

                                    <h3>Welcome to my page - 
                                      <strong>{{ $getRequest->user->username }}</strong>
                                    </h3>

                                      I want to provide {{ $getRequest->category ? $getRequest->category->title : '' }} ({{ $getRequest->description }}) around {{ ucfirst(Str::lower($getRequest->api_city))}} {{ ucfirst(Str::lower($getRequest->api_state))}} ({{ $getRequest->street }})
                                    <div class="request-detail size-wrap">
                                      Item Size: {{itemSize($getRequest->weight)}}
                                    </div>

                                    <div class="request-detail delivery-fee-wrap">
                                      Delivery Fee Payer: <strong class="text-danger">{{$getRequest->delivery_cost_payer =='prepaid' ? 'Sender will pay for Shipping cost':'Receiver will pay for Shipping cost'}}</strong>
                                    </div>
                                  </div>

                                  <div class="photos-wrap">
                                    @auth
                                      <h4>Sample photos {{authUser()->id == $getRequest->user->id ?  'and users that applied to get your help':''}}</h4>
                                    @endauth

                                  <!--Tab Gallery: The expanding image container -->
                                    <div class="container" style="display: none;">                                      
                                      <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>    
                                      <img id="expandedImg" style="width:500px; height: 400px;">
                                      <div id="imgtext"></div>
                                    </div>
                                
                                    @foreach($request_photos as $photo)                  
                                    <div class="column">
                                      <img src="{{$photo->image_url}}" onclick="myFunction(this);" alt="Sample image" style="width: 50px;">
                                    </div>                                    
                                    @endforeach
                                  </div>
                  
                                  @if(auth()->check())
                                  <!-- show all users that want this help -->
                                  @if(authUser()->id == $getRequest->user->id)

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
                                          <td>{{$bid->bidder ? $bid->bidder->name : 'N/A'}} 
                                              {{$bid->bidder ? $bid->bidder->last_name : 'N/A'}}
                                          </td>
                                          <td>{{$bid->bidder ? providerDetail($getRequest->id,$bid->bidder->id)['api_city'] : 'N/A'}} </td>
                                          <td>

                                            @if($bid->bidder) 
                                            @foreach(deliveryFee($getRequest->api_city,providerDetail($getRequest->id,$bid->bidder->id)['api_city'],$getRequest->weight,providerDetail($getRequest->id,$bid->bidder->id)['api_delivery_town_id']) as $fee)
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
                                       <a href="{{route('request.approve',[$bid->id])}}">
                                            <button class="btn btn-sm btn-success btn-custom"><i class="fa fa-eye" title="View"></i></button>
                                            </a>
                                          </td>
                                         
                                        </tr>
                                       @endforeach
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                                  @endif 


                            @if(user_already_contacted_help_provider($getRequest->user_id,$getRequest->id,auth()->user()->id,'Provide Help'))
                                <p style="color:red"> 
                                </p>
                                <span style="font-size: 20px;">Request Status: <strong>{{user_already_contacted_help_provider($getRequest->user_id,$getRequest->id,auth()->user()->id,'Provide Help')['status']}}</strong></span>
                            @else
                                @if($getRequest->user_id != auth()->user()->id)
                                
                                        @if($getRequest->request_type == 2)

                                     <div class="text-left card-btn">
                                       
                         <form class="form" method="post" action="{{ route('request.apply') }}">
                            @csrf
                          <div class="form-group">
                            <input type="hidden" name="request_id" class="form-control" id="request_id" value="{{$getRequest->id}}" >
                              @error('request_id')
                    <small style="color: red; font-size: 14px;"> {{ $message }}</small>
                    @enderror
                          </div>

                           <div class="form-group">
                            <input type="hidden" name="requester_id" class="form-control" id="request_id" value="{{$getRequest->user_id}}" >
                               @error('requester_id')
                    <small style="color: red; font-size: 14px;"> {{ $message }}</small>
                    @enderror
                          </div>
<br>
                          <div class="form-group">
                            <input type="hidden" name="request_type" class="form-control" id="request_type" value="Provide Help" >
                               @error('request_type')
                    <small style="color: red; font-size: 14px;"> {{ $message }}</small>
                    @enderror
                          </div>
<br>
                           <h4 style="margin-left: 200px;">Delivery Location</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
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
                                            <div class="form-group">
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
                                            <div class="form-group">
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
                                            <div class="form-group">
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

                                       <div class="form-group">
                                          <!-- <label for="exampleInputEmail1">Comment (Optional)</label> -->
                                          <textarea type="text" name="comment" class="form-control" id="delievery_cost" value="3500" placeholder="Type a comment (Optional)" ></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-custom">
                                            Contact  {{ $getRequest->user->username }}
                                        </button>
                                    </form>
                                    </div>
                                   @endif
                                @endif
                            @endif
                        @else
                            <div class="text-left card-btn">
                                <a onclick="alert('please login to contact this person')" href="{{route('login')}}" class="btn btn-sm btn-primary btn-header">Contact  {{ $getRequest->user->username }}</a>

                            </div>
                        @endif 
                        </div>
               
                    </div>
                    </div>
                            @if(auth()->check())
                            <div class="col-md-4 float-right">
                                <div class="suggestion">
                                    <h4>Suggestions</h4>
                                    @foreach($suggestions as $suggestion)
                                        <div class="suggestion-area" style="width: 100%;">
                                        
                                            <a href="{{ route('auth_view.make.request', [$id=$suggestion->id]) }}">
                                                <h4 class="name">{{ $suggestion->user->username }}<br> <span class="float-left">{{ $suggestion->category ? $suggestion->category->title : '' }} </span>
                                                </h4>    
                                                <br>                                        
                                                <div class="memo desc">{{ Str::words($suggestion->description,7) }} </div>
                                                <div class="desc">State: <span>{{ $suggestion->api_state ? $suggestion->api_state : "Undefined" }} </span></div>
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
@endsection
