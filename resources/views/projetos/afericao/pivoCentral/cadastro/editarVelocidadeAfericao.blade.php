@extends('_layouts._layout_site')

@section('topo_detalhe')
    <div class="container-fluid topo">
        <div class="row align-items-start">
            {{-- TITULO E SUBTITULO --}}
            <div class="col-6">
                <h1>@lang('afericao.editarVelocidadeAfericao')</h1>
            </div>
            {{-- BOTOES SALVAR E VOLTAR  --}}
            <div class="col-6 text-right botoes">
                <a href="{{ route('gauging_speed_report', $id_afericao) }}" style="color: #3c8dbc" data-toggle="tooltip" data-placement="bottom" title="Voltar">
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
                <a class="nav-link active" id="afericoes-tab" data-toggle="tab" href="#afericoes" role="tab"
                    aria-controls="afericoes" aria-selected="true">@lang('afericao.velocidadeAfericao')</a>
            </li>            
            <li class="nav-item">
                <a class="nav-link" id="afericoesPerCentimetro-tab" data-toggle="tab" href="#afericoesPerCentimetro" role="tab"
                    aria-controls="afericoesPerCentimetro" aria-selected="true">@lang('afericao.afericaoPercentimetro')
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
        <form action="{{ route('gauging_speed_update', $id_afericao) }}" id="formdados" method="POST">
            @csrf
            <input type="hidden" name="id_afericao" value={{ $id_afericao }} />
            <div class="tab-content mt-5" id="myTabContent">
                <div class="tab-pane fade show active" id="afericoes" role="tabpanel" aria-labelledby="afericoes-tab">
                    <div class="col-md-12" id="cssPreloader">
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
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required
                                        value="{{ $velocidade['minuto01'] }}" />
                                </div>

                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.tempoSegundoMilissegundo') . __('unidadesAcoes.(s:ms)'), 'id' =>
                                    'segundo01'])@endcomponent
                                    <input class="form-control" name="segundo01" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required
                                        value="{{ $velocidade['segundo01'] }}" />
                                </div>

                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.distanciaM') .
                                    __('unidadesAcoes.(m)'), 'id' => 'distancia01'])@endcomponent
                                    <input class="form-control" name="distancia01" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required
                                        value="{{ $velocidade['distancia01'] }}" />
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
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required
                                        value="{{ $velocidade['minuto02'] }}" />
                                </div>

                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.tempoSegundoMilissegundo') . __('unidadesAcoes.(s:ms)'), 'id' =>
                                    'segundo02'])@endcomponent
                                    <input class="form-control" name="segundo02" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required
                                        value="{{ $velocidade['segundo02'] }}" />
                                </div>

                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.distanciaM') .
                                    __('unidadesAcoes.(m)'), 'id' => 'distancia02'])@endcomponent
                                    <input class="form-control" name="distancia02" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required
                                        value="{{ $velocidade['distancia02'] }}" />
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
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required
                                        value="{{ $velocidade['minuto03'] }}" />
                                </div>

                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.tempoSegundoMilissegundo') . __('unidadesAcoes.(s:ms)'), 'id' =>
                                    'segundo03'])@endcomponent
                                    <input class="form-control" name="segundo03" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required
                                        value="{{ $velocidade['segundo03'] }}" />
                                </div>

                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.distanciaM') .
                                    __('unidadesAcoes.(m)'), 'id' => 'distancia03'])@endcomponent
                                    <input class="form-control" name="distancia03" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required
                                        value="{{ $velocidade['distancia03'] }}" />
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
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required
                                        value="{{ $velocidade['minuto04'] }}" />
                                </div>

                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.tempoSegundoMilissegundo') . __('unidadesAcoes.(s:ms)'), 'id' =>
                                    'segundo04'])@endcomponent
                                    <input class="form-control" name="segundo04" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required
                                        value="{{ $velocidade['segundo04'] }}" />
                                </div>

                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.distanciaM') .
                                    __('unidadesAcoes.(m)'), 'id' => 'distancia04'])@endcomponent
                                    <input class="form-control" name="distancia04" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required
                                        value="{{ $velocidade['distancia04'] }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade show mx-3" id="afericoesPerCentimetro" role="tabpanel" aria-labelledby="afericoesPerCentimetro-tab">
                    <!------------------------Aferição Percentímetro------------------------>
                    <div>
                        <div class="form-row justify-content-start">
                            <div class="form-group col-md-4 telo5ce">
                                <b> @lang('afericao.afericaoPercentimetro')</b>
                            </div>
                        </div>
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-6 telo5ce">
                                <select class="custom-select" id="mudaDivs" name="tipo_movimento">
                                    <option value="1" <?php if ($velocidade['tipo_movimento']==1) {
                                        echo "selected='selected'" ; } ?>>
                                        @lang('afericao.movimentoContinuo')
                                    </option>
                                    <option value="0" <?php if ($velocidade['tipo_movimento']==0) {
                                        echo "selected='selected'" ; } ?>>
                                        @lang('afericao.comParada')
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <b>@lang('afericao.naoAferiu')</b>
                                <input type="checkbox" <?php if ($velocidade['nao_aferiu']==1) {
                                    echo "checked='checked'" ; } ?> class="nao_aferiu"
                                    name="nao_aferiu" />
                            </div>
                        </div>
                    </div>

                    <!------------------------MOVIMENTADO------------------------>
                    <div id="movimentando" <?php if ($velocidade['tipo_movimento']==0) { echo "style='display:none'" ; } ?>>
                        <div>
                            <div class="form-row justify-content-start">
                                <div class="form-group col-md-4 telo5ce">
                                    <b>80 @lang('unidadesAcoes.porcentagem')</b>
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.tempoMinuto') .
                                    __('unidadesAcoes.(min)'), 'id' => 'minuto_perc_01'])@endcomponent
                                    <input class="form-control" name="minuto_perc_01" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required  value="{{ $velocidade['minuto_perc_01'] }}"/>
                                </div>

                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.tempoSegundoMilissegundo') . __('unidadesAcoes.(s:ms)'), 'id' =>
                                    'segundo_perc_01'])@endcomponent
                                    <input class="form-control" name="segundo_perc_01" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required value="{{ $velocidade['segundo_perc_01'] }}"/>
                                </div>

                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.distanciaM') .
                                    __('unidadesAcoes.(m)'), 'id' => 'distancia_perc_01'])@endcomponent
                                    <input class="form-control" name="distancia_perc_01" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" required value="{{ $velocidade['distancia_perc_01'] }}"/>
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
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.tempoMinuto') .
                                    __('unidadesAcoes.(min)'), 'id' => 'minuto_perc_02'])@endcomponent
                                    <input class="form-control" name="minuto_perc_02" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" value="{{ $velocidade['minuto_perc_02'] }}"/>
                                </div>

                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.tempoSegundoMilissegundo') . __('unidadesAcoes.(s:ms)'), 'id' =>
                                    'segundo_perc_02'])@endcomponent
                                    <input class="form-control" name="segundo_perc_02" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" value="{{ $velocidade['segundo_perc_02'] }}"/>
                                </div>

                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.distanciaM') .
                                    __('unidadesAcoes.(m)'), 'id' => 'distancia_perc_02'])@endcomponent
                                    <input class="form-control" name="distancia_perc_02" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" value="{{ $velocidade['distancia_perc_02'] }}"/>
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
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.tempoMinuto') .
                                    __('unidadesAcoes.(min)'), 'id' => 'minuto_perc_03'])@endcomponent
                                    <input class="form-control" name="minuto_perc_03" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" value="{{ $velocidade['minuto_perc_03'] }}"/>
                                </div>

                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.tempoSegundoMilissegundo') . __('unidadesAcoes.(s:ms)'), 'id' =>
                                    'segundo_perc_03'])@endcomponent
                                    <input class="form-control" name="segundo_perc_03" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" value="{{ $velocidade['segundo_perc_03'] }}"/>
                                </div>

                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.distanciaM') .
                                    __('unidadesAcoes.(m)'), 'id' => 'distancia_perc_03'])@endcomponent
                                    <input class="form-control" name="distancia_perc_03" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" value="{{ $velocidade['distancia_perc_03'] }}"/>
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
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.tempoMinuto') .
                                    __('unidadesAcoes.(min)'), 'id' => 'minuto_perc_04'])@endcomponent
                                    <input class="form-control" name="minuto_perc_04" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" value="{{ $velocidade['minuto_perc_04'] }}"/>
                                </div>

                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.tempoSegundoMilissegundo') . __('unidadesAcoes.(s:ms)'), 'id' =>
                                    'segundo_perc_04'])@endcomponent
                                    <input class="form-control" name="segundo_perc_04" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" value="{{ $velocidade['segundo_perc_04'] }}"/>
                                </div>

                                <div class="form-group col-md-4 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.distanciaM') .
                                    __('unidadesAcoes.(m)'), 'id' => 'distancia_perc_04'])@endcomponent
                                    <input class="form-control" name="distancia_perc_04" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" value="{{ $velocidade['distancia_perc_04'] }}"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!------------------------PARADO------------------------>
                    <div id="parado" <?php if ($velocidade['tipo_movimento']==1) { echo "style='display:none'" ; } ?>>
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
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" value="{{ $velocidade['minuto_movi_01'] }}"/>
                                </div>

                                <div class="form-group col-md-3 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.movimentadoSeg') . __('unidadesAcoes.(s:ms)'), 'id' =>
                                    'segundo_movi_01'])@endcomponent
                                    <input class="form-control" name="segundo_movi_01" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" value="{{ $velocidade['segundo_movi_01'] }}"/>
                                </div>
                                <div class="form-group col-md-3 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.paradoMin')
                                    . __('unidadesAcoes.(min)'), 'id' => 'minuto_parado_01'])@endcomponent
                                    <input class="form-control" name="minuto_parado_01" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" value="{{ $velocidade['minuto_parado_01'] }}"/>
                                </div>

                                <div class="form-group col-md-3 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.paradoSeg')
                                    . __('unidadesAcoes.(s:ms)'), 'id' => 'segundo_parado_01'])@endcomponent
                                    <input class="form-control" name="segundo_parado_01" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" value="{{ $velocidade['segundo_parado_01'] }}"/>
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
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" value="{{ $velocidade['minuto_movi_02'] }}"/>
                                </div>

                                <div class="form-group col-md-3 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.movimentadoSeg') . __('unidadesAcoes.(s:ms)'), 'id' =>
                                    'segundo_movi_02'])@endcomponent
                                    <input class="form-control" name="segundo_movi_02" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" value="{{ $velocidade['segundo_movi_02'] }}"/>
                                </div>
                                <div class="form-group col-md-3 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.paradoMin')
                                    . __('unidadesAcoes.(min)'), 'id' => 'minuto_parado_02'])@endcomponent
                                    <input class="form-control" name="minuto_parado_02" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" value="{{ $velocidade['minuto_parado_02'] }}"/>
                                </div>

                                <div class="form-group col-md-3 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.paradoSeg')
                                    . __('unidadesAcoes.(s:ms)'), 'id' => 'segundo_parado_02'])@endcomponent
                                    <input class="form-control" name="segundo_parado_02" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" value="{{ $velocidade['segundo_parado_02'] }}"/>
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
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" value="{{ $velocidade['minuto_movi_03'] }}"/>
                                </div>

                                <div class="form-group col-md-3 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.movimentadoSeg') . __('unidadesAcoes.(s:ms)'), 'id' =>
                                    'segundo_movi_03'])@endcomponent
                                    <input class="form-control" name="segundo_movi_03" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" value="{{ $velocidade['segundo_movi_03'] }}"/>
                                </div>
                                <div class="form-group col-md-3 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.paradoMin')
                                    . __('unidadesAcoes.(min)'), 'id' => 'minuto_parado_03'])@endcomponent
                                    <input class="form-control" name="minuto_parado_03" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" value="{{ $velocidade['minuto_parado_03'] }}"/>
                                </div>

                                <div class="form-group col-md-3 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.paradoSeg')
                                    . __('unidadesAcoes.(s:ms)'), 'id' => 'segundo_parado_03'])@endcomponent
                                    <input class="form-control" name="segundo_parado_03" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" value="{{ $velocidade['segundo_parado_03'] }}"/>
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
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" value="{{ $velocidade['minuto_movi_04'] }}"/>
                                </div>

                                <div class="form-group col-md-3 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' =>
                                        __('afericao.movimentadoSeg') . __('unidadesAcoes.(s:ms)'), 'id' =>
                                    'segundo_movi_04'])@endcomponent
                                    <input class="form-control" name="segundo_movi_04" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" value="{{ $velocidade['segundo_movi_04'] }}"/>
                                </div>
                                <div class="form-group col-md-3 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.paradoMin')
                                    . __('unidadesAcoes.(min)'), 'id' => 'minuto_parado_04'])@endcomponent
                                    <input class="form-control" name="minuto_parado_04" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" value="{{ $velocidade['minuto_parado_04'] }}"/>
                                </div>

                                <div class="form-group col-md-3 telo5ce">
                                    @component('_layouts._components._inputLabel', ['texto' => __('afericao.paradoSeg')
                                    . __('unidadesAcoes.(s:ms)'), 'id' => 'segundo_parado_04'])@endcomponent
                                    <input class="form-control" name="segundo_parado_04" type="number"
                                        pattern="[0-9]+([\,|\.][0-9]+)?" step="0.01" min="0" value="{{ $velocidade['segundo_parado_04'] }}"/>
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

    {{-- SALVAR E VALIDAR CAMPOS VAZIOS --}}
    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
    <script>
        $(document).ready(function() {
            $('#botaosalvar').on('click', function() {
                $('#formdados').submit();
            });

            $("#form_submit").validate({
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
                    minuto01: "Campo <strong>TEMPO (MIN)</strong> é obrigatório",

                    "segundo01": {
                        required: "Campo <strong>TEMPO (S:MS)</strong> é obrigatório"
                    },
                    "distancia01": {
                        required: "Campo <strong>DISTÂNCIA</strong> é obrigatório"
                    },
                    "minuto02": {
                        required: "Campo <strong>TEMPO (MIN)</strong> é obrigatório"
                    },
                    "segundo02": {
                        required: "Campo <strong>TEMPO (S:MS)</strong> é obrigatório"
                    },
                    "distancia02": {
                        required: "Campo <strong>DISTÂNCIA</strong> é obrigatório"
                    },
                    "minuto03": {
                        required: "Campo <strong>TEMPO (MIN)</strong> é obrigatório"
                    },
                    "segundo03": {
                        required: "Campo <strong>TEMPO (S:MS)</strong> é obrigatório"
                    },
                    "distancia03": {
                        required: "Campo <strong>DISTÂNCIA</strong> é obrigatório",
                    },
                    "minuto04": {
                        required: "Campo <strong>TEMPO (MIN)</strong> é obrigatório"
                    },
                    "segundo04": {
                        required: "Campo <strong>TEMPO (S:MS)</strong> é obrigatório"
                    },
                    "distancia04": {
                        required: "Campo <strong>DISTÂNCIA</strong> é obrigatório"
                    },
                    "minuto_perc_01": {
                        required: "Campo <strong>TEMPO (MIN)</strong> é obrigatório"
                    },
                    "segundo_perc_01": {
                        required: "Campo <strong>TEMPO (S:MS)</strong> é obrigatório"
                    },
                    "distancia_perc_01": {
                        required: "Campo <strong>DISTÂNCIA</strong> é obrigatório"
                    },
                    "minuto_perc_02": {
                        required: "Campo <strong>TEMPO (MIN)</strong> é obrigatório"
                    },
                    "segundo_perc_02": {
                        required: "Campo <strong>TEMPO (S:MS)</strong> é obrigatório"
                    },
                    "distancia_perc_02": {
                        required: "Campo <strong>DISTÂNCIA</strong> é obrigatório"
                    },
                    "minuto_perc_03": {
                        required: "Campo <strong>TEMPO (MIN)</strong> é obrigatório"
                    },
                    "segundo_perc_03": {
                        required: "Campo <strong>TEMPO (S:MS)</strong> é obrigatório"
                    },
                    "distancia_perc_03": {
                        required: "Campo <strong>DISTÂNCIA</strong> é obrigatório"
                    },
                    "minuto_perc_04": {
                        required: "Campo <strong>TEMPO (MIN)</strong> é obrigatório"
                    },
                    "segundo_perc_04": {
                        required: "Campo <strong>TEMPO (S:MS)</strong> é obrigatório"
                    },
                    "distancia_perc_04": {
                        required: "Campo <strong>DISTÂNCIA</strong> é obrigatório"
                    },
                    "minuto_movi_01": {
                        required: "Campo <strong>TEMPO (MIN)</strong> é obrigatório"
                    },
                    "segundo_movi_01": {
                        required: "Campo <strong>TEMPO (S:MS)</strong> é obrigatório"
                    },
                    "minuto_parado_01": {
                        required: "Campo <strong>PARADO (MIN)</strong> é obrigatório"
                    },
                    "segundo_parado_01": {
                        required: "Campo <strong>PARADO (S:MS)</strong> é obrigatório"
                    },
                    "minuto_movi_02": {
                        required: "Campo <strong>TEMPO (MIN)</strong> é obrigatório"
                    },
                    "segundo_movi_02": {
                        required: "Campo <strong>TEMPO (S:MS)</strong> é obrigatório"
                    },
                    "minuto_parado_02": {
                        required: "Campo <strong>PARADO (MIN)</strong> é obrigatório"
                    },
                    "segundo_parado_02": {
                        required: "Campo <strong>PARADO (S:MS)</strong> é obrigatório"
                    },
                    "minuto_movi_03": {
                        required: "Campo <strong>TEMPO (MIN)</strong> é obrigatório"
                    },
                    "segundo_movi_03": {
                        required: "Campo <strong>TEMPO (S:MS)</strong> é obrigatório"
                    },
                    "minuto_parado_03": {
                        required: "Campo <strong>PARADO (MIN)</strong> é obrigatório"
                    },
                    "segundo_parado_03": {
                        required: "Campo <strong>PARADO (S:MS)</strong> é obrigatório"
                    },
                    "minuto_movi_04": {
                        required: "Campo <strong>TEMPO (MIN)</strong> é obrigatório"
                    },
                    "segundo_movi_04": {
                        required: "Campo <strong>TEMPO (S:MS)</strong> é obrigatório"
                    },
                    "minuto_parado_04": {
                        required: "Campo <strong>PARADO (MIN)</strong> é obrigatório"
                    },
                    "segundo_parado_04": {
                        required: "Campo <strong>PARADO (S:MS)</strong> é obrigatório"
                    },
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

    <script type="text/javascript">
        // Função de verificação se foi ou não aferido.
        function NaoAferiu(obj) {
            if (obj.checked) {
                $(obj).val(1);
                //Manipulando os inputs da div 'Movimentando'.
                $('#movimentando :input').attr("disabled", true);
                $('#movimentando :input').css("background-color", "transparent");
                $('#movimentando :input').each(function() {
                    if ($(this).val()) {
                        $(this).val('');
                        $(this).removeClass('has-value');
                        $(this).css("color", "transparent");
                    }
                });
                //Manipulando os inputs da div 'Parado'.
                $('#parado :input').attr("disabled", true);
                $('#parado :input').css("background-color", "transparent");
                $('#parado :input').each(function() {
                    if ($(this).val()) {
                        $(this).val('');
                        $(this).removeClass('has-value');
                    }
                });
            } else {
                $(obj).val(0);
                $('#movimentando :input').attr("disabled", false);
                $('#parado :input').attr("disabled", false);
                $('#movimentando :input').css("color", "black");
                $('#parado :input').css("color", "black");
            }
        }

        // Função para manipular as mudanças de divs.
        function MudaDivs(obj) {
            var select = obj.children("option:selected").val();

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
        }

        // Verificando o checkbox nos eventos de mudanças.
        $(".nao_aferiu").change(function() {
            NaoAferiu(this);
        });

        // Executa a função no evento de mudança.
        $('#mudaDivs').change(function() {
            MudaDivs($('#mudaDivs'));
        });

        $(function() {
            // Mudança de divs no ínicio da página.
            MudaDivs($('#mudaDivs'));

            //Verificando se o usuário ativou ou não o checkbox.
            NaoAferiu($(".nao_aferiu"));
        });

    </script>
@endsection
