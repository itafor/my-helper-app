@extends('layouts.app-blue', ['class' => 'login-page', 'page' => _('Reset password'), 'contentClass' => 'login-page'])

@section('content')
     <div class="page-wrap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <form class="form" method="post" action="{{ route('password.email') }}">
                        @csrf

                        <div class="card card-login card-white">
                            <div class="card-header">
                                <!--<img src="{{ asset('white') }}/img/card-primary.png" alt="">-->
                                <h2 class="text-center">{{ _('Reset Your Password') }}</h2>
                            </div>
                            <div class="card-body">
                                @include('alerts.success')

                                <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-email-85"></i>
                                        </div>
                                    </div>
                                    <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ _('Email') }}">
                                    @include('alerts.feedback', ['field' => 'email'])
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-custom btn-lg btn-block mb-3">{{ _('Send Password Reset Link') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
