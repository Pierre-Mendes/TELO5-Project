<template>
    <form method="post" id='alterarFazenda' class="my-auto" v-bind:action="url_submit" > 
        <input  type="hidden" name="_method" value="put">
        <input v-if="token" type="hidden" name="_token" v-bind:value="token">  
        <div id="div_botao_selecionar">
            <i class="fa fa-fw"></i>
            <button type="button" @click="buscaFazendas()" id="btn-selecionar-fazenda-navbar"  class='btn btn-outline-light'  data-toggle="tooltip" data-placement="bottom"  >                 
                {{fazenda_atual || txt_nenhuma_fazenda_selec}}
            </button>
        </div>  
        <div id="spin" hidden class="text-light"> 
            <div class='text-center' id="divForm">
                <select v-bind:data-live-search-placeholder=txt_buscar  data-size="15"  onchange="$('#alterarFazenda').submit()" v-bind:model="fazenda_id || ''" name="fazenda" id='fazenda' data-style="btn-outline-light" class='selectpicker text-light' data-width="100%" data-live-search="true">
                    
                    <option style="font-weight: bold" v-if="fazenda_atual" selected v-bind:value="fazenda_id" > {{fazenda_atual}}</option>
                    <option style="font-weight: bold" v-if="!fazenda_atual" selected v-bind:value="''" >{{txt_nenhuma_fazenda_selec}}</option>
                    <option v-if="fazenda_atual" v-bind:value="''" >{{txt_nao_selecionar}}</option>
                    
                </select>
            </div>
        </div>
    </form>
</template>

<script>

    export default {
        
        props:['titulo', 'css', 'url', 'fazenda_atual','token', 'fazenda_id', 'url_submit', 'txt_alterar', 'txt_nenhuma_fazenda_selec', 'txt_nao_selecionar', 'txt_erro', 'txt_selecionar_fazenda', 'txt_buscar'], 
        data: {
            fazendas: {},
            fazenda: '',
        },
        data () {
            return {
                fazendas: this.$store.fazendas,
                fazenda: null
            }
        },
        mounted(){
            this.adicionarTituloAoBotao();	
        },

        methods:{
            buscaFazendas:function(){
                if($('#fazenda option').length <= 2){
                    $("#spin").addClass("spinner-border"); 
                    $("#spin").removeAttr('hidden');
                    $("#div_botao_selecionar").hide();
                    $("#divForm").attr("hidden", true); 
                    //$("button[name='btn-selecionar-fazenda']").attr("disabled", true); 
                    axios.get(this.url + "").then(res => {            
                        this.$store.commit('setFazendas',res.data);
                        this.fazendas = this.$store.state.fazendas;
                        this.alterarSelect();
                        $("#spin").removeClass("spinner-border"); 
                        $("#divForm").attr("hidden", false); 
                        //$("button[name='btn-selecionar-fazenda']").attr("disabled", false); 
                        $('#fazenda').selectpicker('toggle');
                        //$('#fazenda').focus();
                    }).catch(error => {
                        $("#div_botao_selecionar").show();
                        $("#spin").attr('hidden', 'hidden');
                        alert(this.txt_erro);
                    });
                }
            },  
            alterarSelect:function(){
                let optgroup;
                let ultimo_prop;
                //Adicionando optgroup no select
                this.fazendas.forEach(fazenda => {
                    if(fazenda.proprietario !== ultimo_prop){
                        ultimo_prop = fazenda.proprietario;
                        optgroup = "<optgroup label='"+fazenda.proprietario +"' class='farm-item'></optgroup>";
                        $("#fazenda").append(optgroup);
                    }
                    $("#fazenda").find('optgroup[label="'+ fazenda.proprietario +'"]').append('<option class="farm-item"  value="' +fazenda.id +'">'+ fazenda.nome +'</option>');
                });
                $('#fazenda').selectpicker('refresh');
            },
            adicionarTituloAoBotao:function(){
                $("#btn-selecionar-fazenda-navbar").attr('data-original-title', this.txt_selecionar_fazenda);
            }
                   
        }
    }
  
</script>

