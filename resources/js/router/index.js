import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeComponent from '../views/Home'
import LoginComponent from '../views/Auth/login'
import registerComponent from '../views/Auth/register'
import Setting from '../views/setting/Index.vue'
import SetPermission from '../views/setting/roles/SetPermission.vue'
import Permission from '../views/setting/roles/Permission.vue'
import Role from '../views/setting/roles/Role.vue'
import store from '../store.js'


Vue.use(VueRouter)

const route = new VueRouter({
    mode : 'history',
    routes : [
        {
            path : '/home',
            name : 'home',
            component : HomeComponent,
            meta : {requiresAuth : true}
        },
        // {
        //     path : '/',
        //     name : 'home',
        //     component : HomeComponent,
        //     meta : {requiresAuth : true}
        // },
        {
            path : '/login',
            name : 'login',
            component : LoginComponent,
        },
        {
            path : '/register',
            name : 'register',
            component : registerComponent,
        },
        {
            path: '/setting',
            component: Setting,
            name : 'setting_access',
            meta: { requiresAuth: true },
            children: [
                {
                    path: 'setting/role-permission',
                    name: 'role.permissions',
                    component: SetPermission,
                    meta: { title: 'Set Permissions', requiresAuth: true }
                },
                {
                    path: '/role',
                    name: 'role',
                    component: Role,
                    meta: { title: 'Set Role', requiresAuth: true }
                },
                {
                    path: '/permission',
                    name: 'permissions',
                    component: Permission,
                    meta: { title: 'Permissions', requiresAuth: true }
                },
            ]
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