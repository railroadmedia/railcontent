require('./bootstrap');

import { createApp } from 'vue';
import store from './vue/store';
import router from './vue/router';
import AppContainer from './vue/apps/AppContainer.vue';
import PageContainer from './vue/components/PageContainer/PageContainer.vue';
import HomeCardLinks from './vue/components/HomeCardLinks/HomeCardLinks.vue';
import CatalogSection from './vue/components/CatalogSection/CatalogSection.vue';
import StatsSection from './vue/components/StatsSection/StatsSection.vue';
import HeaderCarousel from './vue/components/HeaderCarousel/HeaderCarousel.vue'
import CoachEvent from './vue/vuesora/components/Coaches/CoachEvent.vue';
import Onboarding from './vue/components/Onboarding/Onboarding.vue';
import axios from 'axios'
import VueAxios from 'vue-axios'

const app = createApp({});

//Register Global Components
app.component('AppContainer', AppContainer)
   .component('PageContainer', PageContainer)
   .component('HeaderCarousel', HeaderCarousel)
   .component('HomeCardLinks', HomeCardLinks)
   .component('CatalogSection', CatalogSection)
   .component('StatsSection', StatsSection)
   .component('CoachEvent', CoachEvent)
   .component('Onboarding', Onboarding)

app.directive('click-outside', {
    mounted(el, binding, vnode) {
        setTimeout(() => {
            el.clickOutsideEvent = (event) => {
                if (!(el === event.target || el.contains(event.target))) {
                    binding.value()
                }
            }
            document.body.addEventListener('click', el.clickOutsideEvent)
        }, 100)
    },
    unmounted(el) {
        document.body.removeEventListener('click', el.clickOutsideEvent)
    }
})

app.use(store);
app.use(router);
app.use(VueAxios, axios);
app.mount('#app');

