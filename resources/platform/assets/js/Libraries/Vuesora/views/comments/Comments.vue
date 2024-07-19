<template>
    <div id="commentsSection" class="tw-flex tw-flex-col tw-flex-grow comments-container dark:tw-text-white tw-w-full lg:tw-mb-6">
        <div class="tw-flex tw-flex-row tw-w-full tw-flex-wrap tw-py-6 tw-items-center">
            <div class="tw-w-full tw-flex-wrap tw-text-[#00101D] dark:tw-text-white tw-flex tw-items-center">
                <!-- Preview Cards -->
                <div v-if="comments.length > 0" class="lg:tw-mr-4 tw-flex">
                    <div class="tw-relative tw-h-[40px] tw-hidden lg:tw-block"
                         :style="`${flattenedProfilePics.length > 1 ? 'width: 100px;' : 'width: 60px;'}`">
                        <div class="tw-h-[40px] tw-absolute" v-for="(src, index) in (flattenedProfilePics.slice(0, 3))"
                             :style="`margin-left: ${index * 20}px`" :key="index">
                            <img :src="src"
                                 :class="`tw-h-[40px] tw-w-[40px] tw-rounded-full tw-border-[1px] tw-border-${brand} tw-box-border`" />
                        </div>
                    </div>
                </div>
                <div class="tw-flex tw-flex-grow">
                    <h2 class="tw-font-bold tw-text-xl md:tw-text-2xl tw-mb-2 lg:tw-mb-0 tw-whitespace-nowrap tw-mr-5">
                        <span>{{ totalCommentsAndReplies }}</span>
                        Comments
                    </h2>
                    <div class="tw-flex tw-flex-grow tw-justify-end">
                        <!-- Sort -->
                        <div class="tw-relative">
                            <button
                                @click="toggleSortOptions"
                                class="tw-border-2 tw-text-[#000C17] tw-border-[#000C17] dark:tw-text-white dark:tw-border-white tw-h-[35px] sm:tw-h-[50px] tw-w-[35px] sm:tw-w-[50px] tw-rounded-full tw-flex tw-justify-center tw-items-center tw-mr-3">
                                <svg v-if="sortOption === '-mine'" class="tw-w-[20px] sm:tw-w-[22px] tw-h-[20px] sm:tw-h-[22px]" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 7.5L6.0075 7.5M9 7.5L9.0075 7.5M12 7.5L12.0075 7.5M6.75 12L3.75 12C2.92157 12 2.25 11.3284 2.25 10.5L2.25 4.5C2.25 3.67157 2.92157 3 3.75 3L14.25 3C15.0784 3 15.75 3.67158 15.75 4.5L15.75 10.5C15.75 11.3284 15.0784 12 14.25 12L10.5 12L6.75 15.75L6.75 12Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <musora-icon v-else :icon-name="sortIcon" class="tw-w-[20px] sm:tw-w-[22px] tw-h-[20px] sm:tw-h-[22px]" />
                            </button>
                            <div v-if="showSortOptions" v-click-outside="closeSortOptions"
                                 class="tw-w-[150px] tw-drop-shadow-lg tw-rounded tw-bg-white tw-text-black dark:tw-bg-[#081825] dark:tw-text-white tw-absolute -tw-left-[80px] tw-py-2 tw-mt-1 tw-top-[100%] tw-z-[10]">
                                <ul class="tw-text-xs tw-w-full">
                                    <!-- List Items -->
                                    <li v-for="(item, i) in sortOptions" :key="i" class="tw-w-full">
                                        <button
                                            class="tw-flex tw-items-center tw-w-full tw-px-[10px] tw-py-2 tw-z-30 tw-transition-colors dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"
                                            @click.prevent="handleSort(item.value)"
                                        >
                                            <svg v-if="item.value === '-mine'" class="tw-w-[20px] tw-h-[20px] tw-mr-[10px]" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 7.5L6.0075 7.5M9 7.5L9.0075 7.5M12 7.5L12.0075 7.5M6.75 12L3.75 12C2.92157 12 2.25 11.3284 2.25 10.5L2.25 4.5C2.25 3.67157 2.92157 3 3.75 3L14.25 3C15.0784 3 15.75 3.67158 15.75 4.5L15.75 10.5C15.75 11.3284 15.0784 12 14.25 12L10.5 12L6.75 15.75L6.75 12Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <musora-icon v-else :icon-name="item.icon" class="tw-w-[20px] tw-h-[20px] tw-mr-[10px]" />
                                            {{ item.name }}
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <button v-if="collapsable" class="btn collapse-square"
                                @click="commentsCollapsed = !commentsCollapsed">
                            <div class="tw-border-2 tw-text-[#000C17] tw-border-[#000C17] dark:tw-text-white dark:tw-border-white tw-h-[35px] sm:tw-h-[50px] tw-w-[35px] sm:tw-w-[50px] tw-rounded-full tw-flex tw-justify-center tw-items-center" :class="!commentsCollapsed && 'tw-rotate-180'">
                                <i class="fas fa-chevron-down tw-text-lg"></i>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="!commentsCollapsed && collapsable" class="tw-flex tw-flex-col tw-w-full">
            <!-- Post a Comment -->
            <div id="postComment" class="tw-flex tw-flex-row comment-post tw-mb-6">
                <div class="tw-flex-col avatar-column tw-mr-[15px] tw-hidden md:tw-flex">
                    <div class="user-avatar smaller" :class="avatarClassObject">
                        <!-- User Avatar -->
                        <img :src="currentUser.avatar" loading="lazy"
                             class="tw-rounded-full tw-transition-opacity tw-duration-500"
                             :class="currentUser.imageLoaded ? 'tw-opacity-1' : 'tw-opacity-0'"
                             @load="currentUser.imageLoaded = true">
                    </div>
                    <p v-if="showUserExp" class="tw-text-sm dense tw-uppercase tw-text-center mt-1">
                        {{ userExpRank }}
                    </p>
                    <p v-if="showUserExp" class="tw-text-sm dense tw-text-center font-compressed">
                        {{ userExpValue }} XP
                    </p>
                </div>

                <div class="tw-flex tw-flex-col tw-grow tw-w-full">
                    <text-editor
                        :fieldKey="contentId + '-comment-text-editor'"
                        ref="textEditor" :is-student-comment="!currentUser.isAdmin"
                        v-model="commentInterface"
                        :height="150"
                        placeholder="Share your thoughts...">
                    </text-editor>

                    <div class="tw-flex tw-flex-row tw-justify-end mv-1">
                        <MuButton :disabled="loading" dusk="submit-comment" @click="postComment">
                            Comment
                        </MuButton>
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

            <!-- Comments -->
            <comment-post v-if="pinnedComment != null" :comment="pinnedComment" :brand="brand" :current-user="currentUser"
                          :pinned="true" :theme-color="themeColor" :profile-base-route="profileBaseRoute"
                          :has-public-profiles="hasPublicProfiles" :opened-comment-id="openedCommentId"
                          @likeComment="handleCommentLike" @likeReply="handleReplyLike" @deleteComment="handleCommentDelete"
                          @deleteReply="handleReplyDelete" @openLikes="addLikeUsersToModal"
                          @replyOpened="handleReplyOpened"></comment-post>

            <comment-post v-for="(comment, i) in comments" :key="i" :comment="comment" :brand="brand"
                          :current-user="currentUser" :theme-color="themeColor" :profile-base-route="profileBaseRoute"
                          :has-public-profiles="hasPublicProfiles" :opened-comment-id="openedCommentId"
                          @likeComment="handleCommentLike" @likeReply="handleReplyLike" @deleteComment="handleCommentDelete"
                          @deleteReply="handleReplyDelete" @openLikes="addLikeUsersToModal"
                          @replyOpened="handleReplyOpened"></comment-post>

            <comment-likes-modal :theme-color="themeColor" :brand="brand" :comment-id="currentLikeUsersId"
                                 :like-users="likeUsers" :total-like-users="totalLikeUsers" :loading-like-users="loadingLikeUsers"
                                 :requesting-like-users="requestingLikeUsers" @loadMoreLikeUsers="addLikeUsersToModal"></comment-likes-modal>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import * as QueryString from 'query-string';
