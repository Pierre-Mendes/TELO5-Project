@extends('_layouts._layout_site')
@include('_layouts._includes._head')

@section('head')@endsection

@section('topo_detalhe')

    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- Titlle and SubTitlle --}}
            <div class="col-6">
                <h1>@lang('redimensionamento.red_pivoCentral')</h1>
            </div>

            {{-- Save and Return Buttons --}}
            <div class="col-6 text-right botoes position">
                <a href="{{ route('resizing_manager') }}" style="color: #3c8dbc" data-toggle="tooltip"
                    data-placement="bottom" title="Voltar">
                    <button type="button"><span class="fa-stack fa-lg"><i class="fas fa-circle fa-stack-2x"></i><i
                                class="fas fa-angle-double-left fa-stack-1x fa-inverse"></i></span></button>
                </a>

                <button type="button" id="botaosalvar" data-toggle="tooltip" data-placement="bottom" title="Salvar">
                    <span class="fa-stack fa-2x"><i class="fas fa-circle fa-stack-2x"></i><i
                            class="fas fa-save fa-stack-1x fa-inverse"></i></span>
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
                    aria-controls="iGerais" aria-selected="true">@lang('redimensionamento.informacaoGeral')</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="consideracoes-tab" data-toggle="tab" href="#consideracoes" role="tab"
                    aria-controls="consideracoes" aria-selected="false">@lang('redimensionamento.consideracoes')</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="pAerea-tab" data-toggle="tab" href="#pAerea" role="tab" aria-controls="pAerea"
                    aria-selected="false">@lang('redimensionamento.parteAerea')</a>
            </li>
        </ul>
    </div>

    {{-- PRELOADER --}}
    {{-- <div id="coverScreen">
        <div class="preloader">
            <i class="fas fa-circle-notch fa-spin fa-2x"></i>
            <div>@lang('redimensionamento.preloader')</div>
        </div>
    </div> --}}

    {{-- FORMULARIO DE CADASTRO --}}
    <form action="#" method="post" id="formdados" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="put" />
        <input type="hidden" name="id_redimensionamento" value="{{ $redimensionamento[0]['id_afericao'] }}">
        <input type="hidden" name="id_adutora" value="{{ $redimensionamento[0]['id_adutora'] }}">
        <input type="hidden" value="0" name="editar_emissores" id="editar_emissores">
        <input type="hidden" value="" name="excluir_imagens" id="excluir_imagens">
        <div class="tab-content small.required tab-validate mt-5" id="myTabContent">
            <div class="tab-pane fade show active" id="iGerais" role="tabpanel" aria-labelledby="iGerais-tab">
                <div class="col-md-12 formpivocentral" id="cssPreloader">
                    <div class="form-row justify-content-start">
                        <p class="col-4  text-center">@lang('redimensionamento.redim')</p>
                        <p class="col-4  text-center">@lang('redimensionamento.afericao')</p>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for=""> @lang('redimensionamento.vazaoFinal')</label>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <input type="number" step="0.01" name="vazao" class="text-center col form-control"
                                    value="{{ number_format($redimensionamento[0]->vazao_sistema, 2) }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                <input class="text-center col form-control" disabled type="text"
                                    value="{{ number_format($afericao[0]->somatorio_vazao_ok, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <label for="">
                                    @lang('redimensionamento.pressaoBomba')@lang('unidadesAcoes.(mca)')
                                </label>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <input type="number" step="0.01" name="pressao_bomba" class="text-center col form-control"
                                    value="{{ number_format($redimensionamento[0]->pressao_na_bomba, 2) }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                <input class="text-center col form-control" disabled type="text"
                                    value="{{ number_format($afericao[0]->pressao_na_bomba, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <label for="">
                                    @lang('redimensionamento.giroEquipamento')@lang('unidadesAcoes.(graus)')
                                </label>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <input type="number" step="1" max="360" min="0" name="giro_equipamento"
                                    class="text-center col form-control" value="{{ $redimensionamento[0]->angulo_pivo }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                <input class="text-center col form-control" disabled type="text"
                                    value="{{ number_format($afericao[0]->angulo_pivo, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <label for="">
                                    @lang('redimensionamento.coeficienteRugosidadeA')
                                </label>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <input type="number" name="rugosidade_adutora" class="text-center col form-control"
                                    value="{{ number_format($redimensionamento[0]->rugosidade_adutora, 2) }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                <input class="text-center col form-control" disabled type="text"
                                    value="{{ number_format($afericao[0]->rugosidade_adutora, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <label for="">
                                    @lang('redimensionamento.valvula')
                                </label>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <select onchange="editarEmissores()" class='form-control' required='true'
                                    id="valv_reguladoras" name='valv_reguladoras'>
                                    <option @if ($redimensionamento[0]->valvula_reguladora == 10) selected @endif value='10'><b>10 PSI</b></option>
                                    <option @if ($redimensionamento[0]->valvula_reguladora == 15) selected @endif value='15'><b>15 PSI</b></option>
                                    <option @if ($redimensionamento[0]->valvula_reguladora == 20) selected @endif value='20'><b>20 PSI</b></option>
                                    <option @if ($redimensionamento[0]->valvula_reguladora == 25) selected @endif value='25'><b>25 PSI</b></option>
                                    <option @if ($redimensionamento[0]->valvula_reguladora == 30) selected @endif value='30'><b>30 PSI</b></option>
                                    <option @if ($redimensionamento[0]->valvula_reguladora == 35) selected @endif value='35'><b>35 PSI</b></option>
                                    <option @if ($redimensionamento[0]->valvula_reguladora == 40) selected @endif value='40'><b>40 PSI</b></option>
                                    <option @if ($redimensionamento[0]->valvula_reguladora == 45) selected @endif value='45'><b>45 PSI</b></option>
                                    <option @if ($redimensionamento[0]->valvula_reguladora == 50) selected @endif value='50'><b>50 PSI</b></option>
                                </select>
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                <select class='form-control text-center' required='true' disabled>
                                    <option @if ($afericao[0]->valvula_reguladora == 10) selected @endif value='10'><b>10 PSI</b></option>
                                    <option @if ($afericao[0]->valvula_reguladora == 15) selected @endif value='15'><b>15 PSI</b></option>
                                    <option @if ($afericao[0]->valvula_reguladora == 20) selected @endif value='20'><b>20 PSI</b></option>
                                    <option @if ($afericao[0]->valvula_reguladora == 25) selected @endif value='25'><b>25 PSI</b></option>
                                    <option @if ($afericao[0]->valvula_reguladora == 30) selected @endif value='30'><b>30 PSI</b></option>
                                    <option @if ($afericao[0]->valvula_reguladora == 35) selected @endif value='35'><b>35 PSI</b></option>
                                    <option @if ($afericao[0]->valvula_reguladora == 40) selected @endif value='40'><b>40 PSI</b></option>
                                    <option @if ($afericao[0]->valvula_reguladora == 45) selected @endif value='45'><b>45 PSI</b></option>
                                    <option @if ($afericao[0]->valvula_reguladora == 50) selected @endif value='50'><b>50 PSI</b></option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <label for="">
                                    @lang('redimensionamento.emissores')
                                </label>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <select class='form-control' onchange="editarEmissores()" name='marca_modelo_emissores'>
                                    <option @if ($redimensionamento[0]->modelo_emissores == 'I-WOB UP3') selected @endif value='I-WOB UP3'>@lang('afericao.i-wob-up3')
                                    </option>
                                    <option @if ($redimensionamento[0]->modelo_emissores == 'Fabrimar') selected @endif value='Fabrimar'>
                                        <b>@lang('afericao.fabrimar')</b>
                                    </option>
                                    <option @if ($redimensionamento[0]->modelo_emissores == 'Nelson') selected @endif value='Nelson'>
                                        <b>@lang('afericao.nelson')</b>
                                    </option>
                                    <option @if ($redimensionamento[0]->modelo_emissores == 'Super Spray - UP3') selected @endif value='Super Spray - UP3'>
                                        <b>@lang('afericao.super-spray-up3')</b>
                                    </option>
                                    <option @if ($redimensionamento[0]->modelo_emissores == 'Super Spray') selected @endif value='Super Spray'>
                                        <b>@lang('afericao.super-spray')</b>
                                    </option>
                                    <option @if ($redimensionamento[0]->modelo_emissores == 'I-WOB') selected @endif value='I-WOB'><b>@lang('afericao.i-wob')</b>
                                    </option>
                                    <option @if ($redimensionamento[0]->modelo_emissores == 'Trash Buster') selected @endif value='Trash Buster'>
                                        <b>@lang('afericao.trash-buster')</b>
                                    </option>
                                    <option @if ($redimensionamento[0]->modelo_emissores == 'Komet') selected @endif value='Komet'><b>@lang('afericao.komet')</b>
                                    </option>
                                    <option @if ($redimensionamento[0]->modelo_emissores == 'Fan Spray') selected @endif value='Fan Spray'>
                                        <b>@lang('afericao.fan-spray')</b>
                                    </option>
                                </select>
                                <div class="line"></div>
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                <select class='form-control' disabled>
                                    <option @if ($afericao[0]->modelo_emissores == 'I-WOB UP3') selected @endif value='I-WOB UP3'>@lang('afericao.i-wob-up3')
                                    </option>
                                    <option @if ($afericao[0]->modelo_emissores == 'Fabrimar') selected @endif value='Fabrimar'>
                                        <b>@lang('afericao.fabrimar')</b>
                                    </option>
                                    <option @if ($afericao[0]->modelo_emissores == 'Nelson') selected @endif value='Nelson'>
                                        <b>@lang('afericao.nelson')</b>
                                    </option>
                                    <option @if ($afericao[0]->modelo_emissores == 'Super Spray - UP3') selected @endif value='Super Spray - UP3'>
                                        <b>@lang('afericao.super-spray-up3')</b>
                                    </option>
                                    <option @if ($afericao[0]->modelo_emissores == 'Super Spray') selected @endif value='Super Spray'>
                                        <b>@lang('afericao.super-spray')</b>
                                    </option>
                                    <option @if ($afericao[0]->modelo_emissores == 'I-WOB') selected @endif value='I-WOB'><b>@lang('afericao.i-wob')</b>
                                    </option>
                                    <option @if ($afericao[0]->modelo_emissores == 'Trash Buster') selected @endif value='Trash Buster'>
                                        <b>@lang('afericao.trash-buster')</b>
                                    </option>
                                    <option @if ($afericao[0]->modelo_emissores == 'Komet') selected @endif value='Komet'><b>@lang('afericao.komet')</b>
                                    </option>
                                    <option @if ($afericao[0]->modelo_emissores == 'Fan Spray') selected @endif value='Fan Spray'>
                                        <b>@lang('afericao.fan-spray')</b>
                                    </option>
                                </select>
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <label for="">
                                    @lang('redimensionamento.alcanceCanhao')@lang('unidadesAcoes.(m)')
                                </label>
                            </div>
                        </div>

                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <input class="text-center col form-control" name="alcance_canhao_final" type="text"
                                    value="{{ number_format($redimensionamento[0]->alcance_canhao_final, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                <input class="text-center col form-control" disabled type="text"
                                    value="{{ number_format($afericao[0]->alcance_canhao_final, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                        </div>
                    </div>

                    <div class="form-row justify-content-start">
                        <p class="col-4  text-center">@lang('redimensionamento.redim')</p>
                        <p class="col-4  text-center">@lang('redimensionamento.afericao')</p>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <label for="">
                                    @lang('redimensionamento.coeficienteRugosidadeP')
                                </label>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <input type="number" name="rugosidade_pivo" class="text-center col form-control"
                                    value="{{ number_format($redimensionamento[0]->coeficiente_rugosidade, 2) }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                <input class="text-center col form-control" disabled type="text"
                                    value="{{ number_format($afericao[0]->coeficiente_rugosidade, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <label for="">
                                    @lang('redimensionamento.laminaAnual')@lang('unidadesAcoes.(mm/ha/ano)')
                                </label>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <input type="number" step="0.01" name="lamina_anual" class="text-center col form-control"
                                    value="{{ number_format($redimensionamento[0]->lamina_anual, 2) }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                <input class="text-center col form-control" disabled type="text"
                                    value="{{ number_format($afericao[0]->lamina_anual, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <label for="">
                                    @lang('redimensionamento.custoMedio')@lang('unidadesAcoes.($/kWh)')
                                </label>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <input type="number" step="0.01" name="custo_medio" class="text-center col form-control"
                                    value="{{ number_format($redimensionamento[0]->custo_medio, 2) }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                <input class="text-center col form-control" disabled type="text"
                                    value="{{ number_format($afericao[0]->custo_medio, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <label for="">
                                    @lang('redimensionamento.defletor')
                                </label>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <input name="defletor" class="text-center col form-control" type="text"
                                    value="{{ $redimensionamento[0]->defletor }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                <input class="text-center col form-control" disabled type="text"
                                    value="{{ $afericao[0]->defletor }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <label for="">
                                    @lang('redimensionamento.valvReg')
                                </label>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <select class='form-control' onchange="editarEmissores()" name="tipo_valvula">
                                    <option @if ($redimensionamento[1][0]['valvulas_reguladoras_tipo'] == 'LF') selected @endif value='LF'><b>LF</b></option>
                                    <option @if ($redimensionamento[1][0]['valvulas_reguladoras_tipo'] == 'MF') selected @endif value='MF'><b>MF</b></option>
                                    <option @if ($redimensionamento[1][0]['valvulas_reguladoras_tipo'] == 'HF') selected @endif value='HF'><b>HF</b></option>
                                    <option @if ($redimensionamento[1][0]['valvulas_reguladoras_tipo'] == 'PSR') selected @endif value='PSR'><b>PSR</b></option>
                                </select>
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                <select class='form-control' disabled>
                                    <option @if ($afericao[1][0]['valvulas_reguladoras_tipo'] == 'LF') selected @endif value='LF'><b>LF</b></option>
                                    <option @if ($afericao[1][0]['valvulas_reguladoras_tipo'] == 'MF') selected @endif value='MF'><b>MF</b></option>
                                    <option @if ($afericao[1][0]['valvulas_reguladoras_tipo'] == 'HF') selected @endif value='HF'><b>HF</b></option>
                                    <option @if ($afericao[1][0]['valvulas_reguladoras_tipo'] == 'PSR') selected @endif value='PSR'><b>PSR</b></option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <label for="">
                                    @lang('redimensionamento.vazaoCanhao')@lang('unidadesAcoes.(m3/h)')
                                </label>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <input class="text-center col form-control" name="vazao_canhao_final" type="text"
                                    value="{{ number_format($redimensionamento[0]->vazao_canhao_final, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                <input class="text-center col form-control" disabled type="text"
                                    value="{{ number_format($afericao[0]->vazao_canhao_final, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                        </div>
                    </div>

                    <div class="form-row justify-content-start">
                        <div class='form-group col-md-4 telo5ce'>
                            <label for="">
                                @lang('redimensionamento.utilizarPlug')
                            </label>
                            <select disabled name="utilizar_plug" id="utilizar_plug" class="form-control">
                                <option value="sim">@lang('fichaTecnica.sim')</option>
                                <option value="nao">@lang('fichaTecnica.nao')</option>
                            </select>
                        </div>

                        <div class='form-group col-md-4 telo5ce'>
                            <label for="">
                                @lang('redimensionamento.utilizarPressaoCentro')
                            </label>
                            <select disabled name="utilizar_pressao_centro" id="utilizar_pressao_centro"
                                class="form-control">
                                <option value="sim">@lang('fichaTecnica.sim')</option>
                                <option value="nao">@lang('fichaTecnica.nao')</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row justify-content-start">
                        <div class='form-group col-md-4 telo5ce'>
                            <label for="">
                                @lang('redimensionamento.utilizarPlugAteTorre')
                            </label>
                            <input class="form-control telo5ce" name="lances_c_plug" type="number"
                                value="{{ $redimensionamento[0]->lances_c_plug }}">
                            @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                        </div>
                        <div class='form-group col-md-4 telo5ce'>
                            <label for="">
                                @lang('redimensionamento.espacamentoMaximoPlug')</small>
                            </label>
                            <input class="text-center col form-control" name="espacamento_maximo_plug" type="number"
                                value="{{ $redimensionamento[0]->espacamento_maximo_plug }}">
                            @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                        </div>
                    </div>

                    <div class="form-row justify-content-start">
                        <div class='form-group col-md-4 telo5ce'>
                            <label for="">@lang('redimensionamento.emissoresComPlugInicio')</label>
                            <input class="text-center col form-control" type="number" name="num_emissores_c_plug_inicio"
                                value="{{ $redimensionamento[0]->num_emissores_c_plug_inicio }}">
                            @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                        </div>
                    </div>

                    <div class="form-row justify-content-center pb-5">
                        <button class="btn btn-outline-primary" type="submit"> <i class="fa fa-calculator fa-fw"></i>
                            @lang('redimensionamento.calcularNovamente')
                        </button>
                    </div>
                </div>

            </div>

            <div class="tab-pane fade" id="consideracoes" role="tabpanel" aria-labelledby="consideracoes-tab">
                <div class="col-md-12">
                    <div class="form-row justify-content-start">
                        <p class="col-4  text-center">@lang('redimensionamento.redim')</p>
                        <p class="col-4  text-center">@lang('redimensionamento.afericao')</p>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="">
                                    @lang('unidadesAcoes.(mca)')
                                </label>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <input readonly class="text-center col form-control" type="text"
                                    value="{{ number_format($redimensionamento[0]->pressao_5_4_2, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                            <div class='col-4 text-center form-group'>
                                <input class="text-center col form-control" disabled type="text"
                                    value="{{ number_format($redimensionamento[0]->pressao_5_4_2, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="">
                                    @lang('redimensionamento.hfAdutora')@lang('unidadesAcoes.(mca)')
                                </label>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <input readonly class="text-center col form-control" type="text"
                                    value="{{ number_format($redimensionamento[0]->hf_adutora, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                            <div class='col-4 text-center form-group'>
                                <input class="text-center col form-control" disabled type="text"
                                    value="{{ number_format($afericao[0]->hf_adutora, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="">
                                    @lang('redimensionamento.desnivelMotobomba')@lang('unidadesAcoes.(m)')
                                </label>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <input readonly class="text-center col form-control" type="text"
                                    value="{{ number_format($redimensionamento[0]->desnivel_motobomba, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                            <div class='col-4 text-center form-group'>
                                <input class="text-center col form-control" disabled type="text"
                                    value="{{ number_format($afericao[0]->desnivel_motobomba, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="">
                                    @lang('redimensionamento.pressaoCentro')@lang('unidadesAcoes.(mca)')
                                </label>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <input readonly class="text-center col form-control" type="text"
                                    value="{{ number_format($redimensionamento[0]->pressao_centro, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                            <div class='col-4 text-center form-group'>
                                <input class="text-center col form-control" disabled type="text"
                                    value="{{ number_format($afericao[0]->pressao_centro, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="">
                                    @lang('redimensionamento.hfParteAerea')@lang('unidadesAcoes.(mca)')
                                </label>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <input readonly class="text-center col form-control" type="text"
                                    value="{{ number_format($redimensionamento[0]->somatorio_perda_carga_real * 1.1, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                            <div class='col-4 text-center form-group'>
                                <input class="text-center col form-control" disabled type="text"
                                    value="{{ number_format($afericao[0]->somatorio_perda_carga_real * 1.1, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="">
                                    @lang('redimensionamento.desnivelMaisAlto')@lang('unidadesAcoes.(m)')
                                </label>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <input readonly class="text-center col form-control" type="text"
                                    value="{{ number_format($redimensionamento[0]->desnivel_total, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                            <div class='col-4 text-center form-group'>
                                <input class="text-center col form-control" disabled type="text"
                                    value="{{ number_format($afericao[0]->desnivel_total, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="">
                                    @lang('redimensionamento.areaTotal')@lang('unidadesAcoes.(ha)')
                                </label>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <input readonly class="text-center col form-control" type="text"
                                    value="{{ number_format($redimensionamento[0]->area_total_com_canhao, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                            <div class='col-4 text-center form-group'>
                                <input class="text-center col form-control" disabled type="text"
                                    value="{{ number_format($afericao[0]->area_total_com_canhao, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="">
                                    @lang('redimensionamento.velocidade100')
                                </label>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <input readonly class="text-center col form-control" type="text"
                                    value="{{ number_format($redimensionamento[0]->tempo_a_100, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                            <div class='col-4 text-center form-group'>
                                <input class="text-center col form-control" disabled type="text"
                                    value="{{ number_format($afericao[0]->tempo_a_100, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                        </div>
                    </div>

                    <div class="form-row justify-content-start">
                        <p class="col-4  text-center">@lang('redimensionamento.redim')</p>
                        <p class="col-4  text-center">@lang('redimensionamento.afericao')</p>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="">
                                    @lang('redimensionamento.areaSemCanhao')@lang('unidadesAcoes.(ha)')
                                </label>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <input readonly class="text-center col form-control" type="text"
                                    value="{{ number_format($redimensionamento[0]->area_total, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                <input class="text-center col form-control" disabled type="text"
                                    value="{{ number_format($afericao[0]->area_total, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="">
                                    @lang('redimensionamento.lamina')@lang('unidadesAcoes.(mm)')
                                </label>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <input readonly class="text-center col form-control" type="text"
                                    value="{{ number_format($redimensionamento[0]->lamina, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                <input class="text-center col form-control" disabled type="text"
                                    value="{{ number_format($afericao[0]->lamina, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="">
                                    @lang('redimensionamento.tempoFuncionamento')@lang('unidadesAcoes.(h)')
                                </label>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <input readonly class="text-center col form-control" type="text"
                                    value="{{ number_format($redimensionamento[0]->tempo, 0, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                <input class="text-center col form-control" disabled type="text"
                                    value="{{ number_format($afericao[0]->tempo, 0, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="">
                                    @lang('redimensionamento.pressaoRequerida')@lang('unidadesAcoes.(mca)')
                                </label>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <input readonly class="text-center col form-control" type="text"
                                    value="{{ number_format($redimensionamento[0]->pressao_requerida, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                <input class="text-center col form-control" disabled type="text"
                                    value="{{ number_format($redimensionamento[0]->pressao_requerida, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="">
                                    @lang('redimensionamento.pressaoPontaCalculada')@lang('unidadesAcoes.(mca)')
                                </label>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">

                            <div class='form-group col-md-4 telo5ce'>
                                <input readonly class="text-center col form-control" type="text"
                                    value="{{ number_format($redimensionamento[0]->pressao_ponta, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                <input class="text-center col form-control" disabled type="text"
                                    value="{{ number_format($afericao[0]->pressao_ponta, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="">
                                    @lang('redimensionamento.pressaoPontaRequerida')@lang('unidadesAcoes.(mca)')
                                </label>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class='form-group col-md-4 telo5ce'>
                                <input readonly class="text-center col form-control" type="text"
                                    value="{{ number_format($redimensionamento[0]->pressao_ponta_requerida, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                            <div class='form-group col-md-4 telo5ce'>
                                <input class="text-center col form-control" disabled type="text"
                                    value="{{ number_format($afericao[0]->pressao_ponta_requerida, 2, ',', '.') }}">
                                @component('_layouts._components._inputLabel', ['texto' => '', 'id' => ''])@endcomponent
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="form-row justify-content-start">
                        <div class="form-group col-md-4 telo5ce">
                            <label for="">
                                <h4 class="text-center">@lang('redimensionamento.curvasDeBomba') </h4>
                            </label>
                        </div>
                    </div>
                    <div class="form-row justify-content-start">
                        <div class="form-group col-md-4 telo5ce">
                            @foreach ($imagens as $key => $imagem)
                                <div>
                                    <img data-toggle="modal" data-target="#modalImagens"
                                        data-image-name="{{ $imagem->getFileName() }}" id="imagem-{{ $key }}"
                                        data-whatever="{{ url('storage/projetos/redimensionamento/' . $redimensionamento[0]['id_afericao'] . '/' . $imagem->getFileName()) }}"
                                        src="{{ url('storage/projetos/redimensionamento/' . $redimensionamento[0]['id_afericao'] . '/' . $imagem->getFileName()) }}"
                                        class="img-thumbnail img-pointer" style="width: 100px; height: 100px" alt="">
                                    <button class="btn btn-outline-danger btn-remover-imagem"
                                        onclick="excluirImagem({{ $key }})"
                                        id="btn-remover-imagem-{{ $key }}" data-whatever="{{ $key }}"
                                        type="button"> <i class="fa fa-trash"> </i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>


                    <div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <div class="form-group">
                                    <span class=""><i>@lang('redimensionamento.cliqueNaImagemParaExpandir')</i></span>
                                </div>
                                <input type="file" accept=".jpg" id="imagens_curvas_bomba" multiple name="images[]">
                            </div>
                        </div>
                    </div>

                    <div class="row col-12">
                        {{-- <div class="col-12  text-light text-center" style="padding-top: 1%">
                            <a class="btn btn-outline-success"
                                href="{{ route('resizing_status', $redimensionamento[0]['id_afericao']) }}">
                                <i class="fa fa-check fa-fw"></i> @lang('unidadesAcoes.sair')</a>
                        </div> --}}
                        <div class="modal fade" id="modalImagens" tabindex="-1" role="dialog"
                            aria-labelledby="modalImagensLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-irr-escuro">
                                        <h5 class="modal-title"><b> @lang('redimensionamento.curvasDeBomba') </b></h5>
                                        <button type="button" class="btn btn-danger close text-light" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img id="img_modal" src="" alt="" class="img img-thumbnail w-100">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">@lang('unidadesAcoes.fechar')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

