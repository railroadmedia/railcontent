<template>
    <div
        :id="domID"
        class="tw-flex tw-flex-row comment-post pv mb-1 dark:tw-text-white"
        :class="{'pinned': pinned}"
    >
        <div class="tw-flex tw-flex-col avatar-column tw-mr-[15px]">
            <div
                v-if="hasPublicProfiles"
                class="user-avatar smaller"
                :class="[avatarClassObject, brand]"
            >
                <a
                    :href="profileRoute"
                    target="_blank"
                    class="tw-no-underline"
                >
                    <img
                        src="https://dmmior4id2ysr.cloudfront.net/assets/images/image-loader.svg"
                        :data-ix-src="comment.user['fields.profile_picture_image_url']"
                        data-ix-fade
                        class="tw-rounded-full"
                    >
                </a>
            </div>
            <img
                v-if="!hasPublicProfiles"
                :src="comment.user['fields.profile_picture_image_url']"
                class="tw-rounded-full"
            >

            <p
                v-if="showUserExp"
                class="body dense tw-font-bold tw-uppercase tw-text-center tw-mt-1"
            >
                {{ userExpRank }}
            </p>
            <p
                v-if="showUserExp"
                class="tiny dense tw-text-[#9EC0DC] tw-text-center font-compressed"
            >
                {{ userExpValue }} XP
            </p>
        </div>
        <div class="tw-flex tw-flex-col tw-flex-grow">
            <div class="tw-flex tw-flex-row tw-mb-1 comment-meta">
                <div class="tw-flex tw-flex-col tw-flex-grow tw-mr-1">
                    <h2 class="break-words">
                        <a
                            v-if="hasPublicProfiles"
                            :href="profileRoute"
                            target="_blank"
                            class="tw-font-bold tw-text-black tw-text-[18px] dark:tw-text-white tw-no-underline"
                        >
                            {{ comment.user.display_name }}
                        </a>
                        <span
                            v-else
                            class="tw-font-bold tw-text-black tw-text-[18px] dark:tw-text-white tw-no-underline"
                        >
                            {{ comment.user.display_name }}
                        </span>

                        <span class="tw-font-bold tw-font-bebas-neue tw-uppercase dark:tw-text-white tw-text-[16px] tw-ml-[9px]">
                            {{ dateString }}
                        </span>
                    </h2>
                </div>

                <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-flex-auto">
                    <div class="tw-flex tw-flex-row">
                        <span
                            v-if="(isUsersPost || isCurrentUserAdmin)"
                            class="tiny no-decoration text-grey-3 tw-pointer tw-mr-1"
                        >
                            <i
                                class="fas fa-trash"
                                @click="deleteComment"
                            ></i>
                        </span>

                        <!--<span class="tiny no-decoration text-grey-3 pointer">-->
                        <!--<i class="fas fa-link"-->
                        <!--@click="getCommentLink"></i>-->
                        <!--<textarea class="comment-id-copy"-->
                        <!--contenteditable="true">{{ commentUrl }}</textarea>-->
                        <!--</span>-->
                    </div>
                </div>
            </div>

            <div class="tw-flex tw-flex-row body tw-mb-1">
                <div
                    class="tw-flex tw-flex-col post-body tw-flex-grow"
                    v-html="comment.comment"
                >
                </div>
            </div>

            <div class="tw-flex tw-flex-row tw-flex-wrap">
                <div class="tw-flex tw-flex-col tw-mb-1 tw-w-full">
                    <div class="tw-flex tw-flex-row tw-items-center">
                        <p
                            v-if="!isUsersPost"
                            class="tiny tw-mr-3 tw-font-bold tw-uppercase dense tw-pointer reply-like nowrap noselect"
                            :class="comment.is_liked ? themeTextClass : 'text-grey-3'"
                            dusk="like-button"
                            @click="likeComment"
                        >
                            <i class="fas fa-thumbs-up"></i>
                            <span class="hide-xs-only">
                                &nbsp;{{ comment.is_liked ? 'Liked' : 'Like' }}&nbsp;
                            </span>
                        </p>

                        <p
                            class="tiny tw-mr-3 tw-font-bold tw-uppercase dense tw-pointer reply-like nowrap noselect"
                            :class="replying ? themeTextClass : 'text-grey-3'"
                            dusk="reply-button"
                            @click="replyToComment"
                        >
                            <i class="fas fa-reply"></i>
                            <span class="hide-xs-only">
                                &nbsp;{{ replying ? 'Replying' : 'Reply' }}&nbsp;
                            </span>
                        </p>

                        <span class="tw-flex-grow"></span>

                        <p
                            class="x-tiny tw-font-bold text-grey-3 tw-uppercase nowrap tw-pointer noselect"
                            :data-open-modal="openModalString"
                            @click="openLikes"
                        >
                            <i
                                class="fas fa-thumbs-up tw-text-white likes-icon"
                                :class="comment.like_count > 0 ? themeBgClass : 'bg-grey-2'"
                            ></i> {{ comment.like_count }}
                        </p>
                    </div>
                </div>
            </div>

            <transition
                name="slide-fade"
                enter-active-class="slide-fade-enter-active"
                leave-active-class=""
            >
                <div
                    v-if="replying"
                    class="tw-flex tw-flex-row comment-post mv-2"
                >
                    <div class="tw-flex tw-flex-col avatar-column tw-mr-[15px] hide-xs-only">
                        <img
                            :src="currentUser.avatar"
                            class="rounded"
                        >
                    </div>
                    <div class="tw-flex tw-flex-col tw-w-full">
                        <div class="tw-flex tw-flex-row  tw-w-full">
                            <text-editor
                                :fieldKey="domID + '-editor'"
                                ref="textEditor"
                                v-model="replyInterface"
                                toolbar="bold italic underline | bullist numlist | link"
                                :height="150"
                                :isReplySection="true"
                            ></text-editor>
                        </div>
                        <div class="tw-flex tw-flex-row tw-justify-center mv-1">
                            <a
                                class="btn flat dark:tw-text-white tw-text-black collapse-150 short tw-mr-1"
                                @click="cancelReply"
                            >
                                Cancel
                            </a>
                            <button
                                class="btn collapse-150"
                                :disabled="loading"
                                dusk="submit-reply"
                                @click="postReply"
                            >
                                <span
                                    class="tw-text-white short"
                                    :class="themeBgClass"
                                >
                                    Reply
                                </span>
                            </button>
                        </div>

                        <div
                            v-show="loading"
                            class="loading-reply tw-flex-center"
                        >
                            <i
                                class="fas fa-spinner fa-spin"
                                :class="themeTextClass"
                            ></i>
                            <p class="x-tiny text-grey-3">
                                loading...
                            </p>
                        </div>
                    </div>
                </div>
            </transition>

            <transition-group
                name="slide-fade"
                enter-active-class="slide-fade-enter-active"
                leave-active-class=""
                tag="div"
            >
                <comment-reply
                    v-for="replyComment in repliesToShow"
                    :key="replyComment.id"
                    :comment="replyComment"
                    :brand="brand"
                    :parent-id="comment.id"
                    :current-user="currentUser"
                    :theme-color="themeColor"
                    :profile-base-route="profileBaseRoute"
                    :has-public-profiles="hasPublicProfiles"
                    @likeReply="likeReply"
                    @deleteReply="deleteReply"
                    @openLikes="openLikes"
                    @replyPosted="replyPosted"
                    :opened-comment-id="openedCommentId"
                    @replyOpened="(payload) => this.$emit('replyOpened', payload)"
                ></comment-reply>
            </transition-group>

            <div
                v-if="comment.replies && comment.replies.length > 2"
                class="tw-flex tw-flex-row align-center"
            >
                <a
                    class="btn btn-tiny flat text-grey-3 collapse-150"
                    @click="showAllReplies = !showAllReplies"
                >
                    {{ showAllReplies ? 'Hide Replies' : 'Show All Replies' }}
                </a>
            </div>
        </div>
    </div>
