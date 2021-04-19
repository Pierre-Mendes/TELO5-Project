@extends('_layouts._layout_site')

@section('titulo')
    @lang('usuarios.usuarios')
@endsection

@section('conteudo')

<!--
<fieldset style="padding-left: 38px">
    <form>
        <label>Usúario: </label>
        <input type="text" name="buscar" placeholder="nome do usúario">
        <input type="submit" value="Pesquisar">
    </form>
    <label>Tipo de usúario: </label>
    <select>
        <option>Não filtrar</option>
        <option>Administrador</option>
        <option>Gerente</option>
        <option>Surpervisor</option>
        <option>Consultor</option>
        <option>Assistente</option>
    </select>
<br>
    <fieldset>
        <br>
        <input type="radio" value="inativo" name="situacao" id="inativo"> <label for="inativo">Inativo</label>
        <input type="radio" value="inativo" name="situacao" id="ativo"> <label for="ativo">Ativo</label>        
    </fieldset>
    <br>

    
</fieldset>

-->

<!--<filtro titulo="@lang('usuarios.filtrar')" @if(!empty($filtro['filtro'])) show=" show" @endif action="#" txt_buscar="@lang('usuarios.buscar')">
    <div class="col-md-6 form-group">
        <input
            class="form-control"
            id="name_busca"
            name="nome"
            type="text"
            value="@if(isset($filtro['nome'])) {{$filtro['nome']}} @endif"
            aria-describedby           
        />  
        @component('_layouts._components._inputLabel', ['texto'=>__('usuarios.nome'), 'id' => ''])@endcomponent                                                                                                      

    </div>
            <div class="col-md-3 form-group">
                <label for="busca_tipo_usuario">@lang('usuarios.tipo_usuario')</label>
                <select
                data-width="fit"
                id="busca_tipo_usuario"
                class="form-control"
                name="tipo_usuario"
            >
                <option value selected>@lang('usuarios.nao_filtrar')</option>@foreach($papeis as $papel)
                <option value="{{$papel['chave']+100}}">@lang($papel['valor'])</option>@endforeach
            </select> 
<div class="line"></div>
            </div>
            <div class="col-md-3">
            <label for="status_busca">@lang('usuarios.situacao')</label>
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" for="checkAtivo" type="checkbox" @if(isset($filtro['ativo'])) checked @endif value="ativo" id="checkAtivo" name="ativo">
                <label
                class="custom-control-label"
                for="checkAtivo"
                >@lang('usuarios.ativo')</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="inativo" @if(isset($filtro['inativo'])) checked @endif id="checkInativo" name="inativo">
                <label
                class="custom-control-label"
                for="checkInativo"
                >@lang('usuarios.inativo')</label>
            </div>
        </div>
    </filtro>-->

    <!--
    <tabela-lista
        v-bind:titulos="['#','@lang("usuarios.nome")','@lang("usuarios.telefone")','@lang("usuarios.pais")','@lang("usuarios.tipo_usuario")', '@lang("usuarios.email")', '@lang("usuarios.situacao")']"
        v-bind:itens="{{json_encode($listaUsuarios)}}"

    </tabela-lista>
    -->

    <div align="center" class='row'>
        @if(isset($filtro['filtro']))
            @if(isset($filtro['ativo'] ) && !isset($filtro['inativo']))
            {{$listaUsuarios->appends([
                'filtro' => 'filtrar',
                'nome' => $filtro['nome'] ?? '',
                'tipo_usuario' => $filtro['tipo_usuario'] ?? '',
                'ativo' => 'ativo'
            ])}}
            @elseif(isset($filtro['ativo'] ) && !isset($filtro['inativo']))
            {{$listaUsuarios->appends([
                'filtro' => 'filtrar',
                'nome' => $filtro['nome'] ?? '',
                'tipo_usuario' => $filtro['tipo_usuario'] ?? '',
                'inativo' => 'inativo'
            ])}}
            @else
            {{$listaUsuarios->appends([
                'filtro' => 'filtrar',
                'nome' => $filtro['nome'] ?? '',
                'tipo_usuario' => $filtro['tipo_usuario'] ?? ''
            ])}}
            @endif
        @else
            {{$listaUsuarios}}
        @endif
    </div>
    
    <div class="align-content-start col-4 col-md-4 buscar">
        <div class='input-group'>
            <span class="input-group-text bg-transparent" style="border: none" id="search"><i class='fa fa-search'> </i></span>
            <input type="search"  class="form-control"  v-model="buscar" aria-describedby="search" >
            <div class="line"></div>
        </div>     
    </div>

    <table class="table table-striped table-hover tabela">
        <thead id='tbHead'>
            <tr class='text-light'>
                <th style="cursor:pointer; vertical-align: middle">@lang("usuarios.nome")<i class='fa fa-fw fa-sort '></i> </th>
                <th style="cursor:pointer; vertical-align: middle">@lang("usuarios.telefone")<i class='fa fa-fw fa-sort'></i> </th>
                <th style="cursor:pointer; vertical-align: middle">@lang("usuarios.pais")<i class='fa fa-fw fa-sort'></i> </th>
                <th style="cursor:pointer; vertical-align: middle">@lang("usuarios.tipo_usuario")<i class='fa fa-fw fa-sort'></i> </th>
                <th style="cursor:pointer; vertical-align: middle">@lang("usuarios.email")<i class='fa fa-fw fa-sort'></i> </th>
                <th style="cursor:pointer; vertical-align: middle">@lang("usuarios.situacao")<i class='fa fa-fw fa-sort'></i> </th>
                <th style="vertical-align: middle"><i class='fa fa-fw  fa-wrench'></i></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listaUsuarios as $item)
                <tr>
                    <td>
                        {{ $item['nome']}}
                    </td>
                    <td  class="linha">
                        {{ $item['telefone']}}
                    </td>
                    <td  class="linha">
                        {{ $item['pais']}}
                    </td>
                    <td  class="linha">
                        {{ $item['tipo_usuario']}}
                    </td>
                    <td  class="linha">
                        {{ $item['email']}}
                    </td>
                    <td class="linha">
                        {{ $item['situacao']}}
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
        <tfoot><tr><td colspan="7" class="abc"></td></tr></tfoot>
    </table>
    
