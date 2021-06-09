@extends('_layouts._layout_site')
@include('_layouts._includes._head')

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- TITULO --}}
            <div class="col-6">
                <h1>@lang('bocais.cadastrar_bocais')</h1>
            </div>

            {{-- BOTÃO DE VOLTAR E CADASTRAR --}}
            <div class="col-6 text-right botoes position">
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
        <form action="{{ route('save_nozzle') }}" method="POST" id="formdados">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="cadastro" role="tabpanel" aria-labelledby="cadastro-tab">
                    @csrf
                    <div id="cssPreloader">
                        <div class="table table-striped mx-auto">
                            <div class="form-row justify-content-start ml-3 mt-4 telo5ce">
                                <div class="col-md-3">
                                    <label for="fabricante">@lang('bocais')</label>
                                    <input type="hidden" name="id_fabricante" id="id_fabricante">
                                    <input type="text" class="form-control telo5ce" id="fabricante" name="fabricante"
                                        maxlength="50" required autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped mx-auto text-center" id="tabelaTrechos">
                            <thead class="headertable">
                                <tr class="text-center">
                                    <th scope="col-5">@lang('bocais.modelo')</th>
                                    <th scope="col-5">@lang('bocais.nome')</th>
                                    <th scope="col-5">@lang('bocais.vazao_10_psi')</th>
                                    <th scope="col-5">@lang('bocais.intervalo_trabalho')</th>
                                    <th scope="col-5">@lang('bocais.tipo')</th>
                                    <th scope="col-5">@lang('bocais.plug')</th>
                                    <th scope="col-2">@lang('bocais.acoes')</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td><input type="text" class="form-control" required name="modelo[]" id="modelo"></td>
                                <td><input type="number" min=0.1 step=0.1 class="form-control" required name="nome[]"
                                        id="nome">
                                </td>
                                <td><input type="number" min=0.0001 step=0.1 class="form-control" required
                                        name="vazao_10_psi[]" id="vazao10psi"></td>
                                <td><input type="number" min=0.0001 step=0.0001 class="form-control" required
                                        name="intervalo_trabalho[]" id="intervalotrabalho"></td>
                                <td><select class="form-control" name="tipo[]" id="tipo">
                                        <option value=""></option>
                                        <option value="0">@lang('bocais.estatico')</option>
                                        <option value="1">@lang('bocais.rotativo')</option>
                                    </select>
                                <td><select class="form-control" name="plug[]" id="plug">
                                        <option value=""></option>
                                        <option value="0">@lang('bocais.nao')</option>
                                        <option value="1">@lang('bocais.sim')</option>
                                    </select></td>
                                <td>
                                    <div class="row justify-content-center"></div>
                                </td>
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
                                <td></td>
                                <td></td>
                                <td></td>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

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
                    '<td><input type="text" autocomplete="off" class="form-control" required name="modelo[]" id="modelo[]_' +
                    rowCount + '"></td>';

                cols +=
                    '<td><input type="number" min=0.1 step=0.1 class="form-control" required name="nome[]" id="nome_' +
                    rowCount + '"></td>';

                cols +=
                    '<td><input type="number" min=0.0001 step=0.1 class="form-control" required name="vazao_10_psi[]" id="vazao_10_psi[]_' +
                    rowCount + '"></td>';

                cols +=
                    '<td><input type="number" min=0.0001 step=0.0001 class="form-control" required name="intervalo_trabalho[]" id="intervalo_trabalho[]_' +
                    rowCount + '"></td>';

                cols += '<td><select class="form-control" name="tipo[]" id="tipo[]_' + rowCount +
                    '"><option value=""></option><option value="0">Estático</option><option value="1">Rotativo</option></select></td>'

                cols += '<td><select class="form-control" name="plug[]" id="plug[]_' + rowCount +
                    '"><option value=""></option><option value="0">Não</option><option value="1">Sim</option></select></td>'

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
                    "modelo": "Campo <strong>MODELO</strong> é obrigatório",

                    "nome": {
                        required: "Campo <strong>NOME</strong> é obrigatório"
                    },
                    "vazao_10_psi": {
                        required: "Campo <strong>VAZÃO 10 PSI</strong> é obrigatório"
                    },
                    "intervalo_trabalho": {
                        required: "Campo <strong>INTERVALO TRABALHO</strong> é obrigatório"
                    },
                    "tipo": {
                        required: "Campo <strong>TIPO</strong> é obrigatório"
                    },
                    "plug": {
                        required: "Campo <strong>PLUG</strong> é obrigatório"
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
