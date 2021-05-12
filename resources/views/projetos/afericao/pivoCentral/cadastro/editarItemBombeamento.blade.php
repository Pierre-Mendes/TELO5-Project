@extends('_layouts._layout_site')

@section('titulo')
@lang('afericao.editarBombeamento')
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
    </div>
@endsection

@section('conteudo')
<div class="formafericao">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        @foreach ($bombeamentos as $key => $bombeamento)
            <li class="nav-item">
                <a class="nav-link {{ ($key + 1) == 1 ? 'active' : '' }}" id="iGerais-tab" data-toggle="tab" href="#bomba_{{ ($key + 1) }}" role="tab"
                    aria-controls="bomba_{{ ($key + 1) }}" aria-selected="true">Editar bomba {{ ($key + 1) }}</a>
            </li>
        @endforeach
    </ul>


<form action="{{route('editaItemBombeamento')}}" method="POST" id="formdados">
    @csrf
    <input type="hidden" name="id_afericao" value="{{$id_afericao}}">
    <input type="hidden" name="id_bombeamento" value="{{$id_bombeamento}}">
    <div class="tab-content mt-5" id="myTabContent">
        @foreach ($bombeamentos as $key => $bombeamento)
            <div class="tab-pane fade {{ ($key + 1) == 1 ? 'show active' : '' }}" id="bomba_{{ ($key + 1) }}"
                role="tabpanel" aria-labelledby="bomba_{{ ($key + 1) }}">
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
                                <input type="number" step="0.001" value="{{$bombeamento['corrente_leitura_1_fase_1']}}" class="form-control" required   onchange="calcularCarregamentoExistente({{$key+1}})" id="corrente_leitura_1_fase_1{{$key+1}}"  name="corrente_leitura_1_fase_1[]">
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
    {{-- <div class="text-center">
        <button type="submit" name="botao" value="salvar" onclick="mostrarTodasDivs()" id="btnSalvarBombeamento" class="voltar"> @lang('unidadesAcoes.salvar')</button>
        <button type="submit" name="botao" value="sair" onclick="mostrarTodasDivs()" id="btnSair" class="voltar"> @lang('unidadesAcoes.salvarSair')</button>
        <button  class="proximo"><a id="" href="{{route('status_afericao', $id_afericao)}}" style="color: #fff;"> @lang('unidadesAcoes.voltar')</a></button>
    </div> --}}
</form>
@endsection

@section('scripts')

