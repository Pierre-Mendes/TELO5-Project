@extends('_layouts._layout_site')


@section('head')
<style>
    .bg-irr-claro{
        background-color: #1782b6;
        color: white;
    }

    .bg-irr-escuro{
        background-color: #013856;
        color: white;
    }

    .ocupar-100{
        width: 100%;
    }
    .form-group{
        margin-bottom: 0px !important;
    }

    .img-pointer{
        cursor: pointer;
    }


    
</style>
@endsection

@section('titulo')
    @lang('redimensionamento.redimensionamento', ['fazenda' => session()->get('fazenda')['nome']])
@endsection

@section('conteudo')



<form action="{{route('atualizaRedimensionamento')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="_method" value="put" />
    <input type="hidden" name="id_redimensionamento" value="{{$redimensionamento[0]['id_afericao']}}">
    <input type="hidden" name="id_adutora" value="{{$redimensionamento[0]['id_adutora']}}">
    <input type="hidden" value="0" name="editar_emissores" id="editar_emissores">
    <input type="hidden" value="" name="excluir_imagens" id="excluir_imagens">

    <div class="justify-content-center" id="accordion">
        <div class="col-12">
            <hr>
                <h4 class="text-center">  <a href="" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapseOne">1ª @lang('redimensionamento.etapa')</a>  </h4>
            <hr>
        </div>
        <div id="collapse1" class="row justify-content-center collapse show" aria-labelledby="heading1" data-parent="#accordion"><!-- -->
            <div class="col-md-6 row">
                <p class="col-3 text-center text-light"> <i class="fa fa-fw"></i> </p>
                <p class="col-4  text-center">@lang('redimensionamento.redim')</p>
                <p class="col-4  text-center">@lang('redimensionamento.afericao')</p>
                <div class="row ocupar-100">
                    <div class='col-4 text-center row my-auto'>
                        <small class="text-left col ">@lang('redimensionamento.vazaoFinal')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input type="number" step="0.01" name="vazao" class="text-center col form-control"  value="{{ number_format($redimensionamento[0]->vazao_sistema, 2)}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input class="text-center col form-control" disabled  type="text" value="{{ number_format($afericao[0]->somatorio_vazao_ok, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>



                <div class="row ocupar-100">
                    <div class='col-4 text-center row my-auto'>
                            <small class="text-left col ">@lang('redimensionamento.pressaoBomba')@lang('unidadesAcoes.(mca)')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input type="number" step="0.01" name="pressao_bomba" class="text-center col form-control"value="{{ number_format($redimensionamento[0]->pressao_na_bomba, 2)}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input class="text-center col form-control" disabled  type="text" value="{{ number_format($afericao[0]->pressao_na_bomba, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>

                
                <div class="row  ocupar-100">
                    <div class='col-4 text-center row my-auto'>
                            <small class="text-left col ">@lang('redimensionamento.giroEquipamento')@lang('unidadesAcoes.(graus)')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input type="number" step="1" max="360" min="0" name="giro_equipamento" class="text-center col form-control" value="{{ $redimensionamento[0]->angulo_pivo}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input class="text-center col form-control" disabled  type="text" value="{{ number_format($afericao[0]->angulo_pivo, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>

                <div class="row ocupar-100">
                    <div class='col-4 text-center row my-auto'>
                            <small class="text-left col ">@lang('redimensionamento.coeficienteRugosidadeA')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input type="number" name="rugosidade_adutora" class="text-center col form-control" value="{{ number_format($redimensionamento[0]->rugosidade_adutora, 2)}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input class="text-center col form-control" disabled  type="text" value="{{ number_format($afericao[0]->rugosidade_adutora, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>

                
                <div class="row ocupar-100">
                    <div class='col-4 text-center row my-auto'>
                            <small class="text-left col ">@lang('redimensionamento.valvula')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <select  onchange="editarEmissores()" class='form-control' required='true' id="valv_reguladoras" name='valv_reguladoras'>
                            <option @if($redimensionamento[0]->valvula_reguladora == 10) selected @endif value='10'><b>10 PSI</b></option>
                            <option @if($redimensionamento[0]->valvula_reguladora == 15) selected @endif value='15'><b>15 PSI</b></option>
                            <option @if($redimensionamento[0]->valvula_reguladora == 20) selected @endif  value='20'><b>20 PSI</b></option>
                            <option @if($redimensionamento[0]->valvula_reguladora == 25) selected @endif  value='25'><b>25 PSI</b></option>
                            <option @if($redimensionamento[0]->valvula_reguladora == 30) selected @endif value='30'><b>30 PSI</b></option>
                            <option @if($redimensionamento[0]->valvula_reguladora == 35) selected @endif  value='35'><b>35 PSI</b></option>
                            <option @if($redimensionamento[0]->valvula_reguladora == 40) selected @endif value='40'><b>40 PSI</b></option>
                            <option @if($redimensionamento[0]->valvula_reguladora == 45) selected @endif  value='45'><b>45 PSI</b></option>
                            <option @if($redimensionamento[0]->valvula_reguladora == 50) selected @endif  value='50'><b>50 PSI</b></option>
                        </select>
                        <div class="line"></div>    
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <select class='form-control text-center' required='true' disabled >
                            <option @if($afericao[0]->valvula_reguladora == 10) selected @endif value='10'><b>10 PSI</b></option>
                            <option @if($afericao[0]->valvula_reguladora == 15) selected @endif value='15'><b>15 PSI</b></option>
                            <option @if($afericao[0]->valvula_reguladora == 20) selected @endif  value='20'><b>20 PSI</b></option>
                            <option @if($afericao[0]->valvula_reguladora == 25) selected @endif  value='25'><b>25 PSI</b></option>
                            <option @if($afericao[0]->valvula_reguladora == 30) selected @endif value='30'><b>30 PSI</b></option>
                            <option @if($afericao[0]->valvula_reguladora == 35) selected @endif  value='35'><b>35 PSI</b></option>
                            <option @if($afericao[0]->valvula_reguladora == 40) selected @endif value='40'><b>40 PSI</b></option>
                            <option @if($afericao[0]->valvula_reguladora == 45) selected @endif  value='45'><b>45 PSI</b></option>
                            <option @if($afericao[0]->valvula_reguladora == 50) selected @endif  value='50'><b>50 PSI</b></option>
                        </select>
                        <div class="line"></div>
                    </div>
                </div>

                <div class="row ocupar-100">
                    <div class='col-4 text-center row my-auto'>
                            <small class="text-left col ">@lang('redimensionamento.emissores')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <select class='form-control' onchange="editarEmissores()" name='marca_modelo_emissores'>
                            <option @if($redimensionamento[0]->modelo_emissores == 'I-WOB UP3') selected @endif value='I-WOB UP3'>@lang('afericao.i-wob-up3')</option>
                            <option @if($redimensionamento[0]->modelo_emissores == 'Fabrimar') selected @endif  value='Fabrimar'><b>@lang('afericao.fabrimar')</b></option>
                            <option @if($redimensionamento[0]->modelo_emissores == 'Nelson') selected @endif  value='Nelson'><b>@lang('afericao.nelson')</b></option>
                            <option @if($redimensionamento[0]->modelo_emissores == 'Super Spray - UP3') selected @endif  value='Super Spray - UP3'><b>@lang('afericao.super-spray-up3')</b></option>
                            <option @if($redimensionamento[0]->modelo_emissores == 'Super Spray') selected @endif  value='Super Spray'><b>@lang('afericao.super-spray')</b></option>
                            <option @if($redimensionamento[0]->modelo_emissores == 'I-WOB') selected @endif  value='I-WOB'><b>@lang('afericao.i-wob')</b></option>
                            <option @if($redimensionamento[0]->modelo_emissores == 'Trash Buster') selected @endif  value='Trash Buster'><b>@lang('afericao.trash-buster')</b></option>
                            <option @if($redimensionamento[0]->modelo_emissores == 'Komet') selected @endif  value='Komet'><b>@lang('afericao.komet')</b></option>
                            <option @if($redimensionamento[0]->modelo_emissores == 'Fan Spray') selected @endif  value='Fan Spray'><b>@lang('afericao.fan-spray')</b></option>
                        </select>
                        <div class="line"></div>
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <select class='form-control' disabled >
                            <option @if($afericao[0]->modelo_emissores == 'I-WOB UP3') selected @endif value='I-WOB UP3'>@lang('afericao.i-wob-up3')</option>
                            <option @if($afericao[0]->modelo_emissores == 'Fabrimar') selected @endif  value='Fabrimar'><b>@lang('afericao.fabrimar')</b></option>
                            <option @if($afericao[0]->modelo_emissores == 'Nelson') selected @endif  value='Nelson'><b>@lang('afericao.nelson')</b></option>
                            <option @if($afericao[0]->modelo_emissores == 'Super Spray - UP3') selected @endif  value='Super Spray - UP3'><b>@lang('afericao.super-spray-up3')</b></option>
                            <option @if($afericao[0]->modelo_emissores == 'Super Spray') selected @endif  value='Super Spray'><b>@lang('afericao.super-spray')</b></option>
                            <option @if($afericao[0]->modelo_emissores == 'I-WOB') selected @endif  value='I-WOB'><b>@lang('afericao.i-wob')</b></option>
                            <option @if($afericao[0]->modelo_emissores == 'Trash Buster') selected @endif  value='Trash Buster'><b>@lang('afericao.trash-buster')</b></option>
                            <option @if($afericao[0]->modelo_emissores == 'Komet') selected @endif  value='Komet'><b>@lang('afericao.komet')</b></option>
                            <option @if($afericao[0]->modelo_emissores == 'Fan Spray') selected @endif  value='Fan Spray'><b>@lang('afericao.fan-spray')</b></option>
                        </select>
                        <div class="line"></div>
                    </div>
                </div>

                <div class="row ocupar-100">
                    <div class='col-4 text-center row my-auto'>
                        <small class="text-left col ">@lang('redimensionamento.alcanceCanhao')@lang('unidadesAcoes.(m)')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input class="text-center col form-control" name="alcance_canhao_final" type="text" value="{{ number_format($redimensionamento[0]->alcance_canhao_final, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input class="text-center col form-control" disabled  type="text" value="{{ number_format($afericao[0]->alcance_canhao_final, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>

            </div>
            <div class="col-md-6 row">
                <p class="col-3"><i class='fa fa-fw'></i></p>
                <p class="col-4  text-center">@lang('redimensionamento.redim')</p>
                <p class="col-4  text-center">@lang('redimensionamento.afericao')</p>
                <div class="row ocupar-100">
                    <div class='col-4 text-center row my-auto'>
                            <small class="text-left col ">@lang('redimensionamento.coeficienteRugosidadeP')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input type="number" name="rugosidade_pivo" class="text-center col form-control" value="{{ number_format($redimensionamento[0]->coeficiente_rugosidade, 2)}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input class="text-center col form-control" disabled  type="text" value="{{ number_format($afericao[0]->coeficiente_rugosidade, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>
                
                <div class="row ocupar-100">
                    <div class='col-4 text-center row my-auto'>
                            <small class="text-left col ">@lang('redimensionamento.laminaAnual')@lang('unidadesAcoes.(mm/ha/ano)')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input type="number" step="0.01" name="lamina_anual" class="text-center col form-control" value="{{ number_format($redimensionamento[0]->lamina_anual, 2)}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input class="text-center col form-control" disabled  type="text" value="{{ number_format($afericao[0]->lamina_anual, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>

                <div class="row ocupar-100">
                    <div class='col-4 text-center row my-auto'>
                        <small class="text-left col">@lang('redimensionamento.custoMedio')@lang('unidadesAcoes.($/kWh)')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input type="number" step="0.01" name="custo_medio" class="text-center col form-control" value="{{ number_format($redimensionamento[0]->custo_medio, 2)}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input class="text-center col form-control" disabled  type="text" value="{{ number_format($afericao[0]->custo_medio, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>

                <div class="row ocupar-100">
                    <div class='col-4 text-center row my-auto'>
                            <small class="text-left col ">@lang('redimensionamento.defletor')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input name="defletor" class="text-center col form-control" type="text" value="{{ $redimensionamento[0]->defletor}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input class="text-center col form-control" disabled  type="text" value="{{ $afericao[0]->defletor}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>

                <div class="row ocupar-100">
                    <div class='col-4 text-center row my-auto'>
                            <small class="text-left col ">@lang('redimensionamento.valvReg')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <select class='form-control' onchange="editarEmissores()" name="tipo_valvula"  >
                            <option @if($redimensionamento[1][0]['valvulas_reguladoras_tipo'] == 'LF') selected @endif value='LF'><b>LF</b></option>
                            <option @if($redimensionamento[1][0]['valvulas_reguladoras_tipo'] == 'MF') selected @endif  value='MF'><b>MF</b></option>
                            <option @if($redimensionamento[1][0]['valvulas_reguladoras_tipo'] == 'HF') selected @endif  value='HF'><b>HF</b></option>
                            <option @if($redimensionamento[1][0]['valvulas_reguladoras_tipo'] == 'PSR') selected @endif  value='PSR'><b>PSR</b></option>
                        </select>
                        <div class="line"></div>
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <select class='form-control' disabled >
                            <option @if($afericao[1][0]['valvulas_reguladoras_tipo'] == 'LF') selected @endif value='LF'><b>LF</b></option>
                            <option @if($afericao[1][0]['valvulas_reguladoras_tipo'] == 'MF') selected @endif  value='MF'><b>MF</b></option>
                            <option @if($afericao[1][0]['valvulas_reguladoras_tipo'] == 'HF') selected @endif  value='HF'><b>HF</b></option>
                            <option @if($afericao[1][0]['valvulas_reguladoras_tipo'] == 'PSR') selected @endif  value='PSR'><b>PSR</b></option>
                        </select>
                        <div class="line"></div>
                    </div>
                </div>

                <div class="row ocupar-100">
                    <div class='col-4 text-center row my-auto'>
                            <small class="text-left col ">@lang('redimensionamento.vazaoCanhao')@lang('unidadesAcoes.(m3/h)')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input class="text-center col form-control" name="vazao_canhao_final" type="text" value="{{ number_format($redimensionamento[0]->vazao_canhao_final, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input class="text-center col form-control" disabled  type="text" value="{{ number_format($afericao[0]->vazao_canhao_final, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>

            </div>

            <div class="col-md-12 row justify-content-center" >
            
                <div class="row col-md-3">
                    <div class='col-12 text-center form-group' style="padding-left: 5px">
                        <small class="text-left col-4 ">@lang('redimensionamento.utilizarPlug')</small> 
                        <select disabled name="utilizar_plug" id="utilizar_plug" class="form-control">
                            <option value="sim">@lang('fichaTecnica.sim')</option>
                            <option value="nao">@lang('fichaTecnica.nao')</option>
                        </select>
                        <div class="line"></div>
                    </div>
                </div>
    
                <div class="row col-md-3">
                    <div class='col-12 text-center form-group'>
                    </div>
                    <div class='col-12 text-center form-group' style="padding-left: 5px">
                        <small class=" col-4 ">@lang('redimensionamento.utilizarPressaoCentro')</small> 
                        <select disabled name="utilizar_pressao_centro" id="utilizar_pressao_centro" class="form-control">
                            <option value="sim">@lang('fichaTecnica.sim')</option>
                            <option value="nao">@lang('fichaTecnica.nao')</option>
                        </select>
                        <div class="line"></div>
                    </div>
                </div>
    
                <div class="row col-md-2">
                    <div class='col-12 text-center form-control'>
                    </div>
    
                    <div class='col-12 text-center form-group' style="padding-left: 5px">
                        <small class=" col-4 ">@lang('redimensionamento.utilizarPlugAteTorre')</small> 
                            
                        <input class="text-center col form-control" name="lances_c_plug" type="number" value="{{$redimensionamento[0]->lances_c_plug}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>
    
                <div class="row col-md-2">
                    <div class='col-12 text-center form-group'>
                    </div>
    
                    <div class='col-12 text-center form-group' style="padding-left: 5px">
                    <small class=" col-4 ">@lang('redimensionamento.espacamentoMaximoPlug')</small> 
                        
                        <input class="text-center col form-control" name="espacamento_maximo_plug" type="number" value="{{$redimensionamento[0]->espacamento_maximo_plug}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>
    
                <div class="row col-md-2">
                    <div class='col-12 text-center form-group'>
                    </div>
    
                    <div class='col-12 text-center form-group' style="padding-left: 5px">
                    <small class=" col-4 ">@lang('redimensionamento.emissoresComPlugInicio')</small> 
                        
                        <input class="text-center col form-control" type="number" name="num_emissores_c_plug_inicio" value="{{$redimensionamento[0]->num_emissores_c_plug_inicio}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>
            </div>
            <div class="row col-12">
                <div class="col-12  text-light text-center" style="padding-top: 1%">
                    <button class="btn btn-outline-primary" type="submit" > <i class="fa fa-calculator fa-fw"></i> @lang('redimensionamento.calcularNovamente')</button>
                </div>
            </div>
        </div> <!-- -->

        
        <div class="col-12">
            <hr>
                <h4 class="text-center">  <a href="" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapseTwo">2ª @lang('redimensionamento.etapa')</a>  </h4>
            <hr>
        </div>


        <div id="collapse2" class="row justify-content-center collapse" aria-labelledby="heading2" data-parent="#accordion"><!-- -->

            <div class="col-md-6 row">
                <p class="col-3"><i class='fa fa-fw'></i></p>
                <p class="col-4  text-center">@lang('redimensionamento.redim')</p>
                <p class="col-4  text-center">@lang('redimensionamento.afericao')</p>

                <div class="row  ocupar-100">
                    <div class='col-4 text-center row  my-auto'>
                        <small class="text-left col">@lang('redimensionamento.pressaoRequerida') 5.4.2 @lang('unidadesAcoes.(mca)')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input readonly class="text-center col form-control" type="text" value="{{ number_format($redimensionamento[0]->pressao_5_4_2, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input class="text-center col form-control" disabled  type="text" value="{{ number_format($redimensionamento[0]->pressao_5_4_2, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>

                <div class="row  ocupar-100">
                    <div class='col-4 text-center row my-auto'>
                            <small class="text-left col ">@lang('redimensionamento.hfAdutora')@lang('unidadesAcoes.(mca)')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input readonly class="text-center col form-control" type="text" value="{{ number_format($redimensionamento[0]->hf_adutora, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input class="text-center col form-control" disabled  type="text" value="{{ number_format($afericao[0]->hf_adutora, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>

                <div class="row  ocupar-100">
                    <div class='col-4 text-center row my-auto'>
                            <small class="text-left col ">@lang('redimensionamento.desnivelMotobomba')@lang('unidadesAcoes.(m)')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input  readonly class="text-center col form-control" type="text" value="{{ number_format($redimensionamento[0]->desnivel_motobomba, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input class="text-center col form-control" disabled  type="text" value="{{ number_format($afericao[0]->desnivel_motobomba, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>

                <div class="row  ocupar-100">
                    <div class='col-4 text-center row my-auto'>
                            <small class="text-left col ">@lang('redimensionamento.pressaoCentro')@lang('unidadesAcoes.(mca)')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input readonly class="text-center col form-control" type="text" value="{{ number_format($redimensionamento[0]->pressao_centro, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input class="text-center col form-control" disabled  type="text" value="{{ number_format($afericao[0]->pressao_centro, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>

                <div class="row ocupar-100">
                    <div class='col-4 text-center row my-auto'>
                        <small class="text-left col ">@lang('redimensionamento.hfParteAerea')@lang('unidadesAcoes.(mca)')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input readonly class="text-center col form-control" type="text" value="{{ number_format($redimensionamento[0]->somatorio_perda_carga_real * 1.1, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input class="text-center col form-control" disabled  type="text" value="{{ number_format($afericao[0]->somatorio_perda_carga_real * 1.1, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>
                <hr>
                <div class="row ocupar-100">
                    <div class='col-4 text-center row my-auto'>
                            <small class="text-left col ">@lang('redimensionamento.desnivelMaisAlto')@lang('unidadesAcoes.(m)')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input readonly class="text-center col form-control" type="text" value="{{ number_format($redimensionamento[0]->desnivel_total, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input class="text-center col form-control" disabled  type="text" value="{{ number_format($afericao[0]->desnivel_total, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>
                <div class="row ocupar-100">
                    <div class='col-4 text-center row my-auto'>
                            <small class="text-left col ">@lang('redimensionamento.areaTotal')@lang('unidadesAcoes.(ha)')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input readonly class="text-center col form-control" type="text" value="{{ number_format($redimensionamento[0]->area_total_com_canhao, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input class="text-center col form-control" disabled  type="text" value="{{ number_format($afericao[0]->area_total_com_canhao, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>


                <div class="row ocupar-100">
                    <div class='col-4 text-center row my-auto'>
                            <small class="text-left col ">@lang('redimensionamento.velocidade100')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input readonly class="text-center col form-control" type="text" value="{{ number_format($redimensionamento[0]->tempo_a_100, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input class="text-center col form-control" disabled  type="text" value="{{ number_format($afericao[0]->tempo_a_100, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>

            </div>

            <div class="col-md-6 row">
                <p class="col-3"><i class='fa fa-fw'></i></p>
                <p class="col-4  text-center">@lang('redimensionamento.redim')</p>
                <p class="col-4  text-center">@lang('redimensionamento.afericao')</p>


                <div class="row ocupar-100">
                    <div class='col-4 text-center row my-auto'>
                            <small class="text-left col ">@lang('redimensionamento.areaSemCanhao')@lang('unidadesAcoes.(ha)')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input readonly class="text-center col form-control" type="text" value="{{ number_format($redimensionamento[0]->area_total, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input class="text-center col form-control" disabled  type="text" value="{{ number_format($afericao[0]->area_total, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>

                <div class="row ocupar-100">
                    <div class='col-4 text-center row my-auto'>
                            <small class="text-left col ">@lang('redimensionamento.lamina')@lang('unidadesAcoes.(mm)')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input readonly class="text-center col form-control" type="text" value="{{ number_format($redimensionamento[0]->lamina, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input class="text-center col form-control" disabled  type="text" value="{{ number_format($afericao[0]->lamina, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>

                <div class="row ocupar-100">
                    <div class='col-4 text-center row my-auto'>
                            <small class="text-left col ">@lang('redimensionamento.tempoFuncionamento')@lang('unidadesAcoes.(h)')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input readonly class="text-center col form-control" type="text" value="{{ number_format($redimensionamento[0]->tempo, 0, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input class="text-center col form-control" disabled  type="text" value="{{ number_format($afericao[0]->tempo, 0, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>

                <div class="row ocupar-100">
                    <div class='col-4 text-center row my-auto'>
                            <small class="text-left col">@lang('redimensionamento.pressaoRequerida')@lang('unidadesAcoes.(mca)')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input readonly class="text-center col form-control" type="text" value="{{ number_format($redimensionamento[0]->pressao_requerida, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input class="text-center col form-control" disabled  type="text" value="{{ number_format($redimensionamento[0]->pressao_requerida, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>

                <div class="row ocupar-100">
                    <div class='col-4 text-center row my-auto'>
                            <small class="text-left col ">@lang('redimensionamento.pressaoPontaCalculada')@lang('unidadesAcoes.(mca)')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input readonly class="text-center col form-control" type="text" value="{{ number_format($redimensionamento[0]->pressao_ponta, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input class="text-center col form-control" disabled  type="text" value="{{ number_format($afericao[0]->pressao_ponta, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>
                
                <div class="row ocupar-100">
                    <div class='col-4 text-center row'>
                        <small class="text-left col ">@lang('redimensionamento.pressaoPontaRequerida')@lang('unidadesAcoes.(mca)')</small> 
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input readonly class="text-center col form-control" type="text" value="{{ number_format($redimensionamento[0]->pressao_ponta_requerida, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                    <div class='col-4 text-center form-group' style="padding-left: 5px">
                        <input class="text-center col form-control" disabled  type="text" value="{{ number_format($afericao[0]->pressao_ponta_requerida, 2, ',', '.')}}">
                        @component('_layouts._components._inputLabel', ['texto'=>'' , 'id' => ''])@endcomponent
                    </div>
                </div>
              
            </div>
        </div>
        <div class="ocupar-100">
            <div class=" col-12">
                <hr>
                    <h4 class="text-center">@lang('redimensionamento.curvasDeBomba')  </h4>
                <hr>
            </div>
            <div class="row justify-content-center" id="grid_images">
                @foreach ($imagens as $key => $imagem)
                    <div style="display: grid">
                        <img data-toggle="modal" data-target="#modalImagens" data-image-name="{{$imagem->getFileName()}}" id="imagem-{{$key}}" data-whatever="{{url('storage/projetos/redimensionamento/'.$redimensionamento[0]['id_afericao'] .'/'.$imagem->getFileName()) }}" src="{{url('storage/projetos/redimensionamento/'.$redimensionamento[0]['id_afericao'] .'/'.$imagem->getFileName())}}" class="img-thumbnail img-pointer" style="width: 100px; height: 100px" alt="" >
                        <button class="btn btn-outline-danger btn-remover-imagem" onclick="excluirImagem({{$key}})" id="btn-remover-imagem-{{$key}}"  data-whatever="{{$key}}" type="button"> <i class="fa fa-trash"> </i> </button>
                    </div> 
                @endforeach
            </div>
            <div class="row justify-content-center">                
                <span class=""><i>@lang('redimensionamento.cliqueNaImagemParaExpandir')</i></span>
            </div>
            <div class="form-group">
                <div class="form-control text-center">
                    <input type="file" accept=".jpg" id="imagens_curvas_bomba" multiple class="file-input"  name="images[]">
                </div>
            </div>
        </div>
        <div class="row col-12">
            <div class="col-12  text-light text-center" style="padding-top: 1%">
                <a class="btn btn-outline-success" href="{{route('status_redimensionamento', $redimensionamento[0]['id_afericao'] )}}" > <i class="fa fa-check fa-fw"></i> @lang('unidadesAcoes.sair')</a>
            </div>
        </div>
    </div>
</form>
<hr>

<div class="modal fade" id="modalImagens" tabindex="-1" role="dialog" aria-labelledby="modalImagensLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-irr-escuro">
                <h5 class="modal-title" ><b> @lang('redimensionamento.curvasDeBomba') </b></h5>
                <button type="button" class="btn btn-danger close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="img_modal" src="" alt="" class="img img-thumbnail w-100">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('unidadesAcoes.fechar')</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    function editarEmissores(){
        $("#editar_emissores").val("1");
    }

    $('#modalImagens').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('#img_modal').attr('src', recipient);
    })
</script>



<script type="text/javascript">
var uploadField = document.getElementById("imagens_curvas_bomba");

uploadField.onchange = function() {
    for (var i = 0; i < this.files.length; i++)
    {
        element = this.files[i];
        if(element.size > 1000000){
            alert("@lang('redimensionamento.tamanhoMaximo')");
            this.value = "";
        };
    }
    addUploadedImagesToGallery(this);
};

function addUploadedImagesToGallery(input){
    var countFiles = $(input)[0].files.length;
    $( ".adicionada" ).each(function( index ) {
        $( this ).remove();
    });
    if(countFiles > 0){
        var imgPath = $(input)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        var image_holder = $("#grid_images");

        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof (FileReader) != "undefined") {
                
                for (var i = 0; i < countFiles; i++) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<img />", {
                            "src": e.target.result,
                            "class": "img-thumbnail adicionada img-pointer",
                            'height': '100',
                            'width': '100',
                            'data-target': "#modalImagens",
                            'data-whatever': e.target.result,
                            'data-toggle':"modal"
                        }).appendTo(image_holder);
                    }

                    //image_holder.show();
                    reader.readAsDataURL($(input)[0].files[i]);
                }

            } else {
                alert("This browser does not support FileReader.");
            }
        } else {
            alert("Pls select only images");
        }
    }else{
        var image_holder = $("#grid_images");
        var count = $("#grid_images img").length;
        if(count == 0){
            $("<img />", {
                "src": "{{asset('img/symbols/upload_img.png')}}",
                "class": "img-thumbnail adicionada",
                'height': '100',
                'width': '100'
            }).appendTo(image_holder);
        }
    }
}

function excluirImagem(imageIndex){
    var deletedImage = $('#imagem-' + imageIndex);
    var inputImagens = $("#excluir_imagens");
    inputImagens.val( inputImagens.val() + deletedImage.data('image-name') + ',' );
    deletedImage.remove();
    $("#btn-remover-imagem-" + imageIndex).remove();

}
</script>
@endsection