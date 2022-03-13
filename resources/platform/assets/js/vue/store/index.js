import {createStore} from "vuex";

const store = createStore({
    state: {
        //User State
        user: {
            data: { name: 'John Smith' },
            token: null,
        }
    },
    getters: {},
    actions: {},
    mutations: {},
    modules: {},
})

export default store;