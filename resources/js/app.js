
require('./bootstrap');
import Vue from 'vue'
import router from './router'
import store from './store'
import Permissions from './mixins/permission'
import GlobalComponent from './globalComponents'
import GlobalMixins from './mixins/global'
import { mapActions, mapGetters, mapState  } from 'vuex'
Vue.mixin(Permissions)
Vue.use(GlobalComponent)
Vue.use(GlobalMixins)

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
    ...mapGetters(['isAuth']),
    ...mapState(['token']),
    ...mapState('user', {
            user_authenticated: state => state.authenticated
        })
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
