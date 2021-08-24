@extends('_layouts._layout_site')
@include('_layouts._includes._head')

@section('head')
@endsection

@section('titulo')

@endsection

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- TITULO E SUBTITULO --}}
            <div class="col-6">
                <h1>@lang('fazendas.fazendas')</h1><br>
                <h4 style="margin-top: -20px">@lang('comum.gerenciar')</h4>
            </div>

            {{-- BOTAO DE CADASTRO --}}
            <div class="col-6 text-right mobile">
                <a href="{{ route('farm_create') }}" data-toggle="tooltip" data-placement="left"
                    title="Cadastrar Fazenda">
                    <span><i class="fas fa-plus-circle fa-3x"></i></span>
                </a>
            </div>
        </div>

        {{-- FILTRO DE PESQUISA --}}
        <div class="row justify-content-end telo5inputfiltro mt-3">
            <div class="col-md-3 position">
                <form action="{{route('filter_farm')}}" method="POST" class="form form-inline">
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
    <div class="table-responsive m-auto tabela">
        <table class="table table-striped mx-auto" id="filtertable">
            @csrf
            <thead class="headertable">
                <tr class="text-center">
                    <th>@lang('fazendas.nome')</th>
                    <th>@lang('fazendas.cidade')</th>
                    <th>@lang('fazendas.estado')</th>
                    <th>@lang('fazendas.pais')</th>
                    <th>@lang('fazendas.proprietario')</th>
                    <th>@lang('fazendas.status')</th>
                    <th>@lang('sidenav.acoes')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fazendas as $fazenda)
                    <tr>
                        <td>{{ $fazenda->nome }}</td>
                        <td>{{ $fazenda->cidade }}</td>
                        <td>{{ $fazenda->estado }}</td>
                        <td>{{ $fazenda->pais }}</td>
                        <td>{{ $fazenda->nome_prop }}</td>
                        <td>{{ $fazenda->ativa }}</td>
                        <td class="acoes">
                            <a href="{{ route('farm_edit', $fazenda->id) }}"><button type="button" class="botaoTabela">
                                    <i class="fas fa-pen"></i></button></a>
                            <button type="submit" class="botaoTabela" data-toggle="modal" data-target="#modalDeletar-{{ $fazenda['id']}}"><i class="fas fa-times" style="padding-left: 6px;"></i></button>

                            {{-- MODAL PARA CONFIRMAR DELEÇÃO --}}
                            <div class="modal fade" id="modalDeletar-{{ $fazenda['id'] }}" tabindex="-1"
                                aria-labelledby="modalDeletar" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                                
                                            <h4 style="margin: 0">@lang('comum.fazenda'){{ $fazenda['nome'] }}<br></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                                <h4 style="padding-bottom: 20px">@lang('comum.excluir')</h4>
                                            <form
                                                action="{{ action('Sistema\FazendaController@deleteFarm', $fazenda['id']) }}"
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
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tfoot>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $fazendas->links() }}
    </div>

@endsection



@section('scripts')
    <script>
        // SCRIPT DE FILTRO DE BUSCA DA TABELA
        $(document).ready(function() {
            $("#filtrotabela").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#filtertable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

    </script>

    {{-- SCRIPT DE FUNCIONALIDADE DO TOOLTIP --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
@endsection
