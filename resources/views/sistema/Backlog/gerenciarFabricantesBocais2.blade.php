@extends('_layouts._layout_site')

@section('titulo')
    @lang('bocais.fabricantes_bocais')
@endsection

@section('conteudo')

    <tabela-lista
        v-bind:titulos="['#','@lang("bocais.fabricante")', '@lang("bocais.modelo")']"
        v-bind:itens="{{json_encode($fabricantes)}}"
        ordem="desc" ordemcol="1"
        criarpage="{{route('bocais.cadastrar')}}" editarpage="{{route('bocais.editar', '')}}/" token="{{ csrf_token() }}"
        modal="sim"
    ></tabela-lista>

    <page name=criarpage></page>
    <page name="editarpage"></page>
@endsection

@section('scripts')
    @include('_layouts._includes._validators_jquery')

    <script type="text/javascript">
    </script>

@endsection