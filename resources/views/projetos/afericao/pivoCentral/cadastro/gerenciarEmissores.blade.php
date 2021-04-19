@extends('_layouts._layout_site')
@section('head')
<style>
    .bg_irr_escuro{
        background-color: #013856 !important;
    }
    .bg_irr_claro{
        background-color: #1782b6 !important;
    }

    td {
        width: 15%;
    }
    
    /*Barra de rolagem para a tabela*/
    .tableFixHead          { overflow-y: scroll; height: 1000px;}
    .tableFixHead thead th { position: sticky; top: 0; }
    td > input {width: 50%;}
</style>
@endsection

@section('titulo')
    @lang('afericao.emissores')
@endsection

@section('conteudo')    
    <div>
        <form id="formEditarTodos" action="{{route("emissores_editar_todos")}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="id_afericao" value="{{$id_afericao}}" />
            <table class="table table-responsive tableFixHead" style="height: 500px">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center" scope="col">@lang('afericao.lance')</th>
                        <th class="text-center" scope="col">@lang('afericao.posLance')</th>
                        <th class="text-center" scope="col">@lang('afericao.saida1')</th>
                        <th class="text-center" scope="col">@lang('afericao.saida2')</th>
                        <th class="text-center" scope="col">@lang('afericao.espacamento')</th>
                        <th class="text-center" scope="col">@lang('afericao.valvulaReguladora')</th>
                        <th class="text-center" scope="col">@lang('afericao.tipoValvula')</th>
                        <th class="text-center" scope="col">@lang('afericao.fabricante')</th>
                        <?php /*<th class="text-center" scope="col">@lang('afericao.acoes')</th> */?>
                    </tr>
                </thead>
                <tbody class="tbody" style="height:100%; overflow-y: scroll">
                @foreach ($emissores as $index => $emissor)
                    @if($emissor['numero_lance'] % 2 == 0) 
                        <tr class="bg_irr_claro text-light rows" id="item_{{$index}}">
                    @else
                        <tr class="bg_irr_escuro text-light rows" id="item_{{$index}}">
                    @endif
                        @if($afericao['tem_balanco'] == "sim" && $emissor['numero_lance'] == $afericao['numero_lances'])
                            <td class="text-center" id="fabricante_{{$emissor['id_lance']}}">@lang('afericao.balanco')</td>                            
                        @else
                            <td class="text-center" id="fabricante_{{$emissor['id_lance']}}">{{$emissor['numero_lance'] }}</td>
                        @endif
                        <input type="hidden" name="id[]" value="{{$emissor['id'] }}" />
                        <td class="text-center" ><input type="hidden" name="numero[]" value="{{$emissor['numero'] }}" />{{$emissor['numero']}}</td>
                        <td class="text-center" id="bocal_1_{{$emissor['id']}}"><input type="number" name="saida_1[]" class="text-center" value="{{ $emissor['saida_1']}}" class="text-center" /></td>
                        <td class="text-center" id="bocal_2_{{$emissor['id']}}"><input type="number" name="saida_2[]" class="text-center" value="{{ $emissor['saida_2']}}" class="text-center" /></td>
                        <td class="text-center" id="espacamento_{{$emissor['id']}}"><input type="number" name="espacamento[]" class="text-center" value="{{ $emissor['espacamento']}}" class="text-center" /></td>
                        <td class="text-center" id="valvula_reguladora_{{$emissor['id']}}">
                            <select name="valvula_reguladora[]">
                                <option value='10' <?php if($emissor['psi'] == 10) echo"selected='selected'";?> ><b>10 PSI</b></option>
                                <option value='15' <?php if($emissor['psi'] == 15) echo"selected='selected'";?> ><b>15 PSI</b></option>
                                <option value='20' <?php if($emissor['psi'] == 20) echo"selected='selected'";?> ><b>20 PSI</b></option>
                                <option value='25' <?php if($emissor['psi'] == 25) echo"selected='selected'";?> ><b>25 PSI</b></option>
                                <option value='30' <?php if($emissor['psi'] == 30) echo"selected='selected'";?> ><b>30 PSI</b></option>
                                <option value='35' <?php if($emissor['psi'] == 35) echo"selected='selected'";?> ><b>35 PSI</b></option>
                                <option value='40' <?php if($emissor['psi'] == 40) echo"selected='selected'";?> ><b>40 PSI</b></option>
                                <option value='45' <?php if($emissor['psi'] == 45) echo"selected='selected'";?> ><b>45 PSI</b></option>
                                <option value='50' <?php if($emissor['psi'] == 50) echo"selected='selected'";?> ><b>50 PSI</b></option>
                            </select>
                        </td>
                        <td class="text-center" id="tipo_valvula_{{$emissor['id']}}">
                            <select name="tipo_valvula[]">
                                <option value='LF'  @if($emissor['tipo_valvula'] == 'LF') selected @endif><b>LF</b></option>
                                <option value='MF'  @if($emissor['tipo_valvula'] == 'MF') selected @endif><b>MF</b></option>
                                <option value='HF'  @if($emissor['tipo_valvula'] == 'HF') selected @endif><b>HF</b></option>
                                <option value='PSR'  @if($emissor['tipo_valvula'] == 'PSR') selected @endif><b>PSR</b></option>
                            </select>
                        </td>
                        <td class="text-center" id="fabricante_{{$emissor['id']}}">
                            <select name="fabricante[]">
                                <option  @if($emissor['emissor'] == 'I-WOB UP3') selected @endif value='I-WOB UP3'><b >@lang('afericao.i-wob-up3')</b></option>
                                <option  @if($emissor['emissor'] == 'FABRIMAR') selected @endif  value='Fabrimar'><b>@lang('afericao.fabrimar')</b></option>
                                <option  @if($emissor['emissor'] == 'NELSON') selected @endif  value='Nelson'><b>@lang('afericao.nelson')</b></option>
                                <option  @if($emissor['emissor'] == 'SUPER SPRAY - UP3') selected @endif  value='Super Spray - UP3'><b>@lang('afericao.super-spray-up3')</b></option>
                                <option  @if($emissor['emissor'] == 'SUPER SPRAY') selected @endif  value='Super Spray'><b>@lang('afericao.super-spray')</b></option>
                                <option  @if($emissor['emissor'] == 'I-WOB') selected @endif  value='I-WOB'><b>@lang('afericao.i-wob')</b></option>
                                <option  @if($emissor['emissor'] == 'TRASH BUSTER') selected @endif  value='Trash Buster'><b>@lang('afericao.trash-buster')</b></option>
                                <option  @if($emissor['emissor'] == 'KOMET') selected @endif  value='Komet'><b>@lang('afericao.komet')</b></option>
                                <option  @if($emissor['emissor'] == 'FAN SPRAY') selected @endif value='Fan Spray'><b>@lang('afericao.fan-spray')</b></option>
                            </select>
                        </td>
                        <?php /*<td class="text-center"> <button class="btn btn-outline-light" id="button_{{$emissor['id']}}"><i class="fa fa-pencil fa-fw"></i></button></td> */?>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="text-align:center">
                <div class="row">                
                    {{$emissores}}
                </div>
            </div>
            
            <br /><br />

            <div class="text-center">
                <button class="btn btn btn-outline-info " name="botao" value="salvar" type="submit">@lang('unidadesAcoes.salvar')</button>
                <button class="btn btn btn-outline-info " name="botao" value="sair" type="submit">@lang('unidadesAcoes.salvarSair')</button>
                <a class="btn btn-outline-dark" href="{{URL::previous()}}">@lang('unidadesAcoes.voltar')</a>
            </div>
        </form>
    </div>
    
    <modal nome="editar" titulo="@lang('afericao.editarEmissor')" css='modal-md'>
    <formulario id="formEditar" v-bind:action="'{{route("emissores_editar")}}'" css='row' method="put" enctype="" token="{{ csrf_token() }}">
            <input type="text" id="id_emissor" name='id_emissor' hidden >
    
            <div class="form-group col-md-6">
                <label for="espacamento">@lang('afericao.espacamento')</label>
                <input class="form-control"   id="espacamento" name="espacamento" type="number" step=0.01 aria-describedby="" placeholder="@lang('afericao.espacamento')" required>
                @component('_layouts._components._inputLabel', ['texto'=>'', 'id' => ''])@endcomponent

            </div>
    
            <div class="form-group col-md-6">
                <label for="valvula_reguladora">@lang('afericao.valvulaReguladora')</label>
                <select  id="valvula_reguladora" name="psi"  class='form-control' required='true' >
                    <option value='10'><b>10 PSI</b></option>
                    <option value='15'><b>15 PSI</b></option>
                    <option value='20'><b>20 PSI</b></option>
                    <option value='25'><b>25 PSI</b></option>
                    <option value='30'><b>30 PSI</b></option>
                    <option value='35'><b>35 PSI</b></option>
                    <option value='40'><b>40 PSI</b></option>
                    <option value='45'><b>45 PSI</b></option>
                    <option value='50'><b>50 PSI</b></option>
                </select>
                <div class="line"></div>
            </div>
    
            <div class="form-group col-md-6">
                <label for="tipo_valvula">@lang('afericao.tipoValvula')</label>
                <select id="tipo_valvula" class='form-control' required='true' name='tipo_valvula'>
                    <option value='LF'  ><b>LF</b></option>
                    <option value='MF'  ><b>MF</b></option>
                    <option value='HF'  ><b>HF</b></option>
                    <option value='PSR' ><b>PSR</b></option>
                </select>
                <div class="line"></div>

            </div>
    
    
            <div class="form-group col-md-6">
                <label for="fabricante">@lang('afericao.fabricante')</label>
                <select class='form-control' required='true'  id="fabricante" required name='emissor'>
                    <option   value='I-WOB UP3'><b>I-WOB UP3</b></option>
                    <option   value='Fabrimar'><b>Fabrimar</b></option>
                    <option   value='Nelson'><b>Nelson</b></option>
                    <option   value='Super Spray - UP3'><b>Super Spray UP3</b></option>
                    <option   value='Super Spray'><b>Super Spray</b></option>
                    <option   value='I-WOB'><b>I-WOB</b></option>
                    <option   value='Trash Buster'><b>Trash Buster</b></option>
                    <option   value='Komet'><b>Komet</b></option>
                    <option   value='Fan Spray'><b>Fan Spray</b></option>
                </select>
                <div class="line"></div>

            </div>
    
            <div class="form-group col-md-6">
                <label for="saida_1">@lang('afericao.saida1')</label>
                <input class="form-control"   id="saida_1" name="saida_1" type="number" step=0.01 aria-describedby="" placeholder="@lang('afericao.saida1')" required>
                @component('_layouts._components._inputLabel', ['texto'=>'', 'id' => ''])@endcomponent            
            </div>
    
            <div class="form-group col-md-6">
                <label for="saida_2">@lang('afericao.saida2')</label>
                <input class="form-control"   id="saida_2" name="saida_2" type="number" step=0.01  aria-describedby="" placeholder="@lang('afericao.saida2')" required>
                @component('_layouts._components._inputLabel', ['texto'=>'', 'id' => ''])@endcomponent
            </div>
            
        </formulario>
        <span slot="botoes">
            <button form="formEditar" class="btn btn-info">@lang('afericao.editarEmissor')</button>
        </span>
    </modal>

@endsection

@section('scripts')
<script type="text/javascript">
    $(document).on("click","tr.rows button", function(e){
        var id_button = (e.currentTarget.id);
        id_button = id_button.split('_')[1];

        var espacamento = $("#espacamento_" + id_button).text();
        var saida_1 = $("#bocal_1_" + id_button).text();
        var saida_2 = $("#bocal_2_" + id_button).text();
        var valvula_reguladora = $("#valvula_reguladora_" + id_button).text();
        var tipo_valvula = $("#tipo_valvula_" + id_button).text();
        var fabricante = $("#fabricante_" + id_button).text();
        $("#espacamento").val(espacamento.replace(",", "."));
        $("#valvula_reguladora").val(valvula_reguladora.split(" ")[0]);
        $("#tipo_valvula").val(tipo_valvula);
        $("#fabricante").val(fabricante);
        $("#saida_1").val(saida_1.replace(",", ".").replace(" ", ""));
        $("#saida_2").val(saida_2.replace(",", ".").replace(" ", ""));
        $("#editar").modal('show');
        $("#id_emissor").val(id_button);
    });
</script>
@endsection