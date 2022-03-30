<script setup>
import ProgressBar from "../../ProgressBar/ProgressBar.vue";
import Button from "../../Button/Button.vue";
import StepWrapper from "../StepWrapper.vue";
import CoachCarousel from '../../CoachCarousel/CoachCarousel.vue'

import { defineEmits, defineProps, ref } from "vue";

const props = defineProps({
  brand: {
    type: String,
  },
  steps: {
    type: Array,
  },
  info: {
    type: Object,
  },
});

const emit = defineEmits(["onChangeStep", "onCheckStep", "onChangeInfo"]);
</script>

<template>
  <StepWrapper :brand="brand" :showBgImg="true">
    <h2 class="tw-mb-[5px] tw-w-full tw-text-center tw-font-bold tw-text-white">
      Finally, choose your coaches.
    </h2>
    <p class="tw-font-[16px] tw-mb-[40px] tw-max-w-[624px] tw-text-white">
      Here are some coaches we think you’ll like based on your experience and
      genre preferences. When you follow a coach you will get notified when they
      release new content.
    </p>
    <CoachCarousel :brand="brand" />
    <ProgressBar
      :brand="brand"
      :currentStep="6"
      :steps="steps"
      @onChangeStep="(s) => emit('onChangeStep', s)"
    />
    <Button
      :brand="brand"
      @onButtonClick="
        () => {
          emit('onChangeStep', 1);
        }
      "
      :isDisabled="!steps[0].checked"
      classOverride="tw-w-[543px] tw-mt-[40px]"
      >COMPLETE YOUR ACCOUNT</Button
    >
  </StepWrapper>
</template>