@extends('_layouts._layout_site')

@section('titulo')
@endsection

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">
            {{-- TITULO E SUBTITULO --}}
            <div class="col-6">
                <h1>@lang('afericao.bombeamento')</h1><br>
                <h4 style="margin-top: -20px">@lang('comum.editar')</h4>
            </div>
            {{-- BOTOES SALVAR E VOLTAR --}}
            <div class="col-6 text-right botoes position">
                <a href="{{ route('gauging_status', $id_afericao) }}" style="color: #3c8dbc" data-toggle="tooltip" data-placement="bottom" title="Voltar">
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
<div class="formafericao">
    {{-- NAVTAB'S --}}
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="iGerais-tab" data-toggle="tab" href="#iGerais" role="tab"
                aria-controls="iGerais" aria-selected="true">@lang('comum.informacoes_navtabs')</a>
        </li>
        @foreach ($bombeamentos as $key => $bombeamento)
            <li class="nav-item">
                <a class="nav-link" id="bombas-tab" data-toggle="tab" href="#bomba_{{ ($key + 1) }}" role="tab"
                    aria-controls="bomba_{{ ($key + 1) }}" aria-selected="true">@lang('afericao.editarBomba') {{ ($key + 1) }}</a>
            </li>
        @endforeach
    </ul>

    {{-- PRELOADER --}}
    <div id="coverScreen">
        <div class="preloader">
            <i class="fas fa-circle-notch fa-spin fa-2x"></i>
            <div>@lang('comum.preloader')</div>
        </div>
    </div>

    {{-- FORMULARIO DE CADASTRO --}}
    <form action="{{route('update_pumping')}}" method="POST" id="formdados">
        @include('_layouts._includes._alert')
        @csrf
        <input type="hidden" name="id_afericao" value="{{$id_afericao}}">
        <input type="hidden" name="id_bombeamento" value="{{$cabecalho_bombeamento['id']}}">
        <div class="tab-content mt-5" id="myTabContent">
            <div class="tab-pane fade show active" id="iGerais" role="tabpanel" aria-labelledby="iGerais-tab">
                <div class="tab-content mt-5" id="myTabContent">
                    <div class="card-body row" id="cssPreloader">
                        <div class="col-md-3 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto'=>__('afericao.altitudeNivelAgua')  . __('unidadesAcoes.(m)'), 'id' => ''])@endcomponent
                            <input type="number"  class="form-control" required name="altitude_nivel_agua" value="{{$cabecalho_bombeamento['altitude_nivel_agua']}}">
                        </div>

                        <div class="col-md-3 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto'=>__('afericao.altitudeCasaBomba') . __('unidadesAcoes.(m)'), 'id' => ''])@endcomponent
                            <input type="number"  class="form-control" required name="altitude_casa_bomba" value="{{$cabecalho_bombeamento['altitude_casa_bomba']}}">
                        </div>

                        <div class="col-md-3 form-group telo5ce">
                            <label for="tipo_instalacao">@lang('afericao.tipoInstalacao')</label>
                            <select name="tipo_instalacao"  class="form-control" id="tipo_instalacao">
                                <option value="0" <?php if($cabecalho_bombeamento['tipo_instalacao'] == 0) echo "selected='selected'"; ?> >@lang('afericao.direta')</option>
                                <option value="1" <?php if($cabecalho_bombeamento['tipo_instalacao'] == 1) echo "selected='selected'"; ?> >@lang('afericao.afogada')</option>
                                <option value="2" <?php if($cabecalho_bombeamento['tipo_instalacao'] == 2) echo "selected='selected'"; ?> >@lang('afericao.balsa')</option>
                                <option value="3" <?php if($cabecalho_bombeamento['tipo_instalacao'] == 3) echo "selected='selected'"; ?> >@lang('afericao.submersa')</option>
                            </select>
                            <div class="line"></div>
                        </div>

                        <div class="col-md-3 form-group telo5ce">
                            <label for="posicionamento_bombeamento">@lang('afericao.posicionamentoBombeamento')</label>
                            <select name="posicionamento_bombeamento"  class="form-control" id="posicionamento_bombeamento">
                                <option value="0" <?php if($cabecalho_bombeamento['captacao'] == 0) echo "selected='selected'"; ?>>@lang('afericao.simples')</option>
                                <option value="1" <?php if($cabecalho_bombeamento['captacao'] == 1) echo "selected='selected'"; ?> >@lang('afericao.serie')</option>
                                <option value="2" <?php if($cabecalho_bombeamento['captacao'] == 2) echo "selected='selected'"; ?>>@lang('afericao.paralelo')</option>
                            </select>
                            <div class="line"></div>
                        </div>

                        <div class="col-md-3 form-group telo5ce">
                            <label for="captacao">@lang('afericao.captacao')</label>
                            <select name="captacao"  class="form-control" id="captacao">
                                <option value="0" <?php if($cabecalho_bombeamento['captacao'] == 0) echo "selected='selected'"; ?> >@lang('afericao.acude')</option>
                                <option value="1" <?php if($cabecalho_bombeamento['captacao'] == 1) echo "selected='selected'"; ?> >@lang('afericao.barragem')</option>
                                <option value="2" <?php if($cabecalho_bombeamento['captacao'] == 2) echo "selected='selected'"; ?> >@lang('afericao.corrego')</option>
                                <option value="3" <?php if($cabecalho_bombeamento['captacao'] == 3) echo "selected='selected'"; ?> >@lang('afericao.lago')</option>
                                <option value="4" <?php if($cabecalho_bombeamento['captacao'] == 4) echo "selected='selected'"; ?> >@lang('afericao.lagoa')</option>
                                <option value="5" <?php if($cabecalho_bombeamento['captacao'] == 5) echo "selected='selected'"; ?> >@lang('afericao.poco')</option>
                            </select>
                            <div class="line"></div>
                        </div>

                        <div class="col-md-3 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto'=>__('afericao.latitude'), 'id' => ''])@endcomponent
                            <input type="number" step=0.000001  class="form-control" required name="latitude" value="{{$cabecalho_bombeamento['latitude']}}">
                        </div>

                        <div class="col-md-3 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto'=>__('afericao.longitude'), 'id' => ''])@endcomponent
                            <input type="number" step=0.000001 class="form-control" required name="longitude" value="{{$cabecalho_bombeamento['longitude']}}">
                        </div>

                        <div class="col-md-3 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto'=>__('afericao.numero_bombas'), 'id' => ''])@endcomponent
                            <input id="numero_bombas" type="number" class="form-control" min="1" required name="numero_bombas" value="{{$cabecalho_bombeamento['numero_bombas']}}" readonly>
                        </div>
                    </div>
                </div>
            </div>

            
            @include('_layouts._includes._alert')
            @foreach ($bombeamentos as $key => $bombeamento)
                <div class="tab-pane fade" id="bomba_{{ ($key + 1) }}" role="tabpanel" aria-labelledby="bomba_{{ ($key + 1) }}">
                    <div class="col-md-12 formpivocentral">
                        <input type="hidden" name="id[]" value="{{$bombeamento['id']}}">
                        <div class="col-md-12 row">

                            <div class="col-md-3 form-group telo5ce">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.comprimentoSuccao') . __('unidadesAcoes.(m)'), 'id' => ''])@endcomponent
                                <input type="number" id="comprimento_succao_{{($key + 1)}}"  value="{{$bombeamento['comprimento_succao']}}" class="form-control" required name="comprimento_succao[]">
                            </div>

                            <div class="col-md-3 form-group telo5ce">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.diametroSuccao') . __('unidadesAcoes.(m)'), 'id' => ''])@endcomponent
                                <input type="number" class="form-control"  value="{{$bombeamento['diametro_succao']}}" required name="diametro_succao[]">
                            </div>

                            <div class="col-md-3 form-group telo5ce">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.marca'), 'id' => ''])@endcomponent
                                <input type="text" class="form-control"  value="{{$bombeamento['marca']}}" required name="marca[]">
                            </div>

                            <div class="col-md-3 form-group telo5ce">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.modelo'), 'id' => ''])@endcomponent
                                <input type="text" class="form-control"  value="{{$bombeamento['modelo']}}" required name="modelo[]">
                            </div>

                            <div class="col-md-3 form-group telo5ce">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.numeroRotores'), 'id' => ''])@endcomponent
                                <input type="number" class="form-control"  value="{{$bombeamento['numero_rotores']}}" required name="numero_rotores[]">
                            </div>

                            <div class="col-md-3 form-group telo5ce">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.diametroRotor') . __('unidadesAcoes.(mm)'), 'id' => ''])@endcomponent
                                <input type="number" class="form-control"  value="{{$bombeamento['diametro_rotor']}}" required name="diametro_rotor[]">
                            </div>

                            <div class="col-md-3 form-group telo5ce">
                                <label for="mat_succao">@lang('afericao.materialSuccao')</label>
                                <select name="material_succao[]"  class="form-control" id="mat_succao{{($key + 1)}}">
                                    <option @if($bombeamento['material_succao'] == "0") selected @endif value="0">@lang('afericao.acoSac')</option>
                                    <option @if($bombeamento['material_succao'] == "1") selected @endif value="1">@lang('afericao.AZ')</option>
                                    <option @if($bombeamento['material_succao'] == "2") selected @endif value="2">@lang('afericao.PVC')</option>
                                    <option @if($bombeamento['material_succao'] == "3") selected @endif value="3">@lang('afericao.RPVC')</option>
                                </select>
                                <div class="line"></div>
                            </div>

                            <div class="col-md-3 form-group telo5ce">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.rendimentoBomba') . __('unidadesAcoes.(%)'), 'id' => ''])@endcomponent
                                <input type="number" class="form-control"  value="{{$bombeamento['rendimento_bomba']}}" required name="rendimento_bomba[]">
                            </div>

                            <div class="col-md-3 form-group telo5ce">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.shutoff') . __('unidadesAcoes.(mca)'), 'id' => ''])@endcomponent
                                <input type="number" class="form-control"  value="{{$bombeamento['shutoff']}}" required name="shutoff[]">
                            </div>

                            <div class="col-md-3 form-group telo5ce">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.rotacao') . __('unidadesAcoes.(rpm)'), 'id' => ''])@endcomponent
                                <input type="number" class="form-control"  value="{{$bombeamento['rotacao']}}" required name="rotacao[]">
                            </div>

                            <div class="col-md-3 form-group telo5ce">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.pressaoBomba') . __('unidadesAcoes.(mca)'), 'id' => ''])@endcomponent
                                <input type="number" class="form-control"  value="{{$bombeamento['pressao_bomba']}}" required name="pressao_bomba[]">
                            </div>
                            <!---->

                            <div class="col-12">
                                <h4>@lang('afericao.motor')</h4>

                            </div>

                            <div class="col-md-3 form-group telo5ce">
                                <label for="tipo_motor">@lang('afericao.tipo_motor')</label>
                                <select name="tipo_motor[]"   class="form-control" id="tipo_motor{{$key + 1}}" onchange="configKeyStarterExistente({{$key + 1}})">
                                    <option @if($bombeamento['tipo_motor'] == "diesel") selected @endif value="diesel">@lang('afericao.diesel')</option>
                                    <option @if($bombeamento['tipo_motor'] == "eletrico") selected @endif value="eletrico">@lang('afericao.eletrico')</option>
                                </select>
                                <div class="line"></div>

                            </div>

                            <div class="col-md-3 form-group telo5ce">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.modelo'), 'id' => ''])@endcomponent
                                <input type="text" class="form-control"  value="{{$bombeamento['modelo_motor']}}" required name="modelo_motor[]">
                            </div>

                            <div class="col-md-3 form-group telo5ce">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.potencia') . __('unidadesAcoes.(cv)'), 'id' => ''])@endcomponent
                                <input type="number" class="form-control"  value="{{$bombeamento['potencia']}}" required name="potencia[]">
                            </div>

                            <div class="col-md-3 form-group telo5ce">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.numeroMotores'), 'id' => ''])@endcomponent
                                <input type="number" class="form-control"  value="{{$bombeamento['numero_motores']}}" required name="numero_motores[]">
                            </div>

                            <div class="col-md-3 form-group telo5ce" id="divChavePartida{{$key + 1}}" @if($bombeamento['tipo_motor'] == "diesel") style="display: none" @endif>
                                <label for="chave_partida">@lang('afericao.chavePartida')</label>
                                <select name="chave_partida[]"   class="form-control" id="chave_partida{{ $key + 1}}">
                                    <option hidden @if($bombeamento['chave_partida'] == "0") selected @endif value="0">@lang('afericao.semChave')</option>
                                    <option @if($bombeamento['chave_partida'] == "1") selected @endif value="1">@lang('afericao.serieParalela')</option>
                                    <option @if($bombeamento['chave_partida'] == "2") selected @endif value="2">@lang('afericao.estrelaTriangulo')</option>
                                    <option @if($bombeamento['chave_partida'] == "3") selected @endif value="3">@lang('afericao.compensadora')</option>
                                    <option @if($bombeamento['chave_partida'] == "4") selected @endif value="4">@lang('afericao.softStarter')</option>
                                </select>
                                <div class="line"></div>

                            </div>

                            <div class="col-md-3 form-group telo5ce">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.fatorServico'), 'id' => ''])@endcomponent
                                <input type="number"  value="{{$bombeamento['fator_servico']}}" class="form-control" required name="fator_servico[]">
                            </div>

                            <div class="col-md-3 form-group telo5ce" id="div_corrente_nominal{{$key + 1}}">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.correnteNominal') . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent
                                <input type="number"  value="{{$bombeamento['corrente_nominal']}}" class="form-control" onchange="calcularCarregamentoExistente({{$key+1}})"  id="corrente_nominal{{$key + 1}}" name="corrente_nominal[]">
                            </div>

                            <div class="col-md-3 form-group telo5ce">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.rendimento'), 'id' => ''])@endcomponent
                                <input type="number"  value="{{$bombeamento['rendimento']}}" class="form-control" required name="rendimento[]">
                            </div>

                            <div class="col-md-3 form-group telo5ce" id="div_tensao_nominal{{$key + 1}}">
                                <label for="tensao_nominal">@lang('afericao.tensaoNominal')</label>
                                <select name="tensao_nominal[]"  class="form-control"  onchange="calcularCarregamentoExistente({{$key+1}})" id="tensao_nominal{{$key + 1}}">
                                    <option @if($bombeamento['tensao_nominal'] == "220") selected @endif value="220">220V</option>
                                    <option @if($bombeamento['tensao_nominal'] == "380") selected @endif value="380">380V</option>
                                    <option @if($bombeamento['tensao_nominal'] == "440") selected @endif value="440">440V</option>
                                </select>
                                <div class="line"></div>

                            </div>

                            <div class="col-md-3 form-group telo5ce" id="div_frequencia{{$key + 1}}">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.frequencia'), 'id' => ''])@endcomponent
                                <input type="number" value="60"  value="{{$bombeamento['frequencia']}}" class="form-control" required name="frequencia[]">
                            </div>
                        </div>
                        
                        <div class="col-md-12 row" id="div_leituras{{$key + 1}}">
                            <div class="col-md-12 row">
                                <h3 class="col-12">@lang('afericao.leitura1')  </h3>
                                <h4 class="col-12">@lang('afericao.corrente')</h4>

                                <div class="col-md-4 form-group telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.fase1') . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent
                                    <input type="number" step="0.001" value="{{$bombeamento['corrente_leitura_1_fase_1']}}" class="form-control" required   onchange="calcularCarregamentoExistente({{$key+1}})" id="corrente_leitura_1_fase_1{{ $key + 1 }}"  name="corrente_leitura_1_fase_1[]">
                                </div>

                                <div class="col-md-4 form-group telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.fase2') . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent
                                    <input type="number" step="0.001" value="{{$bombeamento['corrente_leitura_1_fase_2']}}" class="form-control" required  onchange="calcularCarregamentoExistente({{$key+1}})" id="corrente_leitura_1_fase_2{{$key+1}}"  name="corrente_leitura_1_fase_2[]">
                                </div>

                                <div class="col-md-4 form-group telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.fase3') . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent
                                    <input type="number" step="0.001" value="{{$bombeamento['corrente_leitura_1_fase_3']}}" class="form-control" required  onchange="calcularCarregamentoExistente({{$key+1}})" id="corrente_leitura_1_fase_3{{$key+1}}"  name="corrente_leitura_1_fase_3[]">
                                </div>

                                <h4 class="col-12 ">@lang('afericao.tensao')</h4>

                                <div class="col-md-4 form-group telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.fase1') . __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent
                                    <input type="number"  value="{{$bombeamento['tensao_leitura_1_fase_1']}}" class="form-control"  onchange="calcularCarregamentoExistente({{$key+1}})" required name="tensao_leitura_1_fase_1[]" id="tensao_leitura_1_fase_1{{$key+1}}">
                                </div>

                                <div class="col-md-4 form-group telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.fase2') . __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent
                                    <input type="number"  value="{{$bombeamento['tensao_leitura_1_fase_2']}}" class="form-control"  onchange="calcularCarregamentoExistente({{$key+1}})" required name="tensao_leitura_1_fase_2[]" id="tensao_leitura_1_fase_2{{$key+1}}">
                                </div>

                                <div class="col-md-4 form-group telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.fase3') . __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent
                                    <input type="number"  value="{{$bombeamento['tensao_leitura_1_fase_3']}}" class="form-control"  onchange="calcularCarregamentoExistente({{$key+1}})" required name="tensao_leitura_1_fase_3[]" id="tensao_leitura_1_fase_3{{$key+1}}">
                                </div>


                                <div class="col-md-4 form-group telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.indice_carregamento'), 'id' => ''])@endcomponent
                                    <input type="number"   class="form-control" value="0" step="0.01" readonly id="indice_carregamento_leitura_1_fase_1{{$key+1}}">
                                </div>

                                <div class="col-md-4 form-group telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.indice_carregamento'), 'id' => ''])@endcomponent
                                    <input type="number"  class="form-control" value="0" step="0.01" readonly id="indice_carregamento_leitura_1_fase_2{{$key+1}}">
                                </div>

                                <div class="col-md-4 form-group telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.indice_carregamento'), 'id' => ''])@endcomponent
                                    <input type="number"  class="form-control" value="0" step="0.01" readonly id="indice_carregamento_leitura_1_fase_3{{$key+1}}">
                                </div>
                            </div>

                            <div class="col-md-12 row">
                                <h3 class="col-12">@lang('afericao.leitura2') </h3>
                                <h4 class="col-12">@lang('afericao.corrente')</h4>

                                <div class="col-md-4 form-group telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.fase1') . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent
                                    <input type="number" step="0.001" value="{{$bombeamento['corrente_leitura_2_fase_1']}}" class="form-control"  onchange="calcularCarregamentoExistente({{$key+1}})" id="corrente_leitura_2_fase_1{{$key+1}}"   name="corrente_leitura_2_fase_1[]">
                                </div>

                                <div class="col-md-4 form-group telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.fase2') . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent
                                    <input type="number" step="0.001" value="{{$bombeamento['corrente_leitura_2_fase_2']}}" class="form-control"  onchange="calcularCarregamentoExistente({{$key+1}})" id="corrente_leitura_2_fase_2{{$key+1}}"  name="corrente_leitura_2_fase_2[]">
                                </div>

                                <div class="col-md-4 form-group telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.fase3') . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent
                                    <input type="number" step="0.001" value="{{$bombeamento['corrente_leitura_2_fase_3']}}" class="form-control"  onchange="calcularCarregamentoExistente({{$key+1}})" id="corrente_leitura_2_fase_3{{$key+1}}"  name="corrente_leitura_2_fase_3[]">
                                </div>

                                <h4 class="col-12 ">@lang('afericao.tensao')</h4>

                                <div class="col-md-4 form-group telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.fase1') . __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent
                                    <input type="number"  value="{{$bombeamento['tensao_leitura_2_fase_1']}}" class="form-control"  name="tensao_leitura_2_fase_1[]"  onchange="calcularCarregamentoExistente({{$key+1}})" id="tensao_leitura_2_fase_1{{$key+1}}">
                                </div>

                                <div class="col-md-4 form-group telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.fase2') . __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent
                                    <input type="number"  value="{{$bombeamento['tensao_leitura_2_fase_2']}}" class="form-control"  name="tensao_leitura_2_fase_2[]"  onchange="calcularCarregamentoExistente({{$key+1}})" id="tensao_leitura_2_fase_2{{$key+1}}">
                                </div>

                                <div class="col-md-4 form-group telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.fase3') . __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent
                                    <input type="number" value="{{$bombeamento['tensao_leitura_2_fase_3']}}" class="form-control"  name="tensao_leitura_2_fase_3[]"  onchange="calcularCarregamentoExistente({{$key+1}})" id="tensao_leitura_2_fase_3{{$key+1}}">
                                </div>



                                <div class="col-md-4 form-group telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.indice_carregamento'), 'id' => ''])@endcomponent
                                    <input type="number"   class="form-control" value="0" step="0.01" readonly id="indice_carregamento_leitura_2_fase_1{{$key+1}}">
                                </div>

                                <div class="col-md-4 form-group telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.indice_carregamento'), 'id' => ''])@endcomponent
                                    <input type="number"   class="form-control" value="0" step="0.01" readonly id="indice_carregamento_leitura_2_fase_2{{$key+1}}">
                                </div>

                                <div class="col-md-4 form-group telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.indice_carregamento'), 'id' => ''])@endcomponent
                                    <input type="number"   class="form-control" value="0" step="0.01" readonly id="indice_carregamento_leitura_2_fase_3{{$key+1}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            
        </div>
        
    </form>
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
        });

    </script>

    <script>
        function calcularCarregamentoExistente(num_bombeamento){
            let correnteNominal = $("#corrente_nominal"+num_bombeamento).val();
            if(correnteNominal != null && correnteNominal > 0){
                let leitura = $("#corrente_leitura_1_fase_1"+num_bombeamento).val(); 
                if(leitura != null && leitura > 0){
                    //Calculo de correção
                    correcao_corrente_eletrica_1_fase_1 = leitura * $('#tensao_leitura_1_fase_1'+num_bombeamento).val() * Math.sqrt(3) / $('#tensao_nominal'+num_bombeamento).val();
                    var carregamento = (correcao_corrente_eletrica_1_fase_1/correnteNominal)*100;
                    $("#indice_carregamento_leitura_1_fase_1"+num_bombeamento).val(carregamento.toFixed(2));
                }
                
                leitura = $("#corrente_leitura_1_fase_2"+num_bombeamento).val(); 
                if(leitura != null && leitura > 0){
                    //Calculo de correção
                    correcao_corrente_eletrica_1_fase_2 = leitura * $('#tensao_leitura_1_fase_2'+num_bombeamento).val() * Math.sqrt(3) / $('#tensao_nominal'+num_bombeamento).val();
                    var carregamento = (correcao_corrente_eletrica_1_fase_2/correnteNominal)*100;
                    $("#indice_carregamento_leitura_1_fase_2"+num_bombeamento).val(carregamento.toFixed(2));
                }

                leitura = $("#corrente_leitura_1_fase_3"+num_bombeamento).val(); 
                if(leitura != null && leitura > 0){
                    //Calculo de correção
                    correcao_corrente_eletrica_1_fase_3 = leitura * $('#tensao_leitura_1_fase_3'+num_bombeamento).val() * Math.sqrt(3) / $('#tensao_nominal'+num_bombeamento).val();
                    var carregamento = (correcao_corrente_eletrica_1_fase_3/correnteNominal)*100;
                    $("#indice_carregamento_leitura_1_fase_3"+num_bombeamento).val(carregamento.toFixed(2));
                }

                leitura = $("#corrente_leitura_2_fase_1"+num_bombeamento).val(); 
                if(leitura != null && leitura > 0){
                    //Calculo de correção
                    correcao_corrente_eletrica_2_fase_1 = leitura * $('#tensao_leitura_2_fase_1'+num_bombeamento).val() * Math.sqrt(3) / $('#tensao_nominal'+num_bombeamento).val();
                    var carregamento = (correcao_corrente_eletrica_2_fase_1/correnteNominal)*100;
                    $("#indice_carregamento_leitura_2_fase_1"+num_bombeamento).val(carregamento.toFixed(2));
                }

                leitura = $("#corrente_leitura_2_fase_2"+num_bombeamento).val(); 
                if(leitura != null && leitura > 0){
                    //Calculo de correção
                    correcao_corrente_eletrica_2_fase_2 = leitura * $('#tensao_leitura_2_fase_2'+num_bombeamento).val() * Math.sqrt(3) / $('#tensao_nominal'+num_bombeamento).val();
                    var carregamento = (correcao_corrente_eletrica_2_fase_2/correnteNominal)*100;
                    $("#indice_carregamento_leitura_2_fase_2"+num_bombeamento).val(carregamento.toFixed(2));
                }

                leitura = $("#corrente_leitura_2_fase_3"+num_bombeamento).val(); 
                if(leitura != null && leitura > 0){
                    //Calculo de correção
                    correcao_corrente_eletrica_2_fase_3 = leitura * $('#tensao_leitura_2_fase_3'+num_bombeamento).val() * Math.sqrt(3) / $('#tensao_nominal'+num_bombeamento).val();
                    var carregamento = (correcao_corrente_eletrica_2_fase_3/correnteNominal)*100;
                    $("#indice_carregamento_leitura_2_fase_3"+num_bombeamento).val(carregamento.toFixed(2));
                }
            }
        }


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
