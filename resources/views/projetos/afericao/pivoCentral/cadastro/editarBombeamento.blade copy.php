@extends('_layouts._layout_site')

@section('titulo')
@lang('afericao.editarBombeamento')
@endsection

@section('conteudo')

    <form action="{{route('editaBombeamento')}}" method="POST">
        @csrf
        <input type="hidden" name="id_afericao" value="{{$id_afericao}}">
        <input type="hidden" name="id_bombeamento" value="{{$cabecalho_bombeamento['id']}}">
        <div id="accordion">
            <div class="">
                <div class="" id="headingBombeamento">
                    <h3 class="mb-0">
                        @lang('afericao.bombeamento')
                        <button type="button" class="btn btn-outline-primary float-right" data-toggle="collapse" data-target="#collapseBombeamento" aria-expanded="true" aria-controls="collapseBombeamento">
                            <i class="fa fa-bars fa-fw"></i>
                        </button>
                    </h3>
                    <hr>
                </div>
                
                <div id="collapseBombeamento" class="collapse show" aria-labelledby="headingBombeamento" data-parent="#accordion">
                    <div class="card-body row">
                        <div class="col-md-3 form-group">
                            <input type="number" id="" class="form-control" required name="altitude_nivel_agua" value="{{$cabecalho_bombeamento['altitude_nivel_agua']}}">
                            @component('_layouts._components._inputLabel', ['texto'=>__('afericao.altitudeNivelAgua') . __('unidadesAcoes.(m)') , 'id' => ''])@endcomponent                                                                                                
                        </div>

                        <div class="col-md-3 form-group">
                        <input type="number"  class="form-control" required name="altitude_casa_bomba" value="{{$cabecalho_bombeamento['altitude_casa_bomba']}}">
                            @component('_layouts._components._inputLabel', ['texto'=>__('afericao.altitudeCasaBomba') . __('unidadesAcoes.(m)'), 'id' => ''])@endcomponent                                                                                                
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="tipo_instalacao">@lang('afericao.tipoInstalacao')</label>
                            <select name="tipo_instalacao"  class="form-control" id="tipo_instalacao">
                                <option value="0" <?php if($cabecalho_bombeamento['tipo_instalacao'] == 0) echo "selected='selected'"; ?> >@lang('afericao.direta')</option>
                                <option value="1" <?php if($cabecalho_bombeamento['tipo_instalacao'] == 1) echo "selected='selected'"; ?> >@lang('afericao.afogada')</option>
                                <option value="2" <?php if($cabecalho_bombeamento['tipo_instalacao'] == 2) echo "selected='selected'"; ?> >@lang('afericao.balsa')</option>
                                <option value="3" <?php if($cabecalho_bombeamento['tipo_instalacao'] == 3) echo "selected='selected'"; ?> >@lang('afericao.submersa')</option>
                            </select>
                            <div class="line"></div>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="posicionamento_bombeamento">@lang('afericao.posicionamentoBombeamento')</label>
                            <select name="posicionamento_bombeamento"  class="form-control" id="posicionamento_bombeamento">
                                <option value="0" <?php if($cabecalho_bombeamento['captacao'] == 0) echo "selected='selected'"; ?>>@lang('afericao.simples')</option>
                                <option value="1" <?php if($cabecalho_bombeamento['captacao'] == 1) echo "selected='selected'"; ?>>@lang('afericao.serie')</option>
                                <option value="2" <?php if($cabecalho_bombeamento['captacao'] == 2) echo "selected='selected'"; ?>>@lang('afericao.paralelo')</option>
                            </select>
                            <div class="line"></div>

                        </div>

                        <div class="col-md-3 form-group">
                            <label for="captacao">@lang('afericao.captacao')</label>
                            <select name="captacao"  class="form-control" id="captacao">
                                <option value="0" <?php if($cabecalho_bombeamento['captacao'] == 0) echo "selected='selected'"; ?>>@lang('afericao.acude')</option>
                                <option value="1" <?php if($cabecalho_bombeamento['captacao'] == 1) echo "selected='selected'"; ?>>@lang('afericao.barragem')</option>
                                <option value="2" <?php if($cabecalho_bombeamento['captacao'] == 2) echo "selected='selected'"; ?>>@lang('afericao.corrego')</option>
                                <option value="3" <?php if($cabecalho_bombeamento['captacao'] == 3) echo "selected='selected'"; ?>>@lang('afericao.lago')</option>
                                <option value="4" <?php if($cabecalho_bombeamento['captacao'] == 4) echo "selected='selected'"; ?>>@lang('afericao.lagoa')</option>
                                <option value="5" <?php if($cabecalho_bombeamento['captacao'] == 5) echo "selected='selected'"; ?>>@lang('afericao.poco')</option>
                            </select>
                            <div class="line"></div>

                        </div>                

                        <div class="col-md-3 form-group">
                            <input type="number" step=0.000001  class="form-control" required name="latitude" value="{{$cabecalho_bombeamento['latitude']}}">
                            @component('_layouts._components._inputLabel', ['texto'=>__('afericao.latitude'), 'id' => ''])@endcomponent                                                                                                
                        </div>

                        <div class="col-md-3 form-group">
                            <input type="number" step=0.000001 class="form-control" required name="longitude" value="{{$cabecalho_bombeamento['longitude']}}">
                            @component('_layouts._components._inputLabel', ['texto'=>__('afericao.longitude'), 'id' => ''])@endcomponent                                                                                                
                        </div>

                        <div class="col-md-3 form-group">
                            <input type="number" class="form-control" id="numero_bombas" required name="numero_bombas" value="{{$cabecalho_bombeamento['numero_bombas']}}">
                            @component('_layouts._components._inputLabel', ['texto'=>__('afericao.numero_bombas'), 'id' => ''])@endcomponent                                                                                                
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="accordion">
            <div id="DivBombas">
                @foreach ($bombeamentos as $key => $bombeamento)
                <div class="col-12">
                    <div class="" id="heading{{$key + 1}}">
                        <h4 class="">
                            @lang('afericao.bomba') {{$key + 1}}
                            <button type="button" class="btn btn-outline-primary float-right" data-toggle="collapse" data-target="#collapse{{$key + 1}}" aria-expanded="true" aria-controls="collapse{{$key + 1}}">
                                <i class="fa fa-bars"></i>
                            </button>
                            <hr>
                        </h4>
                        
                    </div>
                    <div class="row collapse" id="collapse{{$key + 1}}" aria-labelledby="heading{{$key + 1}}" data-parent="#accordion">
                        <input type="hidden" name="id[]" value="{{$bombeamento['id']}}">
                        <div class="col-md-12 row">

                            <div class="col-md-3 form-group">
                                <input type="number" id="comprimento_succao_{{$key}}"  value="{{$bombeamento['comprimento_succao']}}" class="form-control" required name="comprimento_succao[]">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.comprimentoSuccao') . __('unidadesAcoes.(m)'), 'id' => ''])@endcomponent                                                                                                
                            </div>

                            <div class="col-md-3 form-group">
                                <input type="number" class="form-control"  value="{{$bombeamento['diametro_succao']}}" required name="diametro_succao[]">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.diametroSuccao') . __('unidadesAcoes.(m)'), 'id' => ''])@endcomponent                                                                                                
                            </div>

                            <div class="col-md-3 form-group">
                                <input type="text" class="form-control"  value="{{$bombeamento['marca']}}" required name="marca[]">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.marca'), 'id' => ''])@endcomponent                                                                                                
                            </div>

                            <div class="col-md-3 form-group">
                                <input type="text" class="form-control"  value="{{$bombeamento['modelo']}}" required name="modelo[]">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.modelo'), 'id' => ''])@endcomponent                                                                                                
                            </div>

                            <div class="col-md-3 form-group">
                                <input type="number" class="form-control"  value="{{$bombeamento['numero_rotores']}}" required name="numero_rotores[]">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.numeroRotores'), 'id' => ''])@endcomponent                                                                                                
                            </div>

                            <div class="col-md-3 form-group">
                                <input type="number" class="form-control"  value="{{$bombeamento['diametro_rotor']}}" required name="diametro_rotor[]">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.diametroRotor') . __('unidadesAcoes.(mm)'), 'id' => ''])@endcomponent                                                                                                
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="mat_succao">@lang('afericao.materialSuccao')</label>
                                <select name="material_succao[]"  class="form-control" id="mat_succao{{$key}}">
                                    <option @if($bombeamento['material_succao'] == "0") selected @endif value="0">@lang('afericao.acoSac')</option>
                                    <option @if($bombeamento['material_succao'] == "1") selected @endif value="1">@lang('afericao.AZ')</option>
                                    <option @if($bombeamento['material_succao'] == "2") selected @endif value="2">@lang('afericao.PVC')</option>
                                    <option @if($bombeamento['material_succao'] == "3") selected @endif value="3">@lang('afericao.RPVC')</option>
                                </select>
                                <div class="line"></div>
                            </div>

                            <div class="col-md-3 form-group">
                                <input type="number" class="form-control"  value="{{$bombeamento['rendimento_bomba']}}" required name="rendimento_bomba[]">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.rendimentoBomba') . __('unidadesAcoes.(%)'), 'id' => ''])@endcomponent                                                                                                
                            </div>

                            <div class="col-md-3 form-group">
                                <input type="number" class="form-control"  value="{{$bombeamento['shutoff']}}" required name="shutoff[]">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.shutoff') . __('unidadesAcoes.(mca)'), 'id' => ''])@endcomponent                                                                                                
                            </div> 

                            <div class="col-md-3 form-group">
                                <input type="number" class="form-control"  value="{{$bombeamento['rotacao']}}" required name="rotacao[]">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.rotacao') . __('unidadesAcoes.(rpm)'), 'id' => ''])@endcomponent                                                                                                
                            </div>

                            <div class="col-md-3 form-group">
                                <input type="number" class="form-control"  value="{{$bombeamento['pressao_bomba']}}" required name="pressao_bomba[]">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.pressaoBomba') . __('unidadesAcoes.(mca)'), 'id' => ''])@endcomponent                                                                                                
                            </div>
                            <!---->

                            <div class="col-12">
                                <h4>@lang('afericao.motor')</h4>
                                <hr>
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="tipo_motor">@lang('afericao.tipo_motor')</label>
                                <select name="tipo_motor[]"   class="form-control" id="tipo_motor{{$key + 1}}" onchange="configKeyStarterExistente({{$key + 1}})">
                                    <option @if($bombeamento['tipo_motor'] == "diesel") selected @endif value="diesel">@lang('afericao.diesel')</option>
                                    <option @if($bombeamento['tipo_motor'] == "eletrico") selected @endif value="eletrico">@lang('afericao.eletrico')</option>
                                </select>
                                <div class="line"></div>

                            </div>

                            <div class="col-md-3 form-group">
                                <input type="text" class="form-control"  value="{{$bombeamento['modelo_motor']}}" required name="modelo_motor[]">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.modelo'), 'id' => ''])@endcomponent                                                                                                
                            </div>

                            <div class="col-md-3 form-group">
                                <input type="number" class="form-control"  value="{{$bombeamento['potencia']}}" required name="potencia[]">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.potencia') . __('unidadesAcoes.(cv)'), 'id' => ''])@endcomponent                                                                                                
                            </div>

                            <div class="col-md-3 form-group">
                                <input type="number" class="form-control"  value="{{$bombeamento['numero_motores']}}" required name="numero_motores[]">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.numeroMotores'), 'id' => ''])@endcomponent                                                                                                
                            </div>

                            <div class="col-md-3 form-group" id="divChavePartida{{$key + 1}}" @if($bombeamento['tipo_motor'] == "diesel") style="display: none" @endif>
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

                            <div class="col-md-3 form-group">
                                <input type="number"  value="{{$bombeamento['fator_servico']}}" class="form-control" required name="fator_servico[]">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.fatorServico'), 'id' => ''])@endcomponent                                                                                                
                            </div>

                            <div class="col-md-3 form-group" id="div_corrente_nominal{{$key + 1}}">
                                <input type="number"  value="{{$bombeamento['corrente_nominal']}}" class="form-control" onchange="calcularCarregamentoExistente({{$key+1}})"  id="corrente_nominal{{$key + 1}}" name="corrente_nominal[]">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.correnteNominal') . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent                                                                                                
                            </div>

                            <div class="col-md-3 form-group">
                                <input type="number"  value="{{$bombeamento['rendimento']}}" class="form-control" required name="rendimento[]">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.rendimento'), 'id' => ''])@endcomponent                                                                                                
                            </div>

                            <div class="col-md-3 form-group" id="div_tensao_nominal{{$key + 1}}">
                                <label for="tensao_nominal">@lang('afericao.tensaoNominal')</label>
                                <select name="tensao_nominal[]"  class="form-control"  onchange="calcularCarregamentoExistente({{$key+1}})" id="tensao_nominal{{$key + 1}}">
                                    <option @if($bombeamento['tensao_nominal'] == "220") selected @endif value="220">220V</option>
                                    <option @if($bombeamento['tensao_nominal'] == "380") selected @endif value="380">380V</option>
                                    <option @if($bombeamento['tensao_nominal'] == "440") selected @endif value="440">440V</option>
                                </select>
                                <div class="line"></div>

                            </div>

                            <div class="col-md-3 form-group" id="div_frequencia{{$key + 1}}">
                                <input type="number" value="60"  value="{{$bombeamento['frequencia']}}" class="form-control" required name="frequencia[]">
                                @component('_layouts._components._inputLabel', ['texto'=>__('afericao.frequencia'), 'id' => ''])@endcomponent                                                                                                
                            </div>
                        </div>
                        <div class="col-md-12 row" id="div_leituras{{$key + 1}}">
                            <div class="col-md-12 row">
                                <h3 class="col-12 text-center">@lang('afericao.leitura1') <hr> </h3>
                                <h4 class="col-12">@lang('afericao.corrente')</h4>

                                <div class="col-md-4 form-group">
                                    <input type="number" step="0.001" value="{{$bombeamento['corrente_leitura_1_fase_1']}}" class="form-control" required   onchange="calcularCarregamentoExistente({{$key+1}})" id="corrente_leitura_1_fase_1{{$key+1}}"  name="corrente_leitura_1_fase_1[]">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.fase1') . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent                                                                                                
                                </div>

                                <div class="col-md-4 form-group">
                                    <input type="number" step="0.001" value="{{$bombeamento['corrente_leitura_1_fase_2']}}" class="form-control" required  onchange="calcularCarregamentoExistente({{$key+1}})" id="corrente_leitura_1_fase_2{{$key+1}}"  name="corrente_leitura_1_fase_2[]">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.fase2') . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent                                                                                                
                                </div>

                                <div class="col-md-4 form-group">
                                    <input type="number" step="0.001" value="{{$bombeamento['corrente_leitura_1_fase_3']}}" class="form-control" required  onchange="calcularCarregamentoExistente({{$key+1}})" id="corrente_leitura_1_fase_3{{$key+1}}"  name="corrente_leitura_1_fase_3[]">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.fase3') . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent                                                                                                
                                </div>

                                <h4 class="col-12 ">@lang('afericao.tensao')</h4>

                                <div class="col-md-4 form-group">
                                    <input type="number"  value="{{$bombeamento['tensao_leitura_1_fase_1']}}" class="form-control"  onchange="calcularCarregamentoExistente({{$key+1}})" required name="tensao_leitura_1_fase_1[]" id="tensao_leitura_1_fase_1{{$key+1}}">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.fase1') . __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent                                                                                                
                                </div>

                                <div class="col-md-4 form-group">
                                    <input type="number"  value="{{$bombeamento['tensao_leitura_1_fase_2']}}" class="form-control"  onchange="calcularCarregamentoExistente({{$key+1}})" required name="tensao_leitura_1_fase_2[]" id="tensao_leitura_1_fase_2{{$key+1}}">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.fase2') . __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent                                                                                                
                                </div>

                                <div class="col-md-4 form-group">
                                    <input type="number"  value="{{$bombeamento['tensao_leitura_1_fase_3']}}" class="form-control"  onchange="calcularCarregamentoExistente({{$key+1}})" required name="tensao_leitura_1_fase_3[]" id="tensao_leitura_1_fase_3{{$key+1}}">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.fase3') . __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent                                                                                                
                                </div>


                                <div class="col-md-4 form-group">
                                    <input type="number"   class="form-control" value="0" step="0.01" readonly id="indice_carregamento_leitura_1_fase_1{{$key+1}}">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.indice_carregamento'), 'id' => ''])@endcomponent                                                                                                
                                </div>

                                <div class="col-md-4 form-group">
                                    <input type="number"  class="form-control" value="0" step="0.01" readonly id="indice_carregamento_leitura_1_fase_2{{$key+1}}">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.indice_carregamento'), 'id' => ''])@endcomponent                                                                                                
                                </div>

                                <div class="col-md-4 form-group">
                                    <input type="number"  class="form-control" value="0" step="0.01" readonly id="indice_carregamento_leitura_1_fase_3{{$key+1}}">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.indice_carregamento'), 'id' => ''])@endcomponent                                                                                                
                                </div>
                            </div>

                            <div class="col-md-12 row">
                                <h3 class="col-12 text-center">@lang('afericao.leitura2') <hr></h3>
                                <h4 class="col-12">@lang('afericao.corrente')</h4>

                                <div class="col-md-4 form-group">
                                    <input type="number" step="0.001" value="{{$bombeamento['corrente_leitura_2_fase_1']}}" class="form-control"  onchange="calcularCarregamentoExistente({{$key+1}})" id="corrente_leitura_2_fase_1{{$key+1}}"   name="corrente_leitura_2_fase_1[]">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.fase1') . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent                                                                                                
                                </div>

                                <div class="col-md-4 form-group">
                                    <input type="number" step="0.001" value="{{$bombeamento['corrente_leitura_2_fase_2']}}" class="form-control"  onchange="calcularCarregamentoExistente({{$key+1}})" id="corrente_leitura_2_fase_2{{$key+1}}"  name="corrente_leitura_2_fase_2[]">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.fase2') . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent                                                                                                
                                </div>

                                <div class="col-md-4 form-group">
                                    <input type="number" step="0.001" value="{{$bombeamento['corrente_leitura_2_fase_3']}}" class="form-control"  onchange="calcularCarregamentoExistente({{$key+1}})" id="corrente_leitura_2_fase_3{{$key+1}}"  name="corrente_leitura_2_fase_3[]">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.fase3') . __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent                                                                                                
                                </div>

                                <h4 class="col-12 ">@lang('afericao.tensao')</h4>

                                <div class="col-md-4 form-group">
                                    <input type="number"  value="{{$bombeamento['tensao_leitura_2_fase_1']}}" class="form-control"  name="tensao_leitura_2_fase_1[]"  onchange="calcularCarregamentoExistente({{$key+1}})" id="tensao_leitura_2_fase_1{{$key+1}}">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.fase1') . __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent                                                                                                
                                </div>

                                <div class="col-md-4 form-group">
                                    <input type="number"  value="{{$bombeamento['tensao_leitura_2_fase_2']}}" class="form-control"  name="tensao_leitura_2_fase_2[]"  onchange="calcularCarregamentoExistente({{$key+1}})" id="tensao_leitura_2_fase_2{{$key+1}}">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.fase2') . __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent                                                                                                
                                </div>

                                <div class="col-md-4 form-group">
                                    <input type="number" value="{{$bombeamento['tensao_leitura_2_fase_3']}}" class="form-control"  name="tensao_leitura_2_fase_3[]"  onchange="calcularCarregamentoExistente({{$key+1}})" id="tensao_leitura_2_fase_3{{$key+1}}">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.fase3') . __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent                                                                                                
                                </div>



                                <div class="col-md-4 form-group">
                                    <input type="number"   class="form-control" value="0" step="0.01" readonly id="indice_carregamento_leitura_2_fase_1{{$key+1}}">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.indice_carregamento'), 'id' => ''])@endcomponent                                                                                                
                                </div>

                                <div class="col-md-4 form-group">
                                    <input type="number"   class="form-control" value="0" step="0.01" readonly id="indice_carregamento_leitura_2_fase_2{{$key+1}}">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.indice_carregamento'), 'id' => ''])@endcomponent                                                                                                
                                </div>

                                <div class="col-md-4 form-group">
                                    <input type="number"   class="form-control" value="0" step="0.01" readonly id="indice_carregamento_leitura_2_fase_3{{$key+1}}">
                                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.indice_carregamento'), 'id' => ''])@endcomponent                                                                                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="text-center">
            @if(!$completo) 
                <a  id="" href="{{route('continuarBombeamentos', $id_adutora)}}"  class="btn btn-outline-dark"> @lang('afericao.continuarCadastro')</a>
            @endif
            <button type="submit" name="botao" value="salvar" onclick="mostrarTodasDivs()" id="btnSalvarBombeamento" class="btn btn-outline-primary"> @lang('unidadesAcoes.salvar')</button>
            <button type="submit" name="botao" value="sair" onclick="mostrarTodasDivs()" id="btnSair" class="btn btn-outline-primary"> @lang('unidadesAcoes.salvarSair')</button>
            <a  id="" href="{{route('status_afericao', $id_afericao)}}"  class="btn btn-outline-dark"> @lang('unidadesAcoes.voltar')</a>
        </div>
    </form>
