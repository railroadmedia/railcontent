require('./bootstrap');

import { createApp } from 'vue';
import store from './vue/store';
import router from './vue/router';
import HomeApp from './vue/apps/HomeApp.vue';

//Home 
createApp(HomeApp)
    .use(store)
    .use(router)
    .mount('#home-app')