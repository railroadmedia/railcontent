<template>
    <div class="tw-relative">
        <div
            class="cs-emoji tw-absolute tw-right-0 tw-bottom-4 tw-rounded-md"
            v-if="showWindow"
        >
            <div class="cs-emoji-tabs tw-flex tw-flex-row tw-items-center tw-justify-between tw-border-b tw-border-gray-800 tw-text-lg">
                <div>
                    <a
                        class="tw-p-3 tw-cursor-pointer"
                        :class="{'cs-text-gray': currentTab != category, 'cs-text-blue': currentTab == category}"
                        v-for="(emojiArray, category) in this.emojiData"
                        :key="category"
                        @click.stop.prevent="setCurrentTab(category)"
                    ><i class="fal" :class="tabIcons[category]"></i></a>
                </div>
                <a
                    class="tw-p-2 cs-text-gray tw-cursor-pointer"
                    @click.stop.prevent="closeEmojiWindow()"
                ><i class="fal fa-backspace"></i></a>
            </div>
            <div class="tw-p-3">
                <textarea
                    v-model="search"
                    placeholder="Search Emojis"
                    wrap="off"
                    rows="1"
                    class="tw-resize-none tw-whitespace-nowrap tw-overflow-x-auto tw-rounded-full cs-text-sm"
                ></textarea>
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
            this.$root.$emit('insertEmoji', emoji);
        },

        closeEmojiWindow() {
            this.search = '';
            this.$root.$emit('closeEmojiWindow', { });
        },
    }
}
</script>
