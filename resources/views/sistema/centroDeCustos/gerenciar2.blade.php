@extends('_layouts._layout_site')

@section('head')
@endsection

@section('titulo')
    @lang('cdc.centro_de_custos')
@endsection

@section('topo_detalhe')
    texto
@endsection
@section('conteudo')
    <tabela-lista v-bind:titulos="['#','@lang(" cdc.nome")', '@lang("cdc.codigo")' ]"
        v-bind:itens="{{ json_encode($cdcs) }}" ordem="desc" ordemcol="1" criar="{{ route('centrocusto.cadastra') }}"
        editar="{{ route('centrocusto.editar', '') }}/" deletar="{{ route('centrocusto.remover', '') }}/"
        token="{{ csrf_token() }}" modal="sim"></tabela-lista>
    <div align="center" class='row'>
        {{ $cdcs }}
    </div>

    <div class="coll-8 m-auto">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">@lang('cdc.nome')</th>
                    <th scope="col">@lang('cdc.codigo')</th>
                    <th scope="col">@lang('sidenav.acoes')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cdcs as $cdc)
                    <tr>
                        <th scope="row">{{ $cdc->nome }}</th>
                        <td>{{ $cdc->codigo }}</td>
                        <td>
                            <a href="{{url("books/$books->id")}}">
                                <button class="btn btn-dark">Visualizar</button>
                              </a>
                              <a href="">
                                <button class="btn btn-primary">Editar</button>
                              </a>
                              <a href="">
                                <button class="btn btn-danger">Excluir</button>
                              </a>
                            </td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
