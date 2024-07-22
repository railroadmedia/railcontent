<template>
    <Breadcrumb :breadcrumbs="breadcrumbs" />
    <PageHeader pageType="forum-thread" :title="thread.title" :ctas="headerCtas" />

    <div class="tw-w-full forum-post tw-py-12">
        <div class="tw-flex tw-flex-col">
            <div class="tw-flex tw-flex-col-reverse md:tw-flex-row tw-mb-8 tw-flex-wrap">
                <!-- Previous Button -->
                <div
                    class="tw-hidden tw-w-full tw-justify-center tw-mb-6 md:tw-mb-0 md:tw-justify-start sm:tw-w-auto md:tw-inline-flex">
                    <a :href="categoryUrl"
                        class="tw-no-underline tw-transition tw-inline-flex tw-text-[#00101D] dark:tw-text-white tw-items-center">
                        <i class="fas fa-arrow-circle-left tw-text-4xl tw-mr-2"></i>
                        <span class="tw-font-bebas-neue tw-uppercase tw-text-xl">Back To Forum</span>
                    </a>
                </div>
                <!-- Pagination -->
                <div class="tw-inline-flex tw-flex-grow tw-w-full tw-order-first md:tw-order-none sm:tw-w-auto"
                    v-if="totalPages > 1">
                    <pagination class="tw-justify-center" :current-page="currentPage" :total-pages="totalPages"
                        @pageChange="handlePageChange"></pagination>
                </div>
                <!-- Filter -->
                <div class="tw-inline-flex form-group tw-w-full tw-mb-6 md:tw-ml-auto md:tw-mb-0 md:tw-w-80 md:tw-pl-4">
                    <div class="form-group xs-12" style="width:100%;">
                        <select id="postSort" v-model="filterInterface"
                            class="has-input tw-text-[#00101D] dark:tw-text-white tw-pb-0 tw-bg-white dark:tw-bg-transparent">
                            <option v-for="option in filterOptions" :key="option.label" :value="option.value"
                                class="tw-text-[#00101D]">
                                {{ option.label }}
                            </option>
                        </select>
                        <label for="postSort" :class="brand">Sort By... </label>
                    </div>
                </div>
            </div>

            <forum-thread-post v-for="(post, i) in posts" :key="post.id" :index="i" :post="post" :brand="brand"
                :current-page="currentPage" :current-user="currentUser" :is-locked="thread.isLocked"
                :profileBaseRoute="baseProfileRoute" :signatures-hidden="signaturesHidden"
                :all-quotes-hidden="allQuotesHidden" :theme-color="themeColor"
                :update-post-base-route="updatePostBaseRoute" @likePost="handlePostLike"
                @openLikes="addLikeUsersToModal" @deletePost="handlePostDelete" @replyToPost="handleReplyToPost"
                @updateCurrentPostID="changeCurrentPostID" />

            <div class="tw-flex tw-flex-row tw-mb-8 tw-flex-wrap">
                <div
                    class="tw-w-full tw-inline-flex tw-justify-center tw-mb-4 sm:tw-mb-0 sm:tw-justify-start sm:tw-w-auto">
                    <a :href="categoryUrl"
                        class="tw-no-underline tw-transition tw-inline-flex tw-text-[#00101D] dark:tw-text-white tw-items-center">
                        <i class="fas fa-arrow-circle-left tw-text-4xl tw-mr-2"></i>
                        <span class="tw-font-bebas-neue tw-uppercase tw-text-xl">Back To Forum</span>
                    </a>
                </div>
                <div class="tw-flex-grow tw-w-full sm:tw-w-auto" v-if="totalPages > 1">
                    <pagination :current-page="currentPage" :total-pages="totalPages" @pageChange="handlePageChange" />
                </div>
            </div>
            <!-- Thread Reply Section -->
            <section v-if="!thread.isLocked" class="tw-flex tw-flex-row pv-3">
                <div class="tw-items-center tw-flex-col tw-hidden sm:tw-inline-flex tw-flex-shrink-0">
                    <!-- Avatar -->
                    <div class="tw-inline-flex tw-flex-col">
                        <div class="user-avatar tw-w-20 tw-h-20 tw-mb-2" :class="[userAvatarClassObject, brand]">
                            <img class="tw-rounded-full" :src="currentUser.avatar">
                        </div>
                    </div>
                    <!-- User Info -->
                    <div class="tw-text-center">
                        <p class="tw-font-bebas-neue tw-uppercase tw-text-xl dark:tw-text-white">{{
        currentUser.userExpVal }}</p>
                        <p class="tw-font-bebas-neue tw-uppercase tw-text-base dark:tw-text-white">Level {{
        currentUser.progressLevel }}</p>
                        <p class="tw-text-sm tw-text-gray-400 dark:tw-text-white ">{{ currentUser.totalPosts }} Posts
                        </p>
                    </div>
                </div>

                <div id="replyContainer" class="tw-flex tw-flex-col tw-w-full sm:tw-pl-4">
                    <form method="post" :action="postStoreFormUrl" @submit="formDisabled = !formDisabled">

                        <text-editor
                            ref="textEditor"
                            :hasImageUploader="true"
                            v-model="postReplyInterface"
                        />

                        <input type="hidden" name="_method" value="PUT">

                        <input type="hidden" name="thread_id" :value="this.thread.id">

                        <input type="hidden" name="brand" :value="this.brand">

                        <div class="flex tw-flex-col md:tw-flex-row mt-2 tw-justify-center md:tw-justify-between">
                            <a :href="`/${brand}/profile/${currentUser.id}/settings/profile#signatureForm`"
                                class="tw-btn-primary tw-text-gray-400 dark:tw-text-[#7E9AB1] tw-bg-transparent tw-px-4 hover:tw-bg-gray-100 dark:hover:tw-bg-[#002039] tw-mb-2">
                                <i class="fas fa-file-signature tw-mr-1"></i>
                                Add Signature
                            </a>

                            <button class="tw-btn-primary thread-reply-button"
                                :class="`tw-bg-${brand} hover:tw-bg-${brand}-600`" type="submit"
                                :disabled="formDisabled">
                                <span>
                                    Reply
                                </span>
                            </button>
                        </div>

                    </form>
                </div>
            </section>

            <comment-likes-modal :theme-color="themeColor" :brand="brand" :comment-id="currentLikeUsersId"
                :like-users="likeUsers" :total-like-users="totalLikeUsers" :loading-like-users="loadingLikeUsers"
                :requesting-like-users="requestingLikeUsers"
                @loadMoreLikeUsers="addLikeUsersToModal"></comment-likes-modal>

            <!-- Share Post Modal -->
            <div id="sharePostModal" class="modal">
                <div class="tw-flex tw-flex-col bg-white corners-3 shadow ph-2 tw-max-w-md tw-rounded-lg">
                    <div class="tw-flex tw-flex-col tw-mb-2 pv-3">
                        <h2 class="tw-text-lg tw-font-bold tw-mb-2">Share Link</h2>
                        <p v-if="shareLinkCopied" class="tw-text-sm tw-text-green-400 tw-mb-3">Link copied successfully.
                            You are good to go!</p>
                        <p v-else class="tw-text-sm tw-text-gray-400 tw-mb-3">Click on the button to copy the link to
                            your clipboard.</p>
                        <div class="tw-w-full tw-flex tw-rounded-full tw-bg-gray-100">
                            <input
                                class="tw-text-base tw-flex-grow tw-border-0 tw-bg-transparent tw-text-gray-400 tw-pl-5 focus:tw-outline-none"
                                :value="sharePostLink" ref="postLinkInput" readonly>
                            <button class="tw-btn-primary tw-px-10" :class="`tw-bg-${brand} hover:tw-bg-${brand}-600`"
                                role="button" title="copy link to clipboard" @click="copyShareLink()">
                                Copy
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
import * as QueryString from 'query-string/index';
import ForumThreadPost from './_ForumThreadPost.vue';
import Pagination from '../../../Components/Pagination.vue';
import ForumService from '../../../assets/js/Services/forums';
import TextEditor from '../../../Components/TextEditor/TextEditor.vue';
import ThemeClasses from '../../../mixins/ThemeClasses';
import CommentLikesModal from '../../comments/_CommentLikesModal.vue';
import PageHeader from '@collections/PageHeader/PageHeader.vue';
import Breadcrumb from '@collections/Breadcrumb/Breadcrumb.vue';
import { useUserStore } from "@stores/user";
import { storeToRefs } from "pinia";

