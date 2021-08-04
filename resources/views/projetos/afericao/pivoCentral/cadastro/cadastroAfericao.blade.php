@extends('_layouts._layout_site')
@include('_layouts._includes._head')

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">
            {{-- TITULO E SUBTITULO --}}
            <div class="col-6">
                <h1>@lang('afericao.afericao')</h1><br>
                <h4 style="margin-top: -20px">@lang('comum.cadastrar')</h4>
            </div>
            {{-- BOTOES SALVAR E VOLTAR --}}
            <div class="col-6 text-right botoes mobile">
                <a href="{{ route('gauging_manager') }}" style="color: #3c8dbc" data-toggle="tooltip"
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
                    aria-controls="consideracoes" aria-selected="false">@lang('afericao.consideracoes')
                </a>
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
        <form action="{{ route('gauging_save') }}" method="post" id="formdados">
            @csrf
            <div class="tab-content small.required tab-validate mt-5" id="myTabContent">
                @include('_layouts._includes._alert')
                {{-- INFORMAÇÕES GERAIS --}}
                <div class="tab-pane fade show active" id="iGerais" role="tabpanel" aria-labelledby="iGerais-tab">
                    <input type="hidden" name="id_fazenda" value="{{ $fazenda->id }}">
                    <div class="col-md-12 formpivocentral" id="cssPreloader">
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="data_afericao">@lang('afericao.dataAfericao')</label>
                                <input type="date" id="data_afericao" class="form-control" name="data_afericao" maxlength="50" required />
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                <label for="marca_modelo_pivo">@lang('afericao.marcaModeloPivo')</label>
                                <select class='form-control' required='true' id="fabricante" name='marca_modelo_pivo'>
                                    @foreach ($pivos as $item)
                                        <option value=""></option>
                                        <option value="{{ $item->id }}">{{ $item->resumo }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="giro_equipamento">@lang('afericao.giroEquipamento') @lang('unidadesAcoes.(graus)')</label>
                                <input type="number" id="giro_equipamento" class="form-control" name="giro_equipamento" min="0" max="360"
                                    maxlength="30" required /> 
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="tempo_funcionamento">@lang('afericao.tempoFuncionamento')</label>
                                <input type="number" id="tempo_funcionamento" class="form-control"
                                    name="tempo_funcionamento" maxlength="30" required />
                            </div>

                            <div class="form-group col-md-4 telo5ce">
                                <label for="nome_pivo">@lang('afericao.nomePivo')</label>
                                <input type="text" id="nome_pivo" class="form-control" name="nome_pivo" maxlength="30"
                                    required />
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="tipo_painel">@lang('afericao.tipoPainel')</label>
                                <input type="text" id="tipo_painel" class="form-control" name="tipo_painel" maxlength="30"
                                    required />
                            </div>
                        </div>

                        <div class="form-row justify-content-center ">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="horimetro">@lang('afericao.horimetro')</label>
                                <input type="number" id="horimetro" class="form-control" name="horimetro" maxlength="30"
                                    required />
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="ano_montagem">@lang('afericao.anoMontagem')</label>
                                <select name="ano_montagem" id="">
                                    @for ($i = date("Y"); $i > 2010; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="lamina_anual">@lang('afericao.laminaAnual')  @lang('unidadesAcoes.(mm)')</label>
                                <input type="number" id="lamina_anual" class="form-control" name="lamina_anual"
                                    maxlength="30" required />
                            </div>
                        </div>

                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="custo_medio">@lang('afericao.custoMedio') @lang('unidadesAcoes.($/kWh)')/@lang('unidadesAcoes.($/L)')</label>
                                <input type="number" id="custo_medio" class="form-control" name="custo_medio" maxlength="30"
                                    required />
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="numero_lances">@lang('afericao.numeroLances')</label>
                                <input type="number" id="numero_lances" class="form-control" name="numero_lances"
                                    maxlength="30" required />
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="tem_balanco">@lang('afericao.possuiBalanco') </label>
                                <select name="tem_balanco" class='form-control'>
                                    <option value="sim" selected>@lang('comum.sim')</option>
                                    <option value="nao">@lang('comum.nao')</option>
                                </select>
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
                                <select class='form-control' name="problema_torre_central[]" id="">
                                    <option value=""></option>
                                    <option value="1">@lang('afericao.problema1')</option>
                                    <option value="2">@lang('afericao.problema2')</option>
                                    <option value="3">@lang('afericao.problema3')</option>
                                    <option value="4">@lang('afericao.problema4')</option>
                                    <option value="5">@lang('afericao.problema5')</option>
                                    <option value="66">@lang('afericao.problema66')</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4 telo5ce">
                                <label for="valvulaPSI">@lang('afericao.valvulaPSI')</label><br>
                                <select class='form-control' name="problema_valvula_psi[]" id="">
                                    <option value=""></option>
                                    <option value=""></option>
                                    <option value="6">@lang('afericao.problema6')</option>
                                    <option value="7">@lang('afericao.problema7')</option>
                                    <option value="8">@lang('afericao.problema8')</option>
                                    <option value="9">@lang('afericao.problema9')</option>
                                    <option value="10">@lang('afericao.problema10')</option>
                                    <option value="11">@lang('afericao.problema11')</option>
                                    <option value="67">@lang('afericao.problema66')</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4 telo5ce">
                                <label for="parteAerea">@lang('afericao.parteAerea')</label><br>
                                <select class='form-control' name="problema_parte_aerea[]" id="">
                                    <option value=""></option>
                                    <option value="12">@lang('afericao.problema12')</option>
                                    <option value="13">@lang('afericao.problema13')</option>
                                    <option value="14">@lang('afericao.problema14')</option>
                                    <option value="15">@lang('afericao.problema15')</option>
                                    <option value="16">@lang('afericao.problema16')</option>
                                    <option value="17">@lang('afericao.problema17')</option>
                                    <option value="18">@lang('afericao.problema18')</option>
                                    <option value="19">@lang('afericao.problema19')</option>
                                    <option value="20">@lang('afericao.problema20')</option>
                                    <option value="21">@lang('afericao.problema21')</option>
                                    <option value="22">@lang('afericao.problema22')</option>
                                    <option value="23">@lang('afericao.problema23')</option>
                                    <option value="24">@lang('afericao.problema24')</option>
                                    <option value="25">@lang('afericao.problema25')</option>
                                    <option value="26">@lang('afericao.problema26')</option>
                                    <option value="68">@lang('afericao.problema66')</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="canhaoFinal">@lang('afericao.canhaoFinal')</label><br>
                                <select class='form-control' name="problema_canhao_final[]" id="">
                                    <option value=""></option>
                                    <option value="27">@lang('afericao.problema27')</option>
                                    <option value="28">@lang('afericao.problema28')</option>
                                    <option value="29">@lang('afericao.problema29')</option>
                                    <option value="30">@lang('afericao.problema30')</option>
                                    <option value="69">@lang('afericao.problema66')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="casaBomba">@lang('afericao.casaBomba')</label><br>
                                <select class='form-control' name="problema_casa_bomba[]" id="">
                                    <option value=""></option>
                                    <option value="31">@lang('afericao.problema30')</option>
                                    <option value="32">@lang('afericao.problema31')</option>
                                    <option value="33">@lang('afericao.problema32')</option>
                                    <option value="34">@lang('afericao.problema33')</option>
                                    <option value="70">@lang('afericao.problema66')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="adutora">@lang('afericao.adutora')</label><br>
                                <select class='form-control' name="problema_adutora[]" id="">
                                    <option value=""></option>
                                    <option value="35">@lang('afericao.problema35')</option>
                                    <option value="36">@lang('afericao.problema36')</option>
                                    <option value="37">@lang('afericao.problema37')</option>
                                    <option value="71">@lang('afericao.problema66')</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class='form-group col-md-4 telo5ce'>
                                <label for="problema_chave_partida">@lang('afericao.chavePartida')</label><br>
                                <select class='form-control' name="problema_chave_partida[]">
                                    <option value=""></option>
                                    <option value="38">@lang('afericao.problema38')</option>
                                    <option value="39">@lang('afericao.problema39')</option>
                                    <option value="40">@lang('afericao.problema40')</option>
                                    <option value="41">@lang('afericao.problema41')</option>
                                    <option value="42">@lang('afericao.problema42')</option>
                                    <option value="72">@lang('afericao.problema66')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="succao">@lang('afericao.succao')</label><br>
                                <select class='form-control' name="problema_succao[]" id="">
                                    <option value=""></option>
                                    <option value="43">@lang('afericao.problema43')</option>
                                    <option value="44">@lang('afericao.problema44')</option>
                                    <option value="45">@lang('afericao.problema45')</option>
                                    <option value="46">@lang('afericao.problema46')</option>
                                    <option value="47">@lang('afericao.problema47')</option>
                                    <option value="73">@lang('afericao.problema66')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="motorPrincipal">@lang('afericao.motorPrincipal')</label><br>
                                <select class='form-control' name="problema_motor_principal[]" id="">
                                    <option value=""></option>
                                    <option value="48">@lang('afericao.problema48')</option>
                                    <option value="49">@lang('afericao.problema49')</option>
                                    <option value="50">@lang('afericao.problema50')</option>
                                    <option value="74">@lang('afericao.problema66')</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="bombaPrincipal">@lang('afericao.bombaPrincipal')</label><br>
                                <select class='form-control' name="problema_bomba_principal[]" id="">
                                    <option value=""></option>
                                    <option value="51">@lang('afericao.problema51')</option>
                                    <option value="52">@lang('afericao.problema52')</option>
                                    <option value="53">@lang('afericao.problema53')</option>
                                    <option value="54">@lang('afericao.problema54')</option>
                                    <option value="55">@lang('afericao.problema55')</option>
                                    <option value="56">@lang('afericao.problema56')</option>
                                    <option value="75">@lang('afericao.problema66')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="motorAuxiliar">@lang('afericao.motorAuxiliar')</label><br>
                                <select class='form-control' name="problema_motor_auxiliar[]" id="">
                                    <option value=""></option>
                                    <option value="57">@lang('afericao.problema57')</option>
                                    <option value="58">@lang('afericao.problema58')</option>
                                    <option value="59">@lang('afericao.problema59')</option>
                                    <option value="76">@lang('afericao.problema66')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="bombaAuxiliar">@lang('afericao.bombaAuxiliar')</label><br>
                                <select class='form-control' name="problema_bomba_auxiliar[]" id="">
                                    <option value=""></option>
                                    <option value="60">@lang('afericao.problema60')</option>
                                    <option value="61">@lang('afericao.problema61')</option>
                                    <option value="62">@lang('afericao.problema62')</option>
                                    <option value="63">@lang('afericao.problema63')</option>
                                    <option value="64">@lang('afericao.problema64')</option>
                                    <option value="65">@lang('afericao.problema65')</option>
                                    <option value="77">@lang('afericao.problema66')</option>
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
                                        <option value=""></option>
                                    <option value='I-WOB UP3'>@lang('afericao.i-wob-up3')</option>
                                    <option value='Fabrimar'><b>@lang('afericao.fabrimar')</b></option>
                                    <option value='Nelson'><b>@lang('afericao.nelson')</b></option>
                                    <option value='Super Spray - UP3'><b>@lang('afericao.super-spray-up3')</b></option>
                                    <option value='Super Spray'><b>@lang('afericao.super-spray')</b></option>
                                    <option value='I-WOB'><b>@lang('afericao.i-wob')</b></option>
                                    <option value='Trash Buster'><b>@lang('afericao.trash-buster')</b></option>
                                    <option value='Komet'><b>@lang('afericao.komet')</b></option>
                                    <option value='Fan Spray'><b>@lang('afericao.fan-spray')</b></option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                <label for="rodado">@lang('afericao.rodado')</label><br>
                                <select class='form-control' required='true' name='rodado'>
                                        <option value=""></option>
                                    <option value='12.4 x 24'><b>12.4 x 24</b></option>
                                    <option value='12.4 x 28'><b>12.4 x 28</b></option>
                                    <option value='12.4 x 38'><b>12.4 x 38</b></option>
                                    <option value='14.9 x 24'><b>14.9 x 24</b></option>
                                    <option value='14.9 x 28'><b>14.9 x 28</b></option>
                                    <option value='16.9 x 28'><b>16.9 x 28</b></option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                <label for="revestimento">@lang('afericao.revestimento')</label><br>
                                <select class='form-control' required='true' name='revestimento'>
                                        <option value=""></option>
                                    <option value='Zincagem'>@lang('afericao.zincagem')</option>
                                    <option value='Politetileno'>@lang('afericao.politetileno')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                <label for="pendural">@lang('afericao.pendural')</label><br>
                                <select class='form-control' name='pendural'>
                                        <option value=""></option>
                                    <option value="flexivel"><b>@lang('afericao.flexivel')</b></option>
                                    <option value="pvc"><b>@lang('afericao.pvc')</b></option>
                                    <option value="az"><b>@lang('afericao.az')</b></option>
                                    <option value="sem pendural"><b>@lang('afericao.semPendural')</b></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-3 telo5ce">
                                <label for="altura_pivo">@lang('afericao.alturaPivo')</label><br>
                                <select class='form-control' required='true' name='altura_pivo' required>
                                        <option value=""></option>
                                    <option value='2.74'><b>2,74</b></option>
                                    <option value='3.75'><b>3,75</b></option>
                                    <option value='4.6'><b>4,6</b></option>
                                    <option value='5.5'><b>5,5</b></option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                <label for="valv_reguladoras">@lang('afericao.valvulaReguladora')</label><br>
                                <select class='form-control' required='true' name='valv_reguladoras' required>
                                        <option value=""></option>
                                    <option value='10'><b>10 PSI</b></option>
                                    <option value='15'><b>15 PSI</b></option>
                                    <option value='20'><b>20 PSI</b></option>
                                    <option value='25'><b>25 PSI</b></option>
                                    <option value='30'><b>30 PSI</b></option>
                                    <option value='35'><b>35 PSI</b></option>
                                    <option value='40'><b>40 PSI</b></option>
                                    <option value='45'><b>45 PSI</b></option>
                                    <option value='50'><b>50 PSI</b></option>
                                    <option hidden value='0'><b>Ausente</b></option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                <label for="defletor">@lang('afericao.defletor')</label><br>
                                <input name='defletor' class='form-control' id="defletor" required />
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                <label for="altura_emissores">@lang('afericao.alturaEmissores') @lang('unidadesAcoes.(m)')</label><br>
                                <input name='altura_emissores' step=0.01 id="altura_emissores" type="number"
                                    class='form-control' required />
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-3 telo5ce">
                                <label for="pressao_centro">@lang('afericao.pressaoCentro') @lang('unidadesAcoes.(mca)')</label><br>
                                <input type="number" step=0.001 min=0.001 class="form-control" name="pressao_centro"
                                    required id="pressao_centro">
                            </div>

                            <div class="form-group col-md-3 telo5ce">
                                <label for="pressao_ponta">@lang('afericao.pressaoPonta') @lang('unidadesAcoes.(mca)')</label><br>
                                <input type="number" step=0.001 min=0.001 class="form-control" name="pressao_ponta" required
                                    id="pressao_ponta">
                            </div>

                            <div class="form-group col-md-3 telo5ce">
                                <label for="rugosidade">@lang('afericao.coeficienteRugosidade')</label><br>
                                <input type="number" number min=1 class="form-control" min=0.001 name="rugosidade" required
                                    id="rugosidade">
                            </div class="form-group col-md-3 telo5ce">

                            <div class="form-group col-md-3 telo5ce">
                                <label for="altitude_centro">@lang('afericao.altitudeCentro') @lang('unidadesAcoes.(m)')</label><br>
                                <input type="number" class="form-control" name="altitude_centro" required
                                    id="altitude_centro">
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-3 telo5ce">
                                <label for="altitude_mais_alto">@lang('afericao.altitudeMaisAlto') @lang('unidadesAcoes.(m)')</label><br>
                                <input type="number" class="form-control" name="altitude_mais_alto" required
                                    id="altitude_mais_alto">
                            </div>

                            <div class="form-group col-md-3 telo5ce">
                                <label for="altitude_mais_baixo">@lang('afericao.altitudeMaisBaixo') @lang('unidadesAcoes.(m)')</label><br>
                                <input type="number" class="form-control" name="altitude_mais_baixo"
                                    id="altitude_mais_baixo">
                            </div>

                            <div class="form-group col-md-3 telo5ce">
                                <label for="latitude">@lang('afericao.latitude')</label><br>
                                <input type="number" step=0.000001 class="form-control" name="latitude" required
                                    id="latitude">
                            </div>

                            <div class="form-group col-md-3 telo5ce">
                                <label for="longitude">@lang('afericao.longitude')</label><br>
                                <input type="number" step=0.000001 class="form-control" name="longitude" required
                                    id="longitude">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- PIVÔ CONJUGADO --}}
                <div class="tab-pane fade" id="pivoConjugado" role="tabpanel" aria-labelledby="pivoConjugado-tab">
                    <div class="col-md-12">
                        <div class="form-row justify-content-start">
                            <div class="form-group col-1 telo5ce">
                                <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="possui_pivo_conjugado" id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1" style="font-size: 1.2rem">@lang('afericao.possuiPivoConjugado')</label>
                                </div>
                            </div>
                            <div class="form-group col-2 telo5ce">
                                <label for="combinedArea">@lang('afericao.combinedArea')</label><br>
                                <input class="font-weight-bold" type="number" id="combinedArea" name="combinedArea" step="0.01" min="0.01" disabled style="background: none !important;" />
                            </div>
                            <div class="form-group col-2 telo5ce">
                                <label for="calcDepthArea">@lang('afericao.depthArea')</label><br>
                                <input class="font-weight-bold" type="number" id="calcDepthArea" name="calcDepthArea" step="0.01" min="0.01" disabled style="background: none !important;" />
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
                                @component('_layouts._components._inputLabel', [ 'texto' => __('afericao.areaPivo') . ' 01 (ha)', 'id' => 'area1',])@endcomponent
                                <input type="number" step=0.0001 name='area_pivo_01' id="area1" class='form-control' />
                            </div>

                            <div class="form-group col-md-3 telo5ce">
                                @component('_layouts._components._inputLabel', [  'texto' => __('afericao.areaPivo') . ' 02 (ha)', 'id' => 'area2', ])@endcomponent
                                <input type="number" step=0.0001 name='area_pivo_02' id="area2" class='form-control' />
                            </div>

                            <div class="form-group col-md-3 telo5ce">
                                @component('_layouts._components._inputLabel', ['texto' => __('afericao.areaPivo') . ' 03 (ha)', 'id' => 'area3'])@endcomponent
                                <input type="number" step=0.0001 name='area_pivo_03' id="area3" class='form-control' />
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                @component('_layouts._components._inputLabel', ['texto' => __('afericao.areaPivo') . ' 04 (ha)', 'id' => 'area4'])@endcomponent
                                <input type="number" step=0.0001 name='area_pivo_04' id="area4" class='form-control' />
                            </div>
                        </div>
                    

                        <div class="form-row justify-content-start">

                            <div class="form-group col-md-3 telo5ce">
                                @component('_layouts._components._inputLabel', [ 'texto' => __('afericao.vazaoPivo') . ' 01 (m³/h)', 'id' => 'vazao1', ])@endcomponent
                                <input type="number" step=0.0001 name='vazao_pivo_01' id="vazao1" class='form-control' />
                            </div>

                            <div class="form-group col-md-3 telo5ce">
                                @component('_layouts._components._inputLabel', [ 'texto' =>  __('afericao.vazaoPivo') . ' 02 (m³/h)', 'id' => 'vazao2', ])@endcomponent
                                <input type="number" step=0.0001 name='vazao_pivo_02' id="vazao2" class='form-control' />
                            </div>

                            <div class="form-group col-md-3 telo5ce">
                                @component('_layouts._components._inputLabel', [ 'texto' => __('afericao.vazaoPivo') . ' 03 (m³/h)', 'id' => 'vazao3', ])@endcomponent
                                <input type="number" step=0.0001 name='vazao_pivo_03' id="vazao3" class='form-control' />
                            </div>

                            <div class="form-group col-md-3 telo5ce">
                                @component('_layouts._components._inputLabel', [ 'texto' => __('afericao.vazaoPivo') . ' 04 (m³/h)', 'id' => 'vazao4', ])@endcomponent
                                <input type="number" step=0.0001 name='vazao_pivo_04' id="vazao4" class='form-control' />
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
                                    <input type="checkbox" class="custom-control-input" name="possui_canhao_final" id="customSwitch2" onchange="mostraCanhaoFinal()">
                                <label class="custom-control-label" for="customSwitch2"  style="font-size: 1.2rem">@lang('afericao.possuiCanhaoFinal')</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-row justify-content-center">
                            <div class='form-group col-md-4 telo5ce'>
                                @component('_layouts._components._inputLabel', ['texto' => __('afericao.marca'), 'id' => 'marca'])@endcomponent
                                <input name='marca_canhao_final' class='form-control' id="marca" />
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                @component('_layouts._components._inputLabel', ['texto' => __('afericao.potencia') .  __('unidadesAcoes.(cv)'), 'id' => 'potencia_final'])@endcomponent
                                <input type="number" id="potencia_canhao" step=0.01 name='potencia_canhao_final'
                                    id="potencia_final" class='form-control' />
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                @component('_layouts._components._inputLabel', ['texto' => __('afericao.vazao'), 'id' => 'vazao_canhao_final'])@endcomponent
                                <input type="number" id="vazao_canhao" step=0.01 name='vazao_canhao_final' id="vazao_canhao_final" class='form-control' />
                            </div>
                        </div>
                        <div class="form-row justify-content-center">
                            <div class='form-group col-md-4 telo5ce'>
                                @component('_layouts._components._inputLabel', ['texto' => __('afericao.modelo'), 'id' =>
                                'modelo_canhao'])@endcomponent
                                <input name='modelo_canhao_final' id="modelo_canhao" class='form-control' />
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                @component('_layouts._components._inputLabel', ['texto' => __('afericao.bomba'), 'id' =>
                                'bomba_canhao'])@endcomponent
                                <input name='bomba_canhao_final' class='form-control' id="bomba_canhao" />
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                @component('_layouts._components._inputLabel', ['texto' => __('afericao.bocais'), 'id' =>
                                'bocais_canhao_final'])@endcomponent
                                <input type="number" id="bocais_canhao" step=1 name='bocais_canhao_final'
                                    id="bocais_canhao_final" class='form-control' />
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class='form-group col-md-4 telo5ce'>
                                @component('_layouts._components._inputLabel', ['texto' => __('afericao.alcanceCanhao'),
                                'id' => 'alcance_canhao'])@endcomponent
                                <input id='alcance_canhao' type="number" step=0.01 name='alcance_canhao_final'
                                    class='form-control' />
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                @component('_layouts._components._inputLabel', ['texto' => __('afericao.motor'), 'id' =>
                                'motor_canhao'])@endcomponent
                                <input name='motor_canhao_final' id="motor_canhao" class='form-control' />
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                <label for="valv_reguladora_canhao_final">@lang('afericao.valvulaReguladora')</label>
                                <select class='form-control' name='valv_reguladora_canhao_final'>
                                    <option value=""></option>
                                    <option value='10'><b>10 PSI</b></option>
                                    <option value='15'><b>15 PSI</b></option>
                                    <option value='20'><b>20 PSI</b></option>
                                    <option value='25'><b>25 PSI</b></option>
                                    <option value='30'><b>30 PSI</b></option>
                                    <option value='35'><b>35 PSI</b></option>
                                    <option value='40'><b>40 PSI</b></option>
                                    <option value='45'><b>45 PSI</b></option>
                                    <option value='50'><b>50 PSI</b></option>
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

            // VALIDATE
            $("#formdados").validate({
                ignore: "",
                invalidHandler: function() {
                    setTimeout(function() {
                        $('.nav-tabs a small.required').remove();
                        var validatePane = $(
                            '.tab-content.tab-validate .tab-pane:has(input.error)').each(
                            function() {
                                var id = $(this).attr('id');
                                $('.nav-tabs').find('a[href^="#' + id + '"]').append(
                                    ' <small class="required">&#9888;&#65039;</small>');
                            });
                    });
                },
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
                var vetArea = [area_pivo_1, area_pivo_2, area_pivo_3, area_pivo_4];
                var vetVazao = [vazao_pivo_1, vazao_pivo_2, vazao_pivo_3, vazao_pivo_4];

                for (let index = 0; index < vetArea.length; index++) {
                    if ((vetArea[index] == "" || vetArea[index] === "") && (vetVazao[index] == "" || vetVazao[index] === "")) {
                    IsEmpty = true;
                    break;
                    }
                }

                if (IsEmpty) {
                    alert("@lang('comum.checkInput')");
                } else {
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
                    url: "{{ route('gaugingCalc_totalAreaConjugated') }}"
                    , type: "post"
                    , data: combinedArea
                    , dataType: 'json'
                    , }).done(function(res) {
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
