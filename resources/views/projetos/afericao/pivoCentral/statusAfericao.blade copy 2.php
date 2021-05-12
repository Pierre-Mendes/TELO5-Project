@extends('_layouts._layout_site')

@section('titulo')
    @if ($tipo_projeto == 'R')
        @lang('redimensionamento.statusRedimensionamento')
    @else
        @lang('afericao.statusAfericao')
    @endif
@endsection

@section('topo_detalhe')

<div class="container-fluid topo">
    <div class="row align-items-start">

        {{-- TITULO E SUBTITULO --}}
        <div class="col-6">
            <h1>
                @if ($tipo_projeto == 'R')
                    @lang('redimensionamento.statusRedimensionamento')
                @else
                    @lang('afericao.statusAfericao')
                @endif
            </h1>
            <p>teste</p>
        </div>

        {{-- BOTOES SALVAR E VOLTAR  --}}
        <div class="col-6 text-right botoes">
            <a href="{{ route('afericoes.pivo.central') }}" style="color: #3c8dbc">
                <button type="button">
                    <span class="fa-stack fa-lg">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fas fa-angle-double-left fa-stack-1x fa-inverse"></i>
                    </span>
                </button>
            </a>
        </div>
    </div>
</div>
@endsection

@section('conteudo')
    {{-- <div class="col-md-12">
        <div class="form-row justify-content-center">
            <div class="form-group col-2 text-center border afericao">
                <div>
                    <h3>
                        @if ($tipo_projeto == 'R')
                            @lang('redimensionamento.configurar_redimensionamento')
                        @else
                            @lang('afericao.afericao')
                        @endif

                        @if ($afericao['condicao'] == 'ok')
                            <i class="{{ $afericao['icone'] }}"></i>
                        @endif
                    </h3>
                </div>
                <div class="p-3" style="background-color: {{ $emissores['cor'] }} !important;">
                    <a href="{{ route($afericao['acao'], $afericao['parametro']) }}" class="small-box-footer">
                        @lang($afericao['botao']) <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="form-group col-md-2 text-center">
                <div>
                    <h3>
                        @lang('afericao.mapaBocais')
                    </h3>
                </div>
                <div class="p-3" style="background-color: {{ $emissores['cor'] }} !important;">
                    <a href="{{ route($emissores['acao'], $emissores['parametro']) }}" class="small-box-footer">
                        @lang($emissores['botao']) <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="form-group col-md-2 text-center">
                <div>
                    <h3>
                        @lang('afericao.adutora')
                    </h3>
                </div>
                <div class="p-3" style="background-color: {{ $adutora['cor'] }} !important;">
                    <a href="{{ route($adutora['acao'], $adutora['parametro']) }}" class="small-box-footer">
                        @lang($adutora['botao']) <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="form-group col-md-2 text-center">
                <div>
                    <h3>
                        @lang('afericao.bombeamento')
                    </h3>
                </div>
                <div class="p-3" style="background-color: {{ $bombeamento['cor'] }} !important;">
                    <a href="{{ route($bombeamento['acao'], $bombeamento['parametro']) }}" class="small-box-footer">
                        @lang($bombeamento['botao']) <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="form-group col-md-2 text-center">
                <div>
                    <h3>
                        @lang('afericao.velocidadeAfericao')
                    </h3>
                </div>
                <div class="p-3" style="background-color: {{ $velocidade['cor'] }} !important;">
                    <a href="{{ route($velocidade['acao'], $velocidade['parametro']) }}" class="small-box-footer">
                        @lang($velocidade['botao']) <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="form-row justify-content-center">
            <div class="form-group col-md-3 text-center">
                <div>
                    <h3>Aferição</h3>
                </div>
                <div>EDITAR</div>
            </div>
            <div class="form-group col-md-3 text-center">
                <div>
                    <h3>Aferição</h3>
                </div>
                <div>EDITAR</div>
            </div>
            <div class="form-group col-md-3 text-center">
                <div>
                    <h3>Aferição</h3>
                </div>
                <div>EDITAR</div>
            </div>
        </div>
    </div> --}}

    <div class="col-md-12">
        <div class="form-row justify-content-center">
            <div class="form-group col-md-2 text-center afericao p-2">
                <div>
                    <h3>
                        @if ($tipo_projeto == 'R')
                            @lang('redimensionamento.configurar_redimensionamento')
                        @else
                            @lang('afericao.afericao')
                        @endif
                        @if ($afericao['condicao'] == 'ok')
                            <i class="{{ $afericao['icone'] }}"
                                style="font-size: 15px; float: right;margin-top: 5px; color:{{ $afericao['cor'] }} !important;"></i>
                        @endif
                    </h3>
                </div>
                <div class="p-2" style="background-color: {{ $afericao['cor'] }} !important;">
                    <a href="{{ route($afericao['acao'], $afericao['parametro']) }}">
                        <span class="editar">{{ strtoupper(__($afericao['botao'])) }}</span>
                        <span class="fa-stack fa-xs">
                            <div>
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-pen fa-stack-1x fa-inverse"
                                    style="color:{{ $afericao['cor'] }} !important;"></i>
                            </div>
                        </span>
                    </a>
                </div>
            </div>

            <div class="form-group col-md-2 text-center afericao p-2">
                <div>
                    <h3>
                        @lang('afericao.mapaBocais')

                        @if ($emissores['condicao'] == 'ok')
                            <i class="{{ $emissores['icone'] }}"
                                style="font-size: 15px; float: right;margin-top: 5px; color:{{ $emissores['cor'] }} !important;"></i>
                        @endif
                    </h3>
                </div>
                <div class="p-2" style="background-color: {{ $emissores['cor'] }} !important;">
                    <a href="{{ route($emissores['acao'], $emissores['parametro']) }}">
                        <span class="editar">{{ strtoupper(__($emissores['botao'])) }}</span>
                        <span class="fa-stack fa-xs">
                            <div>
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-pen fa-stack-1x fa-inverse"
                                    style="color:{{ $emissores['cor'] }} !important;"></i>
                            </div>
                        </span>
                    </a>
                </div>
            </div>

            <div class="form-group col-md-2 text-center afericao p-2">
                <div>
                    <h3>
                        @lang('afericao.adutora')

                        @if ($adutora['condicao'] == 'ok')
                            <i class="{{ $adutora['icone'] }}"
                                style="font-size: 15px; float: right;margin-top: 5px; color:{{ $adutora['cor'] }} !important;"></i>
                        @endif
                    </h3>
                </div>
                <div class="p-2" style="background-color: {{ $adutora['cor'] }} !important;">
                    <a href="{{ route($adutora['acao'], $adutora['parametro']) }}">
                        <span class="editar">{{ strtoupper(__($adutora['botao'])) }}</span>
                        <span class="fa-stack fa-xs">
                            <div>
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-pen fa-stack-1x fa-inverse"
                                    style="color:{{ $adutora['cor'] }} !important;"></i>
                            </div>
                        </span>
                    </a>
                </div>
            </div>

            <div class="form-group col-md-2 text-center afericao p-2">
                <div>
                    <h3>
                        @lang('afericao.bombeamento')

                        @if ($bombeamento['condicao'] == 'ok')
                            <i class="{{ $bombeamento['icone'] }}"
                                style="font-size: 15px; float: right;margin-top: 5px; color:{{ $bombeamento['cor'] }} !important;"></i>
                        @endif
                    </h3>
                </div>
                <div class="p-2" style="background-color: {{ $bombeamento['cor'] }} !important;">
                    <a href="{{ route($bombeamento['acao'], $bombeamento['parametro']) }}">
                        <span class="editar">{{ strtoupper(__($bombeamento['botao'])) }}</span>
                        <span class="fa-stack fa-xs">
                            <div>
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-pen fa-stack-1x fa-inverse"
                                    style="color:{{ $bombeamento['cor'] }} !important;"></i>
                            </div>
                        </span>
                    </a>
                </div>
            </div>
            <div class="form-group col-md-2 text-center afericao p-2">
                <div>
                    <h3>
                        @lang('afericao.velocidadeAfericao')
                        @if ($velocidade['condicao'] == 'ok')
                            <i class="{{ $velocidade['icone'] }}"
                                style="font-size: 15px; float: right;margin-top: 5px; color:{{ $velocidade['cor'] }} !important;"></i>
                        @endif
                    </h3>
                </div>

                <div class="p-2" style="background-color: {{ $velocidade['cor'] }} !important;">
                    <a href="{{ route($velocidade['acao'], $velocidade['parametro']) }}">
                        <span class="editar">{{ strtoupper(__($velocidade['botao'])) }}</span>
                        <span class="fa-stack fa-xs">
                            <div>
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-pen fa-stack-1x fa-inverse"
                                    style="color:{{ $velocidade['cor'] }} !important;"></i>
                            </div>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="form-row justify-content-center">
            <div class="form-group col-md-3 text-center afericao p-2">
                <div>
                    <h3>
                        @lang('afericao.mapaOriginal')

                        @if ($mapaOriginal['condicao'] == 'ok')
                            <i class="{{ $mapaOriginal['icone'] }}"
                                style="font-size: 15px; float: right;margin-top: 5px; color:{{ $mapaOriginal['cor'] }} !important;"></i>
                        @endif
                    </h3>
                </div>
                <div class="p-2" style="background-color: {{ $mapaOriginal['cor'] }} !important;">
                    <a href="{{ route($mapaOriginal['acao'], $mapaOriginal['parametro']) }}">
                        <span class="editar">{{ strtoupper(__($mapaOriginal['botao'])) }}</span>
                        <span class="fa-stack fa-xs">
                            <div>
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-pen fa-stack-1x fa-inverse"
                                    style="color:{{ $mapaOriginal['cor'] }} !important;"></i>
                            </div>
                        </span>
                    </a>
                </div>
            </div>

            <div class="form-group col-md-3 text-center afericao p-2">
                <div>
                    <h3>@lang('afericao.relatorioVelocidade')

                        @if ($relVelocidade['condicao'] == 'ok')
                            <i class="{{ $relVelocidade['icone'] }}"
                                style="font-size: 15px; float: right;margin-top: 5px; color:{{ $relVelocidade['cor'] }} !important;"></i>
                        @endif
                    </h3>
                </div>
                <div class="p-2" style="background-color: {{ $relVelocidade['cor'] }} !important;">
                    <a href="{{ route($relVelocidade['acao'], $relVelocidade['parametro']) }}">
                        <span class="editar">{{ strtoupper(__($relVelocidade['botao'])) }}</span>
                        <span class="fa-stack fa-xs">
                            <div>
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-pen fa-stack-1x fa-inverse"
                                    style="color:{{ $relVelocidade['cor'] }} !important;"></i>
                            </div>
                        </span>
                    </a>
                </div>
            </div>

            <div class="form-group col-md-3 text-center afericao p-2">
                <div>
                    <h3>@lang('afericao.impressoes')
                        @if ($ftDiag['condicao'] == 'ok')
                            <i class="{{ $ftDiag['icone'] }}"
                                style="font-size: 15px; float: right;margin-top: 5px; color:{{ $ftDiag['cor'] }} !important;"></i>
                        @endif
                    </h3>
                </div>
                <div class="p-2" style="background-color: {{ $ftDiag['cor'] }} !important;">
                    <a href="{{ route($ftDiag['acao'], $ftDiag['parametro']) }}">
                        <span class="editar">{{ strtoupper(__($ftDiag['botao'])) }}</span>
                        <span class="fa-stack fa-xs">
                            <div>
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-pen fa-stack-1x fa-inverse"
                                    style="color:{{ $ftDiag['cor'] }} !important;"></i>
                            </div>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
