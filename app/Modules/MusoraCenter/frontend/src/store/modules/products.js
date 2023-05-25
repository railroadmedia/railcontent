import api from '../../api/ecommerce/products';

const state = {
    menuItems: [],
    products: [],
    currentProduct: { id: 0, attributes: {} },
    currentPage: 1,
    totalPages: 0,
    brand: 'default',
};

const getters = {

};

const actions = {
    getProducts({ commit, state }, params = {}) {
        return api.getProducts({
            brands: params.brands,
            limit: params.limit,
            page: params.page,
            order_by_column: 'created_at',
            order_by_direction: 'desc',
        })
            .then((response) => {
                commit('setProducts', { products: response.data.data });
                commit('setCurrentPage', { currentPage: response.data.meta.pagination.current_page });
                commit('setTotalPages', { totalResults: response.data.meta.pagination.total_pages });
            });
    },

    getProductById({ commit, state }, id) {
        api.getProductById(id)
            .then((response) => {
                commit('setCurrentProduct', response.data.data);
            });
    },

    setProducts({ commit, state }, products) {
        commit('setProducts', { products });
    },

    setCurrentProduct({ commit, state }, product) {
        commit('setCurrentProduct', product);
    },

    setCurrentProductAttribute({ commit, state }, { key, value }) {
        commit('setCurrentProductAttribute', { key, value });
    },
};

const mutations = {
    setProducts: (state, { products }) => {
        state.products = products;
    },

    setCurrentProduct: (state, product) => {
        state.currentProduct = product;
    },

    setCurrentProductAttribute: (state, { key, value }) => {
        state.currentProduct.attributes[key] = value;
    },

    setCurrentPage: (state, { currentPage }) => {
        state.currentPage = currentPage;
    },

    setTotalPages: (state, { totalResults }) => {
        state.totalPages = Math.ceil(totalResults / 20);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