export default {
    name: 'ForumThread',
    components: {
        Breadcrumb,
        PageHeader,
        'forum-thread-post': ForumThreadPost,
        pagination: Pagination,
        'text-editor': TextEditor,
        'comment-likes-modal': CommentLikesModal,
    },
    mixins: [ThemeClasses],
    props: {
        thread: {
            type: Object,
            default: () => {
            },
        },
        currentUser: {
            type: Object,
            default: () => ({
                access_level: '',
                avatar: '',
                id: 0,
                isAdmin: false,
                isOwner: false,
                name: '',
                totalPosts: '0',
                userExpVal: 'Casual',
                progressLevel: '1.0',
            }),
        },
        postStoreFormUrl: {
            type: String,
            default: () => '/post/store',
        },
        updatePostBaseRoute: {
            type: String,
            default: '/post/update/',
        },
        categoryUrl: {
            type: String,
            default: () => document.referrer,
        },
        categoryTitle: {
            type: String,
            default: () => '',
        },
        threadTitle: {
            type: String,
            default: () => '',
        },
        showCategoriesUrl: {
            type: String,
            default: () => '',
        },
    },
    data () {
        return {
            posts: this.thread.posts,
            currentPage: Number(this.thread.currentPage),
            totalPages: Number(this.thread.totalPages),
            isFollowed: this.thread.isFollowed,
            isLocked: this.thread.isLocked,
            isPinned: this.thread.isPinned,
            signaturesHidden: false,
            allQuotesHidden: true,
            postReplyBody: '',
            currentPost: [],
            formDisabled: false,
            currentLikeUsersId: 0,
            likeUsers: [],
            loadingLikeUsers: false,
            requestingLikeUsers: true,
            totalLikeUsers: 0,
            likeUsersPage: 1,
            currentPostID: '',
            shareLinkCopied: false,
            filterOptions: [
                {
                    label: 'Oldest',
                    value: 'published_on'
                },
                {
                    label: 'Most recent',
                    value: '-published_on'
                },
                {
                    label: 'My posts',
                    value: 'mine'
                }
            ],
        };
    },
    computed: {
        brand() {
            const userStore = useUserStore();
            const { brand } = storeToRefs(userStore)

            return brand.value;
        },
        breadcrumbs () {
            return [
                {
                    title: 'Forums',
                    url: this.showCategoriesUrl,
                },
                {
                    title: this.categoryTitle,
                    url: this.categoryUrl,
                },
                {
                    title: this.threadTitle,
                },
            ];
        },
        headerCtas () {
            const ctas = []
            if (this.currentUser.isAdmin || this.currentUser.isOwner) {
                ctas.push({
                    type: 'PageHeaderCta',
                    props: {
                        faIconClass: 'fa-edit',
                        text: 'Edit Thread',
                        showTextMobileHideDesktop: true,
                        onClickCallback: this.update,
                    },
                });
            }
            if (this.currentUser.isAdmin) {
                ctas.push({
                    type: 'PageHeaderCta',
                    props: {
                        faIconClass: 'fa-thumbtack',
                        text: `${this.isPinned ? 'Unpin' : 'Pin'} Thread`,
                        showTextMobileHideDesktop: true,
                        onClickCallback: this.pinPost,
                    },
                });
                ctas.push({
                    type: 'PageHeaderCta',
                    props: {
                        faIconClass: 'fa-lock',
                        text: `${this.isLocked ? 'Unlock' : 'Lock'} Thread`,
                        showTextMobileHideDesktop: true,
                        onClickCallback: this.lockPost,
                    },
                });
            }
            ctas.push({
                type: 'PageHeaderCta',
                props: {
                    faIconClass: `${this.signaturesHidden ? 'fa-eye-slash' : 'fa-eye'}`,
                    text: `${this.signaturesHidden ? 'Show' : 'Hide'} All Signatures`,
                    showTextMobileHideDesktop: true,
                    onClickCallback: this.hideSignatures,
                },
            });

            ctas.push({
                type: 'PageHeaderCta',
                props: {
                    text: this.isFollowed ? 'Unfollow' : 'Follow',
                    faIconClass: `fa-user-${this.isFollowed ? 'minus' : 'plus'}`,
                    onClickCallback: this.followPost,
                },
            });

            ctas.push({
                type: 'PageHeaderCta',
                props: {
                    text: 'Add Reply',
                    faIconClass: 'fa-plus',
                    onClickCallback: this.scrollToReply,
                },
            });

            return ctas;
        },
        brandBgColor () {
            return `tw-bg-${this.brand}`;
        },

        sharePostLink () {
            return `${window.location.protocol}//${window.location.host}/${this.brand}/forums/jump-to-post/${this.currentPostID}`;
        },

        postReplyInterface: {
            get () {
                return this.postReplyBody;
            },
            set (val) {
                this.postReplyBody = val;
                this.$refs.textEditor.contentInterface = this.postReplyBody;
            },
        },

        baseProfileRoute () {
            return '/members/profile/';
        },

        userAvatarClassObject () {
            return {
                subscriber: ['edge', 'lifetime', 'team', 'admin', 'guitar', 'piano'].indexOf(this.currentUser.access_level) !== -1,
                edge: this.currentUser.access_level === 'edge',
                pack: this.currentUser.access_level === 'pack',
                coach: this.currentUser.access_level === 'coach',
                'house-coach': this.currentUser.access_level === 'house-coach',
                team: ['team', 'admin'].indexOf(this.currentUser.access_level) !== -1,
                guitar: this.currentUser.access_level === 'guitar',
                piano: this.currentUser.access_level === 'piano',
                lifetime: this.currentUser.access_level === 'lifetime',
            };
        },
        currentFilter: {
            get () {
                const urlParams = QueryString.parse(location.search);
                if (urlParams['sortby_val'] != null) {
                    return urlParams['sortby_val'];
                }
                return '-published_on';
            },
            set (val) {
                return val;
            }
        },
        filterInterface: {
            get () {
                return this.filterOptions.filter(option => option.value === this.currentFilter)[0].value;
            },
            set (value) {
                this.currentFilter = value;
                this.handleFilterChange(value);
            },
        },
    },

    beforeMount () {
        //check if signature cookie exists
        let signatureCookie = this.getCookie('signaturesHidden');
        let signaturesValue = JSON.parse(signatureCookie);
        //If signaturesValue is true set signaturesHidden to true else accept default false
        if (signaturesValue) {
            this.signaturesHidden = signaturesValue;
        }
    },

    mounted () {
        const youtubeIframes = document.querySelectorAll('iframe');

        Array.from(youtubeIframes).forEach((iframe) => {
            iframe.setAttribute('width', '360');
            iframe.setAttribute('height', '205');
        });

        //Scroll Post into view if hash exists
        if (window.location.hash.length && document.querySelector(window.location.hash)) {
            document.querySelector(window.location.hash).scrollIntoView()
        }
    },
    methods: {
        handleFilterChange (value) {
            if (value != 0) {
                window.location.href = `${location.protocol}//${location.host
                    }${location.pathname}?sortby_val=${value}`;
            } else {
                window.location.href = `${location.protocol}//${location.host
                    }${location.pathname}`;
            }
        },

        copyShareLink () {
            //Select the text
            this.$refs.postLinkInput.select();
            this.$refs.postLinkInput.setSelectionRange(0, 99999); /* For mobile devices */
            //Copy to Clipboard
            document.execCommand("copy");
            //Success Message
            this.shareLinkCopied = true;
        },

        changeCurrentPostID (id) {
            this.shareLinkCopied = false;
            this.currentPostID = id;
        },

        update () {
            window.location.href = this.thread.update;
        },

        getPosts () {
            return ForumService.getForumThreadPosts()
                .then((data) => {
                    this.posts = data;
                });
        },

        getCookie (name) {
            return document.cookie.match('(^|;)\\s*' + name + '\\s*=\\s*([^;]+)')?.pop() || false;
        },

        handlePageChange (payload) {
            this.currentPage = payload.page;

            const urlParams = QueryString.parse(location.search);

            urlParams.page = this.currentPage;

            window.location.href = `${location.protocol}//${location.host}${location.pathname}?${QueryString.stringify(urlParams)}`;

            // this.getPosts();
        },

        handlePostDelete (payload) {
            ForumService.deleteForumsPost(payload.id, this.brand)
                .then((response) => {
                    window.shownotification({
                        icon: 'check',
                        text: "You're outta here! We have deleted this post."
                    });

                    this.posts = this.posts.filter(post => post.id !== payload.id);
                });
        },

        handlePostLike (payload) {
            const index = this.posts.map(post => post.id).indexOf(payload.id);
            const likedPost = this.posts[index];

            if (likedPost.isLiked) {
                likedPost.totalLikes -= 1;

                ForumService.unlikeForumPost(payload.id, this.brand)
                    .then(resolved => resolved);
            } else {
                likedPost.totalLikes += 1;

                ForumService.likeForumPost(payload.id, this.brand)
                    .then(resolved => resolved);
            }

            likedPost.isLiked = !likedPost.isLiked;
        },

        handleReplyToPost (payload) {
            const blockQuoteHtmlString = `
                <blockquote class="${this.brand}">
                    <span class="post-id">${payload.id}</span>
                    <p class="quote-heading">
                        <strong>${payload.userName}</strong><br>
                        <span> - ${payload.createdOn}</span>
                    </p><br>
                    ${payload.postBody}
                </blockquote>
                <br>`;

            this.scrollToReply();
            this.postReplyInterface += blockQuoteHtmlString;
            this.currentPost = payload.id;
        },

        pinPost() {
            ForumService.pinForumsThread(this.thread.id, this.brand, !this.isPinned)
                .then(resolved => resolved);

            this.isPinned = !this.isPinned;
        },

        lockPost () {
            ForumService.lockForumsThread(this.thread.id, this.brand, !this.isLocked)
                .then(resolved => resolved);

            this.isLocked = !this.isLocked;
        },

        hideSignatures () {
            console.log('hideSignatures')
            //add or remove from cookie based on value of signaturesHidden
            if (!this.signaturesHidden) {
                //Set Cookie
                document.cookie = "signaturesHidden=true;"
                //Set Value to true
                this.signaturesHidden = true;
            } else {
                //Set Cookie to false
                document.cookie = "signaturesHidden=false;"
                //set value to false
                this.signaturesHidden = false;
            }
        },

        followPost () {
            ForumService.followForumsThread(this.thread.id, this.brand, this.isFollowed)
                .then(resolved => resolved);

            this.isFollowed = !this.isFollowed;
        },

        scrollToReply () {
            document.getElementById('replyContainer').scrollIntoView();
        },

        addLikeUsersToModal (payload) {
            const isSameComment = payload.id === this.currentLikeUsersId;

            this.likeUsersPage += 1;
            this.requestingLikeUsers = true;
            this.totalLikeUsers = payload.totalLikeUsers;

            if (!isSameComment) {
                this.loadingLikeUsers = true;
                this.likeUsersPage = 1;
            }

            ForumService.getPostLikeUsers({
                id: payload.id,
                page: this.likeUsersPage
            })
                .then(response => {

                    if (response) {
                        if (isSameComment) {
                            this.likeUsers = [...this.likeUsers, ...response.data];
                        }
                        else {
                            this.likeUsers = response.data;
                        }

                        this.requestingLikeUsers = false;
                        this.currentLikeUsersId = payload.id;

                        // window.modalSimpleBar.recalculate();
                    }

                    this.loadingLikeUsers = false;
                });
        },
    },
};
</script>
<style lang="scss">
@import '../../../assets/sass/partials/variables';