<modal nome="adicionar" titulo="@lang('usuarios.cadastro_usuario')">
    <formulario id="formAdicionar" css="row" action="{{route('usuario.cadastra')}}" method="post" enctype="" token="{{ csrf_token() }}">

        <div class='col-12'>
            <hr>
            <h3>@lang('usuarios.informacoes_pessoais')</h3>
        </div>
        <div class="form-group col-md-6">
            <input class="form-control" id="name" name="nome" type="text" aria-describedby="" required>
            @component('_layouts._components._inputLabel', ['texto'=>__('usuarios.nome'), 'id' => ''])@endcomponent                                                                                                
        </div>

        <div class="form-group col-md-6">
            <input class="form-control" id="telefone" name="telefone" type="text" aria-describedby=""  required>
            @component('_layouts._components._inputLabel', ['texto'=>__('usuarios.telefone'), 'id' => ''])@endcomponent                                                                                                
        </div>

        <div class='col-12'>
            <hr>
            <h3>@lang('usuarios.informacoes_endereco')</h3>
        </div>

        <div class="form-group col-md-4">
            <input class="form-control" id="rua" name="rua" type="text" aria-describedby=""  required>
            @component('_layouts._components._inputLabel', ['texto'=>__('usuarios.rua'), 'id' => ''])@endcomponent                                                                                                
        </div>       

            <div class="form-group col-md-4">
            <input class="form-control" id="cep" name="cep" type="number" aria-describedby="" required>
            @component('_layouts._components._inputLabel', ['texto'=>__('usuarios.cep'), 'id' => ''])@endcomponent                                                                                                
        </div>   

        <div class="form-group col-md-4">
            <input class="form-control" id="cidade" name="cidade" type="text" aria-describedby=""  required>
            @component('_layouts._components._inputLabel', ['texto'=>__('usuarios.cidade'), 'id' => ''])@endcomponent                                                                                                
        </div>                
        

        <div class="form-group col-md-6">
            <input class="form-control" id="Estado" name="estado" type="text" aria-describedby=""  required>
            @component('_layouts._components._inputLabel', ['texto'=>__('usuarios.estado'), 'id' => ''])@endcomponent                                                                                                
        </div> 

        <div class="form-group col-md-6">
            <input class="form-control" id="pais" name="pais" type="text" aria-describedby=""  required>
            @component('_layouts._components._inputLabel', ['texto'=>__('usuarios.pais'), 'id' => ''])@endcomponent                                                                                                
        </div>

        <div class='col-12'>
            <hr>
            <h3>@lang('usuarios.configuracao_sistema')</h3>
        </div>


        <div class="form-group col-md-3">
            <label for="configuracao_idioma">@lang('usuarios.idioma')</label>
            <select class="form-control" name="configuracao_idioma" id="configuracao_idioma" required>
                @foreach($idiomas as $idioma)
                    <option value="{{$idioma['chave']}}">{{$idioma["valor"]}}</option>
                @endforeach
            </select> 
