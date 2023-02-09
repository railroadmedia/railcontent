<script setup>
import { ArrowSmRightIcon } from "@heroicons/vue/solid";
import ModalRenderer from "../Modal/ModalRenderer";
import { XIcon } from "@heroicons/vue/solid";
import { onMounted, ref } from "vue";
import {testCarousel} from "../../../constants/carousel_data";
const props = defineProps({
  brand: {
    type: String,
    default: "",
  },
  topSubtitle: {
    type: String,
    default: "",
  },
  title: {
    type: String,
    default: "",
  },
  titleClasses: {
    type: String,
    default: ""
  },
  logo: {
    type: String,
    default: "",
  },
  ctaText: {
    type: String,
    default: "",
  },
  description: {
    type: String,
    default: "",
  },
  ctaUrl: {
    type: String,
    default: "",
  },
  registerUrl: {
    type: String,
    default: "",
  },
  video: {
    type: String,
    default: "",
  },
  img: {
    type: String,
    default: "",
  },
  showSlide: {
    type: Boolean,
    default: false,
  },
  textContentOverride: {
    type: String,
    default: ''
  },
  animateDirection: {
    type: String,
    default: ''
  },
  isPrevSlide: {
    type: Boolean,
    default: false,
  },
});

const learnMoreModal = ref(false);
const screenSize = ref(window.innerWidth);

const goToUrl = (url) => {
  if (url) {
      if(props.video && screenSize.value > 1279) return;
      window.location.href = url;
  }
};

const detectScreenSize = () => {
    window.addEventListener("resize", ()=>{
        screenSize.value = window.innerWidth;
    });
};

const openModal = () => {
    learnMoreModal.value = true;
};

const closeModal = () => {
    learnMoreModal.value = false;
};

onMounted(() => {
    detectScreenSize();
});
</script>

