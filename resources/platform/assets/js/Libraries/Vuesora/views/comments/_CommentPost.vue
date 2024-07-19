<template>
    <div :id="domID" class="tw-flex tw-flex-row comment-post pv mb-1 dark:tw-text-white" :class="{ 'pinned': pinned }">
        <div class="tw-flex tw-flex-col avatar-column tw-max-w-[33px] sm:tw-max-w-[75px] tw-mr-[6px] sm:tw-mr-[15px]">
            <div v-if="hasPublicProfiles" class="user-avatar smaller" :class="[avatarClassObject, brand]">
                <a :href="profileRoute" target="_blank" class="tw-no-underline">
                    <!-- User Avatar -->
                    <img :src="comment.user['fields.profile_picture_image_url']" loading="lazy"
                        class="tw-rounded-full tw-transition-opacity tw-duration-500 tw-border-[1px] sm:tw-border-[3px]"
                        :class="comment.user.imageLoaded ? 'tw-opacity-1' : 'tw-opacity-0'"
                        @load="comment.user.imageLoaded = true">
                </a>
            </div>
            <img v-if="!hasPublicProfiles" :src="comment.user['fields.profile_picture_image_url']"
                class="tw-rounded-full">

            <p v-if="showUserExp"
                class="tw-hidden sm:tw-block tw-uppercase tw-text-center tw-mt-[10px] tw-font-bebas-neue tw-font-bold tw-text-[18px] tw-leading-none">
                {{ userExpRank }}
            </p>
            <p v-if="showUserExp"
                class="tw-hidden sm:tw-block tw-uppercase tw-text-center tw-mt-[5px] tw-font-bebas-neue tw-font-bold tw-text-[16px] dark:tw-text-[#9EC0DC] tw-leading-none">
                {{ userExpValue }} XP
            </p>
        </div>
        <div class="tw-flex tw-flex-col tw-flex-grow">
            <div class="tw-group/comment" v-on:mouseleave="showDropdown = false;">
                <div class="tw-flex tw-flex-row sm:tw-mb-1 comment-meta">
                    <div class="tw-flex tw-flex-col tw-flex-grow tw-mr-1">
                        <h2 class="tw-flex break-words tw-leading-0 tw-items-end">
                            <a v-if="hasPublicProfiles" :href="profileRoute" target="_blank"
                                class="tw-font-bold tw-text-[#00101D] tw-text-[13px] sm:tw-text-[18px] dark:tw-text-white tw-no-underline tw-leading-0 hover:tw-underline hover:tw-underline-offset-2">
                                {{ comment.user.display_name }}
                            </a>
                            <span v-else
                                class="tw-font-bold tw-text-[#00101D] tw-text-[13px] sm:tw-text-[18px] dark:tw-text-white tw-no-underline tw-leading-0">
                                {{ comment.user.display_name }}
                            </span>

                            <span
                                class="tw-font-normal tw-font-bebas-neue tw-uppercase dark:tw-text-white tw-text-[13px] sm:tw-text-[16px] tw-ml-[9px] tw-leading-0">
                                {{ dateString }}
                            </span>
                        </h2>
                    </div>

                    <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-grow-0">
                        <div class="tw-flex tw-flex-row">
                            <button v-if="(isUsersPost || isCurrentUserAdmin)"
                                class="tw-inline-flex tw-items-center tw-justify-center tw-text-sm no-decoration tw-cursor-pointer tw-mr-1 tw-rounded dark:hover:tw-bg-[#081825] tw-transition-colors hover:tw-bg-white tw-h-[19.5px] sm:tw-h-[24px] tw-w-[19.5px] sm:tw-w-[24px]"
                                @click="deleteComment">
                                <TrashIcon class="tw-w-[16px] tw-h-[16px] tw-text-[#00101D] dark:tw-text-[#9EC0DC]" />
                            </button>
                            <!--<span class="tiny no-decoration text-grey-3 pointer">-->
                            <!--<i class="fas fa-link"-->
                            <!--@click="getCommentLink"></i>-->
                            <!--<textarea class="comment-id-copy"-->
                            <!--contenteditable="true">{{ commentUrl }}</textarea>-->
                            <!--</span>-->
                        </div>
                    </div>
                </div>

                <div class="tw-flex tw-flex-row body sm:tw-mb-2">
                    <div class="tw-flex tw-flex-col post-body tw-flex-grow tw-forum-post tw-text-[13px] sm:tw-text-base" v-html="comment.comment">
                    </div>
                </div>

                <div class="tw-flex tw-flex-row tw-flex-wrap tw-mb-3">
                    <div class="tw-flex tw-flex-col tw-my-2 tw-w-full">
                        <div class="tw-flex tw-flex-row tw-items-center">
                            <button
                                class="tw-flex tw-items-center tw-justify-center tw-h-[32px] tw-min-w-[32px] tw-font-bold tw-uppercase tw-cursor-pointer nowrap noselect tw-rounded dark:hover:tw-bg-[#081825] tw-transition-colors hover:tw-bg-white tw-px-1"
                                :class="comment.is_liked ? themeTextClass : 'tw-text-[#00101D] dark:tw-text-white'"
                                dusk="like-button" @click="likeComment">
                                <musora-icon :icon-name="comment.is_liked ? 'thumb-like-filled' : 'thumb-like'"
                                    class="tw-w-6 tw-h-6" />
                                <span class="hide-xs-only tw-font-bebas-neue tw-text-[16px]">
                                    &nbsp;{{ comment.like_count }}
                                </span>
                            </button>

                            <button
                                class="tw-ml-[16px] tw-flex tw-justify-center tw-h-[32px] tw-min-w-[32px] tw-items-center tw-font-bold tw-uppercase tw-cursor-pointer nowrap noselect tw-rounded dark:hover:tw-bg-[#081825] tw-transition-colors hover:tw-bg-white tw-px-1"
                                :class="replying ? themeTextClass : 'tw-text-[#00101D] dark:tw-text-white'"
                                dusk="reply-button" @click="replyToComment">
                                <MusoraIcon icon-name="comment-outline" class="tw-inline tw-h-[22px] tw-w-[22px]"
                                    width="22" height="22" viewBox="0 0 22 22" />
                                <span class="hide-xs-only tw-font-bebas-neue tw-text-[16px]">
                                    <span v-if="comment.replies && comment.replies.length > 0">&nbsp;
                                        {{ comment.replies.length }}
                                    </span>&nbsp;
                                    {{ repliesToShow.length > 1 ? 'REPLIES' : 'REPLY' }}
                                </span>
                            </button>

                            <span class="tw-flex-grow"></span>

                            <!-- Dropdown -->
                            <div
                                class="lg:tw-hidden group-hover/comment:lg:tw-flex tw-flex tw-items-center tw-text-[#3F3F46] dark:tw-text-white tw-cursor-pointer tw-relative tw-h-[20px]">
                                <button @click="toggleDropdown">
                                    <svg class="tw-rotate-90" width="25" height="25" viewBox="0 0 25 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.5 5.20768L12.5 5.2181M12.5 12.4993L12.5 12.5098M12.5 19.791L12.5 19.8014M12.5 6.24935C11.9247 6.24935 11.4583 5.78298 11.4583 5.20768C11.4583 4.63239 11.9247 4.16602 12.5 4.16602C13.0753 4.16602 13.5417 4.63239 13.5417 5.20768C13.5417 5.78298 13.0753 6.24935 12.5 6.24935ZM12.5 13.541C11.9247 13.541 11.4583 13.0746 11.4583 12.4993C11.4583 11.9241 11.9247 11.4577 12.5 11.4577C13.0753 11.4577 13.5417 11.9241 13.5417 12.4993C13.5417 13.0746 13.0753 13.541 12.5 13.541ZM12.5 20.8327C11.9247 20.8327 11.4583 20.3663 11.4583 19.791C11.4583 19.2157 11.9247 18.7493 12.5 18.7493C13.0753 18.7493 13.5417 19.2157 13.5417 19.791C13.5417 20.3663 13.0753 20.8327 12.5 20.8327Z"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                                <ul v-if="showDropdown"
                                    class="tw-absolute tw-top-6 tw-right-0 tw-drop-shadow-lg tw-rounded tw-bg-white tw-text-black dark:tw-bg-[#081825] dark:tw-text-white tw-absolute tw-right-0 tw-z-50"
                                    v-click-outside="hideDropdown">
                                    <li>
                                        <button
                                            class="tw-flex tw-w-full tw-items-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-whitespace-nowrap tw-text-sm"
                                            :data-open-modal="openModalString" @click="openLikes">
                                            <musora-icon icon-name="thumb-like" class="tw-w-6 tw-h-6 tw-mr-1" /> See All
                                            Likes
                                        </button>
                                    </li>
                                    <li>
                                        <button
                                            class="tw-flex tw-w-full tw-items-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-whitespace-nowrap tw-text-sm"
                                            @click="reportComment">
                                            <FlagIcon class="tw-inline tw-w-6 tw-h-6 tw-mr-1"
                                            />
                                            {{ isReported ? 'Reported' : 'Report Comment' }}
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <transition name="slide-fade" enter-active-class="slide-fade-enter-active" leave-active-class="">
                <div v-if="replying" class="tw-flex tw-flex-row comment-post mv-2">
                    <div class="tw-flex-col avatar-column tw-mr-[15px] tw-hidden md:tw-flex">
                        <img :src="currentUser.avatar" class="rounded">
                    </div>
                    <div class="tw-flex tw-flex-col tw-w-full">
                        <div class="tw-flex tw-flex-row  tw-w-full">
                            <text-editor :fieldKey="domID + '-editor'" ref="textEditor" v-model="replyInterface"
                                :height="150" :is-student-comment="!currentUser.isAdmin"></text-editor>
                        </div>
                        <div class="tw-flex tw-flex-row tw-justify-end mv-1">
                            <a class="btn flat dark:tw-text-white tw-text-[#00101D] collapse-150 short tw-mr-1"
                                @click="cancelReply">
                                Cancel
                            </a>
                            <button class="btn collapse-150" :disabled="loading" dusk="submit-reply" @click="postReply">
                                <span class="tw-text-white short" :class="themeBgClass">
                                    Reply
                                </span>
                            </button>
                        </div>

                        <div :class="loading ? 'tw-flex' : 'tw-hidden'"
                            class="loading-reply tw-z-10 dark:tw-bg-[#000c17]/80 tw-flex-col tw-justify-center tw-items-center">
                            <i class="fas fa-spinner fa-spin tw-mb-2" :class="themeTextClass"></i>
                            <p class="tw-text-sm text-grey-3 dark:tw-text-white tw-font-bold">
                                loading...
                            </p>
                        </div>
                    </div>
                </div>
            </transition>

            <transition-group name="slide-fade" enter-active-class="slide-fade-enter-active" leave-active-class=""
                tag="div">
                <comment-reply v-for="replyComment in repliesToShow" :key="replyComment.id" :comment="replyComment"
                    :brand="brand" :parent-id="comment.id" :current-user="currentUser" :theme-color="themeColor"
                    :profile-base-route="profileBaseRoute" :has-public-profiles="hasPublicProfiles"
                    @likeReply="likeReply" @deleteReply="deleteReply" @openLikes="openLikes" @replyPosted="replyPosted"
                    :opened-comment-id="openedCommentId"
                    @replyOpened="(payload) => this.$emit('replyOpened', payload)"></comment-reply>
            </transition-group>

            <div v-if="comment.replies && comment.replies.length > 2"
                class="tw-flex tw-flex-row tw-items-center tw-justify-center tw-text-center">
                <a class="btn btn-tiny flat dark:tw-text-[#9EC0DC] tw-text-[18px] collapse-150"
                    @click="showAllReplies = !showAllReplies">
                    {{ showAllReplies ? 'Hide Replies' : 'Show All Replies' }}
                </a>
            </div>
        </div>
    </div>
