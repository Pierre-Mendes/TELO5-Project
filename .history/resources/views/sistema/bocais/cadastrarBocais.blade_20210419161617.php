@extends('_layouts._layout_site')
@include('_layouts._includes._head')
@include('_layouts._includes._validators_jquery')

@section('head')@endsection
@section('titulo')@lang('bocais.bocais')@endsection

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- Titlle and Subtitlle --}}
            <div class="col-6">
                <h1>@lang('bocais.bocais')</h1>
            </div>

            {{-- Save button an return button --}}
            <div class="col-6 text-right botoes position">
                <a href="{{ route('bocais.gerenciar') }}" style="color: #3c8dbc">
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
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="cadastro" role="tabpanel" aria-labelledby="cadastro-tab">
                <form action="{{route('bocais.cadastra')}}" method="POST">
                    @csrf
                    <div class="table table-striped mx-auto" id="filtertable">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="fabricante">@lang('bocais.fabricante')</label>
                                <input type="text" name="fabricante" id="fabricante" class="form-control" />
                                <div class="line"></div>
                            </div>
                            <div class="col-md-3">
                                <label for="tipo">@lang('bocais.tipo')</label>
                                <input class="form-control" type="text" name="tipo" id="tipo" />
                                <div class="line"></div>
                            </div>
                            <div class="col-md-3">
                                <label for="modelo">@lang('bocais.modelo')</label>
                                <input class="form-control" type="text" name="modelo" id="modelo" />
                                <div class="line"></div>
                            </div>

                            <div class="col-md-3">
                                <label >@lang('bocais.plug')</label>
                                <select>
                                    <option value='0'>@lang('bocais.nao')</option>
                                    <option value='1'>@lang('bocais.sim')</option>
                                </select>
                            </div>
                        </div>
                    </div>

                        <table class="table table-striped mx-auto" id="filtertable">
                            <thead class="headertable">
                                <tr class="text-center">
                                    <th scope="col-5">@lang('bocais.nome')</th>
                                    <th scope="col-5">@lang('bocais.vazao_10_psi')</th>
                                    <th scope="col-5">@lang('bocais.intervalo_trabalho')</th>
                                    <th scope="col-2">@lang('bocais.acoes')</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td><input type="text" /></td>
                                    <td><input type="text" /></td>
                                    <td><input type="text" /></td>
                                    <td><input type="text" /></td>
                                </tr>
                            </tbody>

                            <tfoot>

                            </tfoot>
                        </table>
                        <div colspan="9" class="text-left" style="padding: 10px">
                                <button class="btn btn-outline-primary " type="button" data-toggle="modal" data-target="#modalAddBocal" data-whatever=""><i class="fa fa-fw fa-plus"></i>@lang('bocais.addBocal')</button>
                        </div>

                    <div class="text-center">
                        <button type="submit" value="salvar" name="botao_form" id="btnSalvar" class="btn btn-outline-primary"> @lang('unidadesAcoes.salvar')</button>
                        <button type="submit" value="sair" name="botao_form" id="btnSalvarBocais" class="btn btn-outline-primary"> @lang('unidadesAcoes.salvarSair')</button>
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
@endsection
