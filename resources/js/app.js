
require('./bootstrap');
import Vue from 'vue'
import router from './router'
import store from './store'

import Permissions from './mixins/Permission.js'
Vue.mixin(Permissions)

import { mapActions, mapGetters } from 'vuex'

Vue.component('app-main', 
require('./components/MainComponent.vue').default);
Vue.component('app-header', 
require('./components/Template/HeaderComponent.vue').default);
Vue.component('app-sidebar', 
require('./components/Template/SidebarComponent.vue').default);
Vue.component('app-footer', 
require('./components/Template/FooterComponent.vue').default);

const app = new Vue({
    el: '#app',
    router,
    store,
    computed: {
    ...mapGetters(['isAuth'])
    },
    methods: {
        ...mapActions('user', ['getUserLogin'])
    },
    created() {
        if (this.isAuth) {
            this.getUserLogin() //REQUEST DATA YANG SEDANG LOGIN
        }
    }
});
