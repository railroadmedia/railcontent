<script setup>
import { defineProps, ref } from "vue";
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/solid";
import SingleCoach from "./SingleCoach.vue";
import { textColor } from "../../../constants/brands";

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

const resultsRef = ref();
const interval = ref(false);
const currentGradientBorder = ref("right");

const gradientMaskMap = {
  left: "gradient-border-left",
  right: "gradient-border-right",
  both: "gradient-border-both",
};

const updateGradientState = (container) => {
  const scrollValue = container.scrollLeft;
  const width = container.scrollWidth - container.offsetWidth;

  if (scrollValue === 0) {
    currentGradientBorder.value = "right";
    stopScroll();
  }
  else if (Math.round(scrollValue) === Math.round(width)) {
    currentGradientBorder.value = "left";
    stopScroll();
  } else if (currentGradientBorder.value !== "both") {
    currentGradientBorder.value = "both"
  }
};

const scrollCarouselLeft = () => {
  interval.value = setInterval(() => {
    const scrollContainer = document.getElementById(
      "coach-carousel-results-container"
    );
    scrollContainer.scrollLeft -= 20;
    updateGradientState(scrollContainer)
  }, 30);
};

const scrollCarouselRight = () => {
  interval.value = setInterval(() => {
    const scrollContainer = document.getElementById(
      "coach-carousel-results-container"
    );
    scrollContainer.scrollLeft += 20;
    updateGradientState(scrollContainer)
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
  updateGradientState(scrollContainer)
}
</script>

<template>
  <div class="tw-relative tw-mb-[20px] md:tw-mb-[40px]">
    <div
      :class="`lg:tw-w-[948px] 2xl:tw-w-[1350px] sm:tw-w-[640px] tw-w-[80vw] tw-overflow-hidden ${gradientMaskMap[currentGradientBorder]}`"
      style="overflow-x: scroll"
      id="coach-carousel-results-container"
      @wheel="onWheelScroll"
    >
      <div class="tw-gap-2 tw-flex tw-transition-all" :ref="resultsRef">
        <SingleCoach v-for="n in 7" :key="n" />
      </div>
    </div>
    <button
      :class="`
        tw-w-[60px]
        tw-h-[60px]
        tw-bg-[#445f74]
        tw-bg-opacity-20
        tw-items-center
        tw-justify-center
        tw-absolute
        tw-left-[-30px]
        tw-top-[50%]
        tw-rounded-full
        hover:tw-bg-opacity-100
        ${currentGradientBorder === 'right' ? 'tw-hidden' : 'tw-hidden md:tw-flex'}
        `
      "
      @mousedown="scrollCarouselLeft"
      @mouseup="stopScroll"
    >
      <ChevronLeftIcon :class="`tw-p-[12px] ${textColor[brand]}`" />
    </button>
    <button
      :class="
        `tw-w-[60px]
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
        ${currentGradientBorder === 'left' ? 'tw-hidden' : 'tw-hidden md:tw-flex'}
        `
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

.gradient-border-both {
  -webkit-mask-image: linear-gradient(
    90deg,
    rgba(0, 0, 0, 0) 0%,
    rgba(0, 0, 0, 1) 7%,
    rgba(0, 0, 0, 1) 93%,
    rgba(0, 0, 0, 0) 100%
  );
  mask-image: linear-gradient(
    90deg,
    rgba(0, 0, 0, 0) 0%,
    rgba(0, 0, 0, 1) 7%,
    rgba(0, 0, 0, 1) 93%,
    rgba(0, 0, 0, 0) 100%
  );
}

.gradient-border-left {
  -webkit-mask-image: linear-gradient(
    90deg,
    rgba(0, 0, 0, 0) 0%,
    rgba(0, 0, 0, 1) 7%,
    rgba(0, 0, 0, 1) 93%,
    rgba(0, 0, 0, 1) 100%
  );
  mask-image: linear-gradient(
    90deg,
    rgba(0, 0, 0, 0) 0%,
    rgba(0, 0, 0, 1) 7%,
    rgba(0, 0, 0, 1) 93%,
    rgba(0, 0, 0, 1) 100%
  );
}

.gradient-border-right {
  -webkit-mask-image: linear-gradient(
    90deg,
    rgba(0, 0, 0, 1) 0%,
    rgba(0, 0, 0, 1) 7%,
    rgba(0, 0, 0, 1) 93%,
    rgba(0, 0, 0, 0) 100%
  );
  mask-image: linear-gradient(
    90deg,
    rgba(0, 0, 0, 1) 0%,
    rgba(0, 0, 0, 1) 7%,
    rgba(0, 0, 0, 1) 93%,
    rgba(0, 0, 0, 0) 100%
  );
}
</style>