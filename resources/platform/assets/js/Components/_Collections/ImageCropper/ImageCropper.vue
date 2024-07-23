<script setup>
import { ref,computed } from "vue";
import {
  CheckIcon,
  PlusCircleIcon,
  MinusCircleIcon,
} from "@heroicons/vue/solid";
import { Cropper } from "vue-advanced-cropper";
import "vue-advanced-cropper/dist/style.css";
import MusoraIcon from "@units/MusoraIcons/MusoraIcon"

import CircleStencil from "./CircleStencil.vue";
import SquareStencil from "./SquareStencil.vue";
import RectangleStencil from "./RectangleStencil.vue";

const props = defineProps({
  selectedImage: {
    type: String, //base64 string
    default: null,
  },
  type: {
    type: String,
    default: 'circle'
  }
});
 
//Emits
const emit = defineEmits(['onCrop']);

//Refs
const cropper = ref(null);
const zoomLevel = ref(0); 

//Computed
const stencil = computed(()=> {
  if(props.type === 'circle') return CircleStencil;
  if(props.type === 'square') return SquareStencil;
  if(props.type === 'rectangle') return RectangleStencil;
})

//Methods
function cropImage() {
  const result = cropper.value.getResult();
  const image = result.canvas.toDataURL();
  emit("onCrop", image);
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
      class="musora-cropper"
      :src="selectedImage"
      :stencil-component="stencil"
    />
    <div
      class="
        tw-w-full
        tw-flex
        tw-flex-col
        md:tw-flex-row
        tw-text-white
        tw-py-[15px]
        tw-items-center
        tw-justify-between
        tw-px-[20px]
      "
    >
      <div
        class="tw-w-auto tw-flex tw-text-sm tw-font-bebas-neue"
      >
        <button
          :class="`tw-flex tw-flex-col tw-justify-center tw-items-center tw-mr-[20px] ${
            zoomLevel === 4 ? 'tw-text-[#445F74]' : 'tw-text-black dark:tw-text-white'
          }`"
          @click="zoomIn"
        >
          <PlusCircleIcon class="tw-w-[25px] tw-h-[25px]" />
          ZOOM IN
        </button>
        <button
          :class="`tw-flex tw-flex-col tw-justify-center tw-items-center tw-mr-[20px] ${
            zoomLevel === 0 ? 'tw-text-[#445F74]' : 'tw-text-black dark:tw-text-white'
          }`"
          @click="zoomOut"
        >
          <MinusCircleIcon class="tw-w-[25px] tw-h-[25px]" />
          ZOOM OUT
        </button>
        <button
          class="
            tw-flex tw-flex-col tw-justify-center tw-items-center tw-mr-[20px] tw-text-black dark:tw-text-white
          "
          @click="rotate"
        >
          <MusoraIcon icon-name="rotate-right" class="tw-w-[25px] tw-h-[25px]" width="25" height="25" viewBox="0 0 25 25" />
          Rotate
        </button>
      </div>
      <button
        @click="cropImage"
        class="
          dark:tw-border-white
          tw-border-black
          tw-border-2
          tw-rounded-[25px]
          tw-flex
          tw-items-center
          tw-justify-center
          tw-font-bebas-neue
          tw-h-[42px]
          tw-text-[20px]
          tw-px-[42px]
          tw-text-black dark:tw-text-white
        "
      >
        <CheckIcon class="tw-w-[20px] tw-h-[20px] tw-inline" /> FINISH CROPPING
      </button>
    </div>
  </div>
</template>

<style type="text/css">
.musora-cropper {
  max-height: 60vh !important;
}
</style>