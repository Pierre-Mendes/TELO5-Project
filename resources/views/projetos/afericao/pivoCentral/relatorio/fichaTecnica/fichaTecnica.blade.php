<!DOCTYPE html>

<style>
    .cor-fundo{
        background-color:#005F8D;
        color:white;
    }
</style>

<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highcharts/7.1.2/css/highcharts.css" integrity="sha256-4bpG/e3EbIONg49CHrSw5c4jzs+8fb4eQbTJTibHWdw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"/>    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highcharts/7.1.2/css/highcharts.css" integrity="sha256-4bpG/e3EbIONg49CHrSw5c4jzs+8fb4eQbTJTibHWdw=" crossorigin="anonymous" /> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <title>@lang('redimensionamento.ftRedimensionamento')</title>
    <link rel="stylesheet" href="{{asset('css/print.css')}}"/>
    <style>
        hr{
            background-color:black;
            margin-top: 0.25rem;
            margin-bottom: 0.25rem;
        }
        .table td, .table th {
            padding: 0rem;
        }
        textarea{
            text-align: justify;
        }

    </style>
</head>
<body>
    <!-- <page size="A4"></page> -->
    
    <div class="container">
        <div class="do-not-break col-12" style="height: 2%; background-color: #005f8d; padding: 10px">
            <div class="row">
                <div class="col-2" >
                    <img src="{{asset('img/logos/logo.png')}}" style="height: 50px" class="img-responsive mx-auto d-block" alt="">
                </div>
                <div class="col-4"></div>
                <div class="col-6 row text-light text-right">
                    <div class="col-12">
                        <b>@lang('usuarios.consultor'): {{$dados_ficha_tecnica->nome_consultor}}</b>
                    </div>
                    <div class="col-12">
                        <b><i class="fa fa-fw fa-envelope"></i> {{$dados_ficha_tecnica->email_consultor}} | <i class="fa fa-fw fa-phone"></i> {{$dados_ficha_tecnica->telefone_consultor}}</b>
                    </div>
                </div>
            </div>
        </div>
        <div class="do-not-break">
             <!--Pivo Central-->
            <div class="text-center cor-fundo" >
                @if($dados_ficha_tecnica->tipo_projeto == "R")
                <h2><b>@lang('redimensionamento.ftRedimensionamento')</b></h2>
                @else
                <h2><b>@lang('fichaTecnica.ftPivoCentralDiagnostico')</b></h2>
                @endif
            </div>
            <div class="row">
                <div class="col-md-2 ">
                    <b>@lang('fichaTecnica.proprietario')</b>
                </div>
                <div class="col-md-2 text-center">
                    {{$dados_ficha_tecnica->nome_proprietario}}
                </div>
                <div class="col-md-2 ">
                        <b>@lang('fichaTecnica.municipio')</b>
                </div>
                <div class="col-md-2 text-center">
                    {{$dados_ficha_tecnica->cidade_fazenda}}
                </div>
                <div class="col-md-2">
                        <b>@lang('fichaTecnica.data')</b>
                </div>
                <div class="col-md-2 text-center">
                    {{date('d/m/Y', strtotime($dados_ficha_tecnica->data_afericao)) }}
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-2">
                    <b>@lang('fichaTecnica.propriedade')</b>
                </div>
                <div class="col-md-2 text-center">
                    {{$dados_ficha_tecnica->nome_fazenda}}
                </div>
                <div class="col-md-2">
                    <b>@lang('fichaTecnica.estado')</b>
                </div>
                <div class="col-md-2 text-center">
                    {{$dados_ficha_tecnica->estado_fazenda}}
                </div>
                <div class="col-md-2">
                    <b>@lang('fichaTecnica.modeloEquipamento')</b>
                </div>
                <div class="col-md-2 text-center">
                    {{$dados_ficha_tecnica->fabricante_pivo.'-'.$dados_ficha_tecnica->nome_modelo_pivo}}
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-2">
                    <b>@lang('fichaTecnica.coordenadas')</b>
                </div>
                <div class="col-md-2 text-center">
                    {{$dados_ficha_tecnica->longitude_fazenda.' - '.$dados_ficha_tecnica->latitude_fazenda}}
                </div>
                <div class="col-md-2">
                    <b>@lang('fichaTecnica.pivoCentralFixo')</b>
                </div>
                <div class="col-md-2 text-center">
                    {{$dados_ficha_tecnica->nome_pivo}}
                </div>
                <div class="col-md-2">
                    <b>@lang('fichaTecnica.conjugado')</b>
                </div>
                <div class="col-md-2 text-center">
                        @lang('fichaTecnica.' . $dados_ficha_tecnica->conjugado)
                </div>
            </div>
            <!------------------------------------------------------------------------------------------------>
            
            <hr>
            <!--Composição da parte aérea-->
            <div><h5><b>@lang('fichaTecnica.composicaoParteAerea'){{$texto_composicao}}</b></h5></div>
            <!------------------------------------------------------------------------------------------------>
            <hr>
            
            <div class="row">
                <div class="col-md-3"><b>@lang('fichaTecnica.areaTotal')</b>@lang('unidadesAcoes.(ha)')</div>
                <div class="col-md-1">
                    {{ number_format( $dados_velocidade['area_total_com_canhao'] ,2,",",".")}}
                </div>
                <div class="col-md-3"><b>@lang('fichaTecnica.laminaDiaria')</b>@lang('unidadesAcoes.(mm)')</div>
                <div class="col-md-1">
                    {{ number_format( $dados_mapa_original[0]['lamina'] ,2,",",".")}}
                </div>
                <div class="col-md-3"><b>@lang('fichaTecnica.raioIrrigado')</b>@lang('unidadesAcoes.(m)')</div>
                <div class="col-md-1">
                    {{ number_format( $dados_velocidade['raio_irrigado'] ,2,",",".")}}
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-3"><b>@lang('fichaTecnica.giroEquipamento')</b></div>
                <div class="col-md-1">
                    {{$dados_velocidade['angulo_pivo']}}@lang('unidadesAcoes.(graus)')
                </div>
                <div class="col-md-3"><b>@lang('fichaTecnica.vazaoTotal')</b>@lang('unidadesAcoes.(m3/h)')</div>
                <div class="col-md-1">
                    {{ number_format( $dados_mapa_original[0]['vazao_sistema'] ,2,",",".")}}
                </div>
                <div class="col-md-3"><b>@lang('fichaTecnica.uniformidadeAplicacao')</b></div>
                <div class="col-md-1">
                    {{number_format($dados_mapa_original[0]['uniformidade_aplicacao'])}} %
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-3"><b>@lang('fichaTecnica.raioUltimaTorre')</b>@lang('unidadesAcoes.(m)')</div>
                <div class="col-md-1">
                    {{ number_format( $dados_mapa_original[0]['raio_ultima_torre'] ,2,",",".")}}
                </div>
                <div class="col-md-3"><b>@lang('fichaTecnica.balanco')</b></div>
                <div class="col-md-1">
                    {{ number_format( $dados_mapa_original[0]['balanco'] ,2,",",".")}}
                </div>
                <div class="col-md-3"><b>@lang('fichaTecnica.velocidade100')</b>@lang('unidadesAcoes.(m/h)')</div>
                <div class="col-md-1">
                    {{ number_format( $dados_velocidade_red['verificacao_velocidade']['media_velocidade'] ,2,",",".")}}
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-3"><b>@lang('fichaTecnica.valvReguladoras')</b></div>
                <div class="col-md-1">
                    {{$afericao['valv_reguladoras'].' PSI'}}
                </div>
                <div class="col-md-3"><b>@lang('fichaTecnica.alcanceCanhao')</b>@lang('unidadesAcoes.(m)')</div>
                <div class="col-md-1">
                    {{ number_format( $dados_mapa_original[0]['alcance_canhao_final'] ,2,",",".")}}
                </div>
                <div class="col-md-3"><b>@lang('fichaTecnica.tempo100')</b>@lang('unidadesAcoes.(h)')</div>
                <div class="col-md-1">
                    {{ number_format( $dados_mapa_original[0]['tempo_a_100'] ,2,",",".")}}
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-2"><b>@lang('fichaTecnica.emissores')</b></div>
                <div class="col-md-2 text-right">
                    @if(!empty($afericao['marca_modelo_emissores'])){{$afericao['marca_modelo_emissores']}} @else - @endif
                </div>
                <div class="col-md-3"><b>@lang('fichaTecnica.numEmissores')</b></div>
                <div class="col-md-1">
                    {{$dados_mapa_original[0]['numero_saidas_sem_plug']}}
                </div>
                <div class="col-md-3"><b>@lang('fichaTecnica.alturaEmissores')</b>@lang('unidadesAcoes.(m)')</div>
                <div class="col-md-1">
                    {{ number_format( $dados_velocidade['altura_emissores'] ,2,",",".")}}
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-3"><b>@lang('fichaTecnica.tipoPainel')</b></div>
                <div class="col-md-1">
                    @if(!empty($afericao['tipo_painel'])){{$afericao['tipo_painel']}}@else - @endif
                </div>
                <div class="col-md-3"><b>@lang('fichaTecnica.defletor')</b></div>
                <div class="col-md-1">
                        @if(!empty($afericao['defletor'])) {{$afericao['defletor']}} @else - @endif
                </div>
                <div class="col-md-3"><b>@lang('fichaTecnica.revestimento')</b></div>
                <div class="col-md-1">
                    @if(!empty($afericao['defletor'])) {{$afericao['revestimento']}} @else - @endif
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-3"><b>@lang('fichaTecnica.pivoConjugado')</b></div>
                <div class="col-md-1">
                    @lang('fichaTecnica.' . $dados_ficha_tecnica->conjugado)
                </div>
                <div class="col-md-3"><b>@lang('fichaTecnica.laminaConjugada')</b>@lang('unidadesAcoes.(mm)')</div>
                <div class="col-md-1">
                    {{ number_format( $lamina_conjugada ,2,",",".")}}
                </div>
                <div class="col-md-3"><b>@lang('fichaTecnica.areaConjugada')</b>@lang('unidadesAcoes.(ha)')</div>
                <div class="col-md-1">
                    @if($dados_ficha_tecnica->conjugado == "sim") - @else @lang('fichaTecnica.nao') @endif
                </div>
            </div>
            <!------------------------------------------------------------------------------------------------>
        </div>
        <div class="do-not-break">
            <!--Adutora-->
            <div class="text-center cor-fundo" >
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
                    <b>@lang('fichaTecnica.pressao')</b>
                </div>
                <div class="col-md-2 text-center">
                    <b>@lang('fichaTecnica.velocidade')</b>@lang('unidadesAcoes.(m/s)')
                </div>            
            </div>
            <hr>
            @foreach( $trechos_adutora AS $key => $trecho)
                <div class="row">
                    <div class="col-md-1 text-center">
                        {{$key+1}}
                    </div>
                    <div class="col-md-2 text-center">
                        {{ number_format( $trecho['diametro'] ,2,",",".")}}
                    </div>
                    <div class="col-md-2 text-center">
                        @if($trecho['tipo_cano'] == 0) @lang('afericao.acoSac') @endif
                        @if($trecho['tipo_cano'] == 1) @lang('afericao.az') @endif
                        @if($trecho['tipo_cano'] == 2) @lang('afericao.ferroFundido') @endif
                        @if($trecho['tipo_cano'] == 3) PVC PN 125 @endif
                        @if($trecho['tipo_cano'] == 4) PVC PN 140 @endif
                        @if($trecho['tipo_cano'] == 5) PVC PN 180 @endif
                        @if($trecho['tipo_cano'] == 6) PVC PN 60 @endif
                        @if($trecho['tipo_cano'] == 7) PVC PN 80 @endif
                        @if($trecho['tipo_cano'] == 8) RPVC PN 100 @endif
                        @if($trecho['tipo_cano'] == 9) @lang('afericao.aluminio') @endif
                    </div>
                    <div class="col-md-2 text-center">
                        {{ number_format( $trecho['comprimento'] ,2,",",".")}}
                    </div>
                    <div class="col-md-1 text-center">
                        {{ number_format( $dados_adutora[$key]['hf'] ,2,",",".")}}
                    </div>
                    <div class="col-md-2 text-center">
                        {{number_format($dados_adutora[$key]['pressao_inicial'], 0)}} / {{number_format($dados_adutora[$key]['pressao_final'], 0)}}
                    </div>
                    <div class="col-md-2 text-center">
                        {{ number_format( $dados_adutora[$key]['velocidade'] ,2,",",".")}}
                    </div>
                </div>
            @endforeach
            <hr>
            <div class="row">
                <div class="col-md-5">
                    <b>@lang('fichaTecnica.total')</b>
                </div>
                <div class="col-md-2 text-center">
                    {{ number_format( $dados_adutora['comprimento_total'] ,2,",",".")}}
                </div>
                <div class="col-md-1 text-center">
                    {{ number_format( $dados_adutora['hf_total'] ,2,",",".")}}
                </div>
            </div>
        </div>
        <div class="do-not-break">
            <!--Altura Manométrica-->
            <div class="text-center cor-fundo" >
                <h4><b>@lang('fichaTecnica.alturaMonometrica')</b></h4>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <b>@lang('fichaTecnica.desnivelCentroPontoMaisAlto')</b>@lang('unidadesAcoes.(m)')
                </div>
                <div class="col-md-2">
                        {{ number_format( $dados_altura_manometrica['desnivel_centro_ponto_mais_alto'] ,2,",",".")}}
                </div>
                <div class="col-md-4">
                    <b>@lang('fichaTecnica.pressaoEntradaCentroPivo')</b>@lang('unidadesAcoes.(mca)')
                </div>
                <div class="col-md-2">
                    {{ number_format( $dados_altura_manometrica['pressao_entrada_centro_pivo'] ,2,",",".")}}
                </div>
            </div>
    
            <div class="row">
                <div class="col-md-4">
                    <b>@lang('fichaTecnica.perdaCargaParteAerea')</b>@lang('unidadesAcoes.(mca)')
                </div>
                <div class="col-md-2">
                    {{ number_format( $dados_altura_manometrica['perda_carga_parte_aerea'] ,2,",",".")}}
                </div>
    
    
                <div class="col-md-4">
                    <b>@lang('fichaTecnica.desnivelMotobombaCentro')</b>@lang('unidadesAcoes.(m)')
                </div>
                <div class="col-md-2">
                    {{ number_format( $dados_altura_manometrica['desnivel_motobomba_centro'] ,2,",",".")}}
                </div>
    
    
            </div>
            <div class="row">
                <div class="col-md-4">
                    <b>@lang('fichaTecnica.alturaEmissores')</b>@lang('unidadesAcoes.(m)')
                </div>
                <div class="col-md-2">
                    {{ number_format( $dados_altura_manometrica['altura_emissores'] ,2,",",".")}}
                </div>
    
                <div class="col-md-4">
                    <b>@lang('fichaTecnica.perdaCargaTotalAdutora')</b>@lang('unidadesAcoes.(mca)')
                </div>
                <div class="col-md-2">
                    {{ number_format( $dados_altura_manometrica['perda_carga_total_adutora'] ,2,",",".")}}
                </div>
    
    
            </div>
            <div class="row">
                <div class="col-md-4">
                    <b>@lang('fichaTecnica.pressaoPonta')</b>@lang('unidadesAcoes.(mca)')
                </div>
                <div class="col-md-2">
                    {{ number_format( $dados_altura_manometrica['pressao_ponta'] ,2,",",".")}}
                </div>
    
                <div class="col-md-4">
                    <b>@lang('fichaTecnica.alturaMonometrica')</b>@lang('unidadesAcoes.(mca)')
                </div>
                <div class="col-md-2">
                        {{ number_format( $dados_altura_manometrica['altura_manometrica_total_requerida'] ,2,",",".")}}
                </div>
            </div>
            <!------------------------------------------------------------------------------------------------>
        </div>
        <div class="do-not-break">
            <!--CONJUNTO MOTOBOMBA-->
            <div class="text-center cor-fundo" >
                <h4><b>@lang('fichaTecnica.conjuntoMotoBomba')</b></h4>
            </div>
            <div class='row'>
                <div class="col-md-2 "><b>@lang('fichaTecnica.numBombas')</b></div>
                <div class="col-md-2 text-center">{{$cabecalho_bombeamento['numero_bombas']}}</div>

                <div class="col-md-2"><b>@lang('fichaTecnica.posicionamentoBombeamento')</b></div>
                <div class="col-md-2 text-center">
                    @if($cabecalho_bombeamento['posicionamento_bombeamento'] == 0) @lang('afericao.simples') @endif
                    @if($cabecalho_bombeamento['posicionamento_bombeamento'] == 1) @lang('afericao.serie') @endif
                    @if($cabecalho_bombeamento['posicionamento_bombeamento'] == 2) @lang('afericao.paralelo') @endif
                </div>

                <div class="col-md-2 "><b>@lang('fichaTecnica.tipoInstalacao')</b></div>
                <div class="col-md-2 text-center">
                    @if($cabecalho_bombeamento['tipo_instalacao'] == 0) @lang('afericao.direta') @endif
                    @if($cabecalho_bombeamento['tipo_instalacao'] == 1) @lang('afericao.afogada') @endif
                    @if($cabecalho_bombeamento['tipo_instalacao'] == 3) @lang('afericao.balsa') @endif
                    @if($cabecalho_bombeamento['tipo_instalacao'] == 4) @lang('afericao.submersa') @endif
                </div>

                <div class="col-md-2"><b>@lang('fichaTecnica.captacao')</b></div>
                <div class="col-md-2 text-center">
                    @if($cabecalho_bombeamento['captacao'] == 0) @lang('afericao.acude') @endif
                    @if($cabecalho_bombeamento['captacao'] == 1) @lang('afericao.barragem') @endif
                    @if($cabecalho_bombeamento['captacao'] == 2) @lang('afericao.corrego') @endif
                    @if($cabecalho_bombeamento['captacao'] == 3) @lang('afericao.lago') @endif
                    @if($cabecalho_bombeamento['captacao'] == 4) @lang('afericao.lagoa') @endif
                    @if($cabecalho_bombeamento['captacao'] == 5) @lang('afericao.poco') @endif
                </div>

                <div class="col-md-2"><b>@lang('afericao.latitude')</b></div>
                <div class="col-md-2 text-center">{{ number_format( $cabecalho_bombeamento['latitude'] ,6,",",".")}} </div>

                <div class="col-md-2"><b>@lang('afericao.longitude')</b></div>
                <div class="col-md-2 text-center">{{ number_format( $cabecalho_bombeamento['longitude'] ,6,",",".")}} </div>
            </div>
        </div>
        <br>
        @include('projetos.afericao.pivoCentral.relatorio.fichaTecnica.fichaTecnica2')
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>


