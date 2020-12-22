@extends('layouts.app-blue', ['class' => 'register-page', 'contentClass' => 'register-page'])

@section('content')
<div class="page-wrap login rainbow">
    <div class="container">
        <div class="row">
            <div class="form-wrap login-wrap reg-type">
    
        
                <div class="card card card-white ">
                    <div class="card-header">
                        <!--<h2 class="text-blue text-center">{{ _('Select Reg. Type') }}</h2>-->
                        <h2 class="text-center">Select <br />Registration Type </h2>
                    </div>
                    <div class="card-body">
                        <div class="pull-left text-center">
                            <a href="{{ url('/register') }}" class="pad">
                                <button type="submit" class="btn btn_simple btn_transparent btn_ggPrimary2">{{ _('Individual') }}</button>
                            </a>
                        </div>
                        
                        <div class="pull-right text-center">
                            <a href="{{ url('/corporate/register') }}"class="pad">
                            <button type="submit" class="btn btn_simple btn_transparent btn_ggPrimary2">{{ _('Corporate') }}</button>
                        </a>
                        </div>
                        
                    </div>
                </div>
            </div>
       </div>
    </div>
</div>
@endsection
