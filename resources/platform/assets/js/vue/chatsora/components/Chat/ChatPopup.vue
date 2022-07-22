<template>
    <div class="tw-fixed tw-top-0 tw-right-0 tw-left-0 tw-h-screen" style="z-index: 200;" v-if="message">
        <div style="overflow-y: scroll; top: 0; right: 0; height: 100%; position: fixed;"></div>
        <div class="cs-overlay tw-absolute tw-inset-0 tw-bg-gray-100 tw-bg-opacity-10" @click.stop.prevent="close()"></div>
        <div class="tw-fixed" v-bind:style="position">
            <div class="tw-absolute tw-text-base" style="bottom: 12px; right: 10px;">
                <div
                    class="cs-sub-menu tw-w-44 tw-p-3 tw-flex tw-flex-col tw-bg-black tw-rounded-lg tw-text-white cs-text-sm tw-z-50"
                >
                    <div v-if="message.user.id != userId && !isAdministrator">
                        <a :href="message.user.profileUrl" target="_blank" class="tw-no-underline tw-text-white">View Profile</a>
                    </div>
                    <div
                        :class="{'tw-mb-2': isAdministrator}"
                        v-if="message.user.id == userId"
                    >
                        <div
                            class="tw-mb-1 tw-cursor-pointer"
                            @click.stop.prevent="editMessage()"
                        >Edit Message</div>
                        <div
                            class="tw-mb-1 tw-cursor-pointer"
                            @click.stop.prevent="removeMessage()"
                        >Delete</div>
                    </div>
                    <div v-if="isAdministrator">
                        <div class="tw-mb-2 tw-font-semibold tw-cursor-default">Moderation</div>
                        <div
                            class="tw-mb-1 tw-cursor-pointer"
                            @click.stop.prevent="pinMessage()"
                            v-if="$_show_pin"
                        >Pin Message</div>
                        <div
                            class="tw-mb-1 tw-cursor-pointer"
                            @click.stop.prevent="unpinMessage()"
                            v-if="$_show_unpin"
                        >Unpin Message</div>
                        <div
                            class="tw-mb-1 tw-cursor-pointer"
                            @click.stop.prevent="removeMessage()"
                            v-if="message.user.id != userId"
                        >Remove Message</div>
                        <div
                            class="tw-mb-1 tw-cursor-pointer"
                            @click.stop.prevent="removeAllMessages()"
                            v-if="message.user.id != userId"
                        >Remove All Messages</div>
                        <div
                            class="tw-cursor-pointer"
                            @click.stop.prevent="blockUser()"
                            v-if="message.user.id != userId"
                        >Block Student</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ChatPopup',
    props: {
        zIndex: {
            type: String,
            default: () => '500',
        },
        userId: {
            type: String,
        },
        isAdministrator: {
            type: Boolean,
            default: () => false,
        },
    },
    data() {
        return {
            position: {
                height: 0,
                width: 0,
                left: '100px',
                top: '100px',
                zIndex: this.zIndex
            },
            message: null,
        };
    },
    computed: {
        $_show_pin: {
            get() {
                return this.isAdministrator && !this.message.pinned && this.message.type != 'reply' && !this.showUpvote;
            },
        },
        $_show_unpin: {
            get() {
                return this.isAdministrator && this.message.pinned && this.message.type != 'reply' && !this.showUpvote;
            },
        },
    },
    mounted() {
        this.$root
            .$on(
                'toggleChatPopup',
                ({ message, domRect }) => {
                    this.position.left = this.roundedPixels(domRect.left + domRect.width);
                    this.position.top = this.roundedPixels(domRect.top);
                    this.message = message;
                    document.body.classList.add('tw-fixed');
                }
            );
    },
    methods: {
        roundedPixels(value) {
            return Math.round(value) + 'px';
        },

        editMessage() {

        },

        removeMessage() {

        },

        pinMessage() {

        },

        unpinMessage() {

        },

        removeAllMessages() {

        },

        blockUser() {

        },

        close() {
            this.message = null;
            document.body.classList.remove('tw-fixed');
        },
    }
}
</script>
