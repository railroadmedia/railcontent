<template>
    <v-card class="edit-form mb-12">
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>Lessons</v-toolbar-title>
            <v-spacer class="hidden-xs-only"></v-spacer>

            <v-tooltip left>
                <template v-slot:activator="{ on }">
                    <v-btn
                        slot="activator"
                        icon
                        text
                        class="mx-0"
                        v-on="on"
                        @click="openNewDialog"
                    >
                        <v-icon>add</v-icon>
                    </v-btn>
                </template>

                <span>Create New Lesson</span>
            </v-tooltip>

            <v-tooltip left>
                <template v-slot:activator="{ on }">
                    <v-btn
                        v-if="thisPost.id && thisPost.type === 'learning-path'"
                        slot="activator"
                        icon
                        text
                        class="mx-0"
                        v-on="on"
                        @click="openLinkDialog"
                    >
                        <v-icon>link</v-icon>
                    </v-btn>
                </template>

                <span>Link Existing Content</span>
            </v-tooltip>
        </v-toolbar>

        <v-col
            v-if="thisPost.id"
            class="column"
            cols="12"
        >
            <content-table
                :post-id="post_id"
                :items="childPosts"
                :child-type="childType"
                :parent-id="post_id"
                @openChildEditForm="childEditHandler"
                @childDeleted="childEdited"
                @childMoved="childEdited"
            ></content-table>
        </v-col>

        <v-dialog
            v-model="newDialog"
            max-width="500px"
        >
            <create-content-form
                :content-type="childType"
                :parent-id="post_id"
                :is-child="true"
                :available-content-types="availableContentTypes"
                @closeDialog="closeDialog"
                @childAdded="childAdded"
            ></create-content-form>
        </v-dialog>

        <v-dialog
            v-model="linkDialog"
            max-width="500px"
        >
            <v-card>
                <v-toolbar
                    flat
                    dark
                    :color="brandColor"
                >
                    <v-toolbar-title style="text-transform:capitalize;">
                        Link Post
                    </v-toolbar-title>
                </v-toolbar>

                <v-col
                    cols="12"
                    class="pa-4 column"
                >
                    <v-form>
                        <v-text-field
                            v-model="linkedPostId"
                            label="Content ID"
                            :disabled="linkedPostEditing"
                            :color="brandColor"
                        ></v-text-field>

                        <v-custom-wysiwyg-editor
                            v-if="linkDialog"
                            v-model="linkedPostDescription.value"
                            label="Description"
                            :color="brandColor"
                        ></v-custom-wysiwyg-editor>

                        <div class="text-right mt-1">
                            <v-btn
                                text
                                class="mr-1"
                                @click="closeDialog"
                            >
                                Cancel
                            </v-btn>
                            <v-btn
                                class="white--text"
                                :disabled="disableLinkForm"
                                :color="brandColor"
                                @click="formHandler"
                            >
                                Save
                            </v-btn>
                        </div>
                    </v-form>
                </v-col>
            </v-card>
        </v-dialog>
    </v-card>
</template>
<script>
import { mapState, mapActions } from 'vuex';
import { Content as ContentHelpers } from '@musora/helper-functions';
import brandColors from '../../../api/mixins.js';
import ContentTable from '../_ContentTable';
import ContentStore from '../../../mixins/content-store';
import CreateContent from './_CreateContent';
import api from '../../../api/content';
import Utils from '../../../api/utils';
import WYSIWYGEditor from '../../../components/CustomWYSIWYGEditor';


