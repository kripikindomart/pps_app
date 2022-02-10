import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeComponent from '../views/Home'
import LoginComponent from '../views/Auth/login'
import registerComponent from '../views/Auth/register'

Vue.use(VueRouter)

const route = new VueRouter({
    mode : 'history',
    routes : [
        {
            path : '/',
            name : 'home',
            component : HomeComponent,
            meta : {requiresAuth : true}
        },
        {
            path : '/login',
            name : 'login',
            component : LoginComponent,
        },
        {
            path : '/register',
            name : 'register',
            component : LoginComponent,
        }
    ]
})

//Navigation Guards
route.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        let auth = store.getters.isAuth
        if (!auth) {
            next({ name: 'login' })
        } else {
            next()
        }
    } else {
        next()
    }
})

export default route