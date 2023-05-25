import api from '../../api/ecommerce/shipping';

const state = {
    menuItems: [],
    shippingOptions: [],
    shippingFulfillments: [],
    results: 0,
    brand: 'default',
};

const getters = {

};

const actions = {
    getShippingOptions({ commit, state }, params = {}) {
        api.getShippingOptions()
            .then((response) => {
                commit('setShippingOptions', { shippingOptions: response.data.data });
            });
    },

    getShippingFulfillments({ commit, state }, params = {}) {
        api.getShippingFulfillments({
            status: params.status,
            page: params.page,
            limit: params.limit,
            order_by_direction: params.order_by_direction,
            order_by_column: params.order_by_column,
        })
            .then((response) => {
                commit('setShippingFulfillments', { shippingFulfillments: response.data.data });
            });
    },

    setShippingOptions({ commit, state }, shippingOptions) {
        commit('setShippingOptions', { shippingOptions });
    },
};

const mutations = {
    setShippingOptions: (state, { shippingOptions }) => {
        state.shippingOptions = shippingOptions;
    },

    setShippingFulfillments: (state, { shippingFulfillments }) => {
        state.shippingFulfillments = shippingFulfillments;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
