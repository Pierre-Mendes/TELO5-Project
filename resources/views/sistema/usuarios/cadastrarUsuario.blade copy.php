@extends('_layouts._layout_site')


@section('conteudo')   
    <div class="card card-login mx-auto mt-5">
        <div class="card-header"><h1 align="center">@lang('cadastrar.cadastro_usuario')</h1></div>
        <div class="card-body">
            <form action="{{route('usuario.cadastra')}}" id="cadastrar_usuario" class='row' method="post">
                {{csrf_field()}}
                <div class='col-12'>
                    <hr>
                    <h3>@lang('cadastrar.informacoes_pessoais')</h3>
                </div>
                <div class="form-group col-md-6">
                    <label for="name">@lang('cadastrar.nome')</label>
                    <input class="form-control" id="name" name="nome" type="text" aria-describedby="" placeholder="@lang('cadastrar.nome')" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="telefone">@lang('cadastrar.telefone')</label>
                    <input class="form-control" id="telefone" name="telefone" type="text" aria-describedby="" placeholder="@lang('cadastrar.telefone')" required>
                </div>

                <div class='col-12'>
                    <hr>
                    <h3>@lang('cadastrar.informacoes_endereco')</h3>
                </div>

               <div class="form-group col-md-4">
                    <label for="rua">@lang('cadastrar.rua')</label>
                    <input class="form-control" id="rua" name="rua" type="text" aria-describedby="" placeholder="@lang('cadastrar.rua')" required>
                </div>       

                 <div class="form-group col-md-4">
                    <label for="cep">@lang('cadastrar.cep')</label>
                    <input class="form-control" id="cep" name="cep" type="number" aria-describedby="" placeholder="@lang('cadastrar.cep')" required>
                </div>   

                <div class="form-group col-md-4">
                    <label for="cidade">@lang('cadastrar.cidade')</label>
                    <input class="form-control" id="cidade" name="cidade" type="text" aria-describedby="" placeholder="@lang('cadastrar.cidade')" required>
                </div>                
                
       
                <div class="form-group col-md-6">
                    <label for="estado">@lang('cadastrar.estado')</label>
                    <input class="form-control" id="Estado" name="estado" type="text" aria-describedby="" placeholder="@lang('cadastrar.estado')" required>
                </div> 

                <div class="form-group col-md-6">
                    <label for="pais">@lang('cadastrar.pais')</label>
                    <input class="form-control" id="pais" name="pais" type="text" aria-describedby="" placeholder="@lang('cadastrar.pais')" required>
                </div>

                <div class='col-12'>
                    <hr>
                    <h3>@lang('cadastrar.configuracao_sistema')</h3>
                </div>


                <div class="form-group col-md-6">
                    <label for="configuracao_idioma">@lang('cadastrar.idioma')</label>
                    <select class="form-control" name="configuracao_idioma" id="configuracao_idioma" required>
                        @foreach($idiomas as $idioma)
                            <option value="{{$idioma['chave']}}">{{$idioma["valor"]}}</option>
                        @endforeach
                    </select>
                </div>

               

                <div class="form-group col-md-6">
                    <label for="tipo_usuario">@lang('cadastrar.tipo_usuario')</label>
                    <select class="form-control" name="tipo_usuario" id="tipo_usuario" required>
                        @foreach($papeis as $papel)
                            <option value="{{$papel['chave']}}">@lang($papel['valor'])</option>
                        @endforeach
                    </select>
                </div>
                
                   

                <div class='col-12'>
                    <hr>
                    <h3>@lang('cadastrar.credenciais_login')</h3>
                </div>


                
                <div class="form-group col-md-4">
                    <label for="email" >@lang('cadastrar.email')</label>
                    <input class="form-control" id="email" name="email" type="email" aria-describedby="" placeholder="@lang('cadastrar.email')" required>
                </div>
                
                <div class="form-group  col-md-4">
                    <label for="password">@lang('cadastrar.senha')</label>
                    <input class="form-control" id="password" minlength="6" name="password" type="password" placeholder="@lang('cadastrar.senha')" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="passwd2">@lang('cadastrar.confirmar_senha')</label>
                    <input class="form-control" id="passwd2" name="confirm_password" data-rule-equalTo="#password" type="password" placeholder="@lang('cadastrar.confirmar_senha')" required>
                </div>


                
                <button class="btn btn-lg btn-info btn-block col-md-2 text-light" style="margin: 0 auto" type="submit">@lang('cadastrar.cadastrar')</button>
              
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="{{URL::previous()}}">@lang('cadastrar.voltar')</a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
   
@endsection



