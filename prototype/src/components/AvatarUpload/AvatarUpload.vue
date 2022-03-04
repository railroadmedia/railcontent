<script setup>
import { ref } from 'vue'
import ImageUploader from '../ImageUploader/ImageUploader.vue'
import UserIcon from './UserIcon.vue'

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
function openUploadForm() {
    alert('display form and upload pic')
}
</script>

<template>
    <div class="">
        <button
            class="tw-flex tw-h-[150px] tw-w-[150px] tw-items-center tw-justify-center tw-overflow-hidden tw-rounded-full tw-bg-white"
            v-on:click="openUploadForm"
        >
            <UserIcon />
        </button>
    </div>
</template>
