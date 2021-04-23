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
                <h1>)</h1>
            </div>

            {{-- BOTOES SALVAR E VOLTAR --}}
            <div class="col-6 text-right botoes">
                <a href="{{ route('pivos.gerenciar') }}" style="color: #3c8dbc">
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
                    aria-current="page" aria-selected="true" href="#cadastro">Editar</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active formpivos" id="cadastro" role="tabpanel" aria-labelledby="cadastro-tab">

                <form action="{{ route('pivos.edita') }}" method="post" class="mt-3" id="formdados">
                    @csrf
                    <input type="hidden" name="id" value="{{ $pivos->id }}">
                    <div class="col-md-12 position">
                        <div>
                            <div class="form-row justify-content-start">
                                <div class="form-group ">
                                    <h3>Dados do Pivo:</h3>
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="form-group col-md-4 telo5ce">
                                    <label for="fabricante">@lang('pivos.fabricante')</label>
                                    <input type="text" class="form-control" id="fabricante" name="fabricante" maxlength="50"
                                        required value="{{ $pivos->fabricante }}">
                                </div>
                                <div class="form-group col-md-4 telo5ce">
                                    <label for="nome">@lang('pivos.nome')</label>
                                    <input type="text" class="form-control" id="nome" name="nome" maxlength="10" required
                                        value="{{ $pivos->nome }}">
                                </div>
                                <div class="form-group col-md-4 telo5ce position">
                                    <label for="espacamento">@lang('pivos.espacamento')</label>
                                    <input type="number" class="form-control" id="espacamento" name="espacamento"
                                        maxlength="10" required value="{{ $pivos->espacamento }}">
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="form-row justify-content-start">
                                <div class="form-group ">
                                    <h3>Dados do Pivo:</h3>
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="form-group col-md-4 telo5ce">
                                    <label for="saida_1_inicial">@lang('pivos.saida1')</label>
                                    <input type="text" class="form-control" id="saida_1_inicial" name="saida_1_inicial"
                                        maxlength="50" required value="{{ $pivos->saida_1_inicial }}">
                                </div>
                                <div class="form-group col-md-4 telo5ce">
                                    <label for="saida_2_inicial">@lang('pivos.saida2')</label>
                                    <input type="text" class="form-control" id="saida_2_inicial" name="saida_2_inicial"
                                        maxlength="10" required value="{{ $pivos->saida_2_inicial }}">
                                </div>
                                <div class="form-group col-md-4 telo5ce">
                                    <label for="saida_3_inicial">@lang('pivos.saida3')</label>
                                    <input type="number" class="form-control" id="saida_3_inicial" name="saida_3_inicial"
                                        maxlength="10" required value="{{ $pivos->saida_3_inicial }}">
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="form-row justify-content-start">
                                <div class="form-group ">
                                    <h3>Dados do Pivo:</h3>
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="form-group col-md-4 telo5ce">
                                    <label for="saida_1_intermediario">@lang('pivos.saida1')</label>
                                    <input type="text" class="form-control" id="saida_1_intermediario"
                                        name="saida_1_intermediario" maxlength="50" required
                                        value="{{ $pivos->saida_1_inicial }}">
                                </div>
                                <div class="form-group col-md-4 telo5ce">
                                    <label for="saida_2_intermediario">@lang('pivos.saida2')</label>
                                    <input type="text" class="form-control" id="saida_2_intermediario"
                                        name="saida_2_intermediario" maxlength="10" required
                                        value="{{ $pivos->saida_2_inicial }}">
                                </div>
                                <div class="form-group col-md-4 telo5ce">
                                    <label for="saida_3_intermediario">@lang('pivos.saida3')</label>
                                    <input type="number" class="form-control" id="saida_3_intermediario"
                                        name="saida_3_intermediario" maxlength="10" required
                                        value="{{ $pivos->saida_3_intermediario }}">
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
        @include('_layouts._includes._validators_jquery')
    @endsection
