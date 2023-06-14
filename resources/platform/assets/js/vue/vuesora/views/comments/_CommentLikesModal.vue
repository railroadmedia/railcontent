<template>
    <div
        :id="customId || 'likeUsersModal'"
        class="modal small"
    >
        <div
            id="likeUsersContainer"
            ref="likeUsersContainer"
            class="tw-flex tw-flex-col tw-bg-white dark:tw-bg-[#081825] corners-10 tw-shadow tw-rounded-lg"
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
                <h1 class="tw-text-2xl tw-flex tw-items-center tw-p-3 tw-items-center tw-justify-center tw-font-bold tw-text-black dark:tw-text-white tw-sticky tw-top-0 tw-bg-white dark:tw-bg-[#081825] tw-border-b tw-border-b-[#E5E7EB] dark:tw-border-b-[#1E364A] tw-z-50 -tw-mb-[1px]">
                    <musora-icon icon-name="thumb-like-filled" class="tw-w-7 tw-h-7 tw-mr-2" />
                    <div>All Likes</div>
                </h1>

                <a
                    v-for="user in likeUsers"
                    :key="user.id"
                    :href="`${baseProfileRoute}${user.user_id}/dashboard`"
                    class="tw-flex tw-flex-row comment-like-user hover:tw-bg-[#E7EFF6] dark:hover:tw-bg-[#002039] tw-border-t tw-border-t-[#E5E7EB] dark:tw-border-t-[#1E364A] tw-no-underline tw-text-[#00101D] dark:tw-text-white pv-1 tw-items-center tw-mx-7"
                >
                    <div class="tw-flex tw-flex-row">
                        <div class="tw-flex tw-flex-col avatar-column">
                            <div
                                class="user-avatar smaller"
                                :class="getUserAvatarClassObject(user)"
                            >
                                <img
                                    class="tw-rounded-full"
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
            return `/${this.brand}/profile/`;
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
