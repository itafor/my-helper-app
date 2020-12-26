@extends('layouts.app-blue', ['pageSlug' => 'requests'])


@section('content')

<!-- d -->
      <div class="page-wrap">
        <div class="container">
            <div class="row">
                
              <div class="col-md-12 content-wrapper pt-40 pb-40">
                <div class="card">     
                
                  <div class="card-header bs-padded">
                     <div class="col-md-8 float-left">
                        <h2>Submitting Pickup Request Information and Generation of Waybill Number</h2>                       
                      </div>
                      <div class="col-md-4 float-right">
                        <div class="float-right">				
                					@if($request_bid->status == 'Pending')
                					<button class="btn btn-dark text-danger" onclick="rejectRequest({{ $request_bid->id  }})">Reject Request</button>

                					@endif
  				              </div>
  				            </div>
                  </div>

				  <div class="card-body">
             @foreach(deliveryFee($request->api_city,providerDetail($request->id,$request_bidder->id)['api_city'],$request->weight,providerDetail($request->id,$request_bidder->id)['api_delivery_town_id']) as $fee)
            <table class="table table-bordered" id="rental_table">
           
                    <tbody>
                      <br>
                      <h2>Delivery fee and Receiver details</h2>

                    <tr>
                     <td class="rent_title">Item Size</td>
                     <td> 
                        {{itemSize($request->weight)}}
                       
                      </td> 
                   </tr>

                   <tr>
                     <td class="rent_title">Delivery Fee</td>
                     <td> 
                         &#8358;{{number_format($fee['DeliveryFee'],2)}} 
                       
                      </td> 
                   </tr>

                   <tr>
                     <td class="rent_title">Vat Amount</td>
                     <td>  
                 &#8358;{{number_format($fee['VatAmount'],2)}}
                      </td>
                   </tr>

                   <tr>
                     <td class="rent_title">Total Amount</td>
                     <td>
                 &#8358;{{number_format($fee['TotalAmount'],2)}}
                     </td>
                   </tr>

                    <tr>
                     <td class="rent_title">Receiver City</td>
                     <td>
                {{providerDetail($request->id,$request_bidder->id)['api_city']}}
                     </td>
                   </tr>
                 <tr>
                     <td class="rent_title">Receiver Address</td>
                     <td>
                {{providerDetail($request->id,$request_bidder->id)['providerAddress']}}
                     </td>
                   </tr>
                 <tr>
                     <td class="rent_title">Receiver Name</td>
                     <td>
                {{$request_bidder ? $request_bidder->name : 'N/A'}} {{$request_bidder ? $request_bidder->last_name : 'N/A'}}
                     </td>
                   </tr>

                   <tr>
                     <td class="rent_title">Receiver Email</td>
                     <td>
                {{$request_bidder->email}}
                     </td>
                   </tr>
                  <tr>
                     <td class="rent_title">Receiver Phone number</td>
                     <td>
                {{$request_bidder->phone}}
                     </td>
                   </tr>

                   <tr>
                     <td class="rent_title">Shipping Fee Payer</td>
                     <td>
                 {{$request->delivery_cost_payer =='prepaid' ? 'Help Provider will pay for Shipping fee':'Help Receiver will pay for Shipping fee'}}
                     </td>
                   </tr>
              </tbody>
          </table>
                            @endforeach
            <hr>
 
           @if($request_bid->status == 'Pending')
            <span style="font-size: 20px;"> Request Status:</span> <span class="text-danger" style="font-size: 20px;"> <strong>{{$request_bid->status}}</strong></span>

             @elseif($request_bid->status == 'Approved')
                             
                              <div class="col-md-12-12">
                             
                              <div class="float-left">
                                 Request Status:<span class=" text-primary"> Request {{$request_bid->status}} and pickup request sent</span>
                                 <br>
                                <a href="{{URL::route('pickupRequest.details', [$request->id, $help_provider->id, $request_bidder->id] )}}">
                                  <button class="btn btn-primary">View details</button>
                                </a>
                              </div>
                                
                              <div class="float-right">

                             Payment Status:  {{paymentStatus(helpProviderPickupRequestDetails($help_provider->id, $request->id, $request_bid->bidder_id)['PaymentRef'])}}

                                 @if($request->delivery_cost_payer =='prepaid')
                                <form action="{{route('initiate_shipping_fee_payment')}}" method="post">
                                  @csrf
                    <input type="text" name="waybillNo" value="{{helpProviderPickupRequestDetails($help_provider->id, $request->id, $request_bid->bidder_id)['WaybillNumber']}}">

                    <input type="hidden" name="pickupRequest_id" value="{{helpProviderPickupRequestDetails($help_provider->id, $request->id, $request_bid->bidder_id)['id']}}">

                                  <button type="submit" class="btn btn-success">Pay shipping fee</button>
                                </form>
                                @endif
                              </div>
                         </div>        

            @elseif($request_bid->status == 'Rejected')
                              Request Status: <span class=" text-danger"> {{$request_bid->status}}</span>
            @elseif($request_bid->status == 'Delivered')
                              Request Status:<span class=" text-success"> {{$request_bid->status}}</span>
            @endif

				   <hr>
				   <div class="col-sm-12">
				  

					       <form class="form" method="post" action="{{ route('request.approve.store') }}" id="approveRequest">
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

                        <div style="display: none;" >
                     <div class="row">
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
                                                        <option  value="{{ $deliverytype['DeliveryTypeName'] }}" {{$deliverytype['DeliveryTypeName'] =='Normal Delivery' ? 'selected' : ''}}>{{ $deliverytype['DeliveryTypeName'] }}</option>
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
                            <input type="text" name="senderPhone" class="form-control" id="senderPhone" value="{{$request->user->phone}}" >
                            </div>
                            <div class="col-sm-4">
                                <label for="exampleInputEmail1">SenderEmail</label>
                            <input type="email" name="senderEmail" class="form-control" id="senderEmail" value="{{$request->user->email}}">
                            </div>
                          </div>


                          <div class="row">
                            <div class="col-sm-3">
                            <label for="inputweight">SenderCity</label>

                           <input name="senderCity" id="senderCity" class="form-control" value="{{$request->api_city}}" required>



                            </div>
                            <div class="col-sm-3">
                                <label for="exampleInputEmail1">SenderTownID</label>
                                 <input name="senderTownID" id="senderTownID" class="form-control" value="{{$request->api_delivery_town_id}}" required>
                            </div>
                            <div class="col-sm-6">

                              <label for="Inputdescription">SenderAddress</label>
                            <input type="text" name="senderAddress" class="form-control" id="senderAddress" value="{{$request->street}}">
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
                                                <input name="RecipientCity" id="RecipientCity" class="form-control" value="{{providerDetail($request->id,$request_bidder->id)['api_city']}}" required >
                                                
                            </div>
                            <div class="col-sm-3">
                                <label for="exampleInputEmail1">RecipientTownID</label>
                                <input name="RecipientTownID" id="RecipientTownID" class="form-control" value="{{providerDetail($request->id,$request_bidder->id)['api_delivery_town_id']}}" required>
                            
                            </div>
                            <div class="col-sm-6">

                              <label for="Inputdescription">RecipientAddress</label>
                            <input type="text" name="RecipientAddress" class="form-control" id="RecipientAddress" value="{{providerDetail($request->id,$request_bidder->id)['providerAddress']}}">
                          </div>
                          </div>

                          <h3>Shipment Items</h3>

                          <div class="row">
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


                                <div id="shipmentItemsContainer">
                                
         
                                </div>
                                  <div style="clear:both"></div>

                                     <div class="form-group">
                                    <button type="button" id="addMoreItem" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i>  Add more Item</button>
                                </div>
                                </div>

                     {{--<div>
                            <label for="exampleInputEmail1">Comment (Optional)</label>
                            <textarea type="text" name="comment" class="form-control" id="delievery_cost" value="3500" placeholder="type a comment" ></textarea>
                          </div>--}}

                           @if($request_bid->status == 'Pending')
                          <button type="submit" class="btn btn-primary float-left">Approve and Submit Pickup Request</button>
					      <button type="button"  class="btn btn-danger float-right text-danger" onclick="rejectRequest({{ $request_bid->id  }})">Reject request</button>

                @elseif($request_bid->status == 'Approved')
                    <!-- Request Status:<span class=" text-primary">{{$request_bid->status}}</span> -->
                @elseif($request_bid->status == 'Rejected')
                    Request Status: <span class=" text-danger" style="font-size: 20px;"> {{$request_bid->status}}</span>
                @elseif($request_bid->status == 'Delivered')
                    Request Status:<span class=" text-success" style="font-size: 20px;"> {{$request_bid->status}}</span>
                @endif

                        </form>
                    
                    </div>





				  </div>
				</div>

           
             <div class="card">
              <div class="card-header">
                <h4 class="card-title">Your Request (Help provided)</h4>
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
                      <img src="{{$photo->image_url}}" onclick="myFunction(this);" alt="Sample image" style="width: 15%;">
                    </div>
                    
                    @endforeach
                  
               @endif
                                
                            </div>

                  <footer class="blockquote-footer">Here is your request <cite title="Source Title">to provide help</cite></footer>
              </div>
            </div>

                  {{--<div class="card">
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
            </div>--}}

                </div>
                <!-- /tables -->

              </div>
              <!-- /card body -->

            </div>
            <!-- /card -->

          </div>
          <!-- /grid item -->
        </div>
       < <!-- /grid -->
</div>


@endsection

