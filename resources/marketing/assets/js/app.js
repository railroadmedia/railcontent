require('./bootstrap');

//Libraries
import Alpine from 'alpinejs'
import { createApp, defineAsyncComponent } from 'vue';
import axios from 'axios';
//components
import ContactEmailForm from './vuesora/components/ContactEmailForm/ContactEmailForm.vue';

window.Alpine = Alpine

//Initialize Alpine
Alpine.start();

//Initialize Vue
const app = createApp({});
//Mount Components
app.component('ContactEmailForm', ContactEmailForm )
//Use Libraries
app.use('VueAxios', axios);
//Mount Vue to App ID
app.mount('#contactPageApp');