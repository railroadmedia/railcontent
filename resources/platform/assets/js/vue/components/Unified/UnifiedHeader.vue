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
    <div class="tw-w-full lg:tw-container lg:tw-px-[50px]">
        <div 
            class="tw-w-full tw-h-full tw-flex tw-items-center tw-justify-center">
            <div
                class="tw-w-full tw-h-full tw-flex tw-items-end tw-justify-between tw-pb-[20px]">
                <div class="tw-h-full tw-flex tw-flex-col tw-justify-between">
                    <slot name="left-content"></slot>
                </div>
                <div class="tw-h-full tw-flex tw-flex-col tw-justify-end tw-text-white tw-text-center tw-uppercase tw-text-[18px] tw-font-bold">
                    <slot name="right-content"></slot>
                </div>
            </div>
        </div>
        <hr class="tw-border-t-[1px] dark:tw-border-[#223F57] tw-border-[#65656B4D]" />
    </div>
</template>
