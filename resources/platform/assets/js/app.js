require('./bootstrap');

import { createApp } from 'vue';
import store from './vue/store';
import router from './vue/router';
import AppContainer from './vue/apps/AppContainer.vue';

//Home 
createApp(AppContainer)
    .use(store)
    .use(router)
    .mount('#app')