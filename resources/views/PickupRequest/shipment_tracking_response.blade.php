@extends('layouts.app', ['pageSlug' => 'shipment_tracker'])
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
    <div class="container-fluid mt--7 header-body">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="welcome-cards track-cards">
                  <div id="card" class="card">
                      <div class="card-header">
                          <h4 class="card-title">Shipment Tracking Response</h4>
                      </div>
  <div class="card-body">

    @if(isset($tracking_responses) && count($tracking_responses) >= 1)
    <h3>Shipment tracker responses </h3>
    <div class="table-responsive">
                 <table class="table tablesorter" id="requests">
                    <thead class=" text-primary">
                       <tr>
                      <th> S/N </th>
                      <th> Order No </th>
                      <th> Way Bill Number </th>
                      <th> Status Code </th>
                      <th> Status Description </th>
                      <th> Status Date </th>
                        </tr>
                     
                    </thead>
                    <tbody>
                       @php
                          $i = 1;
                      @endphp
                      @foreach($tracking_responses as $response)
                      <tr>
                        <td>{{$i}} </td>
                        <td>{{$response->OrderNo}} </td>
                        <td>{{$response->WaybillNumber}} </td>
                        <td>{{$response->StatusCode}} </td>
                        <td>{{$response->StatusDescription}} </td>
                        <td>{{$response->StatusDate}} </td>
                      </tr>
                       @php
                       $i++;
                    @endphp  
                     @endforeach
                    </tbody>
                  </table>
                </div>
  
    @endif
    
                </div>
              </div>
    
  </div>
</div>
        </div>
@endsection

    </div>
    