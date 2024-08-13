<script setup>
import VideoModal from "../Modal/VideoModal.vue";
import { computed, ref } from "vue";
import { useUserStore } from "../../../Stores/user";
import userJourney from "../../../Services/userJourney";
import DraftLabel from '../../_Units/DraftLabel/DraftLabel';

const userStore = useUserStore();

const props = defineProps({
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
  skillLevel: {
    type: String,
    default: ''
  },
  trackingSection: {
    type: String,
    default: ''
  }
});

const primaryVideoModal = ref(false);
const secondaryVideoModal = ref(false);

const skillLevelColor = computed(() => {
  switch (props.skillLevel) {
    case 'All':
      return 'tw-bg-white';
    case 'Introductory':
      return 'tw-bg-[#22C55E]';
    case 'Beginner':
      return 'tw-bg-[#0B76DB]';
    case 'Intermediate':
      return 'tw-bg-[#EAB308]';
    case 'Advanced':
      return 'tw-bg-[#F06314]';
    case 'Expert':
      return 'tw-bg-[#B91C1C]';
    default:
      return 'tw-bg-[#22C55E]';
  }
});

const handleCtaClick = (event, url) => {
  if (props.trackingSection && props.trackingSection.length) {
    event.preventDefault();

    userJourney.trackHomeContentClick({
      payload: {
        contentId: null,
        brand: userStore.brand,
        section: props.trackingSection,
      }
    }).finally(() => {
      window.location.href = url;
    });
  }
};

</script>

