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
                <a href="{{ route('manager_nozzles') }}" style="color: #3c8dbc" data-toggle="tooltip"
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
            <div class="tab-content" id="myTabContent">
                @include('_layouts._includes._alert')
                <div class="tab-pane fade show active" id="cadastro" role="tabpanel" aria-labelledby="cadastro-tab">
                    @csrf
                    <div id="cssPreloader">
                        <div class="table table-striped mx-auto">
                            <div class="form-row justify-content-start ml-4 mt-4 telo5ce">
                                <div class="col-md-2">
                                    <label for="fabricante">@lang('bocais.fabricante')</label>
                                    <input type="hidden" name="id" id="id" value="{{ $bocais['id']}}">
                                    <input type="text" class="form-control telo5ce" id="fabricante" name="fabricante"
                                    maxlength="50" required autocomplete="off" value="{{ $bocais[0]['fabricante'] }}">
                                </div>

                                <div class="col-md-2">
                                    <label for="modelo">@lang('bocais.modelo')</label>
                                    <input type="hidden" name="id" id="id" value="">
                                    <input type="text" class="form-control telo5ce" id="modelo" name="modelo"
                                    maxlength="50" required autocomplete="off" value="{{ $bocais[0]['modelo'] }}">
                                </div>

                                <div class="col-md-2">
                                    <label for="vazao_10_psi">@lang('bocais.vazaoMetroCubico')</label>
                                    <select class="form-control" name="vazao_10_psi" id="vazao_10_psi">
                                        <option value="0" {{ ($bocais[0]['vazao_10_psi'] == 0 ? 'selected' : '') }}>@lang('bocais.vazao-10-psi')</option>
                                        <option value="1" {{ ($bocais[0]['vazao_10_psi'] == 0 ? 'selected' : '') }}>@lang('bocais.vazao-15-psi')</option>
                                        <option value="2" {{ ($bocais[0]['vazao_10_psi'] == 0 ? 'selected' : '') }}>@lang('bocais.vazao-20-psi')</option>
                                        <option value="3" {{ ($bocais[0]['vazao_10_psi'] == 0 ? 'selected' : '') }}>@lang('bocais.vazao-25-psi')</option>
                                        <option value="4" {{ ($bocais[0]['vazao_10_psi'] == 0 ? 'selected' : '') }}>@lang('bocais.vazao-30-psi')</option>
                                        <option value="5" {{ ($bocais[0]['vazao_10_psi'] == 0 ? 'selected' : '') }}>@lang('bocais.vazao-40-psi')</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label for="tipo">@lang('bocais.tipo')</label>
                                    <select class="form-control telo5ce" name="tipo" id="tipo"  name="tipo">
                                        <option value="0" {{ ($bocais[0]['tipo'] == 0 ? 'selected' : '') }}>@lang('bocais.estatico')</option>
                                        <option value="1" {{ ($bocais[0]['tipo'] == 1 ? 'selected' : '') }}>@lang('bocais.rotativo')</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label for="plug">@lang('bocais.plug')</label>
                                    <select class="form-control" name="plug" id="plug">
                                        <option value="0" {{ ($bocais[0]['plug'] == 0 ? 'selected' : '') }}>@lang('bocais.nao')</option>
                                        <option value="1" {{ ($bocais[0]['tipo'] == 1 ? 'selected' : '') }}>@lang('bocais.sim')</option>
                                    </select>
                                </div>
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
                                @foreach ($bocais as $infobocais)
                                <tr>
                                    <input type="hidden" name="id[]" id="id" value="{{ $infobocais->id }}">
                                <td>
                                    <input type="text" class="form-control" required name="nome[]" id="nome" value="{{ $infobocais->nome }}">
                                </td>

                                <td>
                                    <input type="number" min=0.1 step=0.1 class="form-control" required name="vazao[]" id="vazao" value="{{ $infobocais->vazao }}">
                                </td>

                                <td>
                                    <input type="number" min=0.0001 step=0.0001 class="form-control" required name="intervalo_trabalho[]" id="intervalo_trabalho" value="{{ $infobocais->intervalo_trabalho }}">
                                </td>

                                <td>
                                    <div class="row justify-content-center"></div>
                                </td>
                            </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <td>
                                    <button onclick="AddTableRow()" type="button" class="addtablerow" data-toggle="tooltip"
                                        data-placement="right" title="Adicionar Linha"
                                        style="outline: none; cursor: pointer;">
                                        <span class="fa-stack fa-sm">
                                            <i class="fas fa-plus-circle fa-stack-2x"></i>
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

                    cols +=
                        '<td><input type="number" min=0.1 step=0.1 class="form-control" required autocomplete="off" name="nome[]" id="nome_' +
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
                    "modelo[]": {
                        required: true
                    },
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
                    "modelo": "@lang('validate.validate')",

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

            $(window).on('load', function() {
                $("#coverScreen").hide();
            });
        });
    </script>

    {{-- SCRIPT DE FUNCIONALIDADE DO TOOLTIP --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
@endsection
