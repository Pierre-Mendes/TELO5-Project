@extends('_layouts._layout_site')
<?php
$afericao = session()->get('afericao');
$num_lance = session()->get('lance')['numero_lance'];
$lance = session()->get('lance');
$total_emissores = $lance['numero_emissores'];
?>

@section('head')
    <script>
        function setValue(id, valor) {
            console.log(id + "-" + valor);
            $("#" + id + "").val(valor);
        }
    </script>
@endsection

@section('titulo')

@endsection

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- TITULO E SUBTITULO --}}
            <div class="col-6">
                <h1>@lang('afericao.emissores')</h1>
            </div>

            {{-- BOTOES SALVAR E VOLTAR --}}
            {{-- <div class="col-6 text-right botoes position">
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
            </div> --}}
        </div>
    </div>
@endsection

@section('conteudo')
    <form action="{{ route('submit_levantamento_centro_pt_3') }}" method="POST" id="formdados" class="mx-5">
        @csrf
        <input type="hidden" name="lance" value="{{ $num_lance }}">
        <input type="hidden" name="afericao" value="{{ $afericao['id_afericao'] }}">
        <input type="hidden" name="comprimento" id="comprimento" value=0>
        <input type="hidden" name="botao" value="sair" id="botao">
        <div class="col-12 m-auto tabela">
            <table class="table table-striped mx-auto" id="tabelaTrechos">
                <thead>
                    <tr>
                        <th hidden></th>
                        <th scope="col">@lang('afericao.saida1')</th>
                        <th scope="col">@lang('afericao.saida2')</th>
                        <th scope="col">@lang('afericao.espacamento')</th>
                        <th scope="col">@lang('afericao.emissor')</th>
                        <th scope="col">@lang('afericao.tipoValvula')</th>
                        <th scope="col">@lang('afericao.psi')</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i <= $total_emissores; $i++)
                        <tr>
                            <td hidden><input type="hidden" name="numero_emissor[]" value="{{ $i }}"></td>
                            <td>
                                <input type="number" @if (!empty($emissores[$i - 1]['saida_1'])) value="{{ $emissores[$i - 1]['saida_1'] }}" @endif
                                    step=0.1 min=0 id="bocal_{{ $i }}" name="bocal_1[]"
                                    class="form-control first_field">
                            </td>
                            <td>
                                <input type="number" @if (!empty($emissores[$i - 1]['saida_2'])) value="{{ $emissores[$i - 1]['saida_2'] }}" @endif
                                    step=0.1 min=0 name="bocal_2[]" class="form-control ">
                            </td>
                            <td>
                                <input type="number" name="espacamento[]" value="{{ $afericao['pivo']['espacamento'] }}"
                                    step=0.001 min=0.001 required class="form-control espacamento_field">
                            </td>
                            <td>
                                <select class='form-control' required='true' required name='emissor[]'>
                                    <option @if (strtoupper($afericao['marca_modelo_emissores']) == 'I-WOB UP3') selected @endif value='I-WOB UP3'>
                                        <b>@lang('afericao.i-wob-up3')</b>
                                    </option>
                                    <option @if (strtoupper($afericao['marca_modelo_emissores']) == 'FABRIMAR') selected @endif value='Fabrimar'>
                                        <b>@lang('afericao.fabrimar')</b>
                                    </option>
                                    <option @if (strtoupper($afericao['marca_modelo_emissores']) == 'NELSON') selected @endif value='Nelson'>
                                        <b>@lang('afericao.nelson')</b>
                                    </option>
                                    <option @if (strtoupper($afericao['marca_modelo_emissores']) == 'SUPER SPRAY - UP3') selected @endif value='Super Spray - UP3'>
                                        <b>@lang('afericao.super-spray-up3')</b>
                                    </option>
                                    <option @if (strtoupper($afericao['marca_modelo_emissores']) == 'SUPER SPRAY') selected @endif value='Super Spray'>
                                        <b>@lang('afericao.super-spray')</b>
                                    </option>
                                    <option @if (strtoupper($afericao['marca_modelo_emissores']) == 'I-WOB') selected @endif value='I-WOB'><b>@lang('afericao.i-wob')</b>
                                    </option>
                                    <option @if (strtoupper($afericao['marca_modelo_emissores']) == 'TRASH BUSTER') selected @endif value='Trash Buster'>
                                        <b>@lang('afericao.trash-buster')</b>
                                    </option>
                                    <option @if (strtoupper($afericao['marca_modelo_emissores']) == 'KOMET') selected @endif value='Komet'><b>@lang('afericao.komet')</b>
                                    </option>
                                    <option @if (strtoupper($afericao['marca_modelo_emissores']) == 'FAN SPRAY') selected @endif value='Fan Spray'>
                                        <b>@lang('afericao.fan-spray')</b>
                                    </option>
                                </select>
                            </td>
                            <td>
                                <select id="val_reg" class='form-control' required='true' name='tipo_valvula[]'>
                                    <option value='LF' @if ($lance['tipo_valvula'] == 'LF') selected @endif><b>LF</b></option>
                                    <option value='MF' @if ($lance['tipo_valvula'] == 'MF') selected @endif><b>MF</b></option>
                                    <option value='HF' @if ($lance['tipo_valvula'] == 'HF') selected @endif><b>HF</b></option>
                                    <option value='PSR' @if ($lance['tipo_valvula'] == 'PSR') selected @endif><b>PSR</b></option>
                                </select>
                            </td>
                            <td>
                                <select id="val_reg_{{ $i }}" class='form-control' required='true'
                                    name='valvula_reguladora[]'>
                                    <option value='10' @if ($lance['valvula_reguladora'] == 10) selected @endif><b>10 PSI</b></option>
                                    <option value='15' @if ($lance['valvula_reguladora'] == 15) selected @endif><b>15 PSI</b></option>
                                    <option value='20' @if ($lance['valvula_reguladora'] == 20) selected @endif><b>20 PSI</b></option>
                                    <option value='25' @if ($lance['valvula_reguladora'] == 25) selected @endif><b>25 PSI</b></option>
                                    <option value='30' @if ($lance['valvula_reguladora'] == 30) selected @endif><b>30 PSI</b></option>
                                    <option value='35' @if ($lance['valvula_reguladora'] == 35) selected @endif><b>35 PSI</b></option>
                                    <option value='40' @if ($lance['valvula_reguladora'] == 40) selected @endif><b>40 PSI</b></option>
                                    <option value='45' @if ($lance['valvula_reguladora'] == 45) selected @endif><b>45 PSI</b></option>
                                    <option value='50' @if ($lance['valvula_reguladora'] == 50) selected @endif><b>50 PSI</b></option>
                                </select>
                            </td>
                        </tr>
                    @endfor
                </tbody>
                <tfoot>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tfoot>
            </table>
        </div>
        <div class="row justify-content-center botaoAfericao mb-4">
            <a class="voltar" href="{{ route('status_afericao', $afericao['id']) }}">@lang('unidadesAcoes.sair')</a>
            <a class="voltar ml-2" href="{{ URL::previous() }}">@lang('unidadesAcoes.anterior')</a>
            <button class="proximo ml-2" name="botao" value="proximo" type="" id="">@lang('unidadesAcoes.proximo')</button>
            <button class="proximo ml-2" type="" name="botao" value="sair" id="">@lang('unidadesAcoes.salvarSair')</button>
        </div>
    </form>
