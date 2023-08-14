import api from '../../api/comments';

const state = {
    menuItems: [],
    comments: [],
    currentPage: 1,
    totalPages: 0,
    brand: 'drumeo',
};

const getters = {

};

const actions = {
    getComments({ commit, state }, params = {}) {
        api.getComments({
            brand: params.brand,
            limit: params.limit,
            page: params.page,
            sort: params.sort,
        })
            .then((response) => {
                commit('setComments', { comments: response.data.data });
                commit('setCurrentPage', { currentPage: response.data.meta.page });
                commit('setTotalPages', { totalResults: response.data.meta.totalResults });
            });
    },

    getBrand({ commit, state }, router) {
        commit('setBrand', { brand: router.router.params.brand });
    },
};

const mutations = {
    setComments: (state, { comments }) => {
        state.comments = comments;
    },
    setCurrentPage: (state, { currentPage }) => {
        state.currentPage = currentPage;
    },
    setTotalPages: (state, { totalResults }) => {
        state.totalPages = Math.ceil(totalResults / 20);
    },
    setBrand: (state, { brand }) => {
        state.brand = brand;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
