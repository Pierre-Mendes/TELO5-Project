@extends('_layouts._layout_site')

@section('titulo')
@endsection

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">
            {{-- TITULO E SUBTITULO --}}
            <div class="col-6">
                <h1>@lang('afericao.editarBombeamento')</h1>
            </div>
            {{-- BOTOES SALVAR E VOLTAR --}}
            <div class="col-6 text-right botoes position">
                <a href="{{ route('gauging_status', $id_afericao) }}" style="color: #3c8dbc" data-toggle="tooltip" data-placement="bottom" title="Voltar">
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
            <a class="nav-link active" id="iGerais-tab" data-toggle="tab" href="#iGerais" role="tab"
                aria-controls="iGerais" aria-selected="true">@lang('comum.informacoes_navtabs')</a>
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
    <form action="{{route('update_pumping')}}" method="POST" id="formdados">
        @csrf
        <input type="hidden" name="id_afericao" value="{{$id_afericao}}">
        <input type="hidden" name="id_bombeamento" value="{{$cabecalho_bombeamento['id']}}">

        <div id="collapseBombeamento" class="collapse show" aria-labelledby="headingBombeamento" data-parent="#accordion">
            <div class="card-body row" id="cssPreloader">
                <div class="col-md-3 form-group telo5ce">
                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.altitudeNivelAgua')  . __('unidadesAcoes.(m)'), 'id' => ''])@endcomponent
                    <input type="number"  class="form-control" required name="altitude_nivel_agua" value="{{$cabecalho_bombeamento['altitude_nivel_agua']}}">
                </div>

                <div class="col-md-3 form-group telo5ce">
                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.altitudeCasaBomba') . __('unidadesAcoes.(m)'), 'id' => ''])@endcomponent
                    <input type="number"  class="form-control" required name="altitude_casa_bomba" value="{{$cabecalho_bombeamento['altitude_casa_bomba']}}">
                </div>

                <div class="col-md-3 form-group telo5ce">
                    <label for="tipo_instalacao">@lang('afericao.tipoInstalacao')</label>
                    <select name="tipo_instalacao"  class="form-control" id="tipo_instalacao">
                        <option value="0" <?php if($cabecalho_bombeamento['tipo_instalacao'] == 0) echo "selected='selected'"; ?> >@lang('afericao.direta')</option>
                        <option value="1" <?php if($cabecalho_bombeamento['tipo_instalacao'] == 1) echo "selected='selected'"; ?> >@lang('afericao.afogada')</option>
                        <option value="2" <?php if($cabecalho_bombeamento['tipo_instalacao'] == 2) echo "selected='selected'"; ?> >@lang('afericao.balsa')</option>
                        <option value="3" <?php if($cabecalho_bombeamento['tipo_instalacao'] == 3) echo "selected='selected'"; ?> >@lang('afericao.submersa')</option>
                    </select>
                    <div class="line"></div>
                </div>

                <div class="col-md-3 form-group telo5ce">
                    <label for="posicionamento_bombeamento">@lang('afericao.posicionamentoBombeamento')</label>
                    <select name="posicionamento_bombeamento"  class="form-control" id="posicionamento_bombeamento">
                        <option value="0" <?php if($cabecalho_bombeamento['captacao'] == 0) echo "selected='selected'"; ?>>@lang('afericao.simples')</option>
                        <option value="1" <?php if($cabecalho_bombeamento['captacao'] == 1) echo "selected='selected'"; ?> >@lang('afericao.serie')</option>
                        <option value="2" <?php if($cabecalho_bombeamento['captacao'] == 2) echo "selected='selected'"; ?>>@lang('afericao.paralelo')</option>
                    </select>
                    <div class="line"></div>
                </div>

                <div class="col-md-3 form-group telo5ce">
                    <label for="captacao">@lang('afericao.captacao')</label>
                    <select name="captacao"  class="form-control" id="captacao">
                        <option value="0" <?php if($cabecalho_bombeamento['captacao'] == 0) echo "selected='selected'"; ?> >@lang('afericao.acude')</option>
                        <option value="1" <?php if($cabecalho_bombeamento['captacao'] == 1) echo "selected='selected'"; ?> >@lang('afericao.barragem')</option>
                        <option value="2" <?php if($cabecalho_bombeamento['captacao'] == 2) echo "selected='selected'"; ?> >@lang('afericao.corrego')</option>
                        <option value="3" <?php if($cabecalho_bombeamento['captacao'] == 3) echo "selected='selected'"; ?> >@lang('afericao.lago')</option>
                        <option value="4" <?php if($cabecalho_bombeamento['captacao'] == 4) echo "selected='selected'"; ?> >@lang('afericao.lagoa')</option>
                        <option value="5" <?php if($cabecalho_bombeamento['captacao'] == 5) echo "selected='selected'"; ?> >@lang('afericao.poco')</option>
                    </select>
                    <div class="line"></div>
                </div>

                <div class="col-md-3 form-group telo5ce">
                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.latitude'), 'id' => ''])@endcomponent
                    <input type="number" step=0.000001  class="form-control" required name="latitude" value="{{$cabecalho_bombeamento['latitude']}}">
                </div>

                <div class="col-md-3 form-group telo5ce">
                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.longitude'), 'id' => ''])@endcomponent
                    <input type="number" step=0.000001 class="form-control" required name="longitude" value="{{$cabecalho_bombeamento['longitude']}}">
                </div>

                <div class="col-md-3 form-group telo5ce">
                    @component('_layouts._components._inputLabel', ['texto'=>__('afericao.numero_bombas'), 'id' => ''])@endcomponent
                    <input id="numero_bombas" type="number" class="form-control" min="1" required name="numero_bombas" value="{{$cabecalho_bombeamento['numero_bombas']}}" readonly>
                </div>
            </div>
        </div>

        <div class="text-center botaoAfericao">
            <a class="voltar ml-3" href="{{route('pumping_item_edit', $cabecalho_bombeamento['id'])}}" name="botao" style="padding: 10px; width: 250px;">@lang('Editar Item Bombeamento')</a>
        </div>
    </form>
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
                    "altitude_nivel_agua": {
                        required: true
                    },
                    "altitude_casa_bomba": {
                        required: true
                    },
                    "tipo_instalacao": {
                        required: true
                    },
                    "posicionamento_bombeamento": {
                        required: true
                    },
                    "captacao": {
                        required: true
                    },
                    "latitude": {
                        required: true
                    },
                    "longitude": {
                        required: true
                    },
                    "numero_bombas": {
                        required: true
                    }
                },
                messages: {
                    altitude_nivel_agua: "Campo <strong>ALTITUDE NIVEL DE AGUA</strong> é obrigatório",

                    "altitude_casa_bomba": {
                        required: "Campo <strong>ALTITUDE CASA DE BOMBAS</strong> é obrigatório"
                    },
                    "tipo_instalacao": {
                        required: "Campo <strong>TIPO DE INSTALAÇÃO</strong> é obrigatório"
                    },
                    "posicionamento_bombeamento": {
                        required: "Campo <strong>POSICIONAMENTO BOMBEAMENTO</strong> é obrigatório"
                    },
                    "latitude": {
                        required: "Campo <strong>LATITUDE</strong> é obrigatório"
                    },
                    "longitude": {
                        required: "Campo <strong>LONGITUDE</strong> é obrigatório"
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
