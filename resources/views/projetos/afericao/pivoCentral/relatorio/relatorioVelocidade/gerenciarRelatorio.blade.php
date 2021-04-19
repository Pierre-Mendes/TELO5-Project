@extends('_layouts._layout_site')
<style>
    tr ,td{
        text-align: center
    }
</style>
@section('titulo')
    @lang('afericao.relatorioVelocidade')
@endsection

@section('conteudo')
<div class="row">
    <div class="col-md-6 table-responsive">
        <div class="text-center"><b>@lang('afericao.verificacaoVelocidade')</b></div>
        <!------------Tabela Verificação da Velocidade------------>
        <table class="table table-striped table-hover">
            <thead id='tbHead'>
                <tr class='text-light'>
                    <th>@lang('unidadesAcoes.porcentagem')</th>
                    <th>@lang('afericao.espacoMetro') <br> @lang('unidadesAcoes.(m)')</th>
                    <th>@lang('afericao.tempoSegundos') <br> @lang('unidadesAcoes.(s)')</th>
                    <th>@lang('afericao.velocidadeMetroHora') <br> @lang('unidadesAcoes.(m/h)')</th>
                </tr>                       
            </thead>
            <tbody>
                @for($l=1; $l<=4; $l++)
                    <tr>
                        @if(!empty($velocidade_afericao['verificacao_velocidade']['tempo'.$l]))
                            <td>100%</td>
                            <td>{{ $velocidade_afericao['verificacao_velocidade']['espaco'.$l] }}</td>   
                            <td>{{ $velocidade_afericao['verificacao_velocidade']['tempo'.$l] }}</td>               
                            <td>{{ number_format($velocidade_afericao['verificacao_velocidade']['velocidade_mh_'.$l.''], 2) }}</td>
                        @endif                        
                    </tr>
                @endfor                
            </tbody>
            <tfoot style="background-color:#007bff">
                <td style="color:white"><b>@lang('afericao.media')</b></td>
                <td></td>
                <td style="color:white">{{ number_format($velocidade_afericao['verificacao_velocidade']['media_tempo'], 2) }}</td>
                <td style="color:white">{{ number_format($velocidade_afericao['verificacao_velocidade']['media_velocidade'], 2) }}</td>
            </tfoot>
        </table>
        <!---------------------------------------------------------------------------------------------------------------------------->
    </div>

    <div class="col-md-6 table-responsive">
        <div class="text-center"><b>@lang('afericao.redimensionamentoPercentimetro')</b></div>
        <!------------Tabela REDIMENSIONAMENTO PERCENTÍMETRO------------>
        <table class="table table-striped table-hover">
                <thead id='tbHead'>
                    <tr class='text-light'>
                        <th>@lang('unidadesAcoes.porcentagem')</th>
                        <th>@lang('afericao.movimentadoSegundos') <br> @lang('unidadesAcoes.(s)')</th>
                        <th>@lang('afericao.paradoSegundos') <br> @lang('unidadesAcoes.(s)')</th>
                        <th>@lang('afericao.espacoMetro') <br> @lang('unidadesAcoes.(m)')</th>
                        <th>@lang('afericao.velocidadeMetroHora') <br> @lang('unidadesAcoes.(m/h)')</th>
                    </tr>                       
                </thead>
                <tbody>
                    <?php $k = 1;?>
                    @for($j=80; $j>=20; $j=$j-20)
                        <tr>
                            <td>{{$j}}%</td>
                            @if(isset($velocidade_afericao['redimensionamento_percentimetro']['tempo_perc_movimentado_'.$k])) <td>{{ $velocidade_afericao['redimensionamento_percentimetro']['tempo_perc_movimentado_'.$k] }}</td> @else <td></td> @endif
                            @if(isset($velocidade_afericao['redimensionamento_percentimetro']['tempo_perc_parado_'.$k])) <td>{{ $velocidade_afericao['redimensionamento_percentimetro']['tempo_perc_parado_'.$k] }}</td> @else <td></td> @endif
                            @if(isset($velocidade_afericao['redimensionamento_percentimetro']['espaco_'.$j])) <td>{{ number_format($velocidade_afericao['redimensionamento_percentimetro']['espaco_'.$j], 2) }}</td> @else <td></td> @endif
                            @if(isset($velocidade_afericao['redimensionamento_percentimetro']['velocidade_perc_'.$j])) <td>{{ number_format($velocidade_afericao['redimensionamento_percentimetro']['velocidade_perc_'.$j], 2) }}</td> @else <td></td> @endif
                        </tr>
                        <?php $k++; ?>
                    @endfor
                </tbody>
            </table>
        <!---------------------------------------------------------------------------------------------------------------------------->
    </div>
