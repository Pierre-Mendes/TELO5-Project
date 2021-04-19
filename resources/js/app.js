/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');
window.axios = require('axios');


window.Vue = require('vue');
import Vuex from 'Vuex';
Vue.use(Vuex);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vuex

const store = new Vuex.Store({
    state: {
        item: {},
        fazendas: {}
    },
    mutations: {
        setItem(state, obj) {
            state.item = obj;
        },
        setFazendas(state, obj) {
            state.fazendas = obj;
        }
    }
});


Vue.component('tabela-lista', require('./components/TabelaLista.vue').default);
Vue.component('modallink', require('./components/Modal/ModalLink.vue').default);
Vue.component('modal', require('./components/Modal/Modal.vue').default);
Vue.component('modal-selecionar-fazenda', require('./components/Modal/ModalSelecionarFazenda.vue').default);
Vue.component('example', require('./components/ExampleComponent.vue').default);
Vue.component('formulario', require('./components/Formulario.vue').default);
Vue.component('filtro', require('./components/FiltroComponent.vue').default);
Vue.component('caixa', require('./components/Caixa.vue').default);
Vue.component('linha-emissor', require('./components/redimensionamento/LinhaCadastroEmissor.vue').default);
Vue.component('painel', require('./components/painel.vue').default);



const app = new Vue({
    el: '#app',
    store,
    mounted: function() {
        //console.log("ok");
        document.getElementById('app').style.display = "block";
    }
});