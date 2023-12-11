<script setup>
import { ref, onBeforeMount, onMounted } from "vue";
import {
  ChevronLeftIcon,
  ChevronRightIcon,
} from "@heroicons/vue/solid";
import CarouselSlide from "./CarouselSlide.vue";

const props = defineProps({
  preloadedCarousel: {
    type: Array,
    default: [],
  },
});

const currentSlide = ref(0);
const slides = ref([]);
const slideInterval = ref(null);
const animateDirection = ref('right');
const prevSlide = ref(0);

const removeInterval = () => {
  if (slideInterval.value) {
    clearInterval(slideInterval.value);
    slideInterval.value = false;
  }
};

const resetInterval = () => {
  removeInterval();
  slideInterval.value = setInterval(() => {
    animateDirection.value = 'right';
    prevSlide.value = currentSlide.value;
    if (slides.value.length > 0 && currentSlide.value !== slides.value.length - 1) {
      currentSlide.value = currentSlide.value + 1;
    } else {
      currentSlide.value = 0;
    }
  }, 15000);
};

const handleLeft = () => {
  animateDirection.value = 'left';
  prevSlide.value = currentSlide.value;
  if (slides.value.length > 0 && currentSlide.value !== 0) {
    currentSlide.value = currentSlide.value - 1;
  } else {
    currentSlide.value = slides.value.length - 1;
  }
  resetInterval();
};

const handleRight = () => {
  animateDirection.value = 'right';
  prevSlide.value = currentSlide.value;
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
      slides.value = props.preloadedCarousel;
      prevSlide.value = slides.value.length - 1;
  }

});

onMounted(() => {
  resetInterval();
});
</script>

<template>
  <div
    :class="slides.length > 0 ? 'tw-block tw-border-[0.5px] tw-border-[#A1A1A9] dark:tw-border-[#344858] tw-w-full tw-h-[370px] tw-border-box tw-rounded-[10px] tw-relative tw-mt-[16px] tw-mb-[30px] tw-overflow-hidden' : 'tw-mb-4'">

    <CarouselSlide
      v-for="(slide, i) in slides"
      textContentOverride="tw-pb-[26px]"
      :showSlide="i === currentSlide"
      :isPrevSlide="i === prevSlide"
      :key="slide.title"
      :animateDirection="animateDirection"
      :topSubtitle="slide.subtitle"
      :topSubtitleColor="slide.subtitle_color"
      :title="slide.title"
      :titleColor="slide.title_color"
      :logo="slide.logo"
      :btnLightMode="!!slide.btn_light_mode"
      :primaryCtaText="slide.primary_cta_text"
      :primaryCtaUrl="slide.primary_cta_url"
      :primaryVideo="slide.primary_video_src"
      :secondaryCtaText="slide.secondary_cta_text"
      :secondaryCtaUrl="slide.secondary_cta_url"
      :description="slide.description"
      :descriptionColor="slide.desc_color"
      :secondaryVideo="slide.video_src"
      :is-featured="!!slide.is_featured"
      :desktopImg="slide.desktop_img"
      :tabletImg="slide.tablet_img"
      :mobileImg="slide.mobile_img"
      :is-draft="slide.draft === 1"
    />

      <!-- Directional Buttons -->
      <div
          :key="`carousel-directional-buttons`"
          class="tw-absolute tw-bottom-0 tw-right-0 tw-flex tw-justify-end tw-py-[8px] tw-z-30 tw-mr-[21px] tw-mb-[9px] md:tw-mr-[21px] md:tw-mb-[12px] lg:tw-mr-[26px] lg:tw-mb-[20px]"
          v-if="slides.length > 1"
      >

          <button
              class="tw-bg-[#000C17] tw-rounded-full tw-border-2 tw-border-white tw-text-white tw-h-[23px] tw-w-[23px] lg:tw-h-[30px] lg:tw-w-[30px] hover:tw-text-[#00101D] hover:tw-bg-white hover:tw-border-none"
              @click="handleLeft()">
              <ChevronLeftIcon />
          </button>

          <button
              class="tw-bg-[#000C17] tw-rounded-full tw-border-2 tw-border-white tw-text-white tw-h-[23px] tw-w-[23px] lg:tw-h-[30px] lg:tw-w-[30px] tw-ml-[10px] md:tw-ml-[23px] hover:tw-text-[#00101D] hover:tw-bg-white hover:tw-border-none"
              @click="handleRight()">
              <ChevronRightIcon />
          </button>
      </div>

      <!-- Navigation Dots -->
      <div
          :key="`carousel-nav`"
          class="tw-absolute tw-w-auto tw-bottom-0 tw-justify-center tw-py-[15px] lg:tw-py-[25px] tw-z-40 lg:tw-translate-x-[-50%] lg:tw-left-2/4 lg:tw-mx-auto tw-px-[26px] lg:tw-px-0"
          v-if="slides.length > 1"
      >
          <button v-for="(slide, i) in slides" v-bind:key="slide.title" @click="() => handleNavClick(i)" :class="`tw-h-[6px] tw-w-[6px] tw-mr-[10px] lg:tw-mx-[15px] lg:tw-h-[10px] lg:tw-w-[10px] tw-rounded-full ${i === currentSlide ? 'tw-bg-white' : 'tw-bg-[#c4c4c4]/50'
      }`" />
      </div>
  </div>
</template>

<style type="text/css">
.slide-in-right {
	-webkit-animation: slide-in-right 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
	        animation: slide-in-right 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
}
.slide-in-left {
	-webkit-animation: slide-in-left 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
	        animation: slide-in-left 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
}

@-webkit-keyframes slide-in-left {
  0% {
    -webkit-transform: translateX(-1000px);
            transform: translateX(-1000px);
    opacity: 0;
  }
  100% {
    -webkit-transform: translateX(0);
            transform: translateX(0);
    opacity: 1;
  }
}
@keyframes slide-in-left {
  0% {
    -webkit-transform: translateX(-1000px);
            transform: translateX(-1000px);
    opacity: 0;
  }
  100% {
    -webkit-transform: translateX(0);
            transform: translateX(0);
    opacity: 1;
  }
}

@-webkit-keyframes slide-in-right {
  0% {
    -webkit-transform: translateX(1000px);
            transform: translateX(1000px);
    opacity: 0;
  }
  100% {
    -webkit-transform: translateX(0);
            transform: translateX(0);
    opacity: 1;
  }
}
@keyframes slide-in-right {
  0% {
    -webkit-transform: translateX(1000px);
            transform: translateX(1000px);
    opacity: 0;
  }
  100% {
    -webkit-transform: translateX(0);
            transform: translateX(0);
    opacity: 1;
  }
}
</style>
