@extends('_layouts._layout_site')

@section('titulo')

@endsection

@section('topo_detalhe')
<div class="container-fluid topo">
    <div class="row align-items-start">

        {{-- TITULO E SUBTITULO --}}
        <div class="col-6">
            <h1>@lang('afericao.cadastrarAdutora')</h1>
        </div>

        {{-- BOTOES SALVAR E VOLTAR --}}
        <div class="col-6 text-right botoes position">
            {{-- href="{{ route('status_afericao', $id_afericao) }}"> --}}
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
        </div>
    </div>
</div>
@endsection

@section('conteudo')

    <div class="">
        <form action="{{ route('cadastraMotorBomba') }}" method="POST" id="formdados">
            @csrf
            <input type="hidden" value="{{ $id_afericao }}" name="id_afericao">
            <div class="col-12 m-auto tabela">
                <table class="table table-striped mx-auto" id="tabelaTrechos">
                    <thead>
                        <tr>
                            <th scope="col">@lang('afericao.tipoCano')</th>
                            <th scope="col">@lang('afericao.diametro')</th>
                            <th scope="col">@lang('afericao.hw')</th>
                            <th scope="col">@lang('afericao.numeroCanos')</th>
                            <th scope="col">@lang('afericao.comprimento')</th>
                            <th scope="col">@lang('afericao.desnivel')</th>
                            <th scope="col" hidden>@lang('afericao.altitude')</th>
                            <th scope="col" hidden>@lang('afericao.latitude')</th>
                            <th scope="col" hidden>@lang('afericao.longitude')</th>
                            <th scope="col">@lang('afericao.acoes')</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
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
                        <td></td>
                        <td></td>
                        <td></td>
                    </tfoot>
                </table>
            </div>
    </div>
    </div>
    </div>


@endsection

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
            optionsValues.forEach(function(item, index) {
                if (item == value) {
                    $("<option />", {
                        value: item,
                        text: optionsTexts[index]
                    }).appendTo(select).attr('selected', 'selected');
                } else {
                    $("<option />", {
                        value: item,
                        text: optionsTexts[index]
                    }).appendTo(select);
                }
            });

            return select;
        }
    </script>
    {{-- <script>
        $("#formTrecho").submit(function(e) {
            e.preventDefault();
            $("#modalAddTrecho").modal('hide');
            var formulario = [];
            formulario['tipo_cano'] = $("#tipo_cano").val();
            formulario['diametro'] = $("#diametro").val();
            formulario['coeficiente_hw'] = $("#coeficiente_hw").val();
            formulario['numero_canos'] = $("#numero_canos").val();
            formulario['comprimento'] = $("#comprimento").val();
            formulario['desnivel'] = $("#desnivel").val();
            formulario['altitude'] = $("#altitude").val();
            formulario['latitude'] = $("#latitude").val();
            formulario['longitude'] = $("#longitude").val();
            addLinhaTabela(formulario);
            $("#tipo_cano").val(0);
            $("#diametro").val("");
            $("#coeficiente_hw").val("");
            $("#numero_canos").val("");
            $("#comprimento").val("");
            $("#desnivel").val("");
            $("#altitude").val("");
            $("#latitude").val("");
            $("#longitude").val("");
        });

        function addLinhaTabela(formulario) {
            var rowCount = $('#tabelaTrechos >tbody >tr').length;
            var newRow = $("<tr>");
            var cols = "";
            //        cols += '<td><input type="number" required name="tipo_cano[]" value="'+ formulario["tipo_cano"] +'" readonly class="form-control"></td>';
            cols += '<td style="width: 150px">' + criarSelectTipoCano(formulario['tipo_cano']).prop('outerHTML') + '</td>';
            cols += '<td><input type="number" required name="diametro[]" value="' + formulario["diametro"] +
                '" class="form-control"></td>';
            cols += '<td><input type="number" required  name="coeficiente_hw[]" value="' + formulario["coeficiente_hw"] +
                '" class="form-control"></td>';
            cols += '<td><input type="number" required  name="numero_canos[]" value="' + formulario["numero_canos"] +
                '" class="form-control"></td>';
            cols += '<td><input type="number" required  name="comprimento[]" value="' + formulario["comprimento"] +
                '" class="form-control"></td>';
            cols += '<td><input type="number" required  name="desnivel[]" value="' + formulario["desnivel"] +
                '" class="form-control"></td>';
            cols += '<td hidden><input type="number"  name="altitude_trecho[]" value="0" class="form-control"></td>';
            cols += '<td hidden><input type="number"  name="latitude_trecho[]" value="0" class="form-control"></td>';
            cols += '<td hidden><input type="number"  name="longitude_trecho[]" value="0" class="form-control"></td>';
            cols += '<td>';
            cols +=
                '   <button class="btn btn-outline-danger" onclick="deletarLinha(this)" type="button"><i class="fa fa-fw fa-trash"></i></button>';
            cols += '</td>';
            newRow.append(cols);
            $("#tabelaTrechos").append(newRow);
        }



        function deletarLinha(item) {
            var tr = $(item).closest('tr');
            tr.fadeOut(400, function() {
                tr.remove();
            });
        }

        $("#btnSalvarAfericao").on('click', function() {
            $("#collapseBombeamento").show();
            $("#collapseAdutora").show();
        });

    </script> --}}
@endsection
