@extends(' _layouts._layout_site ')
@include(' _layouts._includes._head ')
@section(' head ')
@section('titulo')@lang(' bocais.bocais ')@endsection

@section(' topo_detalhe ')

<div class="container-fluid top">
    <div class="row align-items-start">

        {{-- Titlle Subtitlle --}}
        <div class="col-6">
            <h1>@lang('Proprietários')</h1>
        </div>

        {{-- Log Button --}}
        <div class="col-6 text-right position">
            <a href="{{ route('proprietario.cadastrar') }}">
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

@section(' conteudo ')
<div class="col-md-11 m-auto tabela">
    <table class="table table-striped mx-auto" id="filtertable">
        @csrf
        <thead class="headertable">
            <tr class="text-center">
                <th scope="col-5">@lang(' bocais.# ')</th>
                <th scope="col-5">@lang(' bocais.fabricante ')</th>
                <th scope="col-5">@lang(' bocais.modelo ')</th>
                <th scope="col-2">@lang(' sidenav.acoes ')</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($fabricantes as $fabricante)
                <tr>
                    <td>{{ $fabricante->id }}</td>
                    <td>{{ $fabricante->fabricante }}</td>
                    <td>{{ $fabricante->modelo }}</td>
                    <td class="acoes">
                        <form action="{{ action('Sistema\BocalController@destroy', $fabricante['id']) }}"
                            method="POST" class="delete_form">
                            {{ csrf_field() }}
                            
                            <a href="{{ route('proprietario.editar', $proprietario->id) }}"><button type="button" class=""><i
                                    class='fa fa-fw fa-pen'></i></button></a>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class=""><i class='fa fa-fw fa-times'></i></button>
                        </form>
                    </td>

@endsection


