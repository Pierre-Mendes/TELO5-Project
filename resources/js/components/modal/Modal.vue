<template>
  
  <div class="modal fade " v-bind:id="nome" tabindex="-1" role="dialog">
  <div  :class="'modal-dialog ' +  (css || 'modal-xl')" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">{{titulo}}</h4>
        <button type="button" class=" btn btn-danger close" data-dismiss="modal" aria-label="Close"><i class='fa fa-fw fa-close'></i></button>
      </div>
      <div class="modal-body">
        <slot></slot>
      </div>
      <div class="modal-footer">
        <slot name="botoes"></slot>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</template>

<script>
    export default {
      props:['nome','titulo', 'css']
    }
</script>
