<script setup>
import MusicIcon from "./MusicIcon.vue";
defineProps(["title", "subtitle", "color"]);
const colorMap = {
  red: "#EF4444",
  blue: "#3B82F6",
  yellow: "#EAB308",
  green: "#22C55E",
};
</script>

<template>
  <div
    :class="`tw-flex tw-h-full tw-w-full tw-flex-col tw-items-center tw-justify-center tw-px-[8px] md:tw-px-[30px] tw-text-white`"
  >
    <div class="tw-flex tw-flex-row md:tw-flex-col">
      <MusicIcon classOverride="tw-mb-[12px] tw-h-[22px] tw-w-[22px] tw-mx-1 md:tw-mx-0 md:tw-h-[54px] md:tw-w-[54px]" :color="colorMap[color]" />
      <div
        class="tw-text-[24px] md:tw-text-[32px] tw-leading-[20px] md:tw-leading-[40px]"
        style="font-family: Bebas Neue; font-weight: 700"
      >
        {{ title }}
      </div>
    </div>
    <div
      class="tw-mt-[10px] tw-flex tw-flex-row tw-items-center tw-justify-center"
      style="
        font-family: Open Sans;
        font-weight: 400;
        line-height: 21px;
        font-size: 14px;
      "
    >
      {{ subtitle }}
    </div>
  </div>
</template>
