<template>
    <div class="t-relative">
        <div
            class="cs-emoji t-absolute t-right-0 t-bottom-4 t-rounded-md"
            v-if="showWindow"
        >
            <div class="cs-emoji-tabs t-flex t-flex-row t-items-center t-justify-between t-border-b t-border-gray-800 t-text-lg">
                <div>
                    <a
                        class="t-p-3 t-cursor-pointer"
                        :class="{'cs-text-gray': currentTab != category, 'cs-text-blue': currentTab == category}"
                        v-for="(emojiArray, category) in this.emojiData"
                        :key="category"
                        @click.stop.prevent="setCurrentTab(category)"
                    ><i class="fal" :class="tabIcons[category]"></i></a>
                </div>
                <a
                    class="t-p-2 cs-text-gray t-cursor-pointer"
                    @click.stop.prevent="closeEmojiWindow()"
                ><i class="fal fa-backspace"></i></a>
            </div>
            <div class="t-p-3">
                <textarea
                    v-model="search"
                    placeholder="Search Emojis"
                    wrap="off"
                    rows="1"
                    class="t-resize-none t-whitespace-nowrap t-overflow-x-auto t-rounded-full cs-text-sm"
                ></textarea>
            </div>
            <div class="t-px-3 t-text-white t-font-semibold">{{ $_current_tab_label }}</div>
            <div class="t-py-2 t-overflow-hidden">
                <div class="cs-emoji-list" ref="simplebar">
                    <div class="t-py-3 t-px-2 t-grid t-grid-cols-8 t-gap-y-3 t-text-2xl t-overflow-auto">
                        <a
                            class="t-text-center t-cursor-pointer"
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
