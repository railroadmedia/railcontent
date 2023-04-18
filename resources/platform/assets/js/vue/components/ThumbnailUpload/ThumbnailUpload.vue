<script setup>
import { ref, onMounted } from "vue";
import { XCircleIcon } from '@heroicons/vue/outline';
import ImageDropzone from "../ImageDropzone/ImageDropzone.vue";
import ImageCropper from "../ImageCropper/ImageCropper.vue";
import PlaylistThumbnail from "../Playlists/PlaylistThumbnail.vue"
import ImageUploadProgress from "../ImageUploadProgress/ImageUploadProgress.vue";
import InfoModal from "../Modal/InfoModal.vue";

// TODO: Pass file service, and field key as a parameter to the image upload progress component
// TODO: Refactor the cropper to have a squared stencil


//emits
const emit = defineEmits(['imageUploaded']);

const title = {
    dropzone: "Upload Image",
    crop: "Crop Your Thumbnail",
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
    type: {
        type: String,
        default: null
    },
    userId: {
        type: String,
        default: null
    },
    fileServiceRoute: {
        type: String,
        default: null
    },
    token: {
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

function handleUploadDone({ thumbnail_url }) {
    imgUrlRef.value = thumbnail_url;
    showUploadForm.value = false;
    emit('imageUploaded', imgUrlRef.value)
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
            <ImageCropper v-if="uploadStep === 'crop'" @onCrop="handleCrop" :selectedImage="selectedImage" type="squared" />
            <ImageUploadProgress successMessage="Thumbnail uploaded" fieldKey="playlist_thumbnail" :token="token" uploadService="/railcontent/upload-playlist-thumb" v-if="uploadStep === 'upload'" :image="croppedImage" :userId="userId"
                @onUploadDone="handleUploadDone" @onUploadError="handleUploadError" />
        </InfoModal>

        <div class="hover:tw-underline tw-flex tw-flex-col lg:tw-pr-[42px] tw-w-[200px] tw-shrink-0 tw-mx-auto tw-items-center sm:tw-items-start">
            <button v-on:click="openUploadForm" :class="type === 'playlist' ? 'tw-w-[158px] tw-h-[158px] tw-rounded-lg tw-overflow-hidden' : '' ">

                <!-- Image Conatiner -->
                <template v-if="type==='playlist'">
                    <div v-if="imgUrlRef" class="tw-relative tw-w-full tw-h-full tw-aspect-square">
                        <img
                            :src="`https://musora.com/cdn-cgi/image/width=200/${imgUrlRef}`"
                            alt="playlist thumbnail"
                            class="tw-transition-opacity tw-opacity-0 tw-duration-500 tw-object-cover tw-object-center tw-w-full tw-h-full tw-blur-sm"
                            loading="lazy"
                            onload="this.classList.remove('tw-opacity-0')"
                        />
                        <!-- Image Mask -->
                        <div class="tw-z-10 tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-bg-black/70 tw-flex tw-justify-center">
                            <img class="tw-h-full tw-object-contain" :src="`https://musora.com/cdn-cgi/image/width=200/${imgUrlRef}`" alt="playlist thumbnail">
                        </div>
                    </div>

                    <!-- placeholder (no image or items) -->
                    <div v-else class="tw-transition tw-flex tw-items-center tw-justify-center tw-w-full tw-h-full tw-bg-[#3F3F46] dark:tw-bg-[#445F74]">
                        <musora-icon icon-name="playlist" class="tw-w-1/2 tw-h-1/2 tw-text-white" />
                    </div>
                </template>

                <!-- Playlist thumbnail -->
                <PlaylistThumbnail
                    v-if="type==='playlist'"
                    :img="imgUrlRef"
                    :brand="brand"
                />

                <img v-else class="tw-w-[158px] tw-h-[158px] tw-rounded-[9px]"
                    :src="`${imgUrlRef ? imgUrlRef : 'https://placehold.jp/158x158.png'}`"
                />
            </button>
            <div class="tw-flex tw-flex-row tw-pt-[12px] tw-justify-center tw-items-center tw-mb-7 sm:tw-mb-0 tw-w-full">
                <button v-on:click="openUploadForm" class="tw-underline tw-text-[#0D0D0D] dark:tw-text-[#7E9AB1] tw-italic tw-text-[13px]">
                    <span v-if="!(imgUrlRef && imgUrlRef.length)">Upload Playlist Image</span>
                    <span v-if="(imgUrlRef && imgUrlRef.length)">Re-upload the image</span>
                </button>
            </div>
        </div>

    </div>
</template>
