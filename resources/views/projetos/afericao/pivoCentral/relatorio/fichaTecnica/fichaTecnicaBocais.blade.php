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
    }


    form>.imprimir {
        display: inline-block;
        cursor: pointer;
        border: none !important;
        outline: none !important;
        background-color: #3c8dbc !important;
        float: right;
        margin: 20px;
        padding: 15px;
        border-radius: 50%;
    }

    form>.voltar {
        display: inline-block;
        cursor: pointer;
        border: none !important;
        outline: none !important;
        background-color: #3c8dbc !important;
        float: right;
        padding: 5px 10px;
        margin-top: 32px;
        border-radius: 50%;
        color: #fff;
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
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <title>@lang('redimensionamento.ftRedimensionamento')</title>
    <link rel="stylesheet" href="{{ asset('css/print.css') }}" />
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

        .colunas {
            padding: 0px;
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

        table tr {
            max-height: 27px !important;
        }

        label {
            margin: 0;
        }
        .orientacao {
            float: left;
            padding: 5px;
            margin: 30px;
            outline: none;
            border: NONE;
            font-size: 16px;
        }   
        
        @media print {

            .colunas {
                font-size: 12px;
            }

            .impressaoTitulo {
                font-size: 22px;
            }
            .impressaoTitulo2 {
                font-size: 18px;
            }
        }

    </style>
</head>

<body>

    {{-- ARRUMAR O BOTAO DE VOLTAR --}}
    <form class="topo_detalhe" id="topo_detalhe">

        <div class="orientacao">
            <label for="orientacao">Modo de impressão:</label><br>
            <select name="orientacao" id="orientacao">
                <option value="1" selected>Retrato</option>
                <option value="0">Paisagem</option>
            </select>
        </div>
       
        <button id="imprimir" class="imprimir" data-toggle="tooltip" data-placement="bottom" title="Imprimir"><i
                data-feather="printer"></i></button>
        <button class="voltar" data-toggle="tooltip" data-placement="bottom" title="Voltar"><i class="fas fa-angle-double-left"><a
                href="{{ route('gauging_status', $id_afericao) }}"></a></i></button>
    </form>


    <div class="container-fluid">
        {{-- CABECALHO --}}
        <hr>

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

        {{-- 1º PARTE DO CORPO - INFORMAÇÕES GERAIS --}}
        <div class="do-not-break">
            <!--Pivo Central-->
            <div class="text-center">
                @if ($dados_ficha_tecnica->tipo_projeto == 'R')
                    <h2 class="impressaoTitulo"><b>@lang('redimensionamento.ftRedimensionamento')</b></h2>
                @else
                    <h2 class="impressaoTitulo"><b>@lang('fichaTecnica.ftPivoCentralDiagnostico')</b></h2>
                @endif
            </div>

            <div class="row colunas">
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

            <div class="row colunas">
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

        {{-- 2º PARTE DO CORPO - TABELAS --}}
        <div class="do-not-break">
            <div class="text-center">
                <h4 class="impressaoTitulo2"><b>@lang('fichaTecnica.mapaBocal')</b></h4>
            </div>

            <hr>
            
            <div class="row">
                <div class="col-12 m-auto row justify-content-start" id="cssPreloader">

                    @php
                        $id_lanceAtual = 0;
                        $linha_emissores = 0;
                    @endphp

                    @foreach ($dados_lances2 as $lances)

                        @if ($id_lanceAtual != $lances['numero_lance'])
                            <div class="col-md-2 colunas">
                                <table border="1" class="col-12 mb-5 text-center" id="tabelaListaEmissores">
                                    <thead class="border border-right">
                                        <tr>
                                            <th colspan="4">
                                                @lang('afericao.lance') {{ $lances['numero_lance'] }}
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
                                @for ($i = 0; $i < $emissor_max - $lances['numero']; $i++) <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr> @endfor @endif

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
    <script>
        feather.replace();
    </script>
</body>

{{-- IMPRIMIR RELATORIO --}}

<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script>
    window.onload = function() {
        var imprimir = document.querySelector("#imprimir");
        var topo = document.querySelector("#topo_detalhe");

        $('#orientacao').change(function(){
            var orientacao = $(this).val();
            console.log(orientacao);
            if (orientacao == 0){
                $('head').append( $('<link rel="stylesheet" type="text/css" />').attr('href', '{{ asset('css/fichaTecnica.css') }}') );
            } else {
                $("link[href*='{{ asset('css/fichaTecnica.css') }}']").remove();
            }
        });

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

</html>
