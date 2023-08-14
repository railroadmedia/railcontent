import { mapState, mapActions } from 'vuex';
import { Content as ContentHelpers } from '@musora/helper-functions';
import axios from 'axios';
import Utils from '../api/utils';

export default {
    props: {
        thisPost: {
            type: Object,
        },
        contentType: {
            type: String,
        },
        contentModel: {
            type: Object,
        },
        isChild: {
            type: Boolean,
            default: () => false,
        },
    },
    data() {
        return {
            typingTimeout: {},
        };
    },
    computed: {
        ...mapState({
            state: state => state.content,
        }),

        currentRequests() {
            return this.state.currentRequests;
        },

        post_id() {
            return this.thisPost.id;
        },
    },
    methods: {
        ...mapActions('content', [
            'setField',
            'setDatum',
            'setContentProperty',
            'setContentPermission',
            'getRuleToLoading',
            'openChildEditForm',
            'getCurrentPost',
            'getCurrentChildPost',
        ]),

        /**
         * Send the set property request
         *
         * @param key {string} - key of the field
         * @param val {any} - value
         * @param content_id
         * @param child
         */
        sendSetContentPropertyRequest(key, val, content_id, child = false) {
            const prop = {
                content_id,
            };
            prop[key] = val;

            clearTimeout(this.typingTimeout[key]);

            this.typingTimeout[key] = setTimeout(() => {
                this.getRuleToLoading({
                    key,
                    loading: true,
                    child,
                });

                this.setContentProperty({
                    prop,
                    child,
                })
                    .then((response) => {
                        if (response) {
                            this.handleResponse(response, key);
                        }

                        this.getRuleToLoading({
                            key,
                            loading: false,
                            child,
                        });

                        this.$root.$emit('pageLoaded');
                    });
            }, 2000);
        },

        /**
         * Send the set field request
         *
         * @param key {string} - key of the field
         * @param val {any} - value
         * @param deleted {boolean} - whether or not to delete the field
         * @param multi {boolean} - whether or not the content supports multiple
         * @param delay {number} - used for input purposes, wait for user to finish typing etc..
         * @param child { boolean }
         */
        sendSetFieldRequest({
            key,
            val,
            deleted = false,
            multi = false,
            delay = 4000,
            child = false,
        }) {
            let fieldId = this.thisPost[key] === undefined ? null : this.thisPost[key].id;
            const position = Array.isArray(this.thisPost[key]) ? this.thisPost[key].length + 1 : 1;

            if (multi && deleted) {
                fieldId = val;
            }

            clearTimeout(this.typingTimeout[key]);

            this.typingTimeout[key] = setTimeout(() => {
                const hasError = this.$refs[key] ? this.$refs[key].hasError : false;

                if (!hasError) {
                    this.getRuleToLoading({
                        key,
                        loading: true,
                        child,
                    });

                    this.setField({
                        field_id: fieldId,
                        content_id: this.thisPost.id,
                        key,
                        value: val,
                        position,
                        type: this.contentModel[key].type,
                        deleted,
                        child,
                    })
                        .then((response) => {
                            this.handleResponse(response, key);

                            this.getRuleToLoading({
                                key,
                                loading: false,
                                child,
                            });
                        });
                }
            }, delay);
        },

        /**
         * Send the set datum request
         *
         * @param key {string} - key of the datum
         * @param val - value
         * @param deleted {boolean} - whether or not to delete the field
         * @param multi {boolean} - whether or not the content supports multiple
         * @param delay {number} - used for input purposes, wait for user to finish typing etc..
         * @param child { boolean }
         */
        sendSetDatumRequest({
            key,
            val,
            deleted = false,
            multi = false,
            delay = 4000,
            child = false,
        }) {
            const position = Array.isArray(this.thisPost[key]) ? this.thisPost[key].length + 1 : 1;
            clearTimeout(this.typingTimeout);

            this.typingTimeout = setTimeout(() => {
                const hasError = this.$refs[key] ? this.$refs[key].hasError : false;

                if (!hasError) {
                    this.getRuleToLoading({
                        key,
                        loading: true,
                        child,
                    });

                    this.setDatum({
                        datum_id: this.thisPost[key] !== undefined ? this.thisPost[key].id : null,
                        content_id: this.thisPost.id,
                        key,
                        value: val,
                        position,
                        type: this.contentModel[key].type,
                        deleted,
                        child,
                    })
                        .then((response) => {
                            this.handleResponse(response, key);

                            this.getRuleToLoading({
                                key,
                                loading: false,
                                child,
                            });
                        });
                }
            }, delay);
        },

        /**
         * Send the set permission request
         *
         * @param content_id {string|number}
         * @param permission_id {string|number}
         * @param deleted {boolean}
         * @param child {boolean}
         */
        sendSetPermissionRequest({
            content_id,
            permission_id,
            brand,
            deleted = false,
            child = false,
        }) {
            this.setContentPermission({
                content_id,
                permission_id,
                brand,
                deleted,
                child,
            })
                .then((response) => {
                    this.handleResponse(response, 'permission');
                });
        },

        /**
         * Handle the response from a request
         *
         * @param response {object}
         * @param key {string} - The key/label for the data you tried to edit.
         */
        handleResponse(response, key) {
            key = Utils.toCapitalCase(key);

            const successMessage = response
                ? (`${key} successfully edited!`)
                : (`Oops, an error occurred. ${key} likely not edited.`);

            this.$root.$emit('displayMessage', {
                color: response ? 'success' : 'error',
                text: successMessage,
            });
        },

        /**
         * Bus the open child event
         *
         * @param payload {object}
         */
        openChildEditForm(payload) {
            this.$emit('openChildEditForm', payload);
        },

        /**
         * Check if deleted
         *
         * @param key {string}
         * @param val {string}
         * @returns {Boolean}
         */
        isDeleted(key, val) {
            return this.thisPost[key] !== undefined && (this.thisPost[key].id !== null && val.length === 0);
        },

        /**
         * Reset the content edit page state to the post passed in
         *
         * @param post {object}
         */
        resetContentEditState(post) {
            if (this.isChild) {
                this.getCurrentChildPost({
                    currentChildPost: ContentHelpers.flattenContent([post])[0],
                });
            } else {
                this.getCurrentPost({
                    currentPost: ContentHelpers.flattenContent([post])[0],
                });
            }
        },
    },
};
