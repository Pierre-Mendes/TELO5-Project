<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <?php session_start(); ?>
    @include('_layouts._includes._login')
</head>

<body>
    <form action="{{ route('login.entrar') }}" class="box" method="POST" autocomplete="off">
        @csrf
        <img src="{{ asset('img/telo5.jpg') }}" alt="">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Senha">
        <input type="submit" name="enviar" value="Entrar">
        <a href="#">Esqueci a minha senha</a>
    </form>
    <div class="text">
        <p>Copyright © Valmont Industries Inc. All Rights reserved.</p>
    </div>
</body>

</html>
