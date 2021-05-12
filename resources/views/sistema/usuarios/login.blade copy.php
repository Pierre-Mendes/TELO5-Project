<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <?php session_start(); ?>
    @include('_layouts._includes._login')
</head>

<body>

    <div class="login-background">
        <form action="{{ route('login.entrar') }}" method="post">
            @csrf
            <div class="centerlogin">
                <div>
                    <img class="imglogin" src="{{ asset('img/telo5.jpg') }}">
                </div>
                <div>
                    <div>
                        <input name="email" type="email" placeholder="Email" required autocomplete="off" autofocus>
                    </div>
                    <br>
                    <div>
                        <input name="password" type="password" placeholder="Password" required>
                    </div>
    
                    <div hidden class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" name='rememberPassword'
                                        type="checkbox">@lang('login.lembrar_minha_senha') </label>
                            </div>
                        </div>
                    <div>
                        <button type="submit">@lang('login.entrar')</button>
                    </div>
                    <div>
                        <p> I forgot my password</p>
                    </div>
                </div>
            </div>
           
            <div class="mensagemlogin">
                <div>
                    <p> Copyright © Valmont Industries Inc. All Rights reserved.</p>
                </div>
            </div>
            <!--<button class="btn btn-lg btn-info btn-block" type="submit">@lang('login.entrar')</button>-->
        </form>
    </div>
</body>
@include('_layouts._includes._scripts')
@include('_layouts._includes._modal')

</html>
