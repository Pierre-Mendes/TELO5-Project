@extends('_layouts._layout_site')

@section('titulo')
    @lang('fazendas.fazendas')
@endsection

@section('conteudo')
    <filtro titulo="@lang('usuarios.filtrar')" @if(!empty($filtro['filtro'])) show=" show" @endif action="#" txt_buscar="@lang('usuarios.buscar')">
            <div class="col-md-5 form-group">
                <input
                    class="form-control"
                    id="name_busca"
                    name="nome"
                    type="text"
                    value="@if(!empty($filtro['nome'])) {{$filtro['nome']}} @endif"
                    aria-describedby
                    
                />
                @component('_layouts._components._inputLabel', ['texto'=>__('fazendas.nome'), 'id' => ''])@endcomponent                                                                                                

            </div>
            <div class="col-md-5 form-group">
                <input
                    class="form-control"
                    id="nome_proprietario_busca"
                    name="proprietario"
                    type="text"
                    value="@if(!empty($filtro['proprietario'])) {{$filtro['proprietario']}} @endif"
                    aria-describedby
                />
                @component('_layouts._components._inputLabel', ['texto'=>__('fazendas.proprietario'), 'id' => ''])@endcomponent                                                                                                
                
            </div>
            <div class="col-md-2">
                <label for="status_busca">@lang('fazendas.status')</label>
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" for="checkAtivo" type="checkbox" @if(isset($filtro['ativo'])) checked @endif value="ativo" id="checkAtivo" name="ativo">
                    <label
                    class="custom-control-label"
                    for="checkAtivo"
                    >@lang('fazendas.ativa')</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" value="inativo" @if(isset($filtro['inativo'])) checked @endif id="checkInativo" name="inativo">
                    <label
                    class="custom-control-label"
                    for="checkInativo"
                    >@lang('fazendas.inativa')</label>
                </div>
            </div>

    </filtro>
    <tabela-lista
        v-bind:titulos="['#','@lang("fazendas.nome")', '@lang("fazendas.cidade")', '@lang("fazendas.estado")', '@lang("fazendas.pais")', '@lang("fazendas.proprietario")', '@lang("fazendas.status")']"
        v-bind:itens="{{json_encode($fazendas)}}"
        ordem="desc" ordemcol="1"
