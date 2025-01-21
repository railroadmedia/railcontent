<script setup>
import { ref } from "vue";
import ImageUploader from "@collections/ImageUploader/ImageUploader.vue";
import UserIcon from "./UserIcon.vue";

const showUploadForm = ref(false);
const selectedImage = ref(null);

const props = defineProps({
  imgUrl: {
    type: String,
    default: null,
  },
});

const emit = defineEmits(["onImageUpload", "onError"]);

function openUploadForm() {
  showUploadForm.value = !showUploadForm.value;
  selectedImage.value = null;
}

function handleUploadDone({ profile_picture_url }) {
  emit('onImageUpload', profile_picture_url);
  showUploadForm.value = false;
}

function handleUploadError() {
  emit('onError');
  showUploadForm.value = false;
}
</script>

<template>
  <div class="">
    <ImageUploader
      v-if="showUploadForm"
      :selfContained="true"
      uploadServiceRoute="/user-management-system/picture/upload-from-s3-front-end"
      successMessage="Your profile image has successfully uploaded"
      fieldKey="profile_picture_url"
      cropType="circle"
      @uploadSuccess="handleUploadDone"
      @uploadError="handleUploadError"
      @onUploaderClose="openUploadForm"
    />

    <button v-on:click="openUploadForm"
      class="hover:tw-underline tw-flex tw-flex-col tw-justify-center tw-items-center tw-w-full">
      <div class="
          tw-relative
          tw-flex
          tw-h-[100px]
          tw-w-[100px]
          xl:tw-h-[152px]
          xl:tw-w-[152px]
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
        {{ imgUrl ? 'UPDATE PROFILE PICTURE' : 'UPLOAD PHOTO' }}
      </div>
    </button>
  </div>
</template>
