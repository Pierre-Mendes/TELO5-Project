@extends('_layouts._layout_site')
@include('_layouts._includes._head')

@section('head')@endsection
@section('titulo')@lang('bocais.bocais')@endsection

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- Titlle and Subtitlle --}}
            <div class="col-6">
                <h1>@lang('bocais.bocais')</h1>
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
                <form action="{{route('bocais.cadastra')}}" method="POST">
                    @csrf
                    <div class="table table-striped mx-auto" id="filtertable">
                        <div class="form-row justify-content-start ml-3 mt-4 telo5ce">
                            <div class="col-md-3">
                                <label for="fabricante">@lang('bocais.fabricante')</label>
                                <input class="form-control" type="text" name="fabricante" id="fabricante" class="form-control" required/>
                            </div>

                            <div class="col-md-3">
                                <label for="modelo">@lang('bocais.modelo')</label>
                                <input class="form-control" type="text" name="modelo" id="modelo" required/>
                            </div>

                            <div class="col-md-2">
                                <label for="tipo">@lang('bocais.tipo')</label>
                               <div id="alvo">
                                <select name="options" class="col-md-11 form-control has-value">
                                    <option value=""></option>
                                    <option value="0">@lang('afericao.acoSac')</option>
                                    <option value="1">@lang('afericao.az')</option>
                                    <option value="2">@lang('afericao.ferroFundido')</option>
                                    <option value="3">PVC PN 125</option>
                                    <option value="4">PVC PN 140</option>
                                    <option value="5">PVC PN 180</option>
                                    <option value="6">PVC PN 60</option>
                                    <option value="7">PVC PN 80</option>
                                    <option value="8">RPVC PN 100</option>
                                    <option value="9">@lang('afericao.aluminio')</option>
                                </select>
                            </div>
                            </div>

                            <div class="col-md-1">
                                <label >@lang('bocais.plug')</label>
                                <div>
                                <select class="form-control">
                                    <option value='0'>@lang('bocais.nao')</option>
                                    <option value='1'>Sim</option>
                                </select>
                            </div>
                            </div>
                        </div>
                    </div>
                        <table class="table table-striped mx-auto" id="filtertable">
                            <thead class="headertable">
                                <tr class="text-center">
                                    <th scope="col-5">@lang('bocais.nome')</th>
                                    <th scope="col-5">@lang('bocais.vazao_10_psi')</th>
                                    <th scope="col-5">@lang('bocais.intervalo_trabalho')</th>
                                    <th scope="col-2">@lang('bocais.acoes')</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td><input type="number" step="1" min="1" name="fabricante" id="fabricante" class="form-control" required></td>
                                    <td><input type="number" step="0.01" min="0.01" name="vazaoPSI" id="fabricante" class="form-control" required></td>
                                    <td><input type="number" step="0.01" min="0.01" name="intervaloTrabalho" id="fabricante" class="form-control" required></td>
                                    <td class="acoes">
                                        <!--
                                        <form action="{{--action('Sistema\BocalController@removerBocal', $bocais['id']) }}"
                                            method="POST" class="delete_form">
                                            {{ csrf_field() }}
                                            <a href="{{ route('bocais.editar', $fabricante->id) --}}"><button type="button" class=""><i
                                                    class='fa fa-fw fa-pen'></i></button></a>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class=""><i class='fa fa-fw fa-times'></i></button>
                                        </form>
                                    -->
                                    </td>
                                </tr>
                            </tbody>

                            <tfoot>
                                <tfoot>
                                    <td>
                                    <button onclick="AddTableRow()" type="button" class="addtablerow" style="outline: none; cursor: pointer;">
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
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">

@section('scripts')

<script>
    $(document).ready(function(){
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
        AddTableRow = function() {
            var newRow = $("<tr>");
            var cols = "";

            cols += '<td>';
            cols += '<select name="tipo_cano[]" required class="form-control" id="tipo_cano">';
            cols += '<option value="0">@lang('afericao.acoSac')</option>';
            cols += '<option value="1">@lang('afericao.az')</option>';
            cols += '<option value="2">@lang('afericao.ferroFundido')</option>';
            cols += '<option value="3">PVC PN 125</option>';
            cols += '<option value="4">PVC PN 140</option>';
            cols += '<option value="5">PVC PN 180</option>';
            cols += '<option value="6">PVC PN 60</option>';
            cols += '<option value="7">PVC PN 80</option>';
            cols += '<option value="8">RPVC PN 100</option>';
            cols += '<option value="9">@lang('afericao.aluminio')</option>';
            cols += '</select>';
            cols += '</td>';

            cols += '<td><input type="number" min=0.001 step=0.001 class="form-control" required name="diametro[]" id="diametro"></td>';
            cols += '<td><input type="number" class="form-control" required name="coeficiente_hw[]" id="coeficiente_hw"></td>';
            cols += '<td><input type="number" min=1 class="form-control" required name="numero_canos[]" id="numero_canos"></td>';
            cols += '<td><input type="number" step="0.01" class="form-control" required name="comprimento[]" id="comprimento"></td>';
            cols += '<td><input type="number" step="0.01" class="form-control" required name="desnivel[]" id="desnivel"></td>';
            cols += '<td><button type="button" class="removetablerow" onclick="remove(this)" style="outline: none; cursor: pointer; margin-top: 4px;"><i class="fa fa-fw fa-times fa-lg"></i></button></td>';
            cols += '<td hidden><input type="number" class="form-control" value="0" name="altitude[]" id="altitude"></td>';
            cols += '<td hidden><input type="number" step=0.000001 class="form-control" value="0" name="latitude[]" id="latitude"></td>';
            cols += '<td hidden><input type="number" step=0.000001 class="form-control" value="0" name="longitude[]" id="longitude"></td>';
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
        function criarSelectTipoCano(value) {
        var select = $("<select  class='form-control' name=\"tipo_cano[]\" />");
        var optionsValues = [];
        var optionsTexts = [];

        optionsValues.push(0);
        optionsTexts.push("@lang('afericao.acoSac')");

        optionsValues.push(1);
        optionsTexts.push("@lang('afericao.az')");

        optionsValues.push(2);
        optionsTexts.push("@lang('afericao.ferroFundido')");

        optionsValues.push(3);
        optionsTexts.push("PVC PN 125");

        optionsValues.push(4);
        optionsTexts.push("PVC PN 140");

        optionsValues.push(5);
        optionsTexts.push("PVC PN 180");

        optionsValues.push(6);
        optionsTexts.push("PVC PN 60");

        optionsValues.push(7);
        optionsTexts.push("PVC PN 80");

        optionsValues.push(8);
        optionsTexts.push("RPVC PN 100");

        optionsValues.push(9);
        optionsTexts.push("@lang('afericao.aluminio')");

        optionsValues.forEach(function(item, index)
        {
            if (item == value)
            {
                $("<option />", {value: item, text: optionsTexts[index] }).appendTo(select).attr('selected', 'selected');
            }
            else
            {
                $("<option />", {value: item, text: optionsTexts[index] }).appendTo(select);
            }
        });
        return select;
    }
</script>
    @include('_layouts._includes._validators_jquery')
@endsection
