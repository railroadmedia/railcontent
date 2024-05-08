<template>
    <div class="tw-flex tw-flex-row comment-post pv mv-1 dark:tw-text-white tw-ml-[-70px] sm:tw-ml-[-60] md:tw-ml-0 tw-group/reply" v-on:mouseleave="showDropdown = false;">
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
                    <!-- User Avatar -->
                    <img :src="comment.user['fields.profile_picture_image_url']"
                         loading="lazy"
                         class="tw-rounded-full tw-transition-opacity tw-duration-500"
                         :class="comment.user.imageLoaded ? 'tw-opacity-1' : 'tw-opacity-0'"
                         @load="comment.user.imageLoaded = true"
                    >
                </a>
            </div>

            <!-- User Avatar -->
            <img v-if="!hasPublicProfiles"
                 :src="comment.user['fields.profile_picture_image_url']"
                 loading="lazy"
                 class="tw-rounded-full tw-transition-opacity tw-duration-500"
                 :class="comment.user.imageLoaded ? 'tw-opacity-1' : 'tw-opacity-0'"
                 @load="comment.user.imageLoaded = true"
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
            <div class="tw-flex tw-flex-row tw-items-center tw-mb-1 comment-meta">
                <div class="tw-flex tw-flex-col tw-flex-grow tw-mr-1">
                    <h2 class="tw-flex break-words tw-leading-0 tw-items-end">
                        <a
                            v-if="hasPublicProfiles"
                            :href="profileRoute"
                            target="_blank"
                            class="tw-font-bold tw-text-[#00101D] tw-text-[18px] dark:tw-text-white tw-no-underline tw-leading-0 hover:tw-underline hover:tw-underline-offset-2"
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

                <div class="tw-flex tw-flex-col align-h-right tw-justify-center tw-grow-0">
                    <div class="tw-flex tw-flex-row">
                        <button
                            v-if="(isUsersPost || isCurrentUserAdmin)"
                            class="tw-inline-flex tw-items-center tw-justify-center tw-text-sm no-decoration tw-cursor-pointer tw-mr-1 tw-rounded dark:hover:tw-bg-[#081825] tw-transition-colors hover:tw-bg-white tw-h-[32px] tw-w-[32px]"
                            @click="deleteComment"
                        >
                            <TrashIcon class="tw-w-[16px] tw-h-[16px] tw-text-[#00101D] dark:tw-text-[#9EC0DC]" />
                        </button>
                    </div>
                </div>
            </div>

            <div class="tw-flex tw-flex-row body tw-mb-2">
                <div
                    class="tw-flex tw-flex-col post-body tw-flex-grow tw-forum-post"
                    v-html="comment.comment"
                >
                </div>
            </div>


            <div class="tw-flex tw-flex-row tw-flex-wrap">
                <div class="tw-flex tw-flex-col tw-mb-1 tw-w-full">
                    <div class="tw-flex tw-flex-row tw-items-center">
                        <button
                            v-if="!isUsersPost"
                            class="tw-flex tw-items-center tw-justify-center tw-h-[32px] tw-min-w-[32px] tw-font-bold tw-uppercase tw-cursor-pointer nowrap noselect tw-rounded dark:hover:tw-bg-[#081825] tw-transition-colors hover:tw-bg-white tw-px-1"
                            :class="comment.is_liked ? themeTextClass : 'dark:tw-text-white tw-text-[#00101D]'"
                            dusk="like-button"
                            @click="likeComment"
                        >
                            <musora-icon :icon-name="comment.is_liked  ? 'thumb-like-filled' : 'thumb-like'"  class="tw-w-6 tw-h-6" />
                            <span class="hide-xs-only tw-font-bebas-neue tw-text-[16px]">
                                &nbsp;{{ comment.like_count }}
                            </span>
                        </button>

                        <button
                            class="tw-ml-[16px] tw-flex tw-items-center tw-justify-center tw-h-[32px] tw-min-w-[32px] tw-font-bold tw-uppercase tw-cursor-pointer nowrap noselect tw-rounded dark:hover:tw-bg-[#081825] tw-transition-colors hover:tw-bg-white tw-px-1"
                            :class="replying ? themeTextClass : 'dark:tw-text-white tw-text-[#00101D]'"
                            dusk="reply-button"
                            @click="openReply"
                        >
                            <MusoraIcon icon-name="comment-outline" class="tw-inline tw-h-[22px] tw-w-[22px]" width="22" height="22" viewBox="0 0 22 22"/>
                            <span class="hide-xs-only tw-font-bebas-neue tw-text-[16px]">
                                &nbsp;REPLY&nbsp;
                            </span>
                        </button>

                        <span class="tw-flex-grow"></span>

                        <!-- Dropdown -->
                        <div class="lg:tw-hidden group-hover/reply:lg:tw-flex tw-flex tw-items-center tw-text-[#3F3F46] dark:tw-text-white tw-cursor-pointer tw-relative tw-h-[20px]">
                            <button @click="toggleDropdown">
                                <svg class="tw-rotate-90" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.5 5.20768L12.5 5.2181M12.5 12.4993L12.5 12.5098M12.5 19.791L12.5 19.8014M12.5 6.24935C11.9247 6.24935 11.4583 5.78298 11.4583 5.20768C11.4583 4.63239 11.9247 4.16602 12.5 4.16602C13.0753 4.16602 13.5417 4.63239 13.5417 5.20768C13.5417 5.78298 13.0753 6.24935 12.5 6.24935ZM12.5 13.541C11.9247 13.541 11.4583 13.0746 11.4583 12.4993C11.4583 11.9241 11.9247 11.4577 12.5 11.4577C13.0753 11.4577 13.5417 11.9241 13.5417 12.4993C13.5417 13.0746 13.0753 13.541 12.5 13.541ZM12.5 20.8327C11.9247 20.8327 11.4583 20.3663 11.4583 19.791C11.4583 19.2157 11.9247 18.7493 12.5 18.7493C13.0753 18.7493 13.5417 19.2157 13.5417 19.791C13.5417 20.3663 13.0753 20.8327 12.5 20.8327Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                            </button>
                            <ul
                                v-if="showDropdown"
                                class="tw-absolute tw-top-6 tw-right-0 tw-drop-shadow-lg tw-rounded tw-bg-white tw-text-black dark:tw-bg-[#081825] dark:tw-text-white tw-absolute tw-right-0 tw-z-50"
                                v-click-outside="hideDropdown"
                            >
                                <li>
                                    <button class="tw-flex tw-w-full tw-items-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-whitespace-nowrap tw-text-sm" :data-open-modal="openModalString" @click="openLikes">
                                        <musora-icon icon-name="thumb-like"  class="tw-w-6 tw-h-6 tw-mr-1" /> See All Likes
                                    </button>
                                </li>
                                <li>
                                    <button class="tw-flex tw-w-full tw-items-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-whitespace-nowrap tw-text-sm" @click="reportComment">
                                        <FlagIcon class="tw-inline tw-w-6 tw-h-6 tw-mr-1" /> Report Comment
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <transition name="slide-fade">
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
                        <div class="tw-flex tw-flex-row tw-w-full">
                            <text-editor
                                :fieldKey="domID + '-editor'"
                                ref="textEditor"
                                v-model="replyInterface"
                                :height="150"
                            ></text-editor>
                        </div>
                        <div class="tw-flex tw-flex-row tw-justify-end mv-1">
                            <a
                                class="btn flat dark:tw-text-white tw-text-[#00101D] collapse-150 short tw-mr-1"
                                @click="replying = false"
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
                            :class="loading ? 'tw-flex' : 'tw-hidden' "
                            class="loading-reply tw-z-10 dark:tw-bg-[#000c17]/80 tw-flex-col tw-justify-center tw-items-center"
                        >
                            <i
                                class="fas fa-spinner fa-spin tw-mb-2"
                                :class="themeTextClass"
                            ></i>
                            <p class="tw-text-sm text-grey-3 dark:tw-text-white tw-font-bold">
                                loading...
                            </p>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>
