@extends('_layouts._layout_site')

@section('head')
<style>
.bg_irr_escuro{
    background-color: #013856 !important;
}
.bg_irr_claro{
    background-color: #1782b6 !important;
}

.tableFixHead          { overflow-y: auto; width:100% }
.tableFixHead thead th { position: sticky; top: 0; }
</style>
@endsection

@section('titulo')
    @lang('afericao.resultadoAfericao')
@endsection

@section('conteudo')
<div class="col-12 ">
    <div class="text-right" style="padding-bottom: 1rem">
        <a href="{{route('calcular_mapa_original', $id_afericao)}}" class="btn btn-outline-dark" tooltip="@lang('afericao.atualizarMapa')"><i class="fa fa-refresh fa-fw"></i></a>
    </div>
</div>

<div class="col-12">
    <h3>@lang('afericao.graicoUniformidade')<button type="button" data-toggle="collapse" data-target="#grafico_mapa_original" aria-expanded="false" aria-controls="grafico_mapa_original" class="btn btn-outline-primary float-right"><i class="fa fa-fw fa-bars"></i></button></h3>
</div>

<div class="collapse in" id="grafico_mapa_original">
    <div class="col-12 row" >
        <div class="col-12">
            <div  id="grafico_uniformidade"></div>
        </div>
    </div>
</div>
<br />
<div class="col-12 container">
    <h2>@lang('afericao.listaEmissores')</h2>
    <div class="table-responsive" style="height: 250px">
        <table class="table tableFixHead">
            <thead class="thead-dark">
                <tr class="">
                    <th class="text-center" scope="col">@lang('afericao.lance')</th>
                    <th class="text-center" scope="col">@lang('afericao.posLance')</th>
                    <th class="text-center" scope="col">@lang('afericao.posPivo')</th>
                    <th class="text-center" scope="col">@lang('afericao.saida1')</th>
                    <th class="text-center" scope="col">@lang('afericao.saida2')</th>
                    <th class="text-center" scope="col">@lang('afericao.espacamento')</th>
                    <th class="text-center" scope="col">@lang('afericao.valvulaReguladora')</th>
                    <th class="text-center" scope="col">@lang('afericao.tipoValvula')</th>
                    <th class="text-center" scope="col">@lang('afericao.fabricante')</th>
                    <th class="text-center" scope="col">@lang('afericao.vazaoAspersor')</th>
                    <th class="text-center" scope="col">@lang('afericao.vazaoLiberada')</th>
                    <th class="text-center" scope="col">@lang('afericao.pressaoEntrada')</th>
                    <th class="text-center" scope="col">@lang('afericao.acoes')</th>
                </tr>
            </thead>
            <tbody class="tbody" style="height:100%; overflow-y: scroll">
                @foreach ($mapa as $index => $emissor)
                    @if($emissor['numero_lance'] % 2 == 0) 
                        <tr class="bg_irr_claro text-light rows" id="item_{{$index}}">
                    @else
                        <tr class="bg_irr_escuro text-light rows" id="item_{{$index}}">
                    @endif
                        @if($afericao['tem_balanco'] == "sim" && $emissor['numero_lance'] == $afericao['numero_lances'])
                            <td class="text-center" >@lang('afericao.balanco')</td>                        
                        @else
                            <td class="text-center" >{{$emissor['numero_lance']}}</td>                        
                        @endif
                        <td class="text-center" >{{$emissor['posicao_emissor']}}</td>
                        <td class="text-center" >{{$emissor['posicao_emissor']}}</td>
                        <td class="text-center"  id="bocal_1_{{$emissor['posicao_emissor']}}">{{ number_format($emissor['bocal-1'] ,1,",",".")}} </td>
                        <td class="text-center"  id="bocal_2_{{$emissor['posicao_emissor']}}">{{ number_format($emissor['bocal-2'] ,1,",",".")}} </td>
                        <td class="text-center"  id="espacamento_{{$emissor['posicao_emissor']}}" >{{ number_format($emissor['espacamento'],2,",",".")}}</td>
                        <td class="text-center"  id="valvula_reguladora_{{$emissor['posicao_emissor']}}">{{$emissor['valvulas_reguladoras_psi'] }} PSI</td>
                        <td class="text-center"  id="tipo_valvula_{{$emissor['posicao_emissor']}}">{{$emissor['valvulas_reguladoras_tipo']}}</td>
                        <td class="text-center"  id="fabricante_{{$emissor['posicao_emissor']}}">{{$emissor['posicao_emissor'] }}</td>
                        <td class="text-center" >{{ number_format($emissor['vazao_aspersor'],4,",",".")}}</td>
                        <td class="text-center" >{{ number_format($emissor['vazao_liberada'],4,",",".")}}</td>
                        <td class="text-center" >{{ number_format($emissor['pressao_entrada'],4,",",".")}}</td>
                        <td class="text-center"> <button class="btn btn-outline-light" id="button_{{$emissor['posicao_emissor']}}"><i class="fa fa-pencil fa-fw"></i></button></td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>

