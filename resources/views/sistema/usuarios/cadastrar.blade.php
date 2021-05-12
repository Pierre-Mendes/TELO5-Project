@extends('_layouts._layout_site')
@include('_layouts._includes._head')

@section('head')
@endsection

@section('titulo')
    @lang('usuarios.usuarios')
@endsection

@section('topo_detalhe')

    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- TITULO E SUBTITULO --}}
            <div class="col-6">
                <h1>@lang('usuarios.usuarios')</h1>
            </div>

            {{-- BOTOES SALVAR E VOLTAR --}}
            <div class="col-6 text-right botoes position">
                <a href="{{ route('usuarios.listar') }}" style="color: #3c8dbc">
                    <button type="button">
                        <span class="fa-stack fa-lg">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fas fa-angle-double-left fa-stack-1x fa-inverse"></i>
                        </span>
                    </button>
                </a>
                <button type="button" id="botaosalvar">
                    <span class="fa-stack fa-2x">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-save fa-stack-1x fa-inverse"></i>
                    </span>
                </button>
            </div>
        </div>
    </div>
@endsection

@section('conteudo')

    <div>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="cadastro-tab" data-bs-toggle="tab" role="tab" aria-controls="cadastro"
                    aria-current="page" aria-selected="true" href="#cadastro">Geral</a>
            </li>
        </ul>
        <form action="{{ route('usuario.salvar') }}" method="post" class="mt-3" id="formdados" autocomplete="off">
            <div class=" tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="cadastro" role="tabpanel" aria-labelledby="cadastro-tab">
                    @csrf
                    <div class="col-md-12 position">
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-3 telo5ce">
                                <label for="nome">@lang('usuarios.nome')</label>
                                <input type="text" class="form-control telo5ce" id="nome" name="nome" maxlength="50">
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                <label for="rua">@lang('usuarios.rua')</label>
                                <input type="text" class="form-control telo5ce" id="rua" name="rua" maxlength="100">
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                <label for="cep">@lang('usuarios.cep')</label>
                                <input type="number" class="form-control telo5ce" id="cep" name="cep" maxlength="10">
                            </div>
                            <div class="form-group col-md-3 position telo5ce">
                                <label for="cidade">@lang('usuarios.cidade')</label>
                                <input type="text" class="form-control position telo5ce" id="cidade" name="cidade" maxlength="60">
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-3 telo5ce">
                                <label for="telefone">@lang('usuarios.telefone')</label>
                                <input type="number" class="form-control" id="telefone" name="telefone" maxlength="15">
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                <label for="estado">@lang('usuarios.estado')</label>
                                <input type="text" class="form-control" id="estado" name="estado" maxlength="60">
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                <label for="pais">@lang('usuarios.pais')</label><br>
                                <input type="text" class="form-control" id="pais" name="pais" maxlength="60">
                            </div>
                            <div class="form-group col-md-3 position telo5ce">
                                <label for="tipo_usuario">@lang('usuarios.tipo_usuario')</label><br>
                                <select name="tipo_usuario" id="tipo_usuario" class="form-control position telo5ce">
                                    <option value="0">Administrador</option>
                                    <option value="1">Gerente</option>
                                    <option value="2">Supervisor</option>
                                    <option value="3">Consultor</option>
                                    <option value="4">Assistente</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-3 telo5ce">
                                <label for="email">@lang('usuarios.email')</label>
                                <input type="email" class="form-control" id="email" name="email" maxlength="100">
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                <label for="password">@lang('usuarios.senha')</label>
                                <input type="password" class="form-control" id="password" name="password" maxlength="20"
                                >
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                <label for="confirmar_senha">@lang('usuarios.confirmar_senha')</label>
                                <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha"
                                    maxlength="20">
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                <label for="configuracao_idioma">@lang('usuarios.idioma')</label><br>
                                <select required name="configuracao_idioma" id="configuracao_idioma"
                                    class="form-control telo5ce">
                                    <option value="0">pt-BR</option>
                                    <option value="1">EN</option>
                                    <option value="2">ES</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#botaosalvar').on('click', function() {
                $('#formdados').submit();
            });
        });

    </script>
    <!-- Inclusão do Plugin jQuery Validation-->
    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
    <script>
        $(document).ready(function() {
            $("#formdados").validate({
                rules: {
                    "nome": {
                        required: true
                    },
                    "rua": {
                        required: true
                    },
                    "cep": {
                        required: true
                    },
                    "cidade": {
                        required: true
                    },
                    "telefone": {
                        required: true
                    },
                    "estado": {
                        required: true
                    },           
                    "pais": {
                        required: true
                    },
                    "email": {
                        required: true,
                        email: true
                    },
                    "password": {
                        required: true
                    },
                    "confirmar_senha": {
                        required: true
                    }
                },
                messages: {
                    nome: "Campo <strong>NOME</strong> é obrigatório",

                    "rua": {
                        required: "Campo <strong>RUA</strong> é obrigatório"
                    },
                    "cep": {
                        required: "Campo <strong>CEP</strong> é obrigatório"
                    },
                    "cidade": {
                        required: "Campo <strong>CIDADE</strong> é obrigatório"
                    },
                    "telefone": {
                        required: "Campo <strong>TELEFONE</strong> é obrigatório"
                    },
                    "estado": {
                        required: "Campo <strong>ESTADO</strong> é obrigatório"
                    },                    
                    "pais": {
                        required: "Campo <strong>PAIS</strong> é obrigatório"
                    },
                    "email": {
                        required: "Campo <strong>E-MAIL</strong> é obrigatório",
                    },
                    "password": {
                        required: "Campo <strong>SENHA</strong> é obrigatório"
                    },
                    "confirmar_senha": {
                        required: "Campo <strong>CONFRIMAR SENHA</strong> é obrigatório"
                    }                 
                }
            });
        });

    </script>
@endsection
