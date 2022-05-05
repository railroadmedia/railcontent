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
const carouselData = ref([]);
const slideInterval = ref(null);

const resetInterval = (carouselData, brand) => {
  clearInterval(slideInterval.value);
  slideInterval.value = false;
  slideInterval.value = setInterval(() => {
    carouselData.value.forEach(carousel => {
      if(carousel.brand === brand) {
        if (carousel.slides.length > 0 && currentSlide.value !== carousel.slides.length - 1) {
          currentSlide.value = currentSlide.value + 1;
        } else {
          currentSlide.value = 0;
        }
      }
    });
    // console.log(currentSlide.value);
  }, 6000);
};

const handleLeftClick = (carousel) => {
  if (carousel.slides.length > 0 && currentSlide.value !== 0) {
    currentSlide.value = currentSlide.value - 1;
  } else {
    currentSlide.value = carousel.slides.length - 1;
  }
  resetInterval(carouselData, carousel.brand);
};

const handleRightClick = (carousel) => {
  if (carousel.slides.length > 0 && currentSlide.value !== carousel.slides.length - 1) {
    currentSlide.value = currentSlide.value + 1;
  } else {
    currentSlide.value = 0;
  }
  resetInterval(carouselData, carousel.brand);
};

const handleNavClick = (index) => {
  currentSlide.value = index;
};

onBeforeMount( () => {
  if(props.preloadedCarousel.length > 0) {
    carouselData.value = props.preloadedCarousel;
  } else {
    carouselData.value = testCarousel;
  }
});

onMounted(() => {
  console.log(window.location)
  resetInterval(carouselData, props.brand);
});
</script>

<template>
  <div class="tw-block tw-border-[0.5px] tw-border-[#344858] tw-w-full tw-h-[276px] tw-border-box tw-rounded-[10px] tw-relative tw-my-4">
    <template v-for="(carousel, i) in carouselData">
      <template v-if="carousel.brand === brand">
        
        <Slide
          v-for="(slide, j) in carousel.slides"
          :showSlide="j === currentSlide"
          :key="j"
          :topSubtitle="slide.topSubtitle"
          :title="slide.title"
          :ctaText="slide.ctaText"
          :description="slide.description"
          :ctaUrl="slide.ctaUrl"
          :img="slide.img"
        />

        <!-- Directional Buttons -->
        <div :key="`carousel-${i}-buttons`" class="tw-w-full tw-absolute tw-bottom-0 tw-flex tw-justify-end tw-px-[26px] lg:tw-px-[36px] tw-py-[8px] tw-z-30">
          
          <button class="tw-rounded-full tw-border-2 tw-border-white tw-text-white tw-h-[30px] tw-w-[30px] tw-m-[12px] hover:tw-text-black hover:tw-bg-white hover:tw-border-none"
                  @click="handleLeftClick(carousel)"
          >
            <ChevronLeftIcon />
          </button>

          <button class="tw-rounded-full tw-border-2 tw-border-white tw-text-white tw-h-[30px] tw-w-[30px] tw-m-[12px] hover:tw-text-black hover:tw-bg-white hover:tw-border-none"
                  @click="handleRightClick(carousel)"
          >
            <ChevronRightIcon />
          </button>
        </div>

        <!-- Navigation Dots -->
        <div :key="`carousel-${i}-nav`" class="tw-absolute tw-w-auto tw-bottom-0 tw-justify-center tw-py-[25px] tw-z-40 lg:tw-translate-x-[-50%] lg:tw-left-2/4 lg:tw-mx-auto tw-px-[26px] lg:tw-px-0">
          <button
            v-for="(slide, j) in carousel.slides"
            v-bind:key="slide.title"
            @click="() => handleNavClick(j)"
            :class="`tw-h-[6px] tw-w-[6px] tw-mx-[5px] lg:tw-mx-[15px] lg:tw-h-[10px] lg:tw-w-[10px] tw-rounded-full ${
              j === currentSlide ? 'tw-bg-white' : 'tw-bg-[#c4c4c4]/50'
            }`"
          />
        </div>

      </template>
    </template>


  </div>
</template>
