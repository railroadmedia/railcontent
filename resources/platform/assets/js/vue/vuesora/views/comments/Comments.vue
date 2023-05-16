<template>
    <div id="commentsSection" class="tw-flex tw-flex-col tw-flex-grow comments-container dark:tw-text-white tw-w-full">
        <div class="tw-flex tw-flex-row tw-w-full tw-flex-wrap pt-3 tw-items-center">
            <div class="tw-w-full tw-text-[#00101D] dark:tw-text-white tw-flex tw-items-center">
                <!-- Preview Cards -->
                <div class="tw-mr-4 tw-flex">
                    <div v-if="comments.length > 0" class="tw-relative tw-h-[40px] tw-hidden lg:tw-block"
                        :style="`${flattenedProfilePics.length > 1 ? 'width: 100px;' : 'width: 60px;'}`">
                        <div class="tw-h-[40px] tw-absolute" v-for="(src, index) in (flattenedProfilePics.slice(0, 3))"
                            :style="`margin-left: ${index * 20}px`">
                            <img :src="src"
                                :class="`tw-h-[40px] tw-w-[40px] tw-rounded-full tw-border-[1px] tw-border-${brand} tw-box-border`" />
                        </div>
                    </div>
                </div>
                <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl tw-mr-auto">
                    <span>{{ totalCommentsAndReplies }}</span>
                    Comments
                </h2>
                <button v-if="collapsable" class="tw-uppercase tw-font-bebas-neue tw-flex tw-items-center tw-leading-none"
                    @click="commentsCollapsed = !commentsCollapsed">
                    Expand Comment Section
                    <svg class="tw-ml-3 tw-text-[#3F3F46] dark:tw-text-[#9EC0DC]"
                        :class="[{ 'tw-rotate-180': !commentsCollapsed }]" width="15" height="16" viewBox="0 0 15 16"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M13.0492 8.33329L7.21583 14.1666L1.38249 8.33329M13.0492 1.66663L7.21583 7.49996L1.38249 1.66663"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>

        <div v-if="!commentsCollapsed && collapsable" class="tw-flex tw-flex-col tw-w-full">
            <!-- Post a Comment -->
            <div id="postComment" class="tw-flex tw-flex-row comment-post mv-3">
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
                    <text-editor :fieldKey="contentId + '-comment-text-editor'" ref="textEditor" v-model="commentInterface"
                        @input="handleInput" :height="150"></text-editor>

                    <div class="tw-flex tw-flex-row tw-justify-end mv-1">
                        <button class="btn collapse-150" :disabled="loading" dusk="submit-comment" @click="postComment">
                            <span class="tw-text-white short" :class="themeBgClass">
                                Comment
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

            <!-- Sort -->
            <div class="tw-ml-auto tw-mb-3">
                <div class="form-group xs-12" style="width:100%;">
                    <select id="commentSort" class="dark:tw-text-white tw-pb-0 has-input" v-model="sortInterface">
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
                    <label for="commentSort" :class="brandTextColor">Sort By</label>
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
            commentsCollapsed: true,
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

            const relatedLessons = document.getElementById('lessonInfo');

            if ((elemScrollHeight - currentScroll - elemHeight < (relatedLessons.offsetHeight + 200)) && (this.comments.length !== this.totalComments)) {
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

            console.log('GETTING COMMENTSSSS')

            CommentService.getComments(params)
                .then((resolved) => {
                    this.requestingData = false;

                    console.log(resolved)

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

        handleInput(payload) {
            this.comment = payload.currentValue;
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
                                    window.scrollTo(0, ((commentsSection.offsetTop + commentsSection.clientHeight) - 150));
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
