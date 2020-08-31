
@extends('admin.layouts.master', ['pageSlug' => 'admin_dashboard'])



@section('title')

Admin | Logistic Agents

@endsection

@section('content')


 <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title float-left">Request details </h4>

                <h4 class="card-title float-right">
                  <a href="{{route('admin.dashboard')}}">
                  <button class="btn btn-primary btn-sm">
               Back to List
                  <i class="fa fa-arrow-right" aria-hidden="true"></i>
              </button> 
              </a>
            </h4>
              </div>
              <div class="card-body">
                <!-- <div class="table-responsive"> -->
                  <br><br>
                  <dl class="row">
  <dt class="col-sm-3">Id</dt>
  <dd class="col-sm-9">{{$request_details->id}}</dd>

  <dt class="col-sm-3">Date</dt>
  <dd class="col-sm-9">
    {{\Carbon\Carbon::createFromTimeStamp(strtotime($request_details->created_at))->diffForHumans()}}
  </dd>

  <dt class="col-sm-3">Request Type</dt>
  <dd class="col-sm-9">
    {{$request_details->request_type == 2 ? 'Supply' : 'Request'}}
  </dd>

   <dt class="col-sm-3">Category</dt>
  <dd class="col-sm-9">
    {{ $request_details->category ? $request_details->category->title : 'N/A' }}
  </dd>

   <dt class="col-sm-3">Display Name</dt>
  <dd class="col-sm-9">
   {{ $request_details->user ? $request_details->user->username : 'N/A' }}
  </dd>

   <dt class="col-sm-3">Description</dt>
  <dd class="col-sm-9">
   <p>{{ $request_details->description }}</p>
  </dd>

   <dt class="col-sm-3">Type</dt>
  <dd class="col-sm-9">
{{$request_details->type}}
  </dd>

  <dt class="col-sm-3 text-truncate">City</dt>
  <dd class="col-sm-9">

     {{ $request_details->city ? $request_details->city->name : 'N/A' }}
                       
  </dd>
</dl>
                <!-- </div> -->

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
                  
               @endif
              </div>
            </div>
          </div>
        </div>





        <div class="row">
     
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> {{$request_details->request_type == 2 ? 'Help provider details' : 'Help requester details'}}</h4>
              </div>
              <div class="card-body">
                <dl class="row">
  <dt class="col-sm-6">Id</dt>
  <dd class="col-sm-6">{{$request_details->user ? $request_details->user->id : 'N/A'}}</dd>

  <dt class="col-sm-6">First Name</dt>
  <dd class="col-sm-6">
    {{$request_details->user ? $request_details->user->name : 'N/A'}}
  </dd>

  <dt class="col-sm-6">Last Name</dt>
  <dd class="col-sm-6">
    {{$request_details->user ? $request_details->user->last_name : 'N/A'}}
  </dd>

   <dt class="col-sm-6">Display Name</dt>
  <dd class="col-sm-6">
   {{ $request_details->user ? $request_details->user->username : 'N/A' }}
  </dd>

   <dt class="col-sm-6">Phone</dt>
  <dd class="col-sm-6">
   {{ $request_details->user ? $request_details->user->phone : 'N/A' }}
  </dd>

   <dt class="col-sm-6">Email</dt>
  <dd class="col-sm-6">
   {{ $request_details->user ? $request_details->user->email : 'N/A' }}
  </dd>


  <dt class="col-sm-6">State</dt>
  <dd class="col-sm-6">
   {{ $request_details->user ? $request_details->user->api_state : 'N/A' }}
  </dd>


  <dt class="col-sm-6">City</dt>
  <dd class="col-sm-6">
   {{ $request_details->user ? $request_details->user->api_city : 'N/A' }}
  </dd>
</dl>
              </div>
            </div>
          </div>
        </div>


<div class="row">
     
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> {{$request_details->request_type == 2 ? 'Users that applied to receive the above help' : 'Users interested to provide the above request'}}</h4>
              </div>
              <div class="card-body">
                 <div class="table-responsive">
                  <table class="table tablesorter" id="requests">
                    <thead class=" text-primary">
                       <tr>
                      <th> Full name </th>
                      <th> Phone </th>
                      <th> Email </th>
                      <th> Status </th>
                      <th> Actions </th>
                        </tr>
                     
                    </thead>
                    <tbody>
                      @foreach($help_request_bidders as $bid)
                      <tr>
                        <td>{{$bid->requester ? $bid->requester->name : 'N/A'}} 
                            {{$bid->requester ? $bid->requester->last_name : 'N/A'}}
                        </td>
                        <td>{{$bid->requester ? $bid->requester->phone : 'N/A'}} </td>
                        <td>{{$bid->requester ? $bid->requester->email : 'N/A'}} </td>
                        <td>
                            @if($bid->status == 'Approved')
                           <span style="color: green; font-size: 14px;">{{$bid->status}}</span>  
                            @elseif($bid->status =='Pending')
                           <span style="color: brown; font-size: 14px;">{{$bid->status}}</span>
                           @elseif($bid->status == 'Delivered')
                           <span style="color: blue; font-size: 14px;">{{$bid->status}}</span>  
                            @elseif($bid->status == 'Rejected')
                           <span style="color: red; font-size: 14px;">{{$bid->status}}</span>  
                           @endif
                        </td>
                     <td>
                     <a href="{{route('admin.get.request.summary',[$bid->id])}}">
                          <button class="btn btn-sm btn-success"><i class="fa fa-eye" title="View"></i></button>
                          </a>
                        </td>
                       
                      </tr>
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