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
                                    <p>I require <strong>{{ $getRequest->category ? $getRequest->category->title : '' }}</strong> around <strong>{{ $getRequest->api_city }}, {{ $getRequest->api_state }}</strong>. I am willing to pay for it.</p>
                                        @if($getRequest->show_phone == 1)
                                            <p>Kindly call me on <i>
                                                <strong>{{ $getRequest->user->phone }}</strong></i></p>
                                        @else
                                            <p>Kindly contact me through this platform
                                        @endif
                                             for <b>sale of</b> <b>{{ $getRequest->category ? $getRequest->category->title : '' }}({{ $getRequest->description }})</b> at affordable prices around <i>{{ $getRequest->api_city}}, {{ $getRequest->api_state}}</i>.
                                        </p>
                                        <p> <strong>{{ $getRequest->user->username }}</strong></p> 
                                        @if($getRequest->show_address == 1)
                                            <p>Address: {{ $getRequest->street }}</p>
                                        @endif
                                    @else
                                    <!-- <h1>Requesting for free service</h1> -->
                                <h3>Welcome to my page - <strong>{{ $getRequest->user->username }}</strong></h3>
                                <div class="user-request-card">
                                        <p>I require <strong>{{ $getRequest->category ? $getRequest->category->title : '' }}({{$getRequest->description}})</strong> around <strong>{{ $getRequest->api_city }}, {{ $getRequest->api_state }}</strong> for free.</p>
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

                  @if(isset($request_photos) && $request_photos !='')

                <!--Tab Gallery: The expanding image container -->
                  <div class="container" style="display: none;">
                    <!-- Close the image -->
                    <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>

                    <!-- Expanded image -->
                    <img id="expandedImg" style="width:100%; height: 400px;">

                    <!-- Image text -->
                    <div id="imgtext"></div>
                  </div>
                                @foreach($request_photos as $photo)

                    <!-- The grid:-->
                    <div class="column">
                     <!--  <img src="img_nature.jpg" alt="Nature" > -->
                      <img src="{{$photo->image_url}}" onclick="myFunction(this);" alt="Sample image">
                    </div>
                    
                    @endforeach
                  
               @endif
                                </div>

                                          <!-- Check if the person is logged in -->
                        @if(auth()->check())
                        <!-- show all users that want this help -->
                         @if(authUser()->id == $getRequest->user->id)
                        <h3 style="margin-top: 20px;">Users interested to provide the above request</h3>
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
                        <td>{{$bid->requester ? $bid->requester->name : 'N/A'}} 
                            {{$bid->requester ? $bid->requester->last_name : 'N/A'}}
                        </td>
                        <td>{{$bid->requester ? $bid->requester->phone : 'N/A'}} </td>
                        <td>{{$bid->requester ? $bid->requester->email : 'N/A'}} </td>
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
                                <p style="color:red">You have previously contacted this user</p>
                                <span>Request Status: <strong>{{user_already_contacted_help_seeker(authUser()->id,$getRequest->id,$getRequest->user_id,'Get Help')['status']}}</strong>
                              @if(user_already_contacted_help_seeker(authUser()->id,$getRequest->id,$getRequest->user_id,'Get Help')['status'] == 'Approved')
                                <a href="{{route('request.approve',[user_already_contacted_help_seeker(authUser()->id,$getRequest->id,$getRequest->user_id,'Get Help')['id']])}}">Submit pickup request</a>
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
                                            <div class="form-group{{ $errors->has('delivery_cost_payer') ? ' has-danger' : '' }}">
                                                <strong><label class="form-control-label" for="delivery_cost_payer">{{ __('Delivery fee Payment Type') }}</label></strong>
                                                <select name="delivery_cost_payer" id="delivery_cost_payer" class="form-control" required>
                                                    <option value="">Select delivey fee payment type</option>
                                                    @foreach(payment_types() as $paymentype)
                                                        <option  value="{{ $paymentype['PaymentType'] }}">{{ $paymentype['PaymentType'] }}</option>
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
                                    <button type="button" id="addMorePhoto" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i>  Add more photo</button>
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
                                <a onclick="alert('please login to contact this person')" href="{{route('login')}}" class="btn btn-sm btn-primary btn-header">Contact  {{ $getRequest->user->username ? $getRequest->user->username : $getRequest->user->company_name }}</a>
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
