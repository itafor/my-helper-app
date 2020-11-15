@extends('layouts.app', ['pageSlug' => ''])

@section('content')
    <div class="header py-7 py-lg-8">
        <div class="container-fluid">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="header-hero-wrap">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="hero-box">
                                    <div class="image-wrap">
                                        <img src="{{ asset('white') }}/img/welcome_004.jpg" alt="Welcome to My Helper"/>
                                        <h4>{{ __('Welcome to MyHelperApp') }}</h4>
                                    </div>
                                    <div class="content">
                                        <h4>{{ __('Welcome to MyHelperApp')}}</h4>
                                        <p>{{ __('Welcome to MyHelperApp where you can receive or provide goods and services for free or at a fee.') }}
                                            <br /><a href="{{ route('make.request') }}">{{ __('Get Started') }}</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="hero-box">
                                    <div class="image-wrap">
                                        <img src="{{ asset('white') }}/img/welcome_002.jpg" alt="Get or Provide Help"/>
                                        <h4>{{ __('Get or Provide help') }}</h4>
                                    </div>
                                    <div class="content">
                                        <h4>{{ __('Get or Provide help')}}</h4>
                                        <p>{{ __('Select any request to provide help. You can create your own request too. ') }}
                                            <br /><a href="{{ route('make.request') }}">{{ __('Get Help') }}</a> or <a href="{{ route('provide.request') }}">{{ __('Provide Help') }}</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="hero-box">
                                    <div class="image-wrap">
                                        <img src="{{ asset('white') }}/img/welcome_005.jpg" alt="How It Works"/>
                                        <h4>{{ __('How It Works') }}</h4>
                                    </div>
                                    <div class="content">
                                        <h4>{{ __('How It Works') }}</h4>
                                         <p>{{ __('Whether free or paid, learn how you can be helped or how you can help others.')}}  
                                            <br /><a href="{{ route('how_it_works') }}">{{ __('Learn more') }}</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-12 content-wrapper">
                        <div class="content-header hidden_all">
                            <h3 class="text-blue text-center h2-heading">{{ __('Welcome to MyHelperApp where you can receive or provide goods and services for free or at a fee.') }} <span> {{__('We’re here to help you get through the day stress free. ')}}</span></h3>
                            <div class="btn-group req-btn" >
                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Get or Provide Help Here
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('make.request') }}">Get Help</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('provide.request') }}">Provide Help</a>
                                </div>
                            </div>
                            <!-- <p class="text-lead text-light">
                                {{ __('What do u need right now for your lockdown?') }}
                            </p> -->
                        </div>
                        
                        
                        <div class="welcome-cards">
                            <div id="card" class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Products and Services</h4>
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
                                </div>


                                <div class="table-responsive hidden-mobile">
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

                                <div class="sponsors">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="title">
                                                <h3>Our Sponsors</h3>
                                                <div class="sponsor-info">
                                                    Free service provided by Sterling Bank, Giving and 100StartApps
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="sponsors-wrap">
                                                <div class="item">
                                                    <a href="https://sterling.ng" target="_blank">
                                                        <img src="{{ asset('white') }}/img/sterling_logo.png" alt="Sterling Bank">
                                                    </a>
                                                </div>   
                                                <div class="item">
                                                    <a href="https://giving.ng" target="_blank">
                                                        <img src="{{ asset('white') }}/img/giving_logo.png" alt="Giving">
                                                    </a>
                                                </div>   
                                                <div class="item">
                                                    <a href="https://100startapps.com" target="_blank">
                                                        <img src="{{ asset('white') }}/img/100startapps_logo.png" alt="100StartApps">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
@endsection