@endsection

@section('scripts')

<script type="text/javascript">

    function mostrarTodasDivs(){
        $('#accordion').collapse({
            toggle: false
        });
        var i = {{$bombeamentos->count()}}
        for (let index = 1; index <= i; index++) {
            $("#collapse"+index).show();
        }
    }

    ///////////////////////////////////////////Funções dos campos já existentes//////////////////////////////////////////////////////////////////////////////////////
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



    $(function(){
        var i = {{$bombeamentos->count()}}
        for (let index = 1; index <= i; index++) {
            configKeyStarterExistente(index);
            calcularCarregamentoExistente(index);
        }
    });

    function configKeyStarterExistente(num_bombeamento){
        var tipo_motor = $("#tipo_motor" + num_bombeamento).val();
        if(tipo_motor === "diesel"){
            $("#divChavePartida" + num_bombeamento).hide();
            $("#chave_partida" + num_bombeamento).val(0);

            $("#div_corrente_nominal" + num_bombeamento).hide();
            $("#div_corrente_nominal" + num_bombeamento).val('');
            $("#div_corrente_nominal" + num_bombeamento).removeAttr("required");

            $("#div_tensao_nominal" + num_bombeamento).hide();
            $("#div_tensao_nominal" + num_bombeamento).val('');
            $("#div_tensao_nominal" + num_bombeamento).removeAttr("required");

            $("#div_frequencia" + num_bombeamento).hide();
            $("#div_frequencia" + num_bombeamento).val('');
            $("#div_frequencia" + num_bombeamento).removeAttr("required");
            
            $("#div_leituras" + num_bombeamento).hide();
            $("#div_leituras" + num_bombeamento + " :input").each(function(){
                $(this).val('');
                $(this).removeAttr("required");
            });

        }else{
            $("#divChavePartida" + num_bombeamento).show();
            if($("#chave_partida" + num_bombeamento).val() == 0){
                $("#chave_partida" + num_bombeamento).val(1);

                $("#div_corrente_nominal" + num_bombeamento).show();
                $("#div_corrente_nominal" + num_bombeamento).attr("requiered", "req");

                $("#div_tensao_nominal" + num_bombeamento).show();
                $("#div_tensao_nominal" + num_bombeamento).attr("requiered", "req");

                $("#div_frequencia" + num_bombeamento).show();
                $("#div_frequencia" + num_bombeamento).attr("requiered", "req");

                $("#div_leituras" + num_bombeamento).show();
                $("#div_leituras" + num_bombeamento).attr("requiered", "req");
                
            }
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /////////////////////////////////////////// Funções para os campos dinâmicos ///////////////////////////////////////////

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

    function configKeyStarter(id_bomba){
        var tipo_motor = $("#tipo_motor_"+id_bomba).val();
        //Escondendo e limpando os campos caso o tipo de motor seja diesel.
        if(tipo_motor === "diesel"){
            $("#divChavePartida_"+id_bomba).hide();
            $("#chave_partida_"+id_bomba).val(0);

            $("#div_corrente_nominal_"+id_bomba).hide();
            $("#div_corrente_nominal_"+id_bomba).val('');
            $("#div_corrente_nominal_"+id_bomba).removeAttr("required");

            $("#div_tensao_nominal_"+id_bomba).hide();
            $("#div_tensao_nominal_"+id_bomba).val('');
            $("#div_tensao_nominal_"+id_bomba).removeAttr("required");

            $("#div_frequencia_"+id_bomba).hide();
            $("#div_frequencia_"+id_bomba).val('');
            $("#div_frequencia_"+id_bomba).removeAttr("required");
            
            $("#div_leituras_"+id_bomba).hide();
            $("#div_leituras_"+id_bomba+" :input").each(function(){
                $(this).val('');
                $(this).removeAttr("required");
            });
        // Se não volta os campos para visiveis.
        }else{
            $("#divChavePartida_"+id_bomba).show();
            $("#chave_partida_"+id_bomba).val(1);

            $("#div_corrente_nominal_"+id_bomba).show();
            $("#div_corrente_nominal_"+id_bomba).attr("required", "req");

            $("#div_tensao_nominal_"+id_bomba).show();
            $("#div_tensao_nominal_"+id_bomba).attr('required', "req");

            $("#div_frequencia_"+id_bomba).show();
            $("#div_frequencia_"+id_bomba).attr('required', "req");

            $("#div_leituras_"+id_bomba).show();
            $("#div_leituras_"+id_bomba+" :input").each(function(){
                $(this).attr('required', "req");
            });

        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // Função para manipulação de labels nos inputs.
    function validaCampo(valor, id){
        if (valor != null && valor != ''){ $('#'+id).addClass('has-value'); }else{ $('#'+id).removeClass('has-value'); }
    }

    // Gerando as divs de bombas e motores na mudança do campo.
    $('#numero_bombas').change(function(){
    
        // Capturando valor do campo de "numero de bombas"
        var numero_bombas = $(this).val();

        // Verificando se já existe campos criados e quantos.
        if ($("#DivBombas").children().length > 0){ $("#DivBombas").children().remove(); }


        // Cria os blocos de campos.
        if (numero_bombas != null && numero_bombas != ''){

            for (i = 1; i <= numero_bombas; i++){
                var html = '';

                //////////////////////////////////////////////////////////////////// BOMBA ////////////////////////////////////////////////////////////////////////////////////////////////////
                html = '<div class="card-body row" id="bomba_'+i+'">';

                html += '   <div class="col-12" id="headingBomba_'+i+'">';
                html += '       <h4>@lang("afericao.bomba") '+(i);
                html += '       <button type="button" class="btn btn-outline-primary float-right" data-toggle="collapse" data-target="#control_bomba_'+i+'" aria-expanded="true" aria-controls="control_bomba_'+i+'">';
                html += '           <i class="fa fa-bars fa-fw"></i>';
                html += '       </button>';
                html += '       </h4> <hr>';
                html += '   </div>';

                // Cria apenas o primeiro bloco de bomba aberto.
                if (i == 1){
                html += '   <div class="col-md-12 row collapse show" id="control_bomba_'+i+'" aria-labelledby="headingBomba_'+i+'" data-parent="#DivBombas">';
                }
                // Demais blocos, fechados.
                else{
                html += '   <div class="col-md-12 row collapse" id="control_bomba_'+i+'" aria-labelledby="headingBomba_'+i+'" data-parent="#DivBombas">';
                }
                html += '      <div class="col-md-3 form-group">';
                html += '          <input type="number" step="0.01" id="comprimento_succao_'+i+'" class="form-control" required name="comprimento_succao[]" onchange="validaCampo(this.value, this.id)">';
                html += '          @component("_layouts._components._inputLabel", ["texto"=>__("afericao.comprimentoSuccao") . __("unidadesAcoes.(m)"), "id" => ""])@endcomponent';
                html += '      </div>';

                html += '      <div class="col-md-3 form-group">';
                html += '          <input type="number" step="0.001" id="diametro_succao_'+i+'" class="form-control" required name="diametro_succao[]" onchange="validaCampo(this.value, this.id)">';
                html += '          @component("_layouts._components._inputLabel", ["texto"=>__("afericao.diametroSuccao")   . __("unidadesAcoes.(m)") , "id" => ""])@endcomponent';
                html += '      </div>';

                html += '      <div class="col-md-3 form-group">';
                html += '          <input type="text" class="form-control" required name="marca[]" id="marca_'+i+'" onchange="validaCampo(this.value, this.id)">';
                html += '          @component("_layouts._components._inputLabel", ["texto"=>__("afericao.marca"), "id" => ""])@endcomponent';
                html += '      </div>';

                html += '      <div class="col-md-3 form-group">';
                html += '          <input type="text" class="form-control" required name="modelo[]" id="modelo_'+i+'" onchange="validaCampo(this.value, this.id)">';
                html += '          @component("_layouts._components._inputLabel", ["texto"=>__("afericao.modelo"), "id" => ""])@endcomponent';
                html += '      </div>';

                html += '      <div class="col-md-3 form-group">';
                html += '          <input type="number" class="form-control" required name="numero_rotores[]" id="numero_rotores_'+i+'" onchange="validaCampo(this.value, this.id)">';
                html += '          @component("_layouts._components._inputLabel", ["texto"=>__("afericao.numeroRotores"), "id" => ""])@endcomponent';
                html += '      </div>';

                html += '      <div class="col-md-3 form-group">';
                html += '          <input type="number" step="0.01" class="form-control" required name="diametro_rotor[]" id="diametro_rotor_'+i+'" onchange="validaCampo(this.value, this.id)">';
                html += '          @component("_layouts._components._inputLabel", ["texto"=>__("afericao.diametroRotor") . __("unidadesAcoes.(mm)"), "id" => ""])@endcomponent';
                html += '      </div>';

                html += '       <div class="col-md-3 form-group">';
                html += '           <label for="mat_succao">@lang("afericao.materialSuccao")</label>';
                html += '           <select name="material_succao[]"  class="form-control" id="mat_succao_'+i+'">';
                html += '               <option value="0">@lang("afericao.acoSac")</option>';
                html += '               <option value="1">@lang("afericao.AZ")</option>';
                html += '               <option value="2">@lang("afericao.PVC")</option>';
                html += '               <option value="3">@lang("afericao.RPVC")</option>';
                html += '           </select>';
                html += '           <div class="line"></div>';
                html += '       </div>';

                html += '       <div class="col-md-3 form-group">';
                html += '           <input type="number" step="0.01" class="form-control" required name="rendimento_bomba[]" id="rendimento_bomba_'+i+'" onchange="validaCampo(this.value, this.id)">';
                html += '           @component("_layouts._components._inputLabel", ["texto"=>__("afericao.rendimentoBomba"). __("unidadesAcoes.(%)") , "id" => ""])@endcomponent';
                html += '       </div>';

                html += '       <div class="col-md-3 form-group">';
                html += '           <input type="number" step="0.01" class="form-control" required name="shutoff[]" id="shutoff_'+i+'" onchange="validaCampo(this.value, this.id)">';
                html += '           @component("_layouts._components._inputLabel", ["texto"=>__("afericao.shutoff") . __("unidadesAcoes.(mca)"), "id" => ""])@endcomponent';
                html += '       </div>';

                html += '       <div class="col-md-3 form-group">';
                html += '           <input type="number" class="form-control" required name="rotacao[]" id="rotacao_'+i+'" onchange="validaCampo(this.value, this.id)">';
                html += '           @component("_layouts._components._inputLabel", ["texto"=>__("afericao.rotacao") . __("unidadesAcoes.(rpm)"), "id" => ""])@endcomponent';
                html += '       </div>';

                html += '       <div class="col-md-3 form-group">';
                html += '           <input type="number" step="0.01" class="form-control" required name="pressao_bomba[]" id="pressao_bomba_'+i+'" onchange="validaCampo(this.value, this.id)">';
                html += '           @component("_layouts._components._inputLabel", ["texto"=>__("afericao.pressaoBomba").__("unidadesAcoes.(mca)") , "id" => ""])@endcomponent';
                html += '       </div>';

                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                ////////////////////////////////////////////////////////////////////////// MOTOR //////////////////////////////////////////////////////////////////////////////////////////////
                html += '       <div class="col-12">';
                html += '           <h4>@lang("afericao.motor") '+i+'</h4>';
                html += '           <hr>';
                html += '       </div>';

                html += '       <div class="col-md-3 form-group">';
                html += '           <label for="tipo_motor">@lang("afericao.tipo_motor")</label>';
                html += '           <select onchange="configKeyStarter('+i+')" name="tipo_motor[]"  class="form-control" id="tipo_motor_'+i+'">';
                html += '               <option value="diesel">@lang("afericao.diesel")</option>';
                html += '               <option value="eletrico">@lang("afericao.eletrico")</option>';
                html += '           </select>';
                html += '           <div class="line"></div>';
                html += '       </div>';

                html += '       <div class="col-md-3 form-group">';
                html += '           <input type="text" class="form-control" required name="modelo_motor[]" id="modelo_motor_'+i+'" onchange="validaCampo(this.value, this.id)">';
                html += '           @component("_layouts._components._inputLabel", ["texto"=>__("afericao.modelo"), "id" => ""])@endcomponent';
                html += '       </div>';

                html += '       <div class="col-md-3 form-group">'
                html += '           <input type="number" step="0.01" class="form-control" required name="potencia[]" id="potencia_'+i+'" onchange="validaCampo(this.value, this.id)">'
                html += '           @component("_layouts._components._inputLabel", ["texto"=>__("afericao.potencia").__("unidadesAcoes.(cv)"), "id" => ""])@endcomponent'
                html += '       </div>'

                html += '       <div class="col-md-3 form-group">'
                html += '           <input type="number" class="form-control" required name="numero_motores[]" id="numero_motores_'+i+'" onchange="validaCampo(this.value, this.id)">'
                html += '           @component("_layouts._components._inputLabel", ["texto"=>__("afericao.numeroMotores"), "id" => ""])@endcomponent'
                html += '       </div>'

                html += '       <div class="col-md-3 form-group" id="divChavePartida_'+i+'" style="display: none">'
                html += '           <label for="chave_partida">@lang("afericao.chavePartida")</label>'
                html += '           <select name="chave_partida[]"  class="form-control" id="chave_partida_'+i+'">'
                html += '               <option hidden value="0">Sem Chave</option>'
                html += '               <option selected value="1">@lang("afericao.serieParalela")</option>'
                html += '               <option value="2">@lang("afericao.estrelaTriangulo")</option>'
                html += '               <option value="3">@lang("afericao.compensadora")</option>'
                html += '               <option value="4">@lang("afericao.softStarter")</option>'
                html += '           </select>'
                html += '           <div class="line"></div>'
                html += '       </div>'

                html += '       <div class="col-md-3 form-group">'
                html += '           <input type="number" step="0.01" step="0.01" class="form-control" required name="fator_servico[]" id="fator_servico_'+i+'" onchange="validaCampo(this.value, this.id)">'
                html += '           @component("_layouts._components._inputLabel", ["texto"=>__("afericao.fatorServico"), "id" => ""])@endcomponent'
                html += '       </div>'

                html += '       <div class="col-md-3 form-group" id="div_corrente_nominal_'+i+'">'
                html += '       <input type="number" step="0.01" class="form-control" id="corrente_nominal_'+i+'" name="corrente_nominal[]" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                html += '       @component("_layouts._components._inputLabel", ["texto"=>__("afericao.correnteNominal").__("unidadesAcoes.(a)"), "id" => ""])@endcomponent'
                html += '       </div>'

                html += '       <div class="col-md-3 form-group">'
                html += '           <input type="number" step="0.01" class="form-control" required name="rendimento[]" id="rendimento_'+i+'" onchange="validaCampo(this.value, this.id)">'
                html += '           @component("_layouts._components._inputLabel", ["texto"=>__("afericao.rendimento"), "id" => ""])@endcomponent'
                html += '       </div>'

                html += '       <div class="col-md-3 form-group" id="div_tensao_nominal_'+i+'">'
                html += '           <label for="tensao_nominal">@lang("afericao.tensaoNominal")</label>'
                html += '           <select name="tensao_nominal[]" onchange="calcularCarregamento('+i+')"  class="form-control" id="tensao_nominal_'+i+'">'
                html += '               <option value="220">220V</option>'
                html += '               <option value="380">380V</option>'
                html += '               <option value="440">440V</option>'
                html += '           </select>'
                html += '           <div class="line"></div>'
                html += '       </div>'

                html += '       <div class="col-md-3 form-group" id="div_frequencia_'+i+'">'
                html += '           <input type="number" value="60" class="form-control has-value" required name="frequencia[]" id="frequencia_'+i+'" onchange="validaCampo(this.value, this.id)">'
                html += '           @component("_layouts._components._inputLabel", ["texto"=>__("afericao.frequencia"), "id" => ""])@endcomponent'
                html += '       </div>'
                
                html +='        <div class="col-md-12 row" id="div_leituras_'+i+'">'
                html +='            <div class="col-md-12 row">'
                html +='                <h3 class="col-12 text-center">@lang("afericao.leitura1") <hr> </h3>'

                html +='                <h4 class="col-12">@lang("afericao.corrente")</h4>'

                html +='                <div class="col-md-4 form-group">'
                html +='                    <input type="number" step="0.01" class="form-control" id="bomba_'+i+'_corrente_leitura_1_fase_1"  name="corrente_leitura_1_fase_1[]" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.fase1") . __("unidadesAcoes.(a)") , "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group">'
                html +='                    <input type="number" step="0.01" class="form-control" id="bomba_'+i+'_corrente_leitura_1_fase_2"  name="corrente_leitura_1_fase_2[]" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.fase2") . __("unidadesAcoes.(a)"), "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group">'
                html +='                    <input type="number" step="0.01" class="form-control" id="bomba_'+i+'_corrente_leitura_1_fase_3"  name="corrente_leitura_1_fase_3[]" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.fase3") . __("unidadesAcoes.(a)"), "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <h4 class="col-12 ">@lang("afericao.tensao")</h4>'

                html +='                <div class="col-md-4 form-group">'
                html +='                    <input type="number" step="0.01" class="form-control" name="tensao_leitura_1_fase_1[]" id="bomba_'+i+'_tensao_leitura_1_fase_1" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.fase1")  . __("unidadesAcoes.(v)") , "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group">'
                html +='                    <input type="number" step="0.01" class="form-control" name="tensao_leitura_1_fase_2[]" id="bomba_'+i+'_tensao_leitura_1_fase_2" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.fase2")  . __("unidadesAcoes.(v)") , "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group">'
                html +='                    <input type="number" step="0.01" class="form-control" name="tensao_leitura_1_fase_3[]" id="bomba_'+i+'_tensao_leitura_1_fase_3" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.fase3")  . __("unidadesAcoes.(v)") , "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group">'
                html +='                    <input type="number" step="0.01" class="form-control has-value" value="0" readonly  id="bomba_'+i+'_indice_carregamento_leitura_1_fase_1" onchange="validaCampo(this.value, this.id)">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.indice_carregamento"), "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group">'
                html +='                    <input type="number" step="0.01" class="form-control has-value" value="0" readonly id="bomba_'+i+'_indice_carregamento_leitura_1_fase_2" onchange="validaCampo(this.value, this.id)">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.indice_carregamento"), "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group">'
                html +='                    <input type="number" step="0.01" class="form-control has-value" value="0" readonly id="bomba_'+i+'_indice_carregamento_leitura_1_fase_3" onchange="validaCampo(this.value, this.id)">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.indice_carregamento"), "id" => ""])@endcomponent'
                html +='                </div>'
                html +='            </div>'

                html +='            <div class="col-md-12 row">'
                html +='                <h3 class="col-12 text-center">@lang("afericao.leitura2") <hr> </h3>'

                html +='                <h4 class="col-12">@lang("afericao.corrente")</h4>'

                html +='                <div class="col-md-4 form-group">'
                html +='                    <input type="number" step="0.01" class="form-control" id="bomba_'+i+'_corrente_leitura_2_fase_1"   name="corrente_leitura_2_fase_1[]" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.fase1") . __("unidadesAcoes.(a)") , "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group">'
                html +='                    <input type="number" step="0.01" class="form-control" id="bomba_'+i+'_corrente_leitura_2_fase_2"  name="corrente_leitura_2_fase_2[]" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.fase2") . __("unidadesAcoes.(a)") , "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group">'
                html +='                    <input type="number" step="0.01" class="form-control" id="bomba_'+i+'_corrente_leitura_2_fase_3"  name="corrente_leitura_2_fase_3[]" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.fase3") . __("unidadesAcoes.(a)") , "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <h4 class="col-12 ">@lang("afericao.tensao")</h4>'

                html +='                <div class="col-md-4 form-group">'
                html +='                    <input type="number" step="0.01" class="form-control" name="tensao_leitura_2_fase_1[]" id="bomba_'+i+'_tensao_leitura_2_fase_1" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.fase1")  . __("unidadesAcoes.(v)") , "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group">'
                html +='                    <input type="number" step="0.01" class="form-control" name="tensao_leitura_2_fase_2[]" id="bomba_'+i+'_tensao_leitura_2_fase_2" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.fase2")  . __("unidadesAcoes.(v)") , "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group">'
                html +='                    <input type="number" step="0.01" class="form-control" name="tensao_leitura_2_fase_3[]" id="bomba_'+i+'_tensao_leitura_2_fase_3" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.fase3")  . __("unidadesAcoes.(v)") , "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group">'
                html +='                    <input type="number" step="0.01" class="form-control has-value" readonly value="0"  id="bomba_'+i+'_indice_carregamento_leitura_2_fase_1">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.indice_carregamento"), "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group">'
                html +='                    <input type="number" step="0.01" class="form-control has-value" readonly value="0"  id="bomba_'+i+'_indice_carregamento_leitura_2_fase_2">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.indice_carregamento"), "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group">'
                html +='                    <input type="number" step="0.01" class="form-control has-value" readonly value="0" id="bomba_'+i+'_indice_carregamento_leitura_2_fase_3">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.indice_carregamento"), "id" => ""])@endcomponent'
                html +='                </div>'
                html +='            </div>'
                html +='        </div>'
                
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