</template>
<script>
import { DateTime } from 'luxon';
import Toasts from '../../assets/js/classes/toasts';
import CommentService from '../../assets/js/services/comments';
import TextEditor from '../../components/TextEditor/TextEditor.vue';
import CommentReply from './_CommentReply.vue';
import Utils from '../../assets/js/classes/utils';
import ThemeClasses from '../../mixins/ThemeClasses';

export default {
    name: 'CommentPost',
    components: {
        'text-editor': TextEditor,
        'comment-reply': CommentReply,
    },
    mixins: [ThemeClasses],
    props: {
        brand: {
            type: String,
            default: () => '',
        },
        currentUser: {
            type: Object,
            default: () => ({
                display_name: '',
                id: 0,
                isAdmin: false,
                avatar: '',
            }),
        },
        profileBaseRoute: {
            type: String,
            default: '/laravel/public/members/profile/',
        },
        comment: {
            type: Object,
            default: () => ({
                user: {},
            }),
        },
        hasPublicProfiles: {
            type: Boolean,
            default: () => true,
        },
        pinned: {
            type: Boolean,
            default: () => false,
        },
        openedCommentId: {
            type: [String, Number],
        },
    },
    data() {
        return {
            replying: false,
            showAllReplies: false,
            reply: '',
            loading: false,
        };
    },
    computed: {
        avatarClassObject() {
            return {
                subscriber: ['coach', 'edge', 'lifetime', 'team', 'guitar', 'piano'].indexOf(this.comment.user.access_level) !== -1,
                coach: this.comment.user.access_level === 'coach',
                'house-coach': this.comment.user.access_level === 'house-coach',
                edge: this.comment.user.access_level === 'edge',
                pack: this.comment.user.access_level === 'pack',
                team: this.comment.user.access_level === 'team',
                guitar: this.comment.user.access_level === 'guitar',
                piano: this.comment.user.access_level === 'piano',
                lifetime: this.comment.user.access_level === 'lifetime',
            };
        },

        userExpValue() {
            if (this.brand === 'guitareo') {
                return null;
            }

            return Utils.parseXpValue(this.comment.user.xp);
        },

        userExpRank() {
            if (this.comment.user.access_level === 'coach') {
                return 'Coach';
            }

            if (this.comment.user.access_level === 'team') {
                return `${this.brand} Team`;
            }

            if (this.brand === 'pianote') {
                return this.comment.user.rank || 'Casual';
            }

            return 'Level ' + (this.comment.user.level_number || '0.0');
        },

        repliesToShow() {
            setTimeout(() => {
                // Sometimes vue caches the add event button.
                // If it doesn't we need to force a refresh, done with a timeout to
                // Prevent race conditions.
                if (window.addeventatc) {
                    window.addeventatc.refresh();
                }

                // Load the Imgix Service to load srcs and srcsets
                if (window.ImgixService) {
                    window.ImgixService.loadImageSources();
                }
            }, 300);

            if (this.showAllReplies || this.pinned) {
                this.showAllReplies = true;

                return this.comment.replies;
            }

            return this.comment.replies ? this.comment.replies.filter((reply, index) => index < 2) : [];
        },

        replyInterface: {
            get() {
                return this.reply;
            },
            set(val) {
                console.log(val)
                this.reply = val;
            },
        },

        domID() {
            if (this.pinned) {
                return `pinnedComment${this.comment.id}`;
            }

            return `comment${this.comment.id}`;
        },

        profileRoute() {
            return this.profileBaseRoute + this.comment.user_id;
        },

        isLiked() {
            return this.comment.is_liked;
        },

        commentUrl() {
            return `${window.location}?goToComment=${this.comment.id}`;
        },

        dateString() {
            return DateTime.fromSQL(this.comment.created_on, { zone: 'UTC' }).minus({ seconds: 1 }).toRelative();
        },

        isUsersPost() {
            return String(this.currentUser.id) === String(this.comment.user_id);
        },

        isCurrentUserAdmin() {
            return this.currentUser.isAdmin === true;
        },

        openModalString() {
            return this.comment.like_count > 0 ? 'likeUsersModal' : '';
        },

        showUserExp() {
            return this.userExpValue != null && this.comment.user.access_level !== 'team';
        },
    },
    methods: {
        replyToComment() {
            this.replying = !this.replying;
            this.$emit('replyOpened', {
                id: this.comment.id,
            });
        },

        postReply() {
            console.log(this.reply)
            if (this.reply) {
                this.loading = true;

                CommentService.postReply({
                    parent_id: this.comment.id,
                    comment: this.reply.currentValue,
                })
                    .then((resolved) => {
                        if (resolved) {
                            const thisComment = resolved.results || resolved.data[0];

                            this.replyInterface = '';
                            this.replying = false;
                            this.$refs.textEditor.currentValue = '';
                            Toasts.push({
                                icon: 'happy',
                                title: 'Woohoo!',
                                themeColor: this.themeColor,
                                message: 'Thanks for your reply!',
                            });

                            this.replyPosted({ data: thisComment });
                        }

                        this.loading = false;
                    });
            }
        },

        replyPosted(payload) {
            if (this.comment.replies) {
                this.comment.replies.splice(this.comment.replies.length, 0, payload.data);
            }

            this.showAllReplies = true;
        },

        cancelReply() {
            this.replying = false;
            this.reply = '';
        },

        likeComment() {
            this.$emit('likeComment', {
                id: this.comment.id,
                isLiked: this.comment.is_liked,
                pinned: this.pinned,
            });
        },

        deleteComment() {
            Toasts.confirm({
                title: 'Are you sure you want to delete this comment?',
                submitButton: {
                    text: '<span class="bg-error text-white">Delete</span>',
                    callback: () => {
                        this.$emit('deleteComment', {
                            id: this.comment.id,
                            pinned: this.pinned,
                        });
                    },
                },
                cancelButton: {
                    text: '<span class="bg-grey-3 inverted text-grey-3">Cancel</span>',
                },
            });
        },

        likeReply(payload) {
            this.$emit('likeReply', {
                parent_id: this.comment.id,
                id: payload.id,
                isLiked: payload.isLiked,
                isPinned: this.pinned,
            });
        },

        deleteReply(payload) {
            this.$emit('deleteReply', {
                parent_id: this.comment.id,
                id: payload.id,
            });
        },

        openLikes(payload) {
            const hasLikesOrIsBeingBussedFromRoot = this.comment.like_count > 0 || payload.busToRoot;

            if (hasLikesOrIsBeingBussedFromRoot) {
                this.$emit('openLikes', {
                    id: payload.busToRoot ? payload.id : this.comment.id,
                    totalLikeUsers: payload.busToRoot ? payload.totalLikeUsers : this.comment.like_count,
                });
            }
        },

        getCommentLink(event) {
            const { parentElement } = event.target;
            const commentId = parentElement.querySelector('.comment-id-copy');

            commentId.focus();
            commentId.select();

            document.execCommand('copy');

            setTimeout(() => {
                commentId.blur();
            }, 50);
        },
    },
    watch: { 
      	openedCommentId: function(newVal, oldVal) { // watch it
          if (newVal !== oldVal && this.openedCommentId !== this.comment.id) {
            this.replying = false;
          }
        }
    }
};
</script>

<style>
.text-editor-container {
    width: 100%;
}
</style>