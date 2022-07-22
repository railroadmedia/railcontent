<template>
    <div class="cs-message-menu tw-absolute tw-text-base">
        <div class="tw-relative">
            <div
                class="cs-sub-menu tw-absolute tw-right-0 tw-bottom-0 tw-w-44 tw-py-3 tw-flex tw-flex-col tw-bg-black tw-rounded-lg tw-text-white cs-text-sm tw-z-50"
                :class="{'cs-downdown':dropdownMenu}"
                v-if="messageMenu"
            >
                <div v-if="message.user.id != userId && !isAdministrator">
                    <a :href="message.user.profileUrl" target="_blank" class="cs-sub-menu-item tw-px-3 tw-no-underline tw-text-white">View Profile</a>
                </div>
                <div
                    :class="{'tw-mb-2': isAdministrator}"
                    v-if="message.user.id == userId"
                >
                    <div
                        class="cs-sub-menu-item tw-px-3 tw-mb-1 tw-cursor-pointer"
                        @click.stop.prevent="editMessage()"
                    >Edit Message</div>
                    <div
                        class="cs-sub-menu-item tw-px-3 tw-mb-1 tw-cursor-pointer"
                        @click.stop.prevent="removeMessage()"
                    >Delete</div>
                </div>
                <div v-if="isAdministrator">
                    <div class="tw-px-3 tw-mb-2 tw-font-semibold tw-cursor-default">Moderation</div>
                    <div
                        class="cs-sub-menu-item tw-px-3 tw-mb-1 tw-cursor-pointer"
                        @click.stop.prevent="pinMessage()"
                        v-if="$_show_pin"
                    >Pin Message</div>
                    <div
                        class="cs-sub-menu-item tw-px-3 tw-mb-1 tw-cursor-pointer"
                        @click.stop.prevent="unpinMessage()"
                        v-if="$_show_unpin"
                    >Unpin Message</div>
                    <div
                        class="cs-sub-menu-item tw-px-3 tw-mb-1 tw-cursor-pointer"
                        @click.stop.prevent="removeMessage()"
                        v-if="message.user.id != userId"
                    >Remove Message</div>
                    <div
                        class="cs-sub-menu-item tw-px-3 tw-mb-1 tw-cursor-pointer"
                        @click.stop.prevent="removeAllMessages()"
                        v-if="message.user.id != userId"
                    >Remove All Messages</div>
                    <div
                        class="cs-sub-menu-item tw-px-3 tw-cursor-pointer"
                        @click.stop.prevent="blockUser()"
                        v-if="message.user.id != userId"
                    >Block Student</div>
                </div>
            </div>
            <div
                class="cs-react-menu tw-absolute tw-right-0"
                :class="{'cs-downdown':dropdownMenu}"
                v-if="messageReact"
            >
                <div class="tw-flex tw-flex-row tw-bg-black tw-rounded-full tw-text-center space-x-1 tw-py-2 tw-px-3 tw-mb-4">
                    <div
                        class="tw-text-xl tw-cursor-pointer tw-p-1 tw-px-0.5"
                        v-for="(emoji, reaction) in messageReactions"
                        :key="`add-reaction-${reaction}`"
                        @click.stop.prevent="reactToMessage(reaction)"
                    ><span>{{ emoji }}</span></div>
                </div>
            </div>
        </div>
        <div
            class="cs-main-menu tw-flex tw-flex-row tw-rounded-full tw-cursor-pointer tw-px-1"
            :class="{ 'cs-menu-opened': messageMenu || messageReact }"
        >
            <div class="cs-divide-right tw-px-2 cs-text-xs tw-flex tw-flex-row tw-items-center tw-cursor-default">
                <span>{{ $_message_time }}</span>
            </div>
            <div
                class="cs-divide-right cs-tooltip-container tw-px-2 cs-text-sm tw-relative"
                @click.stop.prevent="markAsAnswered()"
                v-if="showUpvote && isAdministrator"
            >
                <i class="fas fa-check"></i>
                <div class="cs-tooltip tw-absolute tw-rounded-md tw-px-2 tw-py-1 tw-text-xs tw-text-white tw-overflow-hidden tw-whitespace-nowrap">Mark as Answered</div>
                <div class="cs-tooltip-arrow tw-absolute tw-transform tw-rotate-45"></div>
            </div>
            <div
                class="cs-divide-right cs-tooltip-container tw-px-2 cs-text-sm tw-relative"
                @click.stop.prevent="toggleMessageReact()"
                v-if="!showUpvote"
            >
                <i class="fas fa-smile-plus"></i>
                <div class="cs-tooltip tw-absolute tw-rounded-md tw-px-2 tw-py-1 tw-text-xs tw-text-white tw-overflow-hidden tw-whitespace-nowrap">Add Reaction</div>
                <div class="cs-tooltip-arrow tw-absolute tw-transform tw-rotate-45"></div>
            </div>
            <div
                class="cs-divide-right tw-px-2 cs-text-sm"
                @click.stop.prevent="messageThread()"
                v-if="showThread"
            ><i class="fal fa-reply-all"></i></div>
            <div
                class="tw-px-2 cs-text-sm"
                @click.stop.prevent="toggleMessageMenu()"
            ><i class="fas fa-ellipsis-h"></i></div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ChatMessageMenu',
    props: {
        message: {
            type: Object,
            default: () => ({
                id: '',
                type: '',
                text: '',
                user: {
                    displayName: '',
                    avatarUrl: '',
                    profileUrl: '',
                    role: '',
                    accessLevelName: '',
                },
            }),
        },
        messageReactions: {
            type: Object,
            default: () => ({}),
        },
        userId: {
            type: String,
        },
        isAdministrator: {
            type: Boolean,
            default: () => false,
        },
        showThread: {
            type: Boolean,
            default: () => true,
        },
        dropdownMenu: {
            type: Boolean,
            default: () => false,
        },
        showUpvote: {
            type: Boolean,
            default: () => true,
        },
        pinnedMessage: {
            type: Boolean,
            default: () => false,
        },
    },
    data() {
        return {
            messageMenu: false,
            messageReact: false,
        };
    },
    computed: {
        $_message_time: {
            get() {
                return this.message.createdAt.toFormat('hh:mma');
            },
        },
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
                'messageMenuToggled',
                ({ message }) => {
                    if (message.id != this.message.id) {
                        this.messageReact = false;
                        this.messageMenu = false;
                    }
                }
            );

        this.$root
            .$on(
                'messageThread',
                () => {
                    this.messageReact = false;
                    this.messageMenu = false;
                }
            );

        this.$root
            .$on(
                'closeMessageMenus',
                () => {
                    if (this.messageReact || this.messageMenu) {
                        this.$root.$emit('messageMenuToggled', { message: this.message, value: false });
                    }

                    this.messageReact = false;
                    this.messageMenu = false;
                }
            );
    },
    methods: {
        toggleMessageMenu() {
            this.messageMenu = !this.messageMenu;
            this.messageReact = false;

            this.$root.$emit('messageMenuToggled', { message: this.message, value: this.messageMenu });
        },

        toggleMessageReact() {
            this.messageReact = !this.messageReact;
            this.messageMenu = false;

            this.$root.$emit('messageMenuToggled', { message: this.message, value: this.messageReact });
        },

        messageThread() {
            this.$root.$emit('messageThread', { message: this.message });

            this.messageReact = false;
            this.messageMenu = false;
        },

        editMessage() {
            this.$root.$emit('editMessage', { message: this.message, pinnedMessage: this.pinnedMessage });
        },

        removeMessage() {
            this.$root.$emit('removeMessage', { message: this.message });
        },

        removeAllMessages() {
            this.$root.$emit('removeAllMessages', { user: this.message.user });
        },

        blockUser() {
            this.$root.$emit('blockUser', { user: this.message.user });
        },

        reactToMessage(reaction) {
            this.$root.$emit(
                'toggleMessageReaction',
                {
                    message: this.message,
                    reaction: reaction
                }
            );
            this.messageReact = false;
        },

        pinMessage() {
            this.$root.$emit('pinMessage', { message: this.message });
        },

        unpinMessage() {
            this.$root.$emit('unpinMessage', { message: this.message });
        },

        markAsAnswered() {
            this.$root.$emit('markAsAnswered', { message: this.message });
        },
    },
}
</script>
