@extends('_layouts._layout_site')
@include('_layouts._includes._head')

@section('head')
@endsection

@section('titulo')

@endsection

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- TITULO --}}
            <div class="col-6">
                <h1>@lang('pivos.cadastrar_pivo')</h1>
            </div>

            {{-- BOTOES VOLTAR E SALVAR --}}
            <div class="col-6 text-right botoes position">
                <a href="{{ route('manager_pivot') }}" style="color: #3c8dbc" data-toggle="tooltip"
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
    </div>
@endsection

@section('conteudo')
    <div>

        {{-- NAVTAB'S --}}
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="cadastro-tab" data-bs-toggle="tab" role="tab" aria-controls="cadastro"
                    aria-current="page" aria-selected="true" href="#cadastro">@lang('comum.informacoes_navtabs')</a>
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
        <form action="{{ route('save_pivot') }}" method="post" class="mt-3" id="formdados">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active formpivos" id="cadastro" role="tabpanel"
                    aria-labelledby="cadastro-tab">
                    @csrf
                    <div class="col-md-12 position" id="cssPreloader">
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="fabricante">@lang('pivos.fabricante')</label>
                                <input type="text" class="form-control telo5ce" id="fabricante" name="fabricante"
                                    maxlength="50" required>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="nome">@lang('pivos.nome')</label>
                                <input type="text" class="form-control telo5ce" id="nome" name="nome" maxlength="15"
                                    required>
                            </div>
                            <div class="form-group col-md-4 telo5ce position">
                                <label for="espacamento">@lang('pivos.espacamento')</label>
                                <input type="number" class="form-control telo5ce" id="espacamento" name="espacamento"
                                    maxlength="50" required>
                            </div>
                        </div>

                        <div class="form-row justify-content-start">
                            <div class="telo5ce">
                                <label for="">@lang('pivos.lance_inicial')</label>
                            </div>
                        </div>

                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="saida_1_inicial">@lang('pivos.saida1')</label>
                                <input type="text" class="form-control telo5ce" id="saida_1_inicial" name="saida_1_inicial"
                                    maxlength="50" required>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="saida_2_inicial">@lang('pivos.saida2')</label>
                                <input type="text" class="form-control telo5ce" id="saida_2_inicial" name="saida_2_inicial"
                                    maxlength="50" required>
                            </div>
                            <div class="form-group col-md-4 telo5ce position">
                                <label for="saida_3_inicial">@lang('pivos.saida3')</label>
                                <input type="text" class="form-control telo5ce" id="saida_3_inicial" name="saida_3_inicial"
                                    maxlength="50" required>
                            </div>
                        </div>

                        <div class="form-row justify-content-start">
                            <div class="telo5ce">
                                <label for="">@lang('pivos.lance_intermediario')</label>
                            </div>
                        </div>

                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="saida_1_intermediario">@lang('pivos.saida1')</label>
                                <input type="text" class="form-control telo5ce" id="saida_1_intermediario"
                                    name="saida_1_intermediario" maxlength="50" required>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="saida_2_intermediario">@lang('pivos.saida2')</label>
                                <input type="text" class="form-control telo5ce" id="saida_2_intermediario"
                                    name="saida_2_intermediario" maxlength="50" required>
                            </div>
                            <div class="form-group col-md-4 telo5ce position">
                                <label for="saida_3_intermediario">@lang('pivos.saida3')</label>
                                <input type="text" class="form-control telo5ce" id="saida_3_intermediario"
                                    name="saida_3_intermediario" maxlength="50" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

    {{-- SALVAR E VALIDAR CAMPOS VAZIOS --}}
    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
    <script>
        $(document).ready(function() {
            $('#botaosalvar').on('click', function() {
                $('#formdados').submit();
            });

            $("#formdados").validate({
                rules: {
                    "fabricante": {
                        required: true
                    },
                    "nome": {
                        required: true
                    },
                    "espacamento": {
                        required: true
                    },
                    "saida_1_inicial": {
                        required: true
                    },
                    "saida_2_inicial": {
                        required: true
                    },
                    "saida_3_inicial": {
                        required: true
                    },
                    "saida_1_intermediario": {
                        required: true
                    },
                    "saida_2_intermediario": {
                        required: true
                    },
                    "saida_3_intermediario": {
                        required: true
                    }
                },
                messages: {
                    fabricante: "Campo <strong>FABRICANTE</strong> é obrigatório",

                    "nome": {
                        required: "Campo <strong>MODELO</strong> é obrigatório"
                    },
                    "espacamento": {
                        required: "Campo <strong>ESPAÇAMENTO</strong> é obrigatório"
                    },
                    "saida_1_inicial": {
                        required: "Campo <strong>1° SAÍDA INICIAL</strong> é obrigatório"
                    },
                    "saida_2_inicial": {
                        required: "Campo <strong>2° SAÍDA INICIAL</strong> é obrigatório"
                    },
                    "saida_3_inicial": {
                        required: "Campo <strong>3° SAÍDA INICIAL</strong> é obrigatório"
                    },
                    "saida_1_intermediario": {
                        required: "Campo <strong>1° SAÍDA INTERMEDIÁRIA</strong> é obrigatório"
                    },
                    "saida_2_intermediario": {
                        required: "Campo <strong>2° SAÍDA INTERMEDIÁRIA</strong> é obrigatório"
                    },
                    "saida_3_intermediario": {
                        required: "Campo <strong>3° SAÍDA INTERMEDIÁRIA</strong> é obrigatório",
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

    {{-- SCRIPT DE FUNCIONALIDADE DO TOOLTIP --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
@endsection