<script type="text/javascript">

    $(document).ready(function() {
        $('#botaosalvar').on('click', function() {
            $('#formdados').submit();
        });
    });

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
                html += '       </h4> ';
                html += '   </div>';

                // Cria apenas o primeiro bloco de bomba aberto.
                if (i == 1){
                html += '   <div class="col-md-12 row collapse show" id="control_bomba_'+i+'" aria-labelledby="headingBomba_'+i+'" data-parent="#DivBombas">';
                }
                // Demais blocos, fechados.
                else{
                html += '   <div class="col-md-12 row collapse" id="control_bomba_'+i+'" aria-labelledby="headingBomba_'+i+'" data-parent="#DivBombas">';
                }
                html += '      <div class="col-md-3 form-group telo5ce">';
                html += '          <input type="number" step="0.01" id="comprimento_succao_'+i+'" class="form-control" required name="comprimento_succao[]" onchange="validaCampo(this.value, this.id)">';
                html += '          @component("_layouts._components._inputLabel", ["texto"=>__("afericao.comprimentoSuccao") . __("unidadesAcoes.(m)"), "id" => ""])@endcomponent';
                html += '      </div>';

                html += '      <div class="col-md-3 form-group telo5ce">';
                html += '          <input type="number" step="0.001" id="diametro_succao_'+i+'" class="form-control" required name="diametro_succao[]" onchange="validaCampo(this.value, this.id)">';
                html += '          @component("_layouts._components._inputLabel", ["texto"=>__("afericao.diametroSuccao")   . __("unidadesAcoes.(m)") , "id" => ""])@endcomponent';
                html += '      </div>';

                html += '      <div class="col-md-3 form-group telo5ce">';
                html += '          <input type="text" class="form-control" required name="marca[]" id="marca_'+i+'" onchange="validaCampo(this.value, this.id)">';
                html += '          @component("_layouts._components._inputLabel", ["texto"=>__("afericao.marca"), "id" => ""])@endcomponent';
                html += '      </div>';

                html += '      <div class="col-md-3 form-group telo5ce">';
                html += '          <input type="text" class="form-control" required name="modelo[]" id="modelo_'+i+'" onchange="validaCampo(this.value, this.id)">';
                html += '          @component("_layouts._components._inputLabel", ["texto"=>__("afericao.modelo"), "id" => ""])@endcomponent';
                html += '      </div>';

                html += '      <div class="col-md-3 form-group telo5ce">';
                html += '          <input type="number" class="form-control" required name="numero_rotores[]" id="numero_rotores_'+i+'" onchange="validaCampo(this.value, this.id)">';
                html += '          @component("_layouts._components._inputLabel", ["texto"=>__("afericao.numeroRotores"), "id" => ""])@endcomponent';
                html += '      </div>';

                html += '      <div class="col-md-3 form-group telo5ce">';
                html += '          <input type="number" step="0.01" class="form-control" required name="diametro_rotor[]" id="diametro_rotor_'+i+'" onchange="validaCampo(this.value, this.id)">';
                html += '          @component("_layouts._components._inputLabel", ["texto"=>__("afericao.diametroRotor") . __("unidadesAcoes.(mm)"), "id" => ""])@endcomponent';
                html += '      </div>';

                html += '       <div class="col-md-3 form-group telo5ce">';
                html += '           <label for="mat_succao">@lang("afericao.materialSuccao")</label>';
                html += '           <select name="material_succao[]"  class="form-control" id="mat_succao_'+i+'">';
                html += '               <option value="0">@lang("afericao.acoSac")</option>';
                html += '               <option value="1">@lang("afericao.AZ")</option>';
                html += '               <option value="2">@lang("afericao.PVC")</option>';
                html += '               <option value="3">@lang("afericao.RPVC")</option>';
                html += '           </select>';
                html += '           <div class="line"></div>';
                html += '       </div>';

                html += '       <div class="col-md-3 form-group telo5ce">';
                html += '           <input type="number" step="0.01" class="form-control" required name="rendimento_bomba[]" id="rendimento_bomba_'+i+'" onchange="validaCampo(this.value, this.id)">';
                html += '           @component("_layouts._components._inputLabel", ["texto"=>__("afericao.rendimentoBomba"). __("unidadesAcoes.(%)") , "id" => ""])@endcomponent';
                html += '       </div>';

                html += '       <div class="col-md-3 form-group telo5ce">';
                html += '           <input type="number" step="0.01" class="form-control" required name="shutoff[]" id="shutoff_'+i+'" onchange="validaCampo(this.value, this.id)">';
                html += '           @component("_layouts._components._inputLabel", ["texto"=>__("afericao.shutoff") . __("unidadesAcoes.(mca)"), "id" => ""])@endcomponent';
                html += '       </div>';

                html += '       <div class="col-md-3 form-group telo5ce">';
                html += '           <input type="number" class="form-control" required name="rotacao[]" id="rotacao_'+i+'" onchange="validaCampo(this.value, this.id)">';
                html += '           @component("_layouts._components._inputLabel", ["texto"=>__("afericao.rotacao") . __("unidadesAcoes.(rpm)"), "id" => ""])@endcomponent';
                html += '       </div>';

                html += '       <div class="col-md-3 form-group telo5ce">';
                html += '           <input type="number" step="0.01" class="form-control" required name="pressao_bomba[]" id="pressao_bomba_'+i+'" onchange="validaCampo(this.value, this.id)">';
                html += '           @component("_layouts._components._inputLabel", ["texto"=>__("afericao.pressaoBomba").__("unidadesAcoes.(mca)") , "id" => ""])@endcomponent';
                html += '       </div>';

                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                ////////////////////////////////////////////////////////////////////////// MOTOR //////////////////////////////////////////////////////////////////////////////////////////////
                html += '       <div class="col-12">';
                html += '           <h4>@lang("afericao.motor") '+i+'</h4>';
                html += '           ';
                html += '       </div>';

                html += '       <div class="col-md-3 form-group telo5ce">';
                html += '           <label for="tipo_motor">@lang("afericao.tipo_motor")</label>';
                html += '           <select onchange="configKeyStarter('+i+')" name="tipo_motor[]"  class="form-control" id="tipo_motor_'+i+'">';
                html += '               <option value="diesel">@lang("afericao.diesel")</option>';
                html += '               <option value="eletrico">@lang("afericao.eletrico")</option>';
                html += '           </select>';
                html += '           <div class="line"></div>';
                html += '       </div>';

                html += '       <div class="col-md-3 form-group telo5ce">';
                html += '           <input type="text" class="form-control" required name="modelo_motor[]" id="modelo_motor_'+i+'" onchange="validaCampo(this.value, this.id)">';
                html += '           @component("_layouts._components._inputLabel", ["texto"=>__("afericao.modelo"), "id" => ""])@endcomponent';
                html += '       </div>';

                html += '       <div class="col-md-3 form-group telo5ce">'
                html += '           <input type="number" step="0.01" class="form-control" required name="potencia[]" id="potencia_'+i+'" onchange="validaCampo(this.value, this.id)">'
                html += '           @component("_layouts._components._inputLabel", ["texto"=>__("afericao.potencia").__("unidadesAcoes.(cv)"), "id" => ""])@endcomponent'
                html += '       </div>'

                html += '       <div class="col-md-3 form-group telo5ce">'
                html += '           <input type="number" class="form-control" required name="numero_motores[]" id="numero_motores_'+i+'" onchange="validaCampo(this.value, this.id)">'
                html += '           @component("_layouts._components._inputLabel", ["texto"=>__("afericao.numeroMotores"), "id" => ""])@endcomponent'
                html += '       </div>'

                html += '       <div class="col-md-3 form-group telo5ce" id="divChavePartida_'+i+'" style="display: none">'
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

                html += '       <div class="col-md-3 form-group telo5ce">'
                html += '           <input type="number" step="0.01" step="0.01" class="form-control" required name="fator_servico[]" id="fator_servico_'+i+'" onchange="validaCampo(this.value, this.id)">'
                html += '           @component("_layouts._components._inputLabel", ["texto"=>__("afericao.fatorServico"), "id" => ""])@endcomponent'
                html += '       </div>'

                html += '       <div class="col-md-3 form-group telo5ce" id="div_corrente_nominal_'+i+'">'
                html += '       <input type="number" step="0.01" class="form-control" id="corrente_nominal_'+i+'" name="corrente_nominal[]" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                html += '       @component("_layouts._components._inputLabel", ["texto"=>__("afericao.correnteNominal").__("unidadesAcoes.(a)"), "id" => ""])@endcomponent'
                html += '       </div>'

                html += '       <div class="col-md-3 form-group telo5ce">'
                html += '           <input type="number" step="0.01" class="form-control" required name="rendimento[]" id="rendimento_'+i+'" onchange="validaCampo(this.value, this.id)">'
                html += '           @component("_layouts._components._inputLabel", ["texto"=>__("afericao.rendimento"), "id" => ""])@endcomponent'
                html += '       </div>'

                html += '       <div class="col-md-3 form-group telo5ce" id="div_tensao_nominal_'+i+'">'
                html += '           <label for="tensao_nominal">@lang("afericao.tensaoNominal")</label>'
                html += '           <select name="tensao_nominal[]" onchange="calcularCarregamento('+i+')"  class="form-control" id="tensao_nominal_'+i+'">'
                html += '               <option value="220">220V</option>'
                html += '               <option value="380">380V</option>'
                html += '               <option value="440">440V</option>'
                html += '           </select>'
                html += '           <div class="line"></div>'
                html += '       </div>'

                html += '       <div class="col-md-3 form-group telo5ce" id="div_frequencia_'+i+'">'
                html += '           <input type="number" value="60" class="form-control has-value" required name="frequencia[]" id="frequencia_'+i+'" onchange="validaCampo(this.value, this.id)">'
                html += '           @component("_layouts._components._inputLabel", ["texto"=>__("afericao.frequencia"), "id" => ""])@endcomponent'
                html += '       </div>'

                html +='        <div class="col-md-12 row" id="div_leituras_'+i+'">'
                html +='            <div class="col-md-12 row">'
                html +='                <h3 class="col-12 text-center">@lang("afericao.leitura1")  </h3>'

                html +='                <h4 class="col-12">@lang("afericao.corrente")</h4>'

                html +='                <div class="col-md-4 form-group telo5ce">'
                html +='                    <input type="number" step="0.01" class="form-control" id="bomba_'+i+'_corrente_leitura_1_fase_1"  name="corrente_leitura_1_fase_1[]" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.fase1") . __("unidadesAcoes.(a)") , "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group telo5ce">'
                html +='                    <input type="number" step="0.01" class="form-control" id="bomba_'+i+'_corrente_leitura_1_fase_2"  name="corrente_leitura_1_fase_2[]" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.fase2") . __("unidadesAcoes.(a)"), "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group telo5ce">'
                html +='                    <input type="number" step="0.01" class="form-control" id="bomba_'+i+'_corrente_leitura_1_fase_3"  name="corrente_leitura_1_fase_3[]" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.fase3") . __("unidadesAcoes.(a)"), "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <h4 class="col-12 ">@lang("afericao.tensao")</h4>'

                html +='                <div class="col-md-4 form-group telo5ce">'
                html +='                    <input type="number" step="0.01" class="form-control" name="tensao_leitura_1_fase_1[]" id="bomba_'+i+'_tensao_leitura_1_fase_1" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.fase1")  . __("unidadesAcoes.(v)") , "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group telo5ce">'
                html +='                    <input type="number" step="0.01" class="form-control" name="tensao_leitura_1_fase_2[]" id="bomba_'+i+'_tensao_leitura_1_fase_2" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.fase2")  . __("unidadesAcoes.(v)") , "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group telo5ce">'
                html +='                    <input type="number" step="0.01" class="form-control" name="tensao_leitura_1_fase_3[]" id="bomba_'+i+'_tensao_leitura_1_fase_3" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.fase3")  . __("unidadesAcoes.(v)") , "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group telo5ce">'
                html +='                    <input type="number" step="0.01" class="form-control has-value" value="0" readonly  id="bomba_'+i+'_indice_carregamento_leitura_1_fase_1" onchange="validaCampo(this.value, this.id)">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.indice_carregamento"), "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group telo5ce">'
                html +='                    <input type="number" step="0.01" class="form-control has-value" value="0" readonly id="bomba_'+i+'_indice_carregamento_leitura_1_fase_2" onchange="validaCampo(this.value, this.id)">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.indice_carregamento"), "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group telo5ce">'
                html +='                    <input type="number" step="0.01" class="form-control has-value" value="0" readonly id="bomba_'+i+'_indice_carregamento_leitura_1_fase_3" onchange="validaCampo(this.value, this.id)">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.indice_carregamento"), "id" => ""])@endcomponent'
                html +='                </div>'
                html +='            </div>'

                html +='            <div class="col-md-12 row">'
                html +='                <h3 class="col-12 text-center">@lang("afericao.leitura2")  </h3>'

                html +='                <h4 class="col-12">@lang("afericao.corrente")</h4>'

                html +='                <div class="col-md-4 form-group telo5ce">'
                html +='                    <input type="number" step="0.01" class="form-control" id="bomba_'+i+'_corrente_leitura_2_fase_1"   name="corrente_leitura_2_fase_1[]" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.fase1") . __("unidadesAcoes.(a)") , "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group telo5ce">'
                html +='                    <input type="number" step="0.01" class="form-control" id="bomba_'+i+'_corrente_leitura_2_fase_2"  name="corrente_leitura_2_fase_2[]" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.fase2") . __("unidadesAcoes.(a)") , "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group telo5ce">'
                html +='                    <input type="number" step="0.01" class="form-control" id="bomba_'+i+'_corrente_leitura_2_fase_3"  name="corrente_leitura_2_fase_3[]" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.fase3") . __("unidadesAcoes.(a)") , "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <h4 class="col-12 ">@lang("afericao.tensao")</h4>'

                html +='                <div class="col-md-4 form-group telo5ce">'
                html +='                    <input type="number" step="0.01" class="form-control" name="tensao_leitura_2_fase_1[]" id="bomba_'+i+'_tensao_leitura_2_fase_1" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.fase1")  . __("unidadesAcoes.(v)") , "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group telo5ce">'
                html +='                    <input type="number" step="0.01" class="form-control" name="tensao_leitura_2_fase_2[]" id="bomba_'+i+'_tensao_leitura_2_fase_2" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.fase2")  . __("unidadesAcoes.(v)") , "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group telo5ce">'
                html +='                    <input type="number" step="0.01" class="form-control" name="tensao_leitura_2_fase_3[]" id="bomba_'+i+'_tensao_leitura_2_fase_3" onchange="calcularCarregamento('+i+'); validaCampo(this.value, this.id);">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.fase3")  . __("unidadesAcoes.(v)") , "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group telo5ce">'
                html +='                    <input type="number" step="0.01" class="form-control has-value" readonly value="0"  id="bomba_'+i+'_indice_carregamento_leitura_2_fase_1">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.indice_carregamento"), "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group telo5ce">'
                html +='                    <input type="number" step="0.01" class="form-control has-value" readonly value="0"  id="bomba_'+i+'_indice_carregamento_leitura_2_fase_2">'
                html +='                    @component("_layouts._components._inputLabel", ["texto"=>__("afericao.indice_carregamento"), "id" => ""])@endcomponent'
                html +='                </div>'

                html +='                <div class="col-md-4 form-group telo5ce">'
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
