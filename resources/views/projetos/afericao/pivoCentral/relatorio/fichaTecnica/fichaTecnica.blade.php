<!DOCTYPE html>

<style>
    .cor-fundo {
        background-color: #005F8D;
        color: white;
    }

    .topo_detalhe {
        height: 100px;
        background-color: #E2EFF7 !important;
        margin-bottom: 20px;
        color: #3c8dbc;
    }

    form>div>div>div>.imprimir {
        display: inline-block;
        cursor: pointer;
        border: none !important;
        outline: none !important;
        background-color: #3c8dbc !important;
        padding: 15px;
        border-radius: 50%;
    }

    form>.voltar {
        display: inline-block;
        cursor: pointer;
        border: none !important;
        outline: none !important;
        float: right;
        margin-right: -10px;
        margin-top: 29px;
        border-radius: 50%;
    }

    form>div>div>div>.salvar>.fa-2x {
        font-size: 1.77em !important;
    }
    
    form>div>div>div>.salvar {
        border: none;
        outline: none;
        cursor: pointer;
        padding: 0;
    }

    .fa-stack-1x, .fa-stack-2x {
        background-color: #3c8dbc;
        border-radius: 50%;
    }

    .botoes {
        margin-top: 20px;
    }
    button svg {
        color: #fff;
    }

</style>

<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highcharts/7.1.2/css/highcharts.css"
        integrity="sha256-4bpG/e3EbIONg49CHrSw5c4jzs+8fb4eQbTJTibHWdw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />
    <!-- choose one -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous" />
    <link rel="stylesheet" href="https:
        //cdnjs.cloudflare.com/ajax/libs/highcharts/7.1.2/css/highcharts.css" integrity="sha256-4bpG/e3EbIONg49CHrSw5c4jzs+8fb4eQbTJTibHWdw="
        crossorigin="anonymous"   />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <title>@lang('redimensionamento.ftRedimensionamento')</title>
    <style>
        hr {
            background-color: black;
            margin-top: 0.25rem;
            margin-bottom: 0.25rem;
        }

        .table td,
        .table th {
            padding: 0rem;
        }

        textarea {
            text-align: justify;
        }

        /* TOOLTIPS */

        .tooltip-inner {
            background-color: transparent;
            color: #162E3C;
            padding: 10px;
        }

        .bs-tooltip-auto[x-placement^=bottom] .arrow::before,
        .bs-tooltip-bottom .arrow::before,
        .bs-tooltip-auto[x-placement^=left] .arrow::before,
        .bs-tooltip-left .arrow::before,
        .bs-tooltip-auto[x-placement^=right] .arrow::before,
        .bs-tooltip-right .arrow::before {
            border-bottom-color: transparent;
            border-left-color: transparent;
            border-right-color: transparent;
        }

        .bs-tooltip-auto[x-placement^=bottom],
        .bs-tooltip-bottom {
            margin-top: -15px;
        }

        .nav-tabs {
            margin-top: -62px;
        }

        
    </style>
</head>

