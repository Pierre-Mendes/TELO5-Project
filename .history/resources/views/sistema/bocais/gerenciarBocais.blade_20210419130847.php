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
</div>
@endsection


