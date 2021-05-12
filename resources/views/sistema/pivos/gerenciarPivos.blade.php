@extends('_layouts._layout_site')

@section('titulo')
    @lang('pivos.pivos')
@endsection

@section('conteudo')
    <filtro titulo="@lang('usuarios.filtrar')" @if(!empty($filtro['filtro'])) show=" show" @endif action="#" txt_buscar="@lang('usuarios.buscar')">


        <div class="col-md-12 form-group">
            <input
                class="form-control"
                id="fabricante_busca"
                name="fabricante"
                type="text"
                value="@if(isset($filtro['fabricante'])) {{$filtro['fabricante']}} @endif"
                aria-describedby
            />
            @component('_layouts._components._inputLabel', ['texto'=>__('bocais.fabricante'), 'id' => ''])@endcomponent                                                                                                

        </div>

        <div hidden class="col-md-3 form-group">
            <label for="vazao_min">@lang('bocal.vazao_min')</label>
            <input
                class="form-control"
                id="vazao_min"
                name="vazao_min"
                type="number"
                step="0.01"
                value="@if(isset($filtro['vazao_min'])) {{$filtro['vazao_min']}} @endif"
                aria-describedby
            />
        </div>
        <div hidden class="col-md-3 form-group">
            <label for="vazao_max">@lang('bocal.vazao_max')</label>
            <input
                class="form-control"
                id="vazao_max"
                name="vazao_max"
                type="number"
                step="0.01"
                value="@if(isset($filtro['vazao_max'])) {{$filtro['vazao_max']}} @endif"
                aria-describedby
            />
        </div>

    </filtro>

    <tabela-lista
        v-bind:titulos="['#','@lang("pivos.fabricante")', '@lang("pivos.modelo")', '@lang("pivos.espacamento") @lang('unidadesAcoes.(m)')']"
        v-bind:itens="{{json_encode($pivos)}}"
        ordem="desc" ordemcol="1"
        criar="{{route('pivos.cadastra')}}"  editar="{{route('pivos.pivo', '')}}/" deletar="{{route('pivos.remove', '')}}/" token="{{ csrf_token() }}"
        modal="sim"

    ></tabela-lista>
    <div align="center" class='row'>
        

        @if(isset($filtro['filtro']))
        {{$pivos->appends([
            'filtro' => 'filtrar',
            'fabricante' => $filtro['fabricante'] ?? '',
            
        ])}}
        @else
            {{$pivos}}
        @endif
    </div>

    
    <modal nome="adicionar" titulo="@lang('pivos.cadastrar_pivo')" css='modal-md'>
        <formulario id="formAdicionar" css="row" action="{{route('pivos.cadastra')}}" method="post" enctype="" token="{{ csrf_token() }}">

            <div class="form-group col-md-12">
                <label for="fabricante">@lang('pivos.fabricante')</label>
                <select name="fabricante" id="fabricante" class="form-control" placeholder="@lang('pivos.selecione_digite')">
                    @foreach ($fabricantes as $fabricante)
                        <option value="{{$fabricante->fabricante}}">{{$fabricante->fabricante}}</option>
                    @endforeach
                </select>
                <div class="line"></div>
            </div>

            <div class="form-group col-md-12">
                <input class="form-control" id="modelo" name="nome" type="text" aria-describedby="" required>
                @component('_layouts._components._inputLabel', ['texto'=>__('pivos.modelo'), 'id' => ''])@endcomponent
            </div>
            
            <div class="form-group col-md-12">
                <input class="form-control" id="espacamento" name="espacamento" type="number" step="0.01" min=0 max=100 aria-describedby=""  required>
                @component('_layouts._components._inputLabel', ['texto'=>__('pivos.espacamento') . __('unidadesAcoes.(m)'), 'id' => ''])@endcomponent
            </div>

            <div class="form-group col-md-12" id="saidas">
                <div class="row col-md-12">
                    <label class="form-group col-md-6">@lang('pivos.espacamentoLanceInicial')</label>
                    <label class="form-group col-md-6">@lang('pivos.espacamentoLanceIntermediario')</label>
                </div>

                <div class="row col-md-12">
                    <div class="form-group col-md-6">
                        <input class="form-control" id="saida_1_inicial" name="saida_1_inicial" type="number" step="0.01" required>
                        @component('_layouts._components._inputLabel', ['texto'=>__('pivos.saida1'), 'id' => ''])@endcomponent
                    </div>

                    <div class="form-group col-md-6">
                        <input class="form-control" id="saida_1_intermediario" name="saida_1_intermediario" type="number" step="0.01" required>
                        @component('_layouts._components._inputLabel', ['texto'=>__('pivos.saida1'), 'id' => ''])@endcomponent
                    </div>
                </div>
                
                <div class="row col-md-12">
                    <div class="form-group col-md-6">
                        <input class="form-control" id="saida_2_inicial" name="saida_2_inicial" type="number" step="0.01" required>
                        @component('_layouts._components._inputLabel', ['texto'=>__('pivos.saida2'), 'id' => ''])@endcomponent
                    </div>

                    <div class="form-group col-md-6">
                        <input class="form-control" id="saida_2_intermediario" name="saida_2_intermediario" type="number" step="0.01" required>
                        @component('_layouts._components._inputLabel', ['texto'=>__('pivos.saida2'), 'id' => ''])@endcomponent
                    </div>
                </div>

                <div class="row col-md-12">
                    <div class="form-group col-md-6">
                        <input class="form-control" id="saida_3_inicial" name="saida_3_inicial" type="number" step="0.01" required>
                        @component('_layouts._components._inputLabel', ['texto'=>__('pivos.saida3'), 'id' => ''])@endcomponent
                    </div>

                    <div class="form-group col-md-6">
                        <input class="form-control" id="saida_3_intermediario" name="saida_3_intermediario" type="number" step="0.01" required>
                        @component('_layouts._components._inputLabel', ['texto'=>__('pivos.saida3'), 'id' => ''])@endcomponent
                    </div>
                </div>
            </div>

        </formulario>
        <span slot="botoes">
            <button form='formAdicionar' class="btn btn-lg btn-info btn-block text-center text-light" style="margin: 0 auto" type="submit">@lang('pivos.cadastrar')</button>
        </span>
    
      </modal>
    
      <modal nome="editar" titulo="@lang('pivos.editar_pivo')" css=' modal-md'>
        <formulario id="formEditar" v-bind:action="'{{route('pivos.edita')}}'" css='row' method="put" enctype="" token="{{ csrf_token() }}">
                <input type="text" name='id' hidden v-model="$store.state.item.id">
                
                <div class="form-group col-md-12">
                    <label for="efabricante">@lang('bocais.fabricante')</label>
                    <select  v-model="$store.state.item.fabricante" name="fabricante" id="efabricante" class="form-control">
                        @foreach ($fabricantes as $fabricante)
                            <option value="{{$fabricante->fabricante}}">{{$fabricante->fabricante}}</option>
                        @endforeach
                    </select>
                    @component('_layouts._components._inputLabel', ['texto'=>'', 'id' => ''])@endcomponent
                </div>

                <div class="form-group col-md-12">
                    <label for="emodelo">@lang('pivos.modelo')</label>
                    <input v-model="$store.state.item.nome" class="form-control" id="emodelo" name="nome" type="text" aria-describedby="" required>
                    @component('_layouts._components._inputLabel', ['texto'=>'', 'id' => ''])@endcomponent
                </div>


                <div class="form-group col-md-12">
                    <label for="eespacamento">@lang('pivos.espacamento') @lang('unidadesAcoes.(m)')</label>
                    <input v-model="$store.state.item.espacamento" class="form-control" id="eespacamento" name="espacamento" type="number" min=0 max=100 step="0.01" aria-describedby="" required>
                    @component('_layouts._components._inputLabel', ['texto'=>'', 'id' => ''])@endcomponent                                                                                                                    
                </div>

                <div class="form-group col-md-12" id="esaidas">
                    <div class="row col-md-12">
                        <label class="form-group col-md-6">@lang('pivos.espacamentoLanceInicial')</label>
                        <label class="form-group col-md-6">@lang('pivos.espacamentoLanceIntermediario')</label>
                    </div>
                    
                    <div class="row col-md-12">
                        <div class="form-group col-md-6">
                            <input v-model="$store.state.item.saida_1_inicial" class="form-control" id="esaida_1_inicial" name="saida_1_inicial" type="number" step="0.01" required>
                            @component('_layouts._components._inputLabel', ['texto'=>__('pivos.saida1'), 'id' => ''])@endcomponent
                        </div>
    
                        <div class="form-group col-md-6">
                            <input v-model="$store.state.item.saida_1_intermediario" class="form-control" id="esaida_1_intermediario" name="saida_1_intermediario" type="number" step="0.01" required>
                            @component('_layouts._components._inputLabel', ['texto'=>__('pivos.saida1'), 'id' => ''])@endcomponent
                        </div>
                    </div>
                    
                    <div class="row col-md-12">
                        <div class="form-group col-md-6">
                            <input v-model="$store.state.item.saida_2_inicial" class="form-control" id="esaida_2_inicial" name="saida_2_inicial" type="number" step="0.01" required>
                            @component('_layouts._components._inputLabel', ['texto'=>__('pivos.saida2'), 'id' => ''])@endcomponent
                        </div>
    
                        <div class="form-group col-md-6">
                            <input v-model="$store.state.item.saida_2_intermediario" class="form-control" id="esaida_2_intermediario" name="saida_2_intermediario" type="number" step="0.01" required>
                            @component('_layouts._components._inputLabel', ['texto'=>__('pivos.saida2'), 'id' => ''])@endcomponent
                        </div>
                    </div>
    
                    <div class="row col-md-12">
                        <div class="form-group col-md-6">
                            <input v-model="$store.state.item.saida_3_inicial" class="form-control" id="esaida_3_inicial" name="saida_3_inicial" type="number" step="0.01" required>
                            @component('_layouts._components._inputLabel', ['texto'=>__('pivos.saida3'), 'id' => ''])@endcomponent
                        </div>
    
                        <div class="form-group col-md-6">
                            <input v-model="$store.state.item.saida_3_intermediario" class="form-control" id="esaida_3_intermediario" name="saida_3_intermediario" type="number" step="0.01" required>
                            @component('_layouts._components._inputLabel', ['texto'=>__('pivos.saida3'), 'id' => ''])@endcomponent
                        </div>
                    </div>
                </div>

            </formulario>
            <span slot="botoes">
            <button form="formEditar" class="btn btn-info">@lang('proprietarios.atualizar')</button>
            </span>
      </modal>
