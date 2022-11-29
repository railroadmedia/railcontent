<template>
    <div class="tw-flex tw-flex-row comment-post pv mv-1  dark:tw-text-white tw-ml-[-70px] sm:tw-ml-[-60] md:tw-ml-0">
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

                <div class="tw-flex tw-flex-col align-h-right tw-justify-center tw-grow-0">
                    <div class="tw-flex tw-flex-row">
                        <span
                            v-if="(isUsersPost || isCurrentUserAdmin)"
                            class="tw-text-sm no-decoration tw-cursor-pointer tw-mr-1"
                            @click="deleteComment"
                        >
                            <TrashIcon class="tw-w-[16px] tw-h-[16px] tw-text-[#00101D] dark:tw-text-[#9EC0DC]" />
                        </span>
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
                        <p
                            v-if="!isUsersPost"
                            class="tw-flex tw-items-center tw-font-bold tw-uppercase tw-cursor-pointer nowrap noselect"
                            :class="comment.is_liked ? themeTextClass : 'dark:tw-text-white tw-text-[#00101D]'"
                            dusk="like-button"
                            @click="likeComment"
                        >
                            <musora-icon :icon-name="comment.is_liked  ? 'thumb-like-filled' : 'thumb-like'"  class="tw-w-6 tw-h-6" />
                            <span class="hide-xs-only tw-font-bebas-neue tw-text-[16px]">
                                &nbsp;{{ comment.like_count }}
                            </span>
                        </p>

                        <p
                            class="tw-ml-[16px] tw-flex tw-items-center tw-font-bold tw-uppercase tw-cursor-pointer nowrap noselect"
                            :class="replying ? themeTextClass : 'dark:tw-text-white tw-text-[#00101D]'"
                            dusk="reply-button"
                            @click="openReply"
                        >
                            <MusoraIcon icon-name="comment-outline" class="tw-inline tw-h-[22px] tw-w-[22px]" width="22" height="22" viewBox="0 0 22 22"/>
                            <span class="hide-xs-only tw-font-bebas-neue tw-text-[16px]">
                                &nbsp;REPLY&nbsp;
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
                                @input="handleInput"
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

export default {
    name: 'CommentReply',
    components: {
        'text-editor': TextEditor,
        TrashIcon,
        ThumbUpIcon,
        MusoraIcon
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
            return this.userExpValue != null && this.comment.user.access_level !== 'team';
        },
    },
    methods: {
        handleInput(payload) {
            this.reply = payload.currentValue;
        },
        likeComment() {
            this.isLiked = !this.isLiked;

            this.$emit('likeReply', {
                id: this.comment.id,
                isLiked: this.comment.is_liked,
                isPinned: this.pinned,
            });
        },

        openLikes() {
            if (this.comment.like_count > 0) {
                this.$emit('openLikes', {
                    id: this.comment.id,
                    totalLikeUsers: this.comment.like_count,
                    busToRoot: true,
                });
            }
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
