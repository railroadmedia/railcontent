<script setup>
import { ref } from "vue";
import { XCircleIcon } from '@heroicons/vue/outline'
import ImageDropzone from "../ImageDropzone/ImageDropzone.vue";
import ImageCropper from "../ImageCropper/ImageCropper.vue";
import ImageUploadProgress from "../ImageUploadProgress/ImageUploadProgress.vue";
import InfoModal from "../Modal/InfoModal.vue";

// TODO: Pass file service, and field key as a parameter to the image upload progress component
// TODO: Refactor the cropper to have a squared stencil

const title = {
    dropzone: "Upload Image",
    crop: "Crop your Avatar",
    upload: "",
};

const showUploadForm = ref(false);
const uploadStep = ref("dropzone");
const selectedImage = ref(null);
const croppedImage = ref(null);

const props = defineProps({
    brand: {
        type: String,
        default: "drumeo",
    },
    imgUrl: {
        type: String,
        default: null,
    },
    userId: {
        type: String,
        default: null
    },
    fileServiceRoute: {
        type: String,
        default: null  
    }
});

const imgUrlRef = ref(props.imgUrl);

function handleImage(image) {
    selectedImage.value = image;
    uploadStep.value = "crop";
}

function handleCrop(image) {
    croppedImage.value = image;
    uploadStep.value = "upload";
}

function openUploadForm() {
    showUploadForm.value = !showUploadForm.value;
    selectedImage.value = null;
    uploadStep.value = "dropzone";
}

function handleUploadDone(imgUrl) {
    imgUrlRef.value = imgUrl;
    showUploadForm.value = false;
}

function handleUploadError() {
    window.shownotification({
        icon: 'error',
        text: 'There was an error uploading this image, please try again later.'
    });
    showUploadForm.value = false;
}
</script>

<template>
    <div class="">
        <InfoModal v-if="showUploadForm" modalId="upload-modal" @onClose="openUploadForm" :title="title[uploadStep]"
            classOverride="tw-border-[#223F57] tw-border-[1px] tw-bg-white dark:tw-bg-[#081825] md:tw-max-w-xl xl:tw-max-w-2xl">
            <ImageDropzone v-if="uploadStep === 'dropzone'" @onImageSelected="handleImage" />
            <ImageCropper v-if="uploadStep === 'crop'" @onCrop="handleCrop" :selectedImage="selectedImage" />
            <ImageUploadProgress v-if="uploadStep === 'upload'" :image="croppedImage" :userId="userId"
                @onUploadDone="handleUploadDone" @onUploadError="handleUploadError" />
        </InfoModal>

        <div class="hover:tw-underline tw-flex tw-flex-col lg:tw-pr-[42px] tw-w-[200px] tw-shrink-0">
            <button v-on:click="openUploadForm">
                <img class="tw-w-[158px] tw-h-[158px] tw-rounded-[9px]"
                    :src="`${imgUrl ? imgUrl : 'https://placehold.jp/158x158.png'}`" />
            </button>
            <div class="tw-flex tw-pt-[12px] tw-justify-center tw-items-center">
                <button v-on:click="openUploadForm" class="tw-underline tw-text-[#7E9AB1] tw-italic tw-text-[13px]">
                    <span v-if="!(imgUrl && imgUrl.length)">Upload Playlist Image</span>
                    <span v-if="(imgUrl && imgUrl.length)">Change Image</span>
                </button>
                <button v-if="(imgUrl && imgUrl.length)" class="tw-ml-[3px]">
                    <XCircleIcon class="tw-text-[#7E9AB1] tw-w-[14px] tw-h-[14px]" />
                </button>
            </div>
        </div>
    </div>
</template>