<div class="container">
    <div class="text-center">
        <a class="btn btn-outline-dark" href="{{URL::previous()}}">@lang('afericao.voltar')</a>
    </div>
</div>

<modal nome="editar" titulo="@lang('afericao.editarEmissor')" css='modal-md'>
<formulario id="formEditar" v-bind:action="'{{route("mapa_original_editar")}}'" css='row' method="put" enctype="" token="{{ csrf_token() }}">
        <input type="text" id="posicao_emissor" name='posicao_emissor' hidden >
        <input type="text" id="id_afericao" name='id_afericao'  value={{$mapa[0]['id_afericao']}} hidden >

        <div class="form-group col-md-6">
            <label for="espacamento">@lang('afericao.espacamento')@lang('unidadesAcoes.(m)')</label>
            <input class="form-control"   id="espacamento" name="espacamento" type="number" step=0.01 aria-describedby="" placeholder="@lang('afericao.espacamento')" required>
            @component('_layouts._components._inputLabel', ['texto'=>'', 'id' => ''])@endcomponent                                                                                                

        </div>

        <div class="form-group col-md-6">
            <label for="valvula_reguladora">@lang('afericao.valvula_reguladora')</label>
            <select  id="valvula_reguladora" name="psi"  class='form-control' required='true' >
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
            <div class="line"></div>
        </div>

        <div class="form-group col-md-6">
            <label for="tipo_valvula">@lang('afericao.tipo_valvula')</label>
            <select id="tipo_valvula" class='form-control' required='true' name='tipo_valvula'>
                <option value='LF'  ><b>LF</b></option>
                <option value='MF'  ><b>MF</b></option>
                <option value='HF'  ><b>HF</b></option>
                <option value='PSR' ><b>PSR</b></option>
            </select>
            <div class="line"></div>
        </div>


        <div class="form-group col-md-6">
            <label for="fabricante">@lang('afericao.fabricante')</label>
            <select class='form-control' required='true'  id="fabricante" required name='emissor'>
                <option   value='I-WOB UP3'><b>I-WOB UP3</b></option>
                <option   value='Fabrimar'><b>Fabrimar</b></option>
                <option   value='Nelson'><b>Nelson</b></option>
                <option   value='Super Spray - UP3'><b>Super Spray UP3</b></option>
                <option   value='Super Spray'><b>Super Spray</b></option>
                <option   value='I-WOB'><b>I-WOB</b></option>
                <option   value='Trash Buster'><b>Trash Buster</b></option>
                <option   value='Komet'><b>Komet</b></option>
                <option   value='Fan Spray'><b>Fan Spray</b></option>
            </select>
            <div class="line"></div>
        </div>

        <div class="form-group col-md-6">
            <label for="saida_1">@lang('afericao.saida_1')</label>
            <input class="form-control"   id="saida_1" name="saida_1" type="number" step=0.01 aria-describedby="" placeholder="@lang('afericao.saida_1')" required>
            @component('_layouts._components._inputLabel', ['texto'=>'', 'id' => ''])@endcomponent                                                                                                
        </div>

        <div class="form-group col-md-6">
            <label for="saida_2">@lang('afericao.saida_2')</label>
            <input class="form-control"   id="saida_2" name="saida_2" type="number" step=0.01  aria-describedby="" placeholder="@lang('afericao.saida_2')" required>
            @component('_layouts._components._inputLabel', ['texto'=>'', 'id' => ''])@endcomponent                                                                                                
        </div>
        
    </formulario>
    <span slot="botoes">
        <button form="formEditar" class="btn btn-info">@lang('unidadesAcoes.salvar')</button>
    </span>
