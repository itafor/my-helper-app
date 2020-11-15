@extends('layouts.app', ['pageSlug' => 'Requests'])
<style type="text/css">
      #rental_table {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size: 12px;
}

#rental_table td{
  border: 1px solid #ddd;
  padding: 8px;
}
#rental_table .rent_title{
  width: 150px;
}
</style>
@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
               <div class="card">
  <div class="card-header">
<div class="float-left">
  Pickup Request Details
</div>
<div class="float-right">
   <a  href="{{ route('pickupRequest.shipmenttracker') }}"><button class="btn btn-warning btn-sm">Track Shippment Status 
  </button>
    </a>
</div>
  </div>
  
   

  <div class="card-body">
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
                     <td class="rent_title">Description</td>
                     <td>
                 {{$get_pickup_request->Description}}
                    
                    </td>
                </tr>

                  <tr>
                     <td class="rent_title">Weight</td>
                     <td>
                 {{$get_pickup_request->Weight}}
                    
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
                  @else
                  <span>Pickup request not yet submitted</span>
                  @endif
  <hr>
    {{--<h4>Shipment Items</h4>
    @if(count(shippmentItems($get_pickup_request->id,$get_pickup_request->request_id,$get_pickup_request->provider_id,$get_pickup_request->receiver_id)) >= 1)
    <div class="table-responsive">
                 <table class="table tablesorter" id="requests">
                    <thead class=" text-primary">
                       <tr>
                      <th> S/N </th>
                      <th> ItemName </th>
                      <th> ItemUnitCost </th>
                      <th> ItemQuantity </th>
                      <th> ItemColour </th>
                      <th> ItemSize </th>
                        </tr>
                     
                    </thead>
                    <tbody>
                       @php
                          $i = 1;
                      @endphp
                      @foreach($get_pickup_request->shipment_items as $item)
                      <tr>
                        <td>{{$i}} </td>
                        <td>{{$item->ItemName}} </td>
                        <td>{{$item->ItemUnitCost}} </td>
                        <td>{{$item->ItemQuantity}} </td>
                        <td>{{$item->ItemColour}} </td>
                        <td>{{$item->ItemSize}} </td>
                      </tr>
                       @php
                       $i++;
                    @endphp  
                     @endforeach
                    </tbody>
                  </table>
                </div>
    @else
    <span>No Item found</span>

    @endif
    --}}
  </div>
</div>
        </div>
    </div>
    
@endsection
