@extends('layouts.app-blue', ['pageSlug' => 'Requests'])
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
    <div class="page-wrap">
        <div class="container">
            <div class="row">
                
              <div class="col-md-12 content-wrapper pt-40 pb-40">
                  <div class="card">         
                      <div class="row card-header bs-padded">
                          <div class="col-md-8">
                              <h2>Pickup Request Details</h2>
                          </div>
                          <div class="col-md-4">
                              <div class="float-right">
                                <a  href="{{ route('pickupRequest.shipmenttracker') }}">
                                  <button class="btn btn-warning btn-sm">Track Shippment Status</button>
                                </a>
                              </div>
                          </div>
                      </div>
               

                      <div class="card-body">
                   


                      @include('inc.pickupRequestDetails')


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
        </div>
  </div>
@endsection
