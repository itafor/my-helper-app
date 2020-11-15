
@extends('logisticPartner.layouts.master',['pageSlug' => 'logisticPartner_request'])



@section('title')

logistic Partner | Requests

@endsection

@section('content')

  <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title float-left"> All Requests</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                 <table class="table tablesorter" id="requests">
                    <thead class=" text-primary">
                       <tr>
                      <th> S/N </th>
                      <th> Request Type </th>
                      <th> Category </th>
                      <th> Details </th>
                      <th> Status </th>
                      <th> Actions </th>
                        </tr>
                     
                    </thead>
                    <tbody>
                       @php
                          $i = 1;
                      @endphp
                      @foreach($all_requests as $req)
                      <tr>
                        <td>{{$i}} </td>

                        <td>{{$req->request->request_type == 2 ? 'Supply' : 'Request'}} 
                           
                        </td>
                         <td>{{ $req->request->category ? $req->request->category->title : 'N/A' }} </td>

                        <td>{{ Str::limit($req->request->description, 30) }}</td>
                       
                        <td>
                            @if($req->status == 'Approved')
                           <span style="color: green; font-size: 14px;">{{$req->status}}</span>  
                            @elseif($req->status =='Pending')
                           <span style="color: brown; font-size: 14px;">{{$req->status}}</span>
                           @elseif($req->status == 'Delivered')
                           <span style="color: blue; font-size: 14px;">{{$req->status}}</span>  
                            @elseif($req->status == 'Rejected')
                           <span style="color: red; font-size: 14px;">{{$req->status}}</span>  
                           @endif

                        </td>
                     
                     <td>
                     <a href="{{route('logistic_partner.request.initialconfirmation',[$req->id])}}">
                          <button class="btn btn-sm btn-success"><i class="fa fa-eye" title="View"></i></button>
                          </a>
                        </td>
                       
                      </tr>
                       @php
                       $i++;
                    @endphp  
                     @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        
        </div>

@endsection


@section('scripts')


@endsection