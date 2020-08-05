@extends('logisticPartner.layouts.master',['pageSlug' => 'logisticPartner_request'])

@section('title')

logistic Partner | Requests

@endsection

@section('content')

  <!-- Grid -->
        <div class="row">

         
                <!-- Tables -->
                <div class="table-responsive">


				            <div class="card">
				  <div class="card-header">
				<div class="float-left">Help seeker details (Receiver)</div>
				
				  </div>
				  <div class="card-body">
				  	<br>
                  <dl class="row">
  <dt class="col-sm-3">Full Name</dt>
  <dd class="col-sm-9">
    {{$request_bidder ? $request_bidder->name : 'N/A'}} 
    {{$request_bidder ? $request_bidder->last_name : 'N/A'}}
  </dd>

  <dt class="col-sm-3">Phone Number</dt>
  <dd class="col-sm-9">
   {{$request_bidder ? $request_bidder->phone : 'N/A'}}
  </dd>

   <dt class="col-sm-3"> Email</dt>
  <dd class="col-sm-9">
    {{$request_bidder ? $request_bidder->email : 'N/A'}}
  </dd>

   <dt class="col-sm-3">Country</dt>
  <dd class="col-sm-9">
    {{$request_bidder->country ? $request_bidder->country->country_name : 'N/A'}}
  </dd>

   <dt class="col-sm-3">State</dt>
  <dd class="col-sm-9">
    {{$request_bidder->state ? $request_bidder->state->name : 'N/A'}}
  </dd>

   <dt class="col-sm-3">City</dt>
  <dd class="col-sm-9">
    {{$request_bidder->city ? $request_bidder->city->name : 'N/A'}}
  </dd>

  <dt class="col-sm-3 text-truncate">Street Address</dt>
  <dd class="col-sm-9">

     <p>{{$request_bidder ? $request_bidder->street: 'N/A'}}</p>
                       
  </dd>
  
</dl>
				   <hr>
				   <div class="col-sm-6">
				   @if($request_bid->status == 'Approved')
                    Request Status:<span class="text-danger"> <strong>{{$request_bid->status}}</strong></span>

					<form class="form" method="post" action="{{ route('logistic_partner.request.finalconfirmation') }}">
                            @csrf
                          <div class="form-group">
                            <input type="hidden" name="request_id" class="form-control" id="request_id" value="{{$request->id}}" >
                          </div>

                          <div class="form-group">
                            <input type="hidden" name="request_bid_id" class="form-control" id="request_id" value="{{$request_bid->id}}" >
                          </div>

                           <div class="form-group">
                            <input type="hidden" name="bidder_id" class="form-control" id="request_id" value="{{$request_bidder->id}}" >
                          </div>


                     <div class="form-group">
                            <label for="exampleInputEmail1">Confirmation code</label>
                            <input type="number" name="confirmation_code" class="form-control" id="delievery_cost" placeholder="Please enter the confirmation code provided by the receiver">
                          </div>
                   
                         
                          <button type="submit" class="btn btn-primary float-left">Confirm that the product has been delivered</button>
					      <!-- <button type="button" class="btn btn-danger float-right" onclick="rejectRequest({{ $request_bid->id  }})">Reject request</button> -->

                        </form>
                    @elseif($request_bid->status == 'Approved')
                    Request Status:<span class=" text-primary"> {{$request_bid->status}}</span>
                    @elseif($request_bid->status == 'Rejected')
                    Request Status: <span class=" text-danger"> {{$request_bid->status}}</span>
                     @elseif($request_bid->status == 'Delivered')
                    Request Status:<span class=" text-success"> {{$request_bid->status}}</span>
                  @endif
                    </div>

				  </div>
				</div>

           
             <div class="card">
              <div class="card-header">
              Request (Help provided)
              </div>
              <div class="card-body">
                      <h3>Welcome to my page - <strong>{{ $request->user->username }}</strong></h3>
                                    @if($request->show_phone == 1)
                                    <div class="user-request-card">
                                        <p>Please call me on 
                                        <strong>
                                                {{ $request->user->phone }}
                                            @else
                                                <p>Kindly contact me through this platform
                                            @endif
                                        </strong>for <b>free</b> <strong>{{ $request->category ? $request->category->title : '' }} - ({{ $request->description }})</strong> around <strong>{{ $request->city->name }}, {{ $request->state->name }}</strong>.
                                    
                                    </p>
                                    <p>Thank you</p>
                                    <p><strong>{{ $request->user->username }}</strong></p> 
                                    @if($request->show_address == 1)
                                        <p>Address: {{ $request->street }}</p>
                                    @endif


                        @if(isset($request_photos) && $request_photos !='')

                <!--Tab Gallery: The expanding image container -->
                  <div class="container" style="display: none;">
                    <!-- Close the image -->
                    <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>

                    <!-- Expanded image -->
                    <img id="expandedImg" style="width:100%; height: 500px;">

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
                   <br>             
                            </div>
                 
              </div>
            </div>


                <div class="card">
              <div class="card-header">
                Help Provider Details
              </div>
              <div class="card-body">
              	@if($help_provider != '')
                  
                  <dl class="row">
  <dt class="col-sm-3">Full Name</dt>
  <dd class="col-sm-9">
    {{$help_provider ? $help_provider->name : 'N/A'}} 
    {{$help_provider ? $help_provider->last_name : 'N/A'}}
  </dd>

  <dt class="col-sm-3">Phone Number</dt>
  <dd class="col-sm-9">
   {{$help_provider ? $help_provider->phone : 'N/A'}}
  </dd>

   <dt class="col-sm-3"> Email</dt>
  <dd class="col-sm-9">
    {{$help_provider ? $help_provider->email : 'N/A'}}
  </dd>

   <dt class="col-sm-3">Country</dt>
  <dd class="col-sm-9">
    {{$help_provider->country ? $help_provider->country->country_name : 'N/A'}}
  </dd>

   <dt class="col-sm-3">State</dt>
  <dd class="col-sm-9">
    {{$help_provider->state ? $help_provider->state->name : 'N/A'}}
  </dd>

   <dt class="col-sm-3">City</dt>
  <dd class="col-sm-9">
    {{$help_provider->city ? $help_provider->city->name : 'N/A'}}
  </dd>

  <dt class="col-sm-3 text-truncate">Street Address</dt>
  <dd class="col-sm-9">

     <p>{{$help_provider ? $help_provider->street: 'N/A'}}</p>
                       
  </dd>
