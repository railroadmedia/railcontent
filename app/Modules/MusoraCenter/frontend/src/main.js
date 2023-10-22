import Vue from 'vue';
import moment from 'moment-timezone';
import VueShowdown from 'vue-showdown';
import vuetify from './plugins/vuetify';
import router from './router';
import store from './store';
import App from './App.vue';
import vueDebounce from 'vue-debounce'

Vue.use(vueDebounce, {
    listenTo: 'input',
    defaultTime: '700ms'
});

Vue.use(VueShowdown, {
    options: {
        emoji: true,
    },
});

Vue.prototype.moment = moment;
Vue.prototype.Stripe = Stripe;

Vue.config.productionTip = false;

const MC = new Vue({
    router,
    store,
    vuetify,
    render: h => h(App),
}).$mount('#app');


// Redirect to 404 if the route has no matched values
router.beforeEach((to, from, next) => {
    if (to.matched.length === 0) {
        next({ name: '404' });
    } else {
        next();
    }
});
