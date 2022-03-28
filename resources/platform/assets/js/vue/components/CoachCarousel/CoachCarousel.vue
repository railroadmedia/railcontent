<script setup>
import { defineProps, ref } from "vue";
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/solid";
import SingleCoach from "./SingleCoach.vue";
import { textColor } from '../../../constants/brands'

const resultsRef = ref();
const props = defineProps({
  coaches: {
    type: Object,
    default: [{}, {}, {}, {}, {}, {}, {}],
  },
  brand: {
    type: String,
    default: 'drumeo'
  }
});
</script>

<template>
  <div class="tw-relative">
    <div class="tw-w-[800px] tw-overflow-hidden">
      <div
        class="tw-gap-2 tw-flex"
        :style="{ marginLeft: -toLeft }"
        :ref="resultsRef"
      >
        <SingleCoach v-for="n in 7" :key="n" />
      </div>
    </div>
    <button
      class="
        tw-w-[60px]
        tw-h-[60px]
        tw-bg-[#445f74]
        tw-bg-opacity-20
        tw-flex
        tw-items-center
        tw-justify-center
        tw-absolute
        tw-left-[-30px]
        tw-top-[50%]
        tw-rounded-full
        hover:tw-bg-opacity-100
      "
    >
      <ChevronLeftIcon :class="`tw-p-[12px] ${textColor[brand]}`" />
    </button>
    <button
      class="
        tw-w-[60px]
        tw-h-[60px]
        tw-bg-[#445f74]
        tw-bg-opacity-20
        tw-flex
        tw-items-center
        tw-justify-center
        tw-absolute
        tw-right-[-30px]
        tw-top-[50%]
        tw-rounded-full
        hover:tw-bg-opacity-100
      "
    >
      <ChevronRightIcon :class="`tw-p-[12px] ${textColor[brand]}`" />
    </button>
  </div>
</template>