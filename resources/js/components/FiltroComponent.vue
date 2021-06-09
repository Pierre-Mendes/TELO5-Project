<template>
  <div>
    <div class="container">
      <form v-bind:action="(action || '#')" class="card" style="border: none">
        <div class style>
          <a
            class
            data-toggle="collapse"
            href="#colapseFiltro"
            role="button"
            aria-expanded="false"
            aria-controls="colapseFiltro"
          >
            <h3 style="color: rgb(23, 130, 182)" class="float-left">
              {{titulo}}
              <i class="fa fa-fw fa-filter"></i>
            </h3>
          </a>
        </div>
          <div
            v-bind:class="'card-body row collapse' + (show || '') + ''"
            id="colapseFiltro"
          >
            <input type="hidden" name="filtro" value="filtrar" />
            <slot></slot>
             <div class="col-12 text-center">
              <button class="btn btn-outline-primary" type="submit">
                <i class="fa fa-fw fa-search"></i> {{txt_buscar}}
              </button>
            </div>
          </div>
      </form>
    </div>
    <div style="height: 15px"></div>
  </div>
</template>

<script>
export default {
  props: ["titulo", "show", "action", "txt_buscar"]
};
</script>
