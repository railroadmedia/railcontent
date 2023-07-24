<template>
    <div class="tw-relative">
        <div
            class="cs-emoji tw-absolute tw-right-0 tw-bottom-0 tw-rounded-md tw-z-150 tw-overflow-hidden dark:tw-bg-[#002138] tw-border dark:tw-border-[#223F57]"
            v-if="showWindow"
        >
            <div class="cs-emoji-tabs tw-flex tw-flex-row tw-items-center tw-justify-between tw-border-b tw-border-gray-800 tw-text-lg">
                <div>
                    <a
                        class="tw-p-3 tw-cursor-pointer"
                        :class="{'tw-text-[#65656B] dark:tw-text-[#9EC0DC]': currentTab != category, 'tw-text-[000C17] dark:tw-text-white': currentTab == category}"
                        v-for="(emojiArray, category) in this.emojiData"
                        :key="category"
                        @click.stop.prevent="setCurrentTab(category)"
                    ><i class="fal" :class="tabIcons[category]"></i></a>
                </div>
                <a
                    class="tw-p-2 tw-text-[000C17] dark:tw-text-white tw-cursor-pointer"
                    @click.stop.prevent="closeEmojiWindow()"
                ><i class="fal fa-backspace"></i></a>
            </div>
            <div class="tw-p-3">
                <input
                    v-model="search"
                    placeholder="Search Emojis"
                    wrap="off"
                    class="tw-resize-none tw-whitespace-nowrap tw-overflow-x-auto tw-rounded-full cs-text-sm tw-w-full tw-py-[9px] tw-px-[13px]"
                >
            </div>
            <div class="tw-px-3 tw-text-white tw-font-semibold">{{ $_current_tab_label }}</div>
            <div class="tw-py-2 tw-overflow-hidden">
                <div class="cs-emoji-list" ref="simplebar">
                    <div class="tw-py-3 tw-px-2 tw-grid tw-grid-cols-8 tw-gap-y-3 tw-text-2xl tw-overflow-auto">
                        <a
                            class="tw-text-center tw-cursor-pointer"
                            v-for="item in $_emoji"
                            :key="item.no"
                            @click.stop.prevent="insertEmoji(item)"
                            :data-item-no="item.no"
                        >{{ item.emoji }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import EmojiData from '../../assets/js/data/emoji.json';
import SimpleBar from 'simplebar';
import 'simplebar/dist/simplebar.min.css';

export default {
    name: 'ChatEmoji',
    props: {
        showWindow: {
            type: Boolean,
            default: () => false,
        },
    },
    data() {
        return {
            emojiData: {},
            tabIcons: {
              "Smileys & People": "fa-smile",
              "Animals & Nature": "fa-leaf",
              "Food & Drink": "fa-hamburger",
              "Travel & Places": "fa-globe",
              "Activities": "fa-football-ball",
              "Objects": "fa-lightbulb",
              "Symbols": "fa-peace",
              "Flags": "fa-flag",
            },
            currentTab: 'Smileys & People',
            search: '',
            simpleBar: null,
        }
    },
    watch: {
        showWindow: function(val) {
            if (val) {
                this.$nextTick(() => {
                    this.simpleBar = new SimpleBar(this.$refs.simplebar, {autoHide: false});
                });
            }
        }
    },
    computed: {
        $_emoji: {
            cache: false,
            get() {
                return this.emojiData[this.currentTab]
                            .filter(item => !this.search ||
                                item.keywords.filter(keyword => keyword.includes(this.search)).length > 0);
            },
        },
        $_current_tab_label: {
            cache: false,
            get() {
                return this.currentTab;
            },
        },
    },
    mounted() {
        this.emojiData = EmojiData;
    },

  methods: {
        setCurrentTab(tab) {
            this.currentTab = tab;
            this.$nextTick(() => {
                this.simpleBar.recalculate();
            });
        },

        insertEmoji(emoji) {
            this.eventBus.emit('insertEmoji', emoji);
        },

        closeEmojiWindow() {
            this.search = '';
            this.eventBus.emit('closeEmojiWindow', { });
        },
    }
}
</script>
