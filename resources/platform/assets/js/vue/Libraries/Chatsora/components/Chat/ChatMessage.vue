<template>
    <div
        class="cs-message t-p-3 t-rounded-md t-relative t-top-0"
        :class="{'system': message.type == 'system', 'pinned': message.pinned && showPin}"
        @mouseleave="closeMessageMenus()"
        @click.stop="closeMessageMenus()"
        ref="msg"
    >
        <div class="t-max-w-full" v-if="message.pinned && showPin">
            <div class="cs-pin-container">
                <a
                    href="#"
                    @click.stop.prevent="unpinMessage()"
                    class="cs-text-sm cs-text-gray t-flex t-flex-row t-items-center"
                ><i class="fal fa-thumbtack"></i><span class="t-ml-1 leading-none">Pinned</span></a>
            </div>
        </div>
        <div class="t-flex t-flex-col t-max-w-full" v-if="messageEdit.id != message.id && message.type != 'system'">
            <chat-user :user="message.user">
                <template v-slot:footer>
                    <div v-html="message.text" class="cs-message-text t-whitespace-normal cs-text-sm"></div>
                    <div class="t-inline-flex t-items-center" v-if="$_has_reactions || showUpvote">
                        <div
                            class="cs-upvote t-flex t-flex-row t-items-center t-px-3 t-rounded-full cs-text-xs"
                            :class="$_message_upvote_class"
                            @click.stop.prevent="toggleUpvote()"
                            v-if="showUpvote"
                        >
                            <i class="cs-icon fas fa-arrow-up"></i>
                            <span class="cs-reaction-count">{{ $_message_upvote }}</span>
                        </div>
                        <div
                            class="t-flex t-flex-row t-text-gray-500 t-cursor-pointer"
                            v-if="$_has_reactions"
                        >
                            <div
                                class="t-flex t-flex-row t-place-content-center t-p-1"
                                v-for="(count, reaction) in $_message_reactions"
                                :key="`message-reaction-${reaction}`"
                                @click.stop.prevent="toggleMessageReaction(reaction)"
                                :title="getReactionUsers(reaction)"
                            >
                                <span>{{ getReactionEmoji(reaction) }}</span>
                                <span class="t-text-xs t-text-white t-ml-1" v-if="count > 1">{{ count }}</span>
                            </div>
                        </div>
                    </div>
                    <div v-if="message.reply_count && showThread" class="t-inline-flex">
                        <a
                            class="t-flex t-flex-row t-content-end"
                            @click.stop.prevent="messageThread()"
                        >
                            <div class="t-transform t--rotate-180">
                                <i class="fal fa-reply"></i>
                            </div>
                            <span class="t-ml-1 cs-text-sm">{{ $_reply_count_label }}</span>
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
                    class="cs-text-sm t-p-2 t-bg-black t-text-white t-resize-none t-rounded-md t-border-0"
                ></textarea>
                <div class="t-flex t-flex-row t-justify-end t-mt-2">
                    <div
                        class="cs-btn-outline-white t-cursor-pointer t-rounded-full t-leading-none t-font-bold focus:t-outline-none focus:t-shadow-outline t-uppercase t-border-2 t-border-white t-text-white t-w-28 t-flex t-items-center t-justify-center t-mr-2"
                        title="Cancel message edit"
                        @click.stop.prevent="cancelMessageEdit()"
                    >Cancel</div>
                    <div
                        class="cs-btn-save t-cursor-pointer t-cursor-pointer t-rounded-full t-leading-none t-font-bold focus:t-outline-none focus:t-shadow-outline t-uppercase t-border-2 t-text-white t-w-28 t-flex t-items-center t-justify-center"
                        :class="brand"
                        title="Save message updates"
                        @click.stop.prevent="saveMessageEdit()"
                    >Save</div>
                </div>
            </div>
        </div>
        <div v-if="message.type == 'system'" class="t-py-2 t-text-white cs-text-sm">
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
                'heart': '💓',
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
            this.$root
                .$on(
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

            this.$root
                .$on(
                    'messageOwnReactionUpdate',
                    ({ message }) => {
                        if (message.id == this.message.id) {
                            this.upvoteNewScore = null;
                        }
                    }
                );

            this.$root
                .$on(
                    'messageMenuToggled',
                    ({ message }) => {
                        if (message.id == this.message.id && this.$refs.msg) {
                            let domRect = this.$refs.msg.getBoundingClientRect();
                            this.$root.$emit('toggleChatPopup', { message: this.message, domRect });
                        }
                    }
                );

            this.$root
                .$on(
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
            this.$root
                .$emit(
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
            this.$root
                .$emit(
                    'toggleMessageReaction',
                    {
                        message: this.message,
                        reaction: reaction
                    }
                );
        },

        toggleUpvote() {
            if (this.message.user.id != this.userId) {
                this.$root
                    .$emit(
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
            this.$root.$emit('messageThread', { message: this.message });
        },

        unpinMessage() {
            this.$root.$emit('unpinMessage', { message: this.message });
        },

        firstWordLength() {
            return this.message.text ? this.message.text.split(' ')[0].length : 0;
        },

        closeMessageMenus() {
            this.$root.$emit('closeMessageMenus', {});
        },
    },
}
</script>
