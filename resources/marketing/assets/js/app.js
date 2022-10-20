require('./bootstrap');

//Libraries
import Alpine from 'alpinejs'
import { createApp, defineAsyncComponent } from 'vue';
import axios from 'axios';

window.Alpine = Alpine

//Initialize Alpine
Alpine.start();

//Initialize Vue
const app = createApp({});
//Mount Components
app.component('ContactEmailForm', defineAsyncComponent(() =>
    import(
        /* webpackChunkName: "piano-backing-tracks" */
        './vuesora/components/ContactEmailForm/ContactEmailForm.vue'
    )
))
//Use Libraries
app.use('VueAxios', axios);
//Mount Vue to App ID
app.mount('#contactPageApp');