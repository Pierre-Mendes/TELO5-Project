@extends('_layouts._layout_site')

@section('topo_detalhe')
@endsection

@section('conteudo')
    @if (empty(session()->has('fazenda') ))
        <div class="alert alert-dismissible fade show" role="alert" style="color: red; font-weigth: bold;">
            {!! Session::get('error') !!}
        </div>
    @endif

    <br/><br/>
    @include('_layouts._includes._alert')

    <img src="{{ asset('img/logo_telo5.png') }}" alt="" style="position: absolute; margin-left: 30%; opacity: 0.5;" width="35%">
@endsection
