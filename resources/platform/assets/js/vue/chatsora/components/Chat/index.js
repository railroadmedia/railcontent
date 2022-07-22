import Vue from 'vue';
import Chat from './Chat';
import ChatPopup from './ChatPopup';

export default {
    install(Vue, options) {
        Vue.component(
            Chat.name,
            Chat
        );
        Vue.component(
            ChatPopup.name,
            ChatPopup
        );
    },
};
