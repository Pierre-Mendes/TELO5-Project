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
                <h1>@lang('usuarios.usuarios')</h1><br>
                <h4 style="margin-top: -20px">@lang('comum.gerenciar')</h4>
            </div>

            {{-- BOTAO DE CADASTRO --}}
            <div class="col-6 text-right mobile">
                <a href="{{ route('usuario_create') }}" data-toggle="tooltip" data-placement="left"
                    title="Cadastrar Usuário">
                    <span><i class="fas fa-plus-circle fa-3x"></i></span>
                </a>
            </div>
        </div>

        {{-- FILTRO DE PESQUISA --}}
        <div class="row justify-content-end telo5inputfiltro mt-3">
            <div class="col-3 position">
                <form action="{{route('filter')}}" method="POST" class="form form-inline">
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
                    <th style="width: 15%">@lang('usuarios.nome')</th>
                    <th style="width: 10%">@lang('usuarios.telefone')</th>
                    <th style="width: 10%">@lang('usuarios.pais')</th>
                    <th style="width: 10%">@lang('usuarios.tipo_usuario')</th>
                    <th style="width: 15%">@lang('usuarios.email')</th>
                    <th style="width: 10%">@lang('usuarios.situacao')</th>
                    <th style="width: 10%">@lang('sidenav.acoes')</th>
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
                            <button type="submit" class="botaoTabela" data-toggle="modal" data-target="#status-{{ $usuarios['id']}}"><i class="fas fa-user-check"></i></button>
                            {{-- <a href="{{ route('usuario_status', $usuarios->id) }}"><button type="button" class="botaoTabela"><i class="fas fa-sync"></i></i></button></a> --}}
                            <a href="{{ route('usuario_edit', $usuarios->id) }}"><button type="button" class="botaoTabela"><i class='fa fa-fw fa-pen'></i></button></a>
                            <button type="submit" class="botaoTabela" data-toggle="modal" data-target="#modalDeletar-{{ $usuarios['id']}}"><i class='fa fa-fw fa-times'></i></button>
                            
                            {{-- MODAL PARA ATIVAR/DESATIVAR --}}
                            <div class="modal fade" id="status-{{ $usuarios['id']}}" tabindex="-1" aria-labelledby="status"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 style="margin: 0">@lang('comum.usuario') {{ $usuarios['nome'] }}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h4 style="padding-bottom: 20px">
                                                @if ($usuario->situacao == 'ativo')
                                                    @lang('comum.inativar')
                                                @else 
                                                    @lang('comum.ativar')
                                                @endif
                                            </h4>

                                            <form action="{{ action('Sistema\UsuarioController@UserChangeStatus', $usuarios['id']) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="post">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">@lang('comum.nao')</button>
                                                <button type="submit" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#exampleModal">@lang('comum.sim')</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- MODAL PARA CONFIRMAR DELEÇÃO --}}
                            <div class="modal fade" id="modalDeletar-{{ $usuarios['id']}}" tabindex="-1" aria-labelledby="modalDeletar"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 style="margin: 0">@lang('comum.usuario') {{ $usuarios['nome'] }}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h4 style="padding-bottom: 20px">@lang('comum.excluir')</h4>
                                            <form
                                                action="{{ action('Sistema\UsuarioController@delete', $usuarios['id']) }}"
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
        {{ $listaUsuarios->links() }}
    </div>
@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    {{-- FILTRO DE BUSCA DAS TABELAS --}}
    <script>
        var $rows = $('#filtertable tbody tr');
        $('#filtrotabela').keyup(function() {
            var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

            $rows.show().filter(function() {
                var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                return !~text.indexOf(val);
            }).hide();
        });

    </script>

@endsection
