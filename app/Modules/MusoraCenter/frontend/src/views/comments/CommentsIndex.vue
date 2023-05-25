<template>
    <v-container>
        <v-row
            
            align="center"
        >
            <v-breadcrumbs divider="/">
                <v-breadcrumbs-item
                    :to="{ name: 'home' }"
                    :active-class="brandTextColor"
                >
                    Home
                </v-breadcrumbs-item>

                <v-breadcrumbs-item disabled>
                    Comments
                </v-breadcrumbs-item>
            </v-breadcrumbs>

            <v-col
                class="column"
                cols="12"
            >
                <v-toolbar
                    flat
                    dark
                    :color="brandColor"
                >
                    <v-toolbar-title class="mr-4">
                        Comments
                    </v-toolbar-title>
                    <v-spacer class="hidden-xs-only"></v-spacer>
                </v-toolbar>
                <v-data-table
                    :headers="headers"
                    :items="state.comments"
                    hide-default-footer
                    class="elevation-1"
                >
                    <template
                        slot="items"
                        slot-scope="props"
                    >
                        <tr
                            style="cursor:pointer;"
                            @click="openThread(props.item.id, props.item.content_id)"
                        >
                            <!--<td>-->
                            <!--<v-tooltip top>-->
                            <!--<v-icon slot="activator"-->
                            <!--color="green">comment</v-icon>-->
                            <!--<span>Open</span>-->
                            <!--</v-tooltip>-->
                            <!--</td>-->
                            <!--<td>-->
                            <!--<v-avatar size="36px">-->
                            <!--<img :src="props.item.user['fields.profile_picture_image_url']">-->
                            <!--</v-avatar>-->
                            <!--</td>-->
                            <td>{{ getLatestReply(props.item).display_name }}</td>
                            <td style="overflow:hidden;">
                                <span class="truncate-2">
                                    {{ getLatestReply(props.item).comment.replace(/<(?:.|\n)*?>/gm, '') }}
                                </span>
                            </td>
                            <td class="text-center">
                                {{ props.item.replies.length }}
                            </td>
                            <td>{{ moment(getLatestReply(props.item).created_on).format('MM/DD/YYYY') }}</td>
                        </tr>
                    </template>
                </v-data-table>

                <div class="text-center">
                    <v-pagination
                        v-model="page"
                        :length="state.totalPages"
                        :color="brandColor"
                    ></v-pagination>
                </div>
            </v-col>

            <v-dialog
                v-model="editDialog"
                fullscreen
                hide-overlay
                transition="dialog-bottom-transition"
            >
                <comment-dialog
                    :editing-thread="editingThread"
                    :thread-lesson="threadLesson"
                    @closeThread="closeThread"
                    @resetComments="resetComments"
                ></comment-dialog>
            </v-dialog>
        </v-row>
    </v-container>
</template>
<script>
import { mapActions, mapState } from 'vuex';
import brandColors from '../../api/mixins.js';
import CommentDialog from './CommentDialog.vue';
import api from '../../api/comments';

const defaultThread = {
    id: 0,
    replies: [],
    display_name: '',
    comment: '',
};

const defaultThreadLesson = {
    id: 0,
    fields: [],
};

export default {
    components: {
        'comment-dialog': CommentDialog,
    },
    mixins: [brandColors],
    data() {
        return {
            editDialog: false,
            headers: [
                // {
                //     text: 'Status',
                //     align: 'center',
                //     sortable: false,
                //     value: 'status',
                //     width: 60
                // },
                // {
                //     text: 'Avatar',
                //     align: 'center',
                //     sortable: false,
                //     value: 'profile_picture_image_url',
                //     width: 60
                // },
                {
                    text: 'Name',
                    align: 'left',
                    sortable: false,
                    value: 'id',
                    width: 100,
                },
                {
                    text: 'Comment',
                    align: 'left',
                    sortable: false,
                    value: 'name',
                },
                {
                    text: 'Replies',
                    align: 'center',
                    sortable: false,
                    value: 'replies',
                    width: 100,
                },
                {
                    text: 'Date',
                    align: 'left',
                    sortable: false,
                    value: 'created_at',
                    width: 150,
                },
            ],
            currentPage: 1,
            editingThread: JSON.parse(JSON.stringify(defaultThread)),
            threadLesson: JSON.parse(JSON.stringify(defaultThreadLesson)),
        };
    },
    computed: {
        ...mapState({
            state: state => state.comments,
        }),
        page: {
            get() {
                return this.currentPage;
            },
            set(val) {
                this.currentPage = val;

                this.getComments({
                    brand: this.state.brand,
                    page: this.currentPage,
                });
            },
        },
    },
    methods: {
        ...mapActions('comments', [
            'getComments',
            'getBrand',
        ]),

        getLatestReply(thread) {
            if (thread.replies.length > 0) {
                return thread.replies[thread.replies.length - 1];
            }

            return thread;
        },

        findCommentById(threadId) {
            return this.editingThread = this.state.comments.filter(comment => comment.id === threadId)[0];
        },

        openThread(threadId, contentId) {
            this.editingThread = JSON.parse(JSON.stringify(this.findCommentById(threadId)));
            api.getLessonByIds(contentId)
                .then((response) => {
                    this.threadLesson = response.data.data[0];
                });

            this.editDialog = true;
        },

        closeThread() {
            this.editDialog = false;
            this.threadLesson = JSON.parse(JSON.stringify(defaultThreadLesson));
            this.editingThread = JSON.parse(JSON.stringify(defaultThread));
        },

        resetComments(payload) {
            this.getComments({
                brand: this.state.brand,
                page: this.currentPage,
            });

            if (payload.closeDialog) {
                this.closeThread();
            }
        },
    },
    mounted() {
        this.getBrand({
            router: this.$route,
        });
        this.getComments({
            brand: this.state.brand,
        });
    },
};
</script>
