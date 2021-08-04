@extends('_layouts._layout_site')

@section('head')
@endsection

@section('topo_detalhe')

    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- TITULO E SUBTITULO --}}
            <div class="col-10">
                <h1>@lang('afericao.afericoesFazenda', ['fazenda' => session()->get('fazenda')['nome']])</h1>
            </div>

            {{-- BOTAO DE CADASTRO --}}
            <div class="col-2 text-right mobile">
                <a href="{{ route('gauging_create') }}" data-toggle="tooltip" data-placement="left"
                    title="Cadastrar Aferição">
                    <span><i class="fas fa-plus-circle fa-3x"></i></span>
                </a>
            </div>
        </div>

        {{-- FILTRO DE PESQUISA --}}
        <div class="row justify-content-end telo5inputfiltro mt-5">
            <div class="col-3 position">
                <form action="{{route('gauging_filter')}}" method="POST" class="form form-inline">
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
    <div class="col-11 m-auto tabela">
        <table class="table table-striped mx-auto" id="filtertable">
            @csrf
            <thead>
                <tr class="text-center">
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
                        @foreach ($pivos as $item)
                            <td value="{{ $item->id }}">{{ $item->resumo }}</td>
                        @endforeach
                        <td>{{ $afericao->numero_lances }}</td>
                        <td class="acoes">
                            <a href="{{ route('gauging_status', $afericao->id) }}"><button type="button" class="botaoTabela"><i class="far fa-chart-bar"></i></button></a>
                            <a href="{{ route('gauging_edit', $afericao->id) }}"><button type="button" class="botaoTabela"> <i class="fas fa-pen"></i></button></a>
                            <button type="submit" class="botaoTabela" data-toggle="modal" data-target="#modalDeletar-{{ $afericao['id'] }}"><i class="fas fa-times"></i></button>

                            <div class="modal fade" id="modalDeletar-{{ $afericao['id'] }}" tabindex="-1"
                                aria-labelledby="modalDeletar" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4>@lang('comum.afericao') {{ $afericao['nome_pivo'] }} / {{ $afericao['pivo'] }}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h4 style="padding-bottom: 20px">@lang('comum.excluir')</h4>
                                            
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

@endsection

@section('scripts')
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