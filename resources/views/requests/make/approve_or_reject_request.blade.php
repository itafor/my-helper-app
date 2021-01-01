
@extends('layouts.app-blue', ['pageSlug' => 'requests'])


@section('content')

 <!-- Grid -->
      <div class="page-wrap">
        <div class="container">
            <div class="row">
                
              <div class="col-md-12 content-wrapper pt-40 pb-40">
                  <div class="card">         
                
      				        <div class="row card-header bs-padded">
                      	 <div class="col-md-8">
                            <h2>Approve or Reject Request to Get Help</h2>                				
                      		</div>
                          <div class="col-md-4">
                            <div class="float-right">
                              @if(authUser()->id == $request_bid->bidder_id)
                              @if($request_bid->status == 'Pending')
         

                              <form class="form" method="post" action="{{ route('request.reject.by.receiver') }}" id="rejectRequest">
                                @csrf
                                <div class="form-group">
                                  <input type="hidden" name="request_bid_id" class="form-control" id="request_bid_id" value="{{$request_bid->id}}" >
                                </div>
                            
                                <button type="submit" class="btn btn-dark">Reject Request</button>

                              </form>
                              @endif
                              @endif
                            </div>
                        </div>
                      </div>


      				        <div class="card-body">

                        <label>
                            <h4>Help Provider details</h4>
                        
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

                                 <dt class="col-sm-3">Pickup State</dt>
                                <dd class="col-sm-9">
                                  {{providerDetail($request->id,$help_provider->id)['api_state']}}
                                </dd>

                                 <dt class="col-sm-3">Pickup City</dt>
                                <dd class="col-sm-9">
                                  {{providerDetail($request->id,$help_provider->id)['api_city']}}
                                </dd>
                                <dt class="col-sm-3">OnforwardingTownId</dt>
                                <dd class="col-sm-9">
                                  {{providerDetail($request->id,$help_provider->id)['api_delivery_town_id'] ? providerDetail($request->id,$help_provider->id)['api_delivery_town_id'] : 'N/A'}}
                                </dd>

                                <dt class="col-sm-3 text-truncate">Pickup Address</dt>
                                <dd class="col-sm-9">
                                   <p>
                                  {{providerDetail($request->id,$help_provider->id)['providerAddress']}}
                                   </p>                       
                                </dd>
                              <!--   <dt class="col-sm-3 text-truncate">Pickup Status</dt>
                                <dd class="col-sm-9">
                                  @if($request_bid->pickup_status == 'Success')
                                   <p>
                                  <a href="{{URL::route('pickupRequest.details', [$request->id, $help_provider->id, $request->user->id] )}}">
                                                     View and track shipment status</a>
                                   </p>
                                     @else
                                     <span>N/A</span>
                                     @endif                
                                </dd> -->
                              </dl>
                          </label>

                          <hr>
                          
                          <div class="request-card">
                            <h4>REQUEST: Welcome to my page - <strong>{{ $request->user->username ? $request->user->username : $request->user->company_name }}</strong></h4>
                            <div class="request-cards">
                                <label>
                                  I need the following items  ({{ $request->description }}) around {{ ucfirst(Str::lower($request->api_city))}}, {{ ucfirst(Str::lower($request->api_state))}} ({{ $request->street }})
                                  <br>
                                  <br>
                            <span>ITEM CATEGORY: {{ $request->category ? $request->category->title : '' }}</span>
                                <br>
                                <br>
                              <h5>ITEMS</h5>
                              <ul>
                              @foreach(reqItems($request->id, $request->category->id) as $reqitem)
                               <li>{{$reqitem->item ? $reqitem->item->name : 'N/A'}}</li>
                              @endforeach
                              </ul>

                                  Status: <strong class="text-danger">{{$request_bid->status}}</strong>
                                  <br>
                                  Item Size: <strong class="text-danger"> {{itemSize($request_bid->weight)}}</strong>
                                  <br>
                                  <p>Delivery Fee Payer: <strong class="text-danger">{{$request_bid->payment_type =='prepaid' ? 'Help Provider will pay for Shipping fee':'Help Receiver will pay for Shipping fee'}}</strong></p>
                                </label> 

                                @if(isset($request_photos) && count($request_photos) >= 1)

                                <h4>Sample photos uploaded by the provider ({{$help_provider ? $help_provider->name : 'N/A'}} 
                                  {{$help_provider ? $help_provider->last_name : 'N/A'}})</h4>
                      
                                <!--Tab Gallery: The expanding image container -->
                                <div class="container" >
                                  <!-- Close the image -->
                                  <span onclick="hidePhoto()" id="closebtn" style="width:450px; display: none;">&times;</span>

                                  <!-- Expanded image -->
                                  <img id="expandedImg" style="width:500px; height: 300px; display: none;">

                                  <!-- Image text -->
                                  <div id="imgtext"></div>
                                </div>

                                  @foreach($request_photos as $photo)

                                  <!-- The grid:-->
                                  <div class="column" style="display: inline;">
                                   <!--  <img src="img_nature.jpg" alt="Nature" > -->
                                    <img src="{{$photo->image_url}}" onclick="myFunction(this);" alt="Sample image" style="width: 50; height: 50;">
                                  </div>
                                  
                                  @endforeach
                                @endif
                            </div>
                          </div>

      				            <div class="col-sm-6">
                  

      				                @if($request_bid->status == 'Pending')
                     
                                @if(authUser()->id == $request_bid->bidder_id)
      					                <form class="form" method="post" action="{{ route('request.approve_or_reject.store') }}" id="approveRequest">
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
                                
                                  <!-- shipment form -->

                                  <div style="display: none;">
                                    <div class="row" >
                                      <div class="col-sm-4">
                                        <label for="Inputdescription">Description</label>
                                        <textarea name="description" class="form-control" id="description">{{ $request->description }}</textarea>
                                      </div>

                                      <div class="col-sm-2">
                                          <label for="inputweight">Weight</label>
                                          <input type="text" name="weight" class="form-control" id="weight" value="{{$request_bid->weight}}" >
                                      </div>

                                      <div class="col-sm-3">
                                        <label for="exampleInputEmail1">PaymentType</label>
                                        <select name="PaymentType" id="PaymentType" class="form-control" required >
                                            <option value="">Select payment type</option>
                                            @foreach(payment_types() as $paymentype)
                                            <option  value="{{ $paymentype['PaymentType'] }}" {{$request_bid->payment_type ==
                                                    $paymentype['PaymentType'] ? 'selected':''}}>{{ $paymentype['PaymentType'] }}</option>
                                            @endforeach
                                        </select>
                                      </div>

                                      <div class="col-sm-3">
                                        <label for="Inputdescription">DeliveryType</label>
                                        <select name="DeliveryType" id="DeliveryType" class="form-control" required >
                                            <option value="">Select delivery type</option>
                                            @foreach(delivery_types() as $deliverytype)
                                            <option  value="{{ $deliverytype['DeliveryTypeName'] }}" {{ $deliverytype['DeliveryTypeName'] =='Normal Delivery' ? 'selected' : ''}}>{{ $deliverytype['DeliveryTypeName'] }}</option>
                                            @endforeach
                                        </select>
                                      </div>
                                    </div>

                                    <!-- <h3>Sender Details</h3> -->
                                    <div class="row" >

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


                                    <div class="row" >
                                      <div class="col-sm-3">
                                          <label for="inputweight">SenderCity</label>
                                          <select name="senderCity" id="senderCity" class="form-control" required >
                                              <option value=" {{providerDetail($request->id,$help_provider->id)['api_city']}}" selected="selected"> {{providerDetail($request->id,$help_provider->id)['api_city']}}</option>
                                          </select>
                                      </div>

                                      <div class="col-sm-3">
                                          <label for="exampleInputEmail1">SenderTownID</label>
                                          <select name="senderTownID" id="senderTownID" class="form-control" required>
                                              <option value="{{providerDetail($request->id,$help_provider->id)['api_delivery_town_id']}}" selected="selected">{{providerDetail($request->id,$help_provider->id)['api_delivery_town_id']}}</option>
                                          </select>
                                      </div>

                                      <div class="col-sm-6">
                                          <label for="Inputdescription">SenderAddress</label>
                                          <input type="text" name="senderAddress" class="form-control" id="senderAddress" value="{{providerDetail($request->id,$help_provider->id)['providerAddress']}}">
                                      </div>
                                    </div>

                                    <!-- <h3>Receiver Details</h3> -->

                                    <div class="row" >
                                      <div class="col-sm-3">
                                          <label for="inputweight">RecipientName</label>
                                          <input type="text" name="RecipientName" class="form-control" id="RecipientName" value="{{$request->user ? $request->user->name : 'N/A'}} {{$request->user ? $request->user->last_name : 'N/A'}}" >
                                      </div>

                                      <div class="col-sm-3">
                                          <label for="exampleInputEmail1">RecipientPhone</label>
                                          <input type="text" name="RecipientPhone" class="form-control" id="RecipientPhone" value="{{$request->user->phone}}" >
                                      </div>

                                      <div class="col-sm-6">
                                          <label for="Inputdescription">RecipientEmail</label>
                                          <input type="text" name="RecipientEmail" class="form-control" id="RecipientEmail" value="{{$request->user->email}}">
                                      </div>
                                    </div>

                                    <div class="row" >

                                      <div class="col-sm-3">
                                          <label for="inputweight">RecipientCity</label>
                                          <select name="RecipientCity" id="RecipientCity" class="form-control" required >
                                            <option value="{{$request->api_city}}" selected="selected">{{$request->api_city}}</option>
                                          </select>
                                      </div>

                                      <div class="col-sm-3">
                                          <label for="exampleInputEmail1">RecipientTownID</label>
                                          <select name="RecipientTownID" id="RecipientTownID" class="form-control" required>
                                            <option value="{{$request->api_delivery_town_id}}">{{$request->api_delivery_town_id}}</option>
                                          </select>
                                      </div>

                                      <div class="col-sm-6">
                                          <label for="Inputdescription">RecipientAddress</label>
                                          <input type="text" name="RecipientAddress" class="form-control" id="RecipientAddress" value="{{$request->street}}">
                                      </div>
                                    </div>

                                    <!-- <h3>Shipment Items</h3> -->
                                     @foreach(reqItems($request->id, $request->category->id) as $key => $reqitem)
                              
                              
                                    <div class="row" >
                                      <div class="col-sm-4">
                                          <label for="inputweight">ItemName</label>
                                          <input type="text" name="ShipmentItems[{{$key}}][ItemName]" class="form-control" id="ItemName" value="{{$reqitem->item ? $reqitem->item->name : 'N/A'}}">
                                      </div>

                                      <div class="col-sm-4">
                                          <label for="exampleInputEmail1">ItemUnitCost</label>
                                          <input type="number" name="ShipmentItems[{{$key}}][ItemUnitCost]" class="form-control" id="ItemUnitCost" value="0">
                                      </div>

                                      <div class="col-sm-4">
                                          <label for="Inputdescription">ItemQuantity</label>
                                          <input type="number" name="ShipmentItems[{{$key}}][ItemQuantity]" class="form-control" id="ItemQuantity" value="1">
                                      </div>

                                      <div class="col-sm-4">
                                          <label for="Inputdescription">ItemColour</label>
                                          <input type="text" name="ShipmentItems[{{$key}}][ItemColour]" class="form-control" id="ItemColour" value="ItemColour">
                                      </div>

                                      <div class="col-sm-4">
                                          <label for="Inputdescription">ItemSize</label>
                                          <input type="text" name="ShipmentItems[{{$key}}][ItemSize]" class="form-control" id="ItemColour" value="0">
                                      </div>

                                    </div>
                                  @endforeach
                                    <div id="shipmentItemsContainer"></div>
                                    <div style="clear:both"></div>

                                    <div class="form-group" >
                                        <button type="button" id="addMoreItem" class="btn btn-success btn-custom"><i class="fa fa-plus-circle"></i>  Add more Item</button>
                                    </div>

                                <!-- shipment form end -->

                                </div>

                               <div class="form-group">
                                  <label for="exampleInputEmail1">Comment (Optional)</label>
                                  <textarea type="text" name="comment" class="form-control" id="delievery_cost" value="3500" placeholder="type a comment" ></textarea>
                                </div>
                               
                                <button type="submit" class="btn btn-primary">Accept Request</button>
      					     

                              </form>
                              @else
                              <span class="text-danger"> <br>You are not the owner of this request, hence you are not allowed to approve or reject it</span>
                              @endif
                                @elseif($request_bid->status == 'Approved')
                                <div class="col-md-12">
                                 <div class="float-left">
                                Request Status:<span class=" text-primary"> {{$request_bid->status}}</span>
                              </div>
                             
                            <div class="float-right">
                          @php
                                $get_pickup_request = helpReceiverPickupRequestDetails($request->user->id, $request->id, $request_bid->requester_id);
                          @endphp
                              @if($request_bid->payment_type =='pay on delivery')
                                 @if(paymentStatus($get_pickup_request->PaymentRef) != "Payment Successful")
                  <form action="{{route('initiate_shipping_fee_payment')}}" method="post">
                                  @csrf
                    <input type="hidden" name="waybillNo" value="{{helpReceiverPickupRequestDetails($request_bid->bidder_id, $request->id, $request_bid->requester_id)['WaybillNumber']}}">

                    <input type="hidden" name="pickupRequest_id" value="{{helpReceiverPickupRequestDetails($request_bid->bidder_id, $request->id, $request_bid->requester_id)['id']}}">

                        <button type="submit" class="btn btn-dark">Pay shipping fee</button>
                    </form>

                          @endif
                        @endif
                              </div>
                         
                              <br>
                              <br>
                              <br>
                              <br>
                              <h2>Pickup Request Details</h2>
                             @include('inc.pickupRequestDetails')  

                    </div>

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

@endsection
