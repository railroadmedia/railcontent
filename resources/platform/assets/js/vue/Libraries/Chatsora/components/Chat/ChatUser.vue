<template>
    <div class="tw-flex tw-flex-row">
        <div
            class="tw-flex-none tw-mr-3 tw-relative tw-overflow-hidden cs-user-avatar"
            :class="getUserMembershipClass()"
        >
            <a
                :href="user.profileUrl"
                target="_blank"
                class="tw-no-underline"
            >
                <img :src="user.avatarUrl" class="tw-max-w-full tw-h-auto">
            </a>
        </div>
        <div class="tw-flex-grow cs-text-sm tw-text-white tw-flex tw-flex-col">
            <div class="tw-flex tw-flex-row">
                <a
                    :href="user.profileUrl"
                    target="_blank"
                    class="tw-flex-none tw-no-underline hover:tw-underline tw-text-white tw-font-semibold"
                >{{ user.displayName }}</a>
                <slot></slot>
            </div>
            <slot name="footer"></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ChatUser',
    props: {
        user: {
            type: Object,
            default: () => ({
                displayName: '',
                avatarUrl: '',
                profileUrl: '',
                role: '',
                accessLevelName: '',
            }),
        },
    },
    methods: {
        getUserMembershipClass() {
            return 'cs-membership-' + this.user.accessLevelName;
        },
    },
}
</script>
