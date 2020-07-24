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
				<div class="float-left">Help seeker details (Receiver)</div>
				<div class="float-right">
					@if($request_bid->status == 'Pending')
					<button class="btn btn-danger btn-sm">Reject Request</button>
					@endif
				</div>
				  </div>
				  <div class="card-body">
				    <!-- <blockquote class="blockquote mb-0"> -->
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
				   @if($request_bid->status == 'Pending')
                    Request Status:<span class="text-danger"> <strong>{{$request_bid->status}}</strong></span>

					<form class="form" method="post" action="{{ route('request.approve.store') }}">
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
                            <input type="hidden" name="requester_id" class="form-control" id="request_id" value="{{authUser()->id}}" >
                          </div>

                            <div class="form-group">
                            <!-- <label for="exampleInputEmail1">Logistic Partner</label> -->
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
                            <label for="exampleInputEmail1">Comment (Optional)</label>
                            <textarea type="text" name="comment" class="form-control" id="delievery_cost" value="3500" placeholder="type a comment" ></textarea>
                          </div>
                         
                          <button type="submit" class="btn btn-primary float-left">Approve request</button>
					      <button type="button" class="btn btn-danger float-right">Reject request</button>

                        </form>
                    @elseif($request_bid->status == 'Approved')
                    Request Status:<span class=" text-primary"> {{$request_bid->status}}</span>
                    @elseif($request_bid->status == 'Rejected')
                    Request Status: <span class=" text-danger"> {{$request_bid->status}}</span>
                     @elseif($request_bid->status == 'Delievered')
                    Request Status:<span class=" text-success"> {{$request_bid->status}}</span>
                  @endif
                    </div>





				  </div>
				</div>

           
             <div class="card">
              <div class="card-header">
              Your Request (Help provided)
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
                                
                            </div>

                  <footer class="blockquote-footer">Here is your request <cite title="Source Title">to provide help</cite></footer>
              </div>
            </div>


                  <div class="card">
              <div class="card-header">
                Logistic partner details
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
              <!-- /card body -->

            </div>
            <!-- /card -->

          </div>
          <!-- /grid item -->

        </div>
        <!-- /grid -->



@endsection


<!-- <!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
request_bid:{{$request_bid}}
<br>
<br>
<br>
request_bidder:{{$request_bidder}}
<br>
<br>
<br>

request:{{$request}}
<br>
<br>
<br>
logistic_partner{{$logistic_partner}}

help_provider:{{$help_provider}}
</body>
</html> -->


<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>