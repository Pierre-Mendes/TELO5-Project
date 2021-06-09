<template>
  <div class="small-box" v-bind:style="defineCor">
    <div class="inner">
      <h3>{{titulo}}</h3>

      <p>{{texto}}</p>
    </div>
    <div class="icon">
      <i v-bind:class="icone"></i>
    </div>
    <a v-bind:href="url" v-bind:target="openNewTab" class="small-box-footer">
      {{botao}} <i class="fa fa-arrow-circle-right"></i>
    </a>
  </div>
</template>

<script>
    export default {
      props:['texto','titulo','url','cor','icone', 'botao', 'newtab'],
      computed:{
        defineCor:function(){
          return "background-color: "+this.cor+" !important;"
        },
        openNewTab:function(){
          if('sim' === this.newtab){
            return "_blank"
          }else{
            return ""
          }
        }
      }

    }
</script>

<style media="screen">
  .bg-aqua{
      background-color: #00c0ef !important;
  }

  .small-box {
    border-radius: 2px;
    position: relative;
    display: block;
    margin-bottom: 20px;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    color: #FFF;
  }

  .small-box:hover {
    text-decoration: none;
    color: #f9f9f9;
  }

  .small-box>.inner {
    padding: 10px;
  }

  .small-box h3, .small-box p {
    z-index: 5;
  }

  .small-box h3 {
    font-size: 20px;
    font-weight: bold;
    margin: 0 0 10px 0;
    white-space: nowrap;
    padding: 0;
  }

  .small-box p {
    font-size: 12px;
  }

  p {
    margin: 0 0 10px;
  }

  .small-box .icon {
    -webkit-transition: all .3s linear;
    -o-transition: all .3s linear;
    transition: all .3s linear;
    position: absolute;
    bottom: 20px;
    right: 10px;
    z-index: 0;
    font-size: 55px;
    color: rgba(0,0,0,0.15);
  }

  .small-box:hover .icon {
    font-size: 65px;
  }

  .small-box>.small-box-footer {
    position: relative;
    text-align: center;
    padding: 3px 0;
    color: #fff;
    color: rgba(255,255,255,0.8);
    display: block;
    z-index: 10;
    background: rgba(0,0,0,0.1);
    text-decoration: none;
  }

  a {
    color: #3c8dbc;
  }

  .small-box>.small-box-footer:hover {
    color: #fff;
    background: rgba(0,0,0,0.15);
  }

  a:hover, a:active, a:focus {
    outline: none;
    text-decoration: none;
    color: #72afd2;
  }


</style>
