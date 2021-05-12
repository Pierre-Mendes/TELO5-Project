@extends('_layouts._layout_site')
<?php 
    $afericao = session()->get('afericao')  ;
    $num_lance = session()->get('numero_lance');
    $progresso = round((($num_lance-1)/$afericao['numero_lances'])*100);
?>

@section('head')

@endsection

@section('titulo')
@lang('afericao.afericao')
@endsection

@section('conteudo')
<form action="{{route('submit_levantamento_centro_pt_2')}}" method="POST">
    @csrf

    

    <div class="row">
        <div class="col-12">
            <br>
            <div class="progress" style="height: 18px">
                <div class="progress-bar" role="progressbar" style="width: {{$progresso}}%;" aria-valuenow="{{$progresso}}" aria-valuemin="0" aria-valuemax="100">{{$progresso}}%</div>
            </div>
        </div>
        <div class="form-group col-12">
            <br>
            @if (!empty($afericao['tem_balanco']) && $num_lance == $afericao['numero_lances'])
                <h3>@lang('afericao.balanco')</h3>
            @else
                <h3>@lang('afericao.lance') {{$num_lance}}</h3>
            @endif
        </div>
        <input type="hidden" name="numero_lance" value="{{$num_lance}}">
        <input type="hidden" name="id_afericao" value="{{$afericao['id']}}">
        <input type="hidden" name="id" value="{{$lance['id']}}">
        
        

        <div class="form-group col-md-4">
            <input type="number" step=1 min=1 name="numero_tubos" id="num_tubo" required  class="form-control ">
            @component('_layouts._components._inputLabel', ['texto'=>__('afericao.numeroTubos'), 'id' => 'num_tubo'])@endcomponent                                                                        
        </div>

        <div class="form-group col-md-4">
            <input type="number" @if(empty($lance->numero_emissores)) id="numero_emissores" required @else   value="{{$lance->numero_emissores}}" readonly @endif name="numero_emissores" step=1 min=1   class="form-control ">
            @component('_layouts._components._inputLabel', ['texto'=>__('afericao.numeroEmissores'), 'id' => 'numero_emissores'])@endcomponent                                                                        
        </div>

        <div class="form-group col-md-4">
            <label for=""> @lang('afericao.diametro')</label>
            <select name="diametro"  class="form-control" required id="">
                <option value="0.127">5"</option>
                <option value="0.1413">5.9/16</option>
                <option value="0.1524">6"</option>
                <option value="0.1683">6.5/8"</option>
                <option value="0.2032">8"</option>
                <option value="0.219">8.5/8"</option>
                <option value="0.254">10"</option>
            </select>
            <div class="line"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="val_reg"> @lang('afericao.valvulaReguladora')</label>
            <select id="val_reg" class='form-control' required='true' name='valvula_reguladora'>
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

        <div class="form-group col-md-4">
            <label for="val_reg"> @lang('afericao.tipoValvula')</label>
            <select id="val_reg" class='form-control' required='true' name='tipo_valvula'>
                <option value='LF'><b>LF</b></option>
                <option value='MF'><b>MF</b></option>
                <option value='HF'><b>HF</b></option>
                <option value='PSR'><b>PSR</b></option>
            </select>
            <div class="line"></div>
        </div>

        <div class="form-group col-md-4">
            <input type="number" class="form-control " id="motorredutor" step=0.01 name="motorredutor">
            @component('_layouts._components._inputLabel', ['texto'=>__('afericao.motorredutor'), 'id' => 'motorredutor'])@endcomponent                                                                        
        </div>

        <div class="form-group col-12 text-center">
            <a class="btn btn-lg btn-outline-dark" href="{{route('status_afericao', $afericao['id'])}}" >@lang('unidadesAcoes.sair')</a>
            <a class="btn btn-lg btn-outline-dark" href="{{route('voltar_lance')}}" >@lang('unidadesAcoes.anterior')</a>
            <button class="btn btn-lg btn-primary"  name="salvar" type="" id="" >@lang('unidadesAcoes.salvar')</button>
        </div>
    </div>
 
</form>
@endsection

@section('scripts')
<script>

    $(document).ready(function() {
        $("#num_tubo").focus();
    });


    $("html").keyup(function(event){
        if(event.keyCode == 13){
            $("#submit_form").click();
        }
    });
    
</script>
@endsection