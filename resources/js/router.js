import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store'
import Home from './components/pages/Home'


Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            redirect: '/home'
        },
        {
            path: '/home',
            name: 'home',
            component: Home
        }
    ]
})

// router.beforeEach((to, from, next) => {
//     if(to.meta.requiresAuth) {
//         if (store.state.token != 'TRUE') {
//             next('/signin') 
//         }
//         next() 
//     } else {
//             next() 
//         }
//     })

export default router