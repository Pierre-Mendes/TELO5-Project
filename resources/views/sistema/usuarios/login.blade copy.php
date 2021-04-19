<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <?php session_start(); ?>
    @include('_layouts._includes._head')
</head>

<body class="login-body">
    <div class="container col-sm-10 col-md-6 col-lg-4 col-xs-3 form">
        <!--<div class="card card-login mx-auto mt-5">-->
        <!--<div id="app"></div>-->

        <div class="login-background">
            <form action="{{ route('login.entrar') }}" method="post">
                {{ csrf_field() }}
                <div class="backgroundlogin">
                    <!--<img class="imglogin" src="https://i.ibb.co/C0f3kJ0/telo5.jpg" alt="telo5">-->
                    <img class="imglogin" src="{{ asset('img/telo5.jpg') }}">
                </div>
                <div class="logininputs">
                    <div class="login-email">
                        <input name="email" type="email" placeholder=" Email" required autocomplete="off" autofocus>
                    </div>

                    <div class="login-password">
                        <input name="password" type="password" placeholder="Password" required>
                    </div>

                    <div hidden class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" name='rememberPassword'
                                    type="checkbox">@lang('login.lembrar_minha_senha') </label>
                        </div>
                    </div>

                    <div class="login-entrar">
                        <button type="submit">@lang('login.entrar')</button>
                    </div>
                </div>

                <div class="mensagemlogin">
                    <div class="login-forgot">
                        I forgot my password
                    </div>
                    
                    <div class="login-rodape">
                        Copyright © Valmont Industries Inc. All Rights reserved.
                    </div>
                </div>

                <!--<button class="btn btn-lg btn-info btn-block" type="submit">@lang('login.entrar')</button>-->
            </form>
        </div>
    </div>
    </div>
</body>
@include('_layouts._includes._scripts')
@include('_layouts._includes._modal')

</html>
