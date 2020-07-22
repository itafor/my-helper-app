
@extends('admin.layouts.master', ['pageSlug' => 'all_requests'])



@section('title')

Admin | Logistic Agents

@endsection

@section('content')



        <div class="row">
          <div class="col-md-6">
            <div class="card  card-tasks">
              <div class="card-header ">
                <h5 class="card-category">Request Details</h5>
                <!-- <h4 class="card-title">Tasks</h4> -->
              </div>
              <div class="card-body ">
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
               
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <!-- <i class="now-ui-icons loader_refresh spin"></i> Updated 3 minutes ago -->
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-category">{{$request_details->request_type == 2 ? 'Provider details' : 'Requester details'}}</h5>
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

  <dt class="col-sm-6">Country</dt>
  <dd class="col-sm-6">
   {{ $request_details->user ? $request_details->user->country->country_name : 'N/A' }}
  </dd>

  <dt class="col-sm-6">State</dt>
  <dd class="col-sm-6">
   {{ $request_details->user ? $request_details->user->state->name : 'N/A' }}
  </dd>


  <dt class="col-sm-6">City</dt>
  <dd class="col-sm-6">
   {{ $request_details->user ? $request_details->user->state->name : 'N/A' }}
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
                <h4 class="card-title float-left"> Request details </h4>

                <h4 class="card-title float-right">
                  <a href="{{route('admin.all.requests')}}">
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
              </div>
            </div>
          </div>
        </div>

@endsection


@section('scripts')


@endsection