<body>
    <form class="topo_detalhe" id="topo_detalhe">
        <div class="container-fluid topo">
            <div class="row align-items-start">
                {{-- TITULO E SUBTITULO --}}
                <div class="col-6">
                </div>
    
                <div class="col-6 text-right botoes position">
                    <a href="javascript:history.back()" class="voltar">
                        <span class="fa-stack fa-lg">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fas fa-angle-double-left fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <button id="imprimir" class="imprimir" data-toggle="tooltip" data-placement="bottom" title="Imprimir">
                        <i data-feather="printer"></i>
                    </button>
                    <button type="button" id="botaosalvar" class="salvar" data-toggle="tooltip" data-placement="bottom" title="Salvar">
                        <span class="fa-stack fa-2x">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fas fa-save fa-stack-1x fa-inverse"></i>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </form>

    {{-- NAVTAB'S --}}
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="iGerais-tab" data-toggle="tab" href="#iGerais" role="tab"
                aria-controls="iGerais" aria-selected="true">@lang('fichaTecnica.fichaTecnica')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="consideracoes-tab" data-toggle="tab" href="#consideracoes" role="tab"
                aria-controls="consideracoes" aria-selected="false">@lang('fichaTecnica.fichaBocais')
            </a>
        </li>
        @if ($dados_ficha_tecnica->tipo_projeto == 'R')
            <li class="nav-item">
                <a class="nav-link" id="pAerea-tab" data-toggle="tab" href="#pAerea" role="tab" aria-controls="pAerea"
                    aria-selected="false">@lang('fichaTecnica.bocaisComprar')
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" id="pivoConjugado-tab" data-toggle="tab" href="#pivoConjugado" role="tab"
                aria-controls="pivoConjugado" aria-selected="false">@lang('fichaTecnica.funcionamento_pivo')</a>
        </li>
    </ul>

    <div class="tab-content small.required tab-validate mt-4" id="myTabContent">
        @include('_layouts._includes._alert')

        {{-- FICHA TÉCNICA PRINCIPAL --}}
        <div class="tab-pane fade show active" id="iGerais" role="tabpanel" aria-labelledby="iGerais-tab">
            <div class="col-md-12 formpivocentral" id="cssPreloader">
                <form action="{{ route('update_datasheet')}}" method="POST" id="formdados">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id_ficha_tecnica }}">
                    <input type="hidden" name="versoes" value="{{ $dados_ficha_tecnica->versoes }}">
                    <div class="container">
                        <div class="do-not-break col-12" style="height: 2%; background-color: #005f8d; padding: 10px">
                            <div class="row">
                                <div class="col-2">
                                    <img src="{{ asset('img/logos/logo.png') }}" style="height: 50px"
                                        class="img-responsive mx-auto d-block" alt="">
                                </div>
                                <div class="col-4"></div>
                                <div class="col-6 row text-light text-right">
                                    <div class="col-12">
                                        <b>@lang('usuarios.consultor'): {{ $dados_ficha_tecnica->nome_consultor }}</b>
                                    </div>
                                    <div class="col-12">
                                        <b><i class="fa fa-fw fa-envelope"></i> {{ $dados_ficha_tecnica->email_consultor }} | <i
                                                class="fa fa-fw fa-phone"></i> {{ $dados_ficha_tecnica->telefone_consultor }}</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="do-not-break">
                            <!--Pivo Central-->
                            <div class="text-center cor-fundo">
                                @if ($dados_ficha_tecnica->tipo_projeto == 'R')
                                    <h2><b>@lang('redimensionamento.ftRedimensionamento')</b></h2>
                                @else
                                    <h2><b>@lang('fichaTecnica.ftPivoCentralDiagnostico')</b></h2>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-2 ">
                                    <b>@lang('fichaTecnica.proprietario'):</b>
                                </div>
                                <div class="col-md-4">
                                    {{ $dados_ficha_tecnica->nome_proprietario }}
                                </div>
                                <div class="col-md-2">
                                    <b>@lang('fichaTecnica.propriedade'):</b>
                                </div>
                                <div class="col-md-4">
                                    {{ $dados_ficha_tecnica->nome_fazenda }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <b>@lang('fichaTecnica.municipio'):</b>
                                </div>
                                <div class="col-md-4">
                                    {{ $dados_ficha_tecnica->cidade_fazenda }}
                                </div>
                                <div class="col-md-2">
                                    <b>@lang('fichaTecnica.estado'):</b>
                                </div>
                                <div class="col-md-4">
                                    {{ $dados_ficha_tecnica->estado_fazenda }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <b>@lang('fichaTecnica.pivoCentralFixo'):</b>
                                </div>
                                <div class="col-md-4">
                                    {{ $dados_ficha_tecnica->nome_pivo }}
                                </div>
                                <div class="col-md-2">
                                    <b>@lang('fichaTecnica.modeloEquipamento'):</b>
                                </div>
                                <div class="col-md-4">
                                    {{ $dados_ficha_tecnica->fabricante_pivo . '-' . $dados_ficha_tecnica->nome_modelo_pivo }}
                                </div>
                            </div>
                
                            <div class="row">
                                <div class="col-md-2">
                                    <b>@lang('fichaTecnica.coordenadas'):</b>
                                </div>
                                <div class="col-md-2" style="font-size: 14px;">
                                    {{ $dados_coordenadas[0]['longitude'] . ' / ' . $dados_coordenadas[0]['latitude'] }}
                                </div>
                                <div class="col-md-2">
                                    <b>@lang('fichaTecnica.conjugado'):</b>
                                </div>
                                <div class="col-md-2">
                                    @lang('fichaTecnica.' . $dados_ficha_tecnica->conjugado)
                                </div>
                                <div class="col-md-2">
                                    <b>@lang('fichaTecnica.data'):</b>
                                </div>
                                <div class="col-md-2">
                                    {{ date('d/m/Y', strtotime($dados_ficha_tecnica->data_afericao)) }}
                                </div>
                            </div>
                
                            <!------------------------------------------------------------------------------------------------>
                
                            <hr>
                            <!--Composição da parte aérea-->
                            <div>
                                <h5><b>@lang('fichaTecnica.composicaoParteAerea'){{ $texto_composicao }}</b></h5>
                            </div>
                            <!------------------------------------------------------------------------------------------------>
                            <hr>
                
                            <div class="row">
                                <div class="col-md-3"><b>@lang('fichaTecnica.areaTotal')</b>@lang('unidadesAcoes.(ha)'):</div>
                                <div class="col-md-1">
                                    {{ number_format($dados_velocidade['area_total_com_canhao'], 2, ',', '.') }}
                                </div>
                                <div class="col-md-3"><b>@lang('fichaTecnica.laminaDiaria')</b>@lang('unidadesAcoes.(mm)'):</div>
                                <div class="col-md-1">
                                    {{ number_format($dados_mapa_original[0]['lamina'], 2, ',', '.') }}
                                </div>
                                <div class="col-md-3"><b>@lang('fichaTecnica.raioIrrigado')</b>@lang('unidadesAcoes.(m)'):</div>
                                <div class="col-md-1">
                                    {{ number_format($dados_velocidade['raio_irrigado'], 2, ',', '.') }}
                                </div>
                            </div>
                
                            <div class="row">
                                <div class="col-md-3"><b>@lang('fichaTecnica.giroEquipamento'):</b></div>
                                <div class="col-md-1">
                                    {{ $dados_velocidade['angulo_pivo'] }}@lang('unidadesAcoes.(graus)')
                                </div>
                                <div class="col-md-3"><b>@lang('fichaTecnica.vazaoTotal')</b>@lang('unidadesAcoes.(m3/h)'):</div>
                                <div class="col-md-1">
                                    {{ number_format($dados_mapa_original[0]['vazao_sistema'], 2, ',', '.') }}
                                </div>
                                <div class="col-md-3"><b>@lang('fichaTecnica.uniformidadeAplicacao'):</b></div>
                                <div class="col-md-1">
                                    {{ number_format($dados_mapa_original[0]['uniformidade_aplicacao']) }} %
                                </div>
                            </div>
                
                            <div class="row">
                                <div class="col-md-3"><b>@lang('fichaTecnica.raioUltimaTorre')</b>@lang('unidadesAcoes.(m)'):</div>
                                <div class="col-md-1">
                                    {{ number_format($dados_mapa_original[0]['raio_ultima_torre'], 2, ',', '.') }}
                                </div>
                                <div class="col-md-3"><b>@lang('fichaTecnica.balanco')</b>:</div>
                                <div class="col-md-1">
                                    {{ number_format($dados_mapa_original[0]['balanco'], 2, ',', '.') }}
                                </div>
                                <div class="col-md-3"><b>@lang('fichaTecnica.velocidade100')</b>@lang('unidadesAcoes.(m/h)'):</div>
                                <div class="col-md-1">
                                    {{ number_format($dados_velocidade_red['verificacao_velocidade']['media_velocidade'], 2, ',', '.') }}
                                </div>
                            </div>
                
                            <div class="row">
                                <div class="col-md-3"><b>@lang('fichaTecnica.valvReguladoras')</b>:</div>
                                <div class="col-md-1">
                                    {{ $afericao['valv_reguladoras'] . ' PSI' }}
                                </div>
                                <div class="col-md-3"><b>@lang('fichaTecnica.alcanceCanhao')</b>@lang('unidadesAcoes.(m)'):</div>
                                <div class="col-md-1">
                                    {{ number_format($dados_mapa_original[0]['alcance_canhao_final'], 2, ',', '.') }}
                                </div>
                                <div class="col-md-3"><b>@lang('fichaTecnica.tempo100')</b>@lang('unidadesAcoes.(h)'):</div>
                                <div class="col-md-1">
                                    {{ number_format($dados_mapa_original[0]['tempo_a_100'], 2, ',', '.') }}
                                </div>
                            </div>
                
                            <div class="row">
                                <div class="col-md-2"><b>@lang('fichaTecnica.emissores')</b>:</div>
                                <div class="col-md-2 text-right">
                                    @if (!empty($afericao['marca_modelo_emissores']))
                                    {{ $afericao['marca_modelo_emissores'] }} @else - @endif
                                </div>
                                <div class="col-md-3"><b>@lang('fichaTecnica.numEmissores')</b>:</div>
                                <div class="col-md-1">
                                    {{ $dados_mapa_original[0]['numero_saidas_sem_plug'] }}
                                </div>
                                <div class="col-md-3"><b>@lang('fichaTecnica.alturaEmissores')</b>@lang('unidadesAcoes.(m)'):</div>
                                <div class="col-md-1">
                                    {{ number_format($dados_velocidade['altura_emissores'], 2, ',', '.') }}
                                </div>
                            </div>
                
                            <div class="row">
                                <div class="col-md-3"><b>@lang('fichaTecnica.tipoPainel')</b>:</div>
                                <div class="col-md-1">
                                    @if (!empty($afericao['tipo_painel']))
                                        {{ $afericao['tipo_painel'] }}@else - @endif
                                </div>
                                <div class="col-md-3"><b>@lang('fichaTecnica.defletor')</b>:</div>
                                <div class="col-md-1">
                                    @if (!empty($afericao['defletor'])) {{ $afericao['defletor'] }}
                                    @else - @endif
                                </div>
                                <div class="col-md-3"><b>@lang('fichaTecnica.revestimento')</b>:</div>
                                <div class="col-md-1">
                                    @if (!empty($afericao['defletor']))
                                    {{ $afericao['revestimento'] }} @else - @endif
                                </div>
                            </div>
                
                            <div class="row">
                                <div class="col-md-3"><b>@lang('fichaTecnica.pivoConjugado')</b>:</div>
                                <div class="col-md-1">
                                    @lang('fichaTecnica.' . $dados_ficha_tecnica->conjugado)
                                </div>
                                <div class="col-md-3"><b>@lang('fichaTecnica.laminaConjugada')</b>@lang('unidadesAcoes.(mm)'):</div>
                                <div class="col-md-1">
                                    {{ number_format($lamina_conjugada, 2, ',', '.') }}
                                </div>
                                <div class="col-md-3"><b>@lang('fichaTecnica.areaConjugada')</b>@lang('unidadesAcoes.(ha)'):</div>
                                <div class="col-md-1">
                                @if ($dados_ficha_tecnica->conjugado == 'sim') - @else
                                        @lang('fichaTecnica.nao') @endif
                                </div>
                            </div>
                            <!------------------------------------------------------------------------------------------------>
                        </div>

                            <!--Adutora-->
                        <div class="do-not-break">
                            <div class="text-center cor-fundo">
                                <h4><b>@lang('fichaTecnica.adutora')</b></h4>
                            </div>
                            <div class="row">
                                <div class="col-md-1 text-center">
                                    <b>@lang('fichaTecnica.trecho')</b>
                                </div>
                                <div class="col-md-2 text-center">
                                    <b>@lang('fichaTecnica.diametro')</b>@lang('unidadesAcoes.(m)')
                                </div>
                                <div class="col-md-2 text-center">
                                    <b>@lang('fichaTecnica.material')</b>
                                </div>
                                <div class="col-md-2 text-center">
                                    <b>@lang('fichaTecnica.comprimento')</b>@lang('unidadesAcoes.(m)')
                                </div>
                                <div class="col-md-1 text-center">
                                    <b>@lang('fichaTecnica.hf')</b>@lang('unidadesAcoes.(mca)')
                                </div>
                                <div class="col-md-2 text-center">
                                    <b>@lang('fichaTecnica.pressao')</b>@lang('unidadesAcoes.(mca)')
                                </div>
                                <div class="col-md-2 text-center">
                                    <b>@lang('fichaTecnica.velocidade')</b>@lang('unidadesAcoes.(m/s)')
                                </div>
                            </div>
                            <hr>
                            @foreach ($trechos_adutora as $key => $trecho)
                                <div class="row">
                                    <div class="col-md-1 text-center">
                                        {{ $key + 1 }}
                                    </div>
                                    <div class="col-md-2 text-center">
                                        {{ number_format($trecho['diametro'], 2, ',', '.') }}
                                    </div>
                                    <div class="col-md-2 text-center">
                                        @if ($trecho['tipo_cano'] == 0) @lang('afericao.acoSac')@endif
                                        @if ($trecho['tipo_cano'] == 1) @lang('afericao.az')@endif
                                        @if ($trecho['tipo_cano'] == 2) @lang('afericao.ferroFundido')@endif
                                        @if ($trecho['tipo_cano'] == 3) PVC PN 125 @endif
                                        @if ($trecho['tipo_cano'] == 4) PVC PN 140 @endif
                                        @if ($trecho['tipo_cano'] == 5) PVC PN 180 @endif
                                        @if ($trecho['tipo_cano'] == 6) PVC PN 60 @endif
                                        @if ($trecho['tipo_cano'] == 7) PVC PN 80 @endif
                                        @if ($trecho['tipo_cano'] == 8) RPVC PN 100 @endif
                                        @if ($trecho['tipo_cano'] == 9) @lang('afericao.aluminio')@endif
                                    </div>
                                    <div class="col-md-2 text-center">
                                        {{ number_format($trecho['comprimento'], 2, ',', '.') }}
                                    </div>
                                    <div class="col-md-1 text-center">
                                        {{ number_format($dados_adutora[$key]['hf'], 2, ',', '.') }}
                                    </div>
                                    <div class="col-md-2 text-center">
                                        {{ number_format($dados_adutora[$key]['pressao_inicial'], 0) }} /
                                        {{ number_format($dados_adutora[$key]['pressao_final'], 0) }}
                                    </div>
                                    <div class="col-md-2 text-center">
                                        {{ number_format($dados_adutora[$key]['velocidade'], 2, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                            <hr>
                            <div class="row">
                                <div class="col-md-5">
                                    <b>@lang('fichaTecnica.total')</b>
                                </div>
                                <div class="col-md-2 text-center">
                                    {{ number_format($dados_adutora['comprimento_total'], 2, ',', '.') }}
                                </div>
                                <div class="col-md-1 text-center">
                                    {{ number_format($dados_adutora['hf_total'], 2, ',', '.') }}
                                </div>
                            </div>
                        </div>

                        <!--Altura Manométrica-->
                        <div class="do-not-break">
                            <div class="text-center cor-fundo">
                                <h4><b>@lang('fichaTecnica.alturaMonometrica')</b>:</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>@lang('fichaTecnica.desnivelCentroPontoMaisAlto')</b>@lang('unidadesAcoes.(m)'):
                                </div>
                                <div class="col-md-2">
                                    {{ number_format($dados_altura_manometrica['desnivel_centro_ponto_mais_alto'], 2, ',', '.') }}
                                </div>
                                <div class="col-md-4">
                                    <b>@lang('fichaTecnica.pressaoEntradaCentroPivo')</b>@lang('unidadesAcoes.(mca)'):
                                </div>
                                <div class="col-md-2">
                                    {{ number_format($dados_altura_manometrica['pressao_entrada_centro_pivo'], 2, ',', '.') }}
                                </div>
                            </div>
                
                            <div class="row">
                                <div class="col-md-4">
                                    <b>@lang('fichaTecnica.perdaCargaParteAerea')</b>@lang('unidadesAcoes.(mca)'):
                                </div>
                                <div class="col-md-2">
                                    {{ number_format($dados_altura_manometrica['perda_carga_parte_aerea'], 2, ',', '.') }}
                                </div>
                
                
                                <div class="col-md-4">
                                    <b>@lang('fichaTecnica.desnivelMotobombaCentro')</b>@lang('unidadesAcoes.(m)'):
                                </div>
                                <div class="col-md-2">
                                    {{ number_format($dados_altura_manometrica['desnivel_motobomba_centro'], 2, ',', '.') }}
                                </div>
                
                
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <b>@lang('fichaTecnica.alturaEmissores')</b>@lang('unidadesAcoes.(m)'):
                                </div>
                                <div class="col-md-2">
                                    {{ number_format($dados_altura_manometrica['altura_emissores'], 2, ',', '.') }}
                                </div>
                
                                <div class="col-md-4">
                                    <b>@lang('fichaTecnica.perdaCargaTotalAdutora')</b>@lang('unidadesAcoes.(mca)'):
                                </div>
                                <div class="col-md-2">
                                    {{ number_format($dados_altura_manometrica['perda_carga_total_adutora'], 2, ',', '.') }}
                                </div>
                
                
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <b>@lang('fichaTecnica.pressaoPonta')</b>@lang('unidadesAcoes.(mca)'):
                                </div>
                                <div class="col-md-2">
                                    {{ number_format($dados_altura_manometrica['pressao_ponta'], 2, ',', '.') }}
                                </div>
                
                                <div class="col-md-4">
                                    <b>@lang('fichaTecnica.alturaMonometrica')</b>@lang('unidadesAcoes.(mca)'):
                                </div>
                                <div class="col-md-2">
                                    {{ number_format($dados_altura_manometrica['altura_manometrica_total_requerida'], 2, ',', '.') }}
                                </div>
                            </div>
                            <!------------------------------------------------------------------------------------------------>
                        </div>

                        <!--CONJUNTO MOTOBOMBA-->
                        <div class="do-not-break">
                            <div class="text-center cor-fundo">
                                <h4><b>@lang('fichaTecnica.conjuntoMotoBomba')</b></h4>
                            </div>
                            <div class='row'>
                                <div class="col-md-2 "><b>@lang('fichaTecnica.numBombas')</b></div>
                                <div class="col-md-2 text-center">{{ $cabecalho_bombeamento['numero_bombas'] }}</div>
                
                                <div class="col-md-2"><b>@lang('fichaTecnica.posicionamentoBombeamento')</b>:</div>
                                <div class="col-md-2 text-center">
                                    @if ($cabecalho_bombeamento['posicionamento_bombeamento'] == 0)
                                        @lang('afericao.simples') @endif
                                    @if ($cabecalho_bombeamento['posicionamento_bombeamento'] == 1)
                                        @lang('afericao.serie') @endif
                                    @if ($cabecalho_bombeamento['posicionamento_bombeamento'] == 2)
                                        @lang('afericao.paralelo') @endif
                                </div>
                
                                <div class="col-md-2 "><b>@lang('fichaTecnica.tipoInstalacao')</b>:</div>
                                <div class="col-md-2 text-center">
                                    @if ($cabecalho_bombeamento['tipo_instalacao'] == 0)
                                        @lang('afericao.direta') @endif
                                    @if ($cabecalho_bombeamento['tipo_instalacao'] == 1)
                                        @lang('afericao.afogada') @endif
                                    @if ($cabecalho_bombeamento['tipo_instalacao'] == 3)
                                        @lang('afericao.balsa') @endif
                                    @if ($cabecalho_bombeamento['tipo_instalacao'] == 4)
                                        @lang('afericao.submersa') @endif
                                </div>
                
                                <div class="col-md-2"><b>@lang('fichaTecnica.captacao')</b>:</div>
                                <div class="col-md-2 text-center">
                                    @if ($cabecalho_bombeamento['captacao'] == 0)
                                        @lang('afericao.acude') @endif
                                    @if ($cabecalho_bombeamento['captacao'] == 1)
                                        @lang('afericao.barragem') @endif
                                    @if ($cabecalho_bombeamento['captacao'] == 2)
                                        @lang('afericao.corrego') @endif
                                    @if ($cabecalho_bombeamento['captacao'] == 3)
                                        @lang('afericao.lago') @endif
                                    @if ($cabecalho_bombeamento['captacao'] == 4)
                                        @lang('afericao.lagoa') @endif
                                    @if ($cabecalho_bombeamento['captacao'] == 5)
                                        @lang('afericao.poco') @endif
                                </div>
                
                                <div class="col-md-2"><b>@lang('afericao.latitude')</b>:</div>
                                <div class="col-md-2 text-center">
                                    {{ number_format($cabecalho_bombeamento['latitude'], 6, ',', '.') }}
                                </div>
                
                                <div class="col-md-2"><b>@lang('afericao.longitude')</b>:</div>
                                <div class="col-md-2 text-center">
                                    {{ number_format($cabecalho_bombeamento['longitude'], 6, ',', '.') }}
                                </div>
                            </div>
                        </div>
                        <br>
                        @include('projetos.afericao.pivoCentral.relatorio.fichaTecnica.fichaTecnica2')
                    </div>
                </form>
            </div>
        </div>

        {{-- FICHA TÉCNICA BOCAIS --}}
        <div class="tab-pane fade" id="consideracoes" role="tabpanel" aria-labelledby="consideracoes-tab">
            <div class="do-not-break col-12">
                <div class="row">
                    <div class="col-2">
                        <img src="{{ asset('img/logos/logo.png') }}" style="height: 50px"
                            class="img-responsive mx-auto d-block" alt="">
                    </div>
                    <div class="col-4"></div>
                    <div class="col-6 row text-right">
                        <div class="col-12">
                        </div>
                        <div class="col-12">
                            <b>@lang('usuarios.consultor'): {{ $dados_ficha_tecnica->nome_consultor }}</b> |

                            <b><i class="fa fa-fw fa-envelope"></i> {{ $dados_ficha_tecnica->email_consultor }} | <i
                                    class="fa fa-fw fa-phone"></i> {{ $dados_ficha_tecnica->telefone_consultor }}</b>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            {{-- 1º INFORMAÇÕES CABEÇALHO --}}
            <div class="do-not-break col-12">
                <!--Pivo Central-->
                <div class="text-center">
                    @if ($dados_ficha_tecnica->tipo_projeto == 'R')
                        <h2 class="impressaoTitulo"><b>@lang('redimensionamento.ftRedimensionamento')</b></h2>
                    @else
                        <h2 class="impressaoTitulo"><b>@lang('fichaTecnica.ftPivoCentralDiagnostico')</b></h2>
                    @endif
                </div>
    
                <div class="row">
                    <div class="col-md-1 ">
                        <b>@lang('fichaTecnica.proprietario')</b>
                    </div>
                    <div class="col-md-3 text-center">
                        {{ $dados_ficha_tecnica->nome_proprietario }}
                    </div>
                    <div class="col-md-1 ">
                        <b>@lang('fichaTecnica.municipio')</b>
                    </div>
                    <div class="col-md-2 text-center">
                        {{ $dados_ficha_tecnica->cidade_fazenda }}
                    </div>
                    <div class="col-md-1">
                        <b>@lang('fichaTecnica.data')</b>
                    </div>
                    <div class="col-md-1 text-center">
                        {{ date('d/m/Y', strtotime($dados_ficha_tecnica->data_afericao)) }}
                    </div>
                    <div class="col-md-2"><b>@lang('fichaTecnica.defletor')</b></div>
                    <div class="col-md-1">
                        @if (!empty($afericao['defletor'])) {{ $afericao['defletor'] }}
                        @else - @endif
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-md-1">
                        <b>@lang('fichaTecnica.propriedade')</b>
                    </div>
                    <div class="col-md-3 text-center">
                        {{ $dados_ficha_tecnica->nome_fazenda }}
                    </div>
                    <div class="col-md-1"><b>@lang('fichaTecnica.emissores')</b></div>
                    <div class="col-md-1 text-center">
                        @if (!empty($afericao['marca_modelo_emissores']))
                        {{ $afericao['marca_modelo_emissores'] }} @else - @endif
                    </div>
                    <div class="col-md-1">
                        <b>@lang('fichaTecnica.modeloEquipamento')</b>
                    </div>
                    <div class="col-md-2 text-center">
                        {{ $dados_ficha_tecnica->fabricante_pivo . '-' . $dados_ficha_tecnica->nome_modelo_pivo }}
                    </div>
                    <div class="col-md-2"><b>@lang('fichaTecnica.valvReguladoras')</b></div>
                    <div class="col-md-1"> {{ $afericao['valv_reguladoras'] . ' PSI' }} </div>
                </div>
            </div>
    
            <hr>
    
            {{-- 2º TABELAS --}}
            <div class="do-not-break">
                
                <div class="row" style="font-size: 15.5px;">
                    <div class="col-12 m-auto row justify-content-start" id="cssPreloader">
    
                        @php
                            $id_lanceAtual = 0;
                            $linha_emissores = 0;
                        @endphp
    
                        @foreach ($dados_lances2 as $lances)
    
                            @if ($id_lanceAtual != $lances['numero_lance'])
                                <div class="col-md-2 colunas">
                                    <table border="1" class="col-12 mb-2 text-center" id="tabelaListaEmissores">
                                        <thead class="border border-right">
                                            <tr>
                                                <th colspan="4">
                                                    @if ($afericao['tem_balanco'] == 'sim' && $lances['numero_lance'] == $afericao['numero_lances'])
                                                        @lang('afericao.balanco')
                                                    @else
                                                        @lang('afericao.lance') {{ $lances['numero_lance'] }} 
                                                    @endif
                                                </th>
                                            </tr>
    
                                            <tr>
                                                <td>@lang('fichaTecnica.numerosEmissores')</td>
                                                <td>@lang('fichaTecnica.bocais')</td>
                                                <td>@lang('fichaTecnica.espacamento')</td>
                                                <td>@lang('fichaTecnica.valvula')</td>
                                            </tr>
                                        </thead>
    
                                        <tbody class="border">
    
                                            @php
                                                $linha_emissores = 0;
                                                $id_lanceAtual = $lances['numero_lance'];
                                            @endphp
                                        @endif
    
                                            @php
                                                $linha_emissores += 1;
                                            @endphp
                                            <tr>
                                                <td>
                                                    {{ $lances['numero'] }}
                                                </td>
                                                <td>
                                                    {{ $lances['saida_1'] }}
                                                </td>
                                                <td>
                                                    {{ $lances['espacamento'] }}
                                                </td>
                                                <td>
                                                    {{ $lances['psi'] }} PSI
                                                </td>
                                            </tr>
    
                                            @if ($lances['numero'] == $lances['numero_emissores'])
                                                @if ($lances['numero'] < $emissor_max)
                                                    @for ($i = 0; $i < $emissor_max - $lances['numero']; $i++) 
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                        </tr> 
                                                    @endfor 
                                                @endif
    
                                        </tbody>
    
                                        <tfoot class="border">
                                            <tr>
                                                <td colspan="2">@lang('fichaTecnica.numTubos')</td>
                                                <td colspan="2">
                                                    {{ $lances['numero_tubos'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">@lang('fichaTecnica.numEmissores')</td>
                                                <td colspan="2">
                                                    {{ $lances['numero_emissores'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">@lang('fichaTecnica.comprimento')</td>
                                                <td colspan="2">
                                                    {{ $lances['comprimento'] }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">@lang('fichaTecnica.diametro')</td>
                                                <td colspan="2">
                                                    {{ $lances['diametro'] }}
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                             @endif
                         @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- LISTA DE COMPRA DE BOCAIS --}}
        @if ($dados_ficha_tecnica->tipo_projeto == 'R')
            <div class="tab-pane fade" id="pAerea" role="tabpanel" aria-labelledby="pAerea-tab">
                {{-- CABEÇALHO --}}
                <div class="do-not-break col-12">
                    <div class="row">
                        <div class="col-2">
                            <img src="{{ asset('img/logos/logo.png') }}" style="height: 50px"
                                class="img-responsive mx-auto d-block" alt="">
                        </div>
                        <div class="col-4"></div>
                        <div class="col-6 row text-right">
                            <div class="col-12">
                                <b>@lang('usuarios.consultor'): {{ $dados_ficha_tecnica->nome_consultor }}</b>
                            </div>
                            <div class="col-12">
                                <b><i class="fa fa-fw fa-envelope"></i> {{ $dados_ficha_tecnica->email_consultor }} | <i
                                        class="fa fa-fw fa-phone"></i> {{ $dados_ficha_tecnica->telefone_consultor }}</b>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="do-not-break col-12">
                    <div class="text-center">
                        @if ($dados_ficha_tecnica->tipo_projeto == 'R')
                            <h2 class="impressaoTitulo"><b>@lang('redimensionamento.ftRedimensionamento')</b></h2>
                        @else
                            <h2 class="impressaoTitulo"><b>@lang('fichaTecnica.ftPivoCentralDiagnostico')</b></h2>
                        @endif
                    </div>
        
                    <div class="row justify-content-center">
                        <div class="col-md-1 ">
                            <b>@lang('fichaTecnica.proprietario')</b>
                        </div>
                        <div class="col-md-3 text-center">
                            {{ $dados_ficha_tecnica->nome_proprietario }}
                        </div>
                        <div class="col-md-1 ">
                            <b>@lang('fichaTecnica.municipio')</b>
                        </div>
                        <div class="col-md-2 text-center">
                            {{ $dados_ficha_tecnica->cidade_fazenda }}
                        </div>
                        <div class="col-md-2"><b>@lang('fichaTecnica.pivo_central')</b></div>
                        <div class="col-md-1">
                            {{ $dados_ficha_tecnica->nome_pivo }}
                        </div>
                    </div>
        
                    <div class="row justify-content-center">
                        <div class="col-md-1">
                            <b>@lang('fichaTecnica.propriedade')</b>
                        </div>
                        <div class="col-md-3 text-center">
                            {{ $dados_ficha_tecnica->nome_fazenda }}
                        </div>
                        <div class="col-md-2"><b>@lang('fichaTecnica.estado')</b></div>
                        <div class="col-md-1 text-center">
                            {{ $dados_ficha_tecnica->estado_fazenda }}
                        </div>
                        <div class="col-md-2">
                            <b>@lang('fichaTecnica.data')</b>
                        </div>
                        <div class="col-md-1 text-center">
                            {{ date('d/m/Y', strtotime($dados_ficha_tecnica->data_afericao)) }}
                        </div>
                    </div>
        
                    <div class="row justify-content-center">
                        <div class="col-md-1">
                            <b>@lang('fichaTecnica.emissores')</b>
                        </div>
                        <div class="col-md-3 text-center">
                            @if (!empty($afericao['marca_modelo_emissores']))
                            {{ $afericao['marca_modelo_emissores'] }} @else - @endif
                        </div>
                        <div class="col-md-2"><b>@lang('fichaTecnica.valvReguladoras')</b></div>
                        <div class="col-md-1 text-center">
                            {{ $afericao['valv_reguladoras'] . ' PSI' }}
                        </div>
                        <div class="col-md-2"><b>@lang('fichaTecnica.total_bocais')</b></div>
                        <div class="col-md-1">{{$total_bocais}}</div>
                    </div>
        
                    <div class="row justify-content-center">
                        <div class="col-md-1">
                            <b>@lang('fichaTecnica.coordenadas')</b>
                        </div>
                        <div class="col-md-3 text-center">
                            {{ $dados_coordenadas[0]['longitude'] . ' / ' . $dados_coordenadas[0]['latitude'] }}
                        </div>
                        <div class="col-md-2"><b>@lang('fichaTecnica.tudo_novo')</b></div>
                        <div class="col-md-1 text-center">
                            <select name="tudo_novo" id="tudo_novo" style="outline: none";>
                                <option value="1">@lang('comum.sim')</option>
                                <option value="0">@lang('comum.nao')</option>
                            </select>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
                <hr>
                {{-- TABELA --}}
                <div class="row" id="lista_bocais" style="display: none;">
                    @php
                        $qtd_colunas = count($lista_bocais_compra) / 10;
                        $qtd_colunas = (int)$qtd_colunas;
                        $resto_coluna = count($lista_bocais_compra) % 10;
                        $k = 10;
                        $ultimo_numero = 0;

                        if ($resto_coluna > 0 ) {
                            $colunas =  12 / ($qtd_colunas + 1) ;
                            $colunas = (int)$colunas;
                            $qtd_colunas = $qtd_colunas + 1;
                            if ($qtd_colunas == 1) {
                                $vl_col = 4;
                                $colunas = 4;
                            } else if ($qtd_colunas == 2) {
                                $vl_col = 3;
                                $colunas = 3;
                            } else if ($qtd_colunas == 3) {
                                $vl_col = 2;
                                $colunas = 8;
                            } 
                            $div_extra = '<div class="col-'.$vl_col.'"></div>';
                        } else {
                            $colunas =  (12 / $qtd_colunas);
                            $div_extra = '';
                        }
                        echo $div_extra;
                    @endphp
                    @for ($i = 0; $i < $qtd_colunas; $i++)
                        <div class="col-{{$colunas}}">
                            <div class="table-responsive m-auto" id="cssPreloader">
                                <table class="table table-striped text-center">
                                    <thead>
                                        <tr style="height: 50px">
                                            <th scope="col">@lang('fichaTecnica.bocal_1')</th>
                                            <th scope="col">@lang('fichaTecnica.totalAcomprar')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($j = $ultimo_numero; $j < $k; $j++)
                                            <tr>
                                                @if ($lista_bocais_compra[$j]['saida_1'] == 0)
                                                    <td>--</td>
                                                    <td>--</td>
                                                @else 
                                                    <td>{{ $lista_bocais_compra[$j]['saida_1'] }}</td>
                                                    <td>{{ $lista_bocais_compra[$j]['quantidade'] }}</td>
                                                @endif
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @php
                            $ultimo_numero = $k;
                            if ($i == $qtd_colunas - 1) $k = $k + $resto_coluna; else  $k = $k + 10;
                        @endphp
                    @endfor
                    @php
                        echo $div_extra;
                    @endphp
                </div>

                <div class="row" id="lista_bocais_comprar">
                    @php
                        $qtd_colunas = count($lista_saldo) / 10;
                        $qtd_colunas = (int)$qtd_colunas;
                        $resto_coluna = count($lista_saldo) % 10;
                        $m = 10;
                        $ultimo_numero = 0;

                        if ($resto_coluna > 0 ) {
                            $colunas =  12 / ($qtd_colunas + 1) ;
                            $colunas = (int)$colunas;
                            $qtd_colunas = $qtd_colunas + 1;
                            if ($qtd_colunas == 1) {
                                $vl_col = 4;
                                $colunas = 4;
                            } else if ($qtd_colunas == 2) {
                                $vl_col = 3;
                                $colunas = 3;
                            } else if ($qtd_colunas == 3) {
                                $vl_col = 2;
                                $colunas = 8;
                            }                            
                            $div_extra = '<div class="col-'.$vl_col.'"></div>';
                        } else {
                            $colunas =  (12 / $qtd_colunas);
                            $div_extra = '';
                        }
                        echo $div_extra;
                    @endphp
                    @for ($l = 0; $l < $qtd_colunas; $l++)
                        <div class="col-{{$colunas}}">
                            <div class="table-responsive m-auto" id="cssPreloader">
                                <table class="table table-striped text-center">
                                    <thead>
                                        <tr style="height: 50px">
                                            <th scope="col">@lang('fichaTecnica.bocal_1')</th>
                                            <th scope="col">@lang('fichaTecnica.totalAcomprar')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($n = $ultimo_numero; $n < $m; $n++)
                                            <tr>
                                                @if ($lista_saldo[$n]['saida_1'] == 0)
                                                    <td>--</td>
                                                    <td>--</td>
                                                @else 
                                                    <td>{{ $lista_saldo[$n]['saida_1'] }}</td>
                                                    <td>{{ $lista_saldo[$n]['quantidade'] }}</td>
                                                @endif
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @php
                            $ultimo_numero = $m;
                            if ($l == $qtd_colunas - 1) $m = $m + $resto_coluna; else  $m = $m + 10;
                        @endphp
                    @endfor
                    @php
                        echo $div_extra;
                    @endphp
                </div>
            </div>
        @endif

        {{-- LISTA DE FUNCIONAMENTO DO PIVO --}}
        <div class="tab-pane fade" id="pivoConjugado" role="tabpanel" aria-labelledby="pivoConjugado-tab">

            {{--CABEÇALHO --}}
            <div class="do-not-break col-12">
                <div class="row">
                    <div class="col-2">
                        <img src="{{ asset('img/logos/logo.png') }}" style="height: 50px"
                            class="img-responsive mx-auto d-block" alt="">
                    </div>
                    <div class="col-4"></div>
                    <div class="col-6 row text-right">
                        <div class="col-12">
                            <b>@lang('usuarios.consultor'): {{ $dados_ficha_tecnica->nome_consultor }}</b>
                        </div>
                        <div class="col-12">
                            <b><i class="fa fa-fw fa-envelope"></i> {{ $dados_ficha_tecnica->email_consultor }} | <i
                                    class="fa fa-fw fa-phone"></i> {{ $dados_ficha_tecnica->telefone_consultor }}</b>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="do-not-break col-12">
                <!--Pivo Central-->
                <div class="text-center">
                    @if ($dados_ficha_tecnica->tipo_projeto == 'R')
                        <h2 class="impressaoTitulo"><b>@lang('redimensionamento.ftRedimensionamento')</b></h2>
                    @else
                        <h2 class="impressaoTitulo"><b>@lang('fichaTecnica.ftPivoCentralDiagnostico')</b></h2>
                    @endif
                </div>
    
                <div class="row justify-content-center">
                    <div class="col-md-1 ">
                        <b>@lang('fichaTecnica.proprietario')</b>
                    </div>
                    <div class="col-md-3 text-center">
                        {{ $dados_ficha_tecnica->nome_proprietario }}
                    </div>
                    <div class="col-md-1">
                        <b>@lang('fichaTecnica.propriedade')</b>
                    </div>
                    <div class="col-md-3 text-center">
                        {{ $dados_ficha_tecnica->nome_fazenda }}
                    </div>
                    <div class="col-md-2">
                        <b>@lang('fichaTecnica.coordenadas'):</b>
                    </div>
                    <div class="col-md-2" style="font-size: 14px;">
                        {{ $dados_coordenadas[0]['longitude'] . ' / ' . $dados_coordenadas[0]['latitude'] }}
                    </div>
                </div>
    
                <div class="row justify-content-center">
                    <div class="col-md-2"><b>@lang('fichaTecnica.pivo_central')</b></div>
                    <div class="col-md-1 text-center">
                        {{ $dados_ficha_tecnica->nome_pivo }}
                    </div>
                    <div class="col-md-2"><b>@lang('fichaTecnica.laminaConjugada')</b></div>
                    <div class="col-md-1 text-center">
                        {{ number_format($lamina_conjugada, 2, ',', '.') }}
                    </div>
                    <div class="col-md-2"><b>@lang('fichaTecnica.raioUltimaTorre')</b> @lang('unidadesAcoes.(m)')</div>
                    <div class="col-md-1 text-center">
                        {{ number_format($dados_mapa_original[0]['raio_ultima_torre'], 2, ',', '.') }}
                    </div>
                    <div class="col-md-2"><b>@lang('fichaTecnica.velocidade100')</b>@lang('unidadesAcoes.(m/h)')</div>
                    <div class="col-md-1"> 
                        {{ number_format($dados_velocidade_red['verificacao_velocidade']['media_velocidade'], 2, ',', '.') }}
                     </div>
                </div>
    
                <div class="row justify-content-center">
                    <div class="col-md-2"><b>@lang('fichaTecnica.balanco')</b></div>
                    <div class="col-md-1 text-center">
                        {{ number_format($dados_mapa_original[0]['balanco'], 2, ',', '.') }}
                    </div>
                    <div class="col-md-2"><b>@lang('fichaTecnica.vazaoTotal')</b>@lang('unidadesAcoes.(m3/h)')</div>
                    <div class="col-md-1 text-center">
                        {{ number_format($dados_mapa_original[0]['vazao_sistema'], 2, ',', '.') }}
                    </div>
                    <div class="col-md-2"><b>@lang('fichaTecnica.alcanceCanhao')</b> @lang('unidadesAcoes.(m)')</div>
                    <div class="col-md-1 text-center">
                        {{ number_format($dados_mapa_original[0]['alcance_canhao_final'], 2, ',', '.') }}
                    </div>
                    <div class="col-md-2"><b>@lang('fichaTecnica.laminaDiaria')</b>@lang('unidadesAcoes.(mm)')</div>
                    <div class="col-md-1"> 
                        {{ number_format($dados_mapa_original[0]['lamina'], 2, ',', '.') }}
                     </div>
                </div>
                
                <div class="row justify-content-center">
                    <div class="col-md-2"><b>@lang('fichaTecnica.raioIrrigado')</b>@lang('unidadesAcoes.(m)')</div>
                    <div class="col-md-1 text-center">
                        {{ number_format($dados_velocidade['raio_irrigado'], 2, ',', '.') }}
                    </div>
                    <div class="col-md-2"><b>@lang('fichaTecnica.pressaoBomba')</b>@lang('unidadesAcoes.(mca)')</div>
                    <div class="col-md-1 text-center">
                        @foreach($bombeamentos AS $key => $bombeamento)
                            {{$bombeamento['pressao_bomba']}}
                        @endforeach
                    </div>
                    <div class="col-md-2"><b>@lang('fichaTecnica.giroEquipamento')</b></div>
                    <div class="col-md-1 text-center">
                        {{ $dados_velocidade['angulo_pivo'] }}@lang('unidadesAcoes.(graus)')
                    </div>
                    <div class="col-md-2"><b>@lang('fichaTecnica.pressao_centro')</b>@lang('unidadesAcoes.(mm)')</div>
                    <div class="col-md-1"> 
                        {{ number_format($dados_altura_manometrica['pressao_entrada_centro_pivo'], 2, ',', '.') }}
                     </div>
                </div>
                
                <div class="row justify-content-center">
                    <div class="col-md-2"><b>@lang('fichaTecnica.area_efetiva')</b>@lang('unidadesAcoes.(ha)')</div>
                    <div class="col-md-1 text-center">
                        {{ number_format($dados_velocidade['area_total_com_canhao'], 2, ',', '.') }}
                    </div>
                    <div class="col-md-2"><b>@lang('fichaTecnica.pressaoPonta')</b>@lang('unidadesAcoes.(mca)')</div>
                    <div class="col-md-1 text-center">
                        {{ number_format($dados_altura_manometrica['pressao_ponta'], 2, ',', '.') }}
                    </div>
                    <div class="col-md-2"><b>@lang('fichaTecnica.tempo100')</b>@lang('unidadesAcoes.(h)')</div>
                    <div class="col-md-1 text-center">
                        {{ number_format($dados_mapa_original[0]['tempo_a_100'], 2, ',', '.') }}
                    </div>
                    <div class="col-md-2"><b>@lang('fichaTecnica.valvReguladoras')</b></div>
                    <div class="col-md-1"> 
                        {{ $afericao['valv_reguladoras'] . ' PSI' }}
                     </div>
                </div>
            </div>
            <hr>

            {{-- TABELA --}}
            <div class="do-not-break">
                 <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">@lang('afericao.velocidade') @lang('unidadesAcoes.porcentagem')</th>
                                        <th class="text-center">@lang('afericao.volta') @lang('unidadesAcoes.(h:min)')</th>
                                        <th class="text-center">@lang('afericao.1/2Volta') @lang('unidadesAcoes.(h:min)')</th>
                                        <th class="text-center">@lang('afericao.1/4Volta') @lang('unidadesAcoes.(h:min)')</th>
                                        <th class="text-center">@lang('afericao.lamina') @lang('unidadesAcoes.(mm)')</th>
                                        <th class="text-center">@lang('afericao.estimativaCusto') @lang('afericao.eletrico') @lang('unidadesAcoes.(R$)')</th>
                                        <th hidden class="text-center">@lang('afericao.estimativaCusto') @lang('afericao.diesel') @lang('unidadesAcoes.(R$)')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($b=100; $b>=5; $b=$b-5)
                                        <tr>
                                            <td class="text-center">{{$b}}</td>
                                            <td class="text-center">{{ number_format($velocidade_pivo[$b]['volta'], 2,",",".") }}</td>
                                            <td class="text-center">{{ number_format($velocidade_pivo[$b]['volta_1_2'], 2,",",".") }}</td>
                                            <td class="text-center">{{ number_format($velocidade_pivo[$b]['volta_1_4'], 2,",",".") }}</td>
                                            <td class="text-center">{{ number_format($velocidade_pivo[$b]['lamina_mm'], 2,",",".") }}</td>
                                            <td class="text-center">{{ number_format($velocidade_pivo[$b]['estimativa_custo_eletrico'], 2,",",".") }}</td>
                                            @if(array_key_exists('estimativa_custo_diesel', $velocidade_pivo[$b]))
                                                <td hidden class="text-center">{{ number_format($velocidade_pivo[$b]['estimativa_custo_diesel'], 2,",",".") }}</td>
                                            @endif
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
        
    </div>
    <script>
        feather.replace()
    </script>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('#botaosalvar').on('click', function() {
            $('#formdados').submit();
        });

        $('#tudo_novo').on('change', function(){
            if ($(this).val() == 0) {
                $('#lista_bocais').attr('style', 'display: flex;');
                $('#lista_bocais_comprar').attr('style', 'display: none;');
            } else {
                $('#lista_bocais').attr('style', 'display: none;');
                $('#lista_bocais_comprar').attr('style', 'display: flex;');
            }
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
    integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
</script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

{{-- TOOLTIPS --}}

<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })


</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>

{{-- IMPRIMIR RELATORIO --}}

<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script>
    window.onload = function() {
        var imprimir = document.querySelector("#imprimir");
        var topo = document.querySelector("#topo_detalhe");
        imprimir.onclick = function() {
            imprimir.style.display = 'none';
            topo.style.display = 'none';
            window.print();

            var time = window.setTimeout(function() {
                imprimir.style.display = 'block';
                topo.style.display = 'block';
            }, 1000);
        }
    }

</script>

<script>
    function voltar() {
        window.history.back()
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        //Adicionando os valores para montar o gráfico
        var projetada = {{ $projetada }};
        var aferida = {{ $aferida }};

        gerarGraficoRedimensionamentoPercentimetro(projetada, aferida);
        
    });


    function gerarGraficoRedimensionamentoPercentimetro(projetada, aferida) {
        var largura_tela = $(window).width() * 0.70;
        //console.log(projetada);
        var size = projetada.length;
        var max = projetada[size - 1];
        var percent = [];
        var percent2 = [];
        var eixoX = [];
        projetada.forEach(element => {
            eixoX.push(element.toFixed(1));
            var unityPercent = parseFloat(((element / max) * 100).toFixed(2));
            percent.push(unityPercent);
        });
        aferida.forEach(element => {
            element.toFixed(2);
            var unityPercent = parseFloat(((element / max) * 100).toFixed(2));
            percent2.push(unityPercent);
        });


        Highcharts.chart('grafico_redimensionamento_percentimetro', {

            title: {
                text: "@lang('afericao.redimensionamentoPercentimetro')"
            },

            yAxis: {
                title: {
                    text: "(%)"
                },
            },
            xAxis: {
                title: {
                    text: "(m/h)"
                },
                categories: eixoX
            },
            navigation: {
                buttonOptions: {
                    enabled: false
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                    pointStart: 0
                }
            },

            series: [{
                    name: "@lang('afericao.projetada')",
                    data: percent,
                    color: 'blue',

                },
                {
                    name: "@lang('afericao.aferida')",
                    data: percent2,
                    color: 'orange'
                }
            ],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });

    }
    var laminas = {{ $laminas }};
    var laminas_medias = {{ $laminas_medias }};
    var emissores = {{ $emissores }};
    gerarGraficoUnidormidade(laminas, laminas_medias, emissores);


    function gerarGraficoUnidormidade(valores_lamina, valores_lamina_media, emissores) {
        var largura_tela = $(window).width() * 0.7;


        Highcharts.chart('grafico_uniformidade', {
            chart: {
                //zoomType: "x",
                //type: 'spline',
                events: {
                    beforePrint: function() {
                        console.log('printou');
                        this.oldhasUserSize = this.hasUserSize;
                        this.resetParams = [this.chartWidth, this.chartHeight, false];
                        this.setSize(600, 400, false);
                    },
                },
                scrollablePlotArea: {
                    enable: false
                },
                height: '500',

                maxWidth: largura_tela

            },
            title: {
                text: '{{ __('afericao.graficoUniformidade') }}'
            },

            xAxis: {
                categories: emissores
            },
            yAxis: [{
                    title: {
                        text: '@lang("afericao.laminamm")'
                    },
                    labels: {
                        formatter: function() {
                            return this.value + "mm";
                        }
                    }
                },
                {
                    title: {
                        text: '',
                        style: {
                            color: 'white'
                        }
                    },
                    labels: {
                        enabled: false,
                    },
                    opposite: true
                }
            ],
            tooltip: {
                crosshairs: true,
                shared: true
            },
            navigation: {
                buttonOptions: {
                    enabled: false
                }
            },
            colors: ['#6CF', '#F55A42'],
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                    type: 'spline',
                    yAxis: 0,
                    tooltip: {
                        headerFormat: '<b>@lang("afericao.emissor") {point.x}</b><br/>',
                        pointFormat: '{series.name} {point.y:.4f} @lang("afericao.mm_dia")<br/>'
                    },
                    name: '@lang("afericao.lamina")',
                    marker: {
                        enabled: false,
                        symbol: 'square'
                    },
                    data: valores_lamina,
                }, {
                    type: 'spline',
                    yAxis: 0,
                    name: '@lang("afericao.laminaMedia")',
                    tooltip: {
                        pointFormat: '{series.name} {point.y:.4f} @lang("afericao.mm_dia")'
                    },
                    marker: {
                        enabled: false,

                        symbol: 'diamond'
                    },
                    data: valores_lamina_media
                },

                @for ($i = 1; $i <= $afericao['numero_lances']; $i++)
                    {
                    yAxis: 1,
                    type: 'area',
                    marker:{enabled: false},
                    @if ($i == $afericao['numero_lances'] && $afericao['tem_balanco'] == 'sim') name:
                    '@lang("afericao.balanco")',
                @else
                    name: '@lang("afericao.lance") {{ $i }}', @endif
                
                    @if ($i % 2 == 0)
                        color: '#647586',
                    @else
                        color: '#69f98a',
                    @endif
                    fillOpacity: 0.2,
                    tooltip: {
                    @if ($i == $afericao['numero_lances'] && $afericao['tem_balanco'] == 'sim')
                        pointFormat: '<br>@lang("afericao.balanco")',
                    @else
                        pointFormat: '<br>@lang("afericao.lance"): {{ $i }}',
                    @endif
                    headerFormat: '<b>{series.name}</b><br>',
                    },
                
                    data: [
                    @foreach ($dados_mapa_original[1] as $emissor)
                        @if ($emissor['numero_lance'] == $i)
                            100,
                        @else
                            null,
                        @endif
                    @endforeach
                    ]
                    },
                @endfor


            ],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });
    }


    function redimChartBeforePrint(chart, width, height) {
        if (typeof(width) == 'undefined')
            width = 950;
        if (typeof(height) == 'undefined')
            height = 400;
        chart.oldhasUserSize = chart.hasUserSize;
        chart.resetParams = [chart.chartWidth, chart.chartHeight, false];
        chart.setSize(width, height, false);
    }

    function redimChartAfterPrint(chart) {
        chart.setSize.apply(chart, chart.resetParams);
        chart.hasUserSize = chart.oldhasUserSize;
    }

    window.onbeforeprint = function() {
        redimChartBeforePrint($('#grafico_uniformidade').highcharts());
        //redimChartBeforePrint($('#chart2').highcharts(), 800, 600);
    };
    window.onafterprint = function() {
        redimChartAfterPrint($('#grafico_uniformidade').highcharts());
    };


</script>

</html>
