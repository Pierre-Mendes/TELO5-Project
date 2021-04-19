@extends('_layouts._layout_site')
@include('_layouts._includes._head')

@section('head')
@endsection

@section('titulo')

@endsection

@section('topo_detalhe')
<div class="container-fluid topo">
    <div class="row align-items-start">

        {{-- TITULO E SUBTITULO --}}
        <div class="col-6">
            <h1>@lang('fazendas.editar')</h1>
        </div>

        {{-- BOTOES SALVAR E VOLTAR  --}}
        <div class="col-6 text-right botoes">
            <a href="{{ route('fazendas.gerenciar') }}" style="color: #3c8dbc">
                <button type="button">
                    <span class="fa-stack fa-lg">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-angle-double-left fa-stack-1x fa-inverse"></i>
                    </span>
                </button>
            </a>
            <button type="button" id="botaosalvar">
                <span class="fa-stack fa-2x">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="fas fa-save fa-stack-1x fa-inverse"></i>
                </span>
            </button>
        </div>
    </div>
@endsection

@section('conteudo')
    <div>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="cadastro-tab" data-bs-toggle="tab" role="tab" aria-controls="cadastro"
                    aria-current="page" aria-selected="true" href="#cadastro">Geral</a>
            </li>
        </ul>
        <form action="{{ route('fazenda.edita') }}" method="POST" class="mt-3" id="formdados">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="cadastro" role="tabpanel" aria-labelledby="cadastro-tab">
                    @csrf
                    <input type="hidden" name="id" value="{{ $fazenda->id }}">
                    <div class="col-md-12 position">
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-3 telo5ce">
                                <label for="nome">@lang('fazendas.nome')</label>
                                <input type="text" class="form-control" id="nome" name="nome" maxlength="50" required
                                    value="{{ $fazenda->nome }}">
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                <label for="id_proprietario">@lang('fazendas.proprietario')</label>
                                <select name="id_proprietario" id="" required class='form-control'>
                                    @foreach ($proprietarios as $proprietario)
                                        @php
                                            $selecionado = $proprietario->id == $fazenda->id_proprietario ? 'selected' : '';
                                        @endphp
                                        <option value="{{ $proprietario->id }}" {{ $selecionado }}>
                                            {{ $proprietario->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3 position telo5ce">
                                <label for="codigo">@lang('fazendas.consultor')</label>
                                <select name="id_consultor" class="form-control" id="">
                                    @foreach ($consultores as $consultor)
                                        @php
                                            $selecionado = $consultor->id == $fazenda->id_consultor ? 'selected' : '';
                                        @endphp
                                        <option value="{{ $consultor->id }}" {{ $selecionado }}>
                                            {{ $consultor->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-3 telo5ce">
                                <label for="cidade">@lang('usuarios.cidade')</label>
                                <input type="text" class="form-control" id="cidade" name="cidade" maxlength="15" required
                                    value="{{ $fazenda->cidade }}">
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                <label for="estado">@lang('usuarios.estado')</label>
                                <input type="text" class="form-control" id="estado" name="estado" maxlength="15" required
                                    value="{{ $fazenda->estado }}">
                            </div>
                            <div class="form-group col-md-3 position telo5ce">
                                <label for="pais">@lang('usuarios.pais')</label>
                                <input type="text" class="form-control" id="pais" name="pais" maxlength="15" required
                                    value="{{ $fazenda->pais }}">
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-3 telo5ce">
                                <label for="latitude">@lang('fazendas.latitude')</label>
                                <input type="text" class="form-control" id="latitude" name="latitude" maxlength="100"
                                    required value="{{ $fazenda->latitude }}">
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                <label for="longitude">@lang('fazendas.longitude')</label>
                                <input type="text" class="form-control" id="longitude" name="longitude" maxlength="100"
                                    required value="{{ $fazenda->longitude }}">
                            </div>
                            <div class="form-group col-md-3 telo5ce">
                                <label for="altitude">@lang('fazendas.altitude')</label>
                                <input type="text" class="form-control" id="altitude" name="altitude" maxlength="100"
                                    required value="{{ $fazenda->altitude }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#botaosalvar').on('click', function() {
                $('#formdados').submit();
            });
        });

    </script>
    @include('_layouts._includes._validators_jquery')
@endsection
