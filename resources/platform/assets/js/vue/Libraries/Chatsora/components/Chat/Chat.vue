<template>
    <div
        class="cs-container t-relative t-h-full t-w-full t-flex t-flex-col vuesora-override"
        :class="brand"
    >
        <div class="cs-top t-flex-none">
            <div class="t-h-full t-w-full t-flex t-flex-row t-items-center t-place-content-between">
                <div class="t-h-full t-ml-4 t-flex t-flex-row t-items-end t-space-x-4 cs-text-sm">
                    <a
                        href="#"
                        class="t-no-underline t-px-3 t-border-b-2 t-h-full t-flex t-flex-row t-items-center"
                        :class="getTabClasses('chat')"
                        @click.stop.prevent="setCurrentTab('chat')"
                    >Chat</a>
                    <a
                        href="#"
                        class="t-no-underline t-px-3 t-border-b-2 t-h-full t-flex t-flex-row t-items-center"
                        :class="getTabClasses('questions')"
                        @click.stop.prevent="setCurrentTab('questions')"
                    >Questions</a>
                </div>
                <a
                    href="#"
                    class="t-no-underline t-font-semibold t-px-4 cs-text-gray t-border-b-2 t-border-transparent t-h-full t-flex t-flex-row t-items-center"
                    @click.stop.prevent="toggleChatMenu()"
                ><i class="fas fa-ellipsis-v"></i></a>
            </div>
            <div class="t-relative">
                <div
                    class="cs-top-menu cs-text-sm t-leading-relaxed t-absolute t-right-4 t-py-3 t-flex t-flex-col t-bg-black t-rounded-lg t-text-white t-z-30"
                    v-if="chatMenu"
                >
                    <div class="t-px-3 t-mb-2 t-font-semibold t-cursor-default" v-if="isAdministrator">Moderation</div>
                    <div class="cs-top-menu-item t-px-3 t-mb-1 t-cursor-pointer" @click.stop.prevent="toggleShowMembers()">Participants</div>
                    <div
                        class="cs-top-menu-item t-px-3 t-mb-1 t-cursor-pointer"
                        @click.stop.prevent="popoutChat()"
                    >Pop Out Chat</div>
                    <div
                        class="cs-top-menu-item t-px-3 t-mb-1 t-cursor-pointer"
                        @click.stop.prevent="toggleShowBannedUsers()"
                        v-if="isAdministrator"
                    >Blocked Students</div>
                    <div
                        class="cs-top-menu-item t-px-3 t-mb-1 t-cursor-pointer"
                        @click.stop.prevent="removeAllQuestions()"
                        v-if="currentTab == 'questions' && isAdministrator"
                    >Clear All Questions</div>
                </div>
            </div>
        </div>

        <div class="t-absolute t-top-0 t-right-0 t-left-0 t-flex t-flex-col t-z-40" v-show="showThread">
            <div class="cs-top t-flex-none">
                <div class="t-h-full t-w-full t-flex t-flex-row t-place-items-center t-justify-between">
                    <a
                        href="#"
                        class="t-ml-3 t-no-underline t-text-white"
                        @click.stop.prevent="hideMessageThread()"
                    ><i class="fas fa-arrow-left"></i><span class="t-ml-2">Thread</span><span class="t-ml-3">{{ $_reply_count_label }}</span></a>
                    <div class="t-mr-3"><i class="fal fa-times t-text-white t-font-semibold t-cursor-pointer" @click.stop.prevent="hideMessageThread()"></i></div>
                </div>
            </div>
        </div>

        <div class="t-absolute t-inset-0 t-flex t-flex-col t-z-40" v-show="showMembers">
            <div class="cs-top t-flex-none">
                <div class="t-h-full t-w-full t-flex t-flex-row t-items-center">
                    <a
                        href="#"
                        class="t-ml-3 t-no-underline t-text-white"
                        @click.stop.prevent="toggleShowMembers()"
                    ><i class="fas fa-arrow-left"></i><span class="t-ml-2 cs-text-sm">Participants</span></a>
                </div>
            </div>
            <div class="cs-body t-flex-grow t-overflow-y-auto">
                <div class="cs-members-container t-mt-1 t-p-3">
                    <div
                        class="t-py-2"
                        v-for="item in $_watchers"
                        :key="item.id"
                    >
                        <chat-user :user="item"></chat-user>
                    </div>
                </div>
            </div>
            <div class="cs-footer t-flex-none t-h-8">
                <div class="t-h-full t-flex t-flex-row t-items-center t-px-3">
                    <span class="cs-text-gray t-text-xs">{{ $_watcher_count }} Online</span>
                </div>
            </div>
        </div>

        <div class="t-absolute t-inset-0 t-flex t-flex-col t-z-40" v-show="showBannedUsers">
            <div class="cs-top t-flex-none">
                <div class="t-h-full t-w-full t-flex t-flex-row t-items-center">
                    <a
                        href="#"
                        class="t-ml-3 t-no-underline t-text-white"
                        @click.stop.prevent="toggleShowBannedUsers()"
                    ><i class="fas fa-arrow-left"></i><span class="t-ml-2 cs-text-sm">Blocked Students</span></a>
                </div>
            </div>
            <div class="cs-body t-flex-grow t-overflow-y-auto">
                <div class="t-mt-1 t-p-3 cs-text-gray" v-if="fetchingBannedUsers || $_banned_users_count == 0">
                    <span v-if="fetchingBannedUsers">Fetching blocked students information...</span>
                    <span v-if="!fetchingBannedUsers && $_banned_users_count == 0">There are no students blocked from this chat.</span>
                </div>
                <div class="cs-members-container t-mt-1 t-p-3" v-if="!fetchingBannedUsers && $_banned_users_count > 0">
                    <div
                        class="t-py-2"
                        v-for="item in bannedUsers"
                        :key="item.id"
                    >
                        <div class="cs-user t-p-3 t-rounded-md">
                            <chat-user :user="item">
                                <div class="t-flex-grow t-text-right">
                                    <a
                                        href="#"
                                        @click.stop.prevent="unblockUser(item)"
                                        class="cs-user-unblock cs-text-sm"
                                    ><span>Unblock</span><i class="t-ml-1 fas fa-times-circle"></i></a>
                                </div>
                            </chat-user>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cs-footer t-flex-none t-h-8">
                <div class="t-h-full t-flex t-flex-row t-items-center t-px-3">
                    <span class="cs-text-gray t-text-xs">{{ $_watcher_count }} Online</span>
                </div>
            </div>
        </div>

        <div class="cs-body t-flex-grow t-flex t-flex-col t-overflow-hidden t-relative">
            <div
                class="cs-messages-container t-pt-4 t-overflow-y-scroll t-z-40"
                v-if="showThread"
                ref="threadMessages"
            >
                <div class="t-border-b t-border-gray-600">
                    <div class="t-my-4">
                        <chat-message
                            :is-administrator="isAdministrator"
                            :message="messageThread"
                            :user-id="userId"
                            :show-upvote="false"
                            :show-menu="false"
                            :show-thread="false"
                            :brand="brand"
                        ></chat-message>
                    </div>
                </div>
                <div class="cs-messages-container t-mt-4">
                    <div
                        v-for="item in $_message_thread_replies"
                        :key="item.id"
                    >
                        <chat-message
                            :is-administrator="isAdministrator"
                            :message="item"
                            :user-id="userId"
                            :show-upvote="false"
                            :show-thread="false"
                            :brand="brand"
                        ></chat-message>
                    </div>
                </div>
            </div>
            <div
                class="cs-messages-container cs-fit t-pt-4 t-pb-2 t-z-20"
                v-show="$_pinned_messages.length && currentTab == 'chat' && !showThread"
            >
                <div
                    v-for="item in $_pinned_messages"
                    :key="item.key"
                >
                    <chat-message
                        :is-administrator="isAdministrator"
                        :message="item"
                        :user-id="userId"
                        :show-upvote="false"
                        :show-thread="enableThread"
                        :dropdown-menu="true"
                        :brand="brand"
                    ></chat-message>
                </div>
            </div>
            <div
                class="cs-messages-container t-px-3 t-pt-4 t-overflow-y-scroll"
                ref="messages"
                v-show="currentTab == 'chat' && !showThread"
                @scroll="containerScrolled"
            >
                <div
                    class="t-cursor-pointer t-pb-5 t-py-3 t-flex t-flex-row t-place-content-center"
                    @click.stop.prevent="loadMoreMessages"
                    v-if="$_show_load_more_messages"
                >
                    <span class="cs-text-sm t-text-white">Load more messages</span>
                </div>
                <div
                    v-for="(item, index) in $_messages"
                    :key="item.key"
                >
                    <chat-message
                        :is-administrator="isAdministrator"
                        :message="item"
                        :user-id="userId"
                        :show-upvote="false"
                        :show-thread="enableThread"
                        :show-pin="false"
                        :dropdown-menu="index <= 1"
                        :brand="brand"
                    ></chat-message>
                </div>
                <div
                    class="t-p-3 t-text-red-400"
                    v-for="(message, index) in messageErrors"
                    :key="`error-message-${index}`"
                >{{ message }}</div>
            </div>
            <div
                class="cs-messages-container t-pt-4 t-overflow-y-scroll"
                ref="questions"
                v-show="currentTab == 'questions' && !showThread"
                @scroll="containerScrolled"
            >
                <div
                    v-for="(item, index) in $_questions"
                    :key="item.key"
                >
                    <chat-message
                        :is-administrator="isAdministrator"
                        :message="item"
                        :user-id="userId"
                        :show-upvote="true"
                        :show-thread="enableThread"
                        :dropdown-menu="index < 1"
                        :brand="brand"
                    ></chat-message>
                </div>
                <div
                    class="cs-text-gray t-px-3 t-py-1 cs-text-sm"
                    v-if="$_questions.length == 0"
                >There are no questions in this chat</div>
                <div
                    class="t-p-3 t-text-red-400"
                    v-for="(message, index) in questionErrors"
                    :key="`error-question-${index}`"
                >{{ message }}</div>
            </div>
            <div
                class="t-absolute t-left-0 t-right-0 t-bottom-2 t-flex t-flex-row t-place-content-center"
                v-if="$_show_scroll"
            >
                <div
                    class="t-flex t-items-center t-place-content-center cs-round-btn cs-bg-brand t-text-white t-rounded-full t-cursor-pointer"
                    :class="brand"
                    @click.stop.prevent="scrollDown()"
                ><i class="fas fa-arrow-down"></i></div>
            </div>
        </div>

        <div
            v-if="showDialog"
            class="cs-dialog-container t-absolute t-inset-0 t-z-50"
        >
            <div
                class="t-w-full t-h-full t-relative"
            >
                <div class="cs-dialog-overlay t-absolute t-inset-0 t-opacity-100 t-z-20" @click.stop.prevent="closeDialog()"></div>
                <div class="t-w-full t-h-full t-flex t-flex-col t-place-content-center t-place-items-center">
                    <div class="cs-dialog-window t-rounded-lg t-flex-none t-bg-black t-z-30 t-relative">
                        <div class="t-absolute t-top-2 t-right-3 t-text-white"><i class="fal fa-times t-font-semibold t-cursor-pointer" @click.stop.prevent="closeDialog()"></i></div>

                        <div
                            class="t-mt-6 t-mx-8 cs-text-sm t-text-center t-text-white t-tracking-tight t-leading-relaxed"
                            v-if="userDeleteMessages != null"
                        >Are you sure you want to delete all user's messages from the chat?</div>

                        <div
                            class="t-mt-6 t-mx-8 cs-text-sm t-text-center t-text-white t-tracking-tight t-leading-relaxed"
                            v-if="questionRemove != null"
                        >Are you sure you want to mark this question as answered?</div>

                        <div
                            class="t-mt-6 t-mx-6 cs-text-sm t-text-center t-text-white t-tracking-tight t-leading-relaxed"
                            :class="{'t-pb-2': $_short_username}"
                            v-if="userBlock != null"
                        >Are you sure you want to block <span class="t-font-bold">{{ userBlock.displayName }}</span> from this chat?</div>
                        <div class="t-mt-3 t-flex t-flex-row t-justify-center">
                            <div
                                class="cs-btn cs-text-sm t-cursor-pointer t-cursor-pointer t-rounded-full t-leading-none t-tracking-normal t-font-bold focus:t-outline-none focus:t-shadow-outline t-uppercase t-text-white t-w-28 t-flex t-justify-center"
                                @click.stop.prevent="closeDialog(true)"
                            >confirm</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <chat-emoji
            :show-window="showEmoji"
        ></chat-emoji>
        <div class="cs-new-message-container t-flex-none box-border">
            <div class="t-h-full t-flex t-flex-col t-place-content-between t-py-2 t-px-4 t-relative">
                <div class="cs-new-message-wrapper t-rounded">
                    <textarea
                        v-model="message"
                        placeholder="Say something..."
                        onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Say something...'"
                        v-on:keyup.enter="sendMessage()"
                        wrap="off"
                        rows="1"
                        class="t-resize-none cs-text-sm t-bg-black t-rounded-none"
                        :class="{'cs-typing': message != ''}"
                        ref="newMessage"
                        v-if="currentTab == 'chat'"
                    ></textarea>
                    <textarea
                        v-model="question"
                        placeholder="Ask a question..."
                        onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Ask a question...'"
                        v-on:keyup.enter="sendQuestion()"
                        wrap="off"
                        rows="1"
                        class="t-resize-none cs-text-sm t-bg-black t-rounded-none"
                        :class="{'cs-typing': question != ''}"
                        v-if="currentTab == 'questions'"
                    ></textarea>
                </div>
                <div class="cs-new-message-menu t-absolute t-text-lg">
                    <a
                        href="#"
                        class="cs-text-gray t-mr-3"
                        @click.stop.prevent="toggleShowEmoji()"
                        v-if="currentTab == 'chat'"
                    ><i class="fal fa-smile"></i></a>
                    <a
                        href="#"
                        class="cs-text-gray"
                        @click.stop.prevent="sendMessage()"
                        v-if="currentTab == 'chat'"
                    ><div class="send-icon" :class="{'blue': message != ''}"></div></a>
                    <a
                        href="#"
                        class="cs-text-gray"
                        @click.stop.prevent="sendQuestion()"
                        v-if="currentTab == 'questions'"
                    ><div class="send-icon" :class="{'blue': question != ''}"></div></a>
                </div>
                <div>
                    <span
                        class="cs-text-gray t-text-xs t-cursor-pointer"
                        @click.stop.prevent="toggleShowMembers()"
                    >{{ $_watcher_count }} Online</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { DateTime } from 'luxon';
