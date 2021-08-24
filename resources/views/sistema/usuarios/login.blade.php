<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <?php session_start(); ?>
    @include('_layouts._includes._login')
</head>

<body>

    <form action="{{ route('signin') }}" class="box" method="POST" autocomplete="off">
        @csrf
        <img src="{{ asset('img/telo5.jpg') }}">
        @if (Session::has('error'))
            <div class="alert-error">
                {!! Session::get('error') !!}
            </div>
        @endif
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Senha">
        <input type="submit" name="enviar" value="Entrar">
        {{-- <a href="#" name="rememberPassword">Esqueci a minha senha</a> --}}
    </form>
    <div class="text">
        <p>Copyright © Valmont Industries Inc. All Rights reserved.</p>
    </div>
</body>

</html>
