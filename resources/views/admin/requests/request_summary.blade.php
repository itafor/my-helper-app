
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
        <div class="float-left">Help seeker details (Receiver)</div>
        <div class="float-right">
          @if($request_bid->status == 'Pending')
          <button class="btn btn-danger btn-sm" onclick="rejectRequest({{ $request_bid->id  }})">Reject Request</button>
          @endif
        </div>
          </div>
          <div class="card-body">
            <br>
                  <dl class="row">
  <dt class="col-sm-3">Full Name</dt>
  <dd class="col-sm-9">
    {{$request_bidder ? $request_bidder->name : 'N/A'}} 
    {{$request_bidder ? $request_bidder->last_name : 'N/A'}}
  </dd>

  <dt class="col-sm-3">Phone Number</dt>
  <dd class="col-sm-9">
   {{$request_bidder ? $request_bidder->phone : 'N/A'}}
  </dd>

   <dt class="col-sm-3"> Email</dt>
  <dd class="col-sm-9">
    {{$request_bidder ? $request_bidder->email : 'N/A'}}
  </dd>

   <dt class="col-sm-3">Country</dt>
  <dd class="col-sm-9">
    {{$request_bidder->country ? $request_bidder->country->country_name : 'N/A'}}
  </dd>

   <dt class="col-sm-3">State</dt>
  <dd class="col-sm-9">
    {{$request_bidder->state ? $request_bidder->state->name : 'N/A'}}
  </dd>

   <dt class="col-sm-3">City</dt>
  <dd class="col-sm-9">
    {{$request_bidder->city ? $request_bidder->city->name : 'N/A'}}
  </dd>

  <dt class="col-sm-3 text-truncate">Street Address</dt>
  <dd class="col-sm-9">

     <p>{{$request_bidder ? $request_bidder->street: 'N/A'}}</p>
                       
  </dd>
  
</dl>
           <hr>
           <div class="col-sm-6">
           @if($request_bid->status == 'Pending')
                    Request Status:<span class="text-danger"> <strong>{{$request_bid->status}}</strong></span>
                    @elseif($request_bid->status == 'Approved')
                    Request Status:<span class=" text-primary"><strong> {{$request_bid->status}}</strong></span>
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
              Request (Help provided)
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
                                        </strong>for <b>free</b> <strong>{{ $request->category ? $request->category->title : '' }} - ({{ $request->description }})</strong> around <strong>{{ $request->city->name }}, {{ $request->state->name }}</strong>.
                                    
                                    </p>
                                    <p>Thank you</p>
                                    <p><strong>{{ $request->user->username }}</strong></p> 
                                    @if($request->show_address == 1)
                                        <p>Address: {{ $request->street }}</p>
                                    @endif
                                
                            </div>

                  <footer class="blockquote-footer">Request <cite title="Source Title">to provide help</cite></footer>
              </div>
            </div>


                  <div class="card">
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