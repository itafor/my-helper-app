@extends('layouts.app', ['pageSlug' => 'productServices'])

@section('content')
    <div class="header py-7 py-lg-8">
        <div class="container-fluid">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-md-12 content-wrapper">
                        <div class="content-header">
                        <h3 class="text-blue text-center h2-heading">{{ __('Welcome to MyHelperApp where you can receive or provide goods and services for free or at a fee.') }} <span> {{__('We’re here to help you get through the day stress free. ')}}</span></h3>

                            <div class="btn-group req-btn">
                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Get or Provide Help Here
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('new.make.request') }}">Get Help</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('new.provide.request') }}">Provide Help</a>
                                </div>
                            </div>
                        <!-- <p class="text-lead text-light">
                            {{ __('What do u need right now for your lockdown?') }}
                        </p> -->
                        </div>
                        <div class="col-md-12 welcome-cards">
                            <div id="card" class="card ">
                                <div class="card-header">
                                    <h4 class="card-title">My Requests</h4>
                                </div>
                                <div class="card-body">
                                @include('alerts.success')
                                    <div class="requests hidden-pc" id="all-requests">
                                         <!--Search CODE -->
                                         <div class="search-filter">
                                            <span class="bmd-form-group">
                                                <div class="input-group">
                                                    <input id="cardSearch" class="form-control" placeholder="Search name, category, request type, time, price or location etc." maxlength="100"  onkeyup="searchCards()" type="text">    
                                                </div>
                                            </span>
                                            <p id="summary"></p>
                                        </div>
                                        <!--Search CODE -->
                                    
                                    </div>


                                    <div class="table-responsive">
                                    <table class="table tablesorter " id="requests">
                                        <thead class=" text-primary">
                                            <tr>
                                                <th class="text-left time">S/N</th>
                                                <th class="text-left time">Product</th>
                                                <th class="text-left req_type">Description</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach( $products as $product )
                                            
                                        <tr class='clickable-row'>
                                                    <td class="text-left city_c">{{ $i}}</td>
                                                    <td class="text-left city_c">{{ $product->title }}</td>
                                                    <td class="text-left city_c">{{ $product->description }}</td>
                                                </tr>
                                             @php
                                            $i++;
                                            @endphp
                                        @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div> 

                                    <div class="disclaimer">
                                          <p><span>Disclaimer:</span> 
                                    This platform does not take responsibility for fulfillment of orders or guarantee of payment for goods and services listed.  Kindly engage with caution.</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
