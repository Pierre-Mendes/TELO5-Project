@extends('_layouts._layout_site')

@section('head')
@endsection

@section('titulo')
    @lang('cdc.centro_de_custos')
@endsection

@section('topo_detalhe')
    texto
@endsection
@section('conteudo')
    <tabela-lista
        v-bind:titulos="['#','@lang("cdc.nome")', '@lang("cdc.codigo")']"
        v-bind:itens="{{json_encode($cdcs)}}"
        ordem="desc" ordemcol="1"
        criar="{{route('centrocusto.cadastra')}}"  editar="{{route('centrocusto.editar', '')}}/" deletar="{{route('centrocusto.remover', '')}}/" token="{{ csrf_token() }}"
        modal="sim"

    ></tabela-lista>
    <div align="center" class='row'>
        {{$cdcs}}
    </div>

    
    <modal nome="adicionar" titulo="@lang('cdc.cadastrarcdc')" css='modal-sm'>
        <formulario id="formAdicionar" css="row" action="{{route('centrocusto.cadastra')}}" method="post" enctype="" token="{{ csrf_token() }}">

            <div class="form-group col-md-12">
                <input class="form-control" id="nome" name="nome" type="text" aria-describedby="" required>
                @component('_layouts._components._inputLabel', ['texto'=>__('cdc.nome'), 'id' => ''])@endcomponent                                                                                                
                
            </div>

            <div class="form-group col-md-12">
                <input class="form-control" id="codigo" name="codigo" type="number" min='0' step='1' max='9999' aria-describedby=""  required>
                @component('_layouts._components._inputLabel', ['texto'=>__('cdc.codigo'), 'id' => ''])@endcomponent                                                                                                
            </div>
                                                  
        </formulario>
        <span slot="botoes">
            <button form='formAdicionar' class="btn btn-lg btn-info btn-block text-center text-light" style="margin: 0 auto" type="submit">@lang('cdc.cadastrar')</button>
        </span>
    
      </modal>
    
      <modal nome="editar" titulo="@lang('cdc.editarcdc')" css=' modal-sm'>
      <formulario id="formEditar" v-bind:action="'{{route('centrocusto.edita')}}'" css='row' method="put" enctype="" token="{{ csrf_token() }}">
            <!--
          <div class="form-group">
            <label for="titulo">Teste</label>
            <input type="text" class="form-control" id="titulo" name="titulo" v-model="$store.state.item.titulo" placeholder="TÃ­tulo">
          </div>
            -->
            <input type="text" name='id' hidden v-model="$store.state.item.id">

            <div class="form-group col-md-12">
                <label for="nome">@lang('cdc.nome')</label>
                <input class="form-control" v-model="$store.state.item.nome" id="nome" name="nome" type="text" aria-describedby="" placeholder="@lang('cdc.nome')" required>
                <div class="line"></div>
            </div>
           
        </formulario>
        <span slot="botoes">
          <button form="formEditar" class="btn btn-info">@lang('cdc.editar')</button>
        </span>
      </modal>

    

@endsection

@section('scripts')
    @include('_layouts._includes._validators_jquery')
@endsection