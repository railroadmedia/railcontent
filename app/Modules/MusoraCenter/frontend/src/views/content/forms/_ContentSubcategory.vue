<template>
    <v-card class="edit-form mb-12">
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>{{ subcategoryByBrand }} Type</v-toolbar-title>
            <v-spacer class="hidden-xs-only"></v-spacer>
        </v-toolbar>

        <v-col
            cols="12"
            class="pa-4 column"
        >
            <v-form ref="editForm">
                <v-autocomplete
                    v-model="selectedContentType"
                    label="Type"
                    :color="brandColor"
                    :items="subcategoryTypesByBrand"
                    required
                >
                </v-autocomplete>

                <div
                    v-if="selectedContentType !== contentType"
                    class="text-right"
                >
                    <v-btn
                        flat
                        @click="selectedContentType = contentType"
                    >
                        Cancel
                    </v-btn>

                    <v-btn
                        :color="brandColor"
                        class="white--text"
                        @click="submitTypeChange"
                    >
                        Save
                    </v-btn>
                </div>
            </v-form>
        </v-col>
    </v-card>
</template>
<script>
import { mapState, mapActions } from 'vuex';
import { Content as ContentHelpers } from '@musora/helper-functions';
import api from '../../../api/content';
import brandColors from '../../../api/mixins.js';
import ContentStore from '../../../mixins/content-store';

export default {
    name: 'ContentSubcategory',
    mixins: [brandColors, ContentStore],
    data() {
        return {
            selectedContentType: this.contentType,
        };
    },
    computed: {
        ...mapState({
            state: state => state.content,
        }),

        subcategoryByBrand() {
            return {
                pianote: 'Student Focus',
                drumeo: 'Show',
            }[this.state.brand];
        },

        subcategoryTypesByBrand() {
            return {
                pianote: ContentHelpers.studentFocus(),
                drumeo: ContentHelpers.shows(),
            }[this.state.brand];
        },
    },
    methods: {
        ...mapActions('content', [
            'getCurrentPost',
        ]),

        submitTypeChange() {
            this.$root.$emit('pageLoading');

            api.setContentProperty({
                content_id: this.thisPost.id,
                type: this.selectedContentType,
            })
                .then((response) => {
                    const post = ContentHelpers.flattenContent(response.data.data)[0];
                    let message;
                    this.$root.$emit('pageLoaded');

                    if (response) {
                        message = 'Content subcategory succesfully set!';
                        this.$router.push({
                            name: 'content.edit',
                            params: {
                                brand: this.state.brand,
                                type: this.selectedContentType,
                                id: this.thisPost.id,
                            },
                        });

                        this.getCurrentPost({
                            currentPost: post,
                        });
                    } else {
                        message = 'Oops, something went wrong. Content subcategory likely not set.';
                        this.selectedContentType = this.contentType;
                    }

                    this.$root.$emit('displayMessage', {
                        color: response ? 'success' : 'error',
                        text: message,
                    });

                    this.$nextTick(() => {
                        this.$forceUpdate();
                    });
                });
        },
    },
};
</script>
