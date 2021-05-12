@extends('_layouts._layout_site')
@include('_layouts._includes._head')

@section('head')
@endsection

@section('titulo')
    @lang('afericao.pivoCentral')
@endsection

@section('topo_detalhe')

<div class="container-fluid topo">
    <div class="row align-items-start">

        {{-- TITULO E SUBTITULO --}}
        <div class="col-6">
            <h1>@lang('afericao.pivoCentral')</h1>
        </div>

        {{-- BOTOES SALVAR E VOLTAR --}}
        <div class="col-6 text-right botoes position">
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
            <li class="nav-item">
                <a class="nav-link active" id="iGerais-tab" data-toggle="tab" href="#iGerais" role="tab"
                    aria-controls="iGerais" aria-selected="true">Informações Gerais</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="consideracoes-tab" data-toggle="tab" href="#consideracoes" role="tab"
                    aria-controls="consideracoes" aria-selected="false">Considerações</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pAerea-tab" data-toggle="tab" href="#pAerea" role="tab" aria-controls="pAerea"
                    aria-selected="false">Parte Aérea</a>
            </li>
        </ul>

        <form action="{{ route('afericoes.pivo.central.salvar') }}" method="post" id="formdados">
            @csrf
            <div class="tab-content mt-5" id="myTabContent">
                <div class="tab-pane fade show active" id="iGerais" role="tabpanel" aria-labelledby="iGerais-tab">
                    <input type="hidden" name="id_fazenda" value="{{ $fazenda->id }}">
                    <div class="col-md-12 formpivocentral">
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="data_afericao">@lang('afericao.dataAfericao')</label>
                                <input type="date" id="data_afericao" class="form-control" name="data_afericao"
                                    maxlength="50" required />
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="marca_modelo_pivo">@lang('afericao.marcaModeloPivo')</label>
                                <input type="text" id="marca_modelo_pivo" class="form-control" name="marca_modelo_pivo"
                                    maxlength="30" required />
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="giro_equipamento">@lang('afericao.giroEquipamento')</label>
                                <input type="number" id="giro_equipamento" class="form-control" name="giro_equipamento"
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
                                <input type="number" id="ano_montagem" class="form-control" name="ano_montagem"
                                    maxlength="4" required />
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="lamina_anual">@lang('afericao.laminaAnual')</label>
                                <input type="number" id="lamina_anual" class="form-control" name="lamina_anual"
                                    maxlength="30" required />
                            </div>
                        </div>

                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="custo_medio">@lang('afericao.custoMedio')</label>
                                <input type="number" id="custo_medio" class="form-control" name="custo_medio" maxlength="30"
                                    required />
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="numero_lances">@lang('afericao.numeroLances')</label>
                                <input type="number" id="numero_lances" class="form-control" name="numero_lances"
                                    maxlength="30" required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="consideracoes" role="tabpanel" aria-labelledby="consideracoes-tab">
                    <div class="col-md-12">
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="torreCentral">@lang('afericao.torreCentral')</label><br>
                                <select class='form-control' name="problema_torre_central[]" id="">
                                    <option value="1">@lang('afericao.problema1')</option>
                                    <option value="2">@lang('afericao.problema2')</option>
                                    <option value="3">@lang('afericao.problema3')</option>
                                    <option value="4">@lang('afericao.problema4')</option>
                                    <option value="5">@lang('afericao.problema5')</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4 telo5ce">
                                <label for="valvulaPSI">@lang('afericao.valvulaPSI')</label><br>
                                <select class='form-control' name="problema_valvula_psi[]" id="">
                                    <option value="6">@lang('afericao.problema6')</option>
                                    <option value="7">@lang('afericao.problema7')</option>
                                    <option value="8">@lang('afericao.problema8')</option>
                                    <option value="9">@lang('afericao.problema9')</option>
                                    <option value="10">@lang('afericao.problema10')</option>
                                    <option value="11">@lang('afericao.problema11')</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4 telo5ce">
                                <label for="parteAerea">@lang('afericao.parteAerea')</label><br>
                                <select class='form-control' name="problema_parte_aerea[]" id="">
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
                                </select>
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="canhaoFinal">@lang('afericao.canhaoFinal')</label><br>
                                <select class='form-control' name="problema_canhao_final[]" id="">
                                    <option value="27">@lang('afericao.problema27')</option>
                                    <option value="28">@lang('afericao.problema28')</option>
                                    <option value="29">@lang('afericao.problema29')</option>
                                    <option value="30">@lang('afericao.problema30')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="casaBomba">@lang('afericao.casaBomba')</label><br>
                                <select class='form-control' name="problema_casa_bomba[]" id="">
                                    <option value="31">@lang('afericao.problema30')</option>
                                    <option value="32">@lang('afericao.problema31')</option>
                                    <option value="33">@lang('afericao.problema32')</option>
                                    <option value="34">@lang('afericao.problema33')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="adutora">@lang('afericao.adutora')</label><br>
                                <select class='form-control' name="problema_adutora[]" id="">
                                    <option value="35">@lang('afericao.problema35')</option>
                                    <option value="36">@lang('afericao.problema36')</option>
                                    <option value="37">@lang('afericao.problema37')</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class='form-group col-md-4 telo5ce' >
                                <label for="problema_chave_partida">@lang('afericao.chavePartida')</label><br>
                                <select class='form-control' name="problema_chave_partida[]">
                                    <option value="38">@lang('afericao.problema38')</option>
                                    <option value="39">@lang('afericao.problema39')</option>
                                    <option value="40">@lang('afericao.problema40')</option>
                                    <option value="41">@lang('afericao.problema41')</option>
                                    <option value="42">@lang('afericao.problema42')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="succao">@lang('afericao.succao')</label><br>
                                <select class='form-control' name="problema_succao[]" id="">
                                    <option value="43">@lang('afericao.problema43')</option>
                                    <option value="44">@lang('afericao.problema44')</option>
                                    <option value="45">@lang('afericao.problema45')</option>
                                    <option value="46">@lang('afericao.problema46')</option>
                                    <option value="47">@lang('afericao.problema47')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="motorPrincipal">@lang('afericao.motorPrincipal')</label><br>
                                <select class='form-control' name="problema_motor_principal[]" id="">
                                    <option value="48">@lang('afericao.problema48')</option>
                                    <option value="49">@lang('afericao.problema49')</option>
                                    <option value="50">@lang('afericao.problema50')</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="bombaPrincipal">@lang('afericao.bombaPrincipal')</label><br>
                                <select class='form-control' name="problema_bomba_principal[]" id="">
                                    <option value="51">@lang('afericao.problema51')</option>
                                    <option value="52">@lang('afericao.problema52')</option>
                                    <option value="53">@lang('afericao.problema53')</option>
                                    <option value="54">@lang('afericao.problema54')</option>
                                    <option value="55">@lang('afericao.problema55')</option>
                                    <option value="56">@lang('afericao.problema56')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="motorAuxiliar">@lang('afericao.motorAuxiliar')</label><br>
                                <select class='form-control' name="problema_motor_auxiliar[]" id="">
                                    <option value="57">@lang('afericao.problema57')</option>
                                    <option value="58">@lang('afericao.problema58')</option>
                                    <option value="59">@lang('afericao.problema59')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="bombaAuxiliar">@lang('afericao.bombaAuxiliar')</label><br>
                                <select class='form-control' name="problema_bomba_auxiliar[]" id="">
                                    <option value="60">@lang('afericao.problema60')</option>
                                    <option value="61">@lang('afericao.problema61')</option>
                                    <option value="62">@lang('afericao.problema62')</option>
                                    <option value="63">@lang('afericao.problema63')</option>
                                    <option value="64">@lang('afericao.problema64')</option>
                                    <option value="65">@lang('afericao.problema65')</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="pAerea" role="tabpanel" aria-labelledby="pAerea-tab">
                    <div class="col-md-12">
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-3 telo5ce">
                                <label for="marca_modelo_emissores">@lang('afericao.marcaModeloEmissores')</label><br>
                                <select class='form-control' required='true' name='marca_modelo_emissores'>
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
                                    <option value='Zincagem'>@lang('afericao.zincagem')</option>
                                    <option value='Politetileno'>@lang('afericao.politetileno')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                <label for="pendural">@lang('afericao.pendural')</label><br>
                                <select class='form-control' name='pendural'>
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
                                <select class='form-control' required='true' name='altura_pivo'
                                    required>
                                    <option value='2.74'><b>2,74</b></option>
                                    <option value='3.75'><b>3,75</b></option>
                                    <option value='4.6'><b>4,6</b></option>
                                    <option value='5.5'><b>5,5</b></option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                <label for="valv_reguladoras">@lang('afericao.valvulaReguladora')</label><br>
                                <select class='form-control' required='true' name='valv_reguladoras'
                                    required>
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
                                <label for="altura_emissores">@lang('afericao.alturaEmissores')</label><br>
                                <input name='altura_emissores' step=0.01 id="altura_emissores"
                                    type="number" class='form-control' required />
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-3 telo5ce">
                                <label for="pressao_centro">@lang('afericao.pressaoCentro')</label><br>
                                <input type="number" step=0.001 min=0.001 class="form-control" name="pressao_centro" required
                                    id="pressao_centro">
                            </div>

                            <div class="form-group col-md-3 telo5ce">
                                <label for="pressao_ponta">@lang('afericao.pressaoPonta')</label><br>
                                <input type="number" step=0.001 min=0.001 class="form-control" name="pressao_ponta" required
                                    id="pressao_ponta">
                            </div>

                            <div class="form-group col-md-3 telo5ce">
                                <label for="rugosidade">@lang('afericao.coeficienteRugosidade')</label><br>
                                <input type="number" number min=1 class="form-control" min=0.001 name="rugosidade" required
                                    id="rugosidade">
                            </div class="form-group col-md-3 telo5ce">

                            <div class="form-group col-md-3 telo5ce">
                                <label for="altitude_centro">@lang('afericao.altitudeCentro')</label><br>
                                <input type="number" class="form-control" name="altitude_centro" required id="altitude_centro">
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-3 telo5ce">
                                <label for="altitude_mais_alto">@lang('afericao.altitudeMaisAlto')</label><br>
                                <input type="number" class="form-control" name="altitude_mais_alto" required
                                    id="altitude_mais_alto">
                            </div>

                            <div class="form-group col-md-3 telo5ce">
                                <label for="altitude_mais_baixo">@lang('afericao.altitudeMaisBaixo')</label><br>
                                <input type="number" class="form-control" name="altitude_mais_baixo" id="altitude_mais_baixo">
                            </div>

                            <div class="form-group col-md-3 telo5ce">
                                <label for="latitude">@lang('afericao.latitude')</label><br>
                                <input type="number" step=0.000001 class="form-control" name="latitude" required id="latitude">
                            </div>

                            <div class="form-group col-md-3 telo5ce">
                                <label for="longitude">@lang('afericao.longitude')</label><br>
                                <input type="number" step=0.000001 class="form-control" name="longitude" required
                                    id="longitude">
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
    <!-- Inclusão do Plugin jQuery Validation-->
    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
    <script>
        $(document).ready(function() {
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
                    data_afericao: "Campo <strong>DATA</strong> é obrigatório",

                    "marca_modelo_pivo": {
                        required: "Campo <strong>MARCA/MODELO</strong> é obrigatório"
                    },
                    "giro_equipamento": {
                        required: "Campo <strong>GIRO DO EQUIPAMENTO</strong> é obrigatório"
                    },
                    "tempo_funcionamento": {
                        required: "Campo <strong>TEMPO DE FUNCIONAMENTO</strong> é obrigatório"
                    },
                    "nome_pivo": {
                        required: "Campo <strong>NOME PIVÔ</strong> é obrigatório"
                    },
                    "tipo_painel": {
                        required: "Campo <strong>TIPO DE PAINEL</strong> é obrigatório"
                    },
                    "horimetro": {
                        required: "Campo <strong>HORÍMETRO</strong> é obrigatório"
                    },
                    "ano_montagem": {
                        required: "Campo <strong>ANO DE MONTAGEM</strong> é obrigatório"
                    },
                    "lamina_anual": {
                        required: "Campo <strong>LÂMINA ANUAL</strong> é obrigatório",
                    },
                    "custo_medio": {
                        required: "Campo <strong>CUSTO MÉDIO</strong> é obrigatório"
                    },
                    "numero_lances": {
                        required: "Campo <strong>LANCES</strong> é obrigatório"
                    },
                    "defletor": {
                        required: "Campo <strong>DEFELTOR</strong> é obrigatório"
                    },
                    "altura_emissores": {
                        required: "Campo <strong>ALTURA DOS EMISSORES</strong> é obrigatório"
                    },
                    "pressao_centro": {
                        required: "Campo <strong>PRESSÃO NO CENTRO</strong> é obrigatório"
                    },
                    "pressao_ponta": {
                        required: "Campo <strong>PRESSÃO NA PONTA</strong> é obrigatório"
                    },
                    "rugosidade": {
                        required: "Campo <strong>COEFICIENTE DE RUGOSIDADE</strong> é obrigatório"
                    },
                    "altitude_centro": {
                        required: "Campo <strong>ALTITUDE CENTRO</strong> é obrigatório"
                    },
                    "altitude_mais_alto": {
                        required: "Campo <strong>ALTITUDE DO PONTO MAIS ALTO</strong> é obrigatório"
                    },
                    "altitude_mais_baixo": {
                        required: "Campo <strong>ALTITUDE DO PONTO MAIS BAIXO</strong> é obrigatório"
                    },
                    "latitude": {
                        required: "Campo <strong>LATITUDE</strong> é obrigatório"
                    },
                    "longitude": {
                        required: "Campo <strong>LONGITUDE</strong> é obrigatório"
                    }
                }
            });
        });

    </script>
@endsection
