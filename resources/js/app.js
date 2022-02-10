
require('./bootstrap');
import Vue from 'vue'
import router from './router'



Vue.component('app-main', 
require('./components/MainComponent.vue').default);


const app = new Vue({
    el: '#app',
    router
});
