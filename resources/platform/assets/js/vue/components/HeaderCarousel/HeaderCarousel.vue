<script setup>
import { ref, onMounted } from "vue";
import {
  ArrowSmRightIcon,
  ChevronLeftIcon,
  ChevronRightIcon,
} from "@heroicons/vue/solid";
import Slide from "./Slide.vue";

const props = defineProps({
  slides: {
    type: Array,
    default: [
      {
        topSubtitle: "STEP BY STEP CURRICULUM",
        title: "DRUMEO METHOD",
        ctaText: "START METHOD",
        description:
          "Exclusive curriculum so you’ll always know what to work on for maximum results.",
        ctaUrl: "#",
        img: "https://musora.imgix.net/https%3A%2F%2Fd1923uyy6spedc.cloudfront.net%2Fdennis-16x9-1648750627.jpg?auto=format&crop=faces%2Cedges&fit=crop&ixlib=php-1.2.1&s=b32acf1a4f65f567d9ae1923abdf377b",
      },
      {
        topSubtitle: "TEST",
        title: "TEST",
        ctaText: "TEST",
        description:
          "ExclusivASDASD um so yousdasd sd asd ’ll always k results.",
        ctaUrl: "#",
        img: "https://musora.imgix.net/https%3A%2F%2Fcdn.musora.com%2Fimage%2Ffetch%2Fc_fill%2Cw_1920%2Ch_823%2Cq_auto%3Agood%2Fhttps%3A%2F%2Fd1923uyy6spedc.cloudfront.net%2Fcoaches-2022%2Fdrumeo%2FAaron-Edgar-ACTION.jpg?auto=format&crop=faces%2Cedges&fit=crop&ixlib=php-1.2.1&s=4e4c88f8bf9839131168e117231f634e",
      },
      {
        topSubtitle: "TEST2",
        title: "TEST2",
        ctaText: "TEST2",
        description:
          "ExclusivASDASD um so yousdasd sd asd ’ll always k results 2.",
        ctaUrl: "#",
        img: "https://musora.imgix.net/https%3A%2F%2Fcdn.musora.com%2Fimage%2Ffetch%2Fc_fill%2Cw_1920%2Ch_823%2Cq_auto%3Agood%2Fhttps%3A%2F%2Fd1923uyy6spedc.cloudfront.net%2Fcoaches-2022%2Fdrumeo%2FDAVE-ATKINSON-ACTION.jpg?auto=format&crop=faces%2Cedges&fit=crop&ixlib=php-1.2.1&s=fea4bfe75d6cef4106ac93acd97d2a4b",
      },
    ],
  },
});
const currentSlide = ref(0);
const slideInterval = ref(null);

const resetInterval = () => {
  clearInterval(slideInterval.value);
  slideInterval.value = false;
  slideInterval.value = setInterval(() => {
    if (
      props.slides.length > 0 &&
      currentSlide.value !== props.slides.length - 1
    ) {
      currentSlide.value = currentSlide.value + 1;
    } else {
      currentSlide.value = 0;
    }
    console.log(currentSlide.value);
  }, 6000);
};

const handleLeftClick = () => {
  if (props.slides.length > 0 && currentSlide.value !== 0) {
    currentSlide.value = currentSlide.value - 1;
  } else {
    currentSlide.value = props.slides.length - 1;
  }
  resetInterval();
};

const handleRightClick = () => {
  if (
    props.slides.length > 0 &&
    currentSlide.value !== props.slides.length - 1
  ) {
    currentSlide.value = currentSlide.value + 1;
  } else {
    currentSlide.value = 0;
  }
  resetInterval();
};

const handleNavClick = (index) => {
  currentSlide.value = index;
};

onMounted(() => {
  resetInterval();
});
</script>

<template>
  <div
    class="
      tw-block
      tw-border-[0.5px]
      tw-border-[#344858]
      tw-w-full
      tw-h-[276px]
      tw-border-box
      tw-rounded-[10px]
      tw-relative
      tw-my-4
    "
  >
    <Slide
      v-for="(slide, i) in slides"
      :showSlide="i === currentSlide"
      v-bind:key="slide.title"
      :topSubtitle="slide.topSubtitle"
      :title="slide.title"
      :ctaText="slide.ctaText"
      :description="slide.description"
      :ctaUrl="slide.ctaUrl"
      :img="slide.img"
    />
    <div
      class="
        tw-absolute
        tw-w-auto
        tw-bottom-0
        tw-justify-center
        tw-py-[25px]
        tw-z-40
        tw-translate-x-[-50%]
        tw-left-2/4
        tw-mx-auto
      "
    >
      <button
        v-for="(slide, i) in slides"
        v-bind:key="slide.title"
        @click="() => handleNavClick(i)"
        :class="`tw-mx-[15px] tw-h-[10px] tw-w-[10px] tw-rounded-full ${
          i === currentSlide ? 'tw-bg-white' : 'tw-bg-[#c4c4c4]/50'
        }`"
      />
    </div>
    <div
      class="
        tw-w-full
        tw-absolute
        tw-bottom-0
        tw-flex
        tw-justify-end
        tw-px-[36px]
        tw-py-[8px]
        tw-z-30
      "
    >
      <button
        class="
          tw-rounded-full
          tw-border-2
          tw-border-white
          tw-text-white
          tw-h-[30px]
          tw-w-[30px]
          tw-m-[12px]
          hover:tw-text-black hover:tw-bg-white hover:tw-border-none
        "
        @click="handleLeftClick"
      >
        <ChevronLeftIcon />
      </button>
      <button
        class="
          tw-rounded-full
          tw-border-2
          tw-border-white
          tw-text-white
          tw-h-[30px]
          tw-w-[30px]
          tw-m-[12px]
          hover:tw-text-black hover:tw-bg-white hover:tw-border-none
        "
        @click="handleRightClick"
      >
        <ChevronRightIcon />
      </button>
    </div>
  </div>
</template>
