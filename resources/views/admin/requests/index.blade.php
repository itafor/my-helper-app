
@extends('admin.layouts.master', ['pageSlug' => 'all_requests'])



@section('title')

Admin | All Requests

@endsection

@section('content')

  <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title float-left"> All Requests</h4>

                <h4 class="card-title float-right">
                  <a href="{{route('admin.logistic.agent.add')}}">
                  <button class="btn btn-primary btn-sm">
                  <i class="fa fa-plus"></i>
                Add new
              </button> 
              </a>
            </h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter" id="requests">
                    <thead class=" text-primary">
                       <tr>
                      <th> S/N </th>
                      <th> Time </th>
                      <th> Request Type </th>
                      <th> Category </th>
                      <th> Display Nmae </th>
                      <th> Details </th>
                      <th> Type </th>
                      <th> City </th>
                      <th> Actions </th>
                        </tr>
                     
                    </thead>
                      
                    <tbody>
                      @php
                          $i = 1;
                      @endphp
                      @foreach($all_requests as $request)
                      <tr>
                        <td>{{$i}} </td>
                            <td>
                              {{\Carbon\Carbon::createFromTimeStamp(strtotime($request->created_at))->diffForHumans()}}
                            </td>
                        <td>{{$request->request_type == 2 ? 'Supply' : 'Request'}} </td>
                        <td>{{ $request->category ? $request->category->title : '' }} </td>
                        <td>{{ $request->user ? $request->user->username : '' }}</td>
                        <td>{{ Str::limit($request->description, 30) }}</td>
                        <td>{{$request->type}} </td>
                        <td>{{ $request->city ? $request->city->name : '' }}</td>
                      
                      @if($request->request_type == 2)
                        <td>
                           <a href="{{route('admin.request.show',[$request->id])}}">
                          <button class="btn btn-sm btn-success"><i class="fa fa-eye" title="View"></i></button>
                          </a>
                        </td>
                      @elseif($request->request_type == 1)
                       <td>
                           <a href="{{route('admin.get.request.show',[$request->id])}}">
                          <button class="btn btn-sm btn-success"><i class="fa fa-eye" title="View"></i></button>
                          </a>
                        </td>
                        @else

                      @endif
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