<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
<?php
    session_start();
?>
</head>
@include('_layouts._includes._head')
<div id="app"></div>

<body style="background-color: #013856">
<div class="container col-sm-10 col-md-6 col-lg-4 col-xs-3">
    <div class="card card-login mx-auto mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="card">
                    <div class="card-header">{{ __('auth.verifyEmail') }}</div>
    
                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('auth.verificationSent') }}
                            </div>
                        @endif
    
                        {{ __('auth.checkEmail') }}
                        {{ __('auth.ifDontReceive') }}, <a href="{{ route('verification.resend') }}">{{ __('auth.requestAnother') }}</a>.
                    </div>
                    <div class="card-body text-center">
                        <a class="btn btn-outline-primary" href="{{route('sair')}}" data-toggle="tooltip" data-placement="bottom" title="@lang('comum.sair')">@lang('comum.sair')</a>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>


</body>
@include('_layouts._includes._scripts')
@include('_layouts._includes._modal')
</html>