<template>
    <v-card class="pa-4">
        <v-toolbar
            dark
            :color="brandColor"
        >
            <v-toolbar-title>Edit Comment: {{ editingThread.id }}</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn
                    class="white--text"
                    flat
                    icon
                    @click.native="closeThread"
                >
                    <v-icon>close</v-icon>
                </v-btn>
            </v-toolbar-items>
        </v-toolbar>

        <div style="max-width:960px;margin:0 auto;">
            <v-card
                column
                xs12
                class="my-4 pa-4"
            >
                <p class="subtitle-1">
                    Lesson: <strong>{{ $_lesson_title }}</strong>
                </p>
                <p class="subtitle-1">
                    Original Commenter: <strong>{{ editingThread.display_name }}</strong>
                </p>
                <p class="subtitle-1">
                    Commented On: <strong>{{ editingThread.created_on }}</strong>
                </p>
                <p
                    v-if="lastReply"
                    class="subtitle-1 mb-4"
                >
                    Last Reply On: <strong>{{ lastReply.created_on }}</strong>
                </p>
                <v-btn
                    block
                    :color="brandColor"
                    target="_blank"
                    :href="'/content-redirect/' + editingThread.content_id + '?goToComment=' + editingThread.id"
                    class="ma-0 white--text"
                >
                    Go To Lesson
                    <v-icon
                        right
                        dark
                    >
                        open_in_new
                    </v-icon>
                </v-btn>
            </v-card>

            <musora-comment
                :user-display-name="editingThread.display_name"
                :comment-body="editingThread.comment"
                :comment-id="editingThread.id"
            ></musora-comment>

            <v-row
                class="pl-12"
                column
            >
                <musora-comment
                    v-for="(reply, i) in replies"
                    v-if="replies.length > 0"
                    :key="'reply-' + i"
                    :is-reply="true"
                    :user-display-name="reply.display_name"
                    :comment-id="reply.id"
                    :comment-body="reply.comment"
                    @deleteReply="handleReplyDelete"
                ></musora-comment>
            </v-row>
            <v-row column>
                <p class="subtitle-1 mt-12">
                    <strong>Reply to this Thread:</strong>
                </p>
                <!--                <text-editor toolbar="bold italic underline | bullist numlist"-->
                <!--                             v-model="commentInterface"-->
                <!--                             :height="150"-->
                <!--                             ref="textEditor"></text-editor>-->

                <div class="text-right mb-12">
                    <!--<v-btn flat dark @click.stop="commentInterface = ''">Cancel</v-btn>-->
                    <v-btn
                        class="white--text"
                        :color="brandColor"
                        :disabled="comment.currentValue.length === 0"
                        @click="submitReply"
                    >
                        Reply
                    </v-btn>
                </div>

                <!--<v-btn color="red" dark>Close this Thread</v-btn>-->
                <!--<v-btn color="green">Reopen this Thread</v-btn>-->
            </v-row>
        </div>
    </v-card>
</template>
<script>
import { mapState } from 'vuex';
import brandColors from '../../api/mixins.js';
import api from '../../api/comments.js';
import Comment from './_Comment.vue';
// import TextEditor from 'vuesora/src/components/TextEditor.vue'

export default {
    name: 'CommentDialog',
    components: {
        'musora-comment': Comment,
        // 'text-editor': TextEditor
    },
    mixins: [brandColors],
    props: {
        editingThread: {
            type: Object,
            default: () => null,
        },
        threadLesson: {
            default: () => null,
        },
    },
    data() {
        return {
            thisLesson: null,
            comment: {
                currentValue: '',
            },
        };
    },
    computed: {
        ...mapState({
            state: state => state.comments,
            auth: state => state.auth,
        }),

        replies() {
            return this.editingThread.replies;
        },

        lastReply() {
            if (this.replies.length) {
                return this.replies[this.replies.length - 1];
            }

            return null;
        },

        $_lesson_title() {
            if (this.threadLesson.fields.length) {
                return this.threadLesson.fields.filter(field => field.key === 'title')[0].value;
            }
        },

        commentInterface: {
            get() {
                return this.comment.currentValue;
            },
            set(val) {
                this.comment = val;
            },
        },
    },
    methods: {

        closeThread() {
            this.comment.currentValue = '';
            this.$emit('closeThread');
        },

        submitReply() {
            api.replyToComment({
                user_id: this.auth.currentUser.id,
                thread_id: this.editingThread.id,
                content_id: this.editingThread.content_id,
                comment: this.commentInterface,
                brand: this.state.brand,
            })
                .then((response) => {
                    if (response === 'no_permission') {
                        this.$root.$emit('displayMessage', {
                            text: 'Sorry, you dont have permission to comment here.',
                            color: 'error',
                        });
                    } else if (response) {
                        this.$root.$emit('displayMessage', {
                            text: 'Reply successfully posted',
                            color: 'success',
                        });

                        this.replies.push(response.data.data[0]);
                    } else {
                        this.$root.$emit('displayMessage', {
                            text: 'Oops, something went wrong. Reply not posted.',
                            color: 'error',
                        });
                    }
                });
        },

        handleReplyDelete(payload) {
            this.editingThread.replies = this.editingThread.replies.filter(reply => reply.id !== payload.commentId);

            this.$emit('resetComments', {
                closeDialog: false,
            });
        },
    },
};
</script>
