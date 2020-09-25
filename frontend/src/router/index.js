import Vue from 'vue'
import Router from 'vue-router'
import Login from '@/components/Login'
import Home from '@/components/Home'

Vue.use(Router)

export default new Router({
    routes:[
        {
            path: "/",
            name: "index",
            redirect: "/login"
        },
        {
            path:'/login',
            name:'Login',
            component: Login
        },
        {
            path:'/home',
            name:'Home',
            component: Home
        },
    ]
})