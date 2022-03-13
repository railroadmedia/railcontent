require('./bootstrap');

import { createApp } from 'vue';
import store from './vue/store';
import HomeApp from './vue/views/Home.vue';

//Home 
createApp(HomeApp)
    .use(store)
    .mount('#home-app')