</modal>

@endsection

@section('scripts')
<script type="text/javascript">
$( document ).ready(function() {
    var laminas = {{$laminas}};
    var laminas_medias = {{$laminas_medias}};
    var emissores = {{$emissores}};
    gerarGraficoUnidormidade(laminas, laminas_medias, emissores);
    //gerarGrafico2();
});

$(document).on("click","tr.rows button", function(e){
    var id_button = (e.currentTarget.id);
    id_button = id_button.split('_')[1];
    
    var espacamento = $("#espacamento_" + id_button).text();
    var saida_1 = $("#bocal_1_" + id_button).text();
    var saida_2 = $("#bocal_2_" + id_button).text();
    var valvula_reguladora = $("#valvula_reguladora_" + id_button).text();
    var tipo_valvula = $("#tipo_valvula_" + id_button).text();
    var fabricante = $("#fabricante_" + id_button).text();
    $("#espacamento").val(espacamento.replace(",", "."));
    $("#valvula_reguladora").val(valvula_reguladora.split(" ")[0]);
    $("#tipo_valvula").val(tipo_valvula);
    $("#fabricante").val(fabricante);
    $("#saida_1").val(saida_1.replace(",", ".").replace(" ", ""));
    $("#saida_2").val(saida_2.replace(",", ".").replace(" ", ""));
    $("#editar").modal('show');
    $("#posicao_emissor").val(id_button);
});


function gerarGraficoUnidormidade(valores_lamina, valores_lamina_media, emissores){
    var largura_tela = $(window).width()*0.70;
    

    Highcharts.chart('grafico_uniformidade', {
        chart: {
            zoomType: "x",
            //type: 'spline',
            scrollablePlotArea: {
                minWidth: largura_tela
            },
            height: '500'
        },
        title: {
            text: '{{__("afericao.graficoUniformidade")}}'
        },
        
        xAxis: {
            categories: emissores,
        },
        
        yAxis: [{ // Primary yAxis
            labels: {
                formatter: function () {
                    return this.value + "mm";
                }
            },
            title: {
                text: '@lang("afericao.laminamm")',
            }
        }, { // Secondary yAxis
            title: {
                text: '',
                style: {
                    color: 'white'
                }
            },
            labels: {
                enabled: false,
                //format: '{value}',
                //style: {
                //    color: Highcharts.getOptions().colors[0]
                //}
            },
            opposite: true
        }],
        colors: ['#6CF', '#F55A42', '#2b908f', '#e4d354'],
        tooltip: {
            crosshairs: true,
            shared: true
        },
        plotOptions: {
            spline: {
                marker: {
                    radius: 4,
                    lineColor: '#666666',
                    lineWidth: 1,
                }
            }, 
        },
        series: [{
            type: 'spline',
            yAxis: 0,
            tooltip: {
                headerFormat: '<b>@lang("afericao.emissor") {point.x}</b><br/>',
                pointFormat: '{series.name} {point.y:.2f} @lang("afericao.mm_dia")<br/>'
            },
            name: '@lang("afericao.lamina")',
            marker: {
                symbol: 'square'
            },
            data: valores_lamina,
        }, {
            yAxis: 0,
            type: 'spline',
            name: '@lang("afericao.laminaMedia")',
            tooltip: {
                pointFormat: '{series.name} {point.y:.2f} @lang("afericao.mm_dia")'
            },
            marker: {
                symbol: 'diamond'
            },
            data: valores_lamina_media
        },
        @for($i = 1; $i <= $afericao['numero_lances']; $i++)
            {
                yAxis: 1,
                type: 'area',
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
                    @foreach($mapa as $emissor)
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

</script>
@endsection