export default {
    name: 'ContentChildren',
    components: {
        'content-table': ContentTable,
        'create-content-form': CreateContent,
        'v-custom-wysiwyg-editor': WYSIWYGEditor,
    },
    mixins: [brandColors, ContentStore],
    data() {
        return {
            newDialog: false,
            linkDialog: false,
            linkedPostId: null,
            linkedPostDescription: {
                id: null,
                value: null,
                position: 1,
            },
            linkedPostEditing: false,
            childPosts: [],
        };
    },
    computed: {
        ...mapState({
            state: state => state.content,
        }),

        post_id() {
            return this.$route.params.id;
        },

        childType() {
            return {
                pack: 'pack-bundle',
                'pack-bundle': 'pack-bundle-lesson',
                'semester-pack': 'semester-pack-lesson',
                'learning-path': (this.state.brand === 'drumeo' || this.state.brand === 'singeo' || this.state.brand === 'guitareo') ? 'learning-path-level' : 'unit',
                'learning-path-level': (this.state.brand === 'singeo' || this.state.brand === 'guitareo') ? 'learning-path-lesson' : 'learning-path-course',
                'learning-path-course': 'learning-path-lesson',
                 'song-tutorial': 'song-tutorial-children',
            }[this.thisPost.type] || `${this.thisPost.type}-part`;
        },

        disableLinkForm() {
            return !this.linkedPostId || !this.linkedPostDescription.value;
        },

        availableContentTypes() {
            return [{
                type: this.childType,
                label: Utils.toCapitalCase(this.childType.replace(/-/g, ' ')),
                icon: ContentHelpers.getContentTypeIcon(this.childType),
            }];
        },
    },
    methods: {
        ...mapActions('content', [
            'getContentChildren',
        ]),

        openNewDialog() {
            this.newDialog = true;
        },

        openLinkDialog() {
            this.linkDialog = true;
            this.linkedPostEditing = false;
        },

        closeDialog() {
            this.newDialog = false;
            this.linkDialog = false;
            this.linkedPostId = null;
            this.linkedPostDescription = {
                id: null,
                value: null,
                position: 1,
            };
            this.linkedPostEditing = false;

            this.$nextTick(() => {
                this.$forceUpdate();
            });
        },

        childAdded() {
            this.closeDialog();
            this.getChildren();
        },

        childEditHandler(payload) {
            if (this.contentType === 'learning-path') {
                let thisLesson = this.childPosts.filter(post => post.id === payload.id);
                thisLesson = thisLesson.length ? thisLesson[0] : null;

                if (thisLesson) {
                    this.linkedPostId = thisLesson.id;
                    this.linkedPostDescription = thisLesson.learning_path_description ? Utils.createObjectCopy(thisLesson.learning_path_description) : '';
                    this.linkedPostEditing = true;

                    this.linkDialog = true;

                    this.$nextTick(() => {
                        this.$forceUpdate();
                    });
                }
            } else {
                this.$router.push({
                    name: 'content.edit',
                    params: {
                        brand: this.state.brand,
                        type: this.childType,
                        id: payload.id,
                    },
                });
            }
        },

        formHandler() {
            if (!this.linkedPostEditing) {
                this.linkPosts();
            } else {
                this.editLinkedPost();
            }
        },

        linkPosts() {
            api.setContentHierarchy({
                parent_id: this.thisPost.id,
                child_id: this.linkedPostId,
            })
                .then((response) => {
                    if (response) {
                        this.editLinkedPost();
                    }
                });
        },

        editLinkedPost() {
            api.setContentDatum({
                datum_id: this.linkedPostDescription.id || null,
                content_id: this.linkedPostId,
                key: 'learning_path_description',
                value: this.linkedPostDescription.value,
                position: 1,
            })
                .then((response) => {
                    if (response) {
                        this.getContentChildren(this.post_id);
                        this.$root.$emit('displayMessage', {
                            color: 'success',
                            text: `Child Lesson successfully ${this.linkedPostEditing ? 'edited' : 'created'}.`,
                        });
                        this.closeDialog();
                    }
                });
        },

        childEdited() {
            this.getChildren();
        },

        getChildren() {
            api.getContentChildren(this.post_id)
                .then((response) => {
                    this.childPosts = ContentHelpers.flattenContent(response.data.data);
                });
        },
    },
    watch: {
        linkDialog() {
            if (this.linkDialog === false) {
                this.linkedPostId = null;
                this.linkedPostDescription = {
                    id: null,
                    value: null,
                    position: 1,
                };
                this.linkedPostEditing = false;
            }
        },
    },
    mounted() {
        this.getChildren();
    },
};
</script>
