@extends('_layouts._layout_site')
@include('_layouts._includes._head')

@section('head')@endsection
@section('titulo')@lang('bocais.bocais')@endsection

@section('topo_detalhe')

<div class="container-fluid topo">
    <div class="row align-items-start">

        {{-- Titlle Subtitlle --}}
        <div class="col-6">
            <h1>@lang('bocais.bocais')</h1>
        </div>

        {{-- Log Button --}}
        <div class="col-6 text-right position">
            <a href="{{ route('bocais.cadastrar') }}">
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
<div class="col-md-10 m-auto tabela">
    <table class="table table-striped mx-auto" id="filtertable">
        @csrf
        <thead class="headertable">
            <tr class="text-center">
                <th scope="col-5">@lang('bocais.#')</th>
                <th scope="col-5">@lang('bocais.fabricante')</th>
                <th scope="col-2">@lang('sidenav.acoes')</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($producers as $producer)
                <tr>
                    <td>{{ $producer->id }}</td>
                    <td>{{ $producer->fabricante }}</td>
                    <td class="acoes">
                        <form action="{{ action('Sistema\BocalController@destroy', $fabricante['id']) }}"
                            method="POST" class="delete_form">
                            {{ csrf_field() }}

                            <a href="{{ route('bocais.editar', $fabricante->id) }}"><button type="button" class=""><i
                                    class='fa fa-fw fa-pen'></i></button></a>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class=""><i class='fa fa-fw fa-times'></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
