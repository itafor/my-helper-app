@extends('layouts.app', ['pageSlug' => 'requests'])


@section('content')

 <!-- Grid -->
        <div class="row">

          <!-- Grid Item -->
          <div class="col-xl-12">

            <!-- Card -->
            <div class="dt-card">

              <!-- Card Body -->
              <div class="dt-card__body">

                <!-- Tables -->
                <div class="table-responsive">


				            <div class="card">
				  <div class="card-header">
				<div class="float-left">Approve or Reject Request to Get Help</div>
				<div class="float-right">
           @if(authUser()->id == $request_bid->bidder_id)
					@if($request_bid->status == 'Pending')
					<!-- <button class="btn btn-danger btn-sm" onclick="rejectRequest({{ $request_bid->id  }})">Reject Request</button> -->

              <form class="form" method="post" action="{{ route('request.reject.by.receiver') }}">
                            @csrf
                          <div class="form-group">
                            <input type="hidden" name="request_bid_id" class="form-control" id="request_bid_id" value="{{$request_bid->id}}" >
                          </div>
                          <button type="submit" class="btn btn-primary float-left btn-sm">Reject Request</button>

                        </form>
          @endif
					@endif
				</div>
				  </div>
				  <div class="card-body">
            <h3>Help Provider details</h3>
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

   <dt class="col-sm-3">State</dt>
  <dd class="col-sm-9">
    {{$help_provider->api_state}}
  </dd>

   <dt class="col-sm-3">City</dt>
  <dd class="col-sm-9">
    {{$help_provider->api_city }}
  </dd>

  <dt class="col-sm-3 text-truncate">Street Address</dt>
  <dd class="col-sm-9">

     <p>{{$help_provider ? $help_provider->street: 'N/A'}}</p>
                       
  </dd>
  
</dl>
				   <hr>
  <h3>REQUEST: Welcome to my page - <strong>{{ $request->user->username ? $request->user->username : $request->user->company_name }}</strong></h3>
                                    @if($request->show_phone == 1)
                                    <div class="user-request-card">
                                        <p>Please call me on 
                                        <strong>
                                                {{ $request->user->phone }}
                                            @else
                                                <p>Kindly contact me through this platform
                                            @endif
                                        </strong>for <b>free</b> <strong>{{ $request->category ? $request->category->title : '' }} - ({{ $request->description }})</strong> around <strong>{{ $request->api_city }}, {{ $request->api_state }}</strong>.
                                    
                                    </p>
                                    <p>Thank you</p>
                                    <p><strong>{{ $request->user->username }}</strong></p> 
                                    @if($request->show_address == 1)
                                        <p>Address: {{ $request->street }}</p>
                                    @endif

                              <p>Status: <strong class="text-danger">{{$request_bid->status}}</strong></p>

              @if(isset($request_photos) && $request_photos !='')

              <h3>Sample photos uploaded by the provider ({{$help_provider ? $help_provider->name : 'N/A'}} 
    {{$help_provider ? $help_provider->last_name : 'N/A'}})</h3>
                <!--Tab Gallery: The expanding image container -->
                  <div class="container" style="display: none;">
                    <!-- Close the image -->
                    <span onclick="this.parentElement.style.display='none'" class="closebtn" style="width:450px;">&times;</span>

                    <!-- Expanded image -->
                    <img id="expandedImg" style="width:500px; height: 300px;">

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




				   <div class="col-sm-6">
				   @if($request_bid->status == 'Pending')
                    Request Status:<span class="text-danger"> <strong>{{$request_bid->status}}</strong></span>
                  @if(authUser()->id == $request_bid->bidder_id)
					<form class="form" method="post" action="{{ route('request.approve_or_reject.store') }}">
                            @csrf
                          <div class="form-group">
                            <input type="hidden" name="request_id" class="form-control" id="request_id" value="{{$request->id}}" >
                          </div>

                          <div class="form-group">
                            <input type="hidden" name="request_bid_id" class="form-control" id="request_id" value="{{$request_bid->id}}" >
                          </div>
                          <!-- help receiver -->
                           <div class="form-group">
                            <input type="hidden" name="bidder_id" class="form-control" id="request_id" value="{{authUser()->id}}" >
                          </div>
                          <!-- help provider -->
                           <div class="form-group">
                            <input type="hidden" name="requester_id" class="form-control" id="request_id" value="{{$help_provider->id}}" >
                          </div>

                            <!-- <div class="form-group">
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
                            <label for="exampleInputEmail1">Delivery cost</label>
                            <input type="number" name="delievery_cost" class="form-control" id="delievery_cost" value="3500" >
                          </div> -->
                     <div class="form-group">
                            <label for="exampleInputEmail1">Comment (Optional)</label>
                            <textarea type="text" name="comment" class="form-control" id="delievery_cost" value="3500" placeholder="type a comment" ></textarea>
                          </div>
                         
                          <button type="submit" class="btn btn-primary float-left">Approve Request</button>
					     

                        </form>
                        @else
                        <span class="text-danger"> <br>You are not the owner of this request, hence you are not allowed to approve or reject it</span>
                        @endif
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

                </div>
                <!-- /tables -->

              </div>
              <!-- /card body -->

            </div>
            <!-- /card -->

          </div>
          <!-- /grid item -->

        </div>
        <!-- /grid -->



@endsection
