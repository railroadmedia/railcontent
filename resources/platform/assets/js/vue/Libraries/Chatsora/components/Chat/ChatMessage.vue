<template>
    <div
        class="cs-message tw-p-3 tw-rounded-md tw-relative tw-top-0 hover:tw-bg-[#F4F4F5] dark:hover:tw-bg-[#002039] hover:tw-border hover:tw-border-[#D4D4D8] dark:hover:tw-border-[#223F57]"
        :class="{'system': message.type == 'system', 'tw-bg-[#F4F4F5] dark:tw-bg-[#002039]': message.pinned && showPin }"
        @mouseleave="closeMessageMenus()"
        @click.stop="closeMessageMenus()"
        ref="msg"
    >
        <div class="tw-max-w-full" v-if="message.pinned && showPin">
            <div class="cs-pin-container">
                <a
                    href="#"
                    @click.stop.prevent="unpinMessage()"
                    class="cs-text-sm cs-text-gray tw-flex tw-flex-row tw-items-center"
                ><i class="fal fa-thumbtack"></i><span class="tw-ml-1 leading-none">Pinned</span></a>
            </div>
        </div>
        <div class="tw-flex tw-flex-col tw-max-w-full" v-if="messageEdit.id != message.id && message.type != 'system'">
            <chat-user :user="message.user">
                <template v-slot:footer>
                    <div v-html="message.text" class="cs-message-text tw-break-words cs-text-sm"></div>
                    <div class="tw-inline-flex tw-items-center" v-if="$_has_reactions || showUpvote">
                        <div
                            class="cs-upvote tw-flex tw-flex-row tw-items-center tw-px-3 tw-rounded-full cs-text-xs tw-border tw-border-[#15803D]/20 dark:tw-border-none tw-bg-[#BBF7D0] dark:tw-bg-[#14532D]"
                            :class="$_message_upvote_class"
                            @click.stop.prevent="toggleUpvote()"
                            v-if="showUpvote"
                        >
                            <i class="cs-icon fas fa-arrow-up tw-text-[#14532D] dark:tw-text-[#F0FDF4]"></i>
                            <span class="cs-reaction-count tw-text-[#14532D] dark:tw-text-[#F0FDF4]">{{ $_message_upvote }}</span>
                        </div>
                        <div
                            class="tw-flex tw-flex-row tw-text-gray-500 tw-cursor-pointer"
                            v-if="$_has_reactions"
                        >
                            <div
                                class="tw-flex tw-flex-row tw-place-content-center tw-p-1"
                                v-for="(count, reaction) in $_message_reactions"
                                :key="`message-reaction-${reaction}`"
                                @click.stop.prevent="toggleMessageReaction(reaction)"
                                :title="getReactionUsers(reaction)"
                            >
                                <span>{{ getReactionEmoji(reaction) }}</span>
                                <span class="tw-text-xs tw-text-white tw-ml-1" v-if="count > 1">{{ count }}</span>
                            </div>
                        </div>
                    </div>
                    <div v-if="message.reply_count && showThread" class="tw-inline-flex">
                        <a
                            class="tw-flex tw-flex-row tw-content-end"
                            @click.stop.prevent="messageThread()"
                        >
                            <div class="tw-transform tw--rotate-180">
                                <i class="fal fa-reply"></i>
                            </div>
                            <span class="tw-ml-1 cs-text-sm">{{ $_reply_count_label }}</span>
                        </a>
                    </div>
                </template>
            </chat-user>

            <chat-message-menu
                :is-administrator="isAdministrator"
                :message="message"
                :message-reactions="messageReactions"
                :user-id="userId"
                :show-thread="showThread"
                :show-upvote="showUpvote"
                :dropdown-menu="dropdownMenu"
                :pinned-message="showPin"
                v-if="showMenu"
            ></chat-message-menu>
        </div>
        <div v-if="messageEdit.id == message.id">
            <div class="cs-message-edit">
                <textarea
                    v-model="messageEdit.text"
                    class="cs-text-sm tw-p-2 tw-bg-black dark:tw-text-white tw-bg-[#F4F4F5] dark:tw-bg-[#002039] tw-resize-none tw-rounded-md tw-border-[#D4D4D8] dark:tw-border-[#223F57] tw-border"
                ></textarea>
                <div class="tw-flex tw-flex-row tw-justify-end tw-mt-2">
                    <div
                        class="cs-btn-outline-white tw-cursor-pointer tw-rounded-full tw-leading-none tw-font-bold focus:tw-outline-none focus:tw-shadow-outline tw-uppercase tw-border-2 tw-border-[#00101D] dark:tw-border-white tw-text-[#00101D] dark:tw-text-white dark:tw-border-white tw-w-28 tw-flex tw-items-center tw-justify-center tw-mr-2 tw-font-bebas-neue"
                        title="Cancel message edit"
                        @click.stop.prevent="cancelMessageEdit()"
                    >Cancel</div>
                    <div
                        class="cs-btn-save tw-cursor-pointer tw-cursor-pointer tw-rounded-full tw-leading-none tw-font-bold focus:tw-outline-none focus:tw-shadow-outline tw-uppercase tw-w-28 tw-flex tw-items-center tw-justify-center tw-font-bebas-neue tw-bg-[#00101D] dark:tw-bg-white tw-text-white dark:tw-text-[#00101D]"
                        title="Save message updates"
                        @click.stop.prevent="saveMessageEdit()"
                    >Save</div>
                </div>
            </div>
        </div>
        <div v-if="message.type == 'system'" class="tw-py-2 cs-text-sm tw-text-black dark:tw-text-white">
            {{ message.text }}
        </div>
    </div>
