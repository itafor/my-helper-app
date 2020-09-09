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
                    <div class="card-body request-card" style="background-image:url({{ asset('white') }}/img/give.jpg);">
                      <div>
                       <div class="col-md-10 float-left">
                               
                                    <div class="user-request-card">
                                      <label>
                                    <h4>Welcome to my page -{{ $getRequest->user->username }}</h4>
                                      I want to provide {{ $getRequest->category ? $getRequest->category->title : '' }} ({{ $getRequest->description }}) around {{ ucfirst(Str::lower($getRequest->api_city))}} {{ ucfirst(Str::lower($getRequest->api_state))}} ({{ $getRequest->street }})<br><br>
                                      Weight: {{$getRequest->weight}}kg<br><br>

                    Delivery Fee Payer: <strong class="text-danger">{{$getRequest->delivery_cost_payer =='prepaid' ? 'Sender will pay for Shipping cost':'Receiver will pay for Shipping cost'}}</strong><br>
                    </label>

                        <h4>Sample photos {{authUser()->id == $getRequest->user->id ?  'and users that applied to get your help':''}}</h4>

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
                 

                        
                  
                        @if(auth()->check())
                        <!-- show all users that want this help -->
                         @if(authUser()->id == $getRequest->user->id)

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
                                <p style="color:red"> 
                                </p>
                                <span>Request Status: <strong>{{user_already_contacted_help_provider($getRequest->user_id,$getRequest->id,auth()->user()->id,'Provide Help')['status']}}</strong></span>
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
                            <!-- <label for="exampleInputEmail1">Comment (Optional)</label> -->
                            <textarea type="text" name="comment" class="form-control" id="delievery_cost" value="3500" placeholder="Type a comment (Optional)" ></textarea>
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
               
                    </div>

        @if(auth()->check())
                            <div class="col-md-2 float-right">
                                <div class="suggestion">
                                    <h4>Suggestions</h4>
                                    @foreach($suggestions as $suggestion)
                                        <div class="suggestion-area" style="width: 100%;">
                                        
                                            <a href="{{ route('auth_view.make.request', [$id=$suggestion->id]) }}">
                                                <h4 class="name">{{ $suggestion->user->username }}<br> <span class="float-left">{{ $suggestion->category ? $suggestion->category->title : '' }} </span>
                                                </h4>    
                                                <br>                                        
                                                <div class="memo desc">{{ Str::limit($suggestion->description,16) }} </div>
                                                <div class="desc">State: <span>{{ $suggestion->api_state }} </span></div>
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
