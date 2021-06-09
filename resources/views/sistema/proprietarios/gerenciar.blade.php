@extends('_layouts._layout_site')
@include('_layouts._includes._head')

@section('topo_detalhe')

    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- TITULO --}}
            <div class="col-6">
                <h1>@lang('proprietarios.administrar_proprietarios')</h1>
            </div>

            {{-- BOTÃO DE CADASTRAR --}}
            <div class="col-6 text-right position">
                <a href="{{ route('owner_create') }}" data-toggle="tooltip" data-placement="left"
                    title="Cadastrar Proprietário">
                    <span><i class="fas fa-plus-circle fa-3x"></i></span>
                </a>
            </div>
        </div>

        {{-- FILTRO DE PESQUISA --}}
        <div class="row justify-content-end telo5inputfiltro mt-3">
            <div class="col-3 position">
                <input class="form-control" id="filtrotabela" type="text" placeholder="@lang('comum.pesquisar')">
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
                    <th scope="col-5">@lang('proprietarios.nome')</th>
                    <th scope="col-5">@lang('proprietarios.tipo_pessoa')</th>
                    <th scope="col-5">@lang('proprietarios.documento')</th>
                    <th scope="col-5">@lang('proprietarios.telefone')</th>
                    <th scope="col-5">@lang('proprietarios.email')</th>
                    <th scope="col-2">@lang('sidenav.acoes')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proprietarios as $proprietario)
                    <tr>
                        <td>{{ $proprietario->nome }}</td>
                        <td>{{ $proprietario->tipo_pessoa }}</td>
                        <td>{{ $proprietario->documento }}</td>
                        <td>{{ $proprietario->telefone }}</td>
                        <td>{{ $proprietario->email }}</td>
                        <td class="acoes">
                            <a href="{{ route('owner_edit', $proprietario->id) }}"><button type="button"
                                class="botaoTabela"><i class='fa fa-fw fa-pen'></i></button></a>
                            <button type="submit" class="botaoTabela" data-toggle="modal" data-target="#modalDeletar-{{ $proprietario['id'] }}"><i class='fa fa-fw fa-times'></i></button>

                            <div class="modal fade" id="modalDeletar-{{ $proprietario['id'] }}" tabindex="-1" aria-labelledby="modalDeletar" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4>@lang('comum.proprietario') {{ $proprietario['nome'] }} <br> @lang('comum.excluir') </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ action('Sistema\ProprietarioController@delete', $proprietario['id']) }}" method="POST"
                                                class="delete_form float-right"> {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('comum.nao')</button>
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
            </tfoot>
        </table>
    </div>



    <div class="d-flex justify-content-center">
        {{ $proprietarios->links() }}
    </div>
@endsection

{{-- *************************************************** --}}
{{-- Start of the JS scripts on this page --}}
@section('scripts')
    <script>

        {{-- FILTRO DE BUSCA DAS TABELAS --}}
        var $rows = $('#filtertable tbody tr');
        $('#filtrotabela').keyup(function() {
            var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

            $rows.show().filter(function() {
                var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                return !~text.indexOf(val);
            }).hide();
        });

    </script>

    {{-- SCRIPT PARA FUNCIONALIDADE DO TOOLTIP --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
@endsection