</div>

    <br />

    <!-----------------Tabela Resultante----------------->
    <div class=row>
        <div class="col-8">
            <table class="table table-striped table-hover">
                <thead id='tbHead'>
                    <tr class='text-light'>
                        <th>@lang('afericao.percentimetro')</th>
                        <th>@lang('afericao.velocidadeProjeto')</th>
                        <th>@lang('afericao.velocidadeMedido')</th>
                        <th>@lang('afericao.velocidadeVariacao') <br> @lang('unidadesAcoes.porcentagem')</th>
                    </tr>                
                </thead>
                <tbody>
                    @for($i=100; $i>=10; $i=$i-10)
                        <tr>
                            <td>{{$i}}%</td>
                            <td>{{number_format($velocidade_afericao['tabela_resultante']['projeto_'.$i], 2)}}</td>
                            @if(isset($velocidade_afericao['tabela_resultante']['medido_'.$i])) <td>{{number_format($velocidade_afericao['tabela_resultante']['medido_'.$i], 2)}}</td> @else <td></td> @endif
                            @if(isset($velocidade_afericao['tabela_resultante']['variacao_'.$i])) <td>{{number_format($velocidade_afericao['tabela_resultante']['variacao_'.$i] * 100, 2)}}</td> @else <td></td> @endif
                        </tr>
                    @endfor                                    
                </tbody>
            </table>
        </div>

        <div class="col-4">
            <table class="table table-striped table-hover">
                <thead id='tbHead'>
                    <tr class='text-light'>
                        <td>@lang('afericao.maiorPositivo')</td>
                        <td>@lang('afericao.maiorNegativo')</td>
                        <td>@lang('afericao.maiorVariacao')</td>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($velocidade_afericao['tabela_resultante']['maior_positivo'])) <td>{{number_format($velocidade_afericao['tabela_resultante']['maior_positivo'] * 100, 2)}}</td> @else <td></td> @endif
                    @if(isset($velocidade_afericao['tabela_resultante']['maior_negativo'])) <td>{{number_format($velocidade_afericao['tabela_resultante']['maior_negativo'] * 100, 2)}}</td> @else <td></td> @endif
                    @if(isset($velocidade_afericao['tabela_resultante']['maior_variacao'])) <td>{{number_format($velocidade_afericao['tabela_resultante']['maior_variacao'] * 100, 2)}}</td> @else <td></td> @endif
                </tbody>
            </table>
        </div>

    </div>
    <!---------------------------------------------------------------------------------------------------------------------------->

    <!---------------------Gráfico--------------------->
    <div id="grafico_redimensionamento_percentimetro" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    <!----------------------------------------------------------------------------->

    <br />
    <br />

    <!---------------------Funcionamento do Pivô--------------------->
    <div class="row">
        <div class="container">
            <div class="col-12">
                <h3>@lang('afericao.funcionamentoPivo')<button data-toggle="collapse" href="#funcionamento_pivo" aria-expanded="false" aria-controls="funcionamento_pivo" class="btn btn-outline-primary float-right"><i class="fa fa-fw fa-bars"></i></button></h3>
            </div>
        </div>        
    </div>
    <hr style="background-color: rgb(1, 56, 86)">

    <div class="collapse" id="funcionamento_pivo">
        <div class="row">
            <div class="col-md-6">
                <br />
                <table class="table table-striped table-hover">
                    <tbody class="">
                        <tr>
                            <td style="text-align:left">@lang('afericao.areaTotal') @lang('unidadesAcoes.(ha)')</td>
                            <td>{{ number_format($mapa_original['area_total_com_canhao'], 2) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:left">@lang('afericao.vazaoTotal') @lang('unidadesAcoes.(m3h)')</td>
                            <td>{{ number_format($mapa_original['somatorio_vazao_ok'], 2) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:left">@lang('afericao.velocidadeA100') @lang('unidadesAcoes.(m/h)')</td>                            
                            <td>{{ number_format($velocidade_afericao['verificacao_velocidade']['media_velocidade'], 2) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:left">@lang('afericao.tempoA100') @lang('unidadesAcoes.(h)')</td>
                            <td>{{ number_format($mapa_original['tempo_a_100'], 2) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:left">@lang('afericao.raioUltimaTorre') @lang('unidadesAcoes.(m)')</td>                            
                            <td>{{ number_format($mapa_original['raio_ultima_torre'], 2) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:left">@lang('afericao.balanco')</td>                            
                            <td>{{ number_format($mapa_original['balanco'], 2) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:left">@lang('afericao.raioIrrigado') @lang('unidadesAcoes.(m)')</td>                            
                            <td>{{ number_format($mapa_original['raio_irrigado'], 2) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:left">@lang('afericao.tempoIrrigacaoPorPonto') @lang('unidadesAcoes.(min)') - 100 @lang('unidadesAcoes.porcentagem')</td>                            
                            <td>{{ number_format($mapa_original['tempo_irri_ponto_min'], 2) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:left">@lang('afericao.potenciaTotalSistema') @lang('unidadesAcoes.(cv)')</td>                            
                            @if(array_key_exists('diesel', $dados_custo_lamina))
                                @if(array_key_exists('potencia_total_sistema_cv', $dados_custo_lamina['diesel']))
                                    <td>{{ number_format($dados_custo_lamina['diesel']['potencia_total_sistema_cv'], 2) }}</td>
                                @endif
                            @endif    
                        </tr>
                        <tr>
                            <td style="text-align:left">@lang('afericao.giroDoEquip') @lang('unidadesAcoes.(graus)')</td>                            
                            <td>{{ number_format($mapa_original['angulo_pivo'], 0) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="col-md-6">
                <br />
                <table class="table table-striped table-hover">
                    <tbody>
                        <tr>
                            <td style="text-align:left">@lang('afericao.laminaAnual') @lang('unidadesAcoes.(mm)')</td>                            
                            <td>{{ number_format($dados_custo_lamina['eletrico']['lamina_anual_mm'], 2) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:left">@lang('unidadesAcoes.kwh/mm')</td>                            
                            <td>{{ number_format($dados_custo_lamina['eletrico']['kwh_mm'], 2) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:left">@lang('afericao.custoMedio') @lang('unidadesAcoes.($/kWh)') @lang('unidadesAcoes.ou') @lang('unidadesAcoes.($/L)')</td>                            
                            <td>{{ number_format($dados_custo_lamina['eletrico']['custo_medio_kwh'], 2) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:left">@lang('afericao.custoEletricoAnual') @lang('unidadesAcoes.(R$/ha)')</td>                            
                            <td>{{ number_format($dados_custo_lamina['eletrico']['custo_anual_ha'], 2) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:left">@lang('afericao.potenciaTotalDoSistema') @lang('unidadesAcoes.(kw)')</td>                            
                            <td>{{ number_format($dados_custo_lamina['eletrico']['potencia_total_sistema_kw'], 2) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:left">@lang('afericao.tempoAnualDeOperacao') @lang('unidadesAcoes.(h)')</td>                            
                            <td>{{ number_format($dados_custo_lamina['eletrico']['tempo_anual_operacao'], 2) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:left">@lang('afericao.consumoEletricoAnual') @lang('unidadesAcoes.(h)')</td>                            
                            <td>{{ number_format($dados_custo_lamina['eletrico']['consumo_anual'], 2) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:left">@lang('afericao.custoEletrico') @lang('unidadesAcoes.(R$/mm/ha)')</td>                            
                            <td>{{ number_format($dados_custo_lamina['eletrico']['custo_mm_ha'], 2) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:left">@lang('afericao.custoEletrico') @lang('unidadesAcoes.(R$)')</td>                            
                            <td>{{ number_format($dados_custo_lamina['eletrico']['custo_anual'], 2) }}</td>
                        </tr>                        
                        <tr>
                            @if(array_key_exists('diesel', $dados_custo_lamina))
                            <td style="text-align:left">@lang('afericao.custoDiesel') @lang('unidadesAcoes.(R$/mm/ha)')</td>                            
                            <td>{{ number_format($dados_custo_lamina['diesel']['custo_anual_mm_ha'], 2) }}</td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <br />

        <div>
            <table class="table table-striped table-hover">
                <thead id='tbHead'>
                    <tr class='text-light'>
                        <th>@lang('afericao.velocidade') @lang('unidadesAcoes.porcentagem')</th>
                        <th>@lang('afericao.volta') @lang('unidadesAcoes.(h:min)')</th>
                        <th>@lang('afericao.1/2Volta') @lang('unidadesAcoes.(h:min)')</th>
                        <th>@lang('afericao.1/4Volta') @lang('unidadesAcoes.(h:min)')</th>
                        <th>@lang('afericao.lamina') @lang('unidadesAcoes.(mm)')</th>
                        <th>@lang('afericao.estimativaCusto') @lang('afericao.eletrico') @lang('unidadesAcoes.(R$)')</th>
                        <th>@lang('afericao.estimativaCusto') @lang('afericao.diesel') @lang('unidadesAcoes.(R$)')</th>
                    </tr>
                </thead>
                <tbody>
                    @for($b=100; $b>=5; $b=$b-5)
                        <tr>
                            <td>{{$b}}</td>
                            <td>{{ number_format($velocidade_pivo[$b]['volta'], 2) }}</td>
                            <td>{{ number_format($velocidade_pivo[$b]['volta_1_2'], 2) }}</td>
                            <td>{{ number_format($velocidade_pivo[$b]['volta_1_4'], 2) }}</td>
                            <td>{{ number_format($velocidade_pivo[$b]['lamina_mm'], 2) }}</td>
                            <td>{{ number_format($velocidade_pivo[$b]['estimativa_custo_eletrico'], 2) }}</td>
                            @if(array_key_exists('estimativa_custo_diesel', $velocidade_pivo[$b]))
                                <td>{{ number_format($velocidade_pivo[$b]['estimativa_custo_diesel'], 2) }}</td>
                            @endif
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
    <!---------------------------------------------------------------------------------------------------------------------------->

    <br />
    <div class="text-center">
        <a class="btn btn-outline-dark" href="{{URL::previous()}}">@lang('afericao.voltar')</a>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
    $( document ).ready(function() {
        //Adicionando os valores para montar o gráfico
        var projetada = {{$projetada}};
        console.log('Projetado: ' + projetada);
        var aferida   = {{$aferida}};
        console.log('Aferido: ' + aferida);

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
                    text: ""
                },
            },
            xAxis: {
                title: {
                    text: ""
                },
                categories: eixoX
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
                color: 'blue'
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
</script>
@endsection