@extends('_layouts._layout_site')

@section('head')
    <style>
        table tbody td input {
            outline: 0px !important;
            -webkit-appearance: none;
            box-shadow: none !important;
            background-color: #26546F !important;
            border: none;
            padding: 5px;
            border-radius: 0px;
            color: #fff;
            font-size: 14px;
        }

        table tbody td select {
            border: none;
            outline: none;
            background: #26546F;
            color: #fff;
            padding: 5px;
        }

        @import url(https://fonts.googleapis.com/css?family=Roboto+Condensed);

    </style>
@endsection

@section('titulo')

@endsection

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- TITULO E SUBTITULO --}}
            <div class="col-6">
                <h1>@lang('afericao.resultadoAfericao')</h1>
            </div>

            {{-- BOTOES SALVAR E VOLTAR --}}
            <div class="col-6 text-right botoes position">

                <a href="{{ route('gauging_status', $id_afericao) }}" style="color: #3c8dbc">
                    <button type="button" data-toggle="tooltip" data-placement="bottom" title="Voltar">
                        <span class="fa-stack fa-lg">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fas fa-angle-double-left fa-stack-1x fa-inverse"></i>
                        </span>
                    </button>
                </a>
                <button type="button" class="editarEmissores" data-toggle="tooltip" data-placement="bottom"
                    title="Editar Emissores">
                    <span class="fa-stack fa-2x">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
                    </span>
                </button>
                <button type="button" id="botaosalvar" disabled data-toggle="tooltip" data-placement="bottom"
                    title="Salvar">
                    <span class="fa-stack fa-2x">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-save fa-stack-1x fa-inverse"></i>
                    </span>
                </button>
                <a href="{{ route('newSpan_create', $id_afericao) }}">
                    <button type="button">
                        <span class="fa-stack fa-2x" data-toggle="tooltip" data-placement="bottom" title="Adicionar Lance">
                            <i class="fas fa-plus-circle fa-2x"></i>
                        </span>
                    </button>
                </a>
            </div>

        </div>
    </div>
@endsection

