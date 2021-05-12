@extends('_layouts._layout_site')

@section('head')
@endsection

@section('topo_detalhe')

<div class="container-fluid topo">
    <div class="row align-items-start">

        {{-- TITULO E SUBTITULO --}}
        <div class="col-6">
            <h1>@lang('afericao.afericoesFazenda', ['fazenda' => session()->get('fazenda')['nome']])</h1>
        </div>

        {{-- BOTAO DE CADASTRO --}}
        <div class="col-6 text-right position">
            <a href="{{ route('afericoes.pivo.central.cadastrar') }}">
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

    <div class="col-8 m-auto tabela">
        <table class="table table-striped mx-auto">
            @csrf
            <thead>
                <tr>
                    <th>@lang('afericao.nomePivo')</th>
                    <th>@lang('afericao.dataAfericao')</th>
                    <th>@lang('afericao.pivo')</th>
                    <th>@lang('afericao.numeroLances')</th>
                    <th>@lang('sidenav.acoes')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($afericoes as $afericao)
                    <tr>
                        <td>{{ $afericao->nome_pivo }}</td>
                        <td>{{ $afericao->data_afericao }}</td>
                        <td>{{ $afericao->pivo }}</td>
                        <td>{{ $afericao->numero_lances }}</td>
                        <td class="acoes">
                            <form action="{{ action('Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@destroy', $afericao['id']) }}"
                                method="POST" class="delete_form">
                                {{ csrf_field() }}
                                <a href="{{ route('status_afericao', $afericao->id) }}"><button type="button"><i class="far fa-chart-bar"></i></button></a>
                                <a href="{{ route('afericoes.pivo.central.editar', $afericao->id) }}"><button type="button" class="">
                                        <i class="fas fa-pen"></i></button></a>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class=""><i class="fas fa-times"></i></button>
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
            </tfoot>
        </table>
    </div>

    <script>
        $('.delete_form').on('submit', function() {
            if (confirm("Deseja realmente excluir ?")) {
                return true;
            } else {
                return false;
            }
        });

    </script>

@endsection

@section('scripts')
@endsection
