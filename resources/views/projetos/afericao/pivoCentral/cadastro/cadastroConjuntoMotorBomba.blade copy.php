@extends('_layouts._layout_site')

@section('titulo')
@lang('afericao.cadastroAdutora')
@endsection

@section('conteudo')

<div class="">
    <form action="{{route('cadastraMotorBomba')}}" method="POST">
        @csrf
    <input type="hidden" value="{{$id_afericao}}" name="id_afericao">

        <div id="accordion">
            <div class="">
                <div class="" id="headingAdutora">
                    <h3 class="mb-0">
                        @lang('afericao.trechos')
                        <button type="button" class="btn btn-outline-primary float-right" data-toggle="collapse" data-target="#collapseAdutora" aria-expanded="true" aria-controls="collapseAdutora">
                            <i class="fa fa-bars fa-fw"></i>
                        </button>
                    </h3>
                    <hr>
                </div>
                
                <div id="collapseAdutora" class="collapse" aria-labelledby="headingAdutora" data-parent="#accordion">
                    <div class="container">
                
                        <table class="table table-responsive-xl" id="tabelaTrechos">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">@lang('afericao.tipoCano')</th>
                                    <th scope="col">@lang('afericao.diametro')</th>
                                    <th scope="col">@lang('afericao.hw')</th>
                                    <th scope="col">@lang('afericao.numeroCanos')</th>
                                    <th scope="col">@lang('afericao.comprimento')</th>
                                    <th scope="col">@lang('afericao.desnivel')</th>
                                    <th scope="col" hidden >@lang('afericao.altitude')</th>
                                    <th scope="col" hidden>@lang('afericao.latitude')</th>
                                    <th scope="col" hidden>@lang('afericao.longitude')</th>
                                    <th scope="col">@lang('afericao.acoes')</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                            </tbody>
                            
                        </table>
                        <div colspan="9" class="text-left" style="padding: 10px">
                            <button class="btn btn-outline-primary " type="button" data-toggle="modal" data-target="#modalAddTrecho" data-whatever=""><i class="fa fa-fw fa-plus"></i>@lang('afericao.addTrecho')</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" name="botao" value="sair" id="btnSalvarAfericao" class="btn btn-outline-primary"> @lang('unidadesAcoes.salvarSair')</button>
            <a  id="" href="{{route('status_afericao', $id_afericao)}}" class="btn btn-outline-dark"> @lang('unidadesAcoes.voltar')</a>
        </div>
    </form>

</div>

<div class="modal fade" id="modalAddTrecho" tabindex="-1" role="dialog" aria-labelledby="modalAddTrechoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalAddTrechoLabel">@lang('afericao.novoTrecho')</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="formTrecho" action="" class="row" >
                <div class="form-group col-md-6">
                    <label class="" for="tipo_cano">@lang('afericao.tipoCano')</label>                                                                                             
                    <select name="tipo_cano" required class="form-control" id="tipo_cano">
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
                    <div class="line"></div>
                </div>
                
                <div class="form-group col-md-6">
                    <input type="number" min=0.001 step=0.001 class="form-control" required name="diametro" id="diametro">
                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.diametro')  . __('unidadesAcoes.(m)'), 'id' => ''])@endcomponent                                                                                                
                </div>

                <div class="form-group col-md-6">
                    <input type="number" class="form-control" required name="coeficiente_hw" id="coeficiente_hw">
                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.coeficiente_hw'), 'id' => ''])@endcomponent                                                                                                
                </div>

                <div class="form-group col-md-6">
                    <input type="number" min=1  class="form-control" required name="numero_canos" id="numero_canos">
                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.numero_canos'), 'id' => ''])@endcomponent                                                                                                
                </div>

                <div class="form-group col-md-6">
                    <input type="number" step="0.01" class="form-control" required name="comprimento" id="comprimento">
                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.comprimento') . __('unidadesAcoes.(m)'), 'id' => 'comprimento'])@endcomponent                                                                                                
                </div>

                <div class="form-group col-md-6">
                    <input type="number" step="0.01" class="form-control" required name="desnivel" id="desnivel">
                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.desnivel') . __('unidadesAcoes.(m)'), 'id' => 'desnivel'])@endcomponent                                                                                                
                </div>

                <div hidden class="form-group col-md-6">
                    <input type="number"  class="form-control" value="0" name="altitude" id="altitude">
                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.altitude')  . __('unidadesAcoes.(m)'), 'id' => ''])@endcomponent                                                                                                
                </div>

                <div hidden class="form-group col-md-6">
                    <input type="number"  step=0.000001 class="form-control"  value="0" name="latitude" id="latitude">
                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.latitude'), 'id' => ''])@endcomponent                                                                                                
                </div>

                <div hidden class="form-group col-md-6">
                    <input type="number"  step=0.000001 class="form-control" value="0" name="longitude" id="longitude">
                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.longitude'), 'id' => ''])@endcomponent                                                                                                
                </div>

            </form>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('afericao.fechar')</button>
            <button form="formTrecho" type="submit" class="btn btn-primary">@lang('afericao.addTrecho')</button>
        </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script>


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

    function addLinhaTabela	(formulario){
        var rowCount = $('#tabelaTrechos >tbody >tr').length;
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

    $("#btnSalvarAfericao").on('click', function(){
        $("#collapseBombeamento").show();
        $("#collapseAdutora").show();
    });
   
</script>
@endsection