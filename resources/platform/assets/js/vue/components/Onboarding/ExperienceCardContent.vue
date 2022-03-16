<script setup>
import MusicIcon from './MusicIcon.vue'
defineProps(['title', 'subtitle', 'color'])
const colorMap = {
    red: '#EF4444',
    blue: '#3B82F6',
    yellow: '#EAB308',
    green: '#22C55E'
}
</script>

<template>
    <div
        :class="`tw-flex tw-h-full tw-w-full tw-flex-col tw-items-center tw-justify-center tw-px-[30px] tw-text-white`"
    >
        <MusicIcon classOverride="tw-mb-[12px]" :color="colorMap[color]" />
        <div
            class="tw-text-[32px] tw-leading-[40px]"
            style="font-family: Bebas Neue; font-weight: 700"
        >
            {{ title }}
        </div>
        <div
            class="tw-mt-[10px] tw-flex tw-flex-row tw-items-center tw-justify-center"
            style="
                font-family: Open Sans;
                font-weight: 400;
                line-height: 21px;
                font-size: 14px;
            "
        >
            {{ subtitle }}
        </div>
    </div>
</template>
