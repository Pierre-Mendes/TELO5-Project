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
                <a href="{{ route('gauging_create') }}" data-toggle="tooltip" data-placement="left"
                    title="Cadastrar Aferição">
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

    <div class="col-8 m-auto tabela">
        <table class="table table-striped mx-auto mt-5">
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
                            <a href="{{ route('gauging_status', $afericao->id) }}"><button type="button" class="botaoTabela"><i class="far fa-chart-bar"></i></button></a>
                            <a href="{{ route('gauging_edit', $afericao->id) }}"><button type="button" class="botaoTabela"> <i class="fas fa-pen"></i></button></a>
                            <button type="submit" class="botaoTabela" data-toggle="modal" data-target="#modalDeletar-{{ $afericao['id'] }}"><i class="fas fa-times"></i></button>

                            <div class="modal fade" id="modalDeletar-{{ $afericao['id'] }}" tabindex="-1"
                                aria-labelledby="modalDeletar" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4>@lang('comum.afericao') {{ $afericao['id'] }} <br> @lang('comum.excluir') </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form
                                                action="{{ action('Projetos\Afericao\PivoCentral\AfericaoPivoCentralController@delete', $afericao['id']) }}"
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
