@extends('_layouts._layout_site')
@include('_layouts._includes._head')

@section('head')
@endsection

@section('titulo')
    @lang('proprietarios.proprietarios')
@endsection

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- TITULO E SUBTITULO --}}
            <div class="col-6">
                <h1>@lang('Cadastrar Proprietário')</h1>
                <p>teste</p>
            </div>

            {{-- BOTOES SALVAR E VOLTAR --}}
            <div class="col-6 text-right botoes position">
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
                    aria-current="page" aria-selected="true" href="#cadastro">Cadastro</a>
            </li>
        </ul>

        <form action="{{ route('proprietario.salvar') }}" method="post" class="mt-3" id="formdados"">
                        <div class=" tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="cadastro" role="tabpanel" aria-labelledby="cadastro-tab">
                @csrf

                <div class="col-md-12 position">
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-3 telo5ce">
                            <label for="nome">@lang('proprietarios.nome')</label>
                            <input type="text" class="form-control telo5ce" id="nome" name="nome" maxlength="50" required>
                        </div>
                        <div class="form-group col-md-3 telo5ce">
                            <label for="telefone">@lang('proprietarios.telefone')</label>
                            <input type="number" class="form-control telo5ce" id="telefone" name="telefone" maxlength="15"
                                required>
                        </div>
                        <div class="form-group col-md-3 telo5ce position">
                            <label for="email">@lang('proprietarios.email')</label>
                            <input type="email" class="form-control" id="email" name="email" maxlength="100" required>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-3 position telo5ce">
                            <label for="tipo_proprietario">@lang('proprietarios.tipo_pessoa')</label><br>
                            <select name="tipo_pessoa" id="tipo_pessoa" class="form-control position telo5ce" required>
                                <option value="fisica">@lang('proprietarios.pessoa_fisica')</option>
                                <option value="juridica">@lang('proprietarios.pessoa_juridica')</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3 telo5ce">
                            <label for="documento">@lang('proprietarios.documento')</label>
                            <input type="text" class="form-control telo5ce" id="documento" name="documento" maxlength="22"
                                required>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
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
    <script>
        $('#botaosalvar').tooltip(options)

    </script>
    @include('_layouts._includes._validators_jquery')
@endsection
