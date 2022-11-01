require('./bootstrap');

//Libraries
import { createApp, defineAsyncComponent } from 'vue';
import axios from 'axios';
//components
import ContactEmailForm from './vuesora/components/ContactEmailForm/ContactEmailForm.vue';

//Initialize Vue
const app = createApp({});
//Mount Components
app.component('ContactEmailForm', ContactEmailForm )
//Use Libraries
app.use('VueAxios', axios);
//Mount Vue to App ID
app.mount('#contactPageApp');
