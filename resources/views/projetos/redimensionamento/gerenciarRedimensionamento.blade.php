@extends('_layouts._layout_site')

@section('titulo')
    @lang('redimensionamento.redimensionamentos', ['fazenda' => session()->get('fazenda')['nome']])
@endsection

@section('conteudo')

<tabela-lista
    v-bind:titulos="['#','@lang("afericao.nomePivo")', '@lang("redimensionamento.dataRedim")', '@lang("afericao.pivo")', '@lang("afericao.numeroLances")']"
    v-bind:itens="{{json_encode($redimensionamentos)}}"
    ordem="desc" ordemcol="1"
    criar="#"  editar="{{route('configurarRedimensionamento', '')}}" deletar="{{route('afericao.remove', '')}}/" token="{{ csrf_token() }}"
    outro="{{route('status_redimensionamento', '')}}" icone_outro="fa-bar-chart"
></tabela-lista>
<div align="center" class='row'>
    {{$redimensionamentos}}
</div>


<modal nome="adicionar"  css='modal-sm' titulo="@lang('redimensionamento.novoRedimensionamento')">
    <form id="formulario_enviar" method="POST" class="container" action="{{route('criarRedimensionamento')}}">
        @csrf
        <div class="form-group">
            <label for="">@lang('redimensionamento.selecione_o_pivo')</label>
            <select  name="id_afericao" onchange="selecionarPivo()" id="selecao_pivo" data-live-search="true" data-style="btn-primary" class="form-control selectpicker">
                <option selected value="">@lang('redimensionamento.nenhum_selecionado')</option>
                @foreach ($pivos as $pivo)
                    <option value="{{$pivo->id}}" data-subtext="{{$pivo->marca_modelo_pivo}}" >{{$pivo->nome_pivo}}</option>
                @endforeach
            </select>
            <small class="text-info" >@lang('redimensionamento.apenasAfericoesCompletas')</small>
        </div>
    </form>
    <span slot="botoes">
        <button type="submit" id="botaoEnviar" disabled form="formulario_enviar"  class="btn btn-outline-primary" ><i class="fa fa-fw fa-plus-circle"></i>@lang('unidadesAcoes.criar') </button>
    </span>
</modal>

@endsection

@section('scripts')
<script type="text/javascript">
    function selecionarPivo(){
        if($("#selecao_pivo").val() !== ""){
            $("#botaoEnviar").removeAttr('disabled');
        }else{
            $("#botaoEnviar").attr('disabled', 'disabled');
        }
    }
</script>


<script type="text/javascript">
    var btnModal = $("#btn-tbl-adicionar");
    btnModal.attr('data-toggle', 'modal');
    btnModal.attr('data-target', '#adicionar');
</script>
@endsection