<script type="text/javascript">
    $( document ).ready(function() {
        //Adicionando os valores para montar o gráfico
        var projetada = {{$projetada}};
        var aferida   = {{$aferida}};

        gerarGraficoRedimensionamentoPercentimetro(projetada, aferida);
        
    });


    function gerarGraficoRedimensionamentoPercentimetro(projetada, aferida){
        var largura_tela = $(window).width()*0.70; 
        //console.log(projetada);
        var size = projetada.length;
        var max = projetada[size - 1];
        var percent = [];
        var percent2 = [];
        var eixoX = [];
        projetada.forEach(element => {
            eixoX.push(element.toFixed(1));
            var unityPercent = parseFloat(((element/max)*100).toFixed(2));
            percent.push(unityPercent);
        });
        aferida.forEach(element => {
            element.toFixed(2);
            var unityPercent = parseFloat(((element/max)*100).toFixed(2));
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
            }],

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
    var laminas = {{$laminas}};
    var laminas_medias = {{$laminas_medias}};
    var emissores = {{$emissores}};
    gerarGraficoUnidormidade(laminas, laminas_medias, emissores);


    function gerarGraficoUnidormidade(valores_lamina, valores_lamina_media, emissores){
        var largura_tela = $(window).width()*0.7;


        Highcharts.chart('grafico_uniformidade', {
            chart: {
                //zoomType: "x",
                //type: 'spline',
                events: {
                    beforePrint: function () {
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
                text: '{{__("afericao.graficoUniformidade")}}'
            },
            
            xAxis: {
                categories: emissores
            },
            yAxis: [
                {
                    title: {
                        text: '@lang("afericao.laminamm")'
                    },
                    labels: {
                        formatter: function () {
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

            @for($i = 1; $i <= $afericao['numero_lances']; $i++)
            {
                yAxis: 1,
                type: 'area',
                marker:{enabled: false},
                @if($i == $afericao['numero_lances'] && $afericao['tem_balanco'] == "sim")
                    name: '@lang("afericao.balanco")',
                @else
                    name: '@lang("afericao.lance") {{$i}}',
                @endif

                @if( $i%2 == 0)
                    color: '#647586',
                @else
                    color: '#69f98a',
                @endif
                fillOpacity: 0.2,
                tooltip: {
                    @if($i == $afericao['numero_lances'] && $afericao['tem_balanco'] == "sim")
                        pointFormat: '<br>@lang("afericao.balanco")',
                    @else
                        pointFormat: '<br>@lang("afericao.lance"): {{$i}}',
                    @endif
                    headerFormat: '<b>{series.name}</b><br>',
                },
    
                data: [
                    @foreach($dados_mapa_original[1] as $emissor)
                        @if($emissor['numero_lance'] == $i)
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
        width  = 950;
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
