@extends('layouts.app', ['class' => 'register-page', 'contentClass' => 'register-page'])

@section('content')
    <div class="row">
        <div class="col-md-3">&nbsp;</div> 
        <div class="col-md-6 reg-type">
            <div class="card card-register card-white ">
                <div class="card-header">
                    <!--<h2 class="text-blue text-center">{{ _('Select Reg. Type') }}</h2>-->
                    <h2 class="text-center">Select <br />Registration Type </h2>
                </div>
                <div class="card-body">
                    <div class="col-md-6 pad text-center">
                        <a href="{{ url('/register') }}" class="pad">
                            <button type="submit" class="btn btn-block btn-round btn-md btn-custom">{{ _('Individual') }}</button>
                        </a>
                    </div>
                    
                    <div class="col-md-6 pad text-center">
                        <a href="{{ url('/corporate/register') }}"class="pad">
                        <button type="submit" class="btn btn-block btn-round btn-md btn-custom">{{ _('Corporate') }}</button>
                    </a>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-md-3">&nbsp;</div> 
    </div>
@endsection
