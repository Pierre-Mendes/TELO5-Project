<?php
/*session()->get('numero_bombeamentos');
session()->get('bomba_atual');*/
$id_afericao = session()->get('id_afericao'); ?>

@extends('_layouts._layout_site')

@section('titulo')

@endsection

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- TITULO E SUBTITULO --}}
            <div class="col-6">
                <h1>@lang('afericao.cadastroBombeamento')</h1>
            </div>

            {{-- BOTOES SALVAR E VOLTAR --}}
            <div class="col-6 text-right botoes position">
                {{-- href="{{ route('status_afericao', $id_afericao) }}"> --}}
                <a href="{{ route('afericoes.pivo.central') }}" style="color: #3c8dbc">
                    <button type="button">
                        <span class="fa-stack fa-lg">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fas fa-angle-double-left fa-stack-1x fa-inverse"></i>
                        </span>
                    </button>
                </a>
                <button type="button" id="botaosalvar">
                    <span class="fa-stack fa-2x">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-save fa-stack-1x fa-inverse"></i>
                    </span>
                </button>
            </div>
        </div>
    @endsection

    @section('conteudo')

        <div class="formafericao">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @for ($i = 1; $i <= $numero_bombas; $i++)
                    <li class="nav-item">
                        <a class="nav-link {{ $i == 1 ? 'active' : '' }}" id="iGerais-tab" data-toggle="tab"
                            href="#bomba_{{ $i }}" role="tab" aria-controls="bomba_{{ $i }}"
                            aria-selected="true">Bomba {{ $i }}</a>
                    </li>
                @endfor
            </ul>
            <form action="{{ route('salvarItemBombeamento.salvar') }}" method="post" id="formdados">
                @csrf
                <input type="hidden" value="{{ $id_afericao }}" name="id_afericao">
                <input type="hidden" value="{{ $numero_bombas }}" name="numero_bombas">
                <input type="hidden" value="{{ $id_bombeamento }}" name="id_bombeamento">
                <div class="tab-content mt-5" id="myTabContent">
                    @for ($i = 1; $i <= $numero_bombas; $i++)
                        <div class="tab-pane fade {{ $i == 1 ? 'show active' : '' }}" id="bomba_{{ $i }}"
                            role="tabpanel" aria-labelledby="bomba_{{ $i }}">
                            <div class="col-md-12 formpivocentral">
                                <div class="form-row justify-content-center">
                                    <div class="col-md-3 form-group telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.comprimentoSuccao') . __('unidadesAcoes.(m)'), 'id' =>
                                        ''])@endcomponent
                                        <input type="number" step="0.01" id="comprimento_succao_'+i+'" class="form-control"
                                            required name="comprimento_succao[]"
                                            onchange="validaCampo(this.value, this.id)">
                                    </div>

                                    <div class="col-md-3 form-group telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.diametroSuccao') . __('unidadesAcoes.(m)'), 'id' => ''])@endcomponent
                                        <input type="number" step="0.001" id="diametro_succao_'+i+'" class="form-control"
                                            required name="diametro_succao[]" onchange="validaCampo(this.value, this.id)">
                                    </div>

                                    <div class="col-md-3 form-group telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.marca'),
                                        'id' => ''])@endcomponent
                                        <input type="text" class="form-control" required name="marca[]" id="marca_'+i+'"
                                            onchange="validaCampo(this.value, this.id)">
                                    </div>

                                    <div class="col-md-3 form-group telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.modelo'),
                                        'id' => ''])@endcomponent
                                        <input type="text" class="form-control" required name="modelo[]" id="modelo_'+i+'"
                                            onchange="validaCampo(this.value, this.id)">
                                    </div>
                                </div>

                                <div class="form-row justify-content-center">
                                    <div class="col-md-3 form-group telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.numeroRotores'), 'id' => ''])@endcomponent
                                        <input type="number" class="form-control" required name="numero_rotores[]"
                                            id="numero_rotores_'+i+'" onchange="validaCampo(this.value, this.id)">
                                    </div>

                                    <div class="col-md-3 form-group telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.diametroRotor') . __('unidadesAcoes.(mm)'), 'id' => ''])@endcomponent
                                        <input type="number" step="0.01" class="form-control" required
                                            name="diametro_rotor[]" id="diametro_rotor_'+i+'"
                                            onchange="validaCampo(this.value, this.id)">
                                    </div>

                                    <div class="col-md-3 form-group telo5ce">
                                        <label for="mat_succao">@lang("afericao.materialSuccao")</label>
                                        <select name="material_succao[]" class="form-control" id="mat_succao_'+i+'">
                                            <option value="0">@lang("afericao.acoSac")</option>
                                            <option value="1">@lang("afericao.AZ")</option>
                                            <option value="2">@lang("afericao.PVC")</option>
                                            <option value="3">@lang("afericao.RPVC")</option>
                                        </select>
                                        <div class="line"></div>
                                    </div>

                                    <div class="col-md-3 form-group telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.rendimentoBomba') . __('unidadesAcoes.(%)'), 'id' => ''])@endcomponent
                                        <input type="number" step="0.01" class="form-control" required
                                            name="rendimento_bomba[]" id="rendimento_bomba_'+i+'"
                                            onchange="validaCampo(this.value, this.id)">
                                    </div>
                                </div>

                                <div class="form-row justify-content-start">
                                    <div class="col-md-3 form-group telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.shutoff') .
                                        __('unidadesAcoes.(mca)'), 'id' => ''])@endcomponent
                                        <input type="number" step="0.01" class="form-control" required name="shutoff[]"
                                            id="shutoff_'+i+'" onchange="validaCampo(this.value, this.id)">
                                    </div>

                                    <div class="col-md-3 form-group telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.rotacao') .
                                        __('unidadesAcoes.(rpm)'), 'id' => ''])@endcomponent
                                        <input type="number" class="form-control" required name="rotacao[]"
                                            id="rotacao_'+i+'" onchange="validaCampo(this.value, this.id)">
                                    </div>

                                    <div class="col-md-3 form-group telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.pressaoBomba') . __('unidadesAcoes.(mca)'), 'id' => ''])@endcomponent
                                        <input type="number" step="0.01" class="form-control" required
                                            name="pressao_bomba[]" id="pressao_bomba_'+i+'"
                                            onchange="validaCampo(this.value, this.id)">
                                    </div>
                                </div>

                                {{-- MOTOR --}}
                                <div class="form-row justify-content-center">
                                    <div class="col-12">
                                        <h4>@lang("afericao.motor")</h4>
                                    </div>
                                </div>

                                <div class="form-row justify-content-center">
                                    <div class="col-md-3 form-group telo5ce">
                                        <label for="tipo_motor">@lang("afericao.tipo_motor")</label>
                                        <select onchange="tipoMotor({{ $i }})" onclick="selected(this.value)"
                                            name="tipo_motor[]" class="form-control" id="tipo_motor_{{ $i }}">
                                            <option selected value="diesel">@lang("afericao.diesel")</option>
                                            <option value="eletrico">@lang("afericao.eletrico")</option>
                                        </select>
                                        <div class="line"></div>
                                    </div>

                                    <div class="col-md-3 form-group telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.modelo'),
                                        'id' => ''])@endcomponent
                                        <input type="text" class="form-control" required name="modelo_motor[]"
                                            id="modelo_motor_'+i+'" onchange="validaCampo(this.value, this.id)">
                                    </div>

                                    <div class="col-md-3 form-group telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.potencia') .
                                        __('unidadesAcoes.(cv)'), 'id' => ''])@endcomponent
                                        <input type="number" step="0.01" class="form-control" required name="potencia[]"
                                            id="potencia_'+i+'" onchange="validaCampo(this.value, this.id)">
                                    </div>

                                    <div class="col-md-3 form-group telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.numeroMotores'), 'id' => ''])@endcomponent
                                        <input type="number" class="form-control" required name="numero_motores[]"
                                            id="numero_motores_'+i+'" onchange="validaCampo(this.value, this.id)">
                                    </div>
                                </div>

                                <div class="form-row justify-content-start">
                                    <div class="col-md-3 form-group telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.fatorServico'), 'id' => ''])@endcomponent
                                        <input type="number" step="0.01" step="0.01" class="form-control" required
                                            name="fator_servico[]" id="fator_servico_'+i+'"
                                            onchange="validaCampo(this.value, this.id)">
                                    </div>

                                    <div class="col-md-3 form-group telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.rendimento'), 'id' => ''])@endcomponent
                                        <input type="number" step="0.01" class="form-control" required name="rendimento[]"
                                            id="rendimento_'+i+'" onchange="validaCampo(this.value, this.id)">
                                    </div>
                                </div>

                                <div style="display:none;" class="motorEletrico" id="motorEletrico_{{ $i }}">
                                    {{-- ELETRICO --}}
                                    <div class="form-row justify-content-start">
                                        <div class="col-md-3 form-group telo5ce" id="div_tensao_nominal_'+i+'">
                                            <label for="tensao_nominal">@lang("afericao.tensaoNominal")</label>
                                            <select name="tensao_nominal[]" onchange="calcularCarregamento('+i+')"
                                                class="form-control" id="tensao_nominal_'+i+'">
                                                <option value="220">220V</option>
                                                <option value="380">380V</option>
                                                <option value="440">440V</option>
                                            </select>
                                            <div class="line"></div>
                                        </div>

                                        <div class="col-md-3 form-group telo5ce" id="div_frequenhiddencia_'+i+'">
                                            @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.frequencia'), 'id' => ''])@endcomponent
                                            <input type="number" value="60" class="form-control has-value" required
                                                name="frequencia[]" id="frequencia_'+i+'"
                                                onchange="validaCampo(this.value, this.id)">
                                        </div>

                                        <div class="col-md-3 form-group telo5ce" id="divChavePartida_'+i+'">
                                            <label for="chave_partida">@lang("afericao.chavePartida")</label>
                                            <select name="chave_partida[]" class="form-control" id="chave_partida_'+i+'">
                                                <option value="0">Sem Chave</option>
                                                <option selected value="1">@lang("afericao.serieParalela")</option>
                                                <option value="2">@lang("afericao.estrelaTriangulo")</option>
                                                <option value="3">@lang("afericao.compensadora")</option>
                                                <option value="4">@lang("afericao.softStarter")</option>
                                            </select>
                                            <div class="line"></div>
                                        </div>

                                        <div class="col-md-3 form-group telo5ce" id="div_corrente_nominal_'+i+'">
                                            @component('_layouts._components._inputLabel', ['texto' =>
                                                __('afericao.correnteNominal') . __('unidadesAcoes.(a)'), 'id' =>
                                            ''])@endcomponent
                                            <input type="number" step="0.01" class="form-control"
                                                id="corrente_nominal_'+i+'" name="corrente_nominal[]"
                                                onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">
                                        </div>
                                    </div>

                                    {{-- LEITURA 1 --}}
                                    <div class="form-row justify-content-start">
                                        <div class="col-12">
                                            <h3>@lang("afericao.leitura1")</h3>
                                            <h4>@lang("afericao.corrente")</h4>
                                        </div>
                                    </div>

                                    <div class="form-row justify-content-start">
                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase1')
                                            . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent
                                            <input type="number" step="0.01" class="form-control"
                                                id="bomba_'+i+'_corrente_leitura_1_fase_1"
                                                name="corrente_leitura_1_fase_1[]"
                                                onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">
                                        </div>

                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase2')
                                            . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent
                                            <input type="number" step="0.01" class="form-control"
                                                id="bomba_'+i+'_corrente_leitura_1_fase_2"
                                                name="corrente_leitura_1_fase_2[]"
                                                onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">
                                        </div>

                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase3')
                                            . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent
                                            <input type="number" step="0.01" class="form-control"
                                                id="bomba_'+i+'_corrente_leitura_1_fase_3"
                                                name="corrente_leitura_1_fase_3[]"
                                                onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">
                                        </div>
                                    </div>

                                    <div class="form-row justify-content-start">
                                        <h4 class="col-12 ">@lang("afericao.tensao")</h4>
                                    </div>

                                    <div class="form-row justify-content-start">
                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase1')
                                            . __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent
                                            <input type="number" step="0.01" class="form-control"
                                                name="tensao_leitura_1_fase_1[]" id="bomba_'+i+'_tensao_leitura_1_fase_1"
                                                onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">
                                        </div>

                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase2')
                                            . __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent
                                            <input type="number" step="0.01" class="form-control"
                                                name="tensao_leitura_1_fase_2[]" id="bomba_'+i+'_tensao_leitura_1_fase_2"
                                                onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">
                                        </div>

                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase3')
                                            . __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent
                                            <input type="number" step="0.01" class="form-control"
                                                name="tensao_leitura_1_fase_3[]" id="bomba_'+i+'_tensao_leitura_1_fase_3"
                                                onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">
                                        </div>
                                    </div>

                                    <div class="form-row justify-content-start">
                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.indice_carregamento'), 'id' => ''])@endcomponent
                                            <input type="number" step="0.01" class="form-control has-value" value="0"
                                                readonly id="bomba_'+i+'_indice_carregamento_leitura_1_fase_1"
                                                onchange="validaCampo(this.value, this.id)">
                                        </div>

                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.indice_carregamento'), 'id' => ''])@endcomponent
                                            <input type="number" step="0.01" class="form-control has-value" value="0"
                                                readonly id="bomba_'+i+'_indice_carregamento_leitura_1_fase_2"
                                                onchange="validaCampo(this.value, this.id)">
                                        </div>

                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.indice_carregamento'), 'id' => ''])@endcomponent
                                            <input type="number" step="0.01" class="form-control has-value" value="0"
                                                readonly id="bomba_'+i+'_indice_carregamento_leitura_1_fase_3"
                                                onchange="validaCampo(this.value, this.id)">
                                        </div>
                                    </div>

                                    {{-- LEITURA 2 --}}
                                    <div class="form-row justify-content-start">
                                        <div class="col-12">
                                            <h3>@lang("afericao.leitura2")</h3>
                                            <h4>@lang("afericao.corrente")</h4>
                                        </div>
                                    </div>

                                    <div class="form-row justify-content-start">
                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase1')
                                            . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent
                                            <input type="number" step="0.01" class="form-control"
                                                id="bomba_'+i+'_corrente_leitura_2_fase_1"
                                                name="corrente_leitura_2_fase_1[]"
                                                onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">
                                        </div>

                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase2')
                                            . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent
                                            <input type="number" step="0.01" class="form-control"
                                                id="bomba_'+i+'_corrente_leitura_2_fase_2"
                                                name="corrente_leitura_2_fase_2[]"
                                                onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                                        </div>

                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase3')
                                            . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent
                                            <input type="number" step="0.01" class="form-control"
                                                id="bomba_'+i+'_corrente_leitura_2_fase_3"
                                                name="corrente_leitura_2_fase_3[]"
                                                onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">
                                        </div>
                                    </div>

                                    <div class="form-row justify-content-start">
                                        <h4 class="col-12 ">@lang("afericao.tensao")</h4>
                                    </div>

                                    <div class="form-row justify-content-start">
                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase1')
                                            . __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent
                                            <input type="number" step="0.01" class="form-control"
                                                name="tensao_leitura_2_fase_1[]" id="bomba_'+i+'_tensao_leitura_2_fase_1"
                                                onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">
                                        </div>

                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase2')
                                            . __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent
                                            <input type="number" step="0.01" class="form-control"
                                                name="tensao_leitura_2_fase_2[]" id="bomba_'+i+'_tensao_leitura_2_fase_2"
                                                onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">
                                        </div>

                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase3')
                                            . __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent
                                            <input type="number" step="0.01" class="form-control"
                                                name="tensao_leitura_2_fase_3[]" id="bomba_'+i+'_tensao_leitura_2_fase_3"
                                                onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">
                                        </div>
                                    </div>

                                    <div class="form-row justify-content-start">
                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.indice_carregamento'), 'id' => ''])@endcomponent
                                            <input type="number" step="0.01" class="form-control has-value" readonly
                                                value="0" id="bomba_'+i+'_indice_carregamento_leitura_2_fase_1">
                                        </div>

                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.indice_carregamento'), 'id' => ''])@endcomponent
                                            <input type="number" step="0.01" class="form-control has-value" readonly
                                                value="0" id="bomba_'+i+'_indice_carregamento_leitura_2_fase_2">
                                        </div>

                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.indice_carregamento'), 'id' => ''])@endcomponent
                                            <input type="number" step="0.01" class="form-control has-value" readonly
                                                value="0" id="bomba_'+i+'_indice_carregamento_leitura_2_fase_3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </form>
        </div>


    @endsection

    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#botaosalvar').on('click', function() {
                    $('#formdados').submit();
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

        <!-- Inclusão do Plugin jQuery Validation-->
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
        <script>
            $(document).ready(function() {
                $("#formdados").validate({
                    rules: {
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
                        comprimento_succao: "Campo <strong>COMPRIMENTO DE SUCÇÃO</strong> é obrigatório",

                        "diametro_succao": {
                            required: "Campo <strong>DIÂMETRO DE SUCÇÃO</strong> é obrigatório"
                        },
                        "marca": {
                            required: "Campo <strong>MARCA</strong> é obrigatório"
                        },
                        "modelo": {
                            required: "Campo <strong>MODELO</strong> é obrigatório"
                        },
                        "numero_rotores": {
                            required: "Campo <strong>NUMERO DE ROTORES</strong> é obrigatório"
                        },
                        "diametro_rotor": {
                            required: "Campo <strong>DIÂMETRO DE ROTOR</strong> é obrigatório"
                        },
                        "rendimento_bomba": {
                            required: "Campo <strong>MODELO</strong> é obrigatório"
                        },
                        "shutoff": {
                            required: "Campo <strong>MODELO</strong> é obrigatório"
                        },
                        "rotacao": {
                            required: "Campo <strong>MODELO</strong> é obrigatório"
                        },
                        "pressao_bomba": {
                            required: "Campo <strong>MODELO</strong> é obrigatório"
                        },
                        "modelo_motor": {
                            required: "Campo <strong>MODELO</strong> é obrigatório"
                        },
                        "potencia": {
                            required: "Campo <strong>MODELO</strong> é obrigatório"
                        },
                        "numero_motores": {
                            required: "Campo <strong>MODELO</strong> é obrigatório"
                        },
                        "fator_servico": {
                            required: "Campo <strong>MODELO</strong> é obrigatório"
                        },
                        "rendimento": {
                            required: "Campo <strong>MODELO</strong> é obrigatório"
                        },
                        "frequencia": {
                            required: "Campo <strong>MODELO</strong> é obrigatório"
                        },
                        "corrente_nominal": {
                            required: "Campo <strong>MODELO</strong> é obrigatório"
                        },
                        "corrente_leitura_1_fase_1": {
                            required: "Campo <strong>MODELO</strong> é obrigatório"
                        },
                        "corrente_leitura_1_fase_2": {
                            required: "Campo <strong>MODELO</strong> é obrigatório"
                        },
                        "corrente_leitura_1_fase_3": {
                            required: "Campo <strong>MODELO</strong> é obrigatório"
                        },
                        "tensao_leitura_1_fase_1": {
                            required: "Campo <strong>MODELO</strong> é obrigatório"
                        },
                        "tensao_leitura_1_fase_2": {
                            required: "Campo <strong>MODELO</strong> é obrigatório"
                        },
                        "tensao_leitura_1_fase_3": {
                            required: "Campo <strong>MODELO</strong> é obrigatório"
                        },
                        "corrente_leitura_2_fase_1": {
                            required: "Campo <strong>MODELO</strong> é obrigatório"
                        },
                        "corrente_leitura_2_fase_2": {
                            required: "Campo <strong>MODELO</strong> é obrigatório"
                        },
                        "corrente_leitura_2_fase_3": {
                            required: "Campo <strong>MODELO</strong> é obrigatório"
                        },
                        "tensao_leitura_2_fase_1": {
                            required: "Campo <strong>MODELO</strong> é obrigatório"
                        },
                        "tensao_leitura_2_fase_2": {
                            required: "Campo <strong>MODELO</strong> é obrigatório"
                        },
                        "tensao_leitura_2_fase_3": {
                            required: "Campo <strong>MODELO</strong> é obrigatório"
                        },
                    }
                });
            });

        </script>
    @endsection