</template>

<script>
import ChatMessageMenu from './ChatMessageMenu.vue';
import ChatUser from './ChatUser.vue';

export default {
    name: 'ChatMessage',
    components: {
        ChatMessageMenu,
        ChatUser,
    },
    props: {
        brand: {
            type: String,
            default: () => 'drumeo',
        },
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
                own_reactions: [],
                reaction_counts: {}
            }),
        },
        userId: {
            type: String,
        },
        isAdministrator: {
            type: Boolean,
            default: () => false,
        },
        showMenu: {
            type: Boolean,
            default: () => true,
        },
        showThread: {
            type: Boolean,
            default: () => true,
        },
        showUpvote: {
            type: Boolean,
            default: () => true,
        },
        dropdownMenu: {
            type: Boolean,
            default: () => false,
        },
        showPin: {
            type: Boolean,
            default: () => true,
        },
    },
    data() {
        return {
            messageEdit: {
                id: null,
                text: ''
            },
            messageReactions: {
                'thumb': '👍',
                'thumbs-down': '👎',
                'heart': '🧡',
                'fire': '🔥',
                'meh-rolling-eyes': '🙄',
                'grin-hearts': '😍',
                'sad-cry': '😢',
                'grin-squint': '😆',
                'grin-tears': '😂',
            },
        };
    },
    computed: {
        $_message_reactions: {
            cache: false,
            get() {
                let reactionCounts = {...this.message.reaction_counts};
                delete reactionCounts.upvote;

                return reactionCounts;
            },
        },

        $_message_upvote: {
            cache: false,
            get() {
                return this.message.reaction_counts.upvote || 0;
            },
        },

        $_message_upvote_class: {
            cache: false,
            get() {
                return { 'active': this.hasOwnReaction('upvote'), 't-cursor-pointer': this.message.user.id != this.userId };
            },
        },

        $_has_reactions: {
            cache: false,
            get() {
                return this.message
                        && this.message.reaction_counts
                        && Object.keys(this.message.reaction_counts).filter((reaction) => reaction != 'upvote').length > 0;
            },
        },

        $_reply_count_label: {
            cache: false,
            get() {
                return this.message.reply_count + (this.message.reply_count > 1 ? ' replies' : ' reply');
            },
        },
    },
    mounted() {
        if (this.message.type != 'system') {
            this.eventBus
                .on(
                    'editMessage',
                    ({ message, pinnedMessage }) => {
                        if (message.id == this.message.id && pinnedMessage == this.showPin) {
                            this.messageEdit = {
                                id: message.id,
                                text: message.text
                            };
                        } else {
                            this.cancelMessageEdit();
                        }
                    }
                );

            this.eventBus
                .on(
                    'messageOwnReactionUpdate',
                    ({ message }) => {
                        if (message.id == this.message.id) {
                            this.upvoteNewScore = null;
                        }
                    }
                );

            this.eventBus
                .on(
                    'messageMenuToggled',
                    ({ message }) => {
                        if (message.id == this.message.id && this.$refs.msg) {
                            let domRect = this.$refs.msg.getBoundingClientRect();
                            this.eventBus.emit('toggleChatPopup', { message: this.message, domRect });
                        }
                    }
                );

            this.eventBus
                .on(
                    'scrollIntoView',
                    ({ message }) => {
                        if (message.id == this.message.id && this.$refs.msg) {
                            this.$refs.msg.scrollIntoView();
                        }
                    }
                );
        }
    },
    methods: {

        cancelMessageEdit() {
            this.messageEdit = {
                id: null,
                text: ''
            };
        },

        saveMessageEdit() {
            this.eventBus
                .emit(
                    'updateMessage',
                    {
                        message: this.message,
                        text: this.messageEdit.text
                    }
                );

            this.messageEdit = {
                id: null,
                text: ''
            };
        },

        getReactionEmoji(reaction) {
            return this.messageReactions[reaction];
        },

        toggleMessageReaction(reaction) {
            this.eventBus
                .emit(
                    'toggleMessageReaction',
                    {
                        message: this.message,
                        reaction: reaction
                    }
                );
        },

        toggleUpvote() {
            if (this.message.user.id != this.userId) {
                this.eventBus
                    .emit(
                        'toggleMessageReaction',
                        {
                            message: this.message,
                            reaction: 'upvote'
                        }
                    );
            }
        },

        hasOwnReaction(reactionType) {
            let has = false;

            this.message.own_reactions.forEach((reaction) => {
                has = has || reaction.type == reactionType;
            });

            return has;
        },

        formatReactionUsers(users, reactionType) {
            let usersString;

            switch(users.length) {
                case 0:
                break;

                case 1:
                    usersString = users[0];
                break;

                case 2:
                    usersString = users[0] + ' and ' + users[1];
                break;

                case 3:
                    usersString = users[0] + ', ' + users[1] + ' and ' + users[2];
                break;

                default:
                    usersString = users[0] + ', ' + users[1] + ' and ' + (users.length - 2) + ' others';
            }

            if (this.hasOwnReaction(reactionType)) {
                if (users.length == 0) {
                    usersString = 'You';
                } else if (users.length == 1) {
                    usersString = 'You and ' + usersString;
                } else {
                    usersString = 'You, ' + usersString;
                }
            }

            return usersString;
        },

        getReactionUsers(reactionType) {

            let reactionUsers = [];

            if (this.message.reactions && this.message.reactions.length) {

                reactionUsers = this.message
                    .reactions
                    .filter((reaction) => reaction.type == reactionType && reaction.user.id != this.userId )
                    .map((reaction) => reaction.user.displayName );

            }

            return reactionUsers.length || this.hasOwnReaction(reactionType)
                ? this.formatReactionUsers(reactionUsers, reactionType)
                : 'Fetching user information...';
        },

        messageThread() {
            this.eventBus.emit('messageThread', { message: this.message });
        },

        unpinMessage() {
            this.eventBus.emit('unpinMessage', { message: this.message });
        },

        firstWordLength() {
            return this.message.text ? this.message.text.split(' ')[0].length : 0;
        },

        closeMessageMenus() {
            this.eventBus.emit('closeMessageMenus', {});
        },
    },
}
</script>
