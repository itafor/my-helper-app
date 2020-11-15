
@extends('admin.layouts.master', ['pageSlug' => 'logistic'])



@section('title')

Admin | Logistic Agents

@endsection

@section('content')

  <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title float-left"> Logistic Agent details</h4>

                <h4 class="card-title float-right">
                  <a href="{{route('admin.logistic.agent')}}">
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
  <dd class="col-sm-9">{{$logistic->id}}</dd>

  <dt class="col-sm-3">Company Name</dt>
  <dd class="col-sm-9">
    {{$logistic->company_name}}
  </dd>

  <dt class="col-sm-3">Phone Number</dt>
  <dd class="col-sm-9">
    {{$logistic->phone}}
  </dd>

   <dt class="col-sm-3">Company Email</dt>
  <dd class="col-sm-9">
    {{$logistic->email}}
  </dd>

   <dt class="col-sm-3">Country</dt>
  <dd class="col-sm-9">
    {{$logistic->country->country_name}}
  </dd>

   <dt class="col-sm-3">State</dt>
  <dd class="col-sm-9">
    {{$logistic->state->name}}
  </dd>

   <dt class="col-sm-3">City</dt>
  <dd class="col-sm-9">
    {{$logistic->city->name}}
  </dd>

  <dt class="col-sm-3 text-truncate">Street Address</dt>
  <dd class="col-sm-9">

     <p>{{$logistic->street}}</p>
                       
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