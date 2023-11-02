import api from '../../api/ecommerce/discounts';

const state = {
    menuItems: [],
    discounts: [],
    includedData: [],
    currentDiscount: { id: 0, attributes: {}, relationships: { product: { data: {} } } },
    results: 0,
    brand: 'default',
    totalPages: 0,
    currentPage: 1,
};

const getters = {

};

const actions = {
    getDiscounts({ commit, state }, { brands, page, limit }) {
        return new Promise((resolve) => {
            api.getDiscounts({ brands, page, limit })
                .then((response) => {
                    commit('setDiscounts', { discounts: response.data.data });
                    commit('setCurrentPage', response.data.meta.pagination.current_page);
                    commit('setTotalPages', response.data.meta.pagination.total_pages);
                    commit('setIncludedData', response.data.included);

                    resolve();
                });
        });
    },

    setCurrentDiscount({ commit, state }, discount) {
        commit('setCurrentDiscount', discount);
    },

    setCurrentDiscountAttribute({ commit, state }, { key, value }) {
        commit('setCurrentDiscountAttribute', { key, value });
    },

    setIncludedData({ commit, state }, data) {
        commit('setIncludedData', data);
    },

    setCurrentDiscountRelationshipId({ commit, state }, { type, id }) {
        commit('setCurrentDiscountRelationshipId', { type, id });
    },

    setDiscounts({ commit, state }, discounts) {
        commit('setDiscounts', { discounts });
    },
};

const mutations = {
    setDiscounts: (state, { discounts }) => {
        state.discounts = discounts;
    },

    setCurrentDiscount: (state, discount) => {
        state.currentDiscount = discount;
    },

    setCurrentDiscountAttribute: (state, { key, value }) => {
        state.currentDiscount.attributes[key] = value;
    },

    setIncludedData(state, data) {
        state.includedData = data;
    },

    setCurrentDiscountRelationshipId(state, { type, id }) {
        state.currentDiscount.relationships[type] = { data: { type, id } };
    },

    setCurrentPage: (state, currentPage) => {
        state.currentPage = currentPage;
    },

    setTotalPages: (state, totalPages) => {
        state.totalPages = totalPages;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