<div class="line"></div>
        </div>

        

        <div class="form-group col-md-3">
            <label for="tipo_usuario">@lang('usuarios.tipo_usuario')</label>
            <select onchange="trocarDivAtivaSuperior()" class="form-control" name="tipo_usuario" id="tipo_usuario" required>
                @foreach($papeis as $papel)
                    <option value="{{$papel['chave']}}">@lang($papel['valor'])</option>
                @endforeach
            </select> 
<div class="line"></div>
        </div>



        <div class="form-group col-md-3">

            <div id='divSupervisor' style="display: none;" >
                <label for="tipo_usuario">@lang('usuarios.superior')</label>
                <select name="superior_s" id="superior_s" class='form-control' required>
                    @foreach ($usuarios_superiores as $item)
                        @if($item->tipo_usuario == 1)
                            <option value="{{$item->id}}">{{$item->nome}}</option>
                        @endif
                    @endforeach
                </select> 
<div class="line"></div>
            </div>

            <div id='divConsultor' style="display: none;" >
                <label for="tipo_usuario">@lang('usuarios.superior')</label>
                <select name="superior_c" id="superior_c" class='form-control' required>
                    @foreach ($usuarios_superiores as $item)
                        @if($item->tipo_usuario == 1 || $item->tipo_usuario == 2)
                            <option value="{{$item->id}}">{{$item->nome}}</option>
                        @endif
                    @endforeach
                </select> 
<div class="line"></div>
            </div>

            <div id='divAssistente' style="display: none;" >
                <label for="tipo_usuario">@lang('usuarios.superior')</label>
                <select id="superior_a" name="superior_a" class='form-control' required>
                    @foreach ($usuarios_superiores as $item)
                        @if($item->tipo_usuario == 3)
                            <option value="{{$item->id}}">{{$item->nome}}</option>
                        @endif
                    @endforeach
                </select> 
