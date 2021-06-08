import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import App from './assets/App.vue';
import Dashboard from './components/Dashboard.vue';
import Home from './components/Home.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';

// const TareaList = () => import('./components/Lista.vue');
// const TareaCreate = () => import('./components/Add.vue');
// const TareaEdit = () => import('./components/Edit.vue');
import Lista from './components/Lista.vue';
import Add from './components/Add.vue';
import store from './store';
 
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
 
//vue-toaster
import Toaster from 'v-toaster';
import 'v-toaster/dist/v-toaster.css';
 
Vue.use(Toaster, {timeout: 2000});
 
const router = new VueRouter({
    mode: 'history',
    routes: [
    {
        path: '/',
        name: 'home',
        component: Home
    },
 
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            auth: false
        }
    },
    
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false
        }
    },
    {
        
        path: '/lista',
        name: 'lista',
        component: Lista
        // component: TareaList
    },
    // {
    //     name: 'tareaEdit',
    //     path: '/tarea/:id/edit',
    //     component: TareaEdit
    // },
    {
        name: 'add',
        path: '/add',
        component: Add
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        meta: { requiresAuth: true }
    }]
});
 
router.beforeEach((to, from, next) => {
 
    // check if the route requires authentication and user is not logged in
    if (to.matched.some(route => route.meta.requiresAuth) && !store.state.isLoggedIn) {
        // redirect to login page
        next({ name: 'login' })
        return
    }
 
    // if logged in redirect to dashboard
    if(to.path === '/login' && store.state.isLoggedIn) {
        next({ name: 'dashboard' })
        return
    }
 
    next()
});
 
// new Vue(App).$mount('#app');
new Vue({
    router,
    store,
    el: '#app',
    render: h => h(App)
});