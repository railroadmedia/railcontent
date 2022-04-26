<template>
    <div class="settings-drawer bg-grey-5 tw-text-white tw-shadow overflow">
        <div class="tw-flex tw-flex-col">
            <div
                class="tw-flex tw-flex-row pa hover-bg-grey-4 bb-grey-4-1 tw-pointer noselect"
                :class="isSingleSource ? 'bg-grey-4' : ''"
                @click.stop="toggleQualities"
            >
                <div class="tw-flex tw-flex-col">
                    <p class="body dense tw-font-bold">
                        Quality:
                    </p>
                </div>
                <div class="tw-flex tw-flex-col tw-justify-center">
                    <p
                        class="tiny dense tw-font-bold tw-text-right"
                        :class="themeTextClass"
                    >
                        {{ currentSourceLabel }}
                        <i
                            class="fas tw-ml-1"
                            :class="qualitiesDropdown ? 'fa-caret-down' : 'fa-caret-up'"
                        ></i>
                    </p>
                </div>
            </div>

            <div
                v-show="qualitiesDropdown"
                class="tw-flex tw-flex-row bb-grey-4-1"
            >
                <div class="tw-flex tw-flex-col">
                    <ul class="tw-list-none tiny tw-text-right dense tw-font-bold">
                        <li
                            v-for="quality in playbackQualities"
                            :key="quality.label"
                            class="pa-1 hover-bg-grey-4 tw-pointer"
                            :class="quality.file === currentSource ? themeTextClass : ''"
                            @click="setQuality(quality)"
                        >
                            {{ quality.label }}
                        </li>

<!--                        <li-->
<!--                            class="pa-1 hover-bg-grey-4 pointer"-->
<!--                            :class="[isAbrEnabled ? themeTextClass : '']"-->
<!--                            @click="setQuality('auto')"-->
<!--                        >-->
<!--                            Auto-->
<!--                        </li>-->
                    </ul>
                </div>
            </div>

            <div
                class="tw-flex tw-flex-row pa hover-bg-grey-4 tw-pointer noselect"
                @click.stop="toggleRates"
            >
                <div class="tw-flex tw-flex-col">
                    <p class="body dense tw-font-bold">
                        Playback Rate:
                    </p>
                </div>
                <div class="tw-flex tw-flex-col tw-justify-center">
                    <p
                        class="tiny dense tw-font-bold tw-text-right"
                        :class="themeTextClass"
                    >
                        {{ currentPlaybackRate }}x
                        <i
                            class="fas tw-ml-1"
                            :class="ratesDropdown ? 'fa-caret-down' : 'fa-caret-up'"
                        ></i>
                    </p>
                </div>
            </div>

            <div
                v-show="ratesDropdown"
                class="tw-flex tw-flex-row bt-grey-4-1"
            >
                <div class="tw-flex tw-flex-col tw-justify-center">
                    <ul class="tw-list-none tiny tw-text-right dense tw-font-bold">
                        <li
                            v-for="rate in playbackRates"
                            :key="`playbackRate-${rate}`"
                            class="pa-1 hover-bg-grey-4 tw-pointer"
                            :class="rate === currentPlaybackRate ? themeTextClass : ''"
                            @click="setRate(rate)"
                        >
                            {{ rate }}x
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import ThemeClasses from '../../mixins/ThemeClasses';

export default {
    name: 'PlayerSettings',
    mixins: [ThemeClasses],
    props: {
        videojsInstance: {
            type: Object,
            default: null,
        },

        currentSource: {
            type: String,
            default: () => '',
        },

        currentPlaybackRate: {
            type: Number,
            default: () => 1,
        },

        playbackQualities: {
            type: Array,
            default: () => [],
        },

        isAbrEnabled: {
            type: Boolean,
            default: () => false,
        },

        drawer: {
            type: Boolean,
            default: () => false,
        },
    },
    data() {
        return {
            qualitiesDropdown: false,
            ratesDropdown: false,
            playbackRates: [0.5, 0.75, 1, 1.25, 1.5, 1.75, 2],
        };
    },
    computed: {
        currentSourceLabel() {
            const currentQuality = this.playbackQualities.find(quality => quality.file === this.currentSource);

            if (this.isAbrEnabled) {
                if (!this.isSingleSource) {
                    return currentQuality ? `Auto (${currentQuality.label})` : 'Auto';
                }

                return 'Auto';
            }

            if (currentQuality) {
                return currentQuality.label;
            }

            return 'Auto';
        },

        isSingleSource() {
            return this.playbackQualities.length <= 1;
        },
    },
    watch: {
        drawer() {
            this.qualitiesDropdown = false;
            this.ratesDropdown = false;
        },
    },
    mounted() {
        document.addEventListener('click', this.closeDrawer);

        this.$parent.$on('userinactive', this.closeDrawer);
    },
    beforeDestroy() {
        document.removeEventListener('click', this.closeDrawer);
    },
    methods: {
        toggleQualities() {
            if (this.isSingleSource) {
                return;
            }

            this.qualitiesDropdown = !this.qualitiesDropdown;
            this.ratesDropdown = false;
        },

        toggleRates() {
            this.qualitiesDropdown = false;
            this.ratesDropdown = !this.ratesDropdown;
        },

        setQuality(quality) {
            this.$emit('setQuality', quality);
        },

        setRate(rate) {
            this.$emit('setRate', { rate });
        },
    },
};
</script>
