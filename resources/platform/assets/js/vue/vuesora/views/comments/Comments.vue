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
                <h2 class="tw-font-bold tw-text-xl md:tw-text-2xl tw-mb-2 lg:tw-mb-0 tw-whitespace-nowrap tw-mr-5">
                    <span>{{ totalCommentsAndReplies }}</span>
                    Comments
                </h2>
                <!-- Sort -->
                <div class="tw-mr-auto">
                    <div class="form-group xs-12" style="width:100%;">
                        <select id="commentSort" class="dark:tw-text-white tw-pb-0 tw-pt-1 has-input tw-h-[40px] tw-font-bebas-neue tw-border-2 tw-border-[#000C17] dark:tw-border-white" v-model="sortInterface">
                            <option class="tw-text-[#00101D]" value="-like_count">
                                Popular
                            </option>
                            <option class="tw-text-[#00101D]" value="-created_on">
                                Latest
                            </option>
                            <option class="tw-text-[#00101D]" value="created_on">
                                Oldest
                            </option>
                            <option class="tw-text-[#00101D]" value="-mine">
                                My Comments
                            </option>
                        </select>
                    </div>
                </div>
                <button v-if="collapsable" class="btn collapse-square"
                        @click="commentsCollapsed = !commentsCollapsed">
                    <div class="tw-border-2 tw-text-[#000C17] tw-border-[#000C17] dark:tw-text-white dark:tw-border-white tw-h-[50px] tw-w-[50px] tw-rounded-full tw-flex tw-justify-center tw-items-center" :class="!commentsCollapsed && 'tw-rotate-180'">
                        <i class="fas fa-chevron-down tw-text-lg"></i>
                    </div>
                </button>
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
                    <text-editor :fieldKey="contentId + '-comment-text-editor'" ref="textEditor" v-model="commentInterface" :height="150" placeholder="Share your thoughts..."></text-editor>

                    <div class="tw-flex tw-flex-row tw-justify-end mv-1">
                        <button class="tw-btn-primary collapse-150 tw-text-white" :class="themeBgClass" :disabled="loading" dusk="submit-comment" @click="postComment">
                                Comment
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
import TextEditor from '../../components/TextEditor/TextEditor.vue';
import CommentService from '../../assets/js/services/comments';
import CommentPost from './_CommentPost.vue';
import CommentLikesModal from './_CommentLikesModal.vue';
import Toasts from '../../assets/js/classes/toasts';
import Utils from '../../assets/js/classes/utils';
import xpMapper from '../../assets/js/classes/xp-mapper';
import CommentMixin from './_mixin';
import ThemeClasses from '../../mixins/ThemeClasses';
import { textColor } from '../../../../constants/brands'

export default {
    name: 'Comments',
    components: {
        'text-editor': TextEditor,
        'comment-post': CommentPost,
        'comment-likes-modal': CommentLikesModal,
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

                            Toasts.push({
                                icon: 'happy',
                                title: 'Woohoo!',
                                themeColor: this.themeColor,
                                message: `Your input is what makes ${Utils.toTitleCase(this.brand)} so great, thanks for commenting.`,
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
    },
};
</script>
