@extends('layouts.app', ['pageSlug' => 'requests'])


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
				<div class="float-left">Approve or Reject Request to Get Help</div>
				<div class="float-right">
           @if(authUser()->id == $request_bid->bidder_id)
					@if($request_bid->status == 'Pending')
					<!-- <button class="btn btn-danger btn-sm" onclick="rejectRequest({{ $request_bid->id  }})">Reject Request</button> -->

              <form class="form" method="post" action="{{ route('request.reject.by.receiver') }}">
                            @csrf
                          <div class="form-group">
                            <input type="hidden" name="request_bid_id" class="form-control" id="request_bid_id" value="{{$request_bid->id}}" >
                          </div>
                          <button type="submit" class="btn btn-danger float-left btn-sm">Reject Request</button>

                        </form>
          @endif
					@endif
				</div>
				  </div>
				  <div class="card-body">
            <h3>Help Provider details</h3>
                  <dl class="row">
  <dt class="col-sm-3">Full Name</dt>
  <dd class="col-sm-9">
    {{$help_provider ? $help_provider->name : 'N/A'}} 
    {{$help_provider ? $help_provider->last_name : 'N/A'}}
  </dd>

  <dt class="col-sm-3">Phone Number</dt>
  <dd class="col-sm-9">
   {{$help_provider ? $help_provider->phone : 'N/A'}}
  </dd>

   <dt class="col-sm-3"> Email</dt>
  <dd class="col-sm-9">
    {{$help_provider ? $help_provider->email : 'N/A'}}
  </dd>

   <dt class="col-sm-3">Pickup State</dt>
  <dd class="col-sm-9">
    {{providerDetail($request->id,$help_provider->id)['api_state']}}
  </dd>

   <dt class="col-sm-3">Pickup City</dt>
  <dd class="col-sm-9">
    {{providerDetail($request->id,$help_provider->id)['api_city']}}
  </dd>

     <dt class="col-sm-3">OnforwardingTownId</dt>
  <dd class="col-sm-9">
    {{providerDetail($request->id,$help_provider->id)['api_delivery_town_id'] ? providerDetail($request->id,$help_provider->id)['api_delivery_town_id'] : 'N/A'}}
  </dd>

  <dt class="col-sm-3 text-truncate">Pickup Address</dt>
  <dd class="col-sm-9">

     <p>{{$help_provider ? $help_provider->street: 'N/A'}}</p>
                       
  </dd>
  
</dl>
				   <hr>
  <h3>REQUEST: Welcome to my page - <strong>{{ $request->user->username ? $request->user->username : $request->user->company_name }}</strong></h3>
                                    <div class="user-request-card">
                                          <label>
                                I need {{ $request->category ? $request->category->title : '' }} ({{ $request->description }}) around {{ ucfirst(Str::lower($request->api_city))}}, {{ ucfirst(Str::lower($request->api_state))}} ({{ $request->street }})
                                      
                                    

                              <p>Status: <strong class="text-danger">{{$request_bid->status}}</strong></p>
                              <p>Weight: <strong class="text-danger">{{$request->weight}}kg</strong></p>
                              <p>Delivery Fee Payer: <strong class="text-danger">{{$request->delivery_cost_payer =='prepaid' ? 'Sender will pay for Shipping cost':'Receiver will pay for Shipping cost'}}</strong></p>
 </label> 
              @if(isset($request_photos) && $request_photos !='')

              <h4>Sample photos uploaded by the provider ({{$help_provider ? $help_provider->name : 'N/A'}} 
    {{$help_provider ? $help_provider->last_name : 'N/A'}})</h4>
                <!--Tab Gallery: The expanding image container -->
                  <div class="container" style="display: none;">
                    <!-- Close the image -->
                    <span onclick="this.parentElement.style.display='none'" class="closebtn" style="width:450px;">&times;</span>

                    <!-- Expanded image -->
                    <img id="expandedImg" style="width:500px; height: 300px;">

                    <!-- Image text -->
                    <div id="imgtext"></div>
                  </div>
                                @foreach($request_photos as $photo)

                    <!-- The grid:-->
                    <div class="column">
                     <!--  <img src="img_nature.jpg" alt="Nature" > -->
                      <img src="{{$photo->image_url}}" onclick="myFunction(this);" alt="Sample image" style="width: 100px; height: 100px;">
                    </div>
                    
                    @endforeach
                   
               @endif
                                
                            </div>




				   <div class="col-sm-6">

             @foreach(deliveryFee($request->api_city,providerDetail($request->id,$help_provider->id)['api_city'],$request->weight,providerDetail($request->id,$help_provider->id)['api_delivery_town_id']) as $fee)
            <table class="table table-bordered" id="rental_table">
           
                    <tbody>
                      <br>
                      <h5>Delivery fee detail</h5>
                   <tr>
                     <td class="rent_title">Delivery Fee</td>
                     <td> 
                         &#8358;{{$fee['DeliveryFee']}} 
                       
                      </td> 
                   </tr>

                   <tr>
                     <td class="rent_title">Vat Amount</td>
                     <td>  
                 &#8358;{{$fee['VatAmount']}}
                      </td>
                   </tr>

                   <tr>
                     <td class="rent_title">Total Amount</td>
                     <td>
                 &#8358;{{$fee['TotalAmount']}}
                     </td>
                   </tr>
</tbody>
</table>
                          @endforeach

				   @if($request_bid->status == 'Pending')
                    <!-- Request Status:<span class="text-danger"> <strong>{{$request_bid->status}}</strong></span> -->
                  @if(authUser()->id == $request_bid->bidder_id)
					<form class="form" method="post" action="{{ route('request.approve_or_reject.store') }}">
                            @csrf
                          <div class="form-group">
                            <input type="hidden" name="request_id" class="form-control" id="request_id" value="{{$request->id}}" >
                          </div>

                          <div class="form-group">
                            <input type="hidden" name="request_bid_id" class="form-control" id="request_id" value="{{$request_bid->id}}" >
                          </div>
                          <!-- help receiver -->
                           <div class="form-group">
                            <input type="hidden" name="bidder_id" class="form-control" id="request_id" value="{{authUser()->id}}" >
                          </div>
                          <!-- help provider -->
                           <div class="form-group">
                            <input type="hidden" name="requester_id" class="form-control" id="request_id" value="{{$help_provider->id}}" >
                          </div>

                         <div class="form-group">
                            <label for="exampleInputEmail1">Comment (Optional)</label>
                            <textarea type="text" name="comment" class="form-control" id="delievery_cost" value="3500" placeholder="type a comment" ></textarea>
                          </div>
                         
                          <button type="submit" class="btn btn-primary float-left">Accept Request</button>
					     

                        </form>
                        @else
                        <span class="text-danger"> <br>You are not the owner of this request, hence you are not allowed to approve or reject it</span>
                        @endif
                    @elseif($request_bid->status == 'Approved')
                    Request Status:<span class=" text-primary"> {{$request_bid->status}}</span>
                    @elseif($request_bid->status == 'Rejected')
                    Request Status: <span class=" text-danger"> {{$request_bid->status}}</span>
                     @elseif($request_bid->status == 'Delivered')
                    Request Status:<span class=" text-success"> {{$request_bid->status}}</span>
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
