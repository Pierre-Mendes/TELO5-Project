<!--<nav class="menuesquerda">
    <ul>
        <li><a href="#">Select Farm</a>
            <ul>
                <li><a href="#">Farm 1</a></li>
                <li><a href="#">Farm 2</a></li>
                <li><a href="#">Farm 3</a></li>
            </ul>
        </li>
    </ul>
</nav>-->

<div hidden>
    <i class="fa fa-fw"></i>
    <button  class=' btn btn-outline-light'  data-toggle="tooltip" data-placement="bottom" title="@lang('comum.fazenda_selecionada')" >
        @if(session()->has('fazenda'))
            {{ Session::get('fazenda')['nome'] }}
        @else
            @lang('comum.nenhuma_fazenda_selecionada')
        @endif
    </button>
</div>

<div >
    <i class="fa fa-fw"></i>

    @if(session()->has('fazenda'))
        <modal-selecionar-fazenda
        titulo="@lang('comum.alterar_fazenda')" css="modal-sm" fazenda_atual="{{Session::get('fazenda')['nome']}}"
        fazenda_id="{{Session::get('fazenda')['id']}}" token="{{ csrf_token() }}"
        url_submit="{{route('fazenda.alterar')}}" url="{{route('fazenda.selecionar')}}"
        txt_alterar="@lang('comum.alterar')" txt_nenhuma_fazenda_selec="@lang('comum.nenhuma_fazenda_selecionada')" txt_nao_selecionar="@lang('comum.nao_selecionar_fazendas')"
        txt_erro="@lang('comum.erro_carregar_fazendas')" txt_selecionar_fazenda="@lang('comum.selecionar_fazenda')" txt_buscar="@lang('comum.buscar_fazendas')">
        </modal-selecionar-fazenda>
    @else

        <modal-selecionar-fazenda
            titulo="@lang('comum.alterar_fazenda')" css="modal-sm" token="{{ csrf_token() }}" url="{{route('fazenda.selecionar')}}"
            url_submit="{{route('fazenda.alterar')}}"
            txt_alterar="@lang('comum.alterar')" txt_nenhuma_fazenda_selec="@lang('comum.nenhuma_fazenda_selecionada')" txt_nao_selecionar="@lang('comum.nao_selecionar_fazendas')"
            txt_erro="@lang('comum.erro_carregar_fazendas')" txt_selecionar_fazenda="@lang('comum.selecionar_fazenda')" txt_buscar="@lang('comum.buscar_fazendas')">
        </modal-selecionar-fazenda>
    @endif
</div>
