
@extends('layouts.app', ['pageSlug' => 'requests'])


@section('content')

 <!-- Grid -->
        <div class="row header-body">

          <!-- Grid Item -->
          <div class="col-xl-12 track-cards">

            <div class="welcome-cards">
              <!-- Card -->
              <div class="card" id="card">
                
				        <div class="card-header">
                	 <div class="col-md-8">
                      <h4 class="card-title">Approve or Reject Request to Get Help</h4>                				
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
                      
                          <button type="submit" class="btn btn-danger float-left btn-custom">Reject Request</button>

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
                          <dt class="col-sm-3 text-truncate">Pickup Status</dt>
                          <dd class="col-sm-9">
                            @if($request_bid->pickup_status == 'Success')
                             <p>
                            <a href="{{URL::route('pickupRequest.details', [$request->id, $help_provider->id, $request->user->id] )}}">
                                               View and track shipment status</a>
                             </p>
                               @else
                               <span>N/A</span>
                               @endif                
                          </dd>
                        </dl>
                    </label>

                    <hr>
                    
                    <div class="request-card">
                      <h4>REQUEST: Welcome to my page - <strong>{{ $request->user->username ? $request->user->username : $request->user->company_name }}</strong></h4>
                      <div class="request-cards">
                          <label>
                            I need {{ $request->category ? $request->category->title : '' }} ({{ $request->description }}) around {{ ucfirst(Str::lower($request->api_city))}}, {{ ucfirst(Str::lower($request->api_state))}} ({{ $request->street }})

                            <p>Status: <strong class="text-danger">{{$request_bid->status}}</strong></p>
                            <p>Weight: <strong class="text-danger">{{$request->weight}}kg</strong></p>
                            <p>Delivery Fee Payer: <strong class="text-danger">{{$request->delivery_cost_payer =='prepaid' ? 'Sender will pay for Shipping cost':'Receiver will pay for Shipping cost'}}</strong></p>
                          </label> 

                          @if(isset($request_photos) && $request_photos !='')

                          <h4>Sample photos uploaded by the provider ({{$help_provider ? $help_provider->name : 'N/A'}} 
                            {{$help_provider ? $help_provider->last_name : 'N/A'}})</h4>
                
                          <!--Tab Gallery: The expanding image container -->
                          <div class="container" >
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
                              <img src="{{$photo->image_url}}" onclick="myFunction(this);" alt="Sample image" style="width: 100px; height: 100px;">
                            </div>
                            
                            @endforeach
                          @endif
                      </div>
                    </div>

				            <div class="col-sm-6">
                      <div class="table-responsive">

                      @foreach(deliveryFee($request->api_city,providerDetail($request->id,$help_provider->id)['api_city'],$request->weight,providerDetail($request->id,$help_provider->id)['api_delivery_town_id']) as $fee)
                        <table class="table table-bordered" id="rental_table">
           
                          <tbody>
                          <br>
                            <h5>Delivery fee detail</h5>
                            <tr>
                               <td class="rent_title">Delivery Fee</td>
                               <td>&#8358;{{number_format($fee['DeliveryFee'],2)}}</td> 
                            </tr>

                            <tr>
                               <td class="rent_title">Vat Amount</td>
                               <td>&#8358;{{number_format($fee['VatAmount'],2)}}</td>
                            </tr>

                            <tr>
                                <td class="rent_title">Total Amount</td>
                                <td>&#8358;{{number_format($fee['TotalAmount'],2)}}</td>
                            </tr>
                          </tbody>
                        </table>

                        @endforeach
                        </div>

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
                                  <textarea name="description" class="form-control" id="description">{{ $request->category ? $request->category->title : '' }} : {{ $request->description }}</textarea>
                                </div>

                                <div class="col-sm-2">
                                    <label for="inputweight">Weight</label>
                                    <input type="text" name="weight" class="form-control" id="weight" value="{{$request->weight}}" >
                                </div>

                                <div class="col-sm-3">
                                  <label for="exampleInputEmail1">PaymentType</label>
                                  <select name="PaymentType" id="PaymentType" class="form-control" required >
                                      <option value="">Select payment type</option>
                                      @foreach(payment_types() as $paymentype)
                                      <option  value="{{ $paymentype['PaymentType'] }}" {{$request->delivery_cost_payer ==
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

                              <div class="row" >

                                <div class="col-sm-3">
                                    <label for="inputweight">ItemName</label>
                                    <input type="text" name="ShipmentItems[112211][ItemName]" class="form-control" id="ItemName" value="ItemName">
                                </div>

                                <div class="col-sm-2">
                                    <label for="exampleInputEmail1">ItemUnitCost</label>
                                    <input type="number" name="ShipmentItems[112211][ItemUnitCost]" class="form-control" id="ItemUnitCost" value="0">
                                </div>

                                <div class="col-sm-2">
                                    <label for="Inputdescription">ItemQuantity</label>
                                    <input type="number" name="ShipmentItems[112211][ItemQuantity]" class="form-control" id="ItemQuantity" value="0">
                                </div>

                                <div class="col-sm-3">
                                    <label for="Inputdescription">ItemColour</label>
                                    <input type="text" name="ShipmentItems[112211][ItemColour]" class="form-control" id="ItemColour" value="ItemColour">
                                </div>

                                <div class="col-sm-2">
                                    <label for="Inputdescription">ItemSize</label>
                                    <input type="text" name="ShipmentItems[112211][ItemSize]" class="form-control" id="ItemColour" value="0">
                                </div>

                              </div>

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
