@extends('_layouts._layout_site')

@section('head')
    <style>

    </style>
@endsection

@section('titulo')

@endsection

@section('topo_detalhe')

    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- TITULO E SUBTITULO --}}
            <div class="col-6">
                <h1>@lang('redimensionamento.configurarPivo')</h1>
            </div>

            {{-- BOTOES SALVAR E VOLTAR --}}
            <div class="col-6 text-right botoes position">
                <a href="{{ route('gauging_manager') }}" style="color: #3c8dbc">
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
    </div>
@endsection

@section('conteudo')

    {{-- <div class="row col-12 justify-content-center" style="padding-bottom: 2%">
    <a data-toggle="modal" data-target="#adicionarLance" class="btn btn-dark btn-circle my-auto  text-light" data-original-title="@lang('redimensionamento.adicionarLance')"  data-toggle="tooltip" data-placement="bottom"><i class="fa fa-plus fa-fw text-light"></i> @lang('redimensionamento.adicionarLance')</a>
</div>
<div class="row col-12 justify-content-center">

    @foreach ($lances as $key => $lance)

        <div class="col" style="min-width: 230px;max-width: 250px;margin-bottom: 5rem">
            <div class="card">
                <img class="card-img-top" src="@if ($lance['numero_lance'] == 1) {{asset('img/symbols/pivot-start.png')}} @elseif($lance['numero_lance'] == $numero_lances) {{asset('img/symbols/pivot-end.png')}} @else {{asset('img/symbols/pivot-middle.png')}} @endif" alt="Pivot" >
                <div class="card-body justify-content-center">
                    <h3 class="text-center">@if ($lance['numero_lance'] == $numero_lances && $tem_balanco == 'sim') @lang('afericao.balanco') @else @lang('afericao.lance') {{$lance['numero_lance']}} @endif</h3>
                    <div class="text-center">
                        <button onclick="alterarIdLanceAntesEditar({{$lance['id']}})" type="submit" form="formEditarLance"  data-original-title="@lang('redimensionamento.editarLance')"  data-toggle="tooltip" data-placement="bottom" class="btn btn-primary"> <i class="fa fa-pencil"></i></button>
                        <a onclick="removerLance({{$lance['id']}}, '@if ($lance['numero_lance'] == $numero_lances && $tem_balanco == 'sim') @lang('afericao.balanco') @else @lang('afericao.lance') {{$lance['numero_lance']}} @endif')" data-original-title="@lang('redimensionamento.removerLance')"  data-toggle="tooltip" data-placement="bottom" class="btn btn-danger"> <i class="fa fa-trash text-light"></i></a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="row col-12">
    <div class="text-center col-12">
        @if ($tipo_projeto == 'R')
            <a class="btn btn-outline-dark" href="{{route('status_redimensionamento', $id_redimensionamento)}}">@lang('afericao.voltar')</a>
        @else
            <a class="btn btn-outline-dark" href="{{route('gauging_status', $id_redimensionamento)}}">@lang('afericao.voltar')</a>
        @endif
    </div>
</div> --}}

    <div class="formafericao">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="iGerais-tab" data-toggle="tab" href="#iGerais" role="tab"
                    aria-controls="iGerais" aria-selected="true">Informações Gerais</a>
            </li>
        </ul>

        {{-- LAYOUT NOVO --}}
        <form action="" method="post" id="formdados">
            @csrf
            <div class="tab-content mt-5" id="myTabContent">
                <div class="tab-pane fade show active" id="iGerais" role="tabpanel" aria-labelledby="iGerais-tab">
                    {{-- <input type="hidden" name="id_fazenda" value="{{ $fazenda->id }}"> --}}
                    <div class="col-md-12">
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <h4>@lang('redimensionamento.posicaoLance')</h4>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="posicao_relativa">@lang('Posiçao Relativa')</label>
                                <select name="posicao_relativa" class="form-control" required id="">
                                    <option value="0">@lang('redimensionamento.antesDo')</option>
                                    <option value="1">@lang('redimensionamento.depoisDo')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for="lance_relativo">@lang('Lance Relativo')</label>
                                <select name="lance_relativo" class="form-control" required id="">
                                    @foreach ($lances as $lance)
                                        @if (!($lance['numero_lance'] == $numero_lances && $tem_balanco == 'sim'))
                                            <option value="{{ $lance['numero_lance'] }}"> @lang('afericao.lance')
                                                {{ $lance['numero_lance'] }} </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                @component('_layouts._components._inputLabel', ['texto' => __('afericao.numeroEmissores'),
                                'id' => 'numero_emissores'])@endcomponent
                                <input type="number" name="numero_emissores" onchange="alterarQuantidadeDeEmissores()"
                                    id="numero_emissores" step=1 min=1 class="form-control ">
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                @component('_layouts._components._inputLabel', ['texto' => __('afericao.numeroTubos'), 'id'
                                => 'num_tubo'])@endcomponent
                                <input type="number" step=1 min=1 name="numero_tubos" id="num_tubo" required
                                    class="form-control ">
                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                <label for=""> @lang('afericao.diametro')</label>
                                <select name="diametro" class="form-control" required id="">
                                    <option value="0.127">5"</option>
                                    <option value="0.1413">5.9/16</option>
                                    <option value="0.1524">6"</option>
                                    <option value="0.1683">6.5/8"</option>
                                    <option value="0.2032">8"</option>
                                    <option value="0.219">8.5/8"</option>
                                    <option value="0.254">10"</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4 telo5ce">
                                <label for="val_reg"> @lang('afericao.valvulaReguladora')</label>
                                <select id="val_reg" onchange="atualizarValvulaReguladora()" class='form-control'
                                    required='true' name='valvula_reguladora_lance'>
                                    <option value='10'><b>10 PSI</b></option>
                                    <option value='15'><b>15 PSI</b></option>
                                    <option value='20'><b>20 PSI</b></option>
                                    <option value='25'><b>25 PSI</b></option>
                                    <option value='30'><b>30 PSI</b></option>
                                    <option value='35'><b>35 PSI</b></option>
                                    <option value='40'><b>40 PSI</b></option>
                                    <option value='45'><b>45 PSI</b></option>
                                    <option value='50'><b>50 PSI</b></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="tipo_valvula"> @lang('afericao.tipoValvula')</label>
                                <select id="tipo_valvula" onchange="atualizarTipoValvulaReguladora()" class='form-control'
                                    required='true' name='tipo_valvula'>
                                    <option value='LF'><b>LF</b></option>
                                    <option value='MF'><b>MF</b></option>
                                    <option value='HF'><b>HF</b></option>
                                    <option value='PSR'><b>PSR</b></option>
                                </select>
                                <div class="line"></div>
                            </div>

                            <div class="form-group col-md-4 telo5ce">
                                @component('_layouts._components._inputLabel', ['texto' => __('afericao.motorredutor'), 'id'
                                => 'motorredutor'])@endcomponent
                                <input type=" number" class="form-control " id="motorredutor" step=0.01 name="motorredutor">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="container">
                    <div class="col-12 text-center">
                        <h3>@lang('redimensionamento.emissores')</h3>
                    </div>
                    <div class="row col-12 justify-content-center" id="div_lista_emissores">

                    </div>
                </div>
            </div> --}}
        </form>

        {{-- LAYOUT VELHO --}}

        {{-- <modal nome="adicionarLance" titulo="@lang('redimensionamento.adicionarLance')" css="modal-xl">
            <formulario id="formAdicionarLance" css="row" action="{{ route('adicionarLance') }}" method="post" enctype=""
                token="{{ csrf_token() }}">
                <input type="hidden" name="id_afericao" value="{{ $id_redimensionamento }}">

                <div class="row col-12">
                    <div class="col-12 text-center">
                        <h3>@lang('redimensionamento.infosLance')</h3>
                    </div>
                    <div class="col-md-12 row justify-content-center">
                        <div class="form-group  col-md-3 col-sm-4">
                            <h4 class="hy-auto">@lang('redimensionamento.posicaoLance')</h4>
                        </div>
                        <div class="form-group col-md-3 col-sm-4">
                            <select name="posicao_relativa" class="form-control" required id="">
                                <option value="0">@lang('redimensionamento.antesDo')</option>
                                <option value="1">@lang('redimensionamento.depoisDo')</option>
                            </select>
                            <div class="line"></div>
                        </div>
                        <div class="form-group  col-md-3 col-sm-4">
                            <select name="lance_relativo" class="form-control" required id="">
                                @foreach ($lances as $lance)
                                    @if (!($lance['numero_lance'] == $numero_lances && $tem_balanco == 'sim'))
                                        <option value="{{ $lance['numero_lance'] }}"> @lang('afericao.lance')
                                            {{ $lance['numero_lance'] }} </option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="line"></div>
                        </div>
                    </div>

                    <div class="form-group col-md-3 col-6">
                        <input type="number" name="numero_emissores" onchange="alterarQuantidadeDeEmissores()"
                            id="numero_emissores" step=1 min=1 class="form-control ">
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.numeroEmissores'), 'id' => 'numero_emissores'])@endcomponent
                    </div>

                    <div class="form-group col-md-2 col-6">
                        <input type="number" step=1 min=1 name="numero_tubos" id="num_tubo" required class="form-control ">
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.numeroTubos'), 'id' => 'num_tubo'])@endcomponent
                    </div>

                    <div class="form-group col-md-1  col-6">
                        <label for=""> @lang('afericao.diametro')</label>
                        <select name="diametro" class="form-control" required id="">
                            <option value="0.127">5"</option>
                            <option value="0.1413">5.9/16</option>
                            <option value="0.1524">6"</option>
                            <option value="0.1683">6.5/8"</option>
                            <option value="0.2032">8"</option>
                            <option value="0.219">8.5/8"</option>
                            <option value="0.254">10"</option>
                        </select>
                        <div class="line"></div>
                    </div>

                    <div class="form-group col-md-2  col-6">
                        <label for="val_reg"> @lang('afericao.valvulaReguladora')</label>
                        <select id="val_reg" onchange="atualizarValvulaReguladora()" class='form-control' required='true'
                            name='valvula_reguladora_lance'>
                            <option value='10'><b>10 PSI</b></option>
                            <option value='15'><b>15 PSI</b></option>
                            <option value='20'><b>20 PSI</b></option>
                            <option value='25'><b>25 PSI</b></option>
                            <option value='30'><b>30 PSI</b></option>
                            <option value='35'><b>35 PSI</b></option>
                            <option value='40'><b>40 PSI</b></option>
                            <option value='45'><b>45 PSI</b></option>
                            <option value='50'><b>50 PSI</b></option>
                        </select>
                        <div class="line"></div>
                    </div>

                    <div class="form-group col-md-2  col-6">
                        <label for="tipo_valvula"> @lang('afericao.tipoValvula')</label>
                        <select id="tipo_valvula" onchange="atualizarTipoValvulaReguladora()" class='form-control'
                            required='true' name='tipo_valvula'>
                            <option value='LF'><b>LF</b></option>
                            <option value='MF'><b>MF</b></option>
                            <option value='HF'><b>HF</b></option>
                            <option value='PSR'><b>PSR</b></option>
                        </select>
                        <div class="line"></div>
                    </div>

                    <div class="form-group col-md-2  col-6">
                        <input type="number" class="form-control " id="motorredutor" step=0.01 name="motorredutor">
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.motorredutor'), 'id' => 'motorredutor'])@endcomponent
                    </div>

                    <hr>

                </div>

                <div class="container">
                    <div class="col-12 text-center">
                        <h3>@lang('redimensionamento.emissores')</h3>
                    </div>
                    <div class="row col-12 justify-content-center" id="div_lista_emissores">

                    </div>
                </div>

            </formulario>
            <span slot="botoes">
                <button form='formAdicionarLance' class="btn btn-lg btn-info btn-block text-center text-light"
                    style="margin: 0 auto" type="submit">@lang('unidadesAcoes.salvar')</button>
            </span>
        </modal> --}}

        {{-- MODAL PARA DELETAR O LANCE --}}

        {{-- <modal nome="removerLance" titulo="@lang('redimensionamento.removerLance')" css="modal-sm">
            <formulario id="formRemoverLance" css="row" action="{{ route('removerLance') }}" method="delete" enctype=""
                token="{{ csrf_token() }}">
                <input type="hidden" name="id_lance" id="id_lance">
                <input type="hidden" name="id_afericao" value="{{ $id_redimensionamento }}">
                <div class="row col-12">
                    <div class="col-12 container">
                        <h5>@lang('redimensionamento.confirmarRemocaoLance')</h5>
                        <h5 id="mensagem_remover"></h5>
                    </div>
                </div>

            </formulario>
            <span slot="botoes">
                <button form='formRemoverLance' class="btn btn-lg btn-danger btn-block text-center text-light"
                    style="margin: 0 auto" type="submit">@lang('unidadesAcoes.remover')</button>
            </span>
        </modal> --}}

        {{-- DIV PARA EDITAR LANCE  --}}
        {{-- <div hidden>
            <formulario id="formEditarLance" css="row" action="{{ route('getInformacoesLance') }}" method="put" enctype=""
                token="{{ csrf_token() }}">
                <input type="hidden" name="id_lance" id="id_lance_editar">
                <input type="hidden" name="id_afericao" value="{{ $id_redimensionamento }}">
                <input type="hidden" name="espacamento" value="{{ $espacamento }}">
                <input type="hidden" name="tem_balanco" value="{{ $tem_balanco }}">
                <input type="hidden" name="numero_lances" value="{{ $numero_lances }}">
                <input type="hidden" name="emissor" value="{{ $emissor }}">
                <input type="hidden" name="tipo_projeto" value="{{ $tipo_projeto }}">
            </formulario>
        </div> --}}


    @endsection

    @section('scripts')
        <script type="text/javascript">
            $('#adicionarLance').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                //var recipient = button.data('pivo-anterior');
                //$("#field_lance_anterior").val(recipient);
            });


            function removerLance(id_lance, lance) {
                $("#id_lance").val(id_lance);
                $("#mensagem_remover").text(lance);
                $('#removerLance').modal('show');
            }

            function alterarIdLanceAntesEditar(id_lance) {
                $("#id_lance_editar").val(id_lance);
            }

        </script>

        <script type="text/javascript">
            function alterarQuantidadeDeEmissores() {
                var qtEmissores = $("#numero_emissores").val();
                var divEmissores = $("#div_lista_emissores");
                var espacamento = "{{ $espacamento }}";
                var emissor = "{{ $emissor }}";

                $("#msgInformeEmissores").remove();
                divEmissores.empty();
                if (qtEmissores == 0 || qtEmissores === "" || qtEmissores === undefined) {
                    divEmissores.append(
                        '<h3 id="msgInformeEmissores" class="text-center" > @lang("redimensionamento.informeNumeroLances") </h3>'
                    );
                } else {
                    for (let index = 0; index < qtEmissores; index++) {
                        var linha = `
                                                        <div class="col-1 my-auto">
                                                            <h3 style="padding-top: 20px">${index + 1}</h3>
                                                        </div>
                                                        <div class="col-11 row">
                                                            <input type="hidden" name="numero_emissor[]" value="${index + 1}">
                                                            <div class="form-group col-md-2">
                                                                <label class='float-label' > @lang('afericao.saida1')</label>
                                                                <input type="number" step=0.1 min=0  name="bocal_1[]" required class="form-control first_field">
                                                                <div class="line" ></div>
                                                            </div>

                                                            <div class="form-group  col-md-2">
                                                                <label class='float-label' > @lang('afericao.saida2')</label>
                                                                <input type="number"  step=0.1 min=0 name="bocal_2[]"  class="form-control ">
                                                                <div class="line" ></div>
                                                            </div>

                                                            <div class="form-group  col-md-2">
                                                                <label class='float-label' > @lang('afericao.espacamento')</label>
                                                                <input type="number" name="espacamento[]" value="${espacamento}" step=0.001 min=0.001 required class="form-control espacamento_field">
                                                                <div class="line" ></div>
                                                            </div>

                                                            <div class="form-group col-md-2">
                                                                <label for=""> @lang('afericao.emissor')</label>
                                                                <select class='form-control' required='true' required name='emissor[]'>
                                                                    <option  ${( emissor.toUpperCase() ==='I-WOB UP3') ? 'selected' : ''}       value='I-WOB UP3'><b>@lang('afericao.i-wob-up3')</b></option>
                                                                    <option  ${( emissor.toUpperCase() ==='FABRIMAR') ? 'selected' : ''}        value='Fabrimar'><b>@lang('afericao.fabrimar')</b></option>
                                                                    <option  ${( emissor.toUpperCase() ==='NELSON') ? 'selected' : ''}          value='Nelson'><b>@lang('afericao.nelson')</b></option>
                                                                    <option  ${( emissor.toUpperCase() ==='SUPER SPRAY - UP3') ? 'selected' : ''} value='Super Spray - UP3'><b>@lang('afericao.super-spray-up3')</b></option>
                                                                    <option  ${( emissor.toUpperCase() ==='SUPER SPRAY') ? 'selected' : ''}     value='Super Spray'><b>@lang('afericao.super-spray')</b></option>
                                                                    <option  ${( emissor.toUpperCase() ==='I-WOB') ? 'selected' : ''}           value='I-WOB'><b>@lang('afericao.i-wob')</b></option>
                                                                    <option  ${( emissor.toUpperCase() ==='TRASH BUSTER') ? 'selected' : ''}    value='Trash Buster'><b>@lang('afericao.trash-buster')</b></option>
                                                                    <option  ${( emissor.toUpperCase() ==='KOMET') ? 'selected' : ''}           value='Komet'><b>@lang('afericao.komet')</b></option>
                                                                    <option  ${( emissor.toUpperCase() ==='FAN SPRAY') ? 'selected' : ''}       value='Fan Spray'><b>@lang('afericao.fan-spray')</b></option>
                                                                </select>
                                                                <div class="line"></div>
                                                            </div>

                                                            <div class="form-group col-md-2">
                                                                <label for="val_reg"> @lang('afericao.tipoValvula')</label>
                                                                <select  class='form-control' required='true' name='tipo_valvula[]'>
                                                                    <option value='LF'  ><b>LF</b></option>
                                                                    <option value='MF'  ><b>MF</b></option>
                                                                    <option value='HF'  ><b>HF</b></option>
                                                                    <option value='PSR' ><b>PSR</b></option>
                                                                </select>
                                                                <div class="line"></div>
                                                            </div>

                                                            <div class="form-group col-md-2">
                                                                <label for="val_reg"> @lang('afericao.psi')</label>
                                                                <select   class='form-control' required='true' name='valvula_reguladora[]'>
                                                                    <option value='10'><b>10 PSI</b></option>
                                                                    <option value='15'><b>15 PSI</b></option>
                                                                    <option value='20'><b>20 PSI</b></option>
                                                                    <option value='25'><b>25 PSI</b></option>
                                                                    <option value='30'><b>30 PSI</b></option>
                                                                    <option value='35'><b>35 PSI</b></option>
                                                                    <option value='40'><b>40 PSI</b></option>
                                                                    <option value='45'><b>45 PSI</b></option>
                                                                    <option value='50'><b>50 PSI</b></option>
                                                                </select>
                                                                <div class="line"></div>
                                                            </div>
                                                        </div>
                                                    `;
                        divEmissores.append(linha);
                    }
                    atualizarTipoValvulaReguladora();
                    atualizarValvulaReguladora();
                }
            }

            function atualizarValvulaReguladora() {
                var indexValvula = $("#val_reg").prop('selectedIndex');
                $('select[name="valvula_reguladora[]"]').each(function(index) {
                    $(this).prop('selectedIndex', indexValvula);
                });
            }

            function atualizarTipoValvulaReguladora() {
                var indexValvula = $("#tipo_valvula").prop('selectedIndex');
                $('select[name="tipo_valvula[]"]').each(function(index) {
                    $(this).prop('selectedIndex', indexValvula);
                });
            }

        </script>
    @endsection
