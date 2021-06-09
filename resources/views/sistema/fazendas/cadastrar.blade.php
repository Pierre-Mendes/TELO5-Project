@extends('_layouts._layout_site')
@include('_layouts._includes._head')

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- TITULO E SUBTITULO --}}
            <div class="col-6">
                <h1>
                    @lang('fazendas.cadastrar_fazenda')</h1>
            </div>

            {{-- BOTOES SALVAR E VOLTAR --}}
            <div class="col-6 text-right botoes position">
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
        <form action="{{ route('farm_save') }}" method="post" class="mt-3" id="formdados">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="cadastro" role="tabpanel" aria-labelledby="cadastro-tab">
                    @csrf
                    <div class="col-md-12 position" id="cssPreloader">
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="nome">@lang('fazendas.nome')</label>
                                <input type="text" id="nome" class="form-control" name="nome" maxlength="50" required>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="id_proprietario">@lang('fazendas.proprietario')</label>
                                <select name="id_proprietario" id="" required class="form-control">
                                    @foreach ($proprietarios as $proprietario)
                                        <option value="{{ $proprietario->id }}">{{ $proprietario->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce position">
                                <label for="codigo">@lang('fazendas.consultor')</label>
                                <select name="id_consultor" class="form-control  position" id="">
                                    @foreach ($consultores as $consultor)
                                        <option value="{{ $consultor->id }}">{{ $consultor->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="cidade">@lang('fazendas.cidade')</label>
                                <input type="text" id="cidade" class="form-control" name="cidade" maxlength="30" required>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="estado">@lang('fazendas.estado')</label>
                                <input type="text" id="estado" class="form-control" name="estado" maxlength="30" required>
                            </div>
                            <div class="form-group col-md-4  position telo5ce">
                                <label for="pais">@lang('fazendas.pais')</label>
                                <input type="text" id="pais" class="form-control  position" name="pais" maxlength="30"
                                    required>
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="latitude">@lang('fazendas.latitude')</label>
                                <input type="text" id="latitude" class="form-control  telo5ce" name="latitude"
                                    maxlength="12" required>
                            </div>

                            <div class="form-group col-md-4 telo5ce">
                                <label for="longitude">@lang('fazendas.longitude')</label>
                                <input type="text" id="longitude" class="form-control telo5ce" name="longitude"
                                    maxlength="12" required>
                            </div>

                            <div class="form-group col-md-4 telo5ce">
                                <label for="altitude">@lang('fazendas.altitude')</label>
                                <input type="number" id="altitude" class="form-control telo5ce" name="altitude"
                                    maxlength="15" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection

@section('scripts')

    {{-- SALVAR E CARREGAR PRELOADER --}}
    <script>
        $(document).ready(function() {
            $('#botaosalvar').on('click', function() {
                $("#coverScreen").show();
                $("#cssPreloader input").each(function() {
                    $(this).css('opacity', '0.2');
                });
                $("#cssPreloader select").each(function() {
                    $(this).css('opacity', '0.2');
                });
                $('#formdados').submit();
            });
        });

        $(window).on('load', function() {
            $("#coverScreen").hide();
        });

    </script>

    <!-- VALIDAÇÕES DE CAMPOS-->
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
                    nome: "Campo <strong>NOME</strong> é obrigatório",
                    "cidade": {
                        required: "Campo <strong>CIDADE</strong> é obrigatório"
                    },
                    "estado": {
                        required: "Campo <strong>ESTADO</strong> é obrigatório"
                    },
                    "pais": {
                        required: "Campo <strong>PAIS</strong> é obrigatório"
                    },
                    "latitude": {
                        required: "Campo <strong>LATITUDE</strong> é obrigatório"
                    },
                    "longitude": {
                        required: "Campo <strong>LONGITUDE</strong> é obrigatório"
                    },
                    "altitude": {
                        required: "Campo <strong>ALTITUDE</strong> é obrigatório"
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

            $(window).on('load', function() {
                $("#coverScreen").hide();
            });
        });

    </script>

    {{-- SCRIPT DE FUNCIONALIDADE DO TOOLTIP --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
@endsection
