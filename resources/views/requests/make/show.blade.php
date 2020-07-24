@extends('layouts.app', ['pageSlug' => 'Requests'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header list-header">
                        <div class="row align-items-center">
                            <div class="col-8">    

                                <h3 class="text-white">Request for  {{ $getRequest->category ? $getRequest->category->title : '' }}</h3>  
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
                        <div class="column-one">
                            @if($getRequest->type == "paid" || $getRequest->type == "Paid")
                                <!-- <h1>Requesting for paid service</h1> -->
                                <h3>Welcome to my page - <strong>{{ $getRequest->user->username }}</strong></h3>
                                <div class="user-request-card">
                                    <p>I require <strong>{{ $getRequest->category ? $getRequest->category->title : '' }}</strong> around <strong>{{ $getRequest->city->name }}, {{ $getRequest->state->name }}</strong>. I am willing to pay for it.</p>
                                        @if($getRequest->show_phone == 1)
                                            <p>Kindly call me on <i>
                                                <strong>{{ $getRequest->user->phone }}</strong></i></p>
                                        @else
                                            <p>Kindly contact me through this platform
                                        @endif
                                             for <b>sale of</b> <b>{{ $getRequest->category ? $getRequest->category->title : '' }}({{ $getRequest->description }})</b> at affordable prices around <i>{{ $getRequest->city->name }}, {{ $getRequest->state->name }}</i>.
                                        </p>
                                        <p> <strong>{{ $getRequest->user->username }}</strong></p> 
                                        @if($getRequest->show_address == 1)
                                            <p>Address: {{ $getRequest->street }}</p>
                                        @endif
                                    @else
                                    <!-- <h1>Requesting for free service</h1> -->
                                <h3>Welcome to my page - <strong>{{ $getRequest->user->username }}</strong></h3>
                                <div class="user-request-card">
                                        <p>I require <strong>{{ $getRequest->category ? $getRequest->category->title : '' }}({{$getRequest->description}})</strong> around <strong>{{ $getRequest->city->name }}, {{ $getRequest->state->name }}</strong> for free.</p>
                                        @if($getRequest->show_phone == 1)
                                            <p>Kindly call me on
                                                <strong>{{ $getRequest->user->phone }}</strong>  
                                        @else
                                            <p>Kindly contact me through this platform
                                        @endif
                                        </p>
                                        <p><strong>{{ $getRequest->user->username }}</strong></p> 
                                        @if($getRequest->show_address == 1)
                                            <p>Address: {{ $getRequest->street }}</p>
                                        @endif
                                    @endif
                                </div>
                                   <!-- Check if the person is logged in -->
                        @if(auth()->check())
                            @if(in_array(auth()->user()->id, $checkIfContacted))
                                <p style="color:red">You have previously contacted this user</p>
                            @else
                                @if($getRequest->user_id != auth()->user()->id)
                                        @if($getRequest->request_type == 1)
                                     <div class="text-left card-btn">
                                       
                         <form class="form" method="post" action="{{ route('request.provide') }}">
                            @csrf
                          <div class="form-group">
                            <label for="exampleInputEmail1">Reqest id</label>
                            <input type="text" name="request_id" class="form-control" id="request_id" value="{{$getRequest->id}}" >
                          </div>

                           <div class="form-group">
                            <label for="exampleInputtext1">Reqester id</label>
                            <input type="text" name="requester_id" class="form-control" id="request_id" value="{{$getRequest->user_id}}" >
                          </div>

                          <div class="form-group">
                            <label for="exampleInputtext1">Request type</label>
                            <input type="text" name="request_type" class="form-control" id="request_type" value="Get Help" >
                          </div>

                            <div class="form-group">
                            <label for="exampleInputEmail1">Logistic Partner</label>
                            <small id="emailHelp" class="form-text text-muted">Please choose a logistic company to deliever this product to the beneficiary</small>
                             <select name="logistic_partner_id" id="logistic_partner_id" class="form-control productCategory" required >
                                        <option value="">Choose logistic partner </option>
                                        @foreach(getLogisticPartners() as $logistic)
                                            <option value="{{ $logistic->id }}">{{ $logistic->company_name }} | {{ $logistic->city ? $logistic->city->name : 'N/A' }}</option>
                                        @endforeach
                                    </select>
                                    
                    @error('logistic_partner_id')
                    <small style="color: red; font-size: 14px;"> {{ $message }}</small>
                    @enderror
                          </div>

                     <div class="form-group">
                            <label for="exampleInputEmail1">Delievery cost</label>
                            <input type="number" name="delievery_cost" class="form-control" id="delievery_cost" value="3500" >
                          </div>
                     <div class="form-group">
                            <label for="exampleInputEmail1">Commet (Optional)</label>
                            <textarea type="text" name="comment" class="form-control" id="delievery_cost" value="3500" placeholder="type a comment" ></textarea>
                          </div>
                         
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                                    </div>
                                   @endif
                                @endif
                            @endif
                        @else
                            <div class="text-left card-btn">
                                <a onclick="alert('please login to contact this person')" href="{{ route('send.requestDetails', $id=[$getRequest->id]) }}" class="btn btn-sm btn-primary btn-header">Contact  {{ $getRequest->user->username }}</a>

                            </div>
                        @endif 
                        </div>
                        <!-- Render suggestion if authenticated -->
                        @if(auth()->check())
                            <div class="column-two">
                                <div class="suggestion">
                                    <h4>Suggestions</h4>
                                    @foreach($suggestions as $suggestion)
                                        <div class="suggestion-area">
                                        
                                            <a href="{{ route('auth_view.provide.request', [$id=$suggestion->id]) }}">
                                        
                                                <h4 class="name">{{ $suggestion->user->username }} <span class="cat memo memo2">{{ $suggestion->category ? $suggestion->category->title : ''}} </span></h4>                                            
                                                <div class="memo desc">{{ $suggestion->description }} </div>
                                                <div class="desc">State: <span>{{ $suggestion->state->name }} </span></div>
                                            </a>
                                        </div>
                                        <br>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Check if the person is logged in -->
                        @if(auth()->check())
                            @if(in_array(auth()->user()->id, $checkIfContacted))
                                <p style="color:red">You have previously contacted this user</p>
                            @else
                                @if($getRequest->user_id != auth()->user()->id)
                                    <div class="text-left card-btn">
                                        <a href="{{ route('send.requestDetails', $id=[$getRequest->id]) }}" onclick="disableButton()" id="email" class="btn btn-sm btn-primary btn-header">Contact {{ $getRequest->user->username }}</a>
                                    </div>
                                @endif
                            @endif
                        @else
                            <div class="text-left card-btn">
                                <a onclick="alert('please login to contact this person')" href="{{ route('send.requestDetails', $id=[$getRequest->id]) }}" class="btn btn-sm btn-primary btn-header">Contact  {{ $getRequest->user->username }}</a>

                            </div>
                        @endif  


                    </div>                       
                </div>
            </div>
        </div>
    </div>
    
@endsection
