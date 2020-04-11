@extends('layouts.app', ['class' => 'register-page', 'contentClass' => 'register-page'])

@section('content')
    <div class="row">
        <div class="container">
        <div class="col-md-6 col-md-offset-2">
            <div class="card card-register card-white ">
                <div class="card-header">
                    <h1 class="text-blue text-center">{{ _('Select Reg. Type') }}</h1>
                </div>
                <a href="{{ url('/register') }}" class="pad">
                    <button type="submit" class="btn btn-block btn-round btn-lg">{{ _('Individual') }}</button>
                </a>
                <a href="{{ url('/corporate/register') }}"class="pad">
                    <button type="submit" class="btn btn-block btn-round btn-lg">{{ _('Corporate') }}</button>
                </a>
              
            </div>
        </div>
        <!-- <div class="col-md-6 mr-auto">
            
        </div> -->
        </div>
    </div>
@endsection
