<template>
    <div
        :id="customId || 'likeUsersModal'"
        class="modal small"
    >
        <div
            id="likeUsersContainer"
            ref="likeUsersContainer"
            class="tw-flex tw-flex-col tw-bg-white corners-10 tw-shadow"
            style="max-height:500px;"
        >
            <div
                v-if="loadingLikeUsers"
                class="tw-flex tw-flex-col pa-3"
            >
                <h1 class="heading tw-text-center">
                    <i
                        class="fas fa-spinner fa-spin"
                        :class="themeTextClass"
                    ></i>
                </h1>
            </div>
            <div
                v-else
                class="tw-flex tw-flex-col"
            >
                <h1 class="heading tw-align-middle pa-3">
                    <i
                        class="fas fa-thumbs-up tw-rounded tw-text-white tw-mr-1 big likes-icon"
                        :class="themeBgClass"
                    ></i>
                    {{ totalLikeUsers }} Like{{ totalLikeUsers == 1 ? '' : 's' }}
                </h1>

                <a
                    v-for="user in likeUsers"
                    :key="user.id"
                    :href="baseProfileRoute + user.user_id"
                    class="tw-flex tw-flex-row comment-like-user bt-grey-1-1 tw-no-underline tw-text-black ph-3 pv-1 tw-items-center"
                >
                    <div class="tw-flex tw-flex-row">
                        <div class="tw-flex tw-flex-col avatar-column">
                            <div
                                class="user-avatar smaller"
                                :class="getUserAvatarClassObject(user)"
                            >
                                <img
                                    class="tw-rounded"
                                    :src="user.avatar_url"
                                >
                            </div>
                        </div>
                        <div class="tw-flex tw-flex-col pl-2 tw-justify-center tw-truncate">
                            <p class="body tw-font-bold tw-truncate">
                                {{ user.display_name }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>
<script>
import ThemeClasses from '../../mixins/ThemeClasses';

export default {
    name: 'CommentLikesModal',
    mixins: [ThemeClasses],
    props: {
        brand: {
            type: String,
            default: () => 'drumeo',
        },
        customId: {
            type: String,
            default: () => null,
        },
        likeUsers: {
            type: Array,
            default: () => [],
        },
        totalLikeUsers: {
            default: () => 0,
        },
        loadingLikeUsers: {
            type: Boolean,
            default: () => false,
        },
        commentId: {
            default: () => 0,
        },
        requestingLikeUsers: {
            type: Boolean,
            default: () => false,
        },
    },
    computed: {
        baseProfileRoute() {
            if (this.brand === 'guitareo') {
                return '/members/account/';
            }

            if (this.brand === 'pianote') {
                return '/members/profile/';
            }

            return '/laravel/public/members/profile/';
        },
    },
    mounted() {
        const likeUsersContainer = this.$refs.likeUsersContainer;

        likeUsersContainer.addEventListener('scroll', (event) => {
            const containerHeight = event.target.clientHeight;
            const scrollPosition = event.target.scrollTop;
            const scrollHeight = event.target.scrollHeight;
            const isNearBottom = (containerHeight + scrollPosition) >= (scrollHeight - 25);

            if (this.totalLikeUsers > 10 && this.likeUsers.length < this.totalLikeUsers) {
                if (isNearBottom && !this.requestingLikeUsers) {
                    this.$emit('loadMoreLikeUsers', {
                        id: this.commentId,
                        totalLikeUsers: this.totalLikeUsers,
                        load_more: true,
                    });
                }
            }
        });
    },
    methods: {
        getUserAvatarClassObject(user) {
            return {
                subscriber: ['edge', 'lifetime', 'team'].indexOf(user.access_level) !== -1,
                edge: user.access_level === 'edge',
                coach: user.access_level === 'coach',
                'house-coach': user.access_level === 'house-coach',
                pack: user.access_level === 'pack',
                team: user.access_level === 'team',
                lifetime: user.access_level === 'lifetime',
            };
        },
    },
};
</script>
