@extends('_layouts._layout_site')

@section('titulo')
@if($tipo_projeto == 'R')
    @lang('redimensionamento.statusRedimensionamento')
@else
    @lang('afericao.statusAfericao')
@endif
@endsection

@section('conteudo')
    

<div class="row" style="overflow-x: hidden">

    <div class="col-lg-3 col-md-4 col-sm-6">
        <caixa 
            @if($tipo_projeto == "R") 
                titulo="{{Str::title(__('redimensionamento.configurar_redimensionamento'))}}" 
            @else 
                titulo="{{Str::title(__('afericao.afericao'))}}" 
            @endif 
            
            texto='@lang($afericao["mensagem"])' 
            botao="@lang($afericao['botao'])" 
            url="{{route($afericao['acao'], $afericao['parametro'])}}" 
            cor="{{$afericao['cor']}}" 
            icone="{{$afericao['icone']}}">
        </caixa>            
    </div>

    <div class="col-lg-3 col-md-4 col-sm-6">
        <caixa 
        titulo="@lang('afericao.mapaBocais')" 
        texto="@lang($emissores['mensagem'])" 
        botao="@lang($emissores['botao'])" 
        url="{{route($emissores['acao'], $emissores['parametro'])}}" 
        cor="{{$emissores['cor']}}" 
        icone="{{$emissores['icone']}}">
    </caixa>           
    </div>

    <div class="col-lg-3 col-md-4 col-sm-6">
        <caixa 
        titulo="@lang('afericao.adutora')" 
        texto="@lang($adutora['mensagem'])" 
        botao="@lang($adutora['botao'])" 
        url="{{route($adutora['acao'], $adutora['parametro'])}}" 
        cor="{{$adutora['cor']}}" 
        icone="{{$adutora['icone']}}">
    </caixa>            
    </div>

    <div class="col-lg-3 col-md-4 col-sm-6">
        <caixa 
            titulo="@lang('afericao.bombeamento')" 
            id="bombeamento" 
            @if ($bombeamento['condicao'] == 'block')
            data-toggle="modal" 
            data-target="#ModalCards" 
            onclick="modalbombeamento()" 
            @else 
            url="{{route($bombeamento['acao'], $bombeamento['parametro'])}}" 
            @endif 
            texto="@lang($bombeamento['mensagem'])" 
            botao="@lang($bombeamento['botao'])"  
            cor="{{$bombeamento['cor']}}" 
            icone="{{$bombeamento['icone']}}" >
        </caixa>            
        <div class="{{$bombeamento['condicao']}}"  type="hidden"></div>
    </div>

    <div class="col-lg-3 col-md-4 col-sm-6">
        <caixa 
        titulo="@lang('afericao.velocidadeAfericao')" 
        texto="@lang($velocidade['mensagem'])" 
        botao="@lang($velocidade['botao'])" 
        url="{{route($velocidade['acao'], $velocidade['parametro'])}}" 
        cor="{{$velocidade['cor']}}" 
        icone="{{$velocidade['icone']}}">
    </caixa>            
    </div>

    <div class="col-lg-3 col-md-4 col-sm-6">
        <caixa 
        titulo="@lang('afericao.mapaOriginal')" 
        id="mapa_original" 
        @if ($mapaOriginal['condicao'] == 'block') 
        data-toggle="modal" 
        data-target="#ModalCards" 
        onclick="modalMapaOriginal()" 
        @else 
        url="{{route($mapaOriginal['acao'], $mapaOriginal['parametro'])}}" 
        @endif 
        texto="@lang($mapaOriginal['mensagem'])" 
        botao="@lang($mapaOriginal['botao'])"  
        cor="{{$mapaOriginal['cor']}}" 
        icone="{{$mapaOriginal['icone']}}" >
    </caixa>
    </div>

    <div class="col-lg-3 col-md-4 col-sm-6">
        <caixa  
        titulo="@lang('afericao.relatorioVelocidade')" 
        id="relatorio_velocidade" 
        @if ($relVelocidade['condicao'] == 'block') 
        data-toggle="modal" 
        data-target="#ModalCards" 
        onclick="modalRelatorioVelocidade()" 
        @else 
        url="{{route($relVelocidade['acao'], $relVelocidade['parametro'])}}" 
        @endif 
        texto="@lang($relVelocidade['mensagem'])" 
        botao="@lang($relVelocidade['botao'])"  
        cor="{{$relVelocidade['cor']}}" 
        icone="{{$relVelocidade['icone']}}" >
    </caixa>
    </div>

    <div class="col-lg-3 col-md-4 col-sm-6">
        <caixa 
        titulo="@lang('afericao.impressoes')" 
        id="ficha_tecnica" 
        @if ($ftDiag['condicao'] == 'block') 
        data-toggle="modal" 
        data-target="#ModalCards" 
        onclick="modalFichaTecnica()" 
        @else 
        newtab='sim'
         url="{{route($ftDiag['acao'], $ftDiag['parametro'])}}" 
         @endif 
         texto="@lang($ftDiag['mensagem'])" 
         botao="@lang($ftDiag['botao'])" 
         cor="{{$ftDiag['cor']}}" 
         icone="{{$ftDiag['icone']}}" >
        </caixa>
    </div>
</div>

<div class="container">
    <div class="text-center">
        @if($tipo_projeto == 'R')
            <a class="btn btn-outline-dark" href="{{route('gerenciarRedimensionamentos')}}">@lang('afericao.voltar')</a>
        @else
            <a class="btn btn-outline-dark" href="{{route('afericoes.pivo.central')}}">@lang('afericao.voltar')</a>
        @endif
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalCards" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="ModalLabel"><b>@lang('afericao.bloqueado')</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            @lang('afericao.mensagemModalCard')
            <div hidden class="bombeamento"><b>@lang('afericao.bombeamentoCard')</b></div>
            <div hidden class="mapa_original"><b>@lang('afericao.mapaOriginalCard')</b></div>
            <div hidden class="relatorio_velocidade"><b>@lang('afericao.relatorioVelocidadeCard')</b></div>
            <div hidden class="ficha_tecnica"><b>@lang('afericao.fichaTecnicaCard')</b></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
    function modalbombeamento() {
        $(".bombeamento").removeAttr("hidden");
    }
    function modalMapaOriginal() {
        $(".mapa_original").removeAttr("hidden");
    }
    function modalRelatorioVelocidade() {
        $(".relatorio_velocidade").removeAttr("hidden");
    }
    function modalFichaTecnica() {
        $(".ficha_tecnica").removeAttr("hidden");
    }

    $('#ModalCards').on('hidden.bs.modal', function (e) {
        $(".bombeamento").attr("hidden",true);
        $(".mapa_original").attr("hidden",true);
        $(".relatorio_velocidade").attr("hidden",true);
        $(".ficha_tecnica").attr("hidden",true);
    });
</script>

@endsection