import axios from 'axios';
import api from '../../api/ecommerce/products';
import Utils from '../../api/utils';

const state = {
    stats: {
        drumeo: { last_update: null },
        pianote: { last_update: null },
        guitareo: { last_update: null },
    },
    brand: 'drumeo',
};

const getters = {

};

const actions = {
    getStats({ commit, state }, brand) {
        const last_update = Math.floor(Date.now() / 1000);
        const refresh_interval = 3600000;

        // Only send the request if it's been an hour since the last one
        if (state.stats[brand].last_update == null
            || (last_update - refresh_interval) > state.stats[brand].last_update) {
            axios.get(`/analytics/json/${brand}`)
                .then((response) => {
                    response.data.stats.last_update = last_update;

                    commit('setStats', { brand, stats: response.data.stats });
                });
        }
    },

    setBrand({ commit, state }, brand) {
        commit('setBrand', { brand });
    },
};

const mutations = {
    setStats: (state, { brand, stats }) => {
        state.stats[brand] = stats;
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
