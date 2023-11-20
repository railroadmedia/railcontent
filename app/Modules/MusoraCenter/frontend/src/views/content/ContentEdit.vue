<template>
    <v-container>
        <v-row>
            <v-col
                class="column"
                cols="12"
            >
                <v-custom-breadcrumbs
                    :breadcrumbs="breadcrumbs"
                ></v-custom-breadcrumbs>
            </v-col>
        </v-row>
        <v-custom-content-forms
            v-if="postModel != null && !loading"
            :this-post="thisPost"
            :content-type="thisPost.type"
            :content-model="postModel"
            @openChildEditForm="openChild"
        ></v-custom-content-forms>

        <v-dialog
            v-model="dialog"
            fullscreen
            hide-overlay
            transition="dialog-bottom-transition"
        >
            <v-card class="pa-4">
                <v-toolbar
                    dark
                    :color="brandColor"
                >
                    <v-toolbar-title>Edit Child Post</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                        <v-btn
                            class="white--text"
                            text
                            icon
                            @click.native="dialog = false"
                        >
                            <v-icon>close</v-icon>
                        </v-btn>
                    </v-toolbar-items>
                </v-toolbar>

                <div style="max-width:1280px;margin:0 auto;">
                    <v-custom-content-forms
                        v-if="thisChildPost.id"
                        :key="thisChildPost.id"
                        :this-post="thisChildPost"
                        :content-type="thisChildPost.type"
                        :content-model="thisChildPostModel"
                        :is-child="true"
                    ></v-custom-content-forms>
                </div>
            </v-card>
        </v-dialog>
    </v-container>
</template>
<script>
import { mapState, mapActions } from 'vuex';
import { Content as ContentHelpers } from '@musora/helper-functions';
import brandColors from '../../api/mixins.js';
import Middleware from '../../middleware/content';
import Utils from '../../api/utils';
import ContentForms from './forms/_ContentForms';
import ContentFieldsData from '../../mixins/content-fields-data';
import api from '../../api/content';
import CustomBreadcrumbs from '../../components/CustomBreadcrumbs';

export default {
    name: 'ContentEdit',
    components: {
        'v-custom-content-forms': ContentForms,
        'v-custom-breadcrumbs': CustomBreadcrumbs,
    },
    mixins: [brandColors, ContentFieldsData],
    beforeRouteUpdate(to, from, next) {
        if (to.params.id !== from.params.id) {
            Middleware.contentEdit(this, to.params.id);
        }
        next();
    },
    beforeRouteEnter(to, from, next) {
        next((vm) => { Middleware.contentEdit(vm); });
    },
    data() {
        return {
            loading: false,
            dialog: false,
            content_type: null,
        };
    },
    computed: {
        ...mapState({
            state: state => state.content,
        }),

        thisPost() {
            return this.state.currentPost;
        },

        breadcrumbs() {
            return [
                {
                    text: 'Home',
                    disabled: false,
                    to: { name: 'home' },
                },
                {
                    text: Utils.toCapitalCase(this.$route.params.brand),
                    disabled: false,
                    to: { name: 'content' },
                },
                {
                    text: this.state.currentPost.title ? this.state.currentPost.title.value : (this.state.currentPost.name ? this.state.currentPost.name.value : ''),
                    disabled: true,
                },
            ];
        },

        postModel() {
            return this.state.contentModel;
        },

        thisChildPost() {
            return this.state.currentChildPost;
        },

        thisChildPostModel() {
            return this.state.childPostContentModel;
        },

        post_id() {
            return this.$route.params.id;
        },
    },
    methods: {
        ...mapActions('content', [
            'getBrand',
            'getInstructors',
            'getCurrentPost',
            'getCurrentChildPost',
            'getContentModel',
            'getChildContentModel',
        ]),

        getChildPost(id) {
            api.getContentById(id)
                .then((response) => {
                    if (response) {
                        this.dialog = true;

                        this.getChildContentModel({ type: response.data.data[0].type });
                        this.getCurrentChildPost({
                            currentChildPost: ContentHelpers.flattenContent(response.data.data)[0],
                        });

                        this.$nextTick(() => {
                            this.$forceUpdate();
                        });
                    }
                });
        },

        openChild(payload) {
            this.getChildPost(payload.id);
        },

        getParsedContentType(type) {
            return Utils.toCapitalCase(type ? type.replace(/-/g, ' ') : '');
        },
    },
    mounted() {
        this.$root.$on('reloadContent', () => {
            Middleware.contentEdit(this, this.post_id);
        });
    },
};
</script>
