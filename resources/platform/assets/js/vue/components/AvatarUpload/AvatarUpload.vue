<script setup>
import { ref } from 'vue'
import ImageDropzone from '../ImageDropzone/ImageDropzone.vue'
import ImageCropper from '../ImageCropper/ImageCropper.vue'
import InfoModal from '../Modal/InfoModal.vue'
import UserIcon from './UserIcon.vue'

const title = {
    dropzone: 'Upload Image',
    crop: 'Crop your Avatar',
    upload: ''
};

const showUploadForm = ref(false)
const uploadStep = ref('dropzone')
const selectedImage = ref(null)
const croppedImage = ref(null)

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

function handleCrop(image) {
    croppedImage.value = image;
    uploadStep.value = 'upload';
}

function openUploadForm() {
    showUploadForm.value = !showUploadForm.value
    selectedImage.value = null;
    uploadStep.value = 'dropzone'
}
</script>

<template>
    <div class="">
        <InfoModal v-if="showUploadForm" modalId="upload-modal" @onClose="openUploadForm" :title="title[uploadStep]">
            <ImageDropzone v-if="uploadStep === 'dropzone'" @onImageSelected="handleImage" />
            <ImageCropper
                v-if="uploadStep === 'crop'"
                @onCrop="handleCrop"
                :selectedImage="selectedImage"
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
