<template>
  <div class="col-md-12 container">
    <div class="form-group d-flex" style="padding-bottom: 10px">
      <div class="align-content-start col-4 col-md-4">
        <div class='input-group'>
              <span class="input-group-text bg-transparent" style="border: none" id="search"><i class='fa fa-search'> </i></span>
              <input type="search"  class="form-control"  v-model="buscar" aria-describedby="search" >
              <div class="line"></div>
        </div>     
      </div>
      <div class="col-md-6">
      </div>
      <div class="align-items-end col-8 col-md-2">
        <a v-if="criar && !modal" v-bind:href="criar" id="btn-tbl-adicionar" class="btn btn-outline-primary btn-lg"><i class="fa fa-fw fa-plus"></i></a>
        <modallink class="col-2" v-if="criar && modal" tipo="link" nome="adicionar" icone="fa fa-fw fa-plus" css="btn btn-outline-primary btn-lg"></modallink>

        <a v-if="criarpage && !page" v-bind:href="criarpage" id="btn-tbl-adicionar" class="btn btn-outline-primary btn-lg"><i class="fa fa-fw fa-plus"></i></a>
        <modallink class="col-2" v-if="criarpage && page" tipo="link" nome="adicionar" icone="fa fa-fw fa-plus" css="btn btn-outline-primary btn-lg"></modallink>
      </div>
    </div>

    <div class="table-responsive">

      <table class="table table-striped table-hover">
      <thead id='tbHead'>
        <tr class='text-light'>
          <th style="cursor:pointer; vertical-align: middle"  v-on:click="ordenaColuna(index)" v-for="(titulo,index) in titulos">{{titulo}}<i class='fa fa-fw fa-sort'></i> </th>

          <th style="vertical-align: middle" v-if="detalhe || editar || deletar || editarpage"><i class='fa fa-fw  fa-wrench'></i></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item,index) in lista">
          <td v-for="i in item">{{i | formataData}}</td>

          <td v-if="detalhe || editar || deletar || outro || editarpage">
            <form v-bind:id="index" v-if="deletar && token" v-bind:action="deletar + item.id" method="post" style="display: inline-flex;">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" v-bind:value="token">
              <a class='btn btn-outline-info' v-if="outro" v-bind:href="outro + '/' + item.id"><i v-bind:class="'fa fa-fw ' + (icone_outro || ' fa-external-link')" ></i> </a>
              <a class='btn btn-outline-primary' v-if="detalhe && !modal" v-bind:href="detalhe"><i class='fa fa-fw fa-eye'></i> |</a>
              <modallink v-if="detalhe && modal" v-bind:item="item" v-bind:url="detalhe" tipo="link" nome="detalhe" icone=" fa fa-fw fa-eye" css="btn btn-outline-info"></modallink>


              <a class='btn btn-outline-primary' v-if="editar && !modal" v-bind:href="editar + '/' + item.id"> <i class='fa fa-fw fa-edit'></i> </a>
              <modallink v-if="editar && modal" v-bind:item="item" v-bind:url="editar" tipo="link" nome="editar" icone='fa fa-fw fa-edit' css="btn btn-outline-primary"></modallink>

              <a class='btn btn-outline-primary' v-if="editarpage && !page" v-bind:href="editarpage + '' + item.id"> <i class='fa fa-fw fa-edit'></i> </a>
              <modallink v-if="editarpage && page" v-bind:item="item" v-bind:url="editarpage" tipo="link" nome="editarpage" icone='fa fa-fw fa-edit' css="btn btn-outline-primary"></modallink>

              <a class='btn btn-outline-danger' href="#"  v-on:click="executaForm(index)"> <i class='fa fa-fw fa-trash'></i></a>

            </form>

            <span v-if="!token">
              <a class='btn btn-outline-info' v-if="outro" v-bind:href="outro + '/' + item.id"><i v-bind:class="'fa fa-fw ' + (icone_outro || ' fa-fa-external-link')" ></i> |</a>
              <a class='btn btn-outline-primary' v-if="detalhe && !modal" v-bind:href="detalhe"><i class='fa fa-fw fa-eye'></i> |</a>
              <modallink v-if="detalhe && modal" v-bind:item="item" v-bind:url="detalhe" tipo="link" nome="detalhe"  icone=" fa fa-fw fa-eye" css="btn btn-outline-info"></modallink>

              <a class='btn btn-outline-primary' v-if="editar && !modal" v-bind:href="editar  + '/' + item.id"> <i class='fa fa-fw fa-edit'></i> |</a>
              <modallink v-if="editar && modal" tipo="link" v-bind:item="item" v-bind:url="editar" nome="editar" icone='fa fa-fw fa-edit' css="btn btn-outline-danger"></modallink>

              <a class='btn btn-outline-primary' v-if="editarpage && !page" v-bind:href="editarpage + '' + item.id"> <i class='fa fa-fw fa-edit'></i> |</a>
              <modallink v-if="editarpage && page" tipo="link" v-bind:item="item" v-bind:url="editarpage" nome="editarpage" icone='fa fa-fw fa-edit' css="btn btn-outline-danger"></modallink>

              <a class='btn btn-outline-danger' v-if="deletar" v-bind:href="deletar"> <i class='fa fa-fw fa-trash'></i></a>
            </span>

            <span v-if="token && !deletar">
              <a class='btn btn-outline-info' v-if="outro" v-bind:href="outro + '/' + item.id"><i v-bind:class="'fa fa-fw ' + (icone_outro || ' fa-fa-external-link')" ></i> |</a>
              <a class='btn btn-outline-primary' v-if="detalhe && !modal" v-bind:href="detalhe"><i class='fa fa-fw fa-edit'></i> |</a>
              <modallink v-if="detalhe && modal" v-bind:item="item" v-bind:url="detalhe" tipo="link" nome="detalhe"  icone=" fa fa-fw fa-eye" css="btn btn-outline-info"></modallink>

              <a class='btn btn-outline-primary' v-if="editar && !modal" v-bind:href="editar + '/' + item.id"> <i class='fa fa-fw fa-edit'></i></a>
              <modallink v-if="editar && modal" tipo="link" v-bind:item="item" v-bind:url="editar" nome="editar"  icone='fa fa-fw fa-edit' css="btn btn-outline-primary"></modallink>

              <a class='btn btn-outline-primary' v-if="editarpage && !page" v-bind:href="editarpage + '' + item.id"> <i class='fa fa-fw fa-edit'></i></a>
              <modallink v-if="editarpage && page" tipo="link" v-bind:item="item" v-bind:url="editarpage" nome="editarpage"  icone='fa fa-fw fa-edit' css="btn btn-outline-primary"></modallink>
            </span>
          </td>
        </tr>
      </tbody>
    </table>

    </div>

  </div>

