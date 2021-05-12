@extends('_layouts._layout_site')

@section('head')
@endsection
@section('titulo')

@endsection

@section('topo_detalhe')
<div class="container-fluid topo">
    <div class="row align-items-start">

        {{-- TITULO E SUBTITULO --}}
        <div class="col-6">
            <h1>@lang('cdc.centro_de_custos')</h1>
        </div>

        {{-- BOTOES SALVAR E VOLTAR --}}
        <div class="col-6 text-right botoes position">
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
</div>
@endsection

@section('conteudo')
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Cadastro</a>
            </li>
        </ul>
        <form action="{{ route('centrocusto.salvar') }}" method="post" class="mt-3" id="formdados">

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active formcdc" id="cadastro" role="tabpanel" aria-labelledby="cadastro-tab">
                    @csrf
                    <div class="col-md-12 position">
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="nome">@lang('cdc.nome')</label>
                                <input type="text" class="form-control" id="nome" name="nome" maxlength="50" required>
                            </div>
                            <div class="form-group col-md-2 telo5ce position">
                                <label for="codigo">@lang('cdc.codigo')</label>
                                <input type="number" class="form-control" id="codigo" name="codigo" maxlength="10" required>
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
