import { Content as ContentHelpers } from '@musora/helper-functions';
import api from '../../api/content';
import Utils from '../../api/utils';
import ContentFieldsData from '../../mixins/content-fields-data';
import * as ContentModel from '../../models/model';

const state = {
    menuItems: [],
    content: [],
    requestTokens: {},
    currentPost: Utils.createObjectCopy(ContentFieldsData),
    currentChildPost: Utils.createObjectCopy(ContentFieldsData),
    emptyPost: Utils.createObjectCopy(ContentFieldsData),
    childPosts: [],
    contentModel: null,
    childPostContentModel: null,
    loading: false,
    results: 0,
    currentPage: 1,
    totalPages: 0,
    instructorOptions: [],
    brand: 'default',
};

const getters = {

};

const actions = {
    getContent({ commit, state }, params = {}) {
        commit('setLoading', { loading: true });

        api.getContent({
            brand: params.brand,
            limit: params.limit,
            statuses: params.statuses,
            sort: params.sort,
            term: params.term,
            included_types: params.included_types,
            page: params.page,
        })
            .then((response) => {
                const flattenedContent = ContentHelpers.flattenContent(response.data.data);

                commit('setContent', { content: flattenedContent });
                commit('setLoading', { loading: false });
                commit('setCurrentPage', { currentPage: response.data.meta.page });
                commit('setTotalPages', { totalResults: response.data.meta.totalResults });
            });
    },

    getContentChildren({ commit, state }, id) {
        api.getContentChildren(id)
            .then((response) => {
                const children = ContentHelpers.flattenContent(response.data.data);

                commit('setContentChildren', children);
            });
    },

    getBrand({ commit, state }, router) {
        commit('setBrand', { brand: router.router.params.brand });
    },

    getInstructors({ commit, state }, params = {}) {
        let instructorType = 'instructor';

        api.getContent({
            brand: params.brand,
            limit: 10000,
            sort: 'slug',
            included_types: [instructorType],
        })
            .then((response) => {
                if (response) {
                    commit('setInstructors', { instructorOptions: ContentHelpers.flattenContent(response.data.data, true) });
                }
            });
    },

    getCurrentPost({ commit, state }, currentPost) {
        commit('setCurrentPost', currentPost);
    },

    getCurrentChildPost({ commit, state }, currentChildPost) {
        commit('setCurrentChildPost', currentChildPost);
    },

    getContentModel({ commit, state }, type) {
        commit('setContentModel', type);
    },

    getChildContentModel({ commit, state }, type) {
        commit('setChildContentModel', type);
    },

    setContentProperty({ commit, state }, { prop, child }) {
        return new Promise((resolve) => {
            api.setContentProperty(prop)
                .then((response) => {
                    if (response) {
                        const currentPost = ContentHelpers.flattenContent(response.data.data)[0];

                        if (child) {
                            commit('setCurrentChildPost', { currentChildPost: currentPost });
                        } else {
                            commit('setCurrentPost', { currentPost });
                        }
                        resolve(true);
                    }
                });
        });
    },

    setContentPermission({ commit, state }, permission) {
        return api.setContentPermission(permission)
            .then((response) => {
                if (response) {
                    if (permission.child) {
                        commit('setCurrentChildPost', {
                            currentChildPost: ContentHelpers.flattenContent([response.data.post])[0],
                        });
                    } else {
                        commit('setCurrentPost', {
                            currentPost: ContentHelpers.flattenContent([response.data.post])[0],
                        });
                    }
                }
                return response;
            });
    },

    setField({ commit, state }, field) {
        return api.setContentField(field)
            .then((response) => {
                if (response) {
                    if (field.child) {
                        commit('setCurrentChildPost', {
                            currentChildPost: ContentHelpers.flattenContent([response.data.post])[0],
                        });
                    } else {
                        commit('setCurrentPost', {
                            currentPost: ContentHelpers.flattenContent([response.data.post])[0],
                        });
                    }
                }
                return response;
            });
    },

    setDatum({ commit, state }, field) {
        return api.setContentDatum(field)
            .then((response) => {
                if (response) {
                    const post = ContentHelpers.flattenContent([response.data.post])[0];

                    if (field.child) {
                        commit('setCurrentChildPost', {
                            currentChildPost: post,
                        });
                    } else {
                        commit('setCurrentPost', {
                            currentPost: post,
                        });
                    }
                }
                return response;
            });
    },

    getRuleToLoading({ commit, state }, rule) {
        commit('setRuleToLoading', rule);
    },

    setCurrentRequest({ commit, state }, token) {
        commit('setCurrentRequest', token);
    },
};

const mutations = {
    setContent: (state, { content }) => {
        state.content = content;
    },

    setCurrentPost: (state, { currentPost }) => {
        state.currentPost = {
            ...state.emptyPost,
            ...currentPost,
        };
    },

    setContentChildren: (state, children) => {
        state.childPosts = children;
    },

    setCurrentChildPost: (state, { currentChildPost }) => {
        state.currentChildPost = {
            ...state.emptyPost,
            ...currentChildPost,
        };
    },

    setBrand: (state, { brand }) => {
        state.brand = brand;
    },

    setCurrentPage: (state, { currentPage }) => {
        state.currentPage = Number(currentPage);
    },

    setTotalPages: (state, { totalResults }) => {
        state.totalPages = Math.ceil(totalResults / 20);
    },

    setLoading: (state, { loading }) => {
        state.loading = loading;
    },

    setInstructors: (state, { instructorOptions }) => {
        state.instructorOptions = instructorOptions;
    },

    setContentModel: (state, { type }) => {
        let contentType = type;
        contentType = ContentHelpers.shows().indexOf(contentType) !== -1 ? 'show' : contentType.replace(/-/g, '');

        const rules = new ContentModel[contentType]();

        state.contentModel = api.parseContentModelForTypeAndBrand(rules, state.brand);
    },

    setChildContentModel: (state, { type }) => {
        let contentType = type;
        contentType = ContentHelpers.shows().indexOf(contentType) !== -1 ? 'show' : contentType.replace(/-/g, '');

        const rules = new ContentModel[contentType]();

        state.childPostContentModel = api.parseContentModelForTypeAndBrand(rules, state.brand);
    },

    setRuleToLoading: (state, rule) => {
        if (state.contentModel[rule.key] == null) {
            return;
        }

        if (rule.child) {
            state.childPostContentModel[rule.key].loading = rule.loading;
        } else {
            state.contentModel[rule.key].loading = rule.loading;
        }
    },

    setCurrentRequest: (state, token) => {
        state.currentRequests[token.key] = token;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
