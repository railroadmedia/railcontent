<script setup>
import { ref, onBeforeMount, onMounted } from "vue";
import { testCarousel } from '../../../constants/carousel_data.js';
import {
  ChevronLeftIcon,
  ChevronRightIcon,
} from "@heroicons/vue/solid";
import CarouselSlide from "./CarouselSlide.vue";

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
  } else {
    slides.value = testCarousel.find(({ brand: iBrand }) => iBrand === props.brand).slides;
  }
  prevSlide.value = slides.value.length - 1;
});

onMounted(() => {
  resetInterval();
});
</script>

<template>
  <div
    class="tw-block tw-border-[0.5px] tw-border-[#344858] tw-w-full tw-h-[370px] tw-border-box tw-rounded-[10px] tw-relative tw-my-4 tw-overflow-hidden">

    <CarouselSlide
      v-for="(slide, i) in slides"
      textContentOverride="tw-pb-[26px]"
      :showSlide="i === currentSlide"
      :isPrevSlide="i === prevSlide"
      :key="slide.title"
      :animateDirection="animateDirection"
      :brand="brand"
      :topSubtitle="slide.subtitle"
      :title="slide.title"
      :titleClasses="slide.titleClasses"
      :logo="slide.logo"
      :primaryCtaText="slide.primary_cta_text"
      :primaryCtaTextAlt="slide.primary_cta_alt"
      :primaryCtaUrl="slide.primary_cta_url"
      :primaryCtaUrlAlt="slide.primary_cta_url_alt"
      :secondaryCtaText="slide.secondary_cta_text"
      :secondaryCtaUrl="slide.secondary_cta_url"
      :description="slide.description"
      :registerUrl="slide.endpoint"
      :video="slide.video_src"
      :desktopImg="slide.desktop_img"
      :tabletImg="slide.tablet_img"
      :mobileImg="slide.mobile_img"
      @mouseover="removeInterval"
      @mouseout="resetInterval"
      @keyup.left="handleLeft()"
      @keyup.right="handleRight()"
    />

    <!-- Navigation Dots -->
    <div
        :key="`carousel-nav`"
        class="tw-absolute tw-w-auto tw-bottom-0 tw-justify-center tw-py-[15px] lg:tw-py-[25px] tw-z-40 lg:tw-mx-auto tw-right-[26px]"
        v-if="slides.length > 1"
    >
      <button v-for="(slide, i) in slides" v-bind:key="slide.title" @click="() => handleNavClick(i)" :class="`tw-h-[6px] tw-w-[6px] tw-mr-[10px] lg:tw-mx-[15px]    lg:tw-h-[10px] lg:tw-w-[10px] tw-rounded-full ${i === currentSlide ? 'tw-bg-white' : 'tw-bg-[#c4c4c4]/50'
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
