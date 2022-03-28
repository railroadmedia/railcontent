<script setup>
import { defineProps, ref } from "vue";
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/solid";
import SingleCoach from "./SingleCoach.vue";
import { textColor } from "../../../constants/brands";

const resultsRef = ref();
const interval = ref(false);

const props = defineProps({
  coaches: {
    type: Object,
    default: [{}, {}, {}, {}, {}, {}, {}],
  },
  brand: {
    type: String,
    default: "drumeo",
  },
});

const scrollCarouselLeft = () => {
  interval.value = setInterval(() => {
    const scrollContainer = document.getElementById(
      "coach-carousel-results-container"
    );
    scrollContainer.scrollLeft -= 20;
  }, 30);
};

const scrollCarouselRight = () => {
  interval.value = setInterval(() => {
    const scrollContainer = document.getElementById(
      "coach-carousel-results-container"
    );
    scrollContainer.scrollLeft += 20;
  }, 30);
};

function stopScroll() {
  clearInterval(interval.value);
  interval.value = false;
}

function onWheelScroll(e) {
  e.preventDefault();
  const scrollContainer = document.getElementById(
    "coach-carousel-results-container"
  );
  if (e.deltaY > 0) {
    scrollContainer.scrollLeft += 25;
  } else {
    scrollContainer.scrollLeft -= 25;
  }
}
</script>

<template>
  <div class="tw-relative">
    <div
      class="tw-w-[800px] tw-overflow-hidden"
      style="overflow-x: scroll"
      id="coach-carousel-results-container"
      @wheel="onWheelScroll"
    >
      <div class="tw-gap-2 tw-flex tw-transition-all" :ref="resultsRef">
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
      @mousedown="scrollCarouselLeft"
      @mouseup="stopScroll"
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
      @mousedown="scrollCarouselRight"
      @mouseup="stopScroll"
    >
      <ChevronRightIcon :class="`tw-p-[12px] ${textColor[brand]}`" />
    </button>
  </div>
</template>

<style scoped>
#coach-carousel-results-container::-webkit-scrollbar {
  height: 0 !important;
  width: 0 !important;
}

#coach-carousel-results-container {
  overflow: -moz-scrollbars-none;
}

#coach-carousel-results-container {
  -ms-overflow-style: none;
}
</style>