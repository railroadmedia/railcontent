<script setup>
import UploadProgress from "../UploadProgress/UploadProgress.vue";
import axios from "axios";
import { onMounted, ref } from "vue";

const FILE_UPLOAD_SERVICE = () => window.ENDPOINT_PREFIX + "/user-management-system/profile-picture/upload";

const props = defineProps({
  image: {
    type: Blob,
  },
  userId: {
    type: String,
    default: 'random-uuid'
  },
});

const emit = defineEmits(['onUploadDone']);

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

    return new Blob([ia], {type:mimeString});
}

onMounted(() => {
  var data = new FormData();
  const newFileName = `${props.userId}_${Date.now()}.png`;

  // We need dataURItoBlob for the BE to accept the data transfer, it does not accept base64 string.
  data.append('file', dataURItoBlob(props.image), newFileName);
  data.append('target', newFileName);
  data.append('_method', 'POST');

  var config = {
    'content-type': 'multipart/form-data',
    processData: false,
    contentType: false,
    onUploadProgress: function (progressEvent) {
      percentCompleted.value = Math.round(
        (progressEvent.loaded * 100) / progressEvent.total
      );
    },
  };

  axios
    .post(FILE_UPLOAD_SERVICE(), data, config)
    .then(function (res) {
      emit('onUploadDone', res.data.profile_picture_url);
    })
    .catch(function (err) {
      console.log(err);
    });
});
</script>

<template>
  <div class="tw-flex tw-flex-col tw-px-[40px] tw-pb-[48px] tw-w-full">
    <div class="tw-flex tw-flex-col tw-justify-center tw-items-center">
      <img
        class="tw-w-[100px] tw-h-[100px] tw-rounded-full"
        :src="image"
        alty="Profile picture thumbnail"
      />
      <div
        class="tw-w-full tw-text-center tw-text-white tw-mt-[20px] tw-pb-[20px]"
        style="font-family: Open Sans"
      >
        <h2 class="tw-text-bold tw-mb-[12px] tw-text-[16px]">
          {{ percentCompleted === 100 ? 'Image uploaded' : 'Uploading in progress'  }}
        </h2>
        <p class="tw-italic tw-text-[14px] tw-text-[#E5E5E5]">
          {{ percentCompleted === 100 ? 'You can close this modal' : 'This will take a few short seconds'  }}
        </p>
      </div>
      <UploadProgress :percentage="percentCompleted" />
    </div>
  </div>
</template>
