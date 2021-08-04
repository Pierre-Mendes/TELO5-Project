@extends('_layouts._layout_site')
@include('_layouts._includes._head')

@section('head')
@endsection
@section('titulo')
    @lang('cdc.centro_de_custos')
@endsection

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- TITULO E SUBTITULO --}}
            <div class="col-6">
                <h1>@lang('cdc.centro_de_custos')</h1><br>
                <h4 style="margin-top: -20px">@lang('comum.editar')</h4>
            </div>

            {{-- BOTOES SALVAR E VOLTAR --}}
            <div class="col-6 text-right botoes mobile">
                <a href="{{ route('manage_cost_center') }}" style="color: #3c8dbc" data-toggle="tooltip"
                    data-placement="bottom" title="Voltar">
                    <button type="button">
                        <span class="fa-stack fa-lg">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fas fa-angle-double-left fa-stack-1x fa-inverse"></i>
                        </span>
                    </button>
                </a>
                <button type="button" id="botaosalvar" data-toggle="tooltip" data-placement="bottom" title="Salvar">
                    <span class="fa-stack fa-2x">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-save fa-stack-1x fa-inverse"></i>
                    </span>
                </button>
            </div>
        </div>
    @endsection

    @section('conteudo')

        <div>
            {{-- NAVTAB'S --}}
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">@lang('comum.informacoes_navtabs')</a>
                </li>
            </ul>

            {{-- PRELOADER --}}
            <div id="coverScreen">
                <div class="preloader">
                    <i class="fas fa-circle-notch fa-spin fa-2x"></i>
                    <div>@lang('comum.preloader')</div>
                </div>
            </div>

            {{-- FORMULARIO DE CADASTRO --}}
            <form action="{{ route('update_cost_center') }}" method="post" class="row mt-3" id="formdados">
                @include('_layouts._includes._alert')
                @csrf
                <input type="hidden" name="id" value="{{ $centroCusto->id }}">
                <div class="col-md-12 m-auto" id="cssPreloader">
                    <div class="form-row justify-content-start">
                        <div class="form-group col-md-4 telo5ce">
                            <label for="nome">@lang('cdc.nome')</label>
                            <input type="text" class="form-control" id="nome" name="nome" maxlength="50" required
                                value="{{ $centroCusto->nome }}">
                        </div>
                        <div class="form-group col-md-2 telo5ce">
                            <label for="codigo">@lang('cdc.codigo')</label>
                            <input type="number" class="form-control" id="codigo" name="codigo" maxlength="10" required
                                value="{{ $centroCusto->codigo }}">
                        </div>
                    </div>
                </div>

            </form>
        </div>

    @endsection

    @section('scripts')

        {{-- VALIDAÇÕES DE CAMPOS --}}
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
        <script>
        $(document).ready(function() {
            $('#botaosalvar').on('click', function() {
                $('#formdados').submit();
            });

            $("#formdados").validate({
                rules: {
                    "nome": {
                        required: true,
                    },
                    "codigo": {
                        required: true,
                    }
                },
                messages: {
                    nome: "@lang('validate.validate')",
                    "codigo": {
                        required: "@lang('validate.validate')"
                    }
                },
                submitHandler: function(form) {
                    $("#coverScreen").show();
                    $("#cssPreloader input").each(function() {
                        $(this).css('opacity', '0.2');
                    });
                    $("#cssPreloader select").each(function() {
                        $(this).css('opacity', '0.2');
                    });
                    form.submit();
                }
            });

            $(window).on('load', function() {
                $("#coverScreen").hide();
            });
        });

        </script>

        {{-- SCRIPT PARA FUNCIONALIDADE DO TOOLTIP --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
        </script>
    @endsection