@endsection

@section('scripts')
    @include('_layouts._includes._validators_jquery')

    <script type="text/javascript">
        $('#fabricante').editableSelect({ effects: 'fade' });
        
        $("#efabricante").change(function() {
            $('#efabricante').editableSelect({ effects: 'fade' });            
        });

        // Verificando os labels do modal de editar.
        /*$('#editar').on('classChange', function(){
            $('#esaidas :input').each(function(){
                //alert($(this).val());
            });
        });*/


        $(function(){

            $("#fabricante").change(function(e){

                e.preventDefault();

                // Exibe icone de carregamento.
                $('#saidas').html('');
                $('#saidas').html('<div style="text-align: center; font-size: 36px; color: blue; opacity: 0.7;"><i class="fa fa-circle-o-notch fa-spin"></i></div>');
                
                // Token para liberação de requisição ajax.
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                
                var select = $(this).val();

                /*$.get('pivos/ajaxRequest', function (data){
                    console.log(data);
                });*/

                $.ajax({
                    url: '/pivos/ajaxRequest/{valor}',
                    type: 'GET',
                    data: { valor: select },
                    success: function(response)
                    {
                        //Montando saidas.
                        $('#saidas').html(response);

                        // Verificando se os inputs possuem valor.
                        $('#saidas :input').each(function(){
                            if($(this).val() != '' && $(this).val() != 0){
                                $(this).addClass("has-value");
                            }
                            $(this).attr( "step", "0.01" );
                        });
                    }
                });

            });
        });            
    </script>

@endsection