<template>
    <v-card>
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title style="text-transform:capitalize;">
                {{ isContentLink ? 'Link' : 'Create' }} Post: {{ state.brand }}
            </v-toolbar-title>
            <v-spacer class="hidden-xs-only"></v-spacer>

            <v-tooltip left>
                <template v-slot:activator="{ on }">
                    <v-btn
                        v-if="isChild"
                        icon
                        text
                        class="mx-0"
                        v-on="on"
                        @click="isContentLink = !isContentLink"
                    >
                        <v-icon>{{ isContentLink ? 'add' : 'link' }}</v-icon>
                    </v-btn>
                </template>

                <span>{{ isContentLink ? 'Add New Content' : 'Link Existing Content' }}</span>
            </v-tooltip>
        </v-toolbar>

        <v-col
            v-if="!isContentLink"
            cols="12"
            class="pa-4 column"
        >
            <p class="caption grey--text lighten-5">
                Lets start with the basic information.
            </p>

            <v-form ref="newUser">
                <v-text-field
                    v-model="newPostTitle"
                    label="Title"
                    :color="brandColor"
                ></v-text-field>

                <v-autocomplete
                    v-model="newSelectedType"
                    label="Type"
                    color="white"
                    :items="$_availableContentTypes"
                    :disabled="this.contentType !== null"
                    item-text="label"
                    item-value="type"
                >
                </v-autocomplete>

                <div class="text-right">
                    <v-btn
                        text
                        class="mr-1"
                        @click="closeDialog"
                    >
                        Cancel
                    </v-btn>
                    <v-btn
                        class="white--text"
                        :disabled="!newPostTitle || !newSelectedType"
                        :color="brandColor"
                        @click="createPost"
                    >
                        Save
                    </v-btn>
                </div>
            </v-form>
        </v-col>

        <v-col
            v-if="isContentLink"
            cols="12"
            class="pa-4 column"
        >
            <v-form ref="newUser">
                <v-text-field
                    v-model="contentIdToLink"
                    label="Content ID"
                    :color="brandColor"
                ></v-text-field>

                <div class="text-right">
                    <v-btn
                        text
                        class="mr-1"
                        @click="closeDialog"
                    >
                        Cancel
                    </v-btn>
                    <v-btn
                        class="white--text"
                        :disabled="!contentIdToLink"
                        :color="brandColor"
                        @click="linkPost"
                    >
                        Save
                    </v-btn>
                </div>
            </v-form>
        </v-col>
    </v-card>
</template>
<script>
import { mapActions, mapState } from 'vuex';
import { Content as ContentHelpers } from '@musora/helper-functions';
import brandColors from '../../../api/mixins.js';
import api from '../../../api/content';
import Utils from '../../../api/utils';


export default {
    name: 'ContentCreateForm',
    mixins: [brandColors],
    props: {
        contentType: {
            type: String,
            default: () => null,
        },
        isChild: {
            type: Boolean,
            default: () => false,
        },
        parentId: {
            type: Number | String,
            default: () => null,
        },
        availableContentTypes: {
            type: Array,
        },
    },
    data() {
        return {
            newPostTitle: null,
            newSelectedType: this.contentType,
            contentIdToLink: null,
            isContentLink: false,
        };
    },
    computed: {
        ...mapState({
            state: state => state.content,
        }),

        $_availableContentTypes() {
            if (this.availableContentTypes) {
                return this.availableContentTypes;
            }

            return Utils.dynamicSort(ContentHelpers.getBrandSpecificTopLevelContentTypes(this.state.brand), 'label');
        },

        $_availableContentTypesValues() {
            return this.contentType === null ? this.availableContentTypes.map(type => type.label) : [this.contentType];
        },
    },
    methods: {
        closeDialog() {
            this.isContentLink = false;
            this.contentIdToLink = null;

            this.$emit('closeDialog');
        },

        goToPost(post) {
            this.$router.push({
                name: 'content.edit',
                params: {
                    brand: this.state.brand,
                    type: post.type,
                    id: post.id,
                },
            });
        },

        statusToSet() {
            if (this.newSelectedType === 'assignment' || this.newSelectedType === 'instructor') {
                return 'published';
            }

            return 'draft';
        },

        createPost() {
            const now = this.moment.utc(this.moment.now()).format('YYYY-MM-DD HH:mm:ss');
            const publishedNow = ['assignment', 'instructor'].indexOf(this.newSelectedType) !== -1;
            const publishedOnDate = publishedNow ? now : undefined;

            this.$root.$emit('pageLoading');

            api.setContent({
                brand: this.state.brand,
                type: this.newSelectedType.toLowerCase(),
                title: this.newPostTitle,
                parent_id: this.parentId,
                status: this.statusToSet(),
                published_on: publishedOnDate,
            })
                .then((response) => {
                    const newPost = response.data.data[0];

                    if (newPost) {
                        api.setContentField({
                            content_id: newPost.id,
                            key: this.newSelectedType === 'instructor' ? 'name' : 'title',
                            value: this.newPostTitle,
                            position: 1,
                            type: 'string',
                        })
                            .then((resolved) => {
                                if (resolved) {
                                    if (!this.isChild) {
                                        this.$root.$emit('displayMessage', {
                                            color: 'success',
                                            text: 'Lesson successfully created! Redirecting you to the post..',
                                        });

                                        this.goToPost(newPost);
                                    } else {
                                        this.$emit('childAdded');
                                        this.$root.$emit('displayMessage', {
                                            color: 'success',
                                            text: 'Lesson successfully added to this post',
                                        });
                                    }

                                    this.$root.$emit('pageLoaded');
                                }
                            });
                    }
                });
        },

        linkPost() {
            this.$root.$emit('pageLoading');

            api.setContentHierarchy({
                parent_id: this.parentId,
                child_id: this.contentIdToLink,
            })
                .then((response) => {
                    if (response) {
                        this.$emit('childAdded');
                        this.$root.$emit('displayMessage', {
                            color: 'success',
                            text: 'Child successfully added to this post',
                        });
                    }

                    this.$root.$emit('pageLoaded');
                });
        },
    },
};
</script>
