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
                <h1>@lang('fazendas.fazendas')</h1><br>
                <h4 style="margin-top: -20px">@lang('comum.editar')</h4>
            </div>

            {{-- BOTOES SALVAR E VOLTAR --}}
            <div class="col-6 text-right botoes mobile">
                <a href="{{ route('farms_manager') }}" style="color: #3c8dbc" data-toggle="tooltip"
                    data-placement="bottom" title="Voltar">
                    <button type="button">
                        <span class="fa-stack fa-lg">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fas fa-angle-double-left fa-stack-1x fa-inverse"></i>
                        </span>
                    </button>
                </a>
                <button type="button" id="botaosalvar" data-toggle="tooltip" data-placement="bottom" title="Salvar">
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
            {{-- NAVTAB'S --}}
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="cadastro-tab" data-bs-toggle="tab" role="tab" aria-controls="cadastro"
                        aria-current="page" aria-selected="true" href="#cadastro">@lang('comum.informacoes_navtabs')</a>
                </li>
            </ul>

            {{-- PRELOADER --}}
            <div id="coverScreen">
                <div class="preloader">
                    <i class="fas fa-circle-notch fa-spin fa-2x"></i>
                    <div>@lang('comum.preloader')</div>
                </div>
            </div>

            {{-- FORMULARIO DE CADASTRO --}}
            <form action="{{ route('farm_update') }}" method="POST" class="mt-3" id="formdados">
                <div class="tab-content" id="myTabContent">
                    @include('_layouts._includes._alert')
                    <div class="tab-pane fade show active" id="cadastro" role="tabpanel" aria-labelledby="cadastro-tab">
                        @csrf
                        <input type="hidden" name="id" value="{{ $fazenda->id }}">
                        <div class="col-md-12" id="cssPreloader">
                            <div class="form-row justify-content-start">
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
                                <div class="form-group col-md-3 telo5ce">
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

                            <div class="form-row justify-content-start">
                                <div class="form-group col-md-3 telo5ce">
                                    <label for="cidade">@lang('usuarios.cidade')</label>
                                    <input type="text" class="form-control" id="cidade" name="cidade" maxlength="15"
                                        required value="{{ $fazenda->cidade }}">
                                </div>
                                <div class="form-group col-md-3 telo5ce">
                                    <label for="estado">@lang('usuarios.estado')</label>
                                    <input type="text" class="form-control" id="estado" name="estado" maxlength="15"
                                        required value="{{ $fazenda->estado }}">
                                </div>
                                <div class="form-group col-md-3 telo5ce">
                                    <label for="pais">@lang('usuarios.pais')</label>
                                    <input type="text" class="form-control" id="pais" name="pais" maxlength="15" required
                                        value="{{ $fazenda->pais }}">
                                </div>
                            </div>

                            <div class="form-row justify-content-start">
                                <div class="form-group col-md-3 telo5ce">
                                    <label for="latitude">@lang('fazendas.latitude')</label>
                                    <input type="number" class="form-control" id="latitude" name="latitude" maxlength="100"
                                        required value="{{ $fazenda->latitude }}">
                                </div>
                                <div class="form-group col-md-3 telo5ce">
                                    <label for="longitude">@lang('fazendas.longitude')</label>
                                    <input type="number" class="form-control" id="longitude" name="longitude" maxlength="100"
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

        {{-- SALVAR E VALIDAR CAMPOS VAZIOS --}}
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
        <script>
            $(document).ready(function() {
                $('#botaosalvar').on('click', function() {
                    $('#formdados').submit();
                });

                $("#formdados").validate({
                    rules: {
                        "nome": {
                            required: true,
                        },
                        "cidade": {
                            required: true,
                        },
                        "estado": {
                            required: true,
                        },
                        "pais": {
                            required: true,
                        },
                        "latitude": {
                            required: true,
                        },
                        "longitude": {
                            required: true,
                        },
                        "altitude": {
                            required: true,
                        }
                    },
                    messages: {
                        nome: "@lang('validate.validate')",
                        "cidade": {
                            required: "@lang('validate.validate')"
                        },
                        "estado": {
                            required: "@lang('validate.validate')"
                        },
                        "pais": {
                            required: "@lang('validate.validate')"
                        },
                        "latitude": {
                            required: "@lang('validate.validate')"
                        },
                        "longitude": {
                            required: "@lang('validate.validate')"
                        },
                        "altitude": {
                            required: "@lang('validate.validate')"
                        }
                    },
                    submitHandler: function(form) {
                        $("#coverScreen").show();
                        $("#cssPreloader input").each(function() {
                            $(this).css('opacity', '0.2');
                        });
                        $("#cssPreloader select").each(function() {
                            $(this).css('opacity', '0.2');
                        });
                        form.submit();
                    }
                });
            });

            $(window).on('load', function() {
                $("#coverScreen").hide();
            });

        </script>

        {{-- SCRIPT DE FUNCIONALIDADE DO TOOLTIP --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
        </script>
    @endsection
