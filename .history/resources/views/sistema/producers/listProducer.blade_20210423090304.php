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
