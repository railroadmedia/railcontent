import Vue from 'vue';
import Vuex from 'vuex';
import createLogger from 'vuex/dist/logger';
import auth from './modules/auth';
import content from './modules/content';
import users from './modules/users';
import products from './modules/products';
import analytics from './modules/analytics';
import discounts from './modules/discounts';
import comments from './modules/comments';
import orders from './modules/orders';
import shipping from './modules/shipping';

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';

export default new Vuex.Store({
    modules: {
        auth,
        content,
        users,
        products,
        analytics,
        discounts,
        comments,
        orders,
        shipping,
    },
    strict: debug,
    plugins: debug ? [createLogger()] : [],
});
