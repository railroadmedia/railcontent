<script setup>
import { ref } from "vue";
import ImageDropzone from "../ImageDropzone/ImageDropzone.vue";
import ImageCropper from "../ImageCropper/ImageCropper.vue";
import ImageUploadProgress from "../ImageUploadProgress/ImageUploadProgress.vue";
import InfoModal from "../Modal/InfoModal.vue";
import UserIcon from "./UserIcon.vue";

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
  userName: {
    type: String,
    default: null
  },
  userId: {
    type: Number,
    default: null
  }
});

const emit = defineEmits(["onImageUpload"]);

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

function handleUploadDone({ profile_picture_url }) {
  emit('onImageUpload', profile_picture_url);
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
    <InfoModal :self-contained="true" key="info-modal-in-avatar-upload" v-if="showUploadForm" modalId="upload-modal" @onClose="openUploadForm" :title="title[uploadStep]" classOverride="tw-border-[#223F57] tw-border-[1px] tw-bg-white dark:tw-bg-[#081825] md:tw-max-w-xl xl:tw-max-w-2xl">
      <ImageDropzone v-if="uploadStep === 'dropzone'" @onImageSelected="handleImage" />
      <ImageCropper v-if="uploadStep === 'crop'" @onCrop="handleCrop" :selectedImage="selectedImage" />
      <ImageUploadProgress successMessage="Your profile image has successfully uploaded" fieldKey="profile_picture_url" uploadService="/user-management-system/picture/upload-from-s3-front-end" v-if="uploadStep === 'upload'" :image="croppedImage" :userId="userId"
        @onUploadDone="handleUploadDone" @onUploadError="handleUploadError" />
    </InfoModal>

    <button v-on:click="openUploadForm"
      class="hover:tw-underline tw-flex tw-flex-col tw-justify-center tw-items-center tw-w-full">
      <div class="
          tw-relative
          tw-flex
          tw-h-[100px]
          tw-w-[100px]
          xl:tw-h-[150px]
          xl:tw-w-[150px]
          tw-items-center
          tw-justify-center
          tw-overflow-hidden
          tw-rounded-full
          tw-bg-[#002039]
          tw-cursor-pointer
          tw-border-[#344858]
          hover:tw-border-white
          tw-border-2
          tw-color-[#344858]
        " :style="{ ...imgUrl ? { backgroundImage: `url(${imgUrl})`, backgroundSize: 'cover' } : {} }">
        <UserIcon v-if="!imgUrl" />
        <div class="
            tw-absolute
            tw-z-0
            tw-h-[120px]
            tw-w-[120px]
            tw-rounded-full
          "></div>
      </div>
      <div class="tw-text-center tw-text-white tw-font-bebas-neue tw-uppercase tw-mt-[7px]"
        style="text-decoration: inherit;">
        {{ imgUrlRef ? 'UPDATE PROFILE PICTURE' : 'UPLOAD PHOTO' }}
      </div>
    </button>
  </div>
</template>
