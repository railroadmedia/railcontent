<script setup>
import ProgressBar from "../../ProgressBar/ProgressBar.vue";
import Button from "../../Button/Button.vue";
import StepWrapper from "../StepWrapper.vue";
import CoachCarousel from "../../CoachCarousel/CoachCarousel.vue";
import InputLabel from "../../InputLabel/InputLabel.vue";
import { SearchIcon } from "@heroicons/vue/solid";


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

function onInputChange(value) {
    console.log('searching for', value)
}
</script>

<template>
  <StepWrapper :brand="brand" :showBgImg="true">
    <h2 class="tw-mb-[5px] tw-w-full tw-text-center tw-font-bold tw-text-white">
      Finally, choose your coaches.
    </h2>
    <p class="tw-font-[16px] tw-mb-[15px] md:tw-w-[692px] md:tw-block tw-hidden tw-text-white tw-text-center">
      Here are some coaches we think you’ll like based on your experience and
      genre preferences. When you follow a coach you will get notified when they
      release new content.
    </p>
    <div class="tw-relative tw-h-[42px] tw-mb-[40px] tw-w-[600px]">
    <InputLabel
        placeholder="Find a coach..."
        classOverride="tw-text-white tw-w-full tw-bg-[#002039]/90 tw-absolute tw-pl-[36px] tw-box-border"
        @onChange="onInputChange"
      />
      <SearchIcon class="tw-absolute tw-w-[16px] tw-h-[16px] tw-text-[#7E9AB1] tw-mt-[14px] tw-ml-[14px]" />
    </div>
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
      classOverride="tw-w-[543px] tw-mt-[40px]"
      >COMPLETE YOUR ACCOUNT</Button
    >
  </StepWrapper>
</template>