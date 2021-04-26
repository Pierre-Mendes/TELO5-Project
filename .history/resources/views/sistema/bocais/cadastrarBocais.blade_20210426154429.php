@extends('_layouts._layout_site')
@include('_layouts._includes._head')

@section('head')@endsection
@section('titulo')@lang('bocais.bocais')@endsection

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- Titlle and Subtitlle --}}
            <div class="col-6">
                <h1>Cadastrar Bocais</h1>
            </div>

            {{-- Save button an return button --}}
            <div class="col-6 text-right botoes position">
                <a href="{{ route('fabricantes.gerenciar') }}" style="color: #3c8dbc">
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
            </div>
        </div>
    </div>
@endsection

@section('conteudo')
    <div>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="cadastro-tab" data-bs-toggle="tab" role="tab" aria-controls="cadastro"
                    aria-current="page" aria-selected="true" href="#cadastro">Geral</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="cadastro" role="tabpanel" aria-labelledby="cadastro-tab">
                <form action="{{ route('bocais.cadastrar') }}" method="POST">
                    @csrf
                    <div class="table table-striped mx-auto" id="filtertable">
                        <div class="form-row justify-content-start ml-3 mt-4 telo5ce">
                            <div class="col-md-3">
                                <label for="fabricante">@lang('bocais.fabricante')</label>
                                <select class="form-control" name="fabricante">
                                    <option value=""></option>
                                    <option value='0'>Fabricante1</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="modelo">@lang('bocais.modelo')</label>
                                <input class="form-control" type="text" name="modelo" id="modelo" required />
                            </div>

                            <div class="col-md-2">
                                <label for="tipoBocal">Tipo de Bocal</label>
                                <div id="alvo">
                                    <select name="options" class="col-md-11 form-control ">
                                        <option value=""></option>
                                        <option value="0">@lang('afericao.acoSac')</option>

                                    </select>
                                </div>
                           </div>
                        </div>
                    </div>
                    <table class="table table-striped mx-auto" id="tabelaTrechos">
                        <thead class="headertable">
                            <tr class="text-center">
                                <th scope="col-5">@lang('bocais.nome')</th>
                                <th scope="col-5">@lang('bocais.vazao_10_psi')</th>
                                <th scope="col-5">@lang('bocais.intervalo_trabalho')</th>
                                <th scope="col-5">@lang('bocais.plug')</th>
                                <th scope="col-2">@lang('bocais.acoes')</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <td>
                                <button onclick="AddTableRow()" type="button" class="addtablerow"
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
                        </tfoot>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

        <script>
        $(document).ready(function() {
            AddTableRow();
        });

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

        <script>
        (function($) {
            //function add line/row Table
                AddTableRow = function() {
                    var newRow = $("<tr>");
                    var cols = "";

                    cols += '<td><input type="number" min=0.0001 step=0.0001 class="form-control" required name="numero[]" id="numero"></td>';
                    cols += '<td><input type="number" min=0.0001 step=0.0001 class="form-control" required name="vazao_10_psi[]" id="vazao10psi"></td>';
                    cols += '<td><input type="number" min=0.0001 step=0.0001 class="form-control" required name="intervalo_trabalho[]" id="intervalotrabalho"></td>';
                    cols += '<td><select class="form-control"><option value=""></option><option value="0">@lang('bocais.nao')</option><option value="1">Sim</option></select></td>'
                    cols += '<td><div class="row justify-content-center"><button type="button" class="removetablerow" onclick="remove(this)" style="outline: none; cursor: pointer; margin-top: 4px; justify-content: center;"><i class="fa fa-fw fa-times fa-lg"></i></button></div></td>';

                    newRow.append(cols);
                    $("#tabelaTrechos").append(newRow);
                    return false;
                };
        })(jQuery);
        </script>

        <script>
        $(document).ready(function() {
            $('#botaosalvar').on('click', function() {
                $('#formdados').submit();
            });
        });
        </script>

    <script>
    function criarSelectFabricante(value) {
    var select = $("<option' name=\"fabricante[]\" /option>");
    var optionsValues = [];
    var optionsTexts = [];

    optionsValues.push(1);
    optionsTexts.push("@lang('bocais.fabricantes')");

    optionsValues.forEach(function(item, index)
    {
    if (item == value)
    {
    $("<option />", {value: item, text: optionsTexts[index] }).appendTo(select).attr('selected', 'selected');}

    else{
    $("<option />", {value: item, text: optionsTexts[index] }).appendTo(select);} });

    return select;
    }
    </script>
@endsection
