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
    <div class="tw-h-[360px] tw-w-[480px]">
        <ImageUploader />
    </div>
</template>
