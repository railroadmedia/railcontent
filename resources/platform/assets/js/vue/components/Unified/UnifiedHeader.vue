<script setup>
import { onBeforeMount, onMounted, onUpdated, watch, inject, reactive, computed } from 'vue';

//Inject
const token = inject('csrf_token');

//-----------Props-----------//
const props = defineProps({
    brand: {
        type: String,
        default: "drumeo"
    },
    headerBackground: {
        type: String,
        default: "https://picsum.photos/1664/180"
    },
    headerTitle: {
        type: String,
        default: 'Pink Floyd'
    },
    headerSubtitle: {
        type: String,
        default: '27 songs | 23,012 Plays'
    },
    backUrl: {
        type: String,
        default: '#'
    }
})

</script>
<template>
    <div class="tw-h-[180px] tw-w-full" :style="`background-image: url(${headerBackground});`">
        <div
            class="tw-w-full tw-h-full tw-bg-black/20 tw-flex tw-items-center tw-justify-center">
            <div
                class="tw-w-full tw-h-full tw-bg-gradient-to-b tw-from-transparent tw-to-[#00101D] tw-flex tw-items-center tw-justify-between tw-px-[48px] tw-py-[20px]">
                <div class="tw-h-full tw-flex tw-flex-col tw-justify-between">
                    <slot name="left-content"></slot>
                </div>
                <div class="tw-h-full tw-flex tw-flex-col tw-justify-end tw-text-white tw-text-center tw-uppercase tw-text-[18px] tw-font-bold">
                    <slot name="right-content"></slot>
                </div>
            </div>
        </div>
    </div>
</template>
