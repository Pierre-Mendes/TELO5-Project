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
                <h1>@lang('fazendas.fazendas')</h1>
            </div>

            {{-- BOTAO DE CADASTRO --}}
            <div class="col-6 text-right position">
                <a href="{{ route('fazenda.cadastrar') }}">
                    <span><i class="fas fa-plus-circle fa-3x"></i></span>
                </a>
            </div>
        </div>

        {{-- FILTRO DE PESQUISA --}}
        <div class="row justify-content-end telo5inputfiltro mt-3">
            <div class="col-3 position">
                <input class="form-control" id="filtrotabela" type="text" placeholder="Pesquisar..">
                <i class="fas fa-search search"></i>
            </div>
        </div>
    </div>
@endsection

@section('conteudo')
    <div class="col-md-11 m-auto tabela">
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
                            <form action="{{ action('Sistema\CentroCustosController@destroy', $fazenda['id']) }}"
                                method="POST" class="delete_form">
                                {{ csrf_field() }}
                                <a href="{{ route('fazenda.editar', $fazenda->id) }}"><button type="button" class="">
                                        <i class="fas fa-pen"></i></button></a>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class=""><i class="fas fa-times"
                                        style="padding-left: 6px;"></i></button>
                            </form>
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
        @include('_layouts._includes._validators_jquery')
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

        <script>
            // SCRIPT PARA DELETAR LINHA DA TABELA
            $('.delete_form').on('submit', function() {
                if (confirm("Deseja realmente excluir ?")) {
                    return true;
                } else {
                    return false;
                }
            });

        </script>
    @endsection