{{-- @section('scripts')

    <script>
        function editarEmissores() {
            $("#editar_emissores").val("1");
        }

        $('#modalImagens').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('#img_modal').attr('src', recipient);
        })

    </script>



    <script type="text/javascript">
        var uploadField = document.getElementById("imagens_curvas_bomba");

        uploadField.onchange = function() {
            for (var i = 0; i < this.files.length; i++) {
                element = this.files[i];
                if (element.size > 1000000) {
                    alert("@lang('redimensionamento.tamanhoMaximo')");
                    this.value = "";
                };
            }
            addUploadedImagesToGallery(this);
        };

        function addUploadedImagesToGallery(input) {
            var countFiles = $(input)[0].files.length;
            $(".adicionada").each(function(index) {
                $(this).remove();
            });
            if (countFiles > 0) {
                var imgPath = $(input)[0].value;
                var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
                var image_holder = $("#grid_images");

                if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                    if (typeof(FileReader) != "undefined") {

                        for (var i = 0; i < countFiles; i++) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                $("<img />", {
                                    "src": e.target.result,
                                    "class": "img-thumbnail adicionada img-pointer",
                                    'height': '100',
                                    'width': '100',
                                    'data-target': "#modalImagens",
                                    'data-whatever': e.target.result,
                                    'data-toggle': "modal"
                                }).appendTo(image_holder);
                            }

                            //image_holder.show();
                            reader.readAsDataURL($(input)[0].files[i]);
                        }

                    } else {
                        alert("This browser does not support FileReader.");
                    }
                } else {
                    alert("Pls select only images");
                }
            } else {
                var image_holder = $("#grid_images");
                var count = $("#grid_images img").length;
                if (count == 0) {
                    $("<img />", {
                        "src": "{{ asset('img/symbols/upload_img.png') }}",
                        "class": "img-thumbnail adicionada",
                        'height': '100',
                        'width': '100'
                    }).appendTo(image_holder);
                }
            }
        }

        function excluirImagem(imageIndex) {
            var deletedImage = $('#imagem-' + imageIndex);
            var inputImagens = $("#excluir_imagens");
            inputImagens.val(inputImagens.val() + deletedImage.data('image-name') + ',');
            deletedImage.remove();
            $("#btn-remover-imagem-" + imageIndex).remove();

        }

    </script>
@endsection --}}