@section('conteudo')

    <div class="formafericao">
        {{-- NAVTAB'S --}}
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="graficoUniformidade-tab" data-toggle="tab" href="#graficoUniformidade"
                    role="tab" aria-controls="graficoUniformidade"
                    aria-selected="true">@lang('afericao.graicoUniformidade')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="listaEmissores-tab" data-toggle="tab" href="#listaEmissores" role="tab"
                    aria-controls="listaEmissores" aria-selected="false">@lang('afericao.listaEmissores')</a>
            </li>
        </ul>

        {{-- PRELOADER --}}
        {{-- <div id="coverScreen">
            <div class="preloader">
                <i class="fas fa-circle-notch fa-spin fa-2x"></i>
                <div>Carregando...</div>
            </div>
        </div> --}}

        {{-- FORMULARIO DE CADASTRO --}}
        <form id="formdados" method="POST" disabled>

            <div id="msgAlert" class="alert alert-success alert-dismissible fade show" role="alert"
                style="display: none; margin: 20px;">
                <strong>Edição concluida com sucesso</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <input type="hidden" name="id_afericao" value="{{ $id_afericao }}">
            <input type="hidden" name="numero_lances" value="{{ $afericao['numero_lances'] }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="tab-content mt-5" id="myTabContent">

                {{-- GRAFICO DE UNIFORMIDADE --}}
                <div class="tab-pane fade show active" id="graficoUniformidade" role="tabpanel"
                    aria-labelledby="graficoUniformidade-tab">
                    <article>
                        <div class="collapse show" id="grafico_mapa_original">
                            <div class="col-12 row">
                                <div class="col-12">
                                    <div id="grafico_uniformidade"></div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>

                {{-- TABELA DE EMISSORES --}}
                <div class="tab-pane fade" id="listaEmissores" role="tabpanel" aria-labelledby="listaEmissores-tab">
                    <div class="col-md-12 mt-5">
                        <article class="mt-5">
                            <div class="col-12 container">
                                <div class="col-12 m-auto" id="cssPreloader">
                                    <table class="table table-striped mx-auto" id="tabelaListaEmissores">
                                        <thead>
                                            <tr>
                                                <th class="text-center" scope="col">@lang('afericao.lance')</th>
                                                <th class="text-center" scope="col">@lang('afericao.posLance')</th>
                                                <th class="text-center" scope="col">@lang('afericao.posPivo')</th>
                                                <th class="text-center" scope="col">@lang('afericao.saida1')</th>
                                                <th class="text-center" scope="col">@lang('afericao.saida2')</th>
                                                <th class="text-center" scope="col">@lang('afericao.espacamento')</th>
                                                <th class="text-center" scope="col">@lang('afericao.valvulaReguladora')
                                                </th>
                                                <th class="text-center" scope="col">@lang('afericao.tipoValvula')</th>
                                                <th class="text-center" scope="col">@lang('afericao.fabricante')</th>
                                                <th class="text-center" scope="col">@lang('afericao.vazaoAspersor')</th>
                                                <th class="text-center" scope="col">@lang('afericao.vazaoLiberada')</th>
                                                <th class="text-center" scope="col">@lang('afericao.pressaoEntrada')
                                                </th>
                                                {{-- <th class="text-center" scope="col">@lang('afericao.acoes')</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody class="tbody" style="height:100%; overflow-y: scroll">
                                            $
                                            @foreach ($mapa as $index => $emissor)

                                                @if ($emissor['numero_lance'] % 2 == 0)
                                                    <tr class="bg_irr_claro rows" id="item_{{ $index }}">
                                                    @else
                                                    <tr class="bg_irr_escuro rows" id="item_{{ $index }}">
                                                @endif

                                                @if ($afericao['tem_balanco'] == 'sim' && $emissor['numero_lance'] == $afericao['numero_lances'])
                                                    <td class="text-center">@lang('afericao.balanco')</td>
                                                @else
                                                    <td class="text-center">{{ $emissor['numero_lance'] }}</td>
                                                @endif

                                                <input type="hidden" name="id_emissores_{{ $emissor['numero_lance'] }}"
                                                    value="{{ $emissor['id_emissor'] }}">
                                                    
                                                <input type="hidden" name="numero_do_lance_{{ $emissor['numero_lance'] }}"
                                                    value="{{ $emissor['id_emissor'] }}">

                                                <input type="hidden" name="numero_{{ $emissor['numero_lance'] }}"
                                                    value="{{ $emissor['numero'] }}">

                                                <td class="text-center">{{ $emissor['numero'] }}</td>
                                                <td class="text-center">{{ $emissor['posicao_emissor'] }}</td>
                                                <td id="bocal_1_{{ $emissor['id_emissor'] }}"> <input class="text-center"
                                                        name="bocal_1_{{ $emissor['numero_lance'] }}" type="number"
                                                        readonly step="0.01" value="{{ $emissor['saida_1'] }}">
                                                </td>
                                                <td id="bocal_2_{{ $emissor['id_emissor'] }}">
                                                    <input name="bocal_2_{{ $emissor['numero_lance'] }}" type="number"
                                                        step="0.01" class="text-center" readonly
                                                        value="{{ $emissor['saida_2'] }}">
                                                </td>
                                                <td class="text-center" id="espacamento_{{ $emissor['id_emissor'] }}">
                                                    <input name="espacamento_{{ $emissor['numero_lance'] }}"
                                                        style="width:50%" class="text-center" type="number" step="0.01"
                                                        readonly value="{{ $emissor['espacamento'] }}" />
                                                </td>
                                                <td class="text-center"
                                                    id="valvula_reguladora_{{ $emissor['id_emissor'] }}">
                                                    <select disabled
                                                        name="valvula_reguladora_{{ $emissor['numero_lance'] }}">
                                                        {{-- <option value="{{ $emissor['psi'] }}" selected>{{ $emissor['psi'] }}PSI</option> --}}
                                                        <option value='10' @if ($emissor['psi'] == 10) selected @endif><b>10 PSI</b></option>
                                                        <option value='15' @if ($emissor['psi'] == 15) selected @endif><b>15 PSI</b></option>
                                                        <option value='20' @if ($emissor['psi'] == 20) selected @endif><b>20 PSI</b></option>
                                                        <option value='25' @if ($emissor['psi'] == 25) selected @endif><b>25 PSI</b></option>
                                                        <option value='30' @if ($emissor['psi'] == 30) selected @endif><b>30 PSI</b></option>
                                                        <option value='35' @if ($emissor['psi'] == 35) selected @endif><b>35 PSI</b></option>
                                                        <option value='40' @if ($emissor['psi'] == 40) selected @endif><b>40 PSI</b></option>
                                                        <option value='45' @if ($emissor['psi'] == 45) selected @endif><b>45 PSI</b></option>
                                                        <option value='50' @if ($emissor['psi'] == 50) selected @endif><b>50 PSI</b></option>
                                                    </select>
                                                </td>
                                                <td class="text-center" id="tipo_valvula_{{ $emissor['id_emissor'] }}">
                                                    <select disabled name="tipo_valvula_{{ $emissor['numero_lance'] }}">
                                                        {{-- <option value="{{ $emissor['tipo_valvula'] }}">{{ $emissor['tipo_valvula'] }}</option> --}}
                                                        <option value='LF' @if ($emissor['tipo_valvula'] == 'LF') selected @endif><b>LF</b></option>
                                                        <option value='MF' @if ($emissor['tipo_valvula'] == 'MF') selected @endif><b>MF</b></option>
                                                        <option value='HF' @if ($emissor['tipo_valvula'] == 'HF') selected @endif><b>HF</b></option>
                                                        <option value='PSR' @if ($emissor['tipo_valvula'] == 'PSR') selected @endif><b>PSR</b></option>
                                                    </select>
                                                </td>
                                                <td class="text-center" id="fabricante_{{ $emissor['id_emissor'] }}">
                                                    <select disabled name="fabricante_{{ $emissor['numero_lance'] }}">
                                                        {{-- <option value="{{ $emissor['emissor'] }}">{{ $emissor['emissor'] }}</option> --}}
                                                        <option @if (strtoupper($emissor['emissor']) == 'I-WOB UP3') selected @endif value='I-WOB UP3'>
                                                            <b>@lang('afericao.i-wob-up3')</b>
                                                        </option>
                                                        <option @if (strtoupper($emissor['emissor']) == 'FABRIMAR') selected @endif value='Fabrimar'>
                                                            <b>@lang('afericao.fabrimar')</b>
                                                        </option>
                                                        <option @if (strtoupper($emissor['emissor']) == 'NELSON') selected @endif value='Nelson'>
                                                            <b>@lang('afericao.nelson')</b>
                                                        </option>
                                                        <option @if (strtoupper($emissor['emissor']) == 'SUPER SPRAY - UP3') selected @endif
                                                            value='Super Spray - UP3'>
                                                            <b>@lang('afericao.super-spray-up3')</b>
                                                        </option>
                                                        <option @if (strtoupper($emissor['emissor']) == 'SUPER SPRAY') selected @endif value='Super Spray'>
                                                            <b>@lang('afericao.super-spray')</b>
                                                        </option>
                                                        <option @if (strtoupper($emissor['emissor']) == 'I-WOB') selected @endif value='I-WOB'>
                                                            <b>@lang('afericao.i-wob')</b>
                                                        </option>
                                                        <option @if (strtoupper($emissor['emissor']) == 'TRASH BUSTER') selected @endif value='Trash Buster'>
                                                            <b>@lang('afericao.trash-buster')</b>
                                                        </option>
                                                        <option @if (strtoupper($emissor['emissor']) == 'KOMET') selected @endif value='Komet'>
                                                            <b>@lang('afericao.komet')</b>
                                                        </option>
                                                        <option @if (strtoupper($emissor['emissor']) == 'FAN SPRAY') selected @endif value='Fan Spray'>
                                                            <b>@lang('afericao.fan-spray')</b>
                                                        </option>
                                                    </select>
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($emissor['vazao_aspersor'], 4, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($emissor['vazao_liberada'], 4, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($emissor['pressao_entrada'], 4, ',', '.') }}
                                                </td>
                                            @endforeach

                                        </tbody>
                                        <tfoot>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            {{-- <td></td> --}}
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('scripts')


    {{-- SALVAR LANCE DO MODAL E VALIDATE DE CAMPOS DO MODAL --}}
    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
    <script>
        $(document).ready(function() {
            $("#adicionarLance").validate({
                rules: {
                    "posicao_relativa": {
                        required: true,
                    },
                    "lance_relativo": {
                        required: true,
                    },
                    "numero_emissores": {
                        required: true,
                    },
                    "numero_tubos": {
                        required: true,
                    },
                    "diametro": {
                        required: true,
                    },
                    "valvula_reguladora_lance": {
                        required: true,
                    },
                    "tipo_valvula": {
                        required: true,
                    },
                    "motorredutor": {
                        required: true,
                    }
                },
                messages: {
                    lance_relativo: "Campo <strong>LANCE</strong> é obrigatório",
                    numero_emissores: "Campo <strong>NÚMERO DE EMISSORES</strong> é obrigatório",
                    numero_tubos: "Campo <strong>NÚMERO DE TUBOS</strong> é obrigatório",
                    motorredutor: "Campo <strong>MOTORREDUTOR</strong> é obrigatório"
                }
            });
        });

    </script>

    {{-- CARREGAR PRELOADER --}}
    {{-- <script>
        $(document).ready(function() {
            $('#botaosalvar').on('click', function() {
                $("#coverScreen").show();
                $("#cssPreloader input").each(function() {
                    $(this).css('opacity', '0.2');
                });
                $("#cssPreloader select").each(function() {
                    $(this).css('opacity', '0.2');
                });
                $("#botoesSalvar a").each(function() {
                    $(this).css('opacity', '0.2');
                });
                $("#botoesSalvar button").each(function() {
                    $(this).css('opacity', '0.2');
                });
            });
        });

        $(window).on('load', function() {
            $("#coverScreen").hide();
        });

    </script> --}}

    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $(document).ready(function() {
            var laminas = {{ $laminas }};
            var laminas_medias = {{ $laminas_medias }};
            var emissores = {{ $emissores }};
            gerarGraficoUnidormidade(laminas, laminas_medias, emissores);


            // FUNÇÃO PARA HABILITAR E DESABILITAR CAMPOS
            $('.editarEmissores').on('click', () => {
                const $inputs = $('table input');
                const $selects = $('table select');

                $inputs.each((index, input) => {
                    const $input = $(input)
                    const isDisabled = $input.prop('readonly');

                    if (isDisabled) {
                        $input.prop('readonly', false); // desabilita
                    } else {
                        $input.prop('readonly', true); // habilita
                    }
                });

                $selects.each((index, select) => {
                    const $select = $(select);
                    const isDisabled = $select.prop('disabled');

                    if (isDisabled) {
                        $select.prop('disabled', false); // desabilita
                    } else {
                        $select.prop('disabled', true); // habilita
                    }
                });

                if ($('#botaosalvar').prop('disabled')) {
                    $('#botaosalvar').prop('disabled', false); // desabilita
                } else {
                    $('#botaosalvar').prop('disabled', true); // habilita
                }
            });


            // FUNÇÃO PARA SALVAR FORMULARIO DA TABELA DE EMISSORES
            $('#botaosalvar').on('click', function(event) {
                event.preventDefault();
                var serializeDados = $('#formdados').serialize();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('originalMap_edit') }}",
                    data: serializeDados,
                    dataType: 'json'
                }).done(function(res) {
                    console.log(res);

                    // MENSAGEM DE ALERTA APOS CONCLUSAO DE EDIÇÃO
                    var formMessages = $('#msgAlert');
                    formMessages.removeClass('alert-danger');
                    formMessages.addClass('alert-success');
                    $(formMessages).text(res.success);
                    formMessages.show();

                    // FUNÇÃO PARA FECHAR CAMPOS APOS SALVAR EDIÇÃO
                    const $inputs = $('table input');
                    const $selects = $('table select');
                    $inputs.each((index, input) => {
                        const $input = $(input)
                        const isDisabled = $input.prop('readonly');

                        if (isDisabled) {
                            $input.prop('readonly', false); // desabilita
                        } else {
                            $input.prop('readonly', true); // habilita
                        }
                    });

                    $selects.each((index, select) => {
                        const $select = $(select);
                        const isDisabled = $select.prop('disabled');

                        if (isDisabled) {
                            $select.prop('disabled', false); // desabilita
                        } else {
                            $select.prop('disabled', true); // habilita
                        }
                    });

                    if ($('#botaosalvar').prop('disabled')) {
                        $('#botaosalvar').prop('disabled', false); // desabilita
                    } else {
                        $('#botaosalvar').prop('disabled', true); // habilita
                    }



                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.log("Error: " + textStatus);
                });
            });
        });

        function gerarGraficoUnidormidade(valores_lamina, valores_lamina_media, emissores) {
            var largura_tela = $(window).width() * 0.70;


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
                    text: '{{ __('afericao.graficoUniformidade') }}'
                },

                xAxis: {
                    categories: emissores,
                },

                yAxis: [{ // Primary yAxis
                    labels: {
                        formatter: function() {
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
                    @for ($i = 1; $i <= $afericao['numero_lances']; $i++)
                        {
                        yAxis: 1,
                        type: 'area',
                        marker: {
                        enabled: false
                        },
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
                        @foreach ($mapa as $emissor)
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

    </script>
@endsection
