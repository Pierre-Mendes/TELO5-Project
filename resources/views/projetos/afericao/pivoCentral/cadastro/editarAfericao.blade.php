@extends('_layouts._layout_site')
@include('_layouts._includes._head')

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">
            {{-- TITULO E SUBTITULO --}}
            <div class="col-6">
                <h1>@lang('afericao.afericao')</h1><br>
                <h4 style="margin-top: -20px">@lang('comum.editar')</h4>
            </div>
            {{-- BOTOES SALVAR E VOLTAR --}}
            <div class="col-6 text-right botoes">
                <a href="{{ route('gauging_status', $id_afericao) }}" style="color: #3c8dbc" data-toggle="tooltip"
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
    <div class="formafericao">
        {{-- NAVTAB'S --}}
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="iGerais-tab" data-toggle="tab" href="#iGerais" role="tab"
                    aria-controls="iGerais" aria-selected="true">@lang('afericao.informacoes_gerais')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="consideracoes-tab" data-toggle="tab" href="#consideracoes" role="tab"
                    aria-controls="consideracoes" aria-selected="false">@lang('afericao.consideracoes')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pAerea-tab" data-toggle="tab" href="#pAerea" role="tab" aria-controls="pAerea"
                    aria-selected="false">@lang('afericao.parte_aerea')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pivoConjugado-tab" data-toggle="tab" href="#pivoConjugado" role="tab"
                    aria-controls="pivoConjugado" aria-selected="false">@lang('afericao.pivoConjugado')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="canhaoFinal-tab" data-toggle="tab" href="#canhaoFinal" role="tab"
                    aria-controls="canhaoFinal" aria-selected="false">@lang('afericao.canhaoFinal')</a>
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
        <form action="{{ route('gauging_update') }}" method="post" id="formdados">
            @csrf
            <input type="hidden" value="PUT" name="_method">
            <input type="hidden" name="id_afericao" value="{{ $entrada['id_afericao'] }}">
            <input type="hidden" name="id_usuario" value="{{ $entrada['id_usuario'] }}">
            <input type="hidden" name="botao" value="sair" id="botao">
            <div class="tab-content mt-5" id="myTabContent">
                @include('_layouts._includes._alert')

                {{-- INFORMAÇÕES GERAIS --}}
                <div class="tab-pane fade show active" id="iGerais" role="tabpanel" aria-labelledby="iGerais-tab">
                    <div class="col-md-12 formpivocentral" id="cssPreloader">
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="data_afericao">@lang('afericao.dataAfericao')</label>
                                <input type="date" id="data_afericao" class="form-control" name="data_afericao"
                                    maxlength="50" required value="{{ $entrada->data_afericao }}" />
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="marca_modelo_pivo">@lang('afericao.marcaModeloPivo')</label>
                                <select class='form-control' required='true' id="fabricante" name='marca_modelo_pivo'>
                                    @foreach ($pivos as $item)
                                        <option value="{{ $item->id }}" @if (isset($item->id)) selected @endif>{{ $item->resumo }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="giro_equipamento">@lang('afericao.giroEquipamento')  @lang('unidadesAcoes.(graus)')</label>
                                <input type="number" id="giro_equipamento" class="form-control" name="giro_equipamento"
                                    maxlength="30" required value="{{ $entrada->giro_equipamento }}" />
                            </div>
                        </div>

                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="tempo_funcionamento">@lang('afericao.tempoFuncionamento')</label>
                                <input type="number" id="tempo_funcionamento" class="form-control"
                                    name="tempo_funcionamento" maxlength="30" required
                                    value="{{ $entrada->tempo_funcionamento }}" />
                            </div>

                            <div class="form-group col-md-4 telo5ce">
                                <label for="nome_pivo">@lang('afericao.nomePivo')</label>
                                <input type="text" id="nome_pivo" class="form-control" name="nome_pivo" maxlength="30"
                                    required value="{{ $entrada->nome_pivo }}" />
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="tipo_painel">@lang('afericao.tipoPainel')</label>
                                <input type="text" id="tipo_painel" class="form-control" name="tipo_painel" maxlength="30"
                                    required value="{{ $entrada->tipo_painel }}" />
                            </div>
                        </div>

                        <div class="form-row justify-content-start ">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="horimetro">@lang('afericao.horimetro')</label>
                                <input type="number" id="horimetro" class="form-control" name="horimetro" maxlength="30"
                                    required value="{{ $entrada->horimetro }}" />
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="ano_montagem">@lang('afericao.anoMontagem')</label>
                                <input type="number" id="ano_montagem" class="form-control" name="ano_montagem"
                                    maxlength="4" required value="{{ $entrada->ano_montagem }}" />
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="lamina_anual">@lang('afericao.laminaAnual') @lang('unidadesAcoes.(mm)')</label>
                                <input type="number" id="lamina_anual" class="form-control" name="lamina_anual"
                                    maxlength="30" required value="{{ $entrada->lamina_anual }}" />
                            </div>
                        </div>

                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="custo_medio">@lang('afericao.custoMedio') @lang('unidadesAcoes.($/kWh)')/@lang('unidadesAcoes.($/L)')</label>
                                <input type="number" id="custo_medio" class="form-control" name="custo_medio" maxlength="30"
                                    required value="{{$entrada['custo_medio']}}" />
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CONSIDERAÇÕES --}}
                <div class="tab-pane fade" id="consideracoes" role="tabpanel" aria-labelledby="consideracoes-tab">
                    <div class="col-md-12">
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="torreCentral">@lang('afericao.torreCentral')</label><br>
                                <select class="form-control" name="problema_torre_central[]" id="">
                                    <option value="1" {{ $entrada->problema_torre_central == '1' ? 'selected' : '' }}>
                                        @lang('afericao.problema1')</option>
                                    <option value="2" {{ $entrada->problema_torre_central == '2' ? 'selected' : '' }}>
                                        @lang('afericao.problema2')</option>
                                    <option value="3" {{ $entrada->problema_torre_central == '3' ? 'selected' : '' }}>
                                        @lang('afericao.problema3')</option>
                                    <option value="4" {{ $entrada->problema_torre_central == '4' ? 'selected' : '' }}>
                                        @lang('afericao.problema4')</option>
                                    <option value="5" {{ $entrada->problema_torre_central == '5' ? 'selected' : '' }}>
                                        @lang('afericao.problema5')</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4 telo5ce">
                                <label for="valvulaPSI">@lang('afericao.valvulaPSI')</label><br>
                                <select class="form-control" name="problema_valvula_psi[]" id="">
                                    <option value="6" {{ $entrada->problema_valvula_psi == '6' ? 'selected' : '' }}>
                                        @lang('afericao.problema6')</option>
                                    <option value="7" {{ $entrada->problema_valvula_psi == '7' ? 'selected' : '' }}>
                                        @lang('afericao.problema7')</option>
                                    <option value="8" {{ $entrada->problema_valvula_psi == '8' ? 'selected' : '' }}>
                                        @lang('afericao.problema8')</option>
                                    <option value="9" {{ $entrada->problema_valvula_psi == '9' ? 'selected' : '' }}>
                                        @lang('afericao.problema9')</option>
                                    <option value="10" {{ $entrada->problema_valvula_psi == '10' ? 'selected' : '' }}>
                                        @lang('afericao.problema10')</option>
                                    <option value="11" {{ $entrada->problema_valvula_psi == '11' ? 'selected' : '' }}>
                                        @lang('afericao.problema11')</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4 telo5ce">
                                <label for="parteAerea">@lang('afericao.parteAerea')</label><br>
                                <select class="form-control" name="problema_parte_aerea[]" id="">
                                    <option value="12" {{ $entrada->problema_parte_aerea == '12' ? 'selected' : '' }}>
                                        @lang('afericao.problema12')</option>
                                    <option value="13" {{ $entrada->problema_parte_aerea == '13' ? 'selected' : '' }}>
                                        @lang('afericao.problema13')</option>
                                    <option value="14" {{ $entrada->problema_parte_aerea == '14' ? 'selected' : '' }}>
                                        @lang('afericao.problema14')</option>
                                    <option value="15" {{ $entrada->problema_parte_aerea == '15' ? 'selected' : '' }}>
                                        @lang('afericao.problema15')</option>
                                    <option value="16" {{ $entrada->problema_parte_aerea == '16' ? 'selected' : '' }}>
                                        @lang('afericao.problema16')</option>
                                    <option value="17" {{ $entrada->problema_parte_aerea == '17' ? 'selected' : '' }}>
                                        @lang('afericao.problema17')</option>
                                    <option value="18" {{ $entrada->problema_parte_aerea == '18' ? 'selected' : '' }}>
                                        @lang('afericao.problema18')</option>
                                    <option value="19" {{ $entrada->problema_parte_aerea == '19' ? 'selected' : '' }}>
                                        @lang('afericao.problema19')</option>
                                    <option value="20" {{ $entrada->problema_parte_aerea == '20' ? 'selected' : '' }}>
                                        @lang('afericao.problema20')</option>
                                    <option value="21" {{ $entrada->problema_parte_aerea == '21' ? 'selected' : '' }}>
                                        @lang('afericao.problema21')</option>
                                    <option value="22" {{ $entrada->problema_parte_aerea == '22' ? 'selected' : '' }}>
                                        @lang('afericao.problema22')</option>
                                    <option value="23" {{ $entrada->problema_parte_aerea == '23' ? 'selected' : '' }}>
                                        @lang('afericao.problema23')</option>
                                    <option value="24" {{ $entrada->problema_parte_aerea == '24' ? 'selected' : '' }}>
                                        @lang('afericao.problema24')</option>
                                    <option value="25" {{ $entrada->problema_parte_aerea == '25' ? 'selected' : '' }}>
                                        @lang('afericao.problema25')</option>
                                    <option value="26" {{ $entrada->problema_parte_aerea == '26' ? 'selected' : '' }}>
                                        @lang('afericao.problema26')</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="canhaoFinal">@lang('afericao.canhaoFinal')</label><br>
                                <select class="form-control" name="problema_canhao_final[]" id="">
                                    <option value="27" {{ $entrada->problema_canhao_final == '27' ? 'selected' : '' }}>
                                        @lang('afericao.problema27')</option>
                                    <option value="28" {{ $entrada->problema_canhao_final == '28' ? 'selected' : '' }}>
                                        @lang('afericao.problema28')</option>
                                    <option value="29" {{ $entrada->problema_canhao_final == '29' ? 'selected' : '' }}>
                                        @lang('afericao.problema29')</option>
                                    <option value="30" {{ $entrada->problema_canhao_final == '30' ? 'selected' : '' }}>
                                        @lang('afericao.problema30')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="casaBomba">@lang('afericao.casaBomba')</label><br>
                                <select class="form-control" name="problema_casa_bomba[]" id="">
                                    <option value="31" {{ $entrada->problema_casa_bomba == '31' ? 'selected' : '' }}>
                                        @lang('afericao.problema30')</option>
                                    <option value="32" {{ $entrada->problema_casa_bomba == '32' ? 'selected' : '' }}>
                                        @lang('afericao.problema31')</option>
                                    <option value="33" {{ $entrada->problema_casa_bomba == '33' ? 'selected' : '' }}>
                                        @lang('afericao.problema32')</option>
                                    <option value="34" {{ $entrada->problema_casa_bomba == '34' ? 'selected' : '' }}>
                                        @lang('afericao.problema33')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="adutora">@lang('afericao.adutora')</label><br>
                                <select class="form-control" name="problema_adutora[]" id="">
                                    <option value="35" {{ $entrada->problema_adutora == '35' ? 'selected' : '' }}>
                                        @lang('afericao.problema35')</option>
                                    <option value="36" {{ $entrada->problema_adutora == '36' ? 'selected' : '' }}>
                                        @lang('afericao.problema36')</option>
                                    <option value="37" {{ $entrada->problema_adutora == '37' ? 'selected' : '' }}>
                                        @lang('afericao.problema37')</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="problema_chave_partida">@lang('afericao.chavePartida')</label><br>
                                <select class="form-control" name="problema_chave_partida[]">
                                    <option value="38" {{ $entrada->problema_chave_partida == '38' ? 'selected' : '' }}>
                                        @lang('afericao.problema38')</option>
                                    <option value="39" {{ $entrada->problema_chave_partida == '39' ? 'selected' : '' }}>
                                        @lang('afericao.problema39')</option>
                                    <option value="40" {{ $entrada->problema_chave_partida == '40' ? 'selected' : '' }}>
                                        @lang('afericao.problema40')</option>
                                    <option value="41" {{ $entrada->problema_chave_partida == '41' ? 'selected' : '' }}>
                                        @lang('afericao.problema41')</option>
                                    <option value="42" {{ $entrada->problema_chave_partida == '42' ? 'selected' : '' }}>
                                        @lang('afericao.problema42')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="succao">@lang('afericao.succao')</label><br>
                                <select class="form-control" name="problema_succao[]" id="">
                                    <option value="43" {{ $entrada->problema_succao == '43' ? 'selected' : '' }}>
                                        @lang('afericao.problema43')</option>
                                    <option value="44" {{ $entrada->problema_succao == '44' ? 'selected' : '' }}>
                                        @lang('afericao.problema44')</option>
                                    <option value="45" {{ $entrada->problema_succao == '45' ? 'selected' : '' }}>
                                        @lang('afericao.problema45')</option>
                                    <option value="46" {{ $entrada->problema_succao == '46' ? 'selected' : '' }}>
                                        @lang('afericao.problema46')</option>
                                    <option value="47" {{ $entrada->problema_succao == '47' ? 'selected' : '' }}>
                                        @lang('afericao.problema47')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="motorPrincipal">@lang('afericao.motorPrincipal')</label><br>
                                <select class="form-control" name="problema_motor_principal[]" id="">
                                    <option value="48"
                                        {{ $entrada->problema_motor_principal == '48' ? 'selected' : '' }}>
                                        @lang('afericao.problema48')</option>
                                    <option value="49"
                                        {{ $entrada->problema_motor_principal == '49' ? 'selected' : '' }}>
                                        @lang('afericao.problema49')</option>
                                    <option value="50"
                                        {{ $entrada->problema_motor_principal == '50' ? 'selected' : '' }}>
                                        @lang('afericao.problema50')</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="bombaPrincipal">@lang('afericao.bombaPrincipal')</label><br>
                                <select class="form-control" name="problema_bomba_principal[]" id="">
                                    <option value="51"
                                        {{ $entrada->problema_bomba_principal == '51' ? 'selected' : '' }}>
                                        @lang('afericao.problema51')</option>
                                    <option value="52"
                                        {{ $entrada->problema_bomba_principal == '52' ? 'selected' : '' }}>
                                        @lang('afericao.problema52')</option>
                                    <option value="53"
                                        {{ $entrada->problema_bomba_principal == '53' ? 'selected' : '' }}>
                                        @lang('afericao.problema53')</option>
                                    <option value="54"
                                        {{ $entrada->problema_bomba_principal == '54' ? 'selected' : '' }}>
                                        @lang('afericao.problema54')</option>
                                    <option value="55"
                                        {{ $entrada->problema_bomba_principal == '55' ? 'selected' : '' }}>
                                        @lang('afericao.problema55')</option>
                                    <option value="56"
                                        {{ $entrada->problema_bomba_principal == '56' ? 'selected' : '' }}>
                                        @lang('afericao.problema56')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="motorAuxiliar">@lang('afericao.motorAuxiliar')</label><br>
                                <select class="form-control" name="problema_motor_auxiliar[]" id="">
                                    <option value="57" {{ $entrada->problema_motor_auxiliar == '57' ? 'selected' : '' }}>
                                        @lang('afericao.problema57')</option>
                                    <option value="58" {{ $entrada->problema_motor_auxiliar == '58' ? 'selected' : '' }}>
                                        @lang('afericao.problema58')</option>
                                    <option value="59" {{ $entrada->problema_motor_auxiliar == '59' ? 'selected' : '' }}>
                                        @lang('afericao.problema59')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="bombaAuxiliar">@lang('afericao.bombaAuxiliar')</label><br>
                                <select class="form-control" name="problema_bomba_auxiliar[]" id="">
                                    <option value="60" {{ $entrada->problema_bomba_auxiliar == '60' ? 'selected' : '' }}>
                                        @lang('afericao.problema60')</option>
                                    <option value="61" {{ $entrada->problema_bomba_auxiliar == '61' ? 'selected' : '' }}>
                                        @lang('afericao.problema61')</option>
                                    <option value="62" {{ $entrada->problema_bomba_auxiliar == '62' ? 'selected' : '' }}>
                                        @lang('afericao.problema62')</option>
                                    <option value="63" {{ $entrada->problema_bomba_auxiliar == '63' ? 'selected' : '' }}>
                                        @lang('afericao.problema63')</option>
                                    <option value="64" {{ $entrada->problema_bomba_auxiliar == '64' ? 'selected' : '' }}>
                                        @lang('afericao.problema64')</option>
                                    <option value="65" {{ $entrada->problema_bomba_auxiliar == '65' ? 'selected' : '' }}>
                                        @lang('afericao.problema65')</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- PARTE AÉREA --}}
                <div class="tab-pane fade" id="pAerea" role="tabpanel" aria-labelledby="pAerea-tab">
                    <div class="col-md-12">
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-3 telo5ce">
                                <label for="marca_modelo_emissores">@lang('afericao.marcaModeloEmissores')</label><br>
                                <select class='form-control' required='true' name='marca_modelo_emissores'>
                                    <option value='I-WOB UP3'
                                        {{ $entrada->marca_modelo_emissores == 'I-WOB UP3' ? 'selected' : '' }}>
                                        @lang('afericao.i-wob-up3')</option>
                                    <option value='Fabrimar'
                                        {{ $entrada->marca_modelo_emissores == 'Fabrimar' ? 'selected' : '' }}>
                                        @lang('afericao.fabrimar')</option>
                                    <option value='Nelson'
                                        {{ $entrada->marca_modelo_emissores == 'Nelson' ? 'selected' : '' }}>
                                        @lang('afericao.nelson')</option>
                                    <option value='Super Spray - UP3'
                                        {{ $entrada->marca_modelo_emissores == 'Super Spray - UP3' ? 'selected' : '' }}>
                                        @lang('afericao.super-spray-up3')</option>
                                    <option value='Super Spray'
                                        {{ $entrada->marca_modelo_emissores == 'Super Spray' ? 'selected' : '' }}>
                                        @lang('afericao.super-spray')</option>
                                    <option value='I-WOB'
                                        {{ $entrada->marca_modelo_emissores == 'I-WOB' ? 'selected' : '' }}>
                                        @lang('afericao.i-wob')</option>
                                    <option value='Trash Buster'
                                        {{ $entrada->marca_modelo_emissores == 'Trash Buster' ? 'selected' : '' }}>
                                        @lang('afericao.trash-buster')</option>
                                    <option value='Komet'
                                        {{ $entrada->marca_modelo_emissores == 'Komet' ? 'selected' : '' }}>
                                        @lang('afericao.komet')</option>
                                    <option value='Fan Spray'
                                        {{ $entrada->marca_modelo_emissores == 'Fan Spray' ? 'selected' : '' }}>
                                        @lang('afericao.fan-spray')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                <label for="rodado">@lang('afericao.rodado')</label><br>
                                <select class='form-control' required='true' name='rodado'>
                                    <option value='12.4 x 24' {{ $entrada->rodado == '12.4 x 24' ? 'selected' : '' }}>
                                        <b>12.4 x 24</b>
                                    </option>
                                    <option value='12.4 x 28' {{ $entrada->rodado == '12.4 x 28' ? 'selected' : '' }}>
                                        <b>12.4 x 28</b>
                                    </option>
                                    <option value='12.4 x 38' {{ $entrada->rodado == '12.4 x 38' ? 'selected' : '' }}>
                                        <b>12.4 x 38</b>
                                    </option>
                                    <option value='14.9 x 24' {{ $entrada->rodado == '14.9 x 24' ? 'selected' : '' }}>
                                        <b>14.9 x 24</b>
                                    </option>
                                    <option value='14.9 x 28' {{ $entrada->rodado == '14.9 x 28' ? 'selected' : '' }}>
                                        <b>14.9 x 28</b>
                                    </option>
                                    <option value='16.9 x 28' {{ $entrada->rodado == '16.9 x 28' ? 'selected' : '' }}>
                                        <b>16.9 x 28</b>
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                <label for="revestimento">@lang('afericao.revestimento')</label><br>
                                <select class='form-control' required='true' name='revestimento'>
                                    <option value='Zincagem'
                                        {{ $entrada->revestimento == 'Zincagem' ? 'selected' : '' }}>
                                        @lang('afericao.zincagem')</option>
                                    <option value='Politetileno'
                                        {{ $entrada->revestimento == 'Politetileno' ? 'selected' : '' }}>
                                        @lang('afericao.politetileno')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                <label for="pendural">@lang('afericao.pendural')</label><br>
                                <select class='form-control' name='pendural'>
                                    <option value="flexivel" {{ $entrada->pendural == 'flexivel' ? 'selected' : '' }}>
                                        <b>@lang('afericao.flexivel')</b>
                                    </option>
                                    <option value="pvc" {{ $entrada->pendural == 'pvc' ? 'selected' : '' }}>
                                        <b>@lang('afericao.pvc')</b>
                                    </option>
                                    <option value="az" {{ $entrada->pendural == 'az' ? 'selected' : '' }}>
                                        <b>@lang('afericao.az')</b>
                                    </option>
                                    <option value="sem pendural"
                                        {{ $entrada->pendural == 'sem pendural' ? 'selected' : '' }}>
                                        <b>@lang('afericao.semPendural')</b>
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-3 telo5ce">
                                <label for="altura_pivo">@lang('afericao.alturaPivo')</label><br>
                                <select class='form-control' required='true' name='altura_pivo' required>
                                    <option value='2.74' {{ $entrada->pendural == '2.74' ? 'selected' : '' }}>
                                        <b>2,74</b>
                                    </option>
                                    <option value='3.75' {{ $entrada->pendural == '3.75' ? 'selected' : '' }}>
                                        <b>3,75</b>
                                    </option>
                                    <option value='4.6' {{ $entrada->pendural == '4.6' ? 'selected' : '' }}><b>4,6</b>
                                    </option>
                                    <option value='5.5' {{ $entrada->pendural == '5.5' ? 'selected' : '' }}><b>5,5</b>
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                <label for="valv_reguladoras">@lang('afericao.valvulaReguladora')</label><br>
                                <select class='form-control' required='true' name='valv_reguladoras' required>
                                    <option value='10' {{ $entrada->valv_reguladoras == '10' ? 'selected' : '' }}><b>10
                                            PSI</b></option>
                                    <option value='15' {{ $entrada->valv_reguladoras == '15' ? 'selected' : '' }}><b>15
                                            PSI</b></option>
                                    <option value='20' {{ $entrada->valv_reguladoras == '20' ? 'selected' : '' }}><b>20
                                            PSI</b></option>
                                    <option value='25' {{ $entrada->valv_reguladoras == '25' ? 'selected' : '' }}><b>25
                                            PSI</b></option>
                                    <option value='30' {{ $entrada->valv_reguladoras == '30' ? 'selected' : '' }}><b>30
                                            PSI</b></option>
                                    <option value='35' {{ $entrada->valv_reguladoras == '35' ? 'selected' : '' }}><b>35
                                            PSI</b></option>
                                    <option value='40' {{ $entrada->valv_reguladoras == '40' ? 'selected' : '' }}><b>40
                                            PSI</b></option>
                                    <option value='45' {{ $entrada->valv_reguladoras == '45' ? 'selected' : '' }}><b>45
                                            PSI</b></option>
                                    <option value='50' {{ $entrada->valv_reguladoras == '50' ? 'selected' : '' }}><b>50
                                            PSI</b></option>
                                    <option hidden value='0'><b>Ausente</b></option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                <label for="defletor">@lang('afericao.defletor')</label><br>
                                <input name='defletor' class='form-control' id="defletor" required
                                    value="{{ $entrada->defletor }}" />
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                <label for="altura_emissores">@lang('afericao.alturaEmissores') @lang('unidadesAcoes.(m)')</label><br>
                                <input name='altura_emissores' step=0.01 id="altura_emissores" type="number"
                                    class='form-control' required value="{{ $entrada->altura_emissores }}" />
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-3 telo5ce">
                                <label for="pressao_centro">@lang('afericao.pressaoCentro') @lang('unidadesAcoes.(mca)')</label><br>
                                <input type="number" step=0.001 min=0.001 class="form-control" name="pressao_centro"
                                    required id="pressao_centro" value="{{ $entrada->pressao_centro }}">
                            </div>

                            <div class="form-group col-md-3 telo5ce">
                                <label for="pressao_ponta">@lang('afericao.pressaoPonta') @lang('unidadesAcoes.(mca)')</label><br>
                                <input type="number" step=0.001 min=0.001 class="form-control" name="pressao_ponta" required
                                    id="pressao_ponta" value="{{ $entrada->pressao_ponta }}">
                            </div>

                            <div class="form-group col-md-3 telo5ce">
                                <label for="rugosidade">@lang('afericao.coeficienteRugosidade')</label><br>
                                <input type="number" number min=1 class="form-control" min=0.001 name="rugosidade" required
                                    id="rugosidade" value="{{ $entrada->rugosidade }}">
                            </div>

                            <div class="form-group col-md-3 telo5ce">
                                <label for="altitude_centro">@lang('afericao.altitudeCentro') @lang('unidadesAcoes.(m)')</label><br>
                                <input type="number" class="form-control" name="altitude_centro" required
                                    id="altitude_centro" value="{{ $entrada->altitude_centro }}">
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-3 telo5ce">
                                <label for="altitude_mais_alto">@lang('afericao.altitudeMaisAlto') @lang('unidadesAcoes.(m)')</label><br>
                                <input type="number" class="form-control" name="altitude_mais_alto" required
                                    id="altitude_mais_alto" value="{{ $entrada->altitude_mais_alto }}">
                            </div>

                            <div class="form-group col-md-3 telo5ce">
                                <label for="altitude_mais_baixo">@lang('afericao.altitudeMaisBaixo') @lang('unidadesAcoes.(m)')</label><br>
                                <input type="number" class="form-control" name="altitude_mais_baixo"
                                    id="altitude_mais_baixo" value="{{ $entrada->altitude_mais_baixo }}">
                            </div>

                            <div class="form-group col-md-3 telo5ce">
                                <label for="latitude">@lang('afericao.latitude')</label><br>
                                <input type="number" step=0.000001 class="form-control" name="latitude" required
                                    id="latitude" value="{{ $entrada->latitude }}">
                            </div>

                            <div class="form-group col-md-3 telo5ce">
                                <label for="longitude">@lang('afericao.longitude')</label><br>
                                <input type="number" step=0.000001 class="form-control" name="longitude" required
                                    id="longitude" value="{{ $entrada->longitude }}">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- PIVÔ CONJUGADO --}}
                <div class="tab-pane fade" id="pivoConjugado" role="tabpanel" aria-labelledby="pivoConjugado-tab">
                    <div class="col-md-12">
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-1 telo5ce">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" @if(!empty($entrada['area_pivo_01'])) checked @endif name="possui_pivo_conjugado" id="customSwitch1">
                                    <label class="custom-control-label" for="customSwitch1"  style="font-size: 1.2rem">@lang('afericao.possuiPivoConjugado')</label>  
                                </div>
                            </div>
                            <div class="form-group col-2 telo5ce">
                                <label for="combinedArea">@lang('afericao.combinedArea')</label><br>
                                <input class="font-weight-bold" type="number" id="combinedArea" name="combinedArea" step="0.01" min="0.01" disabled style="background: none !important;" value=""/>
                            </div>
                            <div class="form-group col-2 telo5ce">
                                <label for="calcDepthArea">@lang('afericao.depthArea')</label><br>
                                <input class="font-weight-bold" type="number" id="calcDepthArea" name="calcDepthArea" step="0.01" min="0.01" disabled style="background: none !important;" value=""/>
                            </div>
                            <div>
                                <button type="button" class="btn btn-primary text-center voltar pr-4" name="conjugatedDepthArea" data-toggle="tooltip" data-placement="bottom" title="@lang('afericao.depthConjugatedArea')" style="font-size: 13;" id="conjugatedDepthArea">
                                <i class="fas fa-calculator pr-2"></i>@lang('comum.calc')
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-3 telo5ce">
                                @component('_layouts._components._inputLabel', [ 'texto' => __('afericao.areaPivo') . ' 01 (ha)', 'id' => 'area1', ])@endcomponent
                                <input type="number" step=0.0001 name='area_pivo_01' id="area1" class='form-control' value="{{ $entrada->area_pivo_01 }}"/>
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                @component('_layouts._components._inputLabel', [ 'texto' => __('afericao.areaPivo') . ' 02 (ha)', 'id' => 'area2', ])@endcomponent
                                <input type="number" step=0.0001 name='area_pivo_02' id="area2" class='form-control' value="{{ $entrada->area_pivo_02 }}" />
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                @component('_layouts._components._inputLabel', ['texto' => __('afericao.areaPivo') . ' 03 (ha)', 'id' => 'area3'])@endcomponent
                                <input type="number" step=0.0001 name='area_pivo_03' id="area3" class='form-control' value="{{ $entrada->area_pivo_03 }}"  />
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                @component('_layouts._components._inputLabel', ['texto' => __('afericao.areaPivo') . ' 04 (ha)', 'id' => 'area4'])@endcomponent
                                <input type="number" step=0.0001 name='area_pivo_04' id="area4" class='form-control' value="{{ $entrada->area_pivo_04 }}"  />
                            </div>
                        </div>


                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-3 telo5ce">
                                @component('_layouts._components._inputLabel', [ 'texto' =>  __('afericao.vazaoPivo') . ' 01 (m³/h)', 'id' => 'vazao1', ])@endcomponent
                                <input type="number" step=0.0001 name='vazao_pivo_01' id="vazao1" class='form-control' value="{{ $entrada->vazao_pivo_01 }}" />
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                @component('_layouts._components._inputLabel', [ 'texto' => __('afericao.vazaoPivo') . ' 02 (m³/h)', 'id' => 'vazao2', ])@endcomponent
                                <input type="number" step=0.0001 name='vazao_pivo_02' id="vazao2" class='form-control' value="{{ $entrada->vazao_pivo_02 }}" />
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                @component('_layouts._components._inputLabel', [ 'texto' =>  __('afericao.vazaoPivo') . ' 03 (m³/h)', 'id' => 'vazao3',])@endcomponent
                                <input type="number" step=0.0001 name='vazao_pivo_03' id="vazao3" class='form-control' value="{{ $entrada->vazao_pivo_03 }}"  />
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                @component('_layouts._components._inputLabel', [ 'texto' => __('afericao.vazaoPivo') . ' 04 (m³/h)', 'id' => 'vazao4', ])@endcomponent
                                <input type="number" step=0.0001 name='vazao_pivo_04' id="vazao4" class='form-control' value="{{ $entrada->vazao_pivo_04 }}"  />
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CANHÃO FINAL --}}
                <div class="tab-pane fade" id="canhaoFinal" role="tabpanel" aria-labelledby="canhaoFinal-tab">
                    <div class="col-md-12">
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-3 telo5ce">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" @if(!empty($entrada['vazao_canhao_final'])) checked @endif name="possui_canhao_final" id="customSwitch2" onchange="mostraCanhaoFinal()">
                                <label class="custom-control-label" for="customSwitch2"  style="font-size: 1.2rem">@lang('afericao.possuiCanhaoFinal')</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-row justify-content-center">
                            <div class='form-group col-md-4 telo5ce'>
                                @component('_layouts._components._inputLabel', ['texto' => __('afericao.marca'), 'id' =>
                                'marca'])@endcomponent
                                <input name='marca_canhao_final' class='form-control' id="marca" value="{{ $entrada->marca_canhao_final }}" />
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                @component('_layouts._components._inputLabel', ['texto' => __('afericao.potencia') .
                                __('unidadesAcoes.(cv)'), 'id' => 'potencia_final'])@endcomponent
                                <input type="number" id="potencia_canhao" step=0.01 name='potencia_canhao_final'
                                    id="potencia_final" class='form-control'  value="{{ $entrada->potencia_canhao_final }}"/>
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                @component('_layouts._components._inputLabel', ['texto' => __('afericao.vazao'), 'id' =>
                                'vazao_canhao_final'])@endcomponent
                                <input type="number" id="vazao_canhao" step=0.01 name='vazao_canhao_final'
                                    id="vazao_canhao_final" class='form-control' value="{{ $entrada['vazao_canhao_final'] }}" />
                            </div>
                        </div>
                        <div class="form-row justify-content-center">
                            <div class='form-group col-md-4 telo5ce'>
                                @component('_layouts._components._inputLabel', ['texto' => __('afericao.modelo'), 'id' =>
                                'modelo_canhao'])@endcomponent
                                <input name='modelo_canhao_final' id="modelo_canhao" class='form-control' value="{{ $entrada->modelo_canhao_final }}" />
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                @component('_layouts._components._inputLabel', ['texto' => __('afericao.bomba'), 'id' =>
                                'bomba_canhao'])@endcomponent
                                <input name='bomba_canhao_final' class='form-control' id="bomba_canhao" value="{{ $entrada->bomba_canhao_final }}" />
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                @component('_layouts._components._inputLabel', ['texto' => __('afericao.bocais'), 'id' =>
                                'bocais_canhao_final'])@endcomponent
                                <input type="number" id="bocais_canhao" step=1 name='bocais_canhao_final'
                                    id="bocais_canhao_final" class='form-control' value="{{ $entrada->bocais_canhao_final }}" />
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class='form-group col-md-4 telo5ce'>
                                @component('_layouts._components._inputLabel', ['texto' => __('afericao.alcanceCanhao'),
                                'id' => 'alcance_canhao'])@endcomponent
                                <input id='alcance_canhao' type="number" step=0.01 name='alcance_canhao_final'
                                    class='form-control' value="{{ $entrada->alcance_canhao_final }}" />
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                @component('_layouts._components._inputLabel', ['texto' => __('afericao.motor'), 'id' =>
                                'motor_canhao'])@endcomponent
                                <input name='motor_canhao_final' id="motor_canhao" class='form-control' value="{{ $entrada->motor_canhao_final }}" />
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                <label for="valv_reguladora_canhao_final">@lang('afericao.valvulaReguladora')</label>
                                <select class='form-control' name='valv_reguladora_canhao_final'>
                                    <option value='10'><b>{{ $entrada->valv_reguladora_canhao_final == '10' ? '10 PSI' : '' }}</b></option>
                                    <option value='15'><b>{{ $entrada->valv_reguladora_canhao_final == '15' ? '15 PSI' : '' }}</b></option>
                                    <option value='20'><b>{{ $entrada->valv_reguladora_canhao_final == '20' ? '20 PSI' : '' }}</b></option>
                                    <option value='25'><b>{{ $entrada->valv_reguladora_canhao_final == '25' ? '25 PSI' : '' }}</b></option>
                                    <option value='30'><b>{{ $entrada->valv_reguladora_canhao_final == '30' ? '30 PSI' : '' }}</b></option>
                                    <option value='35'><b>{{ $entrada->valv_reguladora_canhao_final == '35' ? '35 PSI' : '' }}</b></option>
                                    <option value='40'><b>{{ $entrada->valv_reguladora_canhao_final == '40' ? '40 PSI' : '' }}</b></option>
                                    <option value='45'><b>{{ $entrada->valv_reguladora_canhao_final == '45' ? '45 PSI' : '' }}</b></option>
                                    <option value='50'><b>{{ $entrada->valv_reguladora_canhao_final == '50' ? '50 PSI' : '' }}</b></option>
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

    {{-- FILTRO SELECT --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
    integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    
    {{-- SALVAR E VALIDAR CAMPOS VAZIOS --}}
    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
    <script>
        $(document).ready(function() {
            habilitaDesabilitaPivo(true);
            habilitaDesabilitaCanhao(true);

            $('#botaosalvar').on('click', function() {
                $('#formdados').submit();
            });

            $("#formdados").validate({
                rules: {
                    "data_afericao": {
                        required: true
                    },
                    "marca_modelo_pivo": {
                        required: true
                    },
                    "giro_equipamento": {
                        required: true
                    },
                    "tempo_funcionamento": {
                        required: true
                    },
                    "nome_pivo": {
                        required: true
                    },
                    "tipo_painel": {
                        required: true
                    },
                    "horimetro": {
                        required: true
                    },
                    "ano_montagem": {
                        required: true
                    },
                    "lamina_anual": {
                        required: true
                    },
                    "custo_medio": {
                        required: true
                    },
                    "numero_lances": {
                        required: true
                    },
                    "defletor": {
                        required: true
                    },
                    "altura_emissores": {
                        required: true
                    },
                    "pressao_centro": {
                        required: true
                    },
                    "pressao_ponta": {
                        required: true
                    },
                    "rugosidade": {
                        required: true
                    },
                    "altitude_centro": {
                        required: true
                    },
                    "altitude_mais_alto": {
                        required: true
                    },
                    "altitude_mais_baixo": {
                        required: true
                    },
                    "latitude": {
                        required: true
                    },
                    "longitude": {
                        required: true
                    }
                },
                messages: {
                    data_afericao: "@lang('validate.validate')",

                    "marca_modelo_pivo": {
                        required: "@lang('validate.validate')"
                    },
                    "giro_equipamento": {
                        required: "@lang('validate.validate')"
                    },
                    "tempo_funcionamento": {
                        required: "@lang('validate.validate')"
                    },
                    "nome_pivo": {
                        required: "@lang('validate.validate')"
                    },
                    "tipo_painel": {
                        required: "@lang('validate.validate')"
                    },
                    "horimetro": {
                        required: "@lang('validate.validate')"
                    },
                    "ano_montagem": {
                        required: "@lang('validate.validate')"
                    },
                    "lamina_anual": {
                        required: "@lang('validate.validate')",
                    },
                    "custo_medio": {
                        required: "@lang('validate.validate')"
                    },
                    "numero_lances": {
                        required: "@lang('validate.validate')"
                    },
                    "defletor": {
                        required: "@lang('validate.validate')"
                    },
                    "altura_emissores": {
                        required: "@lang('validate.validate')"
                    },
                    "pressao_centro": {
                        required: "@lang('validate.validate')"
                    },
                    "pressao_ponta": {
                        required: "@lang('validate.validate')"
                    },
                    "rugosidade": {
                        required: "@lang('validate.validate')"
                    },
                    "altitude_centro": {
                        required: "@lang('validate.validate')"
                    },
                    "altitude_mais_alto": {
                        required: "@lang('validate.validate')"
                    },
                    "altitude_mais_baixo": {
                        required: "@lang('validate.validate')"
                    },
                    "latitude": {
                        required: "@lang('validate.validate')"
                    },
                    "longitude": {
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

            $('#conjugatedDepthArea').on('click', function(event) {
                event.preventDefault();

                var area_pivo_1 = $("#area1").val();
                var area_pivo_2 = $("#area2").val();
                var area_pivo_3 = $("#area3").val();
                var area_pivo_4 = $("#area4").val();

                var vazao_pivo_1 = $("#vazao1").val();
                var vazao_pivo_2 = $("#vazao2").val();
                var vazao_pivo_3 = $("#vazao3").val();
                var vazao_pivo_4 = $("#vazao4").val();

                var IsEmpty = false;
                var AllEmpty = 0;
                var vetArea = [area_pivo_1, area_pivo_2, area_pivo_3, area_pivo_4];
                var vetVazao = [vazao_pivo_1, vazao_pivo_2, vazao_pivo_3, vazao_pivo_4];

                for (let index = 0; index < vetArea.length; index++) {
                    if (((vetArea[index] == "0" || vetArea[index] === "") && 
                         (vetVazao[index] != "0" && vetVazao[index] !== "")) 
                         ||
                        ((vetVazao[index] == "0" || vetVazao[index] === "") && 
                         (vetArea[index] != "0" && vetArea[index] !== "")) 
                       ){
                    IsEmpty = true;
                    break;
                    } else if ((vetArea[index] == "0" || vetArea[index] === "") && (vetVazao[index] == "0" || vetVazao[index] === ""))  {
                        AllEmpty += 1;
                    }
                }


                if (IsEmpty) {
                    alert('@lang("comum.checkInput")');
                } else if (AllEmpty == 4) {
                    alert('Para realizar o cálculo é necessário pelo menos uma área e uma vazão.')
                }
                 else {
                    var combinedArea = {
                    _token: "{{ csrf_token() }}"
                    , area_pivo_1: area_pivo_1
                    , area_pivo_2: area_pivo_2
                    , area_pivo_3: area_pivo_3
                    , area_pivo_4: area_pivo_4
                    , };

                    var depthArea = {
                    _token: "{{ csrf_token() }}"
                    , area_pivo_1: area_pivo_1
                    , area_pivo_2: area_pivo_2
                    , area_pivo_3: area_pivo_3
                    , area_pivo_4: area_pivo_4,

                    vazao_pivo_1: vazao_pivo_1
                    , vazao_pivo_2: vazao_pivo_2
                    , vazao_pivo_3: vazao_pivo_3
                    , vazao_pivo_4: vazao_pivo_4
                    , };

                    $.ajax({
                        url: "{{ route('gaugingCalc_totalAreaConjugated') }}" ,
                        type: "post", 
                        data: combinedArea, 
                        dataType: 'json', 
                        }).done(function(res) {
                        console.log(res);
                        combinedArea = res;
                        return $('input[name = "combinedArea"]').val(combinedArea);
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        console.log("Error: " + textStatus);
                    });

                    $.ajax({
                        url: "{{ route('gaugingCalc_depthArea') }}"
                        , type: "post"
                        , data: depthArea
                        , dataType: 'json'
                        , }).done(function(res) {
                        console.log(res);
                        depthArea = res;
                        return $('input[name = "calcDepthArea"]').val(depthArea);
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        console.log("Error: " + textStatus);
                    });
                }
            });

            // Enable/Disable Checkbox "Pivo Conjugado"
            $('#customSwitch1').click(function() {
                if ($(this).prop("checked") == false) {
                    habilitaDesabilitaPivo(true);
                } else if ($(this).prop("checked") == true) {
                    habilitaDesabilitaPivo(false);
                }
                });

                function habilitaDesabilitaPivo(flag) {
                $("#area1").prop("disabled", flag);
                $("#area2").prop("disabled", flag);
                $("#area3").prop("disabled", flag);
                $("#area4").prop("disabled", flag);

                $("#vazao1").prop("disabled", flag);
                $("#vazao2").prop("disabled", flag);
                $("#vazao3").prop("disabled", flag);
                $("#vazao4").prop("disabled", flag);

                $("#calcCombinedArea").prop("disabled", flag);
                $("#calcDepthTotalArea").prop("disabled", flag);
            }

            //Enable/Disable Checkbox "Canhão final"
            $('#customSwitch2').click(function() {
              if ($(this).prop("checked") == false) {
                habilitaDesabilitaCanhao(true);
              } else if ($(this).prop("checked") == true) {
                habilitaDesabilitaCanhao(false);
              }
            });

            function habilitaDesabilitaCanhao(flag) {
              $("#marca").prop("disabled", flag);
              $("#modelo_canhao").prop("disabled", flag);
              $("#bomba_canhao").prop("disabled", flag);
              $("#bocais_canhao").prop("disabled", flag);
              $("#potencia_canhao").prop("disabled", flag);
              $("#vazao_canhao").prop("disabled", flag);
              $("#bocais_canhao").prop("disabled", flag);
            }
            $(window).on('load', function() {
                $("#coverScreen").hide();
            });
        });

    </script>
@endsection
