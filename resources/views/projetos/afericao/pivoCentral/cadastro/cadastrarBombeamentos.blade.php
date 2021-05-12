<?php
/*session()->get('numero_bombeamentos');
session()->get('bomba_atual');*/
$id_afericao = session()->get('id_afericao'); ?>

@extends('_layouts._layout_site')

@section('titulo')

@endsection

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">

            {{-- TITULO E SUBTITULO --}}
            <div class="col-6">
                <h1>@lang('afericao.cadastroBombeamento')</h1>
            </div>

            {{-- BOTOES SALVAR E VOLTAR --}}
            <div class="col-6 text-right botoes position">
                {{-- href="{{ route('status_afericao', $id_afericao) }}"> --}}
                <a href="{{ route('afericoes.pivo.central') }}" style="color: #3c8dbc">
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
        <div class="formafericao">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="iGerais-tab" data-toggle="tab" href="#iGerais" role="tab"
                        aria-controls="iGerais" aria-selected="true">Cadastrar bombeamento</a>
                </li>
            </ul>
            <form action="{{ route('cadastraBombeamento') }}" method="POST" id="formdados">
                @csrf
                <input type="hidden" value="{{ session()->get('id_afericao') }}" name="id_afericao">
                <div id="collapseBombeamento" class="collapse show" aria-labelledby="headingBombeamento"
                    data-parent="#accordion">
                    <div class="card-body row">
                        <div class="col-md-3 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.altitudeNivelAgua') .
                            __('unidadesAcoes.(m)'), 'id' => ''])@endcomponent
                            <input type="number" class="form-control" required name="altitude_nivel_agua">
                        </div>

                        <div class="col-md-3 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.altitudeCasaBomba') .
                            __('unidadesAcoes.(m)'), 'id' => ''])@endcomponent
                            <input type="number" class="form-control" required name="altitude_casa_bomba">
                        </div>

                        <div class="col-md-3 form-group telo5ce">
                            <label for="tipo_instalacao">@lang('afericao.tipoInstalacao')</label>
                            <select name="tipo_instalacao" class="form-control" id="tipo_instalacao">
                                <option value="0">@lang('afericao.direta')</option>
                                <option value="1">@lang('afericao.afogada')</option>
                                <option value="2">@lang('afericao.balsa')</option>
                                <option value="3">@lang('afericao.submersa')</option>
                            </select>
                            <div class="line"></div>
                        </div>

                        <div>

                        </div>

                        <div class="col-md-3 form-group telo5ce">
                            <label for="posicionamento_bombeamento">@lang('afericao.posicionamentoBombeamento')</label>
                            <select name="posicionamento_bombeamento" class="form-control" id="posicionamento_bombeamento">
                                <option value="0">@lang('afericao.simples')</option>
                                <option value="1">@lang('afericao.serie')</option>
                                <option value="2">@lang('afericao.paralelo')</option>
                            </select>
                            <div class="line"></div>
                        </div>

                        <div class="col-md-3 form-group telo5ce">
                            <label for="captacao">@lang('afericao.captacao')</label>
                            <select name="captacao" class="form-control" id="captacao">
                                <option value="0">@lang('afericao.acude')</option>
                                <option value="1">@lang('afericao.barragem')</option>
                                <option value="2">@lang('afericao.corrego')</option>
                                <option value="3">@lang('afericao.lago')</option>
                                <option value="4">@lang('afericao.lagoa')</option>
                                <option value="5">@lang('afericao.poco')</option>
                            </select>
                            <div class="line"></div>
                        </div>

                        <div class="col-md-3 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.latitude'), 'id' =>
                            ''])@endcomponent
                            <input type="number" step=0.000001 class="form-control" required name="latitude">
                        </div>

                        <div class="col-md-3 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.longitude'), 'id' =>
                            ''])@endcomponent
                            <input type="number" step=0.000001 class="form-control" required name="longitude">
                        </div>

                        <div class="col-md-3 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.numero_bombas'), 'id' =>
                            ''])@endcomponent
                            <input id="numero_bombas" type="number" class="form-control" min="1" value="1" required
                                name="numero_bombas">
                        </div>
                    </div>
                </div>
            </form>
            <script>
                $(document).ready(function() {
                    $('#botaosalvar').on('click', function() {
                        $('#formdados').submit();
                    });
                });

            </script>

                    <!-- Inclusão do Plugin jQuery Validation-->
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
        <script>
            $(document).ready(function() {
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
                    }
                });
            });
    
        </script>
        @endsection
