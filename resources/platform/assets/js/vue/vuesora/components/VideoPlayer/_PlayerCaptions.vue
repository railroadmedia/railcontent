<template>
    <div class="settings-drawer captions bg-grey-5 tw-text-white tw-shadow overflow">
        <div class="tw-flex tw-flex-col">
            <div class="tw-flex tw-flex-row">
                <div class="tw-flex tw-flex-col">
                    <ul class="tw-list-none body tw-text-right dense tw-font-bold">
                        <li
                            v-for="caption in captionOptions"
                            :key="caption.language"
                            class="pa-1 hover-bg-grey-4 tw-pointer tw-relative"
                            :class="[{ 'selected-caption': isSelected(caption) }, isSelected(caption) ? themeTextClass : '']"
                            @click="selectCaptionHandler(caption)"
                        >
                            {{ caption.label }}
                        </li>
                        <li
                            class="pa-1 hover-bg-grey-4 tw-pointer tw-relative"
                            :class="isOff ? [themeTextClass, 'selected-caption'] : ''"
                            @click="selectCaptionHandler(null)"
                        >
                            Off
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
    name: 'PlayerCaptions',
    mixins: [ThemeClasses],
    props: {
        themeColor: {
            type: String,
            default: () => 'drumeo',
        },

        captionOptions: {
            type: Array,
            default: () => [],
        },

        currentCaptions: {
            type: String,
            default: () => null,
        },

        isCaptionsEnabled: {
            type: Boolean,
            default: () => null,
        },
    },

    computed: {
        isOff() {
            return !this.isCaptionsEnabled;
        },
    },

    methods: {
        isSelected(caption) {
            return caption.mode === 'showing';
        },

        selectCaptionHandler(caption) {
            this.$emit('captionsSelected', caption);
        },
    },
};
</script>