<div class="line"></div>
            </div>

        </div>

        <div class='form-group col-md-3'>
            <div class='form-group fit-width' id="divCentroCusto">
                <label for="cdcs">@lang('usuarios.centrodecustos')</label>
                <br>
                <select  class='selectpicker col-12' data-width="fit"  multiple name="cdcs[]" id="cdcs" >
                    @foreach ($cdcs as $item)
                        <option value="{{$item->id}}">{{$item->nome}}</option>
                    @endforeach
                </select> 
            </div>
        </div>
        
            

        <div class='col-12'>
            <hr>
            <h3>@lang('usuarios.credenciais_login')</h3>
        </div>


        
        <div class="form-group col-md-4">
            <input class="form-control" id="email" name="email" type="email" aria-describedby=""  required>
            @component('_layouts._components._inputLabel', ['texto'=>__('usuarios.email'), 'id' => ''])@endcomponent                                                                                                
        </div>
        
        <div class="form-group  col-md-4">
            <input class="form-control" id="password" minlength="6" name="password" type="password"  required>
            @component('_layouts._components._inputLabel', ['texto'=>__('usuarios.senha'), 'id' => ''])@endcomponent                                                                                                
        </div>
        <div class="form-group col-md-4">
            <input class="form-control" id="confirmpassword" name="confirmpassword" type="password"  required>
            @component('_layouts._components._inputLabel', ['texto'=>__('usuarios.confirmar_senha'), 'id' => ''])@endcomponent                                                                                                
        </div>

    
    
                                              
    </formulario>
    <span slot="botoes">
        <button form='formAdicionar' class="btn btn-lg btn-info btn-block text-center text-light" style="margin: 0 auto" type="submit">@lang('usuarios.cadastrar')</button>
    </span>

  </modal>

  <modal nome="editar" titulo="@lang('usuarios.editar_usuario')">
  <formulario id="formEditar" v-bind:action="'{{route('usuario.edita')}}'" css='row' method="put" enctype="" token="{{ csrf_token() }}">
        <!--
      <div class="form-group">
        <label for="titulo">Teste</label>
        <input type="text" class="form-control" id="titulo" name="titulo" v-model="$store.state.item.titulo" placeholder="TÃ­tulo">
      </div>
        -->
    <input type="text" name='id' hidden v-model="$store.state.item.id">

      <div class='col-12'>
            <hr>
            <h3>@lang('usuarios.informacoes_pessoais')</h3>
        </div>
        <div class="form-group col-md-6">
            <label for="ename">@lang('usuarios.nome')</label>
            <input class="form-control" id="ename" name="nome" type="text" v-model="$store.state.item.nome" aria-describedby="" placeholder="@lang('usuarios.nome')" required>
            @component('_layouts._components._inputLabel', ['texto'=>'', 'id' => ''])@endcomponent                                                                                                
        </div>

        <div class="form-group col-md-6">
            <label for="etelefone">@lang('usuarios.telefone')</label>
            <input class="form-control" id="etelefone" name="telefone" type="text" v-model="$store.state.item.telefone" aria-describedby="" placeholder="@lang('usuarios.telefone')" required>
            @component('_layouts._components._inputLabel', ['texto'=>'', 'id' => ''])@endcomponent                                                                                                
        </div>

        <div class='col-12'>
            <hr>
            <h3>@lang('usuarios.informacoes_endereco')</h3>
        </div>

       <div class="form-group col-md-4">
            <label for="erua">@lang('usuarios.rua')</label>
            <input class="form-control" id="erua" name="rua"  v-model="$store.state.item.rua" type="text" aria-describedby="" placeholder="@lang('usuarios.rua')" required>
            @component('_layouts._components._inputLabel', ['texto'=>'', 'id' => ''])@endcomponent                                                                                                
        </div>       

         <div class="form-group col-md-4">
            <label for="ecep">@lang('usuarios.cep')</label>
            <input class="form-control" id="ecep" name="cep"  v-model="$store.state.item.cep" type="number" aria-describedby="" placeholder="@lang('usuarios.cep')" required>
            @component('_layouts._components._inputLabel', ['texto'=>'', 'id' => ''])@endcomponent                                                                                                
        </div>   

        <div class="form-group col-md-4">
            <label for="ecidade">@lang('usuarios.cidade')</label>
            <input class="form-control" id="ecidade" name="cidade"  v-model="$store.state.item.cidade" type="text" aria-describedby="" placeholder="@lang('usuarios.cidade')" required>
            @component('_layouts._components._inputLabel', ['texto'=>'', 'id' => ''])@endcomponent                                                                                                
        </div>                
        

        <div class="form-group col-md-6">
            <label for="eestado">@lang('usuarios.estado')</label>
            <input class="form-control" id="eEstado" name="estado"  v-model="$store.state.item.estado" type="text" aria-describedby="" placeholder="@lang('usuarios.estado')" required>
            @component('_layouts._components._inputLabel', ['texto'=>'', 'id' => ''])@endcomponent                                                                                                
        </div> 

        <div class="form-group col-md-6">
            <label for="epais">@lang('usuarios.pais')</label>
            <input class="form-control" id="epais" name="pais"  v-model="$store.state.item.pais" type="text" aria-describedby="" placeholder="@lang('usuarios.pais')" required>
            @component('_layouts._components._inputLabel', ['texto'=>'', 'id' => ''])@endcomponent                                                                                                
        </div>

        <div class='col-12'>
            <hr>
            <h3>@lang('usuarios.configuracao_sistema')</h3>
        </div>


        <div class="form-group col-md-4">
            <label for="econfiguracao_idioma">@lang('usuarios.idioma')</label>
            <select class="form-control" name="configuracao_idioma"  v-model="$store.state.item.configuracao_idioma" id="econfiguracao_idioma" required>
                @foreach($idiomas as $idioma)
                    <option value="{{$idioma['chave']}}">{{$idioma["valor"]}}</option>
                @endforeach
            </select> 
<div class="line"></div>
        </div>

       

        <div class="form-group col-md-4">
            <label for="etipo_usuario">@lang('usuarios.tipo_usuario')</label>
            <select class="form-control"  onchange="etrocarDivAtivaSuperior()" name="tipo_usuario" id="etipo_usuario" v-model="$store.state.item.tipo_usuario" required>
                @foreach($papeis as $papel)
                    <option value="{{$papel['chave']}}">@lang($papel['valor'])</option>
                @endforeach
            </select> 
