@extends('_layouts._layout_site')
@include('_layouts._includes._head')

@section('head')
@endsection

@section('titulo')
    @lang('proprietarios.proprietarios')
@endsection

@section('topo_detalhe')
    <div style="display:inline-block">
        <p>teste</p>
    </div>
    <div style="float: right;  margin-top: -30px; padding-right: 20px">
        <a href="{{ route('proprietario.cadastrar') }}">
            <span><i class="fas fa-plus-circle fa-3x"></i></span>
        </a>
    </div>
@endsection

@section('conteudo')
    <div class="col-10 m-auto tabela">
        <table class="table table-striped mx-auto">
            @csrf
            <thead>
                <tr>
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
                            <form action="{{ action('Sistema\ProprietarioController@destroy', $proprietario['id']) }}"
                                method="POST" class="delete_form">
                                {{ csrf_field() }}
                                <a href="{{ route('proprietario.editar', $proprietario->id) }}"><button type="button" class=""><i
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
            </tfoot>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        $('.delete_form').on('submit', function() {
            if (confirm("Deseja realmente excluir ?")) {
                return true;
            } else {
                return false;
            }
        });

    </script>
    @include('_layouts._includes._validators_jquery')
@endsection
