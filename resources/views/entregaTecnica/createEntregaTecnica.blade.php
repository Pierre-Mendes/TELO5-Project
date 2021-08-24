@extends('_layouts._layout_site')

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- TITULO E SUBTITULO --}}
            <div class="col-6 titulo-cdc-mobile">
                <h1>@lang('entregaTecnica.entregaTecnica')</h1><br>
                <h4 style="margin-top: -20px">@lang('comum.cadastrar')</h4>
            </div>

            {{-- BOTOES SALVAR E VOLTAR --}}
            <div class="col-6 text-right botoes mobile">
                <a href="{{ route('manage_technical_delivery') }}" style="color: #3c8dbc" data-toggle="tooltip"
                    data-placement="bottom" title="Voltar">
                    <button type="button">
                        <span class="fa-stack fa-lg">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fas fa-angle-double-left fa-stack-1x fa-inverse"></i>
                        </span>
                    </button>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('conteudo')
        {{-- NAVTAB'S --}}
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">@lang('comum.informacoes_navtabs')</a>
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
        <form action="{{ route('save_technical_delivery') }}" method="post" class="mt-3" id="formdados">
            @csrf
            <div class="tab-content" id="myTabContent">
                @include('_layouts._includes._alert')
                <div class="tab-pane fade show active formcdc" id="cadastro" role="tabpanel" aria-labelledby="cadastro-tab">
                    @csrf
                    <div class="col-md-12" id="cssPreloader">
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="proprietario">@lang('entregaTecnica.proprietario')</label>
                                <select name="proprietario" class='form-control' id="proprietario" required='true'>
                                    <option value=""></option>
                                    @foreach ($proprietarios as $proprietario)
                                        <option value="{{ $proprietario->id }}">{{ $proprietario->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="fazenda">@lang('entregaTecnica.fazenda')</label>
                                <select name="id_fazenda" class="form-control" id="fazenda" required>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="cidade">@lang('fazendas.cidade')</label>
                                <input type="text" id="cidade" class="form-control" name="cidade" maxlength="30" required>
                            </div>
                        </div>
                        
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="estado">@lang('fazendas.estado')</label>
                                <input type="text" id="estado" class="form-control" name="estado" maxlength="30" required>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="id_revenda">@lang('entregaTecnica.revenda')</label>
                                <select name="id_revenda" class="form-control" id="id_revenda" required>
                                    @foreach ($revendas as $revenda)
                                        <option value=""></option>
                                        <option value="{{ $revenda->id }}">{{ $revenda->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="id_tecnico">@lang('entregaTecnica.tecnico_responsavel')</label>
                                <select name="id_tecnico" class="form-control" id="id_tecnico" required>
                                    @foreach ($consultores as $consultor)
                                        <option value=""></option>
                                        <option value="{{ $consultor->id }}">{{ $consultor->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="numero_serie">@lang('entregaTecnica.numero_serie')</label>
                                <input type="number" id="numero_serie" class="form-control" name="numero_serie" maxlength="30" required>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="numero_pedido">@lang('entregaTecnica.numero_pedido')</label>
                                <input type="number" id="numero_pedido" class="form-control" name="numero_pedido" maxlength="30" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- BOTOES PARA SALVAR --}}
        <div class="container">
            <div class="row justify-content-center botaoAfericao align-items-end" id="botoesSalvar">
                {{-- <a class="voltar ml-3" href="{{ route('span_back') }}">@lang('unidadesAcoes.anterior')</a> --}}
                <button class="proximo ml-3" name="" type="submit" id="botaosalvar">@lang('unidadesAcoes.salvar')</button>
            </div>
        </div>
@endsection

@section('scripts')
        <script>
            
            $(document).ready(function() {
                $('#proprietario').on('change', function() {
                    var id = $(this).val();

                    $('#fazenda').each(function () {
                        $('#fazenda option').remove();
                    });
                    
                    $.ajax({
                        url: "{{ route('findFarms_technical_delivery') }}",
                        data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                        },
                        type: 'post',
                        success: function(response) 
                        {
                            $.each( response, function(k, v) {
                                $('#fazenda').append($('<option>', {value:k, text:v}));
                                $('#fazenda-selectized').append($('<option>', {value:k, text:v}));
                            });
                        },
                        error: function()
                        {
                            //handle errors
                            alert('error...');
                        }
                    });
                });
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
                    "proprietario": {
                        required: true,
                    },
                    "fazenda": {
                        required: true,
                    },
                    "estado": {
                        required: true,
                    },
                    "id_proprietario": {
                        required: true,
                    },
                    "id_consultor": {
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
                    "id_proprietario": {
                        required: "@lang('validate.validate')"
                    },
                    "id_consultor": {
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
