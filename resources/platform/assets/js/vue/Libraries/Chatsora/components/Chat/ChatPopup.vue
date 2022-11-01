<template>
    <div class="t-fixed t-top-0 t-right-0 t-left-0 t-h-screen" style="z-index: 200;" v-if="message">
        <div style="overflow-y: scroll; top: 0; right: 0; height: 100%; position: fixed;"></div>
        <div class="cs-overlay t-absolute t-inset-0 t-bg-gray-100 t-bg-opacity-10" @click.stop.prevent="close()"></div>
        <div class="t-fixed" v-bind:style="position">
            <div class="t-absolute t-text-base" style="bottom: 12px; right: 10px;">
                <div
                    class="cs-sub-menu t-w-44 t-p-3 t-flex t-flex-col t-bg-black t-rounded-lg t-text-white cs-text-sm t-z-50"
                >
                    <div v-if="message.user.id != userId && !isAdministrator">
                        <a :href="message.user.profileUrl" target="_blank" class="t-no-underline t-text-white">View Profile</a>
                    </div>
                    <div
                        :class="{'t-mb-2': isAdministrator}"
                        v-if="message.user.id == userId"
                    >
                        <div
                            class="t-mb-1 t-cursor-pointer"
                            @click.stop.prevent="editMessage()"
                        >Edit Message</div>
                        <div
                            class="t-mb-1 t-cursor-pointer"
                            @click.stop.prevent="removeMessage()"
                        >Delete</div>
                    </div>
                    <div v-if="isAdministrator">
                        <div class="t-mb-2 t-font-semibold t-cursor-default">Moderation</div>
                        <div
                            class="t-mb-1 t-cursor-pointer"
                            @click.stop.prevent="pinMessage()"
                            v-if="$_show_pin"
                        >Pin Message</div>
                        <div
                            class="t-mb-1 t-cursor-pointer"
                            @click.stop.prevent="unpinMessage()"
                            v-if="$_show_unpin"
                        >Unpin Message</div>
                        <div
                            class="t-mb-1 t-cursor-pointer"
                            @click.stop.prevent="removeMessage()"
                            v-if="message.user.id != userId"
                        >Remove Message</div>
                        <div
                            class="t-mb-1 t-cursor-pointer"
                            @click.stop.prevent="removeAllMessages()"
                            v-if="message.user.id != userId"
                        >Remove All Messages</div>
                        <div
                            class="t-cursor-pointer"
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
                    document.body.classList.add('t-fixed');
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
            document.body.classList.remove('t-fixed');
        },
    }
}
</script>
