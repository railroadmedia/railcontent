<script setup>
import axios from "axios";
import { onMounted, ref, inject } from "vue";
import { v4 as uuidv4 } from 'uuid';
import { useUserStore } from '../../../stores/user';
import { storeToRefs } from 'pinia';
import UploadProgress from "../UploadProgress/UploadProgress.vue";

const props = defineProps({
  image: {
    type: String, //base64 image string
  },
  uploadService: {
    type: String,
    default: ''
  },
  fieldKey: {
    type: String,
    default: null
  },
  successMessage: {
    type: String,
    default: null
  },
  cropType: {
    type: String,
    default: 'square',
  }
});

const userStore = useUserStore();
const { userId } = storeToRefs(userStore);
const token = inject('csrf_token');

const emit = defineEmits(['onUploadDone', 'onUploadError']);

const percentCompleted = ref(0);

function dataURItoBlob(dataURI) {
  // convert base64/URLEncoded data component to raw binary data held in a string
  var byteString;
  if (dataURI.split(',')[0].indexOf('base64') >= 0)
    byteString = atob(dataURI.split(',')[1]);
  else
    byteString = unescape(dataURI.split(',')[1]);

  // separate out the mime component
  var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

  // write the bytes of the string to a typed array
  var ia = new Uint8Array(byteString.length);
  for (var i = 0; i < byteString.length; i++) {
    ia[i] = byteString.charCodeAt(i);
  }

  return new Blob([ia], { type: mimeString });
}

onMounted(() => {
  var formData = new FormData();
  const newFileName = `${userId.value}_${Date.now()}_${uuidv4()}.png`;

  // We need dataURItoBlob for the BE to accept the data transfer, it does not accept base64 string.
  formData.append('file', dataURItoBlob(props.image), newFileName);
  formData.append('target', newFileName);
  formData.append('_method', 'POST');
  formData.append('fieldKey', props.fieldKey);

  Vapor.store(formData.get('file'), {
    visibility: 'public-read',
    progress: progress => {
      percentCompleted.value = progress * 100;
    }
  }).then(response => {
    const options = token ? {
      headers: {
        'X-CSRF-TOKEN': token
      }
    } : {};
    axios.post(props.uploadService, {
      uuid: response.uuid,
      s3_bucket_path: response.key,
      bucket: response.bucket,
      fieldKey: props.fieldKey
    }, options).then((resolved) => {
      if (resolved) {
        emit('onUploadDone', resolved.data);
      }
    }).catch(() => {
      emit('onUploadError');
    });
  }).catch(() => {
    emit('onUploadError');
  });
});
</script>

<template>
  <div class="tw-flex tw-flex-col tw-px-[40px] tw-pb-[48px] tw-w-full">
    <div class="tw-flex tw-flex-col tw-justify-center tw-items-center">
      <img class="tw-h-[100px]" 
          :class="[cropType === 'rectangle' ? 'tw-aspect-video' : 'tw-aspect-square', cropType === 'circle' ? 'tw-rounded-full' : 'tw-rounded-md' ]"
          :src="image" alty="Profile picture thumbnail" 
        />
      <div class="tw-w-full tw-text-center tw-text-white tw-mt-[20px] tw-pb-[20px]" style="font-family: Open Sans">
        <h2 class="tw-text-bold tw-mb-[12px] tw-text-[16px]">
          {{ percentCompleted === 100 ? props.successMessage : 'Uploading in progress' }}
        </h2>
        <p class="tw-italic tw-text-[14px] tw-text-[#E5E5E5]">
          {{ percentCompleted === 100 ? '' : 'This will take a few short seconds' }}
        </p>
      </div>
      <UploadProgress :percentage="percentCompleted" />
    </div>
  </div>
</template>