//remove the highlight from share post modal
// #sharePostModal input::selection {
//     background-color: transparent;
// }

//Temporary (Need to be factored with Blockquotes)
.quote-heading {
    display: flex;
    align-items: flex-end;
    flex-wrap: wrap;
    //defaults
    line-height: 1.7 !important;
    font-family: "Bebas Neue", cursive;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: #52525A;
    font-size: 1rem;
    margin-bottom: 15px;

    strong,
    b {
        line-height: 1.7;
        margin-right: 0.25rem;
        font-family: "Open Sans", sans-serif;
        text-transform: none;
        letter-spacing: 0;
        color: #00101D;
    }

    em {
        line-height: 1.6;
        padding-right: 0.25rem;
        color: #52525A;
        font-style: normal;
    }
}

body.tw-dark .quote-heading em,
body.tw-dark .quote-heading {
    color: #9EC0DC;
}

body.tw-dark .quote-heading strong {
    color: white;
}

.post-body blockquote {
    position: relative;
}

//---------------------------//
.thread-title {
    @include xSmallOnly {
        font-size: 20px;
    }
}

.btn.thread-reply-button {
    @include xSmallOnly {
        max-width: 100%;
    }
}

.back-arrow i {
    transition: color .1s ease-in-out;
    will-change: color;
}

.back-arrow:hover {
    i {
        color: #000;
    }
}

p iframe {
    max-width: 100%;
}

.btn.collapse-square.short {
    max-width: 36px;
}
</style>
../../../assets/js/Services/forums@collections/PageHeader/PageHeader.vue@collections/Breadcrumb/Breadcrumb.vue../../../../Components/Pagination.vue../../../../Components/TextEditor/TextEditor.vue