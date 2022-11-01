<template>
    <div class="cs-message-menu t-absolute t-text-base">
        <div class="t-relative">
            <div
                class="cs-sub-menu t-absolute t-right-0 t-bottom-0 t-w-44 t-py-3 t-flex t-flex-col t-bg-black t-rounded-lg t-text-white cs-text-sm t-z-50"
                :class="{'cs-downdown':dropdownMenu}"
                v-if="messageMenu"
            >
                <div v-if="message.user.id != userId && !isAdministrator">
                    <a :href="message.user.profileUrl" target="_blank" class="cs-sub-menu-item t-px-3 t-no-underline t-text-white">View Profile</a>
                </div>
                <div
                    :class="{'t-mb-2': isAdministrator}"
                    v-if="message.user.id == userId"
                >
                    <div
                        class="cs-sub-menu-item t-px-3 t-mb-1 t-cursor-pointer"
                        @click.stop.prevent="editMessage()"
                    >Edit Message</div>
                    <div
                        class="cs-sub-menu-item t-px-3 t-mb-1 t-cursor-pointer"
                        @click.stop.prevent="removeMessage()"
                    >Delete</div>
                </div>
                <div v-if="isAdministrator">
                    <div class="t-px-3 t-mb-2 t-font-semibold t-cursor-default">Moderation</div>
                    <div
                        class="cs-sub-menu-item t-px-3 t-mb-1 t-cursor-pointer"
                        @click.stop.prevent="pinMessage()"
                        v-if="$_show_pin"
                    >Pin Message</div>
                    <div
                        class="cs-sub-menu-item t-px-3 t-mb-1 t-cursor-pointer"
                        @click.stop.prevent="unpinMessage()"
                        v-if="$_show_unpin"
                    >Unpin Message</div>
                    <div
                        class="cs-sub-menu-item t-px-3 t-mb-1 t-cursor-pointer"
                        @click.stop.prevent="removeMessage()"
                        v-if="message.user.id != userId"
                    >Remove Message</div>
                    <div
                        class="cs-sub-menu-item t-px-3 t-mb-1 t-cursor-pointer"
                        @click.stop.prevent="removeAllMessages()"
                        v-if="message.user.id != userId"
                    >Remove All Messages</div>
                    <div
                        class="cs-sub-menu-item t-px-3 t-cursor-pointer"
                        @click.stop.prevent="blockUser()"
                        v-if="message.user.id != userId"
                    >Block Student</div>
                </div>
            </div>
            <div
                class="cs-react-menu t-absolute t-right-0"
                :class="{'cs-downdown':dropdownMenu}"
                v-if="messageReact"
            >
                <div class="t-flex t-flex-row t-bg-black t-rounded-full t-text-center space-x-1 t-py-2 t-px-3 t-mb-4">
                    <div
                        class="t-text-xl t-cursor-pointer t-p-1 t-px-0.5"
                        v-for="(emoji, reaction) in messageReactions"
                        :key="`add-reaction-${reaction}`"
                        @click.stop.prevent="reactToMessage(reaction)"
                    ><span>{{ emoji }}</span></div>
                </div>
            </div>
        </div>
        <div
            class="cs-main-menu t-flex t-flex-row t-rounded-full t-cursor-pointer t-px-1"
            :class="{ 'cs-menu-opened': messageMenu || messageReact }"
        >
            <div class="cs-divide-right t-px-2 cs-text-xs t-flex t-flex-row t-items-center t-cursor-default">
                <span>{{ $_message_time }}</span>
            </div>
            <div
                class="cs-divide-right cs-tooltip-container t-px-2 cs-text-sm t-relative"
                @click.stop.prevent="markAsAnswered()"
                v-if="showUpvote && isAdministrator"
            >
                <i class="fas fa-check"></i>
                <div class="cs-tooltip t-absolute t-rounded-md t-px-2 t-py-1 t-text-xs t-text-white t-overflow-hidden t-whitespace-nowrap">Mark as Answered</div>
                <div class="cs-tooltip-arrow t-absolute t-transform t-rotate-45"></div>
            </div>
            <div
                class="cs-divide-right cs-tooltip-container t-px-2 cs-text-sm t-relative"
                @click.stop.prevent="toggleMessageReact()"
                v-if="!showUpvote"
            >
                <i class="fas fa-smile-plus"></i>
                <div class="cs-tooltip t-absolute t-rounded-md t-px-2 t-py-1 t-text-xs t-text-white t-overflow-hidden t-whitespace-nowrap">Add Reaction</div>
                <div class="cs-tooltip-arrow t-absolute t-transform t-rotate-45"></div>
            </div>
            <div
                class="cs-divide-right t-px-2 cs-text-sm"
                @click.stop.prevent="messageThread()"
                v-if="showThread"
            ><i class="fal fa-reply-all"></i></div>
            <div
                class="t-px-2 cs-text-sm"
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

            this.$root.$emit('messageMenuToggled', { message: this.message, value: this.messageMenu });
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
            this.messageReact = false;
            this.$root.$emit('messageMenuToggled', { message: this.message, value: this.messageReact });
            this.$root.$emit(
                'toggleMessageReaction',
                {
                    message: this.message,
                    reaction: reaction
                }
            );
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
