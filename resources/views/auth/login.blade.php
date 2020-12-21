@extends('layouts.app-blue', ['class' => 'login-page', 'page' => _('Login Page'), 'contentClass' => 'login-page'])

@section('content')
<div class="page-wrap login rainbow">
    <div class="container">
        <div class="row">
            <div class="form-wrap login-wrap">
                <form class="form" method="post" action="{{ route('login') }}">
                    @csrf

                    <div class="card card-login card-white">
                        <div class="card-header">
                            <!-- <img src="{{ asset('white') }}/img/card-primary.png" alt=""> -->
                            <h2 class="text-center">{{ _('Sign In') }}</h2>
                        </div>
                        <div class="card-body">
                            <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <div class="input-group-prepend">
                                    
                                </div>
                                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ _('Email') }}">
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>
                            <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <div class="input-group-prepend">
                                    
                                </div>
                                <input type="password" placeholder="{{ _('Password') }}" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                                @include('alerts.feedback', ['field' => 'password'])
                            </div>
                            <div class="input-group content-center">
                                <button type="submit" href="" class="btn btn_simple btn_transparent btn_ggPrimary2">{{ _('Submit') }}</button>
                            </div>
                        </div>
                        <div class="card-footer">
                            
                            <div class="pull-left">
                                <h6>
                                    <a href="{{ route('selectReg') }}" class="link footer-link">{{ _('Create Account') }}</a>
                                </h6>
                            </div>
                            <div class="pull-right">
                                <h6>
                                    <a href="{{ route('password.request') }}" class="link footer-link">{{ _('Forgot password?') }}</a>
                                </h6>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
