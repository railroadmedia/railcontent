<template>
    <div class="tw-flex tw-flex-row comment-post pv mv-1">
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
                class="tiny dense tw-text-center font-compressed"
            >
                {{ userExpValue }} XP
            </p>
        </div>
        <div class="tw-flex tw-flex-col tw-flex-grow">
            <div class="tw-flex tw-flex-row tw-items-center tw-mb-1 comment-meta">
                <div class="tw-flex tw-flex-col tw-flex-grow tw-mr-1">
                    <h2 class="body tw-font-bold break-words">
                        <a
                            v-if="hasPublicProfiles"
                            :href="profileRoute"
                            target="_blank"
                            class="tw-text-black tw-no-underline"
                        >
                            {{ comment.user.display_name }}
                        </a>
                        <span
                            v-else
                            class="text-black no-decoration"
                        >
                            {{ comment.user.display_name }}
                        </span>

                        <span class="x-tiny text-grey-3 tw-font-bold tw-italic tw-uppercase tw-ml-1">
                            {{ dateString }}
                        </span>
                    </h2>
                </div>

                <div class="tw-flex tw-flex-col align-h-right tw-justify-center tw-flex-auto">
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
                <div class="tw-flex tw-flex-col tw-mb-1">
                    <div class="tw-flex tw-flex-row tw-items-center">
                        <p
                            class="tiny tw-mr-3 tw-font-bold tw-uppercase dense tw-pointer reply-like nowrap noselect"
                            :class="replying ? themeTextClass : 'text-grey-3'"
                            dusk="reply-button"
                            @click="openReply"
                        >
                            <i class="fas fa-reply"></i>
                            <span class="hide-xs-only">
                                &nbsp;{{ replying ? 'Replying' : 'Reply' }}&nbsp;
                            </span>
                        </p>

                        <p
                            v-if="!isUsersPost"
                            class="tiny tw-mr-3 tw-font-bold tw-uppercase dense tw-pointer reply-like nowrap noselect"
                            :class="comment.is_liked ? themeTextClass : 'text-grey-3'"
                            @click="likeComment"
                        >
                            <i class="fas fa-thumbs-up"></i>
                            <span class="hide-xs-only">
                                &nbsp;{{ comment.is_liked ? 'Liked' : 'Like' }}&nbsp;
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

            <transition name="slide-fade">
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
                        <div class="tw-flex tw-flex-row tw-w-full">
                            <text-editor
                                ref="textEditor"
                                v-model="replyInterface"
                                toolbar="bold italic underline | bullist numlist | link"
                                :height="150"
                            ></text-editor>
                        </div>
                        <div class="tw-flex tw-flex-row tw-justify-center mv-1">
                            <a
                                class="btn flat tw-text-black collapse-150 short tw-mr-1"
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
        </div>
    </div>
</template>
<script>
import { DateTime } from 'luxon';
import Utils from '../../assets/js/classes/utils';
import TextEditor from '../../components/TextEditor/TextEditor.vue';
import Toasts from '../../assets/js/classes/toasts';
import CommentService from '../../assets/js/services/comments';
import ThemeClasses from '../../mixins/ThemeClasses';

export default {
    name: 'CommentReply',
    components: {
        'text-editor': TextEditor,
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
            default: '/laravel/public/members/profile/',
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
            return this.profileBaseRoute + this.comment.user_id;
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
    mounted() {
        /*
        this.$root.$on('replyOpened', (payload) => {
            if (this.comment.id !== payload.id) {
                this.replying = false;
            }
        });
        */
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
            if (this.reply.currentValue) {
                this.loading = true;

                return CommentService.postReply({
                    parent_id: this.parentId,
                    comment: this.reply.currentValue,
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