</template>

<script>
    export default {
      /* usar outro botão:  outro="{{route('fazenda.teste')}}" icone_outro="fa-user-plus" */
      props:['titulos','itens','ordem','ordemcol','criar','detalhe','editar','deletar','outro', 'icone_outro','token','modal', 'criarpage', 'editarpage'],
      data: function(){
        return {
          buscar:'',
          ordemAux: this.ordem || "asc",
          ordemAuxCol: this.ordemcol || 0
        }
      },
      methods:{
        executaForm: function(index){
          document.getElementById(index).submit();
        },
        ordenaColuna: function(coluna){
          this.ordemAuxCol = coluna;
          if(this.ordemAux.toLowerCase() == "asc"){
            this.ordemAux = 'desc';
          }else{
            this.ordemAux = 'asc';
          }
        }
      },
      filters: {
        formataData: function(valor){
          if(!valor) return '';
          valor = valor.toString();
          if(valor.split('-').length == 3){
            valor = valor.split('-');
            return valor[2] + '/' + valor[1]+ '/' + valor[0];
          }

          return valor;
        }
      },
      computed:{
        lista:function(){
          let lista = this.itens.data;
          let ordem = this.ordemAux;
          let ordemCol = this.ordemAuxCol;
          ordem = ordem.toLowerCase();
          ordemCol = parseInt(ordemCol);

          if(ordem == "asc"){
            lista.sort(function(a,b){
              if (Object.values(a)[ordemCol] > Object.values(b)[ordemCol] ) { return 1;}
              if (Object.values(a)[ordemCol] < Object.values(b)[ordemCol] ) { return -1;}
              return 0;
            });
          }else{
            lista.sort(function(a,b){
              if (Object.values(a)[ordemCol] < Object.values(b)[ordemCol] ) { return 1;}
              if (Object.values(a)[ordemCol] > Object.values(b)[ordemCol] ) { return -1;}
              return 0;
            });
          }

          if(this.buscar){
            return lista.filter(res => {
              res = Object.values(res);
              for(let k = 0;k < res.length; k++){
                if((res[k] + "").toLowerCase().indexOf(this.buscar.toLowerCase()) >= 0){
                  return true;
                }
              }
              return false;

            });
          }


          return lista;
        }
      }
    }
</script>

<style media="screen">
  #tbHead{
    background-color: #1782B6;
  }
</style>