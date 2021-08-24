@extends('_layouts._layout_site')
@include('_layouts._includes._head')

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- TITULO --}}
            <div class="col-6">
                <h1>@lang('bocais.bocais')</h1><br>
                <h4 style="margin-top: -20px">@lang('comum.cadastrar')</h4>
            </div>

            {{-- BOTÃO DE VOLTAR E CADASTRAR --}}
            <div class="col-6 text-right botoes mobile">
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
        <form action="{{ route('save_nozzle') }}" method="POST" id="formdados" class="tabelaBocais">
            <div class="tab-content" id="myTabContent">
                @include('_layouts._includes._alert')
                <div class="tab-pane fade show active" id="cadastro" role="tabpanel" aria-labelledby="cadastro-tab">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="id_bocal" id="id_bocal">
                    <div id="cssPreloader">
                            <div class="form-row justify-content ml-4 mt-4 telo5ce">
                                <div class="form-group col-md-2 telo5ce">
                                    <label for="marca">@lang('bocais.marca')</label>
                                    <input type="text" class="form-control" id="marca" name="marca" maxlength="50" required autocomplete="off" style="text-transform: capitalize">
                                </div>

                                <div class="form-group col-md-2 telo5ce">
                                    <label for="modelo">@lang('bocais.modelo')</label>
                                    <input type="text" class="form-control" id="modelo" name="modelo" maxlength="50" required autocomplete="off" style="text-transform: capitalize">
                                </div>

                                <div class="form-group col-md-2 telo5ce">
                                    <label for="pressao_psi">@lang('bocais.pressao')</label>
                                    <select class="form-control selectized" name="pressao_psi" id="pressao_psi">
                                        <option value=""></option>
                                        <option value="6">@lang('bocais.vazao-6-psi')</option>
                                        <option value="10">@lang('bocais.vazao-10-psi')</option>
                                        <option value="15">@lang('bocais.vazao-15-psi')</option>
                                        <option value="20">@lang('bocais.vazao-20-psi')</option>
                                        <option value="25">@lang('bocais.vazao-25-psi')</option>
                                        <option value="30">@lang('bocais.vazao-30-psi')</option>
                                        <option value="40">@lang('bocais.vazao-40-psi')</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-2 telo5ce">
                                    <label for="tipo">@lang('bocais.tipo')</label>
                                    <select class="form-control selectized" name="tipo" id="tipo" name="tipo">
                                        <option value=""></option>
                                        <option value="0">@lang('bocais.estatico')</option>
                                        <option value="1">@lang('bocais.rotativo')</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-2 telo5ce">
                                    <label for="plug">@lang('bocais.plug')</label>
                                    <select class="form-control selectized" name="plug" id="plug" name="plug">
                                        <option value=""></option>
                                        <option value="0">@lang('bocais.nao')</option>
                                        <option value="1">@lang('bocais.sim')</option>
                                    </select>
                                </div>
                            </div>

                        <div class="table-responsive m-auto tabela">
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
                                    <tr>
                                        <td>
                                            <input type="number" min=0.0001 class="form-control" required name="nome[]" id="nome" autocomplete="off">
                                        </td>
                                        <td>
                                            <input type="number" min=0.0001 class="form-control" required name="vazao[]" id="vazao" autocomplete="off">
                                        </td>
                                        <td>
                                            <input type="number" min=0.0001 class="form-control" required name="intervalo_trabalho[]" id="intervalotrabalho" autocomplete="off">
                                        </td>
                                        <td>
                                            <div class="row justify-content-center"></div>
                                        </td>
                                    </tr>
                                </tbody>

                                <tfoot>
                                    <div>
                                        <td>
                                            <div>
                                                <button onclick="AddTableRow()" type="button" class="addtablerow" data-toggle="tooltip"
                                                    data-placement="right" title="@lang('comum.addLine')"
                                                    style="outline: none; cursor: pointer;">
                                                    <span class="fa-stack fa-sm">
                                                    <i class="fas fa-plus-circle fa-stack-2x" style="margin-left: -70px !important;"></i>
                                                    </span>
                                                </button>
                                            </div>
                                        </td>
                                    </div>

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
    {{-- SCRIPT DE FUNCIONALIDADE DO TOOLTIP --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    {{-- FILTRO SELECT --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
            integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

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
                    "pressao_psi[]": {
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

                    "nome": {
                        required: "@lang('validate.validate')"
                    },
                    "pressao_psi": {
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

        //REMOVER LINHAS DA TABELA
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

        //ADICIONAR LINHAS A TABELA
        (function($) {
            //function add line/row Table
            AddTableRow = function() {
                var rowCount = $('#tabelaTrechos >tbody >tr').length;
                var newRow = $("<tr>");
                var cols = "";

                cols +=
                    '<td><input type="number" min=0.1 step=0.1 class="form-control" required name="nome[]" id="nome_' +
                    rowCount + '"></td>';

                cols +=
                    '<td><input type="number" min=0.0001 step=0.1 class="form-control" required name="vazao[]" id="vazao_' +
                    rowCount + '"></td>';

                cols +=
                    '<td><input type="number" min=0.0001 step=0.0001 class="form-control" required name="intervalo_trabalho[]" id="intervalo_trabalho_' +
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
@endsection
