<script setup>
import UploadProgress from "../UploadProgress/UploadProgress.vue";
import axios from "axios";
import { onMounted, ref } from "vue";

const FILE_UPLOAD_SERVICE = "";

const props = defineProps({
  image: {
    type: String,
  },
});

const percentCompleted = ref(0);

onMounted(() => {
  var data = new FormData();
  data.append("profile-pic", "profile-pic-img");
  data.append("data", props.image);

  var config = {
    onUploadProgress: function (progressEvent) {
      percentCompleted.value = Math.round(
        (progressEvent.loaded * 100) / progressEvent.total
      );
    },
  };

  axios
    .post(FILE_UPLOAD_SERVICE, data, config)
    .then(function (res) {
      console.log("success", res);
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
          Uploading in progress
        </h2>
        <p class="tw-italic tw-text-[14px] tw-text-[#E5E5E5]">
          This will take a few short seconds
        </p>
      </div>
      <UploadProgress :percentage="percentCompleted" />
    </div>
  </div>
</template>