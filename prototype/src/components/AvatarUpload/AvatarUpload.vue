<script setup>
import { ref } from 'vue'
import ImageUploader from '../ImageUploader/ImageUploader.vue'

const props = defineProps({
    brand: {
        type: String,
        default: 'drumeo'
    },
    imgUrl: {
        type: String,
        default: null
    }
})
</script>

<template>
    <div class="">
        <div
            class="tw-flex tw-h-[150px] tw-w-[150px] tw-items-center tw-justify-center tw-rounded-full tw-border-[2px] tw-border-[#344858] tw-bg-[#002039]"
        >
            T
        </div>
    </div>
</template>