<div class="line"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="estatus">@lang('usuarios.situacao')</label>
            <select class="form-control" name="situacao" id="estatus" v-model="$store.state.item.situacao" required>
                <option value="0">@lang('usuarios.inativo')</option>
                <option value="1">@lang('usuarios.ativo')</option>
            </select> 
<div class="line"></div>
        </div>

        <div class='col-md-6'>
                <div class='form-group fit-width' id="edivCentroCusto">
                    <label for="cdcs">@lang('usuarios.centrodecustos')</label>
                    <select class='selectpicker col-12'  v-if=$store.state.item.cdc_user v-model="$store.state.item.cdc_user"  multiple name="cdcs[]" id="ecdcs" >
                        @foreach ($cdcs as $item)
                            <option value="{{$item->id}}">{{$item->nome}}</option>
                        @endforeach
                    </select>
                </div>
        </div>

        <div class="form-group col-md-6">
            <div id='edivSupervisor' >
                <label for="tipo_usuario">@lang('usuarios.superior')</label>
                <select name="superior_s" id="esuperior_s" class='form-control' required  v-model="$store.state.item.id_superior" >
                    @foreach ($usuarios_superiores as $item)
                        @if($item->tipo_usuario == 1)
                            <option value="{{$item->id}}">{{$item->nome}}</option>
                        @endif
                    @endforeach
                </select> 
<div class="line"></div>
            </div>

            <div id='edivConsultor'>
                <label for="tipo_usuario">@lang('usuarios.superior')</label>
                <select name="superior_c" id="esuperior_c" class='form-control' required v-model="$store.state.item.id_superior" >
                    @foreach ($usuarios_superiores as $item)
                        @if($item->tipo_usuario == 1 || $item->tipo_usuario == 2)
                            <option value="{{$item->id}}">{{$item->nome}}</option>
                        @endif
                    @endforeach
                </select> 
<div class="line"></div>
            </div>

            <div id='edivAssistente' >
                <label for="tipo_usuario">@lang('usuarios.superior')</label>
                <select name="superior_a" id="esuperior_a" class='form-control' required v-model="$store.state.item.id_superior" >
                    @foreach ($usuarios_superiores as $item)
                        @if($item->tipo_usuario == 3)
                            <option value="{{$item->id}}">{{$item->nome}}</option>
                        @endif
                    @endforeach
                </select> 
<div class="line"></div>
            </div>
        </div>

        <div class='col-12'>
            <hr>
            <h3>@lang('usuarios.credenciais_login')</h3>
        </div>

        <div class="form-group col-md-4">
            <label for="eemail" >@lang('usuarios.email')</label>
            <input class="form-control" id="eemail" name="email" type="email" aria-describedby="" v-model="$store.state.item.email" placeholder="@lang('usuarios.email')" required>
            @component('_layouts._components._inputLabel', ['texto'=>'', 'id' => ''])@endcomponent                                                                                                
        </div>
        
        
        <div class="form-group  col-md-4">
            <label for="epassword">@lang('usuarios.senha')</label>
            <input class="form-control" id="epassword" minlength="6" name="password" type="password"  placeholder="@lang('usuarios.informe_senha_alt')" >
            @component('_layouts._components._inputLabel', ['texto'=>'', 'id' => ''])@endcomponent                                                                                                                
        </div>
        <div class="form-group col-md-4">
            <label for="econfirmpassword">@lang('usuarios.confirmar_senha')</label>
            <input class="form-control" id="econfirmpassword" name="confirm_password" type="password" placeholder="@lang('usuarios.confirmar_senha')" >
            @component('_layouts._components._inputLabel', ['texto'=>'', 'id' => ''])@endcomponent                                                                                                
        </div>
    </formulario>
    <span slot="botoes">
    <button form="formEditar" class="btn btn-info" >@lang('usuarios.atualizar')</button>
    </span>
</modal>



@endsection

@section('scripts')
<!-- Includes to combobox style -->
<script type="text/javascript">

$( document ).ready(function() {
    trocarDivAtivaSuperior();
    etrocarDivAtivaSuperior();
    $('#edivSuperiores').show();

    $("#formAdicionar").submit(function(e){
        if (!checkIfPasswordsMatch()){
            alert("{{__('usuarios.senhasNaoBatem')}}");
            return false;
        }
    });

    $("#formEditar").submit(function(e){
        if (!checkIfPasswordsEditMatch()){
            alert("{{__('usuarios.senhasNaoBatem')}}");
            return false;
        }
    });


});    


