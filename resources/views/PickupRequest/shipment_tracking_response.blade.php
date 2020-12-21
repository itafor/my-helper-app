@extends('layouts.app-blue', ['pageSlug' => 'shipment_tracker'])

@section('content')
    <div class="page-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-10 page-auto">
                    <div class="form-wrap mt-20 mb-20">
                      <div id="card" class="card">
                        <div class="card-header text-center">
                            <h2>Shipment Tracking Response</h2>
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
      </div>
    </div>
@endsection
