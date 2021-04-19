@extends('_layouts._layout_site')

@section('titulo')
    @lang('redimensionamento.editarLance')
@endsection

@section('conteudo')
<formulario  id="formEditarLance" css="row" action="{{route('salvarInformacoesLance')}}" method="put" enctype="" token="{{ csrf_token() }}"  >

    <input type="hidden" name="id_lance" value="{{$lance['id']}}">
    <input type="hidden" name="id_afericao" value="{{$lance['id_afericao']}}">
    <input type="hidden" name="numero_original_emissores" value={{$lance['numero_emissores']}}>
    <div class="row col-12">
        <div class="col-12 text-center">
            <h3>@lang('redimensionamento.editarLance')</h3>
        </div>

        <div class="form-group col-md-3 col-6">
            <input type="number" value="{{$lance['numero_emissores']}}" name="numero_emissores" onchange="alterarQuantidadeDeEmissores()" id="numero_emissores" step=1 min=1   class="form-control ">
            @component('_layouts._components._inputLabel', ['texto'=>__('afericao.numeroEmissores'), 'id' => 'numero_emissores'])@endcomponent                                                                        
        </div>

        <div class="form-group col-md-2 col-6">
            <input type="number" value="{{$lance['numero_tubos']}}" step=1 min=1 name="numero_tubos" id="num_tubo" required  class="form-control ">
            @component('_layouts._components._inputLabel', ['texto'=>__('afericao.numeroTubos'), 'id' => 'num_tubo'])@endcomponent                                                                        
        </div>

        <div class="form-group col-md-1  col-6">
            <label for=""> @lang('afericao.diametro')</label>
            <select name="diametro"  class="form-control" required id="">
                <option @if($lance['diametro'] == 0.127) selected @endif value="0.127">5"</option>
                <option @if($lance['diametro'] == 0.1413) selected @endif  value="0.1413">5.9/16</option>
                <option @if($lance['diametro'] == 0.1524) selected @endif  value="0.1524">6"</option>
                <option @if($lance['diametro'] == 0.1683) selected @endif  value="0.1683">6.5/8"</option>
                <option @if($lance['diametro'] == 0.2032) selected @endif  value="0.2032">8"</option>
                <option @if($lance['diametro'] == 0.219) selected @endif  value="0.219">8.5/8"</option>
                <option @if($lance['diametro'] == 0.254) selected @endif  value="0.254">10"</option>
            </select>
            <div class="line"></div>
        </div>

        <div class="form-group col-md-2  col-6">
            <label for="val_reg"> @lang('afericao.valvulaReguladora')</label>
            <select id="val_reg" onchange="atualizarValvulaReguladora()" class='form-control' required='true' name='valvula_reguladora_lance'>
                <option @if($lance['valvula_reguladora'] == 10) selected @endif value='10'><b>10 PSI</b></option>
                <option @if($lance['valvula_reguladora'] == 15) selected @endif value='15'><b>15 PSI</b></option>
                <option @if($lance['valvula_reguladora'] == 20) selected @endif value='20'><b>20 PSI</b></option>
                <option @if($lance['valvula_reguladora'] == 25) selected @endif value='25'><b>25 PSI</b></option>
                <option @if($lance['valvula_reguladora'] == 30) selected @endif value='30'><b>30 PSI</b></option>
                <option @if($lance['valvula_reguladora'] == 35) selected @endif value='35'><b>35 PSI</b></option>
                <option @if($lance['valvula_reguladora'] == 40) selected @endif value='40'><b>40 PSI</b></option>
                <option @if($lance['valvula_reguladora'] == 45) selected @endif value='45'><b>45 PSI</b></option>
                <option @if($lance['valvula_reguladora'] == 50) selected @endif value='50'><b>50 PSI</b></option>
            </select>
            <div class="line"></div>
        </div>

        <div class="form-group col-md-2  col-6">
            <label for="tipo_valvula"> @lang('afericao.tipoValvula')</label>
            <select id="tipo_valvula" onchange="atualizarTipoValvulaReguladora()" class='form-control' required='true' name='tipo_valvula'>
                <option value='LF'><b>LF</b></option>
                <option value='MF'><b>MF</b></option>
                <option value='HF'><b>HF</b></option>
                <option value='PSR'><b>PSR</b></option>
            </select>
            <div class="line"></div>
        </div>

        <div class="form-group col-md-2  col-6">
            <input type="number" class="form-control" value="{{$lance['motorredutor']}}" id="motorredutor" step=0.01 name="motorredutor">
            @component('_layouts._components._inputLabel', ['texto'=>__('afericao.motorredutor'), 'id' => 'motorredutor'])@endcomponent                                                                        
        </div>

        <hr>

    </div>

    <div class="">
        <div class="col-12 text-center">
            <h3>@lang('redimensionamento.emissores')</h3>
        </div>
        <div class="row col-12 justify-content-center" id="div_lista_emissores">

        </div>
    </div>
    <div class="col-12 text-center">
        <button class="btn btn-outline-primary"><i class="fa fa-save fa-fw"></i>@lang('unidadesAcoes.salvar') </button> <i class="fa fa-fw"></i> <a href="{{ ($dados['tipo_projeto'] == "A") ? route('configurarPivoAfericao', $lance['id_afericao']) : route('configurarPivoRedimensionamento', $lance['id_afericao']) }}" class="btn btn-outline-dark">@lang('unidadesAcoes.voltar')</a>
    </div>