</dl>
                  @else
          <small class="text-danger">No logistic partner choosen yet</small>
                  @endif

                  <footer class="blockquote-footer">Help Provider <cite title="Source Title">details</cite></footer>
              </div>
            </div>


                  <div class="card">
              <div class="card-header">
                Logistic Partner Details
              </div>
              <div class="card-body">
              	@if($logistic_partner != '')
                  
                  <dl class="row">
  <dt class="col-sm-3">Company Name</dt>
  <dd class="col-sm-9">
    {{$logistic_partner ? $logistic_partner->company_name : 'N/A'}} 
  </dd>

  <dt class="col-sm-3">Phone Number</dt>
  <dd class="col-sm-9">
   {{$logistic_partner ? $logistic_partner->phone : 'N/A'}}
  </dd>

   <dt class="col-sm-3"> Email</dt>
  <dd class="col-sm-9">
    {{$logistic_partner ? $logistic_partner->email : 'N/A'}}
  </dd>

   <dt class="col-sm-3">Country</dt>
  <dd class="col-sm-9">
    {{$logistic_partner->country ? $logistic_partner->country->country_name : 'N/A'}}
  </dd>

   <dt class="col-sm-3">State</dt>
  <dd class="col-sm-9">
    {{$logistic_partner->state ? $logistic_partner->state->name : 'N/A'}}
  </dd>

   <dt class="col-sm-3">City</dt>
  <dd class="col-sm-9">
    {{$logistic_partner->city ? $logistic_partner->city->name : 'N/A'}}
  </dd>

  <dt class="col-sm-3 text-truncate">Street Address</dt>
  <dd class="col-sm-9">

     <p>{{$logistic_partner ? $logistic_partner->street: 'N/A'}}</p>
                       
  </dd>
</dl>
                  @else
          <small class="text-danger">No logistic partner choosen yet</small>
                  @endif

                  <footer class="blockquote-footer">Logistic partner <cite title="Source Title">details</cite></footer>
              </div>
            </div>

                </div>
                <!-- /tables -->


        </div>
        <!-- /grid -->


@endsection


@section('scripts')


@endsection