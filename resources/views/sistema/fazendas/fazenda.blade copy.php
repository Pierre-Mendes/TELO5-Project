@extends('_layouts._layout_site')
@section('head')
<style>
    .dropdown-submenu {
        position: relative;
    }
    
    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -1px;
    }
</style>
@endsection


@section('titulo')
    @lang('fazendas.fazenda')
@endsection

@section('conteudo')
<div class="col-md-12  " >
        <div class='col-12' style="margin-bottom: 10px">
            <div class='border row' style="padding: 1%">
                <input disabled  type="text" name='id' hidden v-model="$store.state.item.id">
        
                <div class="form-group col-md-4">
                        <label for="nome"><b>@lang('fazendas.nome')</b></label>
                        <input class="form-control" type="text" disabled value="{{$fazenda['nome']}}">
                    </div>
        
                    <div class="form-group col-md-2">
                        <label for="codigo">@lang('fazendas.cidade')</label>
                        <input class="form-control" type="text" disabled value="{{$fazenda['cidade']}}">
        
                    </div>  
                    <div class="form-group col-md-2">
                        <label for="codigo">@lang('fazendas.estado')</label>
                        <input class="form-control" type="text" disabled value="{{$fazenda['estado']}}">
        
                    </div>
        
                    <div class="form-group col-md-2">
                        <label for="codigo">@lang('fazendas.pais')</label>
                        <input class="form-control" type="text" disabled value="{{$fazenda['pais']}}">
        
                    </div>
        
                    <div class="form-group col-md-2">
                        <label for="codigo">@lang('fazendas.latitude') </label>
                        <input class="form-control" type="text" disabled value="{{$fazenda['latitude']}}">
        
                    </div>
        
                    <div class="form-group col-md-3">
                        <label for="codigo">@lang('fazendas.longitude')</label>
                        <input class="form-control" type="text" disabled value="{{$fazenda['longitude']}}">
        
                    </div>
        
                    <div class="form-group col-md-3">
                        <label for="codigo">@lang('fazendas.altitude')  (@lang('fazendas.em_metros'))</label>
                        <input class="form-control" type="text" disabled value="{{$fazenda['altitude']}}">
        
                    </div>
        
                    <div class="form-group col-md-3">
                        <label for="id_proprietario">@lang('fazendas.proprietario')</label>
                        <input class="form-control" type="text" disabled value="{{$fazenda['nome_proprietario']}}">
        
                    </div>
        
                    <div class="form-group col-md-3">
                        <label for="codigo">@lang('fazendas.consultor')</label>
                        <input class="form-control" type="text" disabled value="{{$fazenda['nome_consultor']}}">
        
                    </div>
            </div>
        </div>
        
        <!--
        <div class="col-md-4 container border">
            <div id="map-container-google-12" class="z-depth-1-half map-container-3">
                <iframe src="https://maps.google.com/maps?q={{$fazenda['latitude']}},{{$fazenda['longitude']}}&hl=es;z=15&amp;output=embed" frameborder="0"
                    style="border:0" allowfullscreen></iframe>
            </div>
        </div>
        -->
        <div class='col-12 border' style="overflow: auto; max-height: 300px; margin-bottom: 10px; padding: 1%">
            <h2>@lang('fazendas.assistentes')</h2>
            @can(['consultor'])
                <div class='container text-center' style="padding-bottom: 1%">
                    <modallink item="'assistente'" url="{{route('fazenda.assistentes_usuario')}}" tipo="link" nome="adicionar" icone='fa fa-fw fa-plus' css="btn btn-outline-primary"></modallink>
                </div>
            @endcan
            <div class="list-group">
                <?php $cont = 0 ?>
                @foreach ($assistentes as $assistente)
                    <?php $cont++ ?>
                    @can('consultor', Auth::user()->all())
                    <form id="assistente{{$assistente->id}}" style="display: none" method="post" action="{{route('fazenda.remover_assistente', $assistente->id)}}">
                        <input type="hidden" name="_method" value="delete">
                        {{ csrf_field() }}
                    </form>
                    @endcan
                    <span class="list-group-item list-group-item-action">{{$assistente->nome}} @can('consultor')<button form="assistente{{$assistente->id}}" class='btn  btn-danger float-right'><i class="fa fa-fw fa-trash"></i> </button> @endcan </span>
                @endforeach
                @if($cont == 0)
                    <span>@lang('fazendas.nenhum_assistente_cadastrado')</span>
                @endif
            </div>
        </div>
        <div class="col-12 border text-center" hidden style="padding: 1%">
            <h2 class="text-left">@lang('fazendas.acoes')</h2>
            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#acoes"><i class="fa fa-wrench fa-fw "></i>@lang('fazendas.acoes')</button>
        </div>
