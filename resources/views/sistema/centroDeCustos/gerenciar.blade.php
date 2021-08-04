@extends('_layouts._layout_site')

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- TITULO E SUBTITULO --}}
            <div class="col-6">
                <h1>@lang('cdc.centro_de_custos')</h1><br>
                <h4 style="margin-top: -20px">@lang('comum.gerenciar')</h4>
            </div>

            {{-- BOTAO DE CADASTRO --}}
            <div class="col-6 text-right mobile">
                <a href="{{ route('create_cost_center') }}" data-toggle="tooltip" data-placement="left"
                    title="Cadastrar Cento de custo">
                    <span><i class="fas fa-plus-circle fa-3x"></i></span>
                </a>
            </div>
        </div>

        {{-- FILTRO DE PESQUISA --}}
        <div class="row justify-content-end telo5inputfiltro mt-3">
            <div class="col-3 position">
                <form action="{{route('filter_center_cost')}}" method="POST" class="form form-inline">
                    @csrf
                    <input class="form-control" name="filter" type="text" placeholder="@lang('comum.pesquisar')"/>
                    <button type="submit" class="btn btn-primary search"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('conteudo')
    @include('_layouts._includes._alert')
    <div class="col-md-11 m-auto tabela">
        <table class="table table-striped mx-auto" id="filtertable">
            @csrf
            <thead class="headertable">
                <tr class="text-center">
                    <th>@lang('cdc.nome')</th>
                    <th>@lang('cdc.codigo')</th>
                    <th>@lang('sidenav.acoes')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cdcs as $cdc)
                    <tr>
                        <td>{{ $cdc->nome }}</td>
                        <td>{{ $cdc->codigo }}</td>
                        <td class="acoes">
                            <a href="{{ route('edit_cost_center', $cdc->id) }}"><button type="button"
                                    class="botaoTabela"><i class='fa fa-fw fa-pen'></i></button></a>
                            <button type="submit" class="botaoTabela" data-toggle="modal"
                                data-target="#modalDeletar-{{ $cdc['id'] }}"><i class='fa fa-fw fa-times'></i></button>

                            {{-- MODAL PARA CONFIRMAR DELEÇÃO --}}
                            <div class="modal fade" id="modalDeletar-{{ $cdc['id'] }}" tabindex="-1"
                                aria-labelledby="modalDeletar" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 style="margin: 0">@lang('comum.centrodecusto') {{ $cdc['nome'] }}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h4 style="padding-bottom: 20px">@lang('comum.excluir')</h4>
                                            <form
                                                action="{{ action('Sistema\CentroCustosController@delete', $cdc['id']) }}"
                                                method="POST" class="delete_form float-right"> {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">@lang('comum.nao')</button>
                                                <button type="submit" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#exampleModal">@lang('comum.sim')</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>

            <tfoot>
                <td></td>
                <td></td>
                <td></td>
            </tfoot>
        </table>
    </div>
    <div class="d-flex justify-content-center mb-5">
        {{ $cdcs->links() }}
    </div>


@endsection

@section('scripts')

    {{-- SCRIPT PARA FUNCIONALIDADE DO TOOLTIP --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
@endsection
