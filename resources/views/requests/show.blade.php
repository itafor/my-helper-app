@extends('layouts.app', ['pageSlug' => ''])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header list-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="text-white">Supply of {{ $getRequest->category ? $getRequest->category->title : ''}}</h3>
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
                                <h3>Welcome to my page - <strong>{{ $getRequest->user->username }}</strong></h3>
                                    <div class="user-request-card">
                                        <p>
                                        @if($getRequest->show_phone == 1)
                                            Please call me on 
                                            <strong>
                                                    {{ $getRequest->user->phone }}</strong>
                                                @else
                                                    Kindly contact me through this platform
                                                @endif
                                             for <b>sale </b>of <strong>{{ $getRequest->category ? $getRequest->category->title : '' }} - {{ $getRequest->description }}</strong> at affordable prices around <strong>{{ $getRequest->city->name }}, {{ $getRequest->state->name }}</strong>.
                                        </p>
                                        <p>Thank you for your patronage</p>
                                        <p><strong>{{ $getRequest->user->username }}</strong></p> 
                                        @if($getRequest->show_address == 1)
                                            <p>Address: {{ $getRequest->street }}</p>
                                        @endif
                                     @else

                                    <h3>Welcome to my page - <strong>{{ $getRequest->user->username }}</strong></h3>
                                    @if($getRequest->show_phone == 1)
                                    <div class="user-request-card">
                                        <p>Please call me on 
                                        <strong>
                                                {{ $getRequest->user->phone }}
                                            @else
                                                <p>Kindly contact me through this platform
                                            @endif
                                        </strong>for <b>free</b> <strong>{{ $getRequest->category ? $getRequest->category->title : '' }} - ({{ $getRequest->description }})</strong> around <strong>{{ $getRequest->city->name }}, {{ $getRequest->state->name }}</strong>.
                                    
                                    </p>
                                    <p>Thank you</p>
                                    <p><strong>{{ $getRequest->user->username }}</strong></p> 
                                    @if($getRequest->show_address == 1)
                                        <p>Address: {{ $getRequest->street }}</p>
                                    @endif
                                @endif
                            </div>
                                <!-- Check if the person is logged in -->
                        @if(auth()->check())
                        <!-- show all users that want this help -->
                         @if(authUser()->id == $getRequest->user->id)
                        <h3 style="margin-top: 20px;">Users that applied to get your help</h3>
            <div class="table-responsive">
                  <table class="table tablesorter" id="requests">
                    <thead class=" text-primary">
                       <tr>
                      <th> Full name </th>
                      <th> Phone </th>
                      <th> Email </th>
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
                        <td>{{$bid->bidder ? $bid->bidder->phone : 'N/A'}} </td>
                        <td>{{$bid->bidder ? $bid->bidder->email : 'N/A'}} </td>
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
                          <button class="btn btn-sm btn-success"><i class="fa fa-eye" title="View"></i></button>
                          </a>
                        </td>
                       
                      </tr>
                     @endforeach
                    </tbody>
                  </table>
                </div>
                        @endif 

                            @if(user_already_contacted_help_provider($getRequest->user_id,$getRequest->id,auth()->user()->id,'Provide Help'))
                                <p style="color:red">You have previously contacted this user 
                                </p>
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

                          <div class="form-group">
                            <input type="hidden" name="request_type" class="form-control" id="request_type" value="Provide Help" >
                               @error('request_type')
                    <small style="color: red; font-size: 14px;"> {{ $message }}</small>
                    @enderror
                          </div>
                         <div class="form-group">
                            <label for="exampleInputEmail1">Comment (Optional)</label>
                            <textarea type="text" name="comment" class="form-control" id="delievery_cost" value="3500" placeholder="type a comment" ></textarea>
                          </div>
                          <button type="submit" class="btn btn-primary btn-header">
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
                        @if(auth()->check())
                            <div class="column-two">
                                <div class="suggestion">
                                    <h4>Suggestions</h4>
                                    @foreach($suggestions as $suggestion)
                                        <div class="suggestion-area">
                                        <!-- Render different URLs if they are guests or not -->
                                        <!-- Link to the get help page -->
                                            <a href="{{ route('auth_view.make.request', [$id=$suggestion->id]) }}">
                                                <h4 class="name">{{ $suggestion->user->username }} <span class="cat memo memo2">{{ $suggestion->category ? $suggestion->category->title : '' }} </span></h4>                                            
                                                <div class="memo desc">{{ $suggestion->description }} </div>
                                                <div class="desc">State: <span>{{ $suggestion->state->name }} </span></div>
                                            </a>
                                        </div>
                                        <br>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <!-- </div> -->
                    <!--     @if(auth()->check())
                            @if(in_array(auth()->user()->id, $checkIfContacted))
                                <p style="color:red">You have previously contacted this user</p>
                            @else
                                @if($getRequest->user_id != auth()->user()->id)
                                    <div class="text-left card-btn">
                                    <a onclick="disableButton()" id="email" href="{{ route('send.provideDetails', $id=[$getRequest->id]) }}" class="btn btn-sm btn-primary btn-header">Contact {{ $getRequest->user->username }}</a>
                                    </div>
                                @endif
                            @endif
                        @else
                            <div class="text-left card-btn">
                                <a onclick="alert('please login to contact this person')" href="{{ route('send.provideDetails', $id=[$getRequest->id]) }}" class="btn btn-sm btn-primary btn-header">Contact {{ $getRequest->user->username }}</a>
                            </div>
                        @endif   -->
                    <!-- </div>                     -->
                        <!-- <div class="col-4 text-right">
                            <a href="{{ route('show.request', $id=[$getRequest->id]) }}" class="btn btn-sm btn-primary btn-header">{{ __('Contact By Email') }}</a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
