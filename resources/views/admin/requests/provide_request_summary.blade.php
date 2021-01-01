
@extends('admin.layouts.master', ['pageSlug' => 'admin_dashboard'])



@section('title')

Request | Summary

@endsection

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
<div class="float-left">
  Pickup Request Details
</div>
<div class="float-right">
   <a  href="{{ route('admin.pickupRequest.shipmenttracker') }}"><button class="btn btn-warning btn-sm">Track Shippment Status 
  </button>
    </a>
</div>
  </div>
          <div class="card-body">
            <br>
           <hr>
           <div class="col-sm-6">
           @if($request_bid->status == 'Pending')
                    Request Status:<span class="text-danger"> <strong>{{$request_bid->status}}</strong></span>
                    @elseif($request_bid->status == 'Approved')
                    Request Status:<span class=" text-primary"><strong> {{$request_bid->status}}</strong></span>
                    <hr>
                    @if($get_pickup_request)
                           <table class="table table-bordered" id="rental_table">
           
                    <tbody>
                   <tr>
                     <td class="rent_title">Transaction Status</td>
                     <td> 
                        {{$get_pickup_request->TransStatus}} 
                       
                      </td> 
                   </tr>

                   <tr>
                     <td class="rent_title">Transaction Status Details</td>
                     <td>  
                {{$get_pickup_request->TransStatusDetails}}
                      </td>
                   </tr>

                   <tr>
                     <td class="rent_title">Order No.</td>
                     <td>
                {{$get_pickup_request->OrderNo}}
                     </td>
                   </tr>

                     <tr>
                     <td class="rent_title">Way Bill Number</td>
                     <td>
                {{$get_pickup_request->WaybillNumber}}
 
                     </td>
                   </tr>

                    <tr>
                     <td class="rent_title">Delivery Fee</td>
                <td>
                &#8358;{{$get_pickup_request->DeliveryFee}}
                </td>           
              </tr>

                 <tr>
                     <td class="rent_title">Vat Amount</td>
                     <td>
                 &#8358;{{$get_pickup_request->VatAmount}}
                     </td>
                </tr>

                 <tr>
                     <td class="rent_title">Total Amount</td>
                     <td>
                 &#8358;{{$get_pickup_request->TotalAmount}}
                    
                    </td>
                </tr>

                  <tr>
                     <td class="rent_title">Payment Reference</td>
                     <td>
                 {{$get_pickup_request->PaymentRef ? $get_pickup_request->PaymentRef : 'N/A'}}
                    
                    </td>
                </tr>
                 <tr>
                     <td class="rent_title">Payment Status</td>
                     <td>
                 {{$get_pickup_request->PaymentRef ? paymentStatus($get_pickup_request->PaymentRef) : 'N/A'}}
                    
                    </td>
                </tr>

                <tr>
                     <td class="rent_title">Description</td>
                     <td>
                 {{$get_pickup_request->Description}}
                    
                    </td>
                </tr>

                    <tr>
                     <td class="rent_title">Item Size</td>
                     <td>
                 {{itemSize($get_pickup_request->Weight)}}
                    
                    </td>
                </tr>

                  <tr>
                     <td class="rent_title">Sender Name</td>
                     <td>
                 {{$get_pickup_request->SenderName}}
                    
                    </td>
                </tr>

                  <tr>
                     <td class="rent_title">Sender City</td>
                     <td>
                 {{$get_pickup_request->SenderCity}}
                    
                    </td>
                </tr>

                  <tr>
                     <td class="rent_title">Sender Town ID</td>
                     <td>
                 {{$get_pickup_request->SenderTownID}}
                    
                    </td>
                </tr>

                 <tr>
                     <td class="rent_title">Sender Address</td>
                     <td>
                 {{$get_pickup_request->SenderAddress}}
                    
                    </td>
                </tr>


                 <tr>
                     <td class="rent_title">Sender Phone</td>
                     <td>
                 {{$get_pickup_request->SenderPhone}}
                    
                    </td>
                </tr>

                 <tr>
                     <td class="rent_title">Sender Email</td>
                     <td>
                 {{$get_pickup_request->SenderEmail}}
                    
                    </td>
                </tr>

                 <tr>
                     <td class="rent_title">Recipient Name</td>
                     <td>
                 {{$get_pickup_request->RecipientName}}
                    
                    </td>
                </tr>

                <tr>
                     <td class="rent_title">Recipient City</td>
                     <td>
                 {{$get_pickup_request->RecipientCity}}
                    
                    </td>
                </tr>

                <tr>
                     <td class="rent_title">Recipient Town ID</td>
                     <td>
                 {{$get_pickup_request->RecipientTownID}}
                    
                    </td>
                </tr>

                <tr>
                     <td class="rent_title">Recipient Address</td>
                     <td>
                 {{$get_pickup_request->RecipientAddress}}
                    
                    </td>
                </tr>

                 <tr>
                     <td class="rent_title">RecipientPhone</td>
                     <td>
                 {{$get_pickup_request->RecipientPhone}}
                    
                    </td>
                </tr>

                 <tr>
                     <td class="rent_title">Recipient Email</td>
                     <td>
                 {{$get_pickup_request->RecipientEmail}}
                    
                    </td>
                </tr>

                 <tr>
                     <td class="rent_title">Payment Type</td>
                     <td>
                 {{$get_pickup_request->PaymentType}}
                    
                    </td>
                </tr>

                 <tr>
                     <td class="rent_title">DeliveryType</td>
                     <td>
                 {{$get_pickup_request->DeliveryType}}
                    
                    </td>
                </tr>
       </tbody>
                  </table>

                   <h3>Items</h3>
                       @if($get_pickup_request->shipment_items)
                        <div class="table-responsive">
                          <table class="table table-bordered">
                          <thead>
                            <tr>
                          <th>Item Name</th>
                          <th>Item Qty</th>
                        </tr>
                          </thead>
                         
                         <tbody>
                       @foreach($get_pickup_request->shipment_items as $item)
                        <tr>
                           <td>  {{$item->ItemName}} </td>
                           <td>  {{$item->ItemQuantity}} </td>
                        </tr>
                        @endforeach
                         </tbody>

                        </table>
                       </div>
                        @else
                       <span>No item found</span>
                       @endif

                  @else
                  <span>Pickup request not yet submitted</span>
                  @endif
                    <hr>
                    @elseif($request_bid->status == 'Rejected')
                    Request Status: <span class=" text-danger"> <strong>{{$request_bid->status}}</strong></span>
                     @elseif($request_bid->status == 'Delivered')
                    Request Status:<span class=" text-success"> <strong>{{$request_bid->status}}</strong></span>
                  @endif
                    </div>





          </div>
        </div>

           
             <div class="card">
              <div class="card-header">
              Sample photos
              </div>
              <div class="card-body">
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
                  @else
                  <small>No photo found</small>
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


@section('scripts')


@endsection