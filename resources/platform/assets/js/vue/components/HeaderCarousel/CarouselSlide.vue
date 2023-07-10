<script setup>
import ModalRenderer from "../Modal/ModalRenderer";
import { XIcon } from "@heroicons/vue/solid";
import { ref } from "vue";

const props = defineProps({
  brand: {
    type: String,
    default: "",
  },
  topSubtitle: {
    type: String,
    default: "",
  },
  topSubtitleColor: {
    type: String,
    default: "",
  },
  title: {
    type: String,
    default: "",
  },
  titleColor: {
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
  btnLightMode: {
    type: Boolean,
    default: false,
  },
  primaryCtaText: {
    type: String,
    default: "",
  },
  primaryCtaUrl: {
    type: String,
    default: "",
  },
  primaryVideo: {
    type: String,
    default: "",
  },
  secondaryCtaText: {
    type: String,
    default: "",
  },
  secondaryCtaUrl: {
    type: String,
    default: "",
  },
  secondaryVideo: {
    type: String,
    default: "",
  },
  description: {
    type: String,
    default: "",
  },
  descriptionColor: {
    type: String,
    default: "",
  },
  isFeatured: {
    type: [Boolean, Number],
    default: false,
  },
  desktopImg: {
    type: String,
    default: "",
  },
  tabletImg: {
    type: String,
    default: "",
  },
  mobileImg: {
    type: String,
    default: "",
  },
  isDraft: {
    type: Boolean,
    default: false,
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

const primaryVideoModal = ref(false);
const secondaryVideoModal = ref(false);

</script>

<template>
  <div v-if="showSlide || isPrevSlide"
      :class="`tw-overflow-hidden tw-rounded-[10px] tw-absolute tw-w-full tw-h-full tw-bg-[#000C17]
        ${ showSlide ? `tw-z-20 ${showSlide ? `slide-in-${animateDirection}` : ''}` : 'tw-z-0' }
      `"
  >
    <section class="tw-w-full tw-h-full tw-rounded-[10px] tw-relative">
        <!-- Draft Label -->
        <div v-if="isDraft" class="tw-text-white tw-absolute tw-right-2 md:tw-right-6 tw-top-2 md:tw-top-6 tw-z-50 tw-font-extrabold tw-text-xl tw-rounded-xl tw-bg-red-700 tw-px-6 tw-py-1">DRAFT</div>

        <!-- Background Image -->
        <div class="tw-absolute tw-inset-0 tw-bg-cover tw-bg-top z-10">
            <picture>
                <source media="(min-width:1280px)" :srcset="`https://www.musora.com/musora-cdn/image/width=2000,quality=85/${desktopImg}`">
                <source media="(min-width:768px)" :srcset="`https://www.musora.com/musora-cdn/image/width=1500,quality=85/${tabletImg}`">
                <img
                    class="tw-w-full tw-h-full tw-object-cover tw-object-top tw-z-50"
                    :src="`https://www.musora.com/musora-cdn/image/width=700,quality=85/${mobileImg}`"
                    alt="banner background image"
                />
            </picture>
        </div>
      <!-- Text Content -->
      <div class="tw-absolute tw-bottom-0 tw-w-full md:tw-relative tw-text-white tw-h-4/5 md:tw-h-full">
        <div class="tw-flex tw-flex-col tw-flex-wrap tw-text-white tw-text-uppercase tw-h-full tw-justify-end lg:tw-mb-0 lg:tw-justify-center tw-px-[15px] sm:tw-px-[26px] tw-font-open-sans tw-pb-12 sm:tw-pb-[38px] md:tw-pb-10 lg:tw-pb-0 tw-relative">
          <h4 class="tw-font-bold tw-text-sm tw-uppercase tw-leading-none tw-mb-3" :class="`${ topSubtitleColor && `tw-text-${topSubtitleColor}` }`" v-if="topSubtitle && !logo">{{ topSubtitle }}</h4>
          <h2 class="
              tw-font-bebas-neue
              tw-text-[50px]
              tw-mb-1
              tw-uppercase
              tw-leading-none
            "
            :class="`${ titleColor && `tw-text-${titleColor}` }`"
              v-if="title && !logo"
            >
            {{ title }}
          </h2>
            <!-- Logo -->
            <img v-if="logo" class="tw-h-24 md:tw-h-28 3xl:tw-h-32 mb-1 tw-mr-auto" :src="`https://www.musora.com/musora-cdn/image/width=800,quality=85${logo}`" alt="pack logo" />
          <p :class="`tw-hidden xl:tw-block xl:tw-line-clamp-3 tw-text-lg tw-max-w-[520px] ${ descriptionColor && `tw-text-${descriptionColor}` }`" v-html="description"></p>
          <!-- CTA -->
            <div class="tw-mt-2 md:tw-mt-4 xl:tw-mt-6 tw-flex tw-items-center md:tw-block">
                <a
                    v-if="primaryCtaText && primaryCtaUrl && !primaryVideo"
                    :href="primaryCtaUrl"
                    :class="`tw-font-bebas-neue tw-rounded-full tw-py-1 sm:tw-py-1 md:tw-py-2 tw-px-6 md:tw-px-10 lg:tw-py-3 lg:tw-px-14 tw-text-lg md:tw-text-xl tw-mr-2 tw-line-clamp-1 lg:tw-line-clamp-none md:tw-inline-block ${btnLightMode ? 'tw-bg-[#00101D] tw-text-white hover:tw-text-[#000C17] hover:tw-bg-white' : 'tw-bg-white tw-text-[#000C17] hover:tw-bg-[#627F97] hover:tw-text-white'} md:tw-mb-2`"
                >
                    {{ primaryCtaText }}
                </a>
                <span
                    v-if="primaryCtaText && primaryVideo"
                    @click="primaryVideoModal = true"
                    :class="`tw-font-bebas-neue tw-rounded-full tw-py-1 sm:tw-py-1 md:tw-py-2 tw-px-6 md:tw-px-10 lg:tw-py-3 lg:tw-px-14 tw-text-lg tw-mr-2 tw-line-clamp-1 lg:tw-line-clamp-none md:tw-inline-block  tw-text-xl ${btnLightMode ? 'tw-bg-[#00101D] tw-text-white hover:tw-text-[#000C17] hover:tw-bg-white' : 'tw-bg-white tw-text-[#000C17] hover:tw-bg-[#627F97] hover:tw-text-white'} md:tw-mb-2 tw-cursor-pointer`"
                >
                    {{ primaryCtaText }}
                </span>
                <a
                    v-if="secondaryCtaText && secondaryCtaUrl && !secondaryVideo"
                    :href="secondaryCtaUrl"
                    :class="`tw-border-2 tw-font-bebas-neue tw-rounded-full tw-py-0.5 sm:tw-py-1 md:tw-py-2 tw-px-6 md:tw-px-10 lg:tw-py-2.5 lg:tw-px-14 tw-text-lg md:tw-text-xl tw-line-clamp-1 lg:tw-line-clamp-none md:tw-inline-block ${btnLightMode ? 'tw-bg-white tw-border-[#000C17] tw-text-[#000C17] hover:tw-bg-[#627F97] hover:tw-text-white' : 'tw-bg-[#000C17] tw-border-white tw-text-white hover:tw-bg-white hover:tw-text-[#000C17]'} md:tw-mb-2`"
                >
                    {{ secondaryCtaText }}
                </a>
                <span
                    v-if="secondaryCtaText && secondaryVideo"
                    @click="secondaryVideoModal = true"
                    :class="`tw-border-2 tw-font-bebas-neue tw-rounded-full tw-py-0.5 sm:tw-py-1 md:tw-py-2 tw-px-6 md:tw-px-10 lg:tw-py-2.5 lg:tw-px-14 tw-text-lg md:tw-text-xl tw-line-clamp-1 lg:tw-line-clamp-none md:tw-inline-block ${btnLightMode ? 'tw-bg-white tw-border-[#000C17] tw-text-[#000C17] hover:tw-bg-[#627F97] hover:tw-text-white' : 'tw-bg-[#000C17] tw-border-white tw-text-white hover:tw-bg-white hover:tw-text-[#000C17]'} md:tw-mb-2 tw-cursor-pointer`"

                >
                    {{ secondaryCtaText }}
                </span>
            </div>
<!--            <div v-if="registerUrl || secondaryVideo" class="tw-gap-2 tw-mt-2 tw-hidden xl:tw-flex tw-flex-wrap">-->
<!--                <a v-if="registerUrl" :href="ctaUrl" :class="`tw-btn-primary tw-bg-${brand} tw-text-xl go-to-button tw-w-[200px]`">-->
<!--                    {{ ctaText }}-->
<!--                </a>-->
<!--                <span v-if="secondaryVideo" @click="openModal()" class="tw-btn-secondary tw-text-white tw-text-xl tw-w-[200px] tw-z-100 tw-relative">Learn More</span>-->
<!--            </div>-->
        </div>
      </div>
    </section>
  </div>

    <!--  Primary Video Modal  -->
    <ModalRenderer v-if="primaryVideoModal">
        <button @click="primaryVideoModal = false;"
                class="tw-text-white tw-absolute tw-right-2 tw-top-2 md:tw-top-[32px] md:tw-right-[48px] tw-z-50">
            <XIcon class="tw-w-[26px] tw-h-[26px] md:tw-w-[48px] md:tw-h-[48px]" />
        </button>
        <div class="tw-w-full tw-mx-6 lg:tw-mx-0 lg:tw-w-1/2 tw-relative" style="padding-bottom: 56.25%;">
            <iframe class="tw-absolute tw-w-full tw-h-full reset-on-close" :src="primaryVideo" frameborder="0" allowfullscreen allow="autoplay" title="primaryVideo"></iframe>
        </div>
    </ModalRenderer>

    <!--  Secondary Video modal  -->
    <ModalRenderer v-if="secondaryVideoModal">
        <button @click="secondaryVideoModal = false;"
                class="tw-text-white tw-absolute tw-right-2 tw-top-2 md:tw-top-[32px] md:tw-right-[48px] tw-z-50">
            <XIcon class="tw-w-[26px] tw-h-[26px] md:tw-w-[48px] md:tw-h-[48px]" />
        </button>
        <div class="tw-w-full tw-mx-6 lg:tw-mx-0 lg:tw-w-1/2 tw-relative" style="padding-bottom: 56.25%;">
            <iframe class="tw-absolute tw-w-full tw-h-full reset-on-close" :src="secondaryVideo" frameborder="0" allowfullscreen allow="autoplay" title="secondaryVideo"></iframe>
        </div>
    </ModalRenderer>
</template>

<style type="text/css">
/*.header-carousel-slide-bg {*/
/*  transition: all 1s;*/
/*  background: linear-gradient(0deg, #000C17 1.16%, #000C17 38.86%, rgba(0, 12, 23, 0) 70.78%), linear-gradient(180deg, rgba(0, 0, 0, 0) 75.35%, #000000 98.04%), linear-gradient(0deg, #000C17 1.16%, #000C17 28.86%, rgba(0, 12, 23, 0) 50.78%);*/
/*}*/

/*.header-carousel-slide-bg:hover {*/
/*  background: linear-gradient(0deg, #000C17 1.16%, #000C17 38.86%, rgba(0, 12, 23, 0) 99.78%), linear-gradient(180deg, rgba(0, 0, 0, 0) 75.35%, #000000 98.04%), linear-gradient(0deg, #000C17 1.16%, #000C17 28.86%, rgba(0, 12, 23, 0) 50.78%);*/
/*}*/

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

