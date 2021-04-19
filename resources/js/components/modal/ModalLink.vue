<template>
  <span>
    <span v-if="item">
      <button v-on:click="preencheFormulario()" v-if="!tipo || (tipo != 'button' && tipo != 'link')" type="button" v-bind:class="css || 'btn btn-primary'" data-toggle="modal" v-bind:data-target="'#' + nome"><i v-bind:class="icone || 'fa fa-gear'"></i></button>
      <button v-on:click="preencheFormulario()" v-if="tipo == 'button'" type="button" v-bind:class="css || 'btn btn-primary'" data-toggle="modal" v-bind:data-target="'#' + nome"><i v-bind:class="icone || 'fa fa-gear'"></i></button>
      <a v-on:click="preencheFormulario()" v-if="tipo == 'link'" href="#" v-bind:class="css || ''" data-toggle="modal" v-bind:data-target="'#' + nome"><i v-bind:class="icone || 'fa fa-gear'"></i></a>
    </span>

    <span v-if="!item">
      <button v-if="!tipo || (tipo != 'button' && tipo != 'link')" type="button" v-bind:class="css || 'btn btn-primary'" data-toggle="modal" v-bind:data-target="'#' + nome"><i v-bind:class="icone || 'fa fa-gear'"></i></button>
      <button v-if="tipo == 'button'" type="button" v-bind:class="css || 'btn btn-primary'" data-toggle="modal" v-bind:data-target="'#' + nome"><i v-bind:class="icone || 'fa fa-gear'"></i></button>
      <a v-if="tipo == 'link'" href="#" v-bind:class="css || ''" data-toggle="modal" v-bind:data-target="'#' + nome"><i v-bind:class="icone || 'fa fa-gear'"></i></a>
    </span>

  </span>

</template>

<script>
    export default {
      props:['tipo','nome','item','css','icone','url'],
      methods:{
        

        preencheFormulario:function(){
          if(this.item.id === undefined){
            axios.get(this.url).then(res => {  
              this.$store.commit('setItem',res.data);
            });
          }else{
            axios.get(this.url + this.item.id).then(res => {   
              this.$store.commit('setItem',res.data);
            });
          }
         
          //this.$store.commit('setItem',this.item);
        }
      }
    }
</script>
