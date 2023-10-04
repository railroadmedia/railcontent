<template>
    <v-card class="edit-form mb-12">
        <v-toolbar
            flat
            dark
            :color="brandColor"
        >
            <v-toolbar-title>Assignments</v-toolbar-title>
            <v-spacer class="hidden-xs-only"></v-spacer>

            <v-tooltip left>
                <template v-slot:activator="{ on }">
                    <v-btn
                        slot="activator"
                        icon
                        text
                        class="mx-0"
                        v-on="on"
                        @click="newDialog = true"
                    >
                        <v-icon>add</v-icon>
                    </v-btn>
                </template>

                <span>Create New Assignment</span>
            </v-tooltip>
        </v-toolbar>

        <v-col
            class="column"
            cols="12"
        >
            <assignments-table
                :post-id="postId"
                :parent-id="post_id"
                :items="childPosts"
                @openChildEditForm="openChildEditForm"
                @childEdited="childEdited"
                @childDeleted="childEdited"
            ></assignments-table>
        </v-col>

        <v-dialog
            v-model="newDialog"
            max-width="500px"
        >
            <create-content-form
                content-type="assignment"
                :parent-id="post_id"
                :is-child="true"
                :available-content-types="$_availableContentTypes"
                @closeDialog="closeDialog"
                @childAdded="childAdded"
            ></create-content-form>
        </v-dialog>
    </v-card>
</template>
<script>
import { mapState, mapActions } from 'vuex';
import { Content as ContentHelpers } from '@musora/helper-functions';
import brandColors from '../../../api/mixins.js';
import AssignmentsTable from '../_AssignmentsTable';
import ContentStore from '../../../mixins/content-store';
import CreateContent from './_CreateContent';
import api from '../../../api/content';

export default {
    name: 'ContentAssignments',
    components: {
        'assignments-table': AssignmentsTable,
        'create-content-form': CreateContent,
    },
    mixins: [brandColors, ContentStore],
    props: {
        thisPost: {
            type: Object,
        },
    },
    data() {
        return {
            childPosts: [],
            newDialog: false,
        };
    },
    computed: {
        ...mapState({
            state: state => state.content,
        }),

        postId() {
            return this.thisPost.id;
        },


        $_availableContentTypes() {
            return [{
                type: 'assignment',
                label: 'Assignment',
                icon: 'icon-metronome',
            }];
        },
    },
    mounted() {
        this.getChildren();
    },
    methods: {
        closeDialog() {
            this.newDialog = false;
        },

        childAdded() {
            this.closeDialog();
            this.getChildren();
        },

        childEdited() {
            this.getChildren();
        },

        getChildren() {
            api.getContentChildren(this.postId)
                .then((response) => {
                    this.childPosts = ContentHelpers.flattenContent(response.data.data);
                });
        },
    },
};
</script>
