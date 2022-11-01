<template>
    <div class="t-flex t-flex-row">
        <div
            class="t-flex-none t-mr-3 t-relative t-overflow-hidden cs-user-avatar"
            :class="getUserMembershipClass()"
        >
            <a
                :href="user.profileUrl"
                target="_blank"
                class="t-no-underline"
            >
                <img :src="user.avatarUrl" class="t-max-w-full t-h-auto">
            </a>
        </div>
        <div class="t-flex-grow cs-text-sm t-text-white t-flex t-flex-col">
            <div class="t-flex t-flex-row">
                <a
                    :href="user.profileUrl"
                    target="_blank"
                    class="t-no-underline hover:t-underline t-text-white t-font-semibold"
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
