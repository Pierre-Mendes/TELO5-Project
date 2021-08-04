<?php
/*session()->get('numero_bombeamentos');
session()->get('bomba_atual');*/
$id_afericao = session()->get('id_afericao'); ?>

@extends('_layouts._layout_site')

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">
            {{-- TITULO E SUBTITULO --}}
            <div class="col-6">
                <h1>@lang('afericao.bombeamento')</h1><br>
                <h4 style="margin-top: -20px">@lang('comum.cadastrar')</h4>
            </div>

            {{-- BOTOES VOLTAR, ADICIONAR E SALVAR --}}
            <div class="col-6 text-right botoes position">
                <a href="{{ route('gauging_status', $id_afericao) }}" style="color: #3c8dbc" data-toggle="tooltip"
                    data-placement="bottom" title="Voltar">
                    <button type="button">
                        <span class="fa-stack fa-lg">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fas fa-angle-double-left fa-stack-1x fa-inverse"></i>
                        </span>
                    </button>
                </a>

                <button type="button" data-toggle="tooltip" data-placement="bottom" title="Salvar" id="criarTab">
                    <span class="fa-stack fa-2x">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        {{-- <i class="fas fa-plus-circle fa-stack-1x fa-inverse"></i> --}}
                        <i class="fas fa-exchange-alt fa-stack-1x fa-inverse"></i>
                    </span>
                </button>

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
    <div class="formafericao">
        {{-- NAVTAB'S --}}
        <div id="navtabs">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="iGerais-tab" data-toggle="tab" href="#iGerais" role="tab"
                        aria-controls="iGerais" aria-selected="true">@lang('comum.informacoes_navtabs')</a>
                </li>
            </ul>
        </div>

        {{-- PRELOADER --}}
        <div id="coverScreen">
            <div class="preloader">
                <i class="fas fa-circle-notch fa-spin fa-2x"></i>
                <div>@lang('comum.preloader')</div>
            </div>
        </div>

        {{-- FORMULARIO DE CADASTRO --}}
        <form action="{{ route('pumping_save') }}" method="POST" id="formdados">
            @include('_layouts._includes._alert')
            @csrf
            <input type="hidden" value="{{ session()->get('id_afericao') }}" name="id_afericao">
            <div class="tab-content mt-5" id="myTabContent">
                <div class="tab-pane fade show active" id="iGerais" role="tabpanel" aria-labelledby="iGerais-tab">
                    <div class="card-body row" id="cssPreloader">
                        <div class="col-md-3 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.altitudeNivelAgua') .
                            __('unidadesAcoes.(m)'), 'id' => ''])@endcomponent
                            <input type="number" class="form-control" required name="altitude_nivel_agua">
                        </div>

                        <div class="col-md-3 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.altitudeCasaBomba') .
                            __('unidadesAcoes.(m)'), 'id' => ''])@endcomponent
                            <input type="number" class="form-control" required name="altitude_casa_bomba">
                        </div>

                        <div class="col-md-3 form-group telo5ce">
                            <label for="tipo_instalacao">@lang('afericao.tipoInstalacao')</label>
                            <select name="tipo_instalacao" class="form-control" id="tipo_instalacao">
                                <option value=""></option>
                                <option value="0">@lang('afericao.direta')</option>
                                <option value="1">@lang('afericao.afogada')</option>
                                <option value="2">@lang('afericao.balsa')</option>
                                <option value="3">@lang('afericao.submersa')</option>
                            </select>
                            <div class="line"></div>
                        </div>

                        <div class="col-md-3 form-group telo5ce">
                            <label for="posicionamento_bombeamento">@lang('afericao.posicionamentoBombeamento')</label>
                            <select name="posicionamento_bombeamento" class="form-control" id="posicionamento_bombeamento">
                                <option value=""></option>
                                <option value="0">@lang('afericao.simples')</option>
                                <option value="1">@lang('afericao.serie')</option>
                                <option value="2">@lang('afericao.paralelo')</option>
                            </select>
                            <div class="line"></div>
                        </div>

                        <div class="col-md-3 form-group telo5ce">
                            <label for="captacao">@lang('afericao.captacao')</label>
                            <select name="captacao" class="form-control" id="captacao">
                                <option value=""></option>
                                <option value="0">@lang('afericao.acude')</option>
                                <option value="1">@lang('afericao.barragem')</option>
                                <option value="2">@lang('afericao.corrego')</option>
                                <option value="3">@lang('afericao.lago')</option>
                                <option value="4">@lang('afericao.lagoa')</option>
                                <option value="5">@lang('afericao.poco')</option>
                            </select>
                            <div class="line"></div>
                        </div>

                        <div class="col-md-3 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.latitude'), 'id' =>
                            ''])@endcomponent
                            <input type="number" step=0.000001 class="form-control" required name="latitude">
                        </div>

                        <div class="col-md-3 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.longitude'), 'id' =>
                            ''])@endcomponent
                            <input type="number" step=0.000001 class="form-control" required name="longitude">
                        </div>

                        <div class="col-md-3 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.numero_bombas'), 'id' =>
                            ''])@endcomponent
                            <input id="numero_bombas" type="number" class="form-control" min="1" value="1" required
                                name="numero_bombas">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

    {{-- FILTRO SELECT --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
    integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

    {{-- SALVAR E VALIDAR CAMPOS VAZIOS --}}
    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
    <script>
        $(document).ready(function() {
            $('#botaosalvar').on('click', function() {
                $('#formdados').submit();
            });

            $("#formdados").validate({
                rules: {
                    "altitude_nivel_agua": {
                        required: true
                    },
                    "altitude_casa_bomba": {
                        required: true
                    },
                    "tipo_instalacao": {
                        required: true
                    },
                    "posicionamento_bombeamento": {
                        required: true
                    },
                    "captacao": {
                        required: true
                    },
                    "latitude": {
                        required: true
                    },
                    "longitude": {
                        required: true
                    },
                    "numero_bombas": {
                        required: true
                    },
                    "comprimento_succao[]": {
                            required: true
                    },
                    "diametro_succao[]": {
                        required: true
                    },
                    "marca[]": {
                        required: true
                    },
                    "modelo[]": {
                        required: true
                    },
                    "numero_rotores[]": {
                        required: true
                    },
                    "diametro_rotor[]": {
                        required: true
                    },
                    "rendimento_bomba[]": {
                        required: true
                    },
                    "shutoff[]": {
                        required: true
                    },
                    "rotacao[]": {
                        required: true
                    },
                    "pressao_bomba[]": {
                        required: true
                    },
                    "modelo_motor[]": {
                        required: true
                    },
                    "potencia[]": {
                        required: true
                    },
                    "numero_motores[]": {
                        required: true
                    },
                    "fator_servico[]": {
                        required: true
                    },
                    "rendimento[]": {
                        required: true
                    },
                    "frequencia[]": {
                        required: true
                    },
                    "corrente_nominal[]": {
                        required: true
                    },
                    "corrente_leitura_1_fase_1[]": {
                        required: true
                    },
                    "corrente_leitura_1_fase_2[]": {
                        required: true
                    },
                    "corrente_leitura_1_fase_3[]": {
                        required: true
                    },
                    "tensao_leitura_1_fase_1[]": {
                        required: true
                    },
                    "tensao_leitura_1_fase_2[]": {
                        required: true
                    },
                    "tensao_leitura_1_fase_3[]": {
                        required: true
                    },
                    "corrente_leitura_2_fase_1[]": {
                        required: true
                    },
                    "corrente_leitura_2_fase_2[]": {
                        required: true
                    },
                    "corrente_leitura_2_fase_3[]": {
                        required: true
                    },
                    "tensao_leitura_2_fase_1[]": {
                        required: true
                    },
                    "tensao_leitura_2_fase_2[]": {
                        required: true
                    },
                    "tensao_leitura_2_fase_3[]": {
                        required: true
                    }
                },
                messages: {
                    altitude_nivel_agua: "@lang('validate.validate')",

                    "altitude_casa_bomba": {
                        required: "@lang('validate.validate')"
                    },
                    "tipo_instalacao": {
                        required: "@lang('validate.validate')"
                    },
                    "posicionamento_bombeamento": {
                        required: "@lang('validate.validate')"
                    },
                    "latitude": {
                        required: "@lang('validate.validate')"
                    },
                    "longitude": {
                        required: "@lang('validate.validate')"
                    },
                    "comprimento_succao": {
                        required: "@lang('validate.validate')"
                    },
                    "diametro_succao": {
                        required: "@lang('validate.validate')"
                    },
                    "marca": {
                        required: "@lang('validate.validate')"
                    },
                    "modelo": {
                        required: "@lang('validate.validate')"
                    },
                    "numero_rotores": {
                        required: "@lang('validate.validate')"
                    },
                    "diametro_rotor": {
                        required: "@lang('validate.validate')"
                    },
                    "rendimento_bomba": {
                        required: "@lang('validate.validate')"
                    },
                    "shutoff": {
                        required: "@lang('validate.validate')"
                    },
                    "rotacao": {
                        required: "@lang('validate.validate')"
                    },
                    "pressao_bomba": {
                        required: "@lang('validate.validate')"
                    },
                    "modelo_motor": {
                        required: "@lang('validate.validate')"
                    },
                    "potencia": {
                        required: "@lang('validate.validate')"
                    },
                    "numero_motores": {
                        required: "@lang('validate.validate')"
                    },
                    "fator_servico": {
                        required: "@lang('validate.validate')"
                    },
                    "rendimento": {
                        required: "@lang('validate.validate')"
                    },
                    "frequencia": {
                        required: "@lang('validate.validate')"
                    },
                    "corrente_nominal": {
                        required: "@lang('validate.validate')"
                    },
                    "corrente_leitura_1_fase_1": {
                        required: "@lang('validate.validate')"
                    },
                    "corrente_leitura_1_fase_2": {
                        required: "@lang('validate.validate')"
                    },
                    "corrente_leitura_1_fase_3": {
                        required: "@lang('validate.validate')"
                    },
                    "tensao_leitura_1_fase_1": {
                        required: "@lang('validate.validate')"
                    },
                    "tensao_leitura_1_fase_2": {
                        required: "@lang('validate.validate')"
                    },
                    "tensao_leitura_1_fase_3": {
                        required: "@lang('validate.validate')"
                    },
                    "corrente_leitura_2_fase_1": {
                        required: "@lang('validate.validate')"
                    },
                    "corrente_leitura_2_fase_2": {
                        required: "@lang('validate.validate')"
                    },
                    "corrente_leitura_2_fase_3": {
                        required: "@lang('validate.validate')"
                    },
                    "tensao_leitura_2_fase_1": {
                        required: "@lang('validate.validate')"
                    },
                    "tensao_leitura_2_fase_2": {
                        required: "@lang('validate.validate')"
                    },
                    "tensao_leitura_2_fase_3": {
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

            $('#criarTab').on('click', function() {
                var quantidade = $("#numero_bombas").val();
                var CabTab = "";
                var HTML = "";
                var i = 0;
                var qtTab = $('#myTab > li').length;
                var qtBombaAtual = 0;

                qtBombaAtual = qtTab - 1;
                if (quantidade > qtBombaAtual){
                    for (i = (qtBombaAtual + 1); i <= quantidade; i++) {
                        CabTab += "<li class='nav-item' id='liBombas-"+ i +"'>";
                        CabTab += '<a class="nav-link" id="bombas-' + i +'-tab " data-toggle="tab" href="#bomba_' + i + '" role="tab" aria-controls="bomba_' + i + '" aria-selected="true" > @lang('afericao.bomba') ' + i + ' </a>';
                        CabTab += '</li>';

                        HTML += '<div class="tab-pane fade" id="bomba_' + i + '" role="tabpanel" aria-labelledby="bomba_' + i + '" >';
                        HTML +=     '<div class="col-md-12 formpivocentral" id="cssPreloader">';

                        HTML +=         '<div class="form-row justify-content-start">';
                        HTML +=             '<div class="col-md-3 form-group telo5ce">';
                        HTML +=                 '@component("_layouts._components._inputLabel", ["texto" => __("afericao.comprimentoSuccao") . __("unidadesAcoes.(m)"), "id" => ""])@endcomponent';
                        HTML +=                 '<input type="number" step="0.01" id="comprimento_succao_'+i+'" class="form-control" required name="comprimento_succao[]" onchange="validaCampo(this.value, this.id)">';
                        HTML +=             '</div>';
                        HTML +=             '<div class="col-md-3 form-group telo5ce">';
                        HTML +=                 '@component("_layouts._components._inputLabel", ["texto" => __("afericao.diametroSuccao") . __("unidadesAcoes.(m)"), "id" => ""])@endcomponent';
                        HTML +=                 '<input type="number" step="0.001" id="diametro_succao_'+i+'" class="form-control" required name="diametro_succao[]" onchange="validaCampo(this.value, this.id)">';
                        HTML +=             '</div>';
                        HTML +=             '<div class="col-md-3 form-group telo5ce">';
                        HTML +=                 '@component("_layouts._components._inputLabel", ["texto" => __("afericao.marca"), "id" => ""])@endcomponent';
                        HTML +=                 '<input type="text" class="form-control" required name="marca[]" id="marca_'+i+'" onchange="validaCampo(this.value, this.id)">';
                        HTML +=             '</div>';
                        HTML +=             '<div class="col-md-3 form-group telo5ce">';
                        HTML +=                 '@component("_layouts._components._inputLabel", ["texto" => __("afericao.modelo"), "id" => ""])@endcomponent';
                        HTML +=                 '<input type="text" class="form-control" required name="modelo[]" id="modelo_'+i+'" onchange="validaCampo(this.value, this.id)">';
                        HTML +=             '</div>';
                        HTML +=         '</div>';

                        HTML +=         '<div class="form-row justify-content-start">';
                        HTML +=             '<div class="col-md-3 form-group telo5ce">';
                        HTML +=                 '@component("_layouts._components._inputLabel", ["texto" => __("afericao.numeroRotores"), "id" => ""])@endcomponent';
                        HTML +=                 '<input type="number" class="form-control" required name="numero_rotores[]" id="numero_rotores_'+i+'" onchange="validaCampo(this.value, this.id)">';
                        HTML +=             '</div>';
                        HTML +=             '<div class="col-md-3 form-group telo5ce">';
                        HTML +=                 '@component("_layouts._components._inputLabel", ["texto" => __("afericao.diametroRotor"). __("unidadesAcoes.(mm)"), "id" => ""])@endcomponent';
                        HTML +=                 '<input type="number" step="0.01" class="form-control" required name="diametro_rotor[]" id="diametro_rotor_'+i+'" onchange="validaCampo(this.value, this.id)">';
                        HTML +=             '</div>';
                        HTML +=             '<div class="col-md-3 form-group telo5ce">';
                        HTML +=                 '<label for="mat_succao">@lang("afericao.materialSuccao")</label>';
                        HTML +=                 '<select name="material_succao[]" class="form-control" id="mat_succao_'+i+'">';
                        HTML +=                     '<option value="0">@lang("afericao.acoSac")</option>';
                        HTML +=                     '<option value="1">@lang("afericao.AZ")</option>';
                        HTML +=                     '<option value="2">@lang("afericao.PVC")</option>';
                        HTML +=                     '<option value="3">@lang("afericao.RPVC")</option>';
                        HTML +=                 '</select>';
                        HTML +=             '</div>';
                        HTML +=             '<div class="col-md-3 form-group telo5ce">';
                        HTML +=                 '@component("_layouts._components._inputLabel", ["texto" => __("afericao.rendimentoBomba") . __("unidadesAcoes.(%)"), "id" => ""])@endcomponent';
                        HTML +=                 '<input type="number" step="0.01" class="form-control" required name="rendimento_bomba[]" id="rendimento_bomba_'+i+'" onchange="validaCampo(this.value, this.id)">';
                        HTML +=             '</div>';
                        HTML +=         '</div>';
                        HTML +=         '<div class="form-row justify-content-start">';
                        HTML +=             '<div class="col-md-3 form-group telo5ce">';
                        HTML +=                 '@component("_layouts._components._inputLabel", ["texto" => __("afericao.shutoff") . __("unidadesAcoes.(mca)"), "id" => ""])@endcomponent';
                        HTML +=                 '<input type="number" step="0.01" class="form-control" required name="shutoff[]" id="shutoff_'+i+'" onchange="validaCampo(this.value, this.id)">';
                        HTML +=             '</div>';
                        HTML +=             '<div class="col-md-3 form-group telo5ce">';
                        HTML +=                 '@component("_layouts._components._inputLabel", ["texto" => __("afericao.rotacao") . __("unidadesAcoes.(rpm)"), "id" => ""])@endcomponent';
                        HTML +=                 '<input type="number" class="form-control" required name="rotacao[]" id="rotacao_'+i+'" onchange="validaCampo(this.value, this.id)">';
                        HTML +=             '</div>';
                        HTML +=             '<div class="col-md-3 form-group telo5ce">';
                        HTML +=                 '@component("_layouts._components._inputLabel", ["texto" => __("afericao.pressaoBomba") . __("unidadesAcoes.(mca)"), "id" => ""])@endcomponent';
                        HTML +=                 '<input type="number" step="0.01" class="form-control" required name="pressao_bomba[]" id="pressao_bomba_'+i+'" onchange="validaCampo(this.value, this.id)">';
                        HTML +=             '</div>';
                        HTML +=         '</div>';

                        // // {{-- MOTOR --}}
                        HTML +=         '<div class="form-row justify-content-start">';
                        HTML +=             '<div class="col-12">';
                        HTML +=                 '<h4>@lang("afericao.motor")</h4>';
                        HTML +=             '</div>';
                        HTML +=          '</div>';

                        HTML +=         '<div class="form-row justify-content-start">';
                        HTML +=             '<div class="col-md-3 form-group telo5ce">';
                        HTML +=                 '<label for="tipo_motor">@lang("afericao.tipo_motor")</label>';
                        HTML +=                 '<select onchange="tipoMotor('+ i +')" name="tipo_motor[]" class="form-control" id="tipo_motor_'+i+'">';
                        HTML +=                     '<option selected value="diesel">@lang("afericao.diesel")</option>';
                        HTML +=                     '<option value="eletrico">@lang("afericao.eletrico")</option>';
                        HTML +=                 '</select>';
                        HTML +=             '</div>';
                        HTML +=             '<div class="col-md-3 form-group telo5ce">';
                        HTML +=                 '@component("_layouts._components._inputLabel", ["texto" => __("afericao.modelo"), "id" => ""])@endcomponent';
                        HTML +=                 '<input type="text" class="form-control" required name="modelo_motor[]" id="modelo_motor_'+i+'" onchange="validaCampo(this.value, this.id)">';
                        HTML +=             '</div>';
                        HTML +=             '<div class="col-md-3 form-group telo5ce">';
                        HTML +=                 '@component("_layouts._components._inputLabel", ["texto" => __("afericao.potencia") . __("unidadesAcoes.(cv)"), "id" => ""])@endcomponent';
                        HTML +=                 '<input type="number" step="0.01" class="form-control" required name="potencia[]" id="potencia_'+i+'" onchange="validaCampo(this.value, this.id)">';
                        HTML +=             '</div>';
                        HTML +=             '<div class="col-md-3 form-group telo5ce">';
                        HTML +=                 '@component("_layouts._components._inputLabel", ["texto" => __("afericao.numeroMotores"), "id" => ""])@endcomponent';
                        HTML +=                 '<input type="number" class="form-control" required name="numero_motores[]" id="numero_motores_'+i+'" onchange="validaCampo(this.value, this.id)">';
                        HTML +=             '</div>';
                        HTML +=         '</div>';

                        HTML +=         '<div class="form-row justify-content-start">';
                        HTML +=             '<div class="col-md-3 form-group telo5ce">';
                        HTML +=                 '@component("_layouts._components._inputLabel", ["texto" => __("afericao.fatorServico"), "id" => ""])@endcomponent';
                        HTML +=                 '<input type="number" step="0.01" step="0.01" class="form-control" required name="fator_servico[]" id="fator_servico_'+i+'" onchange="validaCampo(this.value, this.id)"> ';
                        HTML +=             '</div>';
                        HTML +=             '<div class="col-md-3 form-group telo5ce">';
                        HTML +=                 '@component("_layouts._components._inputLabel", ["texto" => __("afericao.rendimento") . __("unidadesAcoes.(%)"), "id" => ""])@endcomponent';
                        HTML +=                 '<input type="number" step="0.01" class="form-control" required name="rendimento[]" id="rendimento_'+i+'" onchange="validaCampo(this.value, this.id)">';
                        HTML +=             '</div>';
                        HTML +=         '</div>';

                        HTML +=         '<div style="display:none;" class="motorEletrico pb-5" id="motorEletrico_'+i+'" >';
                        
                                            // {{-- ELETRICO --}}
                        HTML +=             '<div class="form-row justify-content-start">';
                        HTML +=                 '<div class="col-md-3 form-group telo5ce" id="div_tensao_nominal_'+i+'">';
                        HTML +=                     '<label for="tensao_nominal">@lang("afericao.tensaoNominal")</label>';
                        HTML +=                     '<select name="tensao_nominal[]" onchange="calcularCarregamento('+i+')" class="form-control" id="tensao_nominal_'+i+'">';
                        HTML +=                         '<option value="220">220V</option>';
                        HTML +=                         '<option value="380">380V</option>';
                        HTML +=                         '<option value="440">440V</option>';
                        HTML +=                     '</select>';
                        HTML +=                 '</div>';
                        HTML +=                 '<div class="col-md-3 form-group telo5ce">';
                        HTML +=                     '@component("_layouts._components._inputLabel", ["texto" => __("afericao.frequencia"), "id" => ""])@endcomponent';
                        HTML +=                     '<input type="number" value="60" class="form-control has-value" required name="frequencia[]" id="frequencia_'+i+'" onchange="validaCampo(this.value, this.id)">';
                        HTML +=                 '</div>';
                        HTML +=                 '<div class="col-md-3 form-group telo5ce" id="divChavePartida_'+i+'">';
                        HTML +=                     '<label for="chave_partida">@lang("afericao.chavePartida")</label>';
                        HTML +=                     '<select name="chave_partida[]" class="form-control" id="chave_partida_'+i+'"> ';
                        HTML +=                         '<option value="0">Sem Chave</option>';
                        HTML +=                         '<option selected value="1">@lang("afericao.serieParalela")</option>';
                        HTML +=                         '<option value="2">@lang("afericao.estrelaTriangulo")</option>';
                        HTML +=                         '<option value="3">@lang("afericao.compensadora")</option>';
                        HTML +=                         '<option value="4">@lang("afericao.softStarter")</option>';
                        HTML +=                     '</select>';
                        HTML +=                 '</div>';
                        HTML +=                 '<div class="col-md-3 form-group telo5ce" id="div_corrente_nominal_'+i+'">';
                        HTML +=                     '@component("_layouts._components._inputLabel", ["texto" => __("afericao.correnteNominal") . __("unidadesAcoes.(a)"), "id" => ""])@endcomponent';
                        HTML +=                     '<input type="number" step="0.01" class="form-control" id="corrente_nominal_'+i+'" name="corrente_nominal[]" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">';
                        HTML +=                 '</div>';
                        HTML +=             '</div>';

                                            // {{-- LEITURA 1 --}}
                        HTML +=             '<div class="form-row justify-content-start">';
                        HTML +=                 '<div class="col-12>"';
                        HTML +=                     '<h3>@lang("afericao.leitura1")</h3>';
                        HTML +=                     '<h4>@lang("afericao.corrente")</h4>';
                        HTML +=                 '</div>';
                        HTML +=             '</div>';

                        HTML +=             '<div class="form-row justify-content-start">';
                        HTML +=                 '<div class="col-md-4 form-group telo5ce">';
                        HTML +=                     '@component("_layouts._components._inputLabel", ["texto" => __("afericao.fase1") . __("unidadesAcoes.(a)"), "id" => ""])@endcomponent';
                        HTML +=                     '<input type="number" step="0.01" class="form-control" id="bomba_'+i+'_corrente_leitura_1_fase_1" name="corrente_leitura_1_fase_1[]" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">';
                        HTML +=                 '</div>';
                        HTML +=                 '<div class="col-md-4 form-group telo5ce">';
                        HTML +=                     '@component("_layouts._components._inputLabel", ["texto" => __("afericao.fase2") . __("unidadesAcoes.(a)"), "id" => ""])@endcomponent';
                        HTML +=                     '<input type="number" step="0.01" class="form-control" id="bomba_'+i+'_corrente_leitura_1_fase_2" name="corrente_leitura_1_fase_2[]" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">';
                        HTML +=                 '</div>';
                        HTML +=                 '<div class="col-md-4 form-group telo5ce">';
                        HTML +=                     '@component("_layouts._components._inputLabel", ["texto" => __("afericao.fase3") . __("unidadesAcoes.(a)"), "id" => ""])@endcomponent';
                        HTML +=                     '<input type="number" step="0.01" class="form-control" id="bomba_'+i+'_corrente_leitura_1_fase_3" name="corrente_leitura_1_fase_3[]" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">';
                        HTML +=                 '</div>';
                        HTML +=             '</div>';

                        HTML +=             '<div class="form-row justify-content-start">';
                        HTML +=                 '<div class="col-12>"';
                        HTML +=                     '<h4>@lang("afericao.tensao")</h4>';
                        HTML +=                 '</div>';
                        HTML +=             '</div>';

                        HTML +=             '<div class="form-row justify-content-start">';
                        HTML +=                 '<div class="col-md-4 form-group telo5ce">';
                        HTML +=                     '@component("_layouts._components._inputLabel", ["texto" => __("afericao.fase1") . __("unidadesAcoes.(v)"), "id" => ""])@endcomponent';
                        HTML +=                     '<input type="number" step="0.01" class="form-control" name="tensao_leitura_1_fase_1[]" id="bomba_'+i+'_tensao_leitura_1_fase_1" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">';
                        HTML +=                 '</div>';
                        HTML +=                 '<div class="col-md-4 form-group telo5ce">';
                        HTML +=                     '@component("_layouts._components._inputLabel", ["texto" => __("afericao.fase2") . __("unidadesAcoes.(v)"), "id" => ""])@endcomponent';
                        HTML +=                     '<input type="number" step="0.01" class="form-control" name="tensao_leitura_1_fase_2[]" id="bomba_'+i+'_tensao_leitura_1_fase_2" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">';
                        HTML +=                 '</div>';
                        HTML +=                 '<div class="col-md-4 form-group telo5ce">';
                        HTML +=                     '@component("_layouts._components._inputLabel", ["texto" => __("afericao.fase3") .__("unidadesAcoes.(v)"), "id" => ""])@endcomponent';
                        HTML +=                     '<input type="number" step="0.01" class="form-control"name="tensao_leitura_1_fase_3[]" id="bomba_'+i+'_tensao_leitura_1_fase_3"onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">';
                        HTML +=                 '</div>';
                        HTML +=             '</div>';

                        HTML +=             '<div class="form-row justify-content-start">';
                        HTML +=                 '<div class="col-md-4 form-group telo5ce">';
                        HTML +=                     '@component("_layouts._components._inputLabel", ["texto" => __("afericao.indice_carregamento"), "id" => ""])@endcomponent';
                        HTML +=                     '<input type="number" step="0.01" class="form-control has-value" value="0" readonly id="bomba_'+i+'_indice_carregamento_leitura_1_fase_1" onchange="validaCampo(this.value, this.id)">';
                        HTML +=                 '</div>';
                        HTML +=                 '<div class="col-md-4 form-group telo5ce">';
                        HTML +=                     '@component("_layouts._components._inputLabel", ["texto" => __("afericao.indice_carregamento"), "id" => ""])@endcomponent';
                        HTML +=                     '<input type="number" step="0.01" class="form-control has-value" value="0" readonly id="bomba_'+i+'_indice_carregamento_leitura_1_fase_2" onchange="validaCampo(this.value, this.id)">';
                        HTML +=                 '</div>';
                        HTML +=                 '<div class="col-md-4 form-group telo5ce">';
                        HTML +=                     '@component("_layouts._components._inputLabel", ["texto" =>__("afericao.indice_carregamento"), "id" => ""])@endcomponent';
                        HTML +=                     '<input type="number" step="0.01" class="form-control has-value" value="0" readonly id="bomba_'+i+'_indice_carregamento_leitura_1_fase_3" onchange="validaCampo(this.value, this.id)">';
                        HTML +=                 '</div>';
                        HTML +=             '</div>';

                        //                     // {{-- LEITURA 2 --}}
                        HTML +=             '<div class="form-row justify-content-start">';
                        HTML +=                 '<div class="col-12>"';
                        HTML +=                     '<h3>@lang("afericao.leitura2")</h3>';
                        HTML +=                     '<h4>@lang("afericao.corrente")</h4>';
                        HTML +=                 '</div>';
                        HTML +=             '</div>';

                        HTML +=             '<div class="form-row justify-content-start">';
                        HTML +=                 '<div class="col-md-4 form-group telo5ce">';
                        HTML +=                     '@component("_layouts._components._inputLabel", ["texto" => __("afericao.fase1") . __("unidadesAcoes.(a)"), "id" => ""])@endcomponent';
                        HTML +=                     '<input type="number" step="0.01" class="form-control" id="bomba_'+i+'_corrente_leitura_2_fase_1" name="corrente_leitura_2_fase_1[]" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">';
                        HTML +=                 '</div>';
                        HTML +=                 '<div class="col-md-4 form-group telo5ce">';
                        HTML +=                     '@component("_layouts._components._inputLabel", ["texto" => __("afericao.fase2") . __("unidadesAcoes.(a)"), "id" => ""])@endcomponent';
                        HTML +=                     '<input type="number" step="0.01" class="form-control" id="bomba_'+i+'_corrente_leitura_2_fase_2" name="corrente_leitura_2_fase_2[]" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">';
                        HTML +=                 '</div>';
                        HTML +=                 '<div class="col-md-4 form-group telo5ce">';
                        HTML +=                     '@component("_layouts._components._inputLabel", ["texto" => __("afericao.fase3") . __("unidadesAcoes.(a)"), "id" => ""])@endcomponent';
                        HTML +=                     '<input type="number" step="0.01" class="form-control" id="bomba_'+i+'_corrente_leitura_2_fase_3" name="corrente_leitura_2_fase_3[]" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">';
                        HTML +=                 '</div>';
                        HTML +=             '</div>';

                        HTML +=             '<div class="form-row justify-content-start">';
                        HTML +=                 '<div class="col-12>"';
                        HTML +=                     '<h4>@lang("afericao.tensao")</h4>';
                        HTML +=                 '</div>';
                        HTML +=             '</div>';

                        HTML +=             '<div class="form-row justify-content-start">';
                        HTML +=                 '<div class="col-md-4 form-group telo5ce">';
                        HTML +=                     '@component("_layouts._components._inputLabel", ["texto" => __("afericao.fase1") . __("unidadesAcoes.(v)"), "id" => ""])@endcomponent';
                        HTML +=                     '<input type="number" step="0.01" class="form-control" name="tensao_leitura_2_fase_1[]" id="bomba_'+i+'_tensao_leitura_2_fase_1" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">';
                        HTML +=                 '</div>';
                        HTML +=                 '<div class="col-md-4 form-group telo5ce">';
                        HTML +=                     '@component("_layouts._components._inputLabel", ["texto" => __("afericao.fase2") . __("unidadesAcoes.(v)"), "id" => ""])@endcomponent';
                        HTML +=                     '<input type="number" step="0.01" class="form-control" name="tensao_leitura_2_fase_2[]" id="bomba_'+i+'_tensao_leitura_2_fase_2" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">';
                        HTML +=                 '</div>';
                        HTML +=                 '<div class="col-md-4 form-group telo5ce">';
                        HTML +=                     '@component("_layouts._components._inputLabel", ["texto" => __("afericao.fase3") .__("unidadesAcoes.(v)"), "id" => ""])@endcomponent';
                        HTML +=                     '<input type="number" step="0.01" class="form-control"name="tensao_leitura_2_fase_3[]" id="bomba_'+i+'_tensao_leitura_2_fase_3"onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">';
                        HTML +=                 '</div>';
                        HTML +=             '</div>';

                        HTML +=             '<div class="form-row justify-content-start">';
                        HTML +=                 '<div class="col-md-4 form-group telo5ce">';
                        HTML +=                     '@component("_layouts._components._inputLabel", ["texto" => __("afericao.indice_carregamento"), "id" => ""])@endcomponent';
                        HTML +=                     '<input type="number" step="0.01" class="form-control has-value" value="0" readonly id="bomba_'+i+'_indice_carregamento_leitura_2_fase_1" onchange="validaCampo(this.value, this.id)">';
                        HTML +=                 '</div>';
                        HTML +=                 '<div class="col-md-4 form-group telo5ce">';
                        HTML +=                     '@component("_layouts._components._inputLabel", ["texto" => __("afericao.indice_carregamento"), "id" => ""])@endcomponent';
                        HTML +=                     '<input type="number" step="0.01" class="form-control has-value" value="0" readonly id="bomba_'+i+'_indice_carregamento_leitura_2_fase_2" onchange="validaCampo(this.value, this.id)">';
                        HTML +=                 '</div>';
                        HTML +=                 '<div class="col-md-4 form-group telo5ce">';
                        HTML +=                     '@component("_layouts._components._inputLabel", ["texto" =>__("afericao.indice_carregamento"), "id" => ""])@endcomponent';
                        HTML +=                     '<input type="number" step="0.01" class="form-control has-value" value="0" readonly id="bomba_'+i+'_indice_carregamento_leitura_2_fase_3" onchange="validaCampo(this.value, this.id)">';
                        HTML +=                 '</div>';
                        HTML +=             '</div>';
                        HTML +=         '</div>';

                        HTML +=     '</div>'; 
                        HTML += '</div>';
                        
                    }

                    $('#myTab').append(CabTab);

                    $('#myTabContent').append(HTML);
                } else if (quantidade < qtBombaAtual){
                    for (j = qtBombaAtual; j > quantidade; j--){
                        $("#liBombas-"+ j +"").remove();
                    }
                }
            });

        });

        function tipoMotor(val) {
                bombeamento = $("#tipo_motor_" + val + " option:selected").text();
                motorEletrico = document.getElementById('motorEletrico_' + val);
                if (bombeamento != "Diesel") {
                    motorEletrico.style.display = 'block';
                } else {
                    motorEletrico.style.display = 'none';
                }
            }
    </script>

    <script>
        function calcularCarregamento(id_bomba){
            let correnteNominal = $("#corrente_nominal_"+id_bomba).val();

            if(correnteNominal != null && correnteNominal > 0){
                let leitura = $("#bomba_"+id_bomba+"_corrente_leitura_1_fase_1").val();            
                if(leitura != null && leitura > 0){
                    //Calculo de correção
                    var correcao_corrente_eletrica_1_fase_1 = leitura * $('#bomba_'+id_bomba+'_tensao_leitura_1_fase_1').val() * Math.sqrt(3) / $('#tensao_nominal_'+id_bomba).val();
                    var carregamento = (correcao_corrente_eletrica_1_fase_1/correnteNominal)*100;
                    $("#bomba_"+id_bomba+"_indice_carregamento_leitura_1_fase_1").val(parseFloat(carregamento.toFixed(2)));
                }
                
                leitura = $("#bomba_"+id_bomba+"_corrente_leitura_1_fase_2").val(); 
                if(leitura != null && leitura > 0){
                    //Calculo de correção
                    var correcao_corrente_eletrica_1_fase_2 = leitura * $('#bomba_'+id_bomba+'_tensao_leitura_1_fase_2').val() * Math.sqrt(3) / $('#tensao_nominal_'+id_bomba).val();
                    var carregamento = (correcao_corrente_eletrica_1_fase_2/correnteNominal)*100;
                    $("#bomba_"+id_bomba+"_indice_carregamento_leitura_1_fase_2").val(parseFloat(carregamento.toFixed(2)));
                }

                leitura = $("#bomba_"+id_bomba+"_corrente_leitura_1_fase_3").val(); 
                if(leitura != null && leitura > 0){
                    //Calculo de correção
                    var correcao_corrente_eletrica_1_fase_3 = leitura * $('#bomba_'+id_bomba+'_tensao_leitura_1_fase_3').val() * Math.sqrt(3) / $('#tensao_nominal_'+id_bomba).val();
                    var carregamento = (correcao_corrente_eletrica_1_fase_3/correnteNominal)*100;
                    $("#bomba_"+id_bomba+"_indice_carregamento_leitura_1_fase_3").val(parseFloat(carregamento.toFixed(2)));
                }

                leitura = $("#bomba_"+id_bomba+"_corrente_leitura_2_fase_1").val(); 
                if(leitura != null && leitura > 0){
                    //Calculo de correção
                    var correcao_corrente_eletrica_2_fase_1 = leitura * $('#bomba_'+id_bomba+'_tensao_leitura_2_fase_1').val() * Math.sqrt(3) / $('#tensao_nominal_'+id_bomba).val();
                    var carregamento = (correcao_corrente_eletrica_2_fase_1/correnteNominal)*100;
                    $("#bomba_"+id_bomba+"_indice_carregamento_leitura_2_fase_1").val(parseFloat(carregamento.toFixed(2)));
                }

                leitura = $("#bomba_"+id_bomba+"_corrente_leitura_2_fase_2").val(); 
                if(leitura != null && leitura > 0){
                    //Calculo de correção
                    var correcao_corrente_eletrica_2_fase_2 = leitura * $('#bomba_'+id_bomba+'_tensao_leitura_2_fase_2').val() * Math.sqrt(3) / $('#tensao_nominal_'+id_bomba).val();
                    var carregamento = (correcao_corrente_eletrica_2_fase_2/correnteNominal)*100;
                    $("#bomba_"+id_bomba+"_indice_carregamento_leitura_2_fase_2").val(parseFloat(carregamento.toFixed(2)));
                }

                leitura = $("#bomba_"+id_bomba+"_corrente_leitura_2_fase_3").val(); 
                if(leitura != null && leitura > 0){
                    //Calculo de correção
                    var correcao_corrente_eletrica_2_fase_3 = leitura * $('#bomba_'+id_bomba+'_tensao_leitura_2_fase_3').val() * Math.sqrt(3) / $('#tensao_nominal_'+id_bomba).val();
                    var carregamento = (correcao_corrente_eletrica_2_fase_3/correnteNominal)*100;
                    $("#bomba_"+id_bomba+"_indice_carregamento_leitura_2_fase_3").val(parseFloat(carregamento.toFixed(2)));
                }
            }
        }
    </script>
@endsection
