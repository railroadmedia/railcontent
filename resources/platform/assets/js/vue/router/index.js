import {createRouter, createWebHistory} from 'vue-router';
import Home from '../views/Home.vue';
import Login from '../views/Login.vue';
import Search from '../views/Search.vue';

const routes = [
    {
        path: '/members',
        name: 'Home',
        component: Home
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/members/search',
        name: 'Search',
        component: Search
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes

})

export default router;