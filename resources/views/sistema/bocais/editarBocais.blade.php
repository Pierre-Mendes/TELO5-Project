@extends('_layouts._layout_site')

@section('topo_detalhe')

    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- TITULO E SUBTITULO --}}
            <div class="col-6">
                <h1>@lang('bocais.editar_bocais')</h1>
            </div>

            {{-- BOTOES SALVAR E VOLTAR --}}
            <div class="col-6 text-right botoes">
                <a href="{{ route('manager_nozzles') }}" style="color: #3c8dbc" data-toggle="tooltip"
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
        <form action="{{ route('update_nozzle') }}" method="post" class="mt-3" id="formdados">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="cadastro" role="tabpanel" aria-labelledby="cadastro-tab">
                    @csrf
                    <div class="col-md-12 position" id="cssPreloader">
                        <input type="hidden" name="id" value="{{ $bocal->id }}">
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-3 telo5ce">
                                <label for="fabricante"><span><b>@lang('bocais.fabricante')</b></span></label>
                                <input type="text" class="form-control telo5ce" id="fabricante" name="fabricante"
                                    maxlength="100" autocomplete="off" required value="{{ $bocal->fabricante }}">
                            </div>

                            <div class="form-group col-md-3 telo5ce">
                                <label for="modelo"><span><b>@lang('bocais.modelo')</b></span></label>
                                <input type="text" class="form-control telo5ce" id="modelo" name="modelo" maxlength="100"
                                    autocomplete="off" required value="{{ $bocal->modelo }}">
                            </div>

                            <div class="form-group col-md-3 telo5ce">
                                <label for="nome"><span><b>@lang('bocais.nome')</b></span></label>
                                <input type="number" class="form-control telo5ce" min="0.1" step="0.1" id="nome" name="nome"
                                    maxlength="100" required value="{{ $bocal->nome }}">
                            </div>

                            <div class="form-group col-md-3 telo5ce">
                                <label for="vazao_10_psi"><span><b>@lang('bocais.vazao_10_psi')</b></span></label>
                                <input type="number" class="form-control telo5ce" min="0.0001" step="0.0001"
                                    id="vazao_10_psi" name="vazao_10_psi" maxlength="100" required
                                    value="{{ $bocal->vazao_10_psi }}">
                            </div>
                        </div>

                        <div class="form-row justify-content-start">

                            <div class="form-group col-md-3 telo5ce">
                                <label
                                    for="intervalo_trabalho"><span><b>@lang('bocais.intervalo_trabalho')</b></span></label>
                                <input type="number" class="form-control telo5ce" min="0.0001" step="0.0001"
                                    id="intervalo_trabalho" name="intervalo_trabalho" maxlength="100" required
                                    value="{{ $bocal->intervalo_trabalho }}">
                            </div>

                            <div class="form-group col-md-3 position telo5ce">
                                <label for="tipo"><span><b>@lang('bocais.tipo')</b></span></label><br>
                                <select name="tipo" id="tipo" class="form-control position  telo5ce" required>
                                    <option value=""></option>
                                    <option value="0" {{ $bocal->tipo == '0' ? 'selected' : '' }}>@lang('bocais.estatico')
                                    </option>
                                    <option value="1" {{ $bocal->tipo == '1' ? 'selected' : '' }}>@lang('bocais.rotativo')
                                    </option>
                                </select>
                            </div>

                            <div class="form-group col-md-3 position telo5ce">
                                <label for="plug"><span><b>@lang('bocais.plug')</b></span></label><br>
                                <select name="plug" id="plug" class="form-control position  telo5ce" required>
                                    <option value=""></option>
                                    <option value="0" {{ $bocal->plug == '0' ? 'selected' : '' }}>@lang('bocais.nao')
                                    </option>
                                    <option value="1" {{ $bocal->plug == '1' ? 'selected' : '' }}>@lang('bocais.sim')
                                    </option>
                                </select>
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
                    "modelo[]": {
                        required: true
                    },
                    "nome[]": {
                        required: true
                    },
                    "vazao_10_psi[]": {
                        required: true
                    },
                    "intervalo_trabalho[]": {
                        required: true
                    },
                    "tipo[]": {
                        required: true
                    },
                    "plug[]": {
                        required: true
                    }
                },
                messages: {
                    "modelo": "Campo <strong>MODELO</strong> é obrigatório",

                    "nome": {
                        required: "Campo <strong>NOME</strong> é obrigatório"
                    },
                    "vazao_10_psi": {
                        required: "Campo <strong>VAZÃO 10 PSI</strong> é obrigatório"
                    },
                    "intervalo_trabalho": {
                        required: "Campo <strong>INTERVALO TRABALHO</strong> é obrigatório"
                    },
                    "tipo": {
                        required: "Campo <strong>TIPO</strong> é obrigatório"
                    },
                    "plug": {
                        required: "Campo <strong>PLUG</strong> é obrigatório"
                    },
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