</div>
<modal nome="adicionar" titulo="@lang('fazendas.cadastrar_assistente')" css='modal-sm'>
    <formulario id="formAdicionar" css="row" action="{{route('fazenda.adicionar_assistente')}}" method="post" token="{{ csrf_token() }}" enctype="">


        <div class="form-group col-md-12">
            <label for="nome">@lang('fazendas.nome_assistente')</label>
            <select name="id_assistente" id="nome" class="form-control" required>
                
                <option  v-for="assistente in $store.state.item.assistentes" :key="assistente.id" v-bind:value="assistente.id" >@{{assistente.nome}}</option>

            </select>
        </div>
                                                
    </formulario>
    <span slot="botoes">
        <button form='formAdicionar' class="btn btn-lg btn-info btn-block text-center text-light" style="margin: 0 auto" type="submit">@lang('fazendas.cadastrar_assistente')</button>
    </span>
</modal>

<modal nome="acoes" css="md" titulo="@lang('fazendas.acoes_fazenda')">
    <div class="container">
        <div class="form-group">
            <label>@lang('fazendas.tipo_projeto')</label>
            <br>
            <select name="" onchange="trocarDivAtiva()" id="tipo_projeto" class="selectpicker">
                <option  value="0">@lang('fazendas.nenhum_selecionado')</option>
                <option  disabled value="1">@lang('fazendas.inspecao_eletrica')</option>
                <option  value="2">@lang('fazendas.afericao_redimensionamento')</option>
                <option  disabled value="3">@lang('fazendas.projeto_irrigacao')</option>
                <option  disabled  value="4">@lang('fazendas.projeto_bombeamento')</option>
                <option  disabled value="5">@lang('fazendas.barragem')</option>
                <option  disabled value="6">@lang('fazendas.viabilidade')</option>
                <option  disabled value="7">@lang('fazendas.analise_solo')</option>
                <option  disabled value="8">@lang('fazendas.simulacao_lamina')</option>
                <option  disabled value="9">@lang('fazendas.canal')</option>
                <option  disabled value="10">@lang('fazendas.inversor_frequencia')</option>
            </select>
        </div>

        <div class="form-group" id="opc2"  style="display: none">
            <label>@lang('fazendas.tipo_equipamento')</label>
            <br>
            <select name="" id="" class="selectpicker">
                <option  value="0">@lang('fazendas.pivo_central')</option>
                <option  disabled value="1">@lang('fazendas.pivo_rebocavel')</option>
                <option  disabled value="2">@lang('fazendas.linear')</option>
                <option  disabled value="3">@lang('fazendas.aspersao')</option>
                <option  disabled value="4">@lang('fazendas.gotejamento')</option>
            </select>
        </div>

        <div class="form-group text-center">
            <a href="#" id="btn_ir" class="btn btn-outline-primary"><i class="fa fa-external-link fa-fw"></i>@lang('fazendas.ir')</a>
        </div>
    </div>
</modal>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('.dropdown-submenu a.test').on("click", function(e){
        $(this).next('ul').toggle();
        e.stopPropagation();
        e.preventDefault();
        });
    });

    function trocarDivAtiva(){
        let selecionado = parseInt( $("#tipo_projeto").val());
        switch (selecionado) {
            case 0:
                $("#opc2").hide();
                $("#btn_ir").removeAttr('href');
                break;
            case 2:
                $("#btn_ir").attr('href', "{{route('cadastrar_levantamento_centro_pt_1')}}");
                $("#opc2").show();
                break;
            default:
                console.log("teste");
                break;
        }
    }
</script>
@endsection