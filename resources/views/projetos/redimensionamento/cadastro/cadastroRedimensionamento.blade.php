@extends('_layouts._layout_site')


@section('head')
    <style>
        .bg-irr-claro{
            background-color: #1782b6;
            color: white;
        }

        .bg-irr-escuro{
            background-color: #013856;
            color: white;
        }

        tr,
        td,
        th {
            text-align: center;
            height: 38px;
            color: #162E3C !important;
        }

        .tabelaLinha td {
        padding: 0 5 0 0;
        vertical-align: middle;
        }

        .tabelaLinha thead th {
            vertical-align: baseline;
            border-bottom: 2px solid #dee2e6;
        }


        input, select {
            margin-bottom: 0px !important;
        }

        .tabelaMargin {
            padding-right: 0 !important;
        }

        table {
            background-color: #E2EFF7 !important;
        }

        .ocupar-100{
            width: 100%;
        }
        .form-group{
            margin-bottom: 0px !important;
        }

        .img-pointer{
            cursor: pointer;
        }

        input, select {
            margin-bottom: 15px;
        }
    </style>
@endsection

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">
            {{-- TITULO E SUBTITULO --}}
            <div class="col-6">
                <h1>@lang('redimensionamento.redimensionamento', ['fazenda' => session()->get('fazenda')['nome']])</h1>
            </div>
            {{-- BOTOES SALVAR E VOLTAR --}}
            <div class="col-6 text-right botoes mobile ">
                <a href="{{ route('gauging_status', $redimensionamento[0]['id_afericao']) }}" style="color: #3c8dbc" data-toggle="tooltip"
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
                <a class="nav-link active" id="primeiraEtapa-tab" data-toggle="tab" href="#primeiraEtapa" role="tab"
                    aria-controls="primeiraEtapa" aria-selected="true">@lang('redimensionamento.parametros')</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" id="imagem-tab" data-toggle="tab" href="#imagem" role="tab" aria-controls="imagem"
                    aria-selected="false">@lang('redimensionamento.curvaBomba')</a>
            </li>
        </ul>

        {{-- PRELOADER --}}
        <div id="coverScreen">
            <div class="preloader">
                <i class="fas fa-circle-notch fa-spin fa-2x"></i>
                <div>@lang('comum.preloader')</div>
            </div>
        </div>
    </div>

    <form action="{{route('atualizaRedimensionamento')}}" method="POST" id="formdados" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="put" />
        <input type="hidden" name="id_redimensionamento" value="{{$redimensionamento[0]['id_afericao']}}">
        <input type="hidden" name="id_adutora" value="{{$redimensionamento[0]['id_adutora']}}">
        <input type="hidden" name="vazao_final_redimensionamento" value="{{$vazao_final_redimensionamento}}">
        <input type="hidden" name="emissor" value="{{$emissores_redimensionamento}}">
        <input type="hidden" value="0" name="editar_emissores" id="editar_emissores">
        <input type="hidden" value="" name="excluir_imagens" id="excluir_imagens">
        <div class="tab-content small.required tab-validate mt-5" id="myTabContent">
            @include('_layouts._includes._alert')

            {{-- PARÂMETROS --}}
            <div class="tab-pane fade show active" id="primeiraEtapa" role="tabpanel" aria-labelledby="primeiraEtapa-tab">
                <div class="table-responsive m-auto " id="cssPreloader">

                    {{-- 1º ETAPA --}}
                    <div class="row">
                        <div class="col-md-4 tabelaMargin">
                            <table class="tabelaLinha table table-striped table-hover ">
                                <thead>
                                    <tr>
                                        <th>@lang('redimensionamento.primeiraEtapa')</th>
                                        <th>@lang('redimensionamento.redim')</th>
                                        <th>@lang('redimensionamento.afericao')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>@lang('redimensionamento.vazao') @lang('unidadesAcoes.(m3h)')</td>
                                        <td><input type="number" step="0.01" name="vazao" class="text-center col form-control"  value="{{ number_format($redimensionamento[0]->vazao_sistema, 2)}}"></td>
                                        <td>{{ number_format($afericao[0]->somatorio_vazao_ok, 2, ',', '.')}}</td>
                                    </tr>
                                    <tr>
                                        <td><label for="">@lang('redimensionamento.pressaoBomba')@lang('unidadesAcoes.(mca)')</label></td>
                                        <td><input type="number" step="0.01" name="pressao_bomba" class="text-center col form-control"value="{{ number_format($redimensionamento[0]->pressao_na_bomba, 2)}}"></td>
                                        <td>{{ number_format($afericao[0]->pressao_na_bomba, 2, ',', '.')}}</td>
                                    </tr>
                                    <tr>
                                        <td><label for="">@lang('redimensionamento.pressaoRequerida')@lang('unidadesAcoes.(mca)')</label></td>
                                        <td>{{ number_format($redimensionamento[0]->pressao_requerida, 2, ',', '.')}}</td>
                                        <td>{{ number_format($redimensionamento[0]->pressao_requerida, 2, ',', '.')}}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('redimensionamento.pressaoRequerida') 5.4.2 @lang('unidadesAcoes.(mca)')</td>
                                        <td>{{ number_format($redimensionamento[0]->pressao_5_4_2, 2, ',', '.')}}</td>
                                        <td>{{ number_format($redimensionamento[0]->pressao_5_4_2, 2, ',', '.')}}</td>
                                    </tr>
                                    <tr>
                                        <td><label for="">@lang('redimensionamento.hfAdutora')@lang('unidadesAcoes.(mca)')</label></td>
                                        <td>{{ number_format($redimensionamento[0]->hf_adutora, 2, ',', '.')}}</td>
                                        <td>{{ number_format($afericao[0]->hf_adutora, 2, ',', '.')}}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="col-md-4 tabelaMargin">
                            <table class="tabelaLinha table table-striped table-hover ">
                                <thead>
                                    <tr>
                                        <th>@lang('redimensionamento.primeiraEtapa')</th>
                                        <th>@lang('redimensionamento.redim')</th>
                                        <th>@lang('redimensionamento.afericao')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td><label for="">@lang('redimensionamento.desnivelMotobomba')@lang('unidadesAcoes.(mca)')</label></td>
                                        <td>{{ number_format($redimensionamento[0]->desnivel_motobomba, 2, ',', '.')}}</td>
                                        <td>{{ number_format($afericao[0]->desnivel_motobomba, 2, ',', '.')}}</td>
                                    </tr>

                                    <tr>
                                        <td><label for="">@lang('redimensionamento.pressaoCentro')@lang('unidadesAcoes.(mca)')</label></td>
                                        <td>{{ number_format($redimensionamento[0]->pressao_centro, 2, ',', '.')}}</td>
                                        <td>{{ number_format($afericao[0]->pressao_centro, 2, ',', '.')}}</td>
                                    </tr>

                                    <tr>
                                        <td><label for="">@lang('redimensionamento.hfParteAerea')@lang('unidadesAcoes.(mca)')</label></td>
                                        <td>{{ number_format($redimensionamento[0]->somatorio_perda_carga_real * 1.1, 2, ',', '.')}}</td>
                                        <td>{{ number_format($afericao[0]->somatorio_perda_carga_real * 1.1, 2, ',', '.')}}</td>
                                    </tr>

                                    <tr>
                                        <td><label for="">@lang('redimensionamento.desnivelMaisAlto')@lang('unidadesAcoes.(m)')</label></td>
                                        <td>{{ number_format($redimensionamento[0]->desnivel_total, 2, ',', '.')}}</td>
                                        <td>{{ number_format($afericao[0]->desnivel_total, 2, ',', '.')}}</td>
                                    </tr>

                                    <tr>
                                        <td><label for="">@lang('redimensionamento.pressaoPontaCalculada')@lang('unidadesAcoes.(mca)')</label></td>
                                        <td>{{ number_format($redimensionamento[0]->pressao_ponta, 2, ',', '.')}}</td>
                                        <td>{{ number_format($afericao[0]->pressao_ponta, 2, ',', '.')}}</td>
                                    </tr>

                                    <tr>
                                        <td><label for="">@lang('redimensionamento.pressaoPontaRequerida')@lang('unidadesAcoes.(mca)')</label></td>
                                        <td>{{ number_format($redimensionamento[0]->pressao_ponta_requerida, 2, ',', '.')}}</td>
                                        <td>{{ number_format($afericao[0]->pressao_ponta_requerida, 2, ',', '.')}}</td>
                                    </tr>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="col-md-4">
                            <table class="tabelaLinha table table-striped table-hover ">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>@lang('redimensionamento.redim')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>@lang('redimensionamento.vazaoFinal')</td>
                                        <td>{{ number_format($vazao_final_redimensionamento['soma'], 2) }}</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>@lang('redimensionamento.utilizarPlug')</td>
                                        <td>
                                            <select disabled name="utilizar_pressao_centro" id="utilizar_pressao_centro" class="form-control">
                                                <option value="sim">@lang('fichaTecnica.sim')</option>
                                                <option value="nao">@lang('fichaTecnica.nao')</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>@lang('redimensionamento.utilizarPressaoCentro')</td>
                                        <td>
                                            <select disabled name="utilizar_pressao_centro" id="utilizar_pressao_centro" class="form-control">
                                                <option value="sim">@lang('fichaTecnica.sim')</option>
                                                <option value="nao">@lang('fichaTecnica.nao')</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>@lang('redimensionamento.utilizarPlugAteTorre')</td>
                                        <td><input class="text-center col form-control" name="lances_c_plug" type="number" value="{{$redimensionamento[0]->lances_c_plug}}"></td>
                                    </tr>

                                    <tr>
                                        <td>@lang('redimensionamento.espacamentoMaximoPlug')</td>
                                        <td><input class="text-center col form-control" name="espacamento_maximo_plug" type="number" value="{{$redimensionamento[0]->espacamento_maximo_plug}}"></td>
                                    </tr>

                                    <tr>
                                        <td>@lang('redimensionamento.emissoresComPlugInicio')</td>
                                        <td><input class="text-center col form-control" type="number" name="num_emissores_c_plug_inicio" value="{{$redimensionamento[0]->num_emissores_c_plug_inicio}}"></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    {{-- 2º ETAPA --}}
                    <div class="row mb-5 ">
                        <div class="col-md-4 tabelaMargin">
                            <table class="tabelaLinha table table-striped table-hover ">
                                <thead>
                                    <tr>
                                        <th>@lang('redimensionamento.segundaEtapa')</th>
                                        <th>@lang('redimensionamento.redim')</th>
                                        <th>@lang('redimensionamento.afericao')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td><label for="">@lang('redimensionamento.areaTotal')@lang('unidadesAcoes.(ha)')</label></td>
                                        <td>{{ number_format($redimensionamento[0]->area_total_com_canhao, 2, ',', '.')}}</td>
                                        <td>{{ number_format($afericao[0]->area_total_com_canhao, 2, ',', '.')}}</td>
                                    </tr>
                                    <tr>
                                        <td><label for="">@lang('redimensionamento.areaSemCanhao')@lang('unidadesAcoes.(ha)')</label></td>
                                        <td>{{ number_format($redimensionamento[0]->area_total, 2, ',', '.')}}</td>
                                        <td>{{ number_format($afericao[0]->area_total, 2, ',', '.')}}</td>
                                    </tr>
                                    <tr>
                                        <td><label for="">@lang('redimensionamento.lamina')@lang('unidadesAcoes.(mm)')</label></td>
                                        <td>{{ number_format($redimensionamento[0]->lamina, 2, ',', '.')}}</td>
                                        <td>{{ number_format($afericao[0]->lamina, 2, ',', '.')}}</td>
                                    </tr>
                                    <tr>
                                        <td><label for="">@lang('redimensionamento.tempoFuncionamento')@lang('unidadesAcoes.(h)')</label></td>
                                        <td>{{ number_format($redimensionamento[0]->tempo, 0, ',', '.')}}</td>
                                        <td>{{ number_format($afericao[0]->tempo, 0, ',', '.')}}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('redimensionamento.valvula')</td>
                                        <td>
                                            <select  onchange="editarEmissores()" class='form-control' required='true' id="valv_reguladoras" name='valv_reguladoras'>
                                                <option @if($redimensionamento[0]->valvula_reguladora == 10) selected @endif value='10'><b>10 PSI</b></option>
                                                <option @if($redimensionamento[0]->valvula_reguladora == 15) selected @endif value='15'><b>15 PSI</b></option>
                                                <option @if($redimensionamento[0]->valvula_reguladora == 20) selected @endif  value='20'><b>20 PSI</b></option>
                                                <option @if($redimensionamento[0]->valvula_reguladora == 25) selected @endif  value='25'><b>25 PSI</b></option>
                                                <option @if($redimensionamento[0]->valvula_reguladora == 30) selected @endif value='30'><b>30 PSI</b></option>
                                                <option @if($redimensionamento[0]->valvula_reguladora == 35) selected @endif  value='35'><b>35 PSI</b></option>
                                                <option @if($redimensionamento[0]->valvula_reguladora == 40) selected @endif value='40'><b>40 PSI</b></option>
                                                <option @if($redimensionamento[0]->valvula_reguladora == 45) selected @endif  value='45'><b>45 PSI</b></option>
                                                <option @if($redimensionamento[0]->valvula_reguladora == 50) selected @endif  value='50'><b>50 PSI</b></option>
                                            </select>    
                                        </td>

                                        <td>
                                            <select class='form-control text-center' required='true' disabled >
                                                <option @if($afericao[0]->valvula_reguladora == 10) selected @endif value='10'><b>10 PSI</b></option>
                                                <option @if($afericao[0]->valvula_reguladora == 15) selected @endif value='15'><b>15 PSI</b></option>
                                                <option @if($afericao[0]->valvula_reguladora == 20) selected @endif  value='20'><b>20 PSI</b></option>
                                                <option @if($afericao[0]->valvula_reguladora == 25) selected @endif  value='25'><b>25 PSI</b></option>
                                                <option @if($afericao[0]->valvula_reguladora == 30) selected @endif value='30'><b>30 PSI</b></option>
                                                <option @if($afericao[0]->valvula_reguladora == 35) selected @endif  value='35'><b>35 PSI</b></option>
                                                <option @if($afericao[0]->valvula_reguladora == 40) selected @endif value='40'><b>40 PSI</b></option>
                                                <option @if($afericao[0]->valvula_reguladora == 45) selected @endif  value='45'><b>45 PSI</b></option>
                                                <option @if($afericao[0]->valvula_reguladora == 50) selected @endif  value='50'><b>50 PSI</b></option>
                                            </select>    
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="">@lang('afericao.fabricante')</label></td>
                                        <td>
                                            <select name="marca_modelo_emissores">
                                                <option @if (strtoupper($redimensionamento[0]['modelo_emissores']) == 'I-WOB UP3') selected @endif value='I-WOB UP3'>
                                                    <b>@lang('afericao.i-wob-up3')</b>
                                                </option>
                                                <option @if (strtoupper($redimensionamento[0]['modelo_emissores']) == 'FABRIMAR') selected @endif value='Fabrimar'>
                                                    <b>@lang('afericao.fabrimar')</b>
                                                </option>
                                                <option @if (strtoupper($redimensionamento[0]['modelo_emissores']) == 'NELSON') selected @endif value='Nelson'>
                                                    <b>@lang('afericao.nelson')</b>
                                                </option>
                                                <option @if (strtoupper($redimensionamento[0]['modelo_emissores']) == 'SUPER SPRAY - UP3') selected @endif
                                                    value='Super Spray - UP3'>
                                                    <b>@lang('afericao.super-spray-up3')</b>
                                                </option>
                                                <option @if (strtoupper($redimensionamento[0]['modelo_emissores']) == 'SUPER SPRAY') selected @endif value='Super Spray'>
                                                    <b>@lang('afericao.super-spray')</b>
                                                </option>
                                                <option @if (strtoupper($redimensionamento[0]['modelo_emissores']) == 'I-WOB') selected @endif value='I-WOB'>
                                                    <b>@lang('afericao.i-wob')</b>
                                                </option>
                                                <option @if (strtoupper($redimensionamento[0]['modelo_emissores']) == 'TRASH BUSTER') selected @endif value='Trash Buster'>
                                                    <b>@lang('afericao.trash-buster')</b>
                                                </option>
                                                <option @if (strtoupper($redimensionamento[0]['modelo_emissores']) == 'KOMET') selected @endif value='Komet'>
                                                    <b>@lang('afericao.komet')</b>
                                                </option>
                                                <option @if (strtoupper($redimensionamento[0]['modelo_emissores']) == 'FAN SPRAY') selected @endif value='Fan Spray'>
                                                    <b>@lang('afericao.fan-spray')</b>
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <select disabled>
                                                <option @if (strtoupper($redimensionamento[0]['modelo_emissores']) == 'I-WOB UP3') selected @endif value='I-WOB UP3'>
                                                    <b>@lang('afericao.i-wob-up3')</b>
                                                </option>
                                                <option @if (strtoupper($redimensionamento[0]['modelo_emissores']) == 'FABRIMAR') selected @endif value='Fabrimar'>
                                                    <b>@lang('afericao.fabrimar')</b>
                                                </option>
                                                <option @if (strtoupper($redimensionamento[0]['modelo_emissores']) == 'NELSON') selected @endif value='Nelson'>
                                                    <b>@lang('afericao.nelson')</b>
                                                </option>
                                                <option @if (strtoupper($redimensionamento[0]['modelo_emissores']) == 'SUPER SPRAY - UP3') selected @endif
                                                    value='Super Spray - UP3'>
                                                    <b>@lang('afericao.super-spray-up3')</b>
                                                </option>
                                                <option @if (strtoupper($redimensionamento[0]['modelo_emissores']) == 'SUPER SPRAY') selected @endif value='Super Spray'>
                                                    <b>@lang('afericao.super-spray')</b>
                                                </option>
                                                <option @if (strtoupper($redimensionamento[0]['modelo_emissores']) == 'I-WOB') selected @endif value='I-WOB'>
                                                    <b>@lang('afericao.i-wob')</b>
                                                </option>
                                                <option @if (strtoupper($redimensionamento[0]['modelo_emissores']) == 'TRASH BUSTER') selected @endif value='Trash Buster'>
                                                    <b>@lang('afericao.trash-buster')</b>
                                                </option>
                                                <option @if (strtoupper($redimensionamento[0]['modelo_emissores']) == 'KOMET') selected @endif value='Komet'>
                                                    <b>@lang('afericao.komet')</b>
                                                </option>
                                                <option @if (strtoupper($redimensionamento[0]['modelo_emissores']) == 'FAN SPRAY') selected @endif value='Fan Spray'>
                                                    <b>@lang('afericao.fan-spray')</b>
                                                </option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="col-md-4 tabelaMargin">
                            <table class="tabelaLinha table table-striped table-hover ">
                                <thead>
                                    <tr>
                                        <th>@lang('redimensionamento.segundaEtapa')</th>
                                        <th>@lang('redimensionamento.redim')</th>
                                        <th>@lang('redimensionamento.afericao')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>@lang('redimensionamento.valvReg')</td>
                                        <td>
                                            <select class='form-control' onchange="editarEmissores()" name="tipo_valvula"  >
                                                <option @if($redimensionamento[1][0]['valvulas_reguladoras_tipo'] == 'LF') selected @endif value='LF'><b>LF</b></option>
                                                <option @if($redimensionamento[1][0]['valvulas_reguladoras_tipo'] == 'MF') selected @endif  value='MF'><b>MF</b></option>
                                                <option @if($redimensionamento[1][0]['valvulas_reguladoras_tipo'] == 'HF') selected @endif  value='HF'><b>HF</b></option>
                                                <option @if($redimensionamento[1][0]['valvulas_reguladoras_tipo'] == 'PSR') selected @endif  value='PSR'><b>PSR</b></option>
                                            </select>   
                                        </td>
                                        <td>
                                            <select class='form-control' disabled >
                                                <option @if($afericao[1][0]['valvulas_reguladoras_tipo'] == 'LF') selected @endif value='LF'><b>LF</b></option>
                                                <option @if($afericao[1][0]['valvulas_reguladoras_tipo'] == 'MF') selected @endif  value='MF'><b>MF</b></option>
                                                <option @if($afericao[1][0]['valvulas_reguladoras_tipo'] == 'HF') selected @endif  value='HF'><b>HF</b></option>
                                                <option @if($afericao[1][0]['valvulas_reguladoras_tipo'] == 'PSR') selected @endif  value='PSR'><b>PSR</b></option>
                                            </select>    
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('redimensionamento.defletor')</td>
                                        <td><input name="defletor" class="text-center col form-control" type="text" value="{{ $redimensionamento[0]->defletor}}"></td>
                                        <td>{{ $afericao[0]->defletor}}</td>
                                     </tr>
                                    <tr>
                                        <td><label for="">@lang('redimensionamento.velocidade100')</label></td>
                                        <td>{{ number_format($redimensionamento[0]->tempo_a_100, 2, ',', '.')}}</td>
                                        <td>{{ number_format($afericao[0]->tempo_a_100, 2, ',', '.')}}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('redimensionamento.coeficienteRugosidadeA')</td>
                                        <td>{{ number_format($redimensionamento[0]->rugosidade_adutora, 2)}}</td>
                                        <td>{{ number_format($afericao[0]->rugosidade_adutora, 2, ',', '.')}}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('redimensionamento.coeficienteRugosidadeP')</td>
                                        <td>{{ number_format($redimensionamento[0]->coeficiente_rugosidade, 2)}}</td>
                                        <td>{{ number_format($afericao[0]->coeficiente_rugosidade, 2, ',', '.')}}</td>
                                    </tr>

                                    <tr>
                                        <td>@lang('redimensionamento.laminaAnual')@lang('unidadesAcoes.(mm/ha/ano)')</td>
                                        <td><input name="lamina_anual" class="text-center col form-control" type="text" value="{{ $redimensionamento[0]->lamina_anual}}"></td>
                                        <td>{{ number_format($afericao[0]->lamina_anual, 2, ',', '.')}}</td>
                                    </tr>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="col-md-4">
                            <table class="tabelaLinha table table-striped table-hover ">
                                <thead>
                                    <tr>
                                        <th>@lang('redimensionamento.segundaEtapa')</th>
                                        <th>@lang('redimensionamento.redim')</th>
                                        <th>@lang('redimensionamento.afericao')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>@lang('redimensionamento.custoMedio')@lang('unidadesAcoes.($/kWh)')</td>
                                        <td><input type="number" step="0.01" name="custo_medio" class="text-center col form-control" value="{{ number_format($redimensionamento[0]->custo_medio, 2)}}"></td>
                                        <td>{{ number_format($afericao[0]->custo_medio, 2, ',', '.')}}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('redimensionamento.alcanceCanhao')@lang('unidadesAcoes.(m)')</td>
                                        <td><input class="text-center col form-control" name="alcance_canhao_final" type="text" value="{{ number_format($redimensionamento[0]->alcance_canhao_final, 2, ',', '.')}}"></td>
                                        <td>{{ number_format($afericao[0]->alcance_canhao_final, 2, ',', '.')}}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('redimensionamento.vazaoCanhao')@lang('unidadesAcoes.(m3/h)')</td>
                                        <td><input class="text-center col form-control" name="vazao_canhao_final" type="text" value="{{ number_format($redimensionamento[0]->vazao_canhao_final, 2, ',', '.')}}"></td>
                                        <td>{{ number_format($afericao[0]->vazao_canhao_final, 2, ',', '.')}}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('redimensionamento.giroEquipamento')@lang('unidadesAcoes.(graus)')</td>
                                        <td><input type="number" step="1" max="360" min="0" name="giro_equipamento" class="text-center col form-control" value="{{ $redimensionamento[0]->angulo_pivo}}"></td>
                                        <td>{{ number_format($afericao[0]->angulo_pivo, 2, ',', '.')}}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CURVA DA BOMBA --}}
            <div class="tab-pane fade" id="imagem" role="tabpanel" aria-labelledby="imagem-tab">
                <div class="col-md-12">
                    <div class="form-row justify-content-start">
                        <div class="form-group col-md-4 telo5ce">
                            <div class="form-row justify-content-start">
                                <div class="col-6 text-center">@lang('redimensionamento.curvasDeBomba')</div>
                                <div class="form-group col-md-4 telo5ce" id="grid_images">
                                    @foreach ($imagens as $key => $imagem)
                                        <div style="display: grid">
                                            <img data-toggle="modal" data-target="#modalImagens" data-image-name="{{$imagem->getFileName()}}" id="imagem-{{$key}}" data-whatever="{{url('storage/projetos/redimensionamento/'.$redimensionamento[0]['id_afericao'] .'/'.$imagem->getFileName()) }}" src="{{url('storage/projetos/redimensionamento/'.$redimensionamento[0]['id_afericao'] .'/'.$imagem->getFileName())}}" class="img-thumbnail img-pointer" style="width: 100px; height: 100px" alt="" >
                                            <button class="btn btn-outline-danger btn-remover-imagem" onclick="excluirImagem({{$key}})" id="btn-remover-imagem-{{$key}}"  data-whatever="{{$key}}" type="button"> <i class="fa fa-trash"> </i> </button>
                                        </div> 
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <div class="form-control">
                                    <input type="file" accept=".jpg" id="imagens_curvas_bomba" multiple class="file-input"  name="images[]">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="modalImagens" tabindex="-1" role="dialog" aria-labelledby="modalImagensLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-irr-escuro">
                    <h5 class="modal-title" ><b> @lang('redimensionamento.curvasDeBomba') </b></h5>
                    <button type="button" class="btn btn-danger close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="img_modal" src="" alt="" class="img img-thumbnail w-100">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('unidadesAcoes.fechar')</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    {{-- FILTRO SELECT --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
    integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    
    <script>
        function editarEmissores(){
            $("#editar_emissores").val("1");
        }

        $('#modalImagens').on('show.bs.modal', function (event) {
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
            for (var i = 0; i < this.files.length; i++)
            {
                element = this.files[i];
                if(element.size > 1000000){
                    alert("@lang('redimensionamento.tamanhoMaximo')");
                    this.value = "";
                };
            }
            addUploadedImagesToGallery(this);
        };

        function addUploadedImagesToGallery(input){
            var countFiles = $(input)[0].files.length;
            $( ".adicionada" ).each(function( index ) {
                $( this ).remove();
            });
            if(countFiles > 0){
                var imgPath = $(input)[0].value;
                var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
                var image_holder = $("#grid_images");

                if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                    if (typeof (FileReader) != "undefined") {
                        
                        for (var i = 0; i < countFiles; i++) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $("<img />", {
                                    "src": e.target.result,
                                    "class": "img-thumbnail adicionada img-pointer",
                                    'height': '100',
                                    'width': '100',
                                    'data-target': "#modalImagens",
                                    'data-whatever': e.target.result,
                                    'data-toggle':"modal"
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
            }else{
                var image_holder = $("#grid_images");
                var count = $("#grid_images img").length;
                if(count == 0){
                    $("<img />", {
                        "src": "{{asset('img/symbols/upload_img.png')}}",
                        "class": "img-thumbnail adicionada",
                        'height': '100',
                        'width': '100'
                    }).appendTo(image_holder);
                }
            }
        }

        function excluirImagem(imageIndex){
            var deletedImage = $('#imagem-' + imageIndex);
            var inputImagens = $("#excluir_imagens");
            inputImagens.val( inputImagens.val() + deletedImage.data('image-name') + ',' );
            deletedImage.remove();
            $("#btn-remover-imagem-" + imageIndex).remove();

        }

    </script>

    {{-- SALVAR E VALIDAR CAMPOS VAZIOS --}}
    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
    <script>
        $(document).ready(function() {
            $('#botaosalvar').on('click', function() {
                $('#formdados').submit();
            });

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
                    "vazao": {
                        required: true
                    },
                    "pressao_bomba": {
                        required: true
                    },
                    "giro_equipamento": {
                        required: true
                    },
                    "rugosidade_adutora": {
                        required: true
                    },
                    "valv_reguladoras": {
                        required: true
                    },
                    "marca_modelo_emissores": {
                        required: true
                    },
                    "alcance_canhao_final": {
                        required: true
                    },
                    "rugosidade_pivo": {
                        required: true
                    },
                    "lamina_anual": {
                        required: true
                    },
                    "custo_medio": {
                        required: true
                    },
                    "defletor": {
                        required: true
                    },
                    "tipo_valvula": {
                        required: true
                    },
                    "vazao_canhao_final": {
                        required: true
                    },
                    "utilizar_pressao_centro": {
                        required: true
                    },
                    "lances_c_plug": {
                        required: true
                    }
                },
                messages: {
                    vazao: "Campo <strong>VAZÃO</strong> é obrigatório",

                    "pressao_bomba": {
                        required: "Campo <strong>PRESSÃO NA BOMBA</strong> é obrigatório"
                    },
                    "giro_equipamento": {
                        required: "Campo <strong>GIRO DO EQUIPAMENTO</strong> é obrigatório"
                    },
                    "rugosidade_adutora": {
                        required: "Campo <strong>COEF. DE RUGOSIDADE ADUTORA</strong> é obrigatório"
                    },
                    "alcance_canhao_final": {
                        required: "Campo <strong>ALCANÇE DO CANHÃO</strong> é obrigatório"
                    },
                    "rugosidade_pivo": {
                        required: "Campo <strong>COEF. RUGOSIDADE PIVÔ</strong> é obrigatório"
                    },
                    "lamina_anual": {
                        required: "Campo <strong>LÂMINA ANUAL</strong> é obrigatório"
                    },
                    "custo_medio": {
                        required: "Campo <strong>CUSTO MÉDIO</strong> é obrigatório"
                    },
                    "defletor": {
                        required: "Campo <strong>DEFLETOR</strong> é obrigatório",
                    },
                    "vazao_canhao_final": {
                        required: "Campo <strong>VAZÃO DO CANHÃO</strong> é obrigatório"
                    },
                    "lances_c_plug": {
                        required: "Campo <strong>PLUG</strong> é obrigatório"
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
        });

        $(window).on('load', function() {
            $("#coverScreen").hide();
        });

    </script>
@endsection