function trocarDivAtivaSuperior(){
    var papel = $('#tipo_usuario').val();
    togleDivCentroCustos(papel);
    var divAssist =  $('#divAssistente');
    var divConsult =  $('#divConsultor');
    var divSup =  $('#divSupervisor');
    var fieldAssist = $("#superior_a");
    var fieldConsult = $("#superior_c");
    var fieldSup = $("#superior_s");
    if(papel == 2){
        divAssist.hide();
        divConsult.hide();
        divSup.show();
        fieldAssist.removeAttr('required');
        fieldConsult.removeAttr('required');
        fieldSup.attr('required', 'required');
    }else if(papel == 3){
        divAssist.hide();
        divConsult.show();
        divSup.hide();
        fieldAssist.removeAttr('required');
        fieldSup.removeAttr('required');
        fieldConsult.attr('required', 'required');
    }else if(papel == 4){
        divAssist.show();
        divConsult.hide();
        divSup.hide();
        fieldSup.removeAttr('required');
        fieldConsult.removeAttr('required');
        fieldAssist.attr('required', 'required');
    }else{
        divAssist.hide();
        divConsult.hide();
        divSup.hide();
        fieldSup.removeAttr('required');
        fieldConsult.removeAttr('required');
        fieldAssist.removeAttr('required');
    }
} 

$('#editar').on('shown.bs.modal', function (e) {
    etrocarDivAtivaSuperior();
})

function togleDivCentroCustos(papel){
    var divCDC =  $('#divCentroCusto');
    if(papel == 0){
        divCDC.hide();
        $("#cdcs").removeAttr('required');
    }else{
        divCDC.show();
        $("#cdcs").attr('required', 'required');
    }
}


function etrocarDivAtivaSuperior(){
    $('#edivSuperiores').hide();
    $('#trocarSuperior').hide();
    var papel = $('#etipo_usuario').val();
    etogleDivCentroCustos(papel);
    var divAssist =  $('#edivAssistente');
    var divConsult =  $('#edivConsultor');
    var divSup =  $('#edivSupervisor');
    var fieldAssist = $("#esuperior_a");
    var fieldConsult = $("#esuperior_c");
    var fieldSup = $("#esuperior_s");
    if(papel == 2){
        divAssist.hide();
        divConsult.hide();
        divSup.show();
        fieldAssist.removeAttr('required');
        fieldConsult.removeAttr('required');
        fieldSup.attr('required', 'required');
    }else if(papel == 3){
        divAssist.hide();
        divConsult.show();
        divSup.hide();
        fieldAssist.removeAttr('required');
        fieldSup.removeAttr('required');
        fieldConsult.attr('required', 'required');
    }else if(papel == 4){
        divAssist.show();
        divConsult.hide();
        divSup.hide();
        fieldSup.removeAttr('required');
        fieldConsult.removeAttr('required');
        fieldAssist.attr('required', 'required');
    }else{
        divAssist.hide();
        divConsult.hide();
        divSup.hide();
        fieldSup.removeAttr('required');
        fieldConsult.removeAttr('required');
        fieldAssist.removeAttr('required');
    }
}

function etogleDivCentroCustos(papel){
    var divCDC =  $('#edivCentroCusto');
    if(papel == 0){
        divCDC.hide();
        $("#ecdcs").removeAttr('required');
    }else{
        divCDC.show();
        $("#ecdcs").attr('required', 'required');
    }
}

function checkIfPasswordsMatch(){
    let senha1 = $("#password").val();
    let senha2 = $("#confirmpassword").val();
    if(senha1 !== "" && senha1 === senha2){
        return true;
    }else{
        return false;
    }
}


function checkIfPasswordsEditMatch(){
    let senha1 = $("#epassword").val();
    let senha2 = $("#econfirmpassword").val();
    if(senha1 === "" || senha1 === senha2){
        return true;
    }else{
        return false;
    }
}
</script>

<script type="text/javascript">
    window.onload = function(){
        $("#busca_tipo_usuario").val(@if(!empty($filtro['tipo_usuario'])) '{{$filtro['tipo_usuario']}}' @else '' @endif).change();
    }
    $('#editar').on('shown.bs.modal', function (e) {
        $("#ecdcs").selectpicker('refresh');
    })
</script>
@endsection