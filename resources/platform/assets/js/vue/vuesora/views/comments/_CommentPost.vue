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
                class="tw-uppercase tw-text-center tw-mt-[10px] tw-font-bebas-neue tw-font-bold tw-text-[18px] tw-leading-none"
            >
                {{ userExpRank }}
            </p>
            <p
                v-if="showUserExp"
                class="tw-uppercase tw-text-center tw-mt-[5px] tw-font-bebas-neue tw-font-bold tw-text-[16px] dark:tw-text-[#9EC0DC] tw-leading-none"
            >
                {{ userExpValue }} XP
            </p>
        </div>
        <div class="tw-flex tw-flex-col tw-flex-grow">
            <div class="tw-flex tw-flex-row tw-mb-1 comment-meta">
                <div class="tw-flex tw-flex-col tw-flex-grow tw-mr-1">
                    <h2 class="tw-flex break-words tw-leading-0 tw-items-end">
                        <a
                            v-if="hasPublicProfiles"
                            :href="profileRoute"
                            target="_blank"
                            class="tw-font-bold tw-text-[#00101D] tw-text-[18px] dark:tw-text-white tw-no-underline tw-leading-0"
                        >
                            {{ comment.user.display_name }}
                        </a>
                        <span
                            v-else
                            class="tw-font-bold tw-text-[#00101D] tw-text-[18px] dark:tw-text-white tw-no-underline tw-leading-0"
                        >
                            {{ comment.user.display_name }}
                        </span>

                        <span class="tw-font-normal tw-font-bebas-neue tw-uppercase dark:tw-text-white tw-text-[16px] tw-ml-[9px] tw-leading-0">
                            {{ dateString }}
                        </span>
                    </h2>
                </div>

                <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-grow-0">
                    <div class="tw-flex tw-flex-row">
                        <span
                            v-if="(isUsersPost || isCurrentUserAdmin)"
                            class="no-decoration tw-cursor-pointer tw-mr-1"
                            @click="deleteComment"
                        >
                            <TrashIcon class="tw-w-[16px] tw-h-[16px] tw-text-[#00101D] dark:tw-text-[#9EC0DC]" />
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
                <div class="tw-flex tw-flex-col tw-my-2 tw-w-full">
                    <div class="tw-flex tw-flex-row tw-items-center">
                        <p
                            class="tw-flex tw-items-center tw-font-bold tw-uppercase tw-cursor-pointer nowrap noselect"
                            :class="comment.is_liked ? themeTextClass : 'tw-text-[#00101D] dark:tw-text-white'"
                            dusk="like-button"
                            @click="likeComment"
                        >
                            <ThumbUpIconOutline class="tw-h-[22px] tw-w-[22px]" />
                            <span class="hide-xs-only tw-font-bebas-neue tw-text-[16px]">
                                &nbsp;{{ comment.like_count }}
                            </span>
                        </p>

                        <p
                            class="tw-ml-[16px] tw-flex tw-items-center tw-font-bold tw-uppercase tw-cursor-pointer nowrap noselect"
                            :class="replying ? themeTextClass : 'tw-text-[#00101D] dark:tw-text-white'"
                            dusk="reply-button"
                            @click="replyToComment"
                        >
                            <MusoraIcon icon-name="comment-outline" class="tw-inline tw-h-[22px] tw-w-[22px]" width="22" height="22" viewBox="0 0 22 22"/>
                            <span class="hide-xs-only tw-font-bebas-neue tw-text-[16px]">
                                <span v-if="comment.replies && comment.replies.length > 0">&nbsp;{{ comment.replies.length }}</span>&nbsp;{{ repliesToShow.length > 1 ? 'REPLIES' : 'REPLY' }}&nbsp;
                            </span>
                        </p>

                        <span class="tw-flex-grow"></span>

                        <p
                            class="dark:tw-text-white tw-text-[#00101D] tw-cursor-pointer tw-flex tw-items-center"
                            :data-open-modal="openModalString"
                            @click="openLikes"
                        >
                            <ThumbUpIcon
                                class="tw-inline tw-mr-[5px] dark:tw-text-white tw-text-[#00101D] tw-border-black dark:tw-border-white tw-border-2 tw-rounded-full tw-bg-transparent tw-p-[3px] tw-w-[22px] tw-h-[22px]"
                                :class="comment.like_count > 0 ? themeBgClass : 'bg-grey-2'"
                            />&nbsp;{{ comment.like_count }}
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
                    <div class="tw-flex-col avatar-column tw-mr-[15px] tw-hidden md:tw-flex">
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
                                @input="handleInput"
                                :height="150"
                            ></text-editor>
                        </div>
                        <div class="tw-flex tw-flex-row tw-justify-end mv-1">
                            <a
                                class="btn flat dark:tw-text-white tw-text-[#00101D] collapse-150 short tw-mr-1"
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
                class="tw-flex tw-flex-row tw-items-center tw-justify-center tw-text-center"
            >
                <a
                    class="btn btn-tiny flat dark:tw-text-[#9EC0DC] tw-text-[18px] collapse-150"
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
import MusoraIcon from '../../../components/MusoraIcons/MusoraIcon.vue'
import Utils from '../../assets/js/classes/utils';
import ThemeClasses from '../../mixins/ThemeClasses';
import { TrashIcon, ThumbUpIcon } from "@heroicons/vue/solid";
import { ThumbUpIcon as ThumbUpIconOutline } from "@heroicons/vue/outline";

export default {
    name: 'CommentPost',
    components: {
        'text-editor': TextEditor,
        'comment-reply': CommentReply,
        TrashIcon,
        ThumbUpIcon,
        ThumbUpIconOutline,
        MusoraIcon,
    },
    mixins: [ThemeClasses],
    props: {
        brand: {
            type: String,
            default: () => 'drumeo',
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

        profileBaseRoute() {
            return '/' + this.brand + '/profile/'
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
            return this.profileBaseRoute + this.comment.user_id + '/dashboard';
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
        handleInput(payload) {
            this.reply = payload.currentValue;
        },
        replyToComment() {
            this.replying = !this.replying;
            this.$emit('replyOpened', {
                id: this.comment.id,
            });
        },

        postReply() {
            if (this.reply) {
                this.loading = true;

                CommentService.postReply({
                    parent_id: this.comment.id,
                    comment: this.reply,
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