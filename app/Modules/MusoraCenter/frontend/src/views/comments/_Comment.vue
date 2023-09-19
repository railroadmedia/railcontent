<template>
    <v-card
        xs12
        class="pa-4 mb-4"
    >
        <!--<v-divider v-if="isReply"-->
        <!--class="mx-4 mv-0"-->
        <!--inset-->
        <!--vertical></v-divider>-->

        <!--<v-flex pr-4 style="flex:0 0 60px">-->
        <!--<v-avatar>-->
        <!--<img :src="userAvatar">-->
        <!--</v-avatar>-->
        <!--</v-flex>-->
        <v-col>
            <p class="subtitle-1">
                <strong>{{ userDisplayName }}</strong>

                <v-btn
                    flat
                    icon
                    color="green"
                    @click="editing = !editing"
                >
                    <v-icon>edit</v-icon>
                </v-btn>
                <v-btn
                    flat
                    icon
                    color="red"
                    @click="deleteComment"
                >
                    <v-icon>delete</v-icon>
                </v-btn>
            </p>
            <p
                v-if="!editing"
                v-html="comment || commentInterface"
            >
                {{ comment || commentInterface }}
            </p>

            <!--            <text-editor v-if="editing"-->
            <!--                         toolbar="bold italic underline | bullist numlist"-->
            <!--                         :initialValue="commentBody"-->
            <!--                         v-model="commentInterface"-->
            <!--                         :height="150"-->
            <!--                         ref="textEditor"></text-editor>-->

            <div
                v-if="editing"
                class="text-right mb-12"
            >
                <v-btn
                    flat
                    dark
                    @click="cancelEdit"
                >
                    Cancel
                </v-btn>
                <v-btn
                    dark
                    :color="brandColor"
                    :disabled="disableSave"
                    @click="saveEdit"
                >
                    Save
                </v-btn>
            </div>
        </v-col>
    </v-card>
</template>
<script>
import { mapState } from 'vuex';
import brandColors from '../../api/mixins.js';
// import TextEditor from 'vuesora/src/components/TextEditor.vue'
import api from '../../api/comments.js';

export default {
    name: 'MusoraComment',
    mixins: [brandColors],
    // components: {
    //     'text-editor': TextEditor
    // },
    props: {
        isReply: {
            type: Boolean,
            default: () => false,
        },
        userAvatar: {
            type: String,
            default: () => '',
        },
        userDisplayName: {
            type: String,
            default: () => '',
        },
        commentBody: {
            type: String,
            default: () => '',
        },
        commentId: {
            type: Number,
            default: () => 0,
        },
    },
    data() {
        return {
            comment: this.commentBody,
            editing: false,
        };
    },
    computed: {
        ...mapState({
            state: state => state.comments,
        }),

        disableSave() {
            if (!this.comment) {
                return true;
            }
                
            return this.commentBody === this.comment.replace(/<(?:.|\n)*?>/gm, '');
        },

        commentInterface: {
            cache: false,
            get() {
                return this.comment || this.commentBody;
            },
            set(val) {
                this.comment = val.currentValue;
            },
        },
    },
    methods: {
        cancelEdit() {
            this.editing = false;
            if (this.commentBody) {
                this.commentInterface = this.commentBody;
            }
        },

        deleteComment() {
            const confirmation = confirm('Are you sure you wish to delete this comment?');

            if (confirmation) {
                api.deleteComment(this.commentId)
                    .then((response) => {
                        console.log(response);

                        if (this.isReply) {
                            this.$emit('deleteReply', {
                                commentId: this.commentId,
                            });
                        } else {
                            this.$emit('deleteThread', {
                                commentId: this.commentId,
                            });
                        }

                        this.$root.$emit('displayMessage', {
                            text: `${this.isReply ? 'Comment' : 'Thread'} successfully deleted`,
                            color: 'success',
                        });
                    });
            }
        },

        saveEdit() {
            api.editComment({
                id: this.commentId,
                comment: this.comment,
            })
                .then((response) => {
                    this.comment = response.data.data[0].comment;
                    this.editing = false;

                    this.$root.$emit('displayMessage', {
                        text: 'Comment successfully edited',
                        color: 'success',
                    });
                });
        },
    },
};
</script>
