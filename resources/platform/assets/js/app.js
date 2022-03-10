require('./bootstrap');

import { createApp } from 'vue'
import HelloWorld from './vue/components/HelloWorld.vue';

const app = createApp({});
app.component('hello-world', HelloWorld)
    .mount('#app');
