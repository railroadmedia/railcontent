<script setup>
import { ref } from 'vue';
import ImageDropzone from '../ImageDropzone/ImageDropzone.vue';
import ImageCropper from '../ImageCropper/ImageCropper.vue';
import ImageUploadProgress from '../ImageUploadProgress/ImageUploadProgress.vue';
import InfoModal from '../Modal/InfoModal.vue';

const props = defineProps({
  modalTitle : {
    type: String, 
    default: 'Upload Image'
  },
  uploadServiceRoute: {
    type: String,
    required: true,
  },
  successMessage: {
    type: String,
    default: 'Your image was successfully uploaded',
  },
  fieldKey: {
    type: String,
    required: true,
  },
  cropType: {
    type: String,
    default: 'square',
  }, // 'circle' for avatars, 'square' for thumbnails
  selfContained: {
    type: Boolean,
    default: false,
  },
  initialStep: {
    type: String,
    default: 'dropzone',
  },
  selectedImage: {
    type: String,
    default: null,
  },
  skipCrop: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits(['uploadSuccess', 'uploadError', 'onUploaderClose']);

const title = {
  dropzone: props.modalTitle,
  crop: `Crop your ${props.cropType === 'circle' ? 'Avatar' : 'Image'}`,
  upload: '',
};

const uploadStep = ref(props.initialStep);
const selectedImage = ref(props.selectedImage);
const croppedImage = ref(props.selectedImage);

function handleImage(image) {
  if (props.skipCrop) {
    croppedImage.value = image;
    uploadStep.value = 'upload';
  } else {
    selectedImage.value = image;
    uploadStep.value = 'crop';
  }
}

function handleCrop(image) {
  croppedImage.value = image;
  uploadStep.value = 'upload';
}

function handleUploadDone(response) {
  emit('uploadSuccess', response);
}

function handleUploadError() {
  emit('uploadError');
}
</script>

<template>
  <div>
    <InfoModal :selfContained="selfContained" modalId="upload-modal" @onClose="emit('onUploaderClose')"
      :title="title[uploadStep]"
      classOverride="tw-border-[#223F57] tw-border-[1px] tw-bg-white dark:tw-bg-[#081825] md:tw-max-w-xl xl:tw-max-w-2xl">
      <ImageDropzone v-if="uploadStep === 'dropzone'" @onImageSelected="handleImage" />
      <ImageCropper v-if="uploadStep === 'crop'" @onCrop="handleCrop" :selectedImage="selectedImage" :type="cropType" />
      <ImageUploadProgress 
        v-if="uploadStep === 'upload'" 
        :successMessage="successMessage" 
        :fieldKey="fieldKey" 
        :uploadService="uploadServiceRoute"
        :crop-type="cropType"
        :image="croppedImage" 
        @onUploadDone="handleUploadDone"
        @onUploadError="handleUploadError" 
      />
    </InfoModal>
  </div>
</template>
