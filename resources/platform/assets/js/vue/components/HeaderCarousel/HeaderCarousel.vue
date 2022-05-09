<script setup>
import { ref, onBeforeMount, onMounted } from "vue";
import { testCarousel } from '../../../constants/carousel_data.js';
import {
  ArrowSmRightIcon,
  ChevronLeftIcon,
  ChevronRightIcon,
} from "@heroicons/vue/solid";
import Slide from "./Slide.vue";

const props = defineProps({
  brand: {
    type: String,
    default: 'drumeo'
  },
  preloadedCarousel: {
    type: Array,
    default: [],
  },
});
const currentSlide = ref(0);
const slides = ref([]);
const slideInterval = ref(null);

const removeInterval = () => {
  if (slideInterval.value) {
    clearInterval(slideInterval.value);
    slideInterval.value = false;
  }
};

const resetInterval = () => {
  removeInterval();
  slideInterval.value = setInterval(() => {
    if (slides.value.length > 0 && currentSlide.value !== slides.value.length - 1) {
      currentSlide.value = currentSlide.value + 1;
    } else {
      currentSlide.value = 0;
    }
  }, 6000);
};

const handleLeft = () => {
  if (slides.value.length > 0 && currentSlide.value !== 0) {
    currentSlide.value = currentSlide.value - 1;
  } else {
    currentSlide.value = slides.value.length - 1;
  }
  resetInterval();
};

const handleRight = () => {
  if (slides.value.length > 0 && currentSlide.value !== slides.value.length - 1) {
    currentSlide.value = currentSlide.value + 1;
  } else {
    currentSlide.value = 0;
  }
  resetInterval();
};

const handleNavClick = (index) => {
  currentSlide.value = index;
};

onBeforeMount(() => {
  if (props.preloadedCarousel.length > 0) {
    slides.value = props.preloadedCarousel.find(({ brand: iBrand }) => iBrand === props.brand).slides;
  } else {
    slides.value = testCarousel.find(({ brand: iBrand }) => iBrand === props.brand).slides;
  }
});

onMounted(() => {
  resetInterval();
});
</script>

<template>
  <div
    class="tw-block tw-border-[0.5px] tw-border-[#344858] tw-w-full tw-h-[276px] tw-border-box tw-rounded-[10px] tw-relative tw-my-4">
    <Slide v-for="(slide, i) in slides" :showSlide="i === currentSlide" :key="slide.title"
      :topSubtitle="slide.topSubtitle" :title="slide.title" :ctaText="slide.ctaText" :description="slide.description"
      :ctaUrl="slide.ctaUrl" :img="slide.img" @mouseover="removeInterval" @mouseout="resetInterval" @keyup.left="handleLeft()" @keyup.right="handleRight()" />

    <!-- Directional Buttons -->
    <div :key="`carousel-directional-buttons`"
      class="tw-absolute tw-bottom-0 tw-right-0 tw-flex tw-justify-end tw-py-[8px] tw-z-30 tw-mr-[21px] tw-mb-[9px] md:tw-mr-[21px] md:tw-mb-[12px] lg:tw-mr-[26px] lg:tw-mb-[20px]">

      <button
        class="tw-rounded-full tw-border-2 tw-border-white tw-text-white tw-h-[23px] tw-w-[23px] lg:tw-h-[26px] lg:tw-w-[26px] hover:tw-text-black hover:tw-bg-white hover:tw-border-none"
        @click="handleLeft()">
        <ChevronLeftIcon />
      </button>

      <button
        class="tw-rounded-full tw-border-2 tw-border-white tw-text-white tw-h-[23px] tw-w-[23px] lg:tw-h-[26px] lg:tw-w-[26px] tw-ml-[10px] md:tw-ml-[23px] hover:tw-text-black hover:tw-bg-white hover:tw-border-none"
        @click="handleRight()">
        <ChevronRightIcon />
      </button>
    </div>

    <!-- Navigation Dots -->
    <div :key="`carousel-nav`"
      class="tw-absolute tw-w-auto tw-bottom-0 tw-justify-center tw-py-[15px] lg:tw-py-[25px] tw-z-40 lg:tw-translate-x-[-50%] lg:tw-left-2/4 lg:tw-mx-auto tw-px-[26px] lg:tw-px-0">
      <button v-for="(slide, i) in slides" v-bind:key="slide.title" @click="() => handleNavClick(i)" :class="`tw-h-[6px] tw-w-[6px] tw-mr-[10px] lg:tw-mx-[15px] lg:tw-h-[10px] lg:tw-w-[10px] tw-rounded-full ${i === currentSlide ? 'tw-bg-white' : 'tw-bg-[#c4c4c4]/50'
      }`" />
    </div>
  </div>
</template>
