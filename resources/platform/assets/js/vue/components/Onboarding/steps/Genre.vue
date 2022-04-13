<script setup>
import ProgressBar from "../../ProgressBar/ProgressBar.vue";
import Button from "../../Button/Button.vue";
import StepWrapper from "../StepWrapper.vue";
import StepHeader from "../StepHeader.vue";
import SkipStep from "../SkipStep.vue";
import MultiSelect from "../../MultiSelect/MultiSelect.vue";
import { ref } from "vue";
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
const options = [
  { value: "D", text: "D" },
  { value: "E", text: "E" },
  { value: "F", text: "F" },
];
function handleMultiSelection(selection) {
  emit(
    "onCheckStep",
    4,
    Object.values(selection).find((val) => val)
  );
  emit("onChangeInfo", { ...props.info, genres: selection });
}
function skipStep() {
  alert("* the user skipped the step *");
}

function goBack() {
  emit('onChangeStep', 3);
}
</script>

<template>
  <StepWrapper :brand="brand" :showBgImg="true">
    <div
      class="
        tw-h-full
        md:tw-h-auto
        tw-w-full tw-flex tw-flex-col tw-items-center
        md:tw-justify-center
        tw-mt-[40px]
        md:tw-mt-0
      "
    >
      <StepHeader title="Great. What kind of songs are you into these days?" 
        @onGoBack="goBack" />
      <MultiSelect
        :options="options"
        :initialSelection="info.genres"
        classOverride="tw-mb-[52px]"
        @onChangeSelection="handleMultiSelection"
      />
    </div>
    <div
      class="
        tw-justify-self-end
        md:tw-justify-self-center
        tw-flex tw-flex-col tw-items-center tw-pb-[20px]
        md:tw-pb-0
      "
    >
      <Button
        :brand="brand"
        @onButtonClick="
          () => {
            emit('onChangeStep', 5);
          }
        "
        :isDisabled="!steps[4].checked"
        classOverride="tw-mx-[16px] tw-w-[90vw] tw-mb-[20px] md:tw-hidden tw-block"
        >Next</Button
      >
      <ProgressBar
        :brand="brand"
        :currentStep="4"
        :steps="steps"
        @onChangeStep="(s) => emit('onChangeStep', s)"
      />
      <Button
        :brand="brand"
        @onButtonClick="
          () => {
            emit('onChangeStep', 5);
          }
        "
        :isDisabled="!steps[4].checked"
        classOverride="md:tw-w-[543px] tw-mt-[40px] tw-hidden md:tw-block"
        >Next</Button
      >
      <SkipStep
        @onSkip="skipStep"
        title="SKIP ACCOUNT SETUP"
        classOverride="tw-mt-[20px] md:tw-mt-0"
      />
    </div>
  </StepWrapper>
</template>
