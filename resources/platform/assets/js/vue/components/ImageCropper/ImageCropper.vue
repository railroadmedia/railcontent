<script setup>
import { ref } from "vue";
import {
  CheckIcon,
  PlusCircleIcon,
  MinusCircleIcon,
} from "@heroicons/vue/solid";
import { Cropper } from "vue-advanced-cropper";
import "vue-advanced-cropper/dist/style.css";

import Stencil from "./Stencil.vue";

const props = defineProps({
  selectedImage: {
    type: String,
    default: null,
  },
});

const emit = defineEmits(['onCrop']);

const cropper = ref(null);
const zoomLevel = ref(0);

function cropImage() {
  const imageSelection = cropper.value.getResult();
  emit("onCrop", imageSelection.image.src);
}

function zoomIn() {
  if (zoomLevel.value < 4) {
    ++zoomLevel.value;
    const factor = 1.4;
    const center = { left: 150, top: 150 };
    cropper.value.zoom(factor, center);
  }
}

function zoomOut() {
  if (zoomLevel.value > 0) {
    --zoomLevel.value;
    const factor = 0.6;
    const center = { left: 150, top: 150 };
    cropper.value.zoom(factor, center);
  }
}

function rotate() {
  cropper.value.rotate(90);
}
</script>

<template>
  <div class="tw-w-full tw-h-full">
    <Cropper
      ref="cropper"
      class="upload-example-cropper"
      :src="selectedImage"
      :stencil-component="Stencil"
    />
    <div
      class="
        tw-w-full
        tw-flex
        tw-text-white
        tw-py-[15px]
        tw-items-center
        tw-justify-between
        tw-px-[20px]
      "
    >
      <div
        class="tw-w-auto tw-flex tw-text-[13px]"
        style="font-family: Bebas Neue"
      >
        <button
          :class="`tw-flex tw-flex-col tw-justify-center tw-items-center tw-mr-[20px] ${
            zoomLevel === 4 ? 'tw-text-[#445F74]' : ''
          }`"
          @click="zoomIn"
        >
          <PlusCircleIcon class="tw-w-[25px] tw-h-[25px]" />
          ZOOM IN
        </button>
        <button
          :class="`tw-flex tw-flex-col tw-justify-center tw-items-center tw-mr-[20px] ${
            zoomLevel === 0 ? 'tw-text-[#445F74]' : ''
          }`"
          @click="zoomOut"
        >
          <MinusCircleIcon class="tw-w-[25px] tw-h-[25px]" />
          ZOOM OUT
        </button>
        <button
          class="
            tw-flex tw-flex-col tw-justify-center tw-items-center tw-mr-[20px]
          "
          @click="rotate"
        >
          Rotate
        </button>
      </div>
      <button
        style="font-family: Roboto Condensed"
        @click="cropImage"
        class="
          tw-border-white
          tw-border-2
          tw-rounded-[25px]
          tw-text-[14px]
          tw-w-[164px]
          tw-h-[30px]
          tw-flex
          tw-items-center
          tw-justify-center
        "
      >
        <CheckIcon class="tw-w-[20px] tw-h-[20px] tw-inline" /> FINISH CROPPING
      </button>
    </div>
  </div>
</template>
