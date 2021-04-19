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
                <h1>@lang('usuarios.usuarios')</h1>
            </div>

            {{-- BOTAO DE CADASTRO --}}
            <div class="col-6 text-right position">
                <a href="{{ route('usuario.cadastrar') }}">
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
                    <th scope="col-5">@lang('usuarios.nome')</th>
                    <th scope="col-5">@lang('usuarios.telefone')</th>
                    <th scope="col-5">@lang('usuarios.pais')</th>
                    <th scope="col-5">@lang('usuarios.tipo_usuario')</th>
                    <th scope="col-5">@lang('usuarios.email')</th>
                    <th scope="col-5">@lang('usuarios.situacao')</th>
                    <th scope="col-2">@lang('sidenav.acoes')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listaUsuarios as $usuarios)
                    <tr>
                        <td>{{ $usuarios->nome }}</td>
                        <td>{{ $usuarios->telefone }}</td>
                        <td>{{ $usuarios->pais }}</td>
                        <td>{{ $usuarios->tipo_usuario }}</td>
                        <td>{{ $usuarios->email }}</td>
                        <td>{{ $usuarios->situacao }}</td>
                        <td class="acoes">
                            <form action="{{ action('Sistema\UsuarioController@destroy', $usuarios['id']) }}"
                                method="POST" class="delete_form">
                                {{ csrf_field() }}
                                <a href="{{ route('usuario.editar', $usuarios->id) }}"><button type="button" class=""><i
                                            class='fa fa-fw fa-pen'></i></button></a>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class=""><i class='fa fa-fw fa-times'></i></button>
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
        {{ $listaUsuarios->links() }}
    </div>
@endsection


@section('scripts')

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
@endsection
