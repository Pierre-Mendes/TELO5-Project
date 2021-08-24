@extends('_layouts._layout_site')

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">
            {{-- TITULO E SUBTITULO --}}
            <div class="col-6 titulo-adutora-mobile">
                <h1>@lang('afericao.adutora')</h1><br>
                <h4 style="margin-top: -20px">@lang('comum.cadastrar')</h4>
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

    <div>
        {{-- PRELOADER --}}
        <div id="coverScreen">
            <div class="preloader">
                <i class="fas fa-circle-notch fa-spin fa-2x"></i>
                <div>@lang('comum.preloader')</div>
            </div>
        </div>

        {{-- FORMULARIO DE CADASTRO --}}
        <form action="{{ route('adductor_save') }}" method="POST" id="formdados">
            <div class="tab-content" id="myTabContent">
                @include('_layouts._includes._alert')
                <div class="tab-pane fade show active formcdc" id="cadastro" role="tabpanel" aria-labelledby="cadastro-tab">
                    @csrf
                    <input type="hidden" value="{{ $id_afericao }}" name="id_afericao">
                    <div class="table-responsive m-auto tabela" id="cssPreloader">
                        <table class="table table-striped mx-auto text-center" id="tabelaTrechos">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('afericao.tipoCano')</th>
                                    <th scope="col">@lang('afericao.diametro') @lang('unidadesAcoes.(m)')</th>
                                    <th scope="col">@lang('afericao.hw')</th>
                                    <th scope="col">@lang('afericao.numeroCanos')</th>
                                    <th scope="col">@lang('afericao.comprimento') @lang('unidadesAcoes.(m)')</th>
                                    <th scope="col">@lang('afericao.desnivel') @lang('unidadesAcoes.(m)')</th>
                                    <th scope="col" hidden>@lang('afericao.altitude')</th>
                                    <th scope="col" hidden>@lang('afericao.latitude')</th>
                                    <th scope="col" hidden>@lang('afericao.longitude')</th>
                                    <th scope="col">@lang('afericao.acoes')</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <td>
                                    <button onclick="AddTableRow()" type="button" class="addtablerow"
                                        style="outline: none; cursor: pointer;">
                                        <span class="fa-stack fa-sm">
                                            <i class="fas fa-plus-circle fa-stack-2x"></i>
                                        </span>
                                    </button>
                                </td>
                                <td></td>
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
        </form>
    </div>
@endsection

@section('scripts')

    {{-- FILTRO SELECT --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
    integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

    {{-- FUNÇÃO PARA REMOVER LINHAS DA TABELA --}}
    <script>
        $(document).ready(function() {
            AddTableRow();
        });

        (function($) {
            remove = function(item) {
                var tr = $(item).closest('tr');
                tr.fadeOut(400, function() {
                    tr.remove();
                });
                return false;
            }
        })(jQuery);

    </script>

    {{-- FUNÇÃO PARA ADICIONAR LINHAS A TABELA --}}
    <script>
        (function($) {
            AddTableRow = function() {

                var rowCount = $('#tabelaTrechos >tbody >tr').length;
                var newRow = $("<tr>");
                var cols = "";
                cols += '<td>';
                cols += '<select name="tipo_cano[]" required class="form-control"  id="tipo_cano">';
                cols += '<option value=""></option>';
                cols += '<option value="0">@lang('afericao.acoSac')</option>';
                cols += '<option value="1">@lang('afericao.az')</option>';
                cols += '<option value="2">@lang('afericao.ferroFundido')</option>';
                cols += '<option value="3">PVC PN 125</option>';
                cols += '<option value="4">PVC PN 140</option>';
                cols += '<option value="5">PVC PN 180</option>';
                cols += '<option value="6">PVC PN 60</option>';
                cols += '<option value="7">PVC PN 80</option>';
                cols += '<option value="8">RPVC PN 100</option>';
                cols += '<option value="9">@lang('afericao.aluminio')</option>';
                cols += '</select>';
                cols += '</td>';
                
                cols += '<td><input type="number" min=0.001 step=0.001 class="form-control" required name="diametro[]" id="diametro_' + rowCount + '"></td>';
                cols += '<td><input type="number" class="form-control" required name="coeficiente_hw[]" id="coeficiente_hw_' + rowCount + '"></td>';
                cols += '<td><input type="number" min=1 class="form-control" required name="numero_canos[]" id="numero_canos_' + rowCount + '"></td>';
                cols += '<td><input type="number" step="0.01" class="form-control" required name="comprimento[]" id="comprimento_' + rowCount + '"></td>';
                cols += '<td><input type="number" step="0.01" class="form-control" required name="desnivel[]" id="desnivel_' + rowCount + '"></td>';
                if (rowCount > 0){
                    cols += '<td><button type="button" class="removetablerow" onclick="remove(this)" style="outline: none; cursor: pointer; margin-top: 4px;"><i class="fa fa-fw fa-times fa-lg"></i></button></td>';
                }
                
                cols += '<td hidden><input type="number" class="form-control" value="0" name="altitude[]" id="altitude_' + rowCount + '"></td>';
                cols += '<td hidden><input type="number" step=0.000001 class="form-control" value="0" name="latitude[]" id="latitude_' + rowCount + '"></td>';
                cols += '<td hidden><input type="number" step=0.000001 class="form-control" value="0" name="longitude[]" id="longitude_' + rowCount + '"></td>';
                newRow.append(cols);
                $("#tabelaTrechos").append(newRow);
                return false;
            };
        })(jQuery);

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
                    "diametro[]": {
                        required: true
                    },
                    "coeficiente_hw[]": {
                        required: true
                    },
                    "numero_canos[]": {
                        required: true
                    },
                    "comprimento[]": {
                        required: true
                    },
                    "desnivel[]": {
                        required: true
                    }
                },
                messages: {
                    diametro: "@lang('validate.validate')",

                    "coeficiente_hw": {
                        required: "@lang('validate.validate')"
                    },
                    "numero_canos": {
                        required: "@lang('validate.validate')"
                    },
                    "comprimento": {
                        required: "@lang('validate.validate')"
                    },
                    "desnivel": {
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

    {{-- FUNÇÃO PARA CRIAR SELECT DO TIPO DE CANO --}}
    <script>
        function criarSelectTipoCano(value) {
            var select = $("<select  class='form-control' name=\"tipo_cano[]\" />");
            var optionsValues = [];
            var optionsTexts = [];

            optionsValues.push(0);
            optionsTexts.push("@lang('afericao.acoSac')");
            optionsValues.push(1);
            optionsTexts.push("@lang('afericao.az')");
            optionsValues.push(2);
            optionsTexts.push("@lang('afericao.ferroFundido')");
            optionsValues.push(3);
            optionsTexts.push("PVC PN 125");
            optionsValues.push(4);
            optionsTexts.push("PVC PN 140");
            optionsValues.push(5);
            optionsTexts.push("PVC PN 180");
            optionsValues.push(6);
            optionsTexts.push("PVC PN 60");
            optionsValues.push(7);
            optionsTexts.push("PVC PN 80");
            optionsValues.push(8);
            optionsTexts.push("RPVC PN 100");
            optionsValues.push(9);
            optionsTexts.push("@lang('afericao.aluminio')");
            optionsValues.forEach(function(item, index) {
                if (item == value) {
                    $("<option />", {
                        value: item,
                        text: optionsTexts[index]
                    }).appendTo(select).attr('selected', 'selected');
                } else {
                    $("<option />", {
                        value: item,
                        text: optionsTexts[index]
                    }).appendTo(select);
                }
            });

            return select;
        }

    </script>
@endsection
