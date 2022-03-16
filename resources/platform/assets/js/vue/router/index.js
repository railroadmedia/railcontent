import {createRouter, createWebHistory} from 'vue-router';
import Home from '../views/Home.vue';
import Login from '../views/Login.vue';
import Search from '../views/Search.vue';
import Onboarding from '../views/Onboarding.vue';

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
    },
    {
        path: '/members/onboarding',
        name: 'Onboarding',
        component: Onboarding
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes

})

export default router;