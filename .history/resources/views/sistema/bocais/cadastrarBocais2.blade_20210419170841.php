@extends('_layouts._layout_site')

@section('titulo')
    @lang('bocais.bocaisCadastrar')
@endsection

@section('conteudo')

<div class="">
    <form action="{{route('bocais.cadastra')}}" method="POST">
        @csrf

        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="fabricante">@lang('bocais.fabricante')</label>
                    <input type="text" name="fabricante" id="fabricante" class="form-control" />
                    <div class="line"></div>
                </div>
                <div class="col-md-3">
                    <label for="tipo">@lang('bocais.tipo')</label>
                    <input class="form-control" type="text" name="tipo" id="tipo" />
                    <div class="line"></div>
                </div>
                <div class="col-md-3">
                    <label for="modelo">@lang('bocais.modelo')</label>
                    <input class="form-control" type="text" name="modelo" id="modelo" />
                    <div class="line"></div>
                </div>

                <div class="col-md-3">
                    <label >@lang('bocais.plug')</label>
                    <select>
                        <option value='0'>@lang('bocais.nao')</option>
                        <option value='1'>@lang('bocais.sim')</option>
                    </select>
                </div>
            </div>
        </div>

            <table class="table table-responsive-xl" id="tabelaBocais">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">@lang('bocais.nome')</th>
                        <th scope="col">@lang('bocais.vazao_10_psi')</th>
                        <th scope="col">@lang('bocais.intervalo_trabalho')</th>
                        <th scope="col">@lang('bocais.acoes')</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><input type="text" /></td>
                        <td><input type="text" /></td>
                        <td><input type="text" /></td>
                        <td><input type="text" /></td>
                    </tr>
                </tbody>

                <tfoot>

                </tfoot>
            </table>
            <div colspan="9" class="text-left" style="padding: 10px">
                    <button class="btn btn-outline-primary " type="button" data-toggle="modal" data-target="#modalAddBocal" data-whatever=""><i class="fa fa-fw fa-plus"></i>@lang('bocais.addBocal')</button>
            </div>

        <div class="text-center">
            <button type="submit" value="salvar" name="botao_form" id="btnSalvar" class="btn btn-outline-primary"> @lang('unidadesAcoes.salvar')</button>
            <button type="submit" value="sair" name="botao_form" id="btnSalvarBocais" class="btn btn-outline-primary"> @lang('unidadesAcoes.salvarSair')</button>
        </div>
    </form>

</div>

@endsection

@section('scripts')
    @include('_layouts._includes._validators_jquery')

    <script type="text/javascript">

    $("#formTrecho").submit(function(e) {
        e.preventDefault();
        $("#modalAddBocal").modal('hide');
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

    function addLinhaTabela	(formulario)
    {
        var rowCount = $('#tabelaTrechos > tbody >tr').length;
        var newRow = $("<tr>");
        var cols = "";
        
    //        cols += '<td><input type="number" required name="tipo_cano[]" value="'+ formulario["tipo_cano"] +'" readonly class="form-control"></td>';
        cols += '<td style="width: 150px">' + criarSelectTipoCano(formulario['tipo_cano']).prop('outerHTML') + '</td>';
        cols += '<td><input type="number" required name="diametro[]" value="'+ formulario["diametro"] +'" class="form-control"></td>';
        cols += '<td><input type="number" required  name="coeficiente_hw[]" value="'+ formulario["coeficiente_hw"] +'" class="form-control"></td>';
        cols += '<td><input type="number" required  name="numero_canos[]" value="'+ formulario["numero_canos"] +'" class="form-control"></td>';
        cols += '<td><input type="number" required  name="comprimento[]" value="'+ formulario["comprimento"] +'" class="form-control"></td>';
        cols += '<td><input type="number" required  name="desnivel[]" value="'+ formulario["desnivel"] +'" class="form-control"></td>';
        cols += '<td hidden><input type="number"  name="altitude_trecho[]" value="0" class="form-control"></td>';
        cols += '<td hidden><input type="number"  name="latitude_trecho[]" value="0" class="form-control"></td>';
        cols += '<td hidden><input type="number"  name="longitude_trecho[]" value="0" class="form-control"></td>';
        cols += '<td>';
        cols += '   <button class="btn btn-outline-danger" onclick="deletarLinha(this)" type="button"><i class="fa fa-fw fa-trash"></i></button>';
        cols += '</td>';
        newRow.append(cols);
        $("#tabelaTrechos").append(newRow);
    }

    function criarSelectTipoCano(value){
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

        optionsValues.forEach(function(item, index){
            if(item == value){
                $("<option />", {value: item, text: optionsTexts[index]}).appendTo(select).attr('selected', 'selected');
            }else{
                $("<option />", {value: item, text: optionsTexts[index]}).appendTo(select);
            }
        });

        return select;
    }

    function deletarLinha(item) {
        var tr = $(item).closest('tr');
        tr.fadeOut(400, function() {
            tr.remove();
        });
    }

    $("#btnSalvarAdutora").on('click', function(){
        $("#collapseBombeamento").show();
        $("#collapseAdutora").show();
    });

    </script>

@endsection
