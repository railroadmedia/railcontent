import api from '../../api/ecommerce/orders';

const state = {
    menuItems: [],
    orders: [],
    results: 0,
    orderDetails: {},
    brand: 'default',
};

const getters = {

};

const actions = {
    getOrderDetails({ commit, state }, params = {}) {
        api.getOrderById(params.orderId)
            .then((response) => {
                commit('setOrderDetails', { orderDetails: response.data.data[0] });
            });
    },

    setOrderDetails({ commit, state }, orderDetails) {
        commit('setOrderDetails', { orderDetails });
    },
};

const mutations = {
    setOrderDetails: (state, { orderDetails }) => {
        state.orderDetails = orderDetails;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
