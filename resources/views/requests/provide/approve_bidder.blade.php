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
					<button class="btn btn-danger btn-sm" onclick="rejectRequest({{ $request_bid->id  }})">Reject Request</button>
					@endif
				</div>
				  </div>
				  <div class="card-body">
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

   <dt class="col-sm-3">State</dt>
  <dd class="col-sm-9">
    {{$request_bidder->api_state }}
  </dd>

   <dt class="col-sm-3">City</dt>
  <dd class="col-sm-9">
    {{$request_bidder->api_city }}
  </dd>

   <dt class="col-sm-3">Delivery Town</dt>
  <dd class="col-sm-9">
    {{$request_bidder->api_delivery_town ? $request_bidder->api_delivery_town : 'N/A'  }}
  </dd>

  <dt class="col-sm-3 text-truncate">Street Address</dt>
  <dd class="col-sm-9">

     <p>{{$request_bidder ? $request_bidder->street: 'N/A'}}</p>
                       
  </dd>
  
</dl>
				   <hr>
				   <div class="col-sm-12">
				   @if($request_bid->status == 'Pending')
                    Request Status:<span class="text-danger"> <strong>{{$request_bid->status}}</strong></span>

					<form class="form" method="post" action="{{ route('request.approve.store') }}">
                            @csrf
                          <div class=">
                            <input type="hidden" name="request_id" class="form-control" id="request_id" value="{{$request->id}}" >
                          </div>

                          <div class=">
                            <input type="hidden" name="request_bid_id" class="form-control" id="request_id" value="{{$request_bid->id}}" >
                          </div>

                           <div class=">
                            <input type="hidden" name="bidder_id" class="form-control" id="request_id" value="{{$request_bidder->id}}" >
                          </div>

                           <div class=">
                            <input type="hidden" name="requester_id" class="form-control" id="request_id" value="{{authUser()->id}}" >
                          </div>

                        
                     <div class="row">
                       <div class="col-sm-4">
                            <label for="Inputdescription">Description</label>
                            <input type="text" name="description" class="form-control" id="description">
                          </div>
                           <div class="col-sm-2">
                             <label for="inputweight">Weight</label>
                            <input type="number" name="weight" class="form-control" id="weight" >
                           </div>
                            <div class="col-sm-3">
                                <label for="exampleInputEmail1">PaymentType</label>
                            <input type="text" name="PaymentType" class="form-control" id="PaymentType" >
                            </div>
                            <div class="col-sm-3">
                              <label for="Inputdescription">DeliveryType</label>
                            <input type="text" name="DeliveryType" class="form-control" id="DeliveryType">
                          </div>
                          </div>
                          <h3>Sender Details</h3>
                          <div class="row">
                            <div class="col-sm-4">
                                <label for="exampleInputEmail1">SenderName</label>
                            <input type="text" name="senderName" class="form-control" id="weight" >
                            </div>
                             <div class="col-sm-4">
                            <label for="inputweight">SenderPhone</label>
                            <input type="text" name="senderPhone" class="form-control" id="senderPhone" >
                            </div>
                            <div class="col-sm-4">
                                <label for="exampleInputEmail1">SenderEmail</label>
                            <input type="email" name="senderEmail" class="form-control" id="senderEmail" >
                            </div>
                          </div>


                          <div class="row">
                            <div class="col-sm-3">
                            <label for="inputweight">SenderCity</label>
                            <input type="text" name="senderCity" class="form-control" id="senderCity" >
                            </div>
                            <div class="col-sm-3">
                                <label for="exampleInputEmail1">SenderTownID</label>
                            <input type="number" name="senderTownID" class="form-control" id="senderTownID" >
                            </div>
                            <div class="col-sm-6">

                              <label for="Inputdescription">SenderAddress</label>
                            <input type="text" name="senderAddress" class="form-control" id="senderAddress">
                          </div>
                          </div>

                          <h3>Receiver Details</h3>

                          <div class="row">
                            <div class="col-sm-3">
                            <label for="inputweight">RecipientName</label>
                            <input type="text" name="RecipientName" class="form-control" id="RecipientName" >
                            </div>
                            <div class="col-sm-3">
                                <label for="exampleInputEmail1">RecipientPhone</label>
                            <input type="text" name="RecipientPhone" class="form-control" id="RecipientPhone" >
                            </div>
                            <div class="col-sm-6">

                              <label for="Inputdescription">RecipientEmail</label>
                            <input type="text" name="RecipientEmail" class="form-control" id="RecipientEmail">
                          </div>
                          </div>

                            <div class="row">
                            <div class="col-sm-3">
                            <label for="inputweight">RecipientCity</label>
                            <input type="text" name="RecipientCity" class="form-control" id="RecipientCity" >
                            </div>
                            <div class="col-sm-3">
                                <label for="exampleInputEmail1">RecipientTownID</label>
                            <input type="text" name="RecipientTownID" class="form-control" id="RecipientTownID" >
                            </div>
                            <div class="col-sm-6">

                              <label for="Inputdescription">RecipientAddress</label>
                            <input type="text" name="RecipientAddress" class="form-control" id="RecipientAddress">
                          </div>
                          </div>

                          <h3>Shipment Items</h3>

                          <div class="row">
                            <div class="col-sm-3">
                            <label for="inputweight">ItemName</label>
                            <input type="text" name="ShipmentItems[112211][ItemName]" class="form-control" id="ItemName" >
                            </div>
                            <div class="col-sm-3">
                                <label for="exampleInputEmail1">ItemUnitCost</label>
                            <input type="number" name="ShipmentItems[112211][ItemUnitCost]" class="form-control" id="ItemUnitCost" >
                            </div>
                            <div class="col-sm-3">
                              <label for="Inputdescription">ItemQuantity</label>
                            <input type="number" name="ShipmentItems[112211][ItemQuantity]" class="form-control" id="ItemQuantity">
                          </div>

                          <div class="col-sm-3">
                              <label for="Inputdescription">ItemColour</label>
                            <input type="text" name="ShipmentItems[112211][ItemColour]" class="form-control" id="ItemColour">
                          </div>
                          </div>


                                <div id="shipmentItemsContainer">
                                
         
                                </div>
                                  <div style="clear:both"></div>

                                     <div class="form-group">
                                    <button type="button" id="addMoreItem" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i>  Add more Item</button>
                                </div>







                          

                     <div class=">
                            <label for="exampleInputEmail1">Comment (Optional)</label>
                            <textarea type="text" name="comment" class="form-control" id="delievery_cost" value="3500" placeholder="type a comment" ></textarea>
                          </div>
                         
                          <button type="submit" class="btn btn-primary float-left">Approve request</button>
					      <button type="button" class="btn btn-danger float-right" onclick="rejectRequest({{ $request_bid->id  }})">Reject request</button>

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
                                        </strong>for <b>free</b> <strong>{{ $request->category ? $request->category->title : '' }} - ({{ $request->description }})</strong> around <strong>{{ $request->api_city }}, {{ $request->api_state }}</strong>.
                                    
                                    </p>
                                    <p>Thank you</p>
                                    <p><strong>{{ $request->user->username }}</strong></p> 
                                    @if($request->show_address == 1)
                                        <p>Address: {{ $request->street }}</p>
                                    @endif

                                    {{$request->api_state}}
                                    {{$request->api_city}}
                                    {{$request->api_delivery_town}}

              @if(isset($request_photos) && $request_photos !='')

                <!--Tab Gallery: The expanding image container -->
                  <div class="container" style="display: none;">
                    <!-- Close the image -->
                    <span onclick="this.parentElement.style.display='none'" class="closebtn" style="margin-right: 400px;">&times;</span>

                    <!-- Expanded image -->
                    <img id="expandedImg" style="width:500px; height: 400px;">

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

                  <footer class="blockquote-footer">Here is your request <cite title="Source Title">to provide help</cite></footer>
              </div>
            </div>
{{$help_provider}}

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
