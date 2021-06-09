<div class="form-group col-md-12" id="saidas">
    <div class="row col-md-12">
        <label class="form-group col-md-6">@lang('pivos.espacamentoLanceInicial')</label>
        <label class="form-group col-md-6">@lang('pivos.espacamentoLanceIntermediario')</label>
    </div>
    
    <div class="row col-md-12">
        <div class="form-group col-md-6">
            <input v-model="$store.state.item.saida_1_inicial" class="form-control" id="esaida_1_inicial" name="saida_1_inicial" type="number" value="{{$saidas['saida_1_inicial']}}" required>
            @component('_layouts._components._inputLabel', ['texto'=>__('pivos.saida1'), 'id' => ''])@endcomponent
        </div>

        <div class="form-group col-md-6">
            <input v-model="$store.state.item.saida_1_intermediario" class="form-control" id="esaida_1_intermediario" name="saida_1_intermediario" type="number" value="{{$saidas['saida_1_intermediario']}}" required>
            @component('_layouts._components._inputLabel', ['texto'=>__('pivos.saida1'), 'id' => ''])@endcomponent
        </div>
    </div>
    
    <div class="row col-md-12">
        <div class="form-group col-md-6">
            <input v-model="$store.state.item.saida_2_inicial" class="form-control" id="esaida_2_inicial" name="saida_2_inicial" type="number" value="{{$saidas['saida_2_inicial']}}" required>
            @component('_layouts._components._inputLabel', ['texto'=>__('pivos.saida2'), 'id' => ''])@endcomponent
        </div>

        <div class="form-group col-md-6">
            <input v-model="$store.state.item.saida_2_intermediario" class="form-control" id="esaida_2_intermediario" name="saida_2_intermediario" type="number" value="{{$saidas['saida_2_intermediario']}}" required>
            @component('_layouts._components._inputLabel', ['texto'=>__('pivos.saida2'), 'id' => ''])@endcomponent
        </div>
    </div>

    <div class="row col-md-12">
        <div class="form-group col-md-6">
            <input v-model="$store.state.item.saida_3_inicial" class="form-control" id="esaida_3_inicial" name="saida_3_inicial" type="number" value="{{$saidas['saida_3_inicial']}}" required>
            @component('_layouts._components._inputLabel', ['texto'=>__('pivos.saida3'), 'id' => ''])@endcomponent
        </div>

        <div class="form-group col-md-6">
            <input v-model="$store.state.item.saida_3_intermediario" class="form-control" id="esaida_3_intermediario" name="saida_3_intermediario" type="number" value="{{$saidas['saida_3_intermediario']}}" required>
            @component('_layouts._components._inputLabel', ['texto'=>__('pivos.saida3'), 'id' => ''])@endcomponent
        </div>
    </div>
</div>