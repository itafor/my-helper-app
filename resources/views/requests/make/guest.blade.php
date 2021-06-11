@extends('layouts.app-blue', ['pageSlug' => 'Requests'])

@section('content')
     <div class="page-wrap">
        <div class="container">
            <div class="row">
              <div class="col-md-1"></div>
                <div class="col-md-10 pb-40 pt-40">
                    <div class="card">
                      <div class="card-header">
                          <div class="row align-items-center">
                            <div class="col-8 col-left"> 
                              <h2>Request for  {{ $getRequest->category ? $getRequest->category->title : '' }}</h2>  
                            </div>
                            <div class="col-4 text-right">
                                @if(auth()->check())
                                    <a href="{{ route('requests') }}" class="btn btn-dark">{{ __('Back to list') }}</a>
                                @else
                                    <a href="{{ route('all_requests') }}" class="btn btn-dark">{{ __('Back to list') }}</a>
                                @endif
                            </div>
                          </div> 
                      </div>

                      <div class="card-body">
                        <h5 class="card-title">
                           Welcome to my page -  <strong>{{ $getRequest->user->username }}</strong>
                        </h5>
                        <p class="card-text">
                          I need the following items ({{ $getRequest->description }}) around  {{ ucfirst(Str::lower($getRequest->api_city))}} {{ ucfirst(Str::lower($getRequest->api_state))}} ({{ $getRequest->street }})

                        </p>
                        <span>ITEM CATEGORY: {{ $getRequest->category ? $getRequest->category->title : '' }}</span>
                                                    <br>
                                                    <br>
                          <h5>ITEMS</h5>
                          <ul>
                          @foreach(reqItems($getRequest->id, $getRequest->category->id) as $reqitem)
                          <li>{{$reqitem->item->name}}</li>
                          @endforeach
                          </ul>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                         <a onclick="alert('please login to contact this person')" href="{{route('auth_view.make.request', [$getRequest->id])}}" class="btn btn-primary">Contact  {{ $getRequest->user->username ? $getRequest->user->username : $getRequest->user->company_name }}</a>
                      </div>
                    </div>
                </div>
                <div class="col-md-1"></div> 
            </div>
        </div>
      </div>
    
@endsection