criar="{{route('fazenda.cadastra')}}"  editar="{{route('fazenda.ver', '')}}/" deletar="{{route('fazenda.remover', '')}}/" token="{{ csrf_token() }}"
        modal="sim"

    ></tabela-lista>
    <div align="center" class='row'>

        @if(isset($filtro['filtro']))
            {{$fazendas->appends([
                'filtro' => 'filtrar',
                'proprietario' => $filtro['proprietario'] ?? '',
                'nome' => $filtro['nome'] ?? ''
            ])}}
        @else
            {{$fazendas}}
        @endif
    </div>

    
    <modal nome="adicionar" titulo="@lang('fazendas.cadastrar')" css=''>
        <formulario id="formAdicionar" css="row" action="{{route('fazenda.cadastra')}}" method="post" enctype="" token="{{ csrf_token() }}">


            <div class="form-group col-md-12">
                <input class="form-control" id="nome" name="nome" type="text" aria-describedby=""  required>
                @component('_layouts._components._inputLabel', ['texto'=>__('fazendas.nome'), 'id' => ''])@endcomponent                                                                                                

            </div>

            <div class="form-group col-md-4">
                <input class="form-control" id="cidade" name="cidade" type="text"   required>
                @component('_layouts._components._inputLabel', ['texto'=>__('fazendas.cidade'), 'id' => ''])@endcomponent                                                                                                

            </div>  

            <div class="form-group col-md-4">
                <input class="form-control" id="estado" name="estado" type="text"   required>
                @component('_layouts._components._inputLabel', ['texto'=>__('fazendas.estado'), 'id' => ''])@endcomponent                                                                                                

            </div>

            <div class="form-group col-md-4">
                <input class="form-control" id="pais" name="pais" type="text" required>
                @component('_layouts._components._inputLabel', ['texto'=>__('fazendas.pais'), 'id' => ''])@endcomponent                                                                                                

            </div>

            <div class="form-group col-md-4">
                <input class="form-control" id="latitude" name="latitude" type="number" min='-85' step='0.0001' max='85' aria-describedby="" required>
                @component('_layouts._components._inputLabel', ['texto'=>__('fazendas.latitude'), 'id' => ''])@endcomponent                                                                                                
            </div>

            <div class="form-group col-md-4">
                <input class="form-control" id="longitude" name="longitude" type="number" min='-180' step='0.0001' max='180' aria-describedby="" required>
                @component('_layouts._components._inputLabel', ['texto'=>__('fazendas.longitude'), 'id' => ''])@endcomponent                                                                                                
            </div>

            <div class="form-group col-md-4">
                <input class="form-control" id="altitude" name="altitude" type="number" min='-1000' step='0.01' max='8848' aria-describedby=""  required>
                @component('_layouts._components._inputLabel', ['texto'=>__('fazendas.altitude'), 'id' => ''])@endcomponent                                                                                                
            </div>

            <div class="form-group col-md-4">
                <label for="id_proprietario">@lang('fazendas.proprietario')</label>
                <select name="id_proprietario" id="" class='form-control' >
                    
                    @foreach ($proprietarios as $proprietario)
                        <option value="{{$proprietario->id}}">{{$proprietario->nome}}</option>
                    @endforeach

                </select>
                <div class="line"></div>
            </div>

            <div class="form-group col-md-4">
                <label for="codigo">@lang('fazendas.consultor')</label>
                <select name="id_consultor" class='form-control' id="">
                    @foreach ($consultores as $consultor)
                        <option value="{{$consultor->id}}">{{$consultor->nome}}</option>
                    @endforeach
                </select>
                <div class="line"></div>

            </div>

                                                  
        </formulario>
        <span slot="botoes">
            <button form='formAdicionar' class="btn btn-lg btn-info btn-block text-center text-light" style="margin: 0 auto" type="submit">@lang('fazendas.cadastrar')</button>
        </span>
    
      </modal>
    
      <modal nome="editar" titulo="@lang('fazendas.editar')" css=''>
      <formulario id="formEditar" v-bind:action="'{{route('fazenda.edita')}}'" css='row' method="put" enctype="" token="{{ csrf_token() }}">
            <!--
          <div class="form-group">
            <label for="titulo">Teste</label>
            <input type="text" class="form-control" id="titulo" name="titulo" v-model="$store.state.item.titulo" placeholder="TÃ­tulo">
          </div>
            -->
            <input type="text" name='id' hidden v-model="$store.state.item.id">

            <div class="form-group col-md-12">
                    <label for="nome">@lang('fazendas.nome')</label>
                    <input class="form-control" id="nome"  v-model="$store.state.item.nome"  name="nome" type="text" aria-describedby="" placeholder="@lang('fazendas.nome')" required>
                    @component('_layouts._components._inputLabel', ['texto'=>'', 'id' => ''])@endcomponent                                                                                                
                </div>
    
                <div class="form-group col-md-4">
                    <label for="codigo">@lang('fazendas.cidade')</label>
                    <input class="form-control" id="cidade"   v-model="$store.state.item.cidade"  name="cidade" type="text"  placeholder="@lang('fazendas.cidade')" required>
                    @component('_layouts._components._inputLabel', ['texto'=>'', 'id' => ''])@endcomponent                                                                                                
                </div>  
    
                <div class="form-group col-md-4">
                    <label for="codigo">@lang('fazendas.estado')</label>
                    <input class="form-control" id="estado" name="estado"  v-model="$store.state.item.estado"  type="text"  placeholder="@lang('fazendas.estado')" required>
                    @component('_layouts._components._inputLabel', ['texto'=>'', 'id' => ''])@endcomponent                                                                                                
                </div>
    
                <div class="form-group col-md-4">
                    <label for="codigo">@lang('fazendas.pais')</label>
                    <input class="form-control" id="pais" name="pais" type="text"  v-model="$store.state.item.pais"  placeholder="@lang('fazendas.pais')" required>
                    @component('_layouts._components._inputLabel', ['texto'=>'', 'id' => ''])@endcomponent                                                                                                
                </div>
    
                <div class="form-group col-md-4">
                    <label for="codigo">@lang('fazendas.latitude') </label>
                    <input class="form-control" id="latitude" name="latitude"  v-model="$store.state.item.latitude"  type="number" min='-85' step='0.0001' max='85' aria-describedby="" placeholder="@lang('fazendas.latitude')" required>
                    @component('_layouts._components._inputLabel', ['texto'=>'', 'id' => ''])@endcomponent                                                                                                
                </div>
    
                <div class="form-group col-md-4">
                    <label for="codigo">@lang('fazendas.longitude')</label>
                    <input class="form-control" id="longitude" name="longitude"  v-model="$store.state.item.longitude"  type="number" min='-180' step='0.0001' max='180' aria-describedby="" placeholder="@lang('fazendas.longitude')" required>
                    @component('_layouts._components._inputLabel', ['texto'=>'', 'id' => ''])@endcomponent                                                                                                
                </div>
    
                <div class="form-group col-md-4">
                    <label for="codigo">@lang('fazendas.altitude')  (@lang('fazendas.em_metros'))</label>
                    <input class="form-control" id="altitude"  v-model="$store.state.item.altitude"  name="altitude" type="number" min='-1000' step='0.01' max='8848' aria-describedby="" placeholder="@lang('fazendas.altitude')" required>
                    @component('_layouts._components._inputLabel', ['texto'=>'', 'id' => ''])@endcomponent                                                                                                
                </div>
    
                <div class="form-group col-md-4">
                    <label for="id_proprietario">@lang('fazendas.proprietario')</label>
                    <select readonly disabled name="id_proprietario" id="" aria-readonly="true"  v-model="$store.state.item.id_proprietario"  class='form-control' >
                        
                        @foreach ($proprietarios as $proprietario)
                            <option value="{{$proprietario->id}}">{{$proprietario->nome}}</option>
                        @endforeach
    
                    </select>
                <div class="line"></div>

                </div>
    
                <div class="form-group col-md-4">
                    <label for="codigo">@lang('fazendas.consultor')</label>
                    <select name="id_consultor"  v-model="$store.state.item.id_consultor"  class='form-control' id="">
                        @foreach ($consultores as $consultor)
                            <option value="{{$consultor->id}}">{{$consultor->nome}}</option>
                        @endforeach
                    </select>
                <div class="line"></div>

                </div>

                <div class='form-group col-md-4'>
                    <label for="codigo">@lang('fazendas.status')</label>
                    <select name="ativa"  v-model="$store.state.item.ativa"  class='form-control' required>
                        <option value="0">@lang('fazendas.inativa')</option>
                        <option value="1">@lang('fazendas.ativa')</option>
                    </select>
                <div class="line"></div>

                </div>



        </formulario>
        <span slot="botoes">
          <button form="formEditar" class="btn btn-info">@lang('fazendas.editar')</button>
        </span>
      </modal>

    

@endsection

@section('scripts')
    @include('_layouts._includes._validators_jquery')
@endsection