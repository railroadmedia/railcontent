<script setup>
import { ref } from 'vue'
//import { UserIcon } from '@heroicons/vue/solid'
import ImageDropzone from '../ImageDropzone/ImageDropzone.vue'
import ImageUploader from '../ImageUploader/ImageUploader.vue'
import InfoModal from '../Modal/InfoModal.vue'
import UserIcon from './UserIcon.vue'
import { Cropper } from 'vue-advanced-cropper'
import 'vue-advanced-cropper/dist/style.css'

import Stencil from './Stencil.vue'

const title = {
    dropzone: 'Upload Image',
    crop: 'Crop your Avatar'
};

const showUploadForm = ref(false)
const uploadStep = ref('dropzone')
const selectedImage = ref(null)

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

function handleImage(image) {
    selectedImage.value = image;
    uploadStep.value = "crop"
}

function openUploadForm() {
    showUploadForm.value = !showUploadForm.value
}
</script>

<template>
    <div class="">
        <InfoModal v-if="showUploadForm" modalId="upload-modal" @onClose="openUploadForm" :title="title[uploadStep]">
            <ImageDropzone v-if="uploadStep === 'dropzone'" @onImageSelected="handleImage" />
            <Cropper
                v-if="uploadStep === 'crop'"
                ref="cropper"
                class="upload-example-cropper"
                :src="selectedImage"
                :stencil-component="Stencil"
            />
        </InfoModal>
        <button
            class="tw-relative tw-flex tw-h-[150px] tw-w-[150px] tw-items-center tw-justify-center tw-overflow-hidden tw-rounded-full tw-bg-[#002039]"
            v-on:click="openUploadForm"
        >
            <UserIcon />
            <div
                class="tw-absolute tw-z-0 tw-h-[120px] tw-w-[120px] tw-rounded-full tw-bg-white"
            ></div>
        </button>
        <div
            style="font-family: Bebas Neue"
            class="tw-text-center tw-text-white"
        >
            UPLOAD PHOTO
        </div>
    </div>
</template>
