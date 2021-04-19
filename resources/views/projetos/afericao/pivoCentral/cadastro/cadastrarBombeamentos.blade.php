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
                <li class="nav-item">
                    <a class="nav-link active" id="iGerais-tab" data-toggle="tab" href="#iGerais" role="tab"
                        aria-controls="iGerais" aria-selected="true">Cadastrar bombeamento</a>
                </li>
            </ul>
            <form action="{{ route('cadastraBombeamento') }}" method="POST" id="formdados">
                @csrf
                <input type="hidden" value="{{ session()->get('id_afericao') }}" name="id_afericao">
                <div id="collapseBombeamento" class="collapse show" aria-labelledby="headingBombeamento"
                    data-parent="#accordion">
                    <div class="card-body row">
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
                                <option value="0">@lang('afericao.direta')</option>
                                <option value="1">@lang('afericao.afogada')</option>
                                <option value="2">@lang('afericao.balsa')</option>
                                <option value="3">@lang('afericao.submersa')</option>
                            </select>
                            <div class="line"></div>
                        </div>

                        <div>

                        </div>

                        <div class="col-md-3 form-group telo5ce">
                            <label for="posicionamento_bombeamento">@lang('afericao.posicionamentoBombeamento')</label>
                            <select name="posicionamento_bombeamento" class="form-control" id="posicionamento_bombeamento">
                                <option value="0">@lang('afericao.simples')</option>
                                <option value="1">@lang('afericao.serie')</option>
                                <option value="2">@lang('afericao.paralelo')</option>
                            </select>
                            <div class="line"></div>
                        </div>

                        <div class="col-md-3 form-group telo5ce">
                            <label for="captacao">@lang('afericao.captacao')</label>
                            <select name="captacao" class="form-control" id="captacao">
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


                <div id="DivBombas">
                    <div class="card-body " id="bomba_1">
                        <div class="col-12" id="headingBomba_1">
                            <h4>@lang("afericao.bomba") 1
                                <button type="button" class="btn btn-outline-primary float-right" data-toggle="collapse"
                                    data-target="#control_bomba_1" aria-expanded="true" aria-controls="control_bomba_1">
                                    <i class="fa fa-bars fa-fw"></i>
                                </button>
                            </h4>
                        </div>

                        <div class="col-md-12 collapse show" id="control_bomba_1" aria-labelledby="headingBomba_1"
                            data-parent="#DivBombas">

                            <div class="form-row justify-content-center">
                                <div class="col-md-3 form-group telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' =>
                                    __('afericao.comprimentoSuccao') . __('unidadesAcoes.(m)'), 'id' => ''])@endcomponent
                                    <input type="number" step="0.01" id="comprimento_succao_1" class="form-control" required
                                        name="comprimento_succao[]" onchange="validaCampo(this.value, this.id)">
                                </div>

                                <div class="col-md-3 form-group telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.diametroSuccao')
                                    . __('unidadesAcoes.(m)'), 'id' => ''])@endcomponent
                                    <input type="number" step="0.001" id="diametro_succao_1" class="form-control" required
                                        name="diametro_succao[]" onchange="validaCampo(this.value, this.id)">
                                </div>

                                <div class="col-md-3 form-group telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.marca'), 'id' =>
                                    ''])@endcomponent
                                    <input type="text" class="form-control" required name="marca[]" id="marca_1"
                                        onchange="validaCampo(this.value, this.id)">
                                </div>

                                <div class="col-md-3 form-group telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.modelo'), 'id'
                                    => ''])@endcomponent
                                    <input type="text" class="form-control" required name="modelo[]" id="modelo_1"
                                        onchange="validaCampo(this.value, this.id)">
                                </div>

                                {{-- aqui --}}
                                <div class="form-row justify-content-center">
                                    <div class="col-md-3 form-group telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.numeroRotores'), 'id' => ''])@endcomponent

                                        <input type="number" class="form-control" required name="numero_rotores[]"
                                            id="numero_rotores_1" onchange="validaCampo(this.value, this.id)">
                                    </div>

                                    <div class="col-md-3 form-group telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.diametroRotor') . __('unidadesAcoes.(mm)'), 'id' => ''])@endcomponent

                                        <input type="number" step="0.01" class="form-control" required
                                            name="diametro_rotor[]" id="diametro_rotor_1"
                                            onchange="validaCampo(this.value, this.id)">
                                    </div>

                                    <div class="col-md-3 form-group telo5ce">
                                        <label for="mat_succao">@lang("afericao.materialSuccao")</label>

                                        <select name="material_succao[]" class="form-control" id="mat_succao_1">
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
                                            name="rendimento_bomba[]" id="rendimento_bomba_1"
                                            onchange="validaCampo(this.value, this.id)">
                                    </div>
                                </div>

                                <div class="form-row justify-content-center">
                                    <div class="col-md-4 form-group telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.shutoff') .
                                        __('unidadesAcoes.(mca)'), 'id' => ''])@endcomponent

                                        <input type="number" step="0.01" class="form-control" required name="shutoff[]"
                                            id="shutoff_1" onchange="validaCampo(this.value, this.id)">
                                    </div>

                                    <div class="col-md-4 form-group telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.rotacao') .
                                        __('unidadesAcoes.(rpm)'), 'id' => ''])@endcomponent

                                        <input type="number" class="form-control" required name="rotacao[]" id="rotacao_1"
                                            onchange="validaCampo(this.value, this.id)">
                                    </div>

                                    <div class="col-md-4 form-group telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.pressaoBomba') . __('unidadesAcoes.(mca)'), 'id' => ''])@endcomponent

                                        <input type="number" step="0.01" class="form-control" required
                                            name="pressao_bomba[]" id="pressao_bomba_1"
                                            onchange="validaCampo(this.value, this.id)">
                                    </div>
                                </div>

                                {{-- aqui --}}
                                <div class="form-row justify-content-center">
                                    <div class="col-md-12 telo5ce">

                                        <label for=""><span style="font-size: 16px"><b>@lang("afericao.motor") 1</b></span>
                                        </label>
                                    </div>
                                    <div class="col-md-4 form-group telo5ce">
                                        <label for="tipo_motor">@lang("afericao.tipo_motor")</label>
                                        <select onchange="configKeyStarter(1)" name="tipo_motor[]" class="form-control"
                                            id="tipo_motor_1">
                                            <option value="diesel">@lang("afericao.diesel")</option>
                                            <option value="eletrico">@lang("afericao.eletrico")</option>
                                        </select>
                                        <div class="line"></div>
                                    </div>

                                    <div class="col-md-4 form-group telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.modelo'),
                                        'id' => ''])@endcomponent

                                        <input type="text" class="form-control" required name="modelo_motor[]"
                                            id="modelo_motor_1" onchange="validaCampo(this.value, this.id)">
                                    </div>

                                    <div class="col-md-4 form-group telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.potencia') .
                                        __('unidadesAcoes.(cv)'), 'id' => ''])@endcomponent

                                        <input type="number" step="0.01" class="form-control" required name="potencia[]"
                                            id="potencia_1" onchange="validaCampo(this.value, this.id)">
                                    </div>
                                </div>

                                <div class="form-row justify-content-center">
                                    <div class="col-md-4 form-group  telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.numeroMotores'), 'id' => ''])@endcomponent

                                        <input type="number" class="form-control" required name="numero_motores[]"
                                            id="numero_motores_1" onchange="validaCampo(this.value, this.id)">
                                    </div>



                                    <div class="col-md-4 form-group  telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.fatorServico'), 'id' => ''])@endcomponent

                                        <input type="number" step="0.01" step="0.01" class="form-control" required
                                            name="fator_servico[]" id="fator_servico_1"
                                            onchange="validaCampo(this.value, this.id)">
                                    </div>'

                                    <div class="col-md-4 form-group telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.rendimento'), 'id' => ''])@endcomponent

                                        <input type="number" step="0.01" class="form-control" required name="rendimento[]"
                                            id="rendimento_1" onchange="validaCampo(this.value, this.id)">
                                    </div>
                                </div>

                                <div class="form-row justify-content-center">
                                    <div class="col-md-3 form-group telo5ce" id="divChavePartida_1" style="display: none">
                                        <label for="chave_partida">@lang("afericao.chavePartida")</label>

                                        <select name="chave_partida[]" class="form-control" id="chave_partida_1">
                                            <option hidden value="0">Sem Chave</option>

                                            <option selected value="1">@lang("afericao.serieParalela")</option>
                                            <option value="2">@lang("afericao.estrelaTriangulo")</option>
                                            <option value="3">@lang("afericao.compensadora")</option>
                                            <option value="4">@lang("afericao.softStarter")</option>
                                        </select>
                                        <div class="line"></div>
                                    </div>

                                    <div class="col-md-3 form-group telo5ce" id="div_corrente_nominal_1">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.correnteNominal') . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent

                                        <input type="number" step="0.01" class="form-control" id="corrente_nominal_1"
                                            name="corrente_nominal[]"
                                            onchange="calcularCarregamento(1); validaCampo(this.value, this.id);">
                                    </div>

                                    <div class="col-md-3 form-group telo5ce" id="div_tensao_nominal_1">
                                        <label for="tensao_nominal">@lang("afericao.tensaoNominal")</label>
                                        <select name="tensao_nominal[]" onchange="calcularCarregamento(1)"
                                            class="form-control" id="tensao_nominal_1">
                                            <option value="220">220V</option>
                                            <option value="380">380V</option>
                                            <option value="440">440V</option>
                                        </select>
                                        <div class="line"></div>
                                    </div>

                                    <div class="col-md-3 form-group telo5ce" id="div_frequencia_1">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.frequencia'), 'id' => ''])@endcomponent

                                        <input type="number" value="60" class="form-control has-value" required
                                            name="frequencia[]" id="frequencia_1"
                                            onchange="validaCampo(this.value, this.id)">
                                    </div>
                                </div>

                                <div class="col-md-12" id="div_leituras_1">
                                    <div class="col-md-12 row">

                                        <label><span style="font-size: 16px"><b>@lang("afericao.leitura1")</b></span>
                                        </label>
                                        <h4 class="col-12">@lang("afericao.corrente")</h4>

                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase1')
                                            . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent

                                            <input type="number" step="0.01" class="form-control"
                                                id="bomba_1_corrente_leitura_1_fase_1" name="corrente_leitura_1_fase_1[]"
                                                onchange="calcularCarregamento(1); validaCampo(this.value, this.id);">
                                        </div>

                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase2')
                                            . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent

                                            <input type="number" step="0.01" class="form-control"
                                                id="bomba_1_corrente_leitura_1_fase_2" name="corrente_leitura_1_fase_2[]"
                                                onchange="calcularCarregamento(1); validaCampo(this.value, this.id);">
                                        </div>

                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase3')
                                            . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent

                                            <input type="number" step="0.01" class="form-control"
                                                id="bomba_1_corrente_leitura_1_fase_3" name="corrente_leitura_1_fase_3[]"
                                                onchange="calcularCarregamento(1); validaCampo(this.value, this.id);">
                                        </div>

                                        <h4 class="col-12 ">@lang("afericao.tensao")</h4>

                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase1')
                                            . __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent

                                            <input type="number" step="0.01" class="form-control"
                                                name="tensao_leitura_1_fase_1[]" id="bomba_1_tensao_leitura_1_fase_1"
                                                onchange="calcularCarregamento(1); validaCampo(this.value, this.id);">
                                        </div>

                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase2')
                                            . __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent

                                            <input type="number" step="0.01" class="form-control"
                                                name="tensao_leitura_1_fase_2[]" id="bomba_1_tensao_leitura_1_fase_2"
                                                onchange="calcularCarregamento(1); validaCampo(this.value, this.id);">
                                        </div>

                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase3')
                                            . __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent

                                            <input type="number" step="0.01" class="form-control"
                                                name="tensao_leitura_1_fase_3[]" id="bomba_1_tensao_leitura_1_fase_3"
                                                onchange="calcularCarregamento(1); validaCampo(this.value, this.id);">'
                                        </div>

                                        <div class="col-md-4 form-group">
                                            @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.indice_carregamento'), 'id' => ''])@endcomponent'

                                            <input type="number" step="0.01" class="form-control has-value" value="0"
                                                readonly id="bomba_1_indice_carregamento_leitura_1_fase_1"
                                                onchange="validaCampo(this.value, this.id)">
                                        </div>

                                        <div class="col-md-4 form-group">
                                            @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.indice_carregamento'), 'id' => ''])@endcomponent'

                                            <input type="number" step="0.01" class="form-control has-value" value="0"
                                                readonly id="bomba_1_indice_carregamento_leitura_1_fase_2"
                                                onchange="validaCampo(this.value, this.id)">
                                        </div>'

                                        <div class="col-md-4 form-group">
                                            @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.indice_carregamento'), 'id' => ''])@endcomponent'

                                            <input type="number" step="0.01" class="form-control has-value" value="0"
                                                readonly id="bomba_1_indice_carregamento_leitura_1_fase_3"
                                                onchange="validaCampo(this.value, this.id)">'
                                        </div>
                                    </div>

                                    <div class="col-md-12 row">

                                        <label><span style="font-size: 16px"><b>@lang("afericao.leitura2")</b></span>
                                        </label>
                                        <h4 class="col-12">@lang("afericao.corrente")</h4>

                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase1')
                                            . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent '

                                            <input type="number" step="0.01" class="form-control"
                                                id="bomba_1_corrente_leitura_2_fase_1" name="corrente_leitura_2_fase_1[]"
                                                onchange="calcularCarregamento(1); validaCampo(this.value, this.id);">'
                                        </div>

                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase2')
                                            . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent '

                                            <input type="number" step="0.01" class="form-control"
                                                id="bomba_1_corrente_leitura_2_fase_2" name="corrente_leitura_2_fase_2[]"
                                                onchange="calcularCarregamento(1); validaCampo(this.value, this.id);">'
                                        </div>'

                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase3')
                                            . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent '

                                            ' <input type="number" step="0.01" class="form-control"
                                                id="bomba_1_corrente_leitura_2_fase_3" name="corrente_leitura_2_fase_3[]"
                                                onchange="calcularCarregamento(1); validaCampo(this.value, this.id);">
                                        </div>

                                        <h4 class="col-12 ">@lang("afericao.tensao")</h4>'

                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase1')
                                            . __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent

                                            <input type="number" step="0.01" class="form-control"
                                                name="tensao_leitura_2_fase_1[]" id="bomba_1_tensao_leitura_2_fase_1"
                                                onchange="calcularCarregamento(1); validaCampo(this.value, this.id);">'
                                        </div>

                                        <div class="col-md-4 form-group telo5ce">
                                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase2')
                                            . __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent

                                            <input type="number" step="0.01" class="form-control"
                                                name="tensao_leitura_2_fase_2[]" id="bomba__tensao_leitura_2_fase_2"
                                                onchange="calcularCarregamento(); validaCampo(this.value, this.id);">'
                                        </div>

                                        <div class="col-md-4 form-group telo5ce">'
                                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase3')
                                            . __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent '

                                            <input type="number" step="0.01" class="form-control"
                                                name="tensao_leitura_2_fase_3[]" id="bomba_'1'_tensao_leitura_2_fase_3"
                                                onchange="calcularCarregamento(1); validaCampo(this.value, this.id);">'
                                        </div>

                                        <div class="col-md-4 form-group">
                                            @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.indice_carregamento'), 'id' => ''])@endcomponent'

                                            <input type="number" step="0.01" class="form-control has-value" readonly
                                                value="0" id="bomba_1_indice_carregamento_leitura_2_fase_1">
                                        </div>

                                        <div class="col-md-4 form-group">
                                            @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.indice_carregamento'), 'id' => ''])@endcomponent'

                                            <input type="number" step="0.01" class="form-control has-value" readonly
                                                value="0" id="bomba_1_indice_carregamento_leitura_2_fase_2">
                                        </div>'

                                        <div class="col-md-4 form-group">
                                            @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.indice_carregamento'), 'id' => ''])@endcomponent'

                                            <input type="number" step="0.01" class="form-control has-value" readonly
                                                value="0" id="bomba_1_indice_carregamento_leitura_2_fase_3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

        </script>

        <script type="text/javascript">
            function calcularCarregamento(id_bomba) {
                let correnteNominal = $("#corrente_nominal_" + id_bomba).val();

                if (correnteNominal != null && correnteNominal > 0) {
                    let leitura = $("#bomba_" + id_bomba + "_corrente_leitura_1_fase_1").val();
                    if (leitura != null && leitura > 0) {
                        //Calculo de correção
                        var correcao_corrente_eletrica_1_fase_1 = leitura * $('#bomba_' + id_bomba +
                            '_tensao_leitura_1_fase_1').val() * Math.sqrt(3) / $('#tensao_nominal_' + id_bomba).val();
                        var carregamento = (correcao_corrente_eletrica_1_fase_1 / correnteNominal) * 100;
                        $("#bomba_" + id_bomba + "_indice_carregamento_leitura_1_fase_1").val(parseFloat(carregamento
                            .toFixed(2)));
                    }

                    leitura = $("#bomba_" + id_bomba + "_corrente_leitura_1_fase_2").val();
                    if (leitura != null && leitura > 0) {
                        //Calculo de correção
                        var correcao_corrente_eletrica_1_fase_2 = leitura * $('#bomba_' + id_bomba +
                            '_tensao_leitura_1_fase_2').val() * Math.sqrt(3) / $('#tensao_nominal_' + id_bomba).val();
                        var carregamento = (correcao_corrente_eletrica_1_fase_2 / correnteNominal) * 100;
                        $("#bomba_" + id_bomba + "_indice_carregamento_leitura_1_fase_2").val(parseFloat(carregamento
                            .toFixed(2)));
                    }

                    leitura = $("#bomba_" + id_bomba + "_corrente_leitura_1_fase_3").val();
                    if (leitura != null && leitura > 0) {
                        //Calculo de correção
                        var correcao_corrente_eletrica_1_fase_3 = leitura * $('#bomba_' + id_bomba +
                            '_tensao_leitura_1_fase_3').val() * Math.sqrt(3) / $('#tensao_nominal_' + id_bomba).val();
                        var carregamento = (correcao_corrente_eletrica_1_fase_3 / correnteNominal) * 100;
                        $("#bomba_" + id_bomba + "_indice_carregamento_leitura_1_fase_3").val(parseFloat(carregamento
                            .toFixed(2)));
                    }

                    leitura = $("#bomba_" + id_bomba + "_corrente_leitura_2_fase_1").val();
                    if (leitura != null && leitura > 0) {
                        //Calculo de correção
                        var correcao_corrente_eletrica_2_fase_1 = leitura * $('#bomba_' + id_bomba +
                            '_tensao_leitura_2_fase_1').val() * Math.sqrt(3) / $('#tensao_nominal_' + id_bomba).val();
                        var carregamento = (correcao_corrente_eletrica_2_fase_1 / correnteNominal) * 100;
                        $("#bomba_" + id_bomba + "_indice_carregamento_leitura_2_fase_1").val(parseFloat(carregamento
                            .toFixed(2)));
                    }

                    leitura = $("#bomba_" + id_bomba + "_corrente_leitura_2_fase_2").val();
                    if (leitura != null && leitura > 0) {
                        //Calculo de correção
                        var correcao_corrente_eletrica_2_fase_2 = leitura * $('#bomba_' + id_bomba +
                            '_tensao_leitura_2_fase_2').val() * Math.sqrt(3) / $('#tensao_nominal_' + id_bomba).val();
                        var carregamento = (correcao_corrente_eletrica_2_fase_2 / correnteNominal) * 100;
                        $("#bomba_" + id_bomba + "_indice_carregamento_leitura_2_fase_2").val(parseFloat(carregamento
                            .toFixed(2)));
                    }

                    leitura = $("#bomba_" + id_bomba + "_corrente_leitura_2_fase_3").val();
                    if (leitura != null && leitura > 0) {
                        //Calculo de correção
                        var correcao_corrente_eletrica_2_fase_3 = leitura * $('#bomba_' + id_bomba +
                            '_tensao_leitura_2_fase_3').val() * Math.sqrt(3) / $('#tensao_nominal_' + id_bomba).val();
                        var carregamento = (correcao_corrente_eletrica_2_fase_3 / correnteNominal) * 100;
                        $("#bomba_" + id_bomba + "_indice_carregamento_leitura_2_fase_3").val(parseFloat(carregamento
                            .toFixed(2)));
                    }
                }
            }

            function configKeyStarter(id_bomba) {
                var tipo_motor = $("#tipo_motor_" + id_bomba).val();
                //Escondendo e limpando os campos caso o tipo de motor seja diesel.
                if (tipo_motor === "diesel") {
                    $("#divChavePartida_" + id_bomba).hide();
                    $("#chave_partida_" + id_bomba).val(0);

                    $("#div_corrente_nominal_" + id_bomba).hide();
                    $("#div_corrente_nominal_" + id_bomba).val('');
                    $("#div_corrente_nominal_" + id_bomba).removeAttr("required");

                    $("#div_tensao_nominal_" + id_bomba).hide();
                    $("#div_tensao_nominal_" + id_bomba).val('');
                    $("#div_tensao_nominal_" + id_bomba).removeAttr("required");

                    $("#div_frequencia_" + id_bomba).hide();
                    $("#div_frequencia_" + id_bomba).val('');
                    $("#div_frequencia_" + id_bomba).removeAttr("required");

                    $("#div_leituras_" + id_bomba).hide();
                    $("#div_leituras_" + id_bomba + " :input").each(function() {
                        $(this).val('');
                        $(this).removeAttr("required");
                    });
                    // Se não volta os campos para visiveis.
                } else {
                    $("#divChavePartida_" + id_bomba).show();
                    $("#chave_partida_" + id_bomba).val(1);

                    $("#div_corrente_nominal_" + id_bomba).show();
                    $("#div_corrente_nominal_" + id_bomba).attr("required", "req");

                    $("#div_tensao_nominal_" + id_bomba).show();
                    $("#div_tensao_nominal_" + id_bomba).attr('required', "req");

                    $("#div_frequencia_" + id_bomba).show();
                    $("#div_frequencia_" + id_bomba).attr('required', "req");

                    $("#div_leituras_" + id_bomba).show();
                    $("#div_leituras_" + id_bomba + " :input").each(function() {
                        $(this).attr('required', "req");
                    });

                }
            }

            /*
             ** Não deixa o usuário salvar o formulário caso a quantidade de bombas for
             ** diferente da quantidade de bombas geradas
             */
            /*$("form").submit(function (e) {
                var validationFailed = false;

                // Validando
                if ( $('#numero_bombas').val() != ($('#DivBombas').children()).length ) validationFailed = true;
                if (validationFailed) {
                    e.preventDefault();
                    return false;
                }
            });*/

            // Função para manipulação de labels nos inputs.
            function validaCampo(valor, id) {
                if (valor != null && valor != '') {
                    $('#' + id).addClass('has-value');
                } else {
                    $('#' + id).removeClass('has-value');
                }
            }

            // Gerando as divs de bombas e motores no click do botão.
            //$('#gera_bombas').click(function(){
            // Gerando as divs de bombas e motores na mudança do campo.
            $('#numero_bombas').change(function() {
                // Capturando valor do campo de "numero de bombas"
                var numero_bombas = $(this).val();
                // Verificando se já existe campos criados e quantos.
                if ($("#DivBombas").children().length > 1) {
                    $("#DivBombas").children().remove();
                }

                // Cria os blocos de campos.
                if (numero_bombas != null && numero_bombas != '') {

                    for (i = 1; i <= numero_bombas; i++) {
                        var html = '';
                        //////////////////////////////////////////////////////////////////// BOMBA ////////////////////////////////////////////////////////////////////////////////////////////////////
                        html = '<div class="card-body " id="bomba_' + i + '">';
                        html += '   <div class="col-12" id="headingBomba_' + i + '">';
                        html += '       <h4>@lang("afericao.bomba") ' + (i);
                        html +=
                            '       <button type="button" class="btn btn-outline-primary float-right" data-toggle="collapse" data-target="#control_bomba_' +
                            i + '" aria-expanded="true" aria-controls="control_bomba_' + i + '">';
                        html += '           <i class="fa fa-bars fa-fw"></i>';
                        html += '       </button>';
                        html += '       </h4>';
                        html += '   </div>';

                        // Cria apenas o primeiro bloco de bomba aberto.
                        if (i == 1) {
                            html += '   <div class="col-md-12 collapse show" id="control_bomba_' + i +
                                '" aria-labelledby="headingBomba_' + i + '" data-parent="#DivBombas">';
                        }
                        // Demais blocos, fechados.
                        else {
                            html += '   <div class="col-md-12 row collapse" id="control_bomba_' + i +
                                '" aria-labelledby="headingBomba_' + i + '" data-parent="#DivBombas">';
                        }

                        html += '    <div class="form-row justify-content-center">';
                        html += '      <div class="col-md-3 form-group telo5ce">';
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.comprimentoSuccao') . __('unidadesAcoes.(m)'),
                        'id' => ''])@endcomponent ';
                        html += '          <input type="number" step="0.01" id="comprimento_succao_' + i +
                            '" class="form-control" required name="comprimento_succao[]" onchange="validaCampo(this.value, this.id)">';
                        html += '      </div>';

                        html += '      <div class="col-md-3 form-group telo5ce">';
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.diametroSuccao') . __('unidadesAcoes.(m)'), 'id'
                        => ''])@endcomponent ';
                        html += '          <input type="number" step="0.001" id="diametro_succao_' + i +
                            '" class="form-control" required name="diametro_succao[]" onchange="validaCampo(this.value, this.id)">';
                        html += '      </div>';

                        html += '      <div class="col-md-3 form-group telo5ce">';
                        html += '          @component('_layouts._components._inputLabel', ['texto' => __('afericao.marca'), 'id' => ''])@endcomponent';
                        html +=
                            '          <input type="text" class="form-control" required name="marca[]" id="marca_' +
                            i + '" onchange="validaCampo(this.value, this.id)">';
                        html += '      </div>';

                        html += '      <div class="col-md-3 form-group telo5ce">';
                        html += '          @component('_layouts._components._inputLabel', ['texto' => __('afericao.modelo'), 'id' => ''])@endcomponent';
                        html +=
                            '          <input type="text" class="form-control" required name="modelo[]" id="modelo_' +
                            i + '" onchange="validaCampo(this.value, this.id)">';
                        html += '      </div>';
                        html += '    </div>';

                        html += '    <div class="form-row justify-content-center">';
                        html += '      <div class="col-md-3 form-group telo5ce">';
                        html += '          @component('_layouts._components._inputLabel', ['texto' => __('afericao.numeroRotores'), 'id' => ''])@endcomponent';
                        html +=
                            '          <input type="number" class="form-control" required name="numero_rotores[]" id="numero_rotores_' +
                            i + '" onchange="validaCampo(this.value, this.id)">';
                        html += '      </div>';

                        html += '      <div class="col-md-3 form-group telo5ce">';
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.diametroRotor') . __('unidadesAcoes.(mm)'), 'id'
                        => ''])@endcomponent ';
                        html +=
                            '          <input type="number" step="0.01" class="form-control" required name="diametro_rotor[]" id="diametro_rotor_' +
                            i + '" onchange="validaCampo(this.value, this.id)">';
                        html += '      </div>';

                        html += '       <div class="col-md-3 form-group telo5ce">';
                        html += '           <label for="mat_succao">@lang("afericao.materialSuccao")</label>';
                        html +=
                            '           <select name="material_succao[]"  class="form-control" id="mat_succao_' +
                            i + '">';
                        html += '               <option value="0">@lang("afericao.acoSac")</option>';
                        html += '               <option value="1">@lang("afericao.AZ")</option>';
                        html += '               <option value="2">@lang("afericao.PVC")</option>';
                        html += '               <option value="3">@lang("afericao.RPVC")</option>';
                        html += '           </select>';
                        html += '           <div class="line"></div>';
                        html += '       </div>';

                        html += '       <div class="col-md-3 form-group telo5ce">';
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.rendimentoBomba') . __('unidadesAcoes.(%)'),
                        'id' => ''])@endcomponent ';
                        html +=
                            '           <input type="number" step="0.01" class="form-control" required name="rendimento_bomba[]" id="rendimento_bomba_' +
                            i + '" onchange="validaCampo(this.value, this.id)">';
                        html += '       </div>';
                        html += '    </div>';

                        html += '    <div class="form-row justify-content-center">';
                        html += '       <div class="col-md-4 form-group telo5ce">';
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.shutoff') . __('unidadesAcoes.(mca)'), 'id' =>
                        ''])@endcomponent ';
                        html +=
                            '           <input type="number" step="0.01" class="form-control" required name="shutoff[]" id="shutoff_' +
                            i + '" onchange="validaCampo(this.value, this.id)">';
                        html += '       </div>';

                        html += '       <div class="col-md-4 form-group telo5ce">';
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.rotacao') . __('unidadesAcoes.(rpm)'), 'id' =>
                        ''])@endcomponent ';
                        html +=
                            '           <input type="number" class="form-control" required name="rotacao[]" id="rotacao_' +
                            i + '" onchange="validaCampo(this.value, this.id)">';
                        html += '       </div>';

                        html += '       <div class="col-md-4 form-group telo5ce">';
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.pressaoBomba') . __('unidadesAcoes.(mca)'), 'id'
                        => ''])@endcomponent ';
                        html +=
                            '           <input type="number" step="0.01" class="form-control" required name="pressao_bomba[]" id="pressao_bomba_' +
                            i + '" onchange="validaCampo(this.value, this.id)">';
                        html += '       </div>';
                        html += '    </div>';

                        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                        ////////////////////////////////////////////////////////////////////////// MOTOR //////////////////////////////////////////////////////////////////////////////////////////////

                        html += '       <div class="form-row justify-content-center">';
                        html += '           <div class="col-md-12 telo5ce">';
                        html +=
                            '              <label for=""><span style="font-size: 16px"><b>@lang("afericao.motor") ' +
                            i + '</b></span> </label>';
                        html += '           </div>';
                        html += '           <div class="col-md-4 form-group telo5ce">';
                        html += '               <label for="tipo_motor">@lang("afericao.tipo_motor")</label>';
                        html += '               <select onchange="configKeyStarter(' + i +
                            ')" name="tipo_motor[]"  class="form-control" id="tipo_motor_' + i + '">';
                        html += '                   <option value="diesel">@lang("afericao.diesel")</option>';
                        html += '                   <option value="eletrico">@lang("afericao.eletrico")</option>';
                        html += '               </select>';
                        html += '           <div class="line"></div>';
                        html += '           </div>';

                        html += '           <div class="col-md-4 form-group telo5ce">';
                        html += '               @component('_layouts._components._inputLabel', ['texto' => __('afericao.modelo'), 'id' => ''])@endcomponent';
                        html +=
                            '               <input type="text" class="form-control" required name="modelo_motor[]" id="modelo_motor_' +
                            i + '" onchange="validaCampo(this.value, this.id)">';
                        html += '           </div>';

                        html += '           <div class="col-md-4 form-group telo5ce">'
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.potencia') . __('unidadesAcoes.(cv)'), 'id' =>
                        ''])@endcomponent '
                        html +=
                            '               <input type="number" step="0.01" class="form-control" required name="potencia[]" id="potencia_' +
                            i + '" onchange="validaCampo(this.value, this.id)">'
                        html += '           </div>'
                        html += '       </div>'

                        html += '       <div class="form-row justify-content-center">';
                        html += '           <div class="col-md-4 form-group  telo5ce">'
                        html += '               @component('_layouts._components._inputLabel', ['texto' => __('afericao.numeroMotores'), 'id' => ''])@endcomponent'
                        html +=
                            '               <input type="number" class="form-control" required name="numero_motores[]" id="numero_motores_' +
                            i + '" onchange="validaCampo(this.value, this.id)">'
                        html += '           </div>'



                        html += '           <div class="col-md-4 form-group  telo5ce">'
                        html += '               @component('_layouts._components._inputLabel', ['texto' => __('afericao.fatorServico'), 'id' => ''])@endcomponent'
                        html +=
                            '               <input type="number" step="0.01" step="0.01" class="form-control" required name="fator_servico[]" id="fator_servico_' +
                            i + '" onchange="validaCampo(this.value, this.id)">'
                        html += '           </div>'

                        html += '           <div class="col-md-4 form-group telo5ce">'
                        html += '               @component('_layouts._components._inputLabel', ['texto' => __('afericao.rendimento'), 'id' => ''])@endcomponent'
                        html +=
                            '               <input type="number" step="0.01" class="form-control" required name="rendimento[]" id="rendimento_' +
                            i + '" onchange="validaCampo(this.value, this.id)">'
                        html += '           </div>'
                        html += '       </div>'

                        html += '       <div class="form-row justify-content-center">';
                        html += '           <div class="col-md-3 form-group telo5ce" id="divChavePartida_' + i +
                            '" style="display: none">'
                        html += '               <label for="chave_partida">@lang("afericao.chavePartida")</label>'
                        html +=
                            '               <select name="chave_partida[]"  class="form-control" id="chave_partida_' +
                            i + '">'
                        html += '                   <option hidden value="0">Sem Chave</option>'
                        html +=
                            '                   <option selected value="1">@lang("afericao.serieParalela")</option>'
                        html += '                   <option value="2">@lang("afericao.estrelaTriangulo")</option>'
                        html += '                   <option value="3">@lang("afericao.compensadora")</option>'
                        html += '                   <option value="4">@lang("afericao.softStarter")</option>'
                        html += '               </select>'
                        html += '               <div class="line"></div>'
                        html += '           </div>'

                        html += '           <div class="col-md-3 form-group telo5ce" id="div_corrente_nominal_' +
                            i + '">'
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.correnteNominal') . __('unidadesAcoes.(a)'),
                        'id' => ''])@endcomponent '
                        html +=
                            '               <input type="number" step="0.01" class="form-control" id="corrente_nominal_' +
                            i + '" name="corrente_nominal[]" onchange="calcularCarregamento(' + i +
                            '); validaCampo(this.value, this.id);">'
                        html += '           </div>'

                        html += '           <div class="col-md-3 form-group telo5ce" id="div_tensao_nominal_' + i +
                            '">'
                        html += '               <label for="tensao_nominal">@lang("afericao.tensaoNominal")</label>'
                        html += '               <select name="tensao_nominal[]" onchange="calcularCarregamento(' +
                            i + ')"  class="form-control" id="tensao_nominal_' + i + '">'
                        html += '                   <option value="220">220V</option>'
                        html += '                   <option value="380">380V</option>'
                        html += '                   <option value="440">440V</option>'
                        html += '               </select>'
                        html += '               <div class="line"></div>'
                        html += '           </div>'

                        html += '           <div class="col-md-3 form-group telo5ce" id="div_frequencia_' + i + '">'
                        html += '               @component('_layouts._components._inputLabel', ['texto' => __('afericao.frequencia'), 'id' => ''])@endcomponent'
                        html +=
                            '               <input type="number" value="60" class="form-control has-value" required name="frequencia[]" id="frequencia_' +
                            i + '" onchange="validaCampo(this.value, this.id)">'
                        html += '           </div>'
                        html += '       </div>'

                        html += '        <div class="col-md-12" id="div_leituras_' + i + '">'
                        html += '            <div class="col-md-12 row">'
                        html +=
                            '                <label><span style="font-size: 16px"><b>@lang("afericao.leitura1")</b></span> </label>';
                        html += '                <h4 class="col-12">@lang("afericao.corrente")</h4>'

                        html += '                <div class="col-md-4 form-group telo5ce">'
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase1') . __('unidadesAcoes.(a)'), 'id' =>
                        ''])@endcomponent '
                        html +=
                            '                    <input type="number" step="0.01" class="form-control" id="bomba_' +
                            i +
                            '_corrente_leitura_1_fase_1"  name="corrente_leitura_1_fase_1[]" onchange="calcularCarregamento(' +
                            i + '); validaCampo(this.value, this.id);">'
                        html += '                </div>'

                        html += '                <div class="col-md-4 form-group telo5ce">'
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase2') . __('unidadesAcoes.(a)'), 'id' =>
                        ''])@endcomponent '
                        html +=
                            '                    <input type="number" step="0.01" class="form-control" id="bomba_' +
                            i +
                            '_corrente_leitura_1_fase_2"  name="corrente_leitura_1_fase_2[]" onchange="calcularCarregamento(' +
                            i + '); validaCampo(this.value, this.id);">'
                        html += '                </div>'

                        html += '                <div class="col-md-4 form-group telo5ce">'
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase3') . __('unidadesAcoes.(a)'), 'id' =>
                        ''])@endcomponent '
                        html +=
                            '                    <input type="number" step="0.01" class="form-control" id="bomba_' +
                            i +
                            '_corrente_leitura_1_fase_3"  name="corrente_leitura_1_fase_3[]" onchange="calcularCarregamento(' +
                            i + '); validaCampo(this.value, this.id);">'
                        html += '                </div>'

                        html += '                <h4 class="col-12 ">@lang("afericao.tensao")</h4>'

                        html += '                <div class="col-md-4 form-group telo5ce">'
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase1') . __('unidadesAcoes.(v)'), 'id' =>
                        ''])@endcomponent '
                        html +=
                            '                    <input type="number" step="0.01" class="form-control" name="tensao_leitura_1_fase_1[]" id="bomba_' +
                            i + '_tensao_leitura_1_fase_1" onchange="calcularCarregamento(' + i +
                            '); validaCampo(this.value, this.id);">'
                        html += '                </div>'

                        html += '                <div class="col-md-4 form-group telo5ce">'
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase2') . __('unidadesAcoes.(v)'), 'id' =>
                        ''])@endcomponent '
                        html +=
                            '                    <input type="number" step="0.01" class="form-control" name="tensao_leitura_1_fase_2[]" id="bomba_' +
                            i + '_tensao_leitura_1_fase_2" onchange="calcularCarregamento(' + i +
                            '); validaCampo(this.value, this.id);">'
                        html += '                </div>'

                        html += '                <div class="col-md-4 form-group telo5ce">'
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase3') . __('unidadesAcoes.(v)'), 'id' =>
                        ''])@endcomponent '
                        html +=
                            '                    <input type="number" step="0.01" class="form-control" name="tensao_leitura_1_fase_3[]" id="bomba_' +
                            i + '_tensao_leitura_1_fase_3" onchange="calcularCarregamento(' + i +
                            '); validaCampo(this.value, this.id);">'
                        html += '                </div>'

                        html += '                <div class="col-md-4 form-group">'
                        html += '                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.indice_carregamento'), 'id' => ''])@endcomponent'
                        html +=
                            '                    <input type="number" step="0.01" class="form-control has-value" value="0" readonly  id="bomba_' +
                            i +
                            '_indice_carregamento_leitura_1_fase_1" onchange="validaCampo(this.value, this.id)">'
                        html += '                </div>'

                        html += '                <div class="col-md-4 form-group">'
                        html += '                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.indice_carregamento'), 'id' => ''])@endcomponent'
                        html +=
                            '                    <input type="number" step="0.01" class="form-control has-value" value="0" readonly id="bomba_' +
                            i +
                            '_indice_carregamento_leitura_1_fase_2" onchange="validaCampo(this.value, this.id)">'
                        html += '                </div>'

                        html += '                <div class="col-md-4 form-group">'
                        html += '                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.indice_carregamento'), 'id' => ''])@endcomponent'
                        html +=
                            '                    <input type="number" step="0.01" class="form-control has-value" value="0" readonly id="bomba_' +
                            i +
                            '_indice_carregamento_leitura_1_fase_3" onchange="validaCampo(this.value, this.id)">'
                        html += '                </div>'
                        html += '            </div>'

                        html += '            <div class="col-md-12 row">'
                        html +=
                            '                <label><span style="font-size: 16px"><b>@lang("afericao.leitura2")</b></span> </label>';
                        html += '                <h4 class="col-12">@lang("afericao.corrente")</h4>'

                        html += '                <div class="col-md-4 form-group telo5ce">'
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase1') . __('unidadesAcoes.(a)'), 'id' =>
                        ''])@endcomponent '
                        html +=
                            '                    <input type="number" step="0.01" class="form-control" id="bomba_' +
                            i +
                            '_corrente_leitura_2_fase_1"   name="corrente_leitura_2_fase_1[]" onchange="calcularCarregamento(' +
                            i + '); validaCampo(this.value, this.id);">'
                        html += '                </div>'

                        html += '                <div class="col-md-4 form-group telo5ce">'
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase2') . __('unidadesAcoes.(a)'), 'id' =>
                        ''])@endcomponent '
                        html +=
                            '                    <input type="number" step="0.01" class="form-control" id="bomba_' +
                            i +
                            '_corrente_leitura_2_fase_2"  name="corrente_leitura_2_fase_2[]" onchange="calcularCarregamento(' +
                            i + '); validaCampo(this.value, this.id);">'
                        html += '                </div>'

                        html += '                <div class="col-md-4 form-group telo5ce">'
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase3') . __('unidadesAcoes.(a)'), 'id' =>
                        ''])@endcomponent '
                        html +=
                            '                    <input type="number" step="0.01" class="form-control" id="bomba_' +
                            i +
                            '_corrente_leitura_2_fase_3"  name="corrente_leitura_2_fase_3[]" onchange="calcularCarregamento(' +
                            i + '); validaCampo(this.value, this.id);">'
                        html += '                </div>'

                        html += '                <h4 class="col-12 ">@lang("afericao.tensao")</h4>'

                        html += '                <div class="col-md-4 form-group telo5ce">'
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase1') . __('unidadesAcoes.(v)'), 'id' =>
                        ''])@endcomponent '
                        html +=
                            '                    <input type="number" step="0.01" class="form-control" name="tensao_leitura_2_fase_1[]" id="bomba_' +
                            i + '_tensao_leitura_2_fase_1" onchange="calcularCarregamento(' + i +
                            '); validaCampo(this.value, this.id);">'
                        html += '                </div>'

                        html += '                <div class="col-md-4 form-group telo5ce">'
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase2') . __('unidadesAcoes.(v)'), 'id' =>
                        ''])@endcomponent '
                        html +=
                            '                    <input type="number" step="0.01" class="form-control" name="tensao_leitura_2_fase_2[]" id="bomba_' +
                            i + '_tensao_leitura_2_fase_2" onchange="calcularCarregamento(' + i +
                            '); validaCampo(this.value, this.id);">'
                        html += '                </div>'

                        html += '                <div class="col-md-4 form-group telo5ce">'
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase3') . __('unidadesAcoes.(v)'), 'id' =>
                        ''])@endcomponent '
                        html +=
                            '                    <input type="number" step="0.01" class="form-control" name="tensao_leitura_2_fase_3[]" id="bomba_' +
                            i + '_tensao_leitura_2_fase_3" onchange="calcularCarregamento(' + i +
                            '); validaCampo(this.value, this.id);">'
                        html += '                </div>'

                        html += '                <div class="col-md-4 form-group">'
                        html += '                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.indice_carregamento'), 'id' => ''])@endcomponent'
                        html +=
                            '                    <input type="number" step="0.01" class="form-control has-value" readonly value="0"  id="bomba_' +
                            i + '_indice_carregamento_leitura_2_fase_1">'
                        html += '                </div>'

                        html += '                <div class="col-md-4 form-group">'
                        html += '                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.indice_carregamento'), 'id' => ''])@endcomponent'
                        html +=
                            '                    <input type="number" step="0.01" class="form-control has-value" readonly value="0"  id="bomba_' +
                            i + '_indice_carregamento_leitura_2_fase_2">'
                        html += '                </div>'

                        html += '                <div class="col-md-4 form-group">'
                        html += '                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.indice_carregamento'), 'id' => ''])@endcomponent'
                        html +=
                            '                    <input type="number" step="0.01" class="form-control has-value" readonly value="0" id="bomba_' +
                            i + '_indice_carregamento_leitura_2_fase_3">'
                        html += '                </div>'
                        html += '            </div>'
                        html += '        </div>'

                        html += '   </div>';
                        html += '</div>';
                        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                        // Adiciona os campos no HTML
                        $("#DivBombas").append(html);

                        // Iniciando com a função para ajustar os campos.
                        configKeyStarter(i);
                    }
                }
            });

        </script>

    @endsection