<script>
import { DateTime } from 'luxon';
import Utils from '../../assets/js/classes/utils';
import TextEditor from '../../components/TextEditor/TextEditor.vue';
import MusoraIcon from '../../../components/MusoraIcons/MusoraIcon.vue'
import Toasts from '../../assets/js/classes/toasts';
import CommentService from '../../assets/js/services/comments';
import ThemeClasses from '../../mixins/ThemeClasses';
import { TrashIcon, ThumbUpIcon } from "@heroicons/vue/solid";
import { FlagIcon } from "@heroicons/vue/outline";

export default {
    name: 'CommentReply',
    components: {
        'text-editor': TextEditor,
        TrashIcon,
        ThumbUpIcon,
        MusoraIcon,
        FlagIcon
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
        parentId: {
            type: [String, Number],
            default: () => null,
        },
        profileBaseRoute: {
            type: String,
            default: '',
        },
        comment: {
            type: Object,
            default: () => ({
                user: {},
            }),
        },
        contentId: {
            type: Number,
            default: () => 0,
        },
        pinned: {
            type: Boolean,
            default: () => false,
        },
        hasPublicProfiles: {
            type: Boolean,
            default: () => true,
        },
        openedCommentId: {
            type: [String, Number],
        },
    },
    data() {
        return {
            isLiked: this.comment.is_liked,
            reply: '',
            replying: false,
            loading: false,
            isReported: false,
            showDropdown: false,
        };
    },
    computed: {
        avatarClassObject() {
            return {
                subscriber: ['coach', 'edge', 'lifetime', 'team', 'guitar', 'piano']
                    .indexOf(this.comment.user.access_level) !== -1,
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

        replyInterface: {
            get() {
                return this.reply;
            },
            set(val) {
                this.reply = val;
                this.$refs.textEditor.contentInterface = this.reply;
            },
        },

        userExpValue() {

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

        profileRoute() {
            return this.profileBaseRoute + this.comment.user_id + '/dashboard';
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
        likeComment() {
            this.isLiked = !this.isLiked;

            this.$emit('likeReply', {
                id: this.comment.id,
                isLiked: this.comment.is_liked,
                isPinned: this.pinned,
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

            this.hideDropdown();
        },

        openLikes() {
            if (this.comment.like_count > 0) {
                this.$emit('openLikes', {
                    id: this.comment.id,
                    totalLikeUsers: this.comment.like_count,
                    busToRoot: true,
                });
            }

            this.hideDropdown();
        },

        openReply() {
            this.replying = !this.replying;
            this.$emit('replyOpened', {
                id: this.comment.id,
            });
        },

        postReply() {
            if (this.reply) {
                this.loading = true;

                return CommentService.postReply({
                    parent_id: this.parentId,
                    comment: this.reply,
                })
                    .then((resolved) => {
                        if (resolved) {
                            this.replyInterface = '';
                            this.replying = false;
                            this.$refs.textEditor.currentValue = '';
                            Toasts.push({
                                icon: 'happy',
                                title: 'Woohoo!',
                                themeColor: this.themeColor,
                                message: 'Thanks for your reply!',
                            });

                            this.$emit('replyPosted', {
                                data: resolved.results || resolved.data[0],
                            });
                        }

                        this.loading = false;
                    });
            }
        },

        deleteComment() {
            Toasts.confirm({
                title: 'Are you sure you want to delete this reply?',
                submitButton: {
                    text: '<span class="bg-error text-white">Delete</span>',
                    callback: () => {
                        this.$emit('deleteReply', {
                            id: this.comment.id,
                        });
                    },
                },
                cancelButton: {
                    text: '<span class="bg-grey-3 inverted text-grey-3">Cancel</span>',
                },
            });
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
      	openedCommentId: function(newVal, oldVal) { // watch it
          if (newVal !== oldVal && this.openedCommentId !== this.comment.id) {
            this.replying = false;
          }
        }
    }
};
</script>
