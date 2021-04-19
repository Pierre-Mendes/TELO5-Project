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

@import url(https://fonts.googleapis.com/css?family=Roboto+Condensed);
	*{
		margin: 0;
		padding: 0;
	}

	body{
		background-color: #ddd;
		font-family: 'Roboto Condensed';
	}

	.nav_tabs{
		width: 100%;
		height: 650px;
		position: relative;
	}

	.nav_tabs ul{
		list-style: none;
	}

	.nav_tabs ul li{
		float: left;
	}

	.tab_label{
		display: block;
		width: auto;
		background-color: #363b48;
		padding: 15px;
		font-size: 10px;
		color:#fff;
		cursor: pointer;
		text-align: center;
	}


	.nav_tabs .rd_tab { 
	display:none;
	position: absolute;
}

.nav_tabs .rd_tab:checked ~ label { 
	background-color: #007bff;
	color:#fff;}

.tab-content{
	border-top: solid 5px #007bff;
	background-color: #fff;
	display: none;
	position: absolute;
	height: relative;
	width: 1250px;
	left: 0;	
}

.rd_tab:checked ~ .tab-content{
	display: block;
}
.tab-content h2{
	padding: 10px;
	color: #87d3b7;
}
.tab-content article{
	padding: 10px;
	color: #555;
}
</style>
@endsection

@section('titulo')
    @lang('afericao.resultadoAfericao')
@endsection

@section('conteudo')
<nav class="nav_tabs">
    <ul>
        <li>
            <input type="radio" id="tab1" class="rd_tab" name="tabs" checked>
            <label for="tab1" class="tab_label">@lang('afericao.graicoUniformidade')</label>
            <div class="tab-content">
                <article>
                    <div class="col-12 ">
                        <div class="text-right" style="padding-bottom: 1rem">
                            <a href="{{route('calcular_mapa_original', $id_afericao)}}" class="btn btn-outline-dark" data-original-title="@lang('afericao.atualizarMapa')" data-toggle="tooltip" data-placement="left" ><i class="fa fa-refresh fa-fw"></i></a>
                        </div>
                    </div>

                    <div class="collapse show" id="grafico_mapa_original">
                        <div class="col-12 row" >
                            <div class="col-12">
                                <div  id="grafico_uniformidade"></div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </li>
        <li>
            <input type="radio" name="tabs" class="rd_tab" id="tab2">
            <label for="tab2" class="tab_label">@lang('afericao.listaEmissores')</label>
            <div class="tab-content">
                <article>
                    <div class="col-12 container">
                        <div class="row col-12 justify-content-end" style="padding-bottom: 2%">
                            <a data-toggle="modal" data-target="#adicionarLance" class="btn btn-dark btn-circle my-auto  text-light" data-original-title="@lang('redimensionamento.adicionarLance')"  data-toggle="tooltip" data-placement="bottom"><i class="fa fa-plus fa-fw text-light"></i> @lang('redimensionamento.adicionarLance')</a>
                        </div>
                        <div class="table-responsive" style="height: 400px">
                            <table class="table tableFixHead">
                                <thead class="thead-dark">
                                    <tr class="">
                                        <th class="text-center" scope="col">@lang('afericao.lance')</th>
                                        <th class="text-center" scope="col">@lang('afericao.posLance')</th>
                                        <th class="text-center" scope="col">@lang('afericao.posPivo')</th>
                                        <th class="text-center" scope="col">@lang('afericao.saida1')</th>
                                        <th class="text-center" scope="col">@lang('afericao.saida2')</th>
                                        <th class="text-center" scope="col" >@lang('afericao.espacamento')</th>
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
                                            <td class="text-center" >{{$emissor['numero']}}</td>
                                            <td class="text-center" >{{$emissor['posicao_emissor']}}</td>
                                            <td class="text-center"  id="bocal_1_{{$emissor['id_emissor']}}">{{ number_format($emissor['saida_1'] ,1,",",".")}} </td>
                                            <td class="text-center"  id="bocal_2_{{$emissor['id_emissor']}}">{{ number_format($emissor['saida_2'] ,1,",",".")}} </td>
                                            <td class="text-center"  id="espacamento_{{$emissor['id_emissor']}}" ><input style="width:50%" class="text-center" value="{{ number_format($emissor['espacamento'],2,",",".")}}" /></td>
                                            <td class="text-center"  id="valvula_reguladora_{{$emissor['id_emissor']}}">
                                                <select>
                                                    <option value="{{$emissor['psi'] }}" selected>{{$emissor['psi'] }} PSI</option>
                                                </select>
                                            </td>
                                            <td class="text-center"  id="tipo_valvula_{{$emissor['id_emissor']}}">
                                                <select>
                                                    <option value="{{$emissor['tipo_valvula']}}">{{$emissor['tipo_valvula']}}</option>
                                                </select>
                                            </td>
                                            <td class="text-center"  id="fabricante_{{$emissor['id_emissor']}}">
                                                <select>
                                                    <option value="{{$emissor['emissor'] }}">{{$emissor['emissor'] }}</option>
                                                </select>
                                            </td>
                                            <td class="text-center" ><input style="width:50%" class="text-center" value="{{ number_format($emissor['vazao_aspersor'],4,",",".")}}" /></td>
                                            <td class="text-center" ><input style="width:50%" class="text-center" value="{{ number_format($emissor['vazao_liberada'],4,",",".")}}" /></td>
                                            <td class="text-center" ><input style="width:50%" class="text-center" value="{{ number_format($emissor['pressao_entrada'],4,",",".")}}" /></td>
                                            <td class="text-center"> <button class="btn btn-outline-light" id="button_{{$emissor['id_emissor']}}"><i class="fa fa-pencil fa-fw"></i></button></td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>                        
                        <br />
                        <div style="display: flex; justify-content: center;">
                            <span slot="botoes">
                                <button form='' class="btn btn-lg btn-info text-center text-light" type="submit">@lang('unidadesAcoes.salvar')</button>
                            </span>
                        </div>
                    </div>
                </article>
            </div>
        </li>
    </ul>
</nav>
<div class="container">
    <div class="text-center">
        @if($afericao['tipo_projeto'] == 'R')
            <a class="btn btn-outline-dark" href="{{route('status_redimensionamento', $id_afericao)}}">@lang('afericao.voltar')</a>
        @else
            <a class="btn btn-outline-dark" href="{{route('status_afericao', $id_afericao)}}">@lang('afericao.voltar')</a>
        @endif
    </div>
</div>

<modal nome="adicionarLance" titulo="@lang('redimensionamento.adicionarLance')" css="modal-xl">
    <formulario  id="formAdicionarLance" css="row" action="{{route('adicionarLance')}}" method="post" enctype="" token="{{ csrf_token() }}"  >
        <input type="hidden" name="id_afericao" value="{{$id_afericao}}">
        
        <div class="row col-12">
            <div class="col-md-12 row justify-content-center">
                <div class="form-group col-md-3 col-sm-4">
                    <label>@lang('afericao.posicao')</label>
                    <select name="posicao_relativa"  class="form-control" required id="">
                        <option value="0">@lang('redimensionamento.antesDo')</option>
                        <option value="1">@lang('redimensionamento.depoisDo')</option>
                    </select>
                    <div class="line"></div>
                </div>
                <div class="form-group  col-md-3 col-sm-4">
                    <label>@lang('afericao.lance')</label>
                    <select name="lance_relativo"  class="form-control" required id="">
                        
                    </select>
                    <div class="line"></div>
                </div>
                <div class="form-group col-md-3 col-6">
                    <input type="number" name="numero_emissores" onchange="alterarQuantidadeDeEmissores()" id="numero_emissores" step=1 min=1   class="form-control ">
                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.numeroEmissores'), 'id' => 'numero_emissores'])@endcomponent                                                                        
                </div>
    
                <div class="form-group col-md-2 col-6">
                    <input type="number" step=1 min=1 name="numero_tubos" id="num_tubo" required  class="form-control ">
                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.numeroTubos'), 'id' => 'num_tubo'])@endcomponent                                                                        
                </div>
            </div>

            <div class="col-md-12 row justify-content-center">
                <div class="form-group col-md-3 col-sm-4">
                    <label for=""> @lang('afericao.diametro')</label>
                    <select name="diametro"  class="form-control" required id="">
                        <option value="0.127">5"</option>
                        <option value="0.1413">5.9/16</option>
                        <option value="0.1524">6"</option>
                        <option value="0.1683">6.5/8"</option>
                        <option value="0.2032">8"</option>
                        <option value="0.219">8.5/8"</option>
                        <option value="0.254">10"</option>
                    </select>
                    <div class="line"></div>
                </div>

                <div class="form-group  col-md-3 col-sm-4">
                    <label for="val_reg"> @lang('afericao.valvulaReguladora')</label>
                    <select id="val_reg" onchange="atualizarValvulaReguladora()" class='form-control' required='true' name='valvula_reguladora_lance'>
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

                <div class="form-group col-md-3 col-6">
                    <label for="tipo_valvula"> @lang('afericao.tipoValvula')</label>
                    <select id="tipo_valvula" onchange="atualizarTipoValvulaReguladora()" class='form-control' required='true' name='tipo_valvula'>
                        <option value='LF'><b>LF</b></option>
                        <option value='MF'><b>MF</b></option>
                        <option value='HF'><b>HF</b></option>
                        <option value='PSR'><b>PSR</b></option>
                    </select>
                    <div class="line"></div>
                </div>

                <div class="form-group col-md-2 col-6">
                    <input type="number" class="form-control " id="motorredutor" step=0.01 name="motorredutor">
                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.motorredutor'), 'id' => 'motorredutor'])@endcomponent                                                                        
                </div>

                <hr>
            </div>
        </div>

        <div class="container">
            <div class="col-12 text-center">
                <h3>@lang('redimensionamento.emissores')</h3>
            </div>
            <div class="row col-12 justify-content-center" id="div_lista_emissores">

            </div>
        </div>
        
    </formulario>
    <span slot="botoes">
        <button form='formAdicionarLance' class="btn btn-lg btn-info btn-block text-center text-light" style="margin: 0 auto" type="submit">@lang('unidadesAcoes.salvar')</button>
    </span>
</modal>

<modal nome="editar" titulo="@lang('afericao.editarEmissor')" css='modal-md'>
<formulario id="formEditar" v-bind:action="'{{route("mapa_original_editar")}}'" css='row' method="put" enctype="" token="{{ csrf_token() }}">
        <input type="text" id="id_emissor" name='id_emissor' hidden >
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
    $("#id_emissor").val(id_button);
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
                enabled: false
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
                enabled: false
            },
            data: valores_lamina_media
        },
        @for($i = 1; $i <= $afericao['numero_lances']; $i++)
            {
                yAxis: 1,
                type: 'area',
                marker: {
                    enabled: false
                },      
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