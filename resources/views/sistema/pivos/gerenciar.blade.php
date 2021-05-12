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
            <h1>@lang('pivos.pivos')</h1>
        </div>

        {{-- BOTAO DE CADASTRO --}}
        <div class="col-6 text-right position">
            <a href="{{ route('pivos.cadastrar') }}">
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
    <div class="col-10 m-auto tabela">
        <table class="table table-striped mx-auto">
            @csrf
            <thead class="headertable">
                <tr class="text-center">
                    <th scope="col-5">@lang('pivos.fabricante')</th>
                    <th scope="col-5">@lang('pivos.nome')</th>
                    <th scope="col-5">@lang('pivos.espacamento')</th>
                    <th scope="col-2">@lang('sidenav.acoes')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pivos as $pivo)
                    <tr>
                        <td>{{ $pivo->fabricante }}</td>
                        <td>{{ $pivo->nome }}</td>
                        <td>{{ $pivo->espacamento }}</td>
                        <td class="acoes">
                            <form action="{{ action('Sistema\PivoController@destroy', $pivo['id']) }}"
                                method="POST" class="delete_form">
                                {{ csrf_field() }}
                                <a href="{{ route('pivos.editar', $pivo->id) }}"><button type="button" class=""><i
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
