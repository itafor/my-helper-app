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
				<div class="float-left">Submitting Pickup Request Information and Generation of Waybill Number</div>
				<div class="float-right">
					@if($request_bid->status == 'Pending')
					<button class="btn btn-danger btn-sm" onclick="rejectRequest({{ $request_bid->id  }})">Reject Request</button>

					@endif
				</div>
				  </div>
				  <div class="card-body">
 
 @if($request_bid->status == 'Pending')
   Request Status:<span class="text-danger"> <strong>{{$request_bid->status}}</strong></span>

   @elseif($request_bid->status == 'Approved')
                    Request Status:<span class=" text-primary">Request {{$request_bid->status}} and pickup request sent</span>
                      <a href="{{URL::route('pickupRequest.details', [$request->id, $help_provider->id, $request_bidder->id] )}}">
                        <button class="btn-sm btn-primary">View details</button>

                      </a>
  @elseif($request_bid->status == 'Rejected')
                    Request Status: <span class=" text-danger"> {{$request_bid->status}}</span>
  @elseif($request_bid->status == 'Delivered')
                    Request Status:<span class=" text-success"> {{$request_bid->status}}</span>
  @endif

				   <hr>
				   <div class="col-sm-12">
				  

					<form class="form" method="post" action="{{ route('request.approve.store') }}">
                            @csrf
                          <div>
                            <input type="hidden" name="request_id" class="form-control" id="request_id" value="{{$request->id}}" >
                          </div>

                          <div>
                            <input type="hidden" name="request_bid_id" class="form-control" id="request_id" value="{{$request_bid->id}}" >
                          </div>

                           <div>
                            <input type="hidden" name="bidder_id" class="form-control" id="request_id" value="{{$request_bidder->id}}" >
                          </div>

                           <div >
                            <input type="hidden" name="requester_id" class="form-control" id="request_id" value="{{authUser()->id}}" >
                          </div>

                        
                     <div class="row">
                       <div class="col-sm-4">
                            <label for="Inputdescription">Description</label>
                            <textarea name="description" class="form-control" id="description">{{ $request->category ? $request->category->title : '' }} : {{ $request->description }}</textarea>
                          </div>
                           <div class="col-sm-2">
                             <label for="inputweight">Weight</label>
                            <input type="text" name="weight" class="form-control" id="weight" >
                           </div>
                            <div class="col-sm-3">
                                <label for="exampleInputEmail1">PaymentType</label>
                            <select name="PaymentType" id="PaymentType" class="form-control" required >
                                                    <option value="">Select paymen type</option>
                                                    @foreach(payment_types() as $paymentype)
                                                        <option  value="{{ $paymentype['PaymentType'] }}">{{ $paymentype['PaymentType'] }}</option>
                                                    @endforeach
                                                </select>
                            </div>
                            <div class="col-sm-3">
                              <label for="Inputdescription">DeliveryType</label>
                             <select name="DeliveryType" id="DeliveryType" class="form-control" required >
                                                    <option value="">Select paymen type</option>
                                                    @foreach(delivery_types() as $deliverytype)
                                                        <option  value="{{ $deliverytype['DeliveryTypeName'] }}">{{ $deliverytype['DeliveryTypeName'] }}</option>
                                                    @endforeach
                                                </select>
                          </div>
                          </div>
                          <h3>Sender Details</h3>
                          <div class="row">
                            <div class="col-sm-4">
                                <label for="exampleInputEmail1">SenderName</label>
                            <input type="text" name="senderName" class="form-control" id="weight" value="{{$help_provider->name}} {{$help_provider->last_name}}">
                            </div>
                             <div class="col-sm-4">
                            <label for="inputweight">SenderPhone</label>
                            <input type="text" name="senderPhone" class="form-control" id="senderPhone" value="{{$help_provider->phone}}" >
                            </div>
                            <div class="col-sm-4">
                                <label for="exampleInputEmail1">SenderEmail</label>
                            <input type="email" name="senderEmail" class="form-control" id="senderEmail" value="{{$help_provider->email}}">
                            </div>
                          </div>


                          <div class="row">
                            <div class="col-sm-3">
                            <label for="inputweight">SenderCity</label>

                            <select name="senderCity" id="senderCity" class="form-control" required >
                                                    <option value="">Select sender city</option>
                                                    @foreach(clickship_cities() as $city)
                                                        <option  value="{{ $city['CityCode'] }}" {{$city['CityName'] == $help_provider->api_city ? 'selected' : ''}}>{{ $city['CityName'] }}</option>
                                                    @endforeach
                                                </select>


                            </div>
                            <div class="col-sm-3">
                                <label for="exampleInputEmail1">SenderTownID</label>
                            <select name="senderTownID" id="senderTownID" class="form-control">
                                                    <option value="">Select sender town Id</option>

                               @foreach(getCityCode_by_CityName($help_provider->api_city) as $city)
                                                        <option  value="{{ $city['TownID'] }}">{{ $city['TownName'] }} -{{ $city['TownID'] }}</option>
                                                    @endforeach
                                                </select>
                            </div>
                            <div class="col-sm-6">

                              <label for="Inputdescription">SenderAddress</label>
                            <input type="text" name="senderAddress" class="form-control" id="senderAddress" value="{{$help_provider->street}}">
                          </div>
                          </div>

                          <h3>Receiver Details</h3>

                          <div class="row">
                            <div class="col-sm-3">
                            <label for="inputweight">RecipientName</label>
                            <input type="text" name="RecipientName" class="form-control" id="RecipientName" value="{{$request_bidder ? $request_bidder->name : 'N/A'}} {{$request_bidder ? $request_bidder->last_name : 'N/A'}}" >
                            </div>
                            <div class="col-sm-3">
                                <label for="exampleInputEmail1">RecipientPhone</label>
                            <input type="text" name="RecipientPhone" class="form-control" id="RecipientPhone" value="{{$request_bidder->phone}}" >
                            </div>
                            <div class="col-sm-6">

                              <label for="Inputdescription">RecipientEmail</label>
                            <input type="text" name="RecipientEmail" class="form-control" id="RecipientEmail" value="{{$request_bidder->email}}">
                          </div>
                          </div>

                            <div class="row">
                            <div class="col-sm-3">
                            <label for="inputweight">RecipientCity</label>
                              <select name="RecipientCity" id="RecipientCity" class="form-control" required >
                                                    <option value="">Select Recipient City</option>
                                                    @foreach(clickship_cities() as $city)
                                                        <option  value="{{ $city['CityCode'] }}" {{$city['CityName'] == $request_bidder->api_city ? 'selected' : ''}}>{{ $city['CityName'] }}</option>
                                                    @endforeach
                                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="exampleInputEmail1">RecipientTownID</label>
                             <select name="RecipientTownID" id="RecipientTownID" class="form-control">
                                                    <option value="">Select Recipient Town Id</option>

                               @foreach(getCityCode_by_CityName($request_bidder->api_city) as $city)
                                                        <option  value="{{ $city['TownID'] }}">{{ $city['TownName'] }} -{{ $city['TownID'] }}</option>
                                                    @endforeach
                                                </select>
                            </div>
                            <div class="col-sm-6">

                              <label for="Inputdescription">RecipientAddress</label>
                            <input type="text" name="RecipientAddress" class="form-control" id="RecipientAddress" value="{{$request_bidder ? $request_bidder->street : 'N/A'}}">
                          </div>
                          </div>

                          <h3>Shipment Items</h3>

                          <div class="row">
                            <div class="col-sm-3">
                            <label for="inputweight">ItemName</label>
                            <input type="text" name="ShipmentItems[112211][ItemName]" class="form-control" id="ItemName" >
                            </div>
                            <div class="col-sm-2">
                                <label for="exampleInputEmail1">ItemUnitCost</label>
                            <input type="number" name="ShipmentItems[112211][ItemUnitCost]" class="form-control" id="ItemUnitCost" >
                            </div>
                            <div class="col-sm-2">
                              <label for="Inputdescription">ItemQuantity</label>
                            <input type="number" name="ShipmentItems[112211][ItemQuantity]" class="form-control" id="ItemQuantity">
                          </div>

                          <div class="col-sm-3">
                              <label for="Inputdescription">ItemColour</label>
                            <input type="text" name="ShipmentItems[112211][ItemColour]" class="form-control" id="ItemColour">
                          </div>
                          <div class="col-sm-2">
                              <label for="Inputdescription">ItemSize</label>
                            <input type="text" name="ShipmentItems[112211][ItemSize]" class="form-control" id="ItemColour">
                          </div>
                          </div>


                                <div id="shipmentItemsContainer">
                                
         
                                </div>
                                  <div style="clear:both"></div>

                                     <div class="form-group">
                                    <button type="button" id="addMoreItem" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i>  Add more Item</button>
                                </div>


                     <div>
                            <label for="exampleInputEmail1">Comment (Optional)</label>
                            <textarea type="text" name="comment" class="form-control" id="delievery_cost" value="3500" placeholder="type a comment" ></textarea>
                          </div>

                           @if($request_bid->status == 'Pending')
                          <button type="submit" class="btn btn-primary float-left">Approve and Submit Pickup Request</button>
					      <button type="button" class="btn btn-danger float-right" onclick="rejectRequest({{ $request_bid->id  }})">Reject request</button>

                @elseif($request_bid->status == 'Approved')
                    Request Status:<span class=" text-primary">Request {{$request_bid->status}} and pickup request sent</span>
                @elseif($request_bid->status == 'Rejected')
                    Request Status: <span class=" text-danger"> {{$request_bid->status}}</span>
                @elseif($request_bid->status == 'Delivered')
                    Request Status:<span class=" text-success"> {{$request_bid->status}}</span>
                @endif

                        </form>
                    
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
