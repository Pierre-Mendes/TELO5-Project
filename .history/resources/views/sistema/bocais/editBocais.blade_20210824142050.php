@extends('_layouts._layout_site')

@section('topo_detalhe')

    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- TITULO E SUBTITULO --}}
            <div class="col-6">
                <h1>@lang('bocais.bocais')</h1><br>
                <h4 style="margin-top: -20px">@lang('comum.editar')</h4>
            </div>

            {{-- BOTOES SALVAR E VOLTAR --}}
            <div class="col-6 text-right botoes">
                <a href="{{ route('manage_nozzles') }}" style="color: #3c8dbc" data-toggle="tooltip"
                   data-placement="bottom" title="@lang('comum.voltar')">
                    <button type="button">
                        <span class="fa-stack fa-lg">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fas fa-angle-double-left fa-stack-1x fa-inverse"></i>
                        </span>
                    </button>
                </a>

                <button type="button" id="botaosalvar" data-toggle="tooltip" data-placement="bottom" title="@lang('comum.salvar')">
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
    <div>
        {{-- NAVTAB'S --}}
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="cadastro-tab" data-bs-toggle="tab" role="tab" aria-controls="cadastro"
                   aria-current="page" aria-selected="true" href="#cadastro">@lang('comum.informacoes_navtabs')</a>
            </li>
        </ul>

        {{-- PRELOADER --}}
        <div id="coverScreen">
            <div class="preloader">
                <i class="fas fa-circle-notch fa-spin fa-2x"></i>
                <div>@lang('comum.preloader')</div>
            </div>
        </div>

        {{-- FORMULARIO DE CADASTRO --}}
        <form action="{{ route('update_nozzle') }}" method="post" class="mt-3" id="formdados">
            @csrf
            <input type="hidden" name="id_bocal" id="id_bocal" value="{{ $bocais[0]['id'] }}">
            <div class="tab-content" id="myTabContent">
                @include('_layouts._includes._alert')
                <div class="tab-pane fade show active" id="cadastro" role="tabpanel" aria-labelledby="cadastro-tab">
                    <div id="cssPreloader">
                            <div class="form-row justify-content-start ml-4 mt-4 telo5ce">
                                <div class="col-md-2">
                                    <label for="marca">@lang('bocais.marca')</label>
                                    <input type="text" class="form-control" id="marca" name="marca" maxlength="50" required autocomplete="off" value="{{ $bocais[0]['marca'] }}">
                                </div>

                                <div class="form-group col-md-2 telo5ce">
                                    <label for="modelo">@lang('bocais.modelo')</label>
                                    <input type="text" class="form-control" id="modelo" name="modelo" maxlength="50" autocomplete="off" value="{{ $bocais[0]['modelo'] }}">
                                </div>

                                <div class="form-group col-md-2 telo5ce">
                                    <label for="pressao_psi">@lang('bocais.pressao')</label>
                                    <select class="form-control selec" name="pressao_psi" id="pressao_psi">
                                        <option value='6' @if ($bocais[0]['pressao_psi'] == 6) selected @endif><b>6 PSI</b></option>
                                        <option value='10' @if ($bocais[0]['pressao_psi'] == 10) selected @endif><b>10 PSI</b></option>
                                        <option value='15' @if ($bocais[0]['pressao_psi'] == 15) selected @endif><b>15 PSI</b></option>
                                        <option value='20' @if ($bocais[0]['pressao_psi'] == 20) selected @endif><b>20 PSI</b></option>
                                        <option value='25' @if ($bocais[0]['pressao_psi'] == 25) selected @endif><b>25 PSI</b></option>
                                        <option value='30' @if ($bocais[0]['pressao_psi'] == 30) selected @endif><b>30 PSI</b></option>
                                        <option value='40' @if ($bocais[0]['pressao_psi'] == 40) selected @endif><b>40 PSI</b></option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label for="tipo">@lang('bocais.tipo')</label>
                                    <select class="form-control telo5ce" name="tipo" id="tipo" name="tipo">
                                        <option value="0" {{ $bocais[0]['tipo'] == 0 ? 'selected' : '' }}>@lang('bocais.estatico')</option>
                                        <option value="1" {{ $bocais[0]['tipo'] == 1 ? 'selected' : '' }}>@lang('bocais.rotativo')</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label for="plug">@lang('bocais.plug')</label>
                                    <select class="form-control" name="plug" id="plug">
                                        <option value="0" {{ $bocais[0]['plug'] == 0 ? 'selected' : '' }}>@lang('bocais.nao')</option>
                                        <option value="1" {{ $bocais[0]['tipo'] == 1 ? 'selected' : '' }}>@lang('bocais.sim')</option>
                                    </select>
                                </div>
                            </div>

                        <div class="col-12 m-auto tabela">
                            <table class="table table-striped mx-auto text-center" id="tabelaTrechos">
                                <thead class="headertable">
                                    <tr class="text-center">
                                        <th scope="col-5">@lang('bocais.nome')</th>
                                        <th scope="col-5">@lang('bocais.vazao')</th>
                                        <th scope="col-5">@lang('bocais.intervalo_trabalho')</th>
                                        <th scope="col-2">@lang('bocais.acoes')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($bocais_itens as $infobocais)
                                        <tr>
                                            <input type="hidden" name="id_bocaisItens[]" id="id_bocaisItens" value="{{ $infobocais->id }}">
                                            <td>
                                                <input type="text" class="form-control" required name="nome[]" id="nome" value="{{ $infobocais->nome }}">
                                            </td>

                                            <td>
                                                <input type="number" min=0 class="form-control" required name="vazao[]" id="vazao" value="{{ $infobocais->vazao }}">
                                            </td>

                                            <td>
                                                <input type="number" min=0 class="form-control" required name="intervalo_trabalho[]" id="intervalo_trabalho" value="{{ $infobocais->intervalo_trabalho }}">
                                            </td>
                                            <td class="col-md-1">
                                                <div class="row justify-content-center"></div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <td>
                                        <button onclick="AddTableRow()" type="button" class="addtablerow" data-toggle="tooltip"
                                                data-placement="right" title="@lang('comum.addLine')"
                                                style="outline: none; cursor: pointer;">
                                            <span class="fa-stack fa-sm">
                                                <i class="fas fa-plus-circle fa-stack-2x" style="margin-left: -70px !important;"></i>
                                            </span>
                                        </button>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')

    {{-- FILTRO SELECT --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
            integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

    {{-- REMOVER LINHAS DA TABELA --}}
    <script>
        $(document).ready(function() {});

        (function($) {
            remove = function(item) {
                var tr = $(item).closest('tr');
                tr.fadeOut(400, function() {
                    tr.remove();
                });
                return false;
            }
        })(jQuery);
    </script>

    {{-- ADICIONAR LINHAS A TABELA --}}
    <script>
        (function($) {
            //function add line/row Table
            AddTableRow = function() {
                var rowCount = $('#tabelaTrechos >tbody >tr').length;
                var newRow = $("<tr>");
                var cols = "";

                cols +='<td><input type="number" min=0.1 step=0.1 class="form-control" required autocomplete="off" name="nome[]" id="nome_' +
                    rowCount + '"></td>';

                cols +=
                    '<td><input type="number" min=0.0001 step=0.1 class="form-control" required autocomplete="off" name="vazao[]" id="vazao_' +
                    rowCount + '"></td>';

                cols +=
                    '<td><input type="number" min=0.0001 step=0.0001 class="form-control" required autocomplete="off" name="intervalo_trabalho[]" id="intervalo_trabalho_' +
                    rowCount + '"></td>';

                if (rowCount > 0) {
                    cols +=
                        '<td><div class="row justify-content-center"><button type="button" class="removetablerow" onclick="remove(this)" style="outline: none; cursor: pointer; margin-top: 4px; justify-content: center;"><i class="fa fa-fw fa-times fa-lg"></i></button></div></td>';
                }

                $("#tabelaTrechos").append('<input type="hidden" name="id_bocaisItens[]" id="id_bocaisItens" value="0">');
                newRow.append(cols);
                $("#tabelaTrechos").append(newRow);
                return false;
            };
        })(jQuery);
    </script>

    {{-- SALVAR E VALIDAR CAMPOS VAZIOS --}}
    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
    <script>
        $(document).ready(function() {
            $('#botaosalvar').on('click', function() {
                $('#formdados').submit();
            });

            $("#formdados").validate({
                rules: {
                    "nome[]": {
                        required: true
                    },
                    "vazao_10_psi[]": {
                        required: true
                    },
                    "intervalo_trabalho[]": {
                        required: true
                    },
                    "tipo[]": {
                        required: true
                    },
                    "plug[]": {
                        required: true
                    }
                },
                messages: {
                    "fabricante": {
                        required: "@lang('validate.validate')"
                    },
                    "nome": {
                        required: "@lang('validate.validate')"
                    },
                    "vazao_10_psi": {
                        required: "@lang('validate.validate')"
                    },
                    "intervalo_trabalho": {
                        required: "@lang('validate.validate')"
                    },
                    "tipo": {
                        required: "@lang('validate.validate')"
                    },
                    "plug": {
                        required: "@lang('validate.validate')"
                    },
                    "vazao": {
                        required: "@lang('validate.validate')"
                    },
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

    {{-- SCRIPT DE FUNCIONALIDADE DO TOOLTIP --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
@endsection