<template>
  <div v-if="showSlide || isPrevSlide" :class="`tw-overflow-hidden tw-rounded-[10px] tw-absolute tw-w-full tw-h-full tw-bg-[#000C17]
        ${showSlide ? `tw-z-20 ${showSlide ? `slide-in-${animateDirection}` : ''}` : 'tw-z-0'}
      `">
    <section class="tw-w-full tw-h-full tw-rounded-[10px] tw-relative">
      <!-- Draft Label -->
      <DraftLabel v-if="isDraft" />

      <!-- Background Image -->
      <div class="tw-absolute tw-inset-0 tw-bg-cover tw-bg-top z-10">
        <picture>
          <source media="(min-width:1280px)"
            :srcset="`https://www.musora.com/musora-cdn/image/width=2500,quality=95/${desktopImg}`">
          <source media="(min-width:1024px)"
            :srcset="`https://www.musora.com/musora-cdn/image/width=1780,quality=95/${desktopImg}`">
          <source media="(min-width:768px)"
            :srcset="`https://www.musora.com/musora-cdn/image/width=1470,quality=95/${tabletImg}`">
          <source media="(min-width:640px)"
            :srcset="`https://www.musora.com/musora-cdn/image/width=1220,quality=95/${tabletImg}`">
          <img class="tw-w-full tw-h-full tw-object-cover tw-object-top tw-z-50"
            :src="`https://www.musora.com/musora-cdn/image/width=790,quality=95/${mobileImg}`"
            alt="banner background image" />
        </picture>
      </div>

      <!-- Text Content -->
      <div class="tw-absolute tw-bottom-0 tw-w-full md:tw-relative tw-text-white tw-h-4/5 md:tw-h-full">
        <div
          class="tw-flex tw-flex-col tw-flex-wrap tw-text-white tw-text-uppercase tw-h-full tw-justify-end lg:tw-mb-0 lg:tw-justify-center tw-px-[15px] sm:tw-px-[26px] tw-font-open-sans tw-pb-12 sm:tw-pb-[38px] md:tw-pb-10 lg:tw-pb-0 tw-relative">
          <h4 class="tw-font-bold tw-text-sm tw-uppercase tw-leading-none tw-mb-3"
            :class="`${topSubtitleColor && `tw-text-${topSubtitleColor}`}`" v-if="topSubtitle && !logo">{{ topSubtitle
            }}</h4>
          <h2 class="
              tw-font-bebas-neue
              tw-text-[40px]
              sm:tw-text-[50px]
              tw-mb-1
              tw-uppercase
              tw-leading-none
            " :class="`${titleColor && `tw-text-${titleColor}`}`" v-if="title && !logo">
            {{ title }}
          </h2>
          <!-- Logo -->
          <img v-if="logo" class="tw-h-24 md:tw-h-28 3xl:tw-h-32 mb-1 tw-mr-auto"
            :src="`https://www.musora.com/musora-cdn/image/width=800,quality=95/${logo}`" alt="pack logo" />
          <div v-if="isFeatured && skillLevel" class="tw-flex tw-items-center tw-font-semibold md:tw-text-lg"
            :class="`${descriptionColor && `tw-text-${descriptionColor}`}`">
            <div class="tw-inline-block tw-w-[9px] tw-h-[9px] tw-rounded-full tw-mr-2" :class="skillLevelColor"></div>
            {{ skillLevel }}
          </div>
          <p :class="`tw-hidden xl:tw-line-clamp-3 tw-text-lg tw-max-w-[520px] ${descriptionColor && `tw-text-${descriptionColor}`}`"
            v-html="description"></p>
          <!-- CTA -->
          <div
            class="tw-mt-2 md:tw-mt-4 xl:tw-mt-6 tw-flex tw-items-center md:tw-block tw-max-w-[450px] md:tw-max-w-none">
            <a v-if="primaryCtaText && primaryCtaUrl && !primaryVideo" :href="primaryCtaUrl"
              @click="(e) => handleCtaClick(e, primaryCtaUrl)"
              :class="`tw-btn-primary tw-text-center md:tw-px-10 lg:tw-px-[30px] tw-mr-2 tw-line-clamp-1 md:tw-inline-block ${btnLightMode ? 'tw-bg-[#00101D] tw-text-white hover:tw-text-[#000C17] hover:tw-bg-white' : 'tw-bg-white tw-text-[#000C17] hover:tw-bg-[#627F97] hover:tw-text-white'} md:tw-mb-2 ${secondaryCtaText ? 'tw-flex-1 tw-px-2' : 'tw-px-6'}`">
              {{ primaryCtaText }}
            </a>
            <span v-if="primaryCtaText && primaryVideo" @click="primaryVideoModal = true"
              :class="`tw-btn-primary tw-text-center md:tw-px-10 lg:tw-px-[30px] tw-mr-2 tw-line-clamp-1 md:tw-inline-block ${btnLightMode ? 'tw-bg-[#00101D] tw-text-white hover:tw-text-[#000C17] hover:tw-bg-white' : 'tw-bg-white tw-text-[#000C17] hover:tw-bg-[#627F97] hover:tw-text-white'} md:tw-mb-2 tw-cursor-pointer ${secondaryCtaText ? 'tw-flex-1 tw-px-2' : 'tw-px-6'}`">
              {{ primaryCtaText }}
            </span>
            <a v-if="secondaryCtaText && secondaryCtaUrl && !secondaryVideo" :href="secondaryCtaUrl"
              @click="(e) => handleCtaClick(e, secondaryCtaUrl)"
              :class="`tw-btn-primary tw-flex-1 tw-text-center tw-border-2 tw-font-bebas-neue tw-rounded-full tw-px-2 md:tw-px-10 lg:tw-px-[30px] tw-line-clamp-1 md:tw-inline-block ${btnLightMode ? 'tw-bg-white tw-border-[#000C17] tw-text-[#000C17] hover:tw-bg-[#00101D] hover:tw-text-white' : 'tw-bg-[#000C17] tw-border-white tw-text-white hover:tw-bg-white hover:tw-text-[#000C17]'} md:tw-mb-2`">
              {{ secondaryCtaText }}
            </a>
            <span v-if="secondaryCtaText && secondaryVideo" @click="secondaryVideoModal = true"
              :class="`tw-btn-primary tw-flex-1 tw-text-center tw-border-2 tw-font-bebas-neue tw-rounded-full tw-px-2 md:tw-px-10 lg:tw-px-[30px] tw-line-clamp-1 md:tw-inline-block ${btnLightMode ? 'tw-bg-white tw-border-[#000C17] tw-text-[#000C17] hover:tw-bg-[#00101D] hover:tw-text-white' : 'tw-bg-[#000C17] tw-border-white tw-text-white hover:tw-bg-white hover:tw-text-[#000C17]'} md:tw-mb-2 tw-cursor-pointer`">
              {{ secondaryCtaText }}
            </span>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!--  Primary Video Modal  -->
  <VideoModal v-if="primaryVideoModal" :videoUrl="primaryVideo" @onCloseModal="primaryVideoModal = false" />

  <!--  Secondary Video modal  -->
  <VideoModal v-if="secondaryVideoModal" :videoUrl="secondaryVideo" @onCloseModal="secondaryVideoModal = false" />
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
