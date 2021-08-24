@extends('_layouts._layout_site')
@include('_layouts._includes._head')

@section('head')@endsection

@section('topo_detalhe')

    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- Titlle / Subtitlle --}}
            <div class="col-10 titulo-redimensionamento-mobile">
                <h1>@lang('redimensionamento.redimensionamento', ['fazenda' => session()->get('fazenda')['nome']])</h1>
            </div>

            {{-- Log/Create Button --}}
            <div class="col-2 text-right mobile botoes">
                <button type="button" data-toggle="modal" data-target="#novoRedimensionamento"><i class="fas fa-plus-circle fa-3x"></i></button>
            </div>
        </div>

        {{-- Filter Search --}}
        <div class="row justify-content-end telo5inputfiltro mt-5">
            <div class="col-md-3 position">
                <form action="{{route('resizing_filter')}}" method="POST" class="form form-inline">
                    @csrf
                    <input class="form-control" name="filter" type="text" placeholder="@lang('comum.pesquisar')"/>
                    <button type="submit" class="btn btn-primary search"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('conteudo')
    <div class="table-responsive m-auto tabela">
        <table class="table table-striped mx-auto tabelaRedimensionamento" id="filtertable">
            @csrf
            <thead class="headertable">
                <tr class="text-center">
                    <th style="width: 30%;">@lang('afericao.nomePivo')</th>
                    <th style="width: 15%;">@lang('redimensionamento.dataRedim')</th>
                    <th style="width: 20%;">@lang("afericao.pivo")</th>
                    <th style="width: 15%;">@lang("afericao.numeroLances")</th>
                    <th style="width: 15%;">@lang('sidenav.acoes')</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($redimensionamentos as $redimensionamento)
                    <tr>
                        <td>{{ $redimensionamento->nome_pivo }}</td>
                        <td>{{ $redimensionamento->data_afericao }}</td>
                        <td>{{ $redimensionamento->pivo }}</td>
                        <td>{{ $redimensionamento->numero_lances }}</td>
                        <td class="acoes">
                            <a href="{{ route('resizing_status', $redimensionamento->id) }}"><button type="button" class="botaoTabela"><i class="far fa-chart-bar"></i></button></a>
                            <a href="{{ route('resizing_edit', $redimensionamento->id) }}"><button type="button" class="botaoTabela"><i class="fas fa-pen"></i></button></a>
                            <button type="submit" class="botaoTabela" data-toggle="modal" data-target="#modalDeletar-{{ $redimensionamento['id'] }}"><i class="fas fa-times"></i></button>

                            <div class="modal fade" id="modalDeletar-{{ $redimensionamento['id'] }}" tabindex="-1"
                                aria-labelledby="modalDeletar" aria-hidden="true">
                                <div class="modal-dialog  modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4>
                                                @lang('comum.afericao') {{ $redimensionamento['nome_pivo'] }} / {{ $redimensionamento['pivo'] }}
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h4 style="padding-bottom: 20px">@lang('comum.excluir')</h4>
                                            <form
                                                action="{{ action('Projetos\Redimensionamento\PivoCentral\RedimensionamentoController@delete', $redimensionamento['id']) }}"
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

    <!-- Modal -->
    <div class="modal fade" id="novoRedimensionamento" tabindex="-1" aria-labelledby="novoRedimensionamento"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="novoRedimensionamento">@lang('redimensionamento.novoRedimensionamento')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formulario_enviar" method="POST" class="container" action="{{ route('resizing_create') }}">
                        @csrf
                        <div class="form-group telo5ce">
                            <label for="">@lang('redimensionamento.selecione_o_pivo')</label>
                            <select name="id_afericao" onchange="selecionarPivo()" id="selecao_pivo" data-live-search="true"
                                data-style="btn-primary" class="form-control">
                                <option selected value="">@lang('redimensionamento.nenhum_selecionado')</option>
                                @foreach ($pivos as $pivo)
                                    <option value="{{ $pivo->id }}" data-subtext="{{ $pivo->marca_modelo_pivo }}">
                                        {{ $pivo->nome_pivo }}</option>
                                @endforeach
                            </select>
                            <small class="text-info">@lang('redimensionamento.apenasAfericoesCompletas')</small>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <span slot="botoes"> <button type="submit" id="botaoEnviar" disabled form="formulario_enviar"
                            class="btn btn-outline-primary"><i
                                class="fa fa-fw fa-plus-circle"></i>@lang('unidadesAcoes.criar') </button>
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
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

{{-- SCRIPT DE FUNCIONALIDADE DO TOOLTIP --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
</script>
    <script type="text/javascript">
        function selecionarPivo() {
            if ($("#selecao_pivo").val() !== "") {
                $("#botaoEnviar").removeAttr('disabled');
            } else {
                $("#botaoEnviar").attr('disabled', 'disabled');
            }
        }

    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js"></script>

    <script>

        //Status Column Script
        $('.statsComponent').circleProgress({
            value: 1,
            size: 27,
            fill: {
                color: "#2AFA00"
            }
        }).on('circle-animation-progress', function(event, progress) {
            $(this).find('strong').html(Math.round(24 * progress));
        });

    </script>
@endsection
