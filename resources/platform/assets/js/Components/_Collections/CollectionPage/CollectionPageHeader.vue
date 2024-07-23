<script setup>
import { onBeforeMount, onMounted, onUpdated, watch, inject, reactive, computed } from 'vue';
import { ArrowLeftIcon } from '@heroicons/vue/solid';

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
                    <div class="tw-bg-[#00101D]/50 tw-rounded-full tw-h-[28px] tw-w-[28px]">
                        <a class="tw-w-full tw-h-full tw-flex tw-items-center tw-justify-center" :href="backUrl">
                            <ArrowLeftIcon class="tw-w-[14px] tw-h-[14px] tw-text-white" />
                        </a>
                    </div>
                    <div class="tw-flex tw-flex-col tw-text-white">
                        <h2 class="tw-pb-[10px] tw-text-[32px] tw-font-bold">{{ headerTitle }}</h2>
                        <div class="tw-text-[14px] tw-font-bold tw-leading-none">{{ headerSubtitle }}</div>
                    </div>
                </div>
                <div class="tw-text-white tw-text-center tw-uppercase tw-text-2xl tw-font-bold">
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>
