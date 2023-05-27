const state = {
    currentUser: null,
};

const getters = {

};

const actions = {
    getUserInfo({ commit, state }) {
        const userInfoDataElement = document.getElementById('userInfoDataElement');

        if (userInfoDataElement) {
            console.log(userInfoDataElement);
            commit('setCurrentUser', { currentUser: JSON.parse(userInfoDataElement.dataset.user) });
            userInfoDataElement.parentNode.removeChild(userInfoDataElement);
        }
    },
};

const mutations = {
    setCurrentUser: (state, { currentUser }) => {
        state.currentUser = currentUser;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
