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
  userName : {
    type: String,
    default: null
  },
  userId: {
    type: String,
    default: null
  }
});

const emit = defineEmits(['onError'])

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
  emit('onError');
  showUploadForm.value = false;
}
</script>

<template>
  <div class="">
    <InfoModal
      v-if="showUploadForm"
      modalId="upload-modal"
      @onClose="openUploadForm"
      :title="title[uploadStep]"
    >
      <ImageDropzone
        v-if="uploadStep === 'dropzone'"
        @onImageSelected="handleImage"
      />
      <ImageCropper
        v-if="uploadStep === 'crop'"
        @onCrop="handleCrop"
        :selectedImage="selectedImage"
      />
      <ImageUploadProgress
        v-if="uploadStep === 'upload'"
        :image="croppedImage"
        :userId="userId"
        @onUploadDone="handleUploadDone"
        @onUploadError="handleUploadError"
      />
    </InfoModal>

    <button v-on:click="openUploadForm" class="hover:tw-underline">
      <div
        class="
          tw-relative
          tw-flex
          tw-h-[150px]
          tw-w-[150px]
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
        "
        :style="{ ...imgUrlRef ? { backgroundImage: `url(${imgUrlRef})`, backgroundSize: 'cover' } : {} }"
      >
        <UserIcon v-if="!imgUrlRef" />
        <div
          class="
            tw-absolute
            tw-z-0
            tw-h-[120px]
            tw-w-[120px]
            tw-rounded-full
          "
        ></div>
      </div>
      <div class="tw-text-center tw-text-white tw-font-bebas-neue tw-uppercase tw-mt-[7px]" style="text-decoration: inherit;">
        {{ imgUrlRef ? 'UPDATE PROFILE PICTURE' : 'UPLOAD PHOTO' }}
      </div>
    </button>
  </div>
</template>
