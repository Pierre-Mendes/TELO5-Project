@extends('_layouts._layout_site')
@include('_layouts._includes._head')

@section('topo_detalhe')

    <div class="container-fluid topo">
        <div class="row align-items-start">
            {{-- TITULO E SUBTITULO --}}
            <div class="col-6">
                <h1>@lang('afericao.cadastrar_lance')</h1>
            </div>
        </div>
    </div>

@endsection

@section('conteudo')

    {{-- BARRA DE PROGRESSO --}}
    @php
    $afericao = session()->get('afericao');
    $num_lance = session()->get('numero_lance');
    // $progresso = round((($num_lance - 1) / $afericao['numero_lances']) * 100);
    @endphp
    
    <div class="formafericao">
        {{-- NAVTAB'S --}}
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="lance1-tab" data-toggle="tab" href="#lance1" role="tab"
                    aria-controls="lance1" aria-selected="true">
                    @if (!empty($afericao['tem_balanco']) && $num_lance == $afericao['numero_lances'])
                        @lang('afericao.balanco')
                    @else
                        @lang('afericao.lance') {{ $num_lance }} / {{ $afericao['numero_lances'] }}
                    @endif
                </a>
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
        <form action="{{ route('span_save') }}" method="post" id="formdados">
            @csrf
            <div class="tab-content mt-5" id="myTabContent">
                <div class="tab-pane fade show active" id="lance1" role="tabpanel" aria-labelledby="lance1-tab">
                    <input type="hidden" name="numero_lance" value="{{ $num_lance }}">
                    <input type="hidden" name="id_afericao" value="{{ $afericao['id'] }}">
                    <input type="hidden" name="id" value="{{ $lance['id'] }}">
                    <div class="col-md-12 formpivocentral" id="cssPreloader">
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-4 telo5ce">
                                @component('_layouts._components._inputLabel', ['texto' => __('afericao.numeroTubos'), 'id'
                                => 'num_tubo'])@endcomponent
                                <input type="number" step=1 min=1 name="numero_tubos" id="num_tubo" required
                                    class="form-control ">

                            </div>
                            <div class="form-group col-md-4 telo5ce">
                                @component('_layouts._components._inputLabel', ['texto' => __('afericao.numeroEmissores'),
                                'id' => 'numero_emissores'])@endcomponent
                                <input type="number" @if (empty($lance->numero_emissores)) id="numero_emissores" required @else   value="{{ $lance->numero_emissores }}" readonly @endif name="numero_emissores" step=1 min=1 class="form-control ">
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
                                <div class="line"></div>
                            </div>
                        </div>

                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-4 telo5ce">
                                <label for="val_reg"> @lang('afericao.valvulaReguladora')</label>
                                <select id="val_reg" class='form-control' required='true' name='valvula_reguladora'>
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

                            <div class="form-group col-md-4 telo5ce">
                                <label for="val_reg"> @lang('afericao.tipoValvula')</label>
                                <select id="val_reg" class='form-control' required='true' name='tipo_valvula'>
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
                                <input type="number" class="form-control " id="motorredutor" step=0.01 name="motorredutor">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>

        {{-- BOTOES PARA SALVAR --}}
        <div class="container">
            <div class="row justify-content-center botaoAfericao align-items-end" id="botoesSalvar">
                {{-- <a class="voltar" href="{{route('gauging_status', $afericao['id'])}}" >@lang('unidadesAcoes.sair')</a> --}}
                <a class="voltar ml-3" href="{{ route('span_back') }}">@lang('unidadesAcoes.anterior')</a>
                <button class="proximo ml-3" name="" type="submit" id="botaosalvar">@lang('unidadesAcoes.salvar')</button>
                {{-- <button type="submit" class="voltar m-3"><a href="{{route('gauging_status', $afericao['id'])}}">Voltar</a></button> --}}
                {{-- <button type="submit" class="proximo m-3"><a href="{{route('issuer_create')}}">Proximo</a></button> --}}
            </div>
        </div>

    </div>
@endsection

@section('scripts')

    {{-- VALIDAÇÕES DE CAMPOS --}}
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
                    "rua": {
                        required: true
                    },
                    "cep": {
                        required: true
                    },
                    "cidade": {
                        required: true
                    },
                    "telefone": {
                        required: true
                    },
                    "estado": {
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
                    }
                },
                messages: {
                    nome: "Campo <strong>NOME</strong> é obrigatório",

                    "rua": {
                        required: "Campo <strong>RUA</strong> é obrigatório"
                    },
                    "cep": {
                        required: "Campo <strong>CEP</strong> é obrigatório"
                    },
                    "cidade": {
                        required: "Campo <strong>CIDADE</strong> é obrigatório"
                    },
                    "telefone": {
                        required: "Campo <strong>TELEFONE</strong> é obrigatório"
                    },
                    "estado": {
                        required: "Campo <strong>ESTADO</strong> é obrigatório"
                    },
                    "pais": {
                        required: "Campo <strong>PAIS</strong> é obrigatório"
                    },
                    "email": {
                        required: "Campo <strong>E-MAIL</strong> é obrigatório",
                    },
                    "password": {
                        required: "Campo <strong>SENHA</strong> é obrigatório"
                    },
                    "confirmar_senha": {
                        required: "Campo <strong>CONFRIMAR SENHA</strong> é obrigatório"
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
@endsection
