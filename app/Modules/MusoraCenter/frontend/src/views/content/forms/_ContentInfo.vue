<template>
    <v-col
        cols="12"
        class="mt-4 mb-2 mb-12 px-4 column"
    >
        <h3>
            <v-avatar
                size="30"
                :color="brandColor"
                class="mr-2"
            >
                <v-icon
                    size="14"
                    dark
                    style="vertical-align:middle;"
                >
                    {{ getContentTypeIcon(thisPost.type) }}
                </v-icon>
            </v-avatar>
            {{ parsedContentType }}
        </h3>
        <h1 class="mt-1">
            {{ postTitle }}
        </h1>


        <p class="ma-0">
            <strong>ID:</strong> {{ thisPost.id }}
        </p>

        <v-hover>
            <p slot-scope="{ hover }">
                <strong>Slug:</strong> {{ thisPost.slug }}
                <v-expand-transition>
                    <v-btn
                        v-if="hover"
                        text
                        icon
                        @click="openSlugEdit"
                    >
                        <v-icon small>
                            edit
                        </v-icon>
                    </v-btn>
                </v-expand-transition>
            </p>
        </v-hover>
        <p class="ma-0">
            <strong>Created On:</strong> {{ moment(thisPost.created_on).format('MMMM Do, YYYY') }}
        </p>

        <div class="mt-4">
            <v-btn
                v-if="thisPost.type !== 'assignment' && thisPost.type !== 'instructor'"
                class="ma-0"
                :href="previewUrl"
                target="_blank"
                :color="brandColor"
                dark
            >
                <v-icon
                    left
                    dark
                >
                    pageview
                </v-icon>
                Preview
            </v-btn>

            <v-btn
                v-if="parentId"
                :to="{ name: 'content.edit', params:{ brand: this.state.brand, type: parentContentType, id: parentId } }"
                class="ma-0 ml-4"
                outlined
                :color="brandColor"
                text
            >
                <v-icon
                    left
                    dark
                >
                    arrow_left
                </v-icon>
                Back to Parent
            </v-btn>
        </div>

        <div
            v-if="thisPost.duplicates && thisPost.duplicates.length > 0"
            class="mt-12"
        >
            <h3 class="error--text">
                WARNING!
            </h3>
            <p class="error--text">
                You have duplicate data! Click on the X to delete the duplicates.
            </p>
            <ul class="mb-4">
                <li v-for="duplicate in thisPost.duplicates">
                    {{ duplicate.key }}

                    <v-btn
                        icon
                        text
                        class="error--text"
                        @click="deleteDuplicate(duplicate)"
                    >
                        <v-icon small>
                            close
                        </v-icon>
                    </v-btn>
                </li>
            </ul>
        </div>

        <v-dialog
            v-model="slugEdit"
            width="500"
        >
            <v-card>
                <v-toolbar
                    flat
                    dark
                    :color="brandColor"
                >
                    <v-toolbar-title style="text-transform:capitalize;">
                        Edit Slug
                    </v-toolbar-title>
                </v-toolbar>

                <v-col
                    cols="12"
                    class="pa-4 column"
                >
                    <v-form ref="newUser">
                        <v-text-field
                            v-model="slug"
                            label="Slug"
                            :color="brandColor"
                        ></v-text-field>

                        <div class="text-right">
                            <v-btn
                                text
                                class="mr-1"
                                @click="slugEdit = false"
                            >
                                Cancel
                            </v-btn>
                            <v-btn
                                class="white--text"
                                :color="brandColor"
                                @click="submitSlugEdit"
                            >
                                Save
                            </v-btn>
                        </div>
                    </v-form>
                </v-col>
            </v-card>
        </v-dialog>
    </v-col>
</template>
<script>
import { mapState, mapActions } from 'vuex';
import { Content as ContentHelpers } from '@musora/helper-functions';
import brandColors from '../../../api/mixins.js';
import Utils from '../../../api/utils';
import ContentStore from '../../../mixins/content-store';
import api from '../../../api/content';

export default {
    name: 'ContentInfo',
    mixins: [brandColors, ContentStore],
    props: {
        thisPost: {
            type: Object,
        },
    },
    data() {
        return {
            slugEdit: false,
            slug: this.thisPost.slug,
            parentContentType: null,
            parentId: null,
        };
    },
    computed: {
        ...mapState({
            state: state => state.content,
        }),

        postTitle() {
            return this.thisPost.type === 'instructor' ? this.thisPost.name.value : this.thisPost.title.value;
        },

        parsedContentType() {
            const type = ContentHelpers.topLevelContentTypes().filter(type => type.type === this.contentType);

            return type.length ? type[0].label : this.toCapitalCase(this.contentType.replace(/-/g, ' '));
        },

        previewUrl() {
            const musoraWebAppURL = document.getElementById('musoraWebAppURL').value;
            return `${musoraWebAppURL}/${this.state.brand}/content/${this.thisPost.id}`;
        },
    },
    mounted() {
        this.parentContentType = ContentHelpers.getParentContentType(this.thisPost.type);

        if (this.parentContentType) {
            api.getContentParent(this.thisPost.id, this.parentContentType)
                .then((response) => {
                    this.parentId = response.data.data[0].id;
                });
        }
    },
    methods: {
        toCapitalCase: string => Utils.toCapitalCase(string),

        getContentTypeIcon: type => ContentHelpers.getContentTypeIcon(type),

        openSlugEdit() {
            this.slugEdit = true;
        },

        submitSlugEdit() {
            this.$root.$emit('pageLoading');

            this.sendSetContentPropertyRequest('slug', this.slug, this.thisPost.id, this.isChild);
            this.slugEdit = false;
        },

        deleteDuplicate(duplicate) {
            if (duplicate.type === 'data') {
                this.setDatum({
                    datum_id: duplicate.id,
                    deleted: true,
                    child: this.isChild,
                })
                    .then(this.handleDuplicateDelete);
            } else {
                this.setField({
                    field_id: duplicate.id,
                    deleted: true,
                    child: this.isChild,
                })
                    .then(this.handleDuplicateDelete);
            }
        },

        async handleDuplicateDelete(response) {
            if (response) {
                const post = await api.getContentById(this.post_id);
                const currentPost = ContentHelpers.flattenContent([post])[0];

                if (this.isChild) {
                    this.getCurrentChildPost({ currentChildPost: currentPost });
                } else {
                    this.getCurrentPost({ currentPost });
                }

                this.$root.$emit('displayMessage', {
                    color: 'success',
                    text: 'Duplicate successfully deleted.',
                });
            } else {
                this.$root.$emit('displayMessage', {
                    color: 'error',
                    text: 'Something went wrong. Duplicate likely not deleted.',
                });
            }
        },
    },
};
</script>
