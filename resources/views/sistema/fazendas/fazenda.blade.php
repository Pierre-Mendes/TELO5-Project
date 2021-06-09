@extends('_layouts._layout_site')
@section('head')
@endsection

@section('conteudo1')
    @csrf
    @foreach ($fazendas1 as $fazenda)
        <a href="{{ route('dashboard') }}">
            <option value="">{{ $fazenda->nome }}</option>
        </a>
    @endforeach
@endsection
