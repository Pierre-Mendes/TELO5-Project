@extends('_layouts._layout_site')

@section('head')
@endsection
@section('titulo')
    @lang('proprietario.proprietario')
@endsection

@section('topo_detalhe')

    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- Titlle --}}
            <div class="col-6">
                <h1>@lang('Editar Proprietário')</h1>
            </div>

            {{-- Save button and return button --}}
            <div class="col-6 text-right botoes">
                <a href="{{ route('proprietarios.gerenciar') }}" style="color: #3c8dbc">
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
                    aria-current="page" aria-selected="true" href="#cadastro">Editar cadastro</a>
            </li>
        </ul>

        <form action="{{ route('proprietario.edita') }}" method="post" class="mt-3" id="formdados">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="editar" role="tabpanel" aria-labelledby="editar-tab">
                    @csrf

                    <div class="col-md-12 position">
                        <input type="hidden" name="id" value="{{ $proprietarios->id }}">

                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-3 telo5ce">
                                <label for="nome">@lang('proprietarios.nome')</label>
                                <input type="text" class="form-control telo5ce" id="nome" name="nome" maxlength="50"
                                    required value="{{ $proprietarios->nome }}">
                            </div>

                            <div class="form-group col-md-3 telo5ce position">
                                <label for="email">@lang('proprietarios.email')</label>
                                <input type="email" class="form-control" id="email" name="email" maxlength="100" required
                                    value="{{ $proprietarios->email }}">
                            </div>

                            <div class="form-group col-md-2 telo5ce">
                                <label for="telefone">@lang('proprietarios.telefone')</label>
                                <input type="number" class="form-control telo5ce" id="telefone" name="telefone"
                                    maxlength="15" required value="{{ $proprietarios->telefone }}">
                            </div>

                        </div>

                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-3 position telo5ce">
                                <label for="tipo_proprietario">@lang('proprietarios.tipo_pessoa')</label><br>
                                <select name="tipo_pessoa" id="tipo_pessoa" class="form-control position telo5ce" required>
                                    <option value="fisica">@lang('proprietarios.pessoa_fisica')</option>
                                    <option value="juridica">@lang('proprietarios.pessoa_juridica')</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3 telo5ce position">
                                <label for="documento">@lang('proprietarios.documento')</label>
                                <input type="text" class="form-control telo5ce" id="documento" name="documento"
                                    maxlength="22" required value="{{ $proprietarios->documento }}">
                            </div>
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
                        "email": {
                            required: true
                        },
                        "telefone": {
                            required: true
                        },
                        "documento": {
                            required: true
                        }
                    },
                    messages: {
                        nome: "Campo <strong>NOME</strong> é obrigatório",
    
                        "email": {
                            required: "Campo <strong>E-MAIL</strong> é obrigatório"
                        },
                        "telefone": {
                            required: "Campo <strong>TELEFONE</strong> é obrigatório"
                        },
                        "documento": {
                            required: "Campo <strong>DOCUMENTO</strong> é obrigatório"
                        }            
                    }
                });
            });
    
        </script>
@endsection
