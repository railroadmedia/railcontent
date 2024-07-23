<script setup>
import { ref, onMounted } from 'vue';
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/solid';
import DrumsSvg from './DrumsVueSvg.vue'
import GuitarSvg from './GuitarVueSvg.vue'
import MicSvg from './MicVueSvg.vue'
import PianoSvg from './PianoVueSvg.vue'

const emit = defineEmits(['onNextSlide, onPrevSlide']);

const props = defineProps({
    brand: {
        type: String,
    },
    attributes: {
        type: Array,
        default: []
    },
    img_src: {
        type: String,
    },
    title: {
        type: String,
    },
    isCurrentSlide: {
        type: Boolean,
        default: false,
    }
});
</script>

<template>
    <div :style="{ ...isCurrentSlide ? {} : { width: '0 !important', padding: '0 !important', margin: '0 !important', border: '0 !important' } }"
        class="tw-flex tw-flex-col tw-rounded-[8px] tw-border-[1px] tw-border-[#223F57] tw-bg-[#223F57]/10 tw-w-full xl:tw-max-w-[665px] tw-p-[32px] tw-shrink-0 tw-overflow-hidden">
        <div class="tw-flex tw-text-[#00101D] dark:tw-text-white tw-justify-between tw-items-center">
            <button @click="emit('onPrevSlide')" class="tw-cursor-pointer">
                <ChevronLeftIcon class=" tw-text-[#00101D] dark:tw-text-[#9EC0DC] tw-h-[32px]" />
            </button>
            <h2 class="tw-text-[16px] tw-font-bold">{{ title }}</h2>
            <button @click="emit('onNextSlide')" class="tw-cursor-pointer">
                <ChevronRightIcon class=" tw-text-[#00101D] dark:tw-text-[#9EC0DC] tw-h-[32px]" />
            </button>
        </div>
        <div class="tw-w-full tw-py-[24px]">
            <img v-if="img_src && img_src.length" class="tw-w-full tw-h-auto tw-object-cover" :src="img_src" />
            <div v-if="!img_src || !img_src.length"
                class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-w-full tw-bg-[#002039] tw-aspect-[16/9] tw-relative">
                <DrumsSvg v-if="brand === 'drumeo'" />
                <GuitarSvg v-if="brand === 'guitareo'" />
                <PianoSvg v-if="brand === 'pianote'" />
                <MicSvg v-if="brand === 'singeo'" />
                <div class="tw-pt-[24px] tw-italic tw-text-[#9EC0DC] tw-text-[16px]">No Gear Photo Added</div>
            </div>
        </div>
        <div v-for="{ label, value } in attributes" class="tw-grid tw-grid-cols-2 tw-text-[#00101D] dark:tw-text-[#9EC0DC]">
            <div>{{ label }}:</div>
            <div>{{ value }}</div>
        </div>
    </div>
</template>
