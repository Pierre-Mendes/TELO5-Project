@extends('_layouts._layout_site')

@section('titulo')
    @lang('afericao.velocidadeAfericao')
@endsection

@section('topo_detalhe')

    <div class="container-fluid topo">
        <div class="row align-items-start">
            {{-- TITULO E SUBTITULO --}}
            <div class="col-6 titulo-velocidade-mobile">
                <h1>@lang('afericao.velocidadeAfericao')</h1>
                <h4>@lang('comum.cadastrar')</h4>
            </div>

            {{-- BOTOES SALVAR E VOLTAR --}}
            <div class="col-6 text-right botoes mobile">
                <a href="{{ route('gauging_status', $id_afericao) }}" style="color: #3c8dbc" data-toggle="tooltip"
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
    <div class="formafericao">
        {{-- NAVTAB'S --}}
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="percentimetro-tab" data-toggle="tab" href="#afericoes" role="tab"
                    aria-controls="afericoes" aria-selected="true">@lang('afericao.velocidade100')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="percentimetro-tab" data-toggle="tab" href="#percentimetro" role="tab"
                    aria-controls="percentimetro" aria-selected="true">@lang('afericao.percentimetro')</a>
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
        <form action="{{ route('gauging_speed_save', $id_afericao) }}" id="formdados" method="POST">
            @csrf
            <input type="hidden" name="id_afericao" value={{ $id_afericao }} />
            <div class="tab-content small.required tab-validate mt-5" id="myTabContent">
                @include('_layouts._includes._alert')
                <div class="tab-pane fade show active" id="afericoes" role="tabpanel" aria-labelledby="afericoes-tab">
                    <div class="col-12 m-auto tabela" id="cssPreloader">
                        <table class="table table-striped mx-auto text-center" id="tabelaTrechos">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">@component('_layouts._components._inputLabel', ['texto' => __('afericao.tempoMinuto') . __('unidadesAcoes.(min)'), 'id' => 'minuto01'])@endcomponent</th>
                                    <th scope="col">@component('_layouts._components._inputLabel', ['texto' => __('afericao.tempoSegundoMilissegundo') . __('unidadesAcoes.(s:ms)'), 'id' => 'segundo01'])@endcomponent</th>
                                    <th scope="col">@component('_layouts._components._inputLabel', ['texto' => __('afericao.distanciaM') . __('unidadesAcoes.(m)'), 'id' => 'distancia01'])@endcomponent</th>
                                </tr>
                            </thead>
                            <tbody>
                                    {{-- AFERICAO 01 --}}
                                    <tr>
                                        <td>01</td>
                                        <td><input class="form-control" name="minuto01" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required /></td>
                                        <td>
                                            <input class="form-control" name="segundo01" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required />
                                        </td>
                                        <td>
                                            <input class="form-control" name="distancia01" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required />
                                        </td>
                                    </tr>

                                    {{-- AFERICAO 02 --}}
                                    <tr>
                                        <td>02</td>
                                        <td><input class="form-control" name="minuto02" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required /></td>
                                        <td>
                                            <input class="form-control" name="segundo02" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required />
                                        </td>
                                        <td>
                                            <input class="form-control" name="distancia02" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required />
                                        </td>
                                    </tr>

                                    {{-- AFERICAO O3 --}}
                                    <tr>
                                        <td>03</td>
                                        <td><input class="form-control" name="minuto03" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required /></td>
                                        <td>
                                            <input class="form-control" name="segundo03" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required />
                                        </td>
                                        <td>
                                            <input class="form-control" name="distancia03" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required />
                                        </td>
                                    </tr>

                                    {{-- AFERICAO 04 --}}
                                    <tr>
                                        <td>04</td>
                                        <td><input class="form-control" name="minuto04" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" /></td>
                                        <td>
                                            <input class="form-control" name="segundo04" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                        </td>
                                        <td>
                                            <input class="form-control" name="distancia04" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                        </td>
                                    </tr>
                            </tbody>
                            <tfoot>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="percentimetro" role="tabpanel" aria-labelledby="percentimetro-tab">
                    
                    <div style="margin-left: 20px">
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <b> @lang('afericao.afericaoPercentimetro')</b>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <select class="custom-select" id="mudaDivs" name="tipo_movimento">
                                    <option value="1">@lang('afericao.movimentoContinuo')</option>
                                    <option value="0">@lang('afericao.comParada')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <b>@lang('afericao.naoAferiu')</b>
                                <input type="checkbox" class="nao_aferiu" name="nao_aferiu" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 m-auto tabela" id="cssPreloader">
                        {{-- TABELA MOVIMENTADO --}}
                        <div id="movimentando">
                            <table class="table table-striped mx-auto mt-5 text-center" id="movimentado">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">@component('_layouts._components._inputLabel', ['texto' => __('afericao.tempoMinuto') . __('unidadesAcoes.(min)'), 'id' => 'minuto01'])@endcomponent</th>
                                        <th scope="col">@component('_layouts._components._inputLabel', ['texto' => __('afericao.tempoSegundoMilissegundo') . __('unidadesAcoes.(s:ms)'), 'id' => 'segundo01'])@endcomponent</th>
                                        <th scope="col">@component('_layouts._components._inputLabel', ['texto' => __('afericao.distanciaM') . __('unidadesAcoes.(m)'), 'id' => 'distancia01'])@endcomponent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        {{-- AFERICAO 01 --}}
                                        <tr>
                                            <td>80 @lang('unidadesAcoes.porcentagem')</td>
                                            <td><input class="form-control" name="minuto_perc_01" type="number"
                                                pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required /></td>
                                            <td>
                                                <input class="form-control" name="segundo_perc_01" type="number"
                                                pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required />
                                            </td>
                                            <td>
                                                <input class="form-control" name="distancia_perc_01" type="number"
                                                pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required />
                                            </td>
                                        </tr>

                                        {{-- AFERICAO 02 --}}
                                        <tr>
                                            <td>60 @lang('unidadesAcoes.porcentagem')</td>
                                            <td><input class="form-control" name="minuto_perc_02" type="number"
                                                pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" /></td>
                                            <td>
                                                <input class="form-control" name="segundo_perc_02" type="number"
                                                pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                            </td>
                                            <td>
                                                <input class="form-control" name="distancia_perc_02" type="number"
                                                pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                            </td>
                                        </tr>

                                        {{-- AFERICAO O3 --}}
                                        <tr>
                                            <td>40 @lang('unidadesAcoes.porcentagem')</td>
                                            <td><input class="form-control" name="minuto_perc_03" type="number"
                                                pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" /></td>
                                            <td>
                                                <input class="form-control" name="segundo_perc_03" type="number"
                                                pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                            </td>
                                            <td>
                                                <input class="form-control" name="distancia_perc_03" type="number"
                                                pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                            </td>
                                        </tr>

                                        {{-- AFERICAO 04 --}}
                                        <tr>
                                            <td>20 @lang('unidadesAcoes.porcentagem')</td>
                                            <td><input class="form-control" name="minuto_perc_04" type="number"
                                                pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" /></td>
                                            <td>
                                                <input class="form-control" name="segundo_perc_04" type="number"
                                                pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                            </td>
                                            <td>
                                                <input class="form-control" name="distancia_perc_04" type="number"
                                                pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                            </td>
                                        </tr>
                                </tbody>
                                <tfoot>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tfoot>
                            </table>
                        </div>

                        {{-- TABELA COM PARADA --}}
                        <div id="parado" style="display:none;">
                            <table class="table table-striped mx-auto mt-5 text-center" id="parado">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">@component('_layouts._components._inputLabel', ['texto' => __('afericao.movimentadoMin') . __('unidadesAcoes.(min)'), 'id' => 'minuto_movi_01'])@endcomponent</th>
                                        <th scope="col">@component('_layouts._components._inputLabel', ['texto' => __('afericao.movimentadoSeg') . __('unidadesAcoes.(s:ms)'), 'id' => 'segundo_movi_01'])@endcomponent</th>
                                        <th scope="col">@component('_layouts._components._inputLabel', ['texto' => __('afericao.paradoMin') . __('unidadesAcoes.(min)'), 'id' => 'minuto_parado_01'])@endcomponent</th>
                                        <th scope="col">@component('_layouts._components._inputLabel', ['texto' => __('afericao.paradoSeg') . __('unidadesAcoes.(s:ms)'), 'id' => 'segundo_parado_01'])@endcomponent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        {{-- AFERICAO 01 --}}
                                        <tr>
                                            <td>80 @lang('unidadesAcoes.porcentagem')</td>
                                            <td><input class="form-control" name="minuto_movi_01" type="number"
                                                pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" /></td>
                                            <td>
                                                <input class="form-control" name="segundo_movi_01" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                            </td>
                                            <td>
                                                <input class="form-control" name="minuto_parado_01" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                            </td>
                                            <td>
                                                <input class="form-control" name="segundo_parado_01" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                            </td>
                                        </tr>

                                        {{-- AFERICAO 02 --}}
                                        <tr>
                                            <td>60 @lang('unidadesAcoes.porcentagem')</td>
                                            <td><input class="form-control" name="minuto_movi_02" type="number"
                                                pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" /></td>
                                            <td>
                                                <input class="form-control" name="segundo_movi_02" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                            </td>
                                            <td>
                                                <input class="form-control" name="minuto_parado_02" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                            </td>
                                            <td>
                                                <input class="form-control" name="segundo_parado_02" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                            </td>
                                        </tr>

                                        {{-- AFERICAO O3 --}}
                                        <tr>
                                            <td>40 @lang('unidadesAcoes.porcentagem')</td>
                                            <td><input class="form-control" name="minuto_movi_03" type="number"
                                                pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" /></td>
                                            <td>
                                                <input class="form-control" name="segundo_movi_03" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                            </td>
                                            <td>
                                                <input class="form-control" name="minuto_parado_03" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                            </td>
                                            <td>
                                                <input class="form-control" name="segundo_parado_03" type="number"
                                                pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                            </td>
                                        </tr>

                                        {{-- AFERICAO 04 --}}
                                        <tr>
                                            <td>20 @lang('unidadesAcoes.porcentagem')</td>
                                            <td><input class="form-control" name="minuto_movi_04" type="number"
                                                pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" /></td>
                                            <td>
                                                <input class="form-control" name="segundo_movi_04" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                            </td>
                                            <td>
                                                <input class="form-control" name="minuto_parado_04" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                            </td>
                                            <td>
                                                <input class="form-control" name="segundo_parado_04" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                            </td>
                                        </tr>
                                </tbody>
                                <tfoot>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script type="text/javascript">
        $(function() {
            //Mudança das divs
            $('#mudaDivs').change(function() {
                var select = $(this).children("option:selected").val();
                //Caso seja selecionado parado
                if (select == 0) {
                    $('#parado input[name=minuto_movi_01]').prop("required", true);
                    $('#parado input[name=segundo_movi_01]').prop("required", true);
                    $('#parado input[name=minuto_parado_01]').prop("required", true);
                    $('#parado input[name=segundo_parado_01]').prop("required", true);
                    $('#parado').show();
                    $('#movimentando :input').attr("required", false);
                    $('#movimentando').hide();
                    $('#movimentando :input').each(function() {
                        $(this).val('');
                        $(this).removeClass('has-value');
                    });
                }
                //Caso seja movimentado
                else {
                    $('#movimentando input[name=minuto_perc_01]').prop("required", true);
                    $('#movimentando input[name=segundo_perc_01]').prop("required", true);
                    $('#movimentando input[name=distancia_perc_01]').prop("required", true);
                    $('#movimentando').show();
                    $('#parado :input').attr("required", false);
                    $('#parado').hide();
                    $('#parado :input').each(function() {
                        $(this).val('');
                        $(this).removeClass('has-value');
                    });
                }
            });

            //Caso clique no check box
            $(".nao_aferiu").change(function() {
                if (this.checked) {
                    $(this).val(1);
                    //Manipulando os inputs da div 'Movimentando'
                    $('#movimentando :input').attr("disabled", true);
                    $('#movimentando :input').attr("required", false);
                    $('#movimentando :input').css("background-color", "transparent");
                    $('#movimentando :input').each(function() {
                        if ($(this).val()) {
                            $(this).val('');
                            $(this).removeClass('has-value');
                        }
                    });
                    //Manipulando os inputs da div 'Parado'
                    $('#parado :input').attr("disabled", true);
                    $('#parado :input').attr("required", false);
                    $('#parado :input').css("background-color", "transparent");
                    $('#parado :input').each(function() {
                        if ($(this).val()) {
                            $(this).val('');
                            $(this).removeClass('has-value');
                        }
                    });
                } else {
                    $(this).val(0);
                    $('#movimentando :input').attr("disabled", false);
                    $('#parado :input').attr("disabled", false);
                }
            });

            NaoAferiu();
        });

    </script>

        {{-- VALIDAÇÕES DE CAMPOS --}}
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
        <script>
            $(document).ready(function() {
                
                $('#mudaDivs').on('change', function(){
                    tipoMovimento = ($(this).val());
                    // TIPO MOVIMENTO = 1 É MOVIMENTADO SE FOR = A 0 E PARADO
                    if (tipoMovimento == 1){
                        $('#botaosalvar').on('click', function() {
                            $('#formdados').submit();
                        });
            
                        $("#formdados").validate({
                            ignore: "",
                            invalidHandler: function() {
                                setTimeout(function() {
                                    $('.nav-tabs a small.required').remove();
                                    var validatePane = $('.tab-content.tab-validate .tab-pane:has(input.error)').each(function() {
                                        var id = $(this).attr('id');
                                        $('.nav-tabs').find('a[href^="#' + id + '"]').append('<small class="required">&#9888;&#65039;</small>');
                                    });
                                });
                            },
                            rules: {
                                "minuto01": {
                                    required: true
                                },
                                "segundo01": {
                                    required: true
                                },
                                "distancia01": {
                                    required: true
                                },
                                "minuto02": {
                                    required: true
                                },
                                "segundo02": {
                                    required: true
                                },
                                "distancia02": {
                                    required: true
                                },
                                "minuto03": {
                                    required: true
                                },
                                "segundo03": {
                                    required: true
                                },
                                "distancia03": {
                                    required: true
                                },
                                "minuto04": {
                                    required: true
                                },
                                "segundo04": {
                                    required: true
                                },
                                "distancia04": {
                                    required: true
                                },
                                "minuto_perc_01": {
                                    required: true
                                },
                                "segundo_perc_01": {
                                    required: true
                                },
                                "distancia_perc_01": {
                                    required: true
                                },
                                "minuto_perc_02": {
                                    required: true
                                },
                                "segundo_perc_02": {
                                    required: true
                                },
                                "distancia_perc_02": {
                                    required: true
                                },
                                "minuto_perc_03": {
                                    required: true
                                },
                                "segundo_perc_03": {
                                    required: true
                                },
                                "distancia_perc_03": {
                                    required: true
                                },
                                "minuto_perc_04": {
                                    required: true
                                },
                                "segundo_perc_04": {
                                    required: true
                                },
                                "distancia_perc_04": {
                                    required: true
                                }
                            },
                            messages: {
                                minuto01: "@lang('validate.validate')",
                                "segundo01": {
                                    required: "@lang('validate.validate')"
                                },
                                "distancia01": {
                                    required: "@lang('validate.validate')"
                                },
                                "minuto02": {
                                    required: "@lang('validate.validate')"
                                },
                                "segundo02": {
                                    required: "@lang('validate.validate')"
                                },
                                "distancia02": {
                                    required: "@lang('validate.validate')"
                                },
                                "minuto03": {
                                    required: "@lang('validate.validate')"
                                },
                                "segundo03": {
                                    required: "@lang('validate.validate')"
                                },
                                "distancia03": {
                                    required: "@lang('validate.validate')"
                                },
                                "minuto04": {
                                    required: "@lang('validate.validate')"
                                },
                                "segundo04": {
                                    required: "@lang('validate.validate')"
                                },
                                "distancia04": {
                                    required: "@lang('validate.validate')"
                                },
                                "minuto_perc_01": {
                                    required: "@lang('validate.validate')"
                                },
                                "segundo_perc_01": {
                                    required: "@lang('validate.validate')"
                                },
                                "distancia_perc_01": {
                                    required: "@lang('validate.validate')"
                                },
                                "minuto_perc_02": {
                                    required: "@lang('validate.validate')"
                                },
                                "segundo_perc_02": {
                                    required: "@lang('validate.validate')"
                                },
                                "distancia_perc_02": {
                                    required: "@lang('validate.validate')"
                                },
                                "minuto_perc_03": {
                                    required: "@lang('validate.validate')"
                                },
                                "segundo_perc_03": {
                                    required: "@lang('validate.validate')"
                                },
                                "distancia_perc_03": {
                                    required: "@lang('validate.validate')"
                                },
                                "minuto_perc_04": {
                                    required: "@lang('validate.validate')"
                                },
                                "segundo_perc_04": {
                                    required: "@lang('validate.validate')"
                                },
                                "distancia_perc_04": {
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
                    } else {
                        $('#botaosalvar').on('click', function() {
                            $('#formdados').submit();
                        });
            
                        $("#formdados").validate({
                            ignore: "",
                            invalidHandler: function() {
                                setTimeout(function() {
                                    $('.nav-tabs a small.required').remove();
                                    var validatePane = $('.tab-content.tab-validate .tab-pane:has(input.error)').each(function() {
                                        var id = $(this).attr('id');
                                        $('.nav-tabs').find('a[href^="#' + id + '"]').append('<small class="required">&#9888;&#65039;</small>');
                                    });
                                });
                            },
                            rules: {
                                "minuto01": {
                                    required: true
                                },
                                "segundo01": {
                                    required: true
                                },
                                "distancia01": {
                                    required: true
                                },
                                "minuto02": {
                                    required: true
                                },
                                "segundo02": {
                                    required: true
                                },
                                "distancia02": {
                                    required: true
                                },
                                "minuto03": {
                                    required: true
                                },
                                "segundo03": {
                                    required: true
                                },
                                "distancia03": {
                                    required: true
                                },
                                "minuto04": {
                                    required: true
                                },
                                "segundo04": {
                                    required: true
                                },
                                "distancia04": {
                                    required: true
                                },
                                "minuto_movi_01": {
                                    required: true
                                },
                                "segundo_movi_01": {
                                    required: true
                                },
                                "minuto_parado_01": {
                                    required: true
                                },
                                "segundo_parado_01": {
                                    required: true
                                },
                                "minuto_movi_02": {
                                    required: true
                                },
                                "segundo_movi_02": {
                                    required: true
                                },
                                "minuto_parado_02": {
                                    required: true
                                },
                                "segundo_parado_02": {
                                    required: true
                                },
                                "minuto_movi_03": {
                                    required: true
                                },
                                "segundo_movi_03": {
                                    required: true
                                },
                                "minuto_parado_03": {
                                    required: true
                                },
                                "segundo_parado_03": {
                                    required: true
                                },
                                "minuto_movi_04": {
                                    required: true
                                },
                                "segundo_movi_04": {
                                    required: true
                                },
                                "minuto_parado_04": {
                                    required: true
                                },
                                "segundo_parado_04": {
                                    required: true
                                }
                            },
                            messages: {
                                minuto01: "Campo <strong>OBRIGATÓRIO</strong>",
                                "segundo01": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
                                },
                                "distancia01": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
                                },
                                "minuto02": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
                                },
                                "segundo02": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
                                },
                                "distancia02": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
                                },
                                "minuto03": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
                                },
                                "segundo03": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
                                },
                                "distancia03": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
                                },
                                "minuto04": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
                                },
                                "segundo04": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
                                },
                                "distancia04": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
                                },
                                "minuto_movi_01": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
                                },
                                "segundo_movi_01": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
                                },
                                "minuto_parado_01": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
                                },
                                "segundo_parado_01": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
                                },
                                "minuto_movi_02": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
                                },
                                "segundo_movi_02": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
                                },
                                "minuto_parado_02": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
                                },
                                "segundo_parado_02": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
                                },
                                "minuto_movi_03": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
                                },
                                "segundo_movi_03": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
                                },
                                "minuto_parado_03": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
                                },
                                "segundo_parado_03": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
                                },
                                "minuto_movi_04": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
                                },
                                "segundo_movi_04": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
                                },
                                "minuto_parado_04": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
                                },
                                "segundo_parado_04": {
                                    required: "Campo <strong>OBRIGATÓRIO</strong>"
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
                    }
                    
                });
            });
            $(window).on('load', function() {
                $("#coverScreen").hide();
            });
        </script>
@endsection