</formulario>
@endsection

@section('scripts')


<script type="text/javascript">
    function alterarQuantidadeDeEmissores(){
        var qtEmissores = $("#numero_emissores").val();
        var divEmissores = $("#div_lista_emissores");
        var espacamento = "{{$dados['espacamento']}}";
        var emissor = "{{$dados['emissor']}}";
        var emissores =  @json($emissores);
        var qtEmissoresLance = "{{$lance['numero_emissores']}}";
        
        $("#msgInformeEmissores").remove();
        divEmissores.empty();
        if(qtEmissores == 0 || qtEmissores === "" || qtEmissores === undefined){
            divEmissores.append('<h3 id="msgInformeEmissores" class="text-center" > @lang("redimensionamento.informeNumeroLances") </h3>');
        }else{
            for (let index = 0; index < qtEmissores; index++) {
                var linhaEmissor;
                if(emissores[index] != null){
                    linhaEmissor = emissores[index]['emissor'];
                }else{
                    linhaEmissor = emissor;
                }
                var linha = `
                    <div class="col-1 my-auto linha_emissor">
                        <h3 style="padding-top: 20px">${index + 1}</h3>
                    </div>
                    <div class="col-11 row">
                        <input type="hidden" ${ (index < qtEmissoresLance) ? 'name="id_emissor[]" value=' + emissores[index]["id"] : ''} >
                        <input type="hidden" name="numero_emissor[]" value="${index + 1}">
                        <div class="form-group col-md-2">
                            <label class='float-label' > @lang('afericao.saida1')</label>
                            <input value='${(emissores[index] != null) ? emissores[index]['saida_1'] : ''}' type="number" step=0.1 min=0  name="bocal_1[]" required class="form-control first_field">
                            <div class="line" ></div>
                        </div>
                
                        <div class="form-group  col-md-2">
                            <label class='float-label' > @lang('afericao.saida2')</label>
                            <input type="number" value="${(emissores[index] != null) ? emissores[index]['saida_2'] : ''}" step=0.1 min=0 name="bocal_2[]"  class="form-control ">
                            <div class="line" ></div>
                        </div>
                
                        <div class="form-group  col-md-2">
                            <label class='float-label' > @lang('afericao.espacamento')</label>
                            <input type="number" name="espacamento[]" value="${(emissores[index] != null) ? (emissores[index]['espacamento']).toFixed(2) : espacamento}" step=0.001 min=0.001 required class="form-control espacamento_field">
                            <div class="line" ></div>
                        </div>
                
                        <div class="form-group col-md-2">
                            <label for=""> @lang('afericao.emissor')</label>
                            <select class='form-control' required='true' required name='emissor[]'>
                                <option  ${(linhaEmissor.toUpperCase() ==='I-WOB UP3') ? 'selected' : ''}   ${(emissores[index])}     value='I-WOB UP3'><b>@lang('afericao.i-wob-up3')</b></option>
                                <option  ${(linhaEmissor.toUpperCase() ==='FABRIMAR') ? 'selected' : ''}        value='Fabrimar'><b>@lang('afericao.fabrimar')</b></option>
                                <option  ${(linhaEmissor.toUpperCase() ==='NELSON') ? 'selected' : ''}          value='Nelson'><b>@lang('afericao.nelson')</b></option>
                                <option  ${(linhaEmissor.toUpperCase() ==='SUPER SPRAY - UP3') ? 'selected' : ''} value='Super Spray - UP3'><b>@lang('afericao.super-spray-up3')</b></option>
                                <option  ${(linhaEmissor.toUpperCase() ==='SUPER SPRAY') ? 'selected' : ''}     value='Super Spray'><b>@lang('afericao.super-spray')</b></option>
                                <option  ${(linhaEmissor.toUpperCase() ==='I-WOB') ? 'selected' : ''}            value='I-WOB'><b>@lang('afericao.i-wob')</b></option>
                                <option  ${(linhaEmissor.toUpperCase() ==='TRASH BUSTER') ? 'selected' : ''}    value='Trash Buster'><b>@lang('afericao.trash-buster')</b></option>
                                <option  ${(linhaEmissor.toUpperCase() ==='KOMET') ? 'selected' : ''}           value='Komet'><b>@lang('afericao.komet')</b></option>
                                <option  ${(linhaEmissor.toUpperCase() ==='FAN SPRAY') ? 'selected' : ''}       value='Fan Spray'><b>@lang('afericao.fan-spray')</b></option>
                            </select>
                            <div class="line"></div>
                        </div>
                
                        <div class="form-group col-md-2">
                            <label for="val_reg"> @lang('afericao.tipoValvula')</label>
                            <select  class='form-control' required='true' name='tipo_valvula[]'>
                                <option  ${(emissores[index] != null && emissores[index]['tipo_valvula'].toUpperCase() ==='LF') ? 'selected' : ''}  value='LF'  ><b>LF</b></option>
                                <option  ${(emissores[index] != null && emissores[index]['tipo_valvula'].toUpperCase() ==='MF') ? 'selected' : ''}   value='MF'  ><b>MF</b></option>
                                <option  ${(emissores[index] != null && emissores[index]['tipo_valvula'].toUpperCase() ==='HF') ? 'selected' : ''}   value='HF'  ><b>HF</b></option>
                                <option  ${(emissores[index] != null && emissores[index]['tipo_valvula'].toUpperCase() ==='PSR') ? 'selected' : ''}   value='PSR' ><b>PSR</b></option>
                            </select>
                            <div class="line"></div>
                        </div>
        
                        <div class="form-group col-md-2">
                            <label for="val_reg"> @lang('afericao.psi')</label>
                            <select   class='form-control' required='true' name='valvula_reguladora[]'>
                                <option   ${(emissores[index] != null && emissores[index]['psi'] ==='10') ? 'selected' : ''}   value='10'><b>10 PSI</b></option>
                                <option   ${(emissores[index] != null && emissores[index]['psi'] ==='15') ? 'selected' : ''}   value='15'><b>15 PSI</b></option>
                                <option   ${(emissores[index] != null && emissores[index]['psi'] ==='20') ? 'selected' : ''}   value='20'><b>20 PSI</b></option>
                                <option   ${(emissores[index] != null && emissores[index]['psi'] ==='25') ? 'selected' : ''}   value='25'><b>25 PSI</b></option>
                                <option   ${(emissores[index] != null && emissores[index]['psi'] ==='30') ? 'selected' : ''}   value='30'><b>30 PSI</b></option>
                                <option   ${(emissores[index] != null && emissores[index]['psi'] ==='35') ? 'selected' : ''}   value='35'><b>35 PSI</b></option>
                                <option   ${(emissores[index] != null && emissores[index]['psi'] ==='40') ? 'selected' : ''}   value='40'><b>40 PSI</b></option>
                                <option   ${(emissores[index] != null && emissores[index]['psi'] ==='45') ? 'selected' : ''}   value='45'><b>45 PSI</b></option>
                                <option   ${(emissores[index] != null && emissores[index]['psi'] ==='50') ? 'selected' : ''}   value='50'><b>50 PSI</b></option>
                            </select>
                            <div class="line"></div>
                        </div>
                    </div>
                `;
                divEmissores.append(linha);
            }
            //atualizarTipoValvulaReguladora();
            //atualizarValvulaReguladora();
        }
    }

    function atualizarValvulaReguladora(){
        var indexValvula = $("#val_reg").prop('selectedIndex');
        $('select[name="valvula_reguladora[]"]').each(function(index){
            $(this).prop('selectedIndex', indexValvula);
        });
    }

    function atualizarTipoValvulaReguladora(){
        var indexValvula = $("#tipo_valvula").prop('selectedIndex');
        $('select[name="tipo_valvula[]"]').each(function(index){
            $(this).prop('selectedIndex', indexValvula);
        });
    }

    $( document ).ready(function() {
        alterarQuantidadeDeEmissores();
    });

</script>
@endsection