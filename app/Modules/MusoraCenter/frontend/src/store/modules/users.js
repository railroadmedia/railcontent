import api from '../../api/users';

const state = {
    users: [],
    usersIncluded: [],
    currentUser: null,
    totalPages: 1,
    currentPage: 1,
    userHistory: [],
    brand: 'default',
};

const getters = {

};

const actions = {
    getUsers({ commit, state }, params = {}) {
        return new Promise((resolve) => {
            api.getUsers({
                limit: params.limit,
                page: params.page,
                order_by_column: params.column,
                order_by_direction: params.direction,
                search_term: params.search_term,
            })
                .then((response) => {
                    commit('setUsers', { users: response.data.data });
                    commit('setTotalPages', response.data.meta.pagination.total_pages);
                    commit('setUsersIncluded', response.data.included );

                    resolve();
                });
        });
    },

    getUserById({ commit, state }, id) {
        api.getUserById(id)
            .then((response) => {
                commit('setCurrentUser', response.data.data);
            });
    },

    editUserField({ commit, state }, { id, key, value }) {
        commit('setUserField', { id, key, value });
    },

    getCurrentUser({ commit, state }, user) {
        commit('setCurrentUser', user);
    },

    setUsers({ commit, state }, users) {
        commit('setUsers', { users });
    },
};

const mutations = {
    setUsers: (state, { users }) => {
        state.users = users;
    },

    setUsersIncluded: (state, usersIncluded) => {
        state.usersIncluded = usersIncluded;
    },

    setCurrentUser: (state, user) => {
        state.currentUser = user;
    },

    setUserField: (state, { key, value }) => {
        state.currentUser.attributes[key] = value;
    },

    addUserToHistory: (state, user) => {
        state.userHistory.push(user);

        localStorage.setItem('musora-center-user-history', JSON.stringify(state.userHistory));
    },

    loadUserHistory(state) {
        state.userHistory = JSON.parse(localStorage.getItem('musora-center-user-history') || '[]');
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