@endsection


@section('scripts')
    <script>
        var emissores = [];
        var num_emissor = 1;
        var total_emissor = {{ $total_emissores }};

        $(document).ready(function() {
            getComprimentoLance();
            $("#bocal_1").focus();
        });

        $('.first_field').keypress(function(event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
                console.log('Enter pressed');
            }
        });

        $(".espacamento_field").change(function() {
            getComprimentoLance();
        })

        function getComprimentoLance() {
            var espacamentos = $(".espacamento_field").toArray();
            var total = 0;
            espacamentos.forEach(valor => {
                total += parseFloat(valor.value);
            });
            $("#comprimento").val(total);
        }

        function getValorEspacamento(emissor) {
            switch (emissor) {
                case '':

                    break;
                case '':

                    break;
                default:
                    return ''
                    break;
            }
        }

    </script>

    <script>
        // $(document).ready(function() {
        //     $('#botaosalvar').on('click', function() {
        //         $('#form_emissores').submit();
        //         $("#botao").val("salvar");
        //     });
        // });
        $(document).ready(function() {
            $('#botaosalvar').on('click', function() {
                $('#formdados').submit();
                $("#botao").val("salvar");
            });
        });

    </script>
    <!-- Inclusão do Plugin jQuery Validation-->
    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
    <script>
        $(document).ready(function() {
            $("#formdados").validate({
                rules: {
                    "bocal_1[]": {
                        required: true
                    },
                    "espacamento[]": {
                        required: true
                    },
                    "emissor[]": {
                        required: true
                    },
                    "tipo_valvula[]": {
                        required: true
                    },
                    "valvula_reguladora[]": {
                        required: true
                    }
                },
                messages: {
                    bocal_1: "Campo <strong>SAIDA 1</strong> é obrigatório",
                    "espacamento": {
                        required: "Campo <strong>ESPAÇAMENTO</strong> é obrigatório"
                    },
                    "emissor": {
                        required: "Campo <strong>EMISSOR</strong> é obrigatório"
                    },
                    "tipo_valvula": {
                        required: "Campo <strong>TIPO DE VALVULA</strong> é obrigatório"
                    },
                    "valvula_reguladora": {
                        required: "Campo <strong>PSI</strong> é obrigatório"
                    }
                }
            });
        });

    </script>
@endsection