import { StreamChat } from 'stream-chat';
import RailchatService from '../../assets/js/services/railchat.js';
import ChatEmoji from './ChatEmoji.vue';
import ChatMessage from './ChatMessage.vue';
import ChatUser from './ChatUser.vue';
import 'linkifyjs/lib/linkify-string'

export default {
    name: 'Chat',
    components: {
        ChatEmoji,
        ChatMessage,
        ChatUser,
    },
    props: {
        brand: {
            type: String,
            default: () => 'drumeo',
        },
        apiKey: {
            type: String,
        },
        token: {
            type: String,
        },
        userId: {
            type: String,
        },
        chatChannelName: {
            type: String,
        },
        questionsChannelName: {
            type: String,
        },
        isAdministrator: {
            type: Boolean,
            default: () => false,
        },
        enableThread: {
            type: Boolean,
            default: () => false,
        },
        userData: {
            type: Object,
            default: () => ({
                displayName: '',
                avatarUrl: '',
                profileUrl: '',
                role: '',
                accessLevelName: '',
            }),
        },
        embedUrl: {
            type: String,
            default: () => '',
        },
        messagesPageSize: {
            type: Number,
            default: () => 20,
        },
        popupWindowSettings: {
            type: String,
            default: () => 'width=440,height=820',
        },
    },
    data() {
        return {
            message: '',
            messages: [],
            question: '',
            questions: [],
            streamClient: null,
            chatChannel: null,
            questionsChannel: null,
            showMembers: false,
            showBannedUsers: false,
            showDialog: false,
            showThread: false,
            showPinned: false,
            showEmoji: false,
            currentTab: 'chat',
            messageThread: null,
            messageErrors: [],
            questionRemove: null,
            questionErrors: [],
            userBlock: null,
            userDeleteMessages: null,
            channelWatchers: {},
            watcherCount: 0,
            fetchingBannedUsers: false,
            bannedUsers: {},
            chatMenu: false,
            userMessageId: 0,
            userQuestionId: 0,
            insertedEmoji: [],
            messagesMenusOpened: false,
            questionsMenusOpened: false,
            messagesAutoscroll: false,
            questionsAutoscroll: false,
            messagesPage: 1,
            showScroll: false,
            messagesBottom: true,
            questionsBottom: true,
            scrollingMessages: false,
        };
    },
    computed: {
        $_messages: {
            cache: false,
            get() {
                if (this.messages.length > (this.messagesPageSize * this.messagesPage)) {
                    return this.messages.slice(-1 * this.messagesPageSize * this.messagesPage);
                } else {
                    return this.messages;
                }
            },
        },
        $_messages_count: {
            cache: false,
            get() {
                return this.messages.length;
            },
        },
        $_show_load_more_messages: {
            cache: false,
            get() {
                return this.messages.length > (this.messagesPageSize * this.messagesPage);
            },
        },
        $_pinned_messages: {
            cache: false,
            get() {
                return this.messages
                        .filter(message => message.pinned)
                        .map(message => message)
                        .sort((a, b)=> b.pinnedAt - a.pinnedAt);
            },
        },
        $_questions: {
            cache: false,
            get() {
                let questions = [...this.questions];

                return questions
                    .sort((a, b) => {
                        let aUpVotes = a?.reaction_counts?.upvote || 0;
                        let bUpVotes = b?.reaction_counts?.upvote || 0;

                        return bUpVotes - aUpVotes;
                    });
            },
        },
        $_questions_count: {
            cache: false,
            get() {
                return  this.questions.length;
            },
        },
        $_watchers: {
            cache: false,
            get() {
                return this.channelWatchers;
            },
        },
        $_watcher_count: {
            cache: false,
            get() {
                return this.watcherCount;
            },
        },
        $_banned_users_count: {
            cache: false,
            get() {
                return Object.keys(this.bannedUsers).length;
            },
        },
        $_errors_count: {
            cache: false,
            get() {
                return this.messageErrors.length;
            },
        },
        $_message_thread_replies: {
            cache: false,
            get() {
                return this.messageThread.replies.filter(item => item.type == 'reply');
            },
        },
        $_reply_count_label: {
            cache: false,
            get() {
                let label = '';

                if (this.messageThread && this.messageThread.reply_count) {
                    label = this.messageThread.reply_count + (this.messageThread.reply_count > 1 ? ' replies' : ' reply')
                }

                return label;
            },
        },
        $_short_username: {
            get() {
                return this.userBlock != null && this.userBlock.displayName.length <= 12;
            }
        },
        $_show_scroll: {
            cache: false,
            get() {
                return this.showScroll;
            },
        },
    },
    created: function () {
        window.addEventListener('focus', this.restoreScrollState);
        window.addEventListener('blur', this.setScrollState);
    },
    destroyed: function () {
        window.removeEventListener('focus', this.restoreScrollState);
        window.removeEventListener('blur', this.setScrollState);
    },
    mounted() {
        this.setupChat();

        this.$root.$on('updateMessage', this.updateMessage);
        this.$root.$on('removeMessage', this.removeMessage);
        this.$root.$on('removeAllMessages', this.removeAllMessages);
        this.$root.$on('blockUser', this.blockUser);
        this.$root.$on('toggleMessageReaction', this.toggleMessageReaction);
        this.$root.$on('messageThread', this.showMessageThread);
        this.$root.$on('pinMessage', this.pinMessage);
        this.$root.$on('unpinMessage', this.unpinMessage);
        this.$root.$on('insertEmoji', this.insertEmoji);
        this.$root.$on('closeEmojiWindow', this.closeEmojiWindow);
        this.$root.$on('markAsAnswered', this.markAsAnswered);
        this.$root.$on('postQuestion', this.postQuestion);
        this.$root.$on('messageMenuToggled', this.messageMenuToggledHandler);


    },
    watch: {
        $_messages_count: function () {
            this.scrollMessages();
        },
        $_errors_count: function () {
            this.scrollMessages();
        },
        $_reply_count_label: function () {
            this.scrollThreadMessages();
        },
        $_questions_count: function () {
            this.scrollQuestions();
        },
    },
    methods: {

        restoreScrollState() {
            if (this.currentTab == 'chat') {
                if (this.messagesBottom) {
                    this.$nextTick(() => {
                        this.scrollMessages(true);
                    });
                }
            } else {
                if (this.questionsBottom) {
                    this.$nextTick(() => {
                        this.scrollQuestions(true);
                    });
                }
            }
        },

        setScrollState() {
            if (this.currentTab == 'chat') {
                let container = this.$refs.messages;
                if (Math.ceil(container.scrollHeight - container.scrollTop) === container.clientHeight) {
                    this.messagesBottom = true;
                    this.scrollingMessages = false;
                } else {
                    this.messagesBottom = false;
                }
            } else {
                let container = this.$refs.questions;
                if (Math.ceil(container.scrollHeight - container.scrollTop) === container.clientHeight) {
                    this.questionsBottom = true;
                } else {
                    this.questionsBottom = false;
                }
            }
        },

        scrollDown() {
            if (this.currentTab == 'chat') {
                this.scrollMessages(true);
            } else {
                this.scrollQuestions(true);
            }
        },

        popoutChat() {
            this.chatMenu = false;

            window.open(this.embedUrl, 'ChatWindow', this.popupWindowSettings);
        },

        containerScrolled() {
            let container = this.currentTab === 'chat' ? this.$refs.messages : this.$refs.questions;

            if (this.currentTab === 'questions') {
                this.showScroll = false;
                return;
            }

            if (Math.ceil(container.scrollHeight - container.scrollTop) <= (container.clientHeight + 5)) {
                if (this.currentTab === 'chat') {
                    this.messagesPage = 1;
                }
                this.showScroll = false;
                this.scrollingMessages = false;
            } else if (!this.scrollingMessages) {
                this.showScroll = true;
            }
        },

        loadMoreMessages() {
            this.messagesPage++;

            // let firstMessage = this.$_messages[0];
            // this.$nextTick(() => {
            //     this.$root.$emit('scrollIntoView', { message: firstMessage });
            // });
        },

        messageMenuToggledHandler({ message, value }) {

            if (message.category === 'message') {
                if (value === false) {

                    this.messagesMenusOpened = false;

                    if (this.messagesAutoscroll) {
                        this.scrollMessages(true);
                    }

                } else {
                    this.messagesMenusOpened = true;
                }
            } else {
                if (value === false) {

                    this.questionsMenusOpened = false;

                    if (this.questionsAutoscroll) {
                        this.scrollQuestions(true);
                    }

                } else {
                    this.questionsMenusOpened = true;
                }
            }
        },

        scrollMessages(force = false) {
            let container = this.$refs.messages;

            if (force || Math.ceil(container.scrollHeight - container.scrollTop) <= (container.clientHeight + 100)) {
                if (this.messagesMenusOpened) {
                    this.messagesAutoscroll = true;
                } else {
                    this.scrollingMessages = true;
                    this.messagesAutoscroll = false;
                    this.$nextTick(() => {
                        container.scroll({
                            top: container.scrollHeight,
                            behavior: 'smooth'
                        });
                    });
                }
            } else {
                this.scrollingMessages = false;
            }
        },

        scrollQuestions(force = false) {
            let container = this.$refs.questions;

            if (force || Math.ceil(container.scrollHeight - container.scrollTop) <= (container.clientHeight + 100)) {
                if (this.questionsMenusOpened) {
                    this.questionsAutoscroll = true;
                } else {
                    this.questionsAutoscroll = false;
                    this.$nextTick(() => {
                        container.scroll({
                            top: container.scrollHeight,
                            behavior: 'smooth'
                        });
                    });
                }
            }
        },

        scrollThreadMessages(force = false) {
            let container = this.$refs.threadMessages;

            if (container && (force || Math.ceil(container.scrollHeight - container.scrollTop) <= (container.clientHeight + 100))) {
                this.$nextTick(() => {
                    container.scroll({
                        top: container.scrollHeight,
                        behavior: 'smooth'
                    });
                });
            }
        },

        removeAllQuestions() {
            if (this.questions.length) {
                this.chatMenu = false;
                let questionRemove = this.questions[0];

                this.streamClient
                    .deleteMessage(questionRemove.id)
                    .then(() => {
                        this.deleteMessage({ message: questionRemove, collection: this.questions });
                        this.removeAllQuestions();
                    })
                    .catch(({ response }) => {
                        this.errorHandler(response, 'Mark question as answered error', this.questionErrors);
                    });
            }
        },

        sendMessage() {
            let payload = { text:  this.stripHtml(this.message).trim() };

            this.message = '';

            if (payload.text) {

                if (this.messageThread) {
                    payload.parent_id = this.messageThread.id;
                    payload.show_in_channel = false;
                }

                this.chatChannel
                    .sendMessage(payload)
                    .then(() => {
                        this.messageErrors = [];
                    })
                    .catch(({ response }) => {
                        this.errorHandler(response, 'Message send error', this.messageErrors);
                    });

                let message = {
                    'id': '',
                    'type': 'regular',
                    'text': payload.text.linkify({ className: 'chat-message-link', target: '_blank' }),
                    'reply_count': 0,
                    'pinned': false,
                    'user': this.userData,
                    'reaction_counts': {},
                    'reaction_scores': {},
                    'own_reactions': [],
                    'createdAt': DateTime.now(),
                    'pinnedAt': null,
                    'reactions': [],
                    'replies': [],
                    'key': 'user-' + this.userId + this.userMessageId++,
                    'category': 'message',
                };

                this.messages.push(message);
                this.insertedEmoji = [];

                this.$nextTick(() => {
                    this.scrollMessages(true);
                });
            }
        },

        sendQuestion() {
            let text = this.stripHtml(this.question).trim();

            this.question = '';

            if (text) {

                this.questionsChannel
                    .sendMessage({ text })
                    .then(() => {
                        this.questionErrors = [];
                    })
                    .catch(({ response }) => {
                        this.errorHandler(response, 'Question send error', this.questionErrors);
                    });

                let message = {
                    'id': '',
                    'type': 'regular',
                    'text': text.linkify({ className: 'chat-message-link', target: '_blank' }),
                    'reply_count': 0,
                    'pinned': false,
                    'user': this.userData,
                    'reaction_counts': {},
                    'reaction_scores': {},
                    'own_reactions': [],
                    'createdAt': DateTime.now(),
                    'pinnedAt': null,
                    'reactions': [],
                    'replies': [],
                    'key': 'user-' + this.userId + this.userQuestionId++,
                    'category': 'question',
                };

                this.questions.push(message);

                this.$nextTick(() => {
                    this.scrollQuestions(true);
                });
            }
        },

        postQuestion({ text }) {
            this.question = text;
            this.currentTab = 'questions';

            this.sendQuestion();
        },

        errorHandler(response, action, errors) {
            let message = `${action}, please try again, if the error persists contact support.`;

            if (response) {
                if (response.data?.code) {
                    if (response.data.code == 17) {
                        message = `${action}, your account is currently suspended from chat, please contact support.`;
                    } else {
                        message = message + ' Error code: ' + response.data.code;
                    }
                } else if (response.data?.StatusCode) {
                    message = message + ' Error status code: ' + response.data.StatusCode;
                }
            }

            errors.push(message);
        },

        attachChatEventHandlers(channel, collection, category) {
            channel.on(
                'message.new',
                ({ message }) => {
                    this.pushMessage({ message, collection, category });
                }
            );
            channel.on(
                'message.updated',
                ({ message }) => {
                    this.updateMessageState({ message, collection });
                }
            );
            channel.on(
                'message.deleted',
                ({ message }) => {
                    this.deleteMessage({ message, collection });
                }
            );
            channel.on(
                'reaction.new',
                ({ message, reaction }) => {
                    this.pushMessageReaction({ message, reaction, collection });
                }
            );
            channel.on(
                'reaction.deleted',
                ({ message, reaction }) => {
                    this.deleteMessageReaction({ message, reaction, collection });
                }
            );
            channel.on(
                'reaction.updated',
                ({ message, reaction }) => {
                    this.updateMessageReaction({ message, reaction, collection });
                }
            );
            channel.on(({ type, channel_id, user }) => {
                if (type == 'delete_user_messages') {
                    if (channel_id == this.chatChannelName) {
                        this.deleteUserMessages(user);
                    } else if (channel_id == this.questionsChannelName) {
                        this.deleteUserQuestions(user);
                    }
                }
            });
        },

        setupChat() {
            this.streamClient = new StreamChat(this.apiKey, { timeout: 6000 });

            this.streamClient
                .connectUser({ id: this.userId }, this.token)
                .then(() => {
                    this.chatChannel = this.streamClient.channel('messaging', this.chatChannelName, {})
                    return this.chatChannel.watch();
                })
                .then((state) => {
                    this.fetchWatchers();
                    this.fetchPinnedMessages();
                    this.watcherCount = state.watcher_count;

                    this.processMessages(state, this.messages, 'message');

                    let greeting = {id: 'greeting', type: 'system', text: 'Welcome to chat!'};

                    this.messages.push(greeting);

                    this.chatChannel
                        .on('user.watching.start', ({ user, watcher_count }) => {
                            this.$set(this.channelWatchers, user.id, user);
                            this.watcherCount = watcher_count;
                        });

                    this.chatChannel
                        .on('user.watching.stop', ({ user, watcher_count }) => {
                            if (this.channelWatchers[user.id]) {
                                this.$delete(this.channelWatchers, user.id);
                                this.watcherCount = watcher_count;
                            }
                        });

                    this.attachChatEventHandlers(this.chatChannel, this.messages, 'message');

                    this.setupQuestionsChannel();
                });
        },

        setupQuestionsChannel() {
            this.questionsChannel = this.streamClient.channel('messaging', this.questionsChannelName, {})
            this.questionsChannel
                .watch()
                .then((state) => {
                    this.processMessages(state, this.questions, 'question');
                    this.attachChatEventHandlers(this.questionsChannel, this.questions, 'question');
                });
        },

        fetchWatchers() {

            const limit = 100;

            this.chatChannel
                .query({
                    watchers: { limit, offset: 0 },
                })
                .then(({ watchers }) => {
                    if (watchers) {
                        watchers.forEach(user => {
                            if (Math.abs(DateTime.fromISO(user.last_active).diffNow('hours').toObject().hours) < 4) {
                              this.$set(this.channelWatchers, user.id, user);
                            }
                        });
                    }
                });
        },

        fetchBannedUsers() {
            this.fetchingBannedUsers = true;
            this.bannedUsers = {};

            const limit = 100;

            this.streamClient
                .queryUsers({ banned:true }, {}, { limit, offset:0 })
                .then(({ users }) => {
                    users.forEach(user => {
                        this.$set(this.bannedUsers, user.id, user);
                    });
                    this.fetchingBannedUsers = false;
                });
        },

        fetchPinnedMessages() {
            const limit = 100;

            this.chatChannel
                .search(
                    { pinned: true },
                    null,
                    { limit, offset: 0 }
                )
                .then(({ results }) => {
                    results.forEach(({ message }) => {
                        if (message.type == 'regular') {
                            this.insertMessage(message);
                        }
                    });
                    this.unpinMessages();
                });
        },

        deleteUserMessages(user) {
            this.messages.forEach((message, index) => {
                if (message.user?.id == user.id) {
                    this.messages.splice(index, 1);
                }
            });
        },

        deleteUserQuestions(user) {
            this.questions.forEach((message, index) => {
                if (message.user?.id == user.id) {
                    this.questions.splice(index, 1);
                }
            });
        },

        /**
         * Creates a list of pinned messages, reversed sorted by pinned_at
         * Unpins all but last specified value of pinned messages
         */
        unpinMessages(keep = 2) {
            if (this.$_pinned_messages.length > keep) {
                let revesedSorted = this.$_pinned_messages
                                        .map(({id, text, pinnedAt}) => ({id, text, pinnedAt}))
                                        .sort((a, b)=> b.pinnedAt - a.pinnedAt);

                revesedSorted.forEach((message, idx) => {
                    if (idx > keep - 1) {
                        this.unpinMessage({ message });
                    }
                });
            }
        },

        /**
         * Iterate over initial channel messages and call push message only for main channel non-deleted messages
         */
        processMessages({ messages }, collection, category) {
            messages.forEach((message) => {
                if (message.type == 'regular') {
                    this.pushMessage({ message, collection, category });
                }
            });
        },

        /**
         * Create a copy of user object
         */
        getUserCopy({ id, displayName, avatarUrl, profileUrl, role, accessLevelName }) {
            return { id, displayName, avatarUrl, profileUrl, role, accessLevelName };
        },

        /**
         * Create a copy of message object
         * If the message object has more reactions than latest_reactions the method will fetch all reactions from API
         * The message replies are not populated in this method
         */
        getMessageCopy(message) {
            let messageCopy = (({ id, type, text, reply_count, pinned }) => ({ id, type, text, reply_count, pinned }))(message);

            messageCopy.text = this.stripHtml(messageCopy.text).linkify({ className: 'chat-message-link', target: '_blank' });

            messageCopy.user = this.getUserCopy(message.user);

            messageCopy.reaction_counts = {...message.reaction_counts};
            messageCopy.reaction_scores = {...message.reaction_scores};

            messageCopy.own_reactions = message.own_reactions.map(({ type, score }) => ({ type, score }));
            messageCopy.createdAt = DateTime.fromISO(message.created_at);
            messageCopy.pinnedAt = message.pinned_at ? DateTime.fromISO(message.pinned_at) : null;

            const messageReactionsCount = Object.values(message.reaction_counts || {}).reduce((a, b) => a + b, 0);

            messageCopy.reactions = [];
            messageCopy.replies = [];

            if (message.latest_reactions.length == messageReactionsCount) {

                message.latest_reactions.forEach((reaction) => {
                    messageCopy.reactions.push({ type: reaction.type, user: this.getUserCopy(reaction.user) });
                });

            } else {
                this.chatChannel
                    .getReactions(message.id, { limit: 100 })
                    .then(({ reactions }) => {
                        reactions.forEach((reaction) => {
                            messageCopy.reactions.push({ type: reaction.type, user: this.getUserCopy(reaction.user) });
                        });
                    });
            }

            return messageCopy;
        },

        /**
         * Push a message into internal state
         * If the message has replies the method will fetch them from API
         */
        pushMessage({ message, collection, category }) {
            let messageCopy = this.getMessageCopy(message);

            messageCopy.category = category;
            messageCopy.key = messageCopy.id;

            if (message.reply_count) {
                this.chatChannel
                    .getReplies(message.id, { limit: 100 })
                    .then(({ messages }) => {
                        messages.forEach((reply) => {
                            messageCopy.replies.push(this.getMessageCopy(reply));
                        });

                        if (this.messageThread?.id == messageCopy.id) {
                            this.scrollThreadMessages();
                        }
                    });
            }

            let found = false;

            if (message.user.id == this.userId) {
                if (message.type == 'regular') {
                    let messageIdx = null;

                    collection.forEach((msg, idx) => {
                        if (!msg.id && msg.user.id == this.userId && msg.text == messageCopy.text) {
                            messageIdx = idx;
                            found = true;
                        }
                    });

                    if (messageIdx != null) {
                        messageCopy.key = collection[messageIdx].key

                        collection.splice(messageIdx, 1, messageCopy);
                    }

                } else if (message.type == 'reply' && message.parent_id) {
                    collection.forEach((parentMessage, parrentIdx) => {
                        if (parentMessage.id == message.parent_id) {
                            let messageIdx;
                            parentMessage.replies.forEach((msg, idx) => {
                                if (!msg.id && msg.user.id == this.userId && msg.text == messageCopy.text) {
                                    messageIdx = idx;
                                    found = true;
                                }
                            });
                            if (messageIdx) {
                                messageCopy.key = collection[parrentIdx].replies[messageIdx].key

                                collection[parrentIdx].replies.splice(messageIdx, 1, messageCopy);
                            }
                        }
                    });
                }
            }

            if (message.type == 'regular' && message.user.id == this.userId && category == 'question' && !message.own_reactions.length) {
                this.$nextTick(() => {
                    this.toggleMessageReaction({ message: messageCopy, reaction: 'upvote' });
                });
            }

            if (!found) {
                if (message.type == 'regular') {
                    collection.push(messageCopy);
                } else if (message.type == 'reply' && message.parent_id) {
                    collection.forEach((parentMessage) => {
                        if (parentMessage.id == message.parent_id) {
                            parentMessage.replies.push(messageCopy);
                            parentMessage.reply_count = parentMessage.reply_count + 1;
                        }
                    });
                }
            }
        },

        /**
         * Inserts a message into internal state
         * If the message has replies the method will fetch them from API
         * If the message already exists in the internal state, it will not be duplicated
         */
        insertMessage(message) {
            let exists = false;
            let idx = null;

            const messageCreatedAt = DateTime.fromISO(message.created_at);

            this.messages.forEach((storedMessage, storedIndex) => {
                if (message.id == storedMessage.id) {
                    exists = true;
                }

                if (idx == null && messageCreatedAt < storedMessage.createdAt) {
                    idx = storedIndex;
                }
            });

            if (!exists) {
                let messageCopy = this.getMessageCopy(message);

                if (message.reply_count) {
                    this.chatChannel
                        .getReplies(message.id, { limit: 100 })
                        .then(({ messages }) => {
                            messages.forEach((reply) => {
                                messageCopy.replies.push(this.getMessageCopy(reply));
                            });
                        });
                }

                if (idx) {
                    this.messages.splice(idx, 0, messageCopy);
                } else {
                    this.messages.push(messageCopy);
                }
            }
        },

        /**
         * Update message text and pinned status
         */
        updateMessageState({ message, collection }) {
            collection.forEach((storedMessage) => {
                if (message.type == 'regular' && storedMessage.id == message.id) {
                    storedMessage.text = message.text;
                    storedMessage.pinned = message.pinned;
                    storedMessage.pinnedAt = message.pinned_at ? DateTime.fromISO(message.pinned_at) : null;
                    this.unpinMessages();
                } else if (message.type == 'reply' && message.parent_id && storedMessage.id == message.parent_id) {
                    storedMessage.replies.forEach((storedReplyMessage) => {
                        if (storedReplyMessage.id == message.id) {
                            storedReplyMessage.text = message.text;
                        }
                    });
                }
            });
        },

        /**
         * Delete a message from internal state
         */
        deleteMessage({ message, collection }) {
            let idx = null;

            collection.forEach((storedMessage, messageIndex) => {
                if (message.parent_id && storedMessage.id == message.parent_id) {

                    storedMessage.replies.forEach((storedReplyMessage, replyIndex) => {
                        if (storedReplyMessage.id == message.id) {
                            idx = replyIndex;
                        }
                    });

                    if (idx != null) {
                        storedMessage.replies.splice(idx, 1);
                        storedMessage.reply_count = storedMessage.reply_count - 1;
                        idx = null;
                    }

                } else if (storedMessage.id == message.id) {
                    idx = messageIndex;
                }
            });

            if (idx != null && !message.parent_id) {
                collection.splice(idx, 1);
            }
        },

        /**
         * Locates the internal message, main channel message or reply, and calls addMessageReaction
         */
        pushMessageReaction({ message, reaction, collection }) {
            let scroll = !this.showScroll;
            collection.forEach((storedMessage) => {
                if (message.parent_id && storedMessage.id == message.parent_id) {
                    storedMessage.replies.forEach((storedReplyMessage) => {
                        if (storedReplyMessage.id == message.id) {
                            this.addMessageReaction(
                                storedReplyMessage,
                                reaction,
                                {...message.reaction_counts},
                                {...message.reaction_scores}
                            );
                        }
                    });
                } else if (storedMessage.id == message.id) {
                    this.addMessageReaction(
                        storedMessage,
                        reaction,
                        {...message.reaction_counts},
                        {...message.reaction_scores}
                    );
                }
            });

            if (this.messageThread && this.messageThread.id == message.id) {
                this.$nextTick(() => {
                    this.scrollThreadMessages();
                });
            } else if (this.messageThread == null && scroll) {
                this.$nextTick(() => {
                    this.scrollMessages(true);
                });
            }
        },

        /**
         * Adds a reaction to an internal state message and updates reaction counts
         */
        addMessageReaction(storedMessage, reaction, messageRectionCounts, messageRectionScores) {
            storedMessage.reactions.push({ type: reaction.type, user: this.getUserCopy(reaction.user) });
            storedMessage.reaction_counts = messageRectionCounts;
            storedMessage.reaction_scores = messageRectionScores;
            if (reaction.user.id == this.userId) {
                storedMessage.own_reactions.push({ type: reaction.type, score: reaction.score });
                this.$root.$emit('messageOwnReactionUpdate', { message: storedMessage });
            }
        },

        /**
         * Locates the internal message, main channel message or reply, and calls removeMessageReaction
         */
        deleteMessageReaction({ message, reaction, collection }) {
            collection.forEach((storedMessage) => {
                if (message.parent_id && storedMessage.id == message.parent_id) {
                    storedMessage.replies.forEach((storedReplyMessage) => {
                        if (storedReplyMessage.id == message.id) {
                            this.removeMessageReaction(
                                storedReplyMessage,
                                reaction,
                                {...message.reaction_counts},
                                {...message.reaction_scores}
                            );
                        }
                    });
                } else if (storedMessage.id == message.id) {
                    this.removeMessageReaction(
                        storedMessage,
                        reaction,
                        {...message.reaction_counts},
                        {...message.reaction_scores}
                    );
                }
            });
        },

        /**
         * Removes a reaction from an internal state message and updates reaction counts
         */
        removeMessageReaction(storedMessage, reaction, messageRectionCounts, messageRectionScores) {
            let idx;
            storedMessage.reactions.forEach((storedReaction, index) => {
                if (
                    storedReaction.type == reaction.type
                    && storedReaction.user.id == reaction.user.id
                ) {
                    idx = index;
                }
            });
            storedMessage.reactions.splice(idx, 1);
            storedMessage.reaction_counts = messageRectionCounts;
            storedMessage.reaction_scores = messageRectionScores;
            if (reaction.user.id == this.userId) {
                storedMessage.own_reactions.forEach((ownReaction, index) => {
                    if (ownReaction.type == reaction.type) {
                        idx = index;
                    }
                });
                storedMessage.own_reactions.splice(idx, 1);
            }
        },

        updateMessageReaction({ message, reaction, collection }) {
            collection.forEach((storedMessage) => {
                if (storedMessage.id == message.id) {
                    storedMessage.reaction_counts = {...message.reaction_counts};
                    storedMessage.reaction_scores = {...message.reaction_scores};
                    if (reaction.user.id == this.userId) {
                        storedMessage.own_reactions.forEach((ownReaction) => {
                            if (ownReaction.type == reaction.type) {
                                ownReaction.score = reaction.score;
                            }
                        });
                        this.$root.$emit('messageOwnReactionUpdate', { message });
                    }
                }
            });
        },

        toggleShowMembers() {
            this.showMembers = !this.showMembers;
            this.chatMenu = false;
        },

        toggleShowBannedUsers() {
            this.showBannedUsers = !this.showBannedUsers;
            this.chatMenu = false;

            if (this.showBannedUsers) {
                this.fetchBannedUsers();
            }
        },

        toggleShowEmoji() {
            this.showEmoji = !this.showEmoji;
        },

        updateMessage({ message, text }) {
            let errors = this.currentTab == 'chat' ? this.messageErrors : this.questionErrors;

            this.streamClient
                .updateMessage({
                    id: message.id,
                    text,
                    pinned: message.pinned
                })
                .then(() => {
                    this.messageErrors = [];
                })
                .catch(({ response }) => {
                    this.errorHandler(response, 'Message update error', errors);
                });
        },

        removeMessage({ message }) {
            this.streamClient
                .deleteMessage(message.id)
                .then(() => {
                    this.messageErrors = [];
                })
                .catch(({ response }) => {
                    this.errorHandler(response, 'Message delete error', this.messageErrors);
                });
        },

        blockUser({ user }) {
            this.userBlock = user;
            this.showDialog = true;
        },

        removeAllMessages({ user }) {
            this.userDeleteMessages = user;
            this.showDialog = true;
        },

        markAsAnswered({ message }) {
            this.questionRemove = message;
            this.showDialog = true;
        },

        closeDialog(confirmation) {

            let errors = this.currentTab == 'chat' ? this.messageErrors : this.questionErrors;

            if (confirmation) {

                if (this.userBlock) {

                    RailchatService
                        .banUser(this.userBlock.id)
                        .then(() => {
                            errors = [];
                        })
                        .catch(({ response }) => {
                            this.railErrorHandler(response, 'User ban error', errors);
                        });
                } else if (this.questionRemove) {
                    this.streamClient
                        .deleteMessage(this.questionRemove.id)
                        .then(() => {
                            this.questionErrors = [];
                        })
                        .catch(({ response }) => {
                            this.errorHandler(response, 'Mark question as answered error', this.questionErrors);
                        });
                } else if (this.userDeleteMessages) {

                    RailchatService
                        .deleteUserMessages(this.userDeleteMessages.id)
                        .then(() => {
                            this.messageErrors = [];
                            this.questionErrors = [];
                        })
                        .catch(({ response }) => {
                            this.railErrorHandler(response, 'Delete user messages error', errors);
                        });
                }
            }

            this.showDialog = false;
            this.questionRemove = null;
            this.userBlock = null;
            this.userDeleteMessages = null;
        },

        hasOwnReaction(message, reactionType) {
            let has = false;

            message.own_reactions.forEach((reaction) => {
                has = has || reaction.type == reactionType;
            });

            return has;
        },

        removeOwnReaction({ message, reaction }) {
            let collection = message.category == 'message' ? this.messages : this.questions;
            let selectedMessage;

            collection.forEach((msg) => {
                if (msg.id == message.id) {
                    selectedMessage = msg;
                }
            });

            if (selectedMessage.reaction_counts[reaction] > 1) {
                selectedMessage.reaction_counts[reaction] = selectedMessage.reaction_counts[reaction] - 1;
            } else {
                delete selectedMessage.reaction_counts[reaction];
            }

            let reactionIndex;

            selectedMessage.own_reactions.forEach(({ type }, idx) => {
                if (type == reaction) {
                    reactionIndex = idx;
                }
            });

            if (reactionIndex) {
                selectedMessage.own_reactions.splice(reactionIndex, 1);
            }
        },

        addOwnReaction({ message, reaction }) {
            let collection = message.category == 'message' ? this.messages : this.questions;
            let selectedMessage;

            collection.forEach((msg) => {
                if (msg.id == message.id) {
                    selectedMessage = msg;
                }
            });

            if (selectedMessage) {
                let scroll = !this.showScroll;
                selectedMessage.reaction_counts[reaction] = (selectedMessage.reaction_counts[reaction] || 0) + 1;

                selectedMessage.own_reactions.push({type: reaction, score: 1});

                if (scroll) {
                    this.$nextTick(() => {
                        this.scrollMessages(true);
                    });
                }
            }
        },

        toggleMessageReaction({ message, reaction }) {
            let errors = this.currentTab == 'chat' ? this.messageErrors : this.questionErrors;
            let channel = message.category == 'message' ? this.chatChannel : this.questionsChannel;

            if (this.hasOwnReaction(message, reaction)) {
                this.removeOwnReaction({ message, reaction });

                channel
                    .deleteReaction(message.id, reaction)
                    .then(() => {
                        this.messageErrors = [];
                    })
                    .catch(({ response }) => {
                        this.errorHandler(response, 'Message reaction remove error', errors);
                    });
            } else {
                this.addOwnReaction({ message, reaction });

                channel
                    .sendReaction(message.id, { type: reaction })
                    .then(() => {
                        this.messageErrors = [];
                    })
                    .catch(({ response }) => {
                        this.errorHandler(response, 'Message reaction send error', errors);
                    });
            }
        },

        showMessageThread({ message }) {
            this.messageThread = message;
            this.showMembers = false;
            this.showThread = true;

            this.$nextTick(() => {
                this.scrollThreadMessages(true);
            });
        },

        hideMessageThread() {
            this.showThread = false;
            this.messageThread = null;
        },

        pinMessage({ message }) {
            this.streamClient
                .pinMessage({ id: message.id, text: message.text }, null)
                .then(() => {
                    this.messageErrors = [];
                })
                .catch(({ response }) => {
                    this.errorHandler(response, 'Message pin error', this.messageErrors);
                });
        },

        unpinMessage({ message }) {
            this.streamClient
                .unpinMessage({id: message.id, text: message.text }, null)
                .then(() => {
                    this.messageErrors = [];
                })
                .catch(({ response }) => {
                    this.errorHandler(response, 'Message unpin error', this.messageErrors);
                });
        },

        toggleShowPinned() {
            this.showPinned = !this.showPinned;
        },

        toggleChatMenu() {
            this.chatMenu = !this.chatMenu;
            this.showEmoji = false;
        },

        unblockUser({ id }) {
            RailchatService
                .unbanUser(id)
                .then(() => {
                    this.messageErrors = [];
                    this.fetchBannedUsers();
                })
                .catch(({ response }) => {
                    this.railErrorHandler(response, 'User unban error');
                });
        },

        railErrorHandler(response, action, errors) {
            let message = `${action}, please try again, if the error persists contact support.`;

            if (response && response.data?.errors && Array.isArray(response.data.errors)) {
                response.data.errors.forEach(error => {
                    if (error.detail) {
                        message = `${action}: ${error.detail}`;
                    } else {
                        console.log("Chat::railErrorHandler unknown error message format: %s", JSON.stringify(error));
                    }
                });
            } else {
                console.log("Chat::railErrorHandler unknown error response format: %s", JSON.stringify(response));
            }

            errors.push(message);
        },

        insertEmoji(emoji) {
            const textarea = this.$refs.newMessage;
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            textarea.setRangeText(`${emoji.emoji}`, start, end, 'end');
            this.message = textarea.value;
            this.showEmoji = false;
        },

        closeEmojiWindow() {
            this.showEmoji = false;
        },

        setCurrentTab(tab) {
            if (tab == 'chat' || tab == 'questions') {
                this.setScrollState();
                this.scrollingMessages = true;
                this.currentTab = tab;
                this.$nextTick(() => {
                    this.restoreScrollState();
                    this.containerScrolled();
                });
            }
            this.chatMenu = false;
            this.showEmoji = false;
        },

        getTabClasses(tab) {
            let active = ['t-font-semibold', 't-text-white', 't-border-white'];
            let inactive = ['cs-text-gray', 't-border-transparent'];

            return this.currentTab == tab ? active : inactive;
        },

        stripHtml(html) {
            return html
                .replace(/(<([^>]+)>)/gi, '')
                .replace(/[\u200B-\u200D\uFEFF\u200E\u200F]/g, '');
        },
    },
}
</script>

<style>
</style>