import TextEditor from '../../Components/TextEditor/TextEditor.vue';
import CommentService from '../../assets/js/Services/comments';
import CommentPost from './_CommentPost.vue';
import CommentLikesModal from './_CommentLikesModal.vue';
import Utils from '../../assets/js/classes/utils';
import xpMapper from '../../assets/js/classes/xp-mapper';
import CommentMixin from './_mixin';
import ThemeClasses from '../../mixins/ThemeClasses';
import { textColor } from '../../../../Constants/brands'
import MuButton from '../../../../Components/Button/MuButton';

export default {
    name: 'Comments',
    components: {
        'text-editor': TextEditor,
        'comment-post': CommentPost,
        'comment-likes-modal': CommentLikesModal,
        'MuButton': MuButton,
        // 'wysiwyg-editor': WYSIWYGEditor,
    },
    mixins: [ThemeClasses, CommentMixin],
    props: {
        contentId: {
            type: [Number, String],
            default: () => '',
        },
        collapsable: {
            type: Boolean,
            default: true,
        },
    },
    data() {
        return {
            openedCommentId: null,
            comments: [],
            pinnedComment: null,
            sortOption: '-like_count',
            comment: '',
            loading: false,
            flattenedProfilePics: [],
            commentsCollapsed: false,
            showSortOptions: false,
            sortOptions: [
                {
                    value: '-like_count',
                    name: 'Popular',
                    icon: 'sort-popularity',
                },
                {
                    value: '-created_on',
                    name: 'Latest',
                    icon: 'sort-down',
                },
                {
                    value: 'created_on',
                    name: 'Oldest',
                    icon: 'sort-up',
                },
                {
                    value: '-mine',
                    name: 'My Comments',
                    icon: 'comment',
                },
            ],
        };
    },
    computed: {
        avatarClassObject() {
            return {
                subscriber: ['edge', 'lifetime', 'team'].indexOf(this.currentUser.access_level) !== -1,
                edge: this.currentUser.access_level === 'edge',
                coach: this.currentUser.access_level === 'coach',
                'house-coach': this.currentUser.access_level === 'house-coach',
                pack: this.currentUser.access_level === 'pack',
                team: this.currentUser.access_level === 'team',
                lifetime: this.currentUser.access_level === 'lifetime',
            };
        },

        brandTextColor() {
            return textColor[this.brand];
        },

        userExpValue() {
            return Utils.parseXpValue(this.currentUser.xp);
        },

        userExpRank() {
            if (this.currentUser.access_level === 'team') {
                return `${this.brand} Team`;
            }

            return xpMapper.getNearestValue(this.currentUser.xp);
        },

        sortInterface: {
            get() {
                return this.sortOption;
            },
            set(val) {
                this.sortOption = val;

                this.currentPage = 1;
                this.getComments(this.requestParams, true);
            },
        },

        commentInterface: {
            get() {
                return this.comment;
            },
            set(val) {
                this.comment = val;
            },
        },

        totalPages() {
            return Math.ceil(this.totalComments / 25);
        },

        requestParams() {
            return {
                page: this.currentPage,
                limit: 25,
                content_id: this.contentId,
                sort: this.sortOption,
            };
        },

        showUserExp() {
            return this.userExpValue != null && (['team', 'pack'].indexOf(this.currentUser.access_level) === -1);
        },

        sortIcon() {
            return this.sortOptions.find(option => option.value === this.sortOption).icon;
        },
    },
    mounted() {
        // Check the URI Params if 'goToComment' exists
        const uriParams = QueryString.parse(window.location.search);
        // Run the goToComment method if it does
        if (Object.keys(uriParams).indexOf('goToComment') !== -1) {
            this.goToComment(uriParams.goToComment);
        }

        const elem = document.getElementById('content-container');

        elem.addEventListener('scroll', () => {
            const elemHeight = elem.offsetHeight;
            const elemScrollHeight = elem.scrollHeight;

            // Get the current scroll position
            const currentScroll = elem.scrollTop;

            if ((elemScrollHeight - currentScroll - elemHeight < 1000) && (this.comments.length !== this.totalComments)) {
                if (!this.requestingData) {
                    this.currentPage += 1;

                    this.getComments(this.requestParams);
                }
            }
        });

        this.getComments(this.requestParams);
    },
    methods: {
        handleReplyOpened({ id }) {
            this.openedCommentId = id;
        },
        getComments(params, replace = false) {
            this.requestingData = true;

            CommentService.getComments(params)
                .then((resolved) => {
                    this.requestingData = false;

                    if (resolved) {
                        this.totalComments = resolved.meta ? resolved.meta.totalResults : resolved.total_results;
                        this.totalCommentsAndReplies = resolved.meta ? resolved.meta.totalCommentsAndReplies : this.totalComments;

                        if (replace) {
                            this.comments = resolved.data || resolved.results;
                        } else {
                            this.comments = this.comments.concat(
                                (resolved.data || resolved.results),
                            );
                        }

                        // Flatten comment profile pics
                        this.comments.forEach(({ user, replies }) => {
                            this.flattenedProfilePics.push(user['fields.profile_picture_image_url']);
                            if (replies && replies.length) {
                                replies.forEach(({ user: replyUser }) => {
                                    this.flattenedProfilePics.push(replyUser['fields.profile_picture_image_url']);
                                })
                            }
                        });

                        if (this.pinnedComment != null) {
                            this.comments = this.comments.filter(comment => comment.id !== this.pinnedComment.id);
                        }
                    }
                });
        },

        getCommentById(id) {
            return axios.get(`/railcontent/comment/${id}`)
                .then(response => response.data)
                .catch(CommentService.handleError);
        },

        postComment() {
            if (this.comment) {
                this.loading = true;

                return CommentService.postComment({
                    content_id: this.contentId,
                    comment: this.comment,
                })
                    .then((resolved) => {
                        if (resolved) {
                            const thisComment = resolved.results || resolved.data[0];

                            this.commentInterface = '';
                            this.$refs.textEditor.currentValue = '';

                            window.shownotification({
                                icon: 'check',
                                text: `Woohoo! Your input is what makes ${Utils.toTitleCase(this.brand)} so great, thanks for commenting.`
                            });

                            this.comments.splice(0, 0, thisComment);
                        }

                        this.loading = false;
                    });
            }
        },

        // NOTE: you cannot jump to replies, only top level parent comments
        goToComment(id) {
            CommentService.getCommentById(id)
                .then((resolved) => {
                    if (resolved) {
                        const commentsSection = document.getElementById('postComment');

                        this.pinnedComment = resolved.data.find(result => result.id == id);

                        if (this.pinnedComment) {
                            this.pinnedComment.showAllReplies = true;
                        }

                        /*
                            * Check intermittently for the DOM Element, it could possibly take a couple
                            * of seconds for Vue to render the pinned comment so we want to wait until it exists
                            * before we scroll to it and remove the old one.
                            *
                            * Curtis - Sept 2018
                             */
                        const checkInterval = setInterval(() => {
                            if (this.pinnedComment != null) {
                                this.comments = this.comments.filter(comment => comment.id !== this.pinnedComment.id);

                                setTimeout(() => {
                                    document.getElementById(`pinnedComment${this.pinnedComment.id}`).scrollIntoView({ behavior: 'smooth' });
                                }, 200);

                                clearInterval(checkInterval);
                            }
                        }, 100);
                    }
                });
        },

        closeSortOptions() {
            this.showSortOptions = false;
        },

        toggleSortOptions() {
            this.showSortOptions = !this.showSortOptions;
        },

        handleSort(val){
            this.showSortOptions = false;
            this.sortOption = val;

            this.currentPage = 1;
            this.getComments(this.requestParams, true);
        },
    },
};
</script>
