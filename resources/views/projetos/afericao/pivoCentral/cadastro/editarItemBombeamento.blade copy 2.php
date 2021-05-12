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
    </div>
@endsection

@section('conteudo')
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="cadastro-tab" data-bs-toggle="tab" role="tab" aria-controls="cadastro"
                aria-current="page" aria-selected="true" href="#cadastro">Editar cadastro</a>
        </li>
    </ul>
    <form action="{{ route('editaItemBombeamento') }}" method="POST" id="formdados">
        @foreach ($bombeamentos as $bombeamento)
            <input type="hidden" name="id[]" value="{{ $bombeamento->id }}">
            <div class="col-md-12 formpivocentral">
                <div class="form-row justify-content-center">
                    <div class="col-md-3 form-group telo5ce">
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.comprimentoSuccao') .
                        __('unidadesAcoes.(m)'), 'id' => ''])@endcomponent
                        <input type="number" id="comprimento_succao_{{ $key }}"
                            value="{{ $bombeamento['comprimento_succao'] }}" class="form-control" required
                            name="comprimento_succao[]">
                    </div>

                    <div class="col-md-3 form-group telo5ce">
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.diametroSuccao') .
                        __('unidadesAcoes.(m)'), 'id' => ''])@endcomponent
                        <input type="number" class="form-control" value="{{ $bombeamento['diametro_succao'] }}" required
                            name="diametro_succao[]">
                    </div>

                    <div class="col-md-3 form-group telo5ce">
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.marca'), 'id' =>
                        ''])@endcomponent
                        <input type="text" class="form-control" value="{{ $bombeamento['marca'] }}" required
                            name="marca[]">
                    </div>

                    <div class="col-md-3 form-group telo5ce">
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.modelo'), 'id' =>
                        ''])@endcomponent
                        <input type="text" class="form-control" value="{{ $bombeamento['modelo'] }}" required
                            name="modelo[]">
                    </div>
                </div>

                <div class="form-row justify-content-center">
                    <div class="col-md-3 form-group telo5ce">
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.numeroRotores'), 'id' =>
                        ''])@endcomponent
                        <input type="number" class="form-control" value="{{ $bombeamento['numero_rotores'] }}" required
                            name="numero_rotores[]">
                    </div>

                    <div class="col-md-3 form-group telo5ce">
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.diametroRotor') .
                        __('unidadesAcoes.(mm)'), 'id' => ''])@endcomponent
                        <input type="number" class="form-control" value="{{ $bombeamento['diametro_rotor'] }}" required
                            name="diametro_rotor[]">
                    </div>

                    <div class="col-md-3 form-group telo5ce">
                        <label for="mat_succao">@lang('afericao.materialSuccao')</label>
                        <select name="material_succao[]" class="form-control" id="mat_succao{{ $key }}">
                            <option @if ($bombeamento['material_succao'] == '0') selected @endif value="0">@lang('afericao.acoSac')</option>
                            <option @if ($bombeamento['material_succao'] == '1') selected @endif value="1">@lang('afericao.AZ')</option>
                            <option @if ($bombeamento['material_succao'] == '2') selected @endif value="2">@lang('afericao.PVC')</option>
                            <option @if ($bombeamento['material_succao'] == '3') selected @endif value="3">@lang('afericao.RPVC')</option>
                        </select>
                        <div class="line"></div>
                    </div>

                    <div class="col-md-3 form-group telo5ce">
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.rendimentoBomba') .
                        __('unidadesAcoes.(%)'), 'id' => ''])@endcomponent
                        <input type="number" class="form-control" value="{{ $bombeamento['rendimento_bomba'] }}" required
                            name="rendimento_bomba[]">
                    </div>
                </div>

                <div class="form-row justify-content-center">
                    <div class="col-md-3 form-group telo5ce">
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.shutoff') .
                        __('unidadesAcoes.(mca)'), 'id' => ''])@endcomponent
                        <input type="number" class="form-control" value="{{ $bombeamento['shutoff'] }}" required
                            name="shutoff[]">
                    </div>

                    <div class="col-md-3 form-group telo5ce">
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.rotacao') .
                        __('unidadesAcoes.(rpm)'), 'id' => ''])@endcomponent
                        <input type="number" class="form-control" value="{{ $bombeamento['rotacao'] }}" required
                            name="rotacao[]">
                    </div>

                    <div class="col-md-3 form-group telo5ce">
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.pressaoBomba') .
                        __('unidadesAcoes.(mca)'), 'id' => ''])@endcomponent
                        <input type="number" class="form-control" value="{{ $bombeamento['pressao_bomba'] }}" required
                            name="pressao_bomba[]">
                    </div>
                </div>

                {{-- MOTOR --}}
                <div class="form-row justify-content-center">
                    <div class="col-12">
                        <h4>@lang("afericao.motor")</h4>
                    </div>
                </div>

                <div class="form-row justify-content-center">
                    <div class="col-md-3 form-group telo5ce">
                        <label for="tipo_motor">@lang('afericao.tipo_motor')</label>
                        <select name="tipo_motor[]" onchange="tipoMotor({{ $key }})" class="form-control"
                            id="tipo_motor_{{ $key }}">
                            <option @if ($bombeamento['tipo_motor'] == 'diesel') selected @endif value="diesel">@lang('afericao.diesel') </option>
                            <option @if ($bombeamento['tipo_motor'] == 'eletrico') selected @endif value="eletrico"> @lang('afericao.eletrico')</option>
                        </select>
                        <div class="line"></div>
                    </div>

                    <div class="col-md-3 form-group telo5ce">
                        <input type="text" class="form-control" value="{{ $bombeamento['modelo_motor'] }}" required
                            name="modelo_motor[]">
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.modelo'), 'id' =>
                        ''])@endcomponent
                    </div>

                    <div class="col-md-3 form-group telo5ce">
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.potencia') .
                        __('unidadesAcoes.(cv)'), 'id' => ''])@endcomponent
                        <input type="number" class="form-control" value="{{ $bombeamento['potencia'] }}" required
                            name="potencia[]">
                    </div>

                    <div class="col-md-3 form-group telo5ce">
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.numeroMotores'), 'id' =>
                        ''])@endcomponent
                        <input type="number" class="form-control" value="{{ $bombeamento['numero_motores'] }}" required
                            name="numero_motores[]">
                    </div>
                </div>

                <div class="form-row justify-content-center">
                    <div class="col-md-3 form-group telo5ce">
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.fatorServico'), 'id' =>
                        ''])@endcomponent
                        <input type="number" value="{{ $bombeamento['fator_servico'] }}" class="form-control" required
                            name="fator_servico[]">
                    </div>

                    <div class="col-md-3 form-group telo5ce">
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.correnteNominal') .
                        __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent
                        <input type="number" value="{{ $bombeamento['corrente_nominal'] }}" class="form-control"
                            id="corrente_nominal{{ $key }}" name="corrente_nominal[]">
                    </div>

                    <div class="col-md-3 form-group telo5ce">
                        @component('_layouts._components._inputLabel', ['texto' => __('afericao.rendimento'), 'id' =>
                        ''])@endcomponent
                        <input type="number" value="{{ $bombeamento['rendimento'] }}" class="form-control" required
                            name="rendimento[]">
                    </div>
                </div>

                <div style="display:none;" class="motorEletrico" id="motorEletrico_{{ $key }}">
                    {{-- ELETRICO --}}
                    <div class="form-row justify-content-start">
                        <div class="col-md-3 form-group telo5ce" id="div_tensao_nominal_'+i+'">
                            <label for="tensao_nominal">@lang("afericao.tensaoNominal")</label>
                            <select name="tensao_nominal[]" class="form-control" id="tensao_nominal_'+i+'">
                                <option value="220">220V</option>
                                <option value="380">380V</option>
                                <option value="440">440V</option>
                            </select>
                            <div class="line"></div>
                        </div>

                        <div class="col-md-3 form-group telo5ce" id="div_frequenhiddencia_'+i+'">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.frequencia'), 'id' =>
                            ''])@endcomponent
                            <input type="number" value="60" class="form-control has-value" required name="frequencia[]"
                                id="frequencia_'+i+'">
                        </div>

                        <div class="col-md-3 form-group telo5ce" id="divChavePartida_'+i+'">
                            <label for="chave_partida">@lang("afericao.chavePartida")</label>
                            <select name="chave_partida[]" class="form-control" id="chave_partida_'+i+'">
                                <option value="0">Sem Chave</option>
                                <option selected value="1">@lang("afericao.serieParalela")</option>
                                <option value="2">@lang("afericao.estrelaTriangulo")</option>
                                <option value="3">@lang("afericao.compensadora")</option>
                                <option value="4">@lang("afericao.softStarter")</option>
                            </select>
                            <div class="line"></div>
                        </div>

                        <div class="col-md-3 form-group telo5ce" id="div_corrente_nominal_'+i+'">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.correnteNominal') .
                            __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent
                            <input type="number" step="0.01" class="form-control" id="corrente_nominal_'+i+'"
                                name="corrente_nominal[]">
                        </div>
                    </div>

                    {{-- LEITURA 1 --}}
                    <div class="form-row justify-content-start">
                        <div class="col-12">
                            <h3>@lang("afericao.leitura1")</h3>
                            <h4>@lang("afericao.corrente")</h4>
                        </div>
                    </div>

                    <div class="form-row justify-content-start">
                        <div class="col-md-4 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase1') .
                            __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent
                            <input type="number" step="0.001" value="{{ $bombeamento['corrente_leitura_1_fase_1'] }}"
                                class="form-control" required id="corrente_leitura_1_fase_1{{ $key + 1 }}"
                                name="corrente_leitura_1_fase_1[]">
                        </div>

                        <div class="col-md-4 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase2') .
                            __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent
                            <input type="number" step="0.001" value="{{ $bombeamento['corrente_leitura_1_fase_2'] }}"
                                class="form-control" required id="corrente_leitura_1_fase_2{{ $key + 1 }}"
                                name="corrente_leitura_1_fase_2[]">
                        </div>

                        <div class="col-md-4 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase3') .
                            __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent
                            <input type="number" step="0.001" value="{{ $bombeamento['corrente_leitura_1_fase_3'] }}"
                                class="form-control" required id="corrente_leitura_1_fase_3{{ $key + 1 }}"
                                name="corrente_leitura_1_fase_3[]">
                        </div>
                    </div>

                    <div class="form-row justify-content-start">
                        <h4 class="col-12 ">@lang("afericao.tensao")</h4>
                    </div>

                    <div class="form-row justify-content-start">
                        <div class="col-md-4 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase1') .
                            __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent
                            <input type="number" value="{{ $bombeamento['tensao_leitura_1_fase_1'] }}"
                                class="form-control" required name="tensao_leitura_1_fase_1[]"
                                id="tensao_leitura_1_fase_1{{ $key + 1 }}">
                        </div>

                        <div class="col-md-4 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase2') .
                            __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent
                            <input type="number" value="{{ $bombeamento['tensao_leitura_1_fase_2'] }}"
                                class="form-control" required name="tensao_leitura_1_fase_2[]"
                                id="tensao_leitura_1_fase_2{{ $key + 1 }}">
                        </div>

                        <div class="col-md-4 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase3') .
                            __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent
                            <input type="number" value="{{ $bombeamento['tensao_leitura_1_fase_3'] }}"
                                class="form-control" required name="tensao_leitura_1_fase_3[]"
                                id="tensao_leitura_1_fase_3{{ $key + 1 }}">
                        </div>
                    </div>

                    <div class="form-row justify-content-start">
                        <div class="col-md-4 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.indice_carregamento'),
                            'id' => ''])@endcomponent
                            <input type="number" class="form-control" value="0" step="0.01" readonly
                                id="indice_carregamento_leitura_1_fase_1{{ $key + 1 }}">
                        </div>

                        <div class="col-md-4 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.indice_carregamento'),
                            'id' => ''])@endcomponent
                            <input type="number" class="form-control" value="0" step="0.01" readonly
                                id="indice_carregamento_leitura_1_fase_2{{ $key + 1 }}">
                        </div>

                        <div class="col-md-4 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.indice_carregamento'),
                            'id' => ''])@endcomponent
                            <input type="number" class="form-control" value="0" step="0.01" readonly
                                id="indice_carregamento_leitura_1_fase_3{{ $key + 1 }}">
                        </div>
                    </div>

                    {{-- LEITURA 2 --}}
                    <div class="form-row justify-content-start">
                        <div class="col-12">
                            <h3>@lang("afericao.leitura2")</h3>
                            <h4>@lang("afericao.corrente")</h4>
                        </div>
                    </div>

                    <div class="form-row justify-content-start">
                        <div class="col-md-4 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase1') .
                            __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent
                            <input type="number" step="0.001" value="{{ $bombeamento['corrente_leitura_2_fase_1'] }}"
                                class="form-control" id="corrente_leitura_2_fase_1{{ $key + 1 }}"
                                name="corrente_leitura_2_fase_1[]">
                        </div>

                        <div class="col-md-4 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase2') .
                            __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent
                            <input type="number" step="0.001" value="{{ $bombeamento['corrente_leitura_2_fase_2'] }}"
                                class="form-control" id="corrente_leitura_2_fase_2{{ $key + 1 }}"
                                name="corrente_leitura_2_fase_2[]">
                        </div>

                        <div class="col-md-4 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase3') .
                            __('unidadesAcoes.(a)'), 'id' => ''])@endcomponent
                            <input type="number" step="0.001" value="{{ $bombeamento['corrente_leitura_2_fase_3'] }}"
                                class="form-control" id="corrente_leitura_2_fase_3{{ $key + 1 }}"
                                name="corrente_leitura_2_fase_3[]">
                        </div>
                    </div>

                    <div class="form-row justify-content-start">
                        <h4 class="col-12 ">@lang("afericao.tensao")</h4>
                    </div>

                    <div class="form-row justify-content-start">
                        <div class="col-md-4 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase1') .
                            __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent
                            <input type="number" value="{{ $bombeamento['tensao_leitura_2_fase_1'] }}"
                                class="form-control" name="tensao_leitura_2_fase_1[]"
                                id="tensao_leitura_2_fase_1{{ $key + 1 }}">
                        </div>

                        <div class="col-md-4 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase2') .
                            __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent
                            <input type="number" value="{{ $bombeamento['tensao_leitura_2_fase_2'] }}"
                                class="form-control" name="tensao_leitura_2_fase_2[]"
                                id="tensao_leitura_2_fase_2{{ $key + 1 }}">
                        </div>

                        <div class="col-md-4 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.fase3') .
                            __('unidadesAcoes.(v)'), 'id' => ''])@endcomponent
                            <input type="number" value="{{ $bombeamento['tensao_leitura_2_fase_3'] }}"
                                class="form-control" name="tensao_leitura_2_fase_3[]"
                                id="tensao_leitura_2_fase_3{{ $key + 1 }}">
                        </div>
                    </div>

                    <div class="form-row justify-content-start">
                        <div class="col-md-4 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.indice_carregamento'),
                            'id' => ''])@endcomponent
                            <input type="number" class="form-control" value="0" step="0.01" readonly
                                id="indice_carregamento_leitura_2_fase_1{{ $key + 1 }}">
                        </div>

                        <div class="col-md-4 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.indice_carregamento'),
                            'id' => ''])@endcomponent
                            <input type="number" class="form-control" value="0" step="0.01" readonly
                                id="indice_carregamento_leitura_2_fase_2{{ $key + 1 }}">
                        </div>

                        <div class="col-md-4 form-group telo5ce">
                            @component('_layouts._components._inputLabel', ['texto' => __('afericao.indice_carregamento'),
                            'id' => ''])@endcomponent
                            <input type="number" class="form-control" value="0" step="0.01" readonly
                                id="indice_carregamento_leitura_2_fase_3{{ $key + 1 }}">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </form>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#botaosalvar').on('click', function() {
                $('#formdados').submit();
            });
        });

        function tipoMotor(val) {
            bombeamento = $("#tipo_motor_" + val + " option:selected").val();
            motorEletrico = document.getElementById('motorEletrico_' + val);
            if (bombeamento != "diesel") {
                motorEletrico.style.display = 'block';
            } else {
                motorEletrico.style.display = 'none';
            }
        }

    </script>
@endsection