</template>
<script>
import { DateTime } from 'luxon';
import CommentService from '../../assets/js/Services/comments';
import TextEditor from '../../Components/TextEditor/TextEditor.vue';
import CommentReply from './_CommentReply.vue';
import MusoraIcon from '../../../../Components/MusoraIcons/MusoraIcon.vue'
import Utils from '../../assets/js/classes/utils';
import ThemeClasses from '../../mixins/ThemeClasses';
import { TrashIcon, ThumbUpIcon } from "@heroicons/vue/solid";
import { FlagIcon } from "@heroicons/vue/outline";

export default {
    name: 'CommentPost',
    components: {
        'text-editor': TextEditor,
        'comment-reply': CommentReply,
        TrashIcon,
        ThumbUpIcon,
        MusoraIcon,
        FlagIcon,
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
            isReported: false,
            showDropdown: false,
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
                if (window.addeventatc) {
                    window.addeventatc.refresh();
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
                // console.log(val)
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
            return this.userExpValue != null;
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

                            window.shownotification({
                                icon: 'check',
                                text: 'Woohoo! Thanks for your reply!'
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

        reportComment() {
            if (!this.isReported) {
                this.isReported = true;
                CommentService.reportComment(this.comment.id).then(() => {
                    window.shownotification({
                        icon: 'report',
                        text: 'The comment was reported.'
                    });
                }).catch(() => {
                    this.isReported = false;
                    window.shownotification({
                        icon: 'error',
                        text: 'There was am error reporting this comment, please try again later.'
                    });
                });
            } else {
                window.shownotification({
                    icon: 'report',
                    text: 'You have already reported this comment.'
                });
            }

            this.hideDropdown()
        },

        deleteComment() {
            window.showconfirmationmodal({
                title: 'Are you sure you want to delete this comment?',
                subtitle: 'This cannot be undone.',
                callbacks: {
                    submit: () => {
                        this.$emit('deleteComment', {
                            id: this.comment.id,
                            pinned: this.pinned,
                        });
                    },
                    cancel: () => {
                        console.log('Delete comment cancelled');
                    }
                }
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

            this.hideDropdown()
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

        toggleDropdown() {
            this.showDropdown = !this.showDropdown;
        },

        hideDropdown() {
            this.showDropdown = false;
        },
    },
    beforeMount() {
        this.isReported = this.comment.is_reported_by_viewer;
    },
    watch: {
        openedCommentId: function (newVal, oldVal) { // watch it
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
