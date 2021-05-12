@extends('_layouts._layout_site')
@include('_layouts._includes._head')

@section('head')
@endsection
@section('titulo')
    @lang('cdc.centro_de_custos')
@endsection

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- TITULO E SUBTITULO --}}
            <div class="col-6">
                <h1>@lang('cdc.centro_de_custos')</h1>
            </div>

            {{-- BOTOES SALVAR E VOLTAR --}}
            <div class="col-6 text-right botoes">
                <a href="{{ route('centrocusto.gerenciar') }}" style="color: #3c8dbc">
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
    @endsection

    @section('conteudo')

        <div>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Editar</a>
                </li>
            </ul>
            <form action="{{ route('centrocusto.edita') }}" method="post" class="row mt-3" id="formdados">
                @csrf
                <input type="hidden" name="id" value="{{ $centroCusto->id }}">
                <div class="col-md-11 m-auto position">
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-4 telo5ce">
                            <label for="nome">@lang('cdc.nome')</label>
                            <input type="text" class="form-control" id="nome" name="nome" maxlength="50" required
                                value="{{ $centroCusto->nome }}">
                        </div>
                        <div class="form-group col-md-2 position telo5ce">
                            <label for="codigo">@lang('cdc.codigo')</label>
                            <input type="number" class="form-control" id="codigo" name="codigo" maxlength="10" required
                                value="{{ $centroCusto->codigo }}">
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
                            required: true,
                        },
                        "codigo": {
                            required: true,
                        }
                    },
                    messages: {
                        nome: "Campo <strong>NOME</strong> é obrigatório",
                        "codigo": {
                            required: "Campo <strong>CÓDIGO</strong> é obrigatório"
                        }
                    }
                });
            });

        </script>
    @endsection
