<script setup>
import { ref } from 'vue'
//import { UserIcon } from '@heroicons/vue/solid'
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
            class="tw-relative tw-flex tw-h-[150px] tw-w-[150px] tw-items-center tw-justify-center tw-overflow-hidden tw-rounded-full tw-bg-[#002039]"
            v-on:click="openUploadForm"
        >
            <UserIcon />
            <div
                class="tw-absolute tw-z-0 tw-h-[120px] tw-w-[120px] tw-rounded-full tw-bg-white"
            ></div>
        </button>
        <div class="tw-text-center tw-text-white">UPLOAD PHOTO</div>
    </div>
</template>
