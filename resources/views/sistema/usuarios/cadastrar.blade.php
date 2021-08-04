@extends('_layouts._layout_site')
@include('_layouts._includes._head')

@section('head')

@endsection

@section('titulo')
    @lang('usuarios.usuarios')
@endsection

@section('topo_detalhe')

    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- TITULO E SUBTITULO --}}
            <div class="col-6">
                <h1>@lang('usuarios.usuarios')</h1>
                <h4 style="margin-top: -2px">@lang('comum.cadastrar')</h4>
            </div>

            {{-- BOTOES SALVAR E VOLTAR --}}
            <div class="col-6 text-right botoes mobile">
                <a href="{{ route('usuarios_manager') }}" style="color: #3c8dbc" data-toggle="tooltip"
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
        <form action="{{ route('usuario_save') }}" method="post" class="mt-3" id="formdados" autocomplete="off">

            <div class=" tab-content" id="myTabContent">
                    @include('_layouts._includes._alert')
                <div class="tab-pane fade show active" id="cadastro" role="tabpanel" aria-labelledby="cadastro-tab">
                    @csrf
                    <div class="col-12" id="cssPreloader">

                        <div class="form-row justify-content-center">
                            <div class="form-group col-3 telo5ce">
                                <label for="nome">@lang('usuarios.nome')</label>
                                <input type="text" class="form-control telo5ce" id="nome" name="nome" maxlength="50">
                            </div>
                            <div class="form-group col-3 telo5ce">
                                <label for="tipo_usuario">@lang('usuarios.tipo_usuario')</label><br>
                                <select onchange="trocarDivAtivaSuperior()" name="tipo_usuario" id="tipo_usuario" required class="form-control telo5ce">
                                    @foreach ($papeis as $papel)
                                        <option value=""></option>
                                        <option value="{{ $papel['chave'] }}">@lang($papel['valor'])</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-3 telo5ce">
                                <label for="telefone">@lang('usuarios.telefone')</label>
                                <input type="tel" class="form-control" id="telefone" name="telefone" maxlength="15">
                            </div>
                            <div class="form-group col-3 telo5ce">
                                <label for="pais">@lang('usuarios.pais')</label><br>
                                <input type="text" class="form-control" id="pais" name="pais" maxlength="60">
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="form-group col-3 telo5ce">
                                <label for="cep">@lang('usuarios.cep')</label>
                                <input type="tel" class="form-control telo5ce" id="cep" name="cep" maxlength="10">
                            </div>
                            <div class="form-group col-3 telo5ce">
                                <label for="rua">@lang('usuarios.rua')</label>
                                <input type="text" class="form-control telo5ce" id="rua" name="rua" maxlength="100">
                            </div>
                            <div class="form-group col-3 telo5ce">
                                <label for="cidade">@lang('usuarios.cidade')</label>
                                <input type="text" class="form-control telo5ce" id="cidade" name="cidade"  maxlength="60">
                            </div>
                            <div class="form-group col-3 telo5ce">
                                <label for="estado">@lang('usuarios.estado')</label>
                                <input type="text" class="form-control" id="estado" name="estado" maxlength="60">
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="form-group col-3 telo5ce">
                                <label for="email">@lang('usuarios.email')</label>
                                <input type="email" class="form-control" id="email" name="email" maxlength="100">
                            </div>
                            <div class="form-group col-3 telo5ce">
                                <label for="password">@lang('usuarios.senha')</label>
                                <input type="password" class="form-control" id="password" name="password" maxlength="20">
                            </div>
                            <div class="form-group col-3 telo5ce">
                                <label for="confirmar_senha">@lang('usuarios.confirmar_senha')</label>
                                <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha"
                                    maxlength="20">
                            </div>
                            <div class="form-group col-3 telo5ce">
                                <label for="configuracao_idioma">@lang('usuarios.idioma')</label><br>
                                <select required name="configuracao_idioma" id="configuracao_idioma"
                                    class="form-control telo5ce">
                                    @foreach ($idiomas as $idioma)
                                        <option value=""></option>
                                        <option value="{{ $idioma['chave'] }}">{{ $idioma['valor'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row justify-content-start">
                            <div class="form-group col-3 telo5ce">
                                <div id='divSupervisor' style="display: none;">
                                    <label for="tipo_usuario">@lang('usuarios.superior')</label>
                                    <select name="superior_s" id="superior_s" class='form-control' required>
                                        @foreach ($usuarios_superiores as $item)
                                            @if ($item->tipo_usuario == 1)
                                                <option value=""></option>
                                                <option value="{{ $item->id }}">{{ $item->nome }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="line"></div>
                                </div>

                                <div id='divConsultor' style="display: none;">
                                    <label for="tipo_usuario">@lang('usuarios.superior')</label>
                                    <select name="superior_c" id="superior_c" class='form-control' required>
                                        @foreach ($usuarios_superiores as $item)
                                            @if ($item->tipo_usuario == 1 || $item->tipo_usuario == 2)
                                                <option value=""></option>
                                                <option value="{{ $item->id }}">{{ $item->nome }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="line"></div>
                                </div>

                                <div id='divAssistente' style="display: none;">
                                    <label for="tipo_usuario">@lang('usuarios.superior')</label>
                                    <select id="superior_a" name="superior_a" class='form-control' required>
                                        @foreach ($usuarios_superiores as $item)
                                            @if ($item->tipo_usuario == 3)
                                                <option value=""></option>
                                                <option value="{{ $item->id }}">{{ $item->nome }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="line"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row justify-content-start">
                            <div class='form-group col-3'>
                                <div class='form-group telo5ce' id="divCentroCusto">
                                    <label for="cdcs">@lang('usuarios.centrodecustos')</label>
                                    <select class="form-control" name="cdcs[]" id="cdcs">
                                        @foreach ($cdcs as $item)
                                            <option value=""></option>
                                            <option value="{{ $item->id }}">{{ $item->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('scripts')

    {{-- FILTRO SELECT --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
    integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

    {{-- MASCARA DE INPUT --}}
    <script src="{{ asset('js/jquery.mask.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#telefone').mask('(00) 00000-0000');
            $('#cep').mask('00000-000');
        });

    </script>

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
                        required: true
                    },
                    "tipo_usuario": {
                        required: true
                    },
                    "telefone": {
                        required: true
                    },
                    "pais": {
                        required: true
                    },
                    "email": {
                        required: true,
                        email: true
                    },
                    "password": {
                        required: true
                    },
                    "confirmar_senha": {
                        required: true
                    },
                    "configuracao_idioma": {
                        required: true
                    }
                },
                messages: {
                    nome: "@lang('validate.validate')",

                    "tipo_usuario": {
                        required: "@lang('validate.validate')"
                    },
                    "telefone": {
                        required: "@lang('validate.validate')"
                    },
                    "pais": {
                        required: "@lang('validate.validate')"
                    },
                    "email": {
                        required: "@lang('validate.validate')"
                    },
                    "password": {
                        required: "@lang('validate.validate')"
                    },
                    "confirmar_senha": {
                        required: "@lang('validate.validate')"
                    },
                    "configuracao_idioma": {
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
            

            $(window).on('load', function() {
                $("#coverScreen").hide();
            });

        });

    </script>

    {{-- SCRIPT DE FUNCIONALIDADE DO TOOLTIP --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <!-- Includes to combobox style -->
    <script type="text/javascript">
        $(document).ready(function() {
            trocarDivAtivaSuperior();
            etrocarDivAtivaSuperior();
            $('#edivSuperiores').show();

            $("#formdados").submit(function(e) {
                if (!checkIfPasswordsMatch()) {
                    alert("{{ __('usuarios.senhasNaoBatem') }}");
                    return false;
                }
            });
        });


        function trocarDivAtivaSuperior() {
            var papel = $('#tipo_usuario').val();
            togleDivCentroCustos(papel);
            var divAssist = $('#divAssistente');
            var divConsult = $('#divConsultor');
            var divSup = $('#divSupervisor');
            var fieldAssist = $("#superior_a");
            var fieldConsult = $("#superior_c");
            var fieldSup = $("#superior_s");
            if (papel == 2) {
                divAssist.hide();
                divConsult.hide();
                divSup.show();
                fieldAssist.removeAttr('required');
                fieldConsult.removeAttr('required');
                fieldSup.attr('required', 'required');
            } else if (papel == 3) {
                divAssist.hide();
                divConsult.show();
                divSup.hide();
                fieldAssist.removeAttr('required');
                fieldSup.removeAttr('required');
                fieldConsult.attr('required', 'required');
            } else if (papel == 4) {
                divAssist.show();
                divConsult.hide();
                divSup.hide();
                fieldSup.removeAttr('required');
                fieldConsult.removeAttr('required');
                fieldAssist.attr('required', 'required');
            } else {
                divAssist.hide();
                divConsult.hide();
                divSup.hide();
                fieldSup.removeAttr('required');
                fieldConsult.removeAttr('required');
                fieldAssist.removeAttr('required');
            }
        }

        function togleDivCentroCustos(papel) {
            var divCDC = $('#divCentroCusto');
            if (papel == 0) {
                divCDC.hide();
                $("#cdcs").removeAttr('required');
            } else {
                divCDC.show();
                $("#cdcs").attr('required', 'required');
            }
        }

        function checkIfPasswordsMatch() {
            let senha1 = $("#password").val();
            let senha2 = $("#confirmpassword").val();
            if (senha1 !== "" && senha1 === senha2) {
                return true;
            } else {
                return false;
            }
        }

    </script>

    <script type="text/javascript">
        window.onload = function() {
            if (!empty($filtro['tipo_usuario'])) '{{ $filtro['tipo_usuario'] }}'
            else ''
            endif).change();
        }
        $('#editar').on('shown.bs.modal', function(e) {
            $("#ecdcs").selectpicker('refresh');
        });

    </script>
@endsection
