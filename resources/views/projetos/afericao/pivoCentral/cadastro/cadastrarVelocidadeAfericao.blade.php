@extends('_layouts._layout_site')

@section('titulo')
    @lang('afericao.velocidadeAfericao')
@endsection

@section('topo_detalhe')

<div class="container-fluid topo">
    <div class="row align-items-start">

        {{-- TITULO E SUBTITULO --}}
        <div class="col-6">
            <h1>@lang('afericao.velocidadeAfericao')</h1>
        </div>

        {{-- BOTOES SALVAR E VOLTAR --}}
        <div class="col-6 text-right botoes position">
            <a href="{{ route('status_afericao', $id_afericao) }}" style="color: #3c8dbc">
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
    <div class="formafericao">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="afericoes-tab" data-toggle="tab" href="#afericoes" role="tab"
                    aria-controls="afericoes" aria-selected="true">@lang('afericao.velocidadeAfericao')</a>
            </li>
        </ul>
        <form action="{{ route('velocidade_cadastra', $id_afericao) }}" id="form_submit" method="POST">
            @csrf
            <input type="hidden" name="id_afericao" value={{ $id_afericao }} />
            <div class="tab-content mt-5" id="myTabContent">
                <div class="tab-pane fade show active" id="afericoes" role="tabpanel" aria-labelledby="afericoes-tab">
                    <div class="col-md-12">
                        <!------------------------Velocidade 100%------------------------>
                        <div>
                            <div class="form-row justify-content-start">
                                <div class="form-group col-md-4 telo5ce">
                                    <b> @lang('afericao.afericao01')</b>
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.tempoMinuto') .
                                    __('unidadesAcoes.(min)'), 'id' => 'minuto01'])@endcomponent
                                    <input class="form-control" name="minuto01" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required />
                                </div>

                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.tempoSegundoMilissegundo') . __('unidadesAcoes.(s:ms)'), 'id' =>
                                    'segundo01'])@endcomponent
                                    <input class="form-control" name="segundo01" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required />
                                </div>

                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.distanciaM') .
                                    __('unidadesAcoes.(m)'), 'id' => 'distancia01'])@endcomponent
                                    <input class="form-control" name="distancia01" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required />
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="form-row justify-content-start">
                                <div class="form-group col-md-4 telo5ce">
                                    <b> @lang('afericao.afericao02')</b>
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.tempoMinuto') .
                                    __('unidadesAcoes.(min)'), 'id' => 'minuto02'])@endcomponent
                                    <input class="form-control" name="minuto02" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required />
                                </div>

                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.tempoSegundoMilissegundo') . __('unidadesAcoes.(s:ms)'), 'id' =>
                                    'segundo02'])@endcomponent
                                    <input class="form-control" name="segundo02" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required />
                                </div>

                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.distanciaM') .
                                    __('unidadesAcoes.(m)'), 'id' => 'distancia02'])@endcomponent
                                    <input class="form-control" name="distancia02" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required />
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="form-row justify-content-start">
                                <div class="form-group col-md-4 telo5ce">
                                    <b> @lang('afericao.afericao03')</b>
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.tempoMinuto') .
                                    __('unidadesAcoes.(min)'), 'id' => 'minuto03'])@endcomponent
                                    <input class="form-control" name="minuto03" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required />
                                </div>

                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.tempoSegundoMilissegundo') . __('unidadesAcoes.(s:ms)'), 'id' =>
                                    'segundo03'])@endcomponent
                                    <input class="form-control" name="segundo03" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required />
                                </div>

                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.distanciaM') .
                                    __('unidadesAcoes.(m)'), 'id' => 'distancia03'])@endcomponent
                                    <input class="form-control" name="distancia03" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required />
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="form-row justify-content-start">
                                <div class="form-group col-md-4 telo5ce">
                                    <b> @lang('afericao.afericao04')</b>
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.tempoMinuto') .
                                    __('unidadesAcoes.(min)'), 'id' => 'minuto04'])@endcomponent
                                    <input class="form-control" name="minuto04" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                </div>

                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.tempoSegundoMilissegundo') . __('unidadesAcoes.(s:ms)'), 'id' =>
                                    'segundo04'])@endcomponent
                                    <input class="form-control" name="segundo04" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                </div>

                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.distanciaM') .
                                    __('unidadesAcoes.(m)'), 'id' => 'distancia04'])@endcomponent
                                    <input class="form-control" name="distancia04" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                </div>
                            </div>
                        </div>

                        <!------------------------Aferição Percentímetro------------------------>

                        <div>
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


                        <!------------------------MOVIMENTADO------------------------>
                        <div id="movimentando">
                            <div>
                                <div class="form-row justify-content-start">
                                    <div class="form-group col-md-4 telo5ce">
                                        <b>80 @lang('unidadesAcoes.porcentagem')</b>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-4 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.tempoMinuto') . __('unidadesAcoes.(min)'), 'id' =>
                                        'minuto_perc_01'])@endcomponent
                                        <input class="form-control" name="minuto_perc_01" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required />
                                    </div>

                                    <div class="form-group col-md-4 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.tempoSegundoMilissegundo') . __('unidadesAcoes.(s:ms)'), 'id' =>
                                        'segundo_perc_01'])@endcomponent
                                        <input class="form-control" name="segundo_perc_01" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required />
                                    </div>

                                    <div class="form-group col-md-4 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.distanciaM')
                                        . __('unidadesAcoes.(m)'), 'id' => 'distancia_perc_01'])@endcomponent
                                        <input class="form-control" name="distancia_perc_01" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required />
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="form-row justify-content-start">
                                    <div class="form-group col-md-4 telo5ce">
                                        <b>60 @lang('unidadesAcoes.porcentagem')</b>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-4 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.tempoMinuto') . __('unidadesAcoes.(min)'), 'id' =>
                                        'minuto_perc_02'])@endcomponent
                                        <input class="form-control" name="minuto_perc_02" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                    </div>

                                    <div class="form-group col-md-4 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.tempoSegundoMilissegundo') . __('unidadesAcoes.(s:ms)'), 'id' =>
                                        'segundo_perc_02'])@endcomponent
                                        <input class="form-control" name="segundo_perc_02" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                    </div>

                                    <div class="form-group col-md-4 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.distanciaM')
                                        . __('unidadesAcoes.(m)'), 'id' => 'distancia_perc_02'])@endcomponent
                                        <input class="form-control" name="distancia_perc_02" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="form-row justify-content-start">
                                    <div class="form-group col-md-4 telo5ce">
                                        <b>40 @lang('unidadesAcoes.porcentagem')</b>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-4 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.tempoMinuto') . __('unidadesAcoes.(min)'), 'id' =>
                                        'minuto_perc_03'])@endcomponent
                                        <input class="form-control" name="minuto_perc_03" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                    </div>

                                    <div class="form-group col-md-4 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.tempoSegundoMilissegundo') . __('unidadesAcoes.(s:ms)'), 'id' =>
                                        'segundo_perc_03'])@endcomponent
                                        <input class="form-control" name="segundo_perc_03" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                    </div>

                                    <div class="form-group col-md-4 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.distanciaM')
                                        . __('unidadesAcoes.(m)'), 'id' => 'distancia_perc_03'])@endcomponent
                                        <input class="form-control" name="distancia_perc_03" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="form-row justify-content-start">
                                    <div class="form-group col-md-4 telo5ce">
                                        <b>20 @lang('unidadesAcoes.porcentagem')</b>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-4 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.tempoMinuto') . __('unidadesAcoes.(min)'), 'id' =>
                                        'minuto_perc_04'])@endcomponent
                                        <input class="form-control" name="minuto_perc_04" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                    </div>

                                    <div class="form-group col-md-4 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.tempoSegundoMilissegundo') . __('unidadesAcoes.(s:ms)'), 'id' =>
                                        'segundo_perc_04'])@endcomponent
                                        <input class="form-control" name="segundo_perc_04" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                    </div>

                                    <div class="form-group col-md-4 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.distanciaM')
                                        . __('unidadesAcoes.(m)'), 'id' => 'distancia_perc_04'])@endcomponent
                                        <input class="form-control" name="distancia_perc_04" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!------------------------PARADO------------------------>
                        <div id="parado" style="display:none;">
                            <div>
                                <b>Com parada</b>
                            </div>

                            <div>
                                <div class="form-row justify-content-start">
                                    <div class="form-group col-md-3 telo5ce">
                                        <b>80 @lang('unidadesAcoes.porcentagem')</b>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-3 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.movimentadoMin') . __('unidadesAcoes.(min)'), 'id' =>
                                        'minuto_movi_01'])@endcomponent
                                        <input class="form-control" name="minuto_movi_01" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                    </div>

                                    <div class="form-group col-md-3 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.movimentadoSeg') . __('unidadesAcoes.(s:ms)'), 'id' =>
                                        'segundo_movi_01'])@endcomponent
                                        <input class="form-control" name="segundo_movi_01" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                    </div>
                                    <div class="form-group col-md-3 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.paradoMin')
                                        . __('unidadesAcoes.(min)'), 'id' => 'minuto_parado_01'])@endcomponent
                                        <input class="form-control" name="minuto_parado_01" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                    </div>

                                    <div class="form-group col-md-3 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.paradoSeg')
                                        . __('unidadesAcoes.(s:ms)'), 'id' => 'segundo_parado_01'])@endcomponent
                                        <input class="form-control" name="segundo_parado_01" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="form-row justify-content-start">
                                    <div class="form-group col-md-3 telo5ce">
                                        <b>60 @lang('unidadesAcoes.porcentagem')</b>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-3 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.movimentadoMin') . __('unidadesAcoes.(min)'), 'id' =>
                                        'minuto_movi_02'])@endcomponent
                                        <input class="form-control" name="minuto_movi_02" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                    </div>

                                    <div class="form-group col-md-3 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.movimentadoSeg') . __('unidadesAcoes.(s:ms)'), 'id' =>
                                        'segundo_movi_02'])@endcomponent
                                        <input class="form-control" name="segundo_movi_02" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                    </div>
                                    <div class="form-group col-md-3 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.paradoMin')
                                        . __('unidadesAcoes.(min)'), 'id' => 'minuto_parado_02'])@endcomponent
                                        <input class="form-control" name="minuto_parado_02" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                    </div>

                                    <div class="form-group col-md-3 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.paradoSeg')
                                        . __('unidadesAcoes.(s:ms)'), 'id' => 'segundo_parado_02'])@endcomponent
                                        <input class="form-control" name="segundo_parado_02" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="form-row justify-content-start">
                                    <div class="form-group col-md-3 telo5ce">
                                        <b>40 @lang('unidadesAcoes.porcentagem')</b>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-3 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.movimentadoMin') . __('unidadesAcoes.(min)'), 'id' =>
                                        'minuto_movi_03'])@endcomponent
                                        <input class="form-control" name="minuto_movi_03" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                    </div>

                                    <div class="form-group col-md-3 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.movimentadoSeg') . __('unidadesAcoes.(s:ms)'), 'id' =>
                                        'segundo_movi_03'])@endcomponent
                                        <input class="form-control" name="segundo_movi_03" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                    </div>
                                    <div class="form-group col-md-3 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.paradoMin')
                                        . __('unidadesAcoes.(min)'), 'id' => 'minuto_parado_03'])@endcomponent
                                        <input class="form-control" name="minuto_parado_03" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                    </div>

                                    <div class="form-group col-md-3 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.paradoSeg')
                                        . __('unidadesAcoes.(s:ms)'), 'id' => 'segundo_parado_03'])@endcomponent
                                        <input class="form-control" name="segundo_parado_03" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="form-row justify-content-start">
                                    <div class="form-group col-md-3 telo5ce">
                                        <b>20 @lang('unidadesAcoes.porcentagem')</b>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-3 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.movimentadoMin') . __('unidadesAcoes.(min)'), 'id' =>
                                        'minuto_movi_04'])@endcomponent
                                        <input class="form-control" name="minuto_movi_04" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                    </div>

                                    <div class="form-group col-md-3 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' =>
                                            __('afericao.movimentadoSeg') . __('unidadesAcoes.(s:ms)'), 'id' =>
                                        'segundo_movi_04'])@endcomponent
                                        <input class="form-control" name="segundo_movi_04" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                    </div>
                                    <div class="form-group col-md-3 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.paradoMin')
                                        . __('unidadesAcoes.(min)'), 'id' => 'minuto_parado_04'])@endcomponent
                                        <input class="form-control" name="minuto_parado_04" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                    </div>

                                    <div class="form-group col-md-3 telo5ce">
                                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.paradoSeg')
                                        . __('unidadesAcoes.(s:ms)'), 'id' => 'segundo_parado_04'])@endcomponent
                                        <input class="form-control" name="segundo_parado_04" type="number"
                                            pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" />
                                    </div>
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

    <script>
        $(document).ready(function() {
            $('#botaosalvar').on('click', function() {
                $('#form_submit').submit();
                $("#botao").val("salvar");
            });
        });

    </script>

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
@endsection
