<script setup>
import { ref, onMounted } from "vue";
import { ArrowSmRightIcon } from "@heroicons/vue/solid";
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
        img: "https://musora.imgix.net/https%3A%2F%2Fd1923uyy6spedc.cloudfront.net%2Fdennis-16x9-1648750627.jpg?auto=format&crop=faces%2Cedges&fit=crop&ixlib=php-1.2.1&s=b32acf1a4f65f567d9ae1923abdf377b",
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
    if (props.slides.length > 0 && currentSlide.value !== props.slides.length - 1) {
      currentSlide.value = currentSlide.value + 1;
    } else {
      currentSlide.value = 0;
    }
  }, 2000);
};

onMounted(() => {
    resetInterval();
});
</script>

<template>
  <div
    class="
      tw-border-[0.5px]
      tw-border-[#344858]
      tw-w-full
      tw-h-[276px]
      tw-border-box
      tw-rounded-[10px]
      tw-transition-all
    "
  >
    <Slide
      :topSubtitle="slides[currentSlide].topSubtitle"
      :title="slides[currentSlide].title"
      :ctaText="slides[currentSlide].ctaText"
      :description="slides[currentSlide].description"
      :ctaUrl="slides[currentSlide].ctaUrl"
      :img="slides[currentSlide].img"
    />
  </div>
</template>