<template>
  <div v-if="showSlide || isPrevSlide"
      :class="`tw-bg-[#000C17] tw-overflow-hidden tw-rounded-[10px] tw-absolute tw-w-full tw-h-full tw-cursor-pointer
        ${ showSlide ? `tw-z-20 ${showSlide ? `slide-in-${animateDirection}` : ''}` : 'tw-z-0' }
      `"
      @click="goToUrl(ctaUrl)"
  >
    <section class="tw-w-full tw-h-full tw-rounded-[10px] tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-0 header-carousel-slide-bg">
      <!-- Mobile Image -->
      <div class="md:tw-hidden tw-bg-top tw-bg-cover tw-absolute tw-w-full tw-top-0 tw-min-h-[25vh] tw-text-white"
           :style="`background-color: rgb(0, 16, 29); background-image: url('${img}'); background-position: 50% center;`"
      >
        <div style="width: 100%; height: 100%; background: linear-gradient(rgba(0, 16, 29, 0) 50%, rgb(0, 16, 29));"></div>
      </div>
      <!-- Text Content -->
      <div class="tw-absolute tw-bottom-0 tw-w-full md:tw-relative tw-text-white md:tw-bg-[#00101D] tw-h-4/5 md:tw-h-full tw-bg-gradient-to-t tw-from-[#00101D] tw-via-[#00101D]">
        <div class="tw-flex tw-flex-col tw-text-white tw-text-uppercase tw-h-full tw-justify-end lg:tw-mb-0 lg:tw-justify-center tw-px-[26px] tw-font-open-sans tw-pb-[26px] lg:tw-pb-0">
          <h4 class="tw-font-bold tw-text-sm tw-uppercase tw-leading-none tw-mb-3">{{ topSubtitle }}</h4>
          <h2 class="
              tw-font-bebas-neue
              tw-text-[50px]
              tw-mb-1
              tw-uppercase
              tw-leading-none
            "
            :class="titleClasses"
            >
            {{ title }}
          </h2>
            <!-- Logo -->
            <img v-if="logo" class="tw-h-24 mb-1 tw-mr-auto" :src="`${logo}`" alt="pack logo" />
          <p class="tw-text-sm tw-mb-3 tw-hidden xl:tw-block xl:tw-line-clamp-3" v-html="description"></p>
          <!-- CTA -->
          <span
              class="tw-text-white tw-font-bebas-neue tw-text-lg tw-hidden xl:tw-block"
              v-if="ctaText"
          >{{ ctaText }}
            <ArrowSmRightIcon class="tw-inline tw-w-[20px] tw-h-[18px]" />
          </span>
            <div v-if="registerUrl || video" class="tw-gap-2 tw-mt-2 tw-hidden xl:tw-flex tw-flex-wrap">
                <a v-if="registerUrl" :href="ctaUrl" :class="`tw-btn-primary tw-bg-${brand} tw-text-xl go-to-button tw-w-[200px]`">
                    {{ registerUrl === ctaUrl ? 'Register Now' : 'Go To Course' }}
                </a>
                <span v-if="video && registerUrl === ctaUrl" @click="openModal()" class="tw-btn-secondary tw-text-white tw-text-xl tw-w-[200px] tw-z-100 tw-relative">Learn More</span>
            </div>
        </div>
      </div>
      <!-- Desktop Image -->
      <div class="tw-hidden md:tw-flex tw-bg-top tw-bg-cover tw-text-white"
           :style="`background-color: rgb(0, 16, 29); background-image: url('${img}');  background-position: 50% center;`">
           <div class="tw-w-full tw-h-full" style="background: linear-gradient(268deg, rgba(0, 16, 29, 0) 50%, rgb(0, 16, 29))"></div>
      </div>
    </section>
  </div>

    <ModalRenderer v-if="learnMoreModal">
        <button @click="closeModal"
                class="tw-text-white tw-absolute tw-right-2 tw-top-2 md:tw-top-[32px] md:tw-right-[48px] tw-z-50">
            <XIcon class="tw-w-[26px] tw-h-[26px] md:tw-w-[48px] md:tw-h-[48px]" />
        </button>
        <div class="tw-w-full tw-mx-6 lg:tw-mx-0 lg:tw-w-1/2 tw-relative" style="padding-bottom: 56.25%;">
            <iframe class="tw-absolute tw-w-full tw-h-full reset-on-close" src="//player.vimeo.com/video/738385463?autoplay=1" frameborder="0" allowfullscreen allow="autoplay" title="learn more video"></iframe>
        </div>
    </ModalRenderer>
</template>

<style type="text/css">
.header-carousel-slide-bg {
  transition: all 1s;
  background: linear-gradient(0deg, #000C17 1.16%, #000C17 38.86%, rgba(0, 12, 23, 0) 70.78%), linear-gradient(180deg, rgba(0, 0, 0, 0) 75.35%, #000000 98.04%), linear-gradient(0deg, #000C17 1.16%, #000C17 28.86%, rgba(0, 12, 23, 0) 50.78%);
}

.header-carousel-slide-bg:hover {
  background: linear-gradient(0deg, #000C17 1.16%, #000C17 38.86%, rgba(0, 12, 23, 0) 99.78%), linear-gradient(180deg, rgba(0, 0, 0, 0) 75.35%, #000000 98.04%), linear-gradient(0deg, #000C17 1.16%, #000C17 28.86%, rgba(0, 12, 23, 0) 50.78%);
}

/* Same as .md */
/* @media (min-width: 768px) {
  .header-carousel-slide-bg {
    background: linear-gradient(89.96deg, #000C17 1.16%, #000C17 38.86%, rgba(0, 12, 23, 0) 70.78%), linear-gradient(182.34deg, rgba(0, 0, 0, 0) 75.35%, #000000 98.04%), linear-gradient(89.96deg, #000C17 1.16%, #000C17 28.86%, rgba(0, 12, 23, 0) 50.78%);
  }
  .header-carousel-slide-bg:hover {
    background: linear-gradient(89.96deg, #000C17 1.16%, #000C17 38.86%, rgba(0, 12, 23, 0) 99.78%), linear-gradient(182.34deg, rgba(0, 0, 0, 0) 75.35%, #000000 98.04%), linear-gradient(89.96deg, #000C17 1.16%, #000C17 28.86%, rgba(0, 12, 23, 0) 50.78%);
  }
} */
</style>

