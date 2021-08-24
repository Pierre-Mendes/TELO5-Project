 @if (session()->has('alert'))

    <?php
    $alert = Session::get('alert');
    Session::forget('alert');
    ?>

    <div class='fecharalerta col-12 pt-2'>
        <div id="myAlert" class="alert alert-{{ $alert['tipo'] }} alert-dismissible fade show text-center" toggle="myAlert" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <p>@lang($alert['titulo']) @lang($alert['mensagem'])</p>

            @if (isset($alert['link']))
                <a class="btn btn-{{ $alert['tipo'] }} center-block"
                    href="{{ route($alert['link']) }}">@lang($alert['descLink'])</a>
            @endif
        </div>
    </div>

    <script>
        $(window).load(function(){
            $('.myAlert').click(function(){
                $('.fecharalerta').hide('fast');
            });
        })
    </script>

@endif
