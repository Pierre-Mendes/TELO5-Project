@extends('_layouts._layout_site')

@section('topo_detalhe')

    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- TITULO E SUBTITULO --}}
            <div class="col-6">
                <h1>
                    @lang('entregaTecnica.entregaTecnica')
                </h1>
            </div>
        </div>
    </div>
@endsection

@section('conteudo')
    <div class="col-md-12">
        @include('_layouts._includes._alert')
        <div class="form-row justify-content-center">
            <a href="{{ route('create_technical_delivery') }}" class="form-group col-md-3 text-center entregaTecnica-botoes">
                <button type="submit" >
                    @lang('entregaTecnica.nova')
                </button>
            </a>
        </div>
        <div class="form-row justify-content-center">
            <a href="#" class="form-group col-md-3 text-center entregaTecnica-botoes">
                <button type="submit" >
                    @lang('entregaTecnica.continuar')
                </button>
            </a>
        </div>
        <div class="form-row justify-content-center">
            <a href="#" class="form-group col-md-3 text-center entregaTecnica-botoes">
                <button type="submit" >
                    @lang('entregaTecnica.aprovar')
                </button>
            </a>
        </div>
        <div class="form-row justify-content-center">
            <a href="#" class="form-group col-md-3 text-center entregaTecnica-botoes">
                <button type="submit" >
                    @lang('entregaTecnica.historico')
                </button>
            </a>
        </div>
    </div